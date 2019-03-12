<?php
    class DatabaseSingleton
    {
        private $connection;
        private static $instance;
        private $dbhost = "localhost";
        private $dbuser = "root";
        private $dbpass = "";
        private $dbname = "csplugin";

        private function __construct()
        {
            try
            {
                $this->connection = new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname, $this->dbuser, $this->dbpass);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                die("Failed to connect to DB: ". $e->getMessage());
            }
        }

        // empty up this function to prevent cloning
        private function __clone()
        {}

        public static function getInstance()
        {
            // self with static attributes
            if(!self::$instance)
            {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function getConnection()
        {
            return $this->connection;
        }
    }