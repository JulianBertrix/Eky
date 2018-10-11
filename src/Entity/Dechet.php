<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DechetRepository")
 */
class Dechet
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
    private $quantite_utilise;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeDechet", inversedBy="dechets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_dechet_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Particulier", inversedBy="dechets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $particulier_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantiteUtilise(): ?int
    {
        return $this->quantite_utilise;
    }

    public function setQuantiteUtilise(int $quantite_utilise): self
    {
        $this->quantite_utilise = $quantite_utilise;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getTypeDechetId(): ?TypeDechet
    {
        return $this->type_dechet_id;
    }

    public function setTypeDechetId(?TypeDechet $type_dechet_id): self
    {
        $this->type_dechet_id = $type_dechet_id;

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

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }
}
