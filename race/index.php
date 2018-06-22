<?php
require 'Player.php';
require 'Run.php';
require 'Vehicle.php';

$yamaha = new Vehicle('black', 2, 1, 'tmax');
$porsche = new Vehicle('blue', 4, 2, '911');

$playerOne = new Player('Schumi', 'us', $yamaha);
$playerTwo = new Player('Loeb', 'fr', $porsche);

$gameOne = new Run('Monza');

$gameOne->addPlayer( $playerOne );
$gameOne->addPlayer( $playerTwo );

print_r( $gameOne );
$gameOne->simulate();