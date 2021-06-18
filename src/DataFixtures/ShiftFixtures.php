<?php

namespace App\DataFixtures;

use App\Entity\People;
use App\Entity\Shift;
use DateInterval;
use DatePeriod;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ShiftFixtures extends Fixture implements DependentFixtureInterface
{
    const COUNT_SHIFT = 10;
    
    public function load(ObjectManager $manager)
    {
        $repositoryPeople = $manager->getRepository(People::class);
        $peoples = $repositoryPeople->findAll();
        for ($i=0; $i < self::COUNT_SHIFT; $i++) { 
            $shift = new Shift();
            $randomDateTimestamp = AppFixtures::randomDate();

            $startTime = new DateTime();
            $startTime->setTimestamp($randomDateTimestamp);
            // $shift->setStartDate($startTime);

            $stopTime = new DateTime();
            $stopTime->setTimestamp($randomDateTimestamp + 8 * 60 * 60);
            // $shift->setStopDate($stopTime);
            $period = new DatePeriod($startTime, new DateInterval('P1D'), $stopTime);
            
            $shift->setPeriod($period);
            $shift->setNumber(rand(1, 2));
            
            $shift->setPeople($peoples[rand(0, PeopleFixtures::COUNT_PEOPLE - 1)]);
            $manager->persist($shift);
        }

        $manager->flush();
    }

    public function getDependencies() {
        return [
            PeopleFixtures::class,
        ];
    }
}
