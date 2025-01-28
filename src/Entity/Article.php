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

    public function __construct()
    {
        $this->Lignedemande = new ArrayCollection();
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
}
