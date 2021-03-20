<?php

namespace App\Entity;

use App\Repository\FloorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FloorRepository::class)
 */
class Floor
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
     * @ORM\OneToMany(targetEntity=QuoteArtisan::class, mappedBy="floor")
     */
    private $quoteArtisans;

    /**
     * @ORM\OneToMany(targetEntity=AdsVan::class, mappedBy="floor")
     */
    private $adsVans;

    public function __toString()
    {
        return $this->type;
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
            $quoteArtisan->setFloor($this);
        }

        return $this;
    }

    public function removeQuoteArtisan(QuoteArtisan $quoteArtisan): self
    {
        if ($this->quoteArtisans->removeElement($quoteArtisan)) {
            // set the owning side to null (unless already changed)
            if ($quoteArtisan->getFloor() === $this) {
                $quoteArtisan->setFloor(null);
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
            $adsVan->setFloor($this);
        }

        return $this;
    }

    public function removeAdsVan(AdsVan $adsVan): self
    {
        if ($this->adsVans->removeElement($adsVan)) {
            // set the owning side to null (unless already changed)
            if ($adsVan->getFloor() === $this) {
                $adsVan->setFloor(null);
            }
        }

        return $this;
    }
}
