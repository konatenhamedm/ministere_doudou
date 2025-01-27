<?php

namespace App\Entity;

use App\Repository\SousPrefectureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SousPrefectureRepository::class)]
class SousPrefecture
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

    #[ORM\ManyToOne(inversedBy: 'sousPrefectures')]
    private ?Departement $departement = null;

    #[ORM\OneToMany(mappedBy: 'sousPrefecture', targetEntity: Village::class)]
    private Collection $villages;



    public function __construct()
    {
        $this->villages = new ArrayCollection();
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

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): static
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * @return Collection<int, Village>
     */
    public function getVillages(): Collection
    {
        return $this->villages;
    }

    public function addVillage(Village $village): static
    {
        if (!$this->villages->contains($village)) {
            $this->villages->add($village);
            $village->setSousPrefecture($this);
        }

        return $this;
    }

    public function removeVillage(Village $village): static
    {
        if ($this->villages->removeElement($village)) {
            // set the owning side to null (unless already changed)
            if ($village->getSousPrefecture() === $this) {
                $village->setSousPrefecture(null);
            }
        }

        return $this;
    }

  
}
