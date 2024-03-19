<?php

namespace App\Entity;

use App\Repository\ContentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: ContentRepository::class)]
class Content
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $textAccueil = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $textPresentation = null;

    #[ORM\Column(length: 255)]
    private ?string $mailAmigo = null;

    #[ORM\Column(length: 10)]
    private ?string $telephone = null;

    #[Vich\UploadableField(mapping: 'content', fileNameProperty: 'logoName')]
    private ?File $logo = null;

    #[ORM\Column(nullable: true)]
    private ?string $logoName = null;

    #[Vich\UploadableField(mapping: 'content', fileNameProperty: 'imageAccueilName')]
    private ?File $imageAccueil = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageAccueilName = null;

    #[Vich\UploadableField(mapping: 'content', fileNameProperty: 'iconeSiteName')]
    private ?File $iconeSite = null;

    #[ORM\Column(nullable: true)]
    private ?string $iconeSiteName = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogo(): ?File
    {
        return $this->logo;
    }

    public function setLogo(?File $logo): static
    {
        $this->logo = $logo;
        return $this;
    }

    public function getLogoName(): ?string
    {
        return $this->logoName;
    }

    public function setLogoName(?string $logoName): static
    {
        $this->logoName = $logoName;
        return $this;
    }

    public function getImageAccueil(): ?File
    {
        return $this->imageAccueil;
    }

    public function setImageAccueil(?File $imageAccueil): static
    {
        $this->imageAccueil = $imageAccueil;
        return $this;
    }

    public function getImageAccueilName(): ?string
    {
        return $this->imageAccueilName;
    }

    public function setImageAccueilName(?string $imageAccueilName): static
    {
        $this->imageAccueilName = $imageAccueilName;
        return $this;
    }

    public function getIconeSite(): ?File
    {
        return $this->iconeSite;
    }

    public function setIconeSite(?File $iconeSite): static
    {
        $this->iconeSite = $iconeSite;
        return $this;
    }

    public function getIconeSiteName(): ?string
    {
        return $this->iconeSiteName;
    }

    public function setIconeSiteName(?string $iconeSiteName): static
    {
        $this->iconeSiteName = $iconeSiteName;
        return $this;
    }



    public function getTextAccueil(): ?string
    {
        return $this->textAccueil;
    }

    public function setTextAccueil(string $textAccueil): static
    {
        $this->textAccueil = $textAccueil;

        return $this;
    }

    public function getTextPresentation(): ?string
    {
        return $this->textPresentation;
    }

    public function setTextPresentation(string $textPresentation): static
    {
        $this->textPresentation = $textPresentation;

        return $this;
    }

    public function getMailAmigo(): ?string
    {
        return $this->mailAmigo;
    }

    public function setMailAmigo(string $mailAmigo): static
    {
        $this->mailAmigo = $mailAmigo;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }
}
