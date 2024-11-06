app.controller('glassorder', function($scope, $http) {
    // const inputs = document.querySelectorAll("input");
    // inputs.forEach(i => {
    //     i.autocomplete = "off";
    // })
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
        var bhbhbh = bh - 35 - 20;
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
                    project_id: project_id
                };
                glassorder_all();
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

    $scope.gasstype_new_save = function() {
        let post_data = {
            naf_user: userinfo,
            glasstype_name: $scope.glasstype_name
        };

        $http({
            method: 'post',
            url: api_url + "GlassType/new.php",
            data: post_data
        }).then(
            (res) => {
                if (res.data.msg === "1") {
                    alert('saved');
                    all_glassTypes();
                    $scope.glasstype_name = "";
                    $("#glasstype_name").focus();
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    $scope.supplier_new_save = function() {
        let post_data = {
            naf_user: userinfo,
            supplier_name: $scope.new_supplier_name,
        };
        $http({
            method: 'post',
            url: api_url + "suppliers/new.php",
            data: post_data
        }).then(
            (res) => {
                if (res.data.msg === "1") {
                    alert("saved");
                    $scope.new_supplier_name = "";
                    suppliers_all();
                    $("#new_supplier_name").focus();
                } else {
                    alert(res.data.data);
                }
            }
        )
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
                console.log(res.data);
                if (res.data.msg === "1") {
                    $scope.glassorder = res.data.data;
                } else {
                    alert(res.data.data);
                }
                $scope.isloading = false;
            }
        )
    }


    $("#save_new_glassorder").submit(function(e) {
        e.preventDefault();
        var fd = new FormData(this);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        $.ajax({
            url: api_url + "glassorder/new.php",
            data: fd,
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                console.log(res);
                if (res.msg === "1") {
                    alert(res.data);
                    document.getElementById("new-glassorder").style.display = 'none';
                    location.reload();
                } else {
                    alert(res.data);
                }
            }

        })
    })

    $scope.edit_glassorder = function(x) {
        var dialog = document.getElementById("edit-glassorder");
        dialog.style.display = "block";
        $scope.edit_glassorders = x;
    }


    $("#edit_new_glassorder").submit(function(e) {
        e.preventDefault();

        var fd = new FormData(this);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        $.ajax({
            url: api_url + "glassorder/edit.php",
            data: fd,
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                console.log(res);
                if (res.msg === "1") {
                    alert(res.data);
                    document.getElementById("edit_new_glassorder").style.display = 'none';
                    location.reload();
                } else {
                    alert(res.data);
                }
            }

        })
    })
    $scope.savetoexcel = function() {
        savetoexcel();
    }

    $scope.getinfoold = function($event) {
        if ($event.which === 13) {
            // getoldinfoofglassordernew();
        }
    }
    $scope.getoldinfo = function() {
        console.log("its workign")
        getoldinfoofglassordernew();
    }

    function getoldinfoofglassordernew() {
        var x = $scope.newglassorder.glassorderno;
        if (!x || x === '') {
            console.log("glass order number is empty");
        } else {
            let post_data = {
                naf_user: userinfo,
                project_no: project_id,
                orderno: x
            };
            console.log(post_data);
            $http({
                method: "post",
                data: post_data,
                url: api_url + "glassorder/getbyorderno.php",
            }).then(
                function(res) {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        var c = confirm("Are you Sure Load old Data?");
                        if (c) {
                            $scope.newglassorder = res.data.data;
                        } else {

                        }
                    } else {

                    }
                }
            )
        }
    }

    $scope.getoldinfo = function() {
        getoldinfoofglassordernew();
    }

    $scope.removeNew_glassorder = function() {
        $scope.newglassorder = {
            project_id: project_id,

        };
        $scope.boqitemlist = [];
    }

    $scope.removeglassorder = function(t, p) {
        var c = confirm("Are your Sure Remove this data?");
        if (c) {
            console.log(t, p);
            let post_data = {
                naf_user: userinfo,
                project_id: p,
                ordertoken: t
            };

            var req = $http({
                method: 'post',
                data: post_data,
                url: api_url + "glassorder/Remove.php",
            });

            req.then(
                (res) => {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert("Removed")
                        document.getElementById("edit-glassorder").style.display = "none";
                        glassorder_all();
                    } else {
                        alert(res.data.data);
                    }
                }
            )
        }
    }

    function savetoexcel() {
        console.log("Wroking .... ");
        var tableToExcel = (function() {
            var uri = 'data:application/vnd.ms-excel;base64,',
                template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
                base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) },
                format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
            return function(table, name) {
                if (!table.nodeType) table = document.getElementById(table)
                var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }
                window.location.href = uri + base64(format(template, ctx))
            }
        })()
    }
    $scope.boqitemlist = [];
    $scope.insert_boqitems = function() {
        if (!$scope.newglassorder.boq_itemno || $scope.newglassorder.boq_itemno == '') {

        } else {
            $x = $scope.boqitemlist.includes($scope.newglassorder.boq_itemno);
            if (!$x) {
                $scope.boqitemlist.push($scope.newglassorder.boq_itemno);

            }

        }
    }

    $scope.rmv = function($index) {
        $scope.boqitemlist.splice($index, 1);
    }


})