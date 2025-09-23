<?php

namespace App\Entity;

use App\Repository\SetArtefactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SetArtefactRepository::class)]
class SetArtefact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['setArtefact:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['setArtefact:read'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['setArtefact:read'])]
    private ?string $sousTitre = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['setArtefact:read'])]
    private ?string $image = null;

    /**
     * @var Collection<int, BonusSet>
     */
    #[ORM\OneToMany(targetEntity: BonusSet::class, mappedBy: 'setArtefact', orphanRemoval: true)]
    #[Groups(['setArtefact:read'])]
    private Collection $bonus;

    public function __construct()
    {
        $this->bonus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSousTitre(): ?string
    {
        return $this->sousTitre;
    }

    public function setSousTitre(?string $sousTitre): static
    {
        $this->sousTitre = $sousTitre;

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
     * @return Collection<int, BonusSet>
     */
    public function getBonus(): Collection
    {
        return $this->bonus;
    }

    public function addBonu(BonusSet $bonu): static
    {
        if (!$this->bonus->contains($bonu)) {
            $this->bonus->add($bonu);
            $bonu->setSetArtefact($this);
        }

        return $this;
    }

    public function removeBonu(BonusSet $bonu): static
    {
        if ($this->bonus->removeElement($bonu)) {
            // set the owning side to null (unless already changed)
            if ($bonu->getSetArtefact() === $this) {
                $bonu->setSetArtefact(null);
            }
        }

        return $this;
    }
}
