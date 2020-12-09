<?php
    class Connection{

        private $host = "localhost";
        private $user = "root";
        private $password = "";
        private $dbname = "catering_order";
        public $connection;

        function __construct(){
            $this->connect();
        }

        function connect(){
            $conn = mysqli_connect($this->host, $this->user, $this->password);
            $dbselect = mysqli_select_db($conn, $this->dbname);
            $this->connection = $conn;
        }
    }
?>