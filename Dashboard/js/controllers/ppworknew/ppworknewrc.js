app.controller("ppworknewrcall",ppworknewrcall);

function ppworknewrcall($scope, $http) {
    let _rptdata = [];
    document.getElementById("rpt_materials").classList.add('menuactive');
    document.title = "POWDER COTTINGS RECEIPT REPORT - PMS";
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth();
    var year = date.getFullYear();
    let excelfilename = `Paint Plant All Receipt Report AS ON DATE ${day}-${month}-${year}`;
    let printtitle = `PAINT PLANT ALL RECEIPT REPORT AS ON DATE ${day}-${month}-${year}`;

     //windows auto height adjust
    window.addEventListener('resize', () => {
        maxbodyheight()
    });
    maxbodyheight();

    function maxbodyheight() {
        var mbody = document.querySelector(".ism-bodys");
        var wsize = window.innerHeight;
        var head_size = document.querySelector(".ism-headers").offsetHeight;
        var nav_size = document.querySelector(".ism-navi-itmes");
        nav_size.marginTop = head_size + "px"
        var foot_size = document.querySelector(".ism-footers").offsetHeight;
        var rmh = 120;
        var bh = wsize - 170;
        var bhbh = bh - 35 - 10 - 7;
        var bhbhbh = bh - 35 - 27;
        document.querySelector(".sub-body-container").style.height = bh + "px";
        document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container").style.maiHeight = bh + "px";
        var docwith = window.innerWidth;
        var mbodyw = document.querySelector(".ism-bodys").offsetWidth;
    }


    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian'
    };

    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };

    //windows auto height adjust

    //grid
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

    columnDefs.push({
        headerName: 'PROJECT NAME',
        field: 'ppproject',
        cellRenderer: function (_) {
            return `${_.data.ppproject} [${_.data.pjno}]`;
        },
        sortingOrder: ['asc', 'desc'],
        width: 228,
        filter: 'agMultiColumnFilter',
    })
    columnDefs.push({
        headerName: 'TYPE',
        field: 'pptype',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'DESCRIPTIOIN',
        field: 'ppdescription',
        sortingOrder: ['asc', 'desc'],
        width: 320,
        filter: 'agMultiColumnFilter',
    })
    columnDefs.push({
        headerName: 'COLOR',
        field: 'ppcolor',
        sortingOrder: ['asc', 'desc'],
        width: 318,
        filter: 'agMultiColumnFilter',
    })
    columnDefs.push({
        headerName: 'RECEIVED QTY/PC',
        field: 'returnqty',
        sortingOrder: ['asc', 'desc'],
        width: 80,
        filter: 'agNumberColumnFilter',
    })

    
    columnDefs.push({
        headerName: 'Wt/Kg',
        field: 'totkg',
        sortingOrder: ['asc', 'desc'],
        width: 80,
        filter: 'agNumberColumnFilter',
    })

    columnDefs.push({
        headerName: 'RECEIPT NO',
        field: 'rcpno',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'Date',
        field: 'returndate',
        cellRenderer: function (p) {
            return `<div>${p.data.returndate_d}</div>`
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        sort: 'desc',
        width: 120,
    })

    columnDefs.push({
        headerName: 'REMARKS',
        field: 'remarks',
        sortingOrder: ['asc', 'desc'],
        width: 200,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'TYPE',
        field: 'typef',        
        sortingOrder: ['asc', 'desc'],
        width: 250,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'REMARK',
        field: 'remark',        
        sortingOrder: ['asc', 'desc'],
        width: 250,
        filter: 'agMultiColumnFilter',
    })


    var gridOptions = {
        suppressContextMenu: true,
        columnDefs: columnDefs,
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

    

    $scope.clearFilters = function () {
        gridOptions.api.setRowData(_rptdata);
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

            var param = {
                fileName: excelfilename,
                sheetName: "SHEET1",
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }
    // NewGetReport();
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);

    loadAll();
    function loadAll() {
        const fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        const post_data = {
            url: `${api_url}ppworknew/allpprc.php`,
            data: fd,
            method: "POST",
            headers: {
                'content-type': undefined
            }
        };
        const req = $http(post_data);
            req.then(res => {
                _process = false;
                console.log(res.data);
                if (res?.data?.msg === '1') {
                    _rptdata = res.data.data;
                    gridOptions.api.setRowData(res.data.data);
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                } else if (res?.data?.msg === "404") {
                    alert("USER AUTHENTICATION ERROR");
                    ///location.href = `${site}/logout.php`;
                } else {
                    console.log("API ERROR... CHECK IN CONSOLE");
                }
            })
    }

    $scope.datefilter = {
        diashow: false,
        isloading: false,
        data: {
            fromdate: '',
            todate : ''
        }
    };
    _getThisWeek();


    async function _getThisWeek() {
        console.log("AAAAAA");
        const req = await fetch(`${print_location}/api/cuttinglists/weekget.php`);
        const res = await req.json();
        if (res?.msg !== "1") {
            return;
        }

        $scope.datefilter = {
            ...$scope.datefilter,
            data: {
                fromdate: res.data.fday,
                todate : res.data.fd,
            }
        };

        console.log(res.data);
        console.log($scope.datefilter);

        $scope.$apply();

    }

    $scope.filterbydate = () => {
        const _fromdate = $scope.datefilter?.data?.fromdate ?? '';
        const _todate = $scope.datefilter?.data?.todate ?? '';
        if (!_fromdate || _fromdate === '') {
            alert("Enter Form Date");
            return;
        }

        if (!_todate || _todate === '') {
            alert("Enter To Date");
            return;
        }
        const fdate = _convertDate(_fromdate);
        const todate = _convertDate(_todate);
        gridOptions.api.setRowData([]);
        const filterdata = _rptdata.filter(x => x.returndate >= fdate && x.returndate <= todate);
        let sortdata = filterdata.sort((a, b) => {
            if (a.issuedate < b.issuedate) {
                return -1;
            }
            if (a.issuedate > b.issuedate) {
                return 1;
            }
            return 1;
        })
        gridOptions.api.setRowData(sortdata);
        gridOptions.columnApi.applyColumnState({
            state: [{ colId: 'issuedate', sort: 'desc' }],
        });
        $scope.datefilter['diashow'] = false;

    }

    function _convertDate(d) {
        const x = d.split('-');

        const date = x[0];
        const month = x[1];
        const year = x[2];

        return `${year}-${month}-${date}`;
    }




    $scope.printResult = () => {
        let _data = [];

        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _data.push(_.data);
        })

        let printwindow = window.open(`${print_location}/sprint/ppreceiptrpt.html`, '_blank', "width:1300px;height:700px");
        printwindow.forprintdata = JSON.stringify(_data);        
        printwindow.type = "N";
    }
}


app.controller("ppworknewrcallf",ppworknewrcallf);

function ppworknewrcallf($scope,$http, $routeParams){
    const _mode = $routeParams.type;
    var site = print_location;
    console.log(_mode);
    if (_mode !== 'whtopp' || _mode !== "fctopp") {
        //location.href = site;
    }
    document.getElementById("rpt_materials").classList.add('menuactive');
    document.title = "POWDER COTTINGS RECEIPT REPORT - PMS";
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth();
    var year = date.getFullYear();
    let excelfilename = `Paint Plant All Receipt Report AS ON DATE ${day}-${month}-${year}`;
    let printtitle = `PAINT PLANT ALL RECEIPT REPORT AS ON DATE ${day}-${month}-${year}`;

    switch (_mode) {
        case 'whtopp':
            
            $scope._pagemaintitle = "WAREHOUSE TO PAINT PLANT RECEIPT - REPORT";
            excelfilename = `Warehouse To Paint Plant RECEIPT  AS ON DATE ${day}-${month}-${year}`;
            printtitle = `WAREHOUSE TO PAINT PLANT REPORT AS ON DATE ${day}-${month}-${year}`;
            break;
        case 'fctopp':            
            $scope._pagemaintitle = "FACTORY TO PAINT PLANT RECEIPT  - REPORT";
            excelfilename = `Factory To Paint Plant Receipt AS ON DATE ${day}-${month}-${year}`;
            printtitle = `FACTORY TO PAINT PLANT AS ON DATE ${day}-${month}-${year}`;
            break;
        default:
            $scope._pagemaintitle = "WAREHOUSE TO PAINT PLANT RECEIPT - REPORT";
            excelfilename = `Factory To Paint Plant Receipt  AS ON DATE ${day}-${month}-${year}`;
            printtitle = `WAREHOUSE TO PAINT PLANT RECEIPT REPORT AS ON DATE ${day}-${month}-${year}`;
            break;
    }
     //windows auto height adjust
     window.addEventListener('resize', () => {
        maxbodyheight()
    })
    maxbodyheight();

    function maxbodyheight() {
        var mbody = document.querySelector(".ism-bodys");
        var wsize = window.innerHeight;
        var head_size = document.querySelector(".ism-headers").offsetHeight;
        var nav_size = document.querySelector(".ism-navi-itmes");
        nav_size.marginTop = head_size + "px"
        var foot_size = document.querySelector(".ism-footers").offsetHeight;
        var rmh = 120;
        var bh = wsize - 170;
        var bhbh = bh - 35 - 10 - 7;
        var bhbhbh = bh - 35 - 27;
        document.querySelector(".sub-body-container").style.height = bh + "px";
        document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container").style.maiHeight = bh + "px";
        var docwith = window.innerWidth;
        var mbodyw = document.querySelector(".ism-bodys").offsetWidth;
    }


    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian'
    };

    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };

    //windows auto height adjust

    //grid
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

    columnDefs.push({
        headerName: 'PROJECT NAME',
        field: 'ppproject',
        cellRenderer: function (_) {
            return `${_.data.ppproject} [${_.data.pjno}]`;
        },
        sortingOrder: ['asc', 'desc'],
        width: 228,
        filter: 'agMultiColumnFilter',
    })
    columnDefs.push({
        headerName: 'TYPE',
        field: 'pptype',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'DESCRIPTIOIN',
        field: 'ppdescription',
        sortingOrder: ['asc', 'desc'],
        width: 320,
        filter: 'agMultiColumnFilter',
    })
    columnDefs.push({
        headerName: 'COLOR',
        field: 'ppcolor',
        sortingOrder: ['asc', 'desc'],
        width: 318,
        filter: 'agMultiColumnFilter',
    })
    columnDefs.push({
        headerName: 'RECEIVED QTY/PC',
        field: 'returnqty',
        sortingOrder: ['asc', 'desc'],
        width: 80,
        filter: 'agNumberColumnFilter',
    })

    
    columnDefs.push({
        headerName: 'Wt/Kg',
        field: 'totkg',
        sortingOrder: ['asc', 'desc'],
        width: 80,
        filter: 'agNumberColumnFilter',
    })

    columnDefs.push({
        headerName: 'RECEIPT NO',
        field: 'rcpno',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'Date',
        field: 'returndate',
        cellRenderer: function (p) {
            return `<div>${p.data.returndate_d}</div>`
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        sort: 'desc',
        width: 120,
    })

    columnDefs.push({
        headerName: 'REMARKS',
        field: 'remarks',
        sortingOrder: ['asc', 'desc'],
        width: 200,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'REMARK',
        field: 'remark',        
        sortingOrder: ['asc', 'desc'],
        width: 250,
        filter: 'agMultiColumnFilter',
    })


    var gridOptions = {
        suppressContextMenu: true,
        columnDefs: columnDefs,
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

            var param = {
                fileName: excelfilename,
                sheetName: "SHEET1",
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }
    // NewGetReport();
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);

    loadAll();
    function loadAll() {
        const fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('type', _mode);
        const post_data = {
            url: `${api_url}ppworknew/allpprcf.php`,
            data: fd,
            method: "POST",
            headers: {
                'content-type': undefined
            }
        };
        const req = $http(post_data);
            req.then(res => {
                _process = false;
                console.log(res.data);
                if (res?.data?.msg === '1') {
                    gridOptions.api.setRowData(res.data.data);
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                } else if (res?.data?.msg === "404") {
                    alert("USER AUTHENTICATION ERROR");
                    ///location.href = `${site}/logout.php`;
                } else {
                    console.log("API ERROR... CHECK IN CONSOLE");
                }
            })
    }


    $scope.printResult = () => {
        let _data = [];
        let _project = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _data.push(_.data);
            let dub = _project.includes(_.data.pjno);
            if (!dub) {
                _project.push(_.data.pjno);
            }
        })

        let _fdata = [];

        _project.map((_) => {
            let pno = _;
            let pname = "";
            let list = [];
            _data.map((i) => {
                if (i.pjno === pno) {
                    pname = i.ppproject,
                        list.push(i);
                }
            })
            _fdata.push({ pno, pname, list });
        });

        if (_fdata.length === 0) {
            alert("NOTING FOUND.");
            return;
        }


        localStorage.clear("printppnewrpt");
        localStorage.clear("printppnewreporttitle");

        localStorage.setItem("printppnewreporttitle", printtitle);
        localStorage.setItem("printppnewrpt", JSON.stringify(_fdata))

        var loc = `${print_location}/Print/printppnewrptrc.html`;
        window.open(loc, '_blank', width = "1300px", height = "700px");

    }

    
}