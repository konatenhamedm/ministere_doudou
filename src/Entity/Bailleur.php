<?php

namespace App\Entity;

use App\Repository\BailleurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BailleurRepository::class)]
class Bailleur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $sigle = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $montant = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $pourcentage = null;

    #[ORM\Column(length: 255)]
    private ?string $adresseMail = null;

    #[ORM\ManyToOne(inversedBy: 'bailleurs')]
    private ?TypeFinancement $typeFinancement = null;

    #[ORM\OneToMany(mappedBy: 'bailleur', targetEntity: Interlocuteur::class)]
    private Collection $interlocuteurs;

    public function __construct()
    {
        $this->interlocuteurs = new ArrayCollection();
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

    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    public function setSigle(string $sigle): static
    {
        $this->sigle = $sigle;

        return $this;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getPourcentage(): ?int
    {
        return $this->pourcentage;
    }

    public function setPourcentage(int $pourcentage): static
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }

    public function getAdresseMail(): ?string
    {
        return $this->adresseMail;
    }

    public function setAdresseMail(string $adresseMail): static
    {
        $this->adresseMail = $adresseMail;

        return $this;
    }

    public function getTypeFinancement(): ?TypeFinancement
    {
        return $this->typeFinancement;
    }

    public function setTypeFinancement(?TypeFinancement $typeFinancement): static
    {
        $this->typeFinancement = $typeFinancement;

        return $this;
    }

    /**
     * @return Collection<int, Interlocuteur>
     */
    public function getInterlocuteurs(): Collection
    {
        return $this->interlocuteurs;
    }

    public function addInterlocuteur(Interlocuteur $interlocuteur): static
    {
        if (!$this->interlocuteurs->contains($interlocuteur)) {
            $this->interlocuteurs->add($interlocuteur);
            $interlocuteur->setBailleur($this);
        }

        return $this;
    }

    public function removeInterlocuteur(Interlocuteur $interlocuteur): static
    {
        if ($this->interlocuteurs->removeElement($interlocuteur)) {
            // set the owning side to null (unless already changed)
            if ($interlocuteur->getBailleur() === $this) {
                $interlocuteur->setBailleur(null);
            }
        }

        return $this;
    }
}
