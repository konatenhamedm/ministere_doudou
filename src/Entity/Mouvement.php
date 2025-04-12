<?php

namespace App\Entity;

use App\Repository\MouvementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: MouvementRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"discr", type:"string")]
#[UniqueEntity(fields: 'reference', message: 'Ce code est déjà associé à un mouvement')]
#[ORM\Table(name:'stock_mouvement')]
class Mouvement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateEntree = null;


    #[ORM\OneToMany(mappedBy: 'entreeStock', targetEntity: LigneMouvement::class, orphanRemoval: true, cascade:['persist'])]
    private Collection $ligneEntrees;

    #[ORM\ManyToOne(inversedBy: 'entreeStocks')]
    private ?Sens $sens = null;

    #[ORM\Column(length: 15,unique:true)]
    private ?string $reference = null;

    #[ORM\ManyToOne(inversedBy: 'mouvements')]
    private ?Magasin $magasin = null;


    public function __construct()
    {
        $this->ligneEntrees = new ArrayCollection();
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

    public function getDateEntree(): ?\DateTimeInterface
    {
        return $this->dateEntree;
    }

    public function setDateEntree(\DateTimeInterface $dateEntree): self
    {
        $this->dateEntree = $dateEntree;

        return $this;
    }


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
            $ligneEntree->setEntreeStock($this);
        }

        return $this;
    }

    public function removeLigneEntree(LigneMouvement $ligneEntree): self
    {
        if ($this->ligneEntrees->removeElement($ligneEntree)) {
            // set the owning side to null (unless already changed)
            if ($ligneEntree->getEntreeStock() === $this) {
                $ligneEntree->setEntreeStock(null);
            }
        }

        return $this;
    }

    public function getSens(): ?Sens
    {
        return $this->sens;
    }

    public function setSens(?Sens $sens): self
    {
        $this->sens = $sens;

        return $this;
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

    public function getMagasin(): ?Magasin
    {
        return $this->magasin;
    }

    public function setMagasin(?Magasin $magasin): self
    {
        $this->magasin = $magasin;

        return $this;
    }

}
