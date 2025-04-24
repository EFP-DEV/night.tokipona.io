<?php
define('SITE_ROOT', __DIR__.'/../');
// var_dump($_GET);
// var_dump($_SERVER["REQUEST_URI"]);

$uri_parts = explode('/', $_SERVER["REQUEST_URI"]);
array_shift($uri_parts);

$controller = $uri_parts[0];
$action = $uri_parts[1];
$controller_path = __DIR__ . "/../app/controller/public/$controller.php";

// var_dump($controller_path);
if (file_exists($controller_path)) {
    include $controller_path;
    if(function_exists($action)){
        call_user_func($action);
    }
} else {
    http_response_code(404);
}