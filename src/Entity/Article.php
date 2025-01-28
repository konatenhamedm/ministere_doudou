<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?Categorie $categorie = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column]
    private ?int $seuil = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'articles', targetEntity: LigneDemande::class)]
    private ?LigneDemande $lignedemandes = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: LigneDemande::class)]
    private Collection $Lignedemande;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: LigneMouvement::class)]
    private Collection $ligneMouvements;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: LigneEntree::class)]
    private Collection $ligneEntrees;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: LigneSortie::class)]
    private Collection $ligneSorties;

    public function __construct()
    {
        $this->Lignedemande = new ArrayCollection();
        $this->ligneMouvements = new ArrayCollection();
        $this->ligneEntrees = new ArrayCollection();
        $this->ligneSorties = new ArrayCollection();
    }





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

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

    public function getSeuil(): ?int
    {
        return $this->seuil;
    }

    public function setSeuil(int $seuil): static
    {
        $this->seuil = $seuil;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    
    public function getLignedemandes(): ?LigneDemande
    {
        return $this->lignedemandes;
    }

    public function setLignedemandes(?LigneDemande $lignedemandes): static
    {
        $this->lignedemandes = $lignedemandes;

        return $this;
    }

    /**
     * @return Collection<int, LigneDemande>
     */
    public function getLignedemande(): Collection
    {
        return $this->Lignedemande;
    }

    public function addLignedemande(LigneDemande $lignedemande): static
    {
        if (!$this->Lignedemande->contains($lignedemande)) {
            $this->Lignedemande->add($lignedemande);
            $lignedemande->setArticle($this);
        }

        return $this;
    }

    public function removeLignedemande(LigneDemande $lignedemande): static
    {
        if ($this->Lignedemande->removeElement($lignedemande)) {
            // set the owning side to null (unless already changed)
            if ($lignedemande->getArticle() === $this) {
                $lignedemande->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LigneMouvement>
     */
    public function getLigneMouvements(): Collection
    {
        return $this->ligneMouvements;
    }

    public function addLigneMouvement(LigneMouvement $ligneMouvement): static
    {
        if (!$this->ligneMouvements->contains($ligneMouvement)) {
            $this->ligneMouvements->add($ligneMouvement);
            $ligneMouvement->setArticle($this);
        }

        return $this;
    }

    public function removeLigneMouvement(LigneMouvement $ligneMouvement): static
    {
        if ($this->ligneMouvements->removeElement($ligneMouvement)) {
            // set the owning side to null (unless already changed)
            if ($ligneMouvement->getArticle() === $this) {
                $ligneMouvement->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LigneEntree>
     */
    public function getLigneEntrees(): Collection
    {
        return $this->ligneEntrees;
    }

    public function addLigneEntree(LigneEntree $ligneEntree): static
    {
        if (!$this->ligneEntrees->contains($ligneEntree)) {
            $this->ligneEntrees->add($ligneEntree);
            $ligneEntree->setArticle($this);
        }

        return $this;
    }

    public function removeLigneEntree(LigneEntree $ligneEntree): static
    {
        if ($this->ligneEntrees->removeElement($ligneEntree)) {
            // set the owning side to null (unless already changed)
            if ($ligneEntree->getArticle() === $this) {
                $ligneEntree->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LigneSortie>
     */
    public function getLigneSorties(): Collection
    {
        return $this->ligneSorties;
    }

    public function addLigneSorty(LigneSortie $ligneSorty): static
    {
        if (!$this->ligneSorties->contains($ligneSorty)) {
            $this->ligneSorties->add($ligneSorty);
            $ligneSorty->setArticle($this);
        }

        return $this;
    }

    public function removeLigneSorty(LigneSortie $ligneSorty): static
    {
        if ($this->ligneSorties->removeElement($ligneSorty)) {
            // set the owning side to null (unless already changed)
            if ($ligneSorty->getArticle() === $this) {
                $ligneSorty->setArticle(null);
            }
        }

        return $this;
    }
}
