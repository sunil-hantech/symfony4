<?php

namespace App\Entity;

use App\Repository\TodoRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=TodoRepository::class)
 */
class Todo
{
    use TimestampableEntity;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tile;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    // /**
    //  * @ORM\Column(type="datetime")
    //  */
    // private $createdAt;

    // /**
    //  * @ORM\Column(type="datetime")
    //  */
    // private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTile(): ?string
    {
        return $this->tile;
    }

    public function setTile(string $tile): self
    {
        $this->tile = $tile;

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

    // public function getCreatedAt(): ?\DateTimeInterface
    // {
    //     return $this->createdAt;
    // }

    // public function setCreatedAt(\DateTimeInterface $createdAt): self
    // {
    //     $this->createdAt = $createdAt;

    //     return $this;
    // }

    // public function getUpdatedAt(): ?\DateTimeInterface
    // {
    //     return $this->updatedAt;
    // }

    // public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    // {
    //     $this->updatedAt = $updatedAt;

    //     return $this;
    // }
}
