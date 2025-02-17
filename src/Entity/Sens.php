<?php

namespace App\Entity;

use App\Repository\SensRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SensRepository::class)]
class Sens
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $sens = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    // #[ORM\OneToMany(mappedBy: 'sens', targetEntity: Entree::class)]
    // private Collection $entrees;

    // #[ORM\OneToMany(mappedBy: 'sens', targetEntity: Sortie::class)]
    // private Collection $sorties;

    #[ORM\OneToMany(mappedBy: 'sens', targetEntity: Mouvement::class)]
    private Collection $mouvements;

    public function __construct()
    {
        // $this->entrees = new ArrayCollection();
        // $this->sorties = new ArrayCollection();
        $this->mouvements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSens(): ?int
    {
        return $this->sens;
    }

    public function setSens(int $sens): static
    {
        $this->sens = $sens;

        return $this;
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

    // /**
    //  * @return Collection<int, Entree>
    //  */
    // public function getEntrees(): Collection
    // {
    //     return $this->entrees;
    // }

    // public function addEntree(Entree $entree): static
    // {
    //     if (!$this->entrees->contains($entree)) {
    //         $this->entrees->add($entree);
    //         $entree->setSens($this);
    //     }

    //     return $this;
    // }

    // public function removeEntree(Entree $entree): static
    // {
    //     if ($this->entrees->removeElement($entree)) {
    //         // set the owning side to null (unless already changed)
    //         if ($entree->getSens() === $this) {
    //             $entree->setSens(null);
    //         }
    //     }

    //     return $this;
    // }

    // /**
    //  * @return Collection<int, Sortie>
    //  */
    // public function getSorties(): Collection
    // {
    //     return $this->sorties;
    // }

    // public function addSorty(Sortie $sorty): static
    // {
    //     if (!$this->sorties->contains($sorty)) {
    //         $this->sorties->add($sorty);
    //         $sorty->setSens($this);
    //     }

    //     return $this;
    // }

    // public function removeSorty(Sortie $sorty): static
    // {
    //     if ($this->sorties->removeElement($sorty)) {
    //         // set the owning side to null (unless already changed)
    //         if ($sorty->getSens() === $this) {
    //             $sorty->setSens(null);
    //         }
    //     }

    //     return $this;
    // }

    /**
     * @return Collection<int, Mouvement>
     */
    public function getMouvements(): Collection
    {
        return $this->mouvements;
    }

    public function addMouvement(Mouvement $mouvement): static
    {
        if (!$this->mouvements->contains($mouvement)) {
            $this->mouvements->add($mouvement);
            $mouvement->setSens($this);
        }

        return $this;
    }

    public function removeMouvement(Mouvement $mouvement): static
    {
        if ($this->mouvements->removeElement($mouvement)) {
            // set the owning side to null (unless already changed)
            if ($mouvement->getSens() === $this) {
                $mouvement->setSens(null);
            }
        }

        return $this;
    }
}
