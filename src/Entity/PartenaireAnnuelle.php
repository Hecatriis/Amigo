<?php

namespace App\Entity;

use App\Repository\PartenaireAnnuelleRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: PartenaireAnnuelleRepository::class)]
class PartenaireAnnuelle extends Partenaire
{
}
