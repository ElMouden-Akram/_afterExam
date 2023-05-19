<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['Entrprise:ThisClass']],
    denormalizationContext: ['groups' => ['Entrprise:ThisClass']],
)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('Entrprise:ThisClass')]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups('Entrprise:ThisClass')]
    private ?string $NomEntreprise = null;

    #[ORM\Column(length: 30)]
    #[Groups('Entrprise:ThisClass')]
    private ?string $ville = null;

    #[ORM\Column(length: 30)]
    #[Groups('Entrprise:ThisClass')]
    private ?string $pays = null;

    #[ORM\Column(length: 40)]
    #[Groups('Entrprise:ThisClass')]
    private ?string $website = null;

    #[ORM\Column(length: 40)]
    #[Groups('Entrprise:ThisClass')]
    private ?string $email = null;

    #[ORM\Column(length: 20,nullable: true)]
    #[Groups('Entrprise:ThisClass')]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups('Entrprise:ThisClass')]
    private ?string $logoEntreprise = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups('Entrprise:ThisClass')]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: SecteurActivite::class, inversedBy: 'entreprises')]
    #[Groups('Entrprise:ThisClass')]
    private Collection $fkSecteurActivite;

    #[ORM\OneToMany(mappedBy: 'fkEntreprise', targetEntity: Emploi::class, orphanRemoval: true)]
    #[Groups('Entrprise:ThisClass')]
    private Collection $emplois;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: OffreStage::class, orphanRemoval: true)]
    private Collection $offreStages;

    public function __construct()
    {
        $this->fkSecteurActivite = new ArrayCollection();
        $this->emplois = new ArrayCollection();
        $this->offreStages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEntreprise(): ?string
    {
        return $this->NomEntreprise;
    }

    public function setNomEntreprise(string $NomEntreprise): self
    {
        $this->NomEntreprise = $NomEntreprise;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(?int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getLogoEntreprise(): ?string
    {
        return $this->logoEntreprise;
    }

    public function setLogoEntreprise(?string $logoEntreprise): self
    {
        $this->logoEntreprise = $logoEntreprise;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, SecteurActivite>
     */
    public function getFkSecteurActivite(): Collection
    {
        return $this->fkSecteurActivite;
    }

    public function addFkSecteurActivite(SecteurActivite $fkSecteurActivite): self
    {
        if (!$this->fkSecteurActivite->contains($fkSecteurActivite)) {
            $this->fkSecteurActivite->add($fkSecteurActivite);
        }

        return $this;
    }

    public function removeFkSecteurActivite(SecteurActivite $fkSecteurActivite): self
    {
        $this->fkSecteurActivite->removeElement($fkSecteurActivite);

        return $this;
    }

    /**
     * @return Collection<int, Emploi>
     */
    public function getEmplois(): Collection
    {
        return $this->emplois;
    }

    public function addEmploi(Emploi $emploi): self
    {
        if (!$this->emplois->contains($emploi)) {
            $this->emplois->add($emploi);
            $emploi->setFkEntreprise($this);
        }

        return $this;
    }

    public function removeEmploi(Emploi $emploi): self
    {
        if ($this->emplois->removeElement($emploi)) {
            // set the owning side to null (unless already changed)
            if ($emploi->getFkEntreprise() === $this) {
                $emploi->setFkEntreprise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OffreStage>
     */
    public function getOffreStages(): Collection
    {
        return $this->offreStages;
    }

    public function addOffreStage(OffreStage $offreStage): self
    {
        if (!$this->offreStages->contains($offreStage)) {
            $this->offreStages->add($offreStage);
            $offreStage->setEntreprise($this);
        }

        return $this;
    }

    public function removeOffreStage(OffreStage $offreStage): self
    {
        if ($this->offreStages->removeElement($offreStage)) {
            // set the owning side to null (unless already changed)
            if ($offreStage->getEntreprise() === $this) {
                $offreStage->setEntreprise(null);
            }
        }

        return $this;
    }
}
