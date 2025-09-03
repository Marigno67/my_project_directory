<?php

namespace App\Entity;

use App\Repository\BuildRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BuildRepository::class)]
class Build
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['build:read', 'personnage:read', 'modeDeJeu:read'])] // Ajoutez le nouveau groupe
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['build:read', 'personnage:read', 'modeDeJeu:read'])] // Ajoutez le nouveau groupe
    private ?string $titre = null;

    #[ORM\ManyToOne(inversedBy: 'builds')]
    #[Groups(['modeDeJeu:read'])] // Ajoutez le nouveau groupe
    private ?Personnage $personnage = null;

    #[ORM\ManyToOne(inversedBy: 'builds')]
    #[Groups(['build:read', 'personnage:read'])]
    private ?ModeDeJeu $modeDeJeu = null;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPersonnage(): ?Personnage
    {
        return $this->personnage;
    }

    public function setPersonnage(?Personnage $personnage): static
    {
        $this->personnage = $personnage;

        return $this;
    }

    public function getModeDeJeu(): ?ModeDeJeu
    {
        return $this->modeDeJeu;
    }

    public function setModeDeJeu(?ModeDeJeu $modeDeJeu): static
    {
        $this->modeDeJeu = $modeDeJeu;

        return $this;
    }
    
    public function __toString(): string
    {
        return $this->titre;
    }
}