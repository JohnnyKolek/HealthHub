<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index()
    {
        $this->render('index');
    }

    public function login()
    {
        $this->render('login');
    }

    public function menu()
    {
        session_start();
        if (!isset($_SESSION['user_role'])){
            $this->render("error", ['message' => '401 Unauthorized']);
            return;
        }

        $role = $_SESSION['user_role'];
        if ($role !== 'patient') {
            $this->render('error', ['message' => '403 Forbidden']);
            return;
        }

        $this->render('menu');
    }

}
