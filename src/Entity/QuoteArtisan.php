<?php

namespace App\Entity;

use App\Repository\QuoteArtisanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuoteArtisanRepository::class)
 */
class QuoteArtisan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $message;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $projectDate;

    /**
     * @ORM\ManyToOne(targetEntity=TypeVan::class, inversedBy="quoteArtisans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeVan;

    /**
     * @ORM\ManyToOne(targetEntity=SizeVan::class, inversedBy="quoteArtisans")
     */
    private $sizeVan;

    /**
     * @ORM\ManyToOne(targetEntity=BrandVan::class, inversedBy="quoteArtisans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brandVan;

    /**
     * @ORM\ManyToOne(targetEntity=YearVan::class, inversedBy="quoteArtisans")
     */
    private $yearVan;

    /**
     * @ORM\ManyToOne(targetEntity=KilometerVan::class, inversedBy="quoteArtisans")
     */
    private $kilometerVan;

    /**
     * @ORM\ManyToOne(targetEntity=SpecificSetup::class, inversedBy="quoteArtisans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $specificSetup;

    /**
     * @ORM\ManyToMany(targetEntity=SpecialtiesVanArtisan::class, inversedBy="quoteArtisans")
     */
    private $specialtiesVanArtisan;

    /**
     * @ORM\ManyToOne(targetEntity=Floor::class, inversedBy="quoteArtisans")
     */
    private $floor;

    /**
     * @ORM\ManyToMany(targetEntity=Insulation::class, inversedBy="quoteArtisans")
     */
    private $insulation;

    /**
     * @ORM\ManyToMany(targetEntity=Veneer::class, inversedBy="quoteArtisans")
     */
    private $veneer;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="quoteArtisans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $artisan;

    /**
     * @ORM\ManyToOne(targetEntity=GeneralSetup::class, inversedBy="quoteArtisans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $generalSetup;

    /**
     * @ORM\ManyToMany(targetEntity=VanFurnishing::class, inversedBy="quoteArtisans")
     */
    private $vanFurnishing;

    public function __construct()
    {
        $this->specialtiesVanArtisan = new ArrayCollection();
        $this->insulation = new ArrayCollection();
        $this->veneer = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->vanFurnishing = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getProjectDate(): ?\DateTimeInterface
    {
        return $this->projectDate;
    }

    public function setProjectDate(?\DateTimeInterface $projectDate): self
    {
        $this->projectDate = $projectDate;

        return $this;
    }

    public function getTypeVan(): ?TypeVan
    {
        return $this->typeVan;
    }

    public function setTypeVan(?TypeVan $typeVan): self
    {
        $this->typeVan = $typeVan;

        return $this;
    }

    public function getSizeVan(): ?SizeVan
    {
        return $this->sizeVan;
    }

    public function setSizeVan(?SizeVan $sizeVan): self
    {
        $this->sizeVan = $sizeVan;

        return $this;
    }

    public function getBrandVan(): ?BrandVan
    {
        return $this->brandVan;
    }

    public function setBrandVan(?BrandVan $brandVan): self
    {
        $this->brandVan = $brandVan;

        return $this;
    }

    public function getYearVan(): ?YearVan
    {
        return $this->yearVan;
    }

    public function setYearVan(?YearVan $yearVan): self
    {
        $this->yearVan = $yearVan;

        return $this;
    }

    public function getKilometerVan(): ?KilometerVan
    {
        return $this->kilometerVan;
    }

    public function setKilometerVan(?KilometerVan $kilometerVan): self
    {
        $this->kilometerVan = $kilometerVan;

        return $this;
    }

    public function getSpecificSetup(): ?SpecificSetup
    {
        return $this->specificSetup;
    }

    public function setSpecificSetup(?SpecificSetup $specificSetup): self
    {
        $this->specificSetup = $specificSetup;

        return $this;
    }

    /**
     * @return Collection|SpecialtiesVanArtisan[]
     */
    public function getSpecialtiesVanArtisan(): Collection
    {
        return $this->specialtiesVanArtisan;
    }

    public function addSpecialtiesVanArtisan(SpecialtiesVanArtisan $specialtiesVanArtisan): self
    {
        if (!$this->specialtiesVanArtisan->contains($specialtiesVanArtisan)) {
            $this->specialtiesVanArtisan[] = $specialtiesVanArtisan;
        }

        return $this;
    }

    public function removeSpecialtiesVanArtisan(SpecialtiesVanArtisan $specialtiesVanArtisan): self
    {
        $this->specialtiesVanArtisan->removeElement($specialtiesVanArtisan);

        return $this;
    }

    public function getFloor(): ?Floor
    {
        return $this->floor;
    }

    public function setFloor(?Floor $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * @return Collection|Insulation[]
     */
    public function getInsulation(): Collection
    {
        return $this->insulation;
    }

    public function addInsulation(Insulation $insulation): self
    {
        if (!$this->insulation->contains($insulation)) {
            $this->insulation[] = $insulation;
        }

        return $this;
    }

    public function removeInsulation(Insulation $insulation): self
    {
        $this->insulation->removeElement($insulation);

        return $this;
    }

    /**
     * @return Collection|Veneer[]
     */
    public function getVeneer(): Collection
    {
        return $this->veneer;
    }

    public function addVeneer(Veneer $veneer): self
    {
        if (!$this->veneer->contains($veneer)) {
            $this->veneer[] = $veneer;
        }

        return $this;
    }

    public function removeVeneer(Veneer $veneer): self
    {
        $this->veneer->removeElement($veneer);

        return $this;
    }

    public function getArtisan(): ?User
    {
        return $this->artisan;
    }

    public function setArtisan(?User $artisan): self
    {
        $this->artisan = $artisan;

        return $this;
    }

    public function getGeneralSetup(): ?GeneralSetup
    {
        return $this->generalSetup;
    }

    public function setGeneralSetup(?GeneralSetup $generalSetup): self
    {
        $this->generalSetup = $generalSetup;

        return $this;
    }

    /**
     * @return Collection|VanFurnishing[]
     */
    public function getVanFurnishing(): Collection
    {
        return $this->vanFurnishing;
    }

    public function addVanFurnishing(VanFurnishing $vanFurnishing): self
    {
        if (!$this->vanFurnishing->contains($vanFurnishing)) {
            $this->vanFurnishing[] = $vanFurnishing;
        }

        return $this;
    }

    public function removeVanFurnishing(VanFurnishing $vanFurnishing): self
    {
        $this->vanFurnishing->removeElement($vanFurnishing);

        return $this;
    }
}