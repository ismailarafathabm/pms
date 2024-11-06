<?php 
    class connection{
        const host = "localhost";
        const db = "nafco_pms";
        const user= "root";
        const password= "";

        private $cn;

        public function connect(){           
            $this->cn = new PDO("mysql:host=localhost;dbname=pms;charset=utf8",connection::user,connection::password);
            return $this->cn;
        }       
    }
?>