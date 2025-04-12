<?php

namespace App\Entity;

use App\Repository\MagasinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: MagasinRepository::class)]
#[UniqueEntity(['code'], message: 'Ce Code est déjà utilisé')]
#[ORM\Table(name:'param_magasin')]
class Magasin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $emplacement = null;


    #[ORM\Column(length: 10, unique: true)]
    private ?string $code = null;


    #[ORM\Column(type: Types::DATETIME_MUTABLE,nullable:true)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE,nullable:true)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\OneToMany(mappedBy: 'magasin', targetEntity: Demande::class)]
    private Collection $demandes;

    #[ORM\OneToMany(mappedBy: 'magasin', targetEntity: Mouvement::class)]
    private Collection $mouvements;

    #[ORM\OneToMany(mappedBy: 'magasin', targetEntity: RetourDemande::class)]
    private Collection $retourDemandes;

    #[ORM\OneToMany(mappedBy: 'magasin', targetEntity: Sortie::class)]
    private Collection $sorties;

    #[ORM\OneToMany(mappedBy: 'magasin', targetEntity: ArticleMagasin::class)]
    private Collection $articleMagasins;


    #[ORM\OneToMany(mappedBy: 'magasin', targetEntity: Entree::class)]
    private Collection $entrees;

    public function __construct()
    {
        $this->demandes = new ArrayCollection();
        $this->mouvements = new ArrayCollection();
        $this->retourDemandes = new ArrayCollection();
        $this->sorties = new ArrayCollection();
        $this->articleMagasins = new ArrayCollection();
        $this->entrees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmplacement(): ?string
    {
        return $this->emplacement;
    }

    public function setEmplacement(string $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }


    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

   

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }


    /**
     * @return Collection<int, RetourDemande>
     */
    public function getRetourDemandes(): Collection
    {
        return $this->retourDemandes;
    }

    public function addRetourDemande(RetourDemande $retourDemande): self
    {
        if (!$this->retourDemandes->contains($retourDemande)) {
            $this->retourDemandes->add($retourDemande);
            $retourDemande->setMagasin($this);
        }

        return $this;
    }

    public function removeRetourDemande(RetourDemande $retourDemande): self
    {
        if ($this->retourDemandes->removeElement($retourDemande)) {
            // set the owning side to null (unless already changed)
            if ($retourDemande->getMagasin() === $this) {
                $retourDemande->setMagasin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Sortie>
     */
    public function getSorties(): Collection
    {
        return $this->sorties;
    }

    
    /**
     * @return Collection<int, ArticleMagasin>
     */
    public function getArticleMagasins(): Collection
    {
        return $this->articleMagasins;
    }

    public function addArticleMagasin(ArticleMagasin $articleMagasin): self
    {
        if (!$this->articleMagasins->contains($articleMagasin)) {
            $this->articleMagasins->add($articleMagasin);
            $articleMagasin->setMagasin($this);
        }

        return $this;
    }

    public function removeArticleMagasin(ArticleMagasin $articleMagasin): self
    {
        if ($this->articleMagasins->removeElement($articleMagasin)) {
            // set the owning side to null (unless already changed)
            if ($articleMagasin->getMagasin() === $this) {
                $articleMagasin->setMagasin(null);
            }
        }

        return $this;
    }


    public function getFullLibelle()
    {
        return '['.$this->getCode().'] '.$this->getLibelle();
    }

  
    /**
     * @return Collection<int, Entree>
     */
    public function getEntrees(): Collection
    {
        return $this->entrees;
    }

    public function addEntree(Entree $entree): self
    {
        if (!$this->entrees->contains($entree)) {
            $this->entrees->add($entree);
            $entree->setMagasin($this);
        }

        return $this;
    }

    public function removeEntree(Entree $entree): self
    {
        if ($this->entrees->removeElement($entree)) {
            // set the owning side to null (unless already changed)
            if ($entree->getMagasin() === $this) {
                $entree->setMagasin(null);
            }
        }

        return $this;
    }

}
