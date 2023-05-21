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
use App\Repository\OffreStageRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OffreStageRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['OffreStage:GET']],
    denormalizationContext:['groups' => ['OffreStage:POST']],
    operations:[
        new Get(
            normalizationContext: ['groups' => ['OffreStage:GET']],
            denormalizationContext:['groups' => ['OffreStage:POST']],
        ),
        new Post(),
        new GetCollection(),
        new Patch(),
        new Delete(),
        
        
    ],
    
)]
class OffreStage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['OffreStage:GET'])]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    #[Groups(['OffreStage:GET','OffreStage:POST'])]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['OffreStage:GET','OffreStage:POST'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['OffreStage:GET'])]  // remarque : cette attribut est initialiser au constructeur a la creation de l'object!
    private ?\DateTimeInterface $dateAjout = null;
    
    //🚧 Relation :

    #[ORM\ManyToOne(inversedBy: 'offreStages')]
    #[ORM\JoinColumn(nullable: false)]    
    #[Groups(['OffreStage:GET','OffreStage:POST'])]
    private ?User $ajouterPar = null;
    

    #[ORM\ManyToOne(inversedBy: 'offreStages')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['OffreStage:GET','OffreStage:POST'])]
    private ?Entreprise $entreprise = null;

    public function __construct()
    {
        $this->dateAjout = new \DateTimeImmutable();
    }

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

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }
}
