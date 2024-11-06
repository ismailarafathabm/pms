<?php 
    class PPitems{
        private $cn;
        private $cm;
        private $sql;
        private $response;
        function __construct($db)
        {
            $this->cn = $db;
            $this->response = array("msg" => "0","data" => "_ERROR");
        }

        // private function _checkItem($infos){
        //     $this->sql = "SELECT *FROM bom_items where 
        //     itempartno = :itempartno 
        //     itemalloy = :itemalloy 
        //     itemfinish = :itemfinish 
        //     itemlength = :itemlength 
        //     itemunit = :itemunit, 
        //     ";
        // }
    }
?>