<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeDechetRepository")
 */
class TypeDechet
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
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dechet", mappedBy="type_dechet_id")
     */
    private $dechets;

    /**
     * @ORM\Column(type="integer")
     */
    private $conversion;

    public function __construct()
    {
        $this->dechets = new ArrayCollection();
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
            $dechet->setTypeDechetId($this);
        }

        return $this;
    }

    public function removeDechet(Dechet $dechet): self
    {
        if ($this->dechets->contains($dechet)) {
            $this->dechets->removeElement($dechet);
            // set the owning side to null (unless already changed)
            if ($dechet->getTypeDechetId() === $this) {
                $dechet->setTypeDechetId(null);
            }
        }

        return $this;
    }

    public function getConversion(): ?int
    {
        return $this->conversion;
    }

    public function setConversion(int $conversion): self
    {
        $this->conversion = $conversion;

        return $this;
    }
}
