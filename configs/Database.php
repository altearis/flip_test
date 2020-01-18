<?php
    class Database {
        
        private $db_host = "localhost";
        private $db_user = "root";
        private $db_pass = "";
        private $db_name = "flip_tech_test";
        private $conn = null;

        
        public function getConnection() 
        {       
            $this->conn=null;     
            try{
                $this->conn = new PDO("mysql:host=". $this->db_host. "; dbname=". $this->db_name ,$this->db_user,$this->db_pass);
            }catch(PDOException $ex)
            {
                echo "Database connection problem : " . $ex->getMessage();
                exit();
            }
            return $this->conn;
        }
    }
?>