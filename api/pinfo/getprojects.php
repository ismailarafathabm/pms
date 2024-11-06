<?php 
    include_once('../_def.php');
    $auth = false;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        extract($_POST);
        include_once('../../connection/connection.php');
        $connection = new connection();
        $db = $connection->connect();
        if (isset($user_name) && isset($user_token)) {
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
            $sql = "SELECT *FROM pms_projects_info ";
           
            if($st !== ''){
                $status = $user->enc('enc',$st);  
                $sql .= " where ppstatus='$status'";               
            }
            $sql .= " order by ppregion desc";
                     
            $cm = $db->prepare($sql);           
            $cm->execute();
            $plist = [];
            $vlist = [];
            while($row = $cm->fetch(PDO::FETCH_ASSOC)){
                
                $p = $user->enc('denc',$row['ppcno']);
                $sort = $p;
                if($p !== 'p01'){
                    $sort = "{$p[4]}{$p[5]}/{$p[1]}{$p[2]}{$p[0]}";
                }
                
                $_ppsign = date_create($row['ppsign']);
                $ppsign = date_format($_ppsign,'Y-m-d');
                $ppsign_d = date_format($_ppsign,'d-m-Y');
                $ppsign_n = date_format($_ppsign,'d-M-Y');

                $_ppexpiry = date_create($row['ppexpiry']);
                $ppexpiry = date_format($_ppexpiry,'Y-m-d');
                $ppexpiry_d = date_format($_ppexpiry,'d-m-Y');
                $ppexpiry_n = date_format($_ppexpiry,'d-M-Y');

                $_ppstatuschdate = date_create($row['ppstatuschdate']);
                $ppstatuschdate = date_format($_ppstatuschdate,'Y-m-d');
                $ppstatuschdate_n = date_format($_ppstatuschdate,'d-m-Y');
                $ppstatuschdate_d = date_format($_ppstatuschdate,'d-M-Y');

                $plist[] = array(
                    'ppno' => $row['ppno'],
                    'pno' => $row['ppcno'],
                    'sort' => $sort,
                    'ppcno' => ucwords(strtolower($user->enc('denc',$row['ppcno']))),
                    'ppname' => ucwords(strtolower($user->enc('denc',$row['ppname']))),
                    'ppregion' => ucwords(strtolower($user->enc('denc',$row['ppregion']))),
                    'pplocation' => ucwords(strtolower($user->enc('denc',$row['pplocation']))),
                    'ppsign' => $ppsign,
                    'ppsign_d' => $ppsign_d,
                    'ppsign_n' => $ppsign_n,
                    'ppduration' => ucwords(strtolower($user->enc('denc',$row['ppduration']))),
                    'ppexpiry' => $ppexpiry,
                    'ppexpiry_d' => $ppexpiry_d,
                    'ppexpiry_n' => $ppexpiry_n,
                    'ppstatusupby' => ucwords(strtolower($user->enc('denc',$row['ppstatusupby']))),      
                    'ppstatuschdate' => $ppstatuschdate,
                    'ppstatuschdate_d' => $ppstatuschdate_d,
                    'ppstatuschdate_n' => $ppstatuschdate_n,
                    
                );
            }

            echo response("1", $plist);
        }else{
            echo response("0", "Access Error");
        }
    }else{
        echo response("0", "Request Error");
    }
?>