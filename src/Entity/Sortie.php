<?php

namespace App\Entity;

use App\Repository\SortieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SortieRepository::class)]
class Sortie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\ManyToOne(inversedBy: 'sorties')]
    private ?Sens $sens = null;

    #[ORM\OneToMany(mappedBy: 'sortie', targetEntity: LigneSortie::class)]
    private Collection $ligneSorties;

    public function __construct()
    {
        $this->ligneSorties = new ArrayCollection();
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
     * @return Collection<int, LigneSortie>
     */
    public function getLigneSorties(): Collection
    {
        return $this->ligneSorties;
    }

    public function addLigneSorty(LigneSortie $ligneSorty): static
    {
        if (!$this->ligneSorties->contains($ligneSorty)) {
            $this->ligneSorties->add($ligneSorty);
            $ligneSorty->setSortie($this);
        }

        return $this;
    }

    public function removeLigneSorty(LigneSortie $ligneSorty): static
    {
        if ($this->ligneSorties->removeElement($ligneSorty)) {
            // set the owning side to null (unless already changed)
            if ($ligneSorty->getSortie() === $this) {
                $ligneSorty->setSortie(null);
            }
        }

        return $this;
    }
}
