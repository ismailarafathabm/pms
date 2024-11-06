<?php
session_start();
include_once 'conf.php';
$_username = $_SESSION['nafco_alu_user_name'];
$_accessu = [
    'demo'
];
$_access = false;
foreach ($_accessu as $u) {
    if ($u === $_username) {
        $_access = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAFCO - PMS [USER'S LIST]</title>
    <link rel="stylesheet" href="themes/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="ulist.css">
    <link rel="stylesheet" type="text/css" href="./Dashboard/Main/css.css" />
    <style>
        .dashboard-modal-body-new {
            display: block;
            position: relative;
        }

        .dialog-bodywarper-new {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: flex-end;
        }

        .dialogrow_grid {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            padding: 5px;
        }

        .dialogrow_grid .dialable {
            font-size: 14px;
            margin-bottom: 5px;
            color: rgb(0 0 0 / 91%);

        }

        .dialogrow_grid .diainputs input {
            width: 100%;
            font-size: 14px;
            padding: 9px;
            border-radius: 5px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            -ms-border-radius: 5px;
            -o-border-radius: 5px;
            border: 1px solid #b8b8b8;
            outline: 1px solid transparent;
        }
    </style>
</head>

<body ng-app="pms" ng-controller="pmsctrl">
    <div class="warpper">
        <?php
        if (!$_access) {
        ?>

            <div class="error">
                <div class="warper">
                    <div class="backbtn" onclick="javascript:window.history.back()">
                        <i class="fa fa-arrow-left"></i>
                    </div>
                    <div class="errordiv"> You Can Not Access This Page</div>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="top">
                <div class="top-main">
                    <div class="topright">
                        <div class="backbtn" onclick="javascript:window.history.back()">
                            <i class="fa fa-arrow-left"></i>
                        </div>
                        <div class="titlepage">User List</div>
                    </div>
                    <div class="srcpanel">
                        <input type="text" class="searchbox" ng-model="src" placeholder="Search....">
                        <button class="add_newuser" type="button" onclick="document.getElementById('addnewEmployee_dialog').style.display='block'">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>

                </div>
            </div>
            <div class="body">
                <div class="maincard" ng-repeat="x in userlist | filter:src | orderBy : '-user_login_d'">
                    <div class="userinfos">
                        <div class="card-img">
                            <img width="70px" loading='lazy' src="assets/user4.png" alt="" class="">
                        </div>
                        <div class="card-infos">
                            <div class="username">{{x.user_id}}</div>
                            <div class="usertype">{{x.user_type}}</div>
                            <div class="departments">{{x.user_department}}</div>
                            <div class="userstatus">
                                <p class="{{x.user_status === 'active' ? 'greens' : 'dangers'}}">
                                    {{x.user_status}}
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class=" card-btns">
                        <button class="danger-go" ng-click="getinfos(x)">
                            <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
    </div>

    <div class="dashboard-modal" id="addnewEmployee_dialog">
        <div class="dashboard-modal-container">
            <div class="dashboard-modal-title">
                <div>
                    Create New User Account
                </div>
                <div>
                    <i class="fa fa-times" onclick="document.getElementById('addnewEmployee_dialog').style.display='none'"></i>
                </div>
            </div>
            <form name="savenewuser" id="usernewsave" ng-submit="save_new_user_submit()" autocomplete="off">
                <div class="dashboard-modal-body">
                    <div class="dialog-bodywarper">
                        <div class="dialogrow">
                            <div class="dialable">User Id <sup>*</sup></div>
                            <div class="diainputs">
                                <input type="text" class="diainput" ng-model="newuser.user_id" name="user_id" id="user_id" required>
                            </div>
                        </div>
                        <div class="dialogrow">
                            <div class="dialable">Password <sup>*</sup></div>
                            <div class="diainputs">
                                <input type="text" class="diainput" ng-model="newuser.user_password" name="user_password" id="user_password" required>
                            </div>
                        </div>
                        <div class="dialogrow">
                            <div class="dialable">Department <sup>*</sup></div>
                            <div class="diainputs">
                                <select class="diainput" ng-model="newuser.user_department" name="user_department" id="user_department" required>
                                    <option value="">-Select-</option>
                                    <?php
                                    include_once('controller/departments.php');
                                    $depart = new departments();
                                    $api_dep = json_decode($depart->get_all_departments());
                                    foreach ($api_dep as $dep) {
                                    ?>
                                        <option value="<?php echo $dep->dep_id ?>"><?php echo strtoupper($dep->dep_id) ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="dialogrow">
                            <div class="dialable">Type <sup>*</sup></div>
                            <div class="diainputs">
                                <select class="diainput" ng-model="newuser.user_type" name="user_type" id="user_type" required>
                                    <option value="">-Select-</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="dialogrow">
                            <div class="diainputs">
                                <button ng-disabled="savenewuser.$invalid" type="submit" class="ism-btns btn-normal">
                                    <i class="fa fa-check"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="dasboard-modal-foot">
                <button type="button" class="ism-btns btn-delete" onclick="document.getElementById('addnewEmployee_dialog').style.display='none'">
                    <i class="fa fa-times"></i>
                    Close
                </button>
            </div>
        </div>
    </div>


    <div class="dashboard-modal" id="editnewEmployee_dialog">
        <div class="dashboard-modal-container">
            <div class="dashboard-modal-title">
                <div>
                    Edit User Account
                </div>
                <div>
                    <i class="fa fa-times" onclick="document.getElementById('editnewEmployee_dialog').style.display='none'"></i>
                </div>
            </div>
            <form name="editnewuser" id="usernewedit" ng-submit="edit_new_user_submit()" autocomplete="off">
                <div class="dashboard-modal-body">
                    <div class="dialog-bodywarper">
                        <div class="dialogrow">
                            <div class="dialable">User Id</div>
                            <div class="diainputs">
                                <input type="text" class="diainput" ng-model="edituserinfo.user_id" name="user_id" id="edit_user_id" required readonly>
                            </div>
                        </div>
                        <div class="dialogrow">
                            <div class="dialable">Password</div>
                            <div class="diainputs">
                                <input type="text" class="diainput" ng-model="edituserinfo.user_password" name="user_password" id="edit_user_password" required>
                            </div>
                        </div>
                        <div class="dialogrow">
                            <div class="dialable">Department <sup>*</sup></div>
                            <div class="diainputs">
                                <select class="diainput" ng-model="edituserinfo.user_department" name="user_department" id="edit_user_department" required>
                                    <option value="">-Select-</option>
                                    <?php
                                    include_once('controller/departments.php');
                                    $depart = new departments();
                                    $api_dep = json_decode($depart->get_all_departments());
                                    foreach ($api_dep as $dep) {
                                    ?>
                                        <option value="<?php echo $dep->dep_id ?>"><?php echo strtoupper($dep->dep_id) ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="dialogrow">
                            <div class="dialable">Type <sup>*</sup></div>
                            <div class="diainputs">
                                <select class="diainput" ng-model="edituserinfo.user_type" name="user_type" id="edit_user_type" required>
                                    <option value="">-Select-</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="dialogrow">
                            <div class="dialable">Status <sup>*</sup></div>
                            <div class="diainputs">
                                <select class="diainput" ng-model="edituserinfo.user_status" name="user_status" id="edit_user_status" required>
                                    <option value="">-Select-</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">In-Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="dialogrow">
                            <div class="dialable">Last Login </div>
                            <div class="diainputs" style="display: flex;">
                                <input type="text" class="diainput" ng-model="edituserinfo.user_login" name="user_login" id="user_login" required readonly>
                                <button type="button" ng-click="getLogininfos(edituserinfo.user_id)" style="width:20px">
                                    <i class="fa fa-info"></i>
                                </button>
                            </div>
                        </div>
                        <div class="dialogrow">
                            <div class="diainputs">
                                <button ng-disabled="editnewuser.$invalid" type="submit" class="ism-btns btn-normal">
                                    <i class="fa fa-edit"></i>
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="dasboard-modal-foot">

                <button type="button" class="ism-btns btn-delete" onclick="document.getElementById('editnewEmployee_dialog').style.display='none'">
                    <i class="fa fa-times"></i>
                    Close
                </button>
            </div>
        </div>
    </div>


    <div class="dashboard-modal" id="dia_logininfos_view">
        <div class="dashboard-modal-container" style="width:860px">
            <div class="dashboard-modal-title">
                <div>
                    USER LOGIN INFORMATIONS
                </div>
                <div>
                    <i class="fa fa-times" onclick="document.getElementById('dia_logininfos_view').style.display='none'"></i>
                </div>
            </div>
            <form name="getuserlogins" id="userlogingets" ng-submit="userlogingets_submit()" autocomplete="off">
                <div class="dashboard-modal-body-new">
                    <div class="dialog-bodywarper-new">
                        <div class="dialogrow_grid">
                            <div class="dialable">From Date</div>
                            <div class="diainputs">
                                <input type="text" class="diainput" ng-model="getloginfo.stdate" name="stdate" id="stdate" required placeholder="dd-MM-YYYY">
                            </div>
                        </div>
                        <div class="dialogrow_grid">
                            <div class="dialable">To Date</div>
                            <div class="diainputs">
                                <input type="text" class="diainput" ng-model="getloginfo.enddate" name="enddate" id="enddate" required placeholder="dd-MM-YYYY">
                            </div>
                        </div>
                        <div class="dialogrow_grid">
                            <div class="diainputs">
                                <button ng-disabled="getuserlogins.$invalid || _loadingfetch" type="submit" class="ism-btns btn-normal">
                                    <i ng-show="!_loadingfetch" class="fa fa-edit"></i>
                                    <i ng-show="_loadingfetch" class="fa fa-spinner fa-pulse  fa-fw"></i>
                                    {{!_loadingfetch ? 'GET': ''}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="dashboard-model-body">
                <div class="dialog-bodywarper">
                    <table class="naf-tables" style="white-space: normal !important;">
                        <thead>
                            <tr>
                                <th class="fiexdheader">VIEW ALL</th>
                                <th class="fiexdheader">S.No</th>
                                <th class="fiexdheader">TIME</th>
                                <th class="fiexdheader">TYPE</th>
                                <th class="fiexdheader">DESCRIPTION</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="y in usercurrentLog | orderBy:'-log_time'">
                                <td>
                                    <button class="" ng-click="getAllSessions(y.log_user,y.log_token,y.ldate)">View</button>
                                </td>
                                <td>{{$index+1}}</td>
                                <td>{{y.log_time}}</td>
                                <td>{{y.log_action}}</td>
                                <td>{{y.log_descripton}}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="dasboard-modal-foot">
                <button type="button" class="ism-btns btn-delete" onclick="document.getElementById('dia_logininfos_view').style.display='none'">
                    <i class="fa fa-times"></i>
                    Close
                </button>
            </div>
        </div>
    </div>



    <div class="dashboard-modal" id="dia_loginsession_view">
        <div class="dashboard-modal-container" style="width:1260px">
            <div class="dashboard-modal-title">
                <div>
                    USER SESSON INFORMATION
                </div>
                <div>
                    <i class="fa fa-times" onclick="document.getElementById('dia_loginsession_view').style.display='none'"></i>
                </div>
            </div>
            
            <div class="dashboard-model-body">
                <div class="dialog-bodywarper">
                    <table class="naf-tables" style="white-space: normal !important;height: 80vh;">
                        <thead>
                            <tr>                                
                                <th class="fiexdheader">S.No</th>
                                <th class="fiexdheader">TIME</th>
                                <th class="fiexdheader">TYPE</th>
                                <th class="fiexdheader">PAGE</th>
                                <th class="fiexdheader">API PAGE</th>
                                <th class="fiexdheader">DESCRIPTION</th>
                                <th class="fiexdheader">MESSAGE</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="y in sessionEvents | orderBy:'-log_time'">                                
                                <td>{{$index+1}}</td>
                                <td>{{y.log_time}}</td>
                                <td>{{y.log_action}}</td>
                                <td>{{y.log_descripton.PAGEID}}</td>
                                <td>{{y.log_descripton.API_PAGE}}</td>
                                <td>{{y.log_descripton.ACTION}}</td>
                                <td>{{y.log_descripton.msg}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="dasboard-modal-foot">
                <button type="button" class="ism-btns btn-delete" onclick="document.getElementById('dia_loginsession_view').style.display='none'">
                    <i class="fa fa-times"></i>
                    Close
                </button>
            </div>
        </div>
    </div>



    <script src="<?php echo $url_loginscreen ?>vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="<?php echo $url_theme ?>/angular/angular.js"></script>
    <script>
        var userinfo = {
            user_name: "<?php echo $_SESSION['nafco_alu_user_name'] ?>",
            user_token: "<?php echo $_SESSION['nafco_alu_user_token'] ?>",
            user_dep: "<?php echo $_SESSION['nafco_alu_user_department'] ?>"
        };
        var _username = "<?php echo $_SESSION['nafco_alu_user_name'] ?>";
        var v = "<?php echo $v ?>";
        var api_url = "<?php echo $url_base ?>api/";
        var pms = angular.module('pms', []);
        pms.controller('pmsctrl', function($scope, $http) {
            getAllusers();
            $scope.userlist = [];

            function getAllusers() {
                var fd = {
                    naf_user: userinfo
                }
                var post_data = {
                    url: api_url + "users/index.php",
                    method: 'post',
                    data: fd
                };

                $http(post_data).then(
                    res => {
                        console.log(res.data.data);
                        if (res.data.msg === '1') {
                            $scope.userlist = res.data.data;
                        } else {
                            alert(res.data.data);
                        }
                    }
                )
            }

            $scope.save_new_user_submit = () => {
                let fd = {
                    naf_user: userinfo,
                    newuser: $scope.newuser
                };
                var post_data = {
                    method: 'post',
                    url: api_url + 'users/new.php',
                    data: fd
                }

                $http(post_data).then(
                    res => {
                        if (res.data.msg === "1") {
                            alert("saved");
                            getAllusers();
                            $scope.newuser = [];
                        } else {
                            alert("Error");
                        }
                    }
                )
            }

            $scope.getinfos = (x) => {
                document.getElementById('editnewEmployee_dialog').style.display = 'block';
                $scope.edituserinfo = x;
            }

            $scope.edit_new_user_submit = () => {
                var fd = {
                    user_id: $scope.edituserinfo.user_id,
                    naf_user: userinfo,
                    newuser: $scope.edituserinfo
                };

                var post_data = {
                    url: api_url + "users/edit.php",
                    method: 'post',
                    data: fd,
                };

                $http(post_data).then(
                    res => {
                        console.log(res.data);
                        if (res.data.msg === '1') {
                            alert("updataed");
                            getAllusers();
                        } else {
                            alert(res.data.data);
                        }
                    }
                )
            }

            let _currentUser = "";


            $scope.getLogininfos = (_id) => {
                let doc = document.getElementById("dia_logininfos_view");
                doc.style.display = "block";
                _currentUser = _id;

            }
            $scope._loadingfetch = false;
            $scope.userlogingets_submit = () => LoadUserLogs();
            let _process = false;
            $scope.usercurrentLog = [];

            function LoadUserLogs() {
                $scope._loadingfetch = true;
                if (!_process) {
                    _process = true;
                    let sdate = document.getElementsByName("stdate")[0].value;
                    let enddate = document.getElementsByName("enddate")[0].value;
                    if (sdate === "") {
                        alert("Enter From Date");
                        return;
                    }

                    if (enddate === "") {
                        alert("Enter To Date")
                        return;
                    }

                    const fd = {
                        naf_user: userinfo,
                        getinfouser: _currentUser,
                        stdate: sdate,
                        enddate: enddate,
                    }

                    const post_data = {
                        url: `${api_url}users/getlog.php`,
                        data: fd,
                        method: "POST"
                    };

                    const req = $http(post_data);

                    req.then(res => {
                        _process = false;
                        $scope._loadingfetch = false;
                        //console.log(res.data);
                        if (res?.data?.msg === "1") {
                            $scope.usercurrentLog = res?.data?.data ?? [];
                        } else if (res?.data?.msg === "0") {
                            alert(res.data.data);
                        } else {
                            alert("API ERROR :(, CHECK IN CONSOLE");
                            console.log(res.data);
                        }
                    })
                } else {
                    alert("ANOTHER PROCESS IS RUNNING...");
                }
            }

            $scope.sessionEvents = [];

            $scope.getAllSessions = (id, token, date) => {
                const fd = {
                    naf_user: userinfo,
                    getinfouser: id,
                    stdate: date,
                    sestoken: token,
                };

                const post_data = {
                    url: `${api_url}users/getsession.php`,
                    data: fd,
                    method: "POST"
                };

                const req = $http(post_data);

                req.then(res => {
                    if(res?.data?.msg === "1"){
                        $scope.sessionEvents = [];
                        $scope.sessionEvents = res?.data?.data ?? [];
                        document.getElementById("dia_loginsession_view").style.display = "block";
                    }else if(res?.data?.msg === "0"){
                        alert(res.data.data);
                    }else{
                        alert("API ERROR :( CHECK IN CONSOLE....");
                    }
                })


            }
        });
    </script>

    <script>
        // Notification.requestPermission().then(function(permission) {
        //     console.log(permission);
        // });
    </script>
<?php
        }
?>

</body>

</html>
