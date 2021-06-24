<?php

declare(strict_types=1);

namespace App\Controller;

use App\Report\Downtime\TimberReport;
use App\Report\Timber\TimberPdfReport;
use App\Repository\PeopleRepository;
use App\Repository\ShiftRepository;
use App\Repository\BreakSheduleRepository;
use App\Repository\TimberRepository;
use DateInterval;
use DatePeriod;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Tlc\ReportBundle\Report\AbstractReport;

#[Route("report/timber", name: "report_timber_")]
class TimberController extends AbstractController
{
    public function __construct(
        private PeopleRepository $peopleRepository,
        private TimberRepository $timberRepository,
        private BreakSheduleRepository $breakSheduleRepository,
    ) {
    }

    #[Route("/{start}...{end}/people/{idsPeople}/pdf", name: "for_period_with_people_show_pdf")]
    public function showReportForPeriodWithPeoplePdf(string $start, string $end, string $idsPeople)
    {
        $request = Request::createFromGlobals();
        $sqlWhere = json_decode($request->query->get('sqlWhere') ?? '[]');

        $idsPeople = explode('...', $idsPeople);
        $peoples = [];
        foreach ($idsPeople as $idPeople) {
            if ($idPeople != '')
                $peoples[] = $this->peopleRepository->find($idPeople);
        }
        $startDate = new DateTime($start);
        $endDate = new DateTime($end);
        $period = new DatePeriod($startDate, new DateInterval('P1D'), $endDate);
        $report = new TimberReport($period, $this->timberRepository, $peoples, $sqlWhere);
        $this->showPdf($report);
    }

    #[Route("/{start}...{end}/pdf", name: "for_period_show_pdf")]
    public function showReportForPeriodPdf(string $start, string $end)
    {
        $this->showReportForPeriodWithPeoplePdf($start, $end, '');
    }

    private function showPdf(AbstractReport $report)
    {
        $report->init();
        $pdf = new TimberPdfReport($report);
        $pdf->render();
    }
}
