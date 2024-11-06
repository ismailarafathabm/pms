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
            if(!isset($bomdate) || $bomdate === ''){
                echo response("0","Enter Date");
            }else if(!isset($bomproject) || $bomproject === ''){
                echo response("0","Select Project");
            }  
            else if(!isset($bomcontract) || $bomcontract === ''){
                echo response("0","Enter Contract");
            }  
            else if(!isset($bomcolor) || $bomcolor === ''){
                echo response("0","Enter Color");
            }
            else if(!isset($bomfno) || $bomfno === ''){
                echo response("0","Enter Color");
            }
            
            else{
                if(!date_create($bomdate)){
                    echo response("0","Date is not valid Format");
                }else{
                    if(!isset($itemslist)){
                        echo response("0","Empty List");
                    }else{
                        $infos = json_decode($itemslist);
                        $cdate = date('Y-m-d h:i:s a');
                        $bomdate = date_format(date_create($bomdate),'Y-m-d');
                        $bomproject =  strtolower($bomproject);        
                        $bomno =  $bomfno;                    
                        $sva = [];
                        foreach($infos as $i){                                                                      
                            $item_id = $i->itemid;
                            $bomprofileno = $i->profileno;
                            $bompartno = $i->partno;
                            $bomdescription = $i->ogdiscription;
                            $bomdieweight = $i->dieweight;
                            $bomreqlength = $i->reqlenght;
                            $bomreqbarqty = $i->reqbarqty;
                            $bomunit = $i->itemunits;
                            $bomreqtotweight = $i->totweightreq;
                            $bomavailength = $i->availenght;
                            $bomavaibarqty = $i->avaibarqty;
                            $bomavaiweight = $i->avaitotweight;
                            $bomorderlength = $i->needlenght;
                            $bomorderbarqty = $i->needbarqty;
                            $bomordertotweight = $i->needweight;
                            $bomremark = $i->remarks;
                            $bomsystem = $i->ssystem;
                            $flagprepare = "N";
                            $prepareupdate = $cdate;
                            $prepareby = $user_name;
                            $flagchecked = "N";
                            $checkedupdate =  $cdate;
                            $checkedby = "-" ;
                            $flagapproved = "N";
                            $approvedupdate =  $cdate;
                            $approvedby = "-";
                            $bomitemid = $i->itemid;
                            $alloy = $i->alloy;
                            $mtype = $i->mtype;
                            $finish = $i->finish;
                            $length = $i->availenght;
                           

                            $sva[] = array(
                                "bomdate" => $bomdate,
                                "bomproject" => $bomproject,
                                "bomcontract" => $bomcontract,
                                "bomcolor" => $bomcolor,
                                "bomno" => $bomno,
                                "bomsystem" => $bomsystem,
                                "bomprofileno" => $bomprofileno,
                                "bompartno" => $bompartno,
                                "bomdescription" => $bomdescription,
                                "bomdieweight" => $bomdieweight,
                                "bomunit" => $bomunit,
                                "bomreqlength" => $bomreqlength,
                                "bomreqbarqty" => $bomreqbarqty,
                                "bomreqtotweight" => $bomreqtotweight,
                                "bomavailength" => $bomavailength,
                                "bomavaibarqty" => $bomavaibarqty,
                                "bomavaiweight" => $bomavaiweight,
                                "bomorderlength" => $bomorderlength,
                                "bomorderbarqty" => $bomorderbarqty,
                                "bomordertotweight" => $bomordertotweight,
                                "bomremark" => $bomremark,
                                "flagprepare" => $flagprepare,
                                "prepareupdate" => $prepareupdate,
                                "prepareby" => $prepareby,
                                "flagchecked" => $flagchecked,
                                "checkedupdate" => $checkedupdate,
                                "checkedby" => $checkedby,
                                "flagapproved" => $flagapproved,
                                "approvedupdate" => $approvedupdate,
                                "approvedby" => $approvedby,
                                "bomitemid" => $bomitemid,
                                "bomsno" => $bomsno,
                                "alloy" => $alloy,
                                "mtype" => $mtype,
                                "finish" => $finish,
                                "length" => $length,
                            );
                        }
                        require_once './../../controller/bom.php';
                        $bom = new Bom($cn);
                        echo $bom->Addnew($sva,$bomproject);
                    }
                }
            }                    
        }
        else{
            echo response("0", "Access Error");
        }
    }else{
        echo response("0", "Request Error");
    }