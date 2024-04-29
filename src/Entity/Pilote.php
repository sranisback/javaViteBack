<?php

namespace App\Entity;

use App\Repository\PiloteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PiloteRepository::class)]
class Pilote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'pilotes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    /**
     * @var Collection<int, Voiture|null>
     */
    #[ORM\ManyToMany(targetEntity: Voiture::class, mappedBy: 'piloteId')]
    private Collection $cars;

    /**
     * @var Collection<int, Championnat|null>
     */
    #[ORM\ManyToMany(targetEntity: Championnat::class, mappedBy: 'PilotParticipant')]
    private Collection $championnatSubscribed;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
        $this->championnatSubscribed = new ArrayCollection();
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

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

    /**
     * @return Collection<int, Championnat>
     */
    public function getChampionnatSubscribed(): Collection
    {
        return $this->championnatSubscribed;
    }

    public function addChampionnatSubscribed(Championnat $championnatSubscribed): static
    {
        if (!$this->championnatSubscribed->contains($championnatSubscribed)) {
            $this->championnatSubscribed->add($championnatSubscribed);
            $championnatSubscribed->addPilotParticipant($this);
        }

        return $this;
    }

    public function removeChampionnatSubscribed(Championnat $championnatSubscribed): static
    {
        if ($this->championnatSubscribed->removeElement($championnatSubscribed)) {
            $championnatSubscribed->removePilotParticipant($this);
        }

        return $this;
    }
}
