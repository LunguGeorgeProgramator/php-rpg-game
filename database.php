<?php
    class DataBase {

        protected $servername;
        protected $username;
        protected $password;
        protected $dbname;

        function __construct() {
            $this->servername = "localhost";
            $this->username = "root";
            $this->password = "";
            $this->dbname = "hero_game";
            $this->conn = $this->connectDB($this->servername, $this->username, $this->password, $this->dbname);
        }

        function __destruct() {
            $this->conn->close();
        }

        private function connectDB($servername, $username, $password, $dbname){
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            return $conn;
        }

        public function queryRun($query){
            return $this->conn->query($query);
        }

    }
