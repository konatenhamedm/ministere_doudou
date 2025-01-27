<?php

namespace App\Entity;

use App\Repository\TypeFinancementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeFinancementRepository::class)]
class TypeFinancement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'typeFinancement', targetEntity: Bailleur::class)]
    private Collection $bailleurs;

    public function __construct()
    {
        $this->bailleurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Bailleur>
     */
    public function getBailleurs(): Collection
    {
        return $this->bailleurs;
    }

    public function addBailleur(Bailleur $bailleur): static
    {
        if (!$this->bailleurs->contains($bailleur)) {
            $this->bailleurs->add($bailleur);
            $bailleur->setTypeFinancement($this);
        }

        return $this;
    }

    public function removeBailleur(Bailleur $bailleur): static
    {
        if ($this->bailleurs->removeElement($bailleur)) {
            // set the owning side to null (unless already changed)
            if ($bailleur->getTypeFinancement() === $this) {
                $bailleur->setTypeFinancement(null);
            }
        }

        return $this;
    }
}
