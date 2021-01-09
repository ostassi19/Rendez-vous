<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SecretaireRepository;
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
 * @ORM\Entity(repositoryClass=SecretaireRepository::class)
 */
class Secretaire extends Personne
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
