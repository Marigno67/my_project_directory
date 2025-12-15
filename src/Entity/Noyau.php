<?php

namespace App\Entity;

use App\Repository\NoyauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: NoyauRepository::class)]
class Noyau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['noyau:read', 'build:read:details', 'ensembleNoyau:read', 'personnage:read:details'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['noyau:read', 'personnage:read:details', 'ensembleNoyau:read'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['noyau:read', 'personnage:read:details', 'ensembleNoyau:read'])]
    private ?string $image = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['noyau:read', 'personnage:read:details', 'ensembleNoyau:read'])]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'noyaux')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['noyau:read'])]
    private ?EnsembleNoyau $ensemble = null;

    /**
     * @var Collection<int, PersonnageNoyau>
     */
    #[ORM\OneToMany(targetEntity: PersonnageNoyau::class, mappedBy: 'noyau', orphanRemoval: true)]
    private Collection $personnageNoyaux;

    public function __construct()
    {
        $this->personnageNoyaux = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

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

    public function getEnsemble(): ?EnsembleNoyau
    {
        return $this->ensemble;
    }

    public function setEnsemble(?EnsembleNoyau $ensemble): static
    {
        $this->ensemble = $ensemble;

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
            $personnageNoyau->setNoyau($this);
        }

        return $this;
    }

    public function removePersonnageNoyau(PersonnageNoyau $personnageNoyau): static
    {
        if ($this->personnageNoyaux->removeElement($personnageNoyau)) {
            if ($personnageNoyau->getNoyau() === $this) {
                $personnageNoyau->setNoyau(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom ?? '';
    }
}
