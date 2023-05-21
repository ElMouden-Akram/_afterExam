<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\EtablissmentRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EtablissmentRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['Etablissement:GET']],
    denormalizationContext: ['groups' => ['Etablissement:POST']],
    operations:[
        new Get(),
        new Get(
            uriTemplate: '/etablissmentsDetail/{id}',
            normalizationContext:['groups'=>['Etablissement:GETDETAIL']],
        ),
        new GetCollection(),
        new Post(),
    ]
)]
class Etablissment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['Etablissement:GET','Etablissement:GETDETAIL'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['Etablissement:POST','Etablissement:GET','Etablissement:GETDETAIL'])]
    private ?string $nomEtablissement = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Groups(['Etablissement:POST','Etablissement:GET','Etablissement:GETDETAIL'])]
    private ?string $nomUniversite = null;

    #[ORM\Column(length: 20)]
    #[Groups(['Etablissement:POST','Etablissement:GET','Etablissement:GETDETAIL'])]
    private ?string $region = null;

    #[ORM\Column(length: 50)]
    #[Groups(['Etablissement:POST','Etablissement:GET','Etablissement:GETDETAIL'])]
    private ?string $ville = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['Etablissement:POST','Etablissement:GET','Etablissement:GETDETAIL'])]
    private ?string $logoUniversite = null;

    #[ORM\OneToMany(mappedBy: 'fkEtablissement', targetEntity: CycleEtude::class)]
    #[Groups(['Etablissement:GETDETAIL'])]

    private Collection $cycleEtudes;

    public function __construct()
    {
        $this->cycleEtudes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEtablissement(): ?string
    {
        return $this->nomEtablissement;
    }

    public function setNomEtablissement(string $nomEtablissement): self
    {
        $this->nomEtablissement = $nomEtablissement;

        return $this;
    }

    public function getNomUniversite(): ?string
    {
        return $this->nomUniversite;
    }

    public function setNomUniversite(?string $nomUniversite): self
    {
        $this->nomUniversite = $nomUniversite;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getLogoUniversite(): ?string
    {
        return $this->logoUniversite;
    }

    public function setLogoUniversite(?string $logoUniversite): self
    {
        $this->logoUniversite = $logoUniversite;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, CycleEtude>
     */
    public function getCycleEtudes(): Collection
    {
        return $this->cycleEtudes;
    }

    public function addCycleEtude(CycleEtude $cycleEtude): self
    {
        if (!$this->cycleEtudes->contains($cycleEtude)) {
            $this->cycleEtudes->add($cycleEtude);
            $cycleEtude->setFkEtablissement($this);
        }

        return $this;
    }

    public function removeCycleEtude(CycleEtude $cycleEtude): self
    {
        if ($this->cycleEtudes->removeElement($cycleEtude)) {
            // set the owning side to null (unless already changed)
            if ($cycleEtude->getFkEtablissement() === $this) {
                $cycleEtude->setFkEtablissement(null);
            }
        }

        return $this;
    }
}
