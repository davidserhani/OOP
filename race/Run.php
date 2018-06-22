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

        public function simulate() {}
        private function showRanking() {}

        public function addPlayer( Player $player ) {
            $this->players[] = $player;
        }

    }