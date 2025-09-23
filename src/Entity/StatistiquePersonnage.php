<?php

namespace App\Entity;

use App\Repository\StatistiquePersonnageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: StatistiquePersonnageRepository::class)]
class StatistiquePersonnage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['personnage:read:details'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['personnage:read:details'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['personnage:read:details'])]
    private ?string $valeur = null;

    /**
     * @var Collection<int, Personnage>
     */
    // MODIFIÉ : La relation est maintenant ManyToMany
    #[ORM\ManyToMany(targetEntity: Personnage::class, inversedBy: 'statistiques')]
    private Collection $personnages;

    // MODIFIÉ : Le constructeur est nécessaire pour initialiser la collection
    public function __construct()
    {
        $this->personnages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getValeur(): ?string
    {
        return $this->valeur;
    }

    public function setValeur(string $valeur): static
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * @return Collection<int, Personnage>
     */
    // MODIFIÉ : Les méthodes pour gérer la collection de personnages
    public function getPersonnages(): Collection
    {
        return $this->personnages;
    }

    public function addPersonnage(Personnage $personnage): static
    {
        if (!$this->personnages->contains($personnage)) {
            $this->personnages->add($personnage);
        }

        return $this;
    }

    public function removePersonnage(Personnage $personnage): static
    {
        $this->personnages->removeElement($personnage);

        return $this;
    }
    
    public function __toString(): string
    {
        return $this->nom ?? '';
    }
}