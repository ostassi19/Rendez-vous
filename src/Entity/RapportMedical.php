<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RapportMedicalRepository;
use App\Traits\TimestampTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=RapportMedicalRepository::class)
 */
class RapportMedical
{
    use TimestampTrait;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @ORM\ManyToOne(targetEntity=Fiche::class, inversedBy="rapportMedicals")
     */
    private $Fiche;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $rapport = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getFiche(): ?Fiche
    {
        return $this->Fiche;
    }

    public function setFiche(?Fiche $Fiche): self
    {
        $this->Fiche = $Fiche;

        return $this;
    }

    public function getRapport(): ?array
    {
        return $this->rapport;
    }

    public function setRapport(?array $rapport): self
    {
        $this->rapport = $rapport;

        return $this;
    }
}
