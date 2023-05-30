<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\OffreStageRepository;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: OffreStageRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['OffreStage:GET']],
    denormalizationContext:['groups' => ['OffreStage:POST']],
    operations:[
        new Get(
            normalizationContext: ['groups' => ['OffreStage:GET']],
            denormalizationContext:['groups' => ['OffreStage:POST']],
        ),
        // new Get(
        //     uriTemplate: '/offre_stagesArticle',
        //     normalizationContext: ['groups' => ['OffreStage:GET']],
        // ),
        new Post(),
        new GetCollection(),
        new Patch(),
        new Delete(),     
    ],
)]

#[Assert\Expression('this.FkEmploiType() == "stage"',message: 'Cette emploi a attribut type <> "stage" !')]
//👇 un utser peut ecrire un article sur une emploi :
#[UniqueEntity(fields:["ajouterPar","fkEmploi"], message:"Vous avez deja saisi un post sur cette article.")]
#[ApiFilter(SearchFilter::class, properties: ['fkEmploi.titre' => 'partial','ajouterPar.lastName' => 'partial','fkEmploi.fkEntreprise.NomEntreprise' => 'partial'])]
// #[ApiResource(paginationItemsPerPage: 0)]
class OffreStage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['OffreStage:GET'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['OffreStage:GET','OffreStage:POST'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['OffreStage:GET','OffreStage:POST'])]  // remarque : cette attribut est initialiser au constructeur a la creation de l'object!
    private ?\DateTimeInterface $dateAjout = null;
    
    //🚧 Relation :

    #[ORM\ManyToOne(inversedBy: 'offreStages')]
    #[ORM\JoinColumn(nullable: false)]    
    #[Groups(['OffreStage:GET','OffreStage:POST'/*,'OffreStage:GET:forArticle'*/])]
    private ?User $ajouterPar = null;

    #[ORM\ManyToOne(inversedBy: 'offreStages')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['OffreStage:GET','OffreStage:POST'/*,'OffreStage:GET:forArticle'*/])]
    private ?Emploi $fkEmploi = null;

    #[ORM\Column]
    #[ApiFilter(BooleanFilter::class)]
    private ?bool $validate = null;
    

    // #[ORM\ManyToOne(inversedBy: 'offreStages')]
    // #[ORM\JoinColumn(nullable: false)]
    // #[Groups(['OffreStage:GET','OffreStage:POST','OffreStage:GET:forArticle'])]
    // private ?Entreprise $fkEntreprise = null;

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

    //Pour la assert constraint :
    public function FkEmploiType():string{
        return $this->fkEmploi->getType();
    }

    // public function getFkEntreprise(): ?Entreprise
    // {
    //     return $this->fkEntreprise;
    // }

    // public function setFkEntreprise(?Entreprise $entreprise): self
    // {
    //     $this->fkEntreprise = $entreprise;

    //     return $this;
    // }

    public function getFkEmploi(): ?Emploi
    {
        return $this->fkEmploi;
    }

    public function setFkEmploi(?Emploi $fkEmploi): self
    {
        $this->fkEmploi = $fkEmploi;

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
