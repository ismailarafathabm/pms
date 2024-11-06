app.controller('ctrl_summarysp', ctrl_summarysp);

function ctrl_summarysp($scope, $http) {
    document.getElementById('dia_filter_dates').style.display='flex';
    // const inputs = document.querySelectorAll("input");
    // inputs.forEach(i => {
    //     i.autocomplete = "off";
    // })
    $scope.gregorianDatepickerConfig = {
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

    document.getElementById("manpower_rpts").classList.add('menuactive');

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
        var bh = wsize - 170;
        var bhbh = bh - 35 - 10 - 7;
        var bhbhbh = bh - 35 - 27;
        // var bhbhbh = bh - 45;

        //document.querySelector(".sub-body").style.marginTop = "75px";
        document.querySelector(".sub-body-container").style.height = bh + "px";
        document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container").style.maiHeight = bh + "px";
        //document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        // document.querySelector(".mainbodys_data").style.height = bhbh + "px";
        // document.querySelector(".mainbodys_data").style.maxHeight = bhbh + "px";
        // document.querySelector(".mainbodys_data").style.maiHeight = bhbh + "px";

        // document.querySelector(".loadingdiv").style.height = bhbh + "px";
        // document.querySelector(".loadingdiv").style.maxHeight = bhbh + "px";
        // document.querySelector(".loadingdiv").style.maiHeight = bhbh + "px";

        // document.querySelector(".naf-tables").style.height = bhbhbh + "px";
        // document.querySelector(".naf-tables").style.maxHeight = bhbhbh + "px";
        // document.querySelector(".naf-tables").style.maiHeight = bhbhbh + "px";


        //set size main container

        var docwith = window.innerWidth;
        var mbodyw = document.querySelector(".ism-bodys").offsetWidth;

        //document.querySelector(".inreportsbody").style.width = docwith - 300 - 30;
    }

    $scope.isloading = true;

    $("#back_btn").on('click', function () {
        window.history.back();
    });
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
    var columndef = [];
    var gridOptions = {
        suppressContextMenu: true,
        columnDefs: columndef,
        enableCellChangeFlash: true,
        defaultColDef: {

            sortable: true,
            filter: true,
            floatingFilter: true,
            wrapText: true,
            resizable: true,
        },
        suppressMenuHide: true,
        colResizeDefault: 'shift',
        multiSortKey: 'ctrl',
        excelStyles: [{
            id: 'dateType',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        },
        {
            id: 'dateTypes',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        },
        {
            id: 'dateType_green',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        }
        ],
        statusBar: {
            statusPanels: [{
                statusPanel: 'agFilteredRowCountComponent',
                align: 'left'
            },
            {
                statusPanel: 'agTotalAndFilteredRowCountComponent',
                align: 'left'
            },
            ],
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
    };

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
    var gridDiv = document.querySelector('#myGrid');
   
    $scope.clearFilters = () => {
        filterClear();
    }

    function filterClear() {
        gridOptions.columnApi.applyColumnState({
            defaultState: {
                sort: null,
            },
        });
        gridOptions.api.setFilterModel(null);
    }
    $scope.excelexport = () => {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();
            var mname = "Tickets" + day + month + year;
            var FileName = mname
            var param = {
                fileName: FileName,
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }
    var _startdate = "";
    var _enddate = "";
    $scope.is_start_getrepott = false;
    $scope.getreport_dialog_submit = () => {
        $scope.is_start_getrepott = true;
        var fd = new FormData();
        var date = document.getElementsByName("startdate")[0].value;
        var datex = document.getElementsByName("enddate")[0].value;
        fd.append('startdate', date);
        fd.append('enddate', datex);
        _startdate = date;
        _enddate = datex;
        var post_data = {
            url: `${api_gway}/manpower_summarydt.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        };
        $http(post_data).then(res => {
            if (res.data.msg === '1') {
                columndef = [];
                columndef.push({
                    headerName: 'Project No',
                    field: 'Project No',
                    filter: 'agMultiColumnFilter',
                    sortingOrder: ['asc', 'desc'],
                    width: 100,
                    pinned: 'left',
                }, );
                columndef.push({
                    headerName: 'Project Name',
                    field: 'Project Name',
                    filter: 'agMultiColumnFilter',
                    sortingOrder: ['asc', 'desc'],
                    width: 400,
                    pinned: 'left',
                }, );
                columndef.push({
                    headerName: 'Region',
                    field: 'Region',
                    filter: 'agMultiColumnFilter',
                    sortingOrder: ['asc', 'desc'],
                    width: 160,
                    pinned: 'left',
                    sort: 'asc'

                }, );
                columndef.push({
                    headerName: 'Total Employees',
                    field: 'Total Employees',
                    filter: 'agMultiColumnFilter',
                    sortingOrder: ['asc', 'desc'],
                    width: 70,
                    pinned: 'left',
                }, );
                if (res.data.data.length !== 0) {
                    var xcols = Object.keys(res.data.data[0]);
                    var xcol = xcols.sort();

                    var i = 0;
                    var xcolf = [];
                    xcol.map(k => {
                        if (k !== 'Project No') {
                            if (k !== 'Project Name') {
                                if (k !== 'Region') {
                                    if (k !== 'Total Employees') {
                                        xcolf.push(k);
                                    }
                                }
                            }
                        }
                    })
                    xcolf = xcolf.sort();
                    xcolf.map(k => {
                        var l = k.split('-')
                        columndef.push({
                            headerName: l[2],
                            field: k,
                            width: 60,
                        }, );

                    })
                }
                gridOptions.columnDefs = columndef;                
                new agGrid.Grid(gridDiv, gridOptions);
                gridOptions.api.setRowData(res.data.data);
                document.getElementById('dia_filter_dates').style.display = 'none';
                $scope._filtertitle = `- Date : ${date} - to - ${datex}`;
                _todays = `- Date : ${date} - to - ${datex}`;
            } else {
                alert(res.data.data)
            }
            $scope.is_start_getrepott = false;
        })
    }
    
}