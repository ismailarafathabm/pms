app.controller('drawing_approvals_addnew', function($scope, $http) {
    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian'
    };

    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function(value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function(value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    $scope.isbutton = true;
    $("#back_btn").on('click', function() {
        window.history.back();
    })

    let project_id;
    if (!sessionStorage.getItem('nafco_project_current') || sessionStorage.getItem('nafco_project_current') === '') {
        projectlist();
    } else {
        project_id = sessionStorage.getItem('nafco_project_current');
        get_projectinfo();
        //$scope.projctname = project_id;
    }

    function get_projectinfo() {
        let post_data = {
            naf_user: userinfo,
            project_no: project_id
        }
        var req = $http.post(api_url + "Project/view.php", post_data);
        req.then(res => {
            //console.log(res.data);
            if (res.data.msg === "1") {
                $scope.viewproject = res.data.data;
                $scope.newproject = res.data.data;
                project_id = angular.lowercase(res.data.data.project_no);
            } else {
                alert(res.data.data);
            }
        });
    }

    all_techApprovalsType();

    function all_techApprovalsType() {
        let post_data = {
            naf_user: userinfo
        };
        $http({
            method: 'post',
            data: post_data,
            url: api_url + "Approval_Type/index.php"
        }).then(
            function(res) {
                console.log(res.data);
                if (res.data.msg === "1") {
                    $scope.menu_Techapprovals = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }
    All_approvalsType();

    function All_approvalsType() {
        var post_data = {
            naf_user: userinfo
        };
        $http({
            method: 'post',
            url: api_url + "DrawingApprovalsTypes/index.php",
            data: post_data
        }).then(
            function(res) {
                console.log(res.data);
                if (res.data.msg == "1") {
                    $scope.drawapprovals = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        );
    }

    $scope.save_types = function() {
        var post_data = {
            naf_user: userinfo,
            drawing_types_new: $scope.drawing_types_new
        };
        console.log(post_data);
        $http.post(api_url + "DrawingApprovalsTypes/new.php", post_data)
            .then(
                (res) => {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert("saved");
                        $scope.drawing_types_new = "";
                        All_approvalsType();
                    } else {
                        alert(res.data.data);
                    }
                }
            );

    }
    
    $scope.d_save_new_approval = function() {
        $scope.isbutton = false;
        var post_data = {
            naf_user: userinfo,
            newapproval: $scope.newapproval,
            project_no: project_id
        };

        $http.post(api_url + "DrawingApprovals/new.php", post_data)
            .then(
                function(res) {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert("Saved");
                        $scope.newapproval = {
                            approvals_for: '',
                            approvals_draw_no: '',
                            approvals_descriptions: ''
                        };
                    } else {
                        alert(res.data.data);
                    }
                }
            )

        $scope.isbutton = true;
    }
})