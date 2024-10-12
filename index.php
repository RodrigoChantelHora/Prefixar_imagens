<?php
require('Routes/web.php');
require_once('Config/config.php');

function asset($path, $urlAssets){
    $baseAssetPath = $urlAssets;
    return $baseAssetPath . ltrim($path, '/');
}

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$basePath = $urlBase; //URL BASE DA APLICAÇÃO

if(strpos($requestUri, $basePath) === 0){
    $requestUri = substr($requestUri, strlen($basePath));
}

if(array_key_exists($requestUri, $routes)){
    call_user_func($routes[$requestUri]);
}else{
    http_response_code(404);
    include('Views/Pages/not-found.php');
}