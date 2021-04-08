<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Scalar\String_;


/**
 * @ORM\Entity(repositoryClass=JobRepository::class)
 */
class Job
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;





    /**
     * @ORM\Column(type="string")
     */
    private $contact;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="jobs")
     */
    private $creator;

    /**
     * @ORM\ManyToOne(targetEntity=Trade::class, inversedBy="jobs")
     */
    private $trade;


    /**
     * @ORM\ManyToOne(targetEntity=County::class, inversedBy="jobs")
     */
    private $county;

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getContact(): ?String
    {
        return $this->contact;
    }

    public function setContact(String $contact): self
    {
        $this->contact = $contact;

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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): self
    {
        $this->creator = $creator;

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

    public function __toString()
    {
        return $this->id . ', '.$this->description;
    }




    public function getCounty(): ?County
    {
        return $this->county;
    }

    public function setCounty(?County $county): self
    {
        $this->county = $county;

        return $this;
    }


}
