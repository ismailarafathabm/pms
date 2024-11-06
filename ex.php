<?php
session_start();
include_once('conf.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAFCO - Developer UI </title>
</head>

<body ng-app="dev" ng-controller="dcnt">
    <input type="text" ng-model="srcdata">
    <progress id="file" value="{{totalDisplayed}}" max="{{_approvals.length}}"> 32% </progress>
    <table>
        <tr ng-repeat="x in _approvals | limitTo:dipdatas">
            <td>{{$index+1}}</td>
            <td>{{x.approvals_id}}</td>
            <td>{{x.approvals_descriptions}}</td>
            <td>{{x.approvals_draw_no}}</td>
        </tr>
    </table>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="<?php echo $url_theme ?>/angular/angular.js"></script>

    <script>
        var userinfo = {
            user_name: "<?php echo $_SESSION['nafco_alu_user_name'] ?>",
            user_token: "<?php echo $_SESSION['nafco_alu_user_token'] ?>",
            user_dep: "<?php echo $_SESSION['nafco_alu_user_department'] ?>"
        };

        var api_url = "<?php echo $url_base ?>api/";

        var app = angular.module('dev', [])

            .controller('dcnt', function($scope, $http, $interval) {
                let st = 0;
                let end = 0;
                let totrowcount = 0;
                let dummy = [];
                render();

                function fixdata() {
                    dummy.forEach(x => {
                        console.log(x);
                    })

                }

                function render() {
                    getcounts().then(res => {
                        console.log(res);
                    })

                    getResponse().then(res => {
                        console.log(res);
                        dummy = res;
                        fixdata();
                    })

                }

                function getcounts() {
                    return new Promise((resolve, rject) => {
                        let post_data = {
                            naf_user: userinfo,
                            ofsets: st,
                            limits: end,
                        };
                        $http({
                            method: 'post',
                            data: post_data,
                            url: api_url + "DrawingApprovals/rptrwcnt.php"
                        }).then(
                            res => {
                                if (res.data.msg === "1") {
                                    $scope._approvals = res.data.data;
                                    resolve(res.data.data);
                                } else {
                                    rject("error")

                                }
                            }
                        )
                    })
                }

                function getResponse() {
                    st = 0;
                    end = 2000;
                    return new Promise((resolve, reject) => {
                        let post_data = {
                            naf_user: userinfo,
                            ofsets: st,
                            limits: end,
                        };
                        $http({
                            method: 'post',
                            data: post_data,
                            url: api_url + "DrawingApprovals/rptn.php"
                        }).then(
                            res => {
                                if (res.data.msg === "1") {
                                    resolve(res.data.data);
                                } else {
                                    rject("error")

                                }
                            }
                        )
                    })
                }
            })
    </script>
</body>

</html>