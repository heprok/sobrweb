<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BatchRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Tlc\ManualBundle\Filter\DateFilter;
use Tlc\ReportBundle\Entity\BaseEntity;

#[ORM\Entity(repositoryClass: BatchRepository::class)]
#[ORM\Table(schema: "sobr", name: "batch", options: ["comment" => "Партия"])]
#[
    ApiResource(
        collectionOperations: ["get"],
        itemOperations: ["get"],
        normalizationContext: ["groups" => ["batch:read"]],
        denormalizationContext: ["groups" => ["batch:write"]]
    )
]
#[ApiFilter(DateFilter::class, properties: ['period'])]
class Batch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    #[Groups(["batch:read", "timber:read"])]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Provider::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["batch:read"])]
    private Provider $provider;

    #[ORM\Column(type: "string", length: 64, options: ['comment' => "Накладная"])]
    #[Groups(["batch:read"])]
    private string $waybill;

    #[ORM\ManyToOne(targetEntity: Transport::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["batch:read"])]
    private Transport $transport;

    #[ORM\Column(type: "string", length: 64, nullable: true, options: ['comment' => "Номер транспорта"])]
    #[Groups(["batch:read"])]
    private ?string $number;

    #[ORM\Column(type: "boolean", options: ['default' => false, 'comment' => "Повторная сортировка (пересортировка)"])]
    #[Groups(["batch:read"])]
    private bool $repeat = false;

    private DateTime $firstDateTimber;
    
    private DateTime $lastDateTimber;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    public function setProvider(?Provider $provider): self
    {
        $this->provider = $provider;

        return $this;
    }

    public function getWaybill(): string
    {
        return $this->waybill;
    }

    public function setWaybill(string $waybill): self
    {
        $this->waybill = $waybill;

        return $this;
    }

    public function getTransport(): Transport
    {
        return $this->transport;
    }

    public function setTransport(Transport $transport): self
    {
        $this->transport = $transport;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getRepeat(): bool
    {
        return $this->repeat;
    }

    public function setRepeat(bool $repeat): self
    {
        $this->repeat = $repeat;

        return $this;
    }

    public function getFirstDateTimber(): DateTime
    {
        return $this->firstDateTimber;
    }

    public function setFirstDateTimber(DateTime $firstDateTimber): self
    {
        $this->firstDateTimber = $firstDateTimber;

        return $this;
    }

    public function getLastDateTimber(): DateTime
    {
        return $this->lastDateTimber;
    }

    public function setLastDateTimber(DateTime $lastDateTimber): self
    {
        $this->lastDateTimber = $lastDateTimber;

        return $this;
    }

    #[Groups(["batch:read"])]
    public function getFirstDateTimberFormat(string $format = BaseEntity::DATETIME_FOR_FRONT) : string
    {
        return $this->firstDateTimber->format($format);
    }

    #[Groups(["batch:read"])]
    public function getLastDateTimberFormat(string $format = BaseEntity::DATETIME_FOR_FRONT) : string
    {
        return $this->lastDateTimber->format($format);
    }

}
