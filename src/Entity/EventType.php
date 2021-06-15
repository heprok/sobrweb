<?php

namespace App\Entity;

use Tlc\ManualBundle\Repository\EventTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Tlc\ManualBundle\Entity\EventType as BaseEventType;

#[ORM\Entity(repositoryClass: EventTypeRepository::class)]
#[ORM\Table(schema: 'ds', name: "event_type", options: ["comment" => "Типы события"])]
#[
    ApiResource(
        collectionOperations: ["get", "post"],
        itemOperations: ["get", "put", "delete"],
        normalizationContext: ["groups" => ["event_type:read"]],
        denormalizationContext: ["groups" => ["event_type:write"]]
    )
]
class EventType extends BaseEventType
{
}
