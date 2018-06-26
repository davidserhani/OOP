<?php
    namespace App\Entity;

    interface Entity{
        public function getId();
        public function setId( $id );
        public function __construct( $data );
        public function hydrate( $data );
        public static function prepare();
    }