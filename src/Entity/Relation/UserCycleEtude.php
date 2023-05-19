<?php

namespace App\Entity\Relation;

use App\Entity\User;
use App\Entity\CycleEtude;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\Relation\UserCycleEtudeRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserCycleEtudeRepository::class)]
#[ApiResource]
class UserCycleEtude
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userCycleEtudes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $fkUser = null;

    #[ORM\ManyToOne(inversedBy: 'userCycleEtudes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('User:relation:get')]
    private ?CycleEtude $fkCycleEtude = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateFin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFkUser(): ?User
    {
        return $this->fkUser;
    }

    public function setFkUser(?User $fkUser): self
    {
        $this->fkUser = $fkUser;

        return $this;
    }

    public function getFkCycleEtude(): ?CycleEtude
    {
        return $this->fkCycleEtude;
    }

    public function setFkCycleEtude(?CycleEtude $fkCycleEtude): self
    {
        $this->fkCycleEtude = $fkCycleEtude;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }
}
