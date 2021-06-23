<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TimberQualityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TimberQualityRepository::class)]
#[ORM\Table(schema: "sobr", name: "timber_quality", options: ["comment" => "Качества брёвен"])]
#[
    ApiResource(
        collectionOperations: ["get", "post"],
        itemOperations: ["get", "put"],
        normalizationContext: ["groups" => ["timber_quality:read"]],
        denormalizationContext: ["groups" => ["timber_quality:write"]]
    )
]
class TimberQuality
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer", options: ["comment" => "Id качества"])]
    protected int $id;

    #[ORM\Column(type: "string", length: 32, unique: true, options: ["comment" => "Название качества"])]
    #[Groups(["timber_quality:read", "timber_quality:write"])]
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
