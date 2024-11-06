<?php 
    if(!isset($boqeng)){
        include_once '../_error.php';
    }

    switch($fun){
        case 'default':
            header("HTTP/1.0 404 Page Not Found");
            echo response("0","Page Not Found");
            exit;
        case 'projects':
            echo $boqeng->AllProjects();            
            exit;
        case 'allUsers':
            echo $boqeng->AllUsers();
            exit;
        case 'getuserforcurrentproject':
            if(!isset($ppid) || trim($ppid) === ""){
                header("HTTP/1.0 400 input missing");
                echo response("0","Enter Project");
                exit;
            }
            echo $boqeng->GetProjectAuthorization($ppid);            
            exit;
        case 'saveauth':
            if(!isset($ppid) || trim($ppid) === ""){
                header("HTTP/1.0 400 bad request");
                echo response("0","Select Project");
                exit;
            }
            if(!isset($ppuid) || trim($ppuid) === ""){
                header("HTTP/1.0 400 bad request");
                echo response("0","Select User For Project");
                exit;
            }
            $saveparams = array(
                ":ppid" => $ppid,
                ":ppuid" => $ppuid,
                ":pplaccess" => date('Y-m-d H:i:s'),
                ":ppstauts" => "1",
                ":apiaction" => "boq"
            );
            echo $boqeng->SaveAuthorization($saveparams);
        exit;
        case 'updateauth':
            if(!isset($ppaid) || trim($ppaid) === ""){
                header("HTTP/1.0 400 bad request");
                echo response("0","Select Project");
                exit;
            }
            if(!isset($ppuid) || trim($ppuid) === ""){
                header("HTTP/1.0 400 bad request");
                echo response("0","Select User For Project");
                exit;
            }
            $updateparams = array(
                ":ppuid" => $ppuid,
                ":apiaction" => "boq",
                ":ppaid" => $ppaid,
            );
            echo $boqeng->UpdateAutorization($updateparams);
            exit;
        case 'allauths':
            echo $boqeng->AllAuths();
        exit;
        case 'removeauth':
            if(!isset($ppaid) || trim($ppaid) === "") {
                header("HTTP/1.0 400 bad request");
                echo response("0","Select Any ID");
                exit;
            }
            echo $boqeng->RemoveAuth($ppaid);
        exit;
    }
