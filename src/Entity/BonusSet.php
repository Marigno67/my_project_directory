<?php

namespace App\Entity;

use App\Repository\BonusSetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BonusSetRepository::class)]
class BonusSet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['setArtefact:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['setArtefact:read'])]
    private ?int $nombrePieces = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['setArtefact:read'])]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'bonus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SetArtefact $setArtefact = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombrePieces(): ?int
    {
        return $this->nombrePieces;
    }

    public function setNombrePieces(?int $nombrePieces): static
    {
        $this->nombrePieces = $nombrePieces;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
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
}
