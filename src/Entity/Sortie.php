<?php

namespace App\Entity;

use App\Repository\SortieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\CheckArticleStockMagasin;

#[ORM\Entity(repositoryClass: SortieRepository::class)]
#[ORM\Table(name: 'stock_sortie')]
#[Index(name: 'idx_etat_sortie', columns: ['etat'])]
// #[CheckArticleStockMagasin(groups: ['transfert', 'sortie'])]
class Sortie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez renseigner un libellé', groups: ['new', 'sortie', 'transfert'])]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank(message: 'Veuillez renseigner la date de sortie', groups: ['transfert', 'new', 'sortie', 'transfer'])]
    private ?\DateTimeInterface $dateSortie = null;

    #[ORM\OneToMany(mappedBy: 'sortie', targetEntity: LigneSortie::class, orphanRemoval: true, cascade: ['persist'])]
    #[Assert\Count(min: 1, minMessage: 'Veuillez renseigner au moins une ligne', groups: ['new', 'sortie', 'transfer'])]
    #[Assert\Valid(groups: ['new', 'sortie', 'transfert', 'reception    '])]
    private Collection $ligneSorties;

    #[ORM\Column(length: 50)]
    private ?string $etat = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'sorties')]
    #[Assert\NotBlank(message: 'Veuillez sélectionner un magasin', groups: ['new', 'sortie', 'transfert'])]
    private ?Magasin $magasin = null;

    #[ORM\ManyToOne(inversedBy: 'magasinDestinataire')]
    #[Assert\NotBlank(message: 'Veuillez sélectionner le magasin destinataire', groups: ['transfert'])]
    private ?Magasin $magasinDestinataire = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Veuillez renseigner un motif', groups: ['new', 'sortie'])]
    private ?string $motif = null;

    // #[ORM\OneToOne(mappedBy: 'sortie', cascade: ['persist', 'remove'])]
    // private ?InfoSortieTransfert $infoTransfert = null;

    public function __construct()
    {
        $this->ligneSorties = new ArrayCollection();
        $this->setMotif('');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
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

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(?\DateTimeInterface $dateSortie): self
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

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
            $article = $ligneSorty->getArticle();
            $magasin = $this->getMagasin();
            $type = $this->getType();
            if ($type != 'transfert' || ($type == 'transfert' && $magasin && $article->getStockMagasin($magasin) > 0)) {
                /*$this->ligneSorties->add($ligneSorty);
                $ligneSorty->setSortie($this);*/
            }

            $this->ligneSorties->add($ligneSorty);
            $ligneSorty->setSortie($this);
        }

        return $this;
    }

    public function removeLigneSorty(LigneSortie $ligneSorty): self
    {
        if ($this->ligneSorties->removeElement($ligneSorty)) {
            // set the owning side to null (unless already changed)
            if ($ligneSorty->getSortie() === $this) {
                $ligneSorty->setSortie(null);
            }
        }

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function getMagasinDestinataire(): ?Magasin
    {
        return $this->magasinDestinataire;
    }

    public function setMagasinDestinataire(?Magasin $magasinDestinataire): self
    {
        $this->magasinDestinataire = $magasinDestinataire;

        return $this;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    // public function getInfoTransfert(): ?InfoSortieTransfert
    // {
    //     return $this->infoTransfert;
    // }

    // public function setInfoTransfert(InfoSortieTransfert $infoTransfert): self
    // {
    //     // set the owning side of the relation if necessary
    //     if ($infoTransfert->getSortie() !== $this) {
    //         $infoTransfert->setSortie($this);
    //     }

    //     $this->infoTransfert = $infoTransfert;

    //     return $this;
    // }


}
