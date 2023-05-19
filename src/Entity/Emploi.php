<?php

namespace App\Entity;

use App\Entity\Relation\UserEmploi;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EmploiRepository;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: EmploiRepository::class)]
#[ApiResource]
class Emploi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\Column(length: 255)]
    private ?string $titre = null;
    
    #[ORM\Column(type: Types::TEXT)]
    private ?string $descriptif = null;

    #[ORM\ManyToOne(inversedBy: 'emplois')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entreprise $fkEntreprise = null;

    #[ORM\OneToMany(mappedBy: 'fkEmploi', targetEntity: UserEmploi::class, orphanRemoval: true)]
    private Collection $userEmplois;

    #[ORM\OneToMany(mappedBy: 'emploi', targetEntity: OffreEmploi::class, orphanRemoval: true)]
    private Collection $offreEmplois;

    public function __construct()
    {
        $this->userEmplois = new ArrayCollection();
        $this->offreEmplois = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getFkEntreprise(): ?Entreprise
    {
        return $this->fkEntreprise;
    }

    public function setFkEntreprise(?Entreprise $fkEntreprise): self
    {
        $this->fkEntreprise = $fkEntreprise;

        return $this;
    }

    /**
     * @return Collection<int, UserEmploi>
     */
    public function getUserEmplois(): Collection
    {
        return $this->userEmplois;
    }

    public function addUserEmploi(UserEmploi $userEmploi): self
    {
        if (!$this->userEmplois->contains($userEmploi)) {
            $this->userEmplois->add($userEmploi);
            $userEmploi->setFkEmploi($this);
        }

        return $this;
    }

    public function removeUserEmploi(UserEmploi $userEmploi): self
    {
        if ($this->userEmplois->removeElement($userEmploi)) {
            // set the owning side to null (unless already changed)
            if ($userEmploi->getFkEmploi() === $this) {
                $userEmploi->setFkEmploi(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OffreEmploi>
     */
    public function getOffreEmplois(): Collection
    {
        return $this->offreEmplois;
    }

    public function addOffreEmploi(OffreEmploi $offreEmploi): self
    {
        if (!$this->offreEmplois->contains($offreEmploi)) {
            $this->offreEmplois->add($offreEmploi);
            $offreEmploi->setEmploi($this);
        }

        return $this;
    }

    public function removeOffreEmploi(OffreEmploi $offreEmploi): self
    {
        if ($this->offreEmplois->removeElement($offreEmploi)) {
            // set the owning side to null (unless already changed)
            if ($offreEmploi->getEmploi() === $this) {
                $offreEmploi->setEmploi(null);
            }
        }

        return $this;
    }
}
