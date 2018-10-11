<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CouponRepository")
 */
class Coupon
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commercant", inversedBy="coupons", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commercant_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Particulier", inversedBy="coupons", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $particulier_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $code_promo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_used;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommercantId(): ?Commercant
    {
        return $this->commercant_id;
    }

    public function setCommercantId(?Commercant $commercant_id): self
    {
        $this->commercant_id = $commercant_id;

        return $this;
    }

    public function getParticulierId(): ?Particulier
    {
        return $this->particulier_id;
    }

    public function setParticulierId(?Particulier $particulier_id): self
    {
        $this->particulier_id = $particulier_id;

        return $this;
    }

    public function getCodePromo(): ?int
    {
        return $this->code_promo;
    }

    public function setCodePromo(int $code_promo): self
    {
        $this->code_promo = $code_promo;

        return $this;
    }

    public function getIsUsed(): ?bool
    {
        return $this->is_used;
    }

    public function setIsUsed(bool $is_used): self
    {
        $this->is_used = $is_used;

        return $this;
    }
}
