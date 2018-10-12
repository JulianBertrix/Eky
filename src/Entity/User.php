<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *  message = "Le champs est requis et ne peut être vide"
     * )
     * @Assert\NotNull(
     *  message = "Le champs est requis et ne peut être vide"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *  message = "Le champs est requis et ne peut être vide"
     * )
     * @Assert\NotNull(
     *  message = "Le champs est requis et ne peut être vide"
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *  message = "Le champs est requis et ne peut être vide"
     * )
     * @Assert\NotNull(
     *  message = "Le champs est requis et ne peut être vide"
     * )
     * @Assert\Email(
     *     message = "L'adresse email '{{ value }}' n'est pas valide.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *  message = "Le champs est requis et ne peut être vide"
     * )
     * @Assert\NotNull(
     *  message = "Le champs est requis et ne peut être vide"
     * )
     */
    private $adresse;

    /**
     * @Assert\NotBlank(
     *  message = "Le champs est requis et ne peut être vide"
     * )
     * @Assert\NotNull(
     *  message = "Le champs est requis et ne peut être vide"
     * )
     * @Assert\Length(
     *      min = 10,
     *      max = 10,
     *      minMessage = "Veuillez entrer un numéro de téléphone valide",
     *      maxMessage = "Veuillez entrer un numéro de téléphone valide"
     * )
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
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeUser", inversedBy="users", cascade={"persist", "remove"})
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

    /**
     * @Assert\NotBlank(
     *  message = "Le champs est requis et ne peut être vide"
     * )
     * @Assert\NotNull(
     *  message = "Le champs est requis et ne peut être vide"
     * )
     * @Assert\Length(max=4096)
     */
    private $VerifPassword;

    private $isPro;

    private $username;


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

    public function getVerifPassword(): ?string
    {
        return $this->VerifPassword;
    }

    public function setVerifPassword(?string $VerifPassword): self
    {
        $this->VerifPassword = $VerifPassword;

        return $this;
    }

    public function getSalt()
    {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function getRoles()
    {
        $role = $this->type_user_id;
        switch($role){
            case '1':
                return ['ROLE_ADMIN'];
                break;
            case '2':
                return ['ROLE_USER'];
                break;
            case '3':
                return ['ROLE_COM'];
                break;
        }
        return [
            'ROLE_USER'
        ];
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
    }

    public function getIsPro(): ?bool
    {
        return $this->isPro;
    }

    public function setIsPro(bool $isPro): self
    {
        $this->isPro = $isPro;

        return $this;
    }
}
