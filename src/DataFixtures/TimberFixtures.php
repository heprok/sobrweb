<?php

namespace App\DataFixtures;

use App\Entity\Batch;
use App\Entity\Species;
use App\Entity\Timber;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TimberFixtures extends Fixture implements DependentFixtureInterface
{
    const COUNT_TIMBER = 7000;
    public function load(ObjectManager $manager)
    {

        $batchs = $manager->getRepository(Batch::class)->findAll();
        $species = $manager->getRepository(Species::class)->findAll();

        $randomDatesTimestamp = AppFixtures::getRandomDatetime(self::COUNT_TIMBER);
        
        for ($i = 0; $i < self::COUNT_TIMBER; $i++) {
            $timber = new Timber();

            $drec = new DateTime();
            $drec->setTimestamp($randomDatesTimestamp[$i]);

            $timber->setDrec($drec);
            $timber->setQuality(rand(1,4));
            $timber->setTopDiam(rand(280, 310));
            $timber->setMidDiam(rand(280, 310));
            $timber->setButtDiam(rand(280, 310));
            $timber->setOvality(rand(4,10));
            $timber->setLength(rand(4000, 4200));
            $timber->setTopTaper(rand(280, 310));
            $timber->setButtTaper(rand(280, 310));
            $timber->setTaper(rand(-10, 10));
            $timber->setSweep(rand(-1, 1));
            $timber->setPocket(rand(0, 5));
            $timber->setBatch($batchs[array_rand($batchs)]);
            $timber->setSpecies($species[array_rand($species)]);
            $manager->persist($timber);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BatchFixtures::class, 
            SpeciesFixtures::class
        ];
    }
}
