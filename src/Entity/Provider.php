<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProviderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProviderRepository::class)]
#[ORM\Table(schema: "sobr", name: "provider", options: ["comment" => "Поставщики"])]
#[
    ApiResource(
        collectionOperations: ["get", "post"],
        itemOperations: ["get", "put"],
        normalizationContext: ["groups" => ["provider:read"]],
        denormalizationContext: ["groups" => ["provider:write"]]
    )
]
class Provider
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer", options: ["comment" => "Id поставщика"])]
    protected int $id;

    #[ORM\Column(type: "string", length: 128, unique: true, options: ["comment" => "Имя поставщика"])]
    #[Groups(["provider:read", "provider:write","batch:read"])]
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
