<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CircuitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: CircuitRepository::class)]
class Circuit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Race>
     */
    #[ORM\OneToMany(mappedBy: 'circuit', targetEntity: Race::class, orphanRemoval: true)]
    private Collection $racePlayed;

    public function __construct()
    {
        $this->racePlayed = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
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
     * @return Collection<int, Race>
     */
    public function getRacePlayed(): Collection
    {
        return $this->racePlayed;
    }

    public function addRacePlayed(Race $racePlayed): static
    {
        if (!$this->racePlayed->contains($racePlayed)) {
            $this->racePlayed->add($racePlayed);
            $racePlayed->setCircuit($this);
        }

        return $this;
    }

    public function removeRacePlayed(Race $racePlayed): static
    {
        if ($this->racePlayed->removeElement($racePlayed)) {
            // set the owning side to null (unless already changed)
            if ($racePlayed->getCircuit() === $this) {
                $racePlayed->setCircuit(null);
            }
        }

        return $this;
    }

}
