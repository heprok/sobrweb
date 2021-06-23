<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\BatchRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BatchRepository::class)]
#[ORM\Table(schema: "sobr", name: "batch", options: ["comment" => "Партия"])]
class Batch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Provider::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Provider $provider;

    #[ORM\Column(type: "string", length: 64, options: ['comment' => "Накладная"])]
    private string $waybill;

    #[ORM\ManyToOne(targetEntity: Transport::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Transport $transport;

    #[ORM\Column(type: "string", length: 64, nullable: true, options: ['comment' => "Номер транспорта"])]
    private ?string $number;

    #[ORM\Column(type: "boolean", options: ['default' => false, 'comment' => "Повторная сортировка (пересортировка)"])]
    private bool $repeat = false;

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
}
