app.controller('conditions', function($scope, $http) {
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
        //$scope.projctname = project_id;
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

    function get_projectinfo() {
        let post_data = {
            naf_user: userinfo,
            project_no: project_id
        }
        var req = $http.post(api_url + "Project/view.php", post_data);
        req.then(res => {
            console.log(res.data);
            if (res.data.msg === "1") {
                $scope.viewproject = res.data.data;
                $scope.newproject = res.data.data;
                project_id = angular.lowercase(res.data.data.project_no)
                getconditions(project_id);
            } else {
                alert(res.data.data);
            }
        });
    }

    function getconditions(project_id) {
        let post_data = {
            naf_user: userinfo,
            project_no: project_id
        }
        var req = $http.post(api_url + "Project/conditions.php", post_data);
        req.then(
            function(res) {
                //console.log(res.data);
                $scope._conditions = res.data.data;
            }
        );
    }

    $scope.condition_remove = function(rno) {
        var d = confirm("Are you Sure Delete this Condition?");
        if (d === true) {
            let post_data = {
                naf_user: userinfo,
                projectname: project_id,
                condition_id: rno
            };

            $http.post(api_url + "Project/condition_remove.php", post_data)
                .then(
                    function(res) {
                        console.log(res.data);
                        if (res.data.msg === "1") {
                            alert("Removed...");
                            getconditions(project_id);
                        } else {
                            alert(res.data.data);
                        }
                    }
                );
        } else {

        }
    }

    var modal = document.getElementById("myModal");
    var modal_close = document.getElementById("close_modal");
    $scope.new_conditions = function() {
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

    $scope.new_conditions_add = function() {
        var post_data = {
            naf_user: userinfo,
            projectname: project_id,
            condition_add_new: $("#conditions_add_new").val()
        };
        console.log(post_data);
        $http.post(api_url + "Project/condition_add.php", post_data)
            .then(
                function(res) {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert("Saved....")
                        getconditions(project_id);
                        $("#conditions_add_new").val('');
                    } else {
                        alert(res.data.data);
                    }
                }
            )
    }

});