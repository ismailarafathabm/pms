<?php
session_start();
include_once("conf.php");
if (isset($_SESSION["nafco_alu_user_name"])) {
?>
    <script>
        location.href = "<?php echo $url_router ?>router.php";
    </script>
<?php
} else {
?>
    <html>

    <head>
        <title><?php echo $site_name ?></title>
        <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?php echo $url_loginscreen ?>vendor/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?php echo $url_loginscreen ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?php echo $url_loginscreen ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?php echo $url_loginscreen ?>vendor/animate/animate.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?php echo $url_loginscreen ?>vendor/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?php echo $url_loginscreen ?>vendor/animsition/css/animsition.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?php echo $url_loginscreen ?>vendor/select2/select2.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?php echo $url_loginscreen ?>vendor/daterangepicker/daterangepicker.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?php echo $url_loginscreen ?>css/util.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $url_loginscreen ?>css/main.css">
       
    </head>

    <body>
        <div class="limiter">
            <div class="container-login100" style="background-image: url('<?php echo $url_loginscreen ?>images/bg-01.jpg');">
                <div class="wrap-login100 p-t-30 p-b-50 anix">
                    <center>
                        <img class='logo' src="<?php echo $url_asset ?>/log_screen.png" width="150px">
                    </center>
                    <span class="login100-form-title p-b-41">
                        NAFCO - PMS LOGIN
                    </span>
                    <form class="login100-form validate-form p-b-33 p-t-5" action="login.php" method="POST">

                        <div class="wrap-input100 validate-input" data-validate="Enter username">
                            <input class="input100" type="text" id="nafco_user_name" name="nafco_user_name" placeholder="User name">
                            <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                            <input class="input100" type="password" id="nafco_user_password" name="nafco_user_password" placeholder="Password">
                            <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                        </div>
                        <div class="container-login100-form-btn m-t-32">
                            <?php include_once('l.php'); ?> 
                        </div>
                        <div class="container-login100-form-btn m-t-32">
                            <button class="login100-form-btn" name="nafco_login" type="submit">
                                Login
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div id="dropDownSelect1"></div>
        <script src="<?php echo $url_loginscreen ?>vendor/jquery/jquery-3.2.1.min.js"></script>
        <!--===============================================================================================-->
        <script src="<?php echo $url_loginscreen ?>vendor/animsition/js/animsition.min.js"></script>
        <!--===============================================================================================-->
        <script src="<?php echo $url_loginscreen ?>vendor/bootstrap/js/popper.js"></script>
        <script src="<?php echo $url_loginscreen ?>vendor/bootstrap/js/bootstrap.min.js"></script>
        <!--===============================================================================================-->
        <script src="<?php echo $url_loginscreen ?>vendor/select2/select2.min.js"></script>
        <!--===============================================================================================-->
        <script src="<?php echo $url_loginscreen ?>vendor/daterangepicker/moment.min.js"></script>
        <script src="<?php echo $url_loginscreen ?>vendor/daterangepicker/daterangepicker.js"></script>
        <!--===============================================================================================-->
        <script src="<?php echo $url_loginscreen ?>vendor/countdowntime/countdowntime.js"></script>
        <!--===============================================================================================-->
        <script src="<?php echo $url_loginscreen ?>js/main.js"></script>
        <script>
            const username = localStorage.getItem("nafco_login_username");
            if(!username){

            }else{
                document.getElementById('nafco_user_name').value = username;
            }
        </script>
    </body>

    </html>
<?php
}
?>