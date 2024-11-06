import cuttinglistservices from "../services/index.js";
import * as models from './models.js';
export default function cuttinglistsusersp($scope,$http, $compile) {
    const cts = new cuttinglistservices();
    let access = {};
    const columnDefs = models.rptcolsusers($scope, access, $compile);
    const gridOptions = cts.gridoptions(columnDefs);

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
    $scope.isrptloading = false;
    const gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);
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
                GetRowCount(res.data.data.project_no);
                //console.log($scope.ts);                
                //LoadReports(res.data.data.project_no);
            } else {
                alert(res.data.data);
            }
        });
    }
    let rowcount = 0;
    let splitval = 500;
    async function GetRowCount(projectno) {
        const res = await cts.GET(`cuttinglists/ctrowsp.php?projectno=${projectno}`);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        rowcount = (+res.data);
        let splitcount = rowcount / splitval;
        let rowstart = [];
        let n = 0;
        rowstart.push(n);
        for (var i = 0; i < splitcount; i++) {
            n = n + splitval;
            rowstart.push(n)
        }

        LoadReports(rowstart, projectno);
        $scope.$apply();
        //gridOptions.api.setRowData(res.data);
    }

    async function LoadReports(projectno) {
        if ($scope.isrptloading) return;
        $scope.isrptloading = true;
        const res = await cts.GET(`cuttinglists/indexp.php?projectno=${projectno}`);
        //console.log(res);
        if (res?.msg !== 1) {
            $scope.isrptloading = false;
            alert(res.data);
            return;
        }
        $scope.isrptloading = false;
        gridOptions.api.setRowData(res.data);
        $scope.$apply();
        return;
    }

    async function LoadReports(x, projectno) {
        $scope.isrptloading = true;
        let _griddatas = [];
        x.map(async (i) => {
            const res = await fetchDatas(i, projectno);
            res.data.map(k => {
                _griddatas.push(k);
            })
            gridOptions.api.setRowData(_griddatas);

            if (_griddatas.length === rowcount) {
                let sumof_qty = 0;
                let sumof_area = 0;
                gridOptions.api.forEachNodeAfterFilterAndSort(d => {
                    const i = d.data;
                    sumof_qty += (+i.ct_qty);
                    console.log(i.ct_area);
                    sumof_area += (+i.ct_area);
                })

                $scope.sumof = {
                    totitem: sumof_qty,
                    sumof_area: sumof_area,
                }
                $scope.isrptloading = false;
                $scope.$apply();
            }

        })
    }

    async function fetchDatas(sno, projectno) {
        const res = await cts.GET(`cuttinglists/indexpn.php?nrows=${sno}&projectno=${projectno}`);
        return res;
    }


    $scope.clearFilters = function () {
        gridOptions.columnApi.applyColumnState({
            defaultState: {
                sort: null,
            },
        });
        gridOptions.api.setFilterModel(null);
    }

    $scope.exportExcel = function () {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            let excelfilename = "Cutting List Report";
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

    $scope.printResult = () => {
        // const element = document.getElementById("myGrid");

        // var opt = {
        //     margin: 0.5,
        //     filename: 'your_filename.pdf',
        //     image: { type: 'jpeg', quality: 1 },
        //     html2canvas: { scale: 4, logging: true },
        //     jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
        // };

        // html2pdf().set(opt).from(element).save();


        var _data = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _data.push(_.data);           
        })
        
        //localStorage.setItem("pms_print_cuttinglists", JSON.stringify(_data));
        let printwindow = window.open(`${print_location}/sprint/cuttinglistsp.html`, '_blank', "width:1300px;height:700px")
        printwindow.forprintdata = JSON.stringify(_data);
        printwindow.type = "S";        
        printwindow.project_name = `${$scope.viewproject.project_name}[${$scope.viewproject.project_no}]`;
    }

    //bulk update status

    

}