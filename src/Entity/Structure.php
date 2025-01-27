<?php

namespace App\Entity;

use App\Repository\StructureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StructureRepository::class)]
class Structure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $nombreMembre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column]
    private ?bool $etatCreation = null;

    #[ORM\OneToMany(mappedBy: 'structure', targetEntity: ReunionStructure::class)]
    private Collection $reunionStructures;

    public function __construct()
    {
        $this->reunionStructures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreMembre(): ?int
    {
        return $this->nombreMembre;
    }

    public function setNombreMembre(int $nombreMembre): static
    {
        $this->nombreMembre = $nombreMembre;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function isEtatCreation(): ?bool
    {
        return $this->etatCreation;
    }

    public function setEtatCreation(bool $etatCreation): static
    {
        $this->etatCreation = $etatCreation;

        return $this;
    }

    /**
     * @return Collection<int, ReunionStructure>
     */
    public function getReunionStructures(): Collection
    {
        return $this->reunionStructures;
    }

    public function addReunionStructure(ReunionStructure $reunionStructure): static
    {
        if (!$this->reunionStructures->contains($reunionStructure)) {
            $this->reunionStructures->add($reunionStructure);
            $reunionStructure->setStructure($this);
        }

        return $this;
    }

    public function removeReunionStructure(ReunionStructure $reunionStructure): static
    {
        if ($this->reunionStructures->removeElement($reunionStructure)) {
            // set the owning side to null (unless already changed)
            if ($reunionStructure->getStructure() === $this) {
                $reunionStructure->setStructure(null);
            }
        }

        return $this;
    }
}
