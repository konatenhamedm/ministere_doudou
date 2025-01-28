<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehiculeRepository::class)]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $immatriculation = null;

    #[ORM\Column(length: 255)]
    private ?string $chassi = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateAcquisition = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateMiseEnCirculation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateSortie = null;

    #[ORM\ManyToOne(inversedBy: 'vehicules', cascade: ['persist'])]
    private ?Marque $marque = null;

    #[ORM\ManyToOne(inversedBy: 'vehicules', cascade: ['persist'])]
    private ?Modele $modele = null;

    #[ORM\ManyToOne(inversedBy: 'vehicules', cascade: ['persist'])]
    private ?Type $type = null;

    #[ORM\Column]
    private ?bool $actif = null;



    #[ORM\OneToMany(mappedBy: 'vehicule', targetEntity: Assurance::class, cascade: ['persist', 'remove'])]
    private Collection $assurances;

    #[ORM\OneToMany(mappedBy: 'vehicule', targetEntity: Carburant::class, cascade: ['persist', 'remove'])]
    private Collection $carburants;

    #[ORM\OneToMany(mappedBy: 'vehicule', targetEntity: Intervention::class, cascade: ['persist', 'remove'])]
    private Collection $interventions;

    #[ORM\OneToMany(mappedBy: 'vehicule', targetEntity: VisiteTechnique::class, cascade: ['persist', 'remove'])]
    private Collection $visiteTechniques;

    #[ORM\OneToMany(mappedBy: 'vehicule', targetEntity: Sinistre::class, cascade: ['persist', 'remove'])]
    private Collection $sinistres;

    #[ORM\OneToMany(mappedBy: 'vehicule', targetEntity: Affectation::class, cascade: ['persist', 'remove'])]
    private Collection $affectations;



    public function __construct()
    {
        $this->assurances = new ArrayCollection();
        $this->carburants = new ArrayCollection();
        $this->interventions = new ArrayCollection();
        $this->visiteTechniques = new ArrayCollection();
        $this->sinistres = new ArrayCollection();
        $this->affectations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): static
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getChassi(): ?string
    {
        return $this->chassi;
    }

    public function setChassi(string $chassi): static
    {
        $this->chassi = $chassi;

        return $this;
    }

    public function getDateAcquisition(): ?\DateTimeInterface
    {
        return $this->dateAcquisition;
    }

    public function setDateAcquisition(\DateTimeInterface $dateAcquisition): static
    {
        $this->dateAcquisition = $dateAcquisition;

        return $this;
    }

    public function getDateMiseEnCirculation(): ?\DateTimeInterface
    {
        return $this->dateMiseEnCirculation;
    }

    public function setDateMiseEnCirculation(\DateTimeInterface $dateMiseEnCirculation): static
    {
        $this->dateMiseEnCirculation = $dateMiseEnCirculation;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(\DateTimeInterface $dateSortie): static
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): static
    {
        $this->actif = $actif;

        return $this;
    }

    

    /**
     * @return Collection<int, Assurance>
     */
    public function getAssurances(): Collection
    {
        return $this->assurances;
    }

    public function addAssurance(Assurance $assurance): static
    {
        if (!$this->assurances->contains($assurance)) {
            $this->assurances->add($assurance);
            $assurance->setVehicule($this);
        }

        return $this;
    }

    public function removeAssurance(Assurance $assurance): static
    {
        if ($this->assurances->removeElement($assurance)) {
            // set the owning side to null (unless already changed)
            if ($assurance->getVehicule() === $this) {
                $assurance->setVehicule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Carburant>
     */
    public function getCarburants(): Collection
    {
        return $this->carburants;
    }

    public function addCarburant(Carburant $carburant): static
    {
        if (!$this->carburants->contains($carburant)) {
            $this->carburants->add($carburant);
            $carburant->setVehicule($this);
        }

        return $this;
    }

    public function removeCarburant(Carburant $carburant): static
    {
        if ($this->carburants->removeElement($carburant)) {
            // set the owning side to null (unless already changed)
            if ($carburant->getVehicule() === $this) {
                $carburant->setVehicule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Intervention>
     */
    public function getInterventions(): Collection
    {
        return $this->interventions;
    }

    public function addIntervention(Intervention $intervention): static
    {
        if (!$this->interventions->contains($intervention)) {
            $this->interventions->add($intervention);
            $intervention->setVehicule($this);
        }

        return $this;
    }

    public function removeIntervention(Intervention $intervention): static
    {
        if ($this->interventions->removeElement($intervention)) {
            // set the owning side to null (unless already changed)
            if ($intervention->getVehicule() === $this) {
                $intervention->setVehicule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, VisiteTechnique>
     */
    public function getVisiteTechniques(): Collection
    {
        return $this->visiteTechniques;
    }

    public function addVisiteTechnique(VisiteTechnique $visiteTechnique): static
    {
        if (!$this->visiteTechniques->contains($visiteTechnique)) {
            $this->visiteTechniques->add($visiteTechnique);
            $visiteTechnique->setVehicule($this);
        }

        return $this;
    }

    public function removeVisiteTechnique(VisiteTechnique $visiteTechnique): static
    {
        if ($this->visiteTechniques->removeElement($visiteTechnique)) {
            // set the owning side to null (unless already changed)
            if ($visiteTechnique->getVehicule() === $this) {
                $visiteTechnique->setVehicule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Sinistre>
     */
    public function getSinistres(): Collection
    {
        return $this->sinistres;
    }

    public function addSinistre(Sinistre $sinistre): static
    {
        if (!$this->sinistres->contains($sinistre)) {
            $this->sinistres->add($sinistre);
            $sinistre->setVehicule($this);
        }

        return $this;
    }

    public function removeSinistre(Sinistre $sinistre): static
    {
        if ($this->sinistres->removeElement($sinistre)) {
            // set the owning side to null (unless already changed)
            if ($sinistre->getVehicule() === $this) {
                $sinistre->setVehicule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Affectation>
     */
    public function getAffectations(): Collection
    {
        return $this->affectations;
    }

    public function addAffectation(Affectation $affectation): static
    {
        if (!$this->affectations->contains($affectation)) {
            $this->affectations->add($affectation);
            $affectation->setVehicule($this);
        }

        return $this;
    }

    public function removeAffectation(Affectation $affectation): static
    {
        if ($this->affectations->removeElement($affectation)) {
            // set the owning side to null (unless already changed)
            if ($affectation->getVehicule() === $this) {
                $affectation->setVehicule(null);
            }
        }

        return $this;
    }
}
