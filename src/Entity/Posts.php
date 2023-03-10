<?php

namespace App\Entity;

use App\Repository\PostsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostsRepository::class)]
class Posts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'UserPost')]
    private ?User $created_id = null;

    #[ORM\OneToMany(mappedBy: 'post_id', targetEntity: Comments::class)]
    private Collection $CommentPost;

    public function __construct()
    {
        $this->CommentPost = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreated_Id(): ?User
    {
        return $this->created_id;
    }

    public function setCreated_Id(?User $created_id): self
    {
        $this->created_id = $created_id;

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getComments(): Collection
    {
        return $this->CommentPost;
    }

    public function addCommentPost(Comments $commentPost): self
    {
        if (!$this->CommentPost->contains($commentPost)) {
            $this->CommentPost->add($commentPost);
            $commentPost->setPostId($this);
        }

        return $this;
    }

    public function removeCommentPost(Comments $commentPost): self
    {
        if ($this->CommentPost->removeElement($commentPost)) {
            // set the owning side to null (unless already changed)
            if ($commentPost->getPostId() === $this) {
                $commentPost->setPostId(null);
            }
        }

        return $this;
    }
}
