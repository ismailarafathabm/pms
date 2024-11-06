import POService from './../services/po.js';
export default function pob($scope, $http, $compile, $rootScope, $filter) {
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

    $scope.isrptloading = false;

    const po = new POService();

    
    $scope.addnewgobudget = () => {
        location.href = `${print_location}/Dashboard/Main/index.php#!/pobudget`;
    }

     //gird options
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
    const columnDefs = po.pobcols($scope, $compile, $scope.access);
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
    $scope.excelexport = () => {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();
            var mname = `PROJECT LIST AS ON DATE ${day}-${month}-${year}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }

    $scope.pos = [];
    $scope.sum = {
        area: 0,
        cost: 0
    };
    function sumofcal(data) {
        let _area = 0;
        let _cost = 0;
        data.map(i => {
            _area += (+i.poarea);
            
            _cost += (+i.povalue);
        })
        
        $scope.sum = {
            area:_area,
            cost: _cost
        };
    }
    loadpos();
    async function loadpos() {
        const fd = po.FormData();
        fd.append("poproject", sessionStorage.getItem("nafco_project_current_sno"));
        const res = await po.pobs(fd);
        console.log(res);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }

        $scope.pos = res.data;
        gridOptions.api.setRowData(res.data ?? []);
        sumofcal(res.data);
        $scope.$apply();

    }

    $scope.print_data = (p,r,pr) => {        
        printactions(p,r,pr)
    }

    async function printactions(p, r, pr) {
        const fd = po.FormData();
        
        fd.append('pobproject', p)
        fd.append('pobporefno',r)
        fd.append('pobprefno',pr)
        const res = await po.pobprintinfo(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        localStorage.removeItem("pms_print_purchaes_pob");
        localStorage.setItem("pms_print_purchaes_pob", JSON.stringify(res.data));
        window.open(`${print_location}fprint/#!/pobprint`, "_blank", "height:500px,width:1200px");
    }
}