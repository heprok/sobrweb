<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TimberRepository;
use DateTime;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Tlc\ManualBundle\Filter\DateFilter;
use Tlc\ReportBundle\Entity\BaseEntity;

#[ORM\Entity(repositoryClass: TimberRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(schema: "sobr", name: "timber", options: ["comment" => "Брёвна"])]
#[
    ApiResource(
        collectionOperations: ["get"],
        itemOperations: ["get"],
        normalizationContext: ["groups" => ["timber:read"]],
        denormalizationContext: ["groups" => ["timber:write"]]
    )
]
#[ApiFilter(DateFilter::class, properties: ["drecTimestampKey"])]
class Timber
{
    protected DateTime $drec;

    #[ORM\Id]
    #[ORM\Column(name: "drec", type: "string", options: ["comment" => 'Дата записи'])]
    #[Groups(["timber:read"])]
    #[ApiProperty(identifier: true)]
    protected $drecTimestampKey;

    #[ORM\Column(type: "smallint", options: ["comment" => 'Качество бревна'])]
    #[Groups(["timber:read"])]
    private int $quality;

    #[ORM\Column(type: "smallint", options: ["comment" => 'Диаметр вершины, мм'])]
    #[Groups(["timber:read"])]
    private int $top_diam;

    #[ORM\Column(type: "smallint", options: ["comment" => 'Диаметр центра, мм'])]
    #[Groups(["timber:read"])]
    private int $mid_diam;

    #[ORM\Column(type: "smallint", options: ["comment" => 'Диаметр комля, мм'])]
    #[Groups(["timber:read"])]
    private int $butt_diam;

    #[ORM\Column(type: "float", options: ["comment" => 'Овальность'])]
    #[Groups(["timber:read"])]
    private float $ovality;

    #[ORM\Column(type: "smallint", options: ["comment" => 'Длина бревна, мм.'])]
    #[Groups(["timber:read"])]
    private int $length;

    #[ORM\Column(type: "smallint", options: ["comment" => 'Сбег вершины см/м'])]
    #[Groups(["timber:read"])]
    private int $top_taper;

    #[ORM\Column(type: "smallint", options: ["comment" => 'Сбег комля см/м'])]
    #[Groups(["timber:read"])]
    private int $butt_taper;

    #[ORM\Column(type: "smallint", options: ["comment" => 'Сбег см/м'])]
    #[Groups(["timber:read"])]
    private int $taper;

    #[ORM\Column(type: "smallint", options: ["comment" => 'Кривизна, см/м'])]
    #[Groups(["timber:read"])]
    private int $sweep;

    #[ORM\Column(type: "smallint", options: ["comment" => 'Карман'])]
    #[Groups(["timber:read"])]
    private int $pocket;

    #[ORM\ManyToOne(targetEntity: Species::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["timber:read"])]
    private $species;

    #[ORM\ManyToOne(targetEntity: Batch::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["timber:read"])]
    private $batch;

    public function getDrecTimestampKey(): ?int
    {
        return strtotime($this->drec->format(DATE_ATOM));
    }

    public function getDrec(): DateTime
    {
        return $this->drec;
    }

    public function setDrec(\DateTimeInterface $drec): self
    {
        $this->drec = $drec;

        return $this;
    }

    public function getButt(): ?float
    {
        return $this->butt;
    }

    public function setButt(float $butt): self
    {
        $this->butt = $butt;

        return $this;
    }

    public function getTopTaper(): ?float
    {
        return $this->top_taper;
    }

    public function setTopTaper(float $top_taper): self
    {
        $this->top_taper = $top_taper;

        return $this;
    }

    public function getButtTaper(): ?float
    {
        return $this->butt_taper;
    }

    public function setButtTaper(float $butt_taper): self
    {
        $this->butt_taper = $butt_taper;

        return $this;
    }

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getSweep(): ?float
    {
        return $this->sweep;
    }

    public function setSweep(float $sweep): self
    {
        $this->sweep = $sweep;

        return $this;
    }

    public function getBatch(): ?Batch
    {
        return $this->batch;
    }

    public function setBatch(?Batch $batch): self
    {
        $this->batch = $batch;

        return $this;
    }

    public function getSpecies(): ?Species
    {
        return $this->species;
    }

    public function setSpecies(?Species $species): self
    {
        $this->species = $species;

        return $this;
    }

    public function getQuality() :int
    {
        return $this->quality;
    } 

    public function setQuality(int $quality) :self
    {
        $this->quality = $quality;

        return $this;
    }

    public function getTopDiam(): int
    {
        return $this->top_diam;
    }

    public function setTopDiam(int $top_diam): self
    {
        $this->top_diam = $top_diam;

        return $this;
    }

    public function getMidDiam(): int
    {
        return $this->mid_diam;
    }

    public function setMidDiam(int $mid_diam): self
    {
        $this->mid_diam = $mid_diam;

        return $this;
    }

    public function getButtDiam(): int
    {
        return $this->butt_diam;
    }

    public function setButtDiam(int $butt_diam): self
    {
        $this->butt_diam = $butt_diam;

        return $this;
    }

    public function getOvality(): int
    {
        return $this->ovality;
    }

    public function setOvality($ovality): self
    {
        $this->ovality = $ovality;

        return $this;
    }

    public function getTaper(): int
    {
        return $this->taper;
    }

    public function setTaper($taper): self
    {
        $this->taper = $taper;

        return $this;
    }

    public function getPocket(): int
    {
        return $this->pocket;
    }

    public function setPocket($pocket): self
    {
        $this->pocket = $pocket;

        return $this;
    }

    #[Groups(["timber:read"])]
    public function getStartTime(): ?string
    {
        return $this->drec->format(BaseEntity::TIME_FOR_FRONT);
    }


    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function syncDrecTodrecTimestampKey(LifecycleEventArgs $event)
    {
        $entityManager = $event->getEntityManager();
        $connection = $entityManager->getConnection();
        $platform = $connection->getDatabasePlatform();
        $this->drecTimestampKey = $this->drec->format($platform->getDateTimeFormatString());
    }

    #[ORM\PostLoad]
    public function syncDrecTimestampKeyToDrec(LifecycleEventArgs $event)
    {
        $entityManager = $event->getEntityManager();
        $connection = $entityManager->getConnection();
        $platform = $connection->getDatabasePlatform();
        $this->drec = DateTime::createFromFormat($platform->getDateTimeTzFormatString(), $this->drecTimestampKey) ?:
            \DateTime::createFromFormat($platform->getDateTimeFormatString(), $this->drecTimestampKey) ?:
            \DateTime::createFromFormat(BaseEntity::DATE_SECOND_TIMEZONE_FORMAT_DB, $this->drecTimestampKey) ?:
            \DateTime::createFromFormat(BaseEntity::DATE_SECOND_FORMAT_DB, $this->drecTimestampKey);
    }
}
