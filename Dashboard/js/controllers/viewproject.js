import cuttinglistservices from "../../Main/cuttinglist/js/services/index.js";
app.controller('viewproject', function ($scope, $http) {
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
            // console.log("owk")
            bc_home.style.display = "block";
        } else {
            //console.log("error");
            bc_home.style.display = "none";
        }
    })
    document.getElementById("contract_menu").classList.add('menuactive');
    let project_id;
    let pro_no;
    $("#back_btn").on('click', function() {
        window.history.back();
    })
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
                console.log(res.data.data);
                $scope.viewproject = res.data.data;
                $scope.newproject = res.data.data;
                document.title = `${res.data.data.project_name} [${res.data.data.project_no}] - PMS`;
                pro_no = angular.lowercase(res.data.data.project_no);
                getconditions(angular.lowercase(res.data.data.project_no));
                getterms();
                get_project_specification();
            } else {
                alert(res.data.data);
            }
        });
    }





    $scope.updateprojectinfo = function() {

        var _svdata = {
            naf_user: userinfo,
            _frmdata: $scope.newproject
        };
        var req = $http.post(api_url + "Project/update.php", _svdata);
        req.then(function(res) {
            console.log(res.data);
            ''
            if (res.data.msg === "1") {
                alert("Updated");
            } else {
                alert(res.data.data);
            }
        })
    }
    $scope.upload_pdf_dialog = function($project_no) {
        document.getElementById('new_contract_pdf').style.display = 'block';
    }

    $("#save_contract_pdf").submit(function(e) {
        e.preventDefault();
        var fd = new FormData(this);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        $.ajax({
            url: api_url + "Project/upload_summarypdf.php",
            data: fd,
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res.msg === "1") {
                    alert("saved");
                    get_all_approvals();
                    location.reload();
                } else {
                    alert(res.data);
                }
            }

        })
    })

    function getconditions(project_id) {
        let post_data = {
            naf_user: userinfo,
            project_no: project_id
        }
        var req = $http.post(api_url + "Project/conditions.php", post_data);
        req.then(
            function(res) {
                console.log(res.data);
                $scope._conditions = res.data.data;
            }
        );
    }

    $scope.condition_remove = function(rno) {
        var d = confirm("Are you Sure Delete this Condition?");
        if (d === true) {
            let post_data = {
                naf_user: userinfo,
                projectname: pro_no,
                condition_id: rno
            };
            // console.log(post_data);
            $http.post(api_url + "Project/condition_remove.php", post_data)
                .then(
                    function(res) {
                        console.log(res.data);
                        if (res.data.msg === "1") {
                            alert("Removed...");
                            getconditions(pro_no);
                        } else {
                            alert(res.data.data);
                        }
                    }
                );
        } else {

        }
    }



    $scope.new_conditions_add = function() {
        var post_data = {
            naf_user: userinfo,
            projectname: pro_no,
            condition_add_new: $("#conditions_add_new").val(),
            conditions_add_new_number: $("#conditions_add_new_number").val()

        };
        //console.log(post_data);
        $http.post(api_url + "Project/condition_add.php", post_data)
            .then(
                function(res) {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert("Saved....")
                        getconditions(pro_no);
                        $("#conditions_add_new").val('');
                        $("#conditions_add_new_number").val('');
                    } else {
                        alert(res.data.data);
                    }
                }
            );
    }

    $scope.edit_conditions = (confs) => {
        document.getElementById("myModal_con_edit").style.display = "block";
        $scope.editinfoscon = confs;
    }
    $scope.new_conditions_edit = function() {
        var post_data = {
            naf_user: userinfo,
            project_conditions_id: $("#project_conditions_id").val(),
            condition_add_edit: $("#conditions_add_edit").val(),
            conditions_add_edit_number: $("#conditions_add_edit_number").val()

        };
        //console.log(post_data);
        $http.post(api_url + "Project/conditions_edit.php", post_data)
            .then(
                function(res) {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert("updated....")
                        getconditions(pro_no);
                    } else {
                        alert(res.data.data);
                    }
                }
            );
    }



    function getterms() {
        let post_data = {
            naf_user: userinfo,
            project_no: angular.lowercase(pro_no)
        }
        var req = $http.post(api_url + "Project/terms.php", post_data);
        req.then(
            function(res) {
                console.log(res.data);
                $scope._terms = res.data.data;
            }
        );
    }

    $scope.remove_terms = function(rid) {
        var d = confirm("Are you Sure Delete this Term?");
        if (d === true) {
            let post_data = {
                naf_user: userinfo,
                projectname: angular.lowercase(pro_no),
                terms_id: rid
            };

            $http.post(api_url + "Project/terms_remove.php", post_data)
                .then(
                    function(res) {
                        if (res.data.msg === "1") {
                            alert("removed");
                            getterms();
                        } else {
                            alert(res.data.data);
                        }
                    }
                );
        } else {

        }
    }

    // var modal_terms = document.getElementById("myModal_terms");
    // var modal_terms_close = document.getElementById("close_modal_terms");
    // $scope.new_terms = function() {
    //     modal_terms.style.display = "block";

    // }
    // modal_terms_close.onclick = function() {
    //     modal_terms.style.display = "none";
    // }
    // window.onclick = function(event) {
    //     if (event.target == modal_terms) {
    //         modal_terms.style.display = "none";
    //     }
    // }



    $scope.new_terms_add = function() {
        var post_data = {
            naf_user: userinfo,
            projectname: angular.lowercase(pro_no),
            terms_add_new: $("#terms_add_new").val(),
            payment_terms_number: $("#payment_terms_number").val()
        };
        $http.post(api_url + "Project/term_new.php", post_data)
            .then(
                function(res) {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert("Saved....")
                        getterms();
                        $("#terms_add_new").val('');
                        $("#payment_terms_number").val('')
                    } else {
                        alert(res.data.data);
                    }
                }
            )
    }

    $scope.edits_terms = (termss) => {
        $scope.editterms = termss;
        document.getElementById("myModal_termsedit").style.display = "block";
    }

    $scope.new_terms_edit = () => {
        var post_data = {
            naf_user: userinfo,
            projectname: angular.lowercase(pro_no),
            terms_add_new: $("#payment_terms_descripton").val(),
            payment_terms_number: $("#payment_terms_number_edit").val(),
            payment_terms_id: $("#payment_terms_id").val(),
        };
        console.log(post_data);
        $http.post(api_url + "Project/term_edit.php", post_data)
            .then(
                function(res) {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert("Saved....")
                        getterms();
                    } else {
                        alert(res.data.data);
                    }
                }
            )
    }

    //specifications

    function get_project_specification() {
        let post_data = {
            naf_user: userinfo,
            project_no: angular.lowercase(pro_no)
        }
        console.log(post_data);
        var req = $http.post(api_url + "Project/getspecification.php", post_data);
        req.then(
            function(res) {
                console.log(res.data);
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
                project_no: angular.lowercase(pro_no),
                spec_id: spid
            };
            console.log('its woring', post_data);
            var req = $http.post(api_url + "Project/remove_specification.php", post_data);
            req.then(
                function(res) {
                    if (res.data.msg === "1") {
                        alert("Removed");
                        get_project_specification();
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
    var modal_spec = document.getElementById("myModal_spec");
    var modal_spec_close = document.getElementById("close_modal_spec");
    $scope.edit_alu_spec = function(id, remark, type, type_sub, title) {
        _edit_info = {
            spec_id: id,
            spec_project: angular.lowercase(pro_no),
            spec_remark: remark,
            spec_type: type,
            spec_type_sub: type_sub,
            dialog_title: title
        };
        modal_spec.style.display = "block";
        $scope.dialog_title = _edit_info.dialog_title;
        $scope.edit_spec_remark_aluminium = _edit_info.spec_remark;
    }

    // modal_spec_close.onclick = function() {
    //     modal_spec.style.display = "none";
    // }
    // window.onclick = function(event) {
    //     if (event.target == modal_spec) {
    //         modal_spec.style.display = "none";
    //     }
    // }

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
                    get_project_specification();
                } else {

                    alert(res.data.data);
                }
            }
        )
    }

    $scope.editprojectsinfos = (projectinfos) => {
        $scope.newproject = projectinfos;
        document.querySelector("#diaeditprojectinformations").style.display = 'block';
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

    $scope.bfsearch = false;
    $scope.afsearch = false;
    $scope.get_manpowerinfo = (projectno) => {

        $scope.bfsearch = true;
        $scope.afsearch = false;
        $scope.employeelist_title = `${projectno} - Project Workers`;
        document.getElementById('dia_dashboard_employee_list').style.display = 'block';
        // var dt = new Date();
        // var m = dt.getMonth() + 1;
        // var y = dt.getFullYear();
        // var d = dt.getDay();
        // var sr = `${d}-${m}-${y}`;

        // //$("#date_search").val(sr);
        // $scope.srcmanpower_date = sr;
        $("#manpower_project_no").val(projectno)
    }

    $scope.man_power_report_submit = () => {
        var frm = document.getElementById('manpower_reports');
        var fd = new FormData(frm);
        let post_data = {
            method: 'post',
            data: fd,
            url: api_gway,
            headers: {
                'content-type': undefined
            }
        };
        const req = $http(post_data);

        req.then(
            res => {
                console.log(res.data);
                if (res.data.msg === "1") {
                    getList('Manpower Report', res.data.data.manpower_report);
                    $scope.manpower_pinfos = res.data.data.project_infos;

                } else {
                    alert(res.data.data);
                }
            }
        )
    }
    $scope.againsearch = () => {
        $scope.bfsearch = true;
        $scope.afsearch = false;
    }
    $scope.details = [];
    $scope.employeelist_title = '';
    $scope.employees = [];


    function getList(title, listofemployee) {
        $scope.viewcard = true;
        $scope.details = [];
        if (listofemployee.length !== 0) {

            $scope.employees = listofemployee;
            var dummylist = [];
            listofemployee.forEach((emp) => {
                var hav = dummylist.includes(emp.eposition);
                if (!hav) {
                    dummylist.push(emp.eposition);
                }
            });
            var totalworkers = 0;
            var list = [];
            dummylist.forEach((poi) => {
                var posi = poi;
                var cnt = 0;
                listofemployee.forEach((d) => {
                    if (d.eposition === posi) {
                        cnt += 1;
                        totalworkers += 1;
                    }
                });

                var newdata = {
                    'eposition': posi,
                    'cnt': cnt
                }
                list.push(newdata);

                defalutSelect();
            });
            // var newdatas = {
            //     'eposition': 'Total',
            //     'cnt': totalworkers
            // }
            // list.push(newdatas);
            // /console.log(list);
            $scope.workerinfototal = totalworkers;
            $scope.details = list;
            $scope.bfsearch = false;
            $scope.afsearch = true;
        } else {
            $scope.bfsearch = true;
            $scope.afsearch = false;
            alert("No Data Found")
        }

    }




    defalutSelect();

    function defalutSelect() {
        $scope.srcemp = '';
        $scope.srccate = '';
        $(".card-i").css({
            'color': '#000',
            'background-color': 'transparent',
            'border': 'none'
        });
        $(".table-i").css({
            'color': '#000',
            'background-color': 'transparent',
            'border': 'none'
        });
        $(".info-i").css({
            'color': '#0400b5',
            'background-color': '#d2d2d2',
            'border': '1px solid #cacaca'
        });

        $scope.viewcard = false;
        $scope.viewtable = false;
        $scope.viewinfos = true;
    }

    $scope.showcard = () => {
        $scope.viewcard = true;
        $scope.viewtable = false;
        $scope.viewinfos = false;

        $(".card-i").css({ 'color': '#0400b5', 'background-color': '#d2d2d2', 'border': '1px solid #cacaca' });
        $(".table-i").css({
            'color': '#000',
            'background-color': 'transparent',
            'border': 'none'
        });
        $(".info-i").css({
            'color': '#000',
            'background-color': 'transparent',
            'border': 'none'
        });

    }
    $scope.showtable = () => {
        $scope.viewcard = false;
        $scope.viewtable = true;
        $scope.viewinfos = false;
        $(".card-i").css({
            'color': '#000',
            'background-color': 'transparent',
            'border': 'none'
        });
        $(".table-i").css({ 'color': '#0400b5', 'background-color': '#d2d2d2', 'border': '1px solid #cacaca' });
        $(".info-i").css({
            'color': '#000',
            'background-color': 'transparent',
            'border': 'none'
        });
    }
    $scope.showinfos = () => {
        $scope.viewcard = false;
        $scope.viewtable = false;
        $scope.viewinfos = true;
        $(".card-i").css({
            'color': '#000',
            'background-color': 'transparent',
            'border': 'none'
        });
        $(".table-i").css({
            'color': '#000',
            'background-color': 'transparent',
            'border': 'none'
        });
        $(".info-i").css({ 'color': '#0400b5', 'background-color': '#d2d2d2', 'border': '1px solid #cacaca' });
    }


    //upload

    document.getElementById("handovler_dia").style.display = "none";
    $scope.handover_dia = () => {
        document.getElementById("handovler_dia").style.display = "block";
    }

    $scope.isloading_status = false;
    $scope.new_handover_submit = async () => {
        console.log("hading over start")
        if ($scope.isloading_status) return;
        const fd = new FormData(document.getElementById("new_handover"));
        fd.append("project_id", $scope.viewproject.project_id);
        $scope.isloading_status = true;
        const sr = new cuttinglistservices();
        const res = await sr.POST('projectx/index.php', fd);
        if (res?.msg !== 1) {
            $scope.isloading_status = false;
            alert(res.data);
            $scope.$apply();
            return;
        }
        $scope.isloading_status = false;
        alert("Status Updated");
        $scope.$apply();
        location.reload();
        return;
    }
});

app.filter('capitalize', function() {
    return function(input) {
        return (angular.isString(input) && input.length > 0) ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase() : input;
    }
});

app.filter('ifnan', function() {
    return function(val) {
        return val === 'NAN' ? 'NONE' : val;
    }
})