<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreRepository::class)]
class Offre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $titreOffre = null;

    #[ORM\Column(length: 255)]
    private ?string $villeOffre = null;

    #[ORM\Column(length: 255)]
    private ?string $codePostalOffre = null;

    #[ORM\Column(length: 255)]
    private ?string $typeOffre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $resumeOffre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenuOffre = null;

    #[ORM\ManyToOne(inversedBy: 'lesOffres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PartenaireEntreprise $entreprise = null;

    #[ORM\ManyToMany(targetEntity: Competence::class)]
    private Collection $competences;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreOffre(): ?string
    {
        return $this->titreOffre;
    }

    public function setTitreOffre(string $titreOffre): static
    {
        $this->titreOffre = $titreOffre;

        return $this;
    }

    public function getVilleOffre(): ?string
    {
        return $this->villeOffre;
    }

    public function setVilleOffre(string $villeOffre): static
    {
        $this->villeOffre = $villeOffre;

        return $this;
    }

    public function getCodePostalOffre(): ?string
    {
        return $this->codePostalOffre;
    }

    public function setCodePostalOffre(string $codePostalOffre): static
    {
        $this->codePostalOffre = $codePostalOffre;

        return $this;
    }

    public function getTypeOffre(): ?string
    {
        return $this->typeOffre;
    }

    public function setTypeOffre(string $typeOffre): static
    {
        $this->typeOffre = $typeOffre;

        return $this;
    }

    public function getResumeOffre(): ?string
    {
        return $this->resumeOffre;
    }

    public function setResumeOffre(string $resumeOffre): static
    {
        $this->resumeOffre = $resumeOffre;

        return $this;
    }

    public function getContenuOffre(): ?string
    {
        return $this->contenuOffre;
    }

    public function setContenuOffre(string $contenuOffre): static
    {
        $this->contenuOffre = $contenuOffre;

        return $this;
    }

    public function getEntreprise(): ?PartenaireEntreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?PartenaireEntreprise $entreprise): static
    {
        $this->entreprise = $entreprise;

        return $this;
    }


    /**
     * @return Collection<int, Competence>
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competence $competence): static
    {
        if (!$this->competences->contains($competence)) {
            $this->competences->add($competence);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): static
    {
        $this->competences->removeElement($competence);

        return $this;
    }
}
