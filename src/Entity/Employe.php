<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeRepository::class)]
#[ORM\Table(name: '_admin_employe')]
class Employe
{

    const DEFAULT_CHOICE_LABEL = 'nomComplet';
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $prenom = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: true)]
    private ?Fonction $fonction = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: true)]
    private ?Civilite $civilite = null;

    #[ORM\Column(length: 50)]
    private ?string $contact = null;

    #[ORM\Column(length: 255)]
    private ?string $adresseMail = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'], mappedBy: "employe")]
    private ?Utilisateur $utilisateur = null;


    #[ORM\Column(length: 12, nullable: true)]
    private ?string $matricule = null;



    #[ORM\ManyToOne(inversedBy: 'employes')]
    private ?Entreprise $entreprise = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numPiece = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contacts = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $residence = null;

    #[ORM\ManyToOne(cascade: ["persist"], fetch: "EAGER")]
    #[ORM\JoinColumn(nullable: true)]
    private ?FichierAdmin $piece = null;

    // #[ORM\OneToMany(mappedBy: 'employe', targetEntity: Mission::class)]
    // private Collection $missions;

    #[ORM\ManyToMany(targetEntity: Mission::class, mappedBy: 'participants')]
    private Collection $participant_mission;

    #[ORM\ManyToOne(inversedBy: 'participants')]
    private ?Reunion $reunion = null;

    #[ORM\OneToMany(mappedBy: 'employe', targetEntity: Presence::class)]
    private Collection $presences;

    #[ORM\ManyToMany(targetEntity: Rapportage::class, mappedBy: 'responsables')]
    private Collection $rapportages;

    #[ORM\OneToMany(mappedBy: 'president', targetEntity: Reunion::class)]
    private Collection $reunions;

    #[ORM\OneToMany(mappedBy: 'rapporteur', targetEntity: InfoRapportage::class)]
    private Collection $infoRapportages;

    #[ORM\OneToMany(mappedBy: 'employe', targetEntity: Affectation::class)]
    private Collection $affectations;

    #[ORM\OneToMany(mappedBy: 'responsable', targetEntity: LigneReponsableDossier::class)]
    private Collection $ligneReponsableDossiers;


  

    public function __construct()
    {
        // $this->missions = new ArrayCollection();
        $this->participant_mission = new ArrayCollection();
        $this->presences = new ArrayCollection();
        $this->rapportages = new ArrayCollection();
        $this->reunions = new ArrayCollection();
        $this->infoRapportages = new ArrayCollection();
        $this->affectations = new ArrayCollection();
        $this->ligneReponsableDossiers = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getFonction(): ?Fonction
    {
        return $this->fonction;
    }

    public function setFonction(?Fonction $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getCivilite(): ?Civilite
    {
        return $this->civilite;
    }

    public function setCivilite(?Civilite $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getAdresseMail(): ?string
    {
        return $this->adresseMail;
    }

    public function setAdresseMail(string $adresseMail): self
    {
        $this->adresseMail = $adresseMail;

        return $this;
    }



    public function getNomComplet(): ?string
    {
        return $this->getNom() . ' ' . $this->getPrenom();
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        // set the owning side of the relation if necessary
        if ($utilisateur->getEmploye() !== $this) {
            $utilisateur->setEmploye($this);
        }

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }


    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getNumPiece(): ?string
    {
        return $this->numPiece;
    }

    public function setNumPiece(string $numPiece): self
    {
        $this->numPiece = $numPiece;

        return $this;
    }

    public function getContacts(): ?string
    {
        return $this->contacts;
    }

    public function setContacts(string $contacts): self
    {
        $this->contacts = $contacts;

        return $this;
    }

    public function getResidence(): ?string
    {
        return $this->residence;
    }

    public function setResidence(string $residence): self
    {
        $this->residence = $residence;

        return $this;
    }

    public function getPiece(): ?FichierAdmin
    {
        return $this->piece;
    }

    public function setPiece(FichierAdmin $piece): self
    {
        $this->piece = $piece;

        return $this;
    }

    // /**
    //  * @return Collection<int, Mission>
    //  */
    // public function getMissions(): Collection
    // {
    //     return $this->missions;
    // }

    // public function addMission(Mission $mission): static
    // {
    //     if (!$this->missions->contains($mission)) {
    //         $this->missions->add($mission);
    //         $mission->setEmploye($this);
    //     }

    //     return $this;
    // }

    // public function removeMission(Mission $mission): static
    // {
    //     if ($this->missions->removeElement($mission)) {
    //         // set the owning side to null (unless already changed)
    //         if ($mission->getEmploye() === $this) {
    //             $mission->setEmploye(null);
    //         }
    //     }

    //     return $this;
    // }

    /**
     * @return Collection<int, Mission>
     */
    public function getParticipantMission(): Collection
    {
        return $this->participant_mission;
    }

    public function addParticipantMission(Mission $participantMission): static
    {
        if (!$this->participant_mission->contains($participantMission)) {
            $this->participant_mission->add($participantMission);
            $participantMission->addParticipant($this);
        }

        return $this;
    }

    public function removeParticipantMission(Mission $participantMission): static
    {
        if ($this->participant_mission->removeElement($participantMission)) {
            $participantMission->removeParticipant($this);
        }

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
            $presence->setEmploye($this);
        }

        return $this;
    }

    public function removePresence(Presence $presence): static
    {
        if ($this->presences->removeElement($presence)) {
            // set the owning side to null (unless already changed)
            if ($presence->getEmploye() === $this) {
                $presence->setEmploye(null);
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
            $rapportage->addResponsable($this);
        }

        return $this;
    }

    public function removeRapportage(Rapportage $rapportage): static
    {
        if ($this->rapportages->removeElement($rapportage)) {
            $rapportage->removeResponsable($this);
        }

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
            $reunion->setPresident($this);
        }

        return $this;
    }

    public function removeReunion(Reunion $reunion): static
    {
        if ($this->reunions->removeElement($reunion)) {
            // set the owning side to null (unless already changed)
            if ($reunion->getPresident() === $this) {
                $reunion->setPresident(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InfoRapportage>
     */
    public function getInfoRapportages(): Collection
    {
        return $this->infoRapportages;
    }

    public function addInfoRapportage(InfoRapportage $infoRapportage): static
    {
        if (!$this->infoRapportages->contains($infoRapportage)) {
            $this->infoRapportages->add($infoRapportage);
            $infoRapportage->setRapporteur($this);
        }

        return $this;
    }

    public function removeInfoRapportage(InfoRapportage $infoRapportage): static
    {
        if ($this->infoRapportages->removeElement($infoRapportage)) {
            // set the owning side to null (unless already changed)
            if ($infoRapportage->getRapporteur() === $this) {
                $infoRapportage->setRapporteur(null);
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
            $affectation->setEmploye($this);
        }

        return $this;
    }

    public function removeAffectation(Affectation $affectation): static
    {
        if ($this->affectations->removeElement($affectation)) {
            // set the owning side to null (unless already changed)
            if ($affectation->getEmploye() === $this) {
                $affectation->setEmploye(null);
            }
        }

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
            $ligneReponsableDossier->setResponsable($this);
        }

        return $this;
    }

    public function removeLigneReponsableDossier(LigneReponsableDossier $ligneReponsableDossier): static
    {
        if ($this->ligneReponsableDossiers->removeElement($ligneReponsableDossier)) {
            // set the owning side to null (unless already changed)
            if ($ligneReponsableDossier->getResponsable() === $this) {
                $ligneReponsableDossier->setResponsable(null);
            }
        }

        return $this;
    }

 



  

}
