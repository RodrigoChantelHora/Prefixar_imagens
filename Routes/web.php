<?php

$routes = [
    '/' => 'home',
    '/process'   => 'process'
];

function home() {
    include('Views/Pages/welcome.php');
}

function process() {
    echo "Esta é a página de processos";
}

