<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RaceDataRepository;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: RaceDataRepository::class)]
class RaceData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $pseudo = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Ecurie $ecurie = null;

    #[ORM\Column(nullable: true)]
    private ?int $classement = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbCoups = null;

    #[ORM\Column(nullable: true)]
    private ?int $meilleurTour = null;

    #[ORM\Column(nullable: true)]
    private ?int $grille = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $elimination = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $essais = null;

    #[ORM\ManyToOne(inversedBy: 'data')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Race $race = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getEcurie(): ?Ecurie
    {
        return $this->ecurie;
    }

    public function setEcurie(?Ecurie $ecurie): static
    {
        $this->ecurie = $ecurie;

        return $this;
    }

    public function getClassement(): ?int
    {
        return $this->classement;
    }

    public function setClassement(?int $classement): static
    {
        $this->classement = $classement;

        return $this;
    }

    public function getNbCoups(): ?int
    {
        return $this->nbCoups;
    }

    public function setNbCoups(?int $nbCoups): static
    {
        $this->nbCoups = $nbCoups;

        return $this;
    }

    public function getMeilleurTour(): ?int
    {
        return $this->meilleurTour;
    }

    public function setMeilleurTour(?int $meilleurTour): static
    {
        $this->meilleurTour = $meilleurTour;

        return $this;
    }

    public function getGrille(): ?int
    {
        return $this->grille;
    }

    public function setGrille(?int $grille): static
    {
        $this->grille = $grille;

        return $this;
    }

    public function getElimination(): ?string
    {
        return $this->elimination;
    }

    public function setElimination(?string $elimination): static
    {
        $this->elimination = $elimination;

        return $this;
    }

    public function getEssais(): ?string
    {
        return $this->essais;
    }

    public function setEssais(?string $essais): static
    {
        $this->essais = $essais;

        return $this;
    }

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): static
    {
        $this->race = $race;

        return $this;
    }
}
