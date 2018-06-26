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
        private $uId;

        public function __construct( $username, $country, Vehicle $vehicle )
        {
            $this->username = $username;
            $this->country = $country;
            $this->vehicle = $vehicle;
            self::$counter++;
            $this->randId();
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


        public function randId() {
            $this->uId = uniqid();
        }

        public static function sessionSave( Player $player ) {
            $_SESSION['saved'] = serialize( $player );
            $player->__destruct();
            unset( $player );
        }
        public static function restoreSession( Vehicle $vehicle ) {
            if (!empty( $_SESSION['saved'] ) ) {
                $player = unserialize( $_SESSION['saved'] );
                $player->vehicle = $vehicle;
                return $player;
            }
            return false;
        }

        public function __sleep() {
            return ['username', 'country', 'level', 'score'];
        }
        public function __wakeup() {
            $this->randId();
            unset( $_SESSION['saved'] );
            self::$counter++;
        }

        public function __destruct()
        {
            self::$counter--;
        }
    }