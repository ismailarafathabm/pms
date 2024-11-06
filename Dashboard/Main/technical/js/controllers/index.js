import *  as models from './models.js';
import Technicalservices from '../services/index.js';
export default function compreheciverpt($scope, $http) {
    $scope.access = models.fullaccessuers;
    const _currentuser = userinfo.user_name;
    console.log(_currentuser);
    $scope.status_list = models.statuslist;
    $scope.uncheck = {
        un: true
    }
    $scope.filters = {
        status_filter_A : true,
        status_filter_B : true,
        status_filter_BC : true,
        status_filter_C : true,
        status_filter_D : true,
        status_filter_U : true,
        status_filter_E : true,
        status_filter_F : true,
    }
   

    let tech_colorslist = [];
    let hardwareapprovals = [];
    let technicalapproval_datas = [];
    let calculation_datas = [];
    

    $scope.caniaccessbtns = models.fullaccessuers.includes(_currentuser);
    console.log($scope.caniaccessbtns);
    document.getElementById("cmprpt").classList.add('menuactive');
    function _currentdate() {
        let _date = new Date();
        let _d = _date.getDate();
        let _m = _date.getMonth() + 1;
        let _y = _date.getFullYear();
        if (_m.toString().length === 1) {
            _m = `0${_m}`;
        }
        if (_d.toString().length === 1) {
            _d = `0${_d}`;
        }
        let _day = `${_d}-${_m}-${_y}`;
        return _day;
    }
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

            } else {
                alert(res.data.data);
            }
        });
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

    let username = _username;
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    /*------ Default Codes ------------------------ */
    const ts = new Technicalservices();
    LoadAllDatas();
    async function LoadAllDatas() {
        getSystems();
        loadColorApprovedData();
        getHardwareApprovals();
        getCalculationData();
    }
    /*------ Systems ------------------------ */
    $scope.isloading_system = false;
    $scope.show_system_new = false;
    $scope.approvedsystems = [];
    //getSystems();
    async function getSystems() {
        if ($scope.isloading_system) return;

        $scope.approvedsystems = [];
        const fd = ts.FormData();
        fd.append("techsysprojectid", sessionStorage.getItem("nafco_project_current_sno"));
        $scope.isloading_system = true;
        const res = await ts.projectsystems(fd);
        if (res?.msg !== 1) {
            $scope.isloading_system = false;
            alert(res.data);
            $scope.$apply();
            return;
        }

        $scope.isloading_system = false;        
        $scope.approvedsystems = res.data;
        $scope.$apply();
    }
    $scope.systemnewdia = models.technical_system_dia_model;
    function _setSystemnewStatus(status, data = models.technical_system_dia_model) {
        if (status) {
            console.log(data);
            $scope.systemnewdia = {};
            $scope.systemnewdia = data;
        }
        console.log(data);
        $scope.show_system_new = status;
    }
    $scope.setSystemNewStatus = (status) => {
        _setSystemnewStatus(status);
    }

    $scope.edit_systems = (status, datas) => {
        let data = {
            isloading: false,
            title: "EDIT SYSTEM",
            btn: 'Update',
            mode: 2,
            data: datas,
        }
        _setSystemnewStatus(status, data);

    }

    $scope.save_system_submit = async () => {
        if ($scope.systemnewdia.isloading) return;
        if ($scope.systemnewdia.mode === 1) {
            await saveAction();
            return;
        }
        await updateAction();
        return;

    }

    function _validate() {
        const techsyssystem = document.getElementById("techsyssystem");
        if (techsyssystem.value.trim() === "") {
            techsyssystem.focus();
            return false;
        }
        return true;
    }

    async function saveAction() {
        const validate = _validate();
        if (!validate) {
            return;
        }

        const fd = ts.FormData();
        $scope.systemnewdia = {
            ...$scope.systemnewdia,
            data: { ...$scope.systemnewdia.data },
            isloading: true
        }
        fd.append('payload', JSON.stringify($scope.systemnewdia.data));
        const res = await ts.newsystem(fd);
        if (res?.msg !== 1) {
            $scope.systemnewdia = {
                ...$scope.systemnewdia,
                data: { ...$scope.systemnewdia.data },
                isloading: false
            };
            alert(res.data);
            $scope.$apply();
            return;
        }
        $scope.systemnewdia = {
            ...$scope.systemnewdia,
            data: {
                ...$scope.systemnewdia.data,
                techsyssystem: "",
            },
            isloading: false
        };
        $scope.approvedsystems = res.data;
        $scope.$apply();

    }

    async function updateAction() {
        const validate = _validate();
        if (!validate) {
            return;
        }

        const fd = ts.FormData();
        $scope.systemnewdia = {
            ...$scope.systemnewdia,
            data: { ...$scope.systemnewdia.data },
            isloading: true
        }

        fd.append('payload', JSON.stringify($scope.systemnewdia.data));
        const res = await ts.updatesystem(fd);
        if (res?.msg !== 1) {
            $scope.systemnewdia = {
                ...$scope.systemnewdia,
                data: { ...$scope.systemnewdia.data },
                isloading: false
            };
            alert(res.data);
            $scope.$apply();
            return;
        }
        $scope.systemnewdia = {
            ...$scope.systemnewdia,
            data: {
                ...$scope.systemnewdia.data,
            },
            isloading: false
        };
        $scope.approvedsystems = res.data;
        $scope.$apply();
    }


    $scope.removesystem = async () => {
        const c = confirm("Are You Sure Remove This Data?");
        if (!c) return;
        if ($scope.systemnewdia.isloading) return;
        const fd = ts.FormData();
        fd.append('payload', JSON.stringify($scope.systemnewdia.data));
        $scope.systemnewdia = {
            ...$scope.systemnewdia,
            data: { ...$scope.systemnewdia.data },
            isloading: true,
        }

        const res = await ts.removesystem(fd);
        if (res?.msg !== 1) {
            $scope.systemnewdia = {
                ...$scope.systemnewdia,
                data: { ...$scope.systemnewdia.data },
                isloading: false,
            }
            alert(res.data);
            $scope.$apply();
            return;
        }
        $scope.systemnewdia = {
            ...$scope.systemnewdia,
            data: { ...$scope.systemnewdia.data },
            isloading: false,
        }
        _setSystemnewStatus(false);
        $scope.approvedsystems = res.data;
        $scope.$apply();
        return;
    }

    /*------ For Color Approvals ------------------------ */
    $scope.show_tech_color_model = false;
    $scope.isloading_tech_colors_data = false;
    $scope.tech_colorslist = [];
    $scope.technical_colors_model = models.technical_colors_model;

    function _setTechColorModel(status, data = models.technical_colors_model) {
        if (status) {
            $scope.technical_colors_model = data;
        }
        $scope.show_tech_color_model = status;
    }
    $scope.setColorshowStatus = (status) => {
        _setTechColorModel(status);
    }
    $scope.edit_colorSubmital = (status, x) => {
        console.log(x);
        let _data = {
            isloading: false,
            title: "Update Color Approvals",
            mode: 2,
            btn: "Update",
            data: {
                tcid: x.tcid,
                tcmaterial: x.tcmaterial,
                tecdescription: x.tecdescription,
                tcsubmittedby: x.tcsubmittedby,
                tcsubmitteddate: x.tcsubmitteddate_n,
                tcapprovedstatus: x.tcapprovedstatus,
                tcapproveddate: x.tcapproveddate_n,
                tcprojectid: sessionStorage.getItem("nafco_project_current_sno"),
            }
        };
        _setTechColorModel(status, _data);
    }
    // loadColorApprovedData();
    async function loadColorApprovedData() {
        if ($scope.isloading_tech_colors_data) return;
        const fd = ts.FormData();
        fd.append('tcprojectid', sessionStorage.getItem("nafco_project_current_sno"));
        $scope.isloading_tech_colors_data = true;
        const res = await ts.colorapprovals(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isloading_tech_colors_data = false;
            $scope.$apply();
            return;
        }
        $scope.isloading_tech_colors_data = false;
        tech_colorslist = [];
        tech_colorslist = res.data;
        $scope.tech_colorslist = tech_colorslist;
        $scope.$apply();
    }

    $scope.smaple = () => {
        console.log($scope.technical_colors_model.data.tcapprovedstatus);
    }

    $scope.colorsave_submit = async () => {
        if ($scope.technical_colors_model.isloading) return;
        if ($scope.technical_colors_model.mode === 1) {
            await _saveColorAction();
            return;
        }
        await _updateColorAction();
        return;
    }



    function _colorValidate() {
        const tcmaterial = document.getElementById("tcmaterial");
        const tecdescription = document.getElementById("tecdescription");
        const tcsubmittedby = document.getElementById("tcsubmittedby");
        const tcsubmitteddate = document.getElementById("tcsubmitteddate");
        const tcapprovedstatus = document.getElementById("tcapprovedstatus");
        if (tcmaterial.value.trim() === "") {
            alert("Enter Type");
            tcmaterial.focus();
            return false;
        }

        if (tecdescription.value.trim() === "") {
            alert("Enter Description");
            tecdescription.focus();
            return false;
        }
        if (tcsubmittedby.value.trim() === "") {
            alert("Enter Submitted By");
            tcsubmittedby.focus();
            return false;
        }

        if (tcsubmitteddate.value.trim() === "") {
            alert("Enter Submitted Date");
            tcsubmitteddate.focus();
            return false;
        }

        if (tcapprovedstatus.value.trim() === "") {
            alert("Enter Status Of Submittal");
            tcapprovedstatus.focus();
            return false;
        }
        if (tcapprovedstatus.value !== "1") {
            const tcapproveddate = document.getElementById("tcapproveddate");
            if (tcapproveddate.value.trim() === "") {
                alert("Enter Approved or Cancelled Date");
                tcapproveddate.focus();
                return false;
            }
        }
        return true;
    }

    async function _saveColorAction() {
        const validate = _colorValidate();
        if (!validate) return;
        const fd = ts.FormData();
        fd.append('payload', JSON.stringify($scope.technical_colors_model.data));
        $scope.technical_colors_model = {
            ...$scope.technical_colors_model,
            data: { ...$scope.technical_colors_model.data },
            isloading: true
        };

        const res = await ts.colornew(fd);
        if (res?.msg !== 1) {
            $scope.technical_colors_model = {
                ...$scope.technical_colors_model,
                data: { ...$scope.technical_colors_model.data },
                isloading: false
            };
            alert(res.data);
            $scope.$apply();
            return;
        }

        $scope.technical_colors_model = models.technical_colors_model;
        tech_colorslist = [];
        tech_colorslist = res.data;
        $scope.tech_colorslist = tech_colorslist;
        $scope.$apply();
    }

    async function _updateColorAction() {
        const validate = _colorValidate();
        if (!validate) return;
        const fd = ts.FormData();
        fd.append('payload', JSON.stringify($scope.technical_colors_model.data));
        $scope.technical_colors_model = {
            ...$scope.technical_colors_model,
            data: { ...$scope.technical_colors_model.data },
            isloading: true
        };

        const res = await ts.colorupdate(fd);
        if (res?.msg !== 1) {
            $scope.technical_colors_model = {
                ...$scope.technical_colors_model,
                data: { ...$scope.technical_colors_model.data },
                isloading: false
            };
            alert(res.data);
            $scope.$apply();
            return;
        }

        $scope.technical_colors_model = {
            ...$scope.technical_colors_model,
            data: { ...$scope.technical_colors_model.data },
            isloading: false
        };
        tech_colorslist = [];
        tech_colorslist = res.data;
        $scope.tech_colorslist = tech_colorslist;
        $scope.$apply();
    }

    $scope.removecolor = async (id, project_id) => {
        const c = confirm("Are You Sure Remove Data?");
        if (!c) return;
        if ($scope.technical_colors_model.isloading) return;
        const fd = ts.FormData();
        fd.append('tcid', id);
        fd.append('tcprojectid', project_id);
        $scope.technical_colors_model = {
            ...$scope.technical_colors_model,
            data: { ...$scope.technical_colors_model.data },
            isloading: true
        };
        const res = await ts.colorremove(fd);
        if (res?.msg !== 1) {
            $scope.technical_colors_model = {
                ...$scope.technical_colors_model,
                data: { ...$scope.technical_colors_model.data },
                isloading: false
            };
            $scope.$apply();
            alert(res.data);
            return;
        }

        $scope.technical_colors_model = {
            ...$scope.technical_colors_model,
            data: { ...$scope.technical_colors_model.data },
            isloading: false
        };
        tech_colorslist = [];
        tech_colorslist = res.data;
        $scope.tech_colorslist = tech_colorslist;
        _setTechColorModel(false);
        $scope.$apply();
    }

    /*------ For Color Approvals ------------------------ */

    /*--------For Hardware Approvals --------------------*/

    $scope.isloading_hardwareapprovals = false;
    $scope.show_hardware_dialog = false;
    $scope.hardwareapprovals = [];
    $scope.hardwareapprovals_model = models.technical_hardware_dialog_models;


    async function getHardwareApprovals() {
        if ($scope.isloading_hardwareapprovals) return;
        const fd = ts.FormData();
        $scope.isloading_hardwareapprovals = true;
        fd.append('thproject', sessionStorage.getItem("nafco_project_current_sno"));
        const res = await ts.hardwareall(fd);
        if (res?.msg !== 1) {
            $scope.isloading_hardwareapprovals = true;
            alert(res.data);
            $scope.$apply();
            return;
        }
        hardwareapprovals = [];
        hardwareapprovals = res.data;
        $scope.hardwareapprovals = hardwareapprovals;
        $scope.$apply();
        return;
    }

    $scope.shownewhardwareapprovals_click = (status) => {
        let _data = {
            isloading: false,
            mode: 1,
            btn: "Save",
            title: "Add New Hardware Submittal",
            data: {
                thid: "",
                thproject: sessionStorage.getItem("nafco_project_current_sno"),
                thsystem: "",
                thdescriptions: "",
                thnotes: "",
                thsubmittedby: "",
                thsubmitteddate: "",
                thstatus: "U",
                thsapprovedate: "",
            }
        }
        setHardwareDialogmode(status, _data)
    }
    $scope.closeHardwaredialog = (status) => {
        setHardwareDialogmode(status);
    }
    function setHardwareDialogmode(status, data = models.technical_hardware_dialog_models) {
        $scope.hardwareapprovals_model = data;
        $scope.show_hardware_dialog = status;
    }
    $scope.edit_hardwareSubmital = (status, x) => {
        let data = {
            isloading: false,
            mode: 2,
            btn: "Update",
            title: "Edit Hardware Submittal",
            data: {
                thid: x.thid,
                thproject: sessionStorage.getItem("nafco_project_current_sno"),
                thsystem: x.thsystem,
                thdescriptions: x.thdescriptions,
                thnotes: x.thnotes,
                thsubmittedby: x.thsubmittedby,
                thsubmitteddate: x.thsubmitteddate_n,
                thstatus: x.thstatus,
                thsapprovedate: x.thsapprovedate_n,
            }
        }
        setHardwareDialogmode(status, data);
    }
    $scope.savehardware_submit = async () => {
        if ($scope.hardwareapprovals_model.isloading) return;
        if ($scope.hardwareapprovals_model.mode === 1) {
            await _saveHardware();
            return;
        }

        await _updateHardware();
        return;
    }

    function _Hardwarevalidate() {
        const thsystem = document.getElementById("thsystem");
        const thdescriptions = document.getElementById("thdescriptions");
        const thnotes = document.getElementById("thnotes");
        const thsubmittedby = document.getElementById("thsubmittedby");
        const thsubmitteddate = document.getElementById("thsubmitteddate");
        const thstatus = document.getElementById("thstatus");
        if (thsystem.value.trim() === "") {
            alert("Enter System");
            thsystem.focus();
            return false;
        }
        if (thdescriptions.value.trim() === "") {
            alert("Enter Hardwares Accessories");
            thdescriptions.focus();
            return false;
        }
        if (thnotes.value.trim() === "") {
            alert("Enter Remarks");
            thnotes.focus();
            return false;
        }
        if (thsubmittedby.value.trim() === "") {
            alert("Enter Submitted By");
            thsubmittedby.focus();
            return false;
        }
        if (thsubmitteddate.value.trim() === "") {
            alert("Enter Submitted Date");
            thsubmitteddate.focus();
            return false;
        }
        if (thstatus.value.trim() === "") {
            alert("Select Status");
            thstatus.focus();
            return false;
        }
        if (thstatus.value.trim() !== "U") {
            const thsapprovedate = document.getElementById("thsapprovedate");
            if (thsapprovedate.value.trim() === "") {
                alert("Enter Date");
                thsapprovedate.focus();
                return false;
            }
        }

        return true;
    }

    async function _saveHardware() {
        if ($scope.hardwareapprovals_model.isloading) return;
        const validate = _Hardwarevalidate();
        if (!validate) return;
        const fd = ts.FormData();
        fd.append("payload", JSON.stringify($scope.hardwareapprovals_model.data));
        $scope.hardwareapprovals_model = {
            ...$scope.hardwareapprovals_model,
            data: { ...$scope.hardwareapprovals_model.data },
            isloading: true
        };

        const res = await ts.hardwarenew(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.hardwareapprovals_model = {
                ...$scope.hardwareapprovals_model,
                data: { ...$scope.hardwareapprovals_model.data },
                isloading: false
            };
            $scope.$apply();
            return;
        }

        $scope.hardwareapprovals_model = {
            ...$scope.hardwareapprovals_model,
            data: models.technical_hardware_dialog_models.data,
            isloading: false
        };
        alert("Data has Saved");
        hardwareapprovals = [];
        hardwareapprovals = res.data;
        $scope.hardwareapprovals = hardwareapprovals;
        $scope.$apply();
        return;
    }

    async function _updateHardware() {
        if ($scope.hardwareapprovals_model.isloading) return;
        const validate = _Hardwarevalidate();
        if (!validate) return;
        const fd = ts.FormData();
        fd.append("payload", JSON.stringify($scope.hardwareapprovals_model.data));
        $scope.hardwareapprovals_model = {
            ...$scope.hardwareapprovals_model,
            data: { ...$scope.hardwareapprovals_model.data },
            isloading: true
        };

        const res = await ts.hardwareupdate(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.hardwareapprovals_model = {
                ...$scope.hardwareapprovals_model,
                data: { ...$scope.hardwareapprovals_model.data },
                isloading: false
            };
            $scope.$apply();
            return;
        }
        $scope.hardwareapprovals_model = {
            ...$scope.hardwareapprovals_model,
            data: { ...$scope.hardwareapprovals_model.data },
            isloading: false
        };
        alert("Data has Saved");
        hardwareapprovals = [];
        hardwareapprovals = res.data;
        $scope.hardwareapprovals = hardwareapprovals;
        $scope.$apply();
        return;
    }

    $scope.removeHardwares = async () => {
        const c = confirm('Are You Sure Remove Hardware Submittal data?');
        if (!c) return;
        await removeData();
        return;
    }

    async function removeData() {
        if ($scope.hardwareapprovals_model.isloading) return;
        const fd = ts.FormData();
        fd.append("thid", $scope.hardwareapprovals_model.data.thid);
        fd.append("thproject", $scope.hardwareapprovals_model.data.thproject);
        $scope.hardwareapprovals_model = {
            ...$scope.hardwareapprovals_model,
            data: { ...$scope.hardwareapprovals_model.data },
            isloading: true
        };

        const res = await ts.hardwareremove(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.hardwareapprovals_model = {
                ...$scope.hardwareapprovals_model,
                data: { ...$scope.hardwareapprovals_model.data },
                isloading: false
            };
            $scope.$apply();
            return;
        }

        $scope.hardwareapprovals_model = {
            ...$scope.hardwareapprovals_model,
            data: { ...$scope.hardwareapprovals_model.data },
            isloading: false
        };
        hardwareapprovals = [];
        hardwareapprovals = res.data;
        $scope.hardwareapprovals = hardwareapprovals;
        setHardwareDialogmode(false);
        $scope.$apply();
    }

    /*--------For Hardware Approvals --------------------*/


    /*--------Technical Approvals --------------------*/

    $scope.isloading_technicalapprovals = false;
    $scope.technicalapproval_datas = [];
    $scope.technicalapproval_showdialog = false;
    $scope.technicalaprpovals_dialog = models.technicalapprovals_dialog_model;

    function _setTechnicalApprovalDialogshow(status) {
        $scope.technicalapproval_showdialog = status;
        console.log($scope.technicalaprpovals_dialog);
    }
    $scope.show_technicalsubmittal_click = () => {
        $scope.technicalaprpovals_dialog = {
            isloading: false,
            mode: 1,
            btn: "Save",
            title: "Add New Technical Submittal",
            data: {
                taid: "",
                taproject: sessionStorage.getItem("nafco_project_current_sno"),
                taapproval: "",
                tadescription: "",
                taremarks: "",
                tasubmittedby: "",
                tasubmitteddate: "",
                tastatus: "U",
                taapproveddate: "",
                tacby: "",
                taeby: "",
                tacdate: "",
                taedate: "",
            }
        };

        console.log($scope.technicalaprpovals_dialog);

        _setTechnicalApprovalDialogshow(true);
    }
    $scope.close_technicalsubmittal_click = () => {
        _setTechnicalApprovalDialogshow(false);
    }

    $scope.edit_technicalSubmital = (status, x) => {
        console.log(x);
        $scope.technicalaprpovals_dialog = {
            isloading: false,
            mode: 2,
            btn: "Update",
            title: "Edit Technical Submittal",
            data: {
                taid: x.taid,
                //taid: sessionStorage.getItem("nafco_project_current_sno"),
                taproject: x.taproject,
                taapproval: x.taapproval,
                tadescription: x.tadescription,
                taremarks: x.taremarks,
                tasubmittedby: x.tasubmittedby,
                tasubmitteddate: x.tasubmitteddate_n,
                tastatus: x.tastatus,
                taapproveddate: x.taapproveddate_n,
                tacby: x.tacby,
                taeby: x.taeby,
                tacdate: x.tacdate,
                taedate: x.taedate,
            }
        };

        _setTechnicalApprovalDialogshow(status);
    }
    getAllTechnicalApprovals();
    async function getAllTechnicalApprovals() {
        if ($scope.isloading_technicalapprovals) return;
        $scope.technicalapproval_datas = [];
        const fd = ts.FormData();
        fd.append("taproject", sessionStorage.getItem("nafco_project_current_sno"));
        $scope.isloading_technicalapprovals = true;
        const res = await ts.apicall(fd, "approvalsall");
        if (res?.msg !== 1) {
            $scope.isloading_technicalapprovals = false;
            alert(res.data);
            return;
        }
        $scope.isloading_technicalapprovals = false;
        technicalapproval_datas = [];
        technicalapproval_datas = res.data;
        $scope.technicalapproval_datas = technicalapproval_datas;
        $scope.$apply();
    }

    $scope.savetehnicalsubmittal_submit = async () => {
        console.log("working")
        console.log($scope.technicalaprpovals_dialog);
        if ($scope.technicalaprpovals_dialog.mode === 1) {
            await _saveTechnicalApprovals();
            return;
        }
        await _updateTechnicalApprovals();
        return;
    }
    async function _saveTechnicalApprovals() {
        if ($scope.technicalaprpovals_dialog.isloading) return;
        const fd = ts.FormData();
        fd.append("payload", JSON.stringify($scope.technicalaprpovals_dialog.data));
        $scope.technicalaprpovals_dialog = {
            ...$scope.technicalaprpovals_dialog,
            data: {
                ...$scope.technicalaprpovals_dialog.data,
            },
            isloading: true
        }
        const res = await ts.apicall(fd, "approvalsnew");
        if (res?.msg !== 1) {
            $scope.technicalaprpovals_dialog = {
                ...$scope.technicalaprpovals_dialog,
                data: {
                    ...$scope.technicalaprpovals_dialog.data,
                },
                isloading: false
            };
            alert(res.data);
            $scope.$apply();
            return;
        }

        $scope.technicalaprpovals_dialog = {
            ...$scope.technicalaprpovals_dialog,
            data: {
                ...$scope.technicalaprpovals_dialog.data,
                taproject: sessionStorage.getItem("nafco_project_current_sno"),
            },
            isloading: false
        };

        alert("Data Has Saved");
        technicalapproval_datas = [];
        technicalapproval_datas = res.data;
        $scope.technicalapproval_datas = technicalapproval_datas;
        $scope.$apply();
        return;
    }

    async function _updateTechnicalApprovals() {
        if ($scope.technicalaprpovals_dialog.isloading) return;
        const fd = ts.FormData();
        fd.append("payload", JSON.stringify($scope.technicalaprpovals_dialog.data));
        $scope.technicalaprpovals_dialog = {
            ...$scope.technicalaprpovals_dialog,
            data: {
                ...$scope.technicalaprpovals_dialog.data,
            },
            isloading: true
        }
        const res = await ts.apicall(fd, "approvalsupdate");
        if (res?.msg !== 1) {
            $scope.technicalaprpovals_dialog = {
                ...$scope.technicalaprpovals_dialog,
                data: {
                    ...$scope.technicalaprpovals_dialog.data,
                },
                isloading: false
            };
            alert(res.data);
            $scope.$apply();
            return;
        }
        $scope.technicalaprpovals_dialog = {
            ...$scope.technicalaprpovals_dialog,
            data: {
                ...$scope.technicalaprpovals_dialog.data,
            },
            isloading: false
        };
        technicalapproval_datas = [];
        technicalapproval_datas = res.data;
        $scope.technicalapproval_datas = technicalapproval_datas;
        alert("data Has updated");
        $scope.$apply();
    }

    $scope.removeTechnicalSubmittals = async () => {
        await RemoveData();
        return;
    }

    async function RemoveData() {
        if ($scope.technicalaprpovals_dialog.isloading) return;
        const fd = ts.FormData();
        fd.append('taid', $scope.technicalaprpovals_dialog.data.taid);
        fd.append('taproject', $scope.technicalaprpovals_dialog.data.taproject);
        $scope.technicalaprpovals_dialog = {
            ...$scope.technicalaprpovals_dialog,
            data: {
                ...$scope.technicalaprpovals_dialog.data,
            },
            isloading: true
        }
        const res = await ts.apicall(fd, 'approvalsremove');
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.technicalaprpovals_dialog = {
                ...$scope.technicalaprpovals_dialog,
                data: {
                    ...$scope.technicalaprpovals_dialog.data,
                },
                isloading: false
            }
            $scope.$apply();
            return;
        }
        $scope.technicalaprpovals_dialog = {
            ...$scope.technicalaprpovals_dialog,
            data: {
                ...$scope.technicalaprpovals_dialog.data,
            },
            isloading: false
        };
        technicalapproval_datas = [];
        technicalapproval_datas = res.data;
        $scope.technicalapproval_datas = technicalapproval_datas;
        alert("Removed");
        _setTechnicalApprovalDialogshow(false);
        $scope.$apply();
    }
    /*--------Technical Approvals --------------------*/

    /*--------Technical Calculation Approvals --------------------*/
    $scope.calculation_isloading = false;
    $scope.calculation_datas = [];
    $scope.calculaton_dia_show = false;
    $scope.calculation_dialog = models.technicalcalculations_dialog_model;

    async function getCalculationData() {
        if ($scope.calculation_isloading) return;
        $scope.calculation_datas = [];
        $scope.calculation_isloading = true;
        const fd = ts.FormData();
        fd.append("tcproject", sessionStorage.getItem("nafco_project_current_sno"));
        const res = await ts.apicall(fd, "getcalculations");
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.calculation_isloading = false;
            $scope.$apply();
            return;
        }
        $scope.calculation_isloading = false;
        calculation_datas = [];
        calculation_datas = res.data;
        $scope.calculation_datas = calculation_datas;
        $scope.$apply();
        return;
    }
    $scope.show_calculationsubmittal = () => {
        newcalculationshow();
    }
    function newcalculationshow() {
        $scope.calculation_dialog = {
            isloading: false,
            mode: 1,
            btn: "Save",
            title: "Add New Calculation Submittal",
            data: {
                tcid: "",
                tcproject: sessionStorage.getItem("nafco_project_current_sno"),
                tcsubmitall: "",
                tcsubmittedby: "",
                tcsubmittaldate: "",
                tcstatus: "U",
                tcapproveddate: "",
                tcsubmittalno: "",
                tcsubmittalrv: "",
                tccby: "",
                tceby: "",
                tccdate: "",
                tcedate: "",
            }
        }
        $scope.calculaton_dia_show = true;
    }
    $scope.edit_CalculationSubmital = (x) => {
        editcalculationshow(x)
    }
    function editcalculationshow(x) {
        $scope.calculation_dialog = {
            isloading: false,
            mode: 2,
            btn: "Update",
            title: "Update Calculation Submittal",
            data: {
                tcid: x.tcid,
                tcproject: sessionStorage.getItem("nafco_project_current_sno"),
                tcsubmitall: x.tcsubmitall,
                tcsubmittedby: x.tcsubmittedby,
                tcsubmittaldate: x.tcsubmittaldate_n,
                tcstatus: x.tcstatus,
                tcapproveddate: x.tcapproveddate_n,
                tcsubmittalno: x.tcsubmittalno,
                tcsubmittalrv: x.tcsubmittalrv,
                tccby: x.tccby,
                tceby: x.tceby,
                tccdate: x.tccdate,
                tcedate: x.tcedate,
            }
        }
        $scope.calculaton_dia_show = true;
    }
    $scope.closeCalculationdialog = () => {
        closeCalculationDialog();
    }
    function closeCalculationDialog() {
        $scope.calculaton_dia_show = false;
    }

    $scope.savecalculationSubmittal_submit = async () => {
        if ($scope.calculation_dialog.mode === 1) {
            await _savecalculations();
            return;
        }

        await _updatecalculations()
        return;

    }

    async function _savecalculations() {
        if ($scope.calculation_dialog.isloading) return;
        $scope.calculation_dialog = {
            ...$scope.calculation_dialog,
            data: {
                ...$scope.calculation_dialog.data,
            },
            isloading: true,
        }
        const fd = ts.FormData();
        fd.append('payload', JSON.stringify($scope.calculation_dialog.data));
        const res = await ts.apicall(fd, "newcalculation");
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.calculation_dialog = {
                ...$scope.calculation_dialog,
                data: {
                    ...$scope.calculation_dialog.data,
                },
                isloading: false,
            }
            $scope.$apply();
            return;
        }
        $scope.calculation_dialog = {
            ...$scope.calculation_dialog,
            data: {
                ...$scope.calculation_dialog.data,
            },
            isloading: false,
        }
        alert("Data Has Saved");
        calculation_datas = [];
        calculation_datas = res.data;
        $scope.calculation_datas = calculation_datas;
        $scope.$apply();
    }
    async function _updatecalculations() {
        if ($scope.calculation_dialog.isloading) return;
        $scope.calculation_dialog = {
            ...$scope.calculation_dialog,
            data: {
                ...$scope.calculation_dialog.data,
            },
            isloading: true,
        }
        const fd = ts.FormData();
        fd.append('payload', JSON.stringify($scope.calculation_dialog.data));
        const res = await ts.apicall(fd, "updatecalculation");
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.calculation_dialog = {
                ...$scope.calculation_dialog,
                data: {
                    ...$scope.calculation_dialog.data,
                },
                isloading: false,
            }
            $scope.$apply();
            return;
        }
        $scope.calculation_dialog = {
            ...$scope.calculation_dialog,
            data: {
                ...$scope.calculation_dialog.data,
            },
            isloading: false,
        }
        alert("Data Has Updated");
        calculation_datas = [];
        calculation_datas = res.data;
        $scope.calculation_datas = calculation_datas;
        $scope.$apply();
    }

    $scope.removeCalculation = async () => {
        await _removeCalculations()
        return;
    }
    async function _removeCalculations() {
        const c = confirm('Are You Sure Remove Data?');
        if (!c) return;
        if ($scope.calculation_dialog.isloading) return;
        $scope.calculation_dialog = {
            ...$scope.calculation_dialog,
            data: {
                ...$scope.calculation_dialog.data,
            },
            isloading: true,
        }
        const fd = ts.FormData();
        fd.append('tcproject', $scope.calculation_dialog.data.tcproject);
        fd.append('tcid', $scope.calculation_dialog.data.tcid);
        const res = await ts.apicall(fd, "removecalculation");
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.calculation_dialog = {
                ...$scope.calculation_dialog,
                data: {
                    ...$scope.calculation_dialog.data,
                },
                isloading: false,
            }
            $scope.$apply();
            return;
        }
        $scope.calculation_dialog = {
            ...$scope.calculation_dialog,
            data: {
                ...$scope.calculation_dialog.data,
            },
            isloading: false,
        }
        alert("Data Has Removed");
        calculation_datas = [];
        calculation_datas = res.data;
        $scope.calculation_datas = calculation_datas;
        $scope.calculaton_dia_show = false;
        $scope.$apply();
    }

    $scope.show_status_filter = false;
    // $scope.getCurrentvalue = () => {
    //     const _data = $scope.filters.status_filter_A ?? false;
    //     console.log(_data);
    // }
    $scope.uncheckall = () => {
        const _is = $scope?.uncheck?.un ?? false;
        $scope.filters = {
            status_filter_A : _is,
            status_filter_B : _is,
            status_filter_BC : _is,
            status_filter_C : _is,
            status_filter_D : _is,
            status_filter_U : _is,
            status_filter_E : _is,
            status_filter_F : _is,
        }
    }
    $scope.setStatusFilter = (_status) => $scope.show_status_filter = _status;
    $scope.startfilter = () => filteractions();
    function filteractions() {
        console.log("called");
        $scope.tech_colorslist = [];
        $scope.hardwareapprovals = [];
        $scope.technicalapproval_datas = [];
        $scope.calculation_datas = [];
        console.log($scope.filters.status_filter_A ?? "Error");
        const code_A = !$scope.filters.status_filter_A ? false : true;
        if (code_A) {           
            const tech_colorslist_data = tech_colorslist.filter(x => x.tcapprovedstatus === "A");                   
            tech_colorslist_data.map(i => $scope.tech_colorslist.push(i));
            const hardwareapprovals_data = hardwareapprovals.filter(x => x.thstatus === "A");
            hardwareapprovals_data.map(i => $scope.hardwareapprovals.push(i));
            const technicalapproval_datas_data = technicalapproval_datas.filter(x =>x.tastatus === "A");
            technicalapproval_datas_data.map(i => $scope.technicalapproval_datas.push(i));
            const calculation_datas_data = calculation_datas.filter(x => x.tcstatus === "A");
            calculation_datas_data.map(i => $scope.calculation_datas.push(i));
        }
        const code_B = !$scope.filters.status_filter_B ? false : true;
        if (code_B) {
            const tech_colorslist_data = tech_colorslist.filter(x => x.tcapprovedstatus === "B");                   
            tech_colorslist_data.map(i => $scope.tech_colorslist.push(i));
            const hardwareapprovals_data = hardwareapprovals.filter(x => x.thstatus === "B");
            hardwareapprovals_data.map(i => $scope.hardwareapprovals.push(i));
            const technicalapproval_datas_data = technicalapproval_datas.filter(x =>x.tastatus === "B");
            technicalapproval_datas_data.map(i => $scope.technicalapproval_datas.push(i));
            const calculation_datas_data = calculation_datas.filter(x => x.tcstatus === "B");
            calculation_datas_data.map(i => $scope.calculation_datas.push(i));
        }
        const code_BC = !$scope.filters.status_filter_BC ? false : true;
        if (code_BC) {
            const tech_colorslist_data = tech_colorslist.filter(x => x.tcapprovedstatus === "BC");                   
            tech_colorslist_data.map(i => $scope.tech_colorslist.push(i));
            const hardwareapprovals_data = hardwareapprovals.filter(x => x.thstatus === "BC");
            hardwareapprovals_data.map(i => $scope.hardwareapprovals.push(i));
            const technicalapproval_datas_data = technicalapproval_datas.filter(x =>x.tastatus === "BC");
            technicalapproval_datas_data.map(i => $scope.technicalapproval_datas.push(i));
            const calculation_datas_data = calculation_datas.filter(x => x.tcstatus === "BC");
            calculation_datas_data.map(i => $scope.calculation_datas.push(i));
        }
        const code_C = !$scope.filters.status_filter_C ? false : true;
        if (code_C) {
            const tech_colorslist_data = tech_colorslist.filter(x => x.tcapprovedstatus === "C");                   
            tech_colorslist_data.map(i => $scope.tech_colorslist.push(i));
            const hardwareapprovals_data = hardwareapprovals.filter(x => x.thstatus === "C");
            hardwareapprovals_data.map(i => $scope.hardwareapprovals.push(i));
            const technicalapproval_datas_data = technicalapproval_datas.filter(x =>x.tastatus === "C");
            technicalapproval_datas_data.map(i => $scope.technicalapproval_datas.push(i));
            const calculation_datas_data = calculation_datas.filter(x => x.tcstatus === "C");
            calculation_datas_data.map(i => $scope.calculation_datas.push(i));
        }
        const code_D = !$scope.filters.status_filter_D ? false : true;
        if (code_D) {
            const tech_colorslist_data = tech_colorslist.filter(x => x.tcapprovedstatus === "D");                   
            tech_colorslist_data.map(i => $scope.tech_colorslist.push(i));
            const hardwareapprovals_data = hardwareapprovals.filter(x => x.thstatus === "D");
            hardwareapprovals_data.map(i => $scope.hardwareapprovals.push(i));
            const technicalapproval_datas_data = technicalapproval_datas.filter(x =>x.tastatus === "D");
            technicalapproval_datas_data.map(i => $scope.technicalapproval_datas.push(i));
            const calculation_datas_data = calculation_datas.filter(x => x.tcstatus === "D");
            calculation_datas_data.map(i => $scope.calculation_datas.push(i));
        }
        const code_U = !$scope.filters.status_filter_U ? false : true;
        if (code_U) {
            const tech_colorslist_data = tech_colorslist.filter(x => x.tcapprovedstatus === "U");                   
            tech_colorslist_data.map(i => $scope.tech_colorslist.push(i));
            const hardwareapprovals_data = hardwareapprovals.filter(x => x.thstatus === "U");
            hardwareapprovals_data.map(i => $scope.hardwareapprovals.push(i));
            const technicalapproval_datas_data = technicalapproval_datas.filter(x =>x.tastatus === "U");
            technicalapproval_datas_data.map(i => $scope.technicalapproval_datas.push(i));
            const calculation_datas_data = calculation_datas.filter(x => x.tcstatus === "U");
            calculation_datas_data.map(i => $scope.calculation_datas.push(i));
        }
        const code_E = !$scope.filters.status_filter_E ? false : true;
        if (code_E) {
            const tech_colorslist_data = tech_colorslist.filter(x => x.tcapprovedstatus === "E");                   
            tech_colorslist_data.map(i => $scope.tech_colorslist.push(i));
            const hardwareapprovals_data = hardwareapprovals.filter(x => x.thstatus === "E");
            hardwareapprovals_data.map(i => $scope.hardwareapprovals.push(i));
            const technicalapproval_datas_data = technicalapproval_datas.filter(x =>x.tastatus === "E");
            technicalapproval_datas_data.map(i => $scope.technicalapproval_datas.push(i));
            const calculation_datas_data = calculation_datas.filter(x => x.tcstatus === "E");
            calculation_datas_data.map(i => $scope.calculation_datas.push(i));
        }
        const code_F = !$scope.filters.status_filter_F ? false : true;
        if (code_F) {
            const tech_colorslist_data = tech_colorslist.filter(x => x.tcapprovedstatus === "F");                   
            tech_colorslist_data.map(i => $scope.tech_colorslist.push(i));
            const hardwareapprovals_data = hardwareapprovals.filter(x => x.thstatus === "F");
            hardwareapprovals_data.map(i => $scope.hardwareapprovals.push(i));
            const technicalapproval_datas_data = technicalapproval_datas.filter(x =>x.tastatus === "F");
            technicalapproval_datas_data.map(i => $scope.technicalapproval_datas.push(i));
            const calculation_datas_data = calculation_datas.filter(x => x.tcstatus === "F");
            calculation_datas_data.map(i => $scope.calculation_datas.push(i));
        }
        $scope.show_status_filter = false;
    }

    $scope.printdatas = () => {
        console.log("called");
        if (
            $scope.approvedsystems.length === 0 &&
            $scope.tech_colorslist.length === 0 &&
            $scope.hardwareapprovals.length === 0 &&
            $scope.calculation_datas.length === 0 &&
            $scope.technicalapproval_datas.length === 0
        ) {
            alert("no data found")
            return;
        }
        const _data = {
            projectinfo: $scope.viewproject,
            approvedsystems: $scope.approvedsystems,
            tech_colorslist: $scope.tech_colorslist,
            hardwareapprovals: $scope.hardwareapprovals,
            calculation_datas: $scope.calculation_datas,
            technicalapproval_datas: $scope.technicalapproval_datas,
        }
        localStorage.removeItem('pms_comp_print');
        localStorage.setItem('pms_comp_print', JSON.stringify(_data));
        window.open(`${print_location}/sprint/com.html`, "_blank")
    }

    $scope.smaple_techsubmittal = () => {
        const _status = $scope.technicalaprpovals_dialog?.data?.tastatus || "";
        if (_status.trim() === '') return;
        const res = models.statuslist.find(x => x.code === _status);
        const f = res.code_description.split('-');
        $scope.technicalaprpovals_dialog = {
            ...$scope.technicalaprpovals_dialog,
            data: {
                ...$scope.technicalaprpovals_dialog.data,
                taremarks : f[1]
            }
        }
    }

    $scope.sample_hardwares = () => {
        const _status = $scope.hardwareapprovals_model?.data?.thstatus || "";
        if (_status.trim() === '') return;
        const res = models.statuslist.find(x => x.code === _status);
        const f = res.code_description.split('-');
        $scope.hardwareapprovals_model = {
            ...$scope.hardwareapprovals_model,
            data: {
                ...$scope.hardwareapprovals_model.data,
                thnotes : f[1]
            }
        }

        return;
    }

    


}
