<?php

declare(strict_types=1);

namespace App\Report\Timber;

use Tlc\ReportBundle\Dataset\PdfDataset;
use Tlc\ReportBundle\Entity\BaseEntity;;

use Tlc\ReportBundle\Entity\Column;
use Tlc\ReportBundle\Entity\SummaryStat;
use Tlc\ReportBundle\Entity\SummaryStatMaterial;
use App\Entity\Timber;
use Tlc\ReportBundle\Report\AbstractReport;
use App\Repository\TimberRepository;
use DatePeriod;

final class RegistryTimberReport extends AbstractReport
{
    public function __construct(
        DatePeriod $period,
        private TimberRepository $repository,
        array $people = [],
        array $sqlWhere = []
    ) {
        parent::__construct($period, $people, $sqlWhere);
    }
    /**
     * @return SummaryStatMaterial[]
     */
    public function getSummaryStatsMaterial(): array
    {
        $summaryStatsMaterial = [];

        return $summaryStatsMaterial;
    }

    /**
     *
     * @return SummaryStat[]
     */
    public function getSummaryStats(): array
    {
        $summaryStats = [];
        // $summaryMaterial = $this->getSummaryStatsMaterial();
        // $precent = number_format($summaryMaterial['boards']->getValue() / $summaryMaterial['timber']->getValue() * 100, 0);
        // $summaryStats[] = new SummaryStat('Суммарный процент выхода', $precent, '%');

        return $summaryStats;
    }

    public function getNameReport(): string
    {
        return "хронология брёвен";
    }

    protected function getColumnTotal(): array
    {
        return [];
    }


    protected function updateDataset(): bool
    {
        $timbers = $this->repository->findByPeriod($this->getPeriod(), $this->getSqlWhere());
        if (!$timbers)
            die('В данный период нет брёвен');

        $mainDataSetColumns = [

            new Column(title: "Время записи", precentWidth: 20, group: true, align: 'C', total: false),
            new Column(title: "Порода", precentWidth: 15, group: true, align: 'C', total: false),
            new Column(title: "Качество", precentWidth: 5, group: true, align: 'C', total: false),
            new Column(title: "D 1, мм", precentWidth: 5, group: true, align: 'C', total: false),
            new Column(title: "D 2, мм", precentWidth: 5, group: true, align: 'C', total: false),
            new Column(title: "D u, мм", precentWidth: 5, group: true, align: 'C', total: false),
            new Column(title: "Овальность", precentWidth: 5, group: true, align: 'C', total: false),
            new Column(title: 'Длина, мм', precentWidth: 6, group: true, align: 'C', total: false),
            new Column(title: 'Ст. длина, м', precentWidth: 7, group: true, align: 'C', total: false),
            new Column(title: "Сбег, см/м", precentWidth: 8, group: true, align: 'C', total: false),
            new Column(title: "Кривизна, см/м", precentWidth: 8, group: true, align: 'C', total: false),
            new Column(title: 'Объём, м³', precentWidth: 6, group: true, align: 'C', total: false),
            new Column(title: "Партия", precentWidth: 15, group: true, align: 'C', total: false),
        ];

        $mainDataset = new PdfDataset(
            columns: $mainDataSetColumns,
            textTotal: 'Общий итог',
            textSubTotal: 'Итог'
        );

        foreach ($timbers as $key => $row) {
            $timber = $row[0];
            if ($timber instanceof Timber) {

                $drec = $timber->getDrec();
                $nameSpecies = $timber->getSpecies()->getName();
                $quality = $timber->getQuality();
                $midDiam = $timber->getMidDiam();
                $topDiam = $timber->getTopDiam();
                $buttDiam = $timber->getButtDiam();
                $ovality = $timber->getOvality();
                $length = $timber->getLength();
                $stLength = number_format($row['standart_length'] / 1000, 1);
                $taper = $timber->getTaper();
                $sweep = $timber->getSweep();
                $volume = (float)$row['volume_timber'];
                $batch = $timber->getBatch();

                $mainDataset->addRow([
                    $drec->format(self::FORMAT_DATE_TIME), //"Время записи",
                    $nameSpecies, //Название породы
                    $quality, //"Качество бревна",
                    $buttDiam, //"D 1, мм",
                    $midDiam, //"D 2, мм",
                    $topDiam, //"D u, мм",
                    $ovality,//"Овальность",
                    $length, //'Длина, мм',
                    $stLength, //'Ст. длина, м',
                    $taper, //"Сбег, см/м",
                    $sweep, //"Кривизна, см/м",
                    $volume, //'Объём, м³',
                    $batch->getId() //"Партия",
                ]);
            }
        }

        $this->addDataset($mainDataset);

        return true;
    }
}
