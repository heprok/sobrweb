<?php

namespace App\DataFixtures;

use App\Entity\TimberQuality;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TimberQualityFixtures extends Fixture
{
    const COUNT_TIMBER_QUALITY = 4;
    public function load(ObjectManager $manager)
    {
        $arr_name = [
            '1',
            '2',
            'Брак',
            'Метал',
            'Дрова',
        ];
        

        for ($i = 0; $i < self::COUNT_TIMBER_QUALITY; $i++) {
            $name = $arr_name[$i] ?? "Качество $i";
            $provder = new TimberQuality($name);
            $manager->persist($provder);
        }

        $manager->flush();
    }
}
