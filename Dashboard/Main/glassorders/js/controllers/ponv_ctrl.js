import POService from './../services/po.js';
export default function ponv_ctrl($scope, $http, $rootScope, $compile, $filter) {
    const po = new POService();
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
                localStorage.removeItem("currentproject");
                localStorage.setItem("pms_currentproject", JSON.stringify($scope.viewproject));

                console.log($scope.viewproject);
                $scope.newproject = res.data.data;

            } else {
                alert(res.data.data);
            }
        });
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
    const columnDefs = po.ponewcols($scope, $compile, $scope.access);
    const gridOptions = po.gridoptions(columnDefs);
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

    $scope.exportExcel = function () {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {

            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();
            var mname = `PO REPORT`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: mname,
            };
            gridOptions.api.exportDataAsExcel(param);
        }
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
    $scope.isrptloading = false;
    getData();
    async function getData(){
        const fd = po.FormData();
        fd.append('ponewproject', sessionStorage.getItem("nafco_project_current_sno"));

        const res = await po.ponview(fd);
        if (res?.msg !== 1) {
            //alert(res.data);
            return;
        }
        gridOptions.api.setRowData(res.data);
        $scope.$apply();        
        return;
    }
    $scope.printpo = async (id) => {
        const fd = po.FormData();
        fd.append('ponewid', id);
        const res = await po.ponewinfo(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }

        localStorage.removeItem("pms_ponew_print");
        localStorage.setItem("pms_ponew_print", JSON.stringify(res.data));
        window.open(`${print_location}fprint/#!/ponew`, "_blank", "height:500px,width:1200px");
        return;
    }

    $scope.mkfin = async (id) => {
        const fd = po.FormData();
        fd.append('ponewid', id);
        const res = await po.ponewinfo(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }

        localStorage.removeItem("pms_ponew_print");
        localStorage.setItem("pms_ponew_print", JSON.stringify(res.data));
        window.open(`${print_location}fprint/#!/poadvice`, "_blank", "height:500px,width:1200px");
        return;
    }
}