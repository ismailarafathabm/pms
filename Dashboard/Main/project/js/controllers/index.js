import cuttinglistservices from "../../../cuttinglist/js/services/index.js";
import * as models from "./../../../cuttinglist/js/controllers/models.js";
import * as prj from './models.js';
export default function projectctrl($scope,$http, $compile, $routeParams) {
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
    $scope.isloading = false;
    let pagetype = !$routeParams.mode || $routeParams.mode === "" ? '' : $routeParams.mode;
    const pms = new cuttinglistservices();
    $scope.page_title = "Project List";
    pagetitle(pagetype);
    
    function pagetitle(pagetype) {                        
        if (pagetype === "all") {        
            $scope.page_title = "On Going Projects";
        } else if (pagetype === "villa") {
            $scope.page_title = "On Going Villa's";
        }else if (pagetype === "allhandover") {
            $scope.page_title = "Handed Over Projects";
        }else if (pagetype === "villahandover") {
            $scope.page_title = "Handed Over Villa's";
        } else {
            $scope.page_title = "Project List";
        }
    }
   
    let pdfaccess_user = ['admin', 'demo', 'operation@alunafco.com', 'sam', 'nabil', 'hani', 'estimation', 'estimations','Husam'];
    let pdfaccess = pdfaccess_user.includes(userinfo.user_name);
    let budetacces_user = ['demo', 'sam', 'nimnim', 'estimation', 'estimations', 'procurement', 'nabil', 'hani', 'admin','Husam'];
    let budgetaccess = budetacces_user.includes(userinfo.user_name);
    let access = {
        pdfaccess: pdfaccess_user.includes(userinfo.user_name),
        budetacces : budgetaccess
    };
    const columnDefs = prj.projectgrid($scope, $compile, access);
    const gridOptions = models.gridoptionsx(columnDefs);
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

    $scope.excelexport = function () {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            let excelfilename = $scope.page_title  + ".xlsx";
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();

            var param = {
                fileName: excelfilename,
                sheetName: "SHEET1",
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }

    const gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);
    loadrpt();
    async function loadrpt() {
        gridOptions.api.setRowData([]);
        let  res = {};
        if ($scope.isloading) return;
        if (pagetype === "all") {        
            res = await rptpro();
        } else if (pagetype === "villa") {
            res = await rptvilla();
        }else if (pagetype === "allhandover") {
            res = await rpthpro();
        }else if (pagetype === "villahandover") {
            res = await rpthvilla();
        } else {
            res = await rptpro();
        }
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isloading = false;
            $scope.$apply();
            return;
        }
        $scope.isloading = false;
        gridOptions.api.setRowData(res.data);
        $scope.$apply();
    }
    async function rptpro() {       
        $scope.isloading = true;        
        const res = await pms.GET('projectx/ongoingproject.php');
        return res;
    }
    async function rptvilla() {       
        $scope.isloading = true;        
        const res = await pms.GET('projectx/ongoingprojectvilla.php');
        return res;
    }
    async function rpthpro() {       
        $scope.isloading = true;        
        const res = await pms.GET('projectx/handoverproject.php');
        return res;
    }
    async function rpthvilla() {       
        $scope.isloading = true;        
        const res = await pms.GET('projectx/handovervilla.php');
        return res;
    }

    $scope.xgoproject = (pjno, pjid, page) =>{
        sessionStorage.clear('nafco_project_current');
        sessionStorage.clear('nafco_project_current_sno');
        sessionStorage.setItem('nafco_project_current', pjno);
        sessionStorage.setItem('nafco_project_current_sno', pjid);
        location.href = `${print_location}/Dashboard/Main/index.php#!/${page}`;
        return;
    }

    $scope.printAll = () => {
        let _data = [];    
        let _config = []
        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _data.push(_.data);
            _config.push(_);
        })     
        if (_data.length === 0) {
            alert("No data found");
            return;
        }
        let _bodywidth = _config[0].columnController.columnApi.columnController.columnApi.columnController.bodyWidth;
        let _columns = _config[0].columnController.columnApi.columnController.columnApi.columnController.autoRowHeightColumns;
        let fconfig = [];
        _columns.map((i) => {
            let cconf = {
                colid: i.colId,
                colwidth: i.actualWidth,
                colshow: i.visible,
                colname: i.userProvidedColDef.headerName
            };
            fconfig.push(cconf);
        });
        localStorage.setItem("pms_project_list", JSON.stringify(_data));
        localStorage.setItem("pms_project_list_config", JSON.stringify(fconfig));
        localStorage.setItem("pms_project_list_bodywidth", _bodywidth.toString());
        localStorage.setItem("pms_project_printtile", $scope.page_title);
        localStorage.setItem("pms_project_pdf_access", pdfaccess);
        localStorage.setItem("pms_project_ptype",pagetype);
        const location = `${print_location}sprint/projectlist.html`;
        //console.log(location);
        window.open(location, '_blank', "width:1300,height:600");        
    }
$scope.calc_f1 = function () {
        var __presentage = parseFloat($scope.newproject.project_first_advance_amount);
        var __amount = parseFloat($scope.newproject.project_amount);
        if (__presentage > __amount) {
            $scope.xerror = false;

        } else {
            $scope.xerror = true;
        }
        clc()
    }

    $scope.calc_f2 = function () {
        clc()
    }
    $scope.clcvalues = function () {
        var __presentage = parseFloat($scope.newproject.project_basicpayment);
        if (__presentage <= 100) {
            $scope.xerror = true;
        } else {
            $scope.xerror = false;
        }
        clc();
    }

    function clc() {
        if (!$scope.newproject.project_amount || $scope.newproject.project_amount == "" || !$scope.newproject.project_first_advance_amount || $scope.newproject.project_first_advance_amount == "" || !$scope.newproject.project_basicpayment || $scope.newproject.project_basicpayment == "") {
            $scope.newproject.project_first_advance = 0;
            $scope.ckcolors = "text-danger";
            $scope.bgcolor = "bg-danger";
            $scope.newproject.advance_amount_remark = "Advance Payment Not Completed";
        } else {
            var __amount = parseFloat($scope.newproject.project_amount);
            var __presentage = parseFloat($scope.newproject.project_first_advance_amount);
            var presentage = parseFloat(calcss(__amount, __presentage));
            $scope.newproject.project_first_advance = presentage;
            var _mini = parseInt($scope.newproject.project_basicpayment);
            if (_mini <= presentage) {
                $scope.ckcolors = "color:green";
                $scope.bgcolor = "bg-success";
                $("input[name='advance_amount_remark']").css('color', "green");
                $("input[name='project_first_advance']").css('color', "green");
                $(".fa-check").css('color', "green");
                $scope.newproject.advance_amount_remark = "Advance Payment Completed";
            } else {
                $("input[name='advance_amount_remark']").css('color', "red");
                $("input[name='project_first_advance']").css('color', "red");
                $(".fa-check").css('color', "red");
                $scope.newproject.advance_amount_remark = "Advance Payment Not Completed";
            }
        }
    }

    $scope.save_project = function () {
        clc();
        var _svdata = {
            naf_user: userinfo,
            _frmdata: $scope.newproject,
            _conditions: $scope._condition,
            _terms: $scope._terms
        };
        var req = $http.post(api_url + "Project/new.php", _svdata);
        req.then(function (res) {
            if (res.data.msg === "1") {
                alert("saved");
                reload();
            } else {
                alert(res.data.data);
            }
        })
    }
    
    
}