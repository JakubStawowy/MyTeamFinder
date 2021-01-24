<?php
require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('event', 'DefaultController');
Routing::get('home', 'DefaultController');
Routing::get('eSports', 'EventController');
Routing::get('normalSports', 'EventController');
Routing::get('newEvent', 'DefaultController');
Routing::get('personalProfile', 'DefaultController');
Routing::get('userProfile', 'DefaultController');
Routing::get('userSettings', 'UserController');
Routing::get('userSignedEvents', 'UserController');
Routing::get('userEvents', 'UserController');
Routing::get('signUpUserForEvent', 'EventRegisterController');
Routing::get('signOutUserFromEvent', 'EventRegisterController');
Routing::get('removeEvent', 'EventController');
Routing::get('editEvent', 'EventController');
Routing::get('saveEvent', 'EventController');
Routing::post('login', 'SecurityController');
Routing::post('logout', 'SecurityController');
Routing::post('addEvent', 'EventController');
Routing::post('registerUser', 'SecurityController');
Routing::post('saveUser', 'UserController');
Routing::post('filter', 'EventController');
Routing::post('search', 'EventController');
Routing::post('leaveComment', 'UserController');
Routing::post('makeAdmin', 'UserController');
Routing::post('addSport', 'DefaultController');

Routing::run($path);