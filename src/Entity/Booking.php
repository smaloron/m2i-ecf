<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="datetime")
     */
    private $enteredAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $checkoutAt;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Room", mappedBy="booking")
     */
    private $room;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Person", inversedBy="bookings")
     */
    private $personName;

    public function __construct()
    {
        $this->room = new ArrayCollection();
        $this->personName = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnteredAt(): ?\DateTimeInterface
    {
        return $this->enteredAt;
    }

    public function setEnteredAt(\DateTimeInterface $enteredAt): self
    {
        $this->enteredAt = $enteredAt;

        return $this;
    }

    public function getCheckoutAt(): ?\DateTimeInterface
    {
        return $this->checkoutAt;
    }

    public function setCheckoutAt(\DateTimeInterface $checkoutAt): self
    {
        $this->checkoutAt = $checkoutAt;

        return $this;
    }



    /**
     * @return Collection|Room[]
     */
    public function getRoom(): Collection
    {
        return $this->room;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->room->contains($room)) {
            $this->room[] = $room;
            $room->setBooking($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->room->contains($room)) {
            $this->room->removeElement($room);
            // set the owning side to null (unless already changed)
            if ($room->getBooking() === $this) {
                $room->setBooking(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Person[]
     */
    public function getPersonName(): Collection
    {
        return $this->personName;
    }

    public function addPersonName(Person $personName): self
    {
        if (!$this->personName->contains($personName)) {
            $this->personName[] = $personName;
        }

        return $this;
    }

    public function removePersonName(Person $personName): self
    {
        if ($this->personName->contains($personName)) {
            $this->personName->removeElement($personName);
        }

        return $this;
    }

}
