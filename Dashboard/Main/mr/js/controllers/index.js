import * as Models from './models.js';
import MRservices from './../services/mr.js';
export default function mrctrl($scope, $http, $compile) {
    document.getElementById("newbom").classList.add('menuactive');
    const mr = new MRservices();
    let access = {}
    
   
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
                //console.log($scope.viewproject);
                localStorage.removeItem("currentproject");
                localStorage.setItem("pms_currentproject", JSON.stringify($scope.viewproject));

                //console.log($scope.viewproject);
                $scope.newproject = res.data.data;
                //console.log($scope.ts);                

            } else {
                alert(res.data.data);
            }
        });
    }
    console.log(Models.mr_gird_cols($scope, access, $compile));
    const columnDefs = Models.mr_gird_cols($scope, access, $compile);
    const gridOptions = mr.gridoptions(columnDefs);
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
    LoadMrData();
    async function LoadMrData() {        
        const fd = mr.FormData();
        fd.append('mrproject', sessionStorage.getItem('nafco_project_current_sno'));
        const res = await mr.apicall(fd, 'mrget');
        if (res?.msg !== 1) {
            return;
        }
        console.log(res.data);
        gridOptions.api.setRowData(res.data ?? []);
        return;        
    }
    $scope.show_boq_dialog = false;
    $scope.getboqinfo = (id) => {
        $scope.show_boq_dialog = true;
        _getBoqinfo(id)
    }
    $scope.setSystemNewStatus = (_status) =>   $scope.show_boq_dialog = _status;
    
    $scope.boqinfo_dia = Models.boqdata_dialog(false);   
    async function _getBoqinfo(id) {
        $scope.boqinfo_dia = Models.boqdata_dialog(true);        
        const fd = mr.FormData();
        fd.append('boqid', id);
        const res = await mr.apicall(fd, 'boqinfo');
        if (res?.msg !== 1) {
            $scope.boqinfo_dia = Models.boqdata_dialog(false);
            alert(res.data);
            $scope.$apply();
            return;
        }
        console.log(res.data)
        $scope.boqinfo_dia = Models.boqdata_dialog(false, res.data);
        $scope.$apply();
        console.log($scope.boqinfo_dia)
        return;
    }

    async function getMrInfo(params){
        const fd = mr.FormData();
        fd.append('params', JSON.stringify(params));
        const res = await mr.apicall(fd, 'mrview');
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        localStorage.removeItem('pms_print_mr_info');        
        localStorage.setItem('pms_print_mr_info', JSON.stringify(res.data));
    }

    $scope.print_mr_click = async (p, c, n) => {        
        let params = {
            mrproject: p,
            mrcode: c,
            mrno: n
        };   
        getMrInfo(params);
        window.open(`${print_location}/sprint/mr.html`, "_blank");
    }

    $scope.edit_mr_click = async (p, c, n) => {
        let params = {
            mrproject: p,
            mrcode: c,
            mrno: n
        };   
        await getMrInfo(params);
        
        // localStorage.setItem('pms_print_mr_info_method', 'E');
        window.location.href = `${print_location}/Dashboard/Main/index.php#!/mrn/e`
    }
}