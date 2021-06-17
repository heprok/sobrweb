<?php

namespace App\DataFixtures;

use App\Entity\Downtime;
use App\Entity\DowntimeCause;
use App\Entity\DowntimeGroup;
use App\Entity\DowntimeLocation;
use App\Entity\DowntimePlace;
use DateInterval;
use DatePeriod;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DowntimeFixtures extends Fixture
{
    const COUNT_CAUSE = 3;
    const COUNT_PLACE = 3;
    const COUNT_LOCATION = 2;
    const COUNT_GROUP = 2;
    const COUNT_DOWNTIME = 30;

    public function load(ObjectManager $manager)
    {
        $arrPlace = [];
        $arrCause = [];
        $arrGroup = [];
        $arrLocation = [];
        
        for ($i=1; $i <= self::COUNT_GROUP; $i++) { 
            $group = new DowntimeGroup('Группа ' . $i);
            $arrGroup[] = $group;

            $manager->persist($group);
        }

        for ($i=1; $i <= self::COUNT_LOCATION; $i++) { 
            $location = new DowntimeLocation('Локация ' . $i);
            $arrLocation[] = $location;
            $manager->persist($location);
        }

        for ($i=1; $i <= self::COUNT_CAUSE; $i++) { 
            $cause = new DowntimeCause('Причина ' . $i);
            $cause->setGroups($arrGroup[rand(0, self::COUNT_GROUP - 1)]);

            $arrCause[] = $cause;

            $manager->persist($cause);
        }
        
        for ($i=1; $i <= self::COUNT_PLACE; $i++) { 
            $place = new DowntimePlace("Место  " . $i);
            $place->setLocation($arrLocation[rand(0, self::COUNT_LOCATION - 1)]);
            
            $arrPlace[] = $place;
            $manager->persist($place);
        }

        $randomDatesTimestamp = AppFixtures::getRandomDatetime(self::COUNT_DOWNTIME);

        for ($i=0; $i < self::COUNT_DOWNTIME; $i++) { 
            $downtime = new Downtime();
            $startTime = new DateTime();
            $startTime->setTimestamp($randomDatesTimestamp[$i]);
            
            $stopTime = new DateTime();
            $stopTime->setTimestamp($randomDatesTimestamp[$i] + 3 * 60);
            $stopTime = rand(0, 2) % 2 ? $stopTime : 1; 
            $period = new DatePeriod($startTime, new DateInterval('P1D'), $stopTime);
            $downtime->setPeriod($period);
            $downtime->setCause($arrCause[rand(0, self::COUNT_CAUSE - 1)]);
            $downtime->setPlace($arrPlace[rand(0, self::COUNT_PLACE - 1)]);
            $manager->persist($downtime);
        }
        
        $manager->flush();
    }
}