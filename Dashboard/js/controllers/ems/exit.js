import Employees from './services/employee.js';
app.controller('emp_finalexit', emp_finalexit);
function emp_finalexit($scope) {
    maxbodyheight();
    window.addEventListener('resize', () => {
        maxbodyheight()
    })

    function maxbodyheight() {
        var mbody = document.querySelector(".ism-bodys");        
        var wsize = window.innerHeight;
        //console.log(wsize);
        var head_size = document.querySelector(".ism-headers").offsetHeight;
        //console.log(head_size);        
        var nav_size = document.querySelector(".ism-navi-itmes");
        nav_size.marginTop = head_size + "px"
        var foot_size = document.querySelector(".ism-footers").offsetHeight;
        var rmh = 120;
        var bh = wsize - 110;
        var bhbh = bh - 39 - 8;
        var bhbhbh = bh - 52 - 8;
        // var bhbhbh = bh - 45;

        document.querySelector(".sub-body-container").style.height = bh + "px";
        document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container").style.maiHeight = bh + "px";
        document.querySelector(".sub-body-container").style.marginTop = "75px";
        //document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container-contents").style.height = bhbh + "px";
        document.querySelector(".sub-body-container-contents").style.maxHeight = bhbh + "px";
        document.querySelector(".sub-body-container-contents").style.maiHeight = bhbh + "px";

    }
    
    var filterParams = {
        comparator: function(filterLocalDateAtMidnight, cellValue) {
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
    const emp = new Employees();
    $scope.isLoadingInfo = false;
    const cols = emp.columnsExit(filterParams);
    const gridOptions = emp.gridOptions(cols);
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);

    async function getReport() {
        if (!$scope.isLoadingInfo) {
            $scope.isLoadingInfo = true;
            const res = await emp.finalExit();
            if (res?.msg !== 1) {
                alert(res.data);
                $scope.isLoadingInfo = false;
                $scope.$apply();
                return;
            }
            let finaldata = [];
            res.data.map((i) => {
                let rm = ['Head Office', 'Jeddah Office', 'Kitchen','Azizia Warehouse','Aluminium - Factory','Bonding Section','Cladding Section','Fabrication','Finishing Section','House Driver (g.m)', 'Kitchen Show Room','Maintenance Secrtion','Rockwool Section','Steel Division',];
                let loc = i.esection;
                let add = rm.includes(loc);
                if (!add) {
                    if (i.ecategory !== "Staff") {
                        console.log(i);
                        finaldata.push(i);
                    }
                }
            })            
            gridOptions.api.setRowData(finaldata);
            $scope.isLoadingInfo = false; 
            $scope.$apply();
        }
    }

    getReport();
}