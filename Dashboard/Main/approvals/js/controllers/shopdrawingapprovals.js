import TechnicalSubmitalSerices from '../services/index.js';
import * as models from './models/technicalgridmodel.js';
export default function shopdrawingsubmital($scope, $http, $compile) {
    const tss = new TechnicalSubmitalSerices();
    get_projectinfo();
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
    const access = {};
    const  cols = models.ShopDrawingModel($scope, $compile, access);
    const gridOptions = tss.gridoptions(cols);
    
    $scope.addnewtechsubmitall = () => {
        location.assign(`${print_location}Dashboard/Main/index.php#!/shopdrawingsubmitalnew`);
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
    getProjectShopDrawingSubmittals();    
    async function getProjectShopDrawingSubmittals() {          
        gridOptions.api.setRowData([]);
        const fd = tss.FormData();
        $scope.isrptloading = true;
        fd.append('ds_project', sessionStorage.getItem("nafco_project_current_sno"));
        const res = await tss.apicall("getds", fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isrptloading = false;
            return;
        }
        $scope.isrptloading = false;
        gridOptions.api.setRowData(res.data);
        $scope.$apply();
        return;

    }

    $scope.print_ts = async (id) => {
        let _data = [];
        const fd = tss.FormData();
        fd.append('sno', id);
        const res = await tss.apicall("getinfods", fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        _data = res.data;        
        localStorage.removeItem("naf_print_submital_drawings")
        localStorage.setItem("naf_print_submital_drawings", JSON.stringify(_data));
        window.open(`${print_location}/sprint/dgsubmital.html`,"_blank","width=1200px;height=600px");       
        return;
    }
   
}