<?php 
    include_once('../_def.php');
    $auth = true;
    include_once('../../connection/connection.php');
    $connection = new connection();
    $db = $connection->connect();  

    if($_SERVER["REQUEST_METHOD"] === "POST"){
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
     
        include_once('../../controller/User.php');
        $user = new User($db);
        include_once('../_auth.php');        
        if($auth === true){
            if(!isset($afor) || $afor === ""){
                _errorlog("Enter Approval For",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                echo response('0','Enter Approval For');
                
            }else if(!isset($approvals_projectid) || $approvals_projectid === ""){
                _errorlog("project Number Missing",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                echo response('0','project Number Missing');
            }
            else if(!isset($Adate) || $Adate === ""){
                _errorlog("Enter Approval Date",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                echo response('0','Enter Approval Date');
            }
            else if(!isset($release) || $release === ""){
                _errorlog("Enter Released Date",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                echo response('0','Enter Released Date');
            }
            else if(!isset($remark) || $remark === ""){
                _errorlog("Enter Approval Remarks",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                echo response('0','Enter Approval Remarks');
            }
            else if(!isset($astatus) || $astatus === ""){
                _errorlog("Choose Status",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                echo response('0','Choose Status');
            }
            else if(!isset($givenby) || $givenby === ""){
                _errorlog("Enter Who Give?",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                echo response('0','Enter Who Give?');
            }
            else if(!isset($ftotech) || $ftotech === ""){
                _errorlog("Enter When Did you Forward to Tech Department",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                echo response('0','Enter When Did you Forward to Tech Department');
            }
            else if(!isset($engmanager) || $engmanager === ""){
                _errorlog("Enter Technical Manager Name",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                echo response('0','Enter Technical Manager Name');
            }
            else if(!isset($rfromeng) || $rfromeng === ""){
                _errorlog("Enter When did You Received From technical Manager",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                echo response('0','Enter When did You Received From technical Manager');
            }
            else if(!isset($techengineer) || $techengineer === ""){
                _errorlog("Enter Technical Engineer Name",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                echo response('0','Enter Technical Engineer Name');
            }
            else if(!isset($rftengi) || $rftengi === ""){
                _errorlog("Enter When did you Received From Technical Engineer",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                echo response('0','Enter When did you Received From Technical Engineer');
            }
            else if(!isset($salesDep) || $salesDep === ""){
                _errorlog("Enter When did you Forward to Sales Department",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                echo response('0','Enter When did you Forward to Sales Department');
            }
            else if(!isset($costingDep) || $costingDep === ""){
                _errorlog("Enter When did you Forward to Costing Department",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                echo response('0','Enter When did you Forward to Costing Department');
            }
            else if(!isset($materialdep) || $materialdep === ""){
                _errorlog("Enter When did you Forward to Material Department",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                echo response('0','Enter When did you Forward to Material Department');
            }
            else if(!isset($purchasedep) || $purchasedep === ""){
                _errorlog("Enter When did you Forward to purchasing Department",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                echo response('0','Enter When did you Forward to purchasing Department');
            }
            else if(!isset($engDep) || $engDep === ""){
                _errorlog("Enter When did you Forward to Engineering Department",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                echo response('0','Enter When did you Forward to Engineering Department');
            }else{
                $ddate = date('d-m-Y');
                
                
                include_once('../../controller/Project_approvals.php');
                $ProjectApprovals = new ProjectApprovals($db);   
                $_id = $ProjectApprovals->enc('denc',$approvals_projectid);
                $_svdata = array(
                    'approvals_adate' => $Adate,
                    'approvals_rdate' => $release,
                    'approvals_givenby' => $givenby,
                    'approvals_ftotech' => $ftotech,
                    'approvals_remarks' => $remark,
                    'approvals_tmanager' => $engmanager,
                    'approvals_rftmanger' => $rfromeng,
                    'approvals_tengineer' => $techengineer,
                    'approvals_rftmanager' => $rftengi,
                    'approvals_salse_dep' => $salesDep,
                    'approvals_costing_dep' => $costingDep,
                    'approvals_materials_dep' => $materialdep,
                    'approvals_purchasing_dep' => $purchasedep,
                    'approvals_engineering_dep' => $engDep,
                    'approvals_status' => $astatus,
                    'approvals_projectid' => $_id,
                    'approvals_cdate' => $ddate,
                    'approvals_cby' => $user_name,
                    'approvals_edate' => $ddate,
                    'approvals_eby' => $user_name,
                    'approval_type' => $afor,
                );             
                if($astatus === 'a' || $astatus === 'c'){
                    echo $ProjectApprovals->new_approvals($_svdata);
                }else{
                    if(
                        date_create($Adate) &&                         
                        date_create($release) && 
                        date_create($rfromeng) && 
                        date_create($rftengi) && 
                        date_create($rftengi) && 
                        date_create($salesDep) && 
                        date_create($costingDep) && 
                        date_create($materialdep) && 
                        date_create($purchasedep) && 
                        date_create($engDep)
                    ){
                    
                    if(isset($_FILES['docu'])){
                        $filename = $_FILES['docu']['name'];
                        $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                        if($file_ext === "pdf"){  
                            $_msg = array(
                                "status" => "OK",
                                "PAGEID" => "APPROVEL",
                                "ACTION" => "GET ALL APPROVALS FOR PROJECT",
                                "API_PAGE" => "api/Approvals/index.php",
                                "msg" => "USER GET ALL APPROVALS FOR PROJECT " . $_id
                            );
                            $_log = array(
                                'log_user' => $data->naf_user->user_name,
                                'log_time' => date('Y-m-d H:i:s'),
                                'log_descripton' => json_encode($_msg),
                                'log_action' => "READ",
                                'log_token' => $data->naf_user->user_token
                            );
                            // include_once '../../controller/log.php';
                            // $log = new LOG($db);
                            // $log->save_log($_log);
                            
                            
                            $apis = json_decode($ProjectApprovals->new_approvals($_svdata));
                            if($apis->msg === "1"){
                                $fileno = $apis->data;
                                $location = "../../assets/approvals/";
                                $filenamesxzy = $fileno;
                                move_uploaded_file($filename = $_FILES['docu']['tmp_name'],$location.$filenamesxzy.".pdf");
                                echo response("1", "saved");    
                            }else{
                                _errorlog($apis->data,$data->naf_user->user_name,$data->naf_user->user_token,$db);
                                echo response("0", $apis->data);    
                            }
                        }else{
                            _errorlog("PDF FILES ONLY",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                            echo response("0","PDF FILES ONLY");
                        } 
                    }
                    else{
                        _errorlog("Choose Approval PDF FILE",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                        echo response("0","Choose Approval PDF FILE");
                    }                       
                    }else{
                        _errorlog("Invalid Date.",$data->naf_user->user_name,$data->naf_user->user_token,$db);
                        echo response("0","Invalid Date.");
                        
                    }
                }                
            }
        }else{
            _errorlog("Access Error",$data->naf_user->user_name,$data->naf_user->user_token,$db);
            echo response("0","Access Error");
            
        }
    }else{
        _errorlog("Request Error","","",$db);
        echo response("0","Request Error");
    }

    function _errorlog($msg,$user_name,$user_token,$db){
        $_msg = array(
            "status" => "error",
            "PAGEID" => "APPROVEL",
            "ACTION" => "TRY TO ADD NEW APPROVALS",
            "API_PAGE" => "api/Approvals/new.php",
            "msg" => $msg
        );
        $_log = array(
            'log_user' => $user_name,
            'log_time' => date('Y-m-d H:i:s'),
            'log_descripton' => json_encode($_msg),
            'log_action' => "NEW",
            'log_token' => $user_token
        );
        // include_once '../../controller/log.php';
        // $log = new LOG($db);
        // $log->save_log($_log);
    }
?>