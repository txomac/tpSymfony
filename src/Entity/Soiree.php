<?php

namespace App\Entity;

use App\Repository\SoireeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SoireeRepository::class)
 */
class Soiree
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrparticipants;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $total_soiree;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $moyenne_utilisateur;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="id_soiree")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrparticipants(): ?int
    {
        return $this->nbrparticipants;
    }

    public function setNbrparticipants(?int $nbrparticipants): self
    {
        $this->nbrparticipants = $nbrparticipants;

        return $this;
    }

    public function getTotalSoiree(): ?float
    {
        return $this->total_soiree;
    }

    public function setTotalSoiree(?float $total_soiree): self
    {
        $this->total_soiree = $total_soiree;

        return $this;
    }

    public function getMoyenneUtilisateur(): ?float
    {
        return $this->moyenne_utilisateur;
    }

    public function setMoyenneUtilisateur(?float $moyenne_utilisateur): self
    {
        $this->moyenne_utilisateur = $moyenne_utilisateur;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setIdSoiree($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getIdSoiree() === $this) {
                $user->setIdSoiree(null);
            }
        }

        return $this;
    }
}
