<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Entity\Relation\UserCycleEtude;
use App\Repository\CycleEtudeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CycleEtudeRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['CycleEtude:GET']],
    denormalizationContext: ['groups' => ['CycleEtude:POST']],
    operations:[
        new Post(),
        new Get(
            uriTemplate: '/cycle_etudesDetail/{id}',
            normalizationContext:['groups'=>['CycleEtude:GET','CycleEtude:GETDETAIL']],
        ),
        new Post(),
        new GetCollection(),
        new Patch(),
        new Delete(),
    ],

)]
class CycleEtude
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['CycleEtude:GET'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['CycleEtude:GET','CycleEtude:POST'])]
    private ?string $titre = null;

    #[ORM\Column(length: 30)]
    #[Groups(['CycleEtude:GET','CycleEtude:POST'])]
    private ?string $discipline = null;

    #[ORM\Column(length: 50)]
    #[Groups(['CycleEtude:GET','CycleEtude:POST'])]
    private ?string $diplome = null;

    #[ORM\Column]
    // #[Groups(['CycleEtude:ThisClass'])] //🔥par default sera false par constructeur
    private ?bool $Valider = null;

    //🚧 Relation :

    #[ORM\ManyToOne(inversedBy: 'cycleEtudes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['CycleEtude:GET','CycleEtude:POST'])]
    private ?Etablissment $fkEtablissement = null;
    


    #[ORM\OneToMany(mappedBy: 'fkCycleEtude', targetEntity: UserCycleEtude::class)]
    #[Groups(['CycleEtude:GETDETAIL'])]
    private Collection $userCycleEtudes;

    #[ORM\OneToMany(mappedBy: 'cycleEtude', targetEntity: Formation::class)]
    #[Groups(['CycleEtude:GETDETAIL'])]
    private Collection $formations;

    public function __construct()
    {
        //🔥valeur par default :
        $this->Valider=false;
        $this->userCycleEtudes = new ArrayCollection();
        $this->formations = new ArrayCollection();
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

    public function getDiscipline(): ?string
    {
        return $this->discipline;
    }

    public function setDiscipline(string $discipline): self
    {
        $this->discipline = $discipline;

        return $this;
    }

    public function getDiplome(): ?string
    {
        return $this->diplome;
    }

    public function setDiplome(string $diplome): self
    {
        $this->diplome = $diplome;

        return $this;
    }

    public function getFkEtablissement(): ?Etablissment
    {
        return $this->fkEtablissement;
    }

    public function setFkEtablissement(?Etablissment $fkEtablissement): self
    {
        $this->fkEtablissement = $fkEtablissement;

        return $this;
    }

    public function isValider(): ?bool
    {
        return $this->Valider;
    }

    public function setValider(bool $Valider): self
    {
        $this->Valider = $Valider;

        return $this;
    }

    /**
     * @return Collection<int, UserCycleEtude>
     */
    public function getUserCycleEtudes(): Collection
    {
        return $this->userCycleEtudes;
    }

    public function addUserCycleEtude(UserCycleEtude $userCycleEtude): self
    {
        if (!$this->userCycleEtudes->contains($userCycleEtude)) {
            $this->userCycleEtudes->add($userCycleEtude);
            $userCycleEtude->setFkCycleEtude($this);
        }

        return $this;
    }

    public function removeUserCycleEtude(UserCycleEtude $userCycleEtude): self
    {
        if ($this->userCycleEtudes->removeElement($userCycleEtude)) {
            // set the owning side to null (unless already changed)
            if ($userCycleEtude->getFkCycleEtude() === $this) {
                $userCycleEtude->setFkCycleEtude(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Formation>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations->add($formation);
            $formation->setCycleEtude($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getCycleEtude() === $this) {
                $formation->setCycleEtude(null);
            }
        }

        return $this;
    }
}
