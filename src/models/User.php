<?php

class User {
    private $email;
    private $password;
    private $name;
    private $surname;
    private $phone;

    /**
     * @param $email
     * @param $password
     * @param $name
     * @param $surname
     * @param $phone
     */
    public function __construct($email, $password, $name, $surname, $phone)
    {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
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