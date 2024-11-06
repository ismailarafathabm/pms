import UnitControllers from './controllers/unit.js';
import _ from './service/index.js';

export default function masterlogunits($scope, $compile) {
    const page = "masterlog";
    let uc = new UnitControllers();
    let us = new _();
    //-init
    $scope.unitdata = uc.setUnitData(false);
    $scope.calbytype = uc.setCalbytype();
    console.log($scope.calbytype);
    $scope.unitview = uc.setUnitView(false, "N");
    const ism_dia_ml_units = document.getElementById("ism_dia_ml_units");
    ism_dia_ml_units.style.display = "none";
    //--page functions    
    async function LoadAllUnits() {
        await uc.loadAllUnits($scope,gridOptions);
        // if ($scope.unitdata.isloading) { console.log("already Running..."); return; }
        // $scope.unitdata = uc.setUnitData(true);
        // const res = await us.servicecall(page, "unitsall");
        // console.log(res);
        // if (res?.msg !== 1) {
        //     $scope.unitdata = uc.setUnitData(true);
        //     $scope.$apply();
        //     alert(res?.data);
        //     return;
        // }
        // const fdata = uc.finaldata(res.data ?? []);
        // console.log(fdata);
        // $scope.unitdata = uc.setUnitData(false, fdata);
        // gridOptions.api.setRowData(fdata);
        // $scope.$apply();

    }

    $scope.editunit = async (id) => {
        await uc.unitinfoget($scope, id, ism_dia_ml_units);
    }


    $scope.addnewunit_click = () => {
        console.log("working");
        var _ndata = {
            unitid: "0",
            unitdesc: "",
            calcby: "",
            unitdisplay: "",
        }
        $scope.unitview = uc.setUnitView(false, "N", 'Save', 'Add New Unit', _ndata);
        document.getElementById("unitdesc").focus();
        ism_dia_ml_units.style.display = "flex";
    }



    $scope.savenewunit_click = () => {
        if ($scope.unitview.isloading) {
            alert("Already Process is Running");
            return;
        }
        const validate = uc.unitformvalidate();
        if (validate === 0) { return; }
        if ($scope.unitview.mode === "N") {
            uc.saveunit($scope,gridOptions);
        } else {
            uc.updateunit($scope,gridOptions);
        }
    }
    //--grid works
    var filterParams = {
        comparator: function (filterLocalDateAtMidnight, cellValue) {
            var dateAsString = cellValue;
            var dateParts = dateAsString.split('-');
            var cellDate = new Date(
                Number(dateParts[0]),
                Number(dateParts[1]) - 1,
                Number(dateParts[2])
            );

            if (filterLocalDateAtMidnight.getTime() === cellDate.getTime()) {
                return 0;
            }

            if (cellDate < filterLocalDateAtMidnight) {
                return -1;
            }

            if (cellDate > filterLocalDateAtMidnight) {
                return 1;
            }
        },
    };
    var columnDefs = uc.unitcolumns($compile,$scope);
    
   
    const gridOptions = us.gridoptions(columnDefs);
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

            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();
            var mname = `Factory To Paint Plant  AS ON DATE ${day}-${month}-${year}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: mname,
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }

    const gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    LoadAllUnits();
}