<?php

namespace App\DataFixtures;

use App\Entity\ShiftShedule;
use App\Entity\DowntimeCause;
use App\Entity\DowntimePlace;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ShiftSheduleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $shift = new ShiftShedule('20:00', '08:00', '2 смена (ночь)');
        $manager->persist($shift);
        $shift = new ShiftShedule('08:00', '20:00', 'I смена (день)');
        $manager->persist($shift);

        $manager->flush();
    }
}
