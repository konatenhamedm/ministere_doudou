<?php

namespace App\Entity;

use App\Repository\HistoriqueMissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoriqueMissionRepository::class)]
class HistoriqueMission
{


       #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private string $commentaire;

    #[ORM\Column(type: "datetime")]
    private \DateTime $dateHistorique;

    // #[ORM\ManyToOne(targetEntity: Etat::class)]
    // #[ORM\JoinColumn(nullable: false)]
    // private Etat $etat;

    #[ORM\ManyToOne(targetEntity: Mission::class, inversedBy: "historique")]
    #[ORM\JoinColumn(nullable: false)]
    private Mission $mission;

    #[ORM\ManyToOne(inversedBy: 'historique')]
    private ?Mission $missions = null;


    public function __construct()
    {
        $this->dateHistorique = new \DateTime();
       
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getCommentaire(): string
    {
        return $this->commentaire;
    }

    public function setDateHistorique(\DateTime $dateHistorique): self
    {
        $this->dateHistorique = $dateHistorique;

        return $this;
    }

    public function getDateHistorique(): \DateTime
    {
        return $this->dateHistorique;
    }

    public function setMission(Mission $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getMission(): Mission
    {
        return $this->mission;
    }

    // public function setEtat(Etat $etat): self
    // {
    //     $this->etat = $etat;

    //     return $this;
    // }

    // public function getEtat(): Etat
    // {
    //     return $this->etat;
    // }

    /**
     * @return Collection<int, Mission>
     */

    public function getMissions(): ?Mission
    {
        return $this->missions;
    }

    public function setMissions(?Mission $missions): static
    {
        $this->missions = $missions;

        return $this;
    }
  
    
}
