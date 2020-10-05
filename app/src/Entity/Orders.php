<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OrdersRepository::class)
 * @UniqueEntity("order_id")
 */
class Orders
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15, unique=true)
     */
    private $orderId;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $shippingStatus;

    /**
     * @ORM\Column(type="float")
     */
    private $shippingPrice;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $shippingPaymentStatus;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $paymentStatus;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $currency;

    /**
     * @ORM\OneToMany(targetEntity=OrderElements::class, mappedBy="orderId", orphanRemoval=true)
     */
    private $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function setOrderId(string $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getShippingStatus(): ?string
    {
        return $this->shippingStatus;
    }

    public function setShippingStatus(string $shippingStatus): self
    {
        $this->shippingStatus = $shippingStatus;

        return $this;
    }

    public function getShippingPrice(): ?float
    {
        return $this->shippingPrice;
    }

    public function setShippingPrice(float $shippingPrice): self
    {
        $this->shippingPrice = $shippingPrice;

        return $this;
    }

    public function getShippingPaymentStatus(): ?string
    {
        return $this->shippingPaymentStatus;
    }

    public function setShippingPaymentStatus(string $shippingPaymentStatus): self
    {
        $this->shippingPaymentStatus = $shippingPaymentStatus;

        return $this;
    }

    public function getPaymentStatus(): ?string
    {
        return $this->paymentStatus;
    }

    public function setPaymentStatus(string $paymentStatus): self
    {
        $this->paymentStatus = $paymentStatus;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return Collection|OrderElements[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(OrderElements $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setOrderId($this);
        }

        return $this;
    }

    public function removeItem(OrderElements $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getOrderId() === $this) {
                $item->setOrderId(null);
            }
        }

        return $this;
    }
}
