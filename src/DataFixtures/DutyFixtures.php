<?php

namespace App\DataFixtures;

use App\Entity\Duty;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DutyFixtures extends Fixture
{

    const COUNT_DUTY = 5;

    public function load(ObjectManager $manager)
    {
        $arr_duties = [
            'op' =>    'Оператор',
            'se' =>    'Секретарь',
            'mo' =>    'Монтажник',
            'me' =>    'Менеджер',
            'sr' =>    'Оператор Сортировки'
        ];
        foreach ($arr_duties as $code => $name) {
            $duty = new Duty($code, $name);
            $manager->persist($duty);
        }

        $manager->flush();
    }
}
