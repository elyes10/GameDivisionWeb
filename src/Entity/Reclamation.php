<?php

//namespace App\Controller;
namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Validator as AcmeAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ID_U;

    /**
     * @Assert\NotBlank
     * @AcmeAssert\CheckContent
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Contenu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Please upload image")
     * @Assert\File(mimeTypes={"image/jpeg"})
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $traite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getID_U(): ?int
    {
        return $this->ID_U;
    }

    public function setID_U(?int $ID_U): self
    {
        $this->ID_U = $ID_U;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->Contenu;
    }

    public function setContenu(?string $Contenu): self
    {
        $this->Contenu = $Contenu;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(?string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTraite(): ?string
    {
        return $this->traite;
    }

    public function setTraite(?string $traite): self
    {
        $this->traite = $traite;

        return $this;
    }
}
