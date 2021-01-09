<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;

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
 *
 */
 /**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PatientRepository::class)
 */
class Patient extends Personne
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cnss;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cnrps;

    /**
     * @ORM\OneToMany(targetEntity=Fiche::class, mappedBy="patient")
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

    public function getCnss(): ?string
    {
        return $this->cnss;
    }

    public function setCnss(string $cnss): self
    {
        $this->cnss = $cnss;

        return $this;
    }

    public function getCnrps(): ?string
    {
        return $this->cnrps;
    }

    public function setCnrps(?string $cnrps): self
    {
        $this->cnrps = $cnrps;

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
            $fich->setPatient($this);
        }

        return $this;
    }

    public function removeFich(Fiche $fich): self
    {
        if ($this->fiches->removeElement($fich)) {
            // set the owning side to null (unless already changed)
            if ($fich->getPatient() === $this) {
                $fich->setPatient(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }
}
