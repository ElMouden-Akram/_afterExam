<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use App\Repository\SecteurActiviteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SecteurActiviteRepository::class)]
#[ApiResource(
    //👇regle apliquer a tout les oprerations (default):
    normalizationContext: ['groups' => ['SecteurActivite:ThisClass']],
    denormalizationContext: ['groups' => ['SecteurActivite:ThisClass']],

    operations:[
        new Get(
            
        ),
        new Post(
            // denormalizationContext: ['groups' => ['User:ThisClass']],
        ),
    ],
)]
class SecteurActivite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('SecteurActivite:ThisClass')]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups('SecteurActivite:ThisClass')]
    private ?string $NomDuSecteur = null;

    #[ORM\ManyToMany(targetEntity: Entreprise::class, mappedBy: 'fkSecteurActivite')]
    private Collection $entreprises;

    public function __construct()
    {
        $this->entreprises = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDuSecteur(): ?string
    {
        return $this->NomDuSecteur;
    }

    public function setNomDuSecteur(string $NomDuSecteur): self
    {
        $this->NomDuSecteur = $NomDuSecteur;

        return $this;
    }

    /**
     * @return Collection<int, Entreprise>
     */
    public function getEntreprises(): Collection
    {
        return $this->entreprises;
    }

    public function addEntreprise(Entreprise $entreprise): self
    {
        if (!$this->entreprises->contains($entreprise)) {
            $this->entreprises->add($entreprise);
            $entreprise->addFkSecteurActivite($this);
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): self
    {
        if ($this->entreprises->removeElement($entreprise)) {
            $entreprise->removeFkSecteurActivite($this);
        }

        return $this;
    }
}
