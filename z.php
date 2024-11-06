<html>

<body ng-app="mytest" ng-controller="mycrtl">
    <table>
        <tr ng-repeat="x in lists">
            <td>{{$index+1}}</td>
            <td>{{x.approvals_id}}</td>
        </tr>
    </table>
    <script src="themes/loginscreen/vendor/jquery/jquery-3.2.1.min.js"></script>

    <script src="themes/angular/angular.js"></script>
    <script>
        var app = angular.module('mytest', []);
        app.controller('mycrtl', function($scope) {
            $scope.lists = [];
            console.log("working");
            const p1 = fetch('api/DrawingApprovals/speedcode/index.php');
            p1.then(res => res.json()).then(res => {
                console.log(res.data);
                test(res.data);
                // cl(res.data)
            });
            //cl();

          

            function test(ds) {

                let n = [];
                let x = ds;
                let dv = 100;
                let reqc = parseInt((+x) / (+dv));
                let s = 0;
                let f = 0
                for (var i = 0; i < reqc; i++) {
                    
                    if (i === 0) {
                        s = 0;
                        n.push({
                            s,
                            f
                        });
                        s = 100;
                        n.push({
                            s,
                            f
                        });
                    } else {
                       s += (+dv);
                       n.push({
                            s,
                            f
                        });
                    }
                }


                let req = n.map(
                    limit => fetch(`api/DrawingApprovals/speedcode/all.php?kstart=${limit.s}&kend=${limit.f}`)
                );

                req.forEach(r => {
                    r.then(resp => resp.json()).then(
                        res => {
                            if (res.msg === "1") {
                                console.log(res.data);
                                res.data.forEach(i => {
                                    $scope.lists.push(i);
                                })
                                // $scope.lists.push({
                                //     approvals_id : res.data.approvals_id,
                                //     approvals_token : res.data.approvals_token,
                                //     approvals_for : res.data.approvals_for,
                                //     approvals_draw_no : res.data.approvals_draw_no,
                                //     approvals_descriptions : res.data.approvals_descriptions,
                                //     approvals_last_status : res.data.approvals_last_status,
                                // });
                                $scope.$apply();
                                console.log($scope.lists)
                            }
                        }
                    )
                })
                $scope.$apply();
                // Promise.all(req)
                // .then(responses => {
                // // all responses are resolved successfully
                // for(let response of responses) {
                // //alert(`${response.url}: ${response.status}`); // shows 200 for every url
                // }
                // return responses;
                // })
                // // map array of responses into an array of response.json() to read their content
                // .then(responses => Promise.all(responses.map(r => r.json())))
                // // all JSON answers are parsed: "users" is the array of them
                // .then(users => users.forEach(user => {
                //         $scope.lists.push({
                //         approvals_id : user.data.approvals_id,
                //         approvals_token : user.data.approvals_token,
                //         approvals_for : user.data.approvals_for,
                //         approvals_draw_no : user.data.approvals_draw_no,
                //         approvals_descriptions : user.data.approvals_descriptions,
                //         approvals_last_status : user.data.approvals_last_status,
                //     });
                //     $scope.$apply();
                //     console.log($scope.lists)
                // }));



                // Promise.all(req)
                // .then(responses => {
                // // all responses are resolved successfully
                // for(let response of responses) {
                // //alert(`${response.url}: ${response.status}`); // shows 200 for every url
                // }
                // return responses;
                // })
                // // map array of responses into an array of response.json() to read their content
                // .then(responses => Promise.all(responses.map(r => r.json())))
                // // all JSON answers are parsed: "users" is the array of them
                // .then(users => users.forEach(user => console.log(user)));

            }
        })
    </script>
</body>

<script>

</script>

</html>