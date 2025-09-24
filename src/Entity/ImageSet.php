<?php

namespace App\Entity;

use App\Repository\ImageSetRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use DateTimeImmutable; // AJOUTER CET IMPORT

#[ORM\Entity(repositoryClass: ImageSetRepository::class)]
#[Vich\Uploadable]
class ImageSet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['setArtefact:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)] // Rendu nullable pour que l'entité puisse être créée avant que Vich ne nomme le fichier
    #[Groups(['setArtefact:read'])]
    private ?string $path = null;

    #[Vich\UploadableField(mapping: 'artefacts', fileNameProperty: 'path')]
    private ?File $imageFile = null;

    // AJOUTER CETTE PROPRIÉTÉ
    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SetArtefact $setArtefact = null;

    public function __construct()
    {
        // Initialiser la date à la création
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): static
    {
        $this->path = $path;
        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        // C'EST LA LIGNE LA PLUS IMPORTANTE
        // Si un fichier est uploadé, on met à jour la date.
        // C'est le "signal" pour que VichUploaderBundle s'active.
        if (null !== $imageFile) {
            $this->updatedAt = new DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getSetArtefact(): ?SetArtefact
    {
        return $this->setArtefact;
    }

    public function setSetArtefact(?SetArtefact $setArtefact): static
    {
        $this->setArtefact = $setArtefact;
        return $this;
    }

    // AJOUTER les getters/setters pour updatedAt
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}