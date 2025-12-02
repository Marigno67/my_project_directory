<?php

namespace App\Entity;

use App\Repository\ElementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ElementRepository::class)]
class Element
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['personnage:read', 'personnage:read:details', 'element:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['personnage:read', 'personnage:read:details', 'element:read'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['personnage:read', 'personnage:read:details', 'element:read'])]
    private ?string $icone = null;

    /**
     * @var Collection<int, Personnage>
     */
    #[ORM\OneToMany(targetEntity: Personnage::class, mappedBy: 'element')]
    private Collection $personnages;

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

    public function getIcone(): ?string
    {
        return $this->icone;
    }

    public function setIcone(?string $icone): static
    {
        $this->icone = $icone;

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom ?? '';
    }

    /**
     * @return Collection<int, Personnage>
     */
    public function getPersonnages(): Collection
    {
        return $this->personnages;
    }

    public function addPersonnage(Personnage $personnage): static
    {
        if (!$this->personnages->contains($personnage)) {
            $this->personnages->add($personnage);
            $personnage->setElement($this);
        }

        return $this;
    }

    public function removePersonnage(Personnage $personnage): static
    {
        if ($this->personnages->removeElement($personnage)) {
            // set the owning side to null (unless already changed)
            if ($personnage->getElement() === $this) {
                $personnage->setElement(null);
            }
        }

        return $this;
    }
}
