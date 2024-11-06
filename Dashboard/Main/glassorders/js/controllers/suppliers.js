import GlassSupplierServices from './../services/suppliers.js'
export default function goglasssuppliers($scope, $compile, $rootScope, $filter) {
    $scope.access = {
        addnew: false,
        edit: false,
        print: false,
        priceview: false,
    };

    //grand premissions
    let username = userinfo.user_name;
    const _access_button_new = ['demo', 'sam'];
    if (_access_button_new.includes(username)) {
        $scope.access = {
            ...$scope.access,
            addnew: true,
        };
    }
    const _access_button_edit = ['demo', 'sam'];
    if (_access_button_edit.includes(username)) {
        $scope.access = {
            ...$scope.access,
            edit: true,
        };
    }

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

    const gs = new GlassSupplierServices();
    document.getElementById("glassorderss").classList.add('menuactive');

    const dia_suppliers = document.getElementById("dia_suppliers");
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
                suppliercontact: "",
                supplieraddress: "",
                supplieremail: "",
                supplierphone: "",
                supplierfax : ""
            }
        };

        return _;
    }
    $scope.suppliers = _emptysuppliers();
    $scope.add_new_supplier = () => {
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
        fd.append("suppliercontact", $scope.suppliers.data.suppliercontact ?? "-");
        fd.append("supplieraddress", $scope.suppliers.data.supplieraddress ?? "-");
        fd.append("supplieremail", $scope.suppliers.data.supplieremail ?? "-");
        fd.append("supplierphone", $scope.suppliers.data.supplierphone ?? "-");
        fd.append("supplierfax", $scope.suppliers.data.supplierfax ?? "-");
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
                suppliercontact: "",
                supplieraddress: "",
                supplieremail: "",
                supplierphone: "",
                supplierfax : ""
            },
            isloading: false,
        };
        _msg(true, "t", "Supplier Information Has Saved");
        gridOptions.api.setRowData(res?.data ?? []);
        $scope.$apply();
    }
    $scope.editsupplierinfo = async (id) => {
        if ($scope.suppliers.isloading) {
            console.log("Another Process is Running...");
            return;
        }
        dia_suppliers.style.display = "flex";
        $scope.suppliers = {
            ...$scope.suppliers,
            title: "Edit Supplier Informations",
            btn: "Update",
            mode: "E",
            data: {
                glasssupplierid: "0",
                glasssuppliername: "",
                glasssuppliercountry: "",
                suppliercontact: "",
                supplieraddress: "",
                supplieremail: "",
                supplierphone: "",
                supplierfax : ""
            },
            isloading: true,
        };
        const fd = gs.FormData();
        fd.append("glasssupplierid", id);
        const res = await gs.infosupplier(fd);
        if (res?.msg !== 1) {
            _msg(true, 'n', res.data);
            $scope.suppliers = {
                ...$scope.suppliers,
                data: { ...$scope.suppliers.data },
                isloading: false,
            }
            $scope.$apply();
            return;
        }
        $scope.suppliers = {
            ...$scope.suppliers,
            title: `Edit '${res.data.glasssuppliername}' Informations`,
            btn: "Update",
            mode: "E",
            data: {
                glasssupplierid: res.data.glasssupplierid ?? "0",
                glasssuppliername: res.data.glasssuppliername ?? "",
                glasssuppliercountry: res.data.glasssuppliercountry ?? "",
                suppliercontact:  res.data.suppliercontact ?? "",
                supplieraddress:  res.data.supplieraddress ?? "",
                supplieremail:  res.data.supplieremail ?? "",
                supplierphone:  res.data.supplierphone ?? "",
                supplierfax :  res.data.supplierfax ?? "",
            },
            isloading: false,
        };
        $scope.$apply();
        return;

    }
    async function _updatesupplier() {
        const fd = _validate();
        if (fd === 0) {
            return;
        }

        fd.append("glasssupplierid", $scope.suppliers.data.glasssupplierid);
        $scope.suppliers = {
            ...$scope.suppliers,
            data: { ...$scope.suppliers.data },
            isloading: true
        };

        const res = await gs.updatesupplier(fd);
        if (res?.msg !== 1) {
            _msg(true, "n", res.data);
            $scope.suppliers = {
                ...$scope.suppliers,
                data: { ...$scope.suppliers.data },
                isloading: false
            };
            $scope.$apply();
            return;
        }
        $scope.suppliers = _emptysuppliers();
        _msg(true, "t", "Supplier Information Has Updated");
        gridOptions.api.setRowData(res?.data ?? []);
        $scope.$apply();

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

    const columnDefs = gs.suppliercols($scope, $compile, $scope.access);
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

    getAllSuppliers();
    async function getAllSuppliers() {
        const res = await gs.getAllGlassSuppliers();
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        console.log(res.data);
        gridOptions.api.setRowData(res?.data ?? []);
        $scope.$apply();
        return
    }

}