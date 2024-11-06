import _ from './../services/po.js';
export default function poadvicelist($scope, $http, $compile) {
    const po = new _();
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
    const columnDefs = po.advicecols($scope, $compile, $scope.access);
    const gridOptions = po.gridoptions(columnDefs);
    new agGrid.Grid(gridDiv, gridOptions);
    getAll();
  
    $scope.excelexport = () => {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();
            var mname = `PURCAHSE ADVICE LIST ${day}-${month}-${year}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }
    gridOptions.api.setRowData();
    async function getAll() {
        const fd = po.FormData();
        fd.append("padviceproject", sessionStorage.getItem('nafco_project_current_sno'));
        const res = await po.padvice(fd);
        if (res?.msg !== 1) {
            alert(res.data);            
            return;
        }
        gridOptions.api.setRowData(res.data ?? []);
        $scope.$apply();
    }

    $scope.printadivcef = async (id,poid) => {
        localStorage.removeItem('pms_print_paymentadvice');
        localStorage.removeItem('pms_print_po_info');
        const po = await getpoinfo(poid);
        const advice = await getadvice(id);
        $scope.$apply();
        localStorage.setItem("pms_print_paymentadvice", JSON.stringify(advice));
        localStorage.setItem("pms_print_po_info", JSON.stringify(po));
        window.open(`${print_location}fprint/#!/poadvice`, "_blank", "height:500px,width:1200px");
        return;
    }

    async function getadvice(id) {        
        const fd = await po.FormData();
        fd.append('padvanceid', id);
        const res = await po.getadvice(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return 0;
        }
        return res.data;
    }
    async function getpoinfo(id) {
        const fd = po.FormData();
        fd.append("ponewid",id)
        const res = await po.ponewinfo(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return 0;
        }

        return res.data;
    }
}