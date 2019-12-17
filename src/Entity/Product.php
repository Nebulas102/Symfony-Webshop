<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $specifications;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="float")
     */
    private $height;

    /**
     * @ORM\Column(type="float")
     */
    private $length;

    /**
     * @ORM\Column(type="float")
     */
    private $width;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UnitMeasure", inversedBy="products")
     */
    private $um_dimension;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UnitMeasure", inversedBy="products")
     */
    private $um_weight;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Discount", inversedBy="products")
     */
    private $discount;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\PriceProduct", cascade={"persist", "remove"})
     */
    private $price;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AvailabilityProduct", cascade={"persist", "remove"})
     */
    private $available;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Bill", mappedBy="products")
     */
    private $bills;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inventory", mappedBy="product")
     */
    private $inventories;

    public function __construct()
    {
        $this->bills = new ArrayCollection();
        $this->inventories = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSpecifications(): ?string
    {
        return $this->specifications;
    }

    public function setSpecifications(string $specifications): self
    {
        $this->specifications = $specifications;

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

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(float $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(float $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getUmDimension(): ?UnitMeasure
    {
        return $this->um_dimension;
    }

    public function setUmDimension(?UnitMeasure $um_dimension): self
    {
        $this->um_dimension = $um_dimension;

        return $this;
    }

    public function getUmWeight(): ?UnitMeasure
    {
        return $this->um_weight;
    }

    public function setUmWeight(?UnitMeasure $um_weight): self
    {
        $this->um_weight = $um_weight;

        return $this;
    }

    public function getDiscount(): ?Discount
    {
        return $this->discount;
    }

    public function setDiscount(?Discount $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getPrice(): ?PriceProduct
    {
        return $this->price;
    }

    public function setPrice(?PriceProduct $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getAvailable(): ?AvailabilityProduct
    {
        return $this->available;
    }

    public function setAvailable(?AvailabilityProduct $available): self
    {
        $this->available = $available;

        return $this;
    }

    /**
     * @return Collection|Bill[]
     */
    public function getBills(): Collection
    {
        return $this->bills;
    }

    public function addBill(Bill $bill): self
    {
        if (!$this->bills->contains($bill)) {
            $this->bills[] = $bill;
            $bill->addProduct($this);
        }

        return $this;
    }

    public function removeBill(Bill $bill): self
    {
        if ($this->bills->contains($bill)) {
            $this->bills->removeElement($bill);
            $bill->removeProduct($this);
        }

        return $this;
    }

    /**
     * @return Collection|Inventory[]
     */
    public function getInventories(): Collection
    {
        return $this->inventories;
    }

    public function addInventory(Inventory $inventory): self
    {
        if (!$this->inventories->contains($inventory)) {
            $this->inventories[] = $inventory;
            $inventory->setProduct($this);
        }

        return $this;
    }

    public function removeInventory(Inventory $inventory): self
    {
        if ($this->inventories->contains($inventory)) {
            $this->inventories->removeElement($inventory);
            // set the owning side to null (unless already changed)
            if ($inventory->getProduct() === $this) {
                $inventory->setProduct(null);
            }
        }

        return $this;
    }
}
