import GlassSupplierServices from './../services/suppliers.js';
import PurchaseGlassServices from './../services/purchaseglass.js';
import _ from '../../../masterlog/js/service/index.js';
export default function purchaseglass($scope, $http, $compile, $rootScope, $filter) {
    const gp = new GlassSupplierServices();
    const pgs = new PurchaseGlassServices();
    $scope.pgonew = _emptypgonew();
    $scope.acces = {};
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

    //grid options
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
    const columnDefs = pgs.cols($scope, $compile, $scope.access);
    const gridOptions = pgs.gridoptions(columnDefs);
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
    $scope.isrptloading = false;
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
    loadprojectgos();
    $scope.sum = {
        cost: 0,
        area: 0
    };
    async function loadprojectgos() {
        $scope.isrptloading = true;
        const fd = pgs.FormData();
        fd.append("bgoproject", sessionStorage.getItem('nafco_project_current_sno'));
        const res = await pgs.projectgos(fd);
        console.log(res);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isrptloading = false;
            gridOptions.api.setRowData([])
            $scope.$apply();
            return;
        }
        $scope.isrptloading = false;
        gridOptions.api.setRowData(res.data ?? []);
        sumofcalc(res.data)
        $scope.$apply();
        return;
    }
    function sumofcalc(datas) {
      
        let _area = 0;
        let _cost = 0;
        datas.map(i => {
            _area += (+i.bgogoqty);
            _cost += (+i.bgoval);
        })

        $scope.sum = {
            cost: Math.round(_cost),
            area: Math.round(_area),
        }
    }
    //grid options - end


  
    //get previous order
    getpreviousorder();
    async function getpreviousorder() {
        const fd = pgs.FormData();
        fd.append("bgoproject", sessionStorage.getItem('nafco_project_current_sno'))
        const res = await pgs.sumgobudgetotalarea(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        console.log("pri", res.data);
        $scope.pgonew = {
            ...$scope.pgonew,
            data: {
                ...$scope.pgonew.data,
                bgopsqm :res.data,               
            }
        }
        console.log($scope.pgonew);
        $scope.$apply();
    }
    //get project total sqm
    getbudgetsqm();
    async function getbudgetsqm() {
        const fd = pgs.FormData();
        fd.append("bgprojectid", sessionStorage.getItem('nafco_project_current_sno'))

        const res = await pgs.gobudgettotalarea(fd);
        if (res.msg !== 1) {
            alert(res.data);
            return;
        }
        console.log("budget", res.data);
        $scope.pgonew = {
            ...$scope.pgonew,
            data: {
                ...$scope.pgonew.data,
                bgobsqm :res.data,
            }
        }
        console.log($scope.pgonew);
        $scope.$apply();
        return;
    }

    //load supplier
    $scope.supplierlist = []
    loadAllSuppliers();
    async function loadAllSuppliers() {
        const res = await gp.getAllGlassSuppliers();
        console.log(res);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }

        $scope.supplierlist = res.data ?? [];
        $scope.$apply();
    }
    const dia_suppliers = document.getElementById("dia_suppliers");
    dia_suppliers.style.display = "none";
    function _emptysuppliers() {
        const _ = {
            isloading: false,
            title: "Add New Supplier",
            btn: "Save",
            mode: "N",
            data: {
                glasssupplierid: "0",
                glasssuppliername: "",
                glasssuppliercountry: "",
            }
        };

        return _;
    }
    $scope.suppliers = _emptysuppliers();

    $scope.addnewsupplier = () => {
        $scope.suppliers = {};
        $scope.suppliers = _emptysuppliers();
        dia_suppliers.style.display = "flex";
        document.getElementById("glasssuppliername").focus();
    }
    $scope.save_suppliers_submit = async () => {
        if ($scope.suppliers.isloading) {
            console.log("Already Another Process Is Running...");
            return;
        }

        if ($scope.suppliers.mode === "N") {
            await _savesuppliers();
            return;
        }
    }
    function _validate() {

        const glasssuppliername = document.getElementById("glasssuppliername");
        const glasssuppliercountry = document.getElementById("glasssuppliercountry");
        if (glasssuppliername.value.trim() === "") {
            _msg(true, "n", "Enter Supplier Name");
            glasssuppliername.focus();
            return 0;
        }

        if (glasssuppliercountry.value.trim() === "") {
            _msg(true, "n", "Enter Supplier Location");
            glasssuppliercountry.focus();
            return 0;
        }

        const fd = gp.FormData();
        fd.append("glasssuppliername", glasssuppliername.value);
        fd.append("glasssuppliercountry", glasssuppliercountry.value);
        return fd;

    }
    async function _savesuppliers() {
        const fd = _validate();
        if (fd === 0) {
            return;
        }
        $scope.suppliers = {
            ...$scope.suppliers,
            data: { ...$scope.suppliers.data },
            isloading: true,
        };
        const res = await gp.newsupplier(fd);
        if (res?.msg !== 1) {
            _msg(true, "n", res.data);
            $scope.suppliers = {
                ...$scope.suppliers,
                data: { ...$scope.suppliers.data },
                isloading: false,
            };
            $scope.$apply();
            return;
        }
        $scope.suppliers = {
            ...$scope.suppliers,
            data: {
                glasssupplierid: "0",
                glasssuppliername: "",
                glasssuppliercountry: "",
            },
            isloading: false,
        };
        _msg(true, "t", "Supplier Information Has Saved");
        $scope.supplierlist = res?.data ?? [];
        $scope.$apply();
        return;
    }
    //form actions
    function _emptypgonew() {
        const _ = {            
            isloading: false,
            title: 'New Purchase Approvals Form',
            mode: 'N',
            btn: "Save",
            data: {                
                bgoid: '',
                bgodate: '',
                bgotype: '',
                bgoproject: sessionStorage.getItem('nafco_project_current_sno'),
                bgogorefno: '',
                bgogoqty: '',
                bgoval: '',
                bgoppsqm: '',
                suppliername: '',
                bgopsqm: '',
                bgobsqm :'',
            }
        }
        return _;
    }
   
    document.getElementById("dia_go_approvals").style.display = "none";
    $scope.addnewgoorders = () => {
        document.getElementById("dia_go_approvals").style.display = "flex";
        $scope.pgonew = {
            ...$scope.pgonew,
            isloading: false,
            title: 'New Purchase Approvals Form',
            mode: 'N',
            btn: "Save",
            data: {              
                ...$scope.pgonew.data,
                bgoid: '',
                bgodate: '',
                bgotype: '',
                bgoproject: sessionStorage.getItem('nafco_project_current_sno'),
                bgogorefno: '',
                bgogoqty: '',
                bgoval: '',
                bgoppsqm: '',
                suppliername: '',                
            }
        }
    }



    $scope.areaover = false;
    $scope.calcarea = () => {
        const bgogoqty = document.getElementById("bgogoqty").value.trim() === "" ? 0 : document.getElementById("bgogoqty").value;
        const bgoppsqm = document.getElementById("bgoppsqm").value.trim() === "" ? 0 : document.getElementById("bgoppsqm").value;
        const bgoval = (+bgogoqty) * (+bgoppsqm);
        const parea = document.getElementById("bgopsqm").value.trim() === "" ? 0 : document.getElementById("bgopsqm").value;
        const budgetsqm = document.getElementById("bgobsqm").value.trim() === "" ? 0 : document.getElementById("bgobsqm").value;
        const totarea = (+parea) + (+bgogoqty);
        if (totarea > budgetsqm) {
            $scope.areaover = true;
            _msg(true, 'r', "Area Out of Range..");
        } else {
            $scope.areaover = false;
        }
        $scope.pgonew = {
            ...$scope.pgonew,
            data: {
                ...$scope.pgonew.data,
                bgoval: bgoval,
            }
        }
    }

    $scope.pgonew_save_submit = async () => {
        if ($scope.pgonew.isloading) {
            console.log("Already Process Is Running");
            return;
        }
        if ($scope.pgonew.mode === "N") {
            await _savepgo();
            return;
        }
        await _updatepgo();
        return;
    }
    async function _savepgo() {
        const fd = pgs.FormData();
        fd.append("bgodate", $scope.pgonew.data.bgodate);
        fd.append("bgotype", $scope.pgonew.data.bgotype);
        fd.append("bgoproject", $scope.pgonew.data.bgoproject);
        fd.append("bgogorefno", $scope.pgonew.data.bgogorefno);
        fd.append("bgogoqty", $scope.pgonew.data.bgogoqty);
        fd.append("bgoval", $scope.pgonew.data.bgoval);
        fd.append("bgoppsqm", $scope.pgonew.data.bgoppsqm);
        fd.append("suppliername", $scope.pgonew.data.suppliername);
        fd.append("bgopsqm", $scope.pgonew.data.bgopsqm);
        fd.append("bgobsqm", $scope.pgonew.data.bgobsqm);

        $scope.pgonew = {
            ...$scope.pgonew,
            data: { ...$scope.pgonew.data, },
            isloading: true,
        }

        const res = await pgs.gosave(fd);
        if (res?.msg !== 1) {
            _msg(true, "n", res.data);
            $scope.pgonew = {
                ...$scope.pgonew,
                data: { ...$scope.pgonew.data, },
                isloading: false,
            }
            $scope.$apply();
            return;
        }

        
        $scope.pgonew = {
            ...$scope.pgonew,
            isloading: false,
            title: 'New Purchase Approvals Form',
            mode: 'N',
            btn: "Save",
            data: {              
                ...$scope.pgonew.data,
                bgoid: '',
                bgodate: '',
                bgotype: '',
                bgoproject: sessionStorage.getItem('nafco_project_current_sno'),
                bgogorefno: '',
                bgogoqty: '',
                bgoval: '',
                bgoppsqm: '',
                suppliername: '',                
            }
        }
        _msg(true, 't', "Data Has Saved");
        getbudgetsqm();
        getpreviousorder();
        gridOptions.api.setRowData(res.data ?? []);
        sumofcalc(res.data);
        $scope.$apply();

    }
    async function _updatepgo() {

    }


    $scope.print_data = async (id) => {
        const fd = pgs.FormData();
        fd.append("bgoid", id);
        const res = await pgs.printgo(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        localStorage.removeItem("pms_print_purcashe_glass_order");
        localStorage.setItem("pms_print_purcashe_glass_order", JSON.stringify(res.data));
        window.open(`${print_location}fprint/#!/goprint`, "_blank", "height:500px,width:1200px");
    }

    //form actions
}