import POService from './../services/po.js';
export default function rpt_po($scope, $compile) {
    const po = new POService();
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
    $scope.access = {};
    const columnDefs = po.colsporpt($scope, $compile, $scope.access);
    // const columnDefs = [];
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

    $scope.isrptloading = false;
    $scope.excelexport = () => {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();
            var mname = `BUDGET SUMMARY FOR ALL PROJECTS ${day}-${month}-${year}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }

    new agGrid.Grid(gridDiv, gridOptions);

    async function loadRpt() {
        const res = await po.porpt();
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        gridOptions.api.setRowData(res.data ?? []);
        $scope.$apply();
        return;

    }
    loadRpt();

    $scope.gotoprojectpo = (pjno, pjid) => {
        sessionStorage.clear('nafco_project_current');
        sessionStorage.clear('nafco_project_current_sno');
        sessionStorage.setItem('nafco_project_current', pjno);
        sessionStorage.setItem('nafco_project_current_sno', pjid);
        location.href = `${print_location}/Dashboard/Main/index.php#!/ponv`;
    }

    document.getElementById("mainbutton").addEventListener("click", () => {
        document.getElementById("menuprintbutton").style.display = "flex";
    })

    window.onclick = (e) => {
        if (!e.target.matches(".menubtn") && !e.target.matches(".button-menu")) {
            const menuprintbutton = document.getElementById("menuprintbutton");
            console.log(menuprintbutton);
            if (menuprintbutton === undefined) {

            } else {
                document.getElementById("menuprintbutton").style.display = "none";
            }

        }
    }

    $scope.printaction = (_mode) => {
        document.getElementById("menuprintbutton").style.display = "none";
        printrpt(_mode);
    }
    function _printall(_data) {
        localStorage.removeItem("pms_print_po_rpt");
        localStorage.setItem("pms_print_po_rpt", JSON.stringify(_data));
        window.open('http://172.0.100.17:8082/PMS/fprint/#!/project_po_rpt', "_blank", "width:1200px;height:500px");
    }
    function _printgroup(_data, groupby, title) {

        let _groupitem = [];
        _data.map(i => {
            let _ok = _groupitem.includes(i[groupby].toLowerCase());
            if (!_ok) {
                _groupitem.push(i[groupby].toLowerCase());
            }
        });

        const fdata = _groupitem.map(i => _data.filter(x => i === x[groupby].toLowerCase()));
        console.log(_groupitem, fdata);
        localStorage.removeItem("pms_print_po_rptg");
        localStorage.removeItem("pms_print_po_rptg_title");
        localStorage.setItem("pms_print_po_rptg",JSON.stringify(fdata));
        localStorage.setItem("pms_print_po_rptg_title", title);
        window.open(`${print_location}/fprint/#!/project_po_rptg`, "_blank", "width:1200px;height:500px");
    }
    function printrpt(_mode) {
        let prdata = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(i => prdata.push(i.data));
        switch (_mode) {
            default:
            case 'a':
                _printall(prdata);
                break;
            case 'p':
                _printgroup(prdata, 'project_name', "Project");
                break;
            case 's':
                _printgroup(prdata, 'glasssuppliername', "Supplier");
                break;
            case 'r':
                _printgroup(prdata, 'projectRegion', "Region");
                break;
            case 'l':
                _printgroup(prdata, 'project_location', "Location");
                break;
            case 'l':
                _printgroup(prdata, 'ponewtype', "Material Type");
                break;
        }
    }
}