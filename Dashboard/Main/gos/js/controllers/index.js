import cuttinglistservices from "../../../cuttinglist/js/services/index.js";
import * as models from "./../../../cuttinglist/js/controllers/models.js";
import * as ms from "./models.js";
export default function goeng($scope, $compile) {
    const cts = new cuttinglistservices();
    let access = {};
    const columnDefs = ms.aliprojectgoview($scope, access, $compile);
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
                $scope.isrptloading = false;
                $scope.$apply();
            }          
            
        })
    }

    async function fetchDatas(sno) {
        const res = await cts.GET(`gos/gos.php?limitr=${sno}`);
        return res;
    }

    $scope.goedit = (id) => {
        localStorage.setItem("pms_go_goid",id);
        window.location.href = `${print_location}/Dashboard/Main/index.php#!/goedit`
    }

    $scope.goupload = {
        diashow: false,
        isloading: false,
        id: 0
    };
    $scope.uploadmox = (id) => {
        $scope.goupload = {
            diashow: true,
            isloading: false,
            id: id
        };
    }

    $scope.uploadgosubmit = async () => {
        if ($scope.goupload.isloading) return;
        const fd = new FormData(
            document.getElementById("uploadgo")
        );
        $scope.goupload = {
            ...$scope.goupload,
            isloading: true,
        };
        const res = await cts.POST(`cuttinglists/gopdf.php?goid=${$scope.goupload.id}`, fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.goupload = {
                ...$scope.goupload,
                isloading: false,
            };
            $scope.$apply();
            return;
        }
        alert("Data has Updated");
        GetRowCount();
        $scope.goupload = {
            ...$scope.goupload,
            isloading: false
        };
        $scope.$apply();
        return;
    }
        

    //for file upload

    //for delete

    $scope.removego = async (goid) => {
        const c = confirm("Are You Sure Remove This GO?");
        if (!c) return;
        const rc = confirm("Are your Re conform to Remove This GO?");
        if (!rc) return;
        const res = await gos.GET(`gos/remove.php?goid=${goid}`);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        alert("Data Has Removed");
        GetRowCount($scope.newproject.project_no);
        $scope.$apply();
        return;
    }


}