<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: DemandeRepository::class)]
class Demande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;
    
   


    #[ORM\OneToMany(mappedBy: 'demande', targetEntity: LigneDemande::class)]
    private Collection $ligneDemandes;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Gedmo\Timestampable(on: "create")]
    private ?\DateTimeInterface $dateDemande = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
        #[ORM\JoinColumn(nullable: true)]
    private ?\DateTimeInterface $dateValidation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[ORM\JoinColumn(nullable: true)]
    private ?\DateTimeInterface $dateLivraison = null;


    #[ORM\Column(length: 255)]
    private ?string $etat = 'en_cours';

    public function __construct()
    {
        $this->ligneDemandes = new ArrayCollection();
      
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

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

    /**
     * @return Collection<int, LigneDemande>
     */
    public function getLigneDemandes(): Collection
    {
        return $this->ligneDemandes;
    }

    public function addLigneDemande(LigneDemande $ligneDemande): static
    {
        if (!$this->ligneDemandes->contains($ligneDemande)) {
            $this->ligneDemandes->add($ligneDemande);
            $ligneDemande->setDemande($this);
        }

        return $this;
    }

    public function removeLigneDemande(LigneDemande $ligneDemande): static
    {
        if ($this->ligneDemandes->removeElement($ligneDemande)) {
            // set the owning side to null (unless already changed)
            if ($ligneDemande->getDemande() === $this) {
                $ligneDemande->setDemande(null);
            }
        }

        return $this;
    }

    public function getDateDemande(): ?\DateTimeInterface
    {
        return $this->dateDemande;
    }

    public function setDateDemande(\DateTimeInterface $dateDemande): static
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    public function getDateValidation(): ?\DateTimeInterface
    {
        return $this->dateValidation;
    }

    public function setDateValidation(\DateTimeInterface $dateValidation): static
    {
        $this->dateValidation = $dateValidation;

        return $this;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->dateLivraison;
    }

    public function setDateLivraison(\DateTimeInterface $dateLivraison): static
    {
        $this->dateLivraison = $dateLivraison;

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
