<?php

namespace App\DataFixtures;

use App\Entity\Batch;
use App\Entity\Provider;
use App\Entity\Transport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BatchFixtures extends Fixture implements DependentFixtureInterface
{
    const COUNT_BATCH = 4;
    public function load(ObjectManager $manager)
    {
        $providers = $manager->getRepository(Provider::class)->findAll();
        $transports = $manager->getRepository(Transport::class)->findAll();

        for ($i = 0; $i < self::COUNT_BATCH; $i++) {
            
            $batch = new Batch();

            $batch->setProvider($providers[array_rand($providers)]);
            $batch->setTransport($transports[array_rand($transports)]);
            $batch->setWaybill("Накладная $i");
            $batch->setNumber('Транспорт ' . rand(0, $i));

            $manager->persist($batch);
        }

        $manager->flush();
    }

    public function getDependencies() {
        return [
            TransportFixtures::class, 
            ProviderFixtures::class,
        ];
    }
}
