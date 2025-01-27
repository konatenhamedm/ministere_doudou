<?php

namespace App\Entity;

use App\Repository\TypePlanRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypePlanRepository::class)]
class TypePlan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libTypePlan = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibTypePlan(): ?string
    {
        return $this->libTypePlan;
    }

    public function setLibTypePlan(string $libTypePlan): static
    {
        $this->libTypePlan = $libTypePlan;

        return $this;
    }
}
