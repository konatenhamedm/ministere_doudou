<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

    #[ORM\Column(length: 255)]
    private ?string $sigle = null;

    #[ORM\Column(length: 255)]
    private ?string $codeProjet = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDebutProjet = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateFinProjet = null;

    #[ORM\Column(length: 255)]
    private ?string $boitePostale = null;

    #[ORM\Column(length: 255)]
    private ?string $contactsProjet = null;

    #[ORM\Column(length: 255)]
    private ?string $fax = null;

    #[ORM\Column(length: 255)]
    private ?string $siteWebProjet = null;

    #[ORM\Column]
    private ?bool $statutProjet = null;

    #[ORM\Column(length: 255)]
    private ?string $emailInfoProjet = null;



    #[ORM\Column(type: Types::TEXT)]
    private ?string $situationGeoProjet = null;

    #[ORM\ManyToOne(inversedBy: 'projets')]
    private ?Pays $pays = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): static
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    public function setSigle(string $sigle): static
    {
        $this->sigle = $sigle;

        return $this;
    }

    public function getCodeProjet(): ?string
    {
        return $this->codeProjet;
    }

    public function setCodeProjet(string $codeProjet): static
    {
        $this->codeProjet = $codeProjet;

        return $this;
    }

    public function getDateDebutProjet(): ?\DateTimeInterface
    {
        return $this->dateDebutProjet;
    }

    public function setDateDebutProjet(\DateTimeInterface $dateDebutProjet): static
    {
        $this->dateDebutProjet = $dateDebutProjet;

        return $this;
    }

    public function getDateFinProjet(): ?\DateTimeInterface
    {
        return $this->dateFinProjet;
    }

    public function setDateFinProjet(\DateTimeInterface $dateFinProjet): static
    {
        $this->dateFinProjet = $dateFinProjet;

        return $this;
    }

    public function getBoitePostale(): ?string
    {
        return $this->boitePostale;
    }

    public function setBoitePostale(string $boitePostale): static
    {
        $this->boitePostale = $boitePostale;

        return $this;
    }

    public function getContactsProjet(): ?string
    {
        return $this->contactsProjet;
    }

    public function setContactsProjet(string $contactsProjet): static
    {
        $this->contactsProjet = $contactsProjet;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(string $fax): static
    {
        $this->fax = $fax;

        return $this;
    }

    public function getSiteWebProjet(): ?string
    {
        return $this->siteWebProjet;
    }

    public function setSiteWebProjet(string $siteWebProjet): static
    {
        $this->siteWebProjet = $siteWebProjet;

        return $this;
    }

    public function isStatutProjet(): ?bool
    {
        return $this->statutProjet;
    }

    public function setStatutProjet(bool $statutProjet): static
    {
        $this->statutProjet = $statutProjet;

        return $this;
    }

    public function getEmailInfoProjet(): ?string
    {
        return $this->emailInfoProjet;
    }

    public function setEmailInfoProjet(string $emailInfoProjet): static
    {
        $this->emailInfoProjet = $emailInfoProjet;

        return $this;
    }

 
    public function getSituationGeoProjet(): ?string
    {
        return $this->situationGeoProjet;
    }

    public function setSituationGeoProjet(string $situationGeoProjet): static
    {
        $this->situationGeoProjet = $situationGeoProjet;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): static
    {
        $this->pays = $pays;

        return $this;
    }
}
