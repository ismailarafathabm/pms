import GlassOrderServices from '../services/index.js';
import * as models from './models.js';
export default function goreceiptview($scope, $compile) {
    $scope.pagetitle = "Procurement Entry"
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



    let _rptdata = [];
    $scope.isrptloading = false;
    const gos = new GlassOrderServices();
    let access = {

    }
    const columnDefs = models.goreceipts($scope, access, $compile);
    const gridOptions = gos.gridoptions(columnDefs);
    const gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);
    $scope.isrptloading = false;
    let splitval = 500;
    let rowcount = 0;

    LoadReport();
    async function LoadReport() {
        _rptdata = [];
        const res = await gos.GET(`gos/goreceiptcnt.php`);
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

        LoadReports(rowstart)
        $scope.$apply();
    }
    async function LoadReports(x) {
        $scope.isrptloading = true;
        let _griddatas = [];
        x.map(async (i) => {
            const res = await fetchDatas(i);
            res.data.map(k => {
                _griddatas.push(k);
            })

            if (_griddatas.length === rowcount) {
                $scope.isrptloading = false;
                _rptdata = _griddatas;
                gridOptions.api.setRowData(_griddatas);
                $scope.$apply();
            }

        })
    }
    async function fetchDatas(sno) {
        const res = await gos.GET(`gos/goreceiptrpt.php?limitr=${sno}`);
        return res;
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
        //console.log("AAAAAA");
        const res = await gos.GET(`cuttinglists/weekget.php`);
        if (res?.msg !== 1) {
            return;
        }

        $scope.datefilter = {
            ...$scope.datefilter,
            data: {
                fromdate: res.data.fday,
                todate : res.data.fd,
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
        const filterdata = _rptdata.filter(x => x.goreceiptdate >= fdate && x.goreceiptdate <= todate);
        let sortdata = filterdata.sort((a, b) => {
            if (a.goreceiptdate < b.goreceiptdate) {
                return -1;
            }
            if (a.goreceiptdate > b.goreceiptdate) {
                return 1;
            }
            return 1;
        })
        gridOptions.api.setRowData(sortdata);
        gridOptions.columnApi.applyColumnState({
            state: [{ colId: 'goreceiptdate', sort: 'desc' }],
        });
        $scope.datefilter['diashow'] = false;    
    }

    $scope.clearFilters = () => {
        gridOptions.columnApi.applyColumnState({
            defaultState: {
                sort: null,
            },
        });
        
        gridOptions.api.setFilterModel(null);
        gridOptions.api.setRowData([]);
        gridOptions.api.setRowData(_rptdata);
        gridOptions.columnApi.applyColumnState({
            state: [{ colId: 'goreceiptdate', sort: 'desc' }],
        });
    }

    $scope.printResult = () => {
        let _rpt = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _rpt.push(_.data);
        })

        localStorage.setItem("printrpt_receipt_gos", JSON.stringify(_rpt));
        window.open(`${print_location}/sprint/gosreceipt.html`, "_blank", "width:1300px;height:700px");
    }
}