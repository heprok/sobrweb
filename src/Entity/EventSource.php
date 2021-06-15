<?php

namespace App\Entity;

use Tlc\ManualBundle\Repository\EventSourceRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Tlc\ManualBundle\Entity\EventSource as BaseEventSource;

#[ORM\Entity(repositoryClass: EventSourceRepository::class)]
#[ORM\Table(schema: "ds", name: "event_source", options: ["comment" => "Источник события"])]
#[
    ApiResource(
        collectionOperations: ["get", "post"],
        itemOperations: ["get", "put", "delete"],
        normalizationContext: ["groups" => ["event_source:read"]],
        denormalizationContext: ["groups" => ["event_source:write"]]
    )
]
class EventSource extends BaseEventSource
{

}