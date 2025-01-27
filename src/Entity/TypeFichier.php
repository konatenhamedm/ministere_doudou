<?php

namespace App\Entity;

use App\Repository\TypeFichierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeFichierRepository::class)]
class TypeFichier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'typeFichier', targetEntity: PieceJointeMission::class)]
    private Collection $pieceJointeMissions;

    public function __construct()
    {
        $this->pieceJointeMissions = new ArrayCollection();
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
     * @return Collection<int, PieceJointeMission>
     */
    public function getPieceJointeMissions(): Collection
    {
        return $this->pieceJointeMissions;
    }

    public function addPieceJointeMission(PieceJointeMission $pieceJointeMission): static
    {
        if (!$this->pieceJointeMissions->contains($pieceJointeMission)) {
            $this->pieceJointeMissions->add($pieceJointeMission);
            $pieceJointeMission->setTypeFichier($this);
        }

        return $this;
    }

    public function removePieceJointeMission(PieceJointeMission $pieceJointeMission): static
    {
        if ($this->pieceJointeMissions->removeElement($pieceJointeMission)) {
            // set the owning side to null (unless already changed)
            if ($pieceJointeMission->getTypeFichier() === $this) {
                $pieceJointeMission->setTypeFichier(null);
            }
        }

        return $this;
    }
}
