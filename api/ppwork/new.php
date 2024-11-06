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
            if(!isset($ppdate) || $ppdate === ""){
                echo response("0","Enter Date");
            }else if(!isset($pp_project) || $pp_project === ""){
                echo response("0","Select Project");
            }else if(!isset($pp_projectname) || $pp_projectname === ""){
                echo response("0","Select Project Name");
            }else if(!isset($pp_mtype) || $pp_mtype === ""){
                echo response("0","Enter Material Type");
            }else if(!isset($pp_mdescription) || $pp_mdescription === ""){
                echo response("0","Enter Material Descripton");
            }else if(!isset($pp_color) || $pp_color === ""){
                echo response("0","Enter Material Color");
            }else if(!isset($pp_dieweight) || $pp_dieweight === ""){
                echo response("0","Enter Material Die Weight");
            }else if(!isset($pp_qty) || $pp_qty === ""){
                echo response("0","Enter Material QTY");
            }else if(!isset($pp_units) || $pp_units === ""){
                echo response("0","Enter Material Units");
            }else if(!isset($pp_delno) || $pp_delno === ""){
                echo response("0","Enter Del.No");
            }else if(!isset($pp_dta) || $pp_dta === ""){
                echo response("0","Enter ETA");
            }else if(!isset($pp_location) || $pp_location === ""){
                echo response("0","Enter Location");
            }else if(!isset($pp_remarks) || $pp_remarks === ""){
                echo response("0","Enter Remarks");
            }else if(!isset($pp_type) || $pp_type === ""){
                echo response("0","Some Inputs Missing, Contact Developer");
            }
            else if(!isset($ppbalancedie) || $ppbalancedie === ""){
                echo response("0","Enter Tot Weight");
            }
            else if(!isset($pppartno) || $pppartno === ""){
                echo response("0","Enter Part No");
            }
            else if(!isset($pplenght) || $pplenght === ""){
                echo response("0","Enter Length");
            }
            else if(!isset($ppalloy) || $ppalloy === ""){
                echo response("0","Enter Alloy");
            }
            else if(!isset($ppitemtype) || $ppitemtype === ""){
                echo response("0","Enter Material Type");
            }
            else if(!isset($itempartfunction) || $itempartfunction === ""){
                echo response("0","Eneter System Part function");
            }
            else{
                if(!date_create($ppdate)){
                    echo response("0","Date Is Not A Valid Format");
                }
                else if(!is_numeric($ppbalancedie)){
                    echo response("0","Total weight Valid Format");
                }else if(!is_numeric($pp_dieweight)){
                    echo response("0","Die weight Valid Format");
                }else if(!is_numeric($pp_qty)){
                    echo response("0","QTY Is Not a valid Number");
                }else{
                    $x = date('Y-m-d H:I:s');
                    $__b = (double)$pp_qty * (double)$pp_dieweight * (double)$pplenght;
                    $svdata = array(
                        ':ppdate' => date_format(date_create($ppdate),'Y-m-d'),
                        ':pp_project' => $pp_project,
                        ':pp_projectname' => $pp_projectname,
                        ':pp_mtype' => $pp_mtype,
                        ':pp_mdescription' => $pp_mdescription,
                        ':pp_color' => $pp_color,
                        ':pp_qty' => $pp_qty,
                        ':pp_units' => $pp_units,
                        ':pp_delno' => $pp_delno,
                        ':pp_dta' => $pp_dta,
                        ':pp_location' => $pp_location,
                        ':pp_remarks' => $pp_remarks,
                        ':pp_type' => $pp_type,
                        ':pp_cdate' => $x,
                        ':pp_edate' => $x,
                        ':pp_cby' => $user_name,
                        ':pp_eby' => $user_name,
                        ':pp_extra' => "-",
                        ':pp_dieweight' => $pp_dieweight,
                        ':ppbalancedie' => $__b,
                        ':pppartno' => $pppartno,
                        ':pplenght' => $pplenght,
                        ':ppalloy' => $ppalloy,
                        ':ppitemtype' => $ppitemtype,                        
                    );

                    $items = array(
                        ':itemprofileno' => $pppartno,
                        ':itempartno' => $pppartno,
                        ':itemalloy' => $ppalloy,
                        ':itemfinish' => $pp_color,
                        ':itemlength' => $pplenght,
                        ':itemunit' => $pp_units,
                        ':itemdieweight' => $pp_dieweight,
                        ':itemsystem' => $pp_mtype,
                        ':itemtype' => $ppitemtype,
                        ':itemavai' => "0",
                        ':itemtotweight' => "0",
                        ':itemprice' => "0",
                        ':itemtotprice' => "0",
                        ':itemdescription' => $pp_mdescription,
                        ':itempartfunction' => $itempartfunction
                        
                    );
                    require_once '../../controller/ppworks.php';
                    $PPwork = new PPworks($cn);
                    echo $PPwork->SaveNewPP($svdata,$items);
                }
            }
        }
        else{
            echo response("0", "Access Error");
        }
    }else{
        echo response("0", "Request Error");
    }
