<?php

namespace App\DataFixtures;

use App\Entity\Stack;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StackFixtures extends Fixture
{
    const COUNT_STACK = 4;
    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < self::COUNT_STACK; $i++) {
            
            $provder = new Stack("Штабель $i");
            $manager->persist($provder);
        }

        $manager->flush();
    }
}
