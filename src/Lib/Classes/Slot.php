<?php

Namespace Application\Lib\Classes;

class Slot
{
    
    private int $slotId;
    private \DateTimeImmutable $dateStart;
    private \DateTimeImmutable $dateEnd;
    private string $sector;
    private int $maxPlaces;
    private int $countPlaces;
    private int $userId;

    public function __construct(array $slot)
    {
        $this->slotId = $slot['slot_id'];
        $this->dateStart = new \DateTimeImmutable($slot['date_start']);
        $this->dateEnd = new \DateTimeImmutable($slot['date_end']);
        $this->sector = $slot['sector'];
        $this->maxPlaces = $slot['max_places'];
        $this->countPlaces = $slot['count_places'];
        $this->userId = $slot['user_id'];
    }

    public function getSlotId()
    {
        return $this->slotId;
    }

    public function setSlotId(int $data)
    {
        $this->slotId = $data;
    }


    public function getDateStart()
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeImmutable $data)
    {
        $this->dateStart = $data;
    }


    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeImmutable $data)
    {
        $this->dateEnd = $data;
    }


    public function getSector()
    {
        return $this->sector;
    }

    public function setSector(string $data)
    {
        $this->sector = $data;
    }


    public function getMaxPlaces()
    {
        return $this->maxPlaces;
    }

    public function setMaxPlaces(int $data)
    {
        $this->maxPlaces = $data;
    }


    public function getCountPlaces()
    {
        return $this->countPlaces;
    }

    public function setCountPlaces(int $data)
    {
        $this->countPlaces = $data;
    }


    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId(int $data)
    {
        $this->userId = $data;
    }

}