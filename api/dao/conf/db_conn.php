<?php
    require_once "defines.php";
    class Database{
        private static $conn;

        public function __construct(){}

        public static function conn(){
            if(is_null(self::$conn)){
                self::$conn = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', ''.USER.'', ''.PASS.'');
            }
            return self::$conn;
        }
    }
?>