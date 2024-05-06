<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CircuitRepository;
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

    #[ORM\OneToOne(mappedBy: 'circuit', cascade: ['persist', 'remove'])]
    private ?Race $racePlayer = null;

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

    public function getRacePlayer(): ?Race
    {
        return $this->racePlayer;
    }

    public function setRacePlayer(Race $racePlayer): static
    {
        // set the owning side of the relation if necessary
        if ($racePlayer->getCircuit() !== $this) {
            $racePlayer->setCircuit($this);
        }

        $this->racePlayer = $racePlayer;

        return $this;
    }
}
