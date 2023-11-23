<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Dog.php';

class DefaultController extends AppController {

    public function index()
    {
        $this->render('start');
    }

    public function login()
    {
        $this->render('login');
    }

    public function menu()
    {
        $this->render('menu');
    }

    public function dashboard()
    {
        $title = "MY DOG";
        $this->render('dashboard', ["title" => $title]);
    }


}
