<?php
    namespace App\Entity;

    use PDO;

    class Track {
        private static $db;
        private $id;
        private $name;


        public function getId() {
            return $this->id;
        }
        public function setId( $id ) {
            if ( is_int( $id ) && $id > 0) {
                $this->id = $id;
            }
        }

        public function getName() {
            return $this->name;
        }
        public function setName( $name ) {
            $this->name = $name;
        }

        public function __construct( $data )
        {
            $this->hydrate( $data );
        }

        public function hydrate( $data ) {
                foreach ( $data as $key => $value ) {
                    $method = 'set'. ucfirst( $key );
                    if ( method_exists( $this, $method ) ) {
                        $this->$method( $value );
                    }
                }
            }

        public static function prepare() {
            self::$db = new PDO('mysql:host=localhost;dbname=race', 'root', '');
        }
        public static function getRandomTrack() {
            $result = self::$db->query('SELECT * FROM track ORDER BY RAND() LIMIT 1');
            $data = $result->fetch(PDO::FETCH_ASSOC);
            return new Track( $data );
        }
    }