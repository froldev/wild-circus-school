<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SchoolClassRepository")
 */
class SchoolClass
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Positive
     * @Assert\NotBlank
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Positive
     * @Assert\NotBlank
     */
    private $price;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     * @Assert\NotBlank
     */
    private $startDate;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $picture;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artist", mappedBy="schoolClass")
     * @Assert\NotBlank
     */
    private $artists;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Inscription", inversedBy="schoolClasses")
     */
    private $inscription;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="schoolClass")
     * @Assert\NotBlank
     */
    private $category;

    public function __construct()
    {
        $this->artists = new ArrayCollection();
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

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStartDate(): ?DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(DateTime $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

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

    /**
     * @return Collection|Artist[]
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(Artist $artist): self
    {
        if (!$this->artists->contains($artist)) {
            $this->artists[] = $artist;
            $artist->addSchoolClass($this);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): self
    {
        if ($this->artists->contains($artist)) {
            $this->artists->removeElement($artist);
            $artist->removeSchoolClass($this);
        }

        return $this;
    }

    public function getInscription(): ?inscription
    {
        return $this->inscription;
    }

    public function setInscription(?inscription $inscription): self
    {
        $this->inscription = $inscription;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
