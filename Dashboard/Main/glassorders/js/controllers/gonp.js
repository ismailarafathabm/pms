import GONServices from './../services/gon.js'
export default function gonp($scope, $compile, $http) {

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

    const gs = new GONServices();

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
                localStorage.removeItem("currentproject");
                localStorage.setItem("pms_currentproject", JSON.stringify($scope.viewproject));

                console.log($scope.viewproject);
                $scope.newproject = res.data.data;

            } else {
                alert(res.data.data);
            }
        });
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
    $scope.access = {};
    const columnDefs = gs.colsgopn($scope, $compile, $scope.access);
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

    $scope.isrptloading = false;
    $scope.excelexport = () => {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();
            var mname = `BUDGET SUMMARY FOR ALL PROJECTS ${day}-${month}-${year}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }

    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);
    $scope.goprclistx = [];
    loadgopn();
    async function loadgopn() {
        $scope.goprclistx = [];
        const fd = gs.FormData();
        fd.append("gonp_pjcno", sessionStorage.getItem('nafco_project_current_sno'));
        const res = await gs.getprojectgop(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        $scope.goprclistx = res.data;
        gridOptions.api.setRowData(res.data);
        $scope.$apply();
        return;
    }

    $scope.addnewgo = () => {
        location.assign(`${print_location}Dashboard/Main/index.php#!/gonpnew`);
    }

    //receive GO
    const dia_goprc_new = document.getElementById("dia_goprc_new");
    dia_goprc_new.style.display = "none";

    $scope.goprc = {
        isloading: false,
        mode: 1,
        btn: 'Save',
        title: "RECEIVE",
        data: {
            gonrc_id: '0',
            gonrc_date: '',
            gonrc_invoice: '',
            gonrc_qty: '',
            gonrc_sqm: '',
            gonrc_ppsqm: '',
            gonrc_totalprice: '',
            gonrc_extra: '',
            gonrc_finalprice: '',
            gonrc_remark: '',
            gonrc_project: '',
            gonrc_gopnid: '',
            gonrc_gonid: '',
            gonrc_cby: '',
            gonrc_eby: '',
            gonrc_cdate: '',
            gonrc_edate: ''
        }
    }
    function resetgoprc() {
        $scope.goprc = {
            isloading: false,
            mode: 1,
            btn: 'Save',
            title: "RECEIVE",
            data: {
                gonrc_id: '0',
                gonrc_date: '',
                gonrc_invoice: '',
                gonrc_qty: '',
                gonrc_sqm: '',
                gonrc_ppsqm: '',
                gonrc_totalprice: '',
                gonrc_extra: '',
                gonrc_finalprice: '',
                gonrc_remark: '',
                gonrc_project: '',
                gonrc_gopnid: '',
                gonrc_gonid: '',
                gonrc_cby: '',
                gonrc_eby: '',
                gonrc_cdate: '',
                gonrc_edate: ''
            }
        }
    }
    $scope.receivego = (gonp_id) => {

        resetgoprc();

        const _findata = $scope.goprclistx.find(x => x.gonp_id === gonp_id);
        console.log(_findata);
        dia_goprc_new.style.display = "flex";
        $scope.goprc = {
            ...$scope.goprc,
            isloading: false,
            title: `${_findata?.project_name ?? '-'} GO REF NO :  ${_findata?.gonp_gorefno ?? '-'}  - GLASS RECEIVE`,
            data: {
                ...$scope.goprc.data,
                gonrc_project: _findata?.project_id ?? 0,
                gonrc_gopnid: _findata?.gonp_id ?? 0,
                gonrc_gonid: _findata?.gonp_goid ?? 0,

            }
        };

        console.log($scope.goprc);
    }

    //calc action
    $scope.calcactions = () => {
        const _gonrc_sqm = document.getElementById("gonrc_sqm");
        const _gonrc_ppsqm = document.getElementById("gonrc_ppsqm");
        const _gonrc_extra = document.getElementById("gonrc_extra");

        const gonrc_sqm = _gonrc_sqm.value.trim() === "" ? 0 : _gonrc_sqm.value.trim();
        const gonrc_ppsqm = _gonrc_ppsqm.value.trim() === "" ? 0 : _gonrc_ppsqm.value.trim();
        const gonrc_extra = _gonrc_extra.value.trim() === "" ? 0 : _gonrc_extra.value.trim();

        if (isNaN(gonrc_sqm)) {
            return;
        }

        if (isNaN(gonrc_ppsqm)) {
            return;
        }

        if (isNaN(gonrc_extra)) {
            return;
        }

        let gonrc_totalprice = (+gonrc_sqm) * (+gonrc_ppsqm);
        let gonrc_finalprice = (+gonrc_totalprice) + (+gonrc_extra);

        $scope.goprc = {
            ...$scope.goprc,
            data: {
                ...$scope.goprc.data,
                gonrc_totalprice: Math.round(gonrc_totalprice),
                gonrc_finalprice: Math.round(gonrc_finalprice),

            }
        };
    }


    $scope.save_new_goprc_submit = async () => {
        if ($scope.goprc.isloading) {
            console.log("Old Process is running");
            return;
        }
        if ($scope.goprc.mode === 1) {
            await _saverc(); return;
        }
        await _updaterc(); return;
    }

    const _frmvalidate = () => {
        const gonrc_date = document.getElementById("gonrc_date");
        const gonrc_invoice = document.getElementById("gonrc_invoice");
        const gonrc_qty = document.getElementById("gonrc_qty");
        const gonrc_sqm = document.getElementById("gonrc_sqm");
        const gonrc_ppsqm = document.getElementById("gonrc_ppsqm");
        const gonrc_totalprice = document.getElementById("gonrc_totalprice");
        const gonrc_extra = document.getElementById("gonrc_extra");
        const gonrc_finalprice = document.getElementById("gonrc_finalprice");
        const gonrc_remark = document.getElementById("gonrc_remark");

        if (gonrc_date.value.trim() === "") {
            _msg(true, 'n', "Enter Date");
            gonrc_date.focus();
            return 0;
        }
        if (gonrc_invoice.value.trim() === "") {
            _msg(true, 'n', "Enter Invoice No");
            gonrc_invoice.focus();
            return 0;
        }
        if (gonrc_qty.value.trim() === "") {
            _msg(true, 'n', "Enter Qty");
            gonrc_qty.focus();
            return 0;
        }
        if (isNaN(gonrc_qty.value)) {
            _msg(true, 'n', "Qty Shoud Be A Number value");
            gonrc_qty.focus();
            return 0;
        }
        if (gonrc_sqm.value.trim() === "") {
            _msg(true, 'n', "Enter SQM");
            gonrc_sqm.focus();
            return 0;
        }
        if (isNaN(gonrc_sqm.value)) {
            _msg(true, 'n', "SQM Shoud Be A Number value");
            gonrc_sqm.focus();
            return 0;
        }

        if (gonrc_ppsqm.value.trim() === "") {
            _msg(true, 'n', "Enter Price / SQM");
            gonrc_ppsqm.focus();
            return 0;
        }
        if (isNaN(gonrc_ppsqm.value)) {
            _msg(true, 'n', "Price / SQM Shoud Be A Number value");
            gonrc_ppsqm.focus();
            return 0;
        }



        if (gonrc_totalprice.value.trim() === "") {
            _msg(true, 'n', "Enter Total Price");
            gonrc_totalprice.focus();
            return 0;
        }
        if (isNaN(gonrc_totalprice.value)) {
            _msg(true, 'n', "Total Price  Shoud Be A Number value");
            gonrc_totalprice.focus();
            return 0;
        }


        if (gonrc_extra.value.trim() === "") {
            _msg(true, 'n', "Enter Extra Amount");
            gonrc_extra.focus();
            return 0;
        }
        if (isNaN(gonrc_extra.value)) {
            _msg(true, 'n', "Extra Amount  Shoud Be A Number value");
            gonrc_extra.focus();
            return 0;
        }

        if (gonrc_finalprice.value.trim() === "") {
            _msg(true, 'n', "Enter Final Amount");
            gonrc_finalprice.focus();
            return 0;
        }
        if (isNaN(gonrc_finalprice.value)) {
            _msg(true, 'n', "Final Amount  Shoud Be A Number value");
            gonrc_finalprice.focus();
            return 0;
        }

        if (gonrc_remark.value.trim() === "") {
            _msg(true, 'n', "Enter Remark");
            gonrc_remark.focus();
            return 0;
        }
        return 1;
    }
    async function _saverc() {
        const _validate = _frmvalidate();
        if (_validate !== 1) {
            return;
        }

        const fd = gs.FormData();
        fd.append('payload', JSON.stringify($scope.goprc.data));

        $scope.goprc = {
            ...$scope.goprc,
            isloading: true,
            data: { ...$scope.goprc.data }
        };

        const res = await gs.savegoprc(fd);
        if (res?.msg !== 1) {
            _msg(true, 'n', res.data);
            $scope.goprc = {
                ...$scope.goprc,
                isloading: false,
                data: { ...$scope.goprc.data }
            };
            $scope.$apply();
            return;
        }


        $scope.goprc = {
            ...$scope.goprc,
            isloading: false,
            data: {
                ...$scope.goprc.data,
                gonrc_id: '0',
                gonrc_date: '',
                gonrc_invoice: '',
                gonrc_qty: '',
                gonrc_sqm: '',
                gonrc_ppsqm: '',
                gonrc_totalprice: '',
                gonrc_extra: '',
                gonrc_finalprice: '',
                gonrc_remark: '',
            }
        };

        _msg(true, 'd', "Data Has Saved");
        gridOptions.api.setRowData([]);
        gridOptions.api.setRowData(res.data);
        $scope.$apply();
        return;
    }

    async function _updaterc() {
        return;
    }

    $scope.goprclist = {
        isloading: false,
        data: [],
        sumoff: {
            qty: 0,
            area: 0,
            totalamount: 0,
            extraamount: 0,
            finalamount: 0,
        }
    }
    $scope.receivedlist = async (id) => {
        if ($scope.goprclist.isloading) { return; }
        await loadrclist(id);
        return;
    }
    const dia_goprc_list = document.getElementById("dia_goprc_list");
    dia_goprc_list.style.display = "none";
    
    async function loadrclist(id) {
        dia_goprc_list.style.display = "flex";
        const _findata = $scope.goprclistx.find(x => x.gonp_id === id);
        $scope.goprclist = {
            isloading: true,
            title: `${_findata?.project_name ?? '-'} GO REF NO :  ${_findata?.gonp_gorefno ?? '-'}  - GLASS RECEIVE`,
            data: [],
            sumoff: {
                qty: 0,
                area: 0,
                totalamount: 0,
                extraamount: 0,
                finalamount: 0,
            }
        }
        const fd = gs.FormData();
        fd.append("gonrc_gopnid", id);
        const res = await gs.getgopnrc(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.goprclist = {
                ...$scope.goprclist,
                isloading: false,
                data: [],
                sumoff: {
                    qty: 0,
                    area: 0,
                    totalamount: 0,
                    extraamount: 0,
                    finalamount: 0,
                }
            }
            $scope.$apply();
            return;
        }

        $scope.goprclist = {
            ...$scope.goprclist,
            isloading: false,
            data: res.data,
            sumoff: {
                qty: res.data.reduce((a, b) => (+a) + (+b.gonrc_qty), 0),
                area: res.data.reduce((a, b) => (+a) + (+b.gonrc_sqm), 0),
                totalamount: res.data.reduce((a, b) => (+a) + (+b.gonrc_totalprice), 0),
                extraamount: res.data.reduce((a, b) => (+a) + (+b.gonrc_extra), 0),
                finalamount: res.data.reduce((a, b) => (+a) + (+b.gonrc_finalprice), 0),
            }
        }
        $scope.$apply();
        return;
    }


}