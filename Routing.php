<?php
require_once 'src/controllers/DefaultController.php';
class Routing{
    public static $routes;
    public static function get($url, $controller){
        self::$routes[$url] = $controller;
    }
    public static function run(string $url){
        $action = explode("/", $url)[0];
        if(!array_key_exists($action, self::$routes)){
            die("Wrong url!");
        }
        else{
            $controller = self::$routes[$action];
            $object = new $controller;
            $action = $action ?: 'register';
            $object->$action();
        }
    }
}