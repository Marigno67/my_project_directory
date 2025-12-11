<?php

namespace App\Entity;

use App\Repository\BuildNoyauRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BuildNoyauRepository::class)]
class BuildNoyau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['build:read:details'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'buildNoyaux')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Build $build = null;

    #[ORM\ManyToOne(inversedBy: 'buildNoyaux')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['build:read:details'])]
    private ?Noyau $noyau = null;

    #[ORM\Column]
    #[Groups(['build:read:details'])]
    private ?int $priorite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBuild(): ?Build
    {
        return $this->build;
    }

    public function setBuild(?Build $build): static
    {
        $this->build = $build;

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
