import cuttinglistservices from "../../../cuttinglist/js/services/index.js";
import * as models from './models.js';
export default function boqopenew($scope, $http) {
    const boq = new cuttinglistservices();
    $scope.boqeng = models.boqmodel;
    get_projectinfo();
    function get_projectinfo() {
        let project_id = sessionStorage.getItem("nafco_project_current");
        let post_data = {
            naf_user: userinfo,
            project_no: project_id,
        };
        //var req = $http.post(api_url + "Project/view.php", post_data);
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
                    poq_project_code: $scope.viewproject.project_no_enc,
                    boq_refno: $scope.viewproject.project_boq_refno,
                    boq_reviewno: $scope.viewproject.project_boq_revision,
                    boq_type_refno: $scope.viewproject.project_boq_refno,
                    boq_type_rno: $scope.viewproject.project_boq_revision,
                    issupersede: '0',
                    oldboqid: '0',
                }
                document.title = "New BOQ For" + $scope.viewproject.project_name;
                console.log($scope.boqeng);
            } else {
                alert(res.data.data);
                window.location.href = `${print_location}/Dashboard/Main/index.php`;
            }
        });
    }

    PageLoad();
    $scope.itemtypes = [];
    $scope.finishtypes = [];
    $scope.systemtypes = [];
    $scope.unittypes = [];
    $scope.autocompleate = {};

    $scope.isloading = false;
    async function PageLoad() {
        const BoqitemTypes = new Promise(async (res, rej) => {
            const req = await boq.GET('boqop/itemtypes.php');
            if (req.msg !== 1) {
                rej(req.data);
                return;
            }
            res(req.data);
            return;
        })

        const BoqFinishTypes = new Promise(async (res, rej) => {
            const req = await boq.GET('boqop/finishtypes.php');
            if (req.msg !== 1) {
                rej(req.data);
                return;
            }
            res(req.data);
            return;
        })

        const BoqSystemTypes = new Promise(async (res, rej) => {
            const req = await boq.GET('boqop/systemtypes.php');
            if (req.msg !== 1) {
                rej(req.data);
                return;
            }
            res(req.data);
            return;
        })
        const BoqUnitTypes = new Promise(async (res, rej) => {
            const req = await boq.GET('boqop/unittypes.php');
            if (req.msg !== 1) {
                rej(req.data);
                return;
            }
            res(req.data);
            return;
        })

        const BoqAutoCompleates = new Promise(async (res, rej) => {
            const req = await boq.GET('boqop/index.php');
            if (req.msg !== 1) {
                rej(req.data);
                return;
            }
            res(req.data);
            return;
        })
        $scope.isloading = true;

        Promise.all([BoqitemTypes, BoqFinishTypes, BoqSystemTypes, BoqUnitTypes, BoqAutoCompleates])
            .then(async ([itemtypes, finishtypes, systemtypes, unittypes, autocompleate]) => {
                console.log(itemtypes, finishtypes, systemtypes, unittypes, autocompleate);
                $scope.itemtypes = await itemtypes;
                $scope.finishtypes = await finishtypes;
                $scope.systemtypes = await systemtypes;
                $scope.unittypes = await unittypes;
                $scope.autocompleate = await autocompleate;
                $scope.isloading = false;
                $scope.$apply();
            }).catch(async (err) => {
                $scope.isloading = false;
                $scope.$apply();
                console.log(err)
            })
    }


    // =============================AUTO COMPLEATE DIALOG CODE==========================//
    document.getElementById("auto_itemtypes").style.display = "none";
    document.getElementById("auto_finsish").style.display = "none";
    document.getElementById("auto_systems").style.display = "none";
    document.getElementById("auto_units").style.display = "none";
    let current_itemtype = {};
    let current_finishtype = {};
    let current_systemtype = {};
    let current_units = {};
    //item type
    $scope.showitemtype = ($event) => {
        document.getElementById("auto_finsish").style.display = "none";
        document.getElementById("auto_systems").style.display = "none";
        document.getElementById("auto_units").style.display = "none";

        document.getElementById("auto_itemtypes").style.display = "flex";
        document.getElementById("src_boqitem_type").focus();
        document.getElementById("src_boqitem_type").value = "";
    }
    document.getElementById('src_boqitem_type').addEventListener("keydown", (e) => {

        if (e.which === 27) {
            document.getElementById("auto_itemtypes").style.display = "none";
            document.getElementById("poq_item_type").focus();
        }
        if (e.which === 8) {
            if (document.getElementById("src_boqitem_type").value === '') {
                document.getElementById("auto_itemtypes").style.display = "none";
                document.getElementById("poq_item_type").focus();
            }
        }
    })

    $scope.select_item_type = (x) => {
        current_itemtype = x;
        $scope.boqeng = {
            ...$scope.boqeng,
            poq_item_type: x.ptype_name
        };
        document.getElementById("auto_itemtypes").style.display = "none";
        document.getElementById("poq_item_remark").focus();
    }

    //finish type
    $scope.showfinishtype = ($event) => {
        document.getElementById("auto_itemtypes").style.display = "none";
        document.getElementById("auto_finsish").style.display = "flex";
        document.getElementById("auto_systems").style.display = "none";
        document.getElementById("auto_units").style.display = "none";

        document.getElementById("src_boqfinish_type").focus();
        document.getElementById("src_boqfinish_type").value = "";
    }
    document.getElementById('src_boqfinish_type').addEventListener("keydown", (e) => {
        //console.log(e.which);
        if (e.which === 27) {
            document.getElementById("auto_finsish").style.display = "none";
            document.getElementById("poq_finish").focus();
        }
        if (e.which === 8) {
            if (document.getElementById("src_boqfinish_type").value === '') {
                document.getElementById("auto_finsish").style.display = "none";
                document.getElementById("poq_finish").focus();
            }
        }
    })

    $scope.select_finish_type = (x) => {
        current_finishtype = x;
        $scope.boqeng = {
            ...$scope.boqeng,
            poq_finish: x.finish_name
        };
        document.getElementById("auto_finsish").style.display = "none";
        document.getElementById("poq_system_type").focus();
    }

    //system type
    $scope.showsystemtype = ($event) => {
        document.getElementById("auto_itemtypes").style.display = "none";
        document.getElementById("auto_finsish").style.display = "none";
        document.getElementById("auto_systems").style.display = "flex";
        document.getElementById("auto_units").style.display = "none";

        document.getElementById("src_boqsystem_type").focus();
        document.getElementById("src_boqsystem_type").value = "";
    }
    document.getElementById('src_boqsystem_type').addEventListener("keydown", (e) => {

        if (e.which === 27) {
            document.getElementById("auto_systems").style.display = "none";
            document.getElementById("poq_system_type").focus();
        }
        if (e.which === 8) {
            if (document.getElementById("src_boqsystem_type").value === '') {
                document.getElementById("auto_systems").style.display = "none";
                document.getElementById("poq_system_type").focus();
            }
        }
    })

    $scope.select_system_type = (x) => {
        current_systemtype = x;
        $scope.boqeng = {
            ...$scope.boqeng,
            poq_system_type: x.system_type_name
        };
        document.getElementById("auto_systems").style.display = "none";
        document.getElementById("poq_qty").focus();
    }

    //unit types
    $scope.showunitstype = ($event) => {
        document.getElementById("auto_finsish").style.display = "none";
        document.getElementById("auto_systems").style.display = "none";
        document.getElementById("auto_units").style.display = "flex";
        document.getElementById("auto_itemtypes").style.display = "none";

        document.getElementById("src_boqunits_type").focus();
        document.getElementById("src_boqunits_type").value = "";
    }
    document.getElementById('src_boqunits_type').addEventListener("keydown", (e) => {

        if (e.which === 27) {
            document.getElementById("auto_units").style.display = "none";
            document.getElementById("poq_unit").focus();
        }
        if (e.which === 8) {
            if (document.getElementById("src_boqunits_type").value === '') {
                document.getElementById("auto_units").style.display = "none";
                document.getElementById("poq_unit").focus();
            }
        }
    })

    $scope.select_units_type = (x) => {
        current_units = x;
        $scope.boqeng = {
            ...$scope.boqeng,
            poq_unit: x.unit_name
        };
        document.getElementById("auto_units").style.display = "none";
        document.getElementById("boq_area").focus();
    }
    // =============================AUTO COMPLEATE DIALOG CODE END==========================//
    // =============================REMOVE ITEMS==========================//

    //remove item type
    $scope.remove_boqitem_type = async (x) => {
        if ($scope.isloading) return;
        let c = confirm("Are You Sure Remove Data?");
        if (!c) return;
        $scope.isloading = true;
        const res = await boq.GET('boqop/remove_itemtype.php?id=' + x);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isloading = false;
            $scope.$apply();
            return;
        }
        alert("Removed");
        $scope.itemtypes = [];
        $scope.itemtypes = res.data;
        $scope.isloading = false;
        $scope.$apply();
        return;
    }

    //remove unit type
    $scope.remove_units_type = async (x) => {
        if ($scope.isloading) return;
        let c = confirm("Are You Sure Remove Data?");
        if (!c) return;
        $scope.isloading = true;
        const res = await boq.GET('boqop/remove_unittypes.php?id=' + x);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isloading = false;
            $scope.$apply();
            return;
        }
        alert("Removed");
        $scope.unittypes = [];
        $scope.unittypes = res.data;
        $scope.isloading = false;
        $scope.$apply();
        return;
    }

    //remove system type
    $scope.remove_system_type = async (x) => {
        if ($scope.isloading) return;
        let c = confirm("Are You Sure Remove Data?");
        if (!c) return;
        $scope.isloading = true;
        const res = await boq.GET('boqop/remove_systemtypes.php?id=' + x);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isloading = false;
            $scope.$apply();
            return;
        }
        alert("Removed");
        $scope.systemtypes = [];
        $scope.systemtypes = res.data;
        $scope.isloading = false;
        $scope.$apply();
        return;
    }

    //remove finish types
    $scope.remove_finish_type = async (x) => {
        if ($scope.isloading) return;
        let c = confirm("Are You Sure Remove Data?");
        if (!c) return;
        $scope.isloading = true;
        const res = await boq.GET('boqop/remove_finishtypes.php?id=' + x);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isloading = false;
            $scope.$apply();
            return;
        }
        alert("Removed");
        $scope.finishtypes = [];
        $scope.finishtypes = res.data;
        $scope.isloading = false;
        $scope.$apply();
        return;
    }
    // =============================REMOVE ITEMS END==========================//

    // =============================Add And Edit==========================//
    // boq item type
    document.getElementById("show_new_itemtype").style.display = "none";
    $scope.item_model = models.item_model;
    $scope.addnewitemtype = () => {
        document.getElementById("show_new_itemtype").style.display = "flex";
        $scope.item_model = {
            mode: "1",
            data: {
                ptype_id: '',
                ptype_name: ''
            }
        }
        document.getElementById("ptype_name").focus();
    }
    $scope.hide_itemnew = () => {
        document.getElementById("show_new_itemtype").style.display = "none";
    }

    $scope.edit_boqitem_type = (x) => {
        console.log(x);
        $scope.item_model = {
            mode: "2",
            data: {
                ptype_id: x.ptype_id,
                ptype_name: x.ptype_name
            }
        }
        console.log($scope.item_model);
        document.getElementById("show_new_itemtype").style.display = "flex";
        document.getElementById("ptype_name").focus();

    }

    async function _saveItemType() {
        $scope.isloading = true;
        const fd = new FormData();
        fd.append("payload", JSON.stringify($scope.item_model.data));
        const res = await boq.POST('boqop/new_itemtype.php', fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isloading = false;
            $scope.$apply();
            return;
        }
        $scope.isloading = false;
        $scope.item_model = {
            ...$scope.item_model,
            data: {
                ptype_id: '',
                ptype_name: ''
            }
        };
        $scope.itemtypes = [];
        $scope.itemtypes = res.data;
        alert("Saved");
        $scope.$apply();
    }

    async function _updateItemType() {
        $scope.isloading = true;
        const fd = new FormData();
        fd.append("payload", JSON.stringify($scope.item_model.data));
        const res = await boq.POST('boqop/edit_itemtype.php', fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isloading = false;
            $scope.$apply();
            return;
        }
        $scope.isloading = false;
        $scope.itemtypes = [];
        $scope.itemtypes = res.data;
        alert("Saved");
        $scope.$apply();
    }

    $scope.save_newtype = async () => {
        if ($scope.isloading) return;
        if ($scope.item_model.mode === "1") {
            await _saveItemType()
            return;
        }
        await _updateItemType()
        return;
    }



    //boq item finsih
    $scope.finishtype_model = models.finishtype_model;
    document.getElementById("show_new_finishtype").style.display = "none";
    $scope.addnewsystemtype = () => {
        $scope.finishtype_model = {
            mode: "1",
            data: {
                finish_id: '',
                finish_name: '',
            }
        };
        document.getElementById("show_new_finishtype").style.display = "flex";
        document.getElementById("finish_name").focus();
    }
    $scope.edit_finish_type = (x) => {
        $scope.finishtype_model = {
            mode: '2',
            data: {
                finish_id: x.finish_id,
                finish_name: x.finish_name,
            }
        }
        document.getElementById("show_new_finishtype").style.display = "flex";
        document.getElementById("finish_name").focus();
    }
    $scope.hide_finishnew = () => {
        document.getElementById("show_new_finishtype").style.display = "none";
    }

    async function _saveFinishtype() {
        $scope.isloading = true;
        const fd = new FormData();
        fd.append('payload', JSON.stringify($scope.finishtype_model.data));
        const res = await boq.POST('boqop/new_finishtype.php', fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isloading = false;
            $scope.$apply();
            return;
        }
        alert("data has saved")
        $scope.finishtypes = [];
        $scope.finishtypes = res.data;
        $scope.isloading = false;
        $scope.finishtype_model = {
            mode: "1",
            data: {
                finish_id: '',
                finish_name: '',
            }
        }
        $scope.$apply();
        return;
    }

    async function _editFinishType() {
        $scope.isloading = true;
        const fd = new FormData();
        fd.append('payload', JSON.stringify($scope.finishtype_model.data));
        const res = await boq.POST('boqop/edit_finishtype.php', fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isloading = false;
            $scope.$apply();
            return;
        }
        alert("Data Has Updated");
        $scope.finishtypes = [];
        $scope.finishtypes = res.data;
        $scope.isloading = false;
        $scope.$apply();
        return;
    }

    $scope.save_newfinish = async () => {
        if ($scope.isloading) return;
        if ($scope.finishtype_model.mode === "1") {
            await _saveFinishtype();
            return;
        }
        await _editFinishType();
        return;
    }


    //system edit
    $scope.systemtype_model = models.systemtype_model;
    document.getElementById("show_new_systemtype").style.display = 'none';
    $scope.show_systemtypeadd = () => {
        document.getElementById("show_new_systemtype").style.display = 'flex';
        $scope.systemtype_model = {
            mode: "1",
            data: {
                system_type_id: '',
                system_type_name: ''
            }
        };
        document.getElementById("system_type_name").focus();
    }
    $scope.edit_system_type = (x) => {
        document.getElementById("show_new_systemtype").style.display = 'flex';
        $scope.systemtype_model = {
            mode: '2',
            data: {
                system_type_id: x.system_type_id,
                system_type_name: x.system_type_name
            }
        };
        document.getElementById("system_type_name").focus();
    }
    $scope.hide_systemtype = () => {
        document.getElementById("show_new_systemtype").style.display = 'none';
    }

    async function _savesysteType() {
        $scope.isloading = true;
        const fd = new FormData();
        fd.append("payload", JSON.stringify($scope.systemtype_model.data));
        const res = await boq.POST('boqop/new_systemtype.php', fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isloading = false;
            $scope.$apply();
            return;
        }
        alert('Saved');
        $scope.isloading = false;
        $scope.systemtypes = [];
        $scope.systemtypes = res.data;
        $scope.systemtype_model = {
            mode: "1",
            data: {
                system_type_id: '',
                system_type_name: ''
            }
        }
        $scope.$apply();
        return;
    }

    async function _updatesysteType() {
        $scope.isloading = true;
        const fd = new FormData();
        fd.append("payload", JSON.stringify($scope.systemtype_model.data));
        const res = await boq.POST('boqop/edit_systemtype.php', fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isloading = false;
            $scope.$apply();
            return;
        }
        alert('Saved');
        $scope.isloading = false;
        $scope.systemtypes = [];
        $scope.systemtypes = res.data;
        $scope.$apply();
        return;
    }
    $scope.save_newsystem = async () => {
        if ($scope.isloading) return;
        if ($scope.systemtype_model.mode === "1") {
            await _savesysteType();
            return;
        }
        await _updatesysteType();
        return;
    }
    //unit edit
    $scope.unittyp_model = models.unittyp_model;
    document.getElementById("show_new_unittype").style.display = "none";
    $scope.show_newunits = () => {
        document.getElementById("show_new_unittype").style.display = "flex";
        $scope.unittyp_model = {
            mode: "1",
            data: {
                uint_id: '',
                unit_name: ''
            }
        };
        document.getElementById("unit_name").focus();
    }
    $scope.edit_units_type = (x) => {
        $scope.unittyp_model = {
            mode: '2',
            data: {
                uint_id: x.uint_id,
                unit_name: x.unit_name
            }
        }
        document.getElementById("show_new_unittype").style.display = "flex";
        document.getElementById("unit_name").focus();
    }
    $scope.hide_unitnew = () => {
        document.getElementById("show_new_unittype").style.display = "none";
    }

    async function _saveunits() {
        $scope.isloading = true;
        const fd = new FormData();
        fd.append('payload', JSON.stringify($scope.unittyp_model.data));
        const res = await boq.POST('boqop/new_unittypes.php', fd);
        if (res?.msg !== 1) {
            $scope.isloading = false;
            $scope.$apply();
            return;
        }
        alert('data has saved');
        $scope.isloading = false;
        $scope.unittypes = [];
        $scope.unittypes = res.data;
        $scope.unittyp_model = {
            mode: "1",
            data: {
                uint_id: '',
                unit_name: ''
            }
        };
        $scope.$apply();
    }

    async function _updateunits() {
        $scope.isloading = true;
        const fd = new FormData();
        fd.append('payload', JSON.stringify($scope.unittyp_model.data));
        const res = await boq.POST('boqop/edit_unittypes.php', fd);
        if (res?.msg !== 1) {
            $scope.isloading = false;
            $scope.$apply();
            return;
        }
        alert('data has Updated');
        $scope.isloading = false;
        $scope.unittypes = [];
        $scope.unittypes = res.data;
        $scope.$apply();
    }

    $scope.save_newunits = async () => {
        if ($scope.isloading) return;
        if ($scope.unittyp_model.mode === "1") {
            _saveunits();
            return;
        }
        _updateunits();
        return;
    }

    // =============================Add And Edit END ==========================//

    //======================= calculation actions ===============================//


    $scope.calcmode = "qty";
    $scope.totareamode = true;

    function calc() {
        const poq_item_width = !$scope.boqeng.poq_item_width || $scope.boqeng.poq_item_width === '' ? 0 : $scope.boqeng.poq_item_width;
        const poq_item_height = !$scope.boqeng.poq_item_height || $scope.boqeng.poq_item_height === '' ? 0 : $scope.boqeng.poq_item_height;
        const area = (+poq_item_width) * (+poq_item_height);

        const poq_qty = !$scope.boqeng.poq_qty || $scope.boqeng.poq_qty === '' ? 0 : $scope.boqeng.poq_qty;
        let boq_area = !$scope.boqeng.boq_area || $scope.boqeng.boq_area === '' ? 0 : $scope.boqeng.boq_area;
        if ($scope.totareamode) {
            boq_area = (+area) * (+poq_qty)
        } else {

        }
        const poq_uprice = !$scope.boqeng.poq_uprice || $scope.boqeng.poq_uprice === '' ? 0 : $scope.boqeng.poq_uprice;
        let tot_price = 0;
        if ($scope.calcmode === "qty") {
            tot_price = (+poq_qty) * (+poq_uprice);
        } else {
            if ($scope.totareamode) {
                tot_price = (+boq_area / 1000000) * (+poq_uprice);
            } else {
                tot_price = (+boq_area) * (+poq_uprice);
            }
        }
        $scope.boqeng = {
            ...$scope.boqeng,
            area: area,
            totprice: tot_price
        }
        if ($scope.totareamode) {
            $scope.boqeng = {
                ...$scope.boqeng,
                boq_area: (+boq_area) / 1000000,
            }
        }
    }
    $scope.calc_item_area = () => calc();
    $scope.cal_item_qty = () => calc();
    $scope.calcnew = () => calc();
    $scope.calcnews = () => calc();
    $scope.descriptionlist = [];
    $scope.addtolist = ($event) => {
        if ($event.which === 13) {
            if (!$scope.boqeng.poq_item_remark || $scope.boqeng.poq_item_remark === '') {
                return;
            }
            if (!$scope.descriptionlist.includes($scope.boqeng.poq_item_remark)) {
                $scope.descriptionlist.push($scope.boqeng.poq_item_remark);
                $scope.boqeng.poq_item_remark = "";
                document.getElementById("poq_item_remark").focus();
            }
        }
    }
    $scope.remove_description = (index) => {
        $scope.descriptionlist.splice(index, 1);
    }
    $scope.mode = "1";
    $scope.save_boq = () => {
        if ($scope.isloading) return;
        if ($scope.mode === "2") {
            return;
        }
        _saveBoq();
        return;
    }
    async function _saveBoq() {

        const fd = new FormData();
        let remarks = [];
        if ($scope.descriptionlist.length === 0) {
            remarks.push($scope.boqeng.poq_item_remark);
        } else {
            remarks = $scope.descriptionlist;
        }
        let project_boq_refno = $scope.viewproject.project_boq_refno ?? '';
        let project_boq_revision = $scope.viewproject.project_boq_revision ?? '';
        if (project_boq_revision === '' || project_boq_refno === '') {
            alert("BOQ referance and Revision Number Missing");
            return;
        }
        $scope.boqeng = {
            ...$scope.boqeng,
            poq_finish: current_finishtype.finish_id,
            poq_system_type: current_systemtype.system_type_id,
            poq_item_type: current_itemtype.ptype_id,
            poq_unit: current_units.uint_id,
            boq_calby: $scope.calcmode,
            poq_item_remark: JSON.stringify(remarks),
        }
        fd.append("payload", JSON.stringify($scope.boqeng));
        $scope.isloading = true;
        const res = await boq.POST('boqop/new_boq.php', fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isloading = false;
            $scope.$apply();
            return;
        }
        $scope.isloading = false;
        alert("saved");
        window.location.reload();
        return;
    }
    async function _updateBoq() { };

    $scope.referance = {
        isloading: false,
        mode: "2",
        data: {
            refno: '',
            revisionno: ''
        }
    }

    document.getElementById("show_new_referance").style.display = "none";
    $scope.add_boqrefno = (mode = "1") => {
        $scope.referance = {
            isloading: false,
            mode: mode,
            data: {
                refno: mode === "2" ? $scope.viewproject.project_boq_refno : '',
                revisionno:  mode === "2" ? $scope.viewproject.project_boq_revision : '',
            }
        }
        document.getElementById("show_new_referance").style.display = "flex";
    }
    $scope.hide_newreferance = () => {
        document.getElementById("show_new_referance").style.display = "none";
    }
    $scope.update_referace = async () => await _updateprojectBoq_referance();

    async function _updateprojectBoq_referance() {
        if ($scope.isloading) return;
        const refno = $scope.referance.data.refno ?? "";
        const rev = $scope.referance.data.revisionno ?? "";
        if (refno.trim() === '') {
            document.getElementById("refno").focus();
            return;
        }
        if (rev.trim() === "") {
            document.getElementById("revisionno").focus();
            return;
        }
        const fd = new FormData();
        fd.append('refno', refno);
        fd.append('rewno', rev);

        $scope.isloading = true;
        const res = await boq.POST(`boqop/updatereferance.php?project_id=${$scope.viewproject.project_id}`, fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isloading = false;
            $scope.$apply();
            return;
        }
        alert(res.data);
        window.location.reload();
        return;

    }
}