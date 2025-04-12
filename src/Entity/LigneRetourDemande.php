<?php

namespace App\Entity;

use App\Repository\LigneRetourDemandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LigneRetourDemandeRepository::class)]
#[ORM\Table(name:'stock_ligne_retour_demande')]
class LigneRetourDemande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ligneRetourDemandes')]
    private ?Article $article = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantiteRetournee = null;

    #[ORM\ManyToOne(inversedBy: 'ligneRetourDemandes')]
    private ?RetourDemande $retourDemande = null;

    #[ORM\Column(nullable:true)]
    private ?int $quantiteSortie = null;

    #[ORM\Column]
    private ?int $quantiteRecue = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $cumup = null;

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

    public function getQuantiteRetournee(): ?int
    {
        return $this->quantiteRetournee;
    }

    public function setQuantiteRetournee($quantiteRetournee): self
    {
        $this->quantiteRetournee = $quantiteRetournee;

        return $this;
    }

    public function getRetourDemande(): ?RetourDemande
    {
        return $this->retourDemande;
    }

    public function setRetourDemande(?RetourDemande $retourDemande): self
    {
        $this->retourDemande = $retourDemande;

        return $this;
    }

    public function getQuantiteSortie(): ?int
    {
        return $this->quantiteSortie;
    }

    public function setQuantiteSortie(int $quantiteSortie): self
    {
        $this->quantiteSortie = $quantiteSortie;

        return $this;
    }

    public function getQuantiteRecue(): ?int
    {
        return $this->quantiteRecue;
    }

    public function setQuantiteRecue(int $quantiteRecue): self
    {
        $this->quantiteRecue = $quantiteRecue;

        return $this;
    }

    public function getCumup(): ?string
    {
        return $this->cumup;
    }

    public function setCumup(string $cumup): self
    {
        $this->cumup = $cumup;

        return $this;
    }
}
