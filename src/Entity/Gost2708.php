<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: Gost2708Repository::class)]
#[ORM\Table(schema: "dic", name: "gost_2708", options: ["comment" => "Лесоматериалы круглые. Таблица объёмов по ГОСТ 2708-75"])]
#[
    ApiResource(
        collectionOperations: ["get"],
        itemOperations: ["get"],
        normalizationContext: ["groups" => ["event:read"]],
        denormalizationContext: ["groups" => ["event:write"]]
    )
]
class Gost2708
{
    #[ORM\Id]
    #[ORM\Column(name: "diam", type: "smallint", options: ["comment" => 'Диаметр вершины в диапазоне 3 - 120 см.'])]
    private int $diam;

    #[ORM\Id]
    #[ORM\Column(name: "length", type: "smallint", options: ["comment" => 'Длина в дипазоне 1 - 9.5 м.'])]
    private int $length;

    #[ORM\Column(name: "volume", type: "float", options: ["comment" => 'Объём м³.'])]
    private float $volume;

    public function __construct(int $diam, int $length, float $volume)
    {
        $this->diam = $diam;
        $this->length = $length;
        $this->volume = $volume;
    }

    public function getDiam(): int
    {
        return $this->diam;
    }

    public function setDiam(int $diam): self
    {
        $this->diam = $diam;

        return $this;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getVolume(): float
    {
        return $this->volume;
    }

    public function setVolume(float $volume): self
    {
        $this->volume = $volume;

        return $this;
    }
}
