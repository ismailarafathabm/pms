import GlassSupplierServices from './../services/suppliers.js';
import GONServices from './../services/gon.js'
export default function gonpnew($scope, $http) {
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

    
    const gs = new GlassSupplierServices();
    const gns = new GONServices();
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
                localStorage.removeItem("currentproject");
                localStorage.setItem("pms_currentproject", JSON.stringify($scope.viewproject));

                console.log($scope.viewproject);
                $scope.newproject = res.data.data;

            } else {
                alert(res.data.data);
            }
        });
    }

    //supplier actions    
    $scope.supplierlist = [];
    loadAllSuppliers();
    async function loadAllSuppliers() {
        const res = await gs.getAllGlassSuppliers();
        console.log(res);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }

        $scope.supplierlist = res.data ?? [];
        $scope.$apply();
    }


    //get glass go list
    $scope.golist = [];
    getallgolist();
    async function getallgolist() {
        const fd = gns.FormData();
        fd.append("gonproject", sessionStorage.getItem('nafco_project_current_sno'));
        const res = await gns.projectgon(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }

        $scope.golist = res.data;
        $scope.$apply();
        return;
    }

    $scope.gopn = {
        isloading: false,
        btn: 'Save',
        mode: 1,
        data: {
            gonp_id: 0,
            gonp_type: "",
            gonp_date: "",
            gonp_gorefno: "",
            gonp_supplier: "",
            gonp_gthk: "",
            gonp_gout: "",
            gonp_gin: "",
            gonp_gcotting: "",
            gonp_qty : "",
            gonp_area: "",
            gonp_remarks: "",
            gonp_location: "",
            gonp_eta: "",
            gonp_ppsqm: "",
            gonp_pptotal: "",
            gonp_ppextra: "",
            gonp_pjcno: sessionStorage.getItem('nafco_project_current_sno'),
            gonp_eby: "",
            gonp_cdate: "",
            gonp_edat : "",
            gonp_status: "",
            gonp_goid: "",
        }
    }
    $scope.currentglass = {};
    $scope.getgoinfo = () => {
        $scope.currentglass = {};
        const gonp_goid = $scope.gopn?.data?.gonp_goid ?? "";
        $scope.currentglass = $scope.golist.find(x => x.gonewid === gonp_goid);
        $scope.gopn = {
            ...$scope.gopn,
            data: {
                ...$scope.gopn.data,
                gonp_supplier: $scope.currentglass?.glasssupplierid ?? "",
                gonp_qty: $scope.currentglass?.gonqty ?? 0,
                gonp_gorefno : $scope.currentglass?.gonorderno ?? "-"
            }
        }
        console.log($scope.currentglass,$scope.gopn);
    }

    const frmvalidate = () => {
        return 1;
    }

    $scope.save_ponew = async() =>{
        if ($scope.gopn.isloading) {
            console.log("Already Previous Process running");
            return;
        }
        console.log("called");
        if ($scope.gopn.mode === 1) {
            await saveaction();
            return;
        }
        await updateactions();
        return;
    }

    $scope.calsum = () => {
        const _gonp_area = document.getElementById("gonp_area");
        const _gonp_ppsqm = document.getElementById("gonp_ppsqm");
        const _gonp_pptotal = document.getElementById("gonp_pptotal");
        const _gonp_ppextra = document.getElementById("gonp_ppextra");
        const _gofinal = document.getElementById("gofinal");

        const gonp_area = _gonp_area.value.trim() === "" ? 0 : _gonp_area.value;
        const gonp_ppsqm = _gonp_ppsqm.value.trim() === "" ? 0 : _gonp_ppsqm.value;
        let gonp_pptotal = _gonp_pptotal.value.trim() === "" ? 0 : _gonp_pptotal.value;
        const gonp_ppextra = _gonp_ppextra.value.trim() === "" ? 0 : _gonp_ppextra.value;
        let gofinal = _gofinal.value.trim() === "" ? 0 : _gofinal.value;

        gonp_pptotal = (+gonp_ppsqm) * (+gonp_area);
        gofinal = (+gonp_ppextra) + (+gonp_pptotal);

        $scope.gopn = {
            ...$scope.gopn,
            data: {
                ...$scope.gopn.data,
                gonp_pptotal: Math.round(gonp_pptotal),              
            }
        }

        $scope.gofinal = Math.round(gofinal);



    }
    async function saveaction() {
        const _xval = frmvalidate();
        if (_xval !== 1) {
            return;
        }
        $scope.gopn = {
            ...$scope.gopn,
            isloading: true,
            data: { ...$scope.gopn.data },
        };
        const fd = gns.FormData();
        fd.append("payload", JSON.stringify($scope.gopn.data));
        const res = await gns.savegopn(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.gopn = {
                ...$scope.gopn,
                isloading: false,
                data: { ...$scope.gopn.data },
            };
            $scope.$apply();
            return;
        }
        alert("Data Has Saved");
        $scope.currentglass = {};
        $scope.gopn = {
            isloading: false,
            btn: 'Save',
            mode: 1,
            data: {
                gonp_id: 0,
                gonp_type: "",
                gonp_date: "",
                gonp_gorefno: "",
                gonp_supplier: "",
                gonp_gthk: "",
                gonp_gout: "",
                gonp_gin: "",
                gonp_gcotting: "",
                gonp_qty: "",
                gonp_area: "",
                gonp_remarks: "",
                gonp_location: "",
                gonp_eta: "",
                gonp_ppsqm: "",
                gonp_pptotal: "",
                gonp_ppextra: "",
                gonp_pjcno: sessionStorage.getItem('nafco_project_current_sno'),
                gonp_eby: "",
                gonp_cdate: "",
                gonp_edat: "",
                gonp_status: "",
                gonp_goid: "",
            }
        };
        $scope.gofinal = "";
        $scope.$apply();
        return;
    }


}