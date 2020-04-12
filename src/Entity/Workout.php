<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkoutRepository")
 */
class Workout
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
    private $name;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $gender;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Exercise", inversedBy="workouts")
     */
    private $exercises;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DifficultyLevel", inversedBy="workouts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $difficulty_level;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Goal", inversedBy="workouts")
     */
    private $goal;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="workout")
     */
    private $user;

    public function __construct()
    {
        $this->exercises = new ArrayCollection();
        $this->goal = new ArrayCollection();
        $this->user = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return Collection|Exercise[]
     */
    public function getExercises(): Collection
    {
        return $this->exercises;
    }

    public function addExercise(Exercise $exercise): self
    {
        if (!$this->exercises->contains($exercise)) {
            $this->exercises[] = $exercise;
        }

        return $this;
    }

    public function removeExercise(Exercise $exercise): self
    {
        if ($this->exercises->contains($exercise)) {
            $this->exercises->removeElement($exercise);
        }

        return $this;
    }

    public function getDifficultyLevel(): ?DifficultyLevel
    {
        return $this->difficulty_level;
    }

    public function setDifficultyLevel(?DifficultyLevel $difficulty_level): self
    {
        $this->difficulty_level = $difficulty_level;

        return $this;
    }

    /**
     * @return Collection|Goal[]
     */
    public function getGoal(): Collection
    {
        return $this->goal;
    }

    public function addGoal(Goal $goal): self
    {
        if (!$this->goal->contains($goal)) {
            $this->goal[] = $goal;
        }

        return $this;
    }

    public function removeGoal(Goal $goal): self
    {
        if ($this->goal->contains($goal)) {
            $this->goal->removeElement($goal);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setWorkout($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getWorkout() === $this) {
                $user->setWorkout(null);
            }
        }

        return $this;
    }
}
