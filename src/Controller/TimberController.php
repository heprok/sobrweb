<?php

declare(strict_types=1);

namespace App\Controller;

use App\Report\Timber\TimberReport;
use App\Report\Timber\RegistryTimberPdfReport;
use App\Report\Timber\RegistryTimberReport;
use App\Report\Timber\TimberPdfReport;
use App\Repository\PeopleRepository;
use App\Repository\BreakSheduleRepository;
use App\Repository\TimberRepository;
use Symfony\Component\Routing\Annotation\Route;
use Tlc\ReportBundle\Controller\AbstractReportController;

#[Route("report/timber", name: "report_timber_")]
class TimberController extends AbstractReportController
{
    public function __construct(
        PeopleRepository $peopleRepository,
        private TimberRepository $timberRepository,
        private BreakSheduleRepository $breakSheduleRepository,
    ) {
        parent::__construct($peopleRepository);
    }

    #[Route("/pdf", name: "show_pdf")]
    public function showReportPdf()
    {
        $report = new TimberReport($this->period, $this->timberRepository, $this->peoples, $this->sqlWhere);
        $pdf = new TimberPdfReport($report);
        $pdf->render();
    }

    #[Route("_registry/pdf", name:"from_registry_show_pdf")]
    public function showReportFromRegistryPdf()
    {
        $report = new RegistryTimberReport($this->period, $this->timberRepository, $this->peoples, $this->sqlWhere);
        $pdf = new RegistryTimberPdfReport($report);
        $pdf->render();
    }
}
