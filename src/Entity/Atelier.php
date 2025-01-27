<?php

namespace App\Entity;

use App\Repository\AtelierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AtelierRepository::class)]
class Atelier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\OneToMany(mappedBy: 'atelier', targetEntity: DocumentAtelier::class)]
    private Collection $documentAteliers;

    public function __construct()
    {
        $this->documentAteliers = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * @return Collection<int, DocumentAtelier>
     */
    public function getDocumentAteliers(): Collection
    {
        return $this->documentAteliers;
    }

    public function addDocumentAtelier(DocumentAtelier $documentAtelier): static
    {
        if (!$this->documentAteliers->contains($documentAtelier)) {
            $this->documentAteliers->add($documentAtelier);
            $documentAtelier->setAtelier($this);
        }

        return $this;
    }

    public function removeDocumentAtelier(DocumentAtelier $documentAtelier): static
    {
        if ($this->documentAteliers->removeElement($documentAtelier)) {
            // set the owning side to null (unless already changed)
            if ($documentAtelier->getAtelier() === $this) {
                $documentAtelier->setAtelier(null);
            }
        }

        return $this;
    }

    
}
