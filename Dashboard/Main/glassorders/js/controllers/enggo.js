import EngGoServices from './../services/enggo.js';
import GlassSupplierServices from './../services/suppliers.js';
export default function engglassorder($scope,$http, $rootScope, $compile, $filter) {
    $scope.access = {

    };


    const _msg = (d, t, msg = "") => {
        let icon = t === "n" ? "fa fa-exclamation-circle" : "fa fa-info-circle";
        let theme = t === "n" ? "ism-dialog-input-error" : "ism-dialog-input-success";

        $scope.res = {
            display: d,
            theme: theme,
            icon: icon,
            msg: msg
        }
        setTimeout(_msgoff, 2000);
    }
    _msg(false, "n")
    function _msgoff() {
        $scope.res.display = false;
        $scope.$apply();
    }

    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian'
    };
    moment.locale('en');
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    moment.locale('en');


    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };

    const eg = new EngGoServices();
    const gs = new GlassSupplierServices();

    $scope.gen_project_list = [];
    $scope.get_supplier_list = [];
    $scope.get_glass_list = [];

    $scope.selected_project = {};
    $scope.selected_supplier = {};
    $scope.selected_glass = {};
    loadAllproject();
    async function loadAllproject() {
        const res_project = gs.getAllProjects();
        const res_suppliers = gs.getAllGlassSuppliers();
        const res_glasslist = gs.allglassdescriptoins();

        const res_project_final = await res_project;
        const res_suppliers_final = await res_suppliers;
        const res_glasslist_final = await res_glasslist;

        if (res_project_final?.msg !== 1) {
            alert("Fetch Error");
            console.warn("Error on fetching Project List");
            console.error(res.data);
            return;
        }


        if (res_suppliers_final?.msg !== 1) {
            alert("Fetch Error");
            console.warn("Error on fetching Supplier List");
            console.error(res.data);
            return;
        }


        if (res_glasslist_final?.msg !== 1) {
            alert("Fetch Error");
            console.warn("Error on fetching Glass List");
            console.error(res.data);
            return;
        }

        $scope.gen_project_list = res_project_final.data;
        $scope.get_supplier_list = res_suppliers_final.data;
        $scope.get_glass_list = res_glasslist_final.data;
        $scope.$apply();
        return;
    }

    //gird actions
    const gridDiv = document.querySelector('#myGrid');
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

    const columnDefs = eg.colsdef($scope, $compile, $scope.access);
    const gridOptions = gs.gridoptions(columnDefs);
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

    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);
    //grid def end 

    function _emptyglassorder() {
        const _ = {
            isloading: false,
            mode: "N",
            title: "ADD NEW GLASS ORDER",
            btn: "Save",
            data: {
                goid: "0",
                gono: "",
                godoneby: "",
                goreldate: "",
                gorcdate: "",
                gosupplier: "",
                goglasstype: "",
                goglassspc: "",
                goglassthickness: "",
                gomarkinglocation: "",
                goglassqty: "",
                goremark: "",
                gotype: "",
                goproject: "",
                gostatus: ""
            }
        }

        return _;
    }
    $scope.glassorder = _emptyglassorder();

    let _dia_project = "S";
    document.getElementById("dia_projectselector").style.display = "none";
    $scope.show_project_list_selector = () => {
        _dia_project = "S";
        document.getElementById("dia_projectselector").style.display = "flex";
        document.getElementById("select_auto_projects").style.display = "none";
    }

    $scope.show_project_select = () => {
        const x = document.getElementById("current_select_project").getBoundingClientRect();
        document.getElementById("select_auto_projects").style.top = x.top + "px";
        document.getElementById("select_auto_projects").style.left = x.left + "px";
        document.getElementById("select_auto_projects").style.display = "block";
        const search_listed_project = document.getElementsByName("search_listed_project")[1].focus();;
        // console.log(search_listed_project.focus());
    }

    $scope.project_list_search_input_change = ($event) => {
        let key = $event.which;
        if (key === 8) {
            let length = $event.target.value.length;
            if (length < 1) {
                if (_dia_project === "N") {
                    document.getElementById("select_auto_projects").style.display = "none";
                    document.getElementById("goproject").focus();
                } else {
                    document.getElementById("select_auto_projects").style.display = "none";
                    document.getElementById("current_select_project").focus();
                }
            }
        }

        if (key === 27) {
            if (_dia_project === "N") {
                document.getElementById("select_auto_projects").style.display = "none";
                document.getElementById("goproject").focus();
            } else {
                document.getElementById("select_auto_projects").style.display = "none";
                document.getElementById("current_select_project").focus();
            }
        }
    }

    $scope.select_project = (x) => {
        console.log(x);
        $scope.selected_project = x;
        if (_dia_project === "S") {
            document.getElementById("select_auto_projects").style.display = "none";
            $scope.current_select_project_mo = x.project_name;
            return;
        } else {
            document.getElementById("budget_auto_projects").style.display = "none";
            document.getElementById("gosupplier").focus();
            $scope.glassorder = {
                ...$scope.glassorder,
                data: {
                    ...$scope.glassorder.data,
                    goproject: x.project_name
                }
            }
        }
    }
    get_projectinfo()
    function get_projectinfo() {
        let project_id = sessionStorage.getItem("nafco_project_current");
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
                
            } else {
                alert(res.data.data);
            }
        });
    }
    
    loadprojectglassorders();
    async function loadprojectglassorders() {
        const fd = eg.FormData();
        const pjid = sessionStorage.getItem("nafco_project_current_sno")
        fd.append("goproject", pjid);
        const res = await eg.getgo(fd);
        console.log(res);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        gridOptions.api.setRowData(res.data ?? []);
        $scope.$apply();
    }
    _hideallautocompleate();
    function _hideallautocompleate() {
        document.getElementById("budget_auto_projects").style.display = "none"
        document.getElementById("budget_auto_suppliers").style.display = "none"
        document.getElementById("budget_auto_glass").style.display = "none"

    }

    $scope.view_project_list = () => {
        _hideallautocompleate();
        _dia_project = "N";
        if ($scope.glassorder.mode === "N") {
            document.getElementById("budget_auto_projects").style.display = "block";
            document.getElementsByName("search_listed_project")[0].focus();
        }
        return;
    }

    $scope.view_supplier_list = () => {
        _hideallautocompleate();
        document.getElementById("budget_auto_suppliers").style.display = "block";
        document.getElementById("search_listed_supplier").focus();
    }

    $scope.supplier_list_search_input_change = ($event) => {
        let key = $event.which;
        //console.log(key);
        let length = $event.target.value.length;
        if (length < 1) {
            if (key === 8) {


                document.getElementById("budget_auto_suppliers").style.display = "none";
                document.getElementById("gosupplier").focus();
                return;

            }
        }
        if (key === 27) {
            document.getElementById("budget_auto_suppliers").style.display = "none";
            document.getElementById("gosupplier").focus();
            return;
        }
    }

    $scope.select_supplier = (x) => {
        console.log(x);
        $scope.selected_supplier = x;
        document.getElementById("budget_auto_suppliers").style.display = "none";
        document.getElementById("gono").focus();
        $scope.glassorder = {
            ...$scope.glassorder,
            data: {
                ...$scope.glassorder.data,
                gosupplier: x.glasssuppliername
            }
        }
        // $scope.budget = {
        //     ...$scope.budget,
        //     data: {
        //         ...$scope.budget.data,
        //         gbsupplier: x.glasssuppliername
        //     }
        // };
    }


    $scope.view_glass_list = () => {
        _hideallautocompleate();

        document.getElementById("budget_auto_glass").style.display = "block";
        document.getElementById("search_listed_glass").focus();

    }


    $scope.glass_list_search_input_change = ($event) => {
        let key = $event.which;
        //console.log(key);
        let length = $event.target.value.length;
        if (length < 1) {
            if (key === 8) {

                document.getElementById("budget_auto_glass").style.display = "none";
                document.getElementById("goglassspc").focus();
                return;

            }
        }
        if (key === 27) {
            document.getElementById("budget_auto_glass").style.display = "none";
            document.getElementById("goglassspc").focus();
            return;
        }
    }

    $scope.select_glass = (x) => {
        console.log(x);
        $scope.selected_glass = x;
        document.getElementById("budget_auto_glass").style.display = "none";
        document.getElementById("gomarkinglocation").focus();

        $scope.glassorder = {
            ...$scope.glassorder,
            data: {
                ...$scope.glassorder.data,
                goglasstype: x.glassdescriptoinstype,
                goglassspc: x.glassdescriptoinsspec,
                goglassthickness: x.gdesriptionsortfrm,
            }
        }
        // $scope.budget = {
        //     ...$scope.budget,
        //     data: {
        //         ...$scope.budget.data,
        //         gbudgetspc: x.glassdescriptoinsspec,
        //         gbudgetglasstype: x.glassdescriptoinstype,
        //         gbudgtickness: x.gdesriptionsortfrm,
        //     }
        // };

    }

    $scope.save_glassorder_submit = async () => {
        if ($scope.glassorder.isloading) {
            console.warn("Already Process Is Running...");
            return;
        }
        if ($scope.glassorder.mode === "N") {
            await _savego();
            return;
        }
        await _updatego();
        return;
    }
    let projectid = "";
    
    function govalidate() {
        const fd = eg.FormData();
        const goproject = document.getElementById("goproject");
        const gosupplier = document.getElementById("gosupplier");
        const gono = document.getElementById("gono");
        const godoneby = document.getElementById("godoneby");
        const goreldate = document.getElementById("goreldate");
        const goglassspc = document.getElementById("goglassspc");
        const goglasstype = document.getElementById("goglasstype");
        const goglassthickness = document.getElementById("goglassthickness");
        const gomarkinglocation = document.getElementById("gomarkinglocation");
        const goglassqty = document.getElementById("goglassqty");
        const gotype = document.getElementById("gotype");
        const gostatus = document.getElementById("gostatus");
       
        fd.append("gosupplier", gosupplier.value);
        fd.append("gono", gono.value);
        fd.append("godoneby", godoneby.value);
        fd.append("goreldate", goreldate.value);
        fd.append("goglassspc", goglassspc.value);
        fd.append("goglasstype", goglasstype.value);
        fd.append("goglassthickness", goglassthickness.value);
        fd.append("gomarkinglocation", gomarkinglocation.value);
        fd.append("goglassqty", goglassqty.value);
        fd.append("gotype", gotype.value);
        fd.append("gostatus", gostatus.value);
        if (gostatus.value === "ordered") {
            const gorcdate = document.getElementById("gorcdate");
            fd.append("gorcdate", gorcdate.value);
        }
        if ($scope.glassorder.mode === "E") {
            console.log(projectid);
            fd.append("goproject", projectid);
            fd.append("goid", $scope.glassorder.data.goid);
        } else {
            console.log($scope.selected_project);
            fd.append("goproject", $scope.selected_project.project_id);
        }
        const goremark = document.getElementById("goremark");    
        fd.append("goremark", goremark.value);       
        return fd;
    }
    async function _savego() {
        const fd = govalidate();
        if (fd === 0) {
            return;
        }
        $scope.glassorder = {
            ...$scope.glassorder,
            data: { ...$scope.glassorder.data },
            isloading: true,
        };
        const res = await eg.newgo(fd);
        if (res?.msg !== 1) {
            _msg(true, 'n', res.data);
            $scope.glassorder = {
                ...$scope.glassorder,
                data: { ...$scope.glassorder.data },
                isloading: false,
            };
            $scope.$apply();
            return;
        }

        _msg(true, 't', "Saved");
        $scope.glassorder = {
            ...$scope.glassorder,
            data: {
                ...$scope.glassorder.data,
                gono: "",
                godoneby: "",
                goglassspc: "",
                goglasstype: "",
                goglassthickness: "",
                gomarkinglocation : "",
                goglassqty: "",
                gostatus: "pending",
                gorcdate: "",
                goremark : "",
            },
            isloading: false,
        };
        gridOptions.api.setRowData(res?.data ?? []);
        $scope.$apply();
        return;
    }
    async function _updatego() {
        const fd = govalidate();
        if (fd === 0) {
            return;
        }
        $scope.glassorder = {
            ...$scope.glassorder,
            data: { ...$scope.glassorder.data },
            isloading: true,
        };
        const res = await eg.updatego(fd);
        if (res?.msg !== 1) {
            _msg(true, 'n', res.data);
            $scope.glassorder = {
                ...$scope.glassorder,
                data: { ...$scope.glassorder.data },
                isloading: false,
            };
            $scope.$apply();
            return;
        }

        _msg(true, 't', "Saved");
        $scope.glassorder = {
            ...$scope.glassorder,
            data: {
                ...$scope.glassorder.data,               
            },
            isloading: false,
        };
        gridOptions.api.setRowData(res?.data ?? []);
        $scope.$apply();
        return;
    }

    document.getElementById("dia_glassorders").style.display = "none";
    $scope.addnewgo = () => {
        _hideallautocompleate();
        $scope.glassorder = _emptyglassorder();
        document.getElementById("dia_glassorders").style.display = "flex";
    }

    $scope.editgo = async(id) => {
        if ($scope.glassorder.isloading) {
            console.log("Alread Process Is Running..");
            return;
        }        
        document.getElementById("dia_glassorders").style.display = "flex";
        $scope.glassorder = {
            ...$scope.glassorder,
            data : {...$scope.glassorder.data},
            isloading : true,
        }        
        _hideallautocompleate();
       
        const fd = eg.FormData();
        fd.append("goid", id);
        const res = await eg.getinfo(fd);
        if (res?.msg !== 1) {
            _msg(true, 'n', res.data);
            $scope.glassorder = _emptyglassorder();            
            $scope.$apply();
            return;
        }

        $scope.glassorder = {
            ...$scope.glassorder,
            data: {
                ...$scope.glassorder.data,
                goid : res.data.goid,
                gono : res.data.gono,
                godoneby : res.data.godoneby,
                goreldate : res.data.goreldate_n,
                gorcdate : res.data.gorcdate_n,
                gosupplier : res.data.gosupplier,
                goglasstype : res.data.goglasstype,
                goglassspc : res.data.goglassspc,
                goglassthickness : res.data.goglassthickness,
                gomarkinglocation : res.data.gomarkinglocation,
                goglassqty : res.data.goglassqty,
                goremark : res.data.goremark,
                gotype : res.data.gotype,
                goproject : res.data.project_name,
                gostatus : res.data.gostatus,
            },
            isloading: false,
            mode: "E",
            title: `Edit Glass Order ${res.data.gono}`,
            btn: "Update",
        }
        projectid = res.data.project_id;
        console.log(projectid);
        
        $scope.$apply();
    }


}


