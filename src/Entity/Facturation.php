<?php

namespace App\Entity;

use App\Repository\FacturationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FacturationRepository::class)
 */
class Facturation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Vehicule::class, inversedBy="facturation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idV;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="facturations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idC;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateD;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateF;

    /**
     * @ORM\Column(type="float")
     */
    private $valeur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdV(): ?Vehicule
    {
        return $this->idV;
    }

    public function setIdV(?Vehicule $idV): self
    {
        $this->idV = $idV;

        return $this;
    }

    public function getIdC(): ?Utilisateur
    {
        return $this->idC;
    }

    public function setIdC(?Utilisateur $idC): self
    {
        $this->idC = $idC;

        return $this;
    }

    public function getDateD(): ?\DateTimeInterface
    {
        return $this->dateD;
    }

    public function setDateD(\DateTimeInterface $dateD): self
    {
        $this->dateD = $dateD;

        return $this;
    }

    public function getDateF(): ?\DateTimeInterface
    {
        return $this->dateF;
    }

    public function setDateF(\DateTimeInterface $dateF): self
    {
        $this->dateF = $dateF;

        return $this;
    }

    public function getValeur(): ?float
    {
        return $this->valeur;
    }

    public function setValeur(float $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
    

    public function __toString()
    {
        return $this->getId();
    }
  
    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
