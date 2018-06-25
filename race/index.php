<?php

require_once 'App/Autoloader.php';
App\Autoloader::register();


use App\Vehicles\Vehicle;
use App\Vehicles\Bike;
use App\Vehicles\Car;
use App\Vehicles\Skate;
use App\Gameplay\Player;
use App\Gameplay\Run;


$yamaha = new Bike('black', 2, Vehicle::LIGHT_WEIGHT, 'tmax');
$porsche = new Car('blue', 4, Vehicle::HEAVYWEIGHT, '911');
$ferrari = new Car('blue', 4, Vehicle::MIDDLEWEIGHT, 'LaFerrari');
$lambo = new Skate('blue', 4, Vehicle::LIGHT_WEIGHT, 'Skate');

$playerOne = new Player('Schumi', 'us', $yamaha);
$playerTwo = new Player('Loeb', 'fr', $porsche);
$playerThree = new Player('Flash', 'us', $lambo);
$playerFour = new Player('Boruto', 'fr', $ferrari);

$gameOne = new Run('Monza');
$gameOne->addPlayer( $playerOne );
$gameOne->addPlayer( $playerTwo );
$gameOne->addPlayer( $playerThree );
//$gameOne->addPlayer( $playerFour );
$gameOne->simulate();

$gameTwo = Run::generateRun();
$gameTwo->addPlayer( $playerOne );
$gameTwo->addPlayer( $playerTwo );
//$gameTwo->addPlayer( $playerThree );
//$gameTwo->addPlayer( $playerFour );
$gameTwo->simulate();

$gameThree = Run::generateRun();
$gameThree->addPlayer( $playerOne );
$gameThree->addPlayer( $playerTwo );
$gameThree->addPlayer( $playerThree );
$gameThree->addPlayer( $playerFour );
$gameThree->simulate();