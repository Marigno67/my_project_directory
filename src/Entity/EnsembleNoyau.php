<?php

namespace App\Entity;

use App\Repository\EnsembleNoyauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EnsembleNoyauRepository::class)]
class EnsembleNoyau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['noyau:read', 'ensembleNoyau:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['noyau:read', 'ensembleNoyau:read'])]
    private ?string $nom = null;

    /**
     * @var Collection<int, Noyau>
     */
    #[ORM\OneToMany(targetEntity: Noyau::class, mappedBy: 'ensemble')]
    #[Groups(['ensembleNoyau:read'])]
    private Collection $noyaux;

    public function __construct()
    {
        $this->noyaux = new ArrayCollection();
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

    /**
     * @return Collection<int, Noyau>
     */
    public function getNoyaux(): Collection
    {
        return $this->noyaux;
    }

    public function addNoyau(Noyau $noyau): static
    {
        if (!$this->noyaux->contains($noyau)) {
            $this->noyaux->add($noyau);
            $noyau->setEnsemble($this);
        }

        return $this;
    }

    public function removeNoyau(Noyau $noyau): static
    {
        if ($this->noyaux->removeElement($noyau)) {
            if ($noyau->getEnsemble() === $this) {
                $noyau->setEnsemble(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom ?? '';
    }
}
