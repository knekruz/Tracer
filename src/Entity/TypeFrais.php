<?php

namespace App\Entity;

use App\Repository\TypeFraisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeFraisRepository::class)]
class TypeFrais
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\OneToMany(mappedBy: 'typeFrais', targetEntity: Schema::class)]
    private $schemas;

    public function __construct()
    {
        $this->schemas = new ArrayCollection();
    }

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
            $schema->setTypeFrais($this);
        }

        return $this;
    }

    public function removeSchema(Schema $schema): self
    {
        if ($this->schemas->removeElement($schema)) {
            // set the owning side to null (unless already changed)
            if ($schema->getTypeFrais() === $this) {
                $schema->setTypeFrais(null);
            }
        }

        return $this;
    }
}
