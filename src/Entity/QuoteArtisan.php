<?php

namespace App\Entity;

use App\Repository\QuoteArtisanRepository;
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
}
