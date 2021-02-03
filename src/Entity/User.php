<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $websiteLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $instagramLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $facebookLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $companyName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isValidated;

    /**
     * @ORM\ManyToOne(targetEntity=Town::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $town;

    /**
     * @ORM\ManyToMany(targetEntity=GeneralSetup::class, inversedBy="users")
     */
    private $generalSetup;

    /**
     * @ORM\ManyToMany(targetEntity=SpecificSetup::class, inversedBy="users")
     */
    private $specificSetUp;

    /**
     * @ORM\ManyToMany(targetEntity=SpecialtiesVanExpert::class, inversedBy="users")
     */
    private $specialtiesVanExpert;

    public function __construct()
    {
        $this->generalSetup = new ArrayCollection();
        $this->specificSetUp = new ArrayCollection();
        $this->specialtiesVanExpert = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
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
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getWebsiteLink(): ?string
    {
        return $this->websiteLink;
    }

    public function setWebsiteLink(?string $websiteLink): self
    {
        $this->websiteLink = $websiteLink;

        return $this;
    }

    public function getInstagramLink(): ?string
    {
        return $this->instagramLink;
    }

    public function setInstagramLink(?string $instagramLink): self
    {
        $this->instagramLink = $instagramLink;

        return $this;
    }

    public function getFacebookLink(): ?string
    {
        return $this->facebookLink;
    }

    public function setFacebookLink(?string $facebookLink): self
    {
        $this->facebookLink = $facebookLink;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getIsValidated(): ?bool
    {
        return $this->isValidated;
    }

    public function setIsValidated(?bool $isValidated): self
    {
        $this->isValidated = $isValidated;

        return $this;
    }

    public function getTown(): ?Town
    {
        return $this->town;
    }

    public function setTown(?Town $town): self
    {
        $this->town = $town;

        return $this;
    }

    /**
     * @return Collection|GeneralSetup[]
     */
    public function getGeneralSetup(): Collection
    {
        return $this->generalSetup;
    }

    public function addGeneralSetup(GeneralSetup $generalSetup): self
    {
        if (!$this->generalSetup->contains($generalSetup)) {
            $this->generalSetup[] = $generalSetup;
        }

        return $this;
    }

    public function removeGeneralSetup(GeneralSetup $generalSetup): self
    {
        $this->generalSetup->removeElement($generalSetup);

        return $this;
    }

    /**
     * @return Collection|SpecificSetup[]
     */
    public function getSpecificSetUp(): Collection
    {
        return $this->specificSetUp;
    }

    public function addSpecificSetUp(SpecificSetup $specificSetUp): self
    {
        if (!$this->specificSetUp->contains($specificSetUp)) {
            $this->specificSetUp[] = $specificSetUp;
        }

        return $this;
    }

    public function removeSpecificSetUp(SpecificSetup $specificSetUp): self
    {
        $this->specificSetUp->removeElement($specificSetUp);

        return $this;
    }

    /**
     * @return Collection|SpecialtiesVanExpert[]
     */
    public function getSpecialtiesVanExpert(): Collection
    {
        return $this->specialtiesVanExpert;
    }

    public function addSpecialtiesVanExpert(SpecialtiesVanExpert $specialtiesVanExpert): self
    {
        if (!$this->specialtiesVanExpert->contains($specialtiesVanExpert)) {
            $this->specialtiesVanExpert[] = $specialtiesVanExpert;
        }

        return $this;
    }

    public function removeSpecialtiesVanExpert(SpecialtiesVanExpert $specialtiesVanExpert): self
    {
        $this->specialtiesVanExpert->removeElement($specialtiesVanExpert);

        return $this;
    }
}
