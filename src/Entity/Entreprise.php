<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Patch;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['Entreprise:GET']],
    denormalizationContext: ['groups' => ['Entreprise:POST']],
    operations:[
        new Get(),
        new Post(),
        new GetCollection(),
        new Get(
            uriTemplate: '/entreprisesDetail/{id}',
            normalizationContext:['groups'=>['Entreprise:GET','Entreprise:GETDETAIL']],
        ),
        new Patch(),
    ],
)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['Entreprise:GET','OffreStage:GET:forArticle'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['Entreprise:GET','Entreprise:POST','OffreStage:GET:forArticle'])]
    private ?string $NomEntreprise = null;

    #[ORM\Column(length: 30)]
    #[Groups(['Entreprise:GET','Entreprise:POST'])]
    private ?string $ville = null;

    #[ORM\Column(length: 30)]
    #[Groups(['Entreprise:GET','Entreprise:POST'])]
    private ?string $pays = null;

    #[ORM\Column(length: 40)]
    #[Groups(['Entreprise:GET','Entreprise:POST'])]
    private ?string $website = null;

    #[ORM\Column(length: 40)]
    #[Groups(['Entreprise:GET','Entreprise:POST'])]
    private ?string $email = null;

    #[ORM\Column(length: 20,nullable: true)]
    #[Groups(['Entreprise:GET','Entreprise:POST'])]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['Entreprise:GET','Entreprise:POST'])]
    private ?string $logoEntreprise = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['Entreprise:GET','Entreprise:POST'])]
    private ?string $description = null;

    //🚧 Relation :

    #[ORM\ManyToMany(targetEntity: SecteurActivite::class, inversedBy: 'entreprises')]
    #[Groups(['Entreprise:GET','Entreprise:POST'])]
    private Collection $fkSecteurActivite;

    #[ORM\OneToMany(mappedBy: 'fkEntreprise', targetEntity: Emploi::class, orphanRemoval: true)]
    #[Groups(['Entreprise:GETDETAIL'])]
    private Collection $emplois;

    // #[ORM\OneToMany(mappedBy: 'fkEntreprise', targetEntity: OffreStage::class, orphanRemoval: true)]
    // #[Groups(['Entreprise:GETDETAIL'])]
    // private Collection $offreStages;

    public function __construct()
    {
        $this->fkSecteurActivite = new ArrayCollection();
        $this->emplois = new ArrayCollection();
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
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

}
