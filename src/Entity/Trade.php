<?php

namespace App\Entity;

use App\Repository\TradeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TradeRepository::class)
 */
class Trade
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
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=Job::class, mappedBy="trade")
     */
    private $jobs;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="trade")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=JobAssigned::class, mappedBy="trade")
     */
    private $jobAssigneds;

    /**
     * @ORM\OneToMany(targetEntity=MyJobApplications::class, mappedBy="trade")
     */
    private $myJobApplications;

    public function __construct()
    {
        $this->jobs = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->jobAssigneds = new ArrayCollection();
        $this->myJobApplications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function __toString()
    {
        return $this->title;
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
            $job->setTrade($this);
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        if ($this->jobs->removeElement($job)) {
            // set the owning side to null (unless already changed)
            if ($job->getTrade() === $this) {
                $job->setTrade(null);
            }
        }

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
            $user->setTrade($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getTrade() === $this) {
                $user->setTrade(null);
            }
        }

        return $this;
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
            $jobAssigned->setTrade($this);
        }

        return $this;
    }

    public function removeJobAssigned(JobAssigned $jobAssigned): self
    {
        if ($this->jobAssigneds->removeElement($jobAssigned)) {
            // set the owning side to null (unless already changed)
            if ($jobAssigned->getTrade() === $this) {
                $jobAssigned->setTrade(null);
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
            $myJobApplication->setTrade($this);
        }

        return $this;
    }

    public function removeMyJobApplication(MyJobApplications $myJobApplication): self
    {
        if ($this->myJobApplications->removeElement($myJobApplication)) {
            // set the owning side to null (unless already changed)
            if ($myJobApplication->getTrade() === $this) {
                $myJobApplication->setTrade(null);
            }
        }

        return $this;
    }
}
