<?php 
    include_once('../_def.php');
    $auth = false;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        extract($_POST);
        include_once('../../connection/connection.php');
        $connection = new connection();
        $db = $connection->connect();    
        if(isset($user_name) && isset($user_token)){    
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
        }
        if($auth){
            if(!isset($rqno) || $rqno === ''){
                echo response("0","Enter Quotation Number");
            }else if(!isset($rdate) || $rdate === ''){
                echo response("0","Enter Released Date");
            }else if(!isset($rduration) || $rduration === ''){
                echo response("0","Enter Duration");
            }else if(!isset($ramount) || $ramount === ''){
                echo response("0","Enter Amount");
            }else if(!isset($rsystemtype) || $rsystemtype === ''){
                echo response("0","Enter Proposed System");
            }else if(!isset($rcosingeng) || $rcosingeng === ''){
                echo response("0","Enter Cost Engineer");
            }else if(!isset($rremarks) || $rremarks === ""){
                echo response("0","Enter Remarks");
            }else if(!isset($rdrawingno) || $rdrawingno === ""){
                echo response("0","Enter Drawing No");
            }else{
                if(!is_numeric($ramount)){
                    echo response("0","Amount not valid");
                }else{
                    if(!date_create($rdate)){
                        echo response("0","Date is not valid format");
                    }else{
                        include_once '../../controller/Quotations.php';
                        $qu = new Quotations($db);
                        $s = array(
                            'rdate' => date_format(date_create($rdate),'Y-m-d'), 
                            'rduration' => $qu->enc('enc',$rduration), 
                            'ramount' => $qu->enc('enc',$ramount), 
                            'rsystemtype' => $qu->enc('enc',$rsystemtype), 
                            'rcosingeng' => $qu->enc('enc',$rcosingeng), 
                            'rremarks' => $qu->enc('enc',$rremarks), 
                            'rdrawingno' => $qu->enc('enc',$rdrawingno), 
                            'rcurrent' => $qu->enc('enc','1'), 
                            'rqno' => $rqno, 
                            'cby' => $qu->enc('enc',$user_name), 
                            'eby' => $qu->enc('enc',$user_name), 
                            'cdate' => date('Y-m-d h:i:s a'),
                            'edate' =>date('Y-m-d h:i:s a'),
                            'del' => $qu->enc('enc','1'), 
                            'revision_no' => $qu->enc('enc',$revision_no), 
                        );

                        $updateinfos  = array(
                            'rdate' => date_format(date_create($rdate),'Y-m-d'), 
                            'rduration' => $rduration, 
                            'ramount' => $ramount, 
                            'rsystemtype' =>$rsystemtype, 
                            'rcosingeng' => $rcosingeng, 
                            'rremarks' => $rremarks, 
                            'rdrawingno' => $rdrawingno, 
                            'revision_no' => $revision_no, 
                        );
                        $up = json_encode($updateinfos);
                        echo $qu->NewRevisions($s,$qu->enc('enc',$up),$rqno);
                    }
                }
            }
        }else{
            echo response("404", "Access Error");
        }
    }
    else{
        echo response("0","Request Error");
    }
