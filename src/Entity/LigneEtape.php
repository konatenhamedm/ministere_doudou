<?php

namespace App\Entity;

use App\Repository\LigneEtapeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LigneEtapeRepository::class)]
class LigneEtape
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column]
    private ?int $delai = null;

    #[ORM\ManyToOne(inversedBy: 'ligneetape', cascade: ['persist'])]
    private ?Workflow $workflow = null;

    #[ORM\OneToMany(mappedBy: 'ligneEtape', targetEntity: LigneReponsableDossier::class, cascade: ['persist', 'remove'])]
    private Collection $ligneReponsableDossiers;

    public function __construct()
    {
        $this->ligneReponsableDossiers = new ArrayCollection();
    }

 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

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

    public function getDelai(): ?int
    {
        return $this->delai;
    }

    public function setDelai(int $delai): static
    {
        $this->delai = $delai;

        return $this;
    }

    public function getWorkflow(): ?Workflow
    {
        return $this->workflow;
    }

    public function setWorkflow(?Workflow $workflow): static
    {
        $this->workflow = $workflow;

        return $this;
    }

    /**
     * @return Collection<int, LigneReponsableDossier>
     */
    public function getLigneReponsableDossiers(): Collection
    {
        return $this->ligneReponsableDossiers;
    }

    public function addLigneReponsableDossier(LigneReponsableDossier $ligneReponsableDossier): static
    {
        if (!$this->ligneReponsableDossiers->contains($ligneReponsableDossier)) {
            $this->ligneReponsableDossiers->add($ligneReponsableDossier);
            $ligneReponsableDossier->setLigneEtape($this);
        }

        return $this;
    }

    public function removeLigneReponsableDossier(LigneReponsableDossier $ligneReponsableDossier): static
    {
        if ($this->ligneReponsableDossiers->removeElement($ligneReponsableDossier)) {
            // set the owning side to null (unless already changed)
            if ($ligneReponsableDossier->getLigneEtape() === $this) {
                $ligneReponsableDossier->setLigneEtape(null);
            }
        }

        return $this;
    }

   
}
