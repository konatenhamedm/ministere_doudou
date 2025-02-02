<?php

namespace App\Entity;

use App\Repository\OrdreJourRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdreJourRepository::class)]
class OrdreJour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $libOrdreJour = null;
    
    #[ORM\Column]
    private ?int $numOrdreJour = null;

   

    // #[ORM\OneToMany(mappedBy: 'point', targetEntity: Rapportage::class,cascade:['persist','remove'])]
    // private Collection $rapportages;

    #[ORM\ManyToOne(inversedBy: 'points', cascade: ['persist'])]
    private ?Reunion $reunion = null;

    #[ORM\OneToMany(mappedBy: 'points', targetEntity: Diligence::class, cascade: ['persist', 'remove'])]
    private Collection $diligences;

    public function __construct()
    {
        // $this->rapportages = new ArrayCollection();
        $this->diligences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibOrdreJour(): ?string
    {
        return $this->libOrdreJour;
    }

    public function setLibOrdreJour(string $libOrdreJour): static
    {
        $this->libOrdreJour = $libOrdreJour;

        return $this;
    }

    public function getNumOrdreJour(): ?int
    {
        return $this->numOrdreJour;
    }

    public function setNumOrdreJour(int $numOrdreJour): static
    {
        $this->numOrdreJour = $numOrdreJour;

        return $this;
    } 

    // /**
    //  * @return Collection<int, Rapportage>
    //  */
    // public function getRapportages(): Collection
    // {
    //     return $this->rapportages;
    // }

    // public function addRapportage(Rapportage $rapportage): static
    // {
    //     if (!$this->rapportages->contains($rapportage)) {
    //         $this->rapportages->add($rapportage);
    //         $rapportage->setPoint($this);
    //     }

    //     return $this;
    // }

    // public function removeRapportage(Rapportage $rapportage): static
    // {
    //     if ($this->rapportages->removeElement($rapportage)) {
    //         // set the owning side to null (unless already changed)
    //         if ($rapportage->getPoint() === $this) {
    //             $rapportage->setPoint(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getReunion(): ?Reunion
    {
        return $this->reunion;
    }

    public function setReunion(?Reunion $reunion): static
    {
        $this->reunion = $reunion;

        return $this;
    }

    /**
     * @return Collection<int, Diligence>
     */
    public function getDiligences(): Collection
    {
        return $this->diligences;
    }

    public function addDiligence(Diligence $diligence): static
    {
        if (!$this->diligences->contains($diligence)) {
            $this->diligences->add($diligence);
            $diligence->setPoints($this);
        }

        return $this;
    }

    public function removeDiligence(Diligence $diligence): static
    {
        if ($this->diligences->removeElement($diligence)) {
            // set the owning side to null (unless already changed)
            if ($diligence->getPoints() === $this) {
                $diligence->setPoints(null);
            }
        }

        return $this;
    }
}
