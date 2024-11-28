<?php

Namespace Application\Lib\Classes;

use Application\Lib\Tools;

class Request
{

    private int $requestId;
    private string $firstname;
    private string $lastname;
    private string $class;
    private \DateTimeImmutable $birthday;
    private string $parentFirstname;
    private string $parentLastname;
    private string $address;
    private string $email;
    private string $phone;
    private string $mainTeacher;
    private bool $accepted;
    private int $slotId;

    public function __construct(array $request)
    {
        $this->requestId = $request['request_id'];
        $this->firstname = $request['firstname'];
        $this->lastname = $request['lastname'];
        $this->class = $request['class'];
        $this->birthday = new \DateTimeImmutable($request['birthday']);
        $this->parentFirstname = $request['parent_firstname'];
        $this->parentLastname = $request['parent_lastname'];
        $this->address = $request['address'];
        $this->email = $request['email'];
        $this->phone = $request['phone'];
        $this->mainTeacher = $request['main_teacher'];
        $this->accepted = $request['accepted'];
        $this->slotId = $request['slot_id'];
    }

    public function getRequestId()
    {
        return $this->requestId;
    }

    public function setRequestId(int $data)
    {
        $this->requestId = $data;
    }


    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname(string $data)
    {
        $this->firstname = $data;
    }


    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname(string $data)
    {
        $this->lastname = $data;
    }


    public function getClass()
    {
        return $this->class;
    }

    public function setClass(string $data)
    {
        $this->class = $data;
    }


    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeImmutable $data)
    {
        $this->birthday = $data;
    }

    
    public function getParentFirstname()
    {
        return $this->parentFirstname;
    }

    public function setParentFirstname(string $data)
    {
        $this->parentFirstname = $data;
    }


    public function getParentLastname()
    {
        return $this->parentLastname;
    }

    public function setParentLastname(string $data)
    {
        $this->parentLastname = $data;
    }


    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress(string $data)
    {
        $this->address = $data;
    }


    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $data)
    {
        $this->email = $data;
    }


    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone(string $data)
    {
        $this->phone = $data;
    }


    public function getMainTeacher()
    {
        return $this->mainTeacher;
    }

    public function setMainTeacher(string $data)
    {
        $this->mainTeacher = $data;
    }

    public function getAccepted()
    {
        return $this->accepted;
    }

    public function setAccepted(bool $data)
    {
        $this->accepted = $data;
    }


    public function getSlotId()
    {
        return $this->slotId;
    }

    public function setSlotId(int $data)
    {
        $this->slotId = $data;
    }
    
}