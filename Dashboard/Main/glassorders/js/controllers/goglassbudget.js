import GBudget from './../services/budget.js'
import GlassSupplierServices from './../services/suppliers.js';
export default function goglassbudget($scope, $compile, $rootScope, $filter) {
    let project_auto_dia = "N";
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

    $scope.access = {

    };
    let username = userinfo.user_name;

    let pn_users = ['procurement_demo'];

    let _mode = pn_users.includes(username) ? "PN" : "N";
    $scope.selected_project = {};
    $scope.selected_supplier = {};
    $scope.selected_glass = {};
    const _msg = (d, t, msg = "") => {
        let icon = t === "n" ? "fa fa-exclamation-circle" : "fa fa-info-circle";
        let theme = t === "n" ? "ism-dialog-input-error" : "ism-dialog-input-success";

        $scope.res = {
            display: d,
            theme: theme,
            icon: icon,
            msg: msg
        }
        setTimeout(_msgoff, 2000);
    }
    _msg(false, "n")
    function _msgoff() {
        $scope.res.display = false;
        $scope.$apply();
    }

    const gb = new GBudget();
    const gs = new GlassSupplierServices();

    const dia_glassbudget = document.getElementById("dia_glassbudget");
    dia_glassbudget.style.display = "none";
    $scope.add_new_budget = () => {
        project_auto_dia = "N"
        dia_glassbudget.style.display = "flex";
    }
    const budget_auto_projects = document.getElementById("budget_auto_projects");
    budget_auto_projects.style.display = "none";


    $scope.view_project_list = () => {
        hideallautofill();
        if ($scope.budget.mode !== 'PN' && $scope.budget.mode !== "PE") {
            budget_auto_projects.style.display = "block";
            document.getElementById("search_listed_project").focus();
        }
    }

    $scope.project_list_search_input_change = ($event) => {
        let key = $event.which;
        console.log(project_auto_dia)
        //console.log(key);
        if (key === 8) {

            let length = $event.target.value.length;
            if (length < 1) {
                if (project_auto_dia === "N") {
                    budget_auto_projects.style.display = "none";
                    document.getElementById("gbproject").focus();
                    
                }
                else {
                    document.getElementById("select_auto_projects").style.display = "none"
                    
                }
            }
        }
        if (key === 27) {
            if (project_auto_dia === "N") {
                budget_auto_projects.style.display = "none";
                document.getElementById("gbproject").focus();                
            } else {
                document.getElementById("select_auto_projects").style.display = "none"
            }
        }
    }
    $scope.gen_project_list = [];
    $scope.get_supplier_list = [];
    $scope.get_glass_list = [];
    getAllProject();
    $scope.select_project = (x) => {
        console.log(x);
        $scope.selected_project = x;
        if (project_auto_dia === "N") {
            document.getElementById("budget_auto_projects").style.display = "none";
            document.getElementById("gbsupplier").focus();
        } else {
            document.getElementById("select_auto_projects").style.display = "none";
            $scope.current_select_project_mo = x.project_name;
        }
        
        $scope.budget = {
            ...$scope.budget,
            data: {
                ...$scope.budget.data,
                gbproject: x.project_name
            }
        };
    }

    function hideallautofill() {
        document.getElementById("budget_auto_projects").style.display = "none";
        document.getElementById("budget_auto_suppliers").style.display = "none";
        document.getElementById("budget_auto_glass").style.display = "none";
    }

    async function getAllProject() {
        const res_project = gb.getAllProjects();
        const res_suppliers = gs.getAllGlassSuppliers();
        const res_glasslist = gb.allglassdescriptoins();

        const res_project_final = await res_project;
        const res_suppliers_final = await res_suppliers;
        const res_glasslist_final = await res_glasslist;

        if (res_project_final?.msg !== 1) {
            alert("Fetch Error");
            console.warn("Error on fetching Project List");
            console.error(res.data);
            return;
        }


        if (res_suppliers_final?.msg !== 1) {
            alert("Fetch Error");
            console.warn("Error on fetching Supplier List");
            console.error(res.data);
            return;
        }


        if (res_glasslist_final?.msg !== 1) {
            alert("Fetch Error");
            console.warn("Error on fetching Glass List");
            console.error(res.data);
            return;
        }

        $scope.gen_project_list = res_project_final.data;
        $scope.get_supplier_list = res_suppliers_final.data;
        $scope.get_glass_list = res_glasslist_final.data;
        $scope.$apply();
        return;
    }


    document.getElementById("budget_auto_suppliers").style.display = "none";

    $scope.view_supplier_list = () => {

        hideallautofill();
        if ($scope.budget.mode !== 'PN' && $scope.budget.mode !== "PE") {
            document.getElementById("budget_auto_suppliers").style.display = "block";
            document.getElementById("search_listed_supplier").focus();
        }
    }

    $scope.supplier_list_search_input_change = ($event) => {
        let key = $event.which;
        //console.log(key);
        let length = $event.target.value.length;
        if (length < 1) {
            if (key === 8) {


                document.getElementById("budget_auto_suppliers").style.display = "none";
                document.getElementById("gbsupplier").focus();
                return;

            }
        }
        if (key === 27) {
            document.getElementById("budget_auto_suppliers").style.display = "none";
            document.getElementById("gbsupplier").focus();
            return;
        }
    }

    $scope.select_supplier = (x) => {
        console.log(x);
        $scope.selected_supplier = x;
        document.getElementById("budget_auto_suppliers").style.display = "none";
        document.getElementById("gbudgettype").focus();
        $scope.budget = {
            ...$scope.budget,
            data: {
                ...$scope.budget.data,
                gbsupplier: x.glasssuppliername
            }
        };
    }

    document.getElementById("budget_auto_glass").style.display = "none";
    $scope.view_glass_list = () => {
        hideallautofill();
        if ($scope.budget.mode !== 'PN' && $scope.budget.mode !== "PE") {
            document.getElementById("budget_auto_glass").style.display = "block";
            document.getElementById("search_listed_glass").focus();
        }
    }

    $scope.glass_list_search_input_change = ($event) => {
        let key = $event.which;
        //console.log(key);
        let length = $event.target.value.length;
        if (length < 1) {
            if (key === 8) {

                document.getElementById("budget_auto_glass").style.display = "none";
                document.getElementById("gbudgetspc").focus();
                return;

            }
        }
        if (key === 27) {
            document.getElementById("budget_auto_glass").style.display = "none";
            document.getElementById("gbudgetspc").focus();
            return;
        }
    }

    $scope.select_glass = (x) => {
        console.log(x);
        $scope.selected_glass = x;
        document.getElementById("budget_auto_glass").style.display = "none";
        document.getElementById("gbudgetarea").focus();
        $scope.budget = {
            ...$scope.budget,
            data: {
                ...$scope.budget.data,
                gbudgetspc: x.glassdescriptoinsspec,
                gbudgetglasstype: x.glassdescriptoinstype,
                gbudgtickness: x.gdesriptionsortfrm,
            }
        };

    }
    //adding options start

    const dia_suppliers = document.getElementById("dia_suppliers");

    // dia_glasstype.style.display = "none";
    // dia_glassdescription.style.display = "none";
    dia_suppliers.style.display = "none";
    function _emptysuppliers() {
        const _ = {
            isloading: false,
            title: "Add New Supplier",
            btn: "Save",
            mode: "N",
            data: {
                glasssupplierid: "0",
                glasssuppliername: "",
                glasssuppliercountry: "",
            }
        };

        return _;
    }
    $scope.suppliers = _emptysuppliers();
    $scope.addnewsupplier_click = () => {
        hideallautofill();
        $scope.suppliers = _emptysuppliers();
        dia_suppliers.style.display = "flex";
    }

    $scope.save_suppliers_submit = async () => {
        if ($scope.suppliers.isloading) {
            console.log("Already Another Process Is Running...");
            return;
        }

        if ($scope.suppliers.mode === "N") {
            await _savesuppliers();
        } else {
            await _updatesupplier();
        }
    }

    function _validate() {

        const glasssuppliername = document.getElementById("glasssuppliername");
        const glasssuppliercountry = document.getElementById("glasssuppliercountry");
        if (glasssuppliername.value.trim() === "") {
            _msg(true, "n", "Enter Supplier Name");
            glasssuppliername.focus();
            return 0;
        }

        if (glasssuppliercountry.value.trim() === "") {
            _msg(true, "n", "Enter Supplier Location");
            glasssuppliercountry.focus();
            return 0;
        }

        const fd = gs.FormData();
        fd.append("glasssuppliername", glasssuppliername.value);
        fd.append("glasssuppliercountry", glasssuppliercountry.value);
        return fd;

    }

    async function _savesuppliers() {
        const fd = _validate();
        if (fd === 0) {
            return;
        }
        $scope.suppliers = {
            ...$scope.suppliers,
            data: { ...$scope.suppliers.data },
            isloading: true,
        };
        const res = await gs.newsupplier(fd);
        if (res?.msg !== 1) {
            _msg(true, "n", res.data);
            $scope.suppliers = {
                ...$scope.suppliers,
                data: { ...$scope.suppliers.data },
                isloading: false,
            };
            $scope.$apply();
            return;
        }
        $scope.suppliers = {
            ...$scope.suppliers,
            data: {
                glasssupplierid: "0",
                glasssuppliername: "",
                glasssuppliercountry: "",
            },
            isloading: false,
        };
        _msg(true, "t", "Supplier Information Has Saved");
        $scope.get_supplier_list = res.data;
        $scope.$apply();
    }


    //glass Description
    const dia_glasstype = document.getElementById("dia_glasstype");
    const dia_glassdescription = document.getElementById("dia_glassdescription");
    dia_glasstype.style.display = "none";
    dia_glassdescription.style.display = "none";




    function _emptyglassdescription() {
        const _ = {
            mode: "N",
            isloading: false,
            title: "Save New Glass Description",
            btn: "Save",
            data: {
                glassdescriptoinsid: 0,
                gdesriptionsortfrm: "",
                glassdescriptoinstype: "",
                glassdescriptoinsspec: "",
            },
            glasstypes: [],
        }
        return _;
    }
    $scope.gdescription = _emptyglassdescription();
    gettypes()
    async function gettypes() {
        $scope.gdescription = {
            ...$scope.gdescription,
            data: { ...$scope.gdescription.data },
            glasstypes: [],
            isloading: true,
        }
        const res = await gb.glasstypes();
        if (res?.msg !== 1) {
            $scope.gdescription = {
                ...$scope.gdescription,
                data: { ...$scope.gdescription.data },
                glasstypes: [],
                isloading: false,
            }
            _msg(true, 'n', res.data);
            $scope.apply();
            return;
        }
        $scope.glasstypes =
            $scope.gdescription = {
                ...$scope.gdescription,
                data: { ...$scope.gdescription.data },
                glasstypes: res?.data ?? [],
                isloading: false,
            }
        $scope.$apply();
        return;
    }

    $scope.add_new_glassdescription_click = async () => {
        hideallautofill();
        dia_glassdescription.style.display = "flex";
        $scope.gdescription = _emptyglassdescription();
       // await gettypes();
    }
    $scope.addnewtype = () => {
        document.getElementById("glasstype_name").focus();
        dia_glasstype.style.display = "flex";
    }
    function _emptygtype() {
        const _ = {
            isloading: false,
            title: "Add New Glass Type",
            btn: "Save",
            data: {
                glasstype_name: "",
            },
        }
        return _;
    }
    $scope.gtype = _emptygtype();
    $scope.save_glasstype_submit = async () => {
        await SaveGlassType();
        return;
    }
    async function SaveGlassType() {
        if ($scope.gtype.isloading) {
            console.log("Another Process Is running in background");
            return;
        }

        const glasstype_name = document.getElementById("glasstype_name");
        if (glasstype_name.value.trim() === "") {
            _msg(true, "n", "Enter Glass Type");
            glasstype_name.focus();
            return;
        }
        $scope.gdescription = {
            ...$scope.gdescription,
            data: { ...$scope.gdescription.data },
            glasstypes: [],
            isloading: true,
        }
        $scope.gtype = {
            ...$scope.gtype,
            data: {
                ...$scope.gtype.data,
            },
            isloading: true,
        }
        const fd = gs.FormData();
        fd.append("glasstype_name", glasstype_name.value);
        const res = await gb.addglass(fd);
        if (res?.msg !== 1) {
            $scope.gtype = {
                ...$scope.gtype,
                data: {
                    ...$scope.gtype.data,
                },
                isloading: false,
            }
            $scope.gdescription = {
                ...$scope.gdescription,
                data: { ...$scope.gdescription.data },
                glasstypes: [],
                isloading: false,
            }
            _msg(true, "n", res.data);
            $scope.$apply();
        }
        $scope.gtype = {
            ...$scope.gtype,
            data: {
                glasstype_name: "",
            },
            isloading: false,
        };
        $scope.gdescription = {
            ...$scope.gdescription,
            data: { ...$scope.gdescription.data },
            glasstypes: res.data,
            isloading: false,
        }
        _msg(true, "t", "Saved");
        $scope.$apply();
        glasstype_name.focus();
        return;

    }

    $scope.save_glassdescription_submit = async () => {
        if ($scope.gdescription.mode === "N") {
            addnewglassdescription();
            return;
        }

    }

    function Validate() {
        const glassdescriptoinstype = document.getElementById("glassdescriptoinstype");
        const gdesriptionsortfrm = document.getElementById("gdesriptionsortfrm");
        const glassdescriptoinsspec = document.getElementById("glassdescriptoinsspec");
        if (glassdescriptoinstype.value.trim() === "") {
            _msg(true, "n", "Enter Glass Type");
            glassdescriptoinstype.focus();
            return 0;
        }

        if (gdesriptionsortfrm.value.trim() === "") {
            _msg(true, "n", "Enter Thickness");
            gdesriptionsortfrm.focus();
            return 0;
        }

        if (glassdescriptoinsspec.value.trim() === "") {
            _msg(true, "n", "Enter Glass Specification");
            glassdescriptoinsspec.focus();
            return 0;
        }
        const fd = gs.FormData();
        fd.append("glassdescriptoinstype", glassdescriptoinstype.value);
        fd.append("glassdescriptoinsspec", glassdescriptoinsspec.value);
        fd.append("gdesriptionsortfrm", gdesriptionsortfrm.value);
        return fd;
    }
    async function addnewglassdescription() {
        if ($scope.gdescription.isloading) {
            console.log("Already Process is Running");
            return;
        }
        const fd = Validate();
        if (fd === 0) {
            return;
        }
        $scope.gdescription = {
            ...$scope.gdescription,
            data: { ...$scope.gdescription.data },
            glasstypes: [...$scope.gdescription.glasstypes],
            isloading: true,
        }
        const res = await gs.savenewdescription(fd);

        if (res?.msg !== 1) {
            $scope.gdescription = {
                ...$scope.gdescription,
                data: { ...$scope.gdescription.data },
                glasstypes: [...$scope.gdescription.glasstypes],
                isloading: false,
            };
            _msg(true, "n", res.data);
            $scope.$apply();
            return;
        }
        $scope.gdescription = {
            ...$scope.gdescription,
            data: {
                glassdescriptoinsid: 0,
                gdesriptionsortfrm: "",
                glassdescriptoinstype: "",
                glassdescriptoinsspec: "",
            },
            glasstypes: [...$scope.gdescription.glasstypes],
            isloading: false,
        };
        _msg(true, "t", "Data Has Saved");
        $scope.get_glass_list = res.data;
        $scope.$apply();
        return;
    }
    //adding options end
    function _emptybudget() {
        const _ = {
            isloading: false,
            title: "Add New Glass Summary For Project",
            btn: "Save",
            mode: _mode,
            data: {
                gbudgetid: "",
                gbudgettype: "",
                gbudgetglasstype: "",
                gbudgetspc: "",
                gbudgtickness: "",
                gbudgetarea: "",
                gbudgetbprice: "",
                gbudgetbtotal: "",
                gbudgcustomval: "",
                gbudgettotal: "",
                pricediff: "",
                finalamount: "",
                pupdate: "",
                gbproject: "",
                gbprojectname: "",
                gbsupplier: "",
                sbsupplierlocation: "",
                estimationflag: "",
                procurementflag: "",
            }
        }
        return _;
    }
    $scope.budget = _emptybudget();

    $scope.calculation = () => {
        let _area = $scope.budget.data.gbudgetarea ?? 0;
        let _bprice = $scope.budget.data.gbudgetbprice ?? 0;
        let _totalprice = Math.round((+_area) * (+_bprice));

        let _aprice = $scope.budget.data.gbudgcustomval ?? 0;
        let _atotal = Math.round((+_area) * (+_aprice));

        let _dbprice = Math.round((+_bprice) - (+_aprice));
        let _daprice = Math.round((+_totalprice) - (+_atotal));

        $scope.budget = {
            ...$scope.budget,
            data: {
                ...$scope.budget.data,
                gbudgetbtotal: _totalprice,
                gbudgettotal: _atotal,
                pricediff: _dbprice,
                finalamount: _daprice
            }
        };
    }

    function budgetValidate() {
        const gbproject = document.getElementById("gbproject");
        const gbsupplier = document.getElementById("gbsupplier");
        const gbudgettype = document.getElementById("gbudgettype");
        const pupdate = document.getElementById("pupdate");
        const gbudgetspc = document.getElementById("gbudgetspc");
        const gbudgetglasstype = document.getElementById("gbudgetglasstype");
        const gbudgtickness = document.getElementById("gbudgtickness");
        const gbudgetarea = document.getElementById("gbudgetarea");
        const gbudgetbprice = document.getElementById("gbudgetbprice");
        const gbudgetbtotal = document.getElementById("gbudgetbtotal");

        if (gbproject.value.trim() === "") {
            _msg(true, 'n', "Enter Project");
            gbproject.focus();
            return 0;
        }

        if (gbsupplier.value.trim() === "") {
            _msg(true, 'n', "Enter Supplier");
            gbsupplier.focus();
            return 0;
        }

        if (gbudgettype.value.trim() === "") {
            _msg(true, 'n', "Enter Order Type");
            gbudgettype.focus();
            return 0;
        }

        if (pupdate.value.trim() === "") {
            _msg(true, 'n', "Enter Order Date");
            pupdate.focus();
            return 0;
        }

        if (gbudgetspc.value.trim() === "") {
            _msg(true, 'n', "Enter Glass Specification");
            gbudgetspc.focus();
            return 0;
        }


        if (gbudgetglasstype.value.trim() === "") {
            _msg(true, 'n', "Enter Glass Type");
            gbudgetglasstype.focus();
            return 0;
        }

        if (gbudgtickness.value.trim() === "") {
            _msg(true, 'n', "Enter Glass Tickness");
            gbudgtickness.focus();
            return 0;
        }

        if (gbudgetarea.value.trim() === "") {
            _msg(true, 'n', "Enter Area");
            gbudgetarea.focus();
            return 0;
        }


        const fd = gb.FormData();
        fd.append("gbproject", $scope.selected_project.project_no_e);
        fd.append("gbsupplier", gbsupplier.value);
        fd.append("gbudgettype", gbudgettype.value);
        fd.append("pupdate", pupdate.value);
        fd.append("gbudgetspc", gbudgetspc.value);
        fd.append("gbudgetglasstype", gbudgetglasstype.value);
        fd.append("gbudgtickness", gbudgtickness.value);
        fd.append("gbudgetarea", gbudgetarea.value);
        fd.append("gbudgetbprice", gbudgetbprice.value);
        fd.append("gbudgetbtotal", gbudgetbtotal.value)
        const pricediff = document.getElementById("pricediff");
        const finalamount = document.getElementById("finalamount");
        if ($scope.budget.mode === "PN" || $scope.budget.mode === "PE") {
            const gbudgcustomval = document.getElementById("gbudgcustomval");
            const gbudgettotal = document.getElementById("gbudgettotal");

            if (gbudgcustomval.value.trim() === "") {
                _msg(true, 'n', "Enter Supplier Price Per Sqm");
                gbudgcustomval.focus();
                return 0;
            }

            if (gbudgettotal.value.trim() === "") {
                _msg(true, 'n', "Enter Total Price");
                gbudgcustomval.focus();
                return 0;
            }



            fd.append("gbudgcustomval", gbudgcustomval.value);
            fd.append("gbudgettotal", gbudgettotal.value);

        }
        fd.append("pricediff", pricediff.value);
        fd.append("finalamount", finalamount.value);
        fd.append("gbprojectname", $scope.selected_project.project_name);
        fd.append("sbsupplierlocation", $scope.selected_supplier.glasssuppliercountry);
        return fd;
    }

    $scope.save_glassbudget_submit = async () => {
        if ($scope.budget.isloading) {
            console.log("Another Process Running...");
            return;
        }

        const _savemode = $scope.budget.mode;
        switch (_savemode) {
            case 'N':
                await _savebudget();
                return;
            case 'E':
                await _updatebudget()
                return;
            case 'PN':
                await _saveProcuement();
                return;
            case 'PE':
                await _updateProcuement();
                return;
            default:
                alert("Error On Saving Options")
                return;
        }
    }

    async function _savebudget() {
        const fd = budgetValidate();
        if (fd === 0) {
            return;
        }
        $scope.budget = {
            ...$scope.budget,
            data: { ...$scope.budget.data },
            isloading: true,
        }
        const res = await gb.savebudget(fd);
        if (res?.msg !== 1) {
            $scope.budget = {
                ...$scope.budget,
                data: { ...$scope.budget.data },
                isloading: false,
            }
            _msg(true, 'n', res.data);
            $scope.$apply();
            return;
        }

        $scope.budget = {
            ...$scope.budget,
            data: {
                ...$scope.budget.data,
                gbudgetglasstype: "",
                gbudgetspc: "",
                gbudgtickness: "",
                gbudgetarea: "",
                gbudgetbprice: "",
            },
            isloading: false,
        };
        _msg(true, 't', 'Data Has Saved');
        gridOptions.api.setRowData(res.data);
        $scope.$apply();
    }

    async function _updatebudget() {
        if ($scope.budget.data.estimationflag !== "P") {
            const fd = budgetValidate();
            if (fd === 0) {
                return;
            }
            fd.append("gbudgetid", $scope.budget.data.gbudgetid);
            fd.append("sbsupplierlocation", $scope.budget.data.sbsupplierlocation);
            
            const res = await gb.updatebudget(fd);
            if (res.msg !== 1) {
                _msg(true, 'n', res.data);
                $scope.$apply();
                return;
            }
            _msg(true, 't', 'Data Has Updated');
            gridOptions.api.setRowData(res.data);
            $scope.$apply();
        } else {
            _msg(true, 'n', "This Data Already Posted Due to The Reson We could not Update");
        }
    }

    async function _saveProcuement() {
        const fd = budgetValidate();
        if (fd === 0) {
            return;
        }
    }

    async function _updateProcuement() {
        if ($scope.budget.data.procurementflag !== "P") {
            const fd = budgetValidate();
            if (fd === 0) {
                return;
            }
        } else {
            _msg(true, 'n', "This Data Already Posted Due to The Reson We could not Update");
        }
    }

    const dia_projectselector = document.getElementById("dia_projectselector");
    dia_projectselector.style.display = 'none';

    $scope.show_project_list_selector = () => {
        project_auto_dia = "L"
        dia_projectselector.style.display = "flex";
        document.getElementById("select_auto_projects").style.display = "none";
    }

    $scope.show_project_select = () => {                
        const x = document.getElementById("current_select_project").getBoundingClientRect();
        document.getElementById("select_auto_projects").style.top = x.top + "px";
        document.getElementById("select_auto_projects").style.left = x.left + "px";
        document.getElementById("select_auto_projects").style.display = "block";                
        const search_listed_project = document.getElementsByName("search_listed_project")[1];
        search_listed_project.focus();
      
       
    }

    
    const gridDiv = document.querySelector('#myGrid');
    var filterParams = {
        comparator: function (filterLocalDateAtMidnight, cellValue) {
            var dateAsString = cellValue;
            var dateParts = dateAsString.split('-');
            var cellDate = new Date(
                Number(dateParts[0]),
                Number(dateParts[1]) - 1,
                Number(dateParts[2])
            );

            if (filterLocalDateAtMidnight.getTime() === cellDate.getTime()) {
                return 0;
            }

            if (cellDate < filterLocalDateAtMidnight) {
                return -1;
            }

            if (cellDate > filterLocalDateAtMidnight) {
                return 1;
            }
        },
    };

    const columnDefs = gb.columnsbudget($scope, $compile, $scope.access);
    const gridOptions = gs.gridoptions(columnDefs);
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

    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);

    $scope.select_project_submit = async () => {
        console.log($scope.select_project);
        const _project = $scope.selected_project.project_no_e;
        const fd = gb.FormData();
        fd.append("gbproject", _project);
        const res = await gb.loaddata(fd);
        if (res?.msg !== 1) {
            _msg(true, 'n', res.data);
            return;
        }

        gridOptions.api.setRowData(res?.data ?? []);
        document.getElementById("dia_projectselector").style.display = "none";
        $scope.$apply();
        return;

    }

    $scope.editbudgetinfo = (id) => {
        console.log(id);
        getselectedbugetinfo(id);
    }
    function _databind(data) {
        const _data = {
                gbudgetid :data.gbudgetid,
                gbudgettype :data.gbudgettype,
                gbudgetglasstype :data.gbudgetglasstype,
                gbudgetspc :data.gbudgetspc,
                gbudgtickness :data.gbudgtickness,
                gbudgetarea :data.gbudgetarea,
                gbudgetbprice :data.gbudgetbprice,
                gbudgetbtotal :data.gbudgetbtotal,
                gbudgcustomval :data.gbudgcustomval,
                gbudgettotal :data.gbudgettotal,
                pricediff :data.pricediff,
                finalamount :data.finalamount,
                pupdate: data.pupdate_n,
                gbproject :data.gbproject,
                gbprojectname :data.gbprojectname,
                gbsupplier :data.gbsupplier,
                sbsupplierlocation :data.sbsupplierlocation,
                estimationflag :data.estimationflag,
                procurementflag :data.procurementflag,
        }

        return _data;
    }
    async function getselectedbugetinfo(id) {
        if ($scope.budget.isloading) {
            console.log("Another Process Running...");
            return;
        }
        dia_glassbudget.style.display = "flex";

        const fd = gb.FormData();
        fd.append("gbudgetid", id);
        $scope.budget = {
            ...$scope.budget,
            data: {
              ...$scope.budget.data,
            },
            isloading: true,
        }
        const res = await gb.getbudgetinfo(fd);
        if (res?.msg !== 1) {
            _msg(true, 'n', res.data);
            $scope.budget = {
                ...$scope.budget,
                data: {
                  ...$scope.budget.data,
                },
                isloading: false,
            }
            $scope.$apply();
            return;
        }
        const data = res.data;
        $scope.budget = {
            ...$scope.budget,
            data: _databind(res.data),
            isloading: false,
            mode: 'E',
            btn : "Update"
        }
        $scope.$apply();

    }

    $scope.newgo = {
        isloading: false,
        title: "Add New Glass Order",
        mode: "N",
        btn: "Save",
        data: {
            gopid: "0",
            gopno: "",
            gopdate: "",
            gopproject: "",
            gopsalesrep: "",
            gopglassdesc: "",
            gopglasstype: "",
            gopglasstotalarea: "",
            gopglassqty: "",
            gopglasspricepersqm: "",
            gopglasstotalamount: "",
            gopbudgetid: "",
            goprojectenc :'',
        }
    }

    document.getElementById("dia_budget_glassorders").style.display = "none";

    $scope.addnewglassorder = async(id) => {
        console.log(id)
        if ($scope.newgo.isloading) {
            console.log("already Running....");
            return;
        }
        document.getElementById("dia_budget_glassorders").style.display = "flex";
        $scope.newgo = {
            ...$scope.newgo,
            data: { ...$scope.newgo.data },
            isloading: true,
        };
        const fd = gb.FormData();
        fd.append("gbudgetid", id);
        const res = await gb.getbudgetinfo(fd);
        if (res?.msg !== 1) {
            _msg(true, 'n', res.data);
            $scope.newgo = {
                ...$scope.newgo,
                data: { ...$scope.newgo.data },
                isloading: false,
            };
            $scope.$apply();
            return;
        }
        $scope.newgo = {
            ...$scope.newgo,
            data: {
                gopid: "0",
                gopno: "",
                gopdate: "",
                gopproject: res.data.project_id,
                gopsalesrep: res.data.Sales_Representative,
                gopglassdesc: "",
                gopglasstype: "",
                gopglasstotalarea: "",
                gopglassqty: "",
                gopglasspricepersqm: "",
                gopglasstotalamount: "",
                gopbudgetid: res.data.gbudgetid,
                goprojectenc : res.data.project_no_e
            },
            isloading: false,
            mode: "N"
        };
        console.log($scope.newgo);
        $scope.$apply(); 
        console.log(res.data);
        return;
    }

    $scope.save_glassbudgetglassorders_submit = async () => {
        if ($scope.newgo.isloading) {
            console.log("Already process is running...");
            return;
        }

        if ($scope.newgo.mode === "N") {
            await SaveBudgetgo();
            return;
        }

        await updatebudget()
    }
    function validate() {
        const fd = gb.FormData();
        fd.append('gopno', $scope.newgo.data.gopno);
        fd.append('gopdate', $scope.newgo.data.gopdate);
        fd.append('gopproject', $scope.newgo.data.gopproject);
        fd.append('gopsalesrep', $scope.newgo.data.gopsalesrep);
        fd.append('gopglassdesc', $scope.newgo.data.gopglassdesc);
        fd.append('gopglasstype', $scope.newgo.data.gopglasstype);
        fd.append('gopglasstotalarea', $scope.newgo.data.gopglasstotalarea);
        fd.append('gopglassqty', $scope.newgo.data.gopglassqty);
        fd.append('gopglasspricepersqm', $scope.newgo.data.gopglasspricepersqm);
        fd.append('gopglasstotalamount', $scope.newgo.data.gopglasstotalamount);
        fd.append('gopbudgetid', $scope.newgo.data.gopbudgetid);
        fd.append('projectno', $scope.newgo.data.goprojectenc);

        return fd;

    }
    async function SaveBudgetgo() {
        const fd = validate();
        if (fd === 0) {
            return;
        }
        $scope.newgo = {
            ...$scope.newgo,
            data: { ...$scope.newgo.data },
            isloading: true,
        };
        const res = await gb.savebudgetgo(fd);
        if (res.msg !== 1) {
            $scope.newgo = {
                ...$scope.newgo,
                data: { ...$scope.newgo.data },
                isloading: false,
            };
            _msg(true, 'n', res.data);
            $scope.$apply();
            return;
        }
        $scope.newgo = {
            ...$scope.newgo,
            data: {
                ...$scope.newgo.data,
                gopid: "0",
                gopno: "",
                gopdate: "",
                gopglassdesc: "",
                gopglasstype: "",
                gopglasstotalarea: "",
                gopglassqty: "",
                gopglasspricepersqm: "",
                gopglasstotalamount: "",
                
            },
            isloading: false,
        };
        $scope.$apply();
        gridOptions.api.setRowData(res.data ?? []);
        return;
    }
    async function UpdateBudgetgo() {
        return;
    }
    $scope.glassorderhistroy = {
        isloading: true,
        data : []
    }
    document.getElementById("dia_load_budgetglassorder").style.display = 'none';
    $scope.gethistoryglassorder = async (id) => {
        $scope.glassorderhistroy = {
            isloading: true,
            data : []
        }
        const fd = gb.FormData();
        fd.append('gobudgetid', id);
        const res = await gb.bugetglassorderhistory(fd);
        if (res?.msg !== 1) {
            alert(res.data); return;
        }
        $scope.glassorderhistroy = {
            isloading: true,
            data: res.data
        };
        $scope.$apply();
        document.getElementById("dia_load_budgetglassorder").style.display = 'flex';
        return;
    }


}