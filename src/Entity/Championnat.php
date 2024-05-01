<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ChampionnatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: ChampionnatRepository::class)]
class Championnat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'championnatSubscribed')]
    private Collection $userParticipant;

    /**
     * @var Collection<int, Pilote>
     */
    #[ORM\ManyToMany(targetEntity: Pilote::class, inversedBy: 'championnats')]
    private Collection $pilotesParticipants;

    public function __construct()
    {
        $this->userParticipant = new ArrayCollection();
        $this->PilotParticipant = new ArrayCollection();
        $this->pilotesParticipants = new ArrayCollection();
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
     * @return Collection<int, User>
     */
    public function getUserParticipant(): Collection
    {
        return $this->userParticipant;
    }

    public function addUserParticipant(User $userParticipant): static
    {
        if (!$this->userParticipant->contains($userParticipant)) {
            $this->userParticipant->add($userParticipant);
        }

        return $this;
    }

    public function removeUserParticipant(User $userParticipant): static
    {
        $this->userParticipant->removeElement($userParticipant);

        return $this;
    }

    /**
     * @return Collection<int, Pilote>
     */
    public function getPilotesParticipants(): Collection
    {
        return $this->pilotesParticipants;
    }

    public function addPilotesParticipant(Pilote $pilotesParticipant): static
    {
        if (!$this->pilotesParticipants->contains($pilotesParticipant)) {
            $this->pilotesParticipants->add($pilotesParticipant);
        }

        return $this;
    }

    public function removePilotesParticipant(Pilote $pilotesParticipant): static
    {
        $this->pilotesParticipants->removeElement($pilotesParticipant);

        return $this;
    }

}
