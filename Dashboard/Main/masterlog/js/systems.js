import _ from './controllers/systems.js';

export default function masterlogsystems($scope, $compile) {
    const _msg = (d,t,msg = "") => {
        let icon = t === "n" ? "fa fa-exclamation-circle" : "fa fa-info-circle";
        let theme = t === "n" ? "ism-dialog-input-error" : "ism-dialog-input-success";

        $scope.res = {
            display: d,
            theme: theme,
            icon: icon,
            msg : msg
        }
        setTimeout(_msgoff, 2000);
    }
    let systemid = "";
    const sc = new _();
    $scope.gridData = [];
    getAllSystems();

    //initialize variables
    const dia_new_system = document.getElementById("dia_new_system");
    $scope.newsystem = {
        isloading: false,
        title: "NEW SYSTEM",
        mode: "N",
        btntitle : "Save",
        data: {
            systemid: "",
            systemname: "",
            systemprocurement: "",
            systemesimation: "",
        }

    };

    //initial load 
    dia_new_system.style.display = "none";

    $scope.addnewunit_click = () => {
        $scope.newsystem = {
            isloading: false,
            title: "NEW SYSTEM",
            mode: "N",
            btntitle : "Save",
            data: {
                systemid: "",
                systemname: "",
                systemprocurement: "",
                systemesimation: "",
            }

        };
        dia_new_system.style.display = "flex";
    }

    $scope.editSystem = async (system_name) => {
       
        if ($scope.newsystem.isloading) {
            console.log("Another Process Is Running");
            return;
        }
        dia_new_system.style.display = "flex";
        
        $scope.newsystem = {
            ...$scope.newsystem,
            title : "",
            isloading: true,   
            data: { ...$scope.newsystem.data }
        };
        console.log($scope.newsystem);
        
        const fd = sc.FormData();
        fd.append("systemname", system_name);
        const res = await sc.systemgetinfo(fd);

        systemid = res?.systemid ?? 0;
        
        if (systemid === 0) {           
            dia_new_system.style.display = "none";
            $scope.newsystem = {
                ...$scope.newsystem,
                isloading: false,                
                data: { ...$scope.newsystem.data }
            };
            $scope.$apply();
            return;
        }
       
        

        $scope.newsystem = {
            isloading: false,
            title: `Edit '${res.systemnamedisplay}' Infroamtions`,
            mode: "E",
            btntitle : "Update",
            data: {
                systemid: systemid,
                systemname: res.systemname,
                systemprocurement: res.systemprocurement,
                systemesimation: res.systemesimation,
            }
        };
        //console.log($scope.newsystem);
        $scope.$apply();
       
    }

    $scope.save_system_submit = async () => {
        if ($scope.newsystem.isloading) { console.log("Other Process is Running"); return; }
        if ($scope.newsystem.mode === "N") {
            await _SaveNewSystem();
            return;
        } else {
            await _UpdateSystemInfo();
            return;
        }
    }

    async function _SaveNewSystem() {
        const formvalidate = sc.formvalidate();
        if (!formvalidate) { return; }
        const systemname = document.getElementById("systemname");
        const systemprocurement = document.getElementById("systemprocurement");
        const systemesimation = document.getElementById("systemesimation");
        const fd = sc.FormData();
        fd.append("systemname", systemname.value);
        fd.append("systemprocurement", systemprocurement.value);
        fd.append("systemesimation", systemesimation.value);
        await sc.Fmsave(fd, $scope,gridOptions,_msg);
        return;
    }

    async function _UpdateSystemInfo() {
        if (systemid.trim() === "" || systemid === 0 || systemid === "0") {
            alert("System Id Is Missing");
            return;
        }
        const formvalidate = sc.formvalidate();
        if (!formvalidate) { return; }
        const fd = sc.FormData();
        fd.append("systemname", systemname.value);
        fd.append("systemprocurement", systemprocurement.value);
        fd.append("systemesimation", systemesimation.value);
        fd.append("systemid", systemid);
        await sc.FmUpdate(fd, $scope,gridOptions,_msg);
        return;
    }

    //grid actions
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
    var columnDefs = [];
    columnDefs.push(
        {
            headerName: "",
            cellRenderer: (p) => $compile(
                `<button type="button" class="ism-new-page-header-button normalbtn"  ng-click="editSystem('${p.data.systemname}')" style="padding:">
                    <i class="fa fa-pencil"></i>
                    Edit
                </button>
            `)($scope)[0],
            sort: false,
            filter : false,            
            width:85
        }
    )
    columnDefs.push(
        {
            headerName: "System",
            field: 'systemnamedisplay',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width:200
        }
    )
    var subcols = [];
    subcols.push(
        {
            headerName: "Procurement",
            field: 'systemprocurement',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width:130
        }
    )
    subcols.push(
        {
            headerName: "Estimation",
            field: 'systemesimation',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width:130
        }
    )
    subcols.push(
        {
            headerName: "Total",
            field: 'totaldays',
            sortingOrder: ['asc', 'desc'],
            filter: 'agMultiColumnFilter',
            width:80
        }
    )
    columnDefs.push({
        headerName: "Durations",
        children: subcols,
        headerClass : "gridheadercells"
    })
    const gridOptions = sc.gridoptions(columnDefs);
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
    
    async function getAllSystems() {
        const fd = sc.FormData();
        const datas =  await sc.getData(fd);
        gridOptions.api.setRowData(datas);
        // $scope.apply();
    }

    $scope.clearFilters = function () {
        gridOptions.columnApi.applyColumnState({
            defaultState: {
                sort: null,
            },
        });
        gridOptions.api.setFilterModel(null);
    }

    $scope.exportExcel = function () {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {

            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();
            var mname = `System List`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: mname,
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }

    const gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    getAllSystems();

    $scope.res = {
        display: "",
        theme: "",
        icon : "",
    }
    _msg(false,"n")
    function _msgoff() {        
        $scope.res.display = false;
        $scope.$apply();
    }

   
}