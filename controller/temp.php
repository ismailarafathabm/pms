<?php
include_once('../connection/connection.php');
$conn = new connection();
$cn = $conn->connect();

include_once('Variations.php');
$vars = new Variations($cn);
echo $vars->NewRpttot();
