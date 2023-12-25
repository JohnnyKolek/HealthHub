<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class SecurityController extends AppController
{
    public function login()
    {

        if (!$this->isPost()) {
            $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $repository = new UserRepository();

        $user = $repository->getUser($email);

        if($user == null){
            $this->render('login', ['messages' => ['Wrong credentials!']]);

        }

        if ($user->getPassword() === $password) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/dashboard");
        } else {
            $this->render('login', ['messages' => ['Wrong credentials!']]);
        }


    }

    public function register()
    {
        if (!$this->isPost()) {
            $this->render('register');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $phone = $_POST['phone'];

        if ($password !== $confirmedPassword) {
            $this->render('register', ['messages' => ['Please provide proper password']]);
        }

        //TODO try to use better hash function
        $user = new User($email, md5($password), $name, $surname);

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }
}