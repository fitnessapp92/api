<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrainingDayRepository")
 */
class TrainingDay
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $number_of_day;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberOfDay(): ?int
    {
        return $this->number_of_day;
    }

    public function setNumberOfDay(int $number_of_day): self
    {
        $this->number_of_day = $number_of_day;

        return $this;
    }
}
