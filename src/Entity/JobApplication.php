<?php

namespace App\Entity;

use App\Repository\JobApplicationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobApplicationRepository::class)
 */
class JobApplication
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Job::class, inversedBy="jobApplications")
     */
    private $job;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="jobApplications")
     */
    private $tradeperson;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getJob(): ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getTradeperson(): ?User
    {
        return $this->tradeperson;
    }

    public function setTradeperson(?User $tradeperson): self
    {
        $this->tradeperson = $tradeperson;

        return $this;
    }
}
