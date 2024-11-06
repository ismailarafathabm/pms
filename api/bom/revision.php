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
           
            $api_item = _getiteminfos($cn,$revision_itemid);

            if($api_item->msg === "1"){
                $bomprofileno = $api_item->data->itemprofileno;
                $bompartno = $api_item->data->itempartno;
                $bomdescription = $api_item->data->itemdescription;
                $alloy = $api_item->data->itemalloy;
                $finish = $api_item->data->itemfinish;
                $length = $api_item->data->itemlength;
                $bomtype = $api_item->data->itemtype;   
                $bomdieweight = $api_item->data->itemdieweight;      
                $bomsystem  = $api_item->data->itemsystem; 
                require_once '../../controller/bom.php';
                $bom = new Bom($cn);
                $api_revisionno = _getrevisionno(strtolower($revision_projectno),$bom);
                //echo $api_revisionno['Y'];
                $updateinfos = array(
                    ':bomdate' => date_format(date_create($revision_bomdate),'Y-m-d'),
                    ':bomno' => $api_revisionno['ssno'],
                    ':bomsystem' => $bomsystem,
                    ':bomprofileno' => $revision_bomprofileno,
                    ':bompartno' => $revision_bompartno,
                    ':bomdescription' => $bomdescription,
                    ':bomdieweight' => $revision_bomdieweight,
                    ':bomunit' => $revision_bomunit,
                    ':bomreqlength' => $revision_bomreqlength,
                    ':bomreqbarqty' => $revision_bomreqbarqty,
                    ':bomreqtotweight' => $revision_bomreqtotweight,
                    ':bomremark' => $revision_bomremark === '' ? '-' : $revision_bomremark,
                    ':bomitemid' => $revision_itemid,
                    ':mtype' => $bomtype,
                    ':alloy' => $alloy,
                    ':finish' => $finish,
                    ':length' => $length,
                    ':bomtype' => 'R',
                    ':bomsno' => $api_revisionno['Y'],
                    ':bomlastno' => 'H',
                    ':rwid' => $revision_bomid,
                    ':prepareby' => $user_name,                
                );    
    
               
                echo $bom->Revision($revision_bomid,$updateinfos);
                
            }else{
                echo response("0",$api->data);
            }
            

            

        }
        else{
            echo response("0", "Access Error");
        }
    }else{
        echo response("0", "Request Error");
    }


    function _getiteminfos($cn,$id){
        include_once './../../controller/bomitem.php';
        $bomitem = new bomitem($cn);
        $_iteminfo = $bomitem->getItemInfo($id);
        $iteminfo = json_decode($_iteminfo);
        return $iteminfo;
    }

    function _getrevisionno($project,$api){
       
        $result = $api->_getRevisionNo($project);
        return $result;
    }
