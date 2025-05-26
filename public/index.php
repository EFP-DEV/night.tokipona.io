<?php
session_start();
define('SITE_ROOT', __DIR__.'/../');

require_once(SITE_ROOT.'app/view/template_engine.php');
require_once(SITE_ROOT.'app/dev.php');
require_once(SITE_ROOT . 'app/db.php');


$uri_parts = explode('/', $_SERVER["REQUEST_URI"]);
array_shift($uri_parts);

if(!empty($uri_parts[0]) && $uri_parts[0] === 'admin'){
    $zone = 'admin';
    array_shift($uri_parts);
}
else $zone = 'public';


if(empty($uri_parts[0])){
    $controller = 'home';
}
else{
    $controller = $uri_parts[0];
}

if($zone === 'admin' && empty($_SESSION['active_user']))
    header('Location: /checkin');


if (empty($uri_parts[1])) {
    $action = $controller;
} else {
    $action = $uri_parts[1];
}

$controller_path = SITE_ROOT . "app/controller/$zone/$controller.php";

// var_dump($controller_path);

$failedToLoad = false;


if (file_exists($controller_path)) {
    include $controller_path;
    if(function_exists($action)){
        call_user_func($action);
    } else {
        $failedToLoad = true;
    }
} else {
    $failedToLoad = true;
}

if($failedToLoad === true){
    http_response_code(404);
}
