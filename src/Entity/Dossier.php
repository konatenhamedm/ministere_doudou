<?php

namespace App\Entity;

use App\Repository\DossierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DossierRepository::class)]
class Dossier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'dossiers', cascade: ['persist'])]
    private ?Workflow $workfow = null;

    #[ORM\Column(length: 255)]
    private ?string $etat = 'en_cours';

    #[ORM\OneToMany(mappedBy: 'dossier', targetEntity: LigneReponsableDossier::class,cascade: ['persist','remove'])]
    private Collection $ligneReponsableDossier;

    public function __construct()
    {
        $this->ligneReponsableDossier = new ArrayCollection();
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

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getWorkfow(): ?Workflow
    {
        return $this->workfow;
    }

    public function setWorkfow(?Workflow $workfow): static
    {
        $this->workfow = $workfow;

        return $this;
    }


    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * @return Collection<int, LigneReponsableDossier>
     */
    public function getLigneReponsableDossier(): Collection
    {
        return $this->ligneReponsableDossier;
    }

    public function addLigneReponsableDossier(LigneReponsableDossier $ligneReponsableDossier): static
    {
        if (!$this->ligneReponsableDossier->contains($ligneReponsableDossier)) {
            $this->ligneReponsableDossier->add($ligneReponsableDossier);
            $ligneReponsableDossier->setDossier($this);
        }

        return $this;
    }

    public function removeLigneReponsableDossier(LigneReponsableDossier $ligneReponsableDossier): static
    {
        if ($this->ligneReponsableDossier->removeElement($ligneReponsableDossier)) {
            // set the owning side to null (unless already changed)
            if ($ligneReponsableDossier->getDossier() === $this) {
                $ligneReponsableDossier->setDossier(null);
            }
        }

        return $this;
    }

   
}
