<?php

declare(strict_types=1);

namespace App\Entity;

use Tlc\ManualBundle\Repository\DutyRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Tlc\ManualBundle\Entity\Duty as BaseDuty;

#[ORM\Entity(repositoryClass: DutyRepository::class)]
#[ORM\Table(schema: "sobr", name: "duty",  options: ["comment" => "Список должностей"])]
#[
    ApiResource(
        collectionOperations: ["get", "post"],
        itemOperations: ["get", "put", "delete"],
        normalizationContext: ["groups" => ["duty:read"]],
        denormalizationContext: ["groups" => ["duty:write"]]
    )
]
class Duty extends BaseDuty
{
}
