<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


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

    #[ORM\Column(type: Types::DATETIME_MUTABLE,name: "date_debut_pretuve", nullable: true)]
    private ?\DateTimeInterface $dateDebutPrevue = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE,name: "date_fin_pretuve", nullable: true)]
    private ?\DateTimeInterface $dateFinPrevue = null;

  

    // #[ORM\ManyToOne(inversedBy: 'missions')]
    // private ?employe $employe = null;

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

  

    #[ORM\ManyToOne(cascade: ["persist"], fetch: "EAGER")]
    #[ORM\JoinColumn(nullable: true)]
    private ?FichierAdmin $fichier = null;

    #[ORM\Column]
    private array $options = [];

    #[ORM\OneToMany(mappedBy: 'mission', targetEntity: LigneMission::class,cascade: ['persist', 'remove'])]
    private Collection $ligneMissions;

    #[ORM\Column(type: 'string', length: 255)]
    private string $etat = 'en_cours';

    #[ORM\ManyToOne(inversedBy: 'missions')]
    #[Gedmo\Blameable(on: 'create')]
    private ?Utilisateur $initiateurMission = null;
    
    #[ORM\Column(nullable: true, type: Types::TEXT)]
    private ?string $justification = null;


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

   

    // public function getEmploye(): ?employe
    // {
    //     return $this->employe;
    // }

    // public function setEmploye(?employe $employe): static
    // {
    //     $this->employe = $employe;

    //     return $this;
    // }

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


    public function getJustification(): ?string
    {
        return $this->justification;
    }

    public function setJustification(string $justification): self
    {
        $this->justification = $justification;

        return $this;
    }

    public function getInitiateurMission(): ?Utilisateur
    {
        return $this->initiateurMission;
    }

    public function setInitiateurMission(?Utilisateur $initiateurMission): static
    {
        $this->initiateurMission = $initiateurMission;

        return $this;
    }
}
