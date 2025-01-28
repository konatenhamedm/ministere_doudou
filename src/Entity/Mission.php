<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MissionRepository::class)]
class Mission
{
    const OPTIONS = ['Hébergement assuré', 'Repas fourni'];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: "objet_mission", type: "string", length: 255)]
    #[Assert\NotBlank(message: "Veuillez renseigner l'objet de la mission")]
    private $objetMission;

    #[ORM\Column(length: 255,name: "numero_om")]
    private ?string $numeroOM = null;

    // #[ORM\Column(type: Types::DATETIME_MUTABLE,name: "date_creation_mission")]
    // private ?\DateTimeInterface $dateCreationMission = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE,name: "date_debut_pretuve", nullable: true)]
    private ?\DateTimeInterface $dateDebutPrevue = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE,name: "date_fin_pretuve", nullable: true)]
    private ?\DateTimeInterface $dateFinPrevue = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE,name: "date_debut_effective", nullable: true)]
    private ?\DateTimeInterface $dateDebutEffective = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE,name: "date_fin_effective", nullable: true)] 
    private ?\DateTimeInterface $dateFinEffective = null;

    #[ORM\Column(length: 255,name: "montant_participant_mission")]
    private ?string $montantParticipantMission = null;

    #[ORM\Column(length: 255,name: "pourcentage_avance_mission")]
    private ?string $pourcentageAvanceMission = null;

    #[ORM\Column(length: 255)]
    private ?string $initiateurMission = null;

    #[ORM\ManyToOne(inversedBy: 'missions')]
    private ?employe $employe = null;

    #[ORM\ManyToOne(inversedBy: 'missions')]
    private ?MoyenTransport $moyenTransport = null;



    #[ORM\ManyToMany(targetEntity: Employe::class, inversedBy: 'participant_mission')]
    private Collection $participants;

    #[ORM\OneToMany(mappedBy: 'missions', targetEntity: PieceJointeMission::class)]
    private Collection $pieceJointes;

    #[ORM\OneToMany(mappedBy: 'missions', targetEntity: HistoriqueMission::class)]
    private Collection $historique;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?CompteRendu $compteRendu = null;

    #[ORM\Column(length: 255)]
    private ?string $imputationBudgetaire = null;

    #[ORM\ManyToOne(cascade: ["persist"], fetch: "EAGER")]
    #[ORM\JoinColumn(nullable: true)]
    private ?FichierAdmin $fichier = null;

    #[ORM\Column]
    private array $options = [];

    #[ORM\OneToMany(mappedBy: 'mission', targetEntity: LigneMission::class,cascade: ['persist', 'remove'])]
    private Collection $ligneMissions;

    #[ORM\Column(length: 255)]
    private ?string $etat = 'en_cours';

    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->pieceJointes = new ArrayCollection();
        $this->historique = new ArrayCollection();
        $this->ligneMissions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjetMission(): ?string
    {
        return $this->objetMission;
    }

    public function setObjetMission(string $objetMission): static
    {
        $this->objetMission = $objetMission;

        return $this;
    }

    public function getFichier(): ?FichierAdmin
    {
        return $this->fichier;
    }

    public function setFichier(?FichierAdmin $fichier): self
    {

        $this->fichier = $fichier;



        return $this;
    }

    public function getNumeroOM(): ?string
    {
        return $this->numeroOM;
    }

    public function setNumeroOM(string $numeroOM): static
    {
        $this->numeroOM = $numeroOM;

        return $this;
    }

    // public function getDateCreationMission(): ?\DateTimeInterface
    // {
    //     return $this->dateCreationMission;
    // }

    // public function setDateCreationMission(\DateTimeInterface $dateCreationMission): static
    // {
    //     $this->dateCreationMission = $dateCreationMission;

    //     return $this;
    // }

    public function getDateDebutPrevue(): ?\DateTimeInterface
    {
        return $this->dateDebutPrevue;
    }

    public function setDateDebutPrevue(\DateTimeInterface $dateDebutPrevue): static
    {
        $this->dateDebutPrevue = $dateDebutPrevue;

        return $this;
    }

    public function getDateFinPrevue(): ?\DateTimeInterface
    {
        return $this->dateFinPrevue;
    }

    public function setDateFinPrevue(\DateTimeInterface $dateFinPrevue): static
    {
        $this->dateFinPrevue = $dateFinPrevue;

        return $this;
    }

    public function getDateDebutEffective(): ?\DateTimeInterface
    {
        return $this->dateDebutEffective;
    }

    public function setDateDebutEffective(\DateTimeInterface $dateDebutEffective): static
    {
        $this->dateDebutEffective = $dateDebutEffective;

        return $this;
    }

    public function getDateFinEffective(): ?\DateTimeInterface
    {
        return $this->dateFinEffective;
    }

    public function setDateFinEffective(\DateTimeInterface $dateFinEffective): static
    {
        $this->dateFinEffective = $dateFinEffective;

        return $this;
    }

    public function getMontantParticipantMission(): ?string
    {
        return $this->montantParticipantMission;
    }

    public function setMontantParticipantMission(string $montantParticipantMission): static
    {
        $this->montantParticipantMission = $montantParticipantMission;

        return $this;
    }

    public function getPourcentageAvanceMission(): ?string
    {
        return $this->pourcentageAvanceMission;
    }

    public function setPourcentageAvanceMission(string $pourcentageAvanceMission): static
    {
        $this->pourcentageAvanceMission = $pourcentageAvanceMission;

        return $this;
    }

    public function getInitiateurMission(): ?string
    {
        return $this->initiateurMission;
    }

    public function setInitiateurMission(string $initiateurMission): static
    {
        $this->initiateurMission = $initiateurMission;

        return $this;
    }

    public function getEmploye(): ?employe
    {
        return $this->employe;
    }

    public function setEmploye(?employe $employe): static
    {
        $this->employe = $employe;

        return $this;
    }

    public function getMoyenTransport(): ?MoyenTransport
    {
        return $this->moyenTransport;
    }

    public function setMoyenTransport(?MoyenTransport $moyenTransport): static
    {
        $this->moyenTransport = $moyenTransport;

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
        }

        return $this;
    }

    public function removeParticipant(Employe $participant): static
    {
        $this->participants->removeElement($participant);

        return $this;
    }

    /**
     * @return Collection<int, PieceJointeMission>
     */
    public function getPieceJointes(): Collection
    {
        return $this->pieceJointes;
    }

    public function addPieceJointe(PieceJointeMission $pieceJointe): static
    {
        if (!$this->pieceJointes->contains($pieceJointe)) {
            $this->pieceJointes->add($pieceJointe);
            $pieceJointe->setMissions($this);
        }

        return $this;
    }

    public function removePieceJointe(PieceJointeMission $pieceJointe): static
    {
        if ($this->pieceJointes->removeElement($pieceJointe)) {
            // set the owning side to null (unless already changed)
            if ($pieceJointe->getMissions() === $this) {
                $pieceJointe->setMissions(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, HistoriqueMission>
     */
    public function getHistorique(): Collection
    {
        return $this->historique;
    }

    public function addHistorique(HistoriqueMission $historique): static
    {
        if (!$this->historique->contains($historique)) {
            $this->historique->add($historique);
            $historique->setMissions($this);
        }

        return $this;
    }

    public function removeHistorique(HistoriqueMission $historique): static
    {
        if ($this->historique->removeElement($historique)) {
            // set the owning side to null (unless already changed)
            if ($historique->getMissions() === $this) {
                $historique->setMissions(null);
            }
        }

        return $this;
    }

    public function getCompteRendu(): ?CompteRendu
    {
        return $this->compteRendu;
    }

    public function setCompteRendu(?CompteRendu $compteRendu): static
    {
        $this->compteRendu = $compteRendu;

        return $this;
    }

    public function getImputationBudgetaire(): ?string
    {
        return $this->imputationBudgetaire;
    }

    public function setImputationBudgetaire(string $imputationBudgetaire): static
    {
        $this->imputationBudgetaire = $imputationBudgetaire;

        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(array $options): static
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return Collection<int, LigneMission>
     */
    public function getLigneMissions(): Collection
    {
        return $this->ligneMissions;
    }

    public function addLigneMission(LigneMission $ligneMission): static
    {
        if (!$this->ligneMissions->contains($ligneMission)) {
            $this->ligneMissions->add($ligneMission);
            $ligneMission->setMission($this);
        }

        return $this;
    }

    public function removeLigneMission(LigneMission $ligneMission): static
    {
        if ($this->ligneMissions->removeElement($ligneMission)) {
            // set the owning side to null (unless already changed)
            if ($ligneMission->getMission() === $this) {
                $ligneMission->setMission(null);
            }
        }

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
}
