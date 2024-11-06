app.controller('newspec', function($scope, $http) {
    // const inputs = document.querySelectorAll("input");
    // inputs.forEach(i => {
    //     i.autocomplete = "off";
    // })
    document.getElementById("contract_menu").style.background = '#e84a5f';
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
            } else {
                alert(res.data.data);
            }
        });
    }


    function save_specification(new_spec) {
        let post_data = {
            naf_user: userinfo,
            new_spec: new_spec
        }
        var req = $http.post(api_url + "Project/newSpecification.php", post_data);
        req.then(
            function(res) {
                if (res.data.msg === "1") {
                    alert("saved");
                    $scope.spec_remark_aluminium = "";
                    $scope.spec_remark_finish = "";
                    $scope.spec_remark_glass2 = "";
                    $scope.spec_remark_glass1 = "";
                    $scope.spec_remark_hardware = "";
                } else {
                    alert(res.data.data);
                }
            }
        );
    }

    $scope.aluminium_spec_save = function() {
        let new_spec = {
            spec_project: project_id,
            spec_remark: $scope.spec_remark_aluminium,
            spec_type: "aluminium",
            spec_type_sub: "1"
        };
        save_specification(new_spec);
    }

    $scope.finish_spec_save = function() {
        let new_spec = {
            spec_project: project_id,
            spec_remark: $scope.spec_remark_finish,
            spec_type: "finish",
            spec_type_sub: "1"
        };
        save_specification(new_spec);
    }

    $scope.hardware_spec_save = function() {
        let new_spec = {
            spec_project: project_id,
            spec_remark: $scope.spec_remark_hardware,
            spec_type: "hardware",
            spec_type_sub: "1"
        };
        save_specification(new_spec);
    }
    $scope.glass1_spec_save = function() {
        let new_spec = {
            spec_project: project_id,
            spec_remark: $scope.spec_remark_glass1,
            spec_type: "glass",
            spec_type_sub: "double"
        };
        save_specification(new_spec);
    }

    $scope.glass2_spec_save = function() {
        let new_spec = {
            spec_project: project_id,
            spec_remark: $scope.spec_remark_glass2,
            spec_type: "glass",
            spec_type_sub: "spandrel"
        };

        save_specification(new_spec);
    }

    $scope.glass_spec_save = function() {
        let new_spec = {
            spec_project: project_id,
            spec_remark: $scope.project.glass_spce,
            spec_type: "glass",
            spec_type_sub: $scope.project.glass_type
        };
        console.log(new_spec);
        save_specification(new_spec);
    }
    all_glassSpck();

    function all_glassSpck() {
        let post_data = {
            naf_user: userinfo
        };

        $http({
            method: 'post',
            url: api_url + "GlassTypes/index.php",
            data: post_data
        }).then(
            function(res) {
                if (res.data.msg === "1") {
                    $scope.glass_types = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }


    var modal = document.getElementById("myModal");
    var modal_close = document.getElementById("close_modal");

    $scope.open_glassType = function() {
        modal.style.display = "block";
    }
    modal_close.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    $scope.glassType_add = function() {
        let post_data = {
            naf_user: userinfo,
            glassType: $scope.glassType
        };

        $http({
            method: 'post',
            data: post_data,
            url: api_url + "GlassTypes/new.php"
        }).then(
            (res) => {
                if (res.data.msg === '1') {
                    alert("saved");
                    $scope.glassType = "";
                    all_glassSpck();
                } else {
                    alert(res.data.data);
                }
            }
        )
    }
});