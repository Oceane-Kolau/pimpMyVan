<?php

namespace App\Entity;

use App\Repository\YearVanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=YearVanRepository::class)
 */
class YearVan
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=QuoteArtisan::class, mappedBy="yearVan")
     */
    private $quoteArtisans;

    /**
     * @ORM\OneToMany(targetEntity=AdsVan::class, mappedBy="yearVan")
     */
    private $adsVans;
    
    public function __toString()
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->quoteArtisans = new ArrayCollection();
        $this->adsVans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $quoteArtisan->setYearVan($this);
        }

        return $this;
    }

    public function removeQuoteArtisan(QuoteArtisan $quoteArtisan): self
    {
        if ($this->quoteArtisans->removeElement($quoteArtisan)) {
            // set the owning side to null (unless already changed)
            if ($quoteArtisan->getYearVan() === $this) {
                $quoteArtisan->setYearVan(null);
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
            $adsVan->setYearVan($this);
        }

        return $this;
    }

    public function removeAdsVan(AdsVan $adsVan): self
    {
        if ($this->adsVans->removeElement($adsVan)) {
            // set the owning side to null (unless already changed)
            if ($adsVan->getYearVan() === $this) {
                $adsVan->setYearVan(null);
            }
        }

        return $this;
    }
}
