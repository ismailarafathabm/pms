<?php 
    require_once '../connection/connection.php';
    require_once '../controller/mac.php';
    $enc = new mac();
    
    $conn = new connection();
    $cn = $conn->connect();

    $sql = "SELECT project_no,project_type FROM pms_project_summary";
    $cm = $cn->prepare($sql);
    $cm->execute();
    $projectList= [];
    while($rows = $cm->fetch(PDO::FETCH_ASSOC)){ $projectList[] = $rows; }
    unset($cm,$sql,$rows);

    foreach($projectList as $project){
        $pjno = $enc->enc('denc',$project['project_no']);
        ///$ex = $pjno[0];
        $ptype = $pjno[0];
        echo  $pjno;
        echo "||";
        echo  $ptype;
        echo "||";        
        echo $enc->enc('denc',$project['project_type']);
        echo "||";
        $sv = updateProjectType($project['project_no'],$ptype);
        echo $sv;
        echo "||";
        echo "</br>";
    }

    function updateProjectType($pjno,$type){
        global $enc;    
        $_type = $enc->enc('enc','villa project');
        if($type === "p")
        {
            $_type = $enc->enc('enc','project');
        }

        global $cn;
        $sql = "UPDATE pms_project_summary set project_type='$_type' where project_no='$pjno'";
        $cm = $cn->prepare($sql);
       // $sv = $cm->execute() ? "Updated" : "DB ERROR";
        unset($cm,$sql);
        return "ERROR";        
    }
?>