<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegionRepository::class)]
class Region
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // #[ORM\Column(length: 255)]
    // private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    // #[ORM\Column(length: 255)]
    // private ?string $abrege = null;

    #[ORM\ManyToOne(inversedBy: 'regions')]
    private ?District $district = null;

    #[ORM\OneToMany(mappedBy: 'region', targetEntity: Departement::class)]
    private Collection $chefLieu;

    public function __construct()
    {
        $this->chefLieu = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
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

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    // public function getAbrege(): ?string
    // {
    //     return $this->abrege;
    // }

    // public function setAbrege(string $abrege): static
    // {
    //     $this->abrege = $abrege;

    //     return $this;
    // }

    public function getDistrict(): ?District
    {
        return $this->district;
    }

    public function setDistrict(?District $district): static
    {
        $this->district = $district;

        return $this;
    }

    /**
     * @return Collection<int, Departement>
     */
    public function getChefLieu(): Collection
    {
        return $this->chefLieu;
    }

    public function addChefLieu(Departement $chefLieu): static
    {
        if (!$this->chefLieu->contains($chefLieu)) {
            $this->chefLieu->add($chefLieu);
            $chefLieu->setRegion($this);
        }

        return $this;
    }

    public function removeChefLieu(Departement $chefLieu): static
    {
        if ($this->chefLieu->removeElement($chefLieu)) {
            // set the owning side to null (unless already changed)
            if ($chefLieu->getRegion() === $this) {
                $chefLieu->setRegion(null);
            }
        }

        return $this;
    }

}
