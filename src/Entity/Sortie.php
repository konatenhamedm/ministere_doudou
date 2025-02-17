<?php

namespace App\Entity;

use App\Repository\SortieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: SortieRepository::class)]
class Sortie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    // #[ORM\ManyToOne(inversedBy: 'sorties')]
    // private ?Sens $sens = null;

    // #[ORM\OneToMany(mappedBy: 'sortie', targetEntity: LigneSortie::class, cascade: ['persist', 'remove'])]
    // private Collection $ligneSorties;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Gedmo\Timestampable(on: "create")]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(mappedBy: 'sortie', targetEntity: LigneSortie::class, cascade: ['persist', 'remove'])]
    private Collection $lignesorties;

    public function __construct()
    {
        // $this->ligneSorties = new ArrayCollection();
        $this->lignesorties = new ArrayCollection();
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

    // public function getSens(): ?Sens
    // {
    //     return $this->sens;
    // }

    // public function setSens(?Sens $sens): static
    // {
    //     $this->sens = $sens;

    //     return $this;
    // }

   

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, LigneSortie>
     */
    public function getLignesorties(): Collection
    {
        return $this->lignesorties;
    }

    public function addLignesorty(LigneSortie $lignesorty): static
    {
        if (!$this->lignesorties->contains($lignesorty)) {
            $this->lignesorties->add($lignesorty);
            $lignesorty->setSortie($this);
        }

        return $this;
    }

    public function removeLignesorty(LigneSortie $lignesorty): static
    {
        if ($this->lignesorties->removeElement($lignesorty)) {
            // set the owning side to null (unless already changed)
            if ($lignesorty->getSortie() === $this) {
                $lignesorty->setSortie(null);
            }
        }

        return $this;
    }
}
