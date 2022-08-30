<?php

namespace App\Entity;

use App\Repository\SupportTauxRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SupportTauxRepository::class)]
class SupportTaux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Support::class, inversedBy: 'supportTauxes')]
    #[ORM\JoinColumn(nullable: false)]
    private $idSupport;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private $taux;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private $tauxEmetteur;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private $tauxCnp;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private $tauxDistributeur;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $partCnp;

    #[ORM\Column(type: 'date', nullable: true)]
    private $debutCommerce;

    #[ORM\Column(type: 'date', nullable: true)]
    private $finCommerce;

    #[ORM\ManyToOne(targetEntity: Schema::class, inversedBy: 'supportTauxes')]
    #[ORM\JoinColumn(nullable: false)]
    private $idSchema;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 6, nullable: true)]
    private $tauxMfex;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 6, nullable: true)]
    private $tauxBrut;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 6, nullable: true)]
    private $tauxNet;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSupport(): ?Support
    {
        return $this->idSupport;
    }

    public function setIdSupport(?Support $idSupport): self
    {
        $this->idSupport = $idSupport;

        return $this;
    }

    public function getTaux(): ?string
    {
        return $this->taux;
    }

    public function setTaux(?string $taux): self
    {
        $this->taux = $taux;

        return $this;
    }

    
    public function getTauxEmetteur(): ?string
    {
        return $this->tauxEmetteur;
    }

    public function setTauxEmetteur(string $tauxEmetteur): self
    {
        $this->tauxEmetteur = $tauxEmetteur;

        return $this;
    }

    public function getTauxCnp(): ?string
    {
        return $this->tauxCnp;
    }

    public function setTauxCnp(string $tauxCnp): self
    {
        $this->tauxCnp = $tauxCnp;

        return $this;
    }

    public function getTauxDistributeur(): ?string
    {
        return $this->tauxDistributeur;
    }

    public function setTauxDistributeur(string $tauxDistributeur): self
    {
        $this->tauxDistributeur = $tauxDistributeur;

        return $this;
    }

    public function getPartCnp(): ?string
    {
        return $this->partCnp;
    }

    public function setPartCnp(string $partCnp): self
    {
        $this->partCnp = $partCnp;

        return $this;
    }

    public function getDebutCommerce(): ?\DateTimeInterface
    {
        return $this->debutCommerce;
    }

    public function setDebutCommerce(?\DateTimeInterface $debutCommerce): self
    {
        $this->debutCommerce = $debutCommerce;

        return $this;
    }

    public function getFinCommerce(): ?\DateTimeInterface
    {
        return $this->finCommerce;
    }

    public function setFinCommerce(?\DateTimeInterface $finCommerce): self
    {
        $this->finCommerce = $finCommerce;

        return $this;
    }

    public function getIdSchema(): ?Schema
    {
        return $this->idSchema;
    }

    public function setIdSchema(?Schema $idSchema): self
    {
        $this->idSchema = $idSchema;

        return $this;
    }

    public function getTauxMfex(): ?string
    {
        return $this->tauxMfex;
    }

    public function setTauxMfex(?string $tauxMfex): self
    {
        $this->tauxMfex = $tauxMfex;

        return $this;
    }

    public function getTauxBrut(): ?string
    {
        return $this->tauxBrut;
    }

    public function setTauxBrut(?string $tauxBrut): self
    {
        $this->tauxBrut = $tauxBrut;

        return $this;
    }

    public function getTauxNet(): ?string
    {
        return $this->tauxNet;
    }

    public function setTauxNet(?string $tauxNet): self
    {
        $this->tauxNet = $tauxNet;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
