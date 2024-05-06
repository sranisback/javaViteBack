<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: RaceRepository::class)]
class Race
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToOne(inversedBy: 'racePlayer', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Circuit $circuit = null;

    #[ORM\OneToOne(inversedBy: 'raceCommissaire', cascade: ['persist', 'remove'])]
    private ?Commissaire $commissaire = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbJoueurs = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbTours = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbEssais = null;

    #[ORM\Column(nullable: true)]
    private ?int $meteoEssais = null;

    #[ORM\Column(nullable: true)]
    private ?int $MeteoDepart = null;

    #[ORM\Column(nullable: true)]
    private ?bool $regleTOP = null;

    #[ORM\Column(nullable: true)]
    private ?bool $regleTOPmotor = null;

    #[ORM\Column(nullable: true)]
    private ?bool $regleSuperTop = null;

    #[ORM\Column(nullable: true)]
    private ?bool $regleGlissadesReduites = null;

    /**
     * @var Collection<int, RaceData>
     */
    #[ORM\OneToMany(mappedBy: 'race', targetEntity: RaceData::class, orphanRemoval: true)]
    private Collection $data;

    public function __construct()
    {
        $this->data = new ArrayCollection();
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getCircuit(): ?Circuit
    {
        return $this->circuit;
    }

    public function setCircuit(Circuit $circuit): static
    {
        $this->circuit = $circuit;

        return $this;
    }

    public function getCommissaire(): ?Commissaire
    {
        return $this->commissaire;
    }

    public function setCommissaire(?Commissaire $commissaire): static
    {
        $this->commissaire = $commissaire;

        return $this;
    }

    public function getNbJoueurs(): ?int
    {
        return $this->nbJoueurs;
    }

    public function setNbJoueurs(?int $nbJoueurs): static
    {
        $this->nbJoueurs = $nbJoueurs;

        return $this;
    }

    public function getNbTours(): ?int
    {
        return $this->nbTours;
    }

    public function setNbTours(?int $nbTours): static
    {
        $this->nbTours = $nbTours;

        return $this;
    }

    public function getNbEssais(): ?int
    {
        return $this->nbEssais;
    }

    public function setNbEssais(?int $nbEssais): static
    {
        $this->nbEssais = $nbEssais;

        return $this;
    }

    public function getMeteoEssais(): ?int
    {
        return $this->meteoEssais;
    }

    public function setMeteoEssais(?int $meteoEssais): static
    {
        $this->meteoEssais = $meteoEssais;

        return $this;
    }

    public function getMeteoDepart(): ?int
    {
        return $this->MeteoDepart;
    }

    public function setMeteoDepart(?int $MeteoDepart): static
    {
        $this->MeteoDepart = $MeteoDepart;

        return $this;
    }

    public function isRegleTOP(): ?bool
    {
        return $this->regleTOP;
    }

    public function setRegleTOP(?bool $regleTOP): static
    {
        $this->regleTOP = $regleTOP;

        return $this;
    }

    public function isRegleTOPmotor(): ?bool
    {
        return $this->regleTOPmotor;
    }

    public function setRegleTOPmotor(?bool $regleTOPmotor): static
    {
        $this->regleTOPmotor = $regleTOPmotor;

        return $this;
    }

    public function isRegleSuperTop(): ?bool
    {
        return $this->regleSuperTop;
    }

    public function setRegleSuperTop(bool $regleSuperTop): static
    {
        $this->regleSuperTop = $regleSuperTop;

        return $this;
    }

    public function isRegleGlissadesReduites(): ?bool
    {
        return $this->regleGlissadesReduites;
    }

    public function setRegleGlissadesReduites(?bool $regleGlissadesReduites): static
    {
        $this->regleGlissadesReduites = $regleGlissadesReduites;

        return $this;
    }

    /**
     * @return Collection<int, RaceData>
     */
    public function getData(): Collection
    {
        return $this->data;
    }

    public function addData(RaceData $data): static
    {
        if (!$this->data->contains($data)) {
            $this->data->add($data);
            $data->setRace($this);
        }

        return $this;
    }

    public function removeData(RaceData $data): static
    {
        if ($this->data->removeElement($data)) {
            // set the owning side to null (unless already changed)
            if ($data->getRace() === $this) {
                $data->setRace(null);
            }
        }

        return $this;
    }
}
