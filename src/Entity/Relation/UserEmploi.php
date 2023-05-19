<?php

namespace App\Entity\Relation;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Emploi;
use App\Entity\User;
use App\Repository\Relation\UserEmploiRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserEmploiRepository::class)]
#[ApiResource()]
class UserEmploi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userEmplois')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $fkUser = null;

    #[ORM\ManyToOne(inversedBy: 'userEmplois')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Emploi $fkEmploi = null;

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

    public function getFkEmploi(): ?Emploi
    {
        return $this->fkEmploi;
    }

    public function setFkEmploi(?Emploi $fkEmploi): self
    {
        $this->fkEmploi = $fkEmploi;

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
