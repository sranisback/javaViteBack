<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_USER_NAME', fields: ['userName'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $userName = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * @var Collection<int, Pilote>
     */
    #[ORM\OneToMany(mappedBy: 'userId', targetEntity: Pilote::class, orphanRemoval: true)]
    private Collection $pilotes;

    /**
     * @var Collection<int, Championnat>
     */
    #[ORM\ManyToMany(targetEntity: Championnat::class, mappedBy: 'userParticipant')]
    private Collection $championnatSubscribed;

    public function __construct()
    {
        $this->pilotes = new ArrayCollection();
        $this->championnatSubscribed = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): static
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->userName;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Pilote>
     */
    public function getPilotes(): Collection
    {
        return $this->pilotes;
    }

    public function addPilote(Pilote $pilote): static
    {
        if (!$this->pilotes->contains($pilote)) {
            $this->pilotes->add($pilote);
            $pilote->setUser($this);
        }

        return $this;
    }

    public function removePilote(Pilote $pilote): static
    {
        if ($this->pilotes->removeElement($pilote)) {
            // set the owning side to null (unless already changed)
            if ($pilote->getUser() === $this) {
                $pilote->setUser(null);
            }
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
            $championnatSubscribed->addUserParticipant($this);
        }

        return $this;
    }

    public function removeChampionnatSubscribed(Championnat $championnatSubscribed): static
    {
        if ($this->championnatSubscribed->removeElement($championnatSubscribed)) {
            $championnatSubscribed->removeUserParticipant($this);
        }

        return $this;
    }
}
