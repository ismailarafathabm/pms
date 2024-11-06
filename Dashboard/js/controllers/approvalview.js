app.controller('approvalview', function($scope, $http, $routeParams) {
    // const inputs = document.querySelectorAll("input");
    // inputs.forEach(i => {
    //     i.autocomplete = "off";
    // })
    document.getElementById("approvals_menu").style.background = '#e84a5f';
    $("#back_btn").on('click', function() {
        window.history.back();
    });
    let project_id;
    if (!sessionStorage.getItem('nafco_project_current') || sessionStorage.getItem('nafco_project_current') === '') {
        projectlist();
    } else {
        project_id = sessionStorage.getItem('nafco_project_current');
        get_projectinfo();
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
                if (res.data.msg === "1") {
                    $scope.menu_Techapprovals = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }
    $scope.error = true

    function get_projectinfo() {
        let post_data = {
            naf_user: userinfo,
            project_no: project_id
        }
        var req = $http.post(api_url + "Project/view.php", post_data);
        req.then(res => {
            if (res.data.msg === "1") {
                $scope.viewproject = res.data.data;
                $scope.newproject = res.data.data;
                project_id = angular.lowercase(res.data.data.project_no);
                get_approvalsinfo();

            } else {
                alert(res.data.data);
            }
        });
    }



    function get_approvalsinfo() {
        let post_data = {
            naf_user: userinfo,
            project_no: project_id,
            token: $routeParams.token
        }
        $http.post(api_url + "Approvals/get.php", post_data)
            .then(
                function(res) {
                    if (res.data.msg === "1") {
                        $scope.viewapprovals = res.data.data;
                    } else {
                        alert(res.data.data)
                    }
                }
            );
    }

    function get_approvalsTypes() {
        let post_data = {
            naf_user: userinfo
        };
        $http({
            method: 'post',
            data: post_data,
            url: api_url + "Approval_Type/index.php"
        }).then(
            function(res) {
                if (res.data.msg === "1") {
                    $scope.approval_types = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }
    $scope.aprrovalType_new = function() {
        console.log("its working");
        var post_data = {
            naf_user: userinfo,
            approval_typeName: $scope.approvaltype_name
        };

        var req = $http({
            method: "post",
            url: api_url + "Approval_Type/new.php",
            data: post_data
        });

        req.then(
            function(res) {
                if (res.data.msg === '1') {
                    alert("Saved...");
                    get_approvalsTypes();
                    $scope.approvaltype_name = "";
                } else {
                    alert(res.data.data);
                }
            }
        );
    }

})