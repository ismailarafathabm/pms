import cuttinglistservices from "../../../cuttinglist/js/services/index.js";
import * as models from "./../../../cuttinglist/js/controllers/models.js";
import * as clpr from './models.js'
export default function ctreleasehistory($scope, $compile) {
    const cts = new cuttinglistservices();
    let access = {};
    const columnDefs = clpr.his_grid($scope, $compile,access);
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

    let _data = [];
    $scope.isrptloading = false;
    const gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);
    let splitval = 500;
    let rowcount = 0;
    Get_RowCount();
    async function Get_RowCount() {
        const res = await cts.GET("ct-production/cntrel.php");
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
        // $scope.isrptloading = true;
         let _griddatas = [];
         x.map(async (i) => {           
             const res = await fetchDatas(i);           
             res.data.map(k => {
                _griddatas.push(k);
                
             })           
             gridOptions.api.setRowData(_griddatas);     
             $scope.$apply();
         })
     }
 
     async function fetchDatas(sno) {
         const res = await cts.GET(`ct-production/release-view.php?limitr=${sno}`);
         return res;
     }
}