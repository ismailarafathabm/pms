import cuttinglistservices from "../../../cuttinglist/js/services/index.js";
import * as models from "./../../../cuttinglist/js/controllers/models.js";
import * as clpr from './models.js'
export default function ctproduction($scope, $compile, $routeParams) {
    let pagetype = !$routeParams.type || $routeParams.type === "" ? '' : $routeParams.type;
    $scope.pagetitle = "";
    if (pagetype === "compleate") {
        $scope.pagetitle = "PRODUCTION DELIVERYED";
        document.title = $scope.pagetitle;
    } else if (pagetype === "balance") {
        $scope.pagetitle = "PRODUCTION BALANCE";
        document.title = $scope.pagetitle;
    } else {
        $scope.pagetitle = "PRODUCTION LOG";
        document.title = $scope.pagetitle;
    }
    const cts = new cuttinglistservices();
    let access = {};
    
    const columnDefs = clpr.production_grid($scope, $compile,access);
    const gridOptions = models.gridoptionsx(columnDefs);
    gridOptions['rowSelection'] = 'multiple';
    gridOptions['onSelectionChanged'] = onSelectionChanged;


    $scope.updatebutton = false;
    function onSelectionChanged() {
        const _rows = gridOptions.api.getSelectedRows();
        $scope.updatebutton = _rows.length === 0 ? false : true;
        $scope.$apply();
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
        const res = await cts.GET("ct-production/cntr.php");
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
                 if (pagetype === "compleate") {
                     let _balance = (+k.bal_qty);
                     if (_balance <= 0) {
                        _griddatas.push(k);
                     }                     
                 }
                 else if (pagetype === "balance") {
                     let _balance = (+k.bal_qty);
                     if (_balance > 0) {
                         if (i.ct_type !== "Account MO") {
                             _griddatas.push(k);
                         }
                     }
                 } else {
                    _griddatas.push(k);
                 }
             })           
             _data = _griddatas;
             gridOptions.api.setRowData(_griddatas);     
             $scope.$apply();
         })
     }
 
     async function fetchDatas(sno) {
         const res = await cts.GET(`ct-production/production.php?limitr=${sno}`);
         return res;
     }
 
     $scope.groupupdate_handler = () => {
        let selectedrows = gridOptions.api.getSelectedRows();    
        console.log(selectedrows);
        localStorage.setItem("clprolist", JSON.stringify(selectedrows));        
        window.location.href = `${print_location}/Dashboard/Main/index.php#!/ctproductionentrynew`                
    }
    
    $scope.gropudelver_handler = () => {
        let selectedrows = gridOptions.api.getSelectedRows();    
        console.log(selectedrows);
        localStorage.setItem("clprolist", JSON.stringify(selectedrows));        
        window.location.href = `${print_location}/Dashboard/Main/index.php#!/ctrelease`                
    }
    document.getElementById("procurementreceipt_diashow").style.display = 'none';
    $scope.deliverdlistitem = [];
    $scope.viewhistory = async (id) => {
        $scope.deliverdlistitem = [];
        if ($scope.isrptloading) return;
        $scope.isrptloading = false;
        const res = await cts.GET(`ct-production/deliver-itemlist.php?outcno=${id}`);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isrptloading = false;
            $scope.$apply();
            return;
        }

        $scope.isrptloading = false;
        $scope.deliverdlistitem = res.data;
        $scope.$apply();
        
        document.getElementById("procurementreceipt_diashow").style.display = "flex";
    }
    $scope.procurementreceipt_diahide = () => {
        document.getElementById("procurementreceipt_diashow").style.display = 'none';
    }
    document.getElementById("delivery_update_diashow").style.display = "none";
    
    $scope.update_deliver = {
        outno: "",
        outdate : "",
        outqty : "",
        outarea : "",        
        outid : "",      
    }
    $scope.edit_deliver = (x) => {
        console.log(x);
        $scope.update_deliver = {
            outno: x.outno,
            outdate : x.outdate_d.normal,
            outqty : x.outqty,
            outarea:  x.outqty,            
            outid : x.outid,      
        }
        document.getElementById("delivery_update_diashow").style.display = "flex";
    }
    $scope.delivery_update_hide = () => {
        document.getElementById("delivery_update_diashow").style.display = "none";
    }
    $scope.update_delivery_handler = async () => {
        if ($scope.isrptloading) return;
        $scope.isrptloading = true;
        const fd = new FormData();    
        fd.append('refno', document.getElementById("outno").value);
        fd.append('outdate', document.getElementById("outdate").value);
        fd.append('outqty', document.getElementById("outqty").value);
        fd.append('outarea', document.getElementById("outarea").value);

        const res = await cts.POST(`ct-production/deliver-update.php?outid=${$scope.update_deliver.outid}`, fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isrptloading = false;
            $scope.$apply();
            return;
        }

        alert("data has updated");
        $scope.isrptloading = false;
        $scope.$apply();
        location.reload();
        return;
    }

    $scope.remove_delivery = async (id) => {
        if ($scope.isrptloading) return;
        const c = confirm("Are You Sure Remove This Data?");
        if (!c) return;
        $scope.isrptloading = true;
        const res = await cts.GET(`ct-production/deliver-delete.php?id=${id}`);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isrptloading = false;
            $scope.$apply();
            return;
        }
        alert("Data Has Removed");
        $scope.isrptloading = false;
        $scope.$apply();
        location.reload();
        return;
    }

    $scope.printrpt = () => {
        let _data = [];    
        let _config = []
        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _data.push(_.data);
            _config.push(_);
        })     
        if (_data.length === 0) {
            alert("No data found");
            return;
        }
        let _bodywidth = _config[0].columnController.columnApi.columnController.columnApi.columnController.bodyWidth;
        let _columns = _config[0].columnController.columnApi.columnController.columnApi.columnController.autoRowHeightColumns;
        let fconfig = [];
        _columns.map((i) => {
            let cconf = {
                colid: i.colId,
                colwidth: i.actualWidth,
                colshow: i.visible,
                colname: i.userProvidedColDef.headerName
            };
            fconfig.push(cconf);
        });

        localStorage.setItem("pms_cl_production", JSON.stringify(_data));
        localStorage.setItem("pms_cl_production_config", JSON.stringify(fconfig));
        localStorage.setItem("pms_cl_production_bodywidth", _bodywidth.toString())
        const location = `${print_location}sprint/clproduction.html`;
        //console.log(location);
        window.open(location, '_blank', "width:1300,height:600");        
    }

    
}