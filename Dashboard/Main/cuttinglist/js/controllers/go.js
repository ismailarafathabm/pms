import cuttinglistservices from "../services/index.js";
import * as models from './models.js';
export default function enggo($scope, $compile) {
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
    const cts = new cuttinglistservices();
    let access = {};
    const columnDefs = models.rptcolsgo($scope, access, $compile);
    const gridOptions = cts.gridoptions(columnDefs);
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
            var mname = `Glass Orders : ${$scope.viewproject.project_name}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }
    
    $scope.isloading = false;
    const gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);
    LoadRpt();
    async function LoadRpt() {
        gridOptions.api.setRowData([]);
        if ($scope.isloading) return;
        $scope.isloading = true;
        const res = await cts.GET('cuttinglists/goindex.php');
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isloading = false;
            $scope.$apply();
            return;
        }        
        $scope.isloading = false;
        gridOptions.api.setRowData(res.data);
        $scope.$apply();
        return;
    }

    $scope.updatestatus = {
        diashow : false,
        isloading: false,
        btn : 'Update',
        data: {
            flagstatus: '', 
            issuedate_update : '', 
            reserved_update : '',             
            id : '', 
        }        
    }
    $scope.changestatus = (id, status, date1, date2) => {
        console.log(id, status, date1, date2)
        $scope.updatestatus = {
            diashow : true,
            isloading: false,
            btn : 'Update',
            data: {
                flagstatus: status, 
                issuedate_update : date1, 
                reserved_update : date2,             
                id : id, 
            }        
        }
    }

    $scope.changediastatus = (s) => {
        $scope.updatestatus = {
            diashow : s,
            isloading: false,
            btn : 'Update',
            data: {
                flagstatus: '', 
                issuedate_update : '', 
                reserved_update : '',             
                id : '', 
            }        
        }
    }

    $scope.updatestatusSubmit = async () => {
        if ($scope.updatestatus.isloading) return;
        $scope.updatestatus = {
            ...$scope.updatestatus,
            isloading: true,
            data: {
                ...$scope.updatestatus.data,
            }
        };
        const fd = new FormData();
        fd.append('payload', JSON.stringify($scope.updatestatus.data));
        const res = await cts.POST(`cuttinglists/gostatusupdate.php?goid=${$scope.updatestatus.data.id}`,fd)
        if (res?.msg !== 1) {
            $scope.updatestatus = {
                ...$scope.updatestatus,
                isloading: false,
                data: {
                    ...$scope.updatestatus.data,
                }
            };
            $scope.$apply();
            return;
        }
        $scope.updatestatus = {
            ...$scope.updatestatus,
            isloading: false,
            data: {
                ...$scope.updatestatus.data,
            }
        };
        LoadRpt();
        $scope.$apply();
        return;
    }
    $scope.updatestatusx = {
        diashow : false,
        isloading : false,
        btn : 'Update',
        data : {
            flagstatus : "0",
            issuedate_update : ""
        }
    }
    $scope.changediastatusx = (x) => {
        $scope.updatestatusx = {
            diashow : x,
            isloading : false,
            btn : 'Update',
            data : {
                flagstatus : "0",
                issuedate_update : ""
            }
        }
    }
    $scope.updateStatusdep = (id, flag, xdate) => {
        console.log(id, flag, xdate);
        $scope.updatestatusx = {
            diashow : true,
            isloading : false,
            btn : 'Update',
            data : {
                id : id,
                flagstatus : flag,
                issuedate_update : xdate
            }
        }
        
    }


    $scope.updatestatusxSubmit = async() => {
        if ($scope.updatestatusx.isloading) return;
        $scope.updatestatusx = {
            ...$scope.updatestatusx,
            isloading: true,
            data: {
                ...$scope.updatestatusx.data,
            }
        };
        const fd = new FormData();
        fd.append('payload', JSON.stringify($scope.updatestatusx.data));
        const res = await cts.POST(`cuttinglists/gostatusupdated.php?goid=${$scope.updatestatusx.data.id}`,fd)
        if (res?.msg !== 1) {
            $scope.updatestatusx = {
                ...$scope.updatestatusx,
                isloading: false,
                data: {
                    ...$scope.updatestatusx.data,
                }
            };
            $scope.$apply();
            return;
        }
        $scope.updatestatusx = {
            ...$scope.updatestatusx,
            isloading: false,
            data: {
                ...$scope.updatestatusx.data,
            }
        };
        LoadRpt();
        $scope.$apply();
        return;
    }

    $scope.goupload = {
        isloading: false,
        diashow: false,
    }

    $scope.gouploadx = (status) => {
        $scope.goupload = {
            isloading: false,
            diashow: status,
        }
    }
    let goidx = "";
    $scope.uploadpdfgox = (id) => {
        console.log(id);
        goidx = id;
        $scope.goupload = {
            isloading: false,
            diashow: true,
        }    
    }

    $scope.uploadgosubmit = async() => {
        const fd = new FormData(
            document.getElementById("uploadgo")
        );

        const res = await cts.POST(`cuttinglists/gopdf.php?goid=${goidx}`, fd);
        if (res?.msg !== 1) {
            return;
        }
        alert("upload Done");
        LoadRpt();
        $scope.$apply();
        return;
    }

    $scope.editx = (id) => {
        const location = `${print_location}Dashboard/Main/index.php#!/enggonew/${id}/E`;
        console.log(location);
       // window.open(location, "_blank", "widht:1200px;height:400px");
       window.location.href= location;
    }

    

    
}