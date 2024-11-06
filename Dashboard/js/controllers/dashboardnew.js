app.controller('dashboardcontrollernew', ['$scope', '$http','$compile', function ($scope, $http,$compile) {
    console.log("its working");
    $scope.ctitle = "PROJECT LIST";
    document.title = "PROJECT LIST - PMS"
    // const inputs = document.querySelectorAll("input");
    // inputs.forEach(i => {
    //     i.autocomplete = "off";
    // })
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
    $scope.isloading = true;
    document.getElementById("rpt_project").classList.add('menuactive');
    $("#back_btn").on('click', function () {
        window.history.back();
    })

    sessionStorage.clear('nafco_project_current');
    var post_data = {
        naf_user: userinfo
    }
    var url = api_url + "Project/index.php";
    all_techApprovalsType();

    function all_techApprovalsType() {
        let post_data = {
            naf_user: userinfo
        };
        $http({
            method: 'post',
            data: post_data,
            url: api_url + "Approval_Type/index.php"
        }).then(
            function (res) {
                console.log(res.data);
                if (res.data.msg === "1") {
                    $scope.menu_Techapprovals = res.data.data;
                } else {
                    alert(res.data.data);
                }
                $scope.isloading = false;
            }
        )
    }
    //grid option set
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
        /// <div style="width:20"></div>
        // <button type="button" class="ism-btns btn-normal" style="padding:2px 5px">
        //     <i class="fa fa-pencil"></i>
        //     Edit Quotation
        // </button>
    };
    let pdfAccess = false;
    let pdfUsers = ['superadmin', 'it', 'operation', 'estimate', 'accounts', 'Management', 'contract and operations','admin'];



    pdfUsers.forEach((i) => {
        if (i === userinfo.user_dep) {
            pdfAccess = true;
        }
    })

    if (userinfo.user_name === 'wagdy') {
        pdfAccess = true;
    }
    console.log("start");
    var columndef = [];

    if (pdfAccess === true) {
        columndef.push({
            headerName: '',
            cellRenderer: function (p) {
                return p.data.f === '1' ? `
                <a href="${print_location}assets/contract/${p.data.project_no_enc}.pdf" download="${p.data.project_no}#${p.data.project_name} - CONTRACT " class="link">
                    <img src="${print_location}assets/pdfdownload.png?v=${v}" style="width:15px;"/>
                </a>
                ` : '-';
            },
            width: 50,
            headerClass: 'green-leaves',
            filter: false,
            pinned: 'left'
        })
    }

    columndef.push({
        headerName: 'Contract No',
        field: 'projectsnodisp',
        filter: 'agTextColumnFilter',
        cellRenderer: function (p) {
            return `
            <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" onclick="goproject('${p.data.project_no_enc}','${p.data.project_id}')">
                <div>${p.data.project_no.toUpperCase()}</div>
            </button>
           
            `;
        },
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',
        sort: 'desc',
        hide: true,
    })

    const budgetaccess_users = ['demo','sam', 'nimnim', 'estimation', 'estimations', 'procurement', 'nabil', 'hani','admin'];
    const budgetaccess = budgetaccess_users.includes(userinfo.user_name);
    if (budgetaccess) {
        columndef.push({
            headerName: 'Contract No',
            field: 'project_no',
            cellRenderer: function (p) {
                return `
            <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" onclick="goproject('${p.data.project_no_enc}','${p.data.project_id}')">
                ${p.data.project_no.toUpperCase()}
            </button>
            <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" onclick="goprojectbudget('${p.data.project_no_enc}','${p.data.project_id}')">
            <i class="fa fa-usd"></i> Budget            
        </button>
            `;
            },
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
            width: 150,
            headerClass: 'green-leaves',
            cellClass: 'yellow-leaves',
            pinned: 'left'
        })
    } else {
        columndef.push({
            headerName: 'Contract No',
            field: 'project_no',
            cellRenderer: function (p) {
                return `
            <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" onclick="goproject('${p.data.project_no_enc}','${p.data.project_id}')">
                ${p.data.project_no.toUpperCase()}
            </button>
           
            `;
            },
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
            width: 150,
            headerClass: 'green-leaves',
            cellClass: 'yellow-leaves',
            pinned: 'left'
        })
    }
    columndef.push({
        headerName: 'Project Name',
        field: 'project_name',
        width: 500,
        cellRenderer: function (p) {
            return `
            <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" onclick="goproject('${p.data.project_no_enc}','${p.data.project_id}')">
                ${p.data.project_name.toUpperCase()}
            </button>
            `;
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',
        pinned: 'left'

    })

    columndef.push({
        headerName: 'Contractor Name',
        field: 'project_cname',
        filter: 'agMultiColumnFilter',
        width: 500,
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })
    columndef.push({
        headerName: 'Engineering',
        children : EnggCols(),
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })
    columndef.push({
        headerName: 'Location',
        field: 'project_location',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })
    if (pdfAccess) {
        columndef.push({
            headerName: 'Contract Value',
            field: 'project_amount',
            cellRenderer: (p) => { return (+p.data.project_amount).toLocaleString(2) },
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
            headerClass: 'green-leaves',
            cellClass: 'yellow-leaves numcells',

        })
    }
    columndef.push({
        headerName: 'Sales Man',
        field: 'Sales_Representative',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })

    columndef.push({
        headerName: 'Sign Date',
        field: 'project_singdate_s',
        cellRenderer: function (d) {
            return `<div>${d.data.project_singdate_d}</div>`
        },
        sortingOrder: ['asc', 'desc'],
        sort: 'desc',
        // sortIndex: 0,
        width: 150,
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })

    columndef.push({
        headerName: 'Duration (MONTHS)',
        field: 'project_contract_duration',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })


    columndef.push({
        headerName: 'Expiry Date',
        field: 'project_expiry_date',
        cellRenderer: function (d) {
            return `<div>${d.data.project_expiry_date}</div>`
        },
        sortingOrder: ['asc', 'desc'],
        sort: 'desc',
        // sortIndex: 0,
        width: 150,
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })

    columndef.push({
        headerName: 'Technical %',
        cellRenderer: function (d) {
            return `-`
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })

    //engineering new code

    function EnggCols() {
        let engg_cols = [];

        engg_cols.push(
            {
                headerName: "Qty",
                field: 'cutting_qty',
                cellRenderer: (p) => (+p.data.cutting_qty) === 0 ? '-' : $compile(`
                <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" ng-click="goprojectcuttinglist('${p.data.project_no_enc}','${p.data.project_id}')">
                    ${(+p.data.cutting_qty).toLocaleString(undefined,{maximumFractionDigits:2})}
                </button>
                `)($scope)[0],
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 100 
            }
        )
    
        engg_cols.push(
            {
                headerName: "Area",
                field: 'ctarea',
                cellRenderer: (p) => (+p.data.ctarea) === 0 ? '-' : $compile(`
                <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" ng-click="goprojectcuttinglist('${p.data.project_no_enc}','${p.data.project_id}')">
                    ${(+p.data.ctarea).toLocaleString(undefined,{maximumFractionDigits:2})}
                </button>
                `)($scope)[0],
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 100 
            }
        )

        return engg_cols;
    }

   

    columndef.push({
        headerName: 'Production %',
        cellRenderer: function (d) {
            return `-`
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })

    columndef.push({
        headerName: 'Total %',
        cellRenderer: function (d) {
            return `-`
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })

    columndef.push({
        headerName: 'Hand Over',
        field: 'project_hadnover',
        cellRenderer: function (p) {
            let _status = "";
            if (p.data.project_hadnover === '1')
                _status = "Initial Handing Over";
            else if (p.data.project_hadnover === "2")
                _status = "Partial Handing Over";
            else if (p.data.project_hadnover === "3")
                _status = "Final Handing Over";
            else
                _status = "-";

            return `<div>${_status}</div>`
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })

    columndef.push({
        headerName: 'Hand Over Date',
        field: 'project_handover_date_s',
        cellRenderer: function (d) {
            return d.data.project_hadnover === '0' ? '-' : d.data.project_handover_date_d;
        },
        sortingOrder: ['asc', 'desc'],
        sort: 'desc',
        // sortIndex: 0,
        width: 150,
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })

    // gridOptions.api.refreshClientSideRowModel('sort');
    // gridOptions.api.refreshClientSideRowModel('filter');





    var gridOptions = {
        suppressContextMenu: true,
        columnDefs: columndef,
        enableCellChangeFlash: true,
        defaultColDef: {
            resizable: true,
            autoHeight: true,
            sortable: true,
            filter: true,
            floatingFilter: true,
            wrapText: true,
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
        rowHeight: 35,

    };
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    $scope.clearFilters = () => {
        filterClear();
    }
    function filterClear() {

        gridOptions.columnApi.applyColumnState({
            state: [{ colId: 'projectsnodisp', sort: 'desc' }],
            defaultState: { sort: null },
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
            var mname = `PROJECT LIST AS ON DATE ${day}-${month}-${year}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }
    //grid option set
    getAllProjects();
    function getAllProjects() {
        $http.post(url, post_data).then(
            function (res) {
                console.log(res.data);
                if (res.data.msg === "1") {
                    gridOptions.api.setRowData(res.data.data);
                    // $scope._projects = res.data.data;
                } else {
                    if (res.data.data === "Access Error") {
                        alert("This user ID already Login Another Pc \n Please Re-Login...");
                        _logout();
                    }
                }

            }
        );
    }

    function _today() {
        let _d = new Date();
        let _day = _d.getDate();
        let _month = _d.getMonth() + 1;
        let _year = _d.getFullYear();
        let _disp = `${_day}-${_month}-${_year}`;
        return _disp.toString();
    }
    $scope.printAll = () => {
        let pData = [];

        gridOptions.api.forEachNodeAfterFilterAndSort((i) => {
            pData.push(i.data);

        });


        //    localStorage.setItem('page_title',_title);
        if (pData.length === 0) {

        } else {
            let prdata = "";
            let Cdate = _today();
            prdata += `
        <div class="top_title">PROJECT LIST AS ON DATE ${Cdate}</div>
        <div class="reportInfo">
            <table class="rpt_table">
                <thead>
                    <tr>
                        <th class="rpt_head">S.NO</th>
                        <th class="rpt_head">Contract No</th>
                        <th class="rpt_head">Project Name</th>
                        <th class="rpt_head">Contractor Name</th>
                        <th class="rpt_head">Location</th>`
            if (pdfAccess) {
                prdata += `<th class="rpt_head">Contract Value</th>`;
            }
            prdata += ` <th class="rpt_head">Sales Man</th>
                        <th class="rpt_head">Sign Date</th>
                        <th class="rpt_head">Duration</th>
                        <th class="rpt_head">Expiry Date</th>
                        <th class="rpt_head">Technical (%)</th>
                        <th class="rpt_head">Engineering (%)</th>
                        <th class="rpt_head">Production (%)</th>
                        <th class="rpt_head">Total (%)</th>                        
                        <th class="rpt_head">Hand Over</th>
                        <th class="rpt_head">Hand Over Date</th>
                    </tr>
                </thead>
                <tbody>`
            pData.map((i, index) => {
                let _themes = "";

                if (i.project_hadnover === '0')
                    _themes = "rowRed";
                else if (i.project_hadnover === '1')
                    _themes = "rowOrange";
                else if (i.project_hadnover === '2')
                    _themes = "rowBlue";
                else if (i.project_hadnover === '3')
                    _themes = "rowGreen";
                else
                    _themes = "";

                prdata += `
                    <tr>
                        <td class="rpt_body ${_themes}">${index + 1}</td>
                        <td class="rpt_body ${_themes}">${i.project_no.toUpperCase()}</td>
                        <td class="rpt_body ${_themes}">${i.project_name}</td>
                        <td class="rpt_body ${_themes}">${i.project_cname}</td>
                        <td class="rpt_body ${_themes}">${i.project_location}</td>`
                if (pdfAccess) {
                    prdata += `<td class="rpt_body ${_themes} t_right t_bold">${i.project_amount}</td>`
                }
                prdata += `<td class="rpt_body ${_themes}">${i.Sales_Representative}</td>
                        <td class="rpt_body ${_themes}" style="width:75px">${i.project_singdate_d}</td>
                        <td class="rpt_body ${_themes}">${i.project_contract_duration}</td>
                        <td class="rpt_body ${_themes}" style="width:75px">${i.project_expiry_date}</td>
                        <td class="rpt_body ${_themes}">-</td>
                        <td class="rpt_body ${_themes}">-</td>
                        <td class="rpt_body ${_themes}">-</td>
                        <td class="rpt_body ${_themes}">-</td>
                        
                        <td class="rpt_body ${_themes}">-</td>
                        <td class="rpt_body ${_themes}">-</td>
                    </tr>                    
                    `;
            })

            prdata += `</tbody>
            </table>
        </div>
        `;
            localStorage.setItem('rpt', prdata);
            var loc = print_location + "print/printw.html";
            window.open(loc, '_blank', width = '1300px', height = '800px');
        }



    }




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
        var bh = wsize - 110 - 60;
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


        // document.querySelector(".naf-tables").style.height = bhbhbh + "px";
        // document.querySelector(".naf-tables").style.maxHeight = bhbhbh + "px";
        // document.querySelector(".naf-tables").style.maiHeight = bhbhbh + "px";

    }


    $scope.manpower_summaryreport = () => {
        var sdate = $('#date_search').val();
        var edate = $('#date_search1').val();
        var url = `http://172.0.1.5:8082/EMS//print/psmsummary.php?s=${sdate}&e=${edate}`;
        window.open(url, '_blank', 'widht=1300px;height=600px');
    }


    $scope.xerror = false;
    $("input[name='advance_amount_remark']").css('color', "red");
    $("input[name='project_first_advance']").css('color', "red");
    $(".fa-check").css('color', "red");


    $scope.save_project = function () {
        clc();
        var _svdata = {
            naf_user: userinfo,
            _frmdata: $scope.newproject,
            _conditions: $scope._condition,
            _terms: $scope._terms
        };
        var req = $http.post(api_url + "Project/new.php", _svdata);
        req.then(function (res) {
            if (res.data.msg === "1") {
                alert("saved");
                reload();
            } else {
                alert(res.data.data);
            }
        })
    }

    $scope.calc_f1 = function () {
        var __presentage = parseFloat($scope.newproject.project_first_advance_amount);
        var __amount = parseFloat($scope.newproject.project_amount);
        if (__presentage > __amount) {
            $scope.xerror = false;

        } else {
            $scope.xerror = true;
        }
        clc()
    }

    $scope.calc_f2 = function () {
        clc()
    }
    $scope.clcvalues = function () {
        var __presentage = parseFloat($scope.newproject.project_basicpayment);
        if (__presentage <= 100) {
            $scope.xerror = true;
        } else {
            $scope.xerror = false;
        }
        clc();
    }

    function clc() {
        if (!$scope.newproject.project_amount || $scope.newproject.project_amount == "" || !$scope.newproject.project_first_advance_amount || $scope.newproject.project_first_advance_amount == "" || !$scope.newproject.project_basicpayment || $scope.newproject.project_basicpayment == "") {
            $scope.newproject.project_first_advance = 0;
            $scope.ckcolors = "text-danger";
            $scope.bgcolor = "bg-danger";
            $scope.newproject.advance_amount_remark = "Advance Payment Not Completed";
        } else {
            var __amount = parseFloat($scope.newproject.project_amount);
            var __presentage = parseFloat($scope.newproject.project_first_advance_amount);
            var presentage = parseFloat(calcss(__amount, __presentage));
            $scope.newproject.project_first_advance = presentage;
            var _mini = parseInt($scope.newproject.project_basicpayment);
            if (_mini <= presentage) {
                $scope.ckcolors = "color:green";
                $scope.bgcolor = "bg-success";
                $("input[name='advance_amount_remark']").css('color', "green");
                $("input[name='project_first_advance']").css('color', "green");
                $(".fa-check").css('color', "green");
                $scope.newproject.advance_amount_remark = "Advance Payment Completed";
            } else {
                $("input[name='advance_amount_remark']").css('color', "red");
                $("input[name='project_first_advance']").css('color', "red");
                $(".fa-check").css('color', "red");
                $scope.newproject.advance_amount_remark = "Advance Payment Not Completed";
            }
        }
    }

    $scope.goprojectcuttinglist = (pid, psno) => {
        sessionStorage.clear('nafco_project_current');
        sessionStorage.clear('nafco_project_current_sno');
        sessionStorage.setItem('nafco_project_current', pid);
        sessionStorage.setItem('nafco_project_current_sno', psno);
        if (userinfo.user_name === "eng_carlo") {
            location.href = `${print_location}/Dashboard/Main/index.php#!/cuttinglistsp`;
        } else {
            location.href = `${print_location}/Dashboard/Main/index.php#!/cuttinglistsusersp`;
        }
    }

}])






app.controller('dashboardcontrollernewv', ['$scope', '$http','$compile', function ($scope, $http,$compile) {
    //console.log("its working");
    document.title = "VILLA PROJECT LIST - PMS"
    const inputs = document.querySelectorAll("input");
    inputs.forEach(i => {
        i.autocomplete = "off";
    })
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
    $scope.isloading = true;
    document.getElementById("rpt_projectv").classList.add('menuactive');
    $("#back_btn").on('click', function () {
        window.history.back();
    })

    sessionStorage.clear('nafco_project_current');
    var post_data = {
        naf_user: userinfo
    }
    var url = api_url + "Project/indexx.php";
    all_techApprovalsType();

    function all_techApprovalsType() {
        let post_data = {
            naf_user: userinfo
        };
        $http({
            method: 'post',
            data: post_data,
            url: api_url + "Approval_Type/index.php"
        }).then(
            function (res) {
                console.log(res.data);
                if (res.data.msg === "1") {
                    $scope.menu_Techapprovals = res.data.data;
                } else {
                    alert(res.data.data);
                }
                $scope.isloading = false;
            }
        )
    }
    //grid option set
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
        /// <div style="width:20"></div>
        // <button type="button" class="ism-btns btn-normal" style="padding:2px 5px">
        //     <i class="fa fa-pencil"></i>
        //     Edit Quotation
        // </button>
    };
    let pdfAccess = false;
    let pdfUsers = ['superadmin', 'it', 'operation', 'estimate', 'accounts', 'Management', 'contract and operations','admin'];

    pdfUsers.forEach((i) => {
        if (i === userinfo.user_dep) {
            pdfAccess = true;
        }
    })
    if (userinfo.user_name === 'wagdy') {
        pdfAccess = true;
    }

    var columndef = [];

    if (pdfAccess === true) {
        columndef.push({
            headerName: '',
            cellRenderer: function (p) {
                return p.data.f === '1' ? `
                <a href="${print_location}assets/contract/${p.data.project_no_enc}.pdf" download="${p.data.project_no}#${p.data.project_name} - CONTRACT " class="link">
                    <img src="${print_location}assets/pdfdownload.png?v=${v}" style="width:15px;"/>
                </a>
                ` : '-';
            },
            width: 50,
            headerClass: 'green-leaves',
            filter: false,
            pinned: 'left'
        })
    }
   
    columndef.push({
        headerName: 'Contract No',
        field: 'projectsnodisp',
        filter: 'agMultiColumnFilter',
        cellRenderer: function (p) {
            return `
            <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" onclick="goproject('${p.data.project_no_enc}','${p.data.project_id}')">
                <div>${p.data.project_no.toUpperCase()}</div>
            </button>
            `;
        },
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',
        sort: 'desc',
        hide: true,
    })

    const budgetaccess_users = ['demo','sam', 'nimnim', 'estimation', 'estimations', 'procurement', 'nabil', 'hani','admin'];
    const budgetaccess = budgetaccess_users.includes(userinfo.user_name);
    if (budgetaccess) {
        columndef.push({
            headerName: 'Contract No',
            field: 'project_no',
            cellRenderer: function (p) {
                return `
            <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" onclick="goproject('${p.data.project_no_enc}','${p.data.project_id}')">
                ${p.data.project_no.toUpperCase()}
            </button>
            <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" onclick="goprojectbudget('${p.data.project_no_enc}','${p.data.project_id}')">
            <i class="fa fa-usd"></i> Budget            
        </button>
            `;
            },
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
            width: 190,
            headerClass: 'green-leaves',
            cellClass: 'yellow-leaves',
            pinned: 'left'
        })
    } else {
        columndef.push({
            headerName: 'Contract No',
            field: 'project_no',
            cellRenderer: function (p) {
                return `
            <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" onclick="goproject('${p.data.project_no_enc}','${p.data.project_id}')">
                ${p.data.project_no.toUpperCase()}
            </button>
           
            `;
            },
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
            width: 150,
            headerClass: 'green-leaves',
            cellClass: 'yellow-leaves',
            pinned: 'left'
        })
    }
    // columndef.push({
    //     headerName: 'Contract No',
    //     field: 'project_no',
    //     cellRenderer: function (p) {
    //         return `
    //         <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" onclick="goproject('${p.data.project_no_enc}','${p.data.project_id}')">
    //             ${p.data.project_no.toUpperCase()}
    //         </button>
    //         `;
    //     },
    //     filter: 'agMultiColumnFilter',
    //     sortingOrder: ['asc', 'desc'],
    //     width: 120,
    //     headerClass: 'green-leaves',
    //     cellClass: 'yellow-leaves',
    //     pinned: 'left'
    // })
    columndef.push({
        headerName: 'Project Name',
        field: 'project_name',
        width: 500,
        cellRenderer: function (p) {
            return `
            <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" onclick="goproject('${p.data.project_no_enc}','${p.data.project_id}')">
                ${p.data.project_name.toUpperCase()}
            </button>
            `;
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',
        pinned: 'left'

    })

    columndef.push({
        headerName: 'Contractor Name',
        field: 'project_cname',
        filter: 'agMultiColumnFilter',
        width: 500,
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })
    columndef.push({
        headerName: 'Engineering',
        children : EnggCols(),
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })
    columndef.push({
        headerName: 'Location',
        field: 'project_location',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })
    if (pdfAccess) {
        columndef.push({
            headerName: 'Contract Value',
            field: 'project_amount',
            filter: 'agMultiColumnFilter',
            sortingOrder: ['asc', 'desc'],
            headerClass: 'green-leaves',
            cellClass: 'yellow-leaves',

        })
    }
    columndef.push({
        headerName: 'Sales Man',
        field: 'Sales_Representative',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })

    columndef.push({
        headerName: 'Sign Date',
        field: 'project_singdate_s',
        cellRenderer: function (d) {
            return `<div>${d.data.project_singdate_d}</div>`
        },
        sortingOrder: ['asc', 'desc'],
        sort: 'desc',
        // sortIndex: 0,
        width: 150,
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })

    columndef.push({
        headerName: 'Duration (MONTHS)',
        field: 'project_contract_duration',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })


    columndef.push({
        headerName: 'Expiry Date',
        field: 'project_expiry_date',
        cellRenderer: function (d) {
            return `<div>${d.data.project_expiry_date}</div>`
        },
        sortingOrder: ['asc', 'desc'],
        sort: 'desc',
        // sortIndex: 0,
        width: 150,
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })

    columndef.push({
        headerName: 'Technical %',
        cellRenderer: function (d) {
            return `-`
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })



   function EnggCols() {
        let engg_cols = [];

        engg_cols.push(
            {
                headerName: "Qty",
                field: 'cutting_qty',
                cellRenderer: (p) => (+p.data.cutting_qty) === 0 ? '-' : $compile(`
                <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" ng-click="goprojectcuttinglist('${p.data.project_no_enc}','${p.data.project_id}')">
                    ${(+p.data.cutting_qty).toLocaleString(undefined,{maximumFractionDigits:2})}
                </button>
                `)($scope)[0],
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 100 
            }
        )
    
        engg_cols.push(
            {
                headerName: "Area",
                field: 'ctarea',
                cellRenderer: (p) => (+p.data.ctarea) === 0 ? '-' : $compile(`
                <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" ng-click="goprojectcuttinglist('${p.data.project_no_enc}','${p.data.project_id}')">
                    ${(+p.data.ctarea).toLocaleString(undefined,{maximumFractionDigits:2})}
                </button>
                `)($scope)[0],
                sortingOrder: ['asc', 'desc'],
                filter: 'agMultiColumnFilter',
                width: 100 
            }
        )

        return engg_cols;
    }

   

    columndef.push({
        headerName: 'Production %',
        cellRenderer: function (d) {
            return `-`
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })

    columndef.push({
        headerName: 'Total %',
        cellRenderer: function (d) {
            return `-`
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })

    columndef.push({
        headerName: 'Hand Over',
        field: 'project_hadnover',
        cellRenderer: function (p) {
            let _status = "";
            if (p.data.project_hadnover === '1')
                _status = "Initial Handing Over";
            else if (p.data.project_hadnover === "2")
                _status = "Partial Handing Over";
            else if (p.data.project_hadnover === "3")
                _status = "Final Handing Over";
            else
                _status = "-";

            return `<div>${_status}</div>`
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })

    columndef.push({
        headerName: 'Hand Over Date',
        field: 'project_handover_date_s',
        cellRenderer: function (d) {
            return d.data.project_hadnover === '0' ? '-' : d.data.project_handover_date_d;
        },
        sortingOrder: ['asc', 'desc'],
        sort: 'desc',
        // sortIndex: 0,
        width: 150,
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',

    })

    // gridOptions.api.refreshClientSideRowModel('sort');
    // gridOptions.api.refreshClientSideRowModel('filter');





    var gridOptions = {
        suppressContextMenu: true,
        columnDefs: columndef,
        enableCellChangeFlash: true,
        defaultColDef: {
            resizable: true,
            autoHeight: true,
            sortable: true,
            filter: true,
            floatingFilter: true,
            wrapText: true,
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
        rowHeight: 35,

    };
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    $scope.clearFilters = () => {
        filterClear();
    }
    function filterClear() {

        gridOptions.columnApi.applyColumnState({
            state: [{ colId: 'projectsnodisp', sort: 'desc' }],
            defaultState: { sort: null },
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
            var mname = `PROJECT LIST AS ON DATE ${day}-${month}-${year}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }
    //grid option set
    getAllProjects();
    function getAllProjects() {
        $http.post(url, post_data).then(
            function (res) {
                console.log(res.data);
                if (res.data.msg === "1") {
                    gridOptions.api.setRowData(res.data.data);
                    // $scope._projects = res.data.data;
                } else {
                    if (res.data.data === "Access Error") {
                        alert("This user ID already Login Another Pc \n Please Re-Login...");
                        _logout();
                    }
                }

            }
        );
    }

    function _today() {
        let _d = new Date();
        let _day = _d.getDate();
        let _month = _d.getMonth() + 1;
        let _year = _d.getFullYear();
        let _disp = `${_day}-${_month}-${_year}`;
        return _disp.toString();
    }
    $scope.printAll = () => {
        let pData = [];

        gridOptions.api.forEachNodeAfterFilterAndSort((i) => {
            pData.push(i.data);

        });


        //    localStorage.setItem('page_title',_title);
        if (pData.length === 0) {

        } else {
            let prdata = "";
            let Cdate = _today();
            prdata += `
        <div class="top_title">PROJECT LIST AS ON DATE ${Cdate}</div>
        <div class="reportInfo">
            <table class="rpt_table">
                <thead>
                    <tr>
                        <th class="rpt_head">S.NO</th>
                        <th class="rpt_head">Contract No</th>
                        <th class="rpt_head">Project Name</th>
                        <th class="rpt_head">Contractor Name</th>
                        <th class="rpt_head">Location</th>`
            if (pdfAccess) {
                prdata += `<th class="rpt_head">Contract Value</th>`;
            }
            prdata += ` <th class="rpt_head">Sales Man</th>
                        <th class="rpt_head">Sign Date</th>
                        <th class="rpt_head">Duration</th>
                        <th class="rpt_head">Expiry Date</th>
                        <th class="rpt_head">Technical (%)</th>
                        <th class="rpt_head">Engineering (%)</th>
                        <th class="rpt_head">Production (%)</th>
                        <th class="rpt_head">Total (%)</th>                        
                        <th class="rpt_head">Hand Over</th>
                        <th class="rpt_head">Hand Over Date</th>
                    </tr>
                </thead>
                <tbody>`
            pData.map((i, index) => {
                let _themes = "";

                if (i.project_hadnover === '0')
                    _themes = "rowRed";
                else if (i.project_hadnover === '1')
                    _themes = "rowOrange";
                else if (i.project_hadnover === '2')
                    _themes = "rowBlue";
                else if (i.project_hadnover === '3')
                    _themes = "rowGreen";
                else
                    _themes = "";

                prdata += `
                    <tr>
                        <td class="rpt_body ${_themes}">${index + 1}</td>
                        <td class="rpt_body ${_themes}">${i.project_no.toUpperCase()}</td>
                        <td class="rpt_body ${_themes}">${i.project_name}</td>
                        <td class="rpt_body ${_themes}">${i.project_cname}</td>
                        <td class="rpt_body ${_themes}">${i.project_location}</td>`
                if (pdfAccess) {
                    prdata += `<td class="rpt_body ${_themes} t_right t_bold">${i.project_amount}</td>`
                }
                prdata += `<td class="rpt_body ${_themes}">${i.Sales_Representative}</td>
                        <td class="rpt_body ${_themes}" style="width:75px">${i.project_singdate_d}</td>
                        <td class="rpt_body ${_themes}">${i.project_contract_duration}</td>
                        <td class="rpt_body ${_themes}" style="width:75px">${i.project_expiry_date}</td>
                        <td class="rpt_body ${_themes}">-</td>
                        <td class="rpt_body ${_themes}">-</td>
                        <td class="rpt_body ${_themes}">-</td>
                        <td class="rpt_body ${_themes}">-</td>
                        
                        <td class="rpt_body ${_themes}">-</td>
                        <td class="rpt_body ${_themes}">-</td>
                    </tr>                    
                    `;
            })

            prdata += `</tbody>
            </table>
        </div>
        `;
            localStorage.setItem('rpt', prdata);
            var loc = print_location + "print/printw.html";
            window.open(loc, '_blank', width = '1300px', height = '800px');
        }



    }




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
        var bh = wsize - 110 - 60;
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


        // document.querySelector(".naf-tables").style.height = bhbhbh + "px";
        // document.querySelector(".naf-tables").style.maxHeight = bhbhbh + "px";
        // document.querySelector(".naf-tables").style.maiHeight = bhbhbh + "px";

    }


    $scope.manpower_summaryreport = () => {
        var sdate = $('#date_search').val();
        var edate = $('#date_search1').val();
        var url = `http://172.0.0.1:8082/EMS//print/psmsummary.php?s=${sdate}&e=${edate}`;
        window.open(url, '_blank', 'widht=1300px;height=600px');
    }


    $scope.xerror = false;
    $("input[name='advance_amount_remark']").css('color', "red");
    $("input[name='project_first_advance']").css('color', "red");
    $(".fa-check").css('color', "red");


    $scope.save_project = function () {
        clc();
        var _svdata = {
            naf_user: userinfo,
            _frmdata: $scope.newproject,
            _conditions: $scope._condition,
            _terms: $scope._terms
        };
        var req = $http.post(api_url + "Project/new.php", _svdata);
        req.then(function (res) {
            if (res.data.msg === "1") {
                alert("saved");
                reload();
            } else {
                alert(res.data.data);
            }
        })
    }

    $scope.calc_f1 = function () {
        var __presentage = parseFloat($scope.newproject.project_first_advance_amount);
        var __amount = parseFloat($scope.newproject.project_amount);
        if (__presentage > __amount) {
            $scope.xerror = false;

        } else {
            $scope.xerror = true;
        }
        clc()
    }

    $scope.calc_f2 = function () {
        clc()
    }
    $scope.clcvalues = function () {
        var __presentage = parseFloat($scope.newproject.project_basicpayment);
        if (__presentage <= 100) {
            $scope.xerror = true;
        } else {
            $scope.xerror = false;
        }
        clc();
    }

    function clc() {
        if (!$scope.newproject.project_amount || $scope.newproject.project_amount == "" || !$scope.newproject.project_first_advance_amount || $scope.newproject.project_first_advance_amount == "" || !$scope.newproject.project_basicpayment || $scope.newproject.project_basicpayment == "") {
            $scope.newproject.project_first_advance = 0;
            $scope.ckcolors = "text-danger";
            $scope.bgcolor = "bg-danger";
            $scope.newproject.advance_amount_remark = "Advance Payment Not Completed";
        } else {
            var __amount = parseFloat($scope.newproject.project_amount);
            var __presentage = parseFloat($scope.newproject.project_first_advance_amount);
            var presentage = parseFloat(calcss(__amount, __presentage));
            $scope.newproject.project_first_advance = presentage;
            var _mini = parseInt($scope.newproject.project_basicpayment);
            if (_mini <= presentage) {
                $scope.ckcolors = "color:green";
                $scope.bgcolor = "bg-success";
                $("input[name='advance_amount_remark']").css('color', "green");
                $("input[name='project_first_advance']").css('color', "green");
                $(".fa-check").css('color', "green");
                $scope.newproject.advance_amount_remark = "Advance Payment Completed";
            } else {
                $("input[name='advance_amount_remark']").css('color', "red");
                $("input[name='project_first_advance']").css('color', "red");
                $(".fa-check").css('color', "red");
                $scope.newproject.advance_amount_remark = "Advance Payment Not Completed";
            }
        }
    }

    $scope.goprojectcuttinglist = (pid, psno) => {
        sessionStorage.clear('nafco_project_current');
        sessionStorage.clear('nafco_project_current_sno');
        sessionStorage.setItem('nafco_project_current', pid);
        sessionStorage.setItem('nafco_project_current_sno', psno);
        if (userinfo.user_name === "eng_carlo") {
            location.href = `${print_location}/Dashboard/Main/index.php#!/cuttinglistsp`;
        } else {
            location.href = `${print_location}/Dashboard/Main/index.php#!/cuttinglistsusersp`;
        }
    }

}])

function goproject(pid, psno) {
    console.log(userinfo);
    if (userinfo.user_name !== 'bilal') {
        sessionStorage.clear('nafco_project_current');
        sessionStorage.clear('nafco_project_current_sno');
        sessionStorage.setItem('nafco_project_current', pid);
        sessionStorage.setItem('nafco_project_current_sno', psno);
        _viewproject();
    }
}

function goprojectbudget(pid, psno) {
   // console.log(userinfo);
    if (userinfo.user_name !== 'bilal') {
        sessionStorage.clear('nafco_project_current');
        sessionStorage.clear('nafco_project_current_sno');
        sessionStorage.setItem('nafco_project_current', pid);
        sessionStorage.setItem('nafco_project_current_sno', psno);
        location.href = `${print_location}/Dashboard/Main/index.php#!/projectsummary`;
    }
}


