<?php

namespace App\Entity;

use App\Repository\CountyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CountyRepository::class)
 */
class County
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
    private $county;

    /**
     * @ORM\OneToMany(targetEntity=Job::class, mappedBy="county")
     */
    private $jobs;

    /**
     * @ORM\OneToMany(targetEntity=JobAssigned::class, mappedBy="county")
     */
    private $jobAssigneds;

    /**
     * @ORM\OneToMany(targetEntity=MyJobApplications::class, mappedBy="county")
     */
    private $myJobApplications;

    public function __construct()
    {
        $this->jobs = new ArrayCollection();
        $this->jobAssigneds = new ArrayCollection();
        $this->myJobApplications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCounty(): ?string
    {
        return $this->county;
    }

    public function setCounty(string $county): self
    {
        $this->county = $county;

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
            $job->setCounty($this);
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        if ($this->jobs->removeElement($job)) {
            // set the owning side to null (unless already changed)
            if ($job->getCounty() === $this) {
                $job->setCounty(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->county;
    }

    /**
     * @return Collection|JobAssigned[]
     */
    public function getJobAssigneds(): Collection
    {
        return $this->jobAssigneds;
    }

    public function addJobAssigned(JobAssigned $jobAssigned): self
    {
        if (!$this->jobAssigneds->contains($jobAssigned)) {
            $this->jobAssigneds[] = $jobAssigned;
            $jobAssigned->setCounty($this);
        }

        return $this;
    }

    public function removeJobAssigned(JobAssigned $jobAssigned): self
    {
        if ($this->jobAssigneds->removeElement($jobAssigned)) {
            // set the owning side to null (unless already changed)
            if ($jobAssigned->getCounty() === $this) {
                $jobAssigned->setCounty(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MyJobApplications[]
     */
    public function getMyJobApplications(): Collection
    {
        return $this->myJobApplications;
    }

    public function addMyJobApplication(MyJobApplications $myJobApplication): self
    {
        if (!$this->myJobApplications->contains($myJobApplication)) {
            $this->myJobApplications[] = $myJobApplication;
            $myJobApplication->setCounty($this);
        }

        return $this;
    }

    public function removeMyJobApplication(MyJobApplications $myJobApplication): self
    {
        if ($this->myJobApplications->removeElement($myJobApplication)) {
            // set the owning side to null (unless already changed)
            if ($myJobApplication->getCounty() === $this) {
                $myJobApplication->setCounty(null);
            }
        }

        return $this;
    }
}
