// import _ from '../service/index.js';
import GEN from '../controllers/gen.js';
import _ from '../controllers/mtbl.js';
export default function mtbl_controller($scope, $compile) {
    //for calender
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
    //for calender
    //error msg
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
    //--change event
    //error msg 
    const dia_new_entry = document.getElementById("dia_new_entry");
    ///dia_new_entry.style.display = "none";
    const dia_load_rpt = document.getElementById("dia_load_rpt");
    //dia_load_rpt.style.display = "flex";
    dia_load_rpt.style.display = "none";
    $scope.add_new_mtbl = () => {
        $scope.mtbl = {
            isloading: false,
            title: "New Entry",
            btntitle: "Save",
            mode: "N",
            data: {
                pjcnoenc: "",
                loadid: "",
                loadproject: "",
                location: "",
                description: "",
                qty: "",
                unit: "",
                loadingdate: "",
                ascurrentdate: "",
                driver: "",
                status: "",
                remark: "",
                pjcno: "",
            }
        }
        dia_new_entry.style.display = "flex";
    }
    let _stdate = "";
    let _enddate = "";
    const gen = new GEN();
    const mc = new _();
    //grid options
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
    const columnDefs = mc.columns($scope, $compile);
    const gridOptions = mc.gridoptions(columnDefs);
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

    async function getAllSystems() {
        const fd = sc.FormData();
        const datas = await sc.getData(fd);
        gridOptions.api.setRowData(datas);
        // $scope.apply();
    }

    $scope.clearFilters = function () {
        gridOptions.columnApi.applyColumnState({
            defaultState: {
                sort: null,
            },
        });
        gridOptions.api.setFilterModel(null);
    }

    $scope.load_rpt_submit = async () => {
        if ($scope.mtblrpt.isloading) {
            console.log("Already Process is running");
            return;
        }
        const stdate = document.getElementById("stdate");
        const endate = document.getElementById("endate");
        if (stdate.value.trim() === "") {
            _msg(true, 'n', "Enter From Date");
            stdate.focus();
            return;
        }

        if (endate.value.trim() === "") {
            _msg(true, 'n', "Enter To Date");
            endate.focus();
            return;
        }

        _stdate = stdate.value;
        _enddate = endate.value;

        const fd = mc.FormData();
        fd.append("fromdate", _stdate);
        fd.append("todate", _enddate);

        await mc.getallrpt(fd, $scope, gridOptions);
        return;

    }

    $scope.exportExcel = function () {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {

            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();
            var mname = `System List`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: mname,
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }

    const gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    //grid options
    $scope.projects = [];
    $scope.uints = [];
    DefaltLoad();
    async function DefaltLoad() {
        const projects = gen.getAllProjects();
        const units = gen.getAllUnits();
        $scope.projects = await projects;
        $scope.units = await units;
        //$scope.$apply();
    }

    var sel_project_name = "";
    var sel_project_no = "";
    var sel_project_location = "";
    var sel_project_no_enc = "";
    $scope.show_project_finder = () => {
        document.getElementById("loadproject").setAttribute('readonly', true)
        console.log($scope.mtbl.mode)
        if ($scope.mtbl.mode !== "E") {
            document.getElementById("projectfilter").style.display = "block";
            document.getElementById("directive_project_search_input").focus();
        }
    }

    $scope.mtbl = {
        isloading: false,
        title: "New Entry",
        btntitle: "Save",
        mode: "N",
        data: {
            pjcnoenc: "",
            loadid: "",
            loadproject: "",
            location: "",
            description: "",
            qty: "",
            unit: "",
            loadingdate: "",
            ascurrentdate: "",
            driver: "",
            status: "",
            remark: "",
            pjcno: "",
        }
    }


    $scope.editrec = async (id) => {
        if ($scope.mtbl.isloading) {
            console.log("Already Porcess Is Running");
            return;
        }
        dia_new_entry.style.display = "flex";
        console.log(id);
        await mc.getinfo(id, $scope, _msg);
        return;
    }

    function select_project(x) {
        console.log(x);
        sel_project_name = x.project_name;
        sel_project_no = x.project_no;
        sel_project_location = x.project_location;
        sel_project_no_enc = x.projectenc
        $scope.mtbl = {
            ...$scope.mtbl,
            data: {
                ...$scope.mtbl.data,
                location: sel_project_location,
                loadproject: sel_project_name,
                pjcno: sel_project_no,
                pjcnoenc: sel_project_no_enc
            }
        }
        $scope.srcproject = "";
        document.getElementById("projectfilter").style.display = "none";
        document.getElementById("loadproject").setAttribute('readonly', true)
        document.getElementById("location").focus();
        return;
    }

    $scope.getinfoprojects = (x) => {
        select_project(x);
        return;
    }    

    $scope.project_select = ($event, x) => {
        if ($event.which === 13) {
            select_project(x);
            return;
        }
    }



    // $scope.project_filter_input_keydown = ($event) => {        
    //     if ($event.which === 27) {             
    //         document.getElementById("projectfilter").style.display = "none";

    //     }
    // }

    $scope.show_unitfilters = () => {
        document.getElementById("unitfilter").style.display = "block";
        document.getElementById("directive_unit_search_input").focus();
    }
    var sel_unit = "";

    $scope.listadd = _emptyListAdd();
    $scope.mtbllist = [];
    show_unitfilters

    $scope.select_unit = ($event, x) => {
        if ($event.which === 13) {
            sel_unit = x.unitname;
            $scope.listadd = {
                ...$scope.listadd,
                units: sel_unit
            }
            console.log($scope.listadd);
            document.getElementById("unitfilter").style.display = "none";
        }
    }
    
    function _emptyListAdd() {
        let listadd = {
            id : "",
            description: "",
            area: "",
            qty: "",
            units: "",
        };

        return listadd;
    }
    $scope.itemaddintolist = () => {
        console.log("woring");
        const _description = $scope.listadd.description;
        const _area = $scope.listadd.area;
        const _qty = $scope.listadd.qty;
        const _units = $scope.listadd.units;

        const _find = $scope.mtbllist.filter(x => x.description.toLowerCase() === _description.toLowerCase());
        if (_gridmode === "E") {
            $scope.mtbllist.map(i => {
                if (i.description.toLowerCase() === _description.toLowerCase()) {
                    const _description = $scope.listadd.description;
                    const _area = $scope.listadd.area;
                    const _qty = $scope.listadd.qty;
                    const _units = $scope.listadd.units;
                }
            })
        }
        if (_find.length === 0) {
            $scope.mtbllist.push({
                description: _description,
                area: _area,
                qty: _qty,
                units: _units,
            })
        } else {            
            $scope.mtbllist.map(i => {
                if (i.description.toLowerCase() === _description.toLowerCase()) {
                    let _xarea = (+i.area) + (+_area);
                    let _xqty = (+i.qty) + (+_qty);
                    i.qty = _xqty;
                    i.area = _xarea;
                }
            });
        }

        $scope.listadd = _emptyListAdd();

        document.getElementById("description").focus();
    }

    $scope.removeitem = (i) => {
        $scope.mtbllist.splice(i, 1);
    }   
    let _gridmode = "N";
    $scope.edititem = (i) => {
        const _description = i.description;
        const _area = i.area;
        const _qty = i.qty;
        const _units = i.units;
        $scope.listadd = {
            description: _description,
            area: _area,
            qty: _qty,
            units: _units,
        };
        _gridmode = "E";
        document.getElementById("description").focus();
    }
    // $scope.units_filter_input_keydown = ($event) => {
    //     if($event.which === 192) { document.getElementById("unitfilter").style.display = "none";  }
    // }
    // window.addEventListener("click", (e) => {
    //     if (e.target.id  === "projectfilter" && e.target.id === 'directive_project_search_input') {

    //     } 
    // })
    window.addEventListener("keydown", (e) => {
        console.log(e.which);
        switch (e.which) {
            case 27:
                switch (e.target.id) {
                    default: return;
                    case 'directive_project_search_input':
                        // console.log("called");
                        document.getElementById("projectfilter").style.display = "none";
                        break;;
                    case 'directive_unit_search_input':
                        document.getElementById("unitfilter").style.display = "none";
                        break;;
                }
                break;
            case 40:
                switch (e.target.id) {
                    default: return;
                    case 'directive_unit_search_input':
                        document.getElementById("unit_list_1").focus();
                        break;                    
                }
                break;
                
        }
        

    })



    $scope.save_new_mtbl_submit = async () => {
        if ($scope.mtbl.isloading) {
            console.log("Already Process Is Running..");
            return;
        }

        if ($scope.mtbl.mode === "N") {
            await SaveActions();
        } else {
            await UpdateActions();
        }
    }

    async function SaveActions() {
        //validate
        const fd = mc.formvalidate(_msg);
        if (fd === 0) {
            return;
        }
        if ($scope.listadd.length === 0) {
            _msg(true, "n", "Enter Items");
            return;
        }
        fd.append("items",JSON.stringify($scope.mtbllist))
        fd.append("pjcno", sel_project_no);
        fd.append("pjcnoenc", sel_project_no_enc);
        fd.append("fromdate", _stdate);
        fd.append("todate", _enddate);
        
        await mc.Save(fd, _msg, $scope, gridOptions);

        return;
    }

    async function UpdateActions() {
        console.log($scope.mtbl.data.pjcnoenc)
        const fd = mc.formvalidate();
        fd.append("pjcno", $scope.mtbl.data.pjcno);
        fd.append("pjcnoenc", $scope.mtbl.data.pjcnoenc);
        fd.append("fromdate", _stdate);
        fd.append("todate", _enddate);
        fd.append("loadid", $scope.mtbl.data.loadid);
        await mc.update(fd, $scope, _msg, gridOptions);
        return;
    }

    //grid work start

    //grid work end
    $scope.projectmat = {
        isloading: false,
        data: [],
        title: "",
    }



    const dia_load_rptproject = document.getElementById("dia_load_rptproject")
    dia_load_rptproject.style.display = "none";
    $scope.materialssummarydata = [];
    $scope.getprojectsinfos = async (pjcno, pno) => {
        $scope.materialssummarydata = [];
        if ($scope.projectmat.isloading) {
            console.log("Already Process is Running..");
            return;
        }

        $scope.projectmat = {
            ...$scope.projectmat,
            data: [...$scope.projectmat.data],
            title: `${pjcno}-[${pno}]`
        }
        dia_load_rptproject.style.display = "flex";
        const fd = mc.FormData();
        fd.append("loadproject", pjcno);
        await mc.rptbyproject(fd, $scope);

        console.log(pjcno);

    }
    //const dia_load_rpt = document.getElementById("dia_load_rpt");
    $scope.loadrpt = () => {
        dia_load_rpt.style.display = "flex";
    }

    $scope.materialssummary = false;
    $scope.changedisplaymodesummary = () => {

        if ($scope.materialssummary) {
            $scope.materialssummary = false;
        } else {
            $scope.materialssummary = true;
        }
    }
    $scope.logs = {
        isloading: false,
        data: []
    };
    document.getElementById("dia_load_rptproject_logs").style.display = "none";
    $scope.loadprevious = async (id) => {
        console.log
        if ($scope.isloading) {
            console.log("Already Process Is Running");
            return;
        }
        document.getElementById("dia_load_rptproject_logs").style.display = "flex";
        const fd = mc.FormData();
        fd.append("loadid", id);
        await mc.getlog(fd, $scope);
        return;
    }

    $scope.printrpt = () => {
        let data = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(i => {
            data.push(i.data);
        })
        console.log(data);
        const m = JSON.stringify(data)
        localStorage.removeItem("pms_ism_new_print");
        localStorage.setItem("pms_ism_new_print", m);
        window.open(`${print_location}fprint/#!/`, "_blank", "height:500px,width:1200px");
    }

    $scope.printsummary = () => {
        const _mode = $scope.materialssummary ? "s" : "l";
        const _data = $scope.materialssummary ? $scope.materialssummarydata : $scope.projectmat.data;
        const _selecteproject = $scope.projectmat.title;
        localStorage.removeItem("pms_ism_summary_mode");
        localStorage.removeItem("pms_ism_summary_data");
        localStorage.removeItem("pms_ism_summary_title");

        localStorage.setItem("pms_ism_summary_mode", _mode);
        localStorage.setItem("pms_ism_summary_data", JSON.stringify(_data));
        localStorage.setItem("pms_ism_summary_title", _selecteproject);
        window.open(`${print_location}fprint/#!/materialsummary`, "_blank", "height:600px,width:1200px");
    }

}