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

    #[ORM\ManyToOne(inversedBy: 'reunions')]
    private ?Salle $salle = null;

    #[ORM\ManyToOne(inversedBy: 'reunions')]
    private ?OrdreJour $points = null;

    #[ORM\OneToMany(mappedBy: 'reunion', targetEntity: Employe::class)]
    private Collection $participants;

    #[ORM\OneToMany(mappedBy: 'reunion', targetEntity: Presence::class)]
    private Collection $presences;

    #[ORM\OneToMany(mappedBy: 'reunion', targetEntity: Rapportage::class)]
    private Collection $rapportages;

    #[ORM\OneToMany(mappedBy: 'reunion', targetEntity: Diligence::class)]
    private Collection $diligences;

    #[ORM\ManyToOne(inversedBy: 'reunions')]
    private ?Employe $president = null;

    #[ORM\OneToMany(mappedBy: 'reunion', targetEntity: HistoriqueReunion::class)]
    private Collection $historiqueReunions;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->presences = new ArrayCollection();
        $this->rapportages = new ArrayCollection();
        $this->diligences = new ArrayCollection();
        $this->historiqueReunions = new ArrayCollection();
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

    public function getPoints(): ?OrdreJour
    {
        return $this->points;
    }

    public function setPoints(?OrdreJour $points): static
    {
        $this->points = $points;

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

    /**
     * @return Collection<int, Presence>
     */
    public function getPresences(): Collection
    {
        return $this->presences;
    }

    public function addPresence(Presence $presence): static
    {
        if (!$this->presences->contains($presence)) {
            $this->presences->add($presence);
            $presence->setReunion($this);
        }

        return $this;
    }

    public function removePresence(Presence $presence): static
    {
        if ($this->presences->removeElement($presence)) {
            // set the owning side to null (unless already changed)
            if ($presence->getReunion() === $this) {
                $presence->setReunion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rapportage>
     */
    public function getRapportages(): Collection
    {
        return $this->rapportages;
    }

    public function addRapportage(Rapportage $rapportage): static
    {
        if (!$this->rapportages->contains($rapportage)) {
            $this->rapportages->add($rapportage);
            $rapportage->setReunion($this);
        }

        return $this;
    }

    public function removeRapportage(Rapportage $rapportage): static
    {
        if ($this->rapportages->removeElement($rapportage)) {
            // set the owning side to null (unless already changed)
            if ($rapportage->getReunion() === $this) {
                $rapportage->setReunion(null);
            }
        }

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
            $diligence->setReunion($this);
        }

        return $this;
    }

    public function removeDiligence(Diligence $diligence): static
    {
        if ($this->diligences->removeElement($diligence)) {
            // set the owning side to null (unless already changed)
            if ($diligence->getReunion() === $this) {
                $diligence->setReunion(null);
            }
        }

        return $this;
    }

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
}
