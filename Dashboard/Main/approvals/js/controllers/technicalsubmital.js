import TechnicalSubmitalSerices from "../services/index.js";
import * as  tm from "./models/technicalgridmodel.js";
import { statuslist } from "../../../technical/js/controllers/models.js";
export default function technicalsubmital($scope, $http, $compile) {
    document.getElementById("approvals_menu").classList.add('menuactive');
    get_projectinfo()
    let access = {};
    const ts = new TechnicalSubmitalSerices();
    //console.log(ts);
    const  cols = tm.TechnicalModel($scope, $compile, access);
    const gridOptions = ts.gridoptions(cols);
    console.log(cols);
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

    
    $scope.addnewtechsubmitall = () => {
        location.assign(`${print_location}Dashboard/Main/index.php#!/technicalsubmitalnew`);
    }
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
    $scope.excelexport = () => {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            // var date = new Date();
            // var day = date.getDate();
            // var month = date.getMonth();
            // var year = date.getFullYear();
            var mname = `Material Request For Project : ${$scope.viewproject.project_name}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }
    const gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);
    $scope.isrptloading = false;
    GetRrpt();
    async function GetRrpt() {
        if ($scope.isrptloading) return;
        const fd = ts.FormData();
        fd.append("techsub_project", sessionStorage.getItem("nafco_project_current_sno"));
        $scope.isrptloading = true;
        const res = await ts.apicall('getts_p', fd);
        if (res?.msg !== 1) {
            $scope.isrptloading = false;
            console.log(res.data);
            $scope.$apply();
            return;
        }
        console.log(res.data);
        $scope.isrptloading = false;
        gridOptions.api.setRowData(res.data);
        $scope.$apply();
        return;
    }
    

    $scope.print_ts = (id) => {
        if ($scope.isrptloading) return;
        _printaction(id);
    }

    async function _printaction(id) {
        console.log("print");
        const fd = ts.FormData();
        fd.append('techsub_id', id);
        $scope.isrptloading = true;
        const res = await ts.apicall('printts', fd);
        if (res?.msg !== 1) {
            console.log(res.data);
            alert(res.data);
            $scope.isrptloading = false;
            $scope.$apply();
            return;
        }
        $scope.isrptloading = false;
        $scope.$apply();
        localStorage.removeItem("pms_print_techsubmital_frm");
        localStorage.setItem("pms_print_techsubmital_frm", JSON.stringify(res.data));
        window.open(`${print_location}/sprint/index.html`,"_blank","width=1200px;height=600px");
    }

    
    $scope.goeditpage = async (id) => {
        console.log("working");
        const fd = ts.FormData();
        fd.append('techsub_id', id);
        $scope.isrptloading = true;
        const res = await ts.apicall('printts', fd);
        if (res?.msg !== 1) {
            console.log(res.data);
            alert(res.data);
            $scope.isrptloading = false;
            $scope.$apply();
            return;
        }
        $scope.isrptloading = false;
        localStorage.removeItem("pms_print_techsubmital_frm");
        localStorage.setItem("pms_print_techsubmital_frm", JSON.stringify(res.data));
        window.location.href = `${print_location}/Dashboard/Main/index.php#!/technicalsubmitalnew/e`
    }

    const _currentdate = () => {
        const _date = new Date();
        const _day = _date.getDate();
        const _month = _date.getMonth()+1;
        const _year = _date.getFullYear();
        return `${_day}-${_month}-${_year}`;
    }

    $scope.statusupdate = {
        isloading : false,
        status : false,
        mode: 1,
        title: "Update Status",
        data: {
            techsub_status: 'A',
            techsub_subdate: _currentdate(),   
            techsub_id : ""
        }
    }
    $scope.statuslist = statuslist;
    $scope.setdiastatus = (status) => $scope.statusupdate = {...$scope.statusupdate , status:status };
    
    
    $scope.change_currentStatus = (_status,id) => {
        console.log(_status);
        $scope.statusupdate = {  
            ...$scope.statusupdate,
            status: true,    
            data: {                
                ...$scope.statusupdate.data,
                techsub_status: _status,     
                techsub_id : id
            },
        }
        console.log( $scope.statusupdate)
    }
    async function _updateStatus() {
        gridOptions.api.setRowData([]);
        const techsub_status = $scope.statusupdate?.data?.techsub_status || '';
        const techsub_subdate = $scope.statusupdate?.data?.techsub_subdate || '';
        if (techsub_status.trim() === '') {
            alert("Select Status");
            document.getElementById("techsub_status").focus();
            return;
        }
        if (techsub_subdate.trim() === '') {
            alert("Enter Update Date");
            document.getElementById("techsub_subdate").focus();
            return;
        }
        const fd = ts.FormData();
        fd.append("techsub_status", $scope.statusupdate.data.techsub_status);
        fd.append("techsub_subdate", $scope.statusupdate.data.techsub_subdate);
        fd.append("techsub_id", $scope.statusupdate.data.techsub_id);
        fd.append("techsub_project", sessionStorage.getItem("nafco_project_current_sno"));
        const res = await ts.apicall('updatetsstatus', fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        console.log(res.data);
        gridOptions.api.setRowData(res.data);
        $scope.$apply();
        return;

    }
    $scope.update_technical_submital = async () => {
        console.log("working");
        await _updateStatus()
    }
        
    
}