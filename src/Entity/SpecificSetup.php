<?php

namespace App\Entity;

use App\Repository\SpecificSetupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpecificSetupRepository::class)
 */
class SpecificSetup
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
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="specificSetup")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=QuoteArtisan::class, mappedBy="specificSetup")
     */
    private $quoteArtisans;

    /**
     * @ORM\OneToMany(targetEntity=AdsVan::class, mappedBy="specificSetup")
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
            $user->addSpecificSetUp($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeSpecificSetUp($this);
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
            $quoteArtisan->setSpecificSetup($this);
        }

        return $this;
    }

    public function removeQuoteArtisan(QuoteArtisan $quoteArtisan): self
    {
        if ($this->quoteArtisans->removeElement($quoteArtisan)) {
            // set the owning side to null (unless already changed)
            if ($quoteArtisan->getSpecificSetup() === $this) {
                $quoteArtisan->setSpecificSetup(null);
            }
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
            $adsVan->setSpecificSetup($this);
        }

        return $this;
    }

    public function removeAdsVan(AdsVan $adsVan): self
    {
        if ($this->adsVans->removeElement($adsVan)) {
            // set the owning side to null (unless already changed)
            if ($adsVan->getSpecificSetup() === $this) {
                $adsVan->setSpecificSetup(null);
            }
        }

        return $this;
    }
}