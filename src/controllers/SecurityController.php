<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class SecurityController extends AppController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }
    public function login():void
    {

        if (!$this->isPost()) {
            $this->render('login');
            return;
        }

        $email = $_POST['email'];
        $password = ($_POST['password']);

        $user = $this->userRepository->getUser($email);

        if (!$user) {
            $this->render('login', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email) {
            $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if (!password_verify($password, $user->getPassword())) {
            $this->render('login', ['messages' => ['Wrong password!']]);
        }

        session_start();
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['user_role'] = $user->getRole();

        $url = "http://$_SERVER[HTTP_HOST]";
        error_log($user->getRole());
        if ($user->getRole() === 'doctor'){
            header("Location: {$url}/doctorMenu");
        }
        else {
            header("Location: {$url}/menu");
        }
    }

    public function register(): void
    {
        if (!$this->isPost()) {
            $this->render('register');
            return;
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

        $user = new User(null,$email, password_hash($password, PASSWORD_DEFAULT), $name, $surname, $phone, null);

        $this->userRepository->addUser($user);

        $this->render('login', ['messages' => ['You\'ve been successfully registered!']]);
    }


    public function logout(){
        session_start();
        session_destroy();
        $this->render('index');
    }


}