<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity=Job::class, mappedBy="creator")
     */
    private $jobs;

    /**
     * @ORM\OneToMany(targetEntity=JobCompleted::class, mappedBy="creator")
     */
    private $jobCompleteds;

    /**
     * @ORM\OneToMany(targetEntity=JobApplication::class, mappedBy="tradeperson")
     */
    private $jobApplications;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contactNumber;

    /**
     * @ORM\ManyToOne(targetEntity=Trade::class, inversedBy="users")
     */
    private $trade;

    /**
     * @ORM\OneToMany(targetEntity=JobAssigned::class, mappedBy="creator")
     */
    private $jobAssigneds;

    public function __construct()
    {
        $this->jobs = new ArrayCollection();
        $this->jobCompleteds = new ArrayCollection();
        $this->jobApplications = new ArrayCollection();
        $this->jobAssigneds = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return [$this->role];
    }


    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

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
            $job->setCreator($this);
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        if ($this->jobs->removeElement($job)) {
            // set the owning side to null (unless already changed)
            if ($job->getCreator() === $this) {
                $job->setCreator(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->email;
    }






    /**
     * @return Collection|JobCompleted[]
     */
    public function getJobCompleteds(): Collection
    {
        return $this->jobCompleteds;
    }

    public function addJobCompleted(JobCompleted $jobCompleted): self
    {
        if (!$this->jobCompleteds->contains($jobCompleted)) {
            $this->jobCompleteds[] = $jobCompleted;
            $jobCompleted->setCreator($this);
        }

        return $this;
    }

    public function removeJobCompleted(JobCompleted $jobCompleted): self
    {
        if ($this->jobCompleteds->removeElement($jobCompleted)) {
            // set the owning side to null (unless already changed)
            if ($jobCompleted->getCreator() === $this) {
                $jobCompleted->setCreator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|JobApplication[]
     */
    public function getJobApplications(): Collection
    {
        return $this->jobApplications;
    }

    public function addJobApplication(JobApplication $jobApplication): self
    {
        if (!$this->jobApplications->contains($jobApplication)) {
            $this->jobApplications[] = $jobApplication;
            $jobApplication->setTradeperson($this);
        }

        return $this;
    }

    public function removeJobApplication(JobApplication $jobApplication): self
    {
        if ($this->jobApplications->removeElement($jobApplication)) {
            // set the owning side to null (unless already changed)
            if ($jobApplication->getTradeperson() === $this) {
                $jobApplication->setTradeperson(null);
            }
        }

        return $this;
    }

    public function getContactNumber(): ?string
    {
        return $this->contactNumber;
    }

    public function setContactNumber(string $contactNumber): self
    {
        $this->contactNumber = $contactNumber;

        return $this;
    }

    public function getTrade(): ?Trade
    {
        return $this->trade;
    }

    public function setTrade(?Trade $trade): self
    {
        $this->trade = $trade;

        return $this;
    }

//    /**
//     * @return Collection|JobAssigned[]
//     */
//    public function getJobAssigneds(): Collection
//    {
//        return $this->jobAssigneds;
//    }
//
//    public function addJobAssigned(JobAssigned $jobAssigned): self
//    {
//        if (!$this->jobAssigneds->contains($jobAssigned)) {
//            $this->jobAssigneds[] = $jobAssigned;
//            $jobAssigned->setCreator($this);
//        }
//
//        return $this;
//    }
//
//    public function removeJobAssigned(JobAssigned $jobAssigned): self
//    {
//        if ($this->jobAssigneds->removeElement($jobAssigned)) {
//            // set the owning side to null (unless already changed)
//            if ($jobAssigned->getCreator() === $this) {
//                $jobAssigned->setCreator(null);
//            }
//        }
//
//        return $this;
//    }


}
