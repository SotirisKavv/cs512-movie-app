<?php
    class Database {
        private $servername = "localhost";
        private $username = "root";
        private $password = "toor";
        private $db_name = "moviedb";

        public $conn;

        public function getConnection() {
            $this->conn = null;
            
            try {
                $this->conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->db_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            } catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }
?>