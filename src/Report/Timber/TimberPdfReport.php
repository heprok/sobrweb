<?php

declare(strict_types=1);

namespace App\Report\Timber;

use Tlc\ReportBundle\Report\AbstractPdf;
use Tlc\ReportBundle\Report\AbstractReport;

final class TimberPdfReport extends AbstractPdf
{
    public function __construct(AbstractReport $timberReport)
    {
        $this->setReport($timberReport);
        parent::__constructor();
    }


    protected function getPointFontHeader(): int
    {
        return 10;
    }

    protected function getPointFontText(): int
    {
        return 8;
    }

    protected function getHeightCell(): int
    {
        return 10;
    }
}
