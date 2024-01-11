<?php

class User {
    private $id;
    private $email;
    private $password;
    private $name;
    private $surname;
    private $phone;

    /**
     * @param $id
     * @param $email
     * @param $password
     * @param $name
     * @param $surname
     * @param $phone
     */
    public function __construct($id, $email, $password, $name, $surname, $phone)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getEmail(): string 
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }
}