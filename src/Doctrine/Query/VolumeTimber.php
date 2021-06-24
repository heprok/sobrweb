<?php

namespace App\Query;

use DoctrineExtensions\Query\Postgresql\VolumeTimber as BaseQueryVolumeTimber;

final class VolumeTimber extends BaseQueryVolumeTimber
{
    protected function getSchema():string
    {
        return "sobr";
    }
}
