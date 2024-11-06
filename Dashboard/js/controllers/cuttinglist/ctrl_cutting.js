app.controller('ctrl_engcuttinglist', function ($scope, $http) {
    document.title = "CUTTING LIST - PMS"
    $scope._btn_print = access_cuttinglist_print;
    $scope._btn_excel = access_cuttinglist_excel_report;
    document.getElementById("rpt_project_cuttinglist").classList.add('menuactive');
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

    var columnDefs = [{
        headerName: 'Files',
        field: 'file',
        sortable: false,
        cellRenderer: function (p) {
            return p.data.file === '1' ? `
                <a href="${site}viewuploads.php?foldertoken=${p.data.cuttinglist_token}"  target="_blank">
                    <img loading='lazy' src="${site}assets/pdfdownload.png?v=${v}" style="width:18px;">
                </a>
                ` : ``;
        },
        filter: false,

    },
    {
        headerName: 'Project NO',
        field: 'cuttinglist_project_id',
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
        headerName: 'BOQ ITEM',
        field: 'cuttinglist_boqitem',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],

    },
    {
        headerName: 'Type',
        field: 'cuttinglistfortext',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],

    },
    {
        headerName: 'Ref.No',
        field: 'cuttinglist_clrefno',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],

    },
    {
        headerName: 'CL.Date Released',
        field: 'cuttinglist_cldaterelease_s',
        cellRenderer: function (p) {
            return `<div>${p.data.cuttinglist_cldaterelease}</div>`
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agDateColumnFilter',
        filterParams: filterParams,

    },
    {
        headerName: 'MO.Ref NO',
        field: 'cuttinglist_morefno',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },
    {
        headerName: 'MO.Released To Acct',
        field: 'cuttinglist_moreleasedtoacct_s',
        cellRenderer: function (p) {
            return `<div>${p.data.cuttinglist_moreleasedtoacct}</div>`
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agDateColumnFilter',
        filterParams: filterParams,

    },
    {
        headerName: 'MO.Released To Production',
        field: 'cuttinglist_moreleasedtoproduction_s',
        cellRenderer: function (p) {
            return `<div>${p.data.cuttinglist_moreleasedtoproduction}</div>`
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agDateColumnFilter',
        filterParams: filterParams,

    },
    {
        headerName: 'Released To',
        field: 'cuttinglist_releasedto',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },
    {
        headerName: 'Done By',
        field: 'cuttinglist_doneby',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },
    {
        headerName: 'Marking Type',
        field: 'cuttinglist_markingtype',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },
    {
        headerName: 'Desscription',
        field: 'cuttinglist_descripton',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },
    {
        headerName: 'Location',
        field: 'cuttinglist_location',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },
    {
        headerName: 'Qty',
        field: 'cuttinglist_qty',
        filter: 'agNumberColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },

    {
        headerName: 'Unit',
        field: 'cuttinglist_qty_type',

        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },

    {
        headerName: 'Height',
        field: 'cuttinglist_height',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },
    {
        headerName: 'Width',
        field: 'cuttinglist_width',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },
    {
        headerName: 'AREA.SQM',
        field: 'cuttinglist_area',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },
    {
        headerName: 'Tot.Area',
        field: 'cuttinglist_totarea',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },
    {
        headerName: 'Glass Ref. No.',
        field: 'cuttinglist_classrefno',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },
    {
        headerName: 'SHEET TYPE',
        field: 'cuttinglist_sheettp',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },
    {
        headerName: 'REMARK',
        field: 'cuttinglist_remarks',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },
    {
        headerName: 'SECTION',
        field: 'cuttinglist_section',
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
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);

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
    getReport();

    function getReport() {
        let post_data = {
            naf_user: userinfo
        };
        $http.post(api_url + "cuttinglist/rpt.php", post_data).then(
            (res) => {
                if (res?.data?.msg === "1") {
                    let _y = res.data.data;
                    _y.map(i => {
                        //console.log(i)
                        LoadDataA(i);
                    })


                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                } else {
                    alert("Api Error/")
                    console.log(res.data);
                }
            }

        )
    }
    let absdatas = [];
    function LoadDataA(sno) {
        let x = {
            naf_user: userinfo,
            rdate: sno
        }

        $http.post(api_url + "cuttinglist/getrpt.php", x)
            .then(res => {
                if (res?.data?.msg === '1') {
                     
                    res.data.data.map((k)=>{                        
                        absdatas.push(k);  
                    })
                    
                    gridOptions.api.setRowData(absdatas);
                   
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                } else {
                    alert("Api Error in Fetching data ...")
                    console.log(res.data);
                }
            })

         
           
           
            // var allColumnIds = [];
            // gridOptions.columnApi.getAllColumns().forEach(function(column) {
            //     allColumnIds.push(column.colId);
            // });
            // gridOptions.columnApi.autoSizeColumns(allColumnIds, false);
            $scope.isloading = false;
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
            var mname = "Drawing Approvals Report" + day + month + year;
            var FileName = mname
            var param = {
                fileName: FileName,
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }

    $scope.printResults = () => {
        var print_datas = "";

        var _c = [];
        var _p = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(ms => {
            var havep = _p.includes(ms.data.cuttinglist_project_id);
            if (!havep) {
                _p.push(ms.data.cuttinglist_project_id)
            }
            _c.push({

                cuttinglist_project_id: ms.data.cuttinglist_project_id,
                project_name: ms.data.project_name,
                cuttinglist_boqitem: ms.data.cuttinglist_boqitem,
                cuttinglistfortext: ms.data.cuttinglistfortext,
                cuttinglist_clrefno: ms.data.cuttinglist_clrefno,
                cuttinglist_cldaterelease: ms.data.cuttinglist_cldaterelease,
                cuttinglist_morefno: ms.data.cuttinglist_morefno,
                cuttinglist_moreleasedtoacct: ms.data.cuttinglist_moreleasedtoacct,
                cuttinglist_moreleasedtoproduction: ms.data.cuttinglist_moreleasedtoproduction,
                cuttinglist_releasedto: ms.data.cuttinglist_releasedto,
                cuttinglist_doneby: ms.data.cuttinglist_doneby,
                cuttinglist_markingtype: ms.data.cuttinglist_markingtype,
                cuttinglist_descripton: ms.data.cuttinglist_descripton,
                cuttinglist_location: ms.data.cuttinglist_location,
                cuttinglist_qty: ms.data.cuttinglist_qty,
                cuttinglist_qty_type: ms.data.cuttinglist_qty_type,
                cuttinglist_height: ms.data.cuttinglist_height,
                cuttinglist_width: ms.data.cuttinglist_width,
                cuttinglist_area: ms.data.cuttinglist_area,
                cuttinglist_totarea: ms.data.cuttinglist_totarea,
                cuttinglist_classrefno: ms.data.cuttinglist_classrefno,
                cuttinglist_sheettp: ms.data.cuttinglist_sheettp,
                cuttinglist_remarks: ms.data.cuttinglist_remarks,
                cuttinglist_section: ms.data.cuttinglist_section,

            })
        })

        var _prt = [];

        _p.forEach(_i => {
            var _farray = [];
            var tot = 0;
            var tot_qty = 0;
            var projectname = '';

            _c.forEach(_l => {
                if (_i === _l.cuttinglist_project_id) {
                    if (_l.cuttinglist_totarea !== 'NaN' && _l.cuttinglist_area !== '-') {
                        tot += (+_l.cuttinglist_totarea)
                    }
                    if (_l.cuttinglist_qty !== 'NaN' && _l.cuttinglist_qty !== '-') {
                        tot_qty += (+_l.cuttinglist_qty);
                    }
                    projectname = angular.uppercase(_l.project_name);
                    _farray.push({
                        cuttinglist_project_id: _l.cuttinglist_project_id,
                        project_name: _l.project_name,
                        cuttinglist_boqitem: _l.cuttinglist_boqitem,
                        cuttinglistfortext: _l.cuttinglistfortext,
                        cuttinglist_clrefno: _l.cuttinglist_clrefno,
                        cuttinglist_cldaterelease: _l.cuttinglist_cldaterelease,
                        cuttinglist_morefno: _l.cuttinglist_morefno,
                        cuttinglist_moreleasedtoacct: _l.cuttinglist_moreleasedtoacct,
                        cuttinglist_moreleasedtoproduction: _l.cuttinglist_moreleasedtoproduction,
                        cuttinglist_releasedto: _l.cuttinglist_releasedto,
                        cuttinglist_doneby: _l.cuttinglist_doneby,
                        cuttinglist_markingtype: _l.cuttinglist_markingtype,
                        cuttinglist_descripton: _l.cuttinglist_descripton,
                        cuttinglist_location: _l.cuttinglist_location,
                        cuttinglist_qty: _l.cuttinglist_qty,
                        cuttinglist_qty_type: _l.cuttinglist_qty_type,
                        cuttinglist_height: _l.cuttinglist_height,
                        cuttinglist_width: _l.cuttinglist_width,
                        cuttinglist_area: _l.cuttinglist_area,
                        cuttinglist_totarea: _l.cuttinglist_totarea,
                        cuttinglist_classrefno: _l.cuttinglist_classrefno,
                        cuttinglist_sheettp: _l.cuttinglist_sheettp,
                        cuttinglist_remarks: _l.cuttinglist_remarks,
                        cuttinglist_section: _l.cuttinglist_section,
                    });
                }
            })

            _prt.push({
                prj: angular.uppercase(_i),
                prjn: projectname,
                prjarr: _farray,
                prjtot: tot,
                prjtotitem: tot_qty
            });


        })
        console.log(_prt);

        _prt.forEach(m => {
            print_datas += `
            <div class="main_div">
            
            <div class="projectinfo">
            ${angular.uppercase(m.prj)} -  ${angular.uppercase(m.prjn)}  <span class='title_tos'>Total Area : ${m.prjtot.toFixed(2)} </span > <span class='title_tos' style="margin-right:20px">Total Qty : ${m.prjtotitem.toFixed(2)}</span>
            </div>
            <div class="variationfino">
            <table>
            <thead>
            <tr>
            <th class="fiexdheader">S.No</th>            
            <th class="fiexdheader">BOQ ITEM</th>
            <th class="fiexdheader">Type</th>
            <th class="fiexdheader">Ref.No</th>
            <th class="fiexdheader">CL.Date Released</th>
            <th class="fiexdheader">MO.Ref NO</th>
            <th class="fiexdheader">MO.Released To Acct</th>
            <th class="fiexdheader">MO.Released To Production</th>            
            <th class="fiexdheader">Released To</th>            
            <th class="fiexdheader">Done By</th>            
            <th class="fiexdheader">Marking Type</th>
            <th class="fiexdheader">Desscription</th>
            <th class="fiexdheader">Location</th>
            <th class="fiexdheader">Qty</th>
            <th class="fiexdheader">Height</th>
            <th class="fiexdheader">Width</th>
            <th class="fiexdheader">AREA.SQM</th>
            <th class="fiexdheader">Tot.Area</th>
            <th class="fiexdheader">Glass Ref. No.</th>
            <th class="fiexdheader">SHEET TYPE</th>
            <th class="fiexdheader">REMARK</th>
            <th class="fiexdheader">SECTION</th>
            </tr>
            </thead>
            <tbody>
            `;
            var sno = 0;
            m.prjarr.forEach(l => {
                sno += 1;
                print_datas += `
                <tr>
                <td>${sno}</td>
                <td>${l.cuttinglist_boqitem}</td>
                <td>${l.cuttinglistfortext}</td>
                <td>${l.cuttinglist_clrefno}</td>
                <td>${l.cuttinglist_cldaterelease}</td>
                <td>${l.cuttinglist_morefno}</td>
                <td>${l.cuttinglist_moreleasedtoacct}</td>
                <td>${l.cuttinglist_moreleasedtoproduction}</td>
                <td>${l.cuttinglist_releasedto}</td>
                <td>${l.cuttinglist_doneby}</td>
                <td>${l.cuttinglist_markingtype}</td>
                <td>${l.cuttinglist_descripton}</td>
                <td>${l.cuttinglist_location}</td>
                <td>${l.cuttinglist_qty} - ${l.cuttinglist_qty_type}</td>
                <td>${l.cuttinglist_height}</td>
                <td>${l.cuttinglist_width}</td>
                <td>${l.cuttinglist_area}</td>
                <td>${l.cuttinglist_totarea}</td>
                <td>${l.cuttinglist_classrefno}</td>
                <td>${l.cuttinglist_sheettp}</td>
                <td>${l.cuttinglist_remarks}</td>
                <td>${l.cuttinglist_section}</td>                
                </tr>
                `;
            });
            print_datas += `</tbody>
            </table>
            </div>
            
            </div>`;
        })

        localStorage.removeItem('print_cuttinglistreport');
        localStorage.setItem('print_cuttinglistreport', print_datas);

        //print_cuttinglist.php
        var locationprint = print_location + "Print/print_cuttinglist.php";
        window.open(locationprint, '_blank', "width = '1300px', height = '700px'");
    }

    $scope.printResult = () => {
        let _p = [];
        let _data = [];

        gridOptions.api.forEachNodeAfterFilterAndSort(i=>{
            let _m = _p.includes(i.data.cuttinglist_project_id);
            if(!_m){
                _p.push(i.data.cuttinglist_project_id)
            }
            _data.push(i.data);
        });
        let fdata = [];
        _p.map(i=>{
            let pj = i;
            let pn = "";
            let arr = [];
            _data.map(j=>{
                if(j.cuttinglist_project_id === pj){
                    arr.push(j);
                    pn = j.project_name;
                }
            })

            fdata.push({
                pj,
                pn,
                arr,
            });
        });

        localStorage.clear('pms_cuttinglist');
        localStorage.setItem("pms_cuttinglist",JSON.stringify(fdata));
        var loc =  print_location + "print/printcuttinglist.html";
        window.open(loc, '_blank', "width = '1300px', height = '700px'");



    }


})