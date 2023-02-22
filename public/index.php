<?php

require_once '../vendor/autoload.php';
session_start();

/* ------------
--- ROUTAGE ---
-------------*/



$router = new AltoRouter();


if (array_key_exists('BASE_URI', $_SERVER)) {

    $router->setBasePath($_SERVER['BASE_URI']);

} else { 

    $_SERVER['BASE_URI'] = '/';
}

// ! Home

$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' => '\App\Controllers\MainController' 
    ],
    'main-home'
);

// ! Players

$router->map(
    'GET',
    '/players',
    [
        'method' => 'playerList',
        'controller' => '\App\Controllers\PlayerController' 
    ],
    'player-list'
);


// ! Security

$router->map(
    'GET',
    '/connexion',
    [
        'method' => 'login',
        'controller' => '\App\Controllers\SecurityController' // On indique le FQCN de la classe
    ],
    'security-login'
);

$router->map(
    'POST',
    '/connexion',
    [
        'method' => 'loginValid',
        'controller' => '\App\Controllers\SecurityController' // On indique le FQCN de la classe
    ],
    'security-loginValid'
);

$router->map(
    'GET',
    '/deconnexion',
    [
        'method' => 'logout',
        'controller' => '\App\Controllers\SecurityController' // On indique le FQCN de la classe
    ],
    'security-logout'
);


/* -------------
--- DISPATCH ---
--------------*/

$match = $router->match();

$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');

$dispatcher->dispatch();
