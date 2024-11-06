import cuttinglistservices from "../../../cuttinglist/js/services/index.js";
import * as engi from './releasemodel.js';
export default function boqrelease($scope, $http) {
    const eng = new cuttinglistservices();
    $scope.ispageloading = false;
    $scope.isloaded = false;
    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: "DD-MM-YYYY",
        defaultDisplay: "gregorian",
    };

    moment.locale("en");
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    moment.locale("en");
    //moment.locale('ar-sa');

    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };

    function getToday() {
        const _d = new Date();
        return `${_d.getDate()}-${_d.getMonth() - 1}-${_d.getFullYear()}`
    }
    $scope.boqitems = [];
    $scope.boqeng = engi.engrelease;
    get_projectinfo();
    function get_projectinfo() {
        let project_id = sessionStorage.getItem("nafco_project_current");
        let post_data = {
            naf_user: userinfo,
            project_no: project_id,
        };
        var req = $http.post(api_url + "Project/view.php", post_data);
        var req = $http.post(api_url + "Project/view.php", post_data);
        req.then((res) => {
            if (res.data.msg === "1") {
                $scope.viewproject = res.data.data;
                //console.log($scope.viewproject);
                localStorage.removeItem("currentproject");
                localStorage.setItem(
                    "pms_currentproject",
                    JSON.stringify($scope.viewproject)
                );
                $scope.boqeng = {
                    ...$scope.boqeng,
                    boqeng_project_id: res.data.data.project_id,
                    boqeng_projectno: res.data.data.project_no,
                    boqeng_projectnoenc: res.data.data.project_no_enc,
                    boqeng_projectname: res.data.data.project_name,
                    boqeng_projectlocation: res.data.data.project_location,
                    boqeng_enggname: userinfo.user_name
                };
                GetBoqs();
            } else {
                alert(res.data.data);
                window.location.href = `${print_location}/Dashboard/Main/index.php`;
            }
        });
    }
    async function GetBoqs() {
        const _pjno = sessionStorage.getItem("nafco_project_current");
        const res = await eng.GET('bomn/boqs.php?projectno=' + _pjno);
        if (res?.msg !== 1) {
            alert("Error on Getting BOQ Items.");
            return;
        }
        $scope.boqitems = res.data;
        $scope.$apply();
        return;
    }
    $scope.getBoqinfo = () => {
        let boqid = document.getElementById("boqeng_boqid").value;
        if (boqid === '') {
            return;
        }
        GetBoqinfo(boqid);
    }
    
    $scope.currentboqitem = {
        data: {},
        notes: [],
    };
    async function GetBoqinfo(boqid) {
        $scope.currentboqitem = {
            data: {},
            notes: [],
        };
        if ($scope.ispageloading) return;
        $scope.ispageloading = true;
        const fd = new FormData();
        fd.append("user_name", userinfo.user_name);
        fd.append("user_token", userinfo.user_token);
        fd.append("boqid", boqid);
        const res = await eng.POST('index.php?page=mr&f=boqinfo', fd);
        if (res.msg !== 1) {
            alert(res.data);
            $scope.isloaded = false;
            $scope.ispageloading = false;
            return;
        }
        $scope.isloaded = true;
        $scope.ispageloading = false;
        $scope.boqeng = {
            ...$scope.boqeng,
            boqeng_boqid: boqid,
        };
        $scope.boqinfo_dia = {
            data: res.data.boq,
            notes: res.data.notes,
        };
        
        $scope.$apply();
        await GetTotReleased(boqid);
        return;
    }

    $scope.previous_release = {
        qty: 0,
        area: 0,
    }
    //need to get before released area
    async function GetTotReleased($boqid) {
        $scope.previous_release = {
            qty: 0,
            area: 0,
        }
        const res = await eng.GET(`boqneng/index.php?boqid=${$boqid}`);
        if (res?.msg !== 1) {
            $scope.previous_release = {
                qty: 0,
                area: 0,
            }
            return;
        }
        $scope.previous_release = {
            qty: res.data.tot_qty,
            area: res.data.tot_area,
        }
        $scope.$apply();
        calfun()
        return;

    }

    $scope.bal = {
        qty: 0,
        area: 0,
    };

    function calfun() {
        const pr_qty = $scope.previous_release?.qty ?? 0;
        const pr_area = $scope.previous_release?.area ?? 0;
        let boqeng_qty = document.getElementById("boqeng_qty").value;
        if (boqeng_qty === '') {
            boqeng_qty = 0;
        }
        ///const boqeng_area = document.getElementById('boqeng_area').value;
        const boqqty = $scope.boqinfo_dia?.data?.poq_qty ?? 0;
        const boqarea = $scope.boqinfo_dia?.data?.area ?? 0;

        const boq_width = $scope.boqinfo_dia?.data?.poq_item_width ?? 0;
        const boq_height = $scope.boqinfo_dia?.data?.poq_item_height ?? 0;
        const boq_area = (+boq_width) * (+boq_height);
       

        
        if (boqqty === '') return;
        if (boqarea === '') return;
        if (pr_qty === '') return;
        if (pr_area === '') return;
        if (boqeng_qty === '') return;
        //if (boqeng_area === '') return;
        const boqtot_area = (+boq_width) * (+boq_height) *boqqty ;
        const eng_rele_area = (+boqeng_qty) * (+boq_area);        
        const totrelease_qty = (+pr_qty) + (+boqeng_qty);
        const totrelease_area = (+pr_area) + (+eng_rele_area);
        const bal_qty = (+boqqty) - (+totrelease_qty);
        const bal_area = (+boqtot_area) - (+totrelease_area);
        $scope.boqeng = {
            ...$scope.boqeng,
            boqeng_area : eng_rele_area
        }
        $scope.bal = {
            qty: bal_qty,
            area: bal_area,
        }
    }
    $scope.calcbal = () => {       
        calfun()
    }

    $scope.saveRelease = () => {
        saveEngBoq();
    }

    async function saveEngBoq() {
        const fd = new FormData();
        fd.append("payload", JSON.stringify($scope.boqeng));
        const res = await eng.POST(`boqneng/release.php`, fd);
        if (res?.msg !== 1) {
            alert(res.data);            
            return;
        }
        alert(res.data);
        location.reload();
        return;
    }


    
   
    
    
    
}