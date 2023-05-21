<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\OffreEmploiRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OffreEmploiRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['OffreEmploi:GET']],
    denormalizationContext:['groups' => ['OffreEmploi:POST']],
    operations:[
        new Get(),
        new Post(),
        new GetCollection(),
        new Patch(),
        new Delete(),
        
        
    ],
    
)]
class OffreEmploi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['OffreEmploi:GET'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['OffreEmploi:POST','OffreEmploi:GET'])]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['OffreEmploi:POST','OffreEmploi:GET'])]
    private ?string $description = null;
    
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['OffreEmploi:GET'])]
    private ?\DateTimeInterface $dateAjout = null;

    //🚧 Relation :

    #[ORM\ManyToOne(inversedBy: 'offreEmplois')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['OffreEmploi:POST','OffreEmploi:GET'])]
    private ?User $ajouterPar = null;


    #[ORM\ManyToOne(inversedBy: 'offreEmplois')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['OffreEmploi:POST','OffreEmploi:GET'])]
    private ?Emploi $emploi = null;

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

    public function getEmploi(): ?Emploi
    {
        return $this->emploi;
    }

    public function setEmploi(?Emploi $emploi): self
    {
        $this->emploi = $emploi;

        return $this;
    }
}
