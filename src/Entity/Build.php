<?php

namespace App\Entity;

use App\Repository\BuildRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BuildRepository::class)]
class Build
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['build:read', 'personnage:read', 'modeDeJeu:read:details'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['build:read', 'personnage:read', 'modeDeJeu:read:details'])]
    private ?string $titre = null;

    #[ORM\ManyToOne(inversedBy: 'builds')]
    #[Groups(['build:read', 'modeDeJeu:read:details'])]
    private ?Personnage $personnage = null;

    #[ORM\ManyToOne(inversedBy: 'builds')]
    #[Groups(['build:read', 'personnage:read'])]
    private ?ModeDeJeu $modeDeJeu = null;

    /**
     * @var Collection<int, Equipement>
     */
    #[ORM\ManyToMany(targetEntity: Equipement::class, inversedBy: 'builds')]
    #[Groups(['build:read', 'personnage:read'])]
    private Collection $equipements;

    public function __construct()
    {
        $this->equipements = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Equipement>
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipement $equipement): static
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): static
    {
        $this->equipements->removeElement($equipement);

        return $this;
    }

    public function __toString(): string
    {
        return $this->titre;
    }
}