import cuttinglistservices from "../services/index.js";
import * as models from './models.js';
export default function Cuttinglistsimport($scope, $compile) {    
    const cts = new cuttinglistservices();
    let access = {};
    const columnDefs = models.rptcols($scope, access, $compile);
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


    //LoadReports();
    let splitval = 500;
    $scope.isrptloading = false;
    const gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);
    // LoadData()
    // async function LoadData() {
    //     const res = await cts.GET("cuttinglists/indexct.php");
    //     if (res?.msg !== 1) {
    //         alert(res.data);
    //         return;
    //     }
    //     gridOptions.api.setRowData(res.data);
    //     return;
    // }
    GetRowCount()
    let rowcount = 0;
    async function GetRowCount() {
        const res = await cts.GET("cuttinglists/ctrows.php");
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
        //gridOptions.api.setRowData(res.data);
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
        const res = await cts.GET(`cuttinglists/index.php?nrows=${sno}`);
        return res;
    }

    //edit model
    function setupdateStatus(status) {
        $scope.updatestatus = {
            ...$scope.updatestatus,
            diashow: status,
            data: {
                ...$scope.updatestatus.data
            }
        };
    }
    $scope.changediastatus = (status) => {
        setupdateStatus(status);
    }
    //$scope.account_flag
    $scope.updatestatus = {
        diashow : false,
        isloading: false,
        type: "account_flag",
        title: "Save",
        btn : 'Update',
        data: {
            type : "account_flag",
            ct_no: '',
            ct_mono: '',
            flag: '',
            issued : '',
            return: '', 
            moid: "",
            mono: "",
            project : "",
            materialstatus: "",
            materialrefno : ""
        }
    }
    $scope.changestatus = (
        type, id, mono, flag, projectid, title, sdate = '', ydate = '',
        materialstatus = "", materialrefno = ""
        ) => {
        console.log(type, id, mono, flag, projectid, title,materialrefno);
        setupdateStatus(true);
        const lf = ""+flag.toString();
        $scope.updatestatus = {
            ...$scope.updatestatus,
            title: title,
            type: type,
            data: {
                ...$scope.updatestatus.data,
                ct_no: id,                
                ct_mono: mono,
                flagstatus: lf,
                issuedate_update: sdate,
                reserved_update: ydate,
                materialstatus: materialstatus,
                materialrefno: materialrefno,
                project : projectid, 
            }
        };
        console.log($scope.updatestatus);
    }

    $scope.updatestatusSubmit = async () => {
        if ($scope.updatestatus.isloading) return;
        $scope.updatestatus = {
            ...$scope.updatestatus,
            data: {
                ...$scope.updatestatus.data,                
            },
            isloading: true
        }
        const fd = new FormData();
        fd.append("payload", JSON.stringify($scope.updatestatus.data));        
        const res = await cts.POST(`cuttinglists/updateflag.php?ftype=${$scope.updatestatus.type}&ct_no=${$scope.updatestatus.data.ct_no}`, fd);

        if (res.msg !== 1) {
            $scope.updatestatus = {
                ...$scope.updatestatus,
                data: {
                    ...$scope.updatestatus.data,                
                },
                isloading: false
            }
            alert(res.data);
            $scope.$apply();
            return;
        }

        $scope.updatestatus = {
            ...$scope.updatestatus,
            data: {
                ...$scope.updatestatus.data,                
            },
            isloading: false
        }
        $scope.$apply();
        alert("saved");
        //LoadReports();
        return;
    }
    $scope.editmode = (id) => {
        const location = `${print_location}Dashboard/Main/index.php#!/cuttinglistsnew/${id}/E`;
        //console.log(location);
        window.open(location, '_blank', "width:1300,height:600");
        //window.location.href = location;
        //window.open(location,"_blank","widht:1200px;height:400px");
    }

    $scope.superseedmode = (id) => {
        const location = `${print_location}Dashboard/Main/index.php#!/cuttinglistsnew/${id}/S`;
        console.log(location);
        window.open(location, '_blank', "width:1300,height:600");
        //window.location.href = location;
        //window.open(location,"_blank","widht:1200px;height:400px");
    }

    let currentproject = "";
    let currentmo = "";
    let currentct = "";
    $scope.mouploads = {
        isloading: false,
        diashow : false
    }

    $scope.uploadmox = (project,mo) => {
        console.log(project, mo);
        $scope.mouploads = {
            isloading: false,
            diashow : true
        }
        ///$scope.$apply();
        currentmo = mo;
        currentproject = project;
        console.log($scope.mouploads)

    }

    $scope.mouploadsx = () => {
        console.log("working");
        $scope.mouploads = {
            isloading: false,
            diashow : false
        }
    }
    
    $scope.uploadmosubmit = async () => {
        const fd = new FormData(
            document.getElementById("uploadmo")
        );

        console.log(fd);

        const res = await cts.POST(`cuttinglists/mopdf.php?mo=${currentmo}&project=${currentproject}`, fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        alert("File Upload successfully")
       // LoadReports();
        $scope.$apply();
        return;
    }

    $scope.uploadctpdfsubmit = async () => {
        const fd = new FormData(
            document.getElementById("uploadctpdf")
        );

        const res = await cts.POST(`cuttinglists/ctpdf.php?ctno=${currentct}`, fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        alert("Uploaded");
        //LoadReports();
        $scope.$apply();
        return;
    }

    $scope.ctuploads = {
        diashow: false,
        isloading : false,
    }

    $scope.uploadcuttinglist = (id) => {
        $scope.ctuploads = {
            diashow: true,
            isloading : false,
        }

        currentct = id;
    }

    $scope.ctuploadsx = (status) => {
        $scope.ctuploads = {
            diashow: status,
            isloading : false,
        }
    }

    
}