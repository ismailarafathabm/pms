import _ from './../controllers/mtbl.js';
export default  function mtbl_backlog_controller($scope, $rootScope, $filter,$compile) {
    document.getElementById("project_materialtobeload").classList.add('menuactive');
    const gridDiv = document.querySelector('#myGrid');
    const mc = new _();
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
    console.log(mc);
    const columnDefs = mc.columns($scope, $compile,"v");
    const gridOptions = mc.gridoptions(columnDefs);

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
    async function loadRpt() {        
        const res = await mc.BackLog();
        if (res?.msg !== 1) {
            alert(re.data);
            return;
        }
        console.log(res.data);
        gridOptions.api.setRowData(res.data);
    }
    loadRpt();


    $scope.printrpt = () => {
        const _data = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(i => {
            console.log(i.data);
            _data.push(i.data);
        });
        localStorage.removeItem("pms_ism_print_material_load_backlog");
        localStorage.setItem("pms_ism_print_material_load_backlog", JSON.stringify(_data));
        window.open(`${print_location}fprint/#!/materialtobeloadbacklog`, "_blank", "height:500px,width:1200px");
    }
    
}