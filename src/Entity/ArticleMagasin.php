<?php

namespace App\Entity;

use App\Repository\ArticleMagasinRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleMagasinRepository::class)]
class ArticleMagasin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'articleMagasins')]
    private ?Article $article = null;

    #[ORM\ManyToOne(inversedBy: 'articleMagasins')]
    private ?Magasin $magasin = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column]
    private ?int $seuil = null;

    private $ancienneQuantite;

    private $articleSupprime;

    public  function __construct()
    {
        $this->quantite = 0;
    }
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

    public function getMagasin(): ?Magasin
    {
        return $this->magasin;
    }

    public function setMagasin(?Magasin $magasin): self
    {
        $this->magasin = $magasin;

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

    public function getSeuil(): ?int
    {
        return $this->seuil;
    }

    public function setSeuil(int $seuil): self
    {
        $this->seuil = $seuil;

        return $this;
    }



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
