<?php

namespace App\Entity;

use App\Repository\ElementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ElementRepository::class)]
class Element
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $pourcentage = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $pourcentageEx = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'enfants')]
    private ?self $element = null;

    #[ORM\OneToMany(mappedBy: 'element', targetEntity: self::class)]
    private Collection $enfants;

    #[ORM\OneToMany(mappedBy: 'element', targetEntity: self::class)]
    private Collection $parent;

    #[ORM\Column]
    private ?int $lft = null;

    #[ORM\Column]
    private ?int $lvl = null;

    #[ORM\Column]
    private ?int $rgt = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'elements')]
    private ?self $root = null;

    #[ORM\OneToMany(mappedBy: 'root', targetEntity: self::class)]
    private Collection $elements;

    public function __construct()
    {
        $this->enfants = new ArrayCollection();
        $this->parent = new ArrayCollection();
        $this->elements = new ArrayCollection();
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getPourcentage(): ?string
    {
        return $this->pourcentage;
    }

    public function setPourcentage(string $pourcentage): static
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }

    public function getPourcentageEx(): ?int
    {
        return $this->pourcentageEx;
    }

    public function setPourcentageEx(int $pourcentageEx): static
    {
        $this->pourcentageEx = $pourcentageEx;

        return $this;
    }

    public function getElement(): ?self
    {
        return $this->element;
    }

    public function setElement(?self $element): static
    {
        $this->element = $element;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getEnfants(): Collection
    {
        return $this->enfants;
    }

    public function addEnfant(self $enfant): static
    {
        if (!$this->enfants->contains($enfant)) {
            $this->enfants->add($enfant);
            $enfant->setElement($this);
        }

        return $this;
    }

    public function removeEnfant(self $enfant): static
    {
        if ($this->enfants->removeElement($enfant)) {
            // set the owning side to null (unless already changed)
            if ($enfant->getElement() === $this) {
                $enfant->setElement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getParent(): Collection
    {
        return $this->parent;
    }

    public function addParent(self $parent): static
    {
        if (!$this->parent->contains($parent)) {
            $this->parent->add($parent);
            $parent->setElement($this);
        }

        return $this;
    }

    public function removeParent(self $parent): static
    {
        if ($this->parent->removeElement($parent)) {
            // set the owning side to null (unless already changed)
            if ($parent->getElement() === $this) {
                $parent->setElement(null);
            }
        }

        return $this;
    }

    public function getLft(): ?int
    {
        return $this->lft;
    }

    public function setLft(int $lft): static
    {
        $this->lft = $lft;

        return $this;
    }

    public function getLvl(): ?int
    {
        return $this->lvl;
    }

    public function setLvl(int $lvl): static
    {
        $this->lvl = $lvl;

        return $this;
    }

    public function getRgt(): ?int
    {
        return $this->rgt;
    }

    public function setRgt(int $rgt): static
    {
        $this->rgt = $rgt;

        return $this;
    }

    public function getRoot(): ?self
    {
        return $this->root;
    }

    public function setRoot(?self $root): static
    {
        $this->root = $root;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getElements(): Collection
    {
        return $this->elements;
    }

    public function addElement(self $element): static
    {
        if (!$this->elements->contains($element)) {
            $this->elements->add($element);
            $element->setRoot($this);
        }

        return $this;
    }

    public function removeElement(self $element): static
    {
        if ($this->elements->removeElement($element)) {
            // set the owning side to null (unless already changed)
            if ($element->getRoot() === $this) {
                $element->setRoot(null);
            }
        }

        return $this;
    }
}
