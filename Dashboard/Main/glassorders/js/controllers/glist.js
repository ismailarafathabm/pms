import GoServices from './../services/index.js';
export default function goglassdescription($scope, $rootScope, $compile, $filter) {
    document.getElementById("glassorderss").classList.add('menuactive');
    $scope.access = true;
    //error msg
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
    // error message


    const gs = new GoServices();
    $scope.glasstypes = [];

    $scope.gdescription = {
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

    $scope.gtype = {
        isloading: false,
        title: "Add New Glass Type",
        btn: "Save",
        data: {
            glasstype_name: "",
        },
    }
    const dia_glasstype = document.getElementById("dia_glasstype");
    dia_glasstype.style.display = "none";
    $scope.addnewtype = () => {
        document.getElementById("glasstype_name").focus();
        dia_glasstype.style.display = "flex";
    }
    gettypes() 
    async function gettypes() {
        $scope.gdescription = {
            ...$scope.gdescription,
            data: { ...$scope.gdescription.data },
            glasstypes: [],
            isloading: true,
        }
        const res = await gs.glasstypes();
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
    $scope.isrptloading = false;

    //grid
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



    if ($scope.access) {
        const dia_glassdescription = document.getElementById("dia_glassdescription");
        dia_glassdescription.style.display = "none";
        $scope.addnewunit_click = () => {            
            dia_glassdescription.style.display = "flex";
        }

    }
    const columnDefs = gs.descriptioncols($scope, $compile, $scope.access)
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
    getlist();
    async function getlist() {
        if ($scope.isrptloading) {
            console.log("Alread Process is running..");
            return;
        }
        $scope.isrptloading = true;
        const res = await gs.allglassdescriptoins();
        console.log(res);
        if (res?.msg !== 1) {
            $scope.isrptloading = false;
            alert(res.data);
            $scope.$apply();
            return;
        }
        $scope.isrptloading = false;
        gridOptions.api.setRowData(res?.data ?? []);
        $scope.$apply();
        return;

    }

    $scope.save_glasstype_submit = async () => {
        await SaveGlassType();
        return;
    }

    $scope.save_glasstype_keyup = async ($event) => {
        if ($event.which === 13) {
            await SaveGlassType();
        }
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
        const res = await gs.addglass(fd);
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
        updateglassdescriptions();
        return;

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
        $scope.isrptloading = true;
        gridOptions.api.setRowData(res?.data ?? []);
        $scope.isrptloading = false;
        $scope.$apply();
        return;
    }
    async function updateglassdescriptions() {
        if ($scope.gdescription.isloading) {
            console.log("Already Process is Running");
            return;
        }
        const fd = Validate();
        if (fd === 0) {
            return;
        }
        fd.append("glassdescriptoinsid", $scope.gdescription.data.glassdescriptoinsid);
        $scope.gdescription = {
            ...$scope.gdescription,
            data: { ...$scope.gdescription.data },
            glasstypes: [...$scope.gdescription.glasstypes],
            isloading: true,
        }
        const res = await gs.updateglassdescription(fd);
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
            title: "Save New Glass Description",
            btn : "Save",
            mode : "N",
        };
        _msg(true, "t", "Data Has Saved");
        $scope.isrptloading = true;
        gridOptions.api.setRowData(res?.data ?? []);
        $scope.isrptloading = false;
        $scope.$apply();
    }
    gettypes();
    $scope.getinfo = async (id) => {
        dia_glassdescription.style.display = "flex";
       
        await getInfo(id);
        return;
    }

    async function getInfo(id) {
        if ($scope.gdescription.isloading) {
            console.log("Progress Is Running...");
            return;
        }

        $scope.gdescription = {
            ...$scope.gdescription,
            data: { ...$scope.gdescription.data },
            glasstypes: [...$scope.gdescription.glasstypes],
            isloading: true,
        }

        const fd = gs.FormData();
        fd.append("glassdescriptoinsid", id);
        const res = await gs.getglassdescriptioninfo(fd);
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
            glasstypes: [...$scope.gdescription.glasstypes],
            isloading: false,
            title: "Edit Glass Description",
            mode: "E",
            btn: "Update",
            data: {
                glassdescriptoinsid: res.data.glassdescriptoinsid,
                gdesriptionsortfrm: res.data.gdesriptionsortfrm,
                glassdescriptoinstype: res.data.glassdescriptoinstype,
                glassdescriptoinsspec: res.data.glassdescriptoinsspec,
            },
        };
        $scope.$apply();
    }
}