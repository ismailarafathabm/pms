app.controller('rcwh',rcwh);

function rcwh($scope,$http){
    document.title = "POWDER COTTINGS REPORT [RECEIPT WAREHOUSE] - PMS";    
    document.getElementById("powdercottingR").classList.add('menuactive');
    window.addEventListener('resize', () => {
        maxbodyheight()
    })
    maxbodyheight();

    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian'
    };

    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function(value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function(value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };

    function maxbodyheight() {
        var mbody = document.querySelector(".ism-bodys");
        var wsize = window.innerHeight;
        var head_size = document.querySelector(".ism-headers").offsetHeight;
        var nav_size = document.querySelector(".ism-navi-itmes");
        nav_size.marginTop = head_size + "px"
        var foot_size = document.querySelector(".ism-footers").offsetHeight;
        var rmh = 120;
        var bh = wsize - 160;
        var bhbh = bh - 35 - 10 - 7;
        var bhbhbh = bh - 35 - 27;
        document.querySelector(".sub-body-container").style.height = bh + "px";
        document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container").style.maiHeight = bh + "px";
        var docwith = window.innerWidth;
        var mbodyw = document.querySelector(".ism-bodys").offsetWidth;

    }

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
        headerName: 'Project No',
        field: 'pp_project',
        sortingOrder: ['asc', 'desc'],
        width : 110
        
    })
    columnDefs.push({
        headerName: 'Project Name',
        field: 'pp_projectname',
        sortingOrder: ['asc', 'desc'], 
        width : 228       
    })

   

    columnDefs.push({
        headerName: 'Type',
        field: 'pp_mtype',
        sortingOrder: ['asc', 'desc'],   
        width : 160     
    })

    columnDefs.push({
        headerName: 'Description',
        field: 'pp_mdescription',
        sortingOrder: ['asc', 'desc'],   
        width : 300     
    })

    columnDefs.push({
        headerName: 'Color',
        field: 'pp_color',
        sortingOrder: ['asc', 'desc'], 
        width : 218          
    })

    columnDefs.push({
        headerName: 'Die Weight',
        field: 'pp_dieweight',
        sortingOrder: ['asc', 'desc'],    
        width : 120    
    })

    columnDefs.push({
        headerName: 'QTY',
        field: 'returnqty',
        sortingOrder: ['asc', 'desc'], 
        width : 75          
    })

    columnDefs.push({
        headerName: 'Unit',
        field: 'pp_units',
        sortingOrder: ['asc', 'desc'],     
        width : 97   
    })
    
    columnDefs.push({
        headerName: 'DEL.NO',
        field: 'pp_delno',
        sortingOrder: ['asc', 'desc'],   
        width : 100     
    })

    columnDefs.push({
        headerName: 'Rec.No',
        field: 'rtno',
        sortingOrder: ['asc', 'desc'],   
        width : 100     
    })

    columnDefs.push({
        headerName: 'P.Rec.No',
        field: 'rcpno',
        sortingOrder: ['asc', 'desc'],   
        width : 100     
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
        width : 120
    })

    columnDefs.push({
        headerName: 'Location',
        field: 'pp_location',
        sortingOrder: ['asc', 'desc'],   
        width : 186     
    })

    columnDefs.push({
        headerName: 'Remarks',
        field: 'remark',
        sortingOrder: ['asc', 'desc'],  
        width : 240      
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
            var mname = `Factory To Paint Plant RECEIPT  AS ON DATE ${day}-${month}-${year}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: mname,
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }
    // NewGetReport();
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);

    const _ftype = "pptowh";

    function _apiError($response){
        alert("Something Error In FETCH API , please Read Console Data");
        console.error($response);
    }

    getReport();
    
    function getReport(){
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('pptype',_ftype);

        const post_data = {
            url : `${api_url}ppwork/receiptlist.php`,
            data : fd,
            method : 'POST',
            headers : {
                'content-type' : undefined
            }
        };

        const req = $http(post_data);

        req.then(
            res => {
                if(res?.data?.msg === "1"){
                    gridOptions.api.setRowData(res.data.data);
                }else if(res?.data?.msg === "0"){
                    alert(res.data.data);
                }else{
                    _apiError(res.data);
                }
            }
        )
    }

    $scope.printResult = () => { 
        let _data = [];
        let _project = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((i)=>{
            _data.push(i.data);
            let av = _project.includes(i.data.pp_project);
            if(!av){
                _project.push(i.data.pp_project);
            }
        });
        let _fdata = [];
        _project.map((i)=>{
            let _pno = i;
            let _pname = "";
            let _list = [];
            _data.map((j)=>{
                if(j.pp_project === i){
                    _pname = j.pp_projectname;
                    _list.push(j);
                }
            })
            _fdata.push(
                {
                _pno,_pname,_list
                }
            )
        })

        localStorage.clear("printppreports");
        localStorage.clear("printppreportstitle");
        localStorage.setItem("printppreportstitle","PAINT PLANT RECEIPT - WHAREHOUSE");
        localStorage.setItem("printppreports",JSON.stringify(_fdata));
        var loc = print_location + "print/printpprec.html";
        window.open(loc, '_blank', width = '1300px', height = '800px');
    }

}