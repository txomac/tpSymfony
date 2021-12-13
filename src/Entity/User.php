<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_organisateur;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $dettes;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $depenses;

    /**
     * @ORM\ManyToOne(targetEntity=Soiree::class, inversedBy="users")
     */
    private $id_soiree;

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

    public function getIsOrganisateur(): ?bool
    {
        return $this->is_organisateur;
    }

    public function setIsOrganisateur(?bool $is_organisateur): self
    {
        $this->is_organisateur = $is_organisateur;

        return $this;
    }

    public function getDettes(): ?float
    {
        return $this->dettes;
    }

    public function setDettes(?float $dettes): self
    {
        $this->dettes = $dettes;

        return $this;
    }

    public function getDepenses(): ?float
    {
        return $this->depenses;
    }

    public function setDepenses(?float $depenses): self
    {
        $this->depenses = $depenses;

        return $this;
    }

    public function getIdSoiree(): ?Soiree
    {
        return $this->id_soiree;
    }

    public function setIdSoiree(?Soiree $id_soiree): self
    {
        $this->id_soiree = $id_soiree;

        return $this;
    }
}
