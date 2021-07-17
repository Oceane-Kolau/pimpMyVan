<?php

namespace App\Entity;

use App\Repository\SpecialtiesVanArtisanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpecialtiesVanArtisanRepository::class)
 */
class SpecialtiesVanArtisan
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
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="specialtiesVanArtisan")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity=QuoteArtisan::class, mappedBy="specialtiesVanArtisan")
     */
    private $quoteArtisans;

    /**
     * @ORM\ManyToMany(targetEntity=AdsVan::class, mappedBy="specialtiesVanArtisan")
     */
    private $adsVans;

    public function __toString()
    {
        return $this->type;
    }

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->quoteArtisans = new ArrayCollection();
        $this->adsVans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addSpecialtiesVanArtisan($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeSpecialtiesVanArtisan($this);
        }

        return $this;
    }

    /**
     * @return Collection|QuoteArtisan[]
     */
    public function getQuoteArtisans(): Collection
    {
        return $this->quoteArtisans;
    }

    public function addQuoteArtisan(QuoteArtisan $quoteArtisan): self
    {
        if (!$this->quoteArtisans->contains($quoteArtisan)) {
            $this->quoteArtisans[] = $quoteArtisan;
            $quoteArtisan->addSpecialtiesVanArtisan($this);
        }

        return $this;
    }

    public function removeQuoteArtisan(QuoteArtisan $quoteArtisan): self
    {
        if ($this->quoteArtisans->removeElement($quoteArtisan)) {
            $quoteArtisan->removeSpecialtiesVanArtisan($this);
        }

        return $this;
    }

    /**
     * @return Collection|AdsVan[]
     */
    public function getAdsVans(): Collection
    {
        return $this->adsVans;
    }

    public function addAdsVan(AdsVan $adsVan): self
    {
        if (!$this->adsVans->contains($adsVan)) {
            $this->adsVans[] = $adsVan;
            $adsVan->addSpecialtiesVan($this);
        }

        return $this;
    }

    public function removeAdsVan(AdsVan $adsVan): self
    {
        if ($this->adsVans->removeElement($adsVan)) {
            $adsVan->removeSpecialtiesVan($this);
        }

        return $this;
    }
}
