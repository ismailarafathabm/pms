import cuttinglistservices from "../../../cuttinglist/js/services/index.js";
export default function gonewengp($scope, $http) {
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

    //get project inforamtions
    $scope.currentproject = {};
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
                console.log($scope.viewproject);
                //console.log($scope.viewproject);
                localStorage.removeItem("currentproject");
                localStorage.setItem("pms_currentproject", JSON.stringify($scope.viewproject));

                //console.log($scope.viewproject);
                $scope.newproject = res.data.data;
                GetRowCount($scope.newproject.project_no);
                
                //console.log($scope.ts);                
                //LoadReports(res.data.data.project_no);
            } else {
                alert(res.data.data);
            }
        });
    }

    const cts = new cuttinglistservices();
    $scope.gosdata = [];
    $scope.isrptloading = false;
    let splitval = 500;
    let rowcount = 0;
   
    async function GetRowCount(project_no) {
        console.log(project_no);
        const res = await cts.GET(`gos/indexp.php?goproject=${project_no}`);
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
       
        LoadReports(rowstart,project_no)
        $scope.$apply();
    }

    async function LoadReports(x,project_no) {
        $scope.isrptloading = true;
        let _griddatas = [];
        x.map(async (i) => {
            const res = await fetchDatas(i,project_no);
            res.data.map(k => {
                _griddatas.push(k);
            })
            $scope.gosdata = _griddatas;
            if (_griddatas.length === rowcount) {
                $scope.isrptloading = false;
                $scope.$apply();
            }
            
        })
    }

    async function fetchDatas(sno,project_no) {
        const res = await cts.GET(`gos/gosp.php?limitr=${sno}&goproject=${project_no}`);
        return res;
    }


  

    $scope.focusothers = ($event, crow, ccol) => {
        const rcnt = $scope.gosdata.length;
        const ccnt = 19;
        const li = ccol - 1
        const ri = ccol + 1;
        const ui = crow - 1;
        const di = crow + 1;
        const left_item = `gotype_${crow}_${li}`;
        const right_item = `gotype_${crow}_${ri}`;
        const top_item = `gotype_${ui}_${ccol}`;
        const down_item = `gotype_${di}_${ccol}`;
        
        switch ($event.which) {
            case 13:
            case 39:
                if (ccnt !== ccol) {
                    document.getElementById(right_item).focus();
                }
                break;
            case 37:
                if (ccol !== 0) {
                    document.getElementById(left_item).focus();
                }
                break;
            case 38:
                if (crow !== 0) {
                    document.getElementById(top_item).focus();
                }
                break;
            case 40:
                if (crow !== rcnt) {
                    document.getElementById(down_item).focus();
                }
                break;
            default:
                console.log("Not Found")
                break;
                
        }
    }

    //add multi row
    
    async function AddMultiplerows() {
        const totrows = $scope.totnewrow ?? '';
        if (!totrows || totrows === '' || (+totrows) === 0) {
            alert("Enter Totla Rows");
            return;
        }
        const fd = new FormData();
        fd.append("goprojectid", $scope.viewproject.project_id);
        fd.append("goproject", $scope.viewproject.project_no);
        fd.append("goprojectname", $scope.viewproject.project_name);
        fd.append("goprojectlocation", $scope.viewproject.project_location);
        fd.append("totrows", totrows);
        $scope.isrptloading = true;
        const res = await cts.POST('gos/newgopm.php', fd);
        console.log(res);
        $scope.isrptloading = true;
        GetRowCount($scope.newproject.project_no);
        $scope.$apply();
    }

    $scope.addmulirows = () => {
        if ($scope.isrptloading) return;
        AddMultiplerows();
    }

    $scope.copyrow = async (x) => {
        const c = confirm("Are You Sure Dublicate This Item?");
        if (!c) return;
        const fd = new FormData();
        fd.append("payload", JSON.stringify(x));
        const res = await cts.POST('gos/newgo.php', fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        console.log(res.data);
        GetRowCount($scope.newproject.project_no);
        $scope.$apply();
        return;
    }

    $scope.removerow = async (id) => {
        const c = confirm("Are You Sure Remove This Data ?");
        if (!c) return;
        const cf = confirm("Are You Sure Re Conform Delete this Data?");
        if (!cf) return;
        const res = await cts.GET(`gos/remove.php?goid=${id}`);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        GetRowCount($scope.newproject.project_no);
        $scope.$apply();
        return;
    }

    $scope.isselected = false;
    $scope.selectedDatas = []
    function checkboxactions() {
        $scope.selectedDatas = []
        $scope.selectedDatas = $scope.gosdata.filter(x => x.goidstatus);
       /// console.log(filtersdata);
        $scope.isselected =  $scope.selectedDatas.length === 0 ? false : true;
    }
    $scope.checkStatusall = () => {
        checkboxactions()
    }

    $scope.selordel = () => {
        const _status = $scope.xallx ?? false;
        $scope.gosdata.map(x => x.goidstatus = _status);
        checkboxactions()
    }

    $scope.bulk_update = async (x) => {
        const fd = new FormData();
        fd.append("payload", JSON.stringify(x));
        const res = await cts.POST(`gos/updatex.php?goid=${x.goid}`, fd);
        console.log(res);
    }

    $scope.removeSelected = async () => {
        if ($scope.isrptloading) false;
        const c = confirm("Are You Sure Remove This Data ?");
        if (!c) return;
        const cf = confirm("Are You Sure Re Conform Delete this Data?");
        if (!cf) return;
        let ids = [];
        $scope.selectedDatas.map(x => {
            ids.push(x.goid);
        })
        $scope.isrptloading = true;
        const fd = new FormData();
        fd.append("ids", JSON.stringify(ids));
        const res = await cts.POST("gos/removeb.php", fd);
        if (res?.msg !== 1) {
            $scope.isrptloading = false;
            alert(res.data);
            return;
        }
        GetRowCount($scope.newproject.project_no);
        $scope.isrptloading = false;
        $scope.$apply();       
        
    }
    $scope.goupload = {
        diashow: false,
        isloading: false,
    }
    let currentgo = {};
    $scope.fileupload = (x) => {
        $scope.goupload = {
            diashow: true,
            isloading: false,
        }
        currentgo = x;
    }

    $scope.uploadgosubmit = async() => {
        const fd = new FormData(
            document.getElementById("uploadgo")
        );

        const res = await cts.POST(`cuttinglists/gopdf.php?goid=${currentgo.goid}`, fd);
        if (res?.msg !== 1) {
            return;
        }
        alert("upload Done");        
        $scope.$apply();
        return;
    }

    $scope.getolddatas = async () => {
        const pjno = document.getElementById("goproject").value;
        if (pjno === '') return
        await getolddatasforproject(pjno);        
    }

    async function getolddatasforproject(pjno){
        
    }
}