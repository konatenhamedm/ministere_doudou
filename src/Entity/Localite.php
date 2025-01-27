<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


#[ORM\MappedSuperclass]
abstract class Localite
{
    #[ORM\Column(columnDefinition: "TINYINT(1) NOT NULL DEFAULT 1")]
   
    protected int $etat;

    #[ORM\Column(name: "date_creation", type: "date", nullable: true)]
   
    #[Gedmo\Timestampable(on: "create")]
    protected ?\DateTime $dateCreation = null;

    public function setDateCreation(?\DateTime $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateCreation(): ?\DateTime
    {
        return $this->dateCreation;
    }

  

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getEtat(): int
    {
        return $this->etat;
    }
}
