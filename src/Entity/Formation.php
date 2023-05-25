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
use App\Repository\FormationRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['Formation:GET']],
    denormalizationContext:['groups' => ['Formation:POST']],
    operations:[
        new Get(
            normalizationContext: ['groups' => ['Formation:GET']],
            denormalizationContext:['groups' => ['Formation:POST']],
        ),
        new Get(
            uriTemplate: '/offre_stagesArticle',
            normalizationContext: ['groups' => ['Formation:GET']],
        ),
        new Post(),
        new GetCollection(),
        new Patch(),
        new Delete(),     
    ],
    
)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['Formation:GET'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['Formation:GET'])]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'formations')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['Formation:GET'])]
    private ?User $ajouterPar = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['Formation:GET'])]
    private ?\DateTimeInterface $dateAjout = null;

    #[ORM\ManyToOne(inversedBy: 'formations')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['Formation:GET'])]
    private ?CycleEtude $cycleEtude = null;

    #[ORM\Column]
    private ?bool $validate = null;
    
    public function __construct()
    {
        $this->validate = false ;
        $this->dateAjout = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCycleEtude(): ?CycleEtude
    {
        return $this->cycleEtude;
    }

    public function setCycleEtude(?CycleEtude $cycleEtude): self
    {
        $this->cycleEtude = $cycleEtude;

        return $this;
    }

    public function isValidate(): ?bool
    {
        return $this->validate;
    }

    public function setValidate(bool $validate): self
    {
        $this->validate = $validate;

        return $this;
    }
}
