<?php

namespace App\Entity;

use App\Repository\CompteRenduRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: CompteRenduRepository::class)]
class CompteRendu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    private string $introduction;

    #[ORM\Column(type: 'text')]
    private string $resultat;

    #[ORM\Column(type: 'text')]
    private string $objectif;

    #[ORM\Column(type: 'text')]
    private string $details;

    #[ORM\Column(type: 'text')]
    private string $conclusion;

    #[ORM\Column(type: 'text')]
    private string $contexte;

    #[ORM\OneToOne(targetEntity: Mission::class, inversedBy: 'compteRendu')]
    #[ORM\JoinColumn(nullable: false)]
    private Mission $mission;

    #[ORM\ManyToOne(targetEntity: Employe::class)]
    #[Assert\NotBlank(message: 'Veuillez renseigner le rédacteur')]
    private ?Employe $redacteur = null;

    #[ORM\Column(type: 'date')]
    private \DateTimeInterface $dateCr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntroduction(): string
    {
        return $this->introduction;
    }

    public function setIntroduction(string $introduction): self
    {
        $this->introduction = $introduction;

        return $this;
    }

    public function getResultat(): string
    {
        return $this->resultat;
    }

    public function setResultat(string $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }

    public function getObjectif(): string
    {
        return $this->objectif;
    }

    public function setObjectif(string $objectif): self
    {
        $this->objectif = $objectif;

        return $this;
    }

    public function getDetails(): string
    {
        return $this->details;
    }

    public function setDetails(string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getConclusion(): string
    {
        return $this->conclusion;
    }

    public function setConclusion(string $conclusion): self
    {
        $this->conclusion = $conclusion;

        return $this;
    }

    public function getContexte(): string
    {
        return $this->contexte;
    }

    public function setContexte(string $contexte): self
    {
        $this->contexte = $contexte;

        return $this;
    }

    public function getMission(): Mission
    {
        return $this->mission;
    }

    public function setMission(Mission $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getRedacteur(): ?Employe
    {
        return $this->redacteur;
    }

    public function setRedacteur(?Employe $redacteur): self
    {
        $this->redacteur = $redacteur;

        return $this;
    }

    public function getDateCr(): \DateTimeInterface
    {
        return $this->dateCr;
    }

    public function setDateCr(\DateTimeInterface $dateCr): self
    {
        $this->dateCr = $dateCr;

        return $this;
    }
}
