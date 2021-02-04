<?php

namespace App\Entity;

use Serializable;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @Vich\Uploadable
 */
class User implements UserInterface, \Serializable
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
    private $specificSetup;

    /**
     * @ORM\ManyToMany(targetEntity=SpecialtiesVanArtisan::class, inversedBy="users")
     */
    private $specialtiesVanArtisan;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    * @var string
    */
    private $picture;

    /**
    * @Vich\UploadableField(mapping="picture_file", fileNameProperty="picture")
    * @Assert\File(
    *     maxSize = "3000k",
    *     mimeTypes = {"image/png", "image/jpeg"},
    *     mimeTypesMessage = "Seul le format png est accepté"
    * )
    * @var File
    */
    private $pictureFile;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    * @var string
    */
    private $banner;

    /**
    * @Vich\UploadableField(mapping="banner_file", fileNameProperty="banner")
    * @Assert\File(
    *     maxSize = "3000k",
    *     mimeTypes = {"image/png", "image/jpeg"},
    *     mimeTypesMessage = "Seuls les formats jpg, jpeg et png sont acceptés"
    * )
    * @var File
    */
    private $bannerFile;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    * @var string
    */
    private $profilePicture;

    /**
    * @Vich\UploadableField(mapping="profile_picture_file", fileNameProperty="profile_picture")
    * @Assert\File(
    *     maxSize = "3000k",
    *     mimeTypes = {"image/png", "image/jpeg"},
    *     mimeTypesMessage = "Seuls les formats jpg, jpeg et png sont acceptés"
    * )
    * @var File
    */
    private $profilePictureFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var Datetime
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Contact::class, mappedBy="user")
     */
    private $contacts;


    public function __construct()
    {
        $this->generalSetup = new ArrayCollection();
        $this->specificSetup = new ArrayCollection();
        $this->specialtiesVanArtisan = new ArrayCollection();
        $this->contacts = new ArrayCollection();
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
        return $this->specificSetup;
    }

    public function addSpecificSetUp(SpecificSetup $specificSetup): self
    {
        if (!$this->specificSetup->contains($specificSetup)) {
            $this->specificSetup[] = $specificSetup;
        }

        return $this;
    }

    public function removeSpecificSetUp(SpecificSetup $specificSetup): self
    {
        $this->specificSetup->removeElement($specificSetup);

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function setPictureFile(File $picture = null)
    {
        $this->pictureFile = $picture;
        if ($picture) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function setBannerFile(File $banner = null)
    {
        $this->bannerFile = $banner;
        if ($banner) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getBannerFile(): ?File
    {
        return $this->bannerFile;
    }

    public function getBanner(): ?string
    {
        return $this->banner;
    }

    public function setBanner(?string $banner): self
    {
        $this->banner = $banner;

        return $this;
    }

    public function setProfilePictureFile(File $profilePicture = null)
    {
        $this->profilePictureFile = $profilePicture;
        if ($profilePicture) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getProfilePictureFile(): ?File
    {
        return $this->profilePictureFile;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(?string $profilePicture): self
    {
        $this->profilePicture = $profilePicture;

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

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setUser($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getUser() === $this) {
                $contact->setUser(null);
            }
        }

        return $this;
    }
}
