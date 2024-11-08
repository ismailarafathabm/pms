app.controller('tandc', function($scope, $http) {
    // const inputs = document.querySelectorAll("input");
    // inputs.forEach(i => {
    //     i.autocomplete = "off";
    // })
    let project_id;
    inits();
    $("#back_btn").on('click', function() {
        window.history.back();
    })

    function inits() {
        if (!sessionStorage.getItem('nafco_project_current') || sessionStorage.getItem('nafco_project_current') === '') {
            projectlist();
        } else {
            project_id = sessionStorage.getItem('nafco_project_current');
            get_projectinfo();
        }
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
                getterms(res.data.data.project_no);
                project_id = angular.lowercase(res.data.data.project_no);
            } else {
                alert(res.data.data);

            }
        });
    }

    function getterms(project_id) {
        let post_data = {
            naf_user: userinfo,
            project_no: angular.lowercase(project_id)
        }
        var req = $http.post(api_url + "Project/terms.php", post_data);
        req.then(
            function(res) {
                $scope._terms = res.data.data;
            }
        );
    }

    $scope.remove_terms = function(rid) {
        var d = confirm("Are you Sure Delete this Term?");
        if (d === true) {
            let post_data = {
                naf_user: userinfo,
                projectname: project_id,
                terms_id: rid
            };

            $http.post(api_url + "Project/terms_remove.php", post_data)
                .then(
                    function(res) {
                        if (res.data.msg === "1") {
                            alert("removed");
                            getterms(project_id);
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

    $scope.new_terms_add = function() {
        var post_data = {
            naf_user: userinfo,
            projectname: project_id,
            terms_add_new: $("#terms_add_new").val()
        };
        $http.post(api_url + "Project/term_new.php", post_data)
            .then(
                function(res) {
                    if (res.data.msg === "1") {
                        alert("Saved....")
                        getterms(project_id);
                        $("#terms_add_new").val('');
                    } else {
                        alert(res.data.data);
                    }
                }
            )
    }


});