<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetenceRepository::class)]
class Competence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelleCompetence = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleCompetence(): ?string
    {
        return $this->libelleCompetence;
    }

    public function setLibelleCompetence(string $libelleCompetence): static
    {
        $this->libelleCompetence = $libelleCompetence;

        return $this;
    }
}
