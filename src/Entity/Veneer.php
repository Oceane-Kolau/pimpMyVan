<?php

namespace App\Entity;

use App\Repository\VeneerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VeneerRepository::class)
 */
class Veneer
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
     * @ORM\ManyToMany(targetEntity=QuoteArtisan::class, mappedBy="veneer")
     */
    private $quoteArtisans;

    /**
     * @ORM\ManyToMany(targetEntity=AdsVan::class, mappedBy="veneer")
     */
    private $adsVans;

    public function __construct()
    {
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
            $quoteArtisan->addVeneer($this);
        }

        return $this;
    }

    public function removeQuoteArtisan(QuoteArtisan $quoteArtisan): self
    {
        if ($this->quoteArtisans->removeElement($quoteArtisan)) {
            $quoteArtisan->removeVeneer($this);
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
            $adsVan->addVeneer($this);
        }

        return $this;
    }

    public function removeAdsVan(AdsVan $adsVan): self
    {
        if ($this->adsVans->removeElement($adsVan)) {
            $adsVan->removeVeneer($this);
        }

        return $this;
    }
}
