<?php

namespace App\Entity;

use App\Repository\NodeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NodeRepository::class)
 */
class Node
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userName;

    /**
     * @ORM\Column(type="float")
     */
    private $creditsLeft;

    /**
     * @ORM\Column(type="float")
     */
    private $creditsRight;

    /**
     * @ORM\OneToOne(targetEntity=Node::class, cascade={"persist", "remove"})
     */
    private $childLeft;

    /**
     * @ORM\OneToOne(targetEntity=Node::class, cascade={"persist", "remove"})
     */
    private $childRight;

    /**
     * @ORM\ManyToOne(targetEntity=Node::class)
     */
    private $parent;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    public function getCreditsLeft(): ?float
    {
        return $this->creditsLeft;
    }

    public function setCreditsLeft(float $creditsLeft): self
    {
        $this->creditsLeft = $creditsLeft;

        return $this;
    }

    public function getCreditsRight(): ?float
    {
        return $this->creditsRight;
    }

    public function setCreditsRight(float $creditsRight): self
    {
        $this->creditsRight = $creditsRight;

        return $this;
    }

    public function getChildLeft(): ?self
    {
        return $this->childLeft;
    }

    public function setChildLeft(?self $childLeft): self
    {
        $this->childLeft = $childLeft;

        return $this;
    }

    public function getChildRight(): ?self
    {
        return $this->childRight;
    }

    public function setChildRight(?self $childRight): self
    {
        $this->childRight = $childRight;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent($parent): void
    {
        $this->parent = $parent;
    }
}
