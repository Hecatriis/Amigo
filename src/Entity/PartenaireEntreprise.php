<?php

namespace App\Entity;

use App\Repository\PartenaireEntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: PartenaireEntrepriseRepository::class)]
class PartenaireEntreprise extends Partenaire
{

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: Offre::class)]
    private Collection $lesOffres;

    public function __construct()
    {
        $this->lesOffres = new ArrayCollection();
    }


    /**
     * @return Collection<int, Offre>
     */
    public function getLesOffres(): Collection
    {
        return $this->lesOffres;
    }

    public function addLesOffre(Offre $lesOffre): static
    {
        if (!$this->lesOffres->contains($lesOffre)) {
            $this->lesOffres->add($lesOffre);
            $lesOffre->setEntreprise($this);
        }

        return $this;
    }

    public function removeLesOffre(Offre $lesOffre): static
    {
        if ($this->lesOffres->removeElement($lesOffre)) {
            // set the owning side to null (unless already changed)
            if ($lesOffre->getEntreprise() === $this) {
                $lesOffre->setEntreprise(null);
            }
        }

        return $this;
    }
}
