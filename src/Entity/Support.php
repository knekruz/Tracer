<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SupportRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: SupportRepository::class)]
#[UniqueEntity('isin')]
class Support
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Emetteur::class, inversedBy: 'supports')]
    #[ORM\JoinColumn(nullable: false)]
    private $emetteur;

    #[ORM\Column(type: 'string', length: 20)]
    private $isin;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'date', nullable: true)]
    private $datePremierInvestist;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dateFinInvest;

    #[ORM\Column(type: 'decimal', precision: 11, scale: 2, nullable: true)]
    private $montantInvest;

    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'supports')]
    private $categories;

    #[ORM\ManyToMany(targetEntity: Schema::class, inversedBy: 'supports')]
   private $schemas;

    #[ORM\OneToMany(mappedBy: 'idSupport', targetEntity: SupportTaux::class, orphanRemoval: true)]
    #[ORM\OrderBy(['debutCommerce' => 'DESC'])]
    private $supportTauxes;

    private $supportTauxesActuels;
    
    #[ORM\OneToMany(mappedBy: 'idSupport', targetEntity: SupportInvestissement::class, orphanRemoval: true)]
    private $supportInvestissements;

    private $supportInvestissementsActuels;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->schemas = new ArrayCollection();
        $this->supportTauxes = new ArrayCollection();
        $this->supportTauxesActuels = new ArrayCollection();
        $this->supportInvestissements = new ArrayCollection();
        $this->supportInvestissementsActuels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmetteur(): ?Emetteur
    {
        return $this->emetteur;
    }

    public function setEmetteur(?Emetteur $emetteur): self
    {
        $this->emetteur = $emetteur;

        return $this;
    }

    public function getIsin(): ?string
    {
        return $this->isin;
    }

    public function setIsin(string $isin): self
    {
        $this->isin = $isin;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDatePremierInvestist(): ?\DateTimeInterface
    {
        return $this->datePremierInvestist;
    }

    public function setDatePremierInvestist(\DateTimeInterface $datePremierInvestist): self
    {
        $this->datePremierInvestist = $datePremierInvestist;

        return $this;
    }

    public function getDateFinInvest(): ?\DateTimeInterface
    {
        return $this->dateFinInvest;
    }

    public function setDateFinInvest(?\DateTimeInterface $dateFinInvest): self
    {
        $this->dateFinInvest = $dateFinInvest;

        return $this;
    }

    public function getMontantInvest(): ?float
    {
        return $this->montantInvest;
    }

    public function setMontantInvest(float $montantInvest): self
    {
        $this->montantInvest = $montantInvest;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addSupport($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeSupport($this);
        }

        return $this;
    }
    

    /**
     * @return Collection<int, Schema>
     */
    public function getSchemas(): Collection
    {
        return $this->schemas;
    }

    public function addSchema(Schema $schema): self
    {
        if (!$this->schemas->contains($schema)) {
            $this->schemas[] = $schema;
            $schema->addSupport($this);
        }

        return $this;
    }

    public function removeSchema(Schema $schema): self
    {
        if ($this->schemas->removeElement($schema)) {
            $schema->removeSupport($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, SupportTaux>
     */
    public function getSupportTauxesActuels(): Collection
    {
        $res = $this->getSupportTauxes()->filter(
                function(SupportTaux $monSupportTaux) {
                    $auj = new \DateTime();
                    return $monSupportTaux->getDebutCommerce() < $auj
                    && $monSupportTaux->getFinCommerce() > $auj;
                });
        return $res;
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
            $supportTaux->setIdSupport($this);
        }

        return $this;
    }

    public function removeSupportTaux(SupportTaux $supportTaux): self
    {
        if ($this->supportTauxes->removeElement($supportTaux)) {
            // set the owning side to null (unless already changed)
            if ($supportTaux->getIdSupport() === $this) {
                $supportTaux->setIdSupport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SupportInvestissement>
     */
    public function getSupportInvestissements(): Collection
    {
        return $this->supportInvestissements;
    }

    /**
     * @return Collection<int, SupportInvestissement>
     */
    public function getSupportInvestissementsActuels(DateTime $debut, DateTime $fin): Collection
    {
        $res = $this->getSupportInvestissements()->filter(
            function(SupportInvestissement $monSupportInvest) use($debut, $fin) {
                return $monSupportInvest->getDatePos() >= $debut
                && $monSupportInvest->getDatePos() <= $fin;
            });
        return $res;
    }


    public function addSupportInvestissement(SupportInvestissement $supportInvestissement): self
    {
        if (!$this->supportInvestissements->contains($supportInvestissement)) {
            $this->supportInvestissements[] = $supportInvestissement;
            $supportInvestissement->setIdSupport($this);
        }

        return $this;
    }

    public function removeSupportInvestissement(SupportInvestissement $supportInvestissement): self
    {
        if ($this->supportInvestissements->removeElement($supportInvestissement)) {
            // set the owning side to null (unless already changed)
            if ($supportInvestissement->getIdSupport() === $this) {
                $supportInvestissement->setIdSupport(null);
            }
        }

        return $this;
    }
}
