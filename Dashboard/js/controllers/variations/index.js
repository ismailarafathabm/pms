app.controller('ctrl_newvariations', ctrl_newvariations);

function ctrl_newvariations($scope, $http) {
    document.title = "VARIATION";
    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian'
    };
    var site = print_location;
    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    document.getElementById("pro_costing").classList.add('menuactive');
    maxbodyheight();
    window.addEventListener('resize', () => {
        maxbodyheight()
    })
    $scope.isloading = false;
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

        document.querySelector(".naf-table-div").style.height = bhbhbh + "px";
        document.querySelector(".naf-table-div").style.maxHeight = bhbhbh + "px";
        document.querySelector(".naf-table-div").style.maiHeight = bhbhbh + "px";


        //set size main container

        var docwith = window.innerWidth;
        var mbodyw = document.querySelector(".ism-bodys").offsetWidth;

    }

    let project_id;
    if (!sessionStorage.getItem('nafco_project_current') || sessionStorage.getItem('nafco_project_current') === '') {
        projectlist();
    } else {
        project_id = sessionStorage.getItem('nafco_project_current');
        get_projectinfo();
    }
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
            function (res) {
                console.log(res.data);
                if (res.data.msg === "1") {
                    var list = [];
                    res.data.data.map(i => {
                        //console.log(i.variation_status);
                        list.push(i);
                        // if(i.variation_status !== '2' && i.variation_status !== '5' &&  i.variation_status !== '3') {

                        // }
                    })
                    console.log(list);
                    $scope.variationslist = list;
                } else {
                    alert(res.data.data);
                }
                $scope.isloading = false;
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
            function (res) {
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

    $scope.region_new_save = function () {
        var post_data = {
            naf_user: userinfo,
            region_name: $scope.addnewregionname
        };
        $http({
            method: "post",
            data: post_data,
            url: api_url + "regions/new.php"
        }).then(
            function (res) {
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
    $scope.subjectname_new_save = function () {
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

    $scope.salesman_new_save = function () {
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
            function (res) {
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

    $scope.refnojoin = function ($event) {
        if (!$scope.newvariations.revison_refno_p1 || !$scope.newvariations.revison_refno_p2 || !$scope.newvariations.revison_refno_p3 || !$scope.newvariations.revison_refno_p4) {
            $scope.newvariations.variation_refno = "";
        } else {
            var _refno = $scope.newvariations.revison_refno_p1 + "/" + $scope.newvariations.revison_refno_p2 + "-" + $scope.newvariations.revison_refno_p3 + "/" + $scope.newvariations.revison_refno_p4;
            $scope.newvariations.revison_refno = _refno;
        }
    }

    $scope.refnojoin_edit = function ($event) {
        if (!$scope.editvariations.revison_refno_p1 || !$scope.editvariations.revison_refno_p2 || !$scope.editvariations.revison_refno_p3 || !$scope.editvariations.revison_refno_p4) {
            $scope.editvariations.variation_refno = "";
        } else {
            var _refno = $scope.editvariations.revison_refno_p1 + "/" + $scope.editvariations.revison_refno_p2 + "-" + $scope.editvariations.revison_refno_p3 + "/" + $scope.editvariations.revison_refno_p4;
            $scope.editvariations.revison_refno = _refno;
        }
    }

    $scope.refnojoin_revision = function ($event) {
        if (!$scope.newrevision.revison_refno_p1 || !$scope.newrevision.revison_refno_p2 || !$scope.newrevision.revison_refno_p3 || !$scope.newrevision.revison_refno_p4) {
            $scope.newrevision.variation_refno = "";
        } else {
            var _refno = $scope.newrevision.revison_refno_p1 + "/" + $scope.newrevision.revison_refno_p2 + "-" + $scope.newrevision.revison_refno_p3 + "/" + $scope.newrevision.revison_refno_p4;
            $scope.newrevision.revison_refno = _refno;
        }
    }
    $scope.is_start_getrepott = false;
    $scope.getreport_dialog_submit = () => {
        $scope.is_start_getrepott = true;
        var frm = document.getElementById('getreport_dialog');
        var fd = new FormData(frm);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        let post_data = {
            url: `${api_url}vari/index.php`,
            method: 'post',
            data: fd,
            headers: {
                'content-type': undefined
            }
        };


        $http(post_data).then(res => {
            console.log(res.data);
            if (res.data.msg === '1') {
                alert("saved");
                ListVariations();
                location.reload();
            } else {
                alert(res.data.data);
            }
        })



        $scope.is_start_getrepott = false;

    }
    $scope.editvariationsdialogs = (v) => {
        console.log("working");
        console.log(v);
        var fetch = {
            variation_id: v.variation_id,
            variation_token: v.variation_token,
            revison_project: v.variation_project,
            revison_project_name: v.variation_project_name,
            revison_project_location: v.variation_project_location,
            revison_refno_p1: v.variation_refno_p1,
            revison_refno_p2: v.variation_refno_p2,
            revison_refno_p3: v.variation_refno_p3,
            revison_refno_p4: v.variation_refno_p4,
            revison_refno: v.variation_refno,
            revision_date: v.variation_date,
            revision_to: v.variation_to,
            revision_subject: v.variation_subject,
            revision_description: v.variation_description,
            revision_amount: v.variation_amount,
            revision_remark: v.variation_remarks,
            revision_region: v.variation_region,
            revision_salesman: v.variation_salesman,
            variation_status: v.variation_status,
            variation_createby: v.variation_createby,
            variation_editby: v.variation_editby,
            variation_cdate: v.variation_cdate,
            variation_edate: v.variation_edate,
            revison_no: v.revision_no,
            revison_atten: v.variation_atten,
            v_sub_name: v.v_sub_name,
            region_name: v.region_name,
            salesman_code: v.salesman_code,
            salesman_name: v.salesman_name,
            sdate: v.sdate,
            dispproject: v.dispproject,
            whochange: v.whochange,
            datechange: v.datechange,
            variation_date_n: v.variation_date_n
        }
        $scope.editvariations = fetch;
        $("#dia_edit_varation").css('display', 'flex');
    }
    $scope.is_start_getrepott = false;
    $scope.update_variation_edit_submit = () => {
        $scope.is_start_getrepott = true;
        var frm = document.getElementById('update_variation_edit');
        var fd = new FormData(frm);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        let post_data = {
            method: 'post',
            data: fd,
            url: `${api_url}vari/edit.php`,
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(res => {
            console.log(res.data)
            if (res.data.msg === '1') {
                alert("Updated");
                ListVariations();
            } else {
                alert(res.data.data);
            }
            $scope.is_start_getrepott = false;
        })
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

    $scope.AddNewRevision_btn = (rvs) => {
        console.log(v);
        $scope.refno_display = rvs.variation_refno_p3;
        let rev = {
            variation_id: rvs.variation_id,
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
        var dia_new_revision = document.getElementById('dia_new_revision');
        $scope.newrevision = rev;
        dia_new_revision.style.display = "flex";
    }

    $scope.is_start_getrepott = false;
    $scope.new_revision_save_submit = () => {
        $scope.is_start_getrepott = true;
        var frm = document.getElementById('new_revision_save');
        var fd = new FormData(frm);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        let post_data = {
            url: `${api_url}/vari/revision.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);
        req.then(
            res => {
                if (res.data.msg === "1") {
                    alert("saved");
                    document.getElementById('dia_new_revision').style.display = 'none';
                    ListVariations();
                } else {
                    alert(res.data.data);
                }
                $scope.is_start_getrepott = false;
            }
        );
    }

    $scope.Revision_btnList = (x) => {
        var post_data = {
            naf_user: userinfo,
            project_no: project_id,
            p3: x.variation_token
        };

        console.log(post_data);
        $scope.refno_display = x.variation_refno_p3;
        $http({
            method: 'post',
            data: post_data,
            url: api_url + "Variations/allrevision.php",
            header: {
                'content-Type': 'text/json'
            }
        }).then(
            function (res) {
                console.log(res.data);
                if (res.data.msg === '1') {
                    $scope.revisionlist = [];
                    $scope.revisionlist = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
        document.getElementById("dia_revision_list").style.display = "flex";
    }
    $scope.changeRevisionStatus = (t) => {
        $scope.changeStatus_ctrl = '';
        document.getElementById("update_status").style.display = "flex";
        $scope.changestatus = {
            token_variation: t.variation_token,
            token_revison: t.revison_token,
            project_no: t.revison_project,
        };
    }




    $scope.status_update_cancel_submit = () => {
        let frm = document.getElementById("status_update_cancel");
        let status = document.getElementsByName('variation_status')[0].value;
        let variation_project = document.getElementById('project_no').value;
        let variation_token = document.getElementById('token_variation').value;
        let revison_token = document.getElementById('token_revison').value;
        let fd = new FormData(frm);
        fd.append('status', status);
        fd.append('variation_project', variation_project);
        fd.append('variation_token', variation_token);
        fd.append('revison_token', revison_token);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        var post_data = {
            url: `${api_url}/vari/cancelupdate.php`,
            data: fd,
            method: "POST",
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(
            res => {
                if (res.data.msg === "1") {
                    reload();
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    $scope.status_update_accept_submit = () => {
        let frm = document.getElementById('status_update_accept');
        let status = document.getElementsByName('variation_status')[0].value;
        let variation_project = document.getElementById('project_no').value;
        let variation_token = document.getElementById('token_variation').value;
        let revison_token = document.getElementById('token_revison').value;
        let fd = new FormData(frm);
        fd.append('status', status);
        fd.append('variation_project', variation_project);
        fd.append('variation_token', variation_token);
        fd.append('revison_token', revison_token);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        var post_data = {
            url: `${api_url}/vari/acceptupdate.php`,
            data: fd,
            method: "POST",
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(
            res => {
                if (res.data.msg === "1") {
                    reload();
                } else {
                    alert(res.data.data);
                }
            }
        )

    }
}


app.controller('ctrl_newvariations_accept', function ($scope, $http) {

    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian'
    };

    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    document.getElementById("pro_costing").classList.add('menuactive');
    maxbodyheight();
    window.addEventListener('resize', () => {
        maxbodyheight()
    })
    $scope.isloading = false;
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

        document.querySelector(".naf-table-div").style.height = bhbhbh + "px";
        document.querySelector(".naf-table-div").style.maxHeight = bhbhbh + "px";
        document.querySelector(".naf-table-div").style.maiHeight = bhbhbh + "px";


        //set size main container

        var docwith = window.innerWidth;
        var mbodyw = document.querySelector(".ism-bodys").offsetWidth;

    }

    let project_id;
    if (!sessionStorage.getItem('nafco_project_current') || sessionStorage.getItem('nafco_project_current') === '') {
        projectlist();
    } else {
        project_id = sessionStorage.getItem('nafco_project_current');
        get_projectinfo();
    }
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
            function (res) {
                console.log(res.data);
                if (res.data.msg === "1") {
                    var list = [];
                    res.data.data.map(i => {
                        console.log(i.variation_status);
                        if (i.variation_status === '2' || i.variation_status === '5') {
                            list.push(i);
                        }
                    })
                    console.log(list);
                    $scope.variationslist = list;
                } else {
                    alert(res.data.data);
                }
                $scope.isloading = false;
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
            function (res) {
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

    $scope.region_new_save = function () {
        var post_data = {
            naf_user: userinfo,
            region_name: $scope.addnewregionname
        };
        $http({
            method: "post",
            data: post_data,
            url: api_url + "regions/new.php"
        }).then(
            function (res) {
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
    $scope.subjectname_new_save = function () {
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

    $scope.salesman_new_save = function () {
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
            function (res) {
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

    $scope.refnojoin = function ($event) {
        if (!$scope.newvariations.revison_refno_p1 || !$scope.newvariations.revison_refno_p2 || !$scope.newvariations.revison_refno_p3 || !$scope.newvariations.revison_refno_p4) {
            $scope.newvariations.variation_refno = "";
        } else {
            var _refno = $scope.newvariations.revison_refno_p1 + "/" + $scope.newvariations.revison_refno_p2 + "-" + $scope.newvariations.revison_refno_p3 + "/" + $scope.newvariations.revison_refno_p4;
            $scope.newvariations.revison_refno = _refno;
        }
    }
    $scope.refnojoin_edit = function ($event) {
        if (!$scope.editvariations.revison_refno_p1 || !$scope.editvariations.revison_refno_p2 || !$scope.editvariations.revison_refno_p3 || !$scope.editvariations.revison_refno_p4) {
            $scope.editvariations.variation_refno = "";
        } else {
            var _refno = $scope.editvariations.revison_refno_p1 + "/" + $scope.editvariations.revison_refno_p2 + "-" + $scope.editvariations.revison_refno_p3 + "/" + $scope.editvariations.revison_refno_p4;
            $scope.editvariations.revison_refno = _refno;
        }
    }

    $scope.refnojoin_revision = function ($event) {
        if (!$scope.newrevision.revison_refno_p1 || !$scope.newrevision.revison_refno_p2 || !$scope.newrevision.revison_refno_p3 || !$scope.newrevision.revison_refno_p4) {
            $scope.newrevision.variation_refno = "";
        } else {
            var _refno = $scope.newrevision.revison_refno_p1 + "/" + $scope.newrevision.revison_refno_p2 + "-" + $scope.newrevision.revison_refno_p3 + "/" + $scope.newrevision.revison_refno_p4;
            $scope.newrevision.revison_refno = _refno;
        }
    }
    $scope.is_start_getrepott = false;
    $scope.getreport_dialog_submit = () => {
        $scope.is_start_getrepott = true;
        var frm = document.getElementById('getreport_dialog');
        var fd = new FormData(frm);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        let post_data = {
            url: `${api_url}vari/index.php`,
            method: 'post',
            data: fd,
            headers: {
                'content-type': undefined
            }
        };


        $http(post_data).then(res => {
            console.log(res.data);
            if (res.data.msg === '1') {
                alert("saved");
                ListVariations();

            } else {
                alert(res.data.data);
            }
        })



        $scope.is_start_getrepott = false;

    }
    $scope.editvariationsdialogs = (v) => {
        console.log("working");
        console.log(v);
        var fetch = {
            variation_id: v.variation_id,
            variation_token: v.variation_token,
            revison_project: v.variation_project,
            revison_project_name: v.variation_project_name,
            revison_project_location: v.variation_project_location,
            revison_refno_p1: v.variation_refno_p1,
            revison_refno_p2: v.variation_refno_p2,
            revison_refno_p3: v.variation_refno_p3,
            revison_refno_p4: v.variation_refno_p4,
            revison_refno: v.variation_refno,
            revision_date: v.variation_date,
            revision_to: v.variation_to,
            revision_subject: v.variation_subject,
            revision_description: v.variation_description,
            revision_amount: v.variation_amount,
            revision_remark: v.variation_remarks,
            revision_region: v.variation_region,
            revision_salesman: v.variation_salesman,
            variation_status: v.variation_status,
            variation_createby: v.variation_createby,
            variation_editby: v.variation_editby,
            variation_cdate: v.variation_cdate,
            variation_edate: v.variation_edate,
            revison_no: v.revision_no,
            revison_atten: v.variation_atten,
            v_sub_name: v.v_sub_name,
            region_name: v.region_name,
            salesman_code: v.salesman_code,
            salesman_name: v.salesman_name,
            sdate: v.sdate,
            dispproject: v.dispproject,
            whochange: v.whochange,
            datechange: v.datechange,
            variation_date_n: v.variation_date_n
        }
        $scope.editvariations = fetch;
        $("#dia_edit_varation").css('display', 'flex');
    }
    $scope.is_start_getrepott = false;
    $scope.update_variation_edit_submit = () => {
        $scope.is_start_getrepott = true;
        var frm = document.getElementById('update_variation_edit');
        var fd = new FormData(frm);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        let post_data = {
            method: 'post',
            data: fd,
            url: `${api_url}vari/edit.php`,
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(res => {
            console.log(res.data)
            if (res.data.msg === '1') {
                alert("Updated");
                ListVariations();
            } else {
                alert(res.data.data);
            }
            $scope.is_start_getrepott = false;
        })
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

    $scope.Revision_btnList = (x) => {
        var post_data = {
            naf_user: userinfo,
            project_no: project_id,
            p3: x.variation_token
        };

        console.log(post_data);
        $scope.refno_display = x.variation_refno_p3;
        $http({
            method: 'post',
            data: post_data,
            url: api_url + "Variations/allrevision.php",
            header: {
                'content-Type': 'text/json'
            }
        }).then(
            function (res) {
                console.log(res.data);
                if (res.data.msg === '1') {
                    $scope.revisionlist = [];
                    $scope.revisionlist = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
        document.getElementById("dia_revision_list").style.display = "flex";


    }


    $scope.changeRevsion_accept_info = (t) => {
        console.log("its working");
        document.getElementById("update_status_accept").style.display = "flex";
        $scope.changestatus = {
            token_variation: t.variation_token,
            token_revison: t.revison_token,
            project_no: t.revison_project,
        };
    }
});



app.controller('ctrl_newvariations_cancell', function ($scope, $http) {
    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian'
    };

    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    document.getElementById("pro_costing").classList.add('menuactive');
    maxbodyheight();
    window.addEventListener('resize', () => {
        maxbodyheight()
    })
    $scope.isloading = false;
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

        document.querySelector(".naf-table-div").style.height = bhbhbh + "px";
        document.querySelector(".naf-table-div").style.maxHeight = bhbhbh + "px";
        document.querySelector(".naf-table-div").style.maiHeight = bhbhbh + "px";


        //set size main container

        var docwith = window.innerWidth;
        var mbodyw = document.querySelector(".ism-bodys").offsetWidth;

    }

    let project_id;
    if (!sessionStorage.getItem('nafco_project_current') || sessionStorage.getItem('nafco_project_current') === '') {
        projectlist();
    } else {
        project_id = sessionStorage.getItem('nafco_project_current');
        get_projectinfo();
    }
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
            function (res) {
                console.log(res.data);
                if (res.data.msg === "1") {
                    var list = [];
                    res.data.data.map(i => {
                        console.log(i.variation_status);
                        if (i.variation_status === '3') {
                            list.push(i);
                        }
                    })
                    console.log(list);
                    $scope.variationslist = list;
                } else {
                    alert(res.data.data);
                }
                $scope.isloading = false;
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
            function (res) {
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

    $scope.region_new_save = function () {
        var post_data = {
            naf_user: userinfo,
            region_name: $scope.addnewregionname
        };
        $http({
            method: "post",
            data: post_data,
            url: api_url + "regions/new.php"
        }).then(
            function (res) {
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
    $scope.subjectname_new_save = function () {
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

    $scope.salesman_new_save = function () {
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
            function (res) {
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

    $scope.refnojoin = function ($event) {
        if (!$scope.newvariations.revison_refno_p1 || !$scope.newvariations.revison_refno_p2 || !$scope.newvariations.revison_refno_p3 || !$scope.newvariations.revison_refno_p4) {
            $scope.newvariations.variation_refno = "";
        } else {
            var _refno = $scope.newvariations.revison_refno_p1 + "/" + $scope.newvariations.revison_refno_p2 + "-" + $scope.newvariations.revison_refno_p3 + "/" + $scope.newvariations.revison_refno_p4;
            $scope.newvariations.revison_refno = _refno;
        }
    }
    $scope.refnojoin_edit = function ($event) {
        if (!$scope.editvariations.revison_refno_p1 || !$scope.editvariations.revison_refno_p2 || !$scope.editvariations.revison_refno_p3 || !$scope.editvariations.revison_refno_p4) {
            $scope.editvariations.variation_refno = "";
        } else {
            var _refno = $scope.editvariations.revison_refno_p1 + "/" + $scope.editvariations.revison_refno_p2 + "-" + $scope.editvariations.revison_refno_p3 + "/" + $scope.editvariations.revison_refno_p4;
            $scope.editvariations.revison_refno = _refno;
        }
    }

    $scope.refnojoin_revision = function ($event) {
        if (!$scope.newrevision.revison_refno_p1 || !$scope.newrevision.revison_refno_p2 || !$scope.newrevision.revison_refno_p3 || !$scope.newrevision.revison_refno_p4) {
            $scope.newrevision.variation_refno = "";
        } else {
            var _refno = $scope.newrevision.revison_refno_p1 + "/" + $scope.newrevision.revison_refno_p2 + "-" + $scope.newrevision.revison_refno_p3 + "/" + $scope.newrevision.revison_refno_p4;
            $scope.newrevision.revison_refno = _refno;
        }
    }
    $scope.is_start_getrepott = false;
    $scope.getreport_dialog_submit = () => {
        $scope.is_start_getrepott = true;
        var frm = document.getElementById('getreport_dialog');
        var fd = new FormData(frm);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        let post_data = {
            url: `${api_url}vari/index.php`,
            method: 'post',
            data: fd,
            headers: {
                'content-type': undefined
            }
        };


        $http(post_data).then(res => {
            console.log(res.data);
            if (res.data.msg === '1') {
                alert("saved");
                ListVariations();

            } else {
                alert(res.data.data);
            }
        })



        $scope.is_start_getrepott = false;

    }
    $scope.editvariationsdialogs = (v) => {
        console.log("working");
        console.log(v);
        var fetch = {
            variation_id: v.variation_id,
            variation_token: v.variation_token,
            revison_project: v.variation_project,
            revison_project_name: v.variation_project_name,
            revison_project_location: v.variation_project_location,
            revison_refno_p1: v.variation_refno_p1,
            revison_refno_p2: v.variation_refno_p2,
            revison_refno_p3: v.variation_refno_p3,
            revison_refno_p4: v.variation_refno_p4,
            revison_refno: v.variation_refno,
            revision_date: v.variation_date,
            revision_to: v.variation_to,
            revision_subject: v.variation_subject,
            revision_description: v.variation_description,
            revision_amount: v.variation_amount,
            revision_remark: v.variation_remarks,
            revision_region: v.variation_region,
            revision_salesman: v.variation_salesman,
            variation_status: v.variation_status,
            variation_createby: v.variation_createby,
            variation_editby: v.variation_editby,
            variation_cdate: v.variation_cdate,
            variation_edate: v.variation_edate,
            revison_no: v.revision_no,
            revison_atten: v.variation_atten,
            v_sub_name: v.v_sub_name,
            region_name: v.region_name,
            salesman_code: v.salesman_code,
            salesman_name: v.salesman_name,
            sdate: v.sdate,
            dispproject: v.dispproject,
            whochange: v.whochange,
            datechange: v.datechange,
            variation_date_n: v.variation_date_n
        }
        $scope.editvariations = fetch;
        $("#dia_edit_varation").css('display', 'flex');
    }
    $scope.is_start_getrepott = false;
    $scope.update_variation_edit_submit = () => {
        $scope.is_start_getrepott = true;
        var frm = document.getElementById('update_variation_edit');
        var fd = new FormData(frm);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        let post_data = {
            method: 'post',
            data: fd,
            url: `${api_url}vari/edit.php`,
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(res => {
            console.log(res.data)
            if (res.data.msg === '1') {
                alert("Updated");
                ListVariations();
            } else {
                alert(res.data.data);
            }
            $scope.is_start_getrepott = false;
        })
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

    $scope.Revision_btnList = (x) => {
        var post_data = {
            naf_user: userinfo,
            project_no: project_id,
            p3: x.variation_token
        };

        console.log(post_data);
        $scope.refno_display = x.variation_refno_p3;
        $http({
            method: 'post',
            data: post_data,
            url: api_url + "Variations/allrevision.php",
            header: {
                'content-Type': 'text/json'
            }
        }).then(
            function (res) {
                console.log(res.data);
                if (res.data.msg === '1') {
                    $scope.revisionlist = [];
                    $scope.revisionlist = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
        document.getElementById("dia_revision_list").style.display = "flex";
    }
});


app.filter('statusfilter', function () {
    return function (data, filterx) {
        switch (data) {
            case '1': filterx = 'ISSUED FOR APPROVAL'; break;
            case '2': filterx = "APPROVED"; break;
            case '3': filterx = "CANCELLED"; break;
            case '5': filterx = "PAID/INVOICE"; break;
            case '4': filterx = 'DUMMY'; break;
        }
        return filterx;
    }
})

app.controller('rpt_variations_pending', rpt_variations_pending);
function rpt_variations_pending($scope, $http) {
    document.title = "PENDING VARIATION REPORT [ NAFCO - PMS ]";
    $scope._btn_print = access_variation_print;
    $scope._btn_excel = access_varation_export;
    document.getElementById("rpt_variation").classList.add('menuactive');
    var site = print_location;
    window.addEventListener('resize', () => {
        maxbodyheight()
    })
    maxbodyheight();

    function maxbodyheight() {
        var mbody = document.querySelector(".ism-bodys");
        var wsize = window.innerHeight;
        //console.log(wsize);
        var head_size = document.querySelector(".ism-headers").offsetHeight;
        //console.log(head_size);        
        var nav_size = document.querySelector(".ism-navi-itmes");
        nav_size.marginTop = head_size + "px"
        var foot_size = document.querySelector(".ism-footers").offsetHeight;
        var rmh = 120;
        var bh = wsize - 160;
        var bhbh = bh - 35 - 10 - 7;
        var bhbhbh = bh - 35 - 27;
        // var bhbhbh = bh - 45;

        //document.querySelector(".sub-body").style.marginTop = "75px";
        document.querySelector(".sub-body-container").style.height = bh + "px";
        document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container").style.maiHeight = bh + "px";
        //document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        // document.querySelector(".mainbodys_data").style.height = bhbh + "px";
        // document.querySelector(".mainbodys_data").style.maxHeight = bhbh + "px";
        // document.querySelector(".mainbodys_data").style.maiHeight = bhbh + "px";

        // document.querySelector(".loadingdiv").style.height = bhbh + "px";
        // document.querySelector(".loadingdiv").style.maxHeight = bhbh + "px";
        // document.querySelector(".loadingdiv").style.maiHeight = bhbh + "px";

        // document.querySelector(".naf-tables").style.height = bhbhbh + "px";
        // document.querySelector(".naf-tables").style.maxHeight = bhbhbh + "px";
        // document.querySelector(".naf-tables").style.maiHeight = bhbhbh + "px";


        //set size main container

        var docwith = window.innerWidth;
        var mbodyw = document.querySelector(".ism-bodys").offsetWidth;

        //document.querySelector(".inreportsbody").style.width = docwith - 300 - 30;
    }

    var filterParams = {
        comparator: function (filterLocalDateAtMidnight, cellValue) {
            var dateAsString = cellValue;
            var dateParts = dateAsString.split('-');
            var cellDate = new Date(
                Number(dateParts[0]),
                Number(dateParts[1]) - 1,
                Number(dateParts[2])
            );

            if (filterLocalDateAtMidnight.getTime() === cellDate.getTime()) {
                return 0;
            }

            if (cellDate < filterLocalDateAtMidnight) {
                return -1;
            }

            if (cellDate > filterLocalDateAtMidnight) {
                return 1;
            }
        },
    };
    var statuscheck = {
        'td-yellow': function (p) {
            return p.data.variation_status === '1'
        },
        'trgreen': function (p) {
            return p.data.variation_status === '2'
        },
        'trred txt-red': function (p) {
            return p.data.variation_status === '3'
        },
        'tryellow2': function (p) {
            return p.data.variation_status === '4'
        },
        'trgreen2': function (p) {
            return p.data.variation_status === '5'
        },
    }


    var columnDefs = [];
    console.log(access_variation_amount);
    columnDefs.push({
        headerName: 'Sl.No',
        field : "sno",
        //cellRenderer: 'node.rowIndex + 1',
        valueGetter: "node.rowIndex + 1",
        filter: false,
        sortable: false,
        suppressMenu: false,
        cellClassRules: statuscheck
    })

    columnDefs.push({
        headerName: 'Project NO',
        field: 'variation_project',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Name',
        field: 'variation_project_name',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    if (access_variation_amount || access_variation_pdf_access) {
        columnDefs.push({
            headerName: 'File',
            field : "pdfa",
            sortable: false,
            cellRenderer: function (p) {
                let _name = `${p.data.variation_project} # ${p.data.variation_refno} # ${p.data.variation_description}`;
                return `
            <a  href="${site}assets/variations/${p.data.variation_token}.pdf" download="${_name}">
                <img loading='lazy' src="${site}assets/pdfdownload.png?v=${v}" style="width:18px;">
            </a>
            `
            },
            filter: false,
            cellClassRules: statuscheck,
        });
    }
    columnDefs.push({
        headerName: 'Date',
        field: 'sdate',
        cellRenderer: function (p) {
            return `<div>${p.data.variation_date}</div>`
        },
        sortingOrder: ['asc', 'desc'],
        cellClass: 'dateType_green',
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        cellClassRules: statuscheck,
        sort: 'desc',
    })
    columnDefs.push({
        headerName: 'Subject',
        field: 'v_sub_name',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    })
    columnDefs.push({
        headerName: 'Ref No',
        field: 'variation_refno',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    })
    columnDefs.push({
        headerName: 'Revision No',
        field: 'revision_no',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    })
    if (access_variation_amount) {
        columnDefs.push({
            headerName: 'Total Amount',
            field: 'variation_amount',
            filter: 'agNumberColumnFilter',
            sortingOrder: ['asc', 'desc'],
            cellClassRules: statuscheck,
            cellClass: 'money-filed',
            valueFormatter: currencyFormatter,

        })
    }
    columnDefs.push({
        headerName: 'Status',
        field: 'variation_statustext',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,

    })
    if (access_variation_amount || access_variation_pdf_access) {
        columnDefs.push({
            headerName: 'File',
            field : "pdfb",
            sortable: false,
            cellRenderer: function (p) {
                return p.data.variation_status !== '1' ?
                    `
            <a  href="${site}assets/variation_status/${p.data.variation_token}.pdf"  target="_blank">
                <img loading='lazy' src="${site}assets/pdfdownload.png?v=${v}" style="width:18px;">
            </a>
            ` : ``
            },
            filter: false,
            cellClassRules: statuscheck,

        })
    }
    columnDefs.push({
        headerName: 'Atte',
        field: 'variation_atten',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    })
    columnDefs.push({
        headerName: 'Contractor/Client',
        field: 'variation_to',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    })
    columnDefs.push({
        headerName: 'Description',
        field: 'variation_description',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Region',
        field: 'region_name',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Sales Man',
        field: 'salesman_code',
        cellRenderer: function (p) {
            return `<div>${p.data.salesman_code} - ${p.data.salesman_name} </div>`
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });

    function currencyFormatter(params) {
        return formatNumber(params.value);
    }

    function formatNumber(number) {
        // this puts commas into the number eg 1000 goes to 1,000,
        // i pulled this from stack overflow, i have no idea how it works
        return Math.floor(number)
            .toString()
            .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
    var gridOptions = {
        autoHeight: true,
        suppressContextMenu: true,
        columnDefs: columnDefs,
        enableCellChangeFlash: true,
        defaultColDef: {
            autoHeight: true,
            sortable: true,
            filter: true,
            floatingFilter: true,
            wrapText: true,
            resizable: true,
        },
        suppressMenuHide: true,
        colResizeDefault: 'shift',
        excelStyles: [{
            id: 'dateType',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        },
        {
            id: 'dateTypes',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        },
        {
            id: 'dateType_green',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        }
        ],
        statusBar: {
            statusPanels: [{
                statusPanel: 'agFilteredRowCountComponent',
                align: 'left'
            },
            {
                statusPanel: 'agTotalAndFilteredRowCountComponent',
                align: 'left'
            },
            ],
        },
    };

    function dateComparator(date1, date2) {
        var date1Number = monthToComparableNumber(date1);
        var date2Number = monthToComparableNumber(date2);

        if (date1Number === null && date2Number === null) {
            return 0;
        }
        if (date1Number === null) {
            return -1;
        }
        if (date2Number === null) {
            return 1;
        }

        return date1Number - date2Number;
    }

    function monthToComparableNumber(date) {
        if (date === undefined || date === null || date.length !== 10) {
            return null;
        }

        var yearNumber = date.substring(6, 10);
        var monthNumber = date.substring(3, 5);
        var dayNumber = date.substring(0, 2);

        var result = yearNumber * 10000 + monthNumber * 100 + dayNumber;
        return result;
    }

    $scope.clearFilters = function () {
        gridOptions.columnApi.applyColumnState({
            defaultState: {
                sort: null,
            },
        });
        gridOptions.api.setFilterModel(null);
    }

    getRpt();

    function getRpt() {
        let post_data = {
            naf_user: userinfo
        };
        $scope.isloading = true;
        $http({
            method: 'post',
            url: api_url + "Variations/rpt.php",
            data: post_data
        }).then(
            function (res) {
                console.log(res.data);
                if (res.data.msg === "1") {
                    let gdata = [];
                    res.data.data.map(i => {
                        if (i.variation_status !== '2' && i.variation_status !== '5' && i.variation_status !== '3') {
                            gdata.push(i);
                        }
                    })


                    var gridDiv = document.querySelector('#myGrid');
                    new agGrid.Grid(gridDiv, gridOptions);

                    gridOptions.api.setRowData(gdata);
                    var allColumnIds = [];
                    gridOptions.columnApi.getAllColumns().forEach(function (column) {
                        allColumnIds.push(column.colId);
                    });

                    gridOptions.columnApi.autoSizeColumns(allColumnIds, false);

                } else {
                    alert(res.data.data);
                }
                $scope.isloading = false;
            }
        )
    }

    $scope.exportExcel = function () {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {

            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();
            var mname = `Variation's - Pendings AS ON DATE ${day}-${month}-${year}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }
    $scope.printResult_byProject = () => {
        let _data = [];    
        let _config = []
        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _data.push(_.data);
            _config.push(_);
        })     
        if (_data.length === 0) {
            alert("No data found");
            return;
        }
        if (_data.length > 4000) {
            alert("Out of memmory")
            return;
        }
        //console.log(_config[1]);
        let _bodywidth = _config[0].columnController.columnApi.columnController.columnApi.columnController.bodyWidth;
        let _columns = _config[0].columnController.columnApi.columnController.columnApi.columnController.autoRowHeightColumns;
       // console.log(_columns);
        let fconfig = [];
        _columns.map((i) => {
            let cconf = {
                colid: i.colId,
                colwidth: i.actualWidth,
                colshow: i.visible,
                colname: i.userProvidedColDef.headerName
            };
            fconfig.push(cconf);
        });
        localStorage.setItem("pms_variation_list", JSON.stringify(_data));
        localStorage.setItem("pms_variation_config", JSON.stringify(fconfig));
        localStorage.setItem("pms_variation_width", _bodywidth.toString());       
        localStorage.setItem("pms_variation_title", "Pending Variation Report");   
        const location = `${print_location}sprint/variationprint.html`;
        //console.log(location);
        window.open(location, '_blank', "width:1300,height:600"); 
    }
    $scope.printResult_byProjectx = () => {
        // let _i = [];
        // print_variations(_i);
        let _projects = [];
        let _data = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((i) => {
            let k = i.data.variation_project;
            if (!_projects.includes(k)) {
                _projects.push(i.data.variation_project);
            }

            _data.push(i.data);
        });

        // console.log(_projects);
        // console.log(_data);
        let xdata = [];
        _projects.map(i => {
            let pname = "";
            let pno = i;
            let arr = [];
            _data.map(j => {
                if (j.variation_project === i) {
                    pname = j.variation_project_name;
                    arr.push(j);
                }
            })
            xdata.push({ pname, pno, arr });
        })


        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth();
        var year = date.getFullYear();


        let _title = `PENDINGS VARIATION REPORTS AS ON DATE ${day}-${month}-${year}`;

        localStorage.clear("variationsrptprj");
        localStorage.clear("variationsrptprjtit");
        localStorage.clear("variationsrptprjtype");

        localStorage.setItem("variationsrptprj", JSON.stringify(xdata));
        localStorage.setItem("variationsrptprjtit", _title);
        localStorage.setItem("variationsrptprjtype", "pen");

        var loc = print_location + "print/print_variation_proj.html";
        window.open(loc, '_blank', width = '1300px', height = '800px');

    }
    $scope.printResult_bySalesMan = () => {
        // let _i = [];
        // print_variations(_i);
        let _saelsman = [];
        let _data = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((i) => {
            let s = i.data.salesman_code;
            if (!_saelsman.includes(s)) {
                _saelsman.push(s);
            }
            _data.push(i.data);
        });
        let xdata = [];
        _saelsman.map(i => {
            let scode = i;
            let sname = "";
            let arr = [];
            _data.map(j => {

                if (j.salesman_code === i) {
                    sname = j.salesman_name;
                    arr.push(j);
                }
            });
            xdata.push({ scode, sname, arr });
        });
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth();
        var year = date.getFullYear();

        let _title = `PENDINGS VARIATION REPORTS AS ON DATE ${day}-${month}-${year}`;

        localStorage.clear("variationsrptsales");
        localStorage.clear("variationsrptsalestit");
        localStorage.clear("variationsrptsalestype");

        localStorage.setItem("variationsrptsales", JSON.stringify(xdata));
        localStorage.setItem("variationsrptsalestit", _title);
        localStorage.setItem("variationsrptsalestype", "pen");

        var loc = print_location + "print/print_variation_sales.html";
        window.open(loc, '_blank', width = '1300px', height = '800px');

    }
}


app.controller('rpt_variations_approve', rpt_variations_approve);

function rpt_variations_approve($scope, $http) {
    document.title = "APPROVED / PAID VARIATION REPORT [ NAFCO - PMS ]";
    $scope._btn_print = access_variation_print;
    $scope._btn_excel = access_varation_export;
    document.getElementById("rpt_variation").classList.add('menuactive');
    var site = print_location;
    window.addEventListener('resize', () => {
        maxbodyheight()
    })
    maxbodyheight();

    function maxbodyheight() {
        var mbody = document.querySelector(".ism-bodys");
        var wsize = window.innerHeight;
        //console.log(wsize);
        var head_size = document.querySelector(".ism-headers").offsetHeight;
        //console.log(head_size);        
        var nav_size = document.querySelector(".ism-navi-itmes");
        nav_size.marginTop = head_size + "px"
        var foot_size = document.querySelector(".ism-footers").offsetHeight;
        var rmh = 120;
        var bh = wsize - 160;
        var bhbh = bh - 35 - 10 - 7;
        var bhbhbh = bh - 35 - 27;
        // var bhbhbh = bh - 45;

        //document.querySelector(".sub-body").style.marginTop = "75px";
        document.querySelector(".sub-body-container").style.height = bh + "px";
        document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container").style.maiHeight = bh + "px";
        //document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        // document.querySelector(".mainbodys_data").style.height = bhbh + "px";
        // document.querySelector(".mainbodys_data").style.maxHeight = bhbh + "px";
        // document.querySelector(".mainbodys_data").style.maiHeight = bhbh + "px";

        // document.querySelector(".loadingdiv").style.height = bhbh + "px";
        // document.querySelector(".loadingdiv").style.maxHeight = bhbh + "px";
        // document.querySelector(".loadingdiv").style.maiHeight = bhbh + "px";

        // document.querySelector(".naf-tables").style.height = bhbhbh + "px";
        // document.querySelector(".naf-tables").style.maxHeight = bhbhbh + "px";
        // document.querySelector(".naf-tables").style.maiHeight = bhbhbh + "px";


        //set size main container

        var docwith = window.innerWidth;
        var mbodyw = document.querySelector(".ism-bodys").offsetWidth;

        //document.querySelector(".inreportsbody").style.width = docwith - 300 - 30;
    }

    var filterParams = {
        comparator: function (filterLocalDateAtMidnight, cellValue) {
            var dateAsString = cellValue;
            var dateParts = dateAsString.split('-');
            var cellDate = new Date(
                Number(dateParts[0]),
                Number(dateParts[1]) - 1,
                Number(dateParts[2])
            );

            if (filterLocalDateAtMidnight.getTime() === cellDate.getTime()) {
                return 0;
            }

            if (cellDate < filterLocalDateAtMidnight) {
                return -1;
            }

            if (cellDate > filterLocalDateAtMidnight) {
                return 1;
            }
        },
    };
    var statuscheck = {
        'td-yellow': function (p) {
            return p.data.variation_status === '1'
        },
        'trgreen': function (p) {
            return p.data.variation_status === '2'
        },
        'trred txt-red': function (p) {
            return p.data.variation_status === '3'
        },
        'tryellow2': function (p) {
            return p.data.variation_status === '4'
        },
        'trgreen2': function (p) {
            return p.data.variation_status === '5'
        },
    }


    var columnDefs = [];
    console.log(access_variation_amount);
    columnDefs.push({
        headerName: 'Sl.No',
        field : "sno",
        //cellRenderer: 'node.rowIndex + 1',
        valueGetter: "node.rowIndex + 1",
        filter: false,
        sortable: false,
        suppressMenu: false,
        cellClassRules: statuscheck
    });
    columnDefs.push({
        headerName: 'Project NO',
        field: 'variation_project',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Name',
        field: 'variation_project_name',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    if (access_variation_amount || access_variation_pdf_access) {
        columnDefs.push({
            headerName: 'File',
            field : "pdfa",
            sortable: false,
            cellRenderer: function (p) {

                let _name = `${p.data.variation_project} # ${p.data.variation_refno} # ${p.data.variation_description}`;
                return `
            <a  href="${site}assets/variations/${p.data.variation_token}.pdf" download="${_name}">
                <img loading='lazy' src="${site}assets/pdfdownload.png?v=${v}" style="width:18px;">
            </a>
            `
            },
            filter: false,
            cellClassRules: statuscheck,
        });
    }
    columnDefs.push({
        headerName: 'Date',
        field: 'sdate',
        cellRenderer: function (p) {
            return `<div>${p.data.variation_date}</div>`
        },
        sortingOrder: ['asc', 'desc'],
        cellClass: 'dateType_green',
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        cellClassRules: statuscheck,
        sort: 'desc',
    });
    columnDefs.push({
        headerName: 'Subject',
        field: 'v_sub_name',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Ref No',
        field: 'variation_refno',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Revision No',
        field: 'revision_no',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    if (access_variation_amount) {
        columnDefs.push({
            headerName: 'Total Amount',
            field: 'variation_amount',
            filter: 'agNumberColumnFilter',
            sortingOrder: ['asc', 'desc'],
            cellClassRules: statuscheck,
            cellClass: 'money-filed',
            valueFormatter: currencyFormatter,

        });
    }
    columnDefs.push({
        headerName: 'Status',
        field: 'variation_statustext',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,

    });
    columnDefs.push({
        headerName: 'VO#NO',
        field: 'vno',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Date of Approve',
        field: 'approvedate',
        cellRenderer: function (p) {
            let rt = p.data.vno === '-' ? '-' : `<div>${p.data.approvedate_d}</div>`;
            return rt;
        },
        sortingOrder: ['asc', 'desc'],
        cellClass: 'dateType_green',
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        cellClassRules: statuscheck,
    });
    if (access_variation_amount || access_variation_pdf_access) {
        columnDefs.push({
            headerName: 'File',
            field : "pdfb",
            sortable: false,
            cellRenderer: function (p) {
                let _name = `${p.data.variation_project} # ${p.data.variation_refno} # ${p.data.variation_description} - Apporved / Paid`;
                return p.data.variation_status !== '1' ?
                    `
                <a  href="${site}assets/variation_status/${p.data.variation_token}.pdf"  download="${_name}">
                    <img loading='lazy' src="${site}assets/pdfdownload.png?v=${v}" style="width:18px;">
                </a>
                ` : ``
            },
            filter: false,
            cellClassRules: statuscheck,
        });
    }
    columnDefs.push({
        headerName: 'Atte',
        field: 'variation_atten',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Contractor/Client',
        field: 'variation_to',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,

    });
    columnDefs.push({
        headerName: 'Description',
        field: 'variation_description',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Region',
        field: 'region_name',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Sales Man',
        field: 'salesman_code',
        cellRenderer: function (p) {
            return `<div>${p.data.salesman_code} - ${p.data.salesman_name} </div>`
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });



    function currencyFormatter(params) {
        return formatNumber(params.value);
    }

    function formatNumber(number) {
        // this puts commas into the number eg 1000 goes to 1,000,
        // i pulled this from stack overflow, i have no idea how it works
        return Math.floor(number)
            .toString()
            .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
    var gridOptions = {
        suppressContextMenu: true,
        columnDefs: columnDefs,
        enableCellChangeFlash: true,
        defaultColDef: {
            autoHeight: true,
            sortable: true,
            filter: true,
            floatingFilter: true,
            wrapText: true,
            resizable: true,
        },
        suppressMenuHide: true,
        colResizeDefault: 'shift',
        excelStyles: [{
            id: 'dateType',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        },
        {
            id: 'dateTypes',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        },
        {
            id: 'dateType_green',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        }
        ],
        statusBar: {
            statusPanels: [{
                statusPanel: 'agFilteredRowCountComponent',
                align: 'left'
            },
            {
                statusPanel: 'agTotalAndFilteredRowCountComponent',
                align: 'left'
            },
            ],
        },
    };

    function dateComparator(date1, date2) {
        var date1Number = monthToComparableNumber(date1);
        var date2Number = monthToComparableNumber(date2);

        if (date1Number === null && date2Number === null) {
            return 0;
        }
        if (date1Number === null) {
            return -1;
        }
        if (date2Number === null) {
            return 1;
        }

        return date1Number - date2Number;
    }

    function monthToComparableNumber(date) {
        if (date === undefined || date === null || date.length !== 10) {
            return null;
        }

        var yearNumber = date.substring(6, 10);
        var monthNumber = date.substring(3, 5);
        var dayNumber = date.substring(0, 2);

        var result = yearNumber * 10000 + monthNumber * 100 + dayNumber;
        return result;
    }

    $scope.clearFilters = function () {
        gridOptions.columnApi.applyColumnState({
            defaultState: {
                sort: null,
            },
        });
        gridOptions.api.setFilterModel(null);
    }

    getRpt();

    function getRpt() {
        let post_data = {
            naf_user: userinfo
        };
        $scope.isloading = true;
        $http({
            method: 'post',
            url: api_url + "Variations/rpt.php",
            data: post_data
        }).then(
            function (res) {
                console.log(res.data);
                if (res.data.msg === "1") {
                    let gdata = [];
                    res.data.data.map(i => {
                        if (i.variation_status === '2' || i.variation_status === '5') {
                            gdata.push(i);
                        }
                    })


                    var gridDiv = document.querySelector('#myGrid');
                    new agGrid.Grid(gridDiv, gridOptions);

                    gridOptions.api.setRowData(gdata);
                    var allColumnIds = [];
                    gridOptions.columnApi.getAllColumns().forEach(function (column) {
                        allColumnIds.push(column.colId);
                    });

                    gridOptions.columnApi.autoSizeColumns(allColumnIds, false);

                } else {
                    alert(res.data.data);
                }
                $scope.isloading = false;
            }
        )
    }

    $scope.exportExcel = function () {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {

            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();
            var mname = `Variation's - Apporved / Paid AS ON DATE ${day}-${month}-${year}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }
    $scope.printResult_byProject = () => {
        let _data = [];    
        let _config = []
        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _data.push(_.data);
            _config.push(_);
        })     
        if (_data.length === 0) {
            alert("No data found");
            return;
        }
        if (_data.length > 4000) {
            alert("Out of memmory")
            return;
        }
        //console.log(_config[1]);
        let _bodywidth = _config[0].columnController.columnApi.columnController.columnApi.columnController.bodyWidth;
        let _columns = _config[0].columnController.columnApi.columnController.columnApi.columnController.autoRowHeightColumns;
       // console.log(_columns);
        let fconfig = [];
        _columns.map((i) => {
            let cconf = {
                colid: i.colId,
                colwidth: i.actualWidth,
                colshow: i.visible,
                colname: i.userProvidedColDef.headerName
            };
            fconfig.push(cconf);
        });
        localStorage.setItem("pms_variation_list", JSON.stringify(_data));
        localStorage.setItem("pms_variation_config", JSON.stringify(fconfig));
        localStorage.setItem("pms_variation_width", _bodywidth.toString());       
        localStorage.setItem("pms_variation_title", "Apporved / Paid Variations Report");   
        const location = `${print_location}sprint/variationprint.html`;
        //console.log(location);
        window.open(location, '_blank', "width:1300,height:600"); 
    }
    $scope.printResult_byProjectx = () => {
        // let _i = [];
        // print_variations(_i);
        let _projects = [];
        let _data = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((i) => {
            let k = i.data.variation_project;
            if (!_projects.includes(k)) {
                _projects.push(i.data.variation_project);
            }

            _data.push(i.data);
        });

        // console.log(_projects);
        // console.log(_data);
        let xdata = [];
        _projects.map(i => {
            let pname = "";
            let pno = i;
            let arr = [];
            _data.map(j => {
                if (j.variation_project === i) {
                    pname = j.variation_project_name;
                    arr.push(j);
                }
            })
            xdata.push({ pname, pno, arr });
        })


        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth();
        var year = date.getFullYear();


        let _title = `APPROVED / PAID VARIATION REPORTS AS ON DATE ${day}-${month}-${year}`;

        localStorage.clear("variationsrptprj");
        localStorage.clear("variationsrptprjtit");
        localStorage.clear("variationsrptprjtype");

        localStorage.setItem("variationsrptprj", JSON.stringify(xdata));
        localStorage.setItem("variationsrptprjtit", _title);
        localStorage.setItem("variationsrptprjtype", "aprove");

        var loc = print_location + "print/print_variation_proj_approve.html";
        window.open(loc, '_blank', width = '1300px', height = '800px');

    }
    $scope.printResult_bySalesMan = () => {
        // let _i = [];
        // print_variations(_i);
        let _saelsman = [];
        let _data = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((i) => {
            let s = i.data.salesman_code;
            if (!_saelsman.includes(s)) {
                _saelsman.push(s);
            }
            _data.push(i.data);
        });
        let xdata = [];
        _saelsman.map(i => {
            let scode = i;
            let sname = "";
            let arr = [];
            _data.map(j => {

                if (j.salesman_code === i) {
                    sname = j.salesman_name;
                    arr.push(j);
                }
            });
            xdata.push({ scode, sname, arr });
        });
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth();
        var year = date.getFullYear();

        let _title = `APPROVED / PAID VARIATION REPORTS AS ON DATE ${day}-${month}-${year}`;

        localStorage.clear("variationsrptsales");
        localStorage.clear("variationsrptsalestit");
        localStorage.clear("variationsrptsalestype");

        localStorage.setItem("variationsrptsales", JSON.stringify(xdata));
        localStorage.setItem("variationsrptsalestit", _title);
        localStorage.setItem("variationsrptsalestype", "aprove");

        var loc = print_location + "print/print_variation_sales_approve.html";
        window.open(loc, '_blank', width = '1300px', height = '800px');

    }
}


app.controller('rpt_variations_cancel', rpt_variations_cancel);
function rpt_variations_cancel($scope, $http) {
    document.title = "CANCELLED VARIATION REPORT [ NAFCO - PMS ]";
    $scope._btn_print = access_variation_print;
    $scope._btn_excel = access_varation_export;
    document.getElementById("rpt_variation").classList.add('menuactive');
    var site = print_location;
    window.addEventListener('resize', () => {
        maxbodyheight()
    })
    maxbodyheight();

    function maxbodyheight() {
        var mbody = document.querySelector(".ism-bodys");
        var wsize = window.innerHeight;
        //console.log(wsize);
        var head_size = document.querySelector(".ism-headers").offsetHeight;
        //console.log(head_size);        
        var nav_size = document.querySelector(".ism-navi-itmes");
        nav_size.marginTop = head_size + "px"
        var foot_size = document.querySelector(".ism-footers").offsetHeight;
        var rmh = 120;
        var bh = wsize - 160;
        var bhbh = bh - 35 - 10 - 7;
        var bhbhbh = bh - 35 - 27;
        // var bhbhbh = bh - 45;

        //document.querySelector(".sub-body").style.marginTop = "75px";
        document.querySelector(".sub-body-container").style.height = bh + "px";
        document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container").style.maiHeight = bh + "px";
        //document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        // document.querySelector(".mainbodys_data").style.height = bhbh + "px";
        // document.querySelector(".mainbodys_data").style.maxHeight = bhbh + "px";
        // document.querySelector(".mainbodys_data").style.maiHeight = bhbh + "px";

        // document.querySelector(".loadingdiv").style.height = bhbh + "px";
        // document.querySelector(".loadingdiv").style.maxHeight = bhbh + "px";
        // document.querySelector(".loadingdiv").style.maiHeight = bhbh + "px";

        // document.querySelector(".naf-tables").style.height = bhbhbh + "px";
        // document.querySelector(".naf-tables").style.maxHeight = bhbhbh + "px";
        // document.querySelector(".naf-tables").style.maiHeight = bhbhbh + "px";


        //set size main container

        var docwith = window.innerWidth;
        var mbodyw = document.querySelector(".ism-bodys").offsetWidth;

        //document.querySelector(".inreportsbody").style.width = docwith - 300 - 30;
    }

    var filterParams = {
        comparator: function (filterLocalDateAtMidnight, cellValue) {
            var dateAsString = cellValue;
            var dateParts = dateAsString.split('-');
            var cellDate = new Date(
                Number(dateParts[0]),
                Number(dateParts[1]) - 1,
                Number(dateParts[2])
            );

            if (filterLocalDateAtMidnight.getTime() === cellDate.getTime()) {
                return 0;
            }

            if (cellDate < filterLocalDateAtMidnight) {
                return -1;
            }

            if (cellDate > filterLocalDateAtMidnight) {
                return 1;
            }
        },
    };
    var statuscheck = {
        'td-yellow': function (p) {
            return p.data.variation_status === '1'
        },
        'trgreen': function (p) {
            return p.data.variation_status === '2'
        },
        'trred txt-red': function (p) {
            return p.data.variation_status === '3'
        },
        'tryellow2': function (p) {
            return p.data.variation_status === '4'
        },
        'trgreen2': function (p) {
            return p.data.variation_status === '5'
        },
    }


    var columnDefs = [];
    console.log(access_variation_amount);
   
    columnDefs.push({
        headerName: 'Sl.No',
        field : "sno",
        //cellRenderer: 'node.rowIndex + 1',
        valueGetter: "node.rowIndex + 1",
        filter: false,
        sortable: false,
        suppressMenu: false,
        cellClassRules: statuscheck
    });
    columnDefs.push({
        headerName: 'Project NO',
        field: 'variation_project',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Name',
        field: 'variation_project_name',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    if (access_variation_amount || access_variation_pdf_access) {
    
        columnDefs.push({
            headerName: 'File',
            sortable: false,
            field : "pdfa",
            cellRenderer: function (p) {
                let _name = `${p.data.variation_project} # ${p.data.variation_refno} # ${p.data.variation_description}`;
                return `
                <a  href="${site}assets/variations/${p.data.variation_token}.pdf" download="${_name}">
                    <img loading='lazy' src="${site}assets/pdfdownload.png?v=${v}" style="width:18px;">
                </a>
                `
            },
            filter: false,
            cellClassRules: statuscheck,
            width: 60
        });
    }
    columnDefs.push({
        headerName: 'Date',
        field: 'sdate',
        cellRenderer: function (p) {
            return `<div>${p.data.variation_date}</div>`
        },
        sortingOrder: ['asc', 'desc'],
        cellClass: 'dateType_green',
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        cellClassRules: statuscheck,
        sort: 'desc',
    });
    columnDefs.push({
        headerName: 'Subject',
        field: 'v_sub_name',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Ref No',
        field: 'variation_refno',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,

    });
    columnDefs.push({
        headerName: 'Revision No',
        field: 'revision_no',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
        width: 60
    });
    if (access_variation_amount ) {
    
        columnDefs.push({
            headerName: 'Total Amount',
            field: 'variation_amount',
            filter: 'agNumberColumnFilter',
            sortingOrder: ['asc', 'desc'],
            cellClassRules: statuscheck,
            cellClass: 'money-filed',
            valueFormatter: currencyFormatter,

        });
    }
    columnDefs.push({
        headerName: 'Status',
        field: 'variation_statustext',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Cancelled By',
        field: 'cancelby',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Cancelled Date',
        field: 'caceldate',
        cellRenderer: function (p) {
            let k = p.data.cancelby === '-' ? '-' : `<div>${p.data.caceldate_d}</div>`;
            return k;
        },
        sortingOrder: ['asc', 'desc'],
        cellClass: 'dateType_green',
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        cellClassRules: statuscheck,
    });
    if (access_variation_amount || access_variation_pdf_access) {
    
        columnDefs.push({
            headerName: 'File',
            sortable: false,
            field : "pdfb",
            cellRenderer: function (p) {
                let _name = `${p.data.variation_project} # ${p.data.variation_refno} # ${p.data.variation_description} - Cancelled`;
                return p.data.variation_status !== '1' ?
                    `
            <a  href="${site}assets/variation_status/${p.data.variation_token}.pdf"  download="${_name}">
                <img loading='lazy' src="${site}assets/pdfdownload.png?v=${v}" style="width:18px;">
            </a>
            ` : ``
            },
            filter: false,
            cellClassRules: statuscheck,
            width: 60
        });
    }
    columnDefs.push({
        headerName: 'Atte',
        field: 'variation_atten',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Contractor/Client',
        field: 'variation_to',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Description',
        field: 'variation_description',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Region',
        field: 'region_name',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Sales Man',
        field: 'salesman_code',
        cellRenderer: function (p) {
            return `<div>${p.data.salesman_code} - ${p.data.salesman_name} </div>`
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
   
   

    function currencyFormatter(params) {
        return formatNumber(params.value);
    }

    function formatNumber(number) {
        // this puts commas into the number eg 1000 goes to 1,000,
        // i pulled this from stack overflow, i have no idea how it works
        return Math.floor(number)
            .toString()
            .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
    var gridOptions = {
        suppressContextMenu: true,
        columnDefs: columnDefs,
        enableCellChangeFlash: true,
        defaultColDef: {
            autoHeight: true,
            sortable: true,
            filter: true,
            floatingFilter: true,
            wrapText: true,
            resizable: true,
        },
        suppressMenuHide: true,
        colResizeDefault: 'shift',
        excelStyles: [{
            id: 'dateType',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        },
        {
            id: 'dateTypes',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        },
        {
            id: 'dateType_green',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        }
        ],
        statusBar: {
            statusPanels: [{
                statusPanel: 'agFilteredRowCountComponent',
                align: 'left'
            },
            {
                statusPanel: 'agTotalAndFilteredRowCountComponent',
                align: 'left'
            },
            ],
        },
    };

    function dateComparator(date1, date2) {
        var date1Number = monthToComparableNumber(date1);
        var date2Number = monthToComparableNumber(date2);

        if (date1Number === null && date2Number === null) {
            return 0;
        }
        if (date1Number === null) {
            return -1;
        }
        if (date2Number === null) {
            return 1;
        }

        return date1Number - date2Number;
    }

    function monthToComparableNumber(date) {
        if (date === undefined || date === null || date.length !== 10) {
            return null;
        }

        var yearNumber = date.substring(6, 10);
        var monthNumber = date.substring(3, 5);
        var dayNumber = date.substring(0, 2);

        var result = yearNumber * 10000 + monthNumber * 100 + dayNumber;
        return result;
    }

    $scope.clearFilters = function () {
        gridOptions.columnApi.applyColumnState({
            defaultState: {
                sort: null,
            },
        });
        gridOptions.api.setFilterModel(null);
    }

    getRpt();

    function getRpt() {
        let post_data = {
            naf_user: userinfo
        };
        $scope.isloading = true;
        $http({
            method: 'post',
            url: api_url + "Variations/rpt.php",
            data: post_data
        }).then(
            function (res) {
                console.log(res.data);
                if (res.data.msg === "1") {
                    let gdata = [];
                    res.data.data.map(i => {
                        if (i.variation_status === '3') {
                            gdata.push(i);
                        }
                    })


                    var gridDiv = document.querySelector('#myGrid');
                    new agGrid.Grid(gridDiv, gridOptions);

                    gridOptions.api.setRowData(gdata);
                    var allColumnIds = [];
                    gridOptions.columnApi.getAllColumns().forEach(function (column) {
                        allColumnIds.push(column.colId);
                    });

                    gridOptions.columnApi.autoSizeColumns(allColumnIds, false);

                } else {
                    alert(res.data.data);
                }
                $scope.isloading = false;
            }
        )
    }

    $scope.exportExcel = function () {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {

            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();

            var mname = `Variation's - Cancelled AS ON DATE ${day}-${month}-${year}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }


    $scope.printResult_byProject = () => {
        let _data = [];    
        let _config = []
        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _data.push(_.data);
            _config.push(_);
        })     
        if (_data.length === 0) {
            alert("No data found");
            return;
        }
        if (_data.length > 4000) {
            alert("Out of memmory")
            return;
        }
        //console.log(_config[1]);
        let _bodywidth = _config[0].columnController.columnApi.columnController.columnApi.columnController.bodyWidth;
        let _columns = _config[0].columnController.columnApi.columnController.columnApi.columnController.autoRowHeightColumns;
       // console.log(_columns);
        let fconfig = [];
        _columns.map((i) => {
            let cconf = {
                colid: i.colId,
                colwidth: i.actualWidth,
                colshow: i.visible,
                colname: i.userProvidedColDef.headerName
            };
            fconfig.push(cconf);
        });
        localStorage.setItem("pms_variation_list", JSON.stringify(_data));
        localStorage.setItem("pms_variation_config", JSON.stringify(fconfig));
        localStorage.setItem("pms_variation_width", _bodywidth.toString());       
        localStorage.setItem("pms_variation_title", "Cancelled Variation Report");   
        const location = `${print_location}sprint/variationprint.html`;
        //console.log(location);
        window.open(location, '_blank', "width:1300,height:600"); 
    }

    $scope.printResult_byProjectx = () => {
        // let _i = [];
        // print_variations(_i);
        let _projects = [];
        let _data = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((i) => {
            let k = i.data.variation_project;
            if (!_projects.includes(k)) {
                _projects.push(i.data.variation_project);
            }
            _data.push(i.data);
        });

        // console.log(_projects);
        // console.log(_data);
        let xdata = [];
        _projects.map(i => {
            let pname = "";
            let pno = i;
            let arr = [];
            _data.map(j => {
                if (j.variation_project === i) {
                    pname = j.variation_project_name;
                    arr.push(j);
                }
            })
            xdata.push({ pname, pno, arr });
        })


        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth();
        var year = date.getFullYear();


        let _title = `CANCELLED VARIATION REPORTS AS ON DATE ${day}-${month}-${year}`;

        localStorage.clear("variationsrptprj");
        localStorage.clear("variationsrptprjtit");
        localStorage.clear("variationsrptprjtype");

        localStorage.setItem("variationsrptprj", JSON.stringify(xdata));
        localStorage.setItem("variationsrptprjtit", _title);
        localStorage.setItem("variationsrptprjtype", "canc");

        var loc = print_location + "print/print_variation_proj_cancel.html";
        window.open(loc, '_blank', width = '1300px', height = '800px');

    }

    $scope.printResult_bySalesMan = () => {
        // let _i = [];
        // print_variations(_i);
        let _saelsman = [];
        let _data = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((i) => {
            let s = i.data.salesman_code;
            if (!_saelsman.includes(s)) {
                _saelsman.push(s);
            }
            _data.push(i.data);
        });
        let xdata = [];
        _saelsman.map(i => {
            let scode = i;
            let sname = "";
            let arr = [];
            _data.map(j => {
                if (j.salesman_code === i) {
                    sname = j.salesman_name;
                    arr.push(j);
                }
            });
            xdata.push({ scode, sname, arr });
        });
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth();
        var year = date.getFullYear();

        let _title = `CANCELLED VARIATION REPORTS AS ON DATE ${day}-${month}-${year}`;

        localStorage.clear("variationsrptsales");
        localStorage.clear("variationsrptsalestit");
        localStorage.clear("variationsrptsalestype");

        localStorage.setItem("variationsrptsales", JSON.stringify(xdata));
        localStorage.setItem("variationsrptsalestit", _title);
        localStorage.setItem("variationsrptsalestype", "Cancelled Variation Report");
        var loc = print_location + "print/print_variation_sales_cancel.html";
        window.open(loc, '_blank', width = '1300px', height = '800px');

    }
}




app.controller('rpt_variations_all', rpt_variations_all);
function rpt_variations_all($scope, $http) {
    document.title = "VARIATION REPORT [ NAFCO - PMS ]";
    $scope._btn_print = access_variation_print;
    $scope._btn_excel = access_varation_export;
    document.getElementById("rpt_variation").classList.add('menuactive');
    var site = print_location;
    window.addEventListener('resize', () => {
        maxbodyheight()
    })
    maxbodyheight();

    function maxbodyheight() {
        var mbody = document.querySelector(".ism-bodys");
        var wsize = window.innerHeight;
        //console.log(wsize);
        var head_size = document.querySelector(".ism-headers").offsetHeight;
        //console.log(head_size);        
        var nav_size = document.querySelector(".ism-navi-itmes");
        nav_size.marginTop = head_size + "px"
        var foot_size = document.querySelector(".ism-footers").offsetHeight;
        var rmh = 120;
        var bh = wsize - 160;
        var bhbh = bh - 35 - 10 - 7;
        var bhbhbh = bh - 35 - 27;
        // var bhbhbh = bh - 45;

        //document.querySelector(".sub-body").style.marginTop = "75px";
        document.querySelector(".sub-body-container").style.height = bh + "px";
        document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container").style.maiHeight = bh + "px";
        //document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        // document.querySelector(".mainbodys_data").style.height = bhbh + "px";
        // document.querySelector(".mainbodys_data").style.maxHeight = bhbh + "px";
        // document.querySelector(".mainbodys_data").style.maiHeight = bhbh + "px";

        // document.querySelector(".loadingdiv").style.height = bhbh + "px";
        // document.querySelector(".loadingdiv").style.maxHeight = bhbh + "px";
        // document.querySelector(".loadingdiv").style.maiHeight = bhbh + "px";

        // document.querySelector(".naf-tables").style.height = bhbhbh + "px";
        // document.querySelector(".naf-tables").style.maxHeight = bhbhbh + "px";
        // document.querySelector(".naf-tables").style.maiHeight = bhbhbh + "px";


        //set size main container

        var docwith = window.innerWidth;
        var mbodyw = document.querySelector(".ism-bodys").offsetWidth;

        //document.querySelector(".inreportsbody").style.width = docwith - 300 - 30;
    }

    var filterParams = {
        comparator: function (filterLocalDateAtMidnight, cellValue) {
            var dateAsString = cellValue;
            var dateParts = dateAsString.split('-');
            var cellDate = new Date(
                Number(dateParts[0]),
                Number(dateParts[1]) - 1,
                Number(dateParts[2])
            );

            if (filterLocalDateAtMidnight.getTime() === cellDate.getTime()) {
                return 0;
            }

            if (cellDate < filterLocalDateAtMidnight) {
                return -1;
            }

            if (cellDate > filterLocalDateAtMidnight) {
                return 1;
            }
        },
    };
    var statuscheck = {
        'td-yellow': function (p) {
            return p.data.variation_status === '1'
        },
        'trgreen': function (p) {
            return p.data.variation_status === '2'
        },
        'trred txt-red': function (p) {
            return p.data.variation_status === '3'
        },
        'tryellow2': function (p) {
            return p.data.variation_status === '4'
        },
        'trgreen2': function (p) {
            return p.data.variation_status === '5'
        },
    }


    var columnDefs = [];
   
    columnDefs.push({
        headerName: 'Sl.No',
        field : "sno",
            //cellRenderer: 'node.rowIndex + 1',
            valueGetter: "node.rowIndex + 1",
            filter: false,
            sortable: false,
            suppressMenu: false,
            cellClassRules: statuscheck
    });
    columnDefs.push({
        headerName: 'Project NO',
        field: 'variation_project',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Name',
        field: 'variation_project_name',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    if (access_variation_amount || access_variation_pdf_access) {
    
        columnDefs.push({
            headerName: 'File',
            sortable: false,
            field : "pdfa",
            cellRenderer: function (p) {
                let _name = `${p.data.variation_project} # ${p.data.variation_refno} # ${p.data.variation_description}`;
                return `
            <a  href="${site}assets/variations/${p.data.variation_token}.pdf" download="${_name}">
                <img loading='lazy' src="${site}assets/pdfdownload.png?v=${v}" style="width:18px;">
            </a>
            `
            },
            filter: false,
            cellClassRules: statuscheck,
        });
    }
    columnDefs.push({
        headerName: 'Date',
        field: 'sdate',
        cellRenderer: function (p) {
            return `<div>${p.data.variation_date}</div>`
        },
        sortingOrder: ['asc', 'desc'],
        cellClass: 'dateType_green',
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        cellClassRules: statuscheck,
        sort: 'desc',
    });
    columnDefs.push({
        headerName: 'Subject',
            field: 'v_sub_name',
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
            cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Ref No',
            field: 'variation_refno',
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
            cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Revision No',
        field: 'revision_no',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,

    });
    if (access_variation_amount) {
    
        columnDefs.push({
            headerName: 'Total Amount',
            field: 'variation_amount',
            filter: 'agNumberColumnFilter',
            sortingOrder: ['asc', 'desc'],
            cellClassRules: statuscheck,
            cellClass: 'money-filed',
            valueFormatter: currencyFormatter,
        });
    }
    columnDefs.push({
        headerName: 'Status',
            field: 'variation_statustext',
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
            cellClassRules: statuscheck,
    });
    if (access_variation_amount || access_variation_pdf_access) {
    
        columnDefs.push({
            headerName: 'File',
            field : "pdfb",
            sortable: false,
            cellRenderer: function (p) {
                let _name = `${p.data.variation_project} # ${p.data.variation_refno} # ${p.data.variation_description}`;
                return p.data.variation_status !== '1' ?
                    `
            <a  href="${site}assets/variation_status/${p.data.variation_token}.pdf"  download="${_name}">
                <img loading='lazy' src="${site}assets/pdfdownload.png?v=${v}" style="width:18px;">
            </a>
            ` : ``
            },
            filter: false,
            cellClassRules: statuscheck,
        });
    }
    columnDefs.push({
        headerName: 'Atte',
        field: 'variation_atten',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Contractor/Client',
        field: 'variation_to',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Description',
        field: 'variation_description',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Region',
        field: 'region_name',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });
    columnDefs.push({
        headerName: 'Sales Man',
        field: 'salesman_code',
        cellRenderer: function (p) {
            return `<div>${p.data.salesman_code} - ${p.data.salesman_name} </div>`
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
    });

    function currencyFormatter(params) {
        return formatNumber(params.value);
    }

    function formatNumber(number) {
        // this puts commas into the number eg 1000 goes to 1,000,
        // i pulled this from stack overflow, i have no idea how it works
        return Math.floor(number)
            .toString()
            .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
    var gridOptions = {
        suppressContextMenu: true,
        columnDefs: columnDefs,
        enableCellChangeFlash: true,
        defaultColDef: {
            autoHeight: true,
            sortable: true,
            filter: true,
            floatingFilter: true,
            wrapText: true,
            resizable: true,
        },
        suppressMenuHide: true,
        colResizeDefault: 'shift',
        excelStyles: [{
            id: 'dateType',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        },
        {
            id: 'dateTypes',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        },
        {
            id: 'dateType_green',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        }
        ],
        statusBar: {
            statusPanels: [{
                statusPanel: 'agFilteredRowCountComponent',
                align: 'left'
            },
            {
                statusPanel: 'agTotalAndFilteredRowCountComponent',
                align: 'left'
            },
            ],
        },
    };

    function dateComparator(date1, date2) {
        var date1Number = monthToComparableNumber(date1);
        var date2Number = monthToComparableNumber(date2);

        if (date1Number === null && date2Number === null) {
            return 0;
        }
        if (date1Number === null) {
            return -1;
        }
        if (date2Number === null) {
            return 1;
        }

        return date1Number - date2Number;
    }

    function monthToComparableNumber(date) {
        if (date === undefined || date === null || date.length !== 10) {
            return null;
        }

        var yearNumber = date.substring(6, 10);
        var monthNumber = date.substring(3, 5);
        var dayNumber = date.substring(0, 2);

        var result = yearNumber * 10000 + monthNumber * 100 + dayNumber;
        return result;
    }

    $scope.clearFilters = function () {
        gridOptions.columnApi.applyColumnState({
            defaultState: {
                sort: null,
            },
        });
        gridOptions.api.setFilterModel(null);
    }

    getRpt();

    function getRpt() {
        let post_data = {
            naf_user: userinfo
        };
        $scope.isloading = true;
        $http({
            method: 'post',
            url: api_url + "Variations/rpt.php",
            data: post_data
        }).then(
            function (res) {
                console.log(res.data);
                if (res.data.msg === "1") {
                    let gdata = [];
                    res.data.data.map(i => {
                        gdata.push(i);
                    })


                    var gridDiv = document.querySelector('#myGrid');
                    new agGrid.Grid(gridDiv, gridOptions);

                    gridOptions.api.setRowData(gdata);
                    var allColumnIds = [];
                    gridOptions.columnApi.getAllColumns().forEach(function (column) {
                        allColumnIds.push(column.colId);
                    });

                    gridOptions.columnApi.autoSizeColumns(allColumnIds, false);

                } else {
                    alert(res.data.data);
                }
                $scope.isloading = false;
            }
        )
    }

    $scope.exportExcel = function () {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {

            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();

            var mname = `VARIATION - REPORTS AS ON DATE ${day}-${month}-${year}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }

    $scope.printResult_byProject = () => {
        let _data = [];    
        let _config = []
        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _data.push(_.data);
            _config.push(_);
        })     
        if (_data.length === 0) {
            alert("No data found");
            return;
        }
        if (_data.length > 4000) {
            alert("Out of memmory")
            return;
        }
        //console.log(_config[1]);
        let _bodywidth = _config[0].columnController.columnApi.columnController.columnApi.columnController.bodyWidth;
        let _columns = _config[0].columnController.columnApi.columnController.columnApi.columnController.autoRowHeightColumns;
       // console.log(_columns);
        let fconfig = [];
        _columns.map((i) => {
            let cconf = {
                colid: i.colId,
                colwidth: i.actualWidth,
                colshow: i.visible,
                colname: i.userProvidedColDef.headerName
            };
            fconfig.push(cconf);
        });
        localStorage.setItem("pms_variation_list", JSON.stringify(_data));
        localStorage.setItem("pms_variation_config", JSON.stringify(fconfig));
        localStorage.setItem("pms_variation_width", _bodywidth.toString());       
        localStorage.setItem("pms_variation_title", "All Variation Report");   
        const location = `${print_location}sprint/variationprint.html`;
        //console.log(location);
        window.open(location, '_blank', "width:1300,height:600"); 
    }

    $scope.printResult_byProjectx = () => {
        // let _i = [];
        // print_variations(_i);
        let _projects = [];
        let _data = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((i) => {
            let k = i.data.variation_project;
            if (!_projects.includes(k)) {
                _projects.push(i.data.variation_project);
            }

            _data.push(i.data);
        });

        // console.log(_projects);
        // console.log(_data);
        let xdata = [];
        _projects.map(i => {
            let pname = "";
            let pno = i;
            let arr = [];
            _data.map(j => {
                if (j.variation_project === i) {
                    pname = j.variation_project_name;
                    arr.push(j);
                }
            })
            xdata.push({ pname, pno, arr });
        })


        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth();
        var year = date.getFullYear();


        let _title = `ALL VARIATION REPORTS AS ON DATE ${day}-${month}-${year}`;

        localStorage.clear("variationsrptprj");
        localStorage.clear("variationsrptprjtit");
        localStorage.clear("variationsrptprjtype");

        localStorage.setItem("variationsrptprj", JSON.stringify(xdata));
        localStorage.setItem("variationsrptprjtit", _title);
        localStorage.setItem("variationsrptprjtype", "canc");

        var loc = print_location + "print/print_variation_proj_all.html";
        window.open(loc, '_blank', width = '1300px', height = '800px');

    }
    $scope.printResult_bySalesMan = () => {
        // let _i = [];
        // print_variations(_i);
        let _saelsman = [];
        let _data = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((i) => {
            let s = i.data.salesman_code;
            if (!_saelsman.includes(s)) {
                _saelsman.push(s);
            }
            _data.push(i.data);
        });
        let xdata = [];
        _saelsman.map(i => {
            let scode = i;
            let sname = "";
            let arr = [];
            _data.map(j => {

                if (j.salesman_code === i) {
                    sname = j.salesman_name;
                    arr.push(j);
                }
            });
            xdata.push({ scode, sname, arr });
        });
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth();
        var year = date.getFullYear();

        let _title = `VARIATION REPORTS AS ON DATE ${day}-${month}-${year}`;

        localStorage.clear("variationsrptsales");
        localStorage.clear("variationsrptsalestit");
        localStorage.clear("variationsrptsalestype");

        localStorage.setItem("variationsrptsales", JSON.stringify(xdata));
        localStorage.setItem("variationsrptsalestit", _title);
        localStorage.setItem("variationsrptsalestype", "canc");

        var loc = print_location + "print/print_variation_sales_all.html";
        window.open(loc, '_blank', width = '1300px', height = '800px');

    }
}






function print_variations(data) {
    console.log(data);
}