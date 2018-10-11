<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user_code;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeUser", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_user_id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Particulier", mappedBy="user_id", cascade={"persist", "remove"})
     */
    private $particulier;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Commercant", mappedBy="user_id", cascade={"persist", "remove"})
     */
    private $commercant;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUserCode(): ?string
    {
        return $this->user_code;
    }

    public function setUserCode(string $user_code): self
    {
        $this->user_code = $user_code;

        return $this;
    }

    public function getTypeUserId(): ?TypeUser
    {
        return $this->type_user_id;
    }

    public function setTypeUserId(?TypeUser $type_user_id): self
    {
        $this->type_user_id = $type_user_id;

        return $this;
    }

    public function getParticulier(): ?Particulier
    {
        return $this->particulier;
    }

    public function setParticulier(Particulier $particulier): self
    {
        $this->particulier = $particulier;

        // set the owning side of the relation if necessary
        if ($this !== $particulier->getUserId()) {
            $particulier->setUserId($this);
        }

        return $this;
    }

    public function getCommercant(): ?Commercant
    {
        return $this->commercant;
    }

    public function setCommercant(Commercant $commercant): self
    {
        $this->commercant = $commercant;

        // set the owning side of the relation if necessary
        if ($this !== $commercant->getUserId()) {
            $commercant->setUserId($this);
        }

        return $this;
    }
}
