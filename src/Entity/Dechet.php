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
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeDechet", inversedBy="dechets", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_dechet_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Particulier", inversedBy="dechets", cascade={"persist", "remove"})
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

    /*
     * @param $poid
     * @param $type
     * 100 g de dechet animal = 5point ,5g = 1point
     * 100 g de dechet vegetal = 10points 10g = 1point
     * cette fonction permet de covertir le pod des dechet en point et de
     * retourner un tableau associatifs contenant la valeur des points arrondie et du reste des points
     * dans le cas ou il reste des chiffres après la virgule
     */

    public function ConvertisseurPoint($poid,$type){

        $tableau = array();

        //si c'est un type vegetal
        if($type ==="animal"){

            $point = $poid / 20;

            //floor permet de d'arrondir la valeur au plus bas que je convertie en integer, ce qui me donne l'arrodie de m'a valeur
            $arrondie = floor($point);

            $reste = $point - $arrondie;

                $tableau["point Arondie"] = (int)$arrondie;
                $tableau["reste"] = $reste;

                return $tableau;

            return $tableau;
        }

        //si c'est un type animal meme procédé
        if ($type === "vegetal"){

             $point = $poid / 10;

            $arrondie = (int)floor($point);
            $reste = $point - $arrondie;

            $tableau["point Arondie"] = $arrondie;
            $tableau["reste"] = $reste;

            return $tableau;
        }

    }
}
