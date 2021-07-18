<?php

namespace App\Entity;

use App\Repository\AdsVanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=AdsVanRepository::class)
 * @Vich\Uploadable
 */
class AdsVan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=TypeVan::class, inversedBy="adsVans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeVan;

    /**
     * @ORM\ManyToOne(targetEntity=SizeVan::class, inversedBy="adsVans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sizeVan;

    /**
     * @ORM\ManyToOne(targetEntity=BrandVan::class, inversedBy="adsVans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brandVan;

    /**
     * @ORM\ManyToOne(targetEntity=YearVan::class, inversedBy="adsVans")
     */
    private $yearVan;

    /**
     * @ORM\ManyToOne(targetEntity=KilometerVan::class, inversedBy="adsVans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $kilometerVan;

    /**
     * @ORM\ManyToOne(targetEntity=SpecificSetup::class, inversedBy="adsVans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $specificSetup;

    /**
     * @ORM\ManyToOne(targetEntity=GeneralSetup::class, inversedBy="adsVans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $generalSetup;

    /**
     * @ORM\ManyToOne(targetEntity=Floor::class, inversedBy="adsVans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $floor;

    /**
     * @ORM\ManyToMany(targetEntity=SpecialtiesVanArtisan::class, inversedBy="adsVans")
     */
    private $specialtiesVan;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isValidated;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="adsVans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Veneer::class, inversedBy="adsVans")
     */
    private $veneer;

    /**
     * @ORM\ManyToMany(targetEntity=Insulation::class, inversedBy="adsVans")
     */
    private $insulation;

    /**
     * @ORM\ManyToMany(targetEntity=VanFurnishing::class, inversedBy="adsVans")
     */
    private $vanFurnishing;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    * @var string
    */
    private $pictureVan;

    /**
    * @Vich\UploadableField(mapping="pictureVan_file", fileNameProperty="pictureVan")
    * @Assert\File(
    *     maxSize = "3000k",
    *     mimeTypes = {"image/png", "image/jpeg"},
    *     mimeTypesMessage = "Seul le format png est accepté"
    * )
    * @var File
    */
    private $pictureVanFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var Datetime
     */
    private $updatedAt;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->specialtiesVan = new ArrayCollection();
        $this->veneer = new ArrayCollection();
        $this->insulation = new ArrayCollection();
        $this->vanFurnishing = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getGeneralSetup(): ?GeneralSetup
    {
        return $this->generalSetup;
    }

    public function setGeneralSetup(?GeneralSetup $generalSetup): self
    {
        $this->generalSetup = $generalSetup;

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
     * @return Collection|SpecialtiesVanArtisan[]
     */
    public function getSpecialtiesVan(): Collection
    {
        return $this->specialtiesVan;
    }

    public function addSpecialtiesVan(SpecialtiesVanArtisan $specialtiesVan): self
    {
        if (!$this->specialtiesVan->contains($specialtiesVan)) {
            $this->specialtiesVan[] = $specialtiesVan;
        }

        return $this;
    }

    public function removeSpecialtiesVan(SpecialtiesVanArtisan $specialtiesVan): self
    {
        $this->specialtiesVan->removeElement($specialtiesVan);

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIsValidated(): ?bool
    {
        return $this->isValidated;
    }

    public function setIsValidated(bool $isValidated): self
    {
        $this->isValidated = $isValidated;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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

    public function setPictureVanFile(File $pictureVan = null)
    {
        $this->pictureVanFile = $pictureVan;
        if ($pictureVan) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getPictureVanFile(): ?File
    {
        return $this->pictureVanFile;
    }

    public function getPictureVan(): ?string
    {
        return $this->pictureVan;
    }

    public function setPictureVan(?string $pictureVan): self
    {
        $this->pictureVan = $pictureVan;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}