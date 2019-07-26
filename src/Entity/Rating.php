<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RatingRepository")
 */
class Rating
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
    private $star;



    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="ratings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $personName;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hotel", inversedBy="ratings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hotelName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStar(): ?int
    {
        return $this->star;
    }

    public function setStar(int $star): self
    {
        $this->star = $star;

        return $this;
    }


    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPersonName(): ?Person
    {
        return $this->personName;
    }

    public function setPersonName(?Person $personName): self
    {
        $this->personName = $personName;

        return $this;
    }

    public function getHotelName(): ?Hotel
    {
        return $this->hotelName;
    }

    public function setHotelName(?Hotel $hotelName): self
    {
        $this->hotelName = $hotelName;

        return $this;
    }
}
