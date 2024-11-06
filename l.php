<?php 
    if(isset($_POST['nafco_login'])){
        //echo "clicke";
        //check inputs

        if(!isset($_POST['nafco_user_name'])){
            ?>
            <div class="alert alert-warning alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="fa fa-times"></i>
                    </span>
                </button>
                <p class="mb-0">Enter User Name</p>
            </div>
            <?php
        }
        else if(!isset($_POST['nafco_user_password'])){
            ?>
            <div class="alert alert-warning alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="fa fa-times"></i>
                    </span>
                </button>
                <p class="mb-0">Enter User Password</p>
            </div>
            <?php 
        }
        else if($_POST['nafco_user_name'] === ""){
            ?>
            <div class="alert alert-warning alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                    <i class="fa fa-times"></i>
                    </span>
                </button>
                <p class="mb-0">Enter User Name</p>
            </div>
            <?php
        }
        else if($_POST['nafco_user_password'] === ""){
            ?>
            <div class="alert alert-warning alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                    <i class="fa fa-times"></i>
                    </span>
                </button>
                <p class="mb-0">Enter password</p>
            </div>
            <?php
        }else{
            //login action codes
           // echo "connection start";
            include_once('connection/connection.php');
            $connection = new connection();
            $db = $connection->connect();
            //echo "db working";
            include_once('controller/User.php');
            $user = new User($db);
            //echo "user working";
           

            $api = json_decode($user->login($_POST['nafco_user_name'],$_POST['nafco_user_password']));
            //echo json_encode($api);
            if($api->msg == "1"){
                if($api->data->user_status == "active"){
                    $_SESSION["nafco_alu_user_name"] = $api->data->user_id;
                    $_SESSION["nafco_alu_user_token"] = $api->data->user_token;
                    $_SESSION["nafco_alu_user_department"] = $api->data->user_department;
                    $_SESSION["nafco_alu_user_type"] = $api->data->user_type;
                    ?>
                    <script>
                        localStorage.setItem("nafco_login_username","<?php echo $_SESSION['nafco_alu_user_name']?>");
                        sessionStorage.setItem("nafco_login", "<?php echo $_SESSION['nafco_alu_user_name']?>");
                        sessionStorage.setItem("nafco_login", "<?php echo $_SESSION['nafco_alu_user_token']?>");
                        location.href = "<?php echo $url_base?>index.php";
                    </script>
                    <?php                    
                }else{
                    ?>
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">
                            <i class="fa fa-times"></i>
                            </span>
                        </button>
                        <p class="mb-0">Account Deactived - Contact Admin</p>
                    </div>
                    <?php
                }
            }else{
                ?>
                <div class="alert alert-danger alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">
                        <i class="fa fa-times"></i>
                        </span>
                    </button>
                     <p class="mb-0"><?php echo $api->data?></p>
                </div>
            <?php
            }
        }        
    }
?>