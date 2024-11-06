import AuthorizationServices from "../services/index.js";

export default function Autorizationctrl($scope) {
    const azs = new AuthorizationServices();
    let _mode = "n";
    let _currentassaignid = "";
    $scope.projectslist = [];
    $scope.userslist = [];
    $scope.allauths = [];
    _defaultload();
    document.getElementById("assainproject").style.display = "none";
    async function _defaultload() {
        const _projects = _getAllProjects();
        const _users = _getAllusers();
        const _allauth = AllAuths();

        $scope.projectslist = await _projects;
        $scope.userslist = await _users;
        $scope.allauths = await _allauth;
        
        $scope.$apply();
    }
    async function _getAllProjects() {
        const res = await azs.apicall("projects");
        if (res?.msg !== 1) {
            return [];
        }
        return res.data;
    }
    async function _getAllusers() {
        const res = await azs.apicall("allUsers");
        if (res?.msg !== 1) {
            return [];
        }
        return res.data;
    }
    document.getElementById("project_autocompleate").style.display = "none";
    $scope.showDiaproject = ($event) => {
        document.getElementById("users_autocompleate").style.display = "none";
        document.getElementById("project_autocompleate").style.display = "flex";
        document.getElementById("projectfilter").focus();
    }
    $scope.current_select = {};
    $scope.selectcurrent = (x) => {
        $scope.current_select = x;
        $scope.userSrc = "";
        $scope.currentuser_select = {};
        getuserforCurrentProject(x);
        document.getElementById("project_autocompleate").style.display = "none";
        document.getElementById("projectSrc").focus();
        $scope.projectSrc = x.project_name + "  -  [" + x.project_no + "]";
        return;
    }

    async function getuserforCurrentProject(x) {
        const fd = azs.FormData();
        fd.append("ppid", x.project_id);
        const res = await azs.apicall("getuserforcurrentproject", fd);
        console.log(res);
        if (res?.msg !== 1) {
            _mode = "n";
            return;
        }
        _mode = "u"
        const mdata = res.data;
        _currentassaignid = mdata.ppaid;
        console.log(mdata.user_no);
        const getuser = $scope.userslist.find(i => i.user_no === mdata.user_no);
        console.log(getuser);
        $scope.currentuser_select = getuser;
        $scope.userSrc = "";
        $scope.userSrc = getuser.user_id;
        $scope.$apply();
    }
    document.getElementById("users_autocompleate").style.display = "none";
    $scope.showDiaUsers = () => {
        document.getElementById("project_autocompleate").style.display = "none";
        document.getElementById("users_autocompleate").style.display = "flex";
        document.getElementById("usersfilter").focus();
    }
    $scope.currentuser_select = {};
    $scope.selectcurrentusers = (x) => {
        $scope.currentuser_select = x;
        document.getElementById("users_autocompleate").style.display = "none";
        document.getElementById("userSrc").focus();
        $scope.userSrc = x.user_id;
        return;
    }
    $scope.updatebusy = false
    $scope.authactionbtn = () => {
        if ($scope.updatebusy) return;
        if (_mode === "n") {
            SaveAction()
            return;
        }
        UpdateAction();
        return;
    }
   
    async function SaveAction() {
        
        const fd = azs.FormData();
        fd.append("ppuid", $scope.currentuser_select.user_no);
        fd.append("ppid", $scope.current_select.project_id)
        $scope.updatebusy = true;
        const res = await azs.apicall("saveauth", fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.updatebusy = false;
            $scope.$apply();
            return;
        }
        alert("Saved");
        $scope.allauths = res.data;  
        $scope.updatebusy = false;
        $scope.$apply();
        document.getElementById("assainproject").style.display = "none";               
        return;
    }
   
    async function UpdateAction() {
      
        const fd = azs.FormData();
        fd.append("ppuid", $scope.currentuser_select.user_no);
        fd.append("ppaid", _currentassaignid)
        $scope.updatebusy = true;
        const res = await azs.apicall("updateauth", fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.updatebusy = false;
            $scope.$apply();
            return;
        }
        alert("Updated");
        $scope.allauths = res.data;      
        $scope.updatebusy = false;
        $scope.$apply();
        document.getElementById("assainproject").style.display = "none";
       
        return;
    }
    $scope.addnewauth = () => {
        $scope.current_select = {};
        $scope.currentuser_select = {};
        _mode = "n";
        _currentassaignid = "";
        $scope.projectSrc = "";
        $scope.userSrc = "";
        document.getElementById("assainproject").style.display = "flex";
    }

    

    async function AllAuths() {
        const res = await azs.apicall("allauths");
        if (res?.msg !== 1) return [];
        return res.data;
    }
    $scope.removebusy = false;
    $scope.removeAuth = async (x) => {
        if ($scope.removebusy) return;
        const c = confirm("Are You Sure Remove?");
        if (!c) return;
        const fd = azs.FormData();
        fd.append("ppaid", x.ppaid);
        $scope.removebusy = true;
        const res = await azs.apicall("removeauth", fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.removebusy = false;
            $scope.$apply();
            return;
        }
        $scope.allauths = res.data;      
        $scope.removebusy = false;
        $scope.$apply();
        return;
    }
}