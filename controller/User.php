<?php 
    date_default_timezone_set('Asia/Riyadh');
    include_once('mac.php');
    include_once('log.php');
  
    class User extends mac{
        private $cn;
        private $cm;
        private $rows;
        private $sql;
        private $response;
        private $hostname;
        
        private $pms_auth;
        
        private $user_no;
        private $user_id;
        private $user_password;
        private $user_token;
        private $user_department;
        private $user_type;
        private $user_status;
        private $user_login;


        private $log;
        private $loginfos;

        function __construct($db){
            $this->cn = $db;
            $this->pms_auth = mac::pms_auth;
            // $this->log = new LOG($db);
            $this->hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $this->response = array("msg" => "0", "data" => "#_ERROR");
            $this->loginfos = array(
                "log_user" => "",
                "log_descripton" => "",
                "log_action" => "",
                "log_token" => "",
            );
        }

        public function create_newuser($newuser){
            $this->user_id = $this->enc('enc',$newuser['user_id']);
            $this->user_password = $this->enc('enc',$newuser['user_password']);
            $this->user_token = $this->token(75);
            $this->user_department = $this->enc('enc',$newuser['user_department']);
            $this->user_type = $this->enc('enc',$newuser['user_type']);
            $this->user_status = $this->enc('enc',"active");
            $date = date('d-m-Y h:i:sa');
            $this->user_login = $this->enc('enc',$date);
            $dub = false;
            $this->sql = "select *from $this->pms_auth where user_id = :user_id";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":user_id",$this->user_id);            
            $this->cm->execute();
            if($this->cm->rowCount() === 0){
                $dub = true;
            }
            //save action
            if($dub === true){
                $this->sql = "insert into $this->pms_auth values(
                    null,
                    :user_id,
                    :user_password,
                    :user_token,
                    :user_department,
                    :user_type,
                    :user_status,
                    :user_login
                )";
                $this->cm = $this->cn->prepare($this->sql);
                $this->cm->bindParam(":user_id",$this->user_id);
                $this->cm->bindParam(":user_password",$this->user_password);
                $this->cm->bindParam(":user_token",$this->user_token);
                $this->cm->bindParam(":user_department",$this->user_department);
                $this->cm->bindParam(":user_type",$this->user_type);
                $this->cm->bindParam(":user_status",$this->user_status);
                $this->cm->bindParam(":user_login",$this->user_login);
                if($this->cm->execute()){
                    $this->response = array("msg" => "1", "data" => "Saved");
                }else{
                    $this->response = array("msg" => "0", "data" => "DB Error");
                }
            }else{
                $this->response = array("msg" => "0", "data" => "This User Number found");
            }
            return json_encode($this->response);
            exit();
        }

        public function get_all_users(){
            $this->sql = "select *from $this->pms_auth";
            $this->cm = $this->cn->prepare($this->sql);            
            $this->cm->execute();
            $_userlist = [];
            while($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($this->rows);
                $login_s = date_format(date_create($this->enc('denc',$user_login)),'Y-m-d H:i:s');
                $_userlist[] = array(
                    'user_no' => $user_no,
                    'user_id' => $this->enc('denc',$user_id),
                    'user_password' => $this->enc('denc',$user_password),
                    'user_token' => $user_token,
                    'user_department' => $this->enc('denc',$user_department),
                    'user_type' => $this->enc('denc',$user_type),
                    'user_status' => $this->enc('denc',$user_status),
                    'user_login' => $this->enc('denc',$user_login),
                    'user_login_d' => $login_s,
                );
            }

            $this->response = array(
                "msg" => "1",
                "data" => $_userlist
            );

            return json_encode($this->response);
            exit();
        }

        public function login($username,$password){
            //echo "login function called";
            $this->user_id = $this->enc('enc',$username);
            $this->user_password = $this->enc('enc',$password);
            $this->sql = "select *from $this->pms_auth where user_id = :user_id and user_password = :user_password";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":user_id",$this->user_id);
            $this->cm->bindParam(":user_password",$this->user_password);
            $this->cm->execute();
            $log = false;
            //echo $this->cm->rowCount();
            if($this->cm->rowCount() === 1){
                $log = true;                
            }
            //echo $log ? "login action" : "Log in faild";
            if($log == true){
                $this->sql = "";
                $this->cm = "";               
                $token = $this->token(75);                
                $date = date('d-m-Y h:i:sa');
                $this->user_login = $this->enc('enc',$date);
                $this->sql = "update $this->pms_auth set user_token = :user_token,user_login=:user_login where user_id=:user_id";                
                $this->cm = $this->cn->prepare($this->sql);
                $this->cm->bindParam(":user_token",$token);
                $this->cm->bindParam(":user_login",$this->user_login);
                $this->cm->bindParam(":user_id",$this->user_id);
                $this->cm->execute(); 

                $this->sql = "";
                $this->cm = "";

                $this->sql = "select *from $this->pms_auth where user_id = :user_id and user_password = :user_password";
                $this->cm = $this->cn->prepare($this->sql);
                $this->cm->bindParam(":user_id",$this->user_id);
                $this->cm->bindParam(":user_password",$this->user_password);
                $this->cm->execute();
                $this->rows = $this->cm->fetch(PDO::FETCH_ASSOC);
                extract($this->rows);
                $_userinfo = array(
                    'user_no' => $user_no,
                    'user_id' => $this->enc('denc',$user_id),
                    'user_password' => $this->enc('denc',$user_password),
                    'user_token' => $user_token,
                    'user_department' => $this->enc('denc',$user_department),
                    'user_type' => $this->enc('denc',$user_type),
                    'user_status' => $this->enc('denc',$user_status),
                    'user_login' => $this->enc('denc',$user_login)
                );
                
                $this->loginfos = array(
                    "log_user" => $username,
                    "log_descripton" => "Status = OK, System Name = $this->hostname",
                    "log_action" => "LOGIN",
                    "log_token" => $user_token,
                );
                //$this->log->save_log($this->loginfos);
                $this->response = array(
                    "msg" => "1",
                    "data" => $_userinfo
                ); 
                
                
            }else{
                $this->loginfos = array(
                    "log_user" => $username,
                    "log_descripton" => "login Status : Error , System Name = $this->hostname",
                    "log_action" => "LOGIN-ERROR",
                    "log_token" => $this->token(75),
                );
                //$this->log->save_log($this->loginfos);
                $this->response = array(
                    "msg" => "0",
                    "data" => "Check User Name Or password"
                );  
                
            }            
            //print_r($this->response);
            return json_encode($this->response);
            exit();
        }
        public function get_user_info($userid){
            $this->user_id = $this->enc('enc',$userid);
            $this->sql = "select *from $this->pms_auth where user_id = :user_id";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":user_id",$this->user_id);
            $this->cm->execute();
            if($this->cm->rowCount() === 1){
                $this->rows = $this->cm->fetch(PDO::FETCH_ASSOC);
                extract($this->rows);
                $_userinfo = array(
                    'user_no' => $user_no,
                    'user_id' => $this->enc('denc',$user_id),
                    'user_password' => $this->enc('denc',$user_password),                    
                    'user_department' => $this->enc('denc',$user_department),
                    'user_type' => $this->enc('denc',$user_type),
                    'user_status' => $this->enc('denc',$user_status),
                    'user_login' => $this->enc('denc',$user_login)
                );                
                $userinfo = array(
                    "_userinfo" => $_userinfo,                    
                );
                $this->response = array(
                    "msg" => "1",
                    "data" => $userinfo
                ); 
            }else{
                $this->response = array(
                    "msg" => "0",
                    "data" => "User Name Not found...."
                ); 
            }
            return json_encode($this->response);
            exit();

        }
        public function LogOut($username){
            $this->user_id = $this->enc('enc',$username);
            $token = $this->token(75);            
            $date = date('d-m-Y h:i:sa');
            $this->user_login = $this->enc('enc',$date);
            $this->sql = "update $this->pms_auth set user_token = :user_token,user_login=:user_login where user_id=:user_id";            
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":user_token",$token);
            $this->cm->bindParam(":user_login",$this->user_login);
            $this->cm->bindParam(":user_id",$this->user_id);
            $this->cm->execute();  
            
            $this->loginfos = array(
                "log_user" => $this->user_id,
                "log_descripton" => "login Status : OK, System Name = $this->hostname",
                "log_action" => "LOGIN",
                "log_token" => $this->token(75),
            );
            $this->log->save_log($this->loginfos);
        }

        public function api_login($username,$usertoken){
            $this->user_id = $this->enc('enc',$username);
            $this->user_token = $usertoken;
            $this->sql = "select *from $this->pms_auth where user_id = :user_id and user_token = :user_token";            
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":user_id",$this->user_id);
            $this->cm->bindParam(":user_token",$this->user_token);
            $this->cm->execute();
            if($this->cm->rowCount() === 1){
                $this->rows = $this->cm->fetch(PDO::FETCH_ASSOC);
                extract($this->rows);
                $_api_user = array(
                    'user_no' => $user_no,
                    'user_id' => $this->enc('denc',$user_id),
                    'user_password' => $this->enc('denc',$user_password),
                    'user_token' => $user_token,
                    'user_department' => $this->enc('denc',$user_department),
                    'user_type' => $this->enc('denc',$user_type),
                    'user_status' => $this->enc('denc',$user_status),
                    'user_login' => $this->enc('denc',$user_login)                    
                );
                $this->loginfos = array(
                    "log_user" => $this->user_id,
                    "log_descripton" => "API REQUEST Id : $username login Status : OK, System Name = $this->hostname",
                    "log_action" => "API REQUEST",
                    "log_token" => $this->token(75),
                );
               // $this->log->save_log($this->loginfos);
                $this->response = array(
                    "msg" => "1",
                    "data" => $_api_user
                ); 
            }else{
                $this->loginfos = array(
                    "log_user" => $this->user_id,
                    "log_descripton" => "API REQUEST Id : $username login Status : Error, System Name = $this->hostname",
                    "log_action" => "API REQUEST",
                    "log_token" => $this->token(75),
                );
               // $this->log->save_log($this->loginfos);
                $this->response = array(
                    "msg" => "0",
                    "data" => "404"
                ); 
            }
            return json_encode($this->response);
            exit();
        }

        public function it_departmentDashboard(){
            $tot_users = "0";
            $tot_admins = "0";
            $tot_active = "0";
            $tot_inactive = "0";
            $_dpusers = [];
            

            $this->sql = "select *from $this->pms_auth";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $tot_users = $this->cm->rowCount();
            
            $this->sql = "";
            $this->cm = "";

            $this->sql = "select *from $this->pms_auth where user_type='YzRxSjIxWU90clJiOW5OS3BLbFFvUT09'";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $tot_admins = $this->cm->rowCount();

            
            $this->sql = "";
            $this->cm = "";

            $this->sql = "select *from $this->pms_auth where user_status='bjZxdmJNVjVrSi9tb1k1UUFKSGZuUT09'";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $tot_active = $this->cm->rowCount();

            
            $this->sql = "";
            $this->cm = "";

            $this->sql = "select *from $this->pms_auth where user_status<>'bjZxdmJNVjVrSi9tb1k1UUFKSGZuUT09'";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $tot_inactive = $this->cm->rowCount();

            $this->sql = "";
            $this->cm = "";

            include_once('departments.php');
            $dep = new departments();

            $api_dep = json_decode($dep->get_all_departments());

            foreach($api_dep as $dep){
                $enc_dep = $this->enc('enc',$dep->dep_id);
                $this->sql = "select *from $this->pms_auth where user_type='YzRxSjIxWU90clJiOW5OS3BLbFFvUT09' and user_department='$enc_dep'";
                $this->cm = $this->cn->prepare($this->sql);
                $this->cm->execute();                
                $_cnt_admin = $this->cm->rowCount();
                $this->sql = "select *from $this->pms_auth where user_type<>'YzRxSjIxWU90clJiOW5OS3BLbFFvUT09' and user_department='$enc_dep'";
                $this->cm = $this->cn->prepare($this->sql);
                $this->cm->execute();                
                $_cnt_users = $this->cm->rowCount();

                $this->sql = "select *from $this->pms_auth where user_department='$enc_dep'";
                $this->cm = $this->cn->prepare($this->sql);
                $this->cm->execute();                
                $_cnt = $this->cm->rowCount();

                $this->sql = "select *from $this->pms_auth where user_department='$enc_dep' and user_status='bjZxdmJNVjVrSi9tb1k1UUFKSGZuUT09'";
                $this->cm = $this->cn->prepare($this->sql);
                $this->cm->execute();                
                $_cnt_active = $this->cm->rowCount();

                $this->sql = "select *from $this->pms_auth where user_department='$enc_dep' and user_status<>'bjZxdmJNVjVrSi9tb1k1UUFKSGZuUT09'";
                $this->cm = $this->cn->prepare($this->sql);
                $this->cm->execute();                
                $_cnt_inactive = $this->cm->rowCount();

                $_dpusers[] = array(
                    "dep_name" => strtoupper($dep->dep_id),
                    "totusers" => $_cnt,
                    "admin" => $_cnt_admin,
                    "users" => $_cnt_users,
                    "active" => $_cnt_active,
                    "inactive" => $_cnt_inactive
                );

            }

            $_infos = array(
                "_all_users" => $tot_users,
                "_activeuser" => $tot_active,
                "_inactiveuser" => $tot_inactive,
                "_admins" => $tot_admins,
                "_depusers" => $_dpusers
            );
            $this->response = array("msg" => "1", "data" => $_infos);
            return json_encode($this->response);
            exit();
        }

        public function update_userinfo($edituserinfo){
            $this->user_id = $this->enc('enc',$edituserinfo['user_id']);
            $this->user_password = $this->enc('enc',$edituserinfo['user_password']);
            $this->user_token = $this->token(75);
            $this->user_department = $this->enc('enc',$edituserinfo['user_department']);
            $this->user_type = $this->enc('enc',$edituserinfo['user_type']);
            $this->user_status = $this->enc('enc',$edituserinfo['user_status']);
            $date = date('d-m-Y h:i:sa');
            $this->user_login = $this->enc('enc',$date);

            $this->sql = "update $this->pms_auth set user_password = :user_password,
            user_token = :user_token,
            user_department =:user_department,
            user_type = :user_type,
            user_status = :user_status where user_id = :user_id";

            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":user_password",$this->user_password);
            $this->cm->bindParam(":user_token",$this->user_token);
            $this->cm->bindParam(":user_department",$this->user_department);
            $this->cm->bindParam(":user_type",$this->user_type);
            $this->cm->bindParam(":user_status",$this->user_status);
            $this->cm->bindParam(":user_id",$this->user_id);

            if($this->cm->execute()){
                $this->response = array(
                    "msg" => "1",
                    "data" => "Updated"
                ); 
            }else{
                $this->response = array(
                    "msg" => "0",
                    "data" => "Data Base Error"
                ); 
            }
            return json_encode($this->response);
            exit();

        }

        public function update_password($username,$oldpass,$newpass){
            $this->user_id = $this->enc('enc',$username);
            $this->user_password = $this->enc('enc',$oldpass);
            $enc_newpass = $this->enc('enc',$newpass);            

            $this->sql = "SELECT *FROM $this->pms_auth where user_id=:user_id and user_password=:user_password";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":user_id",$this->user_id);
            $this->cm->bindParam(":user_password",$this->user_password);
            $this->cm->execute();
            $chang = false;
            
            if($this->cm->rowCount() === 1){
                $chang = true;
            }            
            if($chang === true){
                $token = $this->token('75');
                
                $this->sql = "UPDATE pms_auth set user_password=:user_password,user_token=:user_token where user_id=:user_id";
                $this->cm = $this->cn->prepare($this->sql);
                $this->cm->bindParam(":user_password",$enc_newpass);
                $this->cm->bindParam(":user_token",$token);
                $this->cm->bindParam(":user_id",$this->user_id);
                if($this->cm->execute()){
                    $this->response = array("msg" => "1","data" => "Saved");
                }else{
                    $this->response = array("msg" => "0","data" => "#_ DB Error");
                }
            }else{
                $this->response = array("msg" => "0","data" => "User Information Wrong...");
            }
            return json_encode($this->response);
            exit();
        }

    }
?>