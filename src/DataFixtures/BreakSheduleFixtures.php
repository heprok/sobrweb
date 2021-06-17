<?php

namespace App\DataFixtures;

use App\Entity\BreakShedule;
use App\Entity\DowntimeCause;
use App\Entity\DowntimePlace;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BreakSheduleFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $causes = $manager->getRepository(DowntimeCause::class)->findAll();
        $places = $manager->getRepository(DowntimePlace::class)->findAll();

        $break = new BreakShedule('10:00', '10:10', $causes[array_rand($causes)], $places[array_rand($places)]);
        $manager->persist($break);
        $break = new BreakShedule('15:00', '15:10', $causes[array_rand($causes)], $places[array_rand($places)]);
        $manager->persist($break);
        $break = new BreakShedule('17:00', '17:15', $causes[array_rand($causes)], $places[array_rand($places)]);
        $manager->persist($break);
        $break = new BreakShedule('13:00', '13:40', $causes[array_rand($causes)], $places[array_rand($places)]);
        $manager->persist($break);
        $break = new BreakShedule('22:00', '22:10', $causes[array_rand($causes)], $places[array_rand($places)]);
        $manager->persist($break);
        $break = new BreakShedule('00:00', '00:45', $causes[array_rand($causes)], $places[array_rand($places)]);
        $manager->persist($break);
        $break = new BreakShedule('03:00', '03:10', $causes[array_rand($causes)], $places[array_rand($places)]);
        $manager->persist($break);
        $break = new BreakShedule('05:00', '05:15', $causes[array_rand($causes)], $places[array_rand($places)]);
        $manager->persist($break);

        $manager->flush();
    }


    public function getDependencies()
    {
        return [
            DowntimeFixtures::class
        ];
    }
}
