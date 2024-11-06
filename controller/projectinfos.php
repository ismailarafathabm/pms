<?php 
    require_once 'mac.php';
    class ProjectInfo extends mac{
        private $cn;
        private $cm;        
        private $sql;
        private $response;

        function __construct($db)
        {
            $this->cn = $db;
            $this->response = array('msg' => "0", 'data' => "_Error");
        
        }

        public function ProjectDashboard(){
            $cnt_ongoing_withmanpower = 0;
            
            $status = $this->enc('enc','1');
            $this->sql = "SELECT *FROM pms_projects_info where ppstatus=:ppstatus";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":ppstatus",$status);
            $this->cm->execute();
            $cnt_ongoing_withmanpower = $this->cm->rowCount();
            unset($this->cm,$this->sql);


            $cnt_ongoing_withoutmanpower = 0;
            $status = $this->enc('enc','2');
            $this->sql = "SELECT *FROM pms_projects_info where ppstatus=:ppstatus";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":ppstatus",$status);
            $this->cm->execute();
            $cnt_ongoing_withoutmanpower = $this->cm->rowCount();
            unset($this->cm,$this->sql);

           

            $cnt_notstartedprojects = 0;
            $status = $this->enc('enc','3');
            $this->sql = "SELECT *FROM pms_projects_info where ppstatus=:ppstatus";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":ppstatus",$status);
            $this->cm->execute();
            $cnt_notstartedprojects = $this->cm->rowCount();
            unset($this->cm,$this->sql);


            $cnt_handoverpj = 0;            
            $status = $this->enc('enc','4');
            $this->sql = "SELECT *FROM pms_projects_info where ppstatus=:ppstatus";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":ppstatus",$status);
            $this->cm->execute();
            $cnt_handoverpj = $this->cm->rowCount();
            unset($this->cm,$this->sql);


            $cnt_untitle = 0;
            $status = $this->enc('enc','-');
            $this->sql = "SELECT *FROM pms_projects_info where ppstatus=:ppstatus";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":ppstatus",$status);
            $this->cm->execute();
            $cnt_untitle = $this->cm->rowCount();
            
            $totproject = 0;
            $totproject += $cnt_ongoing_withmanpower;
            $totproject += $cnt_ongoing_withoutmanpower;
            $totproject += $cnt_handoverpj;
            $totproject += $cnt_untitle;


            $result = array(
                'ongoingwithmanpower' => $cnt_ongoing_withmanpower,
                'ongoingwithoutmanpower' => $cnt_ongoing_withoutmanpower,
                'handoverprojects' => $cnt_handoverpj,
                'notstartedwithoutmanpower' => $cnt_notstartedprojects,
                'untitiled' => $cnt_untitle,
                'totalprojects' => $totproject
            );

            $this->response = array(
                'msg' => '1',
                'data' => $result
            );

            return json_encode($this->response);
            exit();
        }
    }
?>