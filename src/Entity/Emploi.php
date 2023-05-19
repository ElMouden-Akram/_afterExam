<?php

namespace App\Entity;

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
}
