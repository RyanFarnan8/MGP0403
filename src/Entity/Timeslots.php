<?php

namespace App\Entity;

use App\Repository\TimeslotsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TimeslotsRepository::class)
 */
class Timeslots
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
    private $timeslots;

    /**
     * @ORM\OneToMany(targetEntity=Job::class, mappedBy="timeslots")
     */
    private $jobs;

    public function __construct()
    {
        $this->jobs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimeslots(): ?string
    {
        return $this->timeslots;
    }

    public function setTimeslots(string $timeslots): self
    {
        $this->timeslots = $timeslots;

        return $this;
    }

    /**
     * @return Collection|Job[]
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    public function addJob(Job $job): self
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs[] = $job;
            $job->setTimeslots($this);
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        if ($this->jobs->removeElement($job)) {
            // set the owning side to null (unless already changed)
            if ($job->getTimeslots() === $this) {
                $job->setTimeslots(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->timeslots;
    }
}
