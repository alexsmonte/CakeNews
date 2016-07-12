<?php
use Cake\Routing\Router;

Router::plugin('CakeNews',['path' => '/cake-news'], function ($routes) {
    $routes->connect('/', ['controller' => 'Posts', 'action' => 'index']);
    $routes->fallbacks('DashedRoute');
});




?>