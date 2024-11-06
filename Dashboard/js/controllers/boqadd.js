app.controller('addboq', function($scope, $http) {
    // const inputs = document.querySelectorAll("input");
    // inputs.forEach(i => {
    //     i.autocomplete = "off";
    // })
    document.getElementById("contract_menu").style.background = '#e84a5f';
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
                project_id = angular.lowercase(res.data.data.project_no);
            } else {
                alert(res.data.data);
            }
        });
    }
    get_all_units();

    function get_all_units() {
        let post_data = {
            naf_user: userinfo
        };

        var req = $http.post(api_url + "Units/index.php", post_data);
        req.then(
            res => {

                if (res.data.msg === "1") {

                    $scope._units = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }
    all_ptype()

    function all_ptype() {
        var post_data = {
            naf_user: userinfo
        };
        var req = $http.post(api_url + "Ptype/index.php", post_data);
        req.then(
            function(res) {
                if (res.status == 200) {
                    if (res.data.msg === "1") {
                        $scope._ptype = res.data.data;
                    } else {
                        alert(res.data.data);
                    }
                } else {
                    alert("Server Connection error....");
                }

            }
        )
    }
    all_systemType();

    function all_systemType() {
        var post_data = {
            naf_user: userinfo
        };
        var req = $http.post(api_url + "SysType/index.php", post_data);
        req.then(
            res => {
                if (res.data.msg === "1") {
                    $scope._systype = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }
    all_systemFinish();

    function all_systemFinish() {
        var post_data = {
            naf_user: userinfo,
        }
        $http.post(api_url + "SysFinish/index.php", post_data)
            .then(
                function(res) {
                    if (res.data.msg === "1") {
                        $scope._sysFinish = res.data.data;
                    } else {
                        alert(res.data.data);
                    }
                }
            )
    }

    $scope.area_cal = function($event) {

        if ($event.which !== 13) {
            $scope._item_area = _area_calc($scope.new_boq.item_width, $scope.new_boq.item_height, 2)

        }
    }

    $scope.price_calc = function($event) {
        if ($event.which !== 13) {
            $scope._itemTprice = _area_calc($scope.new_boq.item_Uprice, $scope.new_boq.item_qty, 2)
        }
    }


    $scope.boq_new_save = function() {
        var post_data = {
            naf_user: userinfo,
            new_boq: $scope.new_boq,
            poq_project_code: project_id,
            ref_no: $scope.viewproject.project_boq_refno,
            rev_no: $scope.viewproject.project_boq_revision,
            notesitems: $scope._notess
        };
        $http.post(api_url + "Boq/new.php", post_data)
            .then(
                function(res) {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert("saved..");
                        reload();
                    } else {
                        alert(res.data.data);
                    }
                }
            );
    }

    var boq_type = document.getElementById("type_add");
    var modal_close_type = document.getElementById("close_modal_type");

    modal_close_type.onclick = function() {
        boq_type.style.display = "none";
    }

    $scope.btn_new_type = function() {
        boq_type.style.display = "block";
    }
    $scope.type_new = function() {
        var post_data = {
            naf_user: userinfo,
            ptype_name: $scope.ptype_name
        };
        $req = $http.post(api_url + "Ptype/new.php", post_data);
        $req.then(
            res => {

                if (res.data.msg === "1") {
                    alert("saved");
                    $scope.ptype_name = "";
                    all_ptype();

                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    var finish_type = document.getElementById("finish_add");
    var close_modal_finish = document.getElementById("close_modal_finish");
    close_modal_finish.onclick = function() {
        finish_type.style.display = "none";
    }
    $scope.new_finish_btn = function() {
        finish_type.style.display = "block";
    }

    $scope.finish_new = function() {
        var post_data = {
            naf_user: userinfo,
            system_finish: $scope.finish_name
        };
        $http.post(api_url + "SysFinish/new.php", post_data)
            .then(
                function(res) {
                    if (res.data.msg == "1") {
                        alert("saved");
                        $scope.finish_name = "";
                        all_systemFinish();
                    } else {
                        alert(res.data.data);
                    }
                }
            )
    }

    var systype_add = document.getElementById("systype_add");
    var close_modal_systype = document.getElementById("close_modal_systype");
    close_modal_systype.onclick = function() {
        systype_add.style.display = "none";
    }
    $scope.open_new_system = function() {
        systype_add.style.display = "block";
    }
    $scope.system_new = function() {
        var post_data = {
            naf_user: userinfo,
            system_name: $scope.system_name
        };

        var req = $http.post(api_url + "SysType/new.php", post_data)
            .then(
                function(res) {
                    if (res.data.msg === "1") {
                        alert("Saved..");
                        $scope.system_name = "";
                        all_systemType();
                    } else {
                        alert(res.data.data);
                    }
                }
            )
    }

    var units_add = document.getElementById("units_add");
    var close_modal_unit = document.getElementById("close_modal_unit");
    close_modal_unit.onclick = function() {
        units_add.style.display = "none";
    }
    $scope.btn_new_unit = function() {
        units_add.style.display = "block";
    }

    $scope.unit_new = function() {
        var post_data = {
            naf_user: userinfo,
            unit_name: $scope.unit_name
        };
        $req = $http.post(api_url + "Units/new.php", post_data);
        $req.then(
            res => {
                if (res.data.msg === "1") {
                    alert("saved");
                    get_all_units();
                    $scope.unit_name = "";

                } else {
                    alert(res.data.data);
                }
            }
        )
    }
    window.onclick = function(event) {
        if (event.target == boq_type) {
            boq_type.style.display = "none";
        } else if (event.target == finish_type) {
            finish_type.style.display = "none";
        } else if (event.target == systype_add) {
            systype_add.style.display = "none";
        } else if (event.target == units_add) {
            units_add.style.display = "none";
        }
    }

    $scope._notess = [];

    $scope.addnewnotes = () => {
        var nwval = $("#notesnew").val();
        if (nwval !== '') {
            var dub = $scope._notess.includes(nwval);
            if (dub) {
                alert("")
            } else {
                $scope._notess.push(nwval);
                $("#notesnew").val('');
            }
        }
    }

    $scope.remove = (item) => {
        $scope._notess.splice(item, 1)
    }
});

function _area_calc(no1, no2, digits) {
    var _no1 = parseFloat(no1);
    var _no2 = parseFloat(no2);
    var x = _no1 * _no2;
    return x
}