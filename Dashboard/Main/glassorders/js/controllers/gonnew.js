import GlassSupplierServices from './../services/suppliers.js';
import GONServices from './../services/gon.js'
export default function gon_new($scope, $http) {
    const gs = new GlassSupplierServices();
    const gns = new GONServices();
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
    //get all supplier


    $scope.gonew = {
        isloading: false,
        btn: "Save",
        mode: 1,
        data: {
            gonewid: 0,
            gondoneby: "",
            gonrelesetopurcahse: "",
            gonrecivedfrompurchase: "",
            gonstatus: "",
            gonsupplier: "",
            gonglasstype: "",
            gonglassspc: "",
            gonmakringlocation: "",
            gonlocation: "",
            gonqty: "",
            gonremark: "",
            gonorderno: "",
            gonby: "",
            goeby: "",
            gocdate: "",
            goedate: "",
            gontype: "",
            gonproject: sessionStorage.getItem('nafco_project_current_sno'),

        }
    }

    function validate() {        
        return 1;
    }
    $scope.save_ponew = async () => {
        console.log("called");
        const _validate = validate();
        if (_validate !== 1) {
            return;
        }

        $scope.gonew = {
            ...$scope.gonew,
            isloading: true,
            data : {...$scope.gonew.data},
        }
        const fd = gns.FormData();
        fd.append('payload', JSON.stringify($scope.gonew.data));
        const res = await gns.savegon(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }

        $scope.gonew = {
            ...$scope.gonew,
            isloading: false,
            data: {
                ...$scope.gonew.data,
                gonewid: 0,
                gondoneby: "",
                gonrelesetopurcahse: "",
                gonrecivedfrompurchase: "",
                gonstatus: "",
                gonsupplier: "",
                gonglasstype: "",
                gonglassspc: "",
                gonmakringlocation: "",
                gonlocation: "",
                gonqty: "",
                gonremark: "",
                gonorderno: "",
                gonby: "",
                goeby: "",
                gocdate: "",
                goedate: "",
                gontype: "",
                gonproject: sessionStorage.getItem('nafco_project_current_sno'),
            }
        }
        $scope.$apply();
        alert("Data Has Saved");
        return;
    }

    
}