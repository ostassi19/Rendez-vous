<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FicheRepository;
use App\Traits\TimestampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=FicheRepository::class)
 */
class Fiche
{
    use TimestampTrait;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $antecedentMaladie;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $abitudeVie;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $histoireMaladie;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $exploration;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $diagnostic;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="fiches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity=Medecin::class, inversedBy="fiches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $medecin;

    /**
     * @ORM\OneToMany(targetEntity=RendezVous::class, mappedBy="fiche")
     */
    private $rendezVouses;

    /**
     * @ORM\OneToMany(targetEntity=Consultation::class, mappedBy="fiche")
     */
    private $consultations;

    /**
     * @ORM\OneToMany(targetEntity=RapportMedical::class, mappedBy="Fiche")
     */
    private $rapportMedicals;

    public function __construct()
    {
        $this->rendezVouses = new ArrayCollection();
        $this->consultations = new ArrayCollection();
        $this->rapportMedicals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAntecedentMaladie(): ?string
    {
        return $this->antecedentMaladie;
    }

    public function setAntecedentMaladie(?string $antecedentMaladie): self
    {
        $this->antecedentMaladie = $antecedentMaladie;

        return $this;
    }

    public function getAbitudeVie(): ?string
    {
        return $this->abitudeVie;
    }

    public function setAbitudeVie(?string $abitudeVie): self
    {
        $this->abitudeVie = $abitudeVie;

        return $this;
    }

    public function getHistoireMaladie(): ?string
    {
        return $this->histoireMaladie;
    }

    public function setHistoireMaladie(?string $histoireMaladie): self
    {
        $this->histoireMaladie = $histoireMaladie;

        return $this;
    }

    public function getExploration(): ?string
    {
        return $this->exploration;
    }

    public function setExploration(?string $exploration): self
    {
        $this->exploration = $exploration;

        return $this;
    }

    public function getDiagnostic(): ?string
    {
        return $this->diagnostic;
    }

    public function setDiagnostic(?string $diagnostic): self
    {
        $this->diagnostic = $diagnostic;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getMedecin(): ?Medecin
    {
        return $this->medecin;
    }

    public function setMedecin(?Medecin $medecin): self
    {
        $this->medecin = $medecin;

        return $this;
    }

    /**
     * @return Collection|RendezVous[]
     */
    public function getRendezVouses(): Collection
    {
        return $this->rendezVouses;
    }

    public function addRendezVouse(RendezVous $rendezVouse): self
    {
        if (!$this->rendezVouses->contains($rendezVouse)) {
            $this->rendezVouses[] = $rendezVouse;
            $rendezVouse->setFiche($this);
        }

        return $this;
    }

    public function removeRendezVouse(RendezVous $rendezVouse): self
    {
        if ($this->rendezVouses->removeElement($rendezVouse)) {
            // set the owning side to null (unless already changed)
            if ($rendezVouse->getFiche() === $this) {
                $rendezVouse->setFiche(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Consultation[]
     */
    public function getConsultations(): Collection
    {
        return $this->consultations;
    }

    public function addConsultation(Consultation $consultation): self
    {
        if (!$this->consultations->contains($consultation)) {
            $this->consultations[] = $consultation;
            $consultation->setFiche($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): self
    {
        if ($this->consultations->removeElement($consultation)) {
            // set the owning side to null (unless already changed)
            if ($consultation->getFiche() === $this) {
                $consultation->setFiche(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RapportMedical[]
     */
    public function getRapportMedicals(): Collection
    {
        return $this->rapportMedicals;
    }

    public function addRapportMedical(RapportMedical $rapportMedical): self
    {
        if (!$this->rapportMedicals->contains($rapportMedical)) {
            $this->rapportMedicals[] = $rapportMedical;
            $rapportMedical->setFiche($this);
        }

        return $this;
    }

    public function removeRapportMedical(RapportMedical $rapportMedical): self
    {
        if ($this->rapportMedicals->removeElement($rapportMedical)) {
            // set the owning side to null (unless already changed)
            if ($rapportMedical->getFiche() === $this) {
                $rapportMedical->setFiche(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getPatient()->getNom();
    }
}
