<?php

/** @var \Laravel\Lumen\Routing\Router $router */

// Initialize ...
$router->post('/init', 'InitController@init');

// Home page ...
$router->get('/home/magazine', 'Home\MagazineHomeController@show');
