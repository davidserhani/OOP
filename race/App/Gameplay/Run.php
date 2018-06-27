<?php
namespace App\Gameplay;

use App\Vehicles\Vehicle;
use App\Entity\Track;

    class Run implements \Countable {
        private $track;
        private $lap;
        private $players = array();
        private $ranking = array();
//        private static $tracks = ['Prairie Meuh Meuh', 'Circuit Yoshi', 'Route Arc-en-ciel', 'Manoir trempé'];

        public function __construct( $track, $lap = 3 )
        {
            $this->track = $track;
            $this->lap = $lap;
        }

        public function simulate() {
            foreach ($this->players as $player) {
                $pos = $this->generatePos( $player );
                $event = $this->generateEvent( $player );

                $this->ranking[] = [
                  'position' => $pos,
                  'failed' => $event,
                  'player' => $player
                ];
            }
            $this->sortRanking();
            $this->updatePlayers();
            $this->showRanking();
        }
        private function generatePos( Player $player ) {
            $poids = $player->getVehicle()->getWeight();
            $max = 100 * $poids;
            switch ($poids) {
                case Vehicle::LIGHT_WEIGHT:
                    $max += (10 * $this->lap);
                    break;
                case Vehicle::HEAVYWEIGHT:
                    $max -= (10 * $this->lap);
            }
            return rand(1, $max);
        }
        private function generateEvent( $player ) {
            $max = 10 * $player->getVehicle()->getWeight();
            $max += 5 * $player->getLevel();
            $rand = rand(1, $max);

            if ($rand == 1) {
                return true;
            }else{
                return false;
            }
        }

        private function sortRanking() {
            usort( $this->ranking, function ( $a, $b ) {
                if ( $a['failed'] === true ) {
                    return 1;
                }else if ( $b['failed'] === true ) {
                    return -1;
                }
                return $a['position'] - $b['position'];
            });
//            var_dump($this->ranking);
//           array_multisort($this->ranking[0]['position'], SORT_NUMERIC, SORT_ASC);
        }

        private function updatePlayers(){
            $points = count( $this->ranking );
            foreach ( $this->ranking as $index => $rank ) {
                if ( $index == 0 ) {
                    $rank['player']->levelUp();
                }
                $rank['player']->updateScore( $points );
                $points--;
            }
        }
        private function showRanking() {

            echo 'Grand Prix de ' .$this->track. '<br />';
            echo count( $this ). ' participants et '. (Player::getCounter() - count( $this )). ' spectateurs.<br />';
            echo  'Classement général : <br />';
            foreach ( $this->ranking as $index => $rank ) {
                if ( $rank['failed'] === false ) {
                  echo '#' .($index + 1). '-' .$rank['player']->getUsername(). '<br />';
                  echo '(Niveau : ' .$rank['player']->getLevel(). ' Score : ' .$rank['player']->getScore(). ')<br />';
                } else {
                    echo $rank['player']->getUsername(). ' : abandon <br />';
                }

//                var_dump($rank);
//                var_dump($rank['position']);

            }
        }

        public static function generateRun() {
            $track = Track::getRandomTrack();
            $laps = rand( 1, 10 );
            return new Run( $track->getName(), $laps);
        }

        public function addPlayer( Player $player ) {
            $this->players[] = $player;
        }

        public function count()
        {
            return count( $this->players );
        }

}