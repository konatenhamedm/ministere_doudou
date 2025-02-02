<?php

namespace App\Entity;

use App\Repository\WorkflowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkflowRepository::class)]
class Workflow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'workflow', targetEntity: LigneEtape::class, cascade:['remove','persist'])]
    private Collection $ligneetape;

    #[ORM\OneToMany(mappedBy: 'workfow', targetEntity: Dossier::class,cascade:['remove','persist'])]
    private Collection $dossiers;

    public function __construct()
    {
        $this->ligneetape = new ArrayCollection();
        $this->dossiers = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, LigneEtape>
     */
    public function getLigneetape(): Collection
    {
        return $this->ligneetape;
    }

    public function addLigneetape(LigneEtape $ligneetape): static
    {
        if (!$this->ligneetape->contains($ligneetape)) {
            $this->ligneetape->add($ligneetape);
            $ligneetape->setWorkflow($this);
        }

        return $this;
    }

    public function removeLigneetape(LigneEtape $ligneetape): static
    {
        if ($this->ligneetape->removeElement($ligneetape)) {
            // set the owning side to null (unless already changed)
            if ($ligneetape->getWorkflow() === $this) {
                $ligneetape->setWorkflow(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Dossier>
     */
    public function getDossiers(): Collection
    {
        return $this->dossiers;
    }

    public function addDossier(Dossier $dossier): static
    {
        if (!$this->dossiers->contains($dossier)) {
            $this->dossiers->add($dossier);
            $dossier->setWorkfow($this);
        }

        return $this;
    }

    public function removeDossier(Dossier $dossier): static
    {
        if ($this->dossiers->removeElement($dossier)) {
            // set the owning side to null (unless already changed)
            if ($dossier->getWorkfow() === $this) {
                $dossier->setWorkfow(null);
            }
        }

        return $this;
    }
}
