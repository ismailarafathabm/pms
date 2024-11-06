import * as Models from './models.js';
import MRservices from './../services/mr.js';

export default function mrrpt($scope, $compile) {
    let rptdata = []
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
    document.getElementById("rpt_materials").classList.add('menuactive');
    const mr = new MRservices();
    let access = {
        postaccess: userinfo.user_name === 'demo' || userinfo.user_name === 'john' ? true : false,
    }
    const columnDefs = Models.mr_girdrpt_cols($scope, access, $compile);
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
    $scope.exportExcel = () => {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            // var date = new Date();
            // var day = date.getDate();
            // var month = date.getMonth();
            // var year = date.getFullYear();
            var mname = `Material Request Report`;
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
        const res = await mr.apicall(fd, 'mrrpt');
        if (res?.msg !== 1) {
            return;
        }
        console.log(res.data);
        rptdata = res.data;
        gridOptions.api.setRowData(rptdata ?? []);
        return;
    }
    $scope.show_boq_dialog = false;
    $scope.getboqinfo = (id) => {
        $scope.show_boq_dialog = true;
        _getBoqinfo(id)
    }
    $scope.setSystemNewStatus = (_status) => $scope.show_boq_dialog = _status;
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
        //autoSizeAll();
        return;
    }

    function autoSizeAll() {
        console.log("called");
        const allColumnIds = [];
        gridOptions.columnApi.getColumns().forEach((column) => {
            allColumnIds.push(column.getId());
        });

        gridOptions.columnApi.autoSizeColumns(allColumnIds, false);
    }
    $scope.printrpt = () => {
        let _data = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _data.push(_.data);
        })
        let printwindow = window.open(`${print_location}/sprint/mrrpt.html`, '_blank', "width:1300px;height:700px");
        printwindow.forprintdata = JSON.stringify(_data);
    }

    $scope.datefilter = {
        diashow: false,
        data: {
            fromdate: '',
            todate: ''
        }
    }
    $scope.showDatefilter = (s) => {
        $scope.datefilter = {
            ...$scope.datefilter,
            data: {
                ...$scope.datefilter.data
            },
            diashow: s,
        }
    }
    _getThisWeek();
    async function _getThisWeek() {
        console.log("AAAAAA");
        const cts = await import('./../../../cuttinglist/js/services/index.js').then(x => new x.default());
        const res = await cts.GET(`cuttinglists/weekget.php`);
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

    function _convertDate(d) {
        const x = d.split('-');

        const date = x[0];
        const month = x[1];
        const year = x[2];

        return `${year}-${month}-${date}`;
    }
    let printoutdate = "";
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
        printoutdate = `FROM ${_fromdate} TO ${_todate}`;
        console.log(printoutdate);
        const fdate = _convertDate(_fromdate);
        const todate = _convertDate(_todate);
        gridOptions.api.setRowData([]);
        const filterdata = rptdata.filter(x => x.mrdate >= fdate && x.mrdate <= todate);
        let sortdata = filterdata.sort((a, b) => {
            if (a.issuedate < b.issuedate) {
                return -1;
            }
            if (a.issuedate > b.issuedate) {
                return 1;
            }
            return 1;
        })
        gridOptions.api.setRowData(sortdata);
        // gridOptions.columnApi.applyColumnState({
        //     state: [{ colId: 'issuedate', sort: 'desc' }],
        // });
        // $scope.datefilter['diashow'] = false;    
        $scope.datefilter = {
            ...$scope.datefilter,
            diashow: false,
            data: {
                ...$scope.datefilter.data
            },

        }

        console.log($scope.datefilter);

    }

    $scope.clearFilters = function () {
        console.log("working");
        gridOptions.columnApi.applyColumnState({
            defaultState: {
                sort: null,
            },
        });
        gridOptions.api.setFilterModel(null);
        gridOptions.api.setRowData([]);
        gridOptions.api.setRowData(rptdata);
        gridOptions.columnApi.applyColumnState({
            state: [{ colId: 'mrdate', sort: 'desc' }],
        });

    }
    $scope.isrptloading = false;
    $scope.postmrgrid = async (pj, mrno) => {
        if ($scope.isrptloading) return;
        const c = confirm("Are You Sure Post This M.R");
        if (!c) return;
        $scope.isrptloading = true;
        const fd = mr.FormData();
        fd.append("project", pj);
        fd.append("mrno", mrno);
        const res = await mr.apicall(fd, "mrpost");
        if (res?.msg !== 1) {
            $scope.isrptloading = false;
            alert(res.data);
            $scope.$apply();
            return;
        }
        window.location.reload();
        return;

    }

}