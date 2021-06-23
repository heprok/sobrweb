<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TransportRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TransportRepository::class)]
#[ORM\Table(schema: "sobr", name: "transport", options: ["comment" => "Транспорт"])]
#[
    ApiResource(
        collectionOperations: ["get", "post"],
        itemOperations: ["get", "put"],
        normalizationContext: ["groups" => ["transport:read"]],
        denormalizationContext: ["groups" => ["transport:write"]]
    )
]
class Transport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer", options: ["comment" => "Id транспорта"])]
    protected int $id;

    #[ORM\Column(type: "string", length: 128, unique: true, options: ["comment" => "Название"])]
    #[Groups(["transport:read", "transport:write"])]
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
