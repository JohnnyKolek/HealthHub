<?php


class Dog {
    private $name;
    private $breed;
    private $description;
    private $colour;
    private $photoURL;

    public function __construct($name, $breed, $description, $color, $photoURL){
        $this->name = $name;
        $this->breed = $breed;
        $this->description = $description;
        $this->color = $color;
        $this->photoURL = $photoURL;
    }

    public function getName(){
        return $this->name;
    }

    public function getBreed(){
        return $this->breed;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getColor(){
        return $this->color;
    }

    public function getPhotoURL(){
        return $this->photoURL;
    }

}