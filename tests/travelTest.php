<?php
namespace TS\Tests;

use PHPUnit\Framework\TestCase;
use TS\Travel;

class TravelTest extends TestCase
{

    public function testShouldReturnShortestWayInHtml()
    {

        $routes = new Travel();
        $routes->addCard(['from'=>'Amsterdam', 'to'=>'Brugge', 'price'=>100, 'vehicle'=>'train', 'seat'=>'45b']);
        $routes->addCard(['from'=>'Antwerpn', 'to'=>'Rotterdam', 'price'=>300, 'vehicle'=>'bus', 'seat'=>'6s']);
        $routes->addCard(['from'=>'Brugge', 'to'=>'Antwerpn', 'price'=>200, 'vehicle'=>'train', 'seat'=>'1b']);
        $routes->addCard(['from'=>'Amsterdam', 'to'=>'Rotterdam', 'price'=>900, 'vehicle'=>'car', 'seat'=>'5s']);
        $routes->addCard(['from'=>'Brugge', 'to'=>'Rotterdam', 'price'=>300, 'vehicle'=>'train', 'seat'=>'42a']);
        $routes->setDepartureName('Amsterdam');
        $routes->setDestinationName('Rotterdam');

        $output = "Take From: Amsterdam
To: Rotterdam
Route: From Amsterdam
 Take a train to Brugge Seat number:45b
 Take a bus to Rotterdam Seat number:6s

Total: 400
";

        $this->assertEquals($routes->toHtml($routes->buildGraph()), $output);
    }
}
