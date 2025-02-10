<?php

namespace App\Entity;

use App\Repository\DocumentAtelierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentAtelierRepository::class)]
class DocumentAtelier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(cascade: ["persist"], fetch: "EAGER")]
    #[ORM\JoinColumn(nullable: true)]
    private ?FichierAdmin $fichier = null;

    #[ORM\ManyToOne(inversedBy: 'documentAteliers', cascade: ['persist'])]
    private ?Atelier $atelier = null;




    public function getId(): ?int
    {
        return $this->id;
    }
    public function getFichier(): ?FichierAdmin
    {
        return $this->fichier;
    }

    public function setFichier(?FichierAdmin $fichier): self
    {

        $this->fichier = $fichier;



        return $this;
    }

    public function getAtelier(): ?Atelier
    {
        return $this->atelier;
    }

    public function setAtelier(?Atelier $atelier): static
    {
        $this->atelier = $atelier;

        return $this;
    }

    
   
}
