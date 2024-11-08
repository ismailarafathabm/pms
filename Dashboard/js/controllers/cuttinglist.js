app.controller('ctrl_operation_cuttinglist', function($scope, $http) {
    // const inputs = document.querySelectorAll("input");
    // inputs.forEach(i => {
    //     i.autocomplete = "off";
    // })
    var bc_home = document.getElementById("back-to-tops");
    bc_home.addEventListener('click', function() {
        window.scrollTo(0, 0);
    })
    bc_home.style.display = "none";
    window.addEventListener('scroll', function() {
        if (pageYOffset > 400) {
            console.log("owk")
            bc_home.style.display = "block";
        } else {
            console.log("error");
            bc_home.style.display = "none";
        }
    })
    document.getElementById("contract_menu").style.background = '#e84a5f';
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
                console.log(res.data);
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
            //console.log(res.data);
            if (res.data.msg === "1") {
                $scope.viewproject = res.data.data;
                $scope.newproject = res.data.data;
                project_id = angular.lowercase(res.data.data.project_no);
                if (res.data.data.project_boq_refno === "") {

                } else if (res.data.data.project_boq_revision === "") {

                } else {
                    project_boq_refno = res.data.data.project_boq_refno;
                    project_boq_revision = res.data.data.project_boq_revision;
                    get_measurement(project_id, project_boq_refno, project_boq_revision);
                }
                $scope.newglassorder = {
                    cuttinglist_project_id: project_id
                };
                markingtype_all();
                // glassorder_all();
                cuttinglist_all();
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
                //console.log(res.data);
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
                //console.log(res.data);
                if (res.data.msg == "1") {
                    $scope._dapprovals = res.data.data;
                    $scope.drawapprovals = res.data.data;

                } else {
                    alert(res.data.data);
                }
            }
        );
    }

    function get_measurement(project_no, refno, reviewno) {
        var post_data = {
            naf_user: userinfo,
            project_no: project_no,
            project_refno: refno,
            project_reviewno: reviewno
        };
        console.log(post_data);
        $http.post(api_url + "Boq/index.php", post_data)
            .then(
                function(res) {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        $scope.measurements = res.data.data;
                    } else {
                        alert(res.data.data);
                    }
                }
            )
    }

    function markingtype_all() {
        let post_data = {
            naf_user: userinfo
        };

        $http({
            method: 'post',
            data: post_data,
            url: api_url + "markinglocation/index.php"
        }).then(
            (res) => {
                console.log(res.data);
                if (res.data.msg === "1") {
                    $scope.supplier_list = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    $scope.cuttinglist = [];

    function cuttinglist_all() {
        let post_data = {
            naf_user: userinfo,
            project_no: project_id,
        };
        console.log(post_data);
        $http({
            method: "post",
            url: api_url + "cuttinglist/index.php",
            data: post_data
        }).then((res) => {
            console.log(res.data);
            if (res.data.msg === "1") {
                $scope.cuttinglist = res.data.data;
            } else {
                alert(res.data.data);
            }
        })
    }




    $scope.glassorderslists = function(refno) {
        document.getElementById("glass_orderlist").style.display = "block";
        let post_data = {
            naf_user: userinfo,
            project_no: project_id,
            glassorderno: refno
        };
        console.log(post_data);
        $http({
            method: 'post',
            url: api_url + "glassorder/getbyrefno.php",
            data: post_data
        }).then(
            (res) => {
                console.log(res.data);
                if (res.data.msg === "1") {
                    $scope.glassorderlist = res.data.data;
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