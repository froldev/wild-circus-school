<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtistRepository")
 */
class Artist
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
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    private $picture;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\SchoolClass", inversedBy="artists")
     * @Assert\NotBlank
     */
    private $schoolClass;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
        $this->schoolClass = new ArrayCollection();
        $this->categories = new ArrayCollection();
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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|SchoolClass[]
     */
    public function getSchoolClass(): Collection
    {
        return $this->schoolClass;
    }

    public function addSchoolClass(SchoolClass $schoolClass): self
    {
        if (!$this->schoolClass->contains($schoolClass)) {
            $this->schoolClass[] = $schoolClass;
        }

        return $this;
    }

    public function removeSchoolClass(SchoolClass $schoolClass): self
    {
        if ($this->schoolClass->contains($schoolClass)) {
            $this->schoolClass->removeElement($schoolClass);
        }

        return $this;
    }
}
