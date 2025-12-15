<?php

namespace App\Entity;

use App\Repository\PersonnageNoyauRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PersonnageNoyauRepository::class)]
class PersonnageNoyau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['personnage:read:details'])]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Personnage::class, inversedBy: 'personnageNoyaux')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Personnage $personnage = null;

    #[ORM\ManyToOne(targetEntity: Noyau::class, inversedBy: 'personnageNoyaux')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['personnage:read:details'])]
    private ?Noyau $noyau = null;

    #[ORM\Column]
    #[Groups(['personnage:read:details'])]
    private ?int $priorite = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNoyau(): ?Noyau
    {
        return $this->noyau;
    }

    public function setNoyau(?Noyau $noyau): static
    {
        $this->noyau = $noyau;

        return $this;
    }

    public function getPriorite(): ?int
    {
        return $this->priorite;
    }

    public function setPriorite(int $priorite): static
    {
        $this->priorite = $priorite;

        return $this;
    }
}
