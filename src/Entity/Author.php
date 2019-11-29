<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuthorRepository")
 */
class Author
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Definition", mappedBy="author")
     */
    private $definition_id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="author_id")
     */
    private $users;

    public function __construct()
    {
        $this->definition_id = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|Definition[]
     */
    public function getDefinitionId(): Collection
    {
        return $this->definition_id;
    }

    public function addDefinitionId(Definition $definitionId): self
    {
        if (!$this->definition_id->contains($definitionId)) {
            $this->definition_id[] = $definitionId;
            $definitionId->setAuthor($this);
        }

        return $this;
    }

    public function removeDefinitionId(Definition $definitionId): self
    {
        if ($this->definition_id->contains($definitionId)) {
            $this->definition_id->removeElement($definitionId);
            // set the owning side to null (unless already changed)
            if ($definitionId->getAuthor() === $this) {
                $definitionId->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addAuthorId($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeAuthorId($this);
        }

        return $this;
    }
}
