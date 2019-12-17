<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BillRepository")
 */
class Bill
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $purchasedate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $deliverydate;

    /**
     * @ORM\Column(type="float")
     */
    private $total_price;

    /**
     * @ORM\Column(type="integer")
     */
    private $total_quantity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bills")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", inversedBy="bills")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPurchasedate(): ?\DateTimeInterface
    {
        return $this->purchasedate;
    }

    public function setPurchasedate(\DateTimeInterface $purchasedate): self
    {
        $this->purchasedate = $purchasedate;

        return $this;
    }

    public function getDeliverydate(): ?\DateTimeInterface
    {
        return $this->deliverydate;
    }

    public function setDeliverydate(\DateTimeInterface $deliverydate): self
    {
        $this->deliverydate = $deliverydate;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->total_price;
    }

    public function setTotalPrice(float $total_price): self
    {
        $this->total_price = $total_price;

        return $this;
    }

    public function getTotalQuantity(): ?int
    {
        return $this->total_quantity;
    }

    public function setTotalQuantity(int $total_quantity): self
    {
        $this->total_quantity = $total_quantity;

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
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
        }

        return $this;
    }
}
