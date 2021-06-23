<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StackRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: StackRepository::class)]
#[ORM\Table(schema: "sobr", name: "stack", options: ["comment" => "Штабели"])]
#[
    ApiResource(
        collectionOperations: ["get", "post"],
        itemOperations: ["get", "put"],
        normalizationContext: ["groups" => ["stack:read"]],
        denormalizationContext: ["groups" => ["stack:write"]]
    )
]
class Stack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer", options: ["comment" => "Id штабеля"])]
    protected int $id;

    #[ORM\Column(type: "string", length: 64, unique: true, options: ["comment" => "Название"])]
    #[Groups(["stack:read", "stack:write"])]
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
