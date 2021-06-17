<?php

namespace App\Entity;

use App\Repository\EventTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Tlc\ManualBundle\Entity\EventType as BaseEventType;

#[ORM\Entity(repositoryClass: EventTypeRepository::class)]
#[ORM\Table(schema: "sobr", name: "event_type", options: ["comment" => "Типы события"])]
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
