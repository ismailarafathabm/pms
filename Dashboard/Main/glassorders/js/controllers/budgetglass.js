import BudgetGlassService from "../services/budgetglass.js";
export default function budgetglass($scope, $http, $rootScope, $compile, $filter) {
    $scope.autoglass = [];
    let _type = "1";
    const bgs = new BudgetGlassService();
    $scope.access = {};
    glassall();
    async function glassall() {
        const res = await bgs.glassautocompleate();
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        $scope.autoglass = res.data;
        $scope.$apply();
        return;
    }
    //display project information on top
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
                console.log($scope.viewproject);
                $scope.newproject = res.data.data;

            } else {
                alert(res.data.data);
            }
        });
    }
    //
  
    console.log('working');
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
    //grid actions
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
    const username = userinfo.user_name;
    console.log(username);
    const editbuttonusers = ['demo', 'nimnim', 'estimations', 'estimation'];
    const addbuttonusers = ['demo', 'nimnim', 'estimations', 'estimation'];
    const printbuttonusers = ['demo', 'nimnim', 'estimations', 'estimation', 'sam', 'AbuZaid', 'nabil', 'hani'];
    
    $scope.access = {
        editbutton: editbuttonusers.includes(username),
        newbutton: addbuttonusers.includes(username),
        printbutton: printbuttonusers.includes(username),  
    }

    console.log($scope.access);

    const columnDefs = bgs.colsdef($scope, $compile, $scope.access);
    const gridOptions = bgs.gridoptions(columnDefs);

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
    $scope.isrptloading = false;
    getData();
    $scope.sum = {
        cost: 0,
        area: 0
    };
    async function getData() {
        if ($scope.isrptloading) {
            console.log("Another Process Is Running");
            return;
        }
        $scope.isrptloading = true;
        const fd = bgs.FormData();
        fd.append("bgprojectid", sessionStorage.getItem('nafco_project_current_sno'));
        const res = await bgs.allglassbudgetbyproject(fd)
        if (res?.msg !== 1) {
            $scope.isrptloading = false;
            alert(res.data);
            gridOptions.api.setRowData([]);
            $scope.$apply();
            return;
        }
        $scope.isrptloading = false;
        gridOptions.api.setRowData(res.data ?? []);
        let _area = 0;
        let _sarea = 0;
        let _total = 0;
        let _stotal = 0;
        res.data.map(i => {
            _area += (+i.bgarea);
            _sarea += (+i.bgshapedarea);
            _total += (+i.bgtotalcost);
            _stotal += (+i.bgshapedtotalcost);
        })
        let atotal = (+_area) + (+_sarea);
        let ctotal = (+_total) + (+_stotal);
        $scope.sum = {
            cost: Math.round(ctotal),
            area: Math.round(atotal),
        };
        $scope.$apply();
        return;
    }

    
    $scope.newglassbudget = {
        isloading: false,
        mode: "N",
        title: "Add New Glass Budget",
        btn: "Save",
        data: {
            bgid: "",
            bgglass: "",
            bgarea: "",
            bgcost: "",
            bgtotalcost: "",
            bgshapedarea: "",
            bgshapedcost: "",
            bgshapedtotalcost: "",
            bgprojectid: sessionStorage.getItem('nafco_project_current_sno'),
            bgrevisionno: "",
            gbudgetglassno : "",
        }
    }

    function glassnewbudget() {
        $scope.newglassbudget = {
            ...$scope.newglassbudget,
            isloading: false,
            mode: "N",
            title: "Add New Glass Budget",
            btn: "Save",
            data: {
                ...$scope.newglassbudget.data,
                bgid: "",
                bgglass: "",
                bgarea: "",
                bgcost: "",
                bgtotalcost: "",
                bgshapedarea: "",
                bgshapedcost: "",
                bgshapedtotalcost: "",
                bgprojectid: sessionStorage.getItem('nafco_project_current_sno'),
                bgrevisionno: "",
                gbudgetglassno : "",
            }
        }
        document.getElementById("dia_glass_budget").style.display = "flex";
    }
    document.getElementById("dia_glass_budget").style.display = "none";
    $scope.addnewgobudget = () => {
        _type = "1";
        glassnewbudget();
        
    }
    $scope.addnewgobudgets = () => {
        _type = "2";
        glassnewbudget();
        
    }
    $scope.save_budgetglass_submit = async () => {
        if ($scope.newglassbudget.isloading) {
            console.log("Already Running this Process");
            return;
        }

        if ($scope.newglassbudget.mode === "N") {
            await _addnew();
            return;
        }

        await _update();
        return;
    }


    
    async function _addnew() {
        const fd = bgs.FormData();
        fd.append("bgglass", $scope.newglassbudget.data.bgglass);
        fd.append("bgarea", $scope.newglassbudget.data.bgarea);
        fd.append("bgcost", $scope.newglassbudget.data.bgcost);
        fd.append("bgtotalcost", $scope.newglassbudget.data.bgtotalcost);
        fd.append("bgshapedarea", $scope.newglassbudget.data.bgshapedarea);
        fd.append("bgshapedcost", $scope.newglassbudget.data.bgshapedcost);
        fd.append("bgshapedtotalcost", $scope.newglassbudget.data.bgshapedtotalcost);
        fd.append("bgprojectid", $scope.newglassbudget.data.bgprojectid);
        fd.append("gbudgetglassno", $scope.newglassbudget.data.gbudgetglassno);
        fd.append("bgtype", _type);
        fd.append("bgcode", $scope.newglassbudget.data.bgcode);
        $scope.newglassbudget = {
            ...$scope.newglassbudget,
            data: { ...$scope.newglassbudget.data },
            isloading: true,
        };
        const res = await bgs.addglassbudgetbyproject(fd);
        if (res?.msg !== 1) {
            $scope.newglassbudget = {
                ...$scope.newglassbudget,
                data: { ...$scope.newglassbudget.data },
                isloading: false,
            };
            _msg(true, 'n', res.data);
            $scope.$apply();
            return;
        }
        _msg(true, 't', "Data has saved");
        $scope.newglassbudget = {
            ...$scope.newglassbudget,
            data: {
                ...$scope.newglassbudget.data,
                bgid: "",
                bgglass: "",
                bgarea: "",
                bgcost: "",
                bgtotalcost: "",
                bgshapedarea: "",
                bgshapedcost: "",
                bgshapedtotalcost: "",
                bgrevisionno: "",
                gbudgetglassno : "",
            },
            isloading: false,
        };
        gridOptions.api.setRowData(res.data ?? []);
        $scope.$apply();
        document.getElementById("gbudgetglassno").focus();
        return;
    }

    async function _update() {
        const fd = bgs.FormData();
        fd.append("bgglass", $scope.newglassbudget.data.bgglass);
        fd.append("bgarea", $scope.newglassbudget.data.bgarea);
        fd.append("bgcost", $scope.newglassbudget.data.bgcost);
        fd.append("bgtotalcost", $scope.newglassbudget.data.bgtotalcost);
        fd.append("bgshapedarea", $scope.newglassbudget.data.bgshapedarea);
        fd.append("bgshapedcost", $scope.newglassbudget.data.bgshapedcost);
        fd.append("bgshapedtotalcost", $scope.newglassbudget.data.bgshapedtotalcost);
        fd.append("bgprojectid", $scope.newglassbudget.data.bgprojectid);
        fd.append("gbudgetglassno", $scope.newglassbudget.data.gbudgetglassno);
        fd.append("bgid", $scope.newglassbudget.data.bgid);
        fd.append("bgcode", $scope.newglassbudget.data.bgcode);
        $scope.newglassbudget = {
            ...$scope.newglassbudget,
            data: { ...$scope.newglassbudget.data },
            isloading: true,
        };
        const res = await bgs.updateglassbudget(fd);
        if (res?.msg !== 1) {
            $scope.newglassbudget = {
                ...$scope.newglassbudget,
                data: { ...$scope.newglassbudget.data },
                isloading: false,
            };
            _msg(true, 'n', res.data);
            $scope.$apply();
            return;
        }
        _msg(true, 't', "Data has Updated");
        $scope.newglassbudget = {
            ...$scope.newglassbudget,
            data: { ...$scope.newglassbudget.data },
            isloading: false,
        };
        gridOptions.api.setRowData(res.data ?? []);
        $scope.$apply();

    }

    $scope.excelexport = () => {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();
            var mname = `PROJECT LIST AS ON DATE ${day}-${month}-${year}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }

    $scope.calcactions = () => {
        console.log( document.getElementById("bgcost").value.trim() )
        let bgarea = document.getElementById("bgarea").value.trim() === "" ? 0 :  document.getElementById("bgarea").value;
        let bgcost = document.getElementById("bgcost").value.trim() === "" ? 0 :  document.getElementById("bgcost").value;
        let bgtotalcost = (+bgarea) * (+bgcost);
        console.log("area",bgarea, bgcost, bgtotalcost);

        let bgshapedarea = document.getElementById("bgshapedarea").value.trim() === "" ? 0 :  document.getElementById("bgshapedarea").value;
        let bgshapedcost =  document.getElementById("bgshapedcost").value.trim() === "" ? 0 :  document.getElementById("bgshapedcost").value;
        let bgshapedtotalcost = (+bgshapedarea) * (+bgshapedcost);
        console.log("shaped area",bgshapedarea, bgshapedcost, bgshapedtotalcost);

        $scope.newglassbudget = {
            ...$scope.newglassbudget,
            data: {
                ...$scope.newglassbudget.data,
                bgtotalcost: Math.round(bgtotalcost),
                bgshapedtotalcost: Math.round(bgshapedtotalcost),
            }
        };
    }
    
    $scope.printrpt = () => {
        localStorage.removeItem("pms_budget_summary_print");
        localStorage.removeItem("pms_budget_summary_project");
        let printdata = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(i => {
            printdata.push(i.data);
        });
        let prj = $scope.viewproject;
        localStorage.setItem("pms_budget_summary_print", JSON.stringify(printdata));
        localStorage.setItem("pms_budget_summary_project", JSON.stringify(prj));
        window.open(`${print_location}/fprint/#!/budgetglass`, "_blank", "width:1200px;height:500px");
    }

    function _successgetting(data) {
        _type = data.bgtype
        console.log(data);
        $scope.newglassbudget = {
            ...$scope.newglassbudget,
            data: {
                ...$scope.newglassbudget,
                bgid: data.bgid,
                bgglass: data.bgglass,
                bgarea: data.bgarea,
                bgcost: data.bgcost,
                bgtotalcost: data.bgtotalcost,
                bgshapedarea: data.bgshapedarea,
                bgshapedcost: data.bgshapedcost,
                bgshapedtotalcost: data.bgshapedtotalcost,
                bgprojectid: data.bgprojectid,
                bgrevisionno: data.bgrevisionno,
                gbudgetglassno: data.gbudgetglassno,
                bgcode : data.bgcode,
            },
            title: "Edit Glass Budget",
            btn: "Update",
            mode : "E",
            isloading: false
        };
    }

    function _errorgetting(_status) {
        $scope.newglassbudget = {
            ...$scope.newglassbudget,
            data: {
                ...$scope.newglassbudget,
                bgid: "",
                bgglass: "",
                bgarea: "",
                bgcost: "",
                bgtotalcost: "",
                bgshapedarea: "",
                bgshapedcost: "",
                bgshapedtotalcost: "",
                bgprojectid: sessionStorage.getItem('nafco_project_current_sno'),
                bgrevisionno: "",
                gbudgetglassno: "",
            },
            isloading: _status,
            mode : "E",
        };
    }
    $scope.editglassbudget = async (id) => {
        if ($scope.newglassbudget.isloading) {
            console.log("Already Another Process Is Running");            
            return;
        }
        document.getElementById("dia_glass_budget").style.display = "flex";
        _errorgetting(true);
        const fd = bgs.FormData();
        fd.append('bgid', id);
        const res = await bgs.getglass(fd);
        if (res?.msg !== 1) {
            _errorgetting(false);
            _msg(true, 'n', res.data);
            $scope.$apply();
            return;
        }

        _successgetting(res.data);
        $scope.$apply();
        return;


    }

}