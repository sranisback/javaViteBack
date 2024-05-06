<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CommissaireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: CommissaireRepository::class)]
class Commissaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $nom = null;

    #[ORM\OneToOne(mappedBy: 'commissaire', cascade: ['persist', 'remove'])]
    private ?Race $raceCommissaire = null;

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

    public function getRaceCommissaire(): ?Race
    {
        return $this->raceCommissaire;
    }

    public function setRaceCommissaire(?Race $raceCommissaire): static
    {
        // unset the owning side of the relation if necessary
        if ($raceCommissaire === null && $this->raceCommissaire !== null) {
            $this->raceCommissaire->setCommissaire(null);
        }

        // set the owning side of the relation if necessary
        if ($raceCommissaire !== null && $raceCommissaire->getCommissaire() !== $this) {
            $raceCommissaire->setCommissaire($this);
        }

        $this->raceCommissaire = $raceCommissaire;

        return $this;
    }
}
