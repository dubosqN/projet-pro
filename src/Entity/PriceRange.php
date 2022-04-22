<?php

namespace App\Entity;

use App\Repository\PriceRangeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PriceRangeRepository::class)
 */
class PriceRange
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"searchable"})
     */
    private $priceRange;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="priceRange")
     */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPriceRange(): ?string
    {
        return $this->priceRange;
    }

    public function setPriceRange(?string $priceRange): self
    {
        $this->priceRange = $priceRange;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setPriceRange($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getPriceRange() === $this) {
                $produit->setPriceRange(null);
            }
        }

        return $this;
    }

    public function __toString(): ?string
    {
        return $this->getPriceRange();
    }
}
