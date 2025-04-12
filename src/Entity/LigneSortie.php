<?php

namespace App\Entity;

use App\Repository\LigneSortieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LigneSortieRepository::class)]
#[ORM\Table(name:'stock_ligne_sortie')]
class LigneSortie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ligneSorties')]
    #[Assert\NotBlank(message: 'Veuillez sélectionner un article pour la ligne', groups: ['new', 'sortie', 'transfert'])]
    private ?Article $article = null;

    #[ORM\Column]
    #[Assert\Positive(message: "Veuillez renseigner la quantite", groups: ['new', 'sortie', 'transfert'])]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'ligneSorties')]
    private ?Sortie $sortie = null;

    #[ORM\Column(nullable: true)]
    #[Assert\PositiveOrZero(message: "Veuillez renseigner la quantite réçue", groups: ['reception'])]
    #[Assert\LessThanOrEqual(propertyPath: 'quantite', message: 'La quantité reçue doit être au moins égale à celle demandée', groups: ['reception'])]
    private ?int $quantiteRecue = null;

    // #[ORM\ManyToMany(targetEntity: InfoSerie::class, inversedBy: 'ligneSorties')]
    // private Collection $infoSeries;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $cumup = null;

    public function __construct()
    {
        // $this->infoSeries = new ArrayCollection();
        $this->setCumup(0);
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

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getSortie(): ?Sortie
    {
        return $this->sortie;
    }

    public function setSortie(?Sortie $sortie): self
    {
        $this->sortie = $sortie;

        return $this;
    }

    public function getQuantiteRecue(): ?int
    {
        return $this->quantiteRecue;
    }

    public function setQuantiteRecue(?int $quantiteRecue): self
    {
        $this->quantiteRecue = $quantiteRecue;

        return $this;
    }

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
    //     }

    //     return $this;
    // }

    // public function removeInfoSeries(InfoSerie $infoSeries): self
    // {
    //     $this->infoSeries->removeElement($infoSeries);

    //     return $this;
    // }

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
