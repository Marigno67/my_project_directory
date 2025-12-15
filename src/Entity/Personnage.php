<?php

namespace App\Entity;

use App\Repository\PersonnageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PersonnageRepository::class)]
class Personnage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['personnage:read', 'modeDeJeu:read:details', 'personnage:read:details'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['personnage:read', 'modeDeJeu:read:details', 'personnage:read:details'])]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['personnage:read', 'modeDeJeu:read:details', 'personnage:read:details'])]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['personnage:read', 'modeDeJeu:read:details', 'personnage:read:details'])]
    private ?string $image = null;

    /**
     * @var Collection<int, Build>
     */
    #[ORM\OneToMany(targetEntity: Build::class, mappedBy: 'personnage')]
    #[Groups(['personnage:read:details'])]
    private Collection $builds;

    /**
     * @var Collection<int, StatistiquePersonnage>
     */
    #[ORM\ManyToMany(targetEntity: StatistiquePersonnage::class, mappedBy: 'personnages')]
    #[Groups(['personnage:read:details'])]
    private Collection $statistiques;

    #[ORM\ManyToOne(inversedBy: 'personnages', fetch: 'EAGER')]
    #[Groups(['personnage:read', 'personnage:read:details'])]
    private ?Element $element = null;

    #[ORM\ManyToOne(inversedBy: 'personnages', fetch: 'EAGER')]
    #[Groups(['personnage:read', 'personnage:read:details'])]
    private ?Role $role = null;

    /**
     * @var Collection<int, PersonnageNoyau>
     */
    #[ORM\OneToMany(targetEntity: PersonnageNoyau::class, mappedBy: 'personnage', orphanRemoval: true)]
    #[Groups(['personnage:read:details'])]
    private Collection $personnageNoyaux;

    public function __construct()
    {
        $this->builds = new ArrayCollection();
        $this->statistiques = new ArrayCollection();
        $this->personnageNoyaux = new ArrayCollection();
    }

    // ... (tout le reste de vos getters et setters)
    
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return Collection<int, Build>
     */
    public function getBuilds(): Collection
    {
        return $this->builds;
    }

    public function addBuild(Build $build): static
    {
        if (!$this->builds->contains($build)) {
            $this->builds->add($build);
            $build->setPersonnage($this);
        }
        return $this;
    }

    public function removeBuild(Build $build): static
    {
        if ($this->builds->removeElement($build)) {
            // set the owning side to null (unless already changed)
            if ($build->getPersonnage() === $this) {
                $build->setPersonnage(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, StatistiquePersonnage>
     */
    public function getStatistiques(): Collection
    {
        return $this->statistiques;
    }

    public function addStatistique(StatistiquePersonnage $statistique): static
    {
        if (!$this->statistiques->contains($statistique)) {
            $this->statistiques->add($statistique);
            $statistique->addPersonnage($this);
        }
        return $this;
    }

    public function removeStatistique(StatistiquePersonnage $statistique): static
    {
        if ($this->statistiques->removeElement($statistique)) {
            $statistique->removePersonnage($this);
        }
        return $this;
    }

    public function getElement(): ?Element
    {
        return $this->element;
    }

    public function setElement(?Element $element): static
    {
        $this->element = $element;
        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): static
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return Collection<int, PersonnageNoyau>
     */
    public function getPersonnageNoyaux(): Collection
    {
        return $this->personnageNoyaux;
    }

    public function addPersonnageNoyau(PersonnageNoyau $personnageNoyau): static
    {
        if (!$this->personnageNoyaux->contains($personnageNoyau)) {
            $this->personnageNoyaux->add($personnageNoyau);
            $personnageNoyau->setPersonnage($this);
        }
        return $this;
    }

    public function removePersonnageNoyau(PersonnageNoyau $personnageNoyau): static
    {
        if ($this->personnageNoyaux->removeElement($personnageNoyau)) {
            if ($personnageNoyau->getPersonnage() === $this) {
                $personnageNoyau->setPersonnage(null);
            }
        }
        return $this;
    }

    public function __toString(): string
    {
        return $this->nom ?? '';
    }
}