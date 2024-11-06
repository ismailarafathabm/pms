<html>
<?php
session_start();
include_once('conf.php');
?>
<?php
if (!isset($_SESSION["nafco_alu_user_name"]) || $_SESSION["nafco_alu_user_name"] === "") {
?>
    <script>
        location.href = "<?php echo $url_base ?>index.php";
    </script>
<?php
}
?>

<head>
    <title>Nafco - Change Password</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url_loginscreen ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="themes/nafco_mo.css" />
    <style>
        #bck_btn {
            padding: 10px;
            border-radius : 1rem;
        }

        #bck_btn:hover {
            color: #fff;
            background: #000;
            box-shadow: 1px 1px 10px #000;

        }
    </style>
</head>

<body ng-app="nafco" ng-controller="nafctrl">
    <h2><?php echo $app_name ?></h2>
    <div class="container">

        <h3><i id="bck_btn" class="fa fa-arrow-left" style='margin-right:12px'></i> CHANGE YOUR PASSWORD</h3>
        <form id="form" name="passchange_frm" action="changepass.php" method="post">
            <div class="form-control">
                <label for="username">Current Password</label>
                <input type="password" ng-model="passchange.old_pass" id="old_pass" name="old_pass" required />
            </div>
            <div class="form-control">
                <label for="currentpassword">New Password</label>
                <input type="password" ng-model="passchane.negw_pass" id="new_pass" name="new_pass" required />
            </div>
            <div class="form-control">
                <label for="currentpassword">Re-Password</label>
                <input type="password" ng-model="passchange.rnew_pass" id="rnew_pass" name="rnew_pass" required />
            </div>
            <button name="change_pass_btn" ng-disabled="passchange_frm.$invalid" ng-show="(passchange.new_pass === passchange.rnew_pass) && (passchange.old_pass !== passchange.new_pass) && !passchange_frm.$invalid" type="submit" class="btn">Change Password</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="<?php echo $url_theme ?>/angular/angular.js"></script>
    <script src="<?php echo $url_theme ?>/angular/angular-route.js"></script>
    <script src="<?php echo $url_theme ?>/angular/angular-ui-router.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-cookie/4.1.0/angular-cookie.js" integrity="sha256-+acwL+Yen2ErC/wtAaCfON4Hp9YrBYtiBrPMPJpn3UY=" crossorigin="anonymous"></script>
    <script>
        var app = angular.module('nafco', []);
        app.controller('nafctrl', ['$scope', '$http', function($scope, $http) {
            $("#bck_btn").on('click', function() {
                window.history.back();
            });
        }]);
    </script>
</body>

</html>
<?php
extract($_POST);
if (isset($change_pass_btn)) {
    if (!isset($old_pass) || $old_pass === "") {
?>

        <script>
            alert("Enter your password")
        </script>
    <?php
    } else if (!isset($new_pass) || $new_pass === "") {
    ?>
        <script>
            alert("Enter Your New Password")
        </script>
    <?php
    }
    if (!isset($rnew_pass) || $rnew_pass === "") {
    ?>

        <script>
            alert("Re-Type password Missing")
        </script>
        <?php
    } else {
        include_once('connection/connection.php');
        $conn = new connection();
        $db = $conn->connect();

        include_once('controller/User.php');
        $users = new User($db);

        $api = json_decode($users->update_password($_SESSION['nafco_alu_user_name'], $old_pass, $new_pass));
        if ($api->msg === "1") {
        ?>
            <script>
                location.href = "<?php echo $url_base ?>logout.php";
            </script>
        <?php
        } else {
        ?>
            <script>
                alert("<?php echo $api->data ?>")
            </script>
<?php
        }
    }
}
?>