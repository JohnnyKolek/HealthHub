<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('login', 'SecurityController');
Router::get('index', 'DefaultController');
Router::get('dashboard', 'DefaultController');
Router::get('menu', 'DefaultController');
Router::get('fileNotFound', 'ErrorController');
Router::get('register', 'SecurityController');
Router::get('doctors', 'VisitController');
Router::get('getDoctors', 'DoctorController');
Router::get('confirm', 'VisitController');


Router::run($path);
