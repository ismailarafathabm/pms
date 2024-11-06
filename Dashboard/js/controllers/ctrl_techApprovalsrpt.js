app.controller('ctrl_techApprovalsrpt', function($scope, $http) {
    document.title = "TECHNICAL APROVAL REPORT - PMS"
    document.getElementById("rpt_project_tech").classList.add('menuactive');
    $scope.isloading = true;
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

        document.querySelector(".loadingdiv").style.height = bhbh + "px";
        document.querySelector(".loadingdiv").style.maxHeight = bhbh + "px";
        document.querySelector(".loadingdiv").style.maiHeight = bhbh + "px";

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

    var statusCheck = {
        'td-yellow': function(d) {
            return d.data.approvals_status === 'a'
        },
        'trgreen': function(d) {
            return d.data.approvals_status === 'b'
        },
        'trorange': function(d) {
            return d.data.approvals_status === 'x'
        }
    };

     // <a href="${site}assets/approvals/${p.data.approvals_token}.pdf" target="_blank" style="margin-right:10px">
                    //     <i class="fa fa-eye"></i>                        
                    // </a>
                    // <a href="${site}assets/approvals/${p.data.approvals_token}.pdf" download="${title}">
                    //     <img loading='lazy' src="${site}assets/pdfdownload.png?v=${v}"  style="width:18px;">
                    // </a>
    var columnDefs = [{
        headerName: 'Sl.No',
        field: 'sno',
            //cellRenderer: 'node.rowIndex + 1',
            valueGetter: "node.rowIndex + 1",
            filter: false,
            sortable: false,
            suppressMenu: false,
            width: 75,
            hide: true,
            cellClassRules: statusCheck,
            width:60,


        },
        {
            headerName: 'File',
            field: 'f',
            sortable: false,
            cellRenderer: function(p) {
                let title = `${p.data.approvals_remarks} # ${p.data.project_no}#${p.data.project_name}`;
                return p.data.approvals_status === 'b' ? `    
                <div style="display:flex">
                    <a href="${site}assets/approvals/${p.data.approvals_token}.pdf" download="${title}.pdf">
                   
                    <img loading='lazy' src="${site}assets/pdfdownload.png?v=${v}"  style="width:18px;">
                </a>
                </div>            
                ` : ``;
            },
            filter: false,
            width: 75,
            cellClassRules: statusCheck,
            width:70,

        },
        {
            headerName: 'Project No',
            field: 'project_no',
            sortingOrder: ['asc', 'desc'],
            cellClassRules: statusCheck,
            width: 90,
           
        },
        {
            headerName: 'Project No',
            field: 'project_name',
            sortingOrder: ['asc', 'desc'],
            cellClassRules: statusCheck,
            width:180,
        },
        {
            headerName: 'Approval Details',
            field: 'approval_type_name',
            sortingOrder: ['asc', 'desc'],
            cellClassRules: statusCheck,
            width:260,
        },
        {
            headerName: 'D.Approved',
            field: 'approvals_adate_s',
            cellRenderer: function(p) {
                return `<div>${p.data.approvals_adate}</div>`
            },
            sortingOrder: ['asc', 'desc'],
            cellClass: 'dateType_green',
            filter: 'agDateColumnFilter',
            filterParams: filterParams,
            sort: 'desc',
            cellClassRules: statusCheck,
            width:120,

        },
        {
            headerName: 'D.Released',
            field: 'approvals_rdate_s',
            cellRenderer: function(p) {
                return `<div>${p.data.approvals_rdate}</div>`
            },
            sortingOrder: ['asc', 'desc'],
            cellClass: 'dateType_green',
            filter: 'agDateColumnFilter',
            filterParams: filterParams,
            sort: 'desc',
            cellClassRules: statusCheck,
            width:120,

        },
        {
            headerName: 'Approval Remark',
            field: 'approvals_remarks',
            sortingOrder: ['asc', 'desc'],
            filter: 'agTextColumnFilter',
            cellClassRules: statusCheck,
            width: 420,
            autoHeight: true,
            wrapText: true,
        },
        {
            headerName: 'Status',
            sortingOrder: ['asc', 'desc'],
            field: 'approvals_status',
            cellRenderer: function(p) {
                var st = "";
                switch (p.data.approvals_status) {
                    case 'a':
                        st = 'A - Approval Not Released';
                        break;
                    case 'b':
                        st = 'B - Approval Released';
                        break;
                    case 'x':
                        st = 'x - Supersede';
                        break;

                }

                return st;
            },
            cellClassRules: statusCheck
        },
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
    getReport();

    function getReport() {
        let post_data = {
            naf_user: userinfo
        };
        const req = $http({
            method: "POST",
            data: post_data,
            url: api_url + "Approvals/index.php"
        });

        req.then(
            (res) => {
                if (res.data.msg === "1") {
                    console.log(res.data);
                    var gridDiv = document.querySelector('#myGrid');
                    new agGrid.Grid(gridDiv, gridOptions);
                    datas = res.data.data;
                    console.log(res.data.data);
                    gridOptions.api.setRowData(datas);

                    var allColumnIds = [];
                    gridOptions.columnApi.getAllColumns().forEach(function(column) {
                        allColumnIds.push(column.colId);
                    });

                    //gridOptions.columnApi.autoSizeColumns(allColumnIds, true);
                    $scope.isloading = false;
                } else {
                    alert(res.data.data);
                }
            }
        )
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
            var mname = `Technical Approvals Report AS ON DATE ${day}-${month}-${year}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName : FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }

    function _today() {
        let _d = new Date();
        let _day = _d.getDate();
        let _month = _d.getMonth() + 1;
        let _year = _d.getFullYear() ;
        let _disp = `${_day}-${_month}-${_year}`;
        return _disp.toString();
    }
    $scope.printResult = () => {
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
        console.log(_config[1]);
        let _bodywidth = _config[0].columnController.columnApi.columnController.columnApi.columnController.bodyWidth;
        let _columns = _config[0].columnController.columnApi.columnController.columnApi.columnController.autoRowHeightColumns;
        console.log(_columns);
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
        localStorage.setItem("pms_techapprovals_list", JSON.stringify(_data));
        localStorage.setItem("pms_techapprovals_config", JSON.stringify(fconfig));
        localStorage.setItem("pms_techapprovals_bodywidth", _bodywidth.toString());       
        const location = `${print_location}sprint/techapprovals.html`;
        //console.log(location);
        window.open(location, '_blank', "width:1300,height:600");     
    }
    $scope.printResultx = () => {       
        var _p = [];
        var _ap = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(ms => {
            switch (ms.data.approvals_status) {
                case 'a':
                    colorinfos = 'color :#494E00;background-color:#FCFFD4';
                    status = "A - Approval Not Released";
                    break;
                case 'b':
                    status = "B - Approval Released";
                    colorinfos = 'color :#007357;background-color:#dcfdf5';
                    break;
                case 'x':
                    status = "X - Supersede";
                    colorinfos = 'color :#ff3200;background-color:#fbedea';
                    break;
            }
            _ap.push({
                project_no: ms.data.project_no,
                project_name: ms.data.project_name,
                approval_type_name: ms.data.approval_type_name,
                approvals_adate: ms.data.approvals_adate,
                approvals_rdate: ms.data.approvals_rdate,
                approvals_remarks: ms.data.approvals_remarks,
                status: status,
                colorinfos: colorinfos,
            });

            var _h = _p.includes(ms.data.project_no);
            if (!_h) {
                _p.push(ms.data.project_no)
            }
        })

        _prt = [];

        _p.map(_i => {
            var prj = _i;
            var prjname = '';
            var prarr = [];
            _ap.map(_j => {
                if (_j.project_no === _i) {
                    prjname = _j.project_name;
                    prarr.push({
                        project_no: _j.project_no,
                        project_name: _j.project_name,
                        approval_type_name: _j.approval_type_name,
                        approvals_adate: _j.approvals_adate,
                        approvals_rdate: _j.approvals_rdate,
                        approvals_remarks: _j.approvals_remarks,
                        status: _j.status,
                        colorinfos: _j.colorinfos,
                    })
                }
            });
            _prt.push({
                prj: prj,
                prjname: prjname,
                prarr: prarr
            });
        });
        let prdata = "";
        let Cdate = _today();
        prdata += `
            <div class="top_title">TECHNICAL APPROVALS REPORTS AS ON DATE ${Cdate}</div>
        `;
        _prt.map(_p=>{
            prdata += `
                <div style="border: 1px dashed #1c58d1;
                padding: 3px;
                display: block;
                margin: 5px;">
                <div class="top_title _n">${_p.prj.toUpperCase()} - ${_p.prjname.toUpperCase()}</div>
            `;
            prdata +=`
                <div class="reportInfo">
                    <table class="rpt_table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="rpt_head">S.NO</th>
                            <th class="rpt_head">Approval Details</th>
                            <th class="rpt_head">D.Approval</th>
                            <th class="rpt_head">D.Released</th>
                            <th class="rpt_head">Approval Remark</th>
                            <th class="rpt_head">Status</th>
                        </tr>
                    </thead>
                    <tbody>`
                    _p.prarr.map((_t,index)=>{
                        let _themes = "";
                        if(_t.status === 'A - Approval Not Released')
                        _themes = "rowOrange";
                        else if(_t.status === 'B - Approval Released')
                        _themes = "rowGreen";
                        if(_t.status === 'X - Supersede')
                        _themes = "rowBlue";
                        else
                        _themes = "";
                        
                        prdata +=` <tr>
                            <td class="rpt_body ${_themes}" style="width:20px">${index+1}</td>
                            <td class="rpt_body ${_themes}" style="width:120px">${_t.approval_type_name}</td>
                            <td class="rpt_body ${_themes}" style="width:75px">${_t.approvals_adate}</td>
                            <td class="rpt_body ${_themes}" style="width:75px">${_t.approvals_rdate}</td>
                            <td class="rpt_body ${_themes}" style="width:500px">${_t.approvals_remarks}</td>
                            <td class="rpt_body ${_themes}" style="width:135px">${_t.status}</td>                            
                        </tr>`
                    })
         prdata +=` </tbody>
                    </table>
                </div>
                </div>
            `;
        });

        localStorage.setItem('rpt', prdata);
        var loc = print_location + "print/printw.html";
        window.open(loc, '_blank', width = '1300px', height = '800px');

        
        // _prt.map(_p => {
        //     print_datas += `
        //     <div class="main_div">            
        //         <div class="projectinfo">
        //         ${angular.uppercase(_p.prj)} -  ${angular.uppercase(_p.prjname)}            
        //         </div>
        //     <div class="variationfino">
        //         <table>
        //             <thead>
        //                 <tr>
        //                     <th class="fiexdheader">S.No</th>            
        //                     <th class="fiexdheader"> Approval Details</th>
        //                     <th class="fiexdheader">D.Approval</th>
        //                     <th class="fiexdheader"> D.Released</th>
        //                     <th class="fiexdheader">Approval Remark</th>
        //                     <th class="fiexdheader">Status</th>                    
        //                 </tr>
        //             </thead>
        //         <tbody>`;
        //     var sno = 0;
        //     _p.prarr.map(_t => {
        //         sno += 1;
        //         print_datas += `
        //         <tr>
        //             <td style="${_t.colorinfos};width:75px">${sno}</td>
        //             <td style="${_t.colorinfos};width:220px">${_t.approval_type_name}</td>
        //             <td style="${_t.colorinfos};width:85px">${_t.approvals_adate}</td>
        //             <td style="${_t.colorinfos};width:85px">${_t.approvals_rdate}</td>
        //             <td style="${_t.colorinfos};width:320px">${_t.approvals_remarks}</td>
        //             <td style="${_t.colorinfos};width:120px">${_t.status}</td>                    
        //         </tr>
        //         `;
        //     })
        //     print_datas += `</tbody>
        //          </table>
        //         </div>
        //     </div>
        //     `;
        // })

        // localStorage.removeItem('print_techapprovals');
        // localStorage.setItem('print_techapprovals', print_datas);

        // var locationprint = print_location + "Print/print_techapprovals.php";
        // window.open(locationprint, '_blank', "width = '1000px', height = '800px'");
    }
})