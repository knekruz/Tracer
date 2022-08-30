<?php

namespace App\Entity;

use App\Repository\SupportInvestissementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SupportInvestissementRepository::class)]
class SupportInvestissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Support::class, inversedBy: 'supportInvestissements')]
    #[ORM\JoinColumn(nullable: false)]
    private $idSupport;

    #[ORM\Column(type: 'integer')]
    private $idInvest;

    #[ORM\Column(type: 'date')]
    private $datePos;

    #[ORM\Column(type: 'decimal', precision: 11, scale: 2)]
    private $montantNet;

    #[ORM\Column(type: 'decimal', precision: 11, scale: 2)]
    private $qteNet;

    #[ORM\Column(type: 'decimal', precision: 11, scale: 2)]
    private $valeurUc;

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

    public function getIdInvest(): ?int
    {
        return $this->idInvest;
    }

    public function setIdInvest(int $idInvest): self
    {
        $this->idInvest = $idInvest;

        return $this;
    }

    public function getDatePos(): ?\DateTimeInterface
    {
        return $this->datePos;
    }

    public function setDatePos(\DateTimeInterface $datePos): self
    {
        $this->datePos = $datePos;

        return $this;
    }

    public function getMontantNet(): ?float
    {
        return $this->montantNet;
    }

    public function setMontantNet(float $montantNet): self
    {
        $this->montantNet = $montantNet;

        return $this;
    }

    public function getQteNet(): ?float
    {
        return $this->qteNet;
    }

    public function setQteNet(float $qteNet): self
    {
        $this->qteNet = $qteNet;

        return $this;
    }

    public function getValeurUc(): ?float
    {
        return $this->valeurUc;
    }

    public function setValeurUc(float $valeurUc): self
    {
        $this->valeurUc = $valeurUc;

        return $this;
    }
}
