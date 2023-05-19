<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\OffreStageRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OffreStageRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['OffreStage:ThisClass']],
)]
class OffreStage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['OffreStage:ThisClass'])]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    #[Groups(['OffreStage:ThisClass'])]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['OffreStage:ThisClass'])]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'offreStages')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['OffreStage:ThisClass'])]
    private ?User $ajouterPar = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['OffreStage:ThisClass'])]
    private ?\DateTimeInterface $dateAjout = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAjouterPar(): ?User
    {
        return $this->ajouterPar;
    }

    public function setAjouterPar(?User $ajouterPar): self
    {
        $this->ajouterPar = $ajouterPar;

        return $this;
    }

    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->dateAjout;
    }

    public function setDateAjout(\DateTimeInterface $dateAjout): self
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }
}
