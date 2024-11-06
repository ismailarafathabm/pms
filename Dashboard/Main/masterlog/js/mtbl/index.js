import GEN from '../controllers/gen.js';
import _ from '../controllers/mtbl.js';
export default function mtbl_controller($scope, $compile) {
    document.getElementById("project_materialtobeload").classList.add('menuactive');
    //for calender
    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian'
    };
    const itemlist = document.getElementById("itemlist");
    itemlist.style.display = "none";
    
    const itemlistmain = document.getElementById("itemlistmain");
    itemlistmain.style.display = "none";

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
    // error message

    //initialize
    const gen = new GEN();
    const mc = new _();
    
    _getDates();
    async function _getDates() {
        $scope.mtblrpt = {
            ...$scope.mtblrpt,
            data : {...$scope.mtblrpt},
            isloading: true,            
        }
        const res = await gen.getdates();
        // const stdate = document.getElementById("stdate");
        // const endate = document.getElementById("endate");
        // stdate.value = res.data.fday;
        // endate.value = res.data.fd;
        $scope.mtblrpt = {
            isloading : false,
            data: {
                stdate: res.data.fday,
                endate: res.data.fd,
            }
        };
        $scope.$apply();
        console.log(res);
    }
    const dia_new_entry = document.getElementById("dia_new_entry");
    dia_new_entry.style.display = "none";
    const dia_load_rpt = document.getElementById("dia_load_rpt");
    const dia_load_rptproject = document.getElementById("dia_load_rptproject")
    dia_load_rptproject.style.display = "none";
    const dia_load_rptproject_logs = document.getElementById("dia_load_rptproject_logs");
    dia_load_rptproject_logs.style.display = "none";
    const dia_edit_entry = document.getElementById("dia_edit_entry");
    dia_edit_entry.style.display = "none";
    $scope.materialssummarydata = [];
    $scope.driverlist = [];
    let _stdate = "";
    let _enddate = "";
    const gridDiv = document.querySelector('#myGrid');
    $scope.projectmat = {
        isloading: false,
        data: [],
        title: "",
    }
    $scope.logs = {
        isloading: false,
        data: []
    };
    $scope.mtbl = _emptymbt();

    $scope.projects = [];
    $scope.uints = [];
    let listitems = {
        id: "",
        description: "",
        area: "",
        qty: "",
        units: ""
    };
    //initialze
    DefaltLoad();
    async function DefaltLoad() {
        const projects = gen.getAllProjects();
        const units = gen.getAllUnits();
        $scope.projects = await projects;
        $scope.units = await units;
        //$scope.$apply();
    }


    $scope.loadrpt = () => {
        dia_load_rpt.style.display = "flex";
    }
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
    $scope.changedisplaymodesummary = () => {

        if ($scope.materialssummary) {
            $scope.materialssummary = false;
        } else {
            $scope.materialssummary = true;
        }
    }
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

    ///gird
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
    const columnDefs = mc.columns($scope, $compile,"A");
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


    new agGrid.Grid(gridDiv, gridOptions);




    //key event

    window.addEventListener("keydown", (e) => {
        console.log(e.which);
        switch (e.which) {
            case 27:
                switch (e.target.id) {
                    default: return;
                    case 'directive_project_search_input':
                        // console.log("called");
                        document.getElementById("projectfilters").style.display = "none";
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
    //Add And Edit
    function _emptymbt() {
        let mtbl_inputs = {
            isloading: false,
            title: "New Entry",
            btntitle: "Save",
            mode: "N",
            data: {
                pjcnoenc: "",
                loadid: "",
                loadproject: "",
                location: "",
                estimatedate: "",
                loadingdate: "",
                estimatetositedate: "",
                ascurrentdate: "",
                driver: "",
                status: "",
                remark: "",
                pjcno: "",
                invno: "",
            },
            listadd: {
                btntitle: "Add",
                mode: "N",
                data: {
                    id: "",
                    cuttinglistno: "",
                    mattype: "",
                    description: "",
                    area: "",
                    qty: "",
                    units: ""
                }
            },
            mtbllist: []
        };
        return mtbl_inputs;
    }
    $scope.add_new_mtbl = () => {
        $scope.mtbl = _emptymbt();
        dia_new_entry.style.display = "flex";
    }

    var sel_project_name = "";
    var sel_project_no = "";
    var sel_project_location = "";
    var sel_project_no_enc = "";
    document.getElementById("projectfilters").style.display = "none";
    $scope.show_project_finder = () => {
        document.getElementById("loadproject").setAttribute('readonly', true)
        console.log($scope.mtbl.mode)
        if ($scope.mtbl.mode !== "E") {
            document.getElementById("projectfilters").style.display = "block";
            document.getElementById("projectfilter").style.display = "block";
            document.getElementById("directive_project_search_input").focus();
        }
    }

    function select_project(x) {
        console.log(x);
        sel_project_name = x.project_name;
        sel_project_no = x.project_no;
        sel_project_location = x.project_location;
        sel_project_no_enc = x.projectenc
        $scope.mtbl = {
            ...$scope.mtbl,
            mtbllist: [...$scope.mtbl.mtbllist],
            listadd: {
                ...$scope.mtbl.listadd,
                data: { ...$scope.mtbl.listadd.data },
            },
            data: {
                ...$scope.mtbl.data,
                location: sel_project_location,
                loadproject: sel_project_name,
                pjcno: sel_project_no,
                pjcnoenc: sel_project_no_enc
            },

        }
        $scope.srcproject = "";
        document.getElementById("projectfilters").style.display = "none";
        document.getElementById("projectfilters").style.display = "none";
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

    $scope.show_unitfilters = () => {
        document.getElementById("unitfilter").style.display = "block";
        document.getElementById("directive_unit_search_input").focus();
    }
    var sel_unit = "";
    $scope.getunitinfo = (x) => {
        sel_unit = x.unitname;
        $scope.mtbl = {
            ...$scope.mtbl,
            data: {
                ...$scope.mtbl.data,
            },
            mtbllist: [...$scope.mtbl.mtbllist],
            listadd: {
                ...$scope.mtbl.listadd,
                data: {
                    ...$scope.mtbl.listadd.data,
                    units: sel_unit
                },
            },
        };

        $scope.mtblinfo = {
            ...$scope.mtblinfo,
            data: {
                ...$scope.mtbl.data,
                unit: sel_unit
            }
        };

        console.log($scope.mtbl);
        document.getElementById("unitfilter").style.display = "none";
        // document.getElementById("loadingdate").focus();
    }
    $scope.changeuniteditinfo = () => {
        document.getElementById("unitfilter").style.display = "block";
        document.getElementById("directive_unit_search_input").focus();
    }
    $scope.itemaddintolist = () => {
        if ($scope.mtbl.listadd.mode === "E") {
            _updateitem();
            return;
        }
        _addToList();
        return;

    }

    function _updateitem() {
        let id = $scope.mtbl.listadd.data.id;
        let _cuttinglistno = document.getElementById("cuttinglistno");
        let _mattype = document.getElementById("mattype");
        let _description = document.getElementById("description");
        let _area = document.getElementById("area");
        let _qty = document.getElementById("qty");
        let _units = document.getElementById("units");
        console.log(_units);
        if (_mattype.value.trim() === "") {
            _msg(true, "n", "Enter Type");
            _mattype.focus();
            return;
        }
        if (_description.value.trim() === "") {
            _msg(true, "n", "Enter Descripton");
            _description.focus();
            return;
        }
        if (_cuttinglistno.value.trim() === "") {
            _msg(true, "n", "Enter Cutting list Number");
            _cuttinglistno.focus();
            return;
        }
        if (_area.value.trim() === "") {
            _msg(true, "n", "Enter Area");
            _area.focus();
            return;
        }
        if (_qty.value.trim() === "") {
            _msg(true, "n", "Enter Qty");
            _qty.focus();
            return;
        }
        if (_units.value.trim() === "") {
            _msg(true, "n", "Enter Units");
            _units.focus();
            return;
        }
        let xunits = _units.value.trim().toLowerCase();
        if (xunits === "sqm" || xunits === "lm") {
            if (_area.value === "0") {
                _area.focus();
                _msg(true, "n", "Enter Area value");
                return;
            }
        }
        $scope.mtbl.mtbllist.map(i => {
            if (i.id === id) {
                i.cuttinglistno = _cuttinglistno.value.trim(),
                    i.mattype = _mattype.value.trim();
                i.description = _description.value.trim();
                i.area = _area.value.trim();
                i.qty = _qty.value.trim();
                i.units = _units.value.trim();
            }
        });


        $scope.mtbl = {
            ...$scope.mtbl,
            mtbllist: [...$scope.mtbl.mtbllist],
            listadd: {
                ...$scope.mtbl.listadd,
                btntitle: "Add",
                mode: "N",
                data: {
                    id: "",
                    description: "",
                    area: "",
                    qty: "",
                    units: ""
                },
            },
            data: {
                ...$scope.mtbl.data,
                location: sel_project_location,
                loadproject: sel_project_name,
                pjcno: sel_project_no,
                pjcnoenc: sel_project_no_enc
            },

        }
        return;
    }

    function _addToList() {
        let _cuttinglistno = document.getElementById("cuttinglistno");
        let _mattype = document.getElementById("mattype");
        let _description = document.getElementById("description");
        let _area = document.getElementById("area");
        let _qty = document.getElementById("qty");
        let _units = document.getElementById("units");
        console.log(_units);
        if (_mattype.value.trim() === "") {
            _msg(true, "n", "Enter Type");
            _mattype.focus();
            return;
        }
        if (_description.value.trim() === "") {
            _msg(true, "n", "Enter Descripton");
            _description.focus();
            return;
        }
        if (_cuttinglistno.value.trim() === "") {
            _msg(true, "n", "Enter Cutting list Number");
            _cuttinglistno.focus();
            return;
        }
        if (_area.value.trim() === "") {
            _msg(true, "n", "Enter Area");
            _area.focus();
            return;
        }
        if (_qty.value.trim() === "") {
            _msg(true, "n", "Enter Qty");
            _qty.focus();
            return;
        }
        if (_units.value.trim() === "") {
            _msg(true, "n", "Enter Units");
            _units.focus();
            return;
        }
        let xunits = _units.value.trim().toLowerCase();
        if (xunits === "sqm" || xunits === "lm") {
            if (_area.value === "0") {
                _area.focus();
                _msg(true, "n", "Enter Area value");
                return;
            }
        }
        listitems = {
            id: "",
            cuttinglistno: _cuttinglistno.value.trim(),
            mattype: _mattype.value.trim(),
            description: _description.value.trim(),
            area: _area.value.trim(),
            qty: _qty.value.trim(),
            units: _units.value.trim(),
            _check: true
        };
        let oldlist = $scope.mtbl.mtbllist;
        oldlist.push(listitems);
        console.log(oldlist);
        $scope.mtbl = {
            ...$scope.mtbl,
            data: { ...$scope.mtbl.data },
            mtbllist: oldlist,
            listadd: {
                btntitle: "Add",
                mode: "N",
                data: {
                    cuttinglistno: "",
                    mattype: "",
                    description: "",
                    area: "",
                    qty: "",
                    units: ""
                }
            }
        }
        $scope.mtbl.mtbllist.map((i, index) => {
            i.id = index + 1;
        });
        console.log($scope.mtbl);
    }
    $scope.removeitem = (i) => {
        $scope.mtbl.mtbllist.splice(i, 1);
    }
    $scope.edititem = (x) => {
        $scope.mtbl = {
            ...$scope.mtbl,
            mtbllist: [...$scope.mtbl.mtbllist],
            data: { ...$scope.mtbl.data },
            listadd: {
                ...$scope.mtbl.listadd,
                data: {
                    id: x.id,
                    cuttinglistno: x.cuttinglistno,
                    mattype: x.mattype,
                    description: x.description,
                    area: x.area,
                    qty: x.qty,
                    units: x.units,
                },
                btntitle: "Update",
                mode: "E",
            },
        };
    }

    //Add And Edit
    ///database action
    $scope.save_new_mtbl_submit = async () => {
        if ($scope.mtbl.isloading) {
            console.log("Another Process is Running....");
            return;
        }
        if ($scope.mtbl.mode === "N") {
            await _save();
            return;
        }
        _update();
        return;
    }

    async function _save() {
        const fd = mc.formvalidate();
        if (fd === 0) {
            return;
        }
        if ($scope.mtbl.mtbllist.length === 0) {
            _msg(true, "n", "Enter Items");
            return;
        }

        fd.append("items", JSON.stringify($scope.mtbl.mtbllist))
        fd.append("pjcno", sel_project_no);
        fd.append("pjcnoenc", sel_project_no_enc);
        fd.append("fromdate", _stdate);
        fd.append("todate", _enddate);
        await mc.Save(fd, _msg, $scope, gridOptions, _emptymbt);
        return;
    }
    async function _update() {
        const fd = mc.formvalidate();
        if (fd === 0) {
            return;
        }

        let _savedata = [];
        $scope.mtbl.mtbllist.map(i => {
            if (i._check) {
                _savedata.push({
                    id: i.id,
                    description: i.description,
                    area: i.area,
                    qty: i.qty,
                    units: i.units,
                })
            }
        })
        fd.append("pjcno", $scope.mtbl.data.pjcno);
        fd.append("pjcnoenc", $scope.mtbl.data.pjcnoenc);
        fd.append("fromdate", _stdate);
        fd.append("todate", _enddate);
        fd.append("items", JSON.stringify(_savedata));
        fd.append("invno", $scope.mtbl.data.invno)
        await mc.updateAll(fd, $scope, _msg, gridOptions, _emptymbt);
        document.getElementById("location").removeAttribute('readonly');
    }
    $scope.save_new_mtblinfo_submit = async () => {
        if ($scope.mtblinfo.isloading) {
            console.log("Already Process is Running..."); return;
        }
        singleupdate();
    }

    async function singleupdate() {
        const fd = mc.checksingleupdatefrmdata();
        if (fd === 0) {
            return;
        }
        const single_unit = document.getElementById("single_unit");
        const single_area = document.getElementById("single_area");
        if (single_unit.value.toLowerCase() === "sqm" || single_unit.value.toLowerCase() === "lm") {
            if (single_area.value === "0") {
                _msg(true, 'n', "Enter Area value");
                return;
            }
        }
        fd.append("pjcno", $scope.mtblinfo.data.pjcno);
        fd.append("pjcnoenc", $scope.mtblinfo.data.pjcnoenc);
        fd.append("fromdate", _stdate);
        fd.append("todate", _enddate);
        fd.append("loadid", $scope.mtblinfo.data.loadid)
        fd.append("invno", $scope.mtblinfo.data.invno);

        await mc.update(fd, $scope, _msg, gridOptions);
    }
    //data base actions
    //get infos
    //with token
    $scope.getinfowithtoken = async (token) => {
        if ($scope.mtbl.isloading) {
            console.log("Another Process is running");
            return;
        }
        dia_new_entry.style.display = "flex";
        const fd = mc.FormData();
        fd.append('loadid', token);
        await mc.getinfotoken(fd, $scope, _msg);
    }
    //get with id
    function _emptyinfomtbl() {
        const _mtblinfo = {
            title: 'Edit',
            btntitle: "Update",
            isloading: false,
            data: {
                pjcnoenc: "",
                loadid: "",
                loadproject: "",
                location: "",
                estimatedate: "",
                loadingdate: "",
                estimatetositedate: "",
                ascurrentdate: "",
                driver: "",
                status: "",
                remark: "",
                pjcno: "",
                invno: "",
                description: "",
                area: "",
                qty: "",
                units: "",
                mattype: "",
                matunit: "",
                cuttinglistno: "",
                mattype: "",
                cuttinglistno : "",

            }
        }
        return _mtblinfo;
    }
    $scope.mtblinfo = _emptyinfomtbl();
    $scope.edititeminfos = async (id) => {
        dia_edit_entry.style.display = "flex";
        await mc.getinfo(id, $scope, _msg);
    }
    //remove 
    let load_delete = false;
    $scope.removemtblitems = async (id) => {
        _delete(id);
    }
    $scope.removeItems = (id) => {
        _delete(id);
    }
    async function _delete(id) {
        if (load_delete) {
            console.log("Another Process Is Running...");
            return;
        }
        let c = confirm("Are You Sure Remove this Data?");
        if (!c) {
            return;
        }
        load_delete = true;
        const fd = mc.FormData();
        fd.append("fromdate", _stdate);
        fd.append("todate", _enddate);
        fd.append("loadid", id);
        const res = await mc.Remove(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            load_delete = false;
            return;date

        }
        dia_edit_entry.style.display = "none";
        alert("Removed");
        load_delete = false;
        gridOptions.api.setRowData(res.data ?? []);
        $scope.$apply();
        return;
    }
    //remove 
    //print
    Date.prototype.getWeek = function () {
        var date = new Date(this.getTime());
        date.setHours(0, 0, 0, 0);
        // Thursday in current week decides the year.
        date.setDate(date.getDate() + 3 - (date.getDay() + 6) % 7);
        // January 4 is always in week 1.
        var week1 = new Date(date.getFullYear(), 0, 4);
        // Adjust to Thursday in week 1 and count number of weeks from date to week1.
        return 1 + Math.round(((date.getTime() - week1.getTime()) / 86400000
            - 3 + (week1.getDay() + 6) % 7) / 7);
    }
    function _datecreate(x) {
        let _d = x.split("-");
        let _date = _d[0];
        let _month = _d[1];
        let _year = _d[2];
        let fdate = new Date(`${_year}-${_month}-${_date}`);
        return fdate;
    }
    $scope.printrpt = () => {
        let data = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(i => {
            data.push(i.data);
        })
        console.log(data);
        const m = JSON.stringify(data)
        localStorage.removeItem("pms_ism_new_print");
        localStorage.removeItem("pagetitle");
        localStorage.setItem("pms_ism_new_print", m);
        let ndate = _datecreate(_stdate);
        let weekno = ndate.getWeek();
        const title = `Materials to be Loaded Week No# ${weekno} [From : ${_stdate} To : ${_enddate}]`
        console.log(title);
        localStorage.setItem("pagetitle", title);
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

    $scope.itemlist = [];
    LoadItems();
    async function LoadItems() {
        const res = await gen.getAllitems();
        if (res.msg !== 1) {
            alert(res.data);
            return;
        }
        $scope.itemlist = res.data ?? [];
        $scope.$apply();
        return;
    }
    let itemmode = "N";
    $scope.show_itemfilters = () => {
        itemmode = "N";
        document.getElementById("itemlistmain").style.display = "block";        
        document.getElementsByName("directive_item_search_inputs")[0].focus();
    }

    $scope.show_itemfilterss = () => {
        itemmode = "E";        
        document.getElementById("itemlist").style.display = "block";
        document.getElementsByName("directive_item_search_inputs")[1].focus();        
    }

    $scope.items_filter_input_keydown = ($event) => {
        const keycode = $event.which
        if (keycode === 27) {
            if (itemmode === 'N') {
                document.getElementById("itemlistmain").style.display = "none";
            } else {
                document.getElementById("itemlist").style.display = "none";
            }
            return;
        }
    }
    
    $scope.getiteminfo = (x) => {
        if (itemmode === "N") {
            console.log(x)
            $scope.mtbl = {
                ...$scope.mtbl,
                mtbllist: [...$scope.mtbl.mtbllist],
                data: { ...$scope.mtbl.data },
                listadd: {
                    ...$scope.mtbl.listadd,
                    data: {
                        ...$scope.mtbl.listadd.data,
                        mattype: x.itemdescription,
                        description: x.itemdescription,
                        units: x.itemunit
                    }
                }

            }
            document.getElementById("itemlistmain").style.display = "none";
            document.getElementById("description").focus();
        } else {
            $scope.mtblinfo = {
                ...$scope.mtblinfo,
                data: {
                    ...$scope.mtblinfo.data,
                    mattype: x.itemdescription,
                    description: document.getElementById("single_description").value === "" ? x.itemdescription : document.getElementById("single_description").value,
                    unit : x.itemunit
                }
            }
            document.getElementById("itemlist").style.display = "none";
            document.getElementById("single_description").focus();
        }
    }
}