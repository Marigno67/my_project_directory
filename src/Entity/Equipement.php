<?php

namespace App\Entity;

use App\Repository\EquipementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EquipementRepository::class)]
class Equipement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['equipement:read', 'build:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['equipement:read', 'build:read'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['equipement:read', 'build:read'])]
    private ?string $emplacement = null;

    /**
     * @var Collection<int, Build>
     */
    #[ORM\ManyToMany(targetEntity: Build::class, inversedBy: 'equipements')]
    private Collection $builds;

    public function __construct()
    {
        $this->builds = new ArrayCollection();
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

    public function getEmplacement(): ?string
    {
        return $this->emplacement;
    }

    public function setEmplacement(string $emplacement): static
    {
        $this->emplacement = $emplacement;

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
        }

        return $this;
    }

    public function removeBuild(Build $build): static
    {
        $this->builds->removeElement($build);

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom;
    }
}