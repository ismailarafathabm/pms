app.controller('ctrl_shopdrawingApprovalsrpt', function ($scope, $http) {
    document.title = "DRAWING APPROVALS REPORT - PMS"
    document.getElementById("rpt_project_drawing").classList.add('menuactive');
    var site = print_location;
    window.addEventListener('resize', () => {
        maxbodyheight()
    })
    maxbodyheight();
    $scope.isloading = true;

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
    var statuscheck = {
        'trgreen': function (p) {
            return p.data.approvals_last_status === 'A'
        },
        'trgreen2': function (p) {
            return p.data.approvals_last_status === 'B'
        },
        'trred txt-red': function (p) {
            return p.data.approvals_last_status === 'C'
        },
        'trorange': function (p) {
            return p.data.approvals_last_status === 'D'
        },
        'tryellow2': function (p) {
            return p.data.approvals_last_status === 'H'
        },
        'trred2 txt-red': function (p) {
            return p.data.approvals_last_status === 'X'
        },
        'trblue': function (p) {
            return p.data.approvals_last_status === 'F'
        },
        'td-yellow': function (p) {
            return p.data.approvals_last_status === 'U'
        },
    }


    var columnDefs = [{
        headerName: 'Sl.No',
        field : "sno",
        //cellRenderer: 'node.rowIndex + 1',
        valueGetter: "node.rowIndex + 1",
        filter: false,
        sortable: false,
        suppressMenu: false,
        cellClassRules: statuscheck,
        width:65,

    },
    {
        headerName: 'File',
        field: 'f',
        sortable: false,
        cellRenderer: function (p) {
            let title = `${p.data.approvals_project_code} # DRAWING NO  ${p.data.approvals_draw_no}# RECEIVED DATE  ${p.data.approvals_infos_receivedon}`;

            return p.data.f === '1' ? `
                <a href="${site}assets/drawingapprovals/${p.data.approvals_last_revision_no}.pdf?v=${v}" download='${title}'>
                    <img loading='lazy' src="${site}assets/pdfdownload.png?v=${v}" style="width:18px;">
                </a>
                ` : ``;
        },
        filter: false,
        cellClassRules: statuscheck,
        width:70,

    },
    {
        headerName: 'Project No',
        field: 'approvals_project_code',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
        width:70,
    },
    {
        headerName: 'Project Name',
        field: 'project_name',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
        width:152,
    },
    {
        headerName: 'Approval For',
        field: 'types_name',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
        width:200,
    },
    {
        headerName: 'Drawing No',
        field: 'approvals_draw_no',
        filter: 'agTextColumnFilter',
        cellRenderer: function (p) {
            return `
                <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" onclick="Revision_btnList('${p.data.approvals_project_code}','${p.data.approvals_token}','${p.data.approvals_draw_no}')">
                    ${p.data.approvals_draw_no}
                </button> `;
        },
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
        width:220,
    },
    {
        headerName: 'Code',
        field: 'approvals_last_status',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
        width:60,
    },
    {
        headerName: 'Description',
        field: 'approvals_descriptions',
        filter: 'agTextColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
        width:553,
    },
    {
        headerName: 'Rev #',
        field: 'approvals_last_revision_code',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
        width:53,
    },
    {
        headerName: 'SUB #',
        field: 'approvals_infos_sub',
        filter: 'agTextColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
        width:214,
    },
    {
        headerName: 'Submitted On',
        field: 'approvals_infos_submitedon',
        cellRenderer: function (p) {
            return `<div>${p.data.approvals_infos_submitedon_d}</div>`
        },
        sortingOrder: ['asc', 'desc'],
        cellClass: 'dateType_green',
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        cellClassRules: statuscheck,
        sort: 'desc',
        width:120,

    },
    {
        headerName: 'Received On',
        field: 'approvals_infos_receivedon',
        sortingOrder: ['asc', 'desc'],
        cellRenderer: function (p) {
            return `<div>${p.data.approvals_infos_receivedon_d}</div>`
        },
        cellClass: 'dateType_green',
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        cellClassRules: statuscheck,
        width:120,
    },
    {
        headerName: 'Client Sign On',
        field: 'approvals_infos_clienton_d',
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
        width:120,
    },
    {
        headerName: 'Recived Delay',
        field: 'daysn',
        filter: 'agNumberColumnFilter',
        cellRenderer: function (p) {
            return p.data.delayclient
        },
        sortingOrder: ['asc', 'desc'],
        cellClassRules: statuscheck,
        width:80,
    },
        // {
        //     headerName: ' Delay From Clients ',
        //     field: 'delayclientn',
        //     filter: 'agNumberColumnFilter',
        //     cellRenderer: function(p) {
        //         return p.data.delayclients
        //     },
        //     sortingOrder: ['asc', 'desc'],
        //     cellClassRules: statuscheck,
        // },
    ];
    var gridOptions = {
        suppressContextMenu: true,
        columnDefs: columnDefs,
        enableCellChangeFlash: true,
        defaultColDef: {
            autoHeight: true,
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





    // NewGetReport();
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    const p1 = fetch(`${api_url}/DrawingApprovals/speedcode/index.php?user_name=${userinfo.user_name}&user_token=${userinfo.user_token}`);
    p1.then(res => res.json()).then(res => {
        console.log(res.data);

        test(res.data);
        // cl(res.data)
    });

    function test(ds) {
        console.log(ds);
        let _d = [];
        let n = [];
        let x = ds;
        let dv = 100;
        let reqc = parseInt((+x) / (+dv));
        let s = 0;
        let f = 0

        for (var i = 0; i < reqc; i++) {
            if (i === 0) {
                s = 0;
                n.push({
                    s,
                    f
                });
                s = 100;
                n.push({
                    s,
                    f
                });
            } else {
                s += (+dv);
                n.push({
                    s,
                    f
                });
            }
        }

        if (s < ds) {
            let x = ds - s;
            s += x;
            n.push({
                s,
                f
            });
        }



        let req = n.map(
            limit => fetch(`${api_url}DrawingApprovals/speedcode/all.php?kstart=${limit.s}&kend=${limit.f}`)
        );

        req.forEach(r => {
            r.then(resp => resp.json()).then(
                res => {
                    if (res.msg === "1") {
                        //console.log(res.data);
                        res.data.forEach(i => {
                            _d.push(i);
                        })
                        gridOptions.api.setRowData(_d);
                        $scope.$apply();
                    }
                }
            )
        })
        $scope.$apply();
    }



    // function NewGetReport() {
    //     let post_data = {
    //         naf_user: userinfo
    //     }
    //     var req = $http.post(api_url + "DrawingApprovals/rpt1.php", post_data);
    //     req.then(res => {
    //         //console.log(res.data);
    //         if (res.data.msg === "1") {
    //             var gridDiv = document.querySelector('#myGrid');
    //             new agGrid.Grid(gridDiv, gridOptions);
    //             datas = res.data.data;
    //             console.log(res.data.data);
    //             gridOptions.api.setRowData(datas);
    //             var allColumnIds = [];
    //             gridOptions.columnApi.getAllColumns().forEach(function(column) {
    //                 allColumnIds.push(column.colId);
    //             });

    //             gridOptions.columnApi.autoSizeColumns(allColumnIds, false);
    //             $scope.isloading = false;
    //         } else {
    //             alert(res.data.data);
    //         }
    //     });
    // }

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
            var mname = `SHOP DRAWING REPORT AS ON DATE ${day}-${month}-${year}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: mname,
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }

    $scope.Revision_btnList = (pcode, ptoken, dno) => {
        console.log('working');
        $scope._drawingno = dno;
        document.getElementById('revision_list').style.display = 'block';
        let post_data = {
            naf_user: userinfo,
            project_no: pcode,
            drawing_no: ptoken
        };

        $http.post(api_url + "DrawingApprovals/getAllrevisions.php", post_data)
            .then(
                function (res) {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        $scope.revision_list = res.data.data;
                    } else {
                        alert(res.data.data);
                    }
                }
            )

    }

   

    function _today() {
        let _d = new Date();
        let _day = _d.getDate();
        let _month = _d.getMonth() + 1;
        let _year = _d.getFullYear();
        let _disp = `${_day}-${_month}-${_year}`;
        return _disp.toString();
    }
    $scope.printResulttest = () => {
        let _data = [];    
        let _config = []
        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _data.push(_.data);
            _config.push(_);
        })     
        if (_data.length === 0) {
            alert("No data found");
            return;
        }
        if (_data.length > 4000) {
            alert("Out of memmory")
            return;
        }
        //console.log(_config[1]);
        let _bodywidth = _config[0].columnController.columnApi.columnController.columnApi.columnController.bodyWidth;
        let _columns = _config[0].columnController.columnApi.columnController.columnApi.columnController.autoRowHeightColumns;
       // console.log(_columns);
        let fconfig = [];
        _columns.map((i) => {
            let cconf = {
                colid: i.colId,
                colwidth: i.actualWidth,
                colshow: i.visible,
                colname: i.userProvidedColDef.headerName
            };
            fconfig.push(cconf);
        });
        localStorage.setItem("pms_drawingapprovals_list", JSON.stringify(_data));
        localStorage.setItem("pms_drawingapprovals_config", JSON.stringify(fconfig));
        localStorage.setItem("pms_drawingapprovals_width", _bodywidth.toString());       
        const location = `${print_location}sprint/drawingapprovals.html`;
        //console.log(location);
        window.open(location, '_blank', "width:1300,height:600"); 
    }
    


    function len(str) {
        // Creating new Blob object and passing string into it 
        // inside square brackets and then 
        // by using size property storin the size 
        // inside the size variable
        let size = new Blob([str]).size;
        return size;
    }


})


function Revision_btnList(pcode, ptoken, dno) {

    let post_data = {
        naf_user: userinfo,
        project_no: pcode,
        drawing_no: ptoken
    };
    document.getElementById('revision_list').style.display = 'block';

    const req = fetch(api_url + "DrawingApprovals/getAllrevisions.php", {
        method: 'post',
        body: JSON.stringify(post_data)
    });

    req.then(resp => resp.json()).then(
        res => {
            console.log(res);
            var scope = angular.element(document.getElementById("revision_list")).scope();
            scope.revision_list = res.data;
            scope._drawingno = dno;
            scope.$apply();
        }
    )
}