app.controller('cuttinglist', function($scope, $http) {
    //pro_costing    
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
    document.getElementById("pro_engg").classList.add('menuactive');

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

    $("#back_btn").on('click', function() {
        window.history.back();
    })
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
                glassorder_all();
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
                if (res.data.msg == "1") {
                    $scope._dapprovals = res.data.data;
                    $scope.drawapprovals = res.data.data;

                } else {
                    alert(res.data.data);
                }
            }
        );
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
                if (res.data.msg === "1") {
                    $scope.supplier_list = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    function get_measurement(project_no, refno, reviewno) {
        var post_data = {
            naf_user: userinfo,
            project_no: project_no,
            project_refno: refno,
            project_reviewno: reviewno
        };
        $http.post(api_url + "Boq/index.php", post_data)
            .then(
                function(res) {
                    if (res.data.msg === "1") {
                        $scope.measurements = res.data.data;
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
            $scope.isloading = false;
        })
    }


    $scope.markingLocation_new_save = function() {
        var post_data = {
            naf_user: userinfo,
            markingLocation: $scope.markingLocation
        };
        $http({
                url: api_url + "markinglocation/new.php",
                method: 'post',
                data: post_data
            })
            .then((res) => {

                if (res.data.msg === '1') {
                    alert("saved");
                    markingtype_all();
                    $scope.markingLocation = "";
                    $("#markingLocation").focus();
                } else {
                    alert(res.data.data);
                }
            })
    }
    $scope.glassorder = ['N/A'];


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
                    $.each(res.data.data, function($order, $index) {
                        $dub = true;
                        $dub = $scope.glassorder.includes($index.glassorderno);

                        if ($dub == false) {
                            $scope.glassorder.push($index.glassorderno);
                        }
                    })
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    $("#save_new_cuttinglist").submit(function(e) {
        e.preventDefault();
        var fd = new FormData(this);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        $.ajax({
            url: api_url + "cuttinglist/new.php",
            data: fd,
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(res) {
                console.log(res);
                if (res.msg === "1") {
                    alert("Saved\n" + res.data);
                    //document.getElementById('save_new_cuttinglist').reset();
                    //_reload();
                    document.getElementById('pdffile').value = "";
                    $scope.newglassorder = {
                        cuttinglist_project_id: project_id
                    };
                    markingtype_all();
                    glassorder_all();
                    cuttinglist_all();
                } else {
                    alert(res.data);
                }
            }
        })
    })
    var modal_edit = document.getElementById('edit-cuttinglist');
    $scope.edit_cuttinglist = function(x) {
        modal_edit.style.display = 'block';
        $scope.editcuttinglist = x;
        console.log(x);
    }

    $("#save_edit_cuttinglist").submit(function(e) {
        var x123_main = $('x123_main');
        x123_main.hide();
        e.preventDefault();
        var fd = new FormData(this);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        $.ajax({
            url: api_url + "cuttinglist/edit.php",
            data: fd,
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                console.log(res);
                if (res.msg === "1") {
                    alert("Updated\n" + res.data);
                    document.getElementById('pdffile').value = "";
                    cuttinglist_all();
                } else {
                    alert(res.data);
                }
            }
        })

        x123_main.show();
    })

    $("#cuttinglist_height").keyup(function() {
        //newcalc();
    });
    $("#cuttinglist_width").keyup(function() {
        // newcalc();
    });

    function newcalc() {
        if ($("#cuttinglist_height").val() == '' || $("#cuttinglist_width").val() == '') {

        } else {
            var num1 = $("#cuttinglist_height").val();
            var num2 = $("#cuttinglist_width").val();
            var res = calc(num1, num2);
            var r = res.toFixed(2);

            $scope.newglassorder.cuttinglist_area = r;
            totareacalc()
                //$("#cuttinglist_area").val(res.toFixed(2))
        }

    }
    $("#cuttinglist_height_edit").keyup(function() {
        //calc2();
    });
    $("#cuttinglist_width_edit").keyup(function() {
        //calc2();
    });
    $scope.calculates_area = function() {
        newcalc();
    }
    $scope.calculates_area2 = function() {
        calc2();
    }
    $scope.errordivscuttinglist = false;
    $scope.rembalance = 0;

    function chcuttinglistqtuy() {
        if (!$scope.newglassorder.cuttinglistfor || $scope.newglassorder.cuttinglistfor === '') {
            //console.log('all its working1234');
            $scope.errordivscuttinglist = false;
            $scope.rembalance = 0;
        } else {
            if (!$scope.newglassorder.cuttinglist_boqitem || $scope.newglassorder.cuttinglist_boqitem === '') {
                //console.log('all its working121');
                $scope.errordivscuttinglist = false;
                $scope.rembalance = 0;
            } else {
                if (!$scope.newglassorder.cuttinglist_qty || $scope.newglassorder.cuttinglist_qty === '') {
                    // console.log('all its working1222');
                    $scope.errordivscuttinglist = false;
                    $scope.rembalance = 0;
                } else {
                    if ($scope.newglassorder.cuttinglistfor === "1") {
                        var diff = +$scope.oldinfos.diff;
                        var cuqty = +$scope.newglassorder.cuttinglist_qty;
                        var rembalances = diff - cuqty;
                        $scope.rembalance = rembalances;
                        console.log(cuqty);
                        if (cuqty > diff) {
                            $scope.errordivscuttinglist = true;
                        } else {
                            $scope.errordivscuttinglist = false;
                        }
                    } else {
                        $scope.errordivscuttinglist = false;
                    }
                }
            }
        }
    }

    $scope.qutycheck = () => {
        chcuttinglistqtuy();
    }
    $scope.totaracalc = function() {
        totareacalc();
        chcuttinglistqtuy();
    }
    $scope.calculates_totarea = function() {
        totareacalc()
    }

    function totareacalc() {
        var num1 = parseFloat($scope.newglassorder.cuttinglist_area);
        var num2 = parseFloat($scope.newglassorder.cuttinglist_qty);
        var num3 = num1 * num2;
        $scope.newglassorder.cuttinglist_totarea = num3.toFixed(2);
    }
    $scope.totaracalc1 = function() {
        totareacalc1()
    }

    function totareacalc1() {
        var num1 = parseFloat($scope.editcuttinglist.cuttinglist_area);
        var num2 = parseFloat($scope.editcuttinglist.cuttinglist_qty);
        var num3 = num1 * num2;
        $scope.editcuttinglist.cuttinglist_totarea = num3.toFixed(2);
    }

    function calc2() {
        if ($("#cuttinglist_height_edit").val() == '' || $("#cuttinglist_width_edit").val() == '') {

        } else {
            var num1 = $("#cuttinglist_height_edit").val();
            var num2 = $("#cuttinglist_width_edit").val();
            var res = calc(num1, num2);
            $("#cuttinglist_area_edit").val(res.toFixed(2));
            totareacalc1();

        }
    }

    $scope.glassorderslists = function(refno) {

        document.getElementById("glass_orderlist").style.display = "block";
        let post_data = {
            naf_user: userinfo,
            project_no: project_id,
            glassorderno: refno
        };

        $http({
            method: 'post',
            url: api_url + "glassorder/getbyrefno.php",
            data: post_data
        }).then(
            (res) => {

                if (res.data.msg === "1") {
                    $scope.glassorderlist = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }
    $("#src_mak").on('change', function() {

    })

    $scope.remove_items = function(t, p) {
        var x = confirm("Are you Sure Delete This?");
        if (x) {
            let post_data = {
                naf_user: userinfo,
                project_no: p,
                project_token: t
            };
            console.log(post_data);
            $http({
                method: 'post',
                data: post_data,
                url: api_url + "cuttinglist/del.php",
            }).then(
                (res) => {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert("item Deleted Successfully");
                        cuttinglist_all();
                        document.getElementById('edit-cuttinglist').style.display = 'none';
                    } else {
                        alert(res.data.data);
                    }
                }
            )
        } else {

        }
    }
    $scope.getrefnoinfos = function() {
        getinfosmorefno();
    }

    function getinfosmorefno() {
        var x = $scope.newglassorder.cuttinglist_morefno;
        if (!x || x === '') {

        } else {
            let post_data = {
                naf_user: userinfo,
                project_no: project_id,
                refno: x
            };
            console.log(post_data);
            $req = $http({ method: 'post', data: post_data, url: api_url + "cuttinglist/getinfo.php" });
            $req.then(
                (res) => {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        let c = confirm("Are You Sure Load old Data?");
                        if (c) {
                            $scope.newglassorder = res.data.data;
                        } else {
                            console.log("canceled by user...")
                        }
                    } else {
                        console.log(res.data.data);
                    }
                }
            )
        }
    }
    GetAllQtyType();

    function GetAllQtyType() {
        var post_data = {
            naf_user: userinfo
        };

        $http({
            method: 'post',
            data: post_data,
            url: api_url + 'cuttinglist/allqtytype.php'
        }).then(
            function(res) {
                console.log(res.data);
                if (res.data.msg === '1') {
                    $scope.ctqtytype = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }
    $scope.qtytype_new_save = function() {
        SaveQtyType();
    }

    function SaveQtyType() {
        var qname = $scope.qtytypenew;
        let post_data = {
            naf_user: userinfo,
            qtytype: qname
        };
        $http.post(
            api_url + "cuttinglist/newqtytype.php",
            post_data
        ).then(
            (res) => {
                console.log(res.data);
                if (res.data.msg === '1') {
                    alert("Data Saved");
                    $scope.qtytypenew = '';
                    GetAllQtyType();
                    document.getElementById('qtytypenew').focus();
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    $scope.getoldbalance = () => {
        if ($scope.newglassorder.cuttinglist_boqitem !== '') {
            var fd = {
                naf_user: userinfo,
                project_no: project_id,
                boqitems: $scope.newglassorder.cuttinglist_boqitem
            };

            var post_data = {
                method: 'post',
                data: fd,
                url: api_url + "cuttinglist/getinfos2.php",
            };

            $http(post_data).then(
                res => {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        $scope.oldinfos = res.data.data;
                        chcuttinglistqtuy();
                    } else {
                        alert(res.data.data);
                    }
                }
            )

        };
    }
})

function calc(num1, num2) {
    _n = parseFloat(num1);
    _m = parseFloat(num2);
    _k = _n * _m;
    return _k;
}