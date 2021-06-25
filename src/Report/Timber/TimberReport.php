<?php

declare(strict_types=1);

namespace App\Report\Timber;

use App\Repository\TimberRepository;
use Tlc\ReportBundle\Dataset\PdfDataset;
use Tlc\ReportBundle\Dataset\SummaryPdfDataset;
use Tlc\ReportBundle\Entity\BaseEntity;
use Tlc\ReportBundle\Entity\Column;
use Tlc\ReportBundle\Entity\SummaryStat;
use Tlc\ReportBundle\Report\AbstractReport;
use Tlc\ManualBundle\Repository\BreakSheduleRepository;
use Tlc\ManualBundle\Repository\DowntimeRepository;
use DateInterval;
use DatePeriod;
use DateTime;

final class TimberReport extends AbstractReport
{
    public function __construct(
        DatePeriod $period,
        private TimberRepository $timberRepository,
        array $peoples = [],
        array $sqlWhere = []
    ) {

        parent::__construct($period, $peoples, $sqlWhere);
    }

    public function getNameReport(): string
    {
        return "по брёвнам";
    }

    /**
     * @return SummaryStat[]
     */
    public function getSummaryStats(): array
    {
        return [];
    }

    /**
     * @return SummaryStatMaterial[]
     */
    public function getSummaryStatsMaterial(): array
    {
        return [];
    }

    protected function updateDataset(): bool
    {
        $timbers = $this->timberRepository->getReportTimberByPeriod($this->getPeriod(), $this->getSqlWhere());
        if (!$timbers)
            die('В данный период нет брёвен');

        $mainDatatetColumns = [
            new Column(title: 'Порода', precentWidth: 25, group: true, align: 'C', total: false),
            new Column(title: 'Качество', precentWidth: 15, group: true, align: 'C', total: false),
            new Column(title: 'Ø, см', precentWidth: 15, group: true, align: 'C', total: false),
            new Column(title: 'Длина, м', precentWidth: 15, group: true, align: 'C', total: false),
            new Column(title: 'Кол-во, шт', precentWidth: 15, group: false, align: 'C', total: true),
            new Column(title: 'Объём, м³', precentWidth: 15, group: false, align: 'R', total: true),
        ];

        $mainDataset = new PdfDataset(
            columns: $mainDatatetColumns,
            textTotal: 'Общий итог',
            textSubTotal: 'Итог'
        );

        $buff['nameSpecies'] = '';
        $buff['diam'] = '';
        $buff['quality'] = '';
        $buff['stLength'] = '';
        foreach ($timbers as $key => $row) {

            $nameSpecies = $row['name_species'];
            $diam = $row['diam'];
            $quality = $row['quality'];
            $stLength = $row['st_length'];
            $countTimbers = $row['count_timber'];
            $volumeTimbers = $row['volume_timber'] ?? 0;

            if (
                ($buff['nameSpecies'] != $nameSpecies ||
                    $buff['diam'] != $diam ||
                    $buff['quality'] != $quality ||
                    $buff['stLength'] != $stLength) &&
                $key != 0
            ) {
                $mainDataset->addSubTotal();
            }

            $buff['diam'] = $diam;
            $buff['quality'] = $quality;
            $buff['stLength'] = $stLength;
            $buff['nameSpecies'] = $nameSpecies;

            $mainDataset->addRow([
                $nameSpecies,
                $quality,
                $diam,
                $stLength,
                $countTimbers,
                $volumeTimbers
            ]);
        }

        $mainDataset->addSubTotal();
        $mainDataset->addTotal();
        $this->addDataset($mainDataset);
        return true;
    }
}
