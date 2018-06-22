<?php
require 'Player.php';
require 'Run.php';
require 'Vehicle.php';

$yamaha = new Vehicle('black', 2, 1, 'tmax');
$porsche = new Vehicle('blue', 4, 2, '911');
$ferrari = new Vehicle('blue', 4, 3, 'LaFerrari');
$lambo = new Vehicle('blue', 4, 3, 'Aventador');

$playerOne = new Player('Schumi', 'us', $yamaha);
$playerTwo = new Player('Loeb', 'fr', $porsche);
$playerThree = new Player('Flash', 'us', $lambo);
$playerFour = new Player('Boruto', 'fr', $ferrari);

$gameOne = new Run('Monza');

$gameOne->addPlayer( $playerOne );
$gameOne->addPlayer( $playerTwo );
$gameOne->addPlayer( $playerThree );
$gameOne->addPlayer( $playerFour );
?>
<!--<pre>-->
<?php
//print_r( $gameOne );
//?>
<!--</pre>-->
<?php
$gameOne->simulate();