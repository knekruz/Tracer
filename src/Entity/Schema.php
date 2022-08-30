<?php

namespace App\Entity;

use App\Repository\SchemaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SchemaRepository::class)]
#[ORM\Table(name: "schemasdata")]
class Schema
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: TypeFrais::class, inversedBy: 'schemas')]
    #[ORM\JoinColumn(nullable: false)]
    private $typeFrais;

    #[ORM\ManyToOne(targetEntity: Periodicite::class, inversedBy: 'schemas')]
    #[ORM\JoinColumn(nullable: false)]
    private $periodicite;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\ManyToMany(targetEntity: Support::class, mappedBy: 'schemas')]
    private $supports;

    #[ORM\OneToMany(mappedBy: 'idSchema', targetEntity: SupportTaux::class, orphanRemoval: true)]
    private $supportTauxes;

    public function __construct()
    {
        $this->supports = new ArrayCollection();
        $this->supportTauxes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeFrais(): ?TypeFrais
    {
        return $this->typeFrais;
    }

    public function setTypeFrais(?TypeFrais $typeFrais): self
    {
        $this->typeFrais = $typeFrais;

        return $this;
    }

    public function getPeriodicite(): ?Periodicite
    {
        return $this->periodicite;
    }

    public function setPeriodicite(?Periodicite $periodicite): self
    {
        $this->periodicite = $periodicite;

        return $this;
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

    /**
     * @return Collection<int, Support>
     */
    public function getSupports(): Collection
    {
        return $this->supports;
    }

    public function addSupport(Support $support): self
    {
        if (!$this->supports->contains($support)) {
            $this->supports[] = $support;
            $support->addSchema($this);
        }

        return $this;
    }

    public function removeSupport(Support $support): self
    {
        $this->supports->removeElement($support);

        return $this;
    }

    /**
     * @return Collection<int, SupportTaux>
     */
    public function getSupportTauxes(): Collection
    {
        return $this->supportTauxes;
    }

    public function addSupportTaux(SupportTaux $supportTaux): self
    {
        if (!$this->supportTauxes->contains($supportTaux)) {
            $this->supportTauxes[] = $supportTaux;
            $supportTaux->setIdSchema($this);
        }

        return $this;
    }

    public function removeSupportTaux(SupportTaux $supportTaux): self
    {
        if ($this->supportTauxes->removeElement($supportTaux)) {
            // set the owning side to null (unless already changed)
            if ($supportTaux->getIdSchema() === $this) {
                $supportTaux->setIdSchema(null);
            }
        }

        return $this;
    }

}
