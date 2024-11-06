import AuthorizationServices from "../../../boqnew/js/services/index.js";
import cuttinglistservices from "../services/index.js";
export default function cuttinglistsnew($scope,$http,$routeParams) {
    //calender initialization

    
       


    console.log($routeParams);
    const params = $routeParams;
    $scope.pagetype = params?.types ?? 'N';
    const dataR = {
        "N": "Save",
        "E": "Update",
        "S" : "Supersede",
    }
    $scope.btntxt = dataR[$scope.pagetype];
    $scope.res = {
        display : false,
        msg : ""
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
    //genral code
    const azs = new AuthorizationServices();
    const cts = new cuttinglistservices();
    console.log("working");

    //autocompleate
    $scope.markings = [];
    $scope.descriptions = [];
    $scope.locations = [];
    $scope.donebys = [];
    $scope.uints = [];
    $scope.sheettypes = [];
   
    async function LoadAutoCompleate(project) {
        console.log("called");
        $scope.markings = [];
        $scope.descriptions = [];
        $scope.locations = [];
        $scope.donebys = [];
        $scope.uints = [];
        $scope.sheettypes = [];


        //const res = await cts.apicall("autocompleate.php");
        const res = await cts.GET(`cuttinglists/autocompleate.php?pro=${project}`);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        console.log(res);
        $scope.markings = res.data.markings;
        $scope.descriptions = res.data.descriptions;
        $scope.locations = res.data.locations;
        $scope.donebys = res.data.donebys;
        $scope.uints = res.data.uints;
        $scope.sheettypes = res.data.sheettypes;
        $scope.$apply();
    }
    //autocompleate
    //--project search dialog    
    document.getElementById("project_autocompleate").style.display = "none";
    document.getElementById("mo_autocompleate").style.display = "none";
    $scope.showprojectsearchbox = () => {
        document.getElementById("project_autocompleate").style.display = "flex";   
        document.getElementById("mo_autocompleate").style.display = "none";        
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
    //--all project get all project for auto compleate dialog box
    getAllprojects();
    $scope.projectslist = [];
    $scope.currentproject = {};
    async function getAllprojects() {
        $scope.projectslist = [];
        const res = await azs.apicall("projects");
        if (res?.msg !== 1) {
            return [];
        }
        $scope.projectslist = res.data;
    }
    
    $scope.setctype = (t) => {
        if (t !== '1') {
            $scope.newct = {
                ...$scope.newct,
                ctprojectname: "",
                ctprojectlocation: "",
                ctprojectno: "",
                projectid: "0",
                boqid: "0",
                ct_mono: "",
            }
            document.getElementsByName("srcprojects")[0].focus();
        } else {
            $scope.newct = {
                ...$scope.newct,
                ctprojectname: "",
                ctprojectlocation: "",
                ctprojectno: "",
                ctprojectname: "",
                ct_mono: "",
            }
            document.getElementsByName("srcprojects")[0].focus();
        }
    }
    $scope.sampleprojects = async () => {
        const projectno = $scope.newct?.ctprojectno?? '';
        if (projectno !== '') {
            await allMos(projectno);   
            //--gonew
            await getGlassorders(projectno);
            await LoadAutoCompleate(projectno);
        }
        // if (projectno === '') return
        // 
        // return;
    }
    async function selectedprojectaction(x) {
        
        $scope.currentproject = x;
        $scope.src = {
            project: x.project_name + " [" + x.project_no + "]"
        }
        $scope.moprefix = x.project_no;
        await allMos(x.project_no);
        await getBoqs(x.project_enc);
        getGlassorders(x.project_name);        
        console.log("function called");
        LoadAutoCompleate(x.project_no);
        $scope.newMo = {
            ...$scope.newMo,
            data: {
                ...$scope.newMo.data,
                c_moproject: x.project_id,
                ctprojectname: x.project_name,
                ctprojectlocation: x.project_location,
                ctprojectno: x.project_no,
                c_mo_accountfalg : "0",
            }
        }

        $scope.newct = {
            ...$scope.newct,
            projectid: x.project_id,
            ctprojectname: x.project_name,
            ctprojectlocation: x.project_location,
            ctprojectno: x.project_no,
            c_mo_accountfalg : "0",
        };
        
    }
    $scope.selectcurrent = async (x) => {
        await selectedprojectaction(x);
        document.getElementById("project_autocompleate").style.display = "none";
        document.getElementById("ct_mono").focus();
    }
    document.getElementById("dia_load_newmo").style.display = "none";
    $scope.shownewmo = () => {
        document.getElementById("dia_load_newmo").style.display = "flex";
    }
    $scope.project_mos = [];
    async function allMos(projectid) {
        //const res = await cts.apicall(`mosall.php?project=${projectid}`, pd);
        const res = await cts.GET(`cuttinglists/mosall.php?project=${projectid.toUpperCase()}`);        
        if (res?.msg !== 1) {
            alert(res.data);            
            return;   
        }
        console.log(res);
        $scope.project_mos = res.data;
        $scope.$apply();
        return;
    }

    //--mo auto compleate dialog
    $scope.showMoItems = ($event) => {
        document.getElementById("project_autocompleate").style.display = "none";
        document.getElementById("mo_autocompleate").style.display = "flex";
        $scope.mofilter = "";
        document.getElementById("mofilter").focus();
    }
    document.getElementById("mofilter").addEventListener("keyup", (e) => {
        if (e.which === 27) {
            $scope.mofilter = "";
            document.getElementById("mo_autocompleate").style.display = "none";
            document.getElementById("ct_mono").focus();
            return;
        }
        if (e.which === 13) {
            const x = $scope.project_mos.find(x => x.c_mono === e.target.value.trim());
            setmocurrentfunction(x);
            return;
        }
    })
    $scope.currentmo = {};
    function setmocurrentfunction(x) {
        console.log(x);
        $scope.currentmo = x;
        if ((+x.c_mo_accountfalg) === 1 || (+x.c_mo_accountfalg) === 0) {
            $scope.newct = {
                ...$scope.newct,
                ct_mono: x.c_mono,
                account_flag: x.c_mo_accountfalg,
                boqid: x.c_mo_boqid
            }
            document.getElementById("mo_autocompleate").style.display = "none";
            document.getElementById("ct_no").focus();
            return;
        }
        if ((+x.c_mo_accountfalg) >= 2) {
            $scope.newct = {
                ...$scope.newct,
                ct_mono: x.c_mono,
                boqid: x.c_mo_boqid,
                account_flag: x.c_mo_accountfalg,
                account_release: x.c_mo_account_issue_d.normal,
            }
            document.getElementById("mo_autocompleate").style.display = "none";
            document.getElementById("ct_no").focus();
            return;
        }
        if ((+x.c_mo_accountfalg) === 3) {
            $scope.newct = {
                ...$scope.newct,
                boqid: x.c_mo_boqid,
                ct_mono: x.c_mono,
                account_flag: x.c_mo_accountfalg,
                account_release: x.c_mo_account_issue_d.normal,
                account_return: x.c_mo_account_release_d.normal,
            }
            document.getElementById("mo_autocompleate").style.display = "none";
            document.getElementById("ct_no").focus();
            return
        }



    }
    $scope.selectmocurrent = (x) => {
        setmocurrentfunction(x);
    }
    $scope.newMo = {
        isloading: false,
        mode: 1,
        btn: "Save",
        title: "Add New MO's",
        data: {
            c_moid: '',
            c_mono: '',
            c_moproject: '',
            c_mo_boqid: '',
            c_mo_accountfalg: '0',
            c_mo_account_issue: '',
            c_mo_account_release: '',
            ctprojectname : "",
            ctprojectlocation :"",
            ctprojectno : "",
        }
    }
    $scope.saveMoSubmit = async () => {
        if ($scope.newMo.mode === 1) {
            await Addnewmo();
            return;
        }
    }
    //--boq

    $scope.boqlist = [];
    async function getBoqs(projectenc) {
        $scope.boqlist = [];
        const mi = await import("../../../mr/js/services/mr.js").then((n) => new n.default());
        const fd = mi.FormData();
        fd.append("project_enc", projectenc);
        const res = await mi.apicall(fd, "getboq");
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        $scope.boqlist = res.data;
        $scope.$apply();
        return;

    }
    async function Addnewmo() {
        if ($scope.newMo.isloading) return;
        $scope.newMo = {
            ...$scope.newMo,
            data: {
                ...$scope.newMo.data,
                cttype: $scope.newct.cttype,
                ctprojectname : $scope.newct.ctprojectname,
                ctprojectlocation : $scope.newct.ctprojectlocation,
                ctprojectno : $scope.newct.ctprojectno,
            },
            isloading: true
        };
        const fd = new FormData();
        console.log($scope.newMo.data);
        fd.append("payload", JSON.stringify($scope.newMo.data));       
        const res = await cts.POST("cuttinglists/monew.php", fd);
        console.log(res);
        if (res?.msg !== 1) {
            $scope.newMo = {
                ...$scope.newMo,
                data: {
                    ...$scope.newMo.data,
                },
                isloading: false
            };
            alert(res.data);
            $scope.res = {
                display : true,
                msg: res.data
            }
            $scope.$apply();
            return;
        }
        
        $scope.project_mos = [];
        $scope.newMo = {
            isloading: false,
            mode: 1,
            btn: "Save",
            title: "Add New MO's",
            data: {
                c_moid: '',
                c_mono: '',
                c_moproject: '',
                c_mo_boqid: '',
                c_mo_accountfalg: '',
                c_mo_account_issue: '',
                c_mo_account_release: '',
                ctprojectname : "",
                ctprojectlocation :"",
                ctprojectno : "",
            }
        }

        $scope.res = {
            display : true,
            msg: "Saved"
        }

        $scope.project_mos = res.data;
        $scope.$apply();
        return;
    }

    $scope.newct = {
        ct_no: "",
        ct_type: "MO",
        ct_mono: "",
        ct_marking: "",
        ct_description: "",
        ct_location: "",
        ct_height: "",
        ct_width: "",
        ct_area: "",
        ct_doneby: "",
        ct_date: "",
        ct_section: "",
        ct_mrefno: "",
        ct_cddate: "",
        ct_eddate: "",
        ct_cby: "",
        ct_eby: "",
        account_flag: "0",
        matterial_flag: "0",
        operation_flag: "0",
        production_flag: "0",
        production_returnflag: "",
        account_release: "",
        account_return: "",
        material_release: "",
        material_return: "",
        operation_release: "",
        operation_return: "",
        production_release: "",
        production_accept: "",
        mgono: "",
        ctunit: "",
        materialstatus: "",
        materialrefno: "",
        forlocation: "",
        projectid: "",
        boqid: "",
        ct_notes: "",
        cttype: "1",
        ctprojectname: "",
        ctprojectlocation: "",
        ctprojectno: "",
    }
    
    $scope.issaving = false;
    $scope.saveCt = async() => {
        if ($scope.issaving) return; 
        if ($scope.pagetype === "N") {
            await saveCuttinglist();
            return;
        }
        if ($scope.pagetype === "E") {
            await UpdateCuttinglist();
            return;
        }
    }
   
    async function UpdateCuttinglist() {
        const fd = new FormData();
        fd.append("payload", JSON.stringify($scope.newct));
        $scope.issaving = true;
        const cid = params?.cid ?? "";
        const res = await cts.POST(`cuttinglists/edit.php?ct_id=${cid}`, fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.issaving = false;
            $scope.$apply();
            return;
        }

        alert("Data Has Updated");
        $scope.issaving = false;
        $scope.$apply();
    }
   
   async function saveCuttinglist(){             
        const fd = new FormData();
        fd.append("payload", JSON.stringify($scope.newct));       
        $scope.issaving = true;
        const res = await cts.POST("cuttinglists/new.php", fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.issaving = false;
            $scope.$apply();
            return;
        }
        $scope.issaving = false;
        // $scope.newct = {
        //     ct_no: "",
        //     ct_type: "MO",
        //     ct_mono: "",
        //     ct_marking: "",
        //     ct_description: "",
        //     ct_location: "",
        //     ct_height: "",
        //     ct_width: "",
        //     ct_area: "",
        //     ct_doneby: "",
        //     ct_date: "",
        //     ct_section: "",
        //     ct_mrefno: "",
        //     ct_cddate: "",
        //     ct_eddate: "",
        //     ct_cby: "",
        //     ct_eby: "",
        //     account_flag: "0",
        //     matterial_flag: "0",
        //     operation_flag: "0",
        //     production_flag: "1",
        //     production_returnflag: "",
        //     account_release: "",
        //     account_return: "",
        //     material_release: "",
        //     material_return: "",
        //     operation_release: "",
        //     operation_return: "",
        //     production_release: "",
        //     production_accept: "",
        //     mgono: "",
        //     ctunit: "",
        //     materialstatus: "",
        //     materialrefno: "",
        //     forlocation: "",
        //     projectid: "",
        //     boqid: "",
        //     ct_notes: "",
        //     cttype: "1",
        //     ctprojectname: "",
        //     ctprojectlocation: "",
        //     ctprojectno: "",
        // }
        $scope.$apply();
        alert("Saved");
        return;
    }

    

    //--as per ali request

    $scope.getoldcuttinglistinfo = ($event) => {
        const ct_no = document.getElementById("ct_no").value;
        if (ct_no === "") {
            return;
        }
    }
   
    $scope.getCTno = async () => { await _getCuttinglistMo() }
    async function _getCuttinglistMo() {
        console.log("working");
        const ctno = document.getElementById("ct_no").value;        
        const project = $scope.newct?.ctprojectno ?? "";    
        console.log(ctno, project);
        if (ctno === "" || project === '') { return; }
        const url = `cuttinglists/getctno.php?ctno=${ctno}&projects=${project}`;
        const res = await cts.GET(url);
        if (res?.msg !== 1) {
            return;
        }

        $scope.newct = {
            ...$scope.newct,                        
            ct_mono: res.data.ct_mono,
            ct_marking: res.data.ct_marking,
            ct_description: res.data.ct_description,
            ct_location: res.data.ct_location,
            ct_height: res.data.ct_height,
            ct_width: res.data.ct_width,
            ct_area:res.data.ct_area,
            ct_qty:res.data.ct_qty,
            ct_doneby: res.data.ct_doneby,
            ct_date: res.data.ct_date,
            ct_section: res.data.ct_section,
            ct_mrefno: res.data.ct_mrefno,            
            account_flag: res.data.account_flag,
            matterial_flag: res.data.matterial_flag,
            operation_flag:res.data.operation_flag,
            production_flag: res.data.production_flag,
            production_returnflag: res.data.production_returnflag,
            account_release: res.data.account_release_l.normal,
            account_return: res.data.account_return_l.normal,
            material_release: res.data.material_release_l.normal,
            material_return: res.data.material_return_l.normal,
            operation_release: res.data.operation_release_l.normal,
            operation_return: res.data.operation_return_l.normal,
            production_release:res.data.production_release_l.normal,
            production_accept: res.data.production_accept_l.normal,
            mgono: res.data.mgono,
            ctunit: res.data.ctunit,
            materialstatus: res.data.materialstatus,
            materialrefno: res.data.materialrefno,
            forlocation: res.data.forlocation,            
            boqid: res.data.boqid,
            ct_notes: res.data.ct_notes,
            cttype: res.data.cttype,            
        }

        $scope.$apply();
        return;
    }
   

    //if not new

    
    $scope.isnproject = false;
    pagemode();
    function pagemode() {
        if ($scope.pagetype !== "N") {       
            GetMode();
        } else {
            Editmode() 
        }
    }
    
    
    function Editmode() {
        let project_id = sessionStorage.getItem("nafco_project_current");
        console.log(project_id);
        if (!project_id || project_id === "") {
            console.log("out of project");
            return;
        } 

        console.log("in of project");
        
        let post_data = {
            naf_user: userinfo,
            project_no: project_id
        }
        var req =  $http.post(api_url + "Project/view.php", post_data);
        req.then(res => {
            //console.log(res.data);

            if (res.data.msg === "1") {
                $scope.isnproject = true;
                $scope.viewproject = res.data.data;
                //console.log($scope.viewproject);
                localStorage.removeItem("currentproject");
                localStorage.setItem("pms_currentproject", JSON.stringify($scope.viewproject));

                //console.log($scope.viewproject);
                $scope.newproject = res.data.data;
                //console.log($scope.ts);                
                $scope.newct = {
                    ...$scope.newct,
                    cttype: "1",
                    projectid: res.data.data.project_id,
                    ctprojectname: res.data.data.project_name,
                    ctprojectlocation: res.data.data.project_location,
                    ctprojectno: res.data.data.project_no,
                }
                $scope.src =
                {
                    project : res.data.data.project_name + "[" + res.data.data.project_no + "]"
                }
                allMos(res.data.data.project_no);
                getBoqs(res.data.data.project_no_enc);
                GetLastCT(res.data.data.project_no);
                LoadAutoCompleate(res.data.data.project_no);
                //$scope.$apply();

            } else {
                alert(res.data.data);
            }
        });
    }
    
    console.log("findFABC");
    async function GetLastCT(project) {
        const res = await cts.GET(`cuttinglists/getlastct.php?projectno=${project}`);
        if (res?.msg !== 1) {
            console.log(res.data);
            return;
        }

        $scope.newct = {
            ct_no: res.data.ct_no,
            ct_type: res.data.ct_type,
            ct_mono: res.data.ct_mono,
            ct_marking: res.data.ct_marking,
            ct_description: res.data.ct_description,
            ct_location: res.data.ct_location,
            ct_height: res.data.ct_height,
            ct_width: res.data.ct_width,
            ct_area: res.data.ct_area,
            ct_doneby: res.data.ct_doneby,
            ct_date: res.data.ct_date,
            ct_section: res.data.ct_section,
            ct_mrefno: res.data.ct_mrefno,
            ct_cddate: res.data.ct_cddate,
            ct_eddate: res.data.ct_eddate,
            ct_cby: res.data.ct_cby,
            ct_eby: res.data.ct_eby,
            account_flag: res.data.account_flag,
            matterial_flag: res.data.matterial_flag,
            operation_flag: res.data.operation_flag,
            production_flag: res.data.production_flag,
            production_returnflag: res.data.production_returnflag,
            account_release: res.data.account_release_l.normal,
            account_return: res.data.account_return_l.normal,
            material_release: res.data.material_release_l.normal,
            material_return: res.data.material_return_l.normal,
            operation_release: res.data.operation_release_l.normal,
            operation_return: res.data.operation_return_l.normal,
            production_release: res.data.production_release_l.normal,
            production_accept: res.data.production_accept_l.normal,
            mgono: res.data.mgono,
            ctunit: res.data.ctunit,
            materialstatus: res.data.materialstatus,
            materialrefno: res.data.materialrefno,
            forlocation: res.data.forlocation,
            projectid: res.data.projectid,
            boqid: res.data.boqid,
            ct_notes: res.data.ct_notes,
            cttype: res.data.cttype,
            ctprojectname: res.data.ctprojectname,
            ctprojectlocation: res.data.ctprojectlocation,
            ctprojectno: res.data.ctprojectno,
            ct_qty: res.data.ct_qty,
        };
        // $scope.src = {
        //     project : res.data.ctprojectname + "["+ res.data.ctprojectno +"]",
        // }
        $scope.$apply();
        return;

    }
    
    async function GetMode() {
        const cid = params?.cid ?? "";
        if (cid === '') {
            alert("Something wrong.Please Select Any Cutting List");
            const location = `${print_location}Dashboard/Main/index.php#!/cuttinglists`
            console.log(location);
            window.href = location;
            return;
        }
        
        const res = await cts.GET(`cuttinglists/get.php?ctno=${cid}`);
        if (res?.msg !== 1) {
            alert(res.data);
            const location = `${print_location}Dashboard/Main/index.php#!/cuttinglists`
            console.log(location);
            window.href = location;
            return;
        }
        //cttype
       
        await allMos(res.data.ctprojectno);
        await getBoqs(res.data.projectenc);
        document.getElementById("srcprojects").setAttribute('readonly', true);
        $scope.newct = {
            ct_no: res.data.ct_no,
            ct_type: res.data.ct_type,
            ct_mono: res.data.ct_mono,
            ct_marking: res.data.ct_marking,
            ct_description: res.data.ct_description,
            ct_location: res.data.ct_location,
            ct_height: res.data.ct_height,
            ct_width: res.data.ct_width,
            ct_area: res.data.ct_area,
            ct_doneby: res.data.ct_doneby,
            ct_date: res.data.ct_date,
            ct_section: res.data.ct_section,
            ct_mrefno: res.data.ct_mrefno,
            ct_cddate: res.data.ct_cddate,
            ct_eddate: res.data.ct_eddate,
            ct_cby: res.data.ct_cby,
            ct_eby: res.data.ct_eby,
            account_flag: res.data.account_flag,
            matterial_flag: res.data.matterial_flag,
            operation_flag: res.data.operation_flag,
            production_flag: res.data.production_flag,
            production_returnflag: res.data.production_returnflag,
            account_release: res.data.account_release_l.normal,
            account_return: res.data.account_return_l.normal,
            material_release: res.data.material_release_l.normal,
            material_return: res.data.material_return_l.normal,
            operation_release: res.data.operation_release_l.normal,
            operation_return: res.data.operation_return_l.normal,
            production_release: res.data.production_release_l.normal,
            production_accept: res.data.production_accept_l.normal,
            mgono: res.data.mgono,
            ctunit: res.data.ctunit,
            materialstatus: res.data.materialstatus,
            materialrefno: res.data.materialrefno,
            forlocation: res.data.forlocation,
            projectid: res.data.projectid,
            boqid: res.data.boqid,
            ct_notes: res.data.ct_notes,
            cttype: res.data.cttype,
            ctprojectname: res.data.ctprojectname,
            ctprojectlocation: res.data.ctprojectlocation,
            ctprojectno: res.data.ctprojectno,
            ct_qty: res.data.ct_qty,
        };
        $scope.src = {
            project : res.data.ctprojectname + "["+ res.data.ctprojectno +"]",
        }
        $scope.$apply();
    }
    console.log("after working")
    //-go
    //get all glass orders 
    $scope.glassorders = [];
    async function getGlassorders(pjno) {
        $scope.glassorders = [];
        const res = await cts.GET(`cuttinglists/goprojects.php?goproject=${pjno}`);
        if (res?.msg !== 1) {
            return;
        }
        $scope.glassorders = res.data;
        $scope.$apply();
        return;        
    }
    //new update
    $scope.checknovalue = (x) => {        
        const v = $scope.newct[x] || '';
        if (v === '') {
            $scope.newct[x] = "0";
        }
    }
    $scope.calc_area = () => calc();
    function calc() {
        const h = document.getElementById("ct_height").value;
        const w = document.getElementById("ct_width").value;
        const q = document.getElementById("ct_qty").value;
        if (h === "" || w === "" || q === '') return;

        const area = (+h) * (+w) * (+q);

        $scope.newct = {
            ...$scope.newct,
            ct_area: area,
        }
    }

}