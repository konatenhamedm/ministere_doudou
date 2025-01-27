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

    #[ORM\OneToMany(mappedBy: 'points', targetEntity: Reunion::class)]
    private Collection $reunions;

    #[ORM\OneToMany(mappedBy: 'point', targetEntity: Rapportage::class)]
    private Collection $rapportages;

    public function __construct()
    {
        $this->reunions = new ArrayCollection();
        $this->rapportages = new ArrayCollection();
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

    /**
     * @return Collection<int, Reunion>
     */
    public function getReunions(): Collection
    {
        return $this->reunions;
    }

    public function addReunion(Reunion $reunion): static
    {
        if (!$this->reunions->contains($reunion)) {
            $this->reunions->add($reunion);
            $reunion->setPoints($this);
        }

        return $this;
    }

    public function removeReunion(Reunion $reunion): static
    {
        if ($this->reunions->removeElement($reunion)) {
            // set the owning side to null (unless already changed)
            if ($reunion->getPoints() === $this) {
                $reunion->setPoints(null);
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
            $rapportage->setPoint($this);
        }

        return $this;
    }

    public function removeRapportage(Rapportage $rapportage): static
    {
        if ($this->rapportages->removeElement($rapportage)) {
            // set the owning side to null (unless already changed)
            if ($rapportage->getPoint() === $this) {
                $rapportage->setPoint(null);
            }
        }

        return $this;
    }
}
