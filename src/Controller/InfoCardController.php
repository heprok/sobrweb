<?php

declare(strict_types=1);

namespace App\Controller;

use Tlc\ReportBundle\Entity\BaseEntity;
use App\Repository\ShiftRepository;
use App\Repository\DowntimeRepository;
use App\Repository\TimberRepository;
use DateInterval;
use DatePeriod;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route("api/infocard", name: "info_card_")]
class InfoCardController extends AbstractController
{

    public function __construct(
        private ShiftRepository $shiftRepository,
        private DowntimeRepository $downtimeRepository,
        private TimberRepository $timberRepository,
    ) {
    }

    #[Route("/currentShift", name: "currentShift")]
    public function getCurrentShift()
    {
        $currentShift = $this->shiftRepository->getCurrentShift();
        if (!$currentShift)
            return $this->json(['value' => 'Не начата', 'color' => 'error'], 204);

        return $this->json([
            'value' => $currentShift->getPeople()->getFio(),
            'subtitle' => 'Смена № ' . $currentShift->getNumber(),
            'color' => 'info'
        ]);
    }

    private function getPeriodForDuration(string $duration): ?DatePeriod
    {
        switch ($duration) {
            case 'today':
                $period = BaseEntity::getPeriodForDay();
                break;

            case 'weekly':
                $period = BaseEntity::getPeriodForDay();
                $lastMonday = new DateTime('last monday ' . $period->end->format(BaseEntity::DATE_FORMAT_DB));
                $period = new DatePeriod($lastMonday, $period->getDateInterval(), $period->end);
                break;

            case 'mountly':
                $period = BaseEntity::getPeriodForDay();
                $start = $period->getStartDate();
                $start->setDate((int)$start->format('Y'), (int)$start->format('n'), 1);
                $period = new DatePeriod($start, $period->getDateInterval(), $period->getEndDate());
                break;

            case 'currentShift':
                $currentShift = $this->shiftRepository->getCurrentShift();
                if (!$currentShift)
                    return null;
                $period = $currentShift->getPeriod();
                break;
        }

        return $period;
    }

    #[Route("/volumeTimbers/{duration}", requirements: ["duration" => "today|currentShift|mountly|weekly"], name: "volumeTimbers")]
    public function getVolumeTimbers(string $duration)
    {
        $period = $this->getPeriodForDuration($duration);
        if (!$period instanceof DatePeriod)
            return $this->json(['value' => '0', 'color' => 'error'], 204);

        $volumeTimbers = number_format($this->timberRepository->getVolumeTimbersByPeriod($period), BaseEntity::PRECISION_FOR_FLOAT, '.', ' ') . ' м³';
        return $this->json([
            'value' => $volumeTimbers,
            'color' => 'info'
        ]);
    }

    #[Route("/countTimbers/{duration}", requirements: ["duration" => "today|currentShift|mountly|weekly"], name: "countTimbers")]
    public function getCountTimbers(string $duration)
    {
        $period = $this->getPeriodForDuration($duration);
        if (!$period instanceof DatePeriod)
            return $this->json(['value' => '0', 'color' => 'error'], 204);

        $countTimbers = $this->timberRepository->getCountTimbersByPeriod($period) . ' шт.';
        return $this->json([
            'value' => $countTimbers,
            'color' => 'info'
        ]);
    }        
    
    // #[Route("/vars/{name}", name: "vars")]
    // public function getVarByName(string $name)
    // {
    //     $var = $this->varsRepository->findOneByName($name);
    //     if(!$var)
    //         return $this->json(['value' => 'Not found', 'color' => 'error']);
            
    //     return $this->json([
    //         'value' => $var->getValue(),
    //         'color' => 'info'
    //     ]);
    // }

    #[Route("/lastDowntime", name: "lastDowntime")]
    public function getLastDowntime()
    {
        $lastDowntime = $this->downtimeRepository->getLastDowntime();
        if (!$lastDowntime)
            return $this->json(['value' => '', 'color' => 'error'], 204);

        $cause = $lastDowntime->getCause();

        $startTime = $lastDowntime->getStartDate();
        $endTime = $lastDowntime->getFinishDate();
        $nowTime = new DateTime();
        // BaseEntity::intervalToString()
        $duration = $endTime ? BaseEntity::intervalToString($endTime->diff($startTime, true)) : 'Продолжается(' . BaseEntity::intervalToString($nowTime->diff($startTime, true)) . ')';
        return $this->json([
            'value' => $cause ? $cause->getName() : '',
            'subtitle' => $duration . '. C ' . $startTime->format(BaseEntity::TIME_FOR_FRONT . '(d.m)') . ' по ' . ($endTime ? $endTime->format(BaseEntity::DATETIME_FOR_FRONT . '(d.m)') : 'Н.В.'),
            'color' => 'orange',
        ]);
    }

    #[Route("/summaryDay/{start}...{end}", name: "summaryDay")]
    public function getSummaryDay(string $start, string $end)
    {
        $startDate = new DateTime($start);
        $endDate = new DateTime($end);
        $period = new DatePeriod($startDate, new DateInterval('P1D'), $endDate);

        $shifts = $this->shiftRepository->findByPeriod($period);
        if (!$shifts)
            return $this->json('Нет смен за заданный день', 404);

        $result['summary'] = ['volumeTimbers' => 0, 'countTimbers' => 0, 'downtime' => new DateTime('00:00')];
        foreach ($shifts as $key => $shift) {
            $result['shifts'][$key]['name'] = 'Смена №' . $shift->getNumber();
            $result['shifts'][$key]['idOperator'] = $shift->getPeople()->getId();
            $result['shifts'][$key]['fioOperator'] = $shift->getPeople()->getFio();
            $result['shifts'][$key]['start'] = $shift->getStart();
            $result['shifts'][$key]['end'] = $shift->getStopDate() ? $shift->getStopDate()->format(BaseEntity::DATE_FORMAT_DB) : date(BaseEntity::DATE_FORMAT_DB);
            $result['shifts'][$key]['volumeTimbers'] = round($this->timberRepository->getVolumeTimbersByPeriod($shift->getPeriod()), BaseEntity::PRECISION_FOR_FLOAT);
            $result['shifts'][$key]['countTimbers'] = $this->timberRepository->getCountTimbersByPeriod($shift->getPeriod());
            $result['shifts'][$key]['downtime'] = $this->downtimeRepository->getTotalDowntimeByPeriod($shift->getPeriod());
        }
        foreach ($result['shifts'] as $shift) {
            $result['summary']['volumeTimbers'] += $shift['volumeTimbers'];
            $result['summary']['countTimbers'] += $shift['countTimbers'];
            $result['summary']['downtime']->add(BaseEntity::stringToInterval($shift['downtime']));
        }

        $result['summary']['volumeTimbers'] = round($result['summary']['volumeTimbers'], BaseEntity::PRECISION_FOR_FLOAT);
        $result['summary']['downtime'] = BaseEntity::intervalToString(date_diff(new DateTime('00:00'), $result['summary']['downtime']));
        return $this->json($result);
    }

    #[Route("/totalDowntime/{duration}", requirements: ["duration" => "today|currentShift|mountly|weekly"], name: "totalTimeDowntime")]
    public function getTotalTimeDowntime(string $duration)
    {
        $period = $this->getPeriodForDuration($duration);
        if (!$period instanceof DatePeriod)
            return $this->json(['value' => '0', 'color' => 'error'], 204);

        $durationTime = $this->downtimeRepository->getTotalDowntimeByPeriod($period);

        if (!$durationTime)
            return $this->json(['value' => '', 'color' => 'error'], 204);

        return $this->json([
            'value' => $durationTime ?? '',
            // 'subtitle' => $duration . '. C ' . $startTime->format(BaseEntity::TIME_FOR_FRONT . '(d.m)') . ' по ' . $endTime->format(BaseEntity::DATETIME_FOR_FRONT . '(d.m)'),
            'color' => 'primary',
        ]);
    }
}
