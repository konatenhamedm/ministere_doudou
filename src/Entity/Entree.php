<?php

namespace App\Entity;

use App\Repository\EntreeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntreeRepository::class)]
class Entree
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\ManyToOne(inversedBy: 'entrees')]
    private ?Sens $sens = null;

    #[ORM\OneToMany(mappedBy: 'entree', targetEntity: LigneEntree::class)]
    private Collection $ligneEntrees;

    public function __construct()
    {
        $this->ligneEntrees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getSens(): ?Sens
    {
        return $this->sens;
    }

    public function setSens(?Sens $sens): static
    {
        $this->sens = $sens;

        return $this;
    }

    /**
     * @return Collection<int, LigneEntree>
     */
    public function getLigneEntrees(): Collection
    {
        return $this->ligneEntrees;
    }

    public function addLigneEntree(LigneEntree $ligneEntree): static
    {
        if (!$this->ligneEntrees->contains($ligneEntree)) {
            $this->ligneEntrees->add($ligneEntree);
            $ligneEntree->setEntree($this);
        }

        return $this;
    }

    public function removeLigneEntree(LigneEntree $ligneEntree): static
    {
        if ($this->ligneEntrees->removeElement($ligneEntree)) {
            // set the owning side to null (unless already changed)
            if ($ligneEntree->getEntree() === $this) {
                $ligneEntree->setEntree(null);
            }
        }

        return $this;
    }
}
