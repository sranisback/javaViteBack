<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $modele = null;

    /**
     * @var Collection<int, Pilote>
     */
    #[ORM\ManyToMany(targetEntity: Pilote::class, inversedBy: 'cars')]
    private Collection $piloteId;

    public function __construct()
    {
        $this->piloteId = new ArrayCollection();
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

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * @return Collection<int, Pilote>
     */
    public function getPiloteId(): Collection
    {
        return $this->piloteId;
    }

    public function addPiloteId(Pilote $piloteId): static
    {
        if (!$this->piloteId->contains($piloteId)) {
            $this->piloteId->add($piloteId);
        }

        return $this;
    }

    public function removePiloteId(Pilote $piloteId): static
    {
        $this->piloteId->removeElement($piloteId);

        return $this;
    }
}
