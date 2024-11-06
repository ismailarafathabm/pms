<?php 
    if(!isset($mkw)){
        include_once '../_error.php';
        exit;
    }
    switch($fun){
        default:
            echo response("0","407- Opreation not Found");        
        exit;
        case 'dublicate' : echo $mkw->dublicateProject($pjcno);exit;
        case 'all': echo $mkw->allprojects();break;
        case 'new':
            include_once 'new.php';
            break;
        case 'getinfo':
            $pjcno = !isset($_GET['pjcno']) || trim($_GET['pjcno']) === "" ? "-" : $_GET['pjcno'];
            echo $mkw->projecinfo($pjcno);
        exit;
    }
?>