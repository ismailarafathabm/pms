app.controller('approvalsedit', function($scope, $http, $routeParams) {
    // const inputs = document.querySelectorAll("input");
    // inputs.forEach(i => {
    //     i.autocomplete = "off";
    // })
    document.getElementById("approvals_menu").style.background = '#e84a5f';
    $("#back_btn").on('click', function() {
        window.history.back();
    })
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
    get_approvalsTypes();
    $scope.sno = $routeParams.token;

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

    $("#edit_new_approval").submit(function(e) {
        e.preventDefault();
        // $("#save_edit_approval_btn").hide();
        //
        var fds = new FormData(this);
        fds.append('user_name', userinfo.user_name);
        fds.append('user_token', userinfo.user_token);
        fds.append("approvals_projectid", project_id);

        $.ajax({
            beforeSend: function() {

            },
            complete: function() {

            },
            error: function(er) {

            },
            url: api_url + "Approvals/edit.php",
            method: 'post',
            data: fds,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                //console.log(res);
                if (res["msg"] === "1") {
                    alert(res["data"]);
                    document.getElementById("edit_new_approval").reset();
                    get_approvalsinfo();
                    location.reload();
                } else {
                    alert(res["data"]);
                }
            }

        })

    });


    var units_add = document.getElementById("approvetype_model");
    var close_modal_unit = document.getElementById("close_modal_type");
    $scope.new_type_model = function() {
        units_add.style.display = "block";
    }
    close_modal_unit.onclick = function() {
        units_add.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == units_add) {
            units_add.style.display = "none";
        }
    }

    $scope.aprrovalType_new = function() {
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


app.controller('approvalsupersheet', function($scope, $http, $routeParams) {
    document.getElementById("approvals_menu").style.background = '#e84a5f';
    $("#back_btn").on('click', function() {
        window.history.back();
    })
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
    get_approvalsTypes();
    $scope.sno = $routeParams.token;

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



    $("#edit_new_approval").submit(function(e) {
        e.preventDefault();
        // $("#save_edit_approval_btn").hide();
        //
        var fds = new FormData(this);
        fds.append('user_name', userinfo.user_name);
        fds.append('user_token', userinfo.user_token);
        fds.append("approvals_projectid", project_id);

        $.ajax({
            beforeSend: function() {

            },
            complete: function() {

            },
            error: function(er) {

            },
            url: api_url + "Approvals/supersheet.php",
            method: 'post',
            data: fds,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res["msg"] === "1") {
                    alert("Updated");
                    document.getElementById("edit_new_approval").reset();
                    window.history.back();
                } else {
                    alert(res["data"]);
                }
            }

        })

    });


    var units_add = document.getElementById("approvetype_model");
    var close_modal_unit = document.getElementById("close_modal_type");
    $scope.new_type_model = function() {
        units_add.style.display = "block";
    }
    close_modal_unit.onclick = function() {
        units_add.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == units_add) {
            units_add.style.display = "none";
        }
    }

    $scope.aprrovalType_new = function() {
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