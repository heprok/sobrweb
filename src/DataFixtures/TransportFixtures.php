<?php

namespace App\DataFixtures;

use App\Entity\Transport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TransportFixtures extends Fixture
{
    const COUNT_TRANSPORT = 4;
    public function load(ObjectManager $manager)
    {

        $arr_name = [
            'Лесовоз',
            'ЖД',
            'Плот',
            'Баржа',
        ];

        for ($i = 0; $i < self::COUNT_TRANSPORT; $i++) {
            $name = $arr_name[$i] ?? "Транспорт $i";
            $provder = new Transport($name);
            $manager->persist($provder);
        }

        $manager->flush();
    }
}
