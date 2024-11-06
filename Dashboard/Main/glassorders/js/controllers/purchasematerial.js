import GlassSupplierServices from './../services/suppliers.js';
import BMO from './../services/purchasematerial.js';
export default function purchasematerial($scope, $http, $compile, $rootScope, $filter) {
    const gp = new GlassSupplierServices();
    const bmo = new BMO();
    const dia_suppliers = document.getElementById("dia_suppliers");
    dia_suppliers.style.display = "none";
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
                console.log($scope.viewproject);
                $scope.newproject = res.data.data;

            } else {
                alert(res.data.data);
            }
        });
    }

    $scope.supplierlist = []
    loadAllSuppliers();
    async function loadAllSuppliers() {
        const res = await gp.getAllGlassSuppliers();
        console.log(res);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }

        $scope.supplierlist = res.data ?? [];
        $scope.$apply();
    }


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

    $scope.addnewsupplier = () => {
        $scope.suppliers = {};
        $scope.suppliers = _emptysuppliers();
        dia_suppliers.style.display = "flex";
        document.getElementById("glasssuppliername").focus();
    }
    $scope.save_suppliers_submit = async () => {
        if ($scope.suppliers.isloading) {
            console.log("Already Another Process Is Running...");
            return;
        }

        if ($scope.suppliers.mode === "N") {
            await _savesuppliers();
            return;
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

        const fd = gp.FormData();
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
        const res = await gp.newsupplier(fd);
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
        $scope.supplierlist = res?.data ?? [];
        $scope.$apply();
        return;
    }
    //grid option
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
    const columnDefs = bmo.cols($scope, $compile, $scope.access);
    const gridOptions = bmo.gridoptions(columnDefs);
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
    $scope.isrptloading = false;
    gridOptions.api.setRowData([]);
    loadprojectpurchase();
    async function loadprojectpurchase() {
        $scope.isrptloading = true;
        const fd = bmo.FormData();
        fd.append('bmoproject', sessionStorage.getItem('nafco_project_current_sno'));
        const res = await bmo.bmos(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isrptloading = false;
            $scope.$apply();
            return;
        }
        $scope.isrptloading = false;
        sumoffcalc(res.data);
        gridOptions.api.setRowData(res.data ?? []);
        $scope.$apply();
        return;
    }
    //get autocompleate
    $scope.sum = {
        cost: 0
    }
    function sumoffcalc(d) {
        let _cost = 0;
        d.map(i => {
            console.log(i.bmoval);
            _cost += (+i.bmoval);
        })
        $scope.sum = {
            cost : _cost
        }
    }
    $scope.itemlist = [];
    allautocompleate();
    async function allautocompleate() {
        $scope.itemlist = [];
        const res = await bmo.autoitems();
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        $scope.itemlist = res.data ?? [];
        $scope.$apply();
    }

    document.getElementById("dia_material_orders").style.display = "none";
    $scope.addnewmaterialorder = () => {
        document.getElementById("dia_material_orders").style.display = "flex";
        $scope.newmaterial = {
            isloading: false,
            mode: "N",
            title: 'Approvals For New Material Order',
            btn: "Save",
            data: {
                bmospplier: '',
                bmotype: '',
                bmomtype: '',
                bmoqty: '',
                bmounit: '',
                bmoppunit: '',
                bmoval: '',
                bmopqty: '',
                bmopval: $scope.sum.cost,
                bmorefno: '',
                bmoproject: sessionStorage.getItem('nafco_project_current_sno'),
                bmoorefno: '',
                bmodate: '',

            }
        };
    }
    $scope.newmaterial = {
        isloading: false,
        mode: "N",
        title: 'Approvals For New Material Order',
        btn: "Save",
        data: {
            bmospplier: '',
            bmotype: '',
            bmomtype: '',
            bmoqty: '',
            bmounit: '',
            bmoppunit: '',
            bmoval: '',
            bmopqty: '',
            bmopval: $scope.sum.cost,
            bmorefno: '',
            bmoproject: sessionStorage.getItem('nafco_project_current_sno'),
            bmoorefno: '',
            bmodate: '',

        }
    };
    $scope.save_material_order_submit = async () => {
        if ($scope.newmaterial.isloading) {
            console.log("Process Is Running");
            return;
        }

        if ($scope.newmaterial.mode === "N") {
            await _savebmo();
            return;
        }
        // await 
    }
    async function _savebmo() {
        const fd = bmo.FormData();
        fd.append('bmospplier', $scope.newmaterial.data.bmospplier);
        fd.append('bmotype', $scope.newmaterial.data.bmotype);
        fd.append('bmomtype', $scope.newmaterial.data.bmomtype);
        fd.append('bmoqty', $scope.newmaterial.data.bmoqty);
        fd.append('bmounit', $scope.newmaterial.data.bmounit);
        fd.append('bmoppunit', $scope.newmaterial.data.bmoppunit);
        fd.append('bmoval', $scope.newmaterial.data.bmoval);
        fd.append('bmopqty', $scope.newmaterial.data.bmopqty);
        fd.append('bmopval', $scope.sum.cost);
        fd.append('bmorefno', $scope.newmaterial.data.bmorefno);
        fd.append('bmoproject', $scope.newmaterial.data.bmoproject);
        fd.append('bmoorefno', $scope.newmaterial.data.bmoorefno);
        $scope.newmaterial = {
            ...$scope.newmaterial,
            data: {
                ...$scope.newmaterial.data
            },
            isloading: true
        };
        const res = await bmo.savebmo(fd);
        if (res?.msg !== 1) {
            $scope.newmaterial = {
                ...$scope.newmaterial,
                data: {
                    ...$scope.newmaterial.data
                },
                isloading: false
            };
            _msg(true, "n", res.data);
            $scope.$apply();
            return;
        }
        $scope.newmaterial = {
            ...$scope.newmaterial,
            data: {
                ...$scope.newmaterial.data,
                bmospplier: '',
                bmotype: '',
                bmomtype: '',
                bmoqty: '',
                bmounit: '',
                bmoppunit: '',
                bmoval: '',
                bmopqty: '',
                bmorefno: '',
                bmopval: $scope.sum.cost,
                bmoorefno: '',
            },
            isloading: false
        };
        _msg(true, "t", "Data Has Saved");
        sumoffcalc(res.data);
        gridOptions.api.setRowData(res.data ?? [])
        $scope.$apply();
        return;
    }
    $scope.calcarea = () => {
        let bmoqty = document.getElementById("bmoqty").value.trim() === "" ? 0 : document.getElementById("bmoqty").value.trim();
        let bmoppunit = document.getElementById("bmoppunit").value.trim() === "" ? 0 : document.getElementById("bmoppunit").value.trim();
        let bmoval = (+bmoqty) * (+bmoppunit);
        $scope.newmaterial = {
            ...$scope.newmaterial,
            data: {
                ...$scope.newmaterial.data,
                bmoval : Math.round(bmoval)
            }
        }
    }

    $scope.print_data = async (id) => {
        const fd = bmo.FormData();
        fd.append('bmoid', id);
        const res = await bmo.bmoprint(fd);
        console.log(res);
        if(res?.msg !== 1)
        {
            alert(res.data);
            return;
        }

        localStorage.removeItem("pms_print_purcashe_material_order");
        localStorage.setItem("pms_print_purcashe_material_order", JSON.stringify(res.data));
        window.open(`${print_location}fprint/#!/mprint`, "_blank", "height:500px,width:1200px");
    }



}