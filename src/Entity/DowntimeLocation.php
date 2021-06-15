<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Tlc\ManualBundle\Repository\DowntimeLocationRepository;
use Doctrine\ORM\Mapping as ORM;
use Tlc\ManualBundle\Entity\DowntimeLocation as BaseDowntimeLocation;

#[ORM\Entity(repositoryClass: DowntimeLocationRepository::class)]
#[ORM\Table(schema: "ds",name: "downtime_location", options: ["comment" => "Локации простоя"])]
#[
    ApiResource(
        collectionOperations: ["get", "post"],
        itemOperations: ["get", "put"],
        normalizationContext: ["groups" => ["downtime_location:read"]],
        denormalizationContext: ["groups" => ["downtime_location:write"]]
    )
]
class DowntimeLocation extends BaseDowntimeLocation
{
    #[ORM\OneToMany(targetEntity: DowntimePlace::class, mappedBy: "location")]
    protected $downtimePlaces;

    public function __construct()
    {
        $this->downtimePlaces = new ArrayCollection();
    }

    /**
     * @return Collection|DowntimePlace[]
     */
    public function getDowntimePlaces(): Collection
    {
        return $this->downtimePlaces;
    }
}
