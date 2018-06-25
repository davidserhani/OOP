<?php
namespace App\Gameplay;

use App\Vehicles\Vehicle;

    final class Player {
        private $username;
        private $country;
        private $vehicle;
        private $level = 0;
        private $score = 0;
        private static $counter = 0;

        public function __construct( $username, $country, Vehicle $vehicle )
        {
            $this->username = $username;
            $this->country = $country;
            $this->vehicle = $vehicle;
            self::$counter++;
        }

        public static function getCounter() {
            return self::$counter;
        }

        public function levelUp() {
            $this->level++;
        }
        public function updateScore( $score ) {
            $this->score += $score;
        }
        public function getUsername() {
            return $this->username;
        }
        public function getCountry() {
            return $this->country;
        }
        public function getScore() {
            return $this->score;
        }
        public function getLevel() {
            return $this->level;
        }
        public function getVehicle() {
            return $this->vehicle;
        }
    }