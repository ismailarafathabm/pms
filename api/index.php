<?php 
  //  echo "working";
    include_once './_def.php';
    date_default_timezone_set('Asia/Riyadh');
    $method = $_SERVER['REQUEST_METHOD'];
    ///echo $method;
    if($method !== "POST"){
        header("HTTP/1.0 400 Bad Request");
        echo response("0","Check Request Method");
        die();        
    }

     //$headers = apache_request_headers();
    // print_r($headers);
    extract($_POST); 
    require_once "../connection/connection.php";
    $conn = new connection();
    $cn = $conn->connect();

    require_once "../controller/User.php";
    $user = new User($cn);
    $auth = true;
    include_once "_nauth.php";
    if(!$auth){
        echo response("404",$_data);
        return;
    }

    $page = !isset($_GET['page']) || trim($_GET['page']) === "" ? "-" : $_GET['page'];
    $fun = !isset($_GET['f']) || trim($_GET['f']) === "" ? "-" : $_GET["f"];
   
    switch($page){
        default: echo response("0","Page Not Found - 404-a "); exit;
        case 'mwk':
            require_once '../controller/maintancework.php';
            $mkw = new MaintanceWork($cn);
            include_once 'mkw/index.php';
            exit;
        case 'metro':
            require_once '../controller/metroapprovals.php';
            $metro = new MetroApprovals($cn);
            include_once 'metro/index.php';
            exit;
        case 'approvalstype':
            require_once '../controller/ApprovalTypes.php';
            $appt = new ApprovalType($cn);
            include_once 'metro/approvaltype.php';
            exit;
        case 'masterlog':
            require_once '../controller/masterlog.php';
            $ml = new MasterLog($cn);
            include_once 'masterlog/index.php';
            exit;
        case 'mattobeload':
            require_once '../controller/mattobeload.php';
            $mtbl = new MattoBeLoad($cn);
            include_once 'mattobeload/index.php';
            exit;
        case 'go':
            //echo "page called";
            require_once '../controller/go.php';
            $go = new GlassOrders($cn);
            include_once 'go/index.php';
            exit;
        case 'budget':
            require_once '../controller/budget.php';
            $budget = new Budget($cn);
            include_once 'budget/index.php';
            exit;
        case 'gon':
            require_once '../controller/gon.php';
            $gon = new GON($cn);
            include_once 'gon/index.php';
            exit;
        case 'submitals':
            require_once '../controller/techapprovals.php';
            $ts = new TechApprovals($cn);
            include_once 'submitals/index.php';
            exit;
        case 'technical':
            require_once '../controller/technical.php';
            $tech = new Technical($cn);
            include_once 'technical/index.php';
        exit;
        case 'mr':
            require_once '../controller/mr.php';
            $mr = new MR($cn);
            include_once 'mr/index.php';
            exit;
        case 'autorize':
            require_once '../controller/boqeng.php';
            $boqeng = new BoqEng($cn);
            include_once 'boqeng/index.php';
            exit;
    }
?>