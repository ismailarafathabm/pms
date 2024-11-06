
function ctrl_manfullrtp($scope, $http) {
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

    var columndef = [{
        headerName: 'Sl.No',
        //cellRenderer: 'node.rowIndex + 1',
        valueGetter: "node.rowIndex + 1",
        width: 70,
        filter: false,
        sortable: false,

    }, {
        headerName: 'Date',
        field: 'mdate',
        cellRenderer: function (params) {
            return `${params.data.mdate_d}`
        },
        cellClass: 'dateType',
        sort: 'desc',
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        width: 100,

    },
    {
        headerName: 'Project NO',
        field: 'projectno',
        width: 100,

    },
    {
        headerName: 'Project Name',
        field: 'projectname',
        width: 180,
    },
    {
        headerName: 'Location',
        field: 'projectlocation',
        width: 100,

    },
    {
        headerName: 'Region',
        field: 'projectregion',
        width: 150,
    },
    {
        headerName: 'File No',
        field: 'fileno',
        width: 80,
    },
    {
        headerName: 'Name',
        field: 'ename',
        width: 160,
    },
    {
        headerName: 'Designation',
        field: 'eposition',
        width: 150,
    },
    {
        headerName: 'Status',
        field: 'filenostatustxt',
        width: 100,
        cellRenderer: function (par) {
           // var rtntxt;
            return par.data.filenostatus === '1' ? `<span style="color:green"><i class="fa fa-check"></i> Present</span>` : `<span style="color:red"><i class="fa fa-times"></i> Absent</span>`
            // if (par.data.filenostatus === '1') {
            //     rtntxt = `<img src='ok.png' height='30px'> - Present`;
            // } else {
            //     rtntxt = `<img src='error.png' height='30px'> - Absent`;
            // }
            // return rtntxt;
        }
    }, {
        headerName: 'Project Manager',
        field: 'mangername',
        cellRenderer : function(i){
            return i.data.mangername === 'NAN' ? 'NONE' : i.data.mangername
        }
    },

    ];

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
    new agGrid.Grid(gridDiv, gridOptions);
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
            url: `${api_gway}/manpower_fullinfo.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        };
        $http(post_data).then(res => {
            if (res.data.msg === '1') {
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
app.controller('ctrl_manfullrtp', ctrl_manfullrtp);
