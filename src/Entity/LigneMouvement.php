<?php

namespace App\Entity;

use App\Repository\LigneMouvementRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: LigneMouvementRepository::class)]
#[ORM\Table(name:'stock_ligne_mouvement')]
#[HasLifecycleCallbacks]
class LigneMouvement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ligneEntrees')]
    private ?Article $article = null;

    #[ORM\Column]
    private ?int $quantite = null;

    private $ancienneQuantite;

    private $articleSupprime;

    #[ORM\ManyToOne(inversedBy: 'ligneEntrees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mouvement $entreeStock = null;


    public $disableStockUpdateListener = false;

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

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

    public function getEntreeStock(): ?Mouvement
    {
        return $this->entreeStock;
    }

    public function setEntreeStock(?Mouvement $entreeStock): self
    {
        $this->entreeStock = $entreeStock;

        return $this;
    }

    #[ORM\PostLoad]
    public function setAncienneQuantite()
    {
        $this->ancienneQuantite = $this->quantite;
    }

    public function getAncienneQuantite()
    {
        return $this->ancienneQuantite;
    }

    #[ORM\PreRemove]
    public function setArticleSupprime()
    {
        $this->articleSupprime = $this->article;
    }

    public function getArticleSupprime()
    {
        return $this->articleSupprime;
    }
}
