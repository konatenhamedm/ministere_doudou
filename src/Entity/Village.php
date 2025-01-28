<?php

namespace App\Entity;

use App\Repository\VillageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VillageRepository::class)]
class Village
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    // #[ORM\Column(length: 255)]
    // private ?string $code = null;

    // #[ORM\Column(length: 255)]
    // private ?string $abrege = null;

    #[ORM\ManyToOne(inversedBy: 'villages')]
    private ?SousPrefecture $sousPrefecture = null;

    #[ORM\OneToMany(mappedBy: 'village', targetEntity: LigneMission::class,cascade: ['remove', 'persist'])]
    private Collection $lignemission;

    public function __construct()
    {
        $this->lignemission = new ArrayCollection();
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

    // public function getCode(): ?string
    // {
    //     return $this->code;
    // }

    // public function setCode(string $code): static
    // {
    //     $this->code = $code;

    //     return $this;
    // }

    // public function getAbrege(): ?string
    // {
    //     return $this->abrege;
    // }

    // public function setAbrege(string $abrege): static
    // {
    //     $this->abrege = $abrege;

    //     return $this;
    // }

    public function getSousPrefecture(): ?SousPrefecture
    {
        return $this->sousPrefecture;
    }

    public function setSousPrefecture(?SousPrefecture $sousPrefecture): static
    {
        $this->sousPrefecture = $sousPrefecture;

        return $this;
    }

    /**
     * @return Collection<int, LigneMission>
     */
    public function getLignemission(): Collection
    {
        return $this->lignemission;
    }

    public function addLignemission(LigneMission $lignemission): static
    {
        if (!$this->lignemission->contains($lignemission)) {
            $this->lignemission->add($lignemission);
            $lignemission->setVillage($this);
        }

        return $this;
    }

    public function removeLignemission(LigneMission $lignemission): static
    {
        if ($this->lignemission->removeElement($lignemission)) {
            // set the owning side to null (unless already changed)
            if ($lignemission->getVillage() === $this) {
                $lignemission->setVillage(null);
            }
        }

        return $this;
    }
}
