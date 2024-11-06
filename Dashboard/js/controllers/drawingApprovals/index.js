app.controller('drawing_approvals_index', function ($scope, $http) {

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
    $scope.isloading = true;
    $("#back_btn").on('click', function () {
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
            function (res) {
                console.log(res.data);
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
            function (res) {
                console.log(res.data);
                if (res.data.msg == "1") {
                    $scope._dapprovals = res.data.data;
                    $scope.drawapprovals = res.data.data;

                } else {
                    alert(res.data.data);
                }
            }
        );
    }
    get_all_approvals();

    function get_all_approvals() {
        var post_data = {
            naf_user: userinfo,
            project_no: project_id
        };

        $http.post(
            api_url + "DrawingApprovals/index.php",
            post_data,

        ).then(
            function (res) {
                console.log(res.data);
                if (res.data.msg == "1") {
                    $scope._approvals = res.data.data;
                    //$scope.newrevisions = res.data.data[0];
                } else {
                    alert(res.data.data);
                }
                $scope.isloading = false;
            }
        );
    }

    $scope.AddNewRevision_btn = function (ainfo) {
        console.log('infos', ainfo);
        document.getElementById("newRevision").style.display = 'block';
        document.getElementById('project_code').value = ainfo.approvals_project_code;
        document.getElementById('approvals_draw_no').value = ainfo.approvals_draw_no;
        document.getElementById('approvals_token').value = ainfo.approvals_token;
        //document.getElementById('_drawingno').text = ainfo.approvals_token;
        document.getElementById('_drawingno').innerText = ainfo.approvals_draw_no;
        // $scope.newrevision.approvals_draw_no = ainfo.approvals_draw_no;
        //$scope.newrevisions.project_code = ainfo.project_code;
        // console.log(ainfo);
        // $scope.newrevisions.approvals_token = ainfo.approvals_token;
        // $scope.newrevisions.approvals_draw_no = ainfo.approvals_draw_no;

    }

    // const approvals_info_submited_on = document.getElementById("approvals_info_submited_on");
    // approvals_info_submited_on.addEventListener("blur", (e) => {
    //     let x = e.target.value;
    //     const approvals_info_received_on = document.getElementById("approvals_info_submited_on");
    //     const approvals_info_client_on = document.getElementById("approvals_info_client_on");
    //     if (x !== "") {
    //         if (approvals_info_received_on.value === "" && approvals_info_client_on.value === "") {
    //             $scope.newrevisions = {
    //                 ...$scope.newrevisions,
    //                 approvals_info_received_on: x,
    //                 approvals_info_client_on: x,
    //             }
    //         } else if (approvals_info_received_on.value === "" && approvals_info_client_on.value !== "") {
    //             $scope.newrevisions = {
    //                 ...$scope.newrevisions,
    //                 approvals_info_received_on: x,                    
    //             }
    //         } else if (approvals_info_received_on.value !== "" && approvals_info_client_on.value === "") {
    //             $scope.newrevisions = {
    //                 ...$scope.newrevisions,
    //                 approvals_info_client_on: x,                
    //             }
    //         } else {
                
    //         }
            
    //     }
    // })

    const approvals_info_code = document.getElementById("approvals_info_code");
    approvals_info_code.addEventListener('change', (e) => {
        let _data = approvals_info_code.options[approvals_info_code.selectedIndex].text;
        console.log(_data);
        if (_data !== "") {            
            $scope.newrevisions = {
                ...$scope.newrevisions,
                approvals_info_remarks : _data,
            }
        }
    })

    $("#save_drawing_approvals").submit(function (e) {

        e.preventDefault();
        $("#save_d_approvals_btn").hide();
        var fd = new FormData(this);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        $("#save_d_approvals_btn").show();
        $.ajax({
            url: api_url + "DrawingApprovals/newinfo.php",
            data: fd,
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                //console.log("reponse return");
                console.log(res);
                if (res.msg === "1") {
                    alert("saved");
                    document.getElementById("newRevision").style.display = 'none';
                    //get_all_approvals();
                    location.reload();
                    //document.getElementById("save_drawing_approvals").reset();
                } else {
                    alert(res.data);
                }
            }

        })

    })

    $scope.Revision_btnList = function ($x) {
        console.log($x);
        $scope._drawingno = $x.approvals_draw_no;
        document.getElementById('revision_list').style.display = 'block';
        let post_data = {
            naf_user: userinfo,
            project_no: $x.approvals_project_code,
            drawing_no: $x.approvals_token
        };

        $http.post(api_url + "DrawingApprovals/getAllrevisions.php", post_data)
            .then(
                function (res) {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        $scope.revision_list = res.data.data;
                    } else {
                        alert(res.data.data);
                    }
                }
            )

    }
    $scope.save_types = function () {
        var post_data = {
            naf_user: userinfo,
            drawing_types_new: $scope.drawing_types_new
        };
        console.log(post_data);
        $http.post(api_url + "DrawingApprovalsTypes/new.php", post_data)
            .then(
                (res) => {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert("saved");
                        $scope.drawing_types_new = "";
                        All_approvalsType();
                    } else {
                        alert(res.data.data);
                    }
                }
            )

    }
    $scope.edit_drawingdt = function ($x) {
        console.log($x);
        document.getElementById('edit_drawinginfo').style.display = 'block';
        $scope.enewapproval = $x;

    }

    $scope.ed_save_new_approval = function () {
        var post_data = {
            naf_user: userinfo,
            newapproval: $scope.enewapproval
        }
        console.log("sta");
        $http.post(api_url + "DrawingApprovals/updateDrawing.php", post_data)
            .then(
                (res) => {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert(res.data.data);
                        location.reload();
                    } else {
                        alert(res.data.data);
                    }
                }
            )
    }

    $scope.edit_revision = function ($rinfos) {
        console.log("working");
        document.getElementById('editRevision').style.display = 'block';
        $scope.editrelease = $rinfos;
        // document.getElementById('_drawingno').innerText = ainfo.approvals_draw_no;
        // document.getElementById('_drawingnos').innerText = $rinfos.approvals_info_drawing_no;
    }

    // var date1 = new Date("06/30/2019");
    // var date2 = new Date("07/30/2019"); 
    // var Difference_In_Time = date2.getTime() - date1.getTime() ;
    // console.log(Difference_In_Time / (1000 * 3600 * 24));
    // var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24); 
    // console.log(Difference_In_Days);


    $("#edit_drawing_approvals").submit(function (e) {
        //console.log("response");
        e.preventDefault();
        $("#update_d_approvals_btn").hide();
        var fd = new FormData(this);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        $.ajax({
            url: api_url + "DrawingApprovals/updateDrawinginfo.php",
            data: fd,
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                //console.log("reponse return");
                console.log(res);
                if (res.msg === "1") {
                    alert("saved");

                    //document.getElementById("editRevision").style.display = 'none';
                    //get_all_approvals();
                    get_all_approvals();
                    //location.reload();
                    //document.getElementById("save_drawing_approvals").reset();
                    location.reload();
                } else {
                    alert(res.data);
                }
            }

        })
        $("#update_d_approvals_btn").show();

    })

    $scope.save_types = function () {
        var post_data = {
            naf_user: userinfo,
            drawing_types_new: $scope.drawing_types_new
        };
        console.log(post_data);
        $http.post(api_url + "DrawingApprovalsTypes/new.php", post_data)
            .then(
                (res) => {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert("saved");
                        $scope.drawing_types_new = "";
                        All_approvalsType();
                    } else {
                        alert(res.data.data);
                    }
                }
            )

    }


    $scope.d_save_new_approval = function () {

        var post_data = {
            naf_user: userinfo,
            newapproval: $scope.newapproval,
            project_no: project_id
        };

        $http.post(api_url + "DrawingApprovals/new.php", post_data)
            .then(
                function (res) {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert("Saved");
                        $scope.newapproval = {
                            approvals_for: '',
                            approvals_draw_no: '',
                            approvals_descriptions: ''
                        };
                    } else {
                        alert(res.data.data);
                    }
                }
            )



    }
    $scope.Removedrawings = (x) => {
        var c = confirm("Are You Sure Remove this Approvals?");
        if (c) {
            var fd = new FormData();
            fd.append('user_name', userinfo.user_name);
            fd.append('user_token', userinfo.user_token);
            fd.append('approvals_id', x.approvals_id);
            var post_data = {
                method: "post",
                data: fd,
                url: api_url + "DrawingApprovals/remove.php",
                headers: {
                    'content-Type': undefined
                }
            };

            const res = $http(post_data);
            res.then(
                (res) => {
                    if (res.data.msg === "1") {
                        alert("Remove");
                        location.reload();
                    } else {
                        alert(res.data.data);
                    }
                }
            )
        }
    }


    $scope.edit_approvals_info_code_change = ($event) => {
        const editreleaseapprovals_info_code = document.getElementById("editreleaseapprovals_info_code");
        const txt = editreleaseapprovals_info_code.options[editreleaseapprovals_info_code.selectedIndex].text;        
        $scope.editrelease = {
            ...$scope.editrelease,
            approvals_info_remarks : txt
        }
    }



})