<?php     
    include_once('../api/_def.php');
    include_once('../controller/departments.php');
    $dep = new departments();
    echo $dep->get_all_departments();
?>

