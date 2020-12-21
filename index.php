<?php
require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('home', 'EventController');
Routing::get('eSports', 'EventController');
Routing::get('normalSports', 'EventController');
Routing::get('newEvent', 'DefaultController');
Routing::get('personalProfile', 'UserController');
Routing::get('userProfile', 'DefaultController');
Routing::post('login', 'SecurityController');
Routing::post('logout', 'SecurityController');
Routing::post('addEvent', 'EventController');
Routing::post('registerUser', 'SecurityController');
Routing::post('assignUserToEvent', 'EventController');

Routing::run($path);