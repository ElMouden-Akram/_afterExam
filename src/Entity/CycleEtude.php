<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Entity\Relation\UserCycleEtude;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CycleEtudeRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CycleEtudeRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['CycleEtude:ThisClass']],
    denormalizationContext: ['groups' => ['CycleEtude:ThisClass']],
    operations:[
        new Post(
            normalizationContext: ['groups' => []],
            denormalizationContext: ['groups' => ['CycleEtude:ThisClass']],
        ),
        new Get(),
    ],

)]
class CycleEtude
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['CycleEtude:ThisClass'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['CycleEtude:ThisClass'])]
    private ?string $titre = null;

    #[ORM\Column(length: 30)]
    #[Groups(['CycleEtude:ThisClass'])]
    private ?string $discipline = null;

    #[ORM\Column(length: 50)]
    #[Groups(['CycleEtude:ThisClass'])]
    private ?string $diplome = null;

    #[ORM\ManyToOne(inversedBy: 'cycleEtudes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['CycleEtude:ThisClass'])]
    private ?Etablissment $fkEtablissement = null;

    #[ORM\Column]
    // #[Groups(['CycleEtude:ThisClass'])] //🔥par default sera false par constructeur
    private ?bool $Valider = null;

    #[ORM\OneToMany(mappedBy: 'fkCycleEtude', targetEntity: UserCycleEtude::class)]
    private Collection $userCycleEtudes;

    public function __construct()
    {
        //valeur par default :
        $this->Valider=false;
        $this->userCycleEtudes = new ArrayCollection();
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
}
