<?php

namespace App\Entity;

use App\Repository\RapportageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RapportageRepository::class)]
class Rapportage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $delaiRapport = null;

    #[ORM\ManyToOne(inversedBy: 'rapportages')]
    private ?Reunion $reunion = null;

    #[ORM\ManyToMany(targetEntity: Employe::class, inversedBy: 'rapportages')]
    private Collection $responsables;

    #[ORM\ManyToOne(inversedBy: 'rapportages')]
    private ?OrdreJour $point = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Diligence $diligence = null;

    public function __construct()
    {
        $this->responsables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDelaiRapport(): ?int
    {
        return $this->delaiRapport;
    }

    public function setDelaiRapport(int $delaiRapport): static
    {
        $this->delaiRapport = $delaiRapport;

        return $this;
    }

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
     * @return Collection<int, Employe>
     */
    public function getResponsables(): Collection
    {
        return $this->responsables;
    }

    public function addResponsable(Employe $responsable): static
    {
        if (!$this->responsables->contains($responsable)) {
            $this->responsables->add($responsable);
        }

        return $this;
    }

    public function removeResponsable(Employe $responsable): static
    {
        $this->responsables->removeElement($responsable);

        return $this;
    }

    public function getPoint(): ?OrdreJour
    {
        return $this->point;
    }

    public function setPoint(?OrdreJour $point): static
    {
        $this->point = $point;

        return $this;
    }

    public function getDiligence(): ?Diligence
    {
        return $this->diligence;
    }

    public function setDiligence(?Diligence $diligence): static
    {
        $this->diligence = $diligence;

        return $this;
    }
}
