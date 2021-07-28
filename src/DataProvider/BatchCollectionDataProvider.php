<?php

declare(strict_types=1);

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Batch;
use App\Entity\Timber;
use App\Repository\TimberRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Tlc\ReportBundle\Entity\BaseEntity;

final class BatchCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{

    public function __construct(private ManagerRegistry $managerRegistry)
    {
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Batch::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $manager = $this->managerRegistry->getManagerForClass($resourceClass);
        $repositoryBatch = $manager->getRepository($resourceClass);

        $repositoryTimber = $manager->getRepository(Timber::class);

        
        if ($repositoryTimber instanceof TimberRepository)
            $batchs = array_key_exists('period', $context['filters'] ?? []) ?
                $repositoryTimber->findBatchByPeriod(BaseEntity::getPeriodFromString($context['filters']['period']))
                : $repositoryBatch->findAll();

        foreach ($batchs as $batch) {
            $firstTibmer = $repositoryTimber->findOneBy(['batch' => $batch]);
            $lastTimber = $repositoryTimber->findOneBy(['batch' => $batch], ['drecTimestampKey' => 'DESC']);
            $batch->setFirstDateTimber($firstTibmer->getDrec());
            $batch->setLastDateTimber($lastTimber->getDrec());
        }

        return $batchs;
    }
}
