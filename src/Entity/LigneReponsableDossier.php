<?php

namespace App\Entity;

use App\Repository\LigneReponsableDossierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LigneReponsableDossierRepository::class)]
class LigneReponsableDossier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ligneReponsableDossiers',cascade: ['persist'])]
    private ?Employe $responsable = null;

    

    #[ORM\ManyToOne(inversedBy: 'ligneReponsableDossier',cascade: ['persist'])]
    private ?Dossier $dossier = null;

    #[ORM\ManyToOne(inversedBy: 'ligneReponsableDossiers',cascade: ['persist'])]
    private ?LigneEtape $ligneEtape = null;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResponsable(): ?Employe
    {
        return $this->responsable;
    }

    public function setResponsable(?Employe $responsable): static
    {
        $this->responsable = $responsable;

        return $this;
    }

   
    public function getDossier(): ?Dossier
    {
        return $this->dossier;
    }

    public function setDossier(?Dossier $dossier): static
    {
        $this->dossier = $dossier;

        return $this;
    }

    public function getLigneEtape(): ?LigneEtape
    {
        return $this->ligneEtape;
    }

    public function setLigneEtape(?LigneEtape $ligneEtape): static
    {
        $this->ligneEtape = $ligneEtape;

        return $this;
    }
}
