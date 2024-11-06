import cuttinglistservices from "../services/index.js";
import * as models from './models.js';
export default function cuttinglistsp($scope, $http, $compile) {

    const cts = new cuttinglistservices();
    let access = {};
    const columnDefs = models.rptcols($scope, access, $compile);
    const gridOptions = cts.gridoptions(columnDefs);
    gridOptions['rowSelection'] = 'multiple';
    gridOptions['onSelectionChanged'] = onSelectionChanged;
    $scope.isselectedrows = false;
    $scope.sumof = {
        totitem: 0,
        sumof_area: 0
    };
    function onSelectionChanged() {
        $scope.sumof = {
            totitem: 0,
            sumof_area: 0
        };
        const _rows = gridOptions.api.getSelectedRows();
        if (_rows.length !== 0) {
            $scope.isselectedrows = true;
        } else {
            $scope.isselectedrows = false;
        }
        console.log(_rows);
        let sumof_qty = 0;
        let sumof_area = 0;
        _rows.map(i => {
            sumof_qty += (+i.ct_qty);
            console.log(i.ct_area);
            sumof_area += (+i.ct_area);
        })

        $scope.sumof = {
            totitem: sumof_qty,
            sumof_area: sumof_area,
        }
        $scope.$apply();
        //console.log($scope.sumof);
    }

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
    $scope.isrptloading = false;
    const gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);
    get_projectinfo()
    function get_projectinfo() {
        let project_id = sessionStorage.getItem("nafco_project_current");
        let post_data = {
            naf_user: userinfo,
            project_no: project_id
        }
        var req = $http.post(api_url + "Project/view.php", post_data);
        req.then(res => {
            //console.log(res.data);
            if (res.data.msg === "1") {
                $scope.viewproject = res.data.data;
                //console.log($scope.viewproject);
                localStorage.removeItem("currentproject");
                localStorage.setItem("pms_currentproject", JSON.stringify($scope.viewproject));

                //console.log($scope.viewproject);
                $scope.newproject = res.data.data;
                //console.log($scope.ts);
                //LoadReports(res.data.data.project_no);
                //LoadData(res.data.data.project_no)
                GetRowCount(res.data.data.project_no);
            } else {
                alert(res.data.data);
            }
        });
    }
    async function LoadReports(projectno) {
        if ($scope.isrptloading) return;
        $scope.isrptloading = true;
        const res = await cts.GET(`cuttinglists/indexp.php?projectno=${projectno}`);
        //console.log(res);
        if (res?.msg !== 1) {
            $scope.isrptloading = false;
            alert(res.data);
            return;
        }
        $scope.isrptloading = false;
        gridOptions.api.setRowData(res.data);
        $scope.$apply();
        return;
    }

    let splitval = 500;
    $scope.isrptloading = false;
    gridOptions.api.setRowData([]);
    //LoadData()
    async function LoadData(pjno) {
        const res = await cts.GET("cuttinglists/indexct.php?projectno=" + pjno);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        gridOptions.api.setRowData(res.data);
        return;
    }
    //GetRowCount()
    let rowcount = 0;
    async function GetRowCount(projectno) {
        const res = await cts.GET(`cuttinglists/ctrowsp.php?projectno=${projectno}`);
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

        LoadReports(rowstart, projectno);
        $scope.$apply();
        //gridOptions.api.setRowData(res.data);
    }
    async function LoadReports(x, projectno) {
        $scope.isrptloading = true;
        let _griddatas = [];
        x.map(async (i) => {
            const res = await fetchDatas(i, projectno);
            res.data.map(k => {
                _griddatas.push(k);
            })
            gridOptions.api.setRowData(_griddatas);

            if (_griddatas.length === rowcount) {
                let sumof_qty = 0;
                let sumof_area = 0;
                gridOptions.api.forEachNodeAfterFilterAndSort(d => {
                    const i = d.data;
                    sumof_qty += (+i.ct_qty);
                    console.log(i.ct_area);
                    sumof_area += (+i.ct_area);
                })

                $scope.sumof = {
                    totitem: sumof_qty,
                    sumof_area: sumof_area,
                }
                $scope.isrptloading = false;
                $scope.$apply();
            }

        })
    }

    async function fetchDatas(sno, projectno) {
        const res = await cts.GET(`cuttinglists/indexpn.php?nrows=${sno}&projectno=${projectno}`);
        return res;
    }
    $scope.changediastatus = (status) => {
        setupdateStatus(status);
    }
    $scope.updatestatus = {
        diashow: false,
        isloading: false,
        type: "account_flag",
        title: "Save",
        btn: 'Update',
        data: {
            type: "account_flag",
            ct_no: '',
            ct_mono: '',
            flag: '',
            issued: '',
            return: '',
            moid: "",
            mono: "",
            project: "",
            materialstatus: "",
            materialrefno: ""
        }
    }


    $scope.xupdatestatus = {
        diashow: false,
        isloading: false,
        type: "account_flag",
        title: "Save",
        btn: 'Update',
        data: {
            type: "account_flag",
            ct_no: '',
            ct_mono: '',
            flag: '',
            issued: '',
            return: '',
            moid: "",
            mono: "",
            project: "",
            materialstatus: "",
            materialrefno: ""
        }
    }
    function setupdateStatus(status) {
        $scope.updatestatus = {
            ...$scope.updatestatus,
            diashow: status,
            data: {
                ...$scope.updatestatus.data
            }
        };
    }

    $scope.changestatus = (
        type, id, mono, flag, projectid, title, sdate = '', ydate = '',
        materialstatus = "", materialrefno = ""
    ) => {
        console.log(type, id, mono, flag, projectid, title, materialrefno);
        setupdateStatus(true);
        const lf = "" + flag.toString();
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
                project: projectid,
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
        console.log(location);
        //localStorage.setItem("pagemode", 'P');
        window.open(location, '_blank', "width:1300,height:600");
        //window.location.href = location;
        //window.open(location,"_blank","widht:1200px;height:400px");
    }

    $scope.superseedmode = (id) => {
        const location = `${print_location}Dashboard/Main/index.php#!/cuttinglistsnew/${id}/S`;
        console.log(location);
        //localStorage.setItem("pagemode", 'P');
        window.open(location, '_blank', "width:1300,height:600");
        //window.location.href = location;
        //window.open(location,"_blank","widht:1200px;height:400px");
    }

    let currentproject = "";
    let currentmo = "";
    let currentct = "";
    $scope.mouploads = {
        isloading: false,
        diashow: false
    }

    $scope.uploadmox = (project, mo) => {
        console.log(project, mo);
        $scope.mouploads = {
            isloading: false,
            diashow: true
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
            diashow: false
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
    let current_pjno = "";
    let current_ctno = "";
    $scope.uploadctpdfsubmit = async () => {
        const fd = new FormData(
            document.getElementById("uploadctpdf")
        );       

        const res = await cts.POST(`cuttinglists/ctpdf.php?ctno=${currentct}&ct_no=${current_ctno}&ctprojectno=${current_pjno}&ctmono=${currentmo}`, fd);
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
        isloading: false,
    }

    $scope.uploadcuttinglist = (id,pj,ctno,mono) => {
        $scope.ctuploads = {
            diashow: true,
            isloading: false,
        }

        currentct = id;
        current_ctno = ctno;
        current_pjno = pj;
        currentmo = mono
    }

    $scope.ctuploadsx = (status) => {
        $scope.ctuploads = {
            diashow: status,
            isloading: false,
        }
    }
    //need to update
    let ids = [];
    let mos = [];
    $scope.updateType = [
        {
            'flag': 'account_flag',
            'title': 'Accounts'
        },
        {
            'flag': 'matterial_flag',
            'title': 'Materials'
        },
        {
            'flag': 'operation_flag',
            'title': 'Operations'
        },
        {
            'flag': 'production_flag',
            'title': 'Productions'
        },
    ];
    let selectedrows = []
    $scope.changestatusgroup = async () => {       
        selectedrows = gridOptions.api.getSelectedRows();    
        localStorage.setItem("ctlist", JSON.stringify(selectedrows));        
        window.location.href = `${print_location}/Dashboard/Main/index.php#!/cuttinglistsupdates`        
        
    }


    $scope.isdeleting = false;
    $scope.removeData = async (id) => {
        if ($scope.isdeleting) return;

        const c = confirm("Are You Sure to Remove This Data?");
        if (!c) return;

        const rc = confirm("Please Re-conform , Are You sure Remove This Data?")
        if (!rc) return;
        $scope.isdeleting = true;
        const res = await cts.GET(`cuttinglists/cldelete.php?id=${id}`);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isdeleting = false;
            $scope.$apply();
            return;
        }
        
        $scope.isdeleting = false;
        $scope.$apply();
        alert("Data Has Removed.");
        window.location.reload();
        return;

    }
}