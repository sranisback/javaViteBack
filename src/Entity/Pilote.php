<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PiloteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: PiloteRepository::class)]
class Pilote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    /**
     * @var Collection<int, Voiture|null>
     */
    #[ORM\ManyToMany(targetEntity: Voiture::class, mappedBy: 'piloteId')]
    private Collection $cars;

    #[ORM\ManyToOne(inversedBy: 'pilotes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $ownedBy = null;

    /**
     * @var Collection<int, Championnat>
     */
    #[ORM\ManyToMany(targetEntity: Championnat::class, mappedBy: 'pilotesParticipants')]
    private Collection $championnats;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
        $this->championnats = new ArrayCollection();
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Voiture>
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Voiture $car): static
    {
        if (!$this->cars->contains($car)) {
            $this->cars->add($car);
            $car->addPiloteId($this);
        }

        return $this;
    }

    public function removeCar(Voiture $car): static
    {
        if ($this->cars->removeElement($car)) {
            $car->removePiloteId($this);
        }

        return $this;
    }

    public function getOwnedBy(): ?User
    {
        return $this->ownedBy;
    }

    public function setOwnedBy(?User $ownedBy): static
    {
        $this->ownedBy = $ownedBy;

        return $this;
    }

    /**
     * @return Collection<int, Championnat>
     */
    public function getChampionnats(): Collection
    {
        return $this->championnats;
    }

    public function addChampionnat(Championnat $championnat): static
    {
        if (!$this->championnats->contains($championnat)) {
            $this->championnats->add($championnat);
            $championnat->addPilotesParticipant($this);
        }

        return $this;
    }

    public function removeChampionnat(Championnat $championnat): static
    {
        if ($this->championnats->removeElement($championnat)) {
            $championnat->removePilotesParticipant($this);
        }

        return $this;
    }
}
