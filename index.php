<?php

namespace TS;

require_once __DIR__ . '/vendor/autoload.php';

$routes = new Travel();
$routes->addCard(['from'=>'Amsterdam', 'to'=>'Brugge', 'price'=>100, 'vehicle'=>'train', 'seat'=>'45b']);
$routes->addCard(['from'=>'Antwerpn', 'to'=>'Rotterdam', 'price'=>300, 'vehicle'=>'bus', 'seat'=>'6s']);
$routes->addCard(['from'=>'Brugge', 'to'=>'Antwerpn', 'price'=>200, 'vehicle'=>'train', 'seat'=>'1b']);
$routes->addCard(['from'=>'Amsterdam', 'to'=>'Rotterdam', 'price'=>900, 'vehicle'=>'car', 'seat'=>'5s']);
$routes->addCard(['from'=>'Brugge', 'to'=>'Rotterdam', 'price'=>300, 'vehicle'=>'train', 'seat'=>'42a']);
$routes->setDepartureName('Amsterdam');
$routes->setDestinationName('Rotterdam');


echo ($routes->toHtml($routes->buildGraph()));
