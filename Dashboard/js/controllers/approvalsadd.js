app.controller('newapprovals', function($scope, $http) {
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
        get_approvalsTypes();
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
    $scope.newapprovals = {
        techengineer: 'Mr. John Lacro',
        engmanager: 'Mr. Sunny Mathew',
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
                project_id = angular.lowercase(res.data.data.project_no);
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

    $("#save_approvals_new").submit(function(e) {

        let project_id = sessionStorage.getItem('nafco_project_current');
        e.preventDefault();
        $("#save_approval_btn").hide();
        var fd = new FormData(this);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append("approvals_projectid", project_id)
        $.ajax({
            url: api_url + "Approvals/new.php",
            method: 'post',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res["msg"] === "1") {
                    alert("saved");
                    document.getElementById("save_approvals_new").reset();
                    location.reload();
                } else {
                    alert(res["data"]);
                }
                $("#save_approval_btn").show();
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