app.controller('spec', function($scope, $http) {
    // const inputs = document.querySelectorAll("input");
    // inputs.forEach(i => {
    //     i.autocomplete = "off";
    // })
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
                get_project_specification(project_id);
            } else {
                alert(res.data.data);
            }
        });



    }

    function get_project_specification(project_id) {
        let post_data = {
            naf_user: userinfo,
            project_no: project_id
        }

        var req = $http.post(api_url + "Project/getspecification.php", post_data);
        req.then(
            function(res) {
                $scope._aluminiumspc = res.data.data._aluminium;
                $scope._finishspc = res.data.data._finish;
                $scope._hardware = res.data.data._hardware;
                $scope._glass = res.data.data._glass;
            }
        );
    }
    $scope.remove_alu_spec = function(spid) {
        var _del = confirm("Are You Sure Delete This?");
        if (_del === true) {
            var post_data = {
                naf_user: userinfo,
                project_no: project_id,
                spec_id: spid
            };
            console.log(post_data, "working");
            var req = $http.post(api_url + "Project/remove_specification.php", post_data);
            req.then(
                function(res) {
                    if (res.data.msg === "1") {
                        alert("Removed");
                        get_project_specification(project_id);
                    } else {
                        alert(res.data.data);
                    }
                }
            )
        }
    }
    var edit_info = {
        spec_id: "",
        spec_project: "",
        spec_remark: "",
        spec_type: "",
        spec_type_sub: ""
    };
    var modal = document.getElementById("myModal");
    var modal_close = document.getElementById("close_modal");
    $scope.edit_alu_spec = function(id, remark, type, type_sub, title) {
        _edit_info = {
            spec_id: id,
            spec_project: project_id,
            spec_remark: remark,
            spec_type: type,
            spec_type_sub: type_sub,
            dialog_title: title
        };
        modal.style.display = "block";
        $scope.dialog_title = _edit_info.dialog_title;
        $scope.edit_spec_remark_aluminium = _edit_info.spec_remark;
    }
    modal_close.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    $scope.aluminium_spec_edit = function() {
        _edit_info.spec_remark = $scope.edit_spec_remark_aluminium;
        var post_data = {
            naf_user: userinfo,
            edit_info: _edit_info
        };
        var req = $http.post(api_url + "Project/update_specification.php", post_data);
        req.then(
            function(res) {
                if (res.data.msg === "1") {
                    alert("saved");
                    get_project_specification(project_id);
                } else {

                    alert(res.data.data);
                }
            }
        )
    }


});