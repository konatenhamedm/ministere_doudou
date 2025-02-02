<?php

namespace App\Entity;

use App\Repository\ReunionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReunionRepository::class)]
class Reunion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libReunion = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateReunion = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heureDebut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heureFin = null;

    #[ORM\ManyToOne(inversedBy: 'reunions', cascade: ['persist'])]
    private ?Salle $salle = null;



    #[ORM\OneToMany(mappedBy: 'reunion', targetEntity: Employe::class, cascade: ['persist', 'remove'])]
    private Collection $participants;


    // #[ORM\OneToMany(mappedBy: 'reunion', targetEntity: Rapportage::class,cascade: ['persist', 'remove'])]
    // private Collection $rapportages;

    // #[ORM\OneToMany(mappedBy: 'reunion', targetEntity: Diligence::class,cascade: ['persist', 'remove'])]
    // private Collection $diligences;

    #[ORM\ManyToOne(inversedBy: 'reunions',cascade: ['persist'])]
    private ?Employe $president = null;

    #[ORM\OneToMany(mappedBy: 'reunion', targetEntity: HistoriqueReunion::class,cascade: ['persist', 'remove'])]
    private Collection $historiqueReunions;

    #[ORM\OneToMany(mappedBy: 'reunion', targetEntity: OrdreJour::class, cascade: ['persist', 'remove'])]
    private Collection $points;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
        // $this->diligences = new ArrayCollection();
        // $this->historiqueReunions = new ArrayCollection();
        $this->points = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibReunion(): ?string
    {
        return $this->libReunion;
    }

    public function setLibReunion(string $libReunion): static
    {
        $this->libReunion = $libReunion;

        return $this;
    }

    public function getDateReunion(): ?\DateTimeInterface
    {
        return $this->dateReunion;
    }

    public function setDateReunion(\DateTimeInterface $dateReunion): static
    {
        $this->dateReunion = $dateReunion;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $heureDebut): static
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heureFin;
    }

    public function setHeureFin(\DateTimeInterface $heureFin): static
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): static
    {
        $this->salle = $salle;

        return $this;
    }



    /**
     * @return Collection<int, Employe>
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Employe $participant): static
    {
        if (!$this->participants->contains($participant)) {
            $this->participants->add($participant);
            $participant->setReunion($this);
        }

        return $this;
    }

    public function removeParticipant(Employe $participant): static
    {
        if ($this->participants->removeElement($participant)) {
            // set the owning side to null (unless already changed)
            if ($participant->getReunion() === $this) {
                $participant->setReunion(null);
            }
        }

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
    //         $rapportage->setReunion($this);
    //     }

    //     return $this;
    // }

    // public function removeRapportage(Rapportage $rapportage): static
    // {
    //     if ($this->rapportages->removeElement($rapportage)) {
    //         // set the owning side to null (unless already changed)
    //         if ($rapportage->getReunion() === $this) {
    //             $rapportage->setReunion(null);
    //         }
    //     }

    //     return $this;
    // }

    // /**
    //  * @return Collection<int, Diligence>
    //  */
    // public function getDiligences(): Collection
    // {
    //     return $this->diligences;
    // }

    // public function addDiligence(Diligence $diligence): static
    // {
    //     if (!$this->diligences->contains($diligence)) {
    //         $this->diligences->add($diligence);
    //         $diligence->setReunion($this);
    //     }

    //     return $this;
    // }

    // public function removeDiligence(Diligence $diligence): static
    // {
    //     if ($this->diligences->removeElement($diligence)) {
    //         // set the owning side to null (unless already changed)
    //         if ($diligence->getReunion() === $this) {
    //             $diligence->setReunion(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getPresident(): ?Employe
    {
        return $this->president;
    }

    public function setPresident(?Employe $president): static
    {
        $this->president = $president;

        return $this;
    }

    /**
     * @return Collection<int, HistoriqueReunion>
     */
    public function getHistoriqueReunions(): Collection
    {
        return $this->historiqueReunions;
    }

    public function addHistoriqueReunion(HistoriqueReunion $historiqueReunion): static
    {
        if (!$this->historiqueReunions->contains($historiqueReunion)) {
            $this->historiqueReunions->add($historiqueReunion);
            $historiqueReunion->setReunion($this);
        }

        return $this;
    }

    public function removeHistoriqueReunion(HistoriqueReunion $historiqueReunion): static
    {
        if ($this->historiqueReunions->removeElement($historiqueReunion)) {
            // set the owning side to null (unless already changed)
            if ($historiqueReunion->getReunion() === $this) {
                $historiqueReunion->setReunion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OrdreJour>
     */
    public function getPoints(): Collection
    {
        return $this->points;
    }

    public function addPoint(OrdreJour $point): static
    {
        if (!$this->points->contains($point)) {
            $this->points->add($point);
            $point->setReunion($this);
        }

        return $this;
    }

    public function removePoint(OrdreJour $point): static
    {
        if ($this->points->removeElement($point)) {
            // set the owning side to null (unless already changed)
            if ($point->getReunion() === $this) {
                $point->setReunion(null);
            }
        }

        return $this;
    }
}
