<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Tlc\ManualBundle\Repository\PeopleRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Tlc\ManualBundle\Entity\People as BasePeople;

#[ORM\Entity(repositoryClass: PeopleRepository::class)]
#[ORM\Table(schema: "sobr", name: "people", options: ["comment" => "Люди"])]
#[
    ApiResource(
        collectionOperations: ["get", "post"],
        itemOperations: ["get", "put", "delete"],
        normalizationContext: ["groups" => ["people:read"]],
        denormalizationContext: ["groups" => ["people:write"]]
    )
]
class People extends BasePeople
{
    #[ORM\ManyToMany(targetEntity: Duty::class)]
    #[ORM\JoinTable( name: "people_to_duty")]
    #[Groups(["people:write", "people:read"])]
    protected $duty;
}
