<?php
    namespace App\Vehicles;
    use App\Gameplay\PowerUP;

    abstract class Vehicle {
        use PowerUP;

        const LIGHT_WEIGHT = 1;
        const MIDDLEWEIGHT = 2;
        const HEAVYWEIGHT = 3;

        private $engine = false;
        private $speed = 0;
        private $color;
        private $wheel;
        private $model;
        private $weight;

        public function __construct( $color, $wheel, $weight, $model )
        {
            $this->setColor( $color );
            if ( is_int( $wheel ) ) {
                $this->wheel = $wheel;
            }
            $this->setWeight( $weight );
            $this->model = $model;
        }

        abstract public function powerUp();

        private function setWeight( $weight ) {
            if ( is_int( $weight ) ) {
                $this->weight = $weight;
            }
        }

        public function start() {
            $this->engine = true;
        }
        public function speedUp() {
            $this->speed++;
        }
        public function brake() {
            if ( $this->speed <= 0 ) {
                return;
            }
            $this->speed--;
        }
        public function turn( $radius ) {
            // ...
        }
        public function stop() {
            $this->engine = false;
        }
        public function reverse() {
            $this->speed = -1;
        }
        public function getSpeed() {
            return $this->speed;
        }
        public function setColor( $color ) {
            $this->color = $color;
        }
        public function getWeight() {
            return $this->weight;
        }
        public function getModel() {
            return $this->model;
        }
    }