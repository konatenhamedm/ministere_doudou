<?php

namespace App\Entity;

use App\Repository\FamilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Attribute\Source;

#[ORM\Entity(repositoryClass: FamilleRepository::class)]
#[ORM\Table(name:'param_famille')]
#[Source]
class Famille
{
    public const DEFAULT_CHOICE_LABEL = 'libelle';

    public const ELEMENT_CODE = 'code';

    const CHILD_PROPS = 'getArticles';

    public const IS_TOTAL = true;
    
    public const CHILD_CLASS = Article::class;

    public const CODE_LOG = 'F7';

    // public const CHILD_SOURCES = [
    //     ArticleGenerique::class, 
    // ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'famille', targetEntity: Article::class)]
    private Collection $articles;


    // #[ORM\OneToMany(mappedBy: 'famille', targetEntity: ArticleGenerique::class)]
    // private Collection $articleGeneriques;

    #[ORM\Column(length: 10)]
    private ?string $code = null;

    // #[ORM\OneToMany(mappedBy: 'famille', targetEntity: FournisseurFamille::class)]
    // private Collection $fournisseurs;

    #[ORM\OneToMany(mappedBy: 'categorieMateriel', targetEntity: Demande::class)]
    private Collection $demandes;

    // #[ORM\OneToMany(mappedBy: 'famille', targetEntity: ServiceFamille::class, orphanRemoval: true,  cascade: ['persist'])]
    // private Collection $services;




    public function __construct()
    {
        $this->articles = new ArrayCollection();
        // $this->fournisseurs = new ArrayCollection();
        $this->demandes = new ArrayCollection();
        // $this->services = new ArrayCollection();
        // $this->articleGeneriques = new ArrayCollection();
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

    // /**
    //  * @return Collection<int, Article>
    //  */
    // public function getArticles(): Collection
    // {
    //     return $this->articles;
    // }

    // public function addArticle(Article $article): self
    // {
    //     if (!$this->articles->contains($article)) {
    //         $this->articles->add($article);
    //         $article->setFamille($this);
    //     }

    //     return $this;
    // }

    // public function removeArticle(Article $article): self
    // {
    //     if ($this->articles->removeElement($article)) {
    //         // set the owning side to null (unless already changed)
    //         if ($article->getFamille() === $this) {
    //             $article->setFamille(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    // /**
    //  * @return Collection<int, Fournisseur>
    //  */
    // public function getFournisseurs(): Collection
    // {
    //     return $this->fournisseurs;
    // }

    // public function addFournisseur(FournisseurFamille $fournisseur): self
    // {
    //     if (!$this->fournisseurs->contains($fournisseur)) {
    //         $this->fournisseurs->add($fournisseur);
    //         $fournisseur->setFamille($this);
    //     }

    //     return $this;
    // }

    // public function removeFournisseur(FournisseurFamille $fournisseur): self
    // {
    //     if ($this->fournisseurs->removeElement($fournisseur)) {
    //         // set the owning side to null (unless already changed)
    //         if ($fournisseur->getFamille() === $this) {
    //             $fournisseur->setFamille(null);
    //         }
    //     }

    //     return $this;
    // }

    // /**
    //  * @return Collection<int, Demande>
    //  */
    // public function getDemandes(): Collection
    // {
    //     return $this->demandes;
    // }

    // public function addDemande(Demande $demande): self
    // {
    //     if (!$this->demandes->contains($demande)) {
    //         $this->demandes->add($demande);
    //         $demande->setCategorieMateriel($this);
    //     }

    //     return $this;
    // }

    // public function removeDemande(Demande $demande): self
    // {
    //     if ($this->demandes->removeElement($demande)) {
    //         // set the owning side to null (unless already changed)
    //         if ($demande->getCategorieMateriel() === $this) {
    //             $demande->setCategorieMateriel(null);
    //         }
    //     }

    //     return $this;
    // }

    // /**
    //  * @return Collection<int, ServiceFamille>
    //  */
    // public function getServices(): Collection
    // {
    //     return $this->services;
    // }

    // public function addService(ServiceFamille $service): self
    // {
    //     if (!$this->services->contains($service)) {
    //         $this->services->add($service);
    //         $service->setFamille($this);
    //     }

    //     return $this;
    // }

    // public function removeService(ServiceFamille $service): self
    // {
    //     if ($this->services->removeElement($service)) {
    //         // set the owning side to null (unless already changed)
    //         if ($service->getFamille() === $this) {
    //             $service->setFamille(null);
    //         }
    //     }

    //     return $this;
    // }


    //  /**
    //  * @return Collection<int, ArticleGenerique>
    //  */
    // public function getArticleGeneriques(): Collection
    // {
    //     return $this->articleGeneriques;
    // }

    // public function addArticleGenerique(ArticleGenerique $articleGenerique): self
    // {
    //     if (!$this->articleGeneriques->contains($articleGenerique)) {
    //         $this->articleGeneriques->add($articleGenerique);
    //         $articleGenerique->setFamille($this);
    //     }

    //     return $this;
    // }

    // public function removeArticleGenerique(ArticleGenerique $articleGenerique): self
    // {
    //     if ($this->articleGeneriques->removeElement($articleGenerique)) {
    //         // set the owning side to null (unless already changed)
    //         if ($articleGenerique->getFamille() === $this) {
    //             $articleGenerique->setFamille(null);
    //         }
    //     }

    //     return $this;
    // }



}
