<?php
    date_default_timezone_set('Asia/Riyadh');
    include_once("mac.php");
    class LOGX extends mac{
        private $cn;
        private $cm;
        private $rows;
        private $sql;
        private $response;

        private $pms_user_log;

        private $log_id;
        private $log_user;
        private $log_time;
        private $log_descripton;
        private $log_action;
        private $log_token;

        function __construct($db){
            $this->cn = $db;
            $this->pms_user_log = mac::pms_user_log;
            $this->response = array("msg" => "0", "data" => "#_ERROR");
        }

        public function save_log($loginfo){
            // $this->log_user = $this->enc('enc',$loginfo['log_user']);
            // $this->log_time = $this->enc('enc',date("d-m-Y h:i:sa"));
            // $this->log_descripton = $this->enc('enc',$loginfo['log_descripton']);
            // $this->log_action = $this->enc('enc',$loginfo['log_action']);
            // $this->log_token = $loginfo['log_token'];
            // $date = date('Y-m-d');
            // $this->sql = "insert into $this->pms_user_log values(
            //     null,
            //     :log_user,
            //     :log_time,
            //     :log_descripton,
            //     :log_action,
            //     :log_token,
            //     '".$date."'
            // )";
            
            // $this->cm = $this->cn->prepare($this->sql);
            // $this->cm->bindParam(":log_user",$this->log_user);
            // $this->cm->bindParam(":log_time",$this->log_time);
            // $this->cm->bindParam(":log_descripton",$this->log_descripton);
            // $this->cm->bindParam(":log_action",$this->log_action);
            // $this->cm->bindParam(":log_token",$this->log_token);
            //$this->cm->execute();
            
        }

        public function get_user_log($userid){            
            $this->log_user = $this->enc('enc',$userid);            
            $this->sql = "SELECT *from $this->pms_user_log where log_user = :log_user";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":log_user",$this->log_user);            
            $this->cm->execute();
            $_logs = [];
            while($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($this->rows);
                $_logs[] = array(
                    'log_id' => $log_id,
                    'log_user' => $this->enc('denc',$log_user),
                    'log_time' => $this->enc('denc',$log_time),
                    'log_descripton' => json_encode($this->enc('denc',$log_descripton)),
                    'log_action' => $this->enc('denc',$log_action),
                    'log_token' => $log_token,
                );
            }            
            $this->response = array("msg" => "1" , "data" => $_logs);
            return json_encode($this->response);
            exit();
        }

        public function LoginLog($userid,$stdate,$enddate){
            $this->sql = "SELECT *FROM pms_user_log where log_user=:log_user and (log_action=:log_action or log_action=:log_actions) and (ldate>=:stdate and ldate <= :enddate)";
            // $this->sql = "SELECT *FROM pms_user_log where log_user=:log_user";
            $this->cm = $this->cn->prepare($this->sql);
            $params = array(
                ':log_user' => $userid,
                ':log_action' => $this->enc('enc',"LOGIN"),
                ':log_actions' => $this->enc('enc',"LOGIN-ERROR"),
                ':stdate' => $stdate,
                ':enddate' => $enddate
            );
            $this->cm->execute($params);
            $rec = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($rows);
                $login_s = date_format(date_create($this->enc('denc',$log_time)),'Y-m-d H:i:s');
                $rec[] = array(
                    'log_id' => $log_id,
                    'log_user' => $this->enc('denc',$log_user),
                    'log_time' => $login_s,
                    'log_descripton' => $this->enc('denc',$log_descripton),
                    'log_action' => $this->enc('denc',$log_action),
                    'log_token' => $log_token,
                    'ldate' => $ldate
                );
            }
            $this->response = array(
                'msg' => "1",
                'data' => $rec
            );
            unset($rows,$this->cm,$this->sql);
            return json_encode($this->response);
            exit();
        }

        public function getLogsSession($userid,$token,$date){
            $this->sql = "SELECT *FROM pms_user_log where log_user=:log_user and log_token=:log_token  and (log_action<>:log_action and log_action<>:log_actions) and ldate = :stdate";
            //$this->sql = "SELECT *FROM pms_user_log where log_user=:log_user and log_token=:log_token  and (log_action=:log_action or log_action=:log_actions) and ldate = :stdate";
            //$this->sql = "SELECT *FROM pms_user_log where log_user=:log_user";
            $this->cm = $this->cn->prepare($this->sql);
            $params = array(
                ':log_user' => $userid,
                ':log_token' => $token,
                ':log_action' => $this->enc('enc',"LOGIN"),
                ':log_actions' => $this->enc('enc',"LOGIN-ERROR"),
                ':stdate' => $date,                
            );
            $this->cm->execute($params);
            $rec = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($rows);
                $login_s = date_format(date_create($this->enc('denc',$log_time)),'Y-m-d H:i:s');
                $rec[] = array(
                    'log_id' => $log_id,
                    'log_user' => $this->enc('denc',$log_user),
                    'log_time' => $login_s,
                    'log_descripton' => json_decode($this->enc('denc',$log_descripton)),
                    'log_action' => $this->enc('denc',$log_action),
                    'log_token' => $log_token,
                    'ldate' => $ldate
                );
            }
            $this->response = array(
                'msg' => "1",
                'data' => $rec
            );
            unset($rows,$this->cm,$this->sql);
            return json_encode($this->response);
            exit();
        }
    }
?>     