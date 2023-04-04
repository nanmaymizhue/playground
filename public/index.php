<?php

session_start();

//var_dump(__DIR__);

const BASE_PATH = __DIR__ . '/../';

//var_dump(BASE_PATH);
require BASE_PATH . 'functions.php';

$routes = require base_path('routes.php');

//require base_path($routes['/notes']);


$uri = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);

//dd($_SERVER);
if(array_key_exists($uri,$routes)){
    require base_path($routes[$uri]);
}else{
    echo "404 not found.";
}





