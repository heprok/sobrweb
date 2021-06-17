<?php

namespace App\DataFixtures;

use App\Entity\StandardLength;
use App\Entity\DowntimeCause;
use App\Entity\DowntimePlace;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StandardLengthFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $length = new StandardLength(3000, array(0, 3990));
        $manager->persist($length);
        $length = new StandardLength(4000, array(3990, 4990));
        $manager->persist($length);
        $length = new StandardLength(5000, array(4990, 5990));
        $manager->persist($length);
        $length = new StandardLength(6000, array(5990, 9000));
        $manager->persist($length);

        $manager->flush();
    }
}
