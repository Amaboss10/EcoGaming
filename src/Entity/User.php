<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'created_id', targetEntity: Posts::class)]
    private Collection $UserPost;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: Comments::class)]
    private Collection $UserComment;

    public function __construct()
    {
        $this->UserPost = new ArrayCollection();
        $this->UserComment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, Posts>
     */
    public function getUserPost(): Collection
    {
        return $this->UserPost;
    }

    public function addUserPost(Posts $userPost): self
    {
        if (!$this->UserPost->contains($userPost)) {
            $this->UserPost->add($userPost);
            $userPost->setCreatedId($this);
        }

        return $this;
    }

    public function removeUserPost(Posts $userPost): self
    {
        if ($this->UserPost->removeElement($userPost)) {
            // set the owning side to null (unless already changed)
            if ($userPost->getCreatedId() === $this) {
                $userPost->setCreatedId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getUserComment(): Collection
    {
        return $this->UserComment;
    }

    public function addUserComment(Comments $userComment): self
    {
        if (!$this->UserComment->contains($userComment)) {
            $this->UserComment->add($userComment);
            $userComment->setUserId($this);
        }

        return $this;
    }

    public function removeUserComment(Comments $userComment): self
    {
        if ($this->UserComment->removeElement($userComment)) {
            // set the owning side to null (unless already changed)
            if ($userComment->getUserId() === $this) {
                $userComment->setUserId(null);
            }
        }

        return $this;
    }
}
