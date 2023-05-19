<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Entity\Relation\UserCycleEtude;
use App\Entity\Relation\UserEmploi;


use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    //👇regle apliquer a tout les oprerations (default):
    normalizationContext: ['groups' => ['User:ThisClass','User:relation:ToRead']],
    denormalizationContext: ['groups' => ['User:ThisClass']],

    operations:[
        new Get(
            normalizationContext: ['groups' => ['User:ThisClass','User:relation:ToRead','CycleEtude:ThisClass','OffreStage:ThisClass']],
        ),
        new Post(
            normalizationContext: ['groups' => []],// je veux que sa me retourne rien apres ecriture(denorma...) dans database , sauf stage requette (ajouter plus tard)
            denormalizationContext: ['groups' => ['User:ThisClass']],
        )
    ],
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['User:ThisClass'])]
    private ?int $id = null;

    #[ORM\Column(length: 30, unique: true)]
    #[Groups(['User:ThisClass'])]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Groups(['User:ThisClass'])]
    private ?string $password = null;

    #[ORM\Column(length: 40)]
    #[Groups(['User:ThisClass','OffreStage:ThisClass'])]
    private ?string $firstName = null;

    #[ORM\Column(length: 40)]
    #[Groups(['User:ThisClass','OffreStage:ThisClass'])]
    private ?string $lastName = null;

    #[ORM\Column(length: 15, nullable: true)]
    #[Groups(['User:ThisClass'])]
    private ?string $CNI = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Groups(['User:ThisClass'])]
    private ?string $CNE = null;

    #[ORM\Column]
    #[Groups(['User:ThisClass'])]
    private ?bool $sexe = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups(['User:ThisClass'])]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(length: 60, nullable: true)]
    #[Groups(['User:ThisClass'])]
    private ?string $adresse = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['User:ThisClass'])]
    private ?int $telephone = null;

// 🚧 attribut bellow for 'relation' 🚧

    #[ORM\OneToMany(mappedBy: 'ajouterPar', targetEntity: OffreStage::class)]
    #[Groups(['User:relation:ToRead'])]
    private Collection $offreStages;

    #[ORM\OneToMany(mappedBy: 'fkUser', targetEntity: UserCycleEtude::class)]
    #[Groups(['User:relation:ToRead'])]
    private Collection $userCycleEtudes;

    #[Groups(['User:relation:ToRead'])]
    #[ORM\OneToMany(mappedBy: 'fkUser', targetEntity: UserEmploi::class, orphanRemoval: true)]
    private Collection $userEmplois;

    #[ORM\OneToMany(mappedBy: 'ajouterPar', targetEntity: OffreEmploi::class)]
    private Collection $offreEmplois;

    #[ORM\OneToMany(mappedBy: 'ajouterPar', targetEntity: Formation::class, orphanRemoval: true)]
    private Collection $formations;

    public function __construct()
    {
        $this->offreStages = new ArrayCollection();
        $this->userCycleEtudes = new ArrayCollection();
        $this->userEmplois = new ArrayCollection();
        $this->offreEmplois = new ArrayCollection();
        $this->formations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCNI(): ?string
    {
        return $this->CNI;
    }

    public function setCNI(?string $CNI): self
    {
        $this->CNI = $CNI;

        return $this;
    }

    public function getCNE(): ?string
    {
        return $this->CNE;
    }

    public function setCNE(?string $CNE): self
    {
        $this->CNE = $CNE;

        return $this;
    }

    public function isSexe(): ?bool
    {
        return $this->sexe;
    }

    public function setSexe(bool $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(?int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection<int, OffreStage>
     */
    public function getOffreStages(): Collection
    {
        return $this->offreStages;
    }

    public function addOffreStage(OffreStage $offreStage): self
    {
        if (!$this->offreStages->contains($offreStage)) {
            $this->offreStages->add($offreStage);
            $offreStage->setAjouterPar($this);
        }

        return $this;
    }

    public function removeOffreStage(OffreStage $offreStage): self
    {
        if ($this->offreStages->removeElement($offreStage)) {
            // set the owning side to null (unless already changed)
            if ($offreStage->getAjouterPar() === $this) {
                $offreStage->setAjouterPar(null);
            }
        }

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
            $userCycleEtude->setFkUser($this);
        }

        return $this;
    }

    public function removeUserCycleEtude(UserCycleEtude $userCycleEtude): self
    {
        if ($this->userCycleEtudes->removeElement($userCycleEtude)) {
            // set the owning side to null (unless already changed)
            if ($userCycleEtude->getFkUser() === $this) {
                $userCycleEtude->setFkUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserEmploi>
     */
    public function getUserEmplois(): Collection
    {
        return $this->userEmplois;
    }

    public function addUserEmploi(UserEmploi $userEmploi): self
    {
        if (!$this->userEmplois->contains($userEmploi)) {
            $this->userEmplois->add($userEmploi);
            $userEmploi->setFkUser($this);
        }

        return $this;
    }

    public function removeUserEmploi(UserEmploi $userEmploi): self
    {
        if ($this->userEmplois->removeElement($userEmploi)) {
            // set the owning side to null (unless already changed)
            if ($userEmploi->getFkUser() === $this) {
                $userEmploi->setFkUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OffreEmploi>
     */
    public function getOffreEmplois(): Collection
    {
        return $this->offreEmplois;
    }

    public function addOffreEmploi(OffreEmploi $offreEmploi): self
    {
        if (!$this->offreEmplois->contains($offreEmploi)) {
            $this->offreEmplois->add($offreEmploi);
            $offreEmploi->setAjouterPar($this);
        }

        return $this;
    }

    public function removeOffreEmploi(OffreEmploi $offreEmploi): self
    {
        if ($this->offreEmplois->removeElement($offreEmploi)) {
            // set the owning side to null (unless already changed)
            if ($offreEmploi->getAjouterPar() === $this) {
                $offreEmploi->setAjouterPar(null);
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
            $formation->setAjouterPar($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getAjouterPar() === $this) {
                $formation->setAjouterPar(null);
            }
        }

        return $this;
    }
}
