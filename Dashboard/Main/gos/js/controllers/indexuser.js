import cuttinglistservices from "../../../cuttinglist/js/services/index.js";
import * as models from "./../../../cuttinglist/js/controllers/models.js";
import * as ms from "./models.js";
export default function goengusers($scope, $compile) {
    const cts = new cuttinglistservices();
    let access = {};
    let _finaldatas = [];
    const columnDefs = ms.aliprojectgoviewusers($scope, access, $compile);
    const gridOptions = models.gridoptionsx(columnDefs);
    gridOptions['rowSelection'] = 'multiple';
    gridOptions['onSelectionChanged'] = onSelectionChanged;
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

    $scope.exportExcel = function () {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            let excelfilename = "Glass Order List";
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


    $scope.isrptloading = false;
    const gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);

    let splitval = 500;
    let rowcount = 0;
    GetRowCount();
    async function GetRowCount() {
        const res = await cts.GET("gos/index.php");
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
            gridOptions.api.setRowData(_griddatas);
            if (_griddatas.length === rowcount) {
                _finaldatas = _griddatas
                $scope.isrptloading = false;
                $scope.$apply();
            }

        })
    }

    async function fetchDatas(sno) {
        const res = await cts.GET(`gos/gos.php?limitr=${sno}`);
        return res;
    }

    $scope.clearFilters = function () {
        gridOptions.columnApi.applyColumnState({
            defaultState: {
                sort: null,
            },
        });

        gridOptions.api.setFilterModel(null);
        gridOptions.api.setRowData([]);
        gridOptions.api.setRowData(_finaldatas);
        gridOptions.columnApi.applyColumnState({
            state: [{ colId: 'issuedate', sort: 'desc' }],
        });


    }

    $scope.printResult = () => {
        let _rpt = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _rpt.push(_.data);
        })
        console.log(_rpt);
        let printwindow = window.open(`${print_location}/sprint/gos.html`, '_blank', "width:1300px;height:700px");
        printwindow.forprintdata = JSON.stringify(_rpt);
        ///printwindow.fordate = printoutdate;
        //printwindow.project_name = $scope.viewproject.project_name;
        printwindow.type = "N";

    }


    //for file upload
    $scope.showdownloadbtn = false;
    function onSelectionChanged() {

        const _rows = gridOptions.api.getSelectedRows();
        console.log(_rows.length);

        if (_rows.length !== 0) {
            $scope.showdownloadbtn = true;
            console.log($scope.showdownloadbtn);
            console.log("cli");
        } else {
            console.log("clix");
            $scope.showdownloadbtn = false;
        }

    }

    $scope.downloadall = () => {
        const _rows = gridOptions.api.getSelectedRows();
        console.log(_rows);
        if (_rows.length === 0) {
            alert("Select Cutting List and Try Again")
            return;
        }
        let sx = [];
        _rows.map(i => {
            if (i.gofilestatus === 'Yes') {
                sx.push({
                    goid: i.goid,
                    gofno: i.gonumber,
                    pjname: i.goprojectname,
                });
            }
        })
        const fd = new FormData();
        fd.append('payload', JSON.stringify(sx))
        fd.append('userid', userinfo.user_name);
        fetch(`${api_url}/gos/download/index.php`, {
            method: 'post',
            body: fd
        }).then(res => {
            return res.blob()
        }).then((res) => {
            console.log(res);
            const aElement = document.createElement("a");
            aElement.setAttribute("download", `GOFILES.zip`);
            const href = URL.createObjectURL(res);
            aElement.href = href;
            aElement.setAttribute("target", "_blank"); aElement.click();
            URL.revokeObjectURL(href);
        });

    }
    //function downloadFile(url, fileName) { fetch(url, { method: "get", mode: "no-cors", referrerPolicy: "no-referrer" }).then((res) => res.blob()).then((res) => { const aElement = document.createElement("a"); aElement.setAttribute("download", fileName); const href = URL.createObjectURL(res); aElement.href = href; aElement.setAttribute("target", "_blank"); aElement.click(); URL.revokeObjectURL(href); }); }


}