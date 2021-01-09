<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrdonnanceRepository;
use App\Traits\TimestampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=OrdonnanceRepository::class)
 */
class Ordonnance
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
    private $nom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Consultation::class, inversedBy="ordonnances")
     */
    private $consultation;

    /**
     * @ORM\OneToMany(targetEntity=TypeSoin::class, mappedBy="ordonnance")
     */
    private $typeSoins;

    public function __construct()
    {
        $this->typeSoins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getConsultation(): ?Consultation
    {
        return $this->consultation;
    }

    public function setConsultation(?Consultation $consultation): self
    {
        $this->consultation = $consultation;

        return $this;
    }

    /**
     * @return Collection|TypeSoin[]
     */
    public function getTypeSoins(): Collection
    {
        return $this->typeSoins;
    }

    public function addTypeSoin(TypeSoin $typeSoin): self
    {
        if (!$this->typeSoins->contains($typeSoin)) {
            $this->typeSoins[] = $typeSoin;
            $typeSoin->setOrdonnance($this);
        }

        return $this;
    }

    public function removeTypeSoin(TypeSoin $typeSoin): self
    {
        if ($this->typeSoins->removeElement($typeSoin)) {
            // set the owning side to null (unless already changed)
            if ($typeSoin->getOrdonnance() === $this) {
                $typeSoin->setOrdonnance(null);
            }
        }

        return $this;
    }
}
