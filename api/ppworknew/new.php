<?php 
    include_once('../_def.php');
    $auth = true;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        extract($_POST);
        $naf_user = array(
            'user_name' => $user_name,
            'user_token' => $user_token
        );
        $datas = array(
            'naf_user' => $naf_user
        );
        $s = json_encode($datas);
        $data = json_decode($s);
        include_once('../../connection/connection.php');
        $connection = new connection();
        $cn = $connection->connect();
        include_once('../../controller/User.php');
        $user = new User($cn);
        include_once('../_auth.php');
        if($auth === true) {
            if(!isset($ppproject) || $ppproject === ''){
                echo response("0", "Select Project");
            }else if(!isset($pptype) || $pptype === ''){
                echo response("0", "Enter Material Type");
            }else if(!isset($ppdescription) || $ppdescription === ""){
                echo response("0", "Enter Material Description");
            }else if(!isset($ppcolor) || $ppcolor === ""){
                echo response("0", "Enter Color");
            }else if(!isset($qty) || $qty === ""){
                echo response("0", "Enter Qty/PCS");
            }else if(!isset($totkg) || $totkg === ""){
                echo response("0", "Enter Weight/KG");
            }else if(!isset($delno) || $delno === ""){
                echo response("0", "Enter DEL.No");
            }else if(!isset($ppdate) || $ppdate === ""){
                echo response("0", "Enter Date");
            }else if(!isset($eta) || $eta === ""){
                echo response("0", "Enter ETA");
            }else if(!isset($location) || $location === ""){
                echo response("0", "Enter Location");
            }else if(!isset($remarks) || $remarks === ""){
                echo response("0", "Enter Remarks");
            }else{
                if(!is_numeric($qty)){
                    echo response("0", "Qty/PCS is not Valid Number Format");
                }else{
                    if(!date_create($ppdate)){
                        echo response("0", "Date is not Valid Number Format");
                    }else{
                        $cdate = date('Y-m-d H:i:s');
                        $cby = $user_name;
                        $sv = array(
                            ':ppproject' => $pjno,
                            ':pptype' => $pptype,
                            ':ppdescription' => $ppdescription,
                            ':ppcolor' => $ppcolor,
                            ':qty' => $qty,
                            ':totkg' => $totkg,
                            ':delno' => $delno,
                            ':rckg' => $totkg,
                            ':rcqty' => $qty,
                            ':eta' => $eta,
                            ':location' => $location,
                            ':remarks' => $remarks,
                            ':cdate' => $cdate,
                            ':edate' => $cdate,
                            ':cby' => $cby,
                            ':eby' => $cby,
                            ':type' => $type,
                            ':pjno' =>$ppproject ,
                            ':ppdate' => date_format(date_create($ppdate),'Y-m-d'),
                        );

                        require_once '../../controller/ppworknew.php';
                        $PPwork = new PPWorkNew($cn);
                        echo $PPwork->saveAction($sv);
                    }
                }
            }
        }else{
            echo response("404", "Access Error");
        }
    }else{
        echo response("0", "Request Error");
    }
?>
    