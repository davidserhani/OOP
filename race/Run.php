<?php
    class Run {
        private $track;
        private $lap;
        private $players = array();
        private $ranking = array();

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
            $this->showRanking();
        }
        private function generatePos( Player $player ) {
            $poids = $player->getVehicle()->getWeight();
            $max = 100 * $poids;
            switch ($poids) {
                case 1:
                    $max += (10 * $this->lap);
                    break;
                case 3:
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
        private function showRanking() {

            echo 'Grand Prix de ' .$this->track. '<br />';
            echo  'Classement général : <br />';
            foreach ( $this->ranking as $index => $rank ) {
                if ( $rank['failed'] === false ) {
                  echo '#' .($index + 1). '-' .$rank['player']->getUsername(). '<br />';
                } else {
                    echo $rank['player']->getUsername(). ' : abandon <br />';
                }

//                var_dump($rank);
//                var_dump($rank['position']);

            }
        }

        public function addPlayer( Player $player ) {
            $this->players[] = $player;
        }
    }