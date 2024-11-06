import cuttinglistservices from "../../../cuttinglist/js/services/index.js";
import * as gridmodels from './../../../cuttinglist/js/controllers/models.js';
import * as models from './releasemodel.js';
export default function engreleasesummary($scope, $http, $compile) {
    let _finaldata = [];
    const eng = new cuttinglistservices();
    $scope.isrptloading = false;
    const access = [];
    const columnDefs = models.EngReleaseCols($scope, access, $compile);
    const gridOptions = gridmodels.gridoptionsx(columnDefs);
    const gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);
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
    get_projectinfo();
    function get_projectinfo() {
        let project_id = sessionStorage.getItem("nafco_project_current");
        let post_data = {
            naf_user: userinfo,
            project_no: project_id,
        };
        var req = $http.post(api_url + "Project/view.php", post_data);
        var req = $http.post(api_url + "Project/view.php", post_data);
        req.then((res) => {
            if (res.data.msg === "1") {
                $scope.viewproject = res.data.data;
                //console.log($scope.viewproject);
                localStorage.removeItem("currentproject");
                localStorage.setItem(
                    "pms_currentproject",
                    JSON.stringify($scope.viewproject)
                );
                GerRelaseSummary();
            } else {
                alert(res.data.data);
                window.location.href = `${print_location}/Dashboard/Main/index.php`;
            }
        });
    }

    async function GerRelaseSummary() {
        if ($scope.isrptloading) return;
        $scope.isrptloading = true;
        const _pjno = sessionStorage.getItem("nafco_project_current_sno");
        const res = await eng.GET('boqneng/releasehistroy.php?projectno=' + _pjno);
        if (res?.msg !== 1) {
            $scope.isrptloading = false;
            alert(res.data);
            $scope.$apply();
        }
        $scope.isrptloading = false;
        _finaldata = res.data;
        gridOptions.api.setRowData(_finaldata);
        console.log(res);
        $scope.$apply();
        return;
    }

    $scope.datefilter = {
        diashow: false,
        isloading: false,
        data: {
            fromdate: '',
            todate: ''
        }
    };
    $scope.showDatefilter = (status) => {
        $scope.datefilter['diashow'] = status;
        console.log($scope.datefilter);
    }
    function _convertDate(d) {
        const x = d.split('-');

        const date = x[0];
        const month = x[1];
        const year = x[2];

        return `${year}-${month}-${date}`;
    }
    _getThisWeek();
    async function _getThisWeek() {
        const res = await eng.GET(`cuttinglists/weekget.php`);
        if (res?.msg !== 1) {
            return;
        }

        $scope.datefilter = {
            ...$scope.datefilter,
            data: {
                fromdate: res.data.fday,
                todate: res.data.fd,
            }
        };

        console.log(res.data);
        console.log($scope.datefilter);

        $scope.$apply();

    }

    $scope.filterbydate = () => {
        const _fromdate = $scope.datefilter?.data?.fromdate ?? '';
        const _todate = $scope.datefilter?.data?.todate ?? '';

        if (!_fromdate || _fromdate === '') {
            alert("Enter Form Date");
            return;
        }

        if (!_todate || _todate === '') {
            alert("Enter To Date");
            return;
        }

        const fdate = _convertDate(_fromdate);
        const todate = _convertDate(_todate);
        gridOptions.api.setRowData([]);
        const filterdata = _finaldata.filter(x => x.boqeng_rdate >= fdate && x.boqeng_rdate <= todate);
        let sortdata = filterdata.sort((a, b) => {
            if (a.boqeng_rdate < b.boqeng_rdate) {
                return -1;
            }
            if (a.boqeng_rdate > b.boqeng_rdate) {
                return 1;
            }
            return 1;
        })
        gridOptions.api.setRowData(sortdata);
        gridOptions.columnApi.applyColumnState({
            state: [{ colId: 'boqeng_rdate', sort: 'desc' }],
        });
        $scope.datefilter['diashow'] = false;
    }

    $scope.clearFilters = function () {
        gridOptions.columnApi.applyColumnState({
            defaultState: {
                sort: null,
            },
        });
        
        gridOptions.api.setFilterModel(null);
        gridOptions.api.setRowData([]);
        gridOptions.api.setRowData(_finaldata);
        gridOptions.columnApi.applyColumnState({
            state: [{ colId: 'issuedate', sort: 'desc' }],
        });
    }

    $scope.exportExcel = function () {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            let excelfilename = `BOQ ENGINEERING RELEASE SUMMARY of ${$scope.viewproject.project_name}[${$scope.viewproject.project_no}]`;
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

    //print actions
    $scope.printResult = () => {
        let _data = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _data.push(_.data);
        })
        localStorage.setItem("printrpt_engg_release_boq", JSON.stringify(_data));
        let printwindow = window.open(`${print_location}/sprint/boqengrelease.html`, '_blank', "width:1300px;height:700px");
        //printwindow.forprintdata = JSON.stringify(_data);
    }



}