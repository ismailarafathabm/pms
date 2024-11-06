<?php 
        include_once('../../connection/connection.php');
        $connection = new connection();
        $cn = $connection->connect();

        require_once '../../controller/ppworks.php';
        $PPwork = new PPworks($cn);
        echo $PPwork->AllDescription();
