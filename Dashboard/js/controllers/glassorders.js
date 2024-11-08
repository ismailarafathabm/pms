app.controller("ctrl_operation_Glassorders", function($scope, $http) {
    // const inputs = document.querySelectorAll("input");
    // inputs.forEach(i => {
    //     i.autocomplete = "off";
    // })
    $("#back_btn").on('click', function() {
        window.history.back();
    });

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
                if (res.data.msg === "1") {
                    $scope.menu_Techapprovals = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    var project_boq_refno = "";
    var project_boq_revision = "";

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
                if (res.data.data.project_boq_refno === "") {

                } else if (res.data.data.project_boq_revision === "") {

                } else {
                    project_boq_refno = res.data.data.project_boq_refno;
                    project_boq_revision = res.data.data.project_boq_revision;

                }
                $scope.newglassorder = {
                    project_id: project_id
                };
                glassorder_all();
            } else {
                alert(res.data.data);
            }
        });
    }

    $scope.glassorder = [];

    function glassorder_all() {
        let post_data = {
            naf_user: userinfo,
            project_no: project_id
        };
        $http({
            method: 'post',
            url: api_url + "glassorder/index.php",
            data: post_data
        }).then(
            (res) => {
                if (res.data.msg === "1") {
                    $scope.glassorder = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }


    suppliers_all();

    function suppliers_all() {
        let post_data = {
            naf_user: userinfo
        }
        $http({ url: api_url + "suppliers/index.php", method: 'POST', data: post_data })
            .then(
                function(res) {
                    if (res.data.msg === "1") {
                        $scope.supplier_list = res.data.data;
                    } else {
                        alert(res.data.data);
                    }
                }
            )
    }

    all_glassTypes();

    function all_glassTypes() {
        let post_data = {
            naf_user: userinfo
        };

        $http({
            method: "post",
            url: api_url + "GlassType/index.php",
            data: post_data
        }).then(
            (res) => {
                if (res.data.msg === "1") {
                    $scope.glasstypes = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }
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
})