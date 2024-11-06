import AuthorizationServices from "../../../boqnew/js/services/index.js";
import cuttinglistservices from "../services/index.js";
export default function enggonew($scope,$routeParams) {
    const azs = new AuthorizationServices();
    const cts = new cuttinglistservices();
    console.log($routeParams)
    $scope.pagetype = $routeParams?.mode ?? 'N';
    console.log($scope.pagetype)
    $scope.btntxt = $scope.pagetype === "N" ? "Save" : "Update";
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

 

    $scope.setctype = (t) => {
        console.log("working")
        if (t === "1") {
            console.log("changed");
            $scope.newgo = {
                ...$scope.newgo,
                projectid: "",
                goproject: "",
                goprojectname: "",
                goprojectlocation: "",
            }
        } else {
            console.log("changed 2");
            $scope.newgo = {
                ...$scope.newgo,
                projectid: "0",
                goproject: "",
                goprojectname: "",
                goprojectlocation: "",
            }
        }

    }

    $scope.newgo = {
        goid: "",
        gono: "",
        gorefno: "",
        goproject: "",
        goprojectname: "",
        goprojectlocation: "",
        gosupplier: "",
        gogtype: "",
        gospec: "",
        gomarking: "",
        goqty: "",
        goarea: "",
        gotype: "1",
        godoneby: "",
        godoneby: "",
        goorddate: "",
        gortopurchase: "",
        gofrmpurchase: "",
        gostatus: "0",
        goremark: "",
        cby: "",
        eby: "",
        cdate: "",
        cedate: "",
        projectid: "",
        gogotype: "1"
    }
    if ($scope.pagetype !== 'N') {
        //get type
        getGoInfo();
        
        
    }

    async function getGoInfo() {
        const id = $routeParams.id;
        const res = await cts.GET(`cuttinglists/goget.php?goid=${id}`);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        $scope.newgo = res.data;
        $scope.newgo = {
            ...$scope.newgo,
            gortopurchase: res.data.gortopurchase_l.normal,
            gofrmpurchase: res.data.gofrmpurchase_l.normal,
            goorddate : res.data.goorddate_l.normal,
        }
        $scope.$apply();
        return;
    }
    $scope.isloading = false;
    $scope.saveCt = async () => {
        if ($scope.isloading) false;
        if ($scope.pagetype === "N") {
            await SaveMO();
            return;
        }

        await updateMO();
        return;

    }


    async function SaveMO() {
        $scope.isloading = true;
        const fd = new FormData();
        fd.append('payload', JSON.stringify($scope.newgo));
        const res = await cts.POST("cuttinglists/gonew.php", fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isloading = false;
            $scope.$apply();
            return;
        }
        $scope.newgo = {
            goid: "",
            gono: "",
            gorefno: "",
            goproject: "",
            goprojectname: "",
            goprojectlocation: "",
            gosupplier: "",
            gogtype: "",
            gospec: "",
            gomarking: "",
            goqty: "",
            goarea: "",
            gotype: "1",
            godoneby: "",
            godoneby: "",
            goorddate: "",
            gortopurchase: "",
            gofrmpurchase: "",
            gostatus: "0",
            goremark: "",
            cby: "",
            eby: "",
            cdate: "",
            cedate: "",
            projectid: "",
            gogotype: "1"
        }
        alert("Saved");
        $scope.isloading = false;
        $scope.$apply();
        return;
    }

    async function updateMO() {
        const fd = new FormData();
        fd.append('payload', JSON.stringify($scope.newgo));
        const res = await cts.POST(`cuttinglists/goupdate.php?goid=${$routeParams.id}`, fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        alert("Data Has updated");
        return;
    }

    //auto compleate
    $scope.gtype = [];
    $scope.gspec = [];
    $scope.gmk = [];
    $scope.gsupplier = [];
    $scope.gremark = [];
    autocompleate();
    async function autocompleate() {
        $scope.gtype = [];
        $scope.gspec = [];
        $scope.gmk = [];
        $scope.gsupplier = [];
        $scope.gremark = [];
        const res = await cts.GET('cuttinglists/goautocompleate.php');
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        $scope.gtype = res.data.gtype;
        $scope.gspec = res.data.gspec;
        $scope.gmk = res.data.gmk;
        $scope.gsupplier = res.data.gsupplier;
        $scope.gremark = res.data.gremark;
        $scope.$apply();
        return;

    }

    //auto compleate
    $scope.projectslist = [];
    $scope.currentproject = {};
    async function ProjectGetAll() {
        $scope.projectslist = [];
        const res = await azs.apicall("projects");
        if (res?.msg !== 1) {
            return;
        }
        $scope.projectslist = res.data;
        $scope.$apply();
        return;
    }

    ProjectGetAll();
    document.getElementById("project_autocompleate").style.display = "none";
    $scope.showprojectsearchbox = () => {
        document.getElementById("project_autocompleate").style.display = "flex";           
        $scope.projectfilter = "";
        document.getElementById("projectfilter").focus();
    }

    document.getElementById("projectfilter").addEventListener("keyup", async (e) => {
        if (e.which === 27) {
            $scope.projectfilter = "";
            ///$scope.project_autocompleate = false; 
            document.getElementById("project_autocompleate").style.display = "none";
            document.getElementById("srcprojects").focus();
            return;
        }
        if (e.which === 13) {
            const _find = $scope.projectslist.find(x => x.project_no.toUpperCase() === e.target.value.toUpperCase().trim());
            console.log(_find);
            const projectname = _find?.project_no ?? "";
            if (!projectname || projectname === "") {
                return;
            }
            await selectedprojectaction(_find);            
            document.getElementById("project_autocompleate").style.display = "none";
            document.getElementById("ct_mono").focus();
            return;
        }
    })
    $scope.selectcurrent = async (x) => {
        await selectedprojectaction(x);
        document.getElementById("project_autocompleate").style.display = "none";        
    }
    async function selectedprojectaction(x) {
        $scope.currentproject = x;
        $scope.src = {
            project: x.project_name + " [" + x.project_no + "]"
        }
        $scope.newgo = {
            ...$scope.newgo,
            goproject :x.project_no,
            goprojectname: x.project_name,
            goprojectlocation:x.project_location,
            projectid:  x.project_id,
        }
    }

}