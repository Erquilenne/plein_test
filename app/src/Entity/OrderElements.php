<?php

namespace App\Entity;

use App\Repository\OrderElementsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderElementsRepository::class)
 */
class OrderElements
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $barcode;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="float")
     */
    private $cost;

    /**
     * @ORM\Column(type="integer")
     */
    private $taxPerc;

    /**
     * @ORM\Column(type="float")
     */
    private $taxAmt;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $trackingNumber;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $canceled;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $ShippedStatusSku;

    /**
     * @ORM\ManyToOne(targetEntity=Orders::class, inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderId;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBarcode(): ?int
    {
        return $this->barcode;
    }

    public function setBarcode(int $barcode): self
    {
        $this->barcode = $barcode;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(float $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getTaxPerc(): ?int
    {
        return $this->taxPerc;
    }

    public function setTaxPerc(int $taxPerc): self
    {
        $this->taxPerc = $taxPerc;

        return $this;
    }

    public function getTaxAmt(): ?float
    {
        return $this->taxAmt;
    }

    public function setTaxAmt(float $taxAmt): self
    {
        $this->taxAmt = $taxAmt;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    public function setTrackingNumber(string $trackingNumber): self
    {
        $this->trackingNumber = $trackingNumber;

        return $this;
    }

    public function getCanceled(): ?string
    {
        return $this->canceled;
    }

    public function setCanceled(string $canceled): self
    {
        $this->canceled = $canceled;

        return $this;
    }

    public function getShippedStatusSku(): ?string
    {
        return $this->ShippedStatusSku;
    }

    public function setShippedStatusSku(string $ShippedStatusSku): self
    {
        $this->ShippedStatusSku = $ShippedStatusSku;

        return $this;
    }

    public function getOrderId(): ?Orders
    {
        return $this->orderId;
    }

    public function setOrderId(?Orders $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

}
