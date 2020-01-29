<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InscriptionRepository")
 */
class Inscription
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Internship", inversedBy="inscription")
     */
    private $internship;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SchoolClass", mappedBy="inscription")
     */
    private $schoolClasses;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isValidate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="inscription")
     */
    private $users;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->schoolClasses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInternship(): ?Internship
    {
        return $this->internship;
    }

    public function setInternship(?Internship $internship): self
    {
        $this->internship = $internship;

        return $this;
    }

    /**
     * @return Collection|SchoolClass[]
     */
    public function getSchoolClasses(): Collection
    {
        return $this->schoolClasses;
    }

    public function addSchoolClass(SchoolClass $schoolClass): self
    {
        if (!$this->schoolClasses->contains($schoolClass)) {
            $this->schoolClasses[] = $schoolClass;
            $schoolClass->setInscription($this);
        }

        return $this;
    }

    public function removeSchoolClass(SchoolClass $schoolClass): self
    {
        if ($this->schoolClasses->contains($schoolClass)) {
            $this->schoolClasses->removeElement($schoolClass);
            // set the owning side to null (unless already changed)
            if ($schoolClass->getInscription() === $this) {
                $schoolClass->setInscription(null);
            }
        }

        return $this;
    }

    public function getIsValidate(): ?bool
    {
        return $this->isValidate;
    }

    public function setIsValidate(bool $isValidate): self
    {
        $this->isValidate = $isValidate;

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
            $user->addInscription($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeInscription($this);
        }

        return $this;
    }
}
