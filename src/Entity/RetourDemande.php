<?php

namespace App\Entity;

use App\Repository\RetourDemandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: RetourDemandeRepository::class)]
#[ORM\Table(name:'stock_retour_demande')]
class RetourDemande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $etat = null;

    #[ORM\Column(length: 10)]
    private ?string $reference = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE,nullable:true)]
    private ?\DateTimeInterface $dateSortie = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE,nullable:true)]
    private ?\DateTimeInterface $dateReceptionRetour = null;


    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(groups: ['retour'],message: "Veuillez renseigner le champs libelle")]
    private ?string $libelle = null;

    #[ORM\ManyToOne(inversedBy: 'retourDemandes')]
    private ?Projet $projet = null;

    #[ORM\Column(length: 255,nullable:true)]
    #[Assert\NotBlank(groups: ['retour'],message: "Veuillez renseigner le champs numero de bon")]
    private ?string $numeroBonSortie = null;

    #[ORM\Column(length: 255,nullable:true)]
    #[Assert\NotBlank(groups: ['demande_valider'],message: "Veuillez renseigner le champs convoyeur")]
    private ?string $convoyeur = null;

    #[ORM\OneToMany(mappedBy: 'retourDemande', targetEntity: LigneRetourDemande::class,orphanRemoval: true, cascade:['persist'])]
    private Collection $ligneRetourDemandes;

    #[ORM\ManyToOne(inversedBy: 'retourDemandes')]
    private ?Magasin $magasin = null;

    public function __construct()
    {

        $this->dateCreation = new \DateTime();
        $this->ligneRetourDemandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(\DateTimeInterface $dateSortie): self
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }
    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

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

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): self
    {
        $this->projet = $projet;

        return $this;
    }

    public function getNumeroBonSortie(): ?string
    {
        return $this->numeroBonSortie;
    }

    public function setNumeroBonSortie(string $numeroBonSortie): self
    {
        $this->numeroBonSortie = $numeroBonSortie;

        return $this;
    }

    public function getConvoyeur(): ?string
    {
        return $this->convoyeur;
    }

    public function setConvoyeur(string $convoyeur): self
    {
        $this->convoyeur = $convoyeur;

        return $this;
    }


    public function getDateReceptionRetour(): ?\DateTimeInterface
    {
        return $this->dateReceptionRetour;
    }

    public function setDateReceptionRetour(\DateTimeInterface $dateReceptionRetour): self
    {
        $this->dateReceptionRetour = $dateReceptionRetour;

        return $this;
    }

    /**
     * @return Collection<int, LigneRetourDemande>
     */
    public function getLigneRetourDemandes(): Collection
    {
        return $this->ligneRetourDemandes;
    }

    public function addLigneRetourDemande(LigneRetourDemande $ligneRetourDemande): self
    {
        if (!$this->ligneRetourDemandes->contains($ligneRetourDemande)) {
            $this->ligneRetourDemandes->add($ligneRetourDemande);
            $ligneRetourDemande->setRetourDemande($this);
        }

        return $this;
    }

    public function removeLigneRetourDemande(LigneRetourDemande $ligneRetourDemande): self
    {
        if ($this->ligneRetourDemandes->removeElement($ligneRetourDemande)) {
            // set the owning side to null (unless already changed)
            if ($ligneRetourDemande->getRetourDemande() === $this) {
                $ligneRetourDemande->setRetourDemande(null);
            }
        }

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
}
