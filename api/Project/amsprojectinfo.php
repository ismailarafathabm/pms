<?php
require_once '../_def.php';
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    extract($_POST);
    if (!isset($projectno) || $projectno === '') {
        echo response("0", "Enter Project Number...");
    } else {
        include_once('../../connection/connection.php');
        $connection = new connection();
        $db = $connection->connect();
        include_once('../../controller/Projects.php');
        $project = new Projects($db);
        $ppno = strtolower($projectno);
        echo $project->getProjectinfo($ppno);
    }
} else {
    echo response("0", "CHECK REQUEST METHOD");
}
