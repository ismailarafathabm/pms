app.controller('ctrl_veriation', function($scope, $http) {

    document.getElementById("pro_costing").classList.add('menuactive');
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

    //back button action
    $("#back_btn").on('click', function() {
            window.history.back();
        })
        //check project no in session Storage
    let project_id;
    if (!sessionStorage.getItem('nafco_project_current') || sessionStorage.getItem('nafco_project_current') === '') {
        projectlist();
    } else {
        project_id = sessionStorage.getItem('nafco_project_current');
        get_projectinfo();
    }
    //get project base info
    function get_projectinfo() {
        let post_data = {
            naf_user: userinfo,
            project_no: project_id
        }
        var req = $http.post(api_url + "Project/view.php", post_data);
        req.then(res => {
            if (res.data.msg === "1") {
                var d = new Date();
                var y = d.getFullYear().toString();
                var yp = y.substr(y.length - 2);
                $scope.viewproject = res.data.data;
                $scope.newproject = res.data.data;
                project_id = angular.lowercase(res.data.data.project_no);
                $scope.newvariations = {
                    revison_project: res.data.data.project_no,
                    revison_project_name: res.data.data.project_name,
                    revison_project_location: res.data.data.project_location,
                    revison_refno_p1: 'NAF/CD'
                };
                ListVariations();
            } else {
                alert(res.data.data);
            }
        });
    }

    //menu technical approvals
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
    allregion();

    function allregion() {
        $scope.src_region = [];
        $scope.listregion = [];
        let post_data = {
            naf_user: userinfo,
        };

        $http({
            method: "post",
            data: post_data,
            url: api_url + "regions/index.php"
        }).then(
            (res) => {
                if (res.data.msg === "1") {
                    $scope.src_region = res.data.data;
                    $scope.listregion = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    allsalesman();

    function allsalesman() {
        $scope.src_salesman = [];
        $scope.salesmanlist = [];
        let post_data = {
            naf_user: userinfo
        };

        $http({
            method: "post",
            data: post_data,
            url: api_url + "SalesMan/index.php"
        }).then(
            function(res) {
                if (res.data.msg === "1") {
                    $scope.src_salesman = res.data.data;
                    $scope.salesmanlist = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    allsubjects();

    function allsubjects() {
        $scope.subjectlist = [];
        $scope.src_subjectlist = [];
        let post_data = {
            naf_user: userinfo
        }
        $http.post(api_url + "variationsubjects/index.php", post_data)
            .then(
                (res) => {
                    //console.log(res.data);
                    if (res.data.msg === "1") {
                        $scope.sublist123 = res.data.data;
                        $scope.src_subjectlist = res.data.data;
                    } else {
                        alert(res.data.data);
                    }
                }
            )
    }

    $scope.region_new_save = function() {
        var post_data = {
            naf_user: userinfo,
            region_name: $scope.addnewregionname
        };
        $http({
            method: "post",
            data: post_data,
            url: api_url + "regions/new.php"
        }).then(
            function(res) {
                if (res.data.msg === "1") {
                    alert("saved");
                    allregion();
                    $scope.addnewregionname = "";
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    //subject_name
    $scope.subjectname_new_save = function() {
        var post_data = {
            naf_user: userinfo,
            subject_name: $scope.addnewsubjectname
        };
        $http({
            method: "post",
            data: post_data,
            url: api_url + "variationsubjects/new.php"
        }).then(
            (res) => {
                if (res.data.msg === "1") {
                    alert("saved");
                    allsubjects();
                    $scope.addnewsubjectname = "";
                    document.getElementById('addnewsubjectname').focus();
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    $scope.salesman_new_save = function() {
        let post_data = {
            naf_user: userinfo,
            sales_code: $scope.addsalesmancode,
            sales_name: $scope.addsalesmanname
        };

        $http({
            method: "post",
            data: post_data,
            url: api_url + "SalesMan/new.php"
        }).then(
            function(res) {
                // console.log(res.data);
                if (res.data.msg === "1") {
                    alert("Saved");
                    allsalesman();
                    $scope.addsalesmancode = "";
                    $scope.addsalesmanname = "";
                    document.getElementById('addsalesmancode').focus();
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    $scope.refnojoin = function($event) {
        if (!$scope.newvariations.revison_refno_p1 || !$scope.newvariations.revison_refno_p2 || !$scope.newvariations.revison_refno_p3 || !$scope.newvariations.revison_refno_p4) {
            $scope.newvariations.variation_refno = "";
        } else {
            var _refno = $scope.newvariations.revison_refno_p1 + "/" + $scope.newvariations.revison_refno_p2 + "-" + $scope.newvariations.revison_refno_p3 + "/" + $scope.newvariations.revison_refno_p4;
            $scope.newvariations.revison_refno = _refno;
        }
    }
    $scope.GetOldinfo = function() {
        if (!$scope.newvariations.revison_refno_p3 || $scope.newvariations.revison_refno_p3 === '') {

        } else {
            let post_data = {
                naf_user: userinfo,
                project_no: project_id,
                p3: $scope.newvariations.revison_refno_p3
            };
            $http({
                method: "post",
                data: post_data,
                url: api_url + "Variations/getp3.php",
            }).then(
                function(res) {
                    console.log(res.data);
                    if (res.data.msg === '1') {
                        if (confirm("Already Data found, Do you Want Load Previous Data?")) {
                            $scope.newvariations = res.data.data;
                        }
                    }
                }
            );
        }
    }


    $scope.refnojoinn = function($event) {
        if (!$scope.newrevision.revison_refno_p1 || !$scope.newrevision.revison_refno_p2 || !$scope.newrevision.revison_refno_p3 || !$scope.newrevision.revison_refno_p4) {
            $scope.newrevision.variation_refno = "";
        } else {
            var _refno = $scope.newrevision.revison_refno_p1 + "/" + $scope.newrevision.revison_refno_p2 + "-" + $scope.newrevision.revison_refno_p3 + "/" + $scope.newrevision.revison_refno_p4;
            $scope.newrevision.revison_refno = _refno;
        }
    }

    $("#save_new_variations").submit(function(e) {
        e.preventDefault();
        var fd = new FormData(this);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        $.ajax({
            url: api_url + "Variations/new.php",
            data: fd,
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                console.log(res);
                if (res.msg === "1") {
                    alert("saved");
                    location.reload();
                } else {
                    alert(res.data);
                }
            }
        })
    })
    $scope.variationslist = [];

    function ListVariations() {
        let post_data = {
            naf_user: userinfo,
            project_no: project_id
        };
        $http({
            method: "post",
            data: post_data,
            url: api_url + "Variations/index.php",
        }).then(
            function(res) {
                console.log(res.data);
                if (res.data.msg === "1") {
                    $scope.variationslist = res.data.data;
                } else {
                    alert(res.data.data);
                }
                $scope.isloading = false;
            }
        )
    }

    $scope.Revision_btnList = function(x) {
        var post_data = {
            naf_user: userinfo,
            project_no: project_id,
            p3: x.variation_token
        };
        $scope.refno_display = x.variation_refno_p3;
        document.getElementById("revision_list").style.display = "block";
        $http({
            method: 'post',
            data: post_data,
            url: api_url + "Variations/allrevision.php",
            header: {
                'content-Type': 'text/json'
            }
        }).then(
            function(res) {
                console.log(res.data);
                if (res.data.msg === '1') {
                    $scope.revisionlist = [];
                    $scope.revisionlist = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )

    }
    $scope.AddNewRevision_btn = function(rvs) {

        $scope.refno_display = rvs.variation_refno_p3;
        $scope.newrevision = {
            revison_project: rvs.variation_project,
            revison_project_name: rvs.variation_project_name,
            revison_project_location: rvs.variation_project_location,
            revison_refno_p1: rvs.variation_refno_p1,
            revison_refno_p2: rvs.variation_refno_p2,
            revison_refno_p3: rvs.variation_refno_p3,
            revison_refno_p3s: rvs.variation_refno_p3,
            revison_refno_p4: rvs.variation_refno_p4,
            revison_refno: rvs.variation_refno,
            revison_no: rvs.revision_no,
            revison_atten: rvs.variation_atten,
            revision_date: rvs.variation_date,
            revision_to: rvs.variation_to,
            revision_subject: rvs.variation_subject,
            revision_description: rvs.variation_description,
            revision_amount: rvs.variation_amount,
            revision_remark: rvs.variation_remarks,
            revision_region: rvs.variation_region,
            revision_salesman: rvs.variation_salesman,
            revision_status: rvs.variation_status,
            variation_token: rvs.variation_token
        };
        document.getElementById("new-revision").style.display = "block";

    }
    $("#save_new_revision").submit(function(e) {
        e.preventDefault();
        var fd = new FormData(this);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        $.ajax({
            url: api_url + "Variations/newrevision.php",
            data: fd,
            method: 'post',
            processData: false,
            cache: false,
            contentType: false,
            success: function(res) {
                console.log('working')
                console.log(res);
            }
        })
    })



    $scope.edit_windows = function(v) {
        document.getElementById('edit-glassorder').style.display = 'block';
        $scope.editvariations = v;
    }



    $scope.status_change = function(itstoken) {
        console.log(itstoken)
        document.getElementById("change-status").style.display = "block";
        $scope.changestatus = {
            token_variation: itstoken.variation_token,
            token_revison: itstoken.revison_token,
            project_no: itstoken.revison_project,
        };
    }

    $scope.status_change_others = function(itstoken) {
        console.log(itstoken)
        document.getElementById("change-status_other").style.display = "block";
        $scope.changestatus = {
            token_variation: itstoken.variation_token,
            token_revison: itstoken.revison_token,
            project_no: itstoken.revison_project,
            revision_amount: itstoken.revision_amount
        };
    }

    $("#status_change_frm").submit(function(e) {
        e.preventDefault();
        var fd = new FormData(this);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        $.ajax({
            url: api_url + "Variations/statuschange.php",
            data: fd,
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                console.log(res);
                if (res.msg === "1") {
                    alert("saved");
                    location.reload();
                } else {
                    alert(res.data);
                }
            }
        })

    });
    //status_change_frm_others
    $("#status_change_frm1").submit(function(e) {
        e.preventDefault();
        var fd = new FormData(this);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        $.ajax({
            url: api_url + "Variations/statuschange_1.php",
            data: fd,
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                console.log(res);
                if (res.msg === "1") {
                    alert("saved");
                    location.reload();
                } else {
                    alert(res.data);
                }
            }
        })

    });

    $("#edit_new_variations").submit(function(e) {
        console.log('working');
        e.preventDefault();
        var fd = new FormData(this);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        $.ajax({
            url: api_url + "Variations/edit.php",
            data: fd,
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                console.log(res);
                if (res.msg === "1") {
                    alert("saved");
                    location.reload();
                } else {
                    alert(res.data);
                }
            }
        })
    })


    $scope.editvariationsdialogs = (x) => {
        $("#dia_editvairations").css('display', 'block');
        $scope.editvariations = x;
    }

    $scope.removevariations = (project, token) => {
        var c = confirm('Are your Sure Remove this Item?');
        if (c) {
            var fd = {
                naf_user: userinfo,
                variation_project: project,
                variation_token: token
            };

            var post_data = {
                url: api_url + "Variations/remove.php",
                method: 'post',
                data: fd
            };

            XRemoveActions(post_data).then(
                (res) => {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert("Removed");
                        location.reload();
                    } else {
                        alert(res.data.data);
                    }
                }
            )

        }
    }
    async function XRemoveActions(post_data = {}) {
        const req = await $http(post_data);
        return req;
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
   
   
});