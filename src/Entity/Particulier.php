<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParticulierRepository")
 */
class Particulier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_point;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="particulier", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dechet", mappedBy="particulier_id")
     */
    private $dechets;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Coupon", mappedBy="particulier_id")
     */
    private $coupons;

    public function __construct()
    {
        $this->dechets = new ArrayCollection();
        $this->coupons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombrePoint(): ?int
    {
        return $this->nombre_point;
    }

    public function setNombrePoint(int $nombre_point): self
    {
        $this->nombre_point = $nombre_point;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return Collection|Dechet[]
     */
    public function getDechets(): Collection
    {
        return $this->dechets;
    }

    public function addDechet(Dechet $dechet): self
    {
        if (!$this->dechets->contains($dechet)) {
            $this->dechets[] = $dechet;
            $dechet->setParticulierId($this);
        }

        return $this;
    }

    public function removeDechet(Dechet $dechet): self
    {
        if ($this->dechets->contains($dechet)) {
            $this->dechets->removeElement($dechet);
            // set the owning side to null (unless already changed)
            if ($dechet->getParticulierId() === $this) {
                $dechet->setParticulierId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Coupon[]
     */
    public function getCoupons(): Collection
    {
        return $this->coupons;
    }

    public function addCoupon(Coupon $coupon): self
    {
        if (!$this->coupons->contains($coupon)) {
            $this->coupons[] = $coupon;
            $coupon->setParticulierId($this);
        }

        return $this;
    }

    public function removeCoupon(Coupon $coupon): self
    {
        if ($this->coupons->contains($coupon)) {
            $this->coupons->removeElement($coupon);
            // set the owning side to null (unless already changed)
            if ($coupon->getParticulierId() === $this) {
                $coupon->setParticulierId(null);
            }
        }

        return $this;
    }
}
