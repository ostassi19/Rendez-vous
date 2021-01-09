<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MedecinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/*
 * @ORM\AssociationOverrides({
 *      @ORM\AssociationOverride(
 *          name="contact",
 *          joinColumns=
 *              @JoinColumn(
 *                  name="contact_id"
 *              ),
 *      ),
 *      @ORM\AssociationOverride(
 *          name="adresse",
 *          joinColumns=
 *              @JoinColumn(
 *                  name="adresse_id"
 *              ),
 *      ),
 * })
 */
/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MedecinRepository::class)
 */
class Medecin extends Personne
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Specialite::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $specialite;

    /**
     * @ORM\OneToMany(targetEntity=Fiche::class, mappedBy="medecin")
     */
    private $fiches;

    public function __construct()
    {
        $this->fiches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecialite(): ?Specialite
    {
        return $this->specialite;
    }

    public function setSpecialite(?Specialite $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }

    /**
     * @return Collection|Fiche[]
     */
    public function getFiches(): Collection
    {
        return $this->fiches;
    }

    public function addFich(Fiche $fich): self
    {
        if (!$this->fiches->contains($fich)) {
            $this->fiches[] = $fich;
            $fich->setMedecin($this);
        }

        return $this;
    }

    public function removeFich(Fiche $fich): self
    {
        if ($this->fiches->removeElement($fich)) {
            // set the owning side to null (unless already changed)
            if ($fich->getMedecin() === $this) {
                $fich->setMedecin(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }
}
