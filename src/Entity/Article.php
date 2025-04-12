<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Attribute\Source;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ORM\Table(name: 'param_article')]
#[UniqueEntity(fields: 'reference', message: 'Ce code est déjà associé a un article')]
#[Source]
class Article
{

    const DEFAULT_CHOICE_LABEL = 'fullLibelle';
    const ELEMENT_CODE = 'reference';
    const DEFAULT_CHOICE_LABEL_COMPLETE = 'designationWithFamille';
    public const CHOICE_PARENT = 'generique.designation';
    const CMUP = '({new_qte}*{new_cout} + ({old_cmup}*{qte_current_stock})) / ({qte_current_stock + new_qte)';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $designation = null;

    #[ORM\ManyToOne(inversedBy: 'articles', cascade: ['persist'])]
    private ?Famille $famille = null;

    // #[ORM\ManyToOne(inversedBy: 'articles', cascade: ['persist'])]
    // private ?Colisage $colisage = null;

    #[ORM\Column(length: 50, unique: true)]
    #[Assert\NotBlank(message: 'Veuillez renseigner la référence de l\'article')]
    private ?string $reference = null;

    // #[ORM\OneToMany(mappedBy: 'article', targetEntity: SpecificationArticle::class)]
    // private Collection $specificationArticles;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: LigneMouvement::class)]
    private Collection $ligneEntrees;

    // #[ORM\OneToMany(mappedBy: 'article', targetEntity: TableCump::class)]
    // private Collection $tableCumps;

    #[ORM\Column(nullable: false)]
    private ?int $seuil = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: LigneDemande::class)]
    private Collection $ligneDemandes;

    // #[ORM\OneToMany(mappedBy: 'article', targetEntity: DemandeArticleFournisseur::class, orphanRemoval: true, cascade: ['persist'])]
    // private Collection $demandes;



    // #[ORM\OneToMany(mappedBy: 'article', targetEntity: LigneRetourAchat::class)]
    // private Collection $ligneRetourAchats;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: LigneRetourDemande::class)]
    private Collection $ligneRetourDemandes;

    // #[ORM\OneToMany(mappedBy: 'article', targetEntity: LigneDemandeAchat::class)]
    // private Collection $ligneDemandeAchats;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: LigneSortie::class)]
    private Collection $ligneSorties;

    // #[ORM\OneToMany(mappedBy: 'article', targetEntity: LigneCommande::class, orphanRemoval: true)]
    // private Collection $ligneCommandes;

    // #[ORM\OneToMany(mappedBy: 'article', targetEntity: LigneAchat::class)]
    // private Collection $ligneAchats;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "Veuillez renseigner la désignation de l'article")]
    private ?string $caracteristique = null;

    // #[ORM\OneToMany(mappedBy: 'article', targetEntity: LigneTransfert::class)]
    // private Collection $ligneTransferts;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: ArticleMagasin::class, cascade: ['persist'])]
    private Collection $articleMagasins;

    // #[ORM\ManyToOne(inversedBy: 'articles')]
    // private ?TypeEpi $typeEpi = null;

    // #[ORM\OneToMany(mappedBy: 'article', targetEntity: LigneAttributionEpi::class)]
    // private Collection $ligneAttributionEpis;

    // #[ORM\OneToMany(mappedBy: 'article', targetEntity: InfoSerie::class, orphanRemoval: true, cascade: ['persist'])]
    // private Collection $infoSeries;

    // #[ORM\OneToOne(mappedBy: 'article', cascade: ['persist', 'remove'])]
    // private ?InfoArticle $infoArticle = null;

    // #[ORM\ManyToOne(inversedBy: 'articles')]
    // #[Assert\NotBlank(message: "Veuillez renseigner le générique de l'article")]
    // private ?ArticleGenerique $generique = null;

    private ?Magasin $magasin;

    #[ORM\Column]
    private ?int $cumup = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Gedmo\Timestampable(on: 'update')]
    private ?\DateTimeInterface $dateModification = null;

    public function __construct()
    {
        // $this->specificationArticles = new ArrayCollection();
        $this->ligneEntrees = new ArrayCollection();
        // $this->tableCumps = new ArrayCollection();
        $this->cumup = 0;
        $this->quantite = 0;
        $this->ligneDemandes = new ArrayCollection();
        // $this->demandes = new ArrayCollection();
        // $this->ligneRetourAchats = new ArrayCollection();
        $this->ligneRetourDemandes = new ArrayCollection();
        // $this->ligneDemandeAchats = new ArrayCollection();
        $this->ligneSorties = new ArrayCollection();
        // $this->ligneCommandes = new ArrayCollection();
        // $this->ligneAchats = new ArrayCollection();
        // $this->ligneTransferts = new ArrayCollection();
        $this->articleMagasins = new ArrayCollection();
        // $this->ligneAttributionEpis = new ArrayCollection();
        // $this->infoSeries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    // public function getFamille(): ?Famille
    // {
    //     return $this->getGenerique() ? $this->getGenerique()->getFamille() : $this->famille;
    // }

    // public function setFamille(?Famille $famille): self
    // {
    //     $this->famille = $famille ?: $this->getGenerique()->getFamille();

    //     return $this;
    // }

    // public function getColisage(): ?Colisage
    // {
    //     return $this->getGenerique() ? $this->getGenerique()->getColisage() : $this->colisage;
    // }

    // public function setColisage(?Colisage $colisage): self
    // {
    //     $this->colisage = $colisage ?: $this->getGenerique()->getColisage();

    //     return $this;
    // }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    // /**
    //  * @return Collection<int, SpecificationArticle>
    //  */
    // public function getSpecificationArticles(): Collection
    // {
    //     return $this->specificationArticles;
    // }

    // public function addSpecificationArticle(SpecificationArticle $specificationArticle): self
    // {
    //     if (!$this->specificationArticles->contains($specificationArticle)) {
    //         $this->specificationArticles->add($specificationArticle);
    //         $specificationArticle->setArticle($this);
    //     }

    //     return $this;
    // }

    // public function removeSpecificationArticle(SpecificationArticle $specificationArticle): self
    // {
    //     if ($this->specificationArticles->removeElement($specificationArticle)) {
    //         // set the owning side to null (unless already changed)
    //         if ($specificationArticle->getArticle() === $this) {
    //             $specificationArticle->setArticle(null);
    //         }
    //     }

    //     return $this;
    // }

    /**
     * @return Collection<int, LigneMouvement>
     */
    public function getLigneEntrees(): Collection
    {
        return $this->ligneEntrees;
    }

    public function addLigneEntree(LigneMouvement $ligneEntree): self
    {
        if (!$this->ligneEntrees->contains($ligneEntree)) {
            $this->ligneEntrees->add($ligneEntree);
            $ligneEntree->setArticle($this);
        }

        return $this;
    }

    public function removeLigneEntree(LigneMouvement $ligneEntree): self
    {
        if ($this->ligneEntrees->removeElement($ligneEntree)) {
            // set the owning side to null (unless already changed)
            if ($ligneEntree->getArticle() === $this) {
                $ligneEntree->setArticle(null);
            }
        }

        return $this;
    }

    // /**
    //  * @return Collection<int, DemandeArticleFournisseur>
    //  */
    // public function getDemandes(): Collection
    // {
    //     return $this->demandes;
    // }

    // public function addDemande(DemandeArticleFournisseur $demande): self
    // {
    //     if (!$this->demandes->contains($demande)) {
    //         $this->demandes->add($demande);
    //         $demande->setArticle($this);
    //     }

    //     return $this;
    // }



    // public function removeDemande(DemandeArticleFournisseur $demande): self
    // {
    //     if ($this->demandes->removeElement($demande)) {
    //         // set the owning side to null (unless already changed)
    //         if ($demande->getArticle() === $this) {
    //             $demande->setArticle(null);
    //         }
    //     }

    //     return $this;
    // }

    // /**
    //  * @return Collection<int, TableCump>
    //  */
    // public function getTableCumps(): Collection
    // {
    //     return $this->tableCumps;
    // }

    // public function addTableCump(TableCump $tableCump): self
    // {
    //     if (!$this->tableCumps->contains($tableCump)) {
    //         $this->tableCumps->add($tableCump);
    //         $tableCump->setArticle($this);
    //     }

    //     return $this;
    // }

    // public function removeTableCump(TableCump $tableCump): self
    // {
    //     if ($this->tableCumps->removeElement($tableCump)) {
    //         // set the owning side to null (unless already changed)
    //         if ($tableCump->getArticle() === $this) {
    //             $tableCump->setArticle(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getSeuil(): ?int
    {
        return $this->seuil;
    }

    public function setSeuil(int $seuil): self
    {
        $this->seuil = $seuil;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

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
            $ligneDemande->setArticle($this);
        }

        return $this;
    }

    public function removeLigneDemande(LigneDemande $ligneDemande): self
    {
        if ($this->ligneDemandes->removeElement($ligneDemande)) {
            // set the owning side to null (unless already changed)
            if ($ligneDemande->getArticle() === $this) {
                $ligneDemande->setArticle(null);
            }
        }

        return $this;
    }

    // public function getCurrentFournisseurs(Offre $offre)
    // {
    //     $fournisseurs = [];

    //     foreach ($this->getDemandes() as $_demande) {
    //         if ($_demande->getOffre() == $offre) {
    //             $fournisseurs[] = $_demande->getFournisseur();
    //         }
    //     }
    //     return $fournisseurs;
    // }


    // /**
    //  * @return Collection<int, LigneRetourAchat>
    //  */
    // public function getLigneRetourAchats(): Collection
    // {
    //     return $this->ligneRetourAchats;
    // }

    // public function addLigneRetourAchat(LigneRetourAchat $ligneRetourAchat): self
    // {
    //     if (!$this->ligneRetourAchats->contains($ligneRetourAchat)) {
    //         $this->ligneRetourAchats->add($ligneRetourAchat);
    //         $ligneRetourAchat->setArticle($this);
    //     }

    //     return $this;
    // }

    // public function removeLigneRetourAchat(LigneRetourAchat $ligneRetourAchat): self
    // {
    //     if ($this->ligneRetourAchats->removeElement($ligneRetourAchat)) {
    //         // set the owning side to null (unless already changed)
    //         if ($ligneRetourAchat->getArticle() === $this) {
    //             $ligneRetourAchat->setArticle(null);
    //         }
    //     }

    //     return $this;
    // }

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
            $ligneRetourDemande->setArticle($this);
        }

        return $this;
    }

    public function removeLigneRetourDemande(LigneRetourDemande $ligneRetourDemande): self
    {
        if ($this->ligneRetourDemandes->removeElement($ligneRetourDemande)) {
            // set the owning side to null (unless already changed)
            if ($ligneRetourDemande->getArticle() === $this) {
                $ligneRetourDemande->setArticle(null);
            }
        }

        return $this;
    }

    // /**
    //  * @return Collection<int, LigneDemandeAchat>
    //  */
    // public function getLigneDemandeAchats(): Collection
    // {
    //     return $this->ligneDemandeAchats;
    // }


    // public function getLigneAchat(DemandeAchat $demandeAchat): LigneDemandeAchat | bool
    // {
    //     return $this->ligneDemandeAchats
    //         ->filter(fn(LigneDemandeAchat $ligneDemandeAchat) => $ligneDemandeAchat->getArticle() == $this && $ligneDemandeAchat->getDemandeAchat() == $demandeAchat)
    //         ->current();
    // }


    // public function getLibelleAchat(DemandeAchat $demandeAchat)
    // {
    //     return $this->getLigneAchat($demandeAchat)?->getLibelle($this);
    // }


    // public function getCoutAchat(DemandeAchat $demandeAchat)
    // {
    //     $ligneAchat =  $this->getLigneAchat($demandeAchat);

    //     if ($ligneAchat) {
    //         return $ligneAchat->getCout();
    //     }
    //     return 0;
    // }


    // public function addLigneDemandeAchat(LigneDemandeAchat $ligneDemandeAchat): self
    // {
    //     if (!$this->ligneDemandeAchats->contains($ligneDemandeAchat)) {
    //         $this->ligneDemandeAchats->add($ligneDemandeAchat);
    //         $ligneDemandeAchat->setArticle($this);
    //     }

    //     return $this;
    // }

    // public function removeLigneDemandeAchat(LigneDemandeAchat $ligneDemandeAchat): self
    // {
    //     if ($this->ligneDemandeAchats->removeElement($ligneDemandeAchat)) {
    //         // set the owning side to null (unless already changed)
    //         if ($ligneDemandeAchat->getArticle() === $this) {
    //             $ligneDemandeAchat->setArticle(null);
    //         }
    //     }

    //     return $this;
    // }

    /**
     * @return Collection<int, LigneSortie>
     */
    public function getLigneSorties(): Collection
    {
        return $this->ligneSorties;
    }

    public function addLigneSorty(LigneSortie $ligneSorty): self
    {
        if (!$this->ligneSorties->contains($ligneSorty)) {
            $this->ligneSorties->add($ligneSorty);
            $ligneSorty->setArticle($this);
        }

        return $this;
    }

    public function removeLigneSorty(LigneSortie $ligneSorty): self
    {
        if ($this->ligneSorties->removeElement($ligneSorty)) {
            // set the owning side to null (unless already changed)
            if ($ligneSorty->getArticle() === $this) {
                $ligneSorty->setArticle(null);
            }
        }

        return $this;
    }


    // public function getQuantiteOffre(Offre $offre)
    // {
    //     $allDemandes = $this->demandes->filter(function ($demande) use ($offre) {
    //         return $demande->getOffre() == $offre;
    //     });

    //     if ($allDemandes->count()) {

    //         return $allDemandes->first()->getQuantite();
    //     }
    //     return 0;
    // }


    // public function getMinFournisseurMontant(DemandeAchat $demandeAchat)
    // {
    //     $montants = [];
    //     $allDemandes = $demandeAchat->getDemandeArticleFournisseurs();

    //     foreach ($allDemandes as $_demande) {
    //         if ($_demande->getArticle() == $this && $_demande->getMontantRemise() > 0) {
    //             $montants[] = ['demande' => $_demande, 'montant' => $_demande->getMontantRemise()];
    //         }
    //     }

    //     uasort($montants, function ($a, $b) {
    //         return $a['montant'] <=> $b['montant'];
    //     });

    //     return current($montants);
    // }


    // public function getAllowedFournisseurs(DemandeAchat $demandeAchat)
    // {
    //     $fournisseurs = [];
    //     $allDemandes = $demandeAchat->getDemandeArticleFournisseurs();

    //     foreach ($allDemandes as $_demande) {

    //         if ($_demande->getMontant() > 0 &&  $_demande->getArticle() == $this) {
    //             $fournisseurs[] = $_demande->getFournisseur()->getId();
    //         }
    //     }

    //     return array_unique($fournisseurs);
    // }


    // public function getFournisseurs()
    // {
    //     $famille = $this->getFamille();
    //     return $famille->getFournisseurs()->map(fn($data) => $data->getFournisseur());
    // }


    // public function getMontant(Offre $offre, Fournisseur $fournisseur)
    // {
    //     $montants = [];
    //     $allDemandes = $this->demandes->filter(function ($demande) use ($offre) {
    //         return $demande->getOffre() == $offre;
    //     });

    //     foreach ($allDemandes as $_demande) {
    //         if ($_demande->getFournisseur() == $fournisseur) {
    //         }
    //         $montants[] = ['demande' => $_demande, 'montant' => $_demande->getMontant()];
    //     }

    //     uasort($montants, function ($a, $b) {
    //         return $a['montant'] <=> $b['montant'];
    //     });

    //     return current($montants);
    // }


    public function getLibelle()
    {
        return $this->getFullLibelle();
    }


    public function getFullLibelle()
    { //dd($this->getFamille()->getLibelle());
        if ($this->caracteristique != '')
            return $this->getDesignation() . " | " . $this->caracteristique;
        else
            return $this->getDesignation();
        //return '[' . $this->getFamille()->getLibelle(). '] ' .$this->getDesignation();
    }

    // /**
    //  * @return Collection<int, LigneCommande>
    //  */
    // public function getLigneCommandes(): Collection
    // {
    //     return $this->ligneCommandes;
    // }

    // public function addLigneCommande(LigneCommande $ligneCommande): self
    // {
    //     if (!$this->ligneCommandes->contains($ligneCommande)) {
    //         $this->ligneCommandes->add($ligneCommande);
    //         $ligneCommande->setArticle($this);
    //     }

    //     return $this;
    // }

    // public function removeLigneCommande(LigneCommande $ligneCommande): self
    // {
    //     if ($this->ligneCommandes->removeElement($ligneCommande)) {
    //         // set the owning side to null (unless already changed)
    //         if ($ligneCommande->getArticle() === $this) {
    //             $ligneCommande->setArticle(null);
    //         }
    //     }

    //     return $this;
    // }

    // /**
    //  * @return Collection<int, LigneAchat>
    //  */
    // public function getLigneAchats(): Collection
    // {
    //     return $this->ligneAchats;
    // }

    // public function addLigneAchat(LigneAchat $ligneAchat): self
    // {
    //     if (!$this->ligneAchats->contains($ligneAchat)) {
    //         $this->ligneAchats->add($ligneAchat);
    //         $ligneAchat->setArticle($this);
    //     }

    //     return $this;
    // }

    // public function removeLigneAchat(LigneAchat $ligneAchat): self
    // {
    //     if ($this->ligneAchats->removeElement($ligneAchat)) {
    //         // set the owning side to null (unless already changed)
    //         if ($ligneAchat->getArticle() === $this) {
    //             $ligneAchat->setArticle(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getCaracteristique(): ?string
    {
        return $this->caracteristique ? $this->caracteristique : $this->designation;
    }

    public function setCaracteristique(?string $caracteristique): self
    {
        $this->caracteristique = $caracteristique;

        return $this;
    }

    // /**
    //  * @return Collection<int, LigneTransfert>
    //  */
    // public function getLigneTransferts(): Collection
    // {
    //     return $this->ligneTransferts;
    // }

    // public function addLigneTransfert(LigneTransfert $ligneTransfert): self
    // {
    //     if (!$this->ligneTransferts->contains($ligneTransfert)) {
    //         $this->ligneTransferts->add($ligneTransfert);
    //         $ligneTransfert->setArticle($this);
    //     }

    //     return $this;
    // }

    // public function removeLigneTransfert(LigneTransfert $ligneTransfert): self
    // {
    //     if ($this->ligneTransferts->removeElement($ligneTransfert)) {
    //         // set the owning side to null (unless already changed)
    //         if ($ligneTransfert->getArticle() === $this) {
    //             $ligneTransfert->setArticle(null);
    //         }
    //     }

    //     return $this;
    // }

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
            $articleMagasin->setArticle($this);
        }

        return $this;
    }

    public function removeArticleMagasin(ArticleMagasin $articleMagasin): self
    {
        if ($this->articleMagasins->removeElement($articleMagasin)) {
            // set the owning side to null (unless already changed)
            if ($articleMagasin->getArticle() === $this) {
                $articleMagasin->setArticle(null);
            }
        }

        return $this;
    }

    // public function getTypeEpi(): ?TypeEpi
    // {
    //     return $this->typeEpi;
    // }

    // public function setTypeEpi(?TypeEpi $typeEpi): self
    // {
    //     $this->typeEpi = $typeEpi;

    //     return $this;
    // }

    // /**
    //  * @return Collection<int, LigneAttributionEpi>
    //  */
    // public function getLigneAttributionEpis(): Collection
    // {
    //     return $this->ligneAttributionEpis;
    // }

    // public function addLigneAttributionEpi(LigneAttributionEpi $ligneAttributionEpi): self
    // {
    //     if (!$this->ligneAttributionEpis->contains($ligneAttributionEpi)) {
    //         $this->ligneAttributionEpis->add($ligneAttributionEpi);
    //         $ligneAttributionEpi->setArticle($this);
    //     }

    //     return $this;
    // }

    // public function removeLigneAttributionEpi(LigneAttributionEpi $ligneAttributionEpi): self
    // {
    //     if ($this->ligneAttributionEpis->removeElement($ligneAttributionEpi)) {
    //         // set the owning side to null (unless already changed)
    //         if ($ligneAttributionEpi->getArticle() === $this) {
    //             $ligneAttributionEpi->setArticle(null);
    //         }
    //     }

    //     return $this;
    // }

    // /**
    //  * @return Collection<int, InfoSerie>
    //  */
    // public function getInfoSeries(): Collection
    // {
    //     return $this->infoSeries;
    // }

    // public function addInfoSeries(InfoSerie $infoSeries): self
    // {
    //     if (!$this->infoSeries->contains($infoSeries)) {
    //         $this->infoSeries->add($infoSeries);
    //         $infoSeries->setArticle($this);
    //     }

    //     return $this;
    // }

    // public function removeInfoSeries(InfoSerie $infoSeries): self
    // {
    //     if ($this->infoSeries->removeElement($infoSeries)) {
    //         // set the owning side to null (unless already changed)
    //         if ($infoSeries->getArticle() === $this) {
    //             $infoSeries->setArticle(null);
    //         }
    //     }

    //     return $this;
    // }

    // public function getInfoArticle(): ?InfoArticle
    // {
    //     return $this->infoArticle;
    // }

    // public function setInfoArticle(InfoArticle $infoArticle): self
    // {
    //     // set the owning side of the relation if necessary
    //     if ($infoArticle->getArticle() !== $this) {
    //         $infoArticle->setArticle($this);
    //     }

    //     $this->infoArticle = $infoArticle;

    //     return $this;
    // }

    // public function getGenerique(): ?ArticleGenerique
    // {
    //     return $this->generique;
    // }

    // public function setGenerique(?ArticleGenerique $generique): self
    // {
    //     $this->generique = $generique;

    //     return $this;
    // }


    /**
     * Get the value of magasin
     */
    public function getMagasin(): ?Magasin
    {
        return $this->magasin;
    }

    /**
     * Set the value of magasin
     */
    public function setMagasin(?Magasin $magasin): self
    {
        $this->magasin = $magasin;

        return $this;
    }

    public function getCumup(): ?int
    {
        return $this->cumup;
    }

    public function setCumup(int $cumup): self
    {
        $this->cumup = $cumup;

        return $this;
    }


    public function getStockMagasin(Magasin $magasin)
    {
        $total = 0;
        foreach ($this->getArticleMagasins() as $articleMagasin) {
            if ($articleMagasin->getMagasin() == $magasin) {
                $total += $articleMagasin->getQuantite();
            }
        }
        return $total;
    }

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->dateModification;
    }

    public function setDateModification(\DateTimeInterface $dateModification): self
    {
        $this->dateModification = $dateModification;

        return $this;
    }
}
