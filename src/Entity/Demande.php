<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DemandeRepository::class)]
#[ORM\Table(name: 'stock_demande')]
class Demande
{
    const PREV_STATES = [
        'validation_service' => ['Demande' => 'cree'],
        'validation_cg' => ['Validation C.S' => 'service', 'Demande' => 'cree'],
        'validation' => ['Validation C.G' => 'valide_cg', 'Validation C.S' => 'service', 'Demande' => 'cree']
    ];


    const VALIDATIONS_ORDER = ['Sup Hiérarchique',  'C.G', 'Direction'];

    const VALIDATIONS_MAPS = [
        'service' => 0,
        'attente_validation' => 1,
        'valide_cg' => 2,
    ];

    const VALIDATIONS = [
        'Demandeur' => 'cree',
        'Sup Hierarchique' => 'attente_validation',
        'Contrôleur de Gestion' => 'valide_cg',
        'Direction' => 'valide',
        'Gestionnaire de stock' => 'livre'
    ];



    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10, unique: true)]
    private ?string $reference = null;


    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDemande = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateValidation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateLivraison = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Gedmo\Blameable(on: 'create')]
    private ?Utilisateur $utilisateur = null;

    #[ORM\OneToMany(mappedBy: 'demande', targetEntity: LigneDemande::class, orphanRemoval: true, cascade: ['persist'])]
    #[Assert\Valid(groups: ['cree', 'valide', 'article'])]
    #[Assert\Count(min: 1, minMessage: 'Veuillez rajouter au moins une ligne')]
    private Collection $ligneDemandes;

    #[ORM\Column(length: 255)]
    private ?string $etat = null;

    #[ORM\ManyToOne(inversedBy: 'demandes')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Projet $projet = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\ManyToOne(inversedBy: 'demandes')]
    #[ORM\JoinColumn(nullable: true)]
    #[Assert\NotBlank(groups: ['valide'], message: "Veuillez renseigner le champs magasin")]
    private ?Magasin $magasin = null;

    // #[ORM\OneToMany(mappedBy: 'demande', targetEntity: HistoriqueDemande::class)]
    // private Collection $historiqueDemandes;

    // #[ORM\ManyToOne(inversedBy: 'demandeArticles')]
    // #[Assert\NotBlank(groups: ['ligne-budgetaire'], message: "Veuillez sélectionner la ligne budgétaire")]
    // private ?LigneBudget $ligneBudgetaire = null;


    private ?string $commentaireValidation = '';

    private ?string $prevEtat = '';

    public function __construct()
    {
        $this->ligneDemandes = new ArrayCollection();
        $this->dateDemande = new \DateTime();
        // $this->historiqueDemandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDemande(): ?\DateTimeInterface
    {
        return $this->dateDemande;
    }

    public function setDateDemande(\DateTimeInterface $dateDemande): self
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    public function getDateValidation(): ?\DateTimeInterface
    {
        return $this->dateValidation;
    }

    public function setDateValidation(\DateTimeInterface $dateValidation): self
    {
        $this->dateValidation = $dateValidation;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->dateLivraison;
    }

    public function setDateLivraison(\DateTimeInterface $dateLivraison): self
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }

    /**
     * @return Collection<int, LigneDemande>
     */
    public function getLigneDemandes(): Collection
    {
        return $this->ligneDemandes;
    }

    public function addLigneDemande(LigneDemande $ligneDemande): self
    {
        if (!$this->ligneDemandes->contains($ligneDemande)) {
            $this->ligneDemandes->add($ligneDemande);
            $ligneDemande->setDemande($this);
        }

        return $this;
    }

    public function removeLigneDemande(LigneDemande $ligneDemande): self
    {
        if ($this->ligneDemandes->removeElement($ligneDemande)) {
            // set the owning side to null (unless already changed)
            if ($ligneDemande->getDemande() === $this) {
                $ligneDemande->setDemande(null);
            }
        }

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): self
    {
        $this->projet = $projet;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getMagasin(): ?Magasin
    {
        return $this->magasin;
    }

    public function setMagasin(?Magasin $magasin): self
    {
        $this->magasin = $magasin;

        return $this;
    }

    // /**
    //  * @return Collection<int, HistoriqueDemande>
    //  */
    // public function getHistoriqueDemandes(): Collection
    // {
    //     return $this->historiqueDemandes;
    // }

    // public function addHistoriqueDemande(HistoriqueDemande $historiqueDemande): self
    // {
    //     if (!$this->historiqueDemandes->contains($historiqueDemande)) {
    //         $this->historiqueDemandes->add($historiqueDemande);
    //         $historiqueDemande->setDemande($this);
    //     }

    //     return $this;
    // }

    // public function removeHistoriqueDemande(HistoriqueDemande $historiqueDemande): self
    // {
    //     if ($this->historiqueDemandes->removeElement($historiqueDemande)) {
    //         // set the owning side to null (unless already changed)
    //         if ($historiqueDemande->getDemande() === $this) {
    //             $historiqueDemande->setDemande(null);
    //         }
    //     }

    //     return $this;
    // }

    // public function getLigneBudgetaire(): ?LigneBudget
    // {
    //     return $this->ligneBudgetaire;
    // }

    // public function setLigneBudgetaire(?LigneBudget $ligneBudgetaire): self
    // {
    //     $this->ligneBudgetaire = $ligneBudgetaire;

    //     return $this;
    // }



    /**
     * Get the value of commentaireValidation
     */
    public function getCommentaireValidation(): ?string
    {
        return $this->commentaireValidation;
    }

    /**
     * Set the value of commentaireValidation
     */
    public function setCommentaireValidation(?string $commentaireValidation): self
    {
        $this->commentaireValidation = $commentaireValidation;

        return $this;
    }

    /**
     * Get the value of prevEtat
     */
    public function getPrevEtat(): ?string
    {
        return $this->prevEtat;
    }

    /**
     * Set the value of prevEtat
     */
    public function setPrevEtat(?string $prevEtat): self
    {
        $this->prevEtat = $prevEtat;

        return $this;
    }
}
