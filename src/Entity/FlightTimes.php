<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FlightTimesRepository")
 * @ORM\Table(name="flight_times")
 */
class FlightTimes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\NotBlank()
     */
    private $flight_code;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $flight_from;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $flight_to;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $flight_date;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $flight_time;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $flight_arrival_time;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFlightCode(): ?string
    {
        return $this->flight_code;
    }

    public function setFlightCode(string $flight_code): self
    {
        $this->flight_code = $flight_code;

        return $this;
    }

    public function getFlightFrom(): ?string
    {
        return $this->flight_from;
    }

    public function setFlightFrom(string $flight_from): self
    {
        $this->flight_from = $flight_from;

        return $this;
    }

    public function getFlightTo(): ?string
    {
        return $this->flight_to;
    }

    public function setFlightTo(string $flight_to): self
    {
        $this->flight_to = $flight_to;

        return $this;
    }

    public function getFlightDate(): ?string
    {
        return $this->flight_date;
    }

    public function setFlightDate(string $flight_date): self
    {
        $this->flight_date = $flight_date;

        return $this;
    }

    public function getFlightTime(): ?string
    {
        return $this->flight_time;
    }

    public function setFlightTime(string $flight_time): self
    {
        $this->flight_time = $flight_time;

        return $this;
    }

    public function getFlightArrivalTime(): ?string
    {
        return $this->flight_arrival_time;
    }

    public function setFlightArrivalTime(string $flight_arrival_time): self
    {
        $this->flight_arrival_time = $flight_arrival_time;

        return $this;
    }
}
