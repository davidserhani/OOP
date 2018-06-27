<?php
    namespace App\Gameplay;

    trait PowerUP{
        private $bp = 0;

        public function addBonus() {
            $this->bp++;
        }
        public function getBonus() {
            return $this->bp;
        }
    }