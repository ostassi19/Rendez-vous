<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TypeSoinRepository;
use App\Traits\TimestampTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=TypeSoinRepository::class)
 */
class TypeSoin
{
    use TimestampTrait;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $traitement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $remarque;

    /**
     * @ORM\ManyToOne(targetEntity=Soin::class)
     */
    private $soin;

    /**
     * @ORM\ManyToOne(targetEntity=Ordonnance::class, inversedBy="typeSoins")
     */
    private $ordonnance;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTraitement(): ?string
    {
        return $this->traitement;
    }

    public function setTraitement(?string $traitement): self
    {
        $this->traitement = $traitement;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(?string $remarque): self
    {
        $this->remarque = $remarque;

        return $this;
    }

    public function getSoin(): ?Soin
    {
        return $this->soin;
    }

    public function setSoin(?Soin $soin): self
    {
        $this->soin = $soin;

        return $this;
    }

    public function getOrdonnance(): ?Ordonnance
    {
        return $this->ordonnance;
    }

    public function setOrdonnance(?Ordonnance $ordonnance): self
    {
        $this->ordonnance = $ordonnance;

        return $this;
    }
}
