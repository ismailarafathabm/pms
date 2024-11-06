app.controller('ctrl_engglassorders', function($scope, $http) {
    document.title = "GLASS ORDERS [NAFCO PMS]";
    $scope.isloading = true;
    $scope._btn_print = access_glassorders_print;
    $scope._btn_excel = access_glassorders_excel;
    document.getElementById("rpt_project_glassorders").classList.add('menuactive');
    var site = print_location;
    window.addEventListener('resize', () => {
        maxbodyheight()
    })
    maxbodyheight();
    $scope.isloading = true;


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
        var bh = wsize - 160;
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

    var columnDefs = [{
            headerName: 'File',
            field: 'file',
            sortable: false,
            cellRenderer: function(p) {
                return p.data.file === '1' ? `
            <a href="${site}vfiles.php?page=glasssorder&folder=${p.data.glassorder_token}"  target="_blank">
                <img loading='lazy' src="${site}assets/pdfdownload.png?v=${v}" style="width:18px;">
            </a>
            ` : ``;
            },
            filter: false,

        },
        {
            headerName: 'Project No',
            field: 'project_no',
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
        },
        {
            headerName: 'Name',
            field: 'project_name',
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
        },
        {
            headerName: 'Glass Ord.No.',
            field: 'glassorderno',
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
        },
        {
            headerName: 'DONE BY',
            field: 'doneby',
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
        },
        {
            headerName: 'RELEASED TO PURCH.',
            field: 'releasedtopurchase_s',
            cellRenderer: function(p) {
                return `<div>${p.data.releasedtopurchase}</div>`
            },
            sortingOrder: ['asc', 'desc'],
            filter: 'agDateColumnFilter',
            filterParams: filterParams,

        },
        {
            headerName: 'RECEIVED FROM PURCH.',
            field: 'recivedfrompurchas_s',
            cellRenderer: function(p) {
                return `<div>${p.data.recivedfrompurchas}</div>`
            },
            sortingOrder: ['asc', 'desc'],
            filter: 'agDateColumnFilter',
            filterParams: filterParams,

        },
        {
            headerName: 'Glass Order Status',
            field: 'orderstatustxt',
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
        },
        {
            headerName: 'SUPPLIER',
            field: 'supplier_name',
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
        },
        {
            headerName: 'GLASS TYPE',
            field: 'glasstype_name',
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
        },
        {
            headerName: 'GLASS SPECIFICATION',
            field: 'glassdescription',
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
        },
        {
            headerName: 'MARKING LOCATION',
            field: 'markinglocation',
            filter: 'agMultiColumnFilter',

            sortingOrder: ['asc', 'desc'],
        },
        {
            headerName: 'QTY',
            field: 'QTY',
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
        },
        {
            headerName: 'REMARK',
            field: 'remarks',

            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
        },
    ];

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

    $scope.clearFilters = function() {
        gridOptions.columnApi.applyColumnState({
            defaultState: {
                sort: null,
            },
        });
        gridOptions.api.setFilterModel(null);
    }

    $scope.exportExcel = function() {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {

            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();
            var mname = "Drawing Approvals Report" + day + month + year;
            var FileName = mname
            var param = {
                fileName: FileName,
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);    
    //getReport();
    getReportNew();

    function getReportNew(){
        let post_data = {
            naf_user: userinfo
        };

        $http.post(api_url + "glassorder/getrpt.php", post_data)
        .then(
            res => {
                if(res?.data?.msg === "1"){
                    res.data.data.map(i=>{
                        getReport(i)
                    })
                }else if(res?.data?.msg === "0"){
                    alert(res.data.data);
                }else{
                    alert("Check Api More Information Check in Console..");
                }
            }
        )
    }
    let _datalist = [];
    function getReport(rpdate) {
        let post_data = {
            naf_user: userinfo
        };

        $http.post(`${api_url}glassorder/rpt.php?rpdate=${rpdate}`, post_data)
            .then(
                res => {
                    if (res?.data?.msg === "1") {
                        //console.log(res.data.data);
                        res.data.data.map(k=>{
                            _datalist.push(k);
                        })                        
                        gridOptions.api.setRowData(_datalist);
                        // console.log("working");
                        // gridOptions.api.setRowData(res.data.data);
                        // var allColumnIds = [];
                        // gridOptions.columnApi.getAllColumns().forEach(function(column) {
                        //     allColumnIds.push(column.colId);
                        // });
                        // gridOptions.columnApi.autoSizeColumns(allColumnIds, false);
                        // $scope.isloading = false;
                    } else if(res?.data?.msg === "0"){

                    }else{
                        //alert(res.data.data)
                        console.log(res.data);
                    }
                }
            )
    }


    $scope.printResult = () => {
        let _p = [];
        let _data = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(i => {
            let _d = _p.includes(ms.data.project_no);
            if(!_d){
                
            }
        });
    }

    $scope.printResultA = () => {
        var print_datas = "";

        var _p = [];
        var _g = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(ms => {
            _g.push({
                project_no: ms.data.project_no,
                project_name: ms.data.project_name,
                glassorderno: ms.data.glassorderno,
                doneby: ms.data.doneby,
                releasedtopurchase: ms.data.releasedtopurchase,
                recivedfrompurchas: ms.data.recivedfrompurchas,
                orderstatustxt: ms.data.orderstatustxt,
                supplier_name: ms.data.supplier_name,
                glasstype_name: ms.data.glasstype_name,
                glassdescription: ms.data.glassdescription,
                markinglocation: ms.data.markinglocation,
                QTY: ms.data.QTY,
                remarks: ms.data.remarks,
            });

            var _h = _p.includes(ms.data.project_no);
            if (!_h) {
                _p.push(ms.data.project_no);
            }

        });

        var _prt = [];
        _p = _p.sort();
        _p.forEach(_i => {
            var prj = _i;
            var prjname = '';
            var toqty = 0;
            var _tmparray = [];
            _g.forEach(_j => {
                if (_j.project_no === prj) {
                    prjname = _j.project_name;
                    if (_j.QTY !== 'NaN' && _j.QTY !== '-') {
                        toqty += (+_j.QTY);
                    }

                    _tmparray.push({
                        project_no: _j.project_no,
                        project_name: _j.project_name,
                        glassorderno: _j.glassorderno,
                        doneby: _j.doneby,
                        releasedtopurchase: _j.releasedtopurchase,
                        recivedfrompurchas: _j.recivedfrompurchas,
                        orderstatustxt: _j.orderstatustxt,
                        supplier_name: _j.supplier_name,
                        glasstype_name: _j.glasstype_name,
                        glassdescription: _j.glassdescription,
                        markinglocation: _j.markinglocation,
                        QTY: _j.QTY,
                        remarks: _j.remarks,

                    })
                }
            })

            _prt.push({
                prj: prj,
                prjname: prjname,
                prjarr: _tmparray,
                prjtot: toqty
            });

        });

        _prt.map(_d => {
            print_datas += `
            <div class="main_div">
            <div class="projectinfo">
            ${angular.uppercase(_d.prj)} -  ${angular.uppercase(_d.prjname)}   <span class='title_tos'>Total Qty : ${_d.prjtot.toFixed(2)}</span>
            </div>
            <div class="variationfino">
            <table>
            <thead>
            <tr>
            <th class="fiexdheader">S.No</th>            
            <th class="fiexdheader">Glass Ord.No.</th>
            <th class="fiexdheader">DONE BY</th>
            <th class="fiexdheader">RELEASED TO PURCH.</th>
            <th class="fiexdheader">RECEIVED FROM PURCH.</th>
            <th class="fiexdheader">Glass Order Status</th>
            <th class="fiexdheader">SUPPLIER</th>
            <th class="fiexdheader">GLASS TYPE</th>
            <th class="fiexdheader">GLASS SPECIFICATION</th>
            <th class="fiexdheader">MARKING LOCATION</th>
            <th class="fiexdheader">QTY</th>
            <th class="fiexdheader">REMARK</th>
            </tr>
            </thead>
            <tbody>`;
            var sno = 0;
            _d.prjarr.map(_t => {
                sno += 1;
                print_datas += `
                <tr>
                <td>${sno}</td>
                <td>${_t.glassorderno}</td>
                <td>${_t.doneby}</td>
                <td>${_t.releasedtopurchase}</td>
                <td>${_t.recivedfrompurchas}</td>
                <td>${_t.orderstatustxt}</td>
                <td>${_t.supplier_name}</td>
                <td>${_t.glasstype_name}</td>
                <td>${_t.glassdescription}</td>
                <td>${_t.markinglocation}</td>
                <td>${_t.QTY}</td>
                <td>${_t.remarks}</td>                            
                </tr>
                `;
            })
            print_datas += `</tbody>
            </table>
            </div>
            </div>
            `;
        })

        localStorage.removeItem('print_glassorderreport');
        localStorage.setItem('print_glassorderreport', print_datas);

        // // //print_cuttinglist.php
        var locationprint = print_location + "Print/print_glassordersrpt.php";
        window.open(locationprint, '_blank', "width = '1300px', height = '800px'");
    }
});