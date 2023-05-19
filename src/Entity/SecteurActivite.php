<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SecteurActiviteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SecteurActiviteRepository::class)]
#[ApiResource]
class SecteurActivite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $NomDuSecteur = null;

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
}
