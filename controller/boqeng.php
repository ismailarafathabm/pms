<?php 
    require_once 'mac.php';

    class BoqEng extends mac{
        private $cn;
        private $cm;
        private $sql;
        private $response;

        function __construct($db){
            $this->cn = $db;            
        }

        private function _getProjects(){
            $this->sql = "SELECT project_id,project_no,project_name,project_cname,project_location FROM pms_project_summary";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $rpts = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($rows);
                $rpt = array(
                    "project_id" => $project_id,
                    "project_enc" => $project_no,
                    "project_no" => $this->enc('denc',$project_no),
                    "project_name" => $this->enc('denc',$project_name),
                    "project_cname" => $this->enc('denc',$project_cname),                                       
                    "project_location" => $this->enc('denc',$project_location),                                       
                );

                $rpts[] = $rpt;
            }
            unset($this->cm,$this->sql,$rows);
            return $rpts;
        }

        public function AllProjects(){
            $rpts = $this->_getProjects();
            $this->response = array("msg" => "1", "data" => $rpts);
            return json_encode($this->response);
            exit;
        }

        private function _getallusers(){   
            $type = $this->enc('enc','engineeringuser');
            $this->sql = "SELECT user_no,user_id FROM pms_auth where user_department='$type'";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $rpts = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($rows);
                $rpt = array(
                    "user_no" => $user_no,
                    "user_id" => $this->enc('denc',$user_id),
                );
                $rpts[] = $rpt;
            }
            unset($this->cm,$this->sql,$rows);
            return $rpts;
        }

        public function AllUsers(){ 
            $rpts = $this->_getallusers();
            $this->response = array("msg" => "1" , "data" => $rpts);
            return json_encode($this->response);
            exit;
        }

        

        private function _checkautorization($projectid,$userid){
            $this->sql = "SELECT COUNT(ppid) as cnt FROM pms_project_autorization where ppid = :ppid and ppuid = :ppuid";
            $this->cm = $this->cn->prepare($this->sql);
            $params = array(
                ":ppid" => $projectid,
                ":ppuid" => $userid
            );
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = (int)$rows["cnt"];
            unset($rows,$this->cm,$this->sql);
            return $cnt;
        }

       



        private function _checkprojectauth($ppid){
            $this->sql = "SELECT a.ppaid,a.ppid,a.ppuid,b.user_no,b.user_id FROM pms_project_autorization as a inner join pms_auth as b on a.ppuid=b.user_no where a.ppid = :ppid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":ppid",$ppid);
            $this->cm->execute();
            $rpt = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $rpt = array(
                    "ppaid" => $rows["ppaid"],
                    "ppid" => $rows["ppid"],
                    "ppuid" => $rows["ppuid"],
                    "user_no" => $rows["user_no"],
                    "user_id" => $rows["user_id"],
                );
            }
            unset($this->cm,$this->sql,$rows);
            return $rpt;
        }

        private function _checkcountprojectauth($ppid){
            $this->sql = "SELECT COUNT(ppid) as cnt From pms_project_autorization where ppid = :ppid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":ppid",$ppid);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = (int)$rows["cnt"];
            unset($rows,$this->sql,$this->cm);
            return $cnt;
        }

        public function GetProjectAuthorization($ppid){
            $cnt = $this->_checkcountprojectauth($ppid);
            if($cnt === 0){
                $this->response = array("msg" => "0" , "data" => "NO data found");
                return json_encode($this->response);
                exit;
            }

            $infos = $this->_checkprojectauth($ppid);
            $this->response = array(
                "msg" => "1", "data" => $infos
            );
            return json_encode($this->response);
            exit;
        }


        private function _saveAuthorization($save){
            //$ddate = date('Y-m-d H:i:s');
            $this->sql = "INSERT INTO pms_project_autorization values(
                null,
                :ppid,
                :ppuid,
                :pplaccess,
                :ppstauts,
                :apiaction
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $issave = $this->cm->execute($save);
            unset($this->cm,$this->sql,$rows);
            return $issave;
        }

        private function _updateProjectAutorization($update){
            $this->sql = "UPDATE pms_project_autorization set 
            ppuid = :ppuid,
            apiaction = :apiaction  where ppaid = :ppaid";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($update);
            unset($this->cm,$this->sql);
            return $sv;
        }

        public function SaveAuthorization($save){
            $sv = $this->_saveAuthorization($save);
            if(!$sv){
                return json_encode(array("msg"=>"0","data" => "Error on Save"));
                exit;
            }
            $rpts = $this->_allAuth();
            return json_encode(array("msg"=>"1","data" => $rpts));
            exit;
        }

        public function UpdateAutorization($update){
            $update = $this->_updateProjectAutorization($update);
            if(!$update){
                return json_encode(array("msg"=>"0","data" => "Error on Update"));
                exit;
            }
            $rpts = $this->_allAuth();
            return json_encode(array("msg"=>"1","data" => $rpts));
            exit;
        }

        private function _allAuth(){
            $this->sql = "SELECT *,auth.user_id,project.project_no,project.project_name FROM pms_project_autorization 
            as pauth left join 
            pms_auth as auth on 
            pauth.ppuid = auth.user_no left join 
            pms_project_summary as project 
            on pauth.ppid = project.project_id";

            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $rpts = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $rpt = array(
                    "ppaid" => $rows["ppaid"],
                    "ppid" => $rows["ppid"],
                    "ppuid" => $rows["ppuid"],
                    "pplaccess" => $rows["pplaccess"],
                    "ppstauts" => $rows["ppstauts"],
                    "apiaction" => $rows["apiaction"],
                    "user_id" => $this->enc('denc',$rows["user_id"]),
                    "project_no" => $this->enc('denc',$rows["project_no"]),
                    "project_name" => $this->enc('denc',$rows["project_name"]),
                );
                $rpts[] = $rpt;
            }
            unset($this->sql,$this->cm,$rows);
            return $rpts;
        }

        public function AllAuths(){
            $rpts = $this->_allAuth();
            $this->response = array("msg" => "1", "data" => $rpts);
            return json_encode($this->response);
            exit;
        }


        private function _RemoveAuth($ppaid){
            $this->sql = "DELETE FROM pms_project_autorization where ppaid = :ppaid limit 1";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":ppaid",$ppaid);
            $rem = $this->cm->execute();
            return $rem;
        }

        public function RemoveAuth($ppaid){
            $rm = $this->_RemoveAuth($ppaid);
            if(!$rm){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error on Remove Data"
                );
                return json_encode($this->response);
                exit;
            }
            $rpts = $this->_allAuth();
            return json_encode(array("msg"=>"1","data" => $rpts));
            exit;

        }




    }
