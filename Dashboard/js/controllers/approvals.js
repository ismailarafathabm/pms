import Gen from './../../Main/masterlog/js/controllers/gen.js';
app.controller('approval', function ($scope, $http, $rootScope) {
    const pc = new Gen();
    $scope.projects = [];
    $rootScope.currentproject = "";
   getAllprojects();
    async function getAllprojects() {
        const project = await pc.getAllProjects();
        $rootScope.projects = project;
        console.log($rootScope.projects);
        console.log(project_id.toUpperCase());
        $rootScope.currentproject = project_id.toUpperCase();
        $scope.$apply();
    }
    $scope.supersedenow = () => {
        console.log("itw working");
        var frm = document.getElementById("sede_edit_approvals");
        var fds = new FormData(frm);
        fds.append('user_name', userinfo.user_name);
        fds.append('user_token', userinfo.user_token);
        fds.append("approvals_projectid", project_id);


        var post_data = {
            url: api_url + "Approvals/supersheet.php",
            method: 'post',
            data: fds,
            headers: {
                'content-type': undefined
            }
        }

        $http(post_data).then(
            (res) => {
                if (res.data.msg === "1") {
                    alert("saved");
                    reload();
                } else {
                    alert(res.data.data);
                }
            }
        )
    }
    $scope.rmvitems = (x) => {
        console.log(x);
        var c = confirm("Are You Sure Remove this Approvals?");
        if (c) {
            var fd = new FormData();
            fd.append('user_name', userinfo.user_name);
            fd.append('user_token', userinfo.user_token);
            fd.append('approvals_id', x.approvals_id);

            var post_data = {
                method: 'post',
                url: api_url + "Approvals/remove.php",
                data: fd,
                headers: {
                    'content-type': undefined
                }
            }

            const req = $http(post_data);

            req.then(
                (res) => {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert("Removed");
                        get_all_approvals();
                    } else {
                        alert(res.data.data);
                    }
                }
            )
        }
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
    document.getElementById("approvals_menu").classList.add('menuactive');

    maxbodyheight();
    window.addEventListener('resize', () => {
        maxbodyheight()
    })

    function maxbodyheight() {
        var menuh = document.querySelector(".topprojectinfos").offsetHeight;
        //console.log(menuh);
        var mbody = document.querySelector(".ism-bodys");
        var wsize = window.innerHeight;
        //console.log(wsize);
        var head_size = document.querySelector(".ism-headers").offsetHeight;
        //console.log(head_size);        
        var nav_size = document.querySelector(".ism-navi-itmes");
        nav_size.marginTop = head_size + "px"
        var foot_size = document.querySelector(".ism-footers").offsetHeight;
        var rmh = 120;
        var bh = wsize - foot_size - menuh - 90;
        var bhbh = bh - 35 - 10 - 15;
        var bhbhbh = bh - 35 - 30;
        // var bhbhbh = bh - 45;
        var mrtop = menuh + 80;
        document.querySelector(".sub-body-container").style.height = bh + "px";
        document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container").style.maiHeight = bh + "px";

        document.querySelector(".sub-body-container").style.marginTop = mrtop + "px";


        document.querySelector(".loadingdiv").style.height = bhbh + "px";
        document.querySelector(".loadingdiv").style.maxHeight = bhbh + "px";
        document.querySelector(".loadingdiv").style.maiHeight = bhbh + "px";

        document.querySelector(".naf-tables").style.height = bhbhbh + "px";
        document.querySelector(".naf-tables").style.maxHeight = bhbhbh + "px";
        document.querySelector(".naf-tables").style.maiHeight = bhbhbh + "px";


        //set size main container

        var docwith = window.innerWidth;
        var mbodyw = document.querySelector(".ism-bodys").offsetWidth;

    }
    const inputs = document.querySelectorAll("input");
    inputs.forEach(i => {
        i.autocomplete = "off";
    })
    $scope.isloading = true;
    $("#back_btn").on('click', function() {
        window.history.back();
    })
    let project_id;
    if (!sessionStorage.getItem('nafco_project_current') || sessionStorage.getItem('nafco_project_current') === '') {
        projectlist();
    } else {
        project_id = sessionStorage.getItem('nafco_project_current');
        console.log(project_id);
        $rootScope.currentproject = project_id;
        
        get_projectinfo();
        get_approvalsTypes();
    }
    $rootScope.changecurrentproject = () => {
        console.log("called");
        project_id = $rootScope.currentproject.toLowerCase();
        console.log("change event"+project_id);
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
                ///console.log(res.data);
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
            //console.log(res.data);
            if (res.data.msg === "1") {
                $scope.viewproject = res.data.data;
                $scope.newproject = res.data.data;
                project_id = angular.lowercase(res.data.data.project_no);
                get_all_approvals();
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
                console.log(res.data);
                if (res.data.msg === "1") {
                    $scope.approval_types = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    function get_all_approvals() {
        var post_data = {
            naf_user: userinfo,
            project_no: project_id,
        };
        ///console.log(post_data);
        $http({
            url: api_url + "Approvals/projects.php",
            method: 'post',
            data: post_data
        }).then(
            function(res) {
                console.log(res.data);
                if (res.data.msg === '1') {
                    $scope._tempapprovals = res.data.data;
                } else {
                    alert(res.data.data);
                }
                $scope.isloading = false;
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
                console.log(JSON.stringify(res));
                if (res["msg"] === "1") {
                    alert("saved");
                    document.getElementById("save_approvals_new").reset();
                    //location.reload();
                    get_all_approvals();
                } else {
                    alert(res["data"]);
                }
                $("#save_approval_btn").show();
            }
        })
    });

    $scope.newapprovals = {
        techengineer: 'Mr. John Lacro',
        engmanager: 'Mr. Sunny Mathew',
    }


    $scope.getinfosapprovals = (infos) => {
        var dia = document.getElementById('dia_EditTechApprovals');
        dia.style.display = "block";
        console.log(infos);
        $scope.viewapprovals = infos;
    }
    $scope.viewinfosapprovals = (infos) => {
        var dia = document.getElementById('dia_viewTechApprovals');
        dia.style.display = "block";
        console.log(infos);
        $scope.viewapprovalsx = infos;
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
                console.log(res);
                console.log(JSON.stringify(res));
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

    $scope.supersedethis = (s) => {
        var dia = document.getElementById('dia_supersedeTechApprovals');
        dia.style.display = "block";
        $scope.viewapprovalssede = s;
    }
})

app.controller('techapprovalfi', function($scope, $http, $routeParams) {

    //$scope.fi.approval_type_name = $routeParams.aptype;

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
    $scope.fi = {
        'approval_type_name': $routeParams.aptype
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
                get_all_approvals();
            } else {
                alert(res.data.data);
            }
        });
    }

    function get_all_approvals() {
        var post_data = {
            naf_user: userinfo,
            project_no: project_id,
        };
        console.log(post_data);
        $http({
            url: api_url + "Approvals/projects.php",
            method: 'post',
            data: post_data
        }).then(
            function(res) {
                console.log(res.data);
                if (res.data.msg === '1') {
                    $scope._tempapprovals = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        );
    }

})

app.controller('asupersheetindex', function($scope, $http) {
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
            //console.log(res.data);
            if (res.data.msg === "1") {
                $scope.viewproject = res.data.data;
                $scope.newproject = res.data.data;
                project_id = angular.lowercase(res.data.data.project_no);
                get_all_approvals();
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
                console.log(res.data);
                if (res.data.msg === "1") {
                    $scope.approval_types = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    function get_all_approvals() {
        var post_data = {
            naf_user: userinfo,
            project_no: project_id,
        };
        console.log(post_data);
        $http({
            url: api_url + "Approvals/supersheet_index.php",
            method: 'post',
            data: post_data
        }).then(
            function(res) {
                console.log(res.data);
                if (res.data.msg === '1') {
                    $scope._tempapprovals = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        );
    }




    // $("#edit_sede_approvals").submit(function(e) {
    //     console.log("its working");
    //     // e.preventDefault();
    //     // // $("#save_edit_approval_btn").hide();
    //     // //
    //     // var fds = new FormData(this);
    //     // fds.append('user_name', userinfo.user_name);
    //     // fds.append('user_token', userinfo.user_token);
    //     // fds.append("approvals_projectid", project_id);

    //     // $.ajax({
    //     //     beforeSend: function() {

    //     //     },
    //     //     complete: function() {

    //     //     },
    //     //     error: function(er) {

    //     //     },
    //     //     url: api_url + "Approvals/supersheet.php",
    //     //     method: 'post',
    //     //     data: fds,
    //     //     cache: false,
    //     //     contentType: false,
    //     //     processData: false,
    //     //     success: function(res) {
    //     //         if (res["msg"] === "1") {
    //     //             alert("Updated");
    //     //             document.getElementById("edit_new_approval").reset();
    //     //             get_all_approvals();
    //     //         } else {
    //     //             alert(res["data"]);
    //     //         }
    //     //     }

    //     // })

    // });


    $scope.rmvitems = (x) => {
        console.log(x);
        var c = confirm("Are You Sure Remove this Approvals?");
        if (c) {
            var fd = new FormData();
            fd.append('user_name', userinfo.user_name);
            fd.append('user_token', userinfo.user_token);
            fd.append('approvals_id', x.approvals_id);

            var post_data = {
                method: 'post',
                url: api_url + "Approvals/remove.php",
                data: fd,
                headers: {
                    'content-type': undefined
                }
            }

            const req = $http(post_data);

            req.then(
                (res) => {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert("Removed");
                        get_all_approvals();
                    } else {
                        alert(res.data.data);
                    }
                }
            )
        }
    }
})

function reload() {
    location.reload();
}