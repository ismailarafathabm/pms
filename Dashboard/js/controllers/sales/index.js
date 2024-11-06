app.controller('ctrl_quotations', ctrl_quotations);
function ctrl_quotations($scope, $http) {
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

    document.getElementById("sales_infos").classList.add('menuactive');
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

        document.querySelector(".sub-body-container").style.height = bh + "px";
        document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container").style.maiHeight = bh + "px";
        //set size main container
        var docwith = window.innerWidth;
        var mbodyw = document.querySelector(".ism-bodys").offsetWidth;
        //document.querySelector(".inreportsbody").style.width = docwith - 300 - 30;
    }

    $("#back_btn").on('click', function () {
        window.history.back();
    });

    //grid options
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
    var columndef = [];
    columndef.push({
        cellRenderer: function (p) {
            return `<div style="display:flex">
                    <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" onclick="newRevision('${p.data.quid}','${p.data.quprojectname}')">
                        <i class="fa fa-plus"></i>
                        New Revision
                    </button>

                    <button type="button" class="ism-btns btn-normal" style="padding:2px 5px;margin-left:10px" onclick="listRevision('${p.data.quid}','${p.data.quprojectname}')">
                    <i class="fa fa-list"></i>
                    Revision List
                </button>
                
            </div>`;
        },
        width: 280,
        headerClass: 'green-leaves',
        filter: false
    })
    columndef.push({
        headerName: 'S.NO',
        field: 'qusno',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves'
    })
    columndef.push({
        headerName: 'REF#',
        field: 'qurefno',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves'
    })
    columndef.push({
        headerName: 'Contracor/Client',
        field: 'qucontact',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves'
    })
    columndef.push({
        headerName: 'Project',
        field: 'quprojectname',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves'
    })
    columndef.push({
        headerName: 'Contact Persion',
        field: 'quattention',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves'
    })
    columndef.push({
        headerName: 'Contact Details',
        field: 'quattention',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves'
    })
    columndef.push({
        headerName: 'Location',
        field: 'qulocation',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves'
    })
    columndef.push({
        headerName: 'Stats',
        field: 'qustatus',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves'
    })
    columndef.push({
        headerName: 'Sales REP',
        field: 'qusalesrep',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves'
    })
    columndef.push({
        headerName: 'Docuemnt Received',
        field: 'qurecivedthru',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves'
    })


    columndef.push({
        headerName: 'Recived Date',
        field: 'qureceiveddate',
        cellRenderer: function (d) {
            return d.data.qureceiveddate_d
        },
        sortingOrder: ['asc', 'desc'],
        sort: 'desc',
        sortIndex: 0,
        width: 150,
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        headerClass: 'green-leaves'
    })
    columndef.push({
        headerName: 'Revision No',
        field: 'revision_no',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves'

    })

    columndef.push({
        headerName: 'Released Date',
        field: 'rdate',
        cellRenderer: function (d) {
            let _ok = d.data.rdate_d;
            let _er = '-';
            return d.data.ramount === '-' ? _er : _ok;
        },
        sortingOrder: ['asc', 'desc'],
        sort: 'desc',
        sortIndex: 0,
        width: 150,
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves',
        
    })

    columndef.push({
        headerName: 'Duration',
        field: 'rduration',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves'
    })
    columndef.push({
        headerName: 'Amount (SR.)',
        field: 'ramount',
        cellRenderer: function (d) {
            return `<div style='color:red'>${d.data.ramount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</div>`
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves'
    })
    columndef.push({
        headerName: 'Proposed System',
        field: 'rsystemtype',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves'
    })
    columndef.push({
        headerName: 'Cost Eng.',
        field: 'rcosingeng',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves'
    })
    columndef.push({
        headerName: 'Remark',
        field: 'rremarks',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves'
    })
    columndef.push({
        headerName: 'Drawing No.',
        field: 'rdrawingno',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        headerClass: 'green-leaves',
        cellClass: 'yellow-leaves'
    })

    function headerHeightSetter() {
        var padding = 20;
        var height = headerHeightGetter() + padding;
        gridOptions.api.setHeaderHeight(height);
        gridOptions.api.resetRowHeights();
    }

    function headerHeightGetter() {
        var columnHeaderTexts = [
            ...document.querySelectorAll('.ag-header-cell-text'),
        ];
        var clientHeights = columnHeaderTexts.map(
            headerText => headerText.clientHeight
        );
        var tallestHeaderTextHeight = Math.max(...clientHeights);

        return tallestHeaderTextHeight;
    }
    var accessedituser = ['est_demo']

    var username = userinfo.user_name;
    var access = false;
    accessedituser.forEach(i => {
        if (i === username) {
            access = true;
        }
    })
    //var access = false;
    var gridOptions = {
        onFirstDataRendered: headerHeightSetter,
        onColumnResized: headerHeightSetter,
        suppressContextMenu: true,
        columnDefs: columndef,
        enableCellChangeFlash: true,
        defaultColDef: {
            editable: access,
            resizable: true,
            autoHeight: true,
            sortable: true,
            filter: true,
            floatingFilter: true,
            wrapText: true,
            headerComponentParams: {
                template:
                    '<div class="ag-cell-label-container" role="presentation">' +
                    '  <span ref="eMenu" class="ag-header-icon ag-header-cell-menu-button"></span>' +
                    '  <div ref="eLabel" class="ag-header-cell-label" role="presentation">' +
                    '    <span ref="eSortOrder" class="ag-header-icon ag-sort-order"></span>' +
                    '    <span ref="eSortAsc" class="ag-header-icon ag-sort-ascending-icon"></span>' +
                    '    <span ref="eSortDesc" class="ag-header-icon ag-sort-descending-icon"></span>' +
                    '    <span ref="eSortNone" class="ag-header-icon ag-sort-none-icon"></span>' +
                    '    <span ref="eText" class="ag-header-cell-text" role="columnheader" style="white-space: normal;"></span>' +
                    '    <span ref="eFilter" class="ag-header-icon ag-filter-icon"></span>' +
                    '  </div>' +
                    '</div>',
            },

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
        onCellEditingStopped: function (event) {
            //console.log('cellEditingStopped');
            updatedata(event.node.data);

        },

        
    };

    

    function updatedata(data) {
        console.log(data);
        var fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('quid', data.quid);
        fd.append('qusno', data.qusno);
        fd.append('qurefno', data.qurefno);
        fd.append('qureceiveddate', data.qureceiveddate);
        fd.append('qusubmitaldate', data.qusubmitaldate);
        fd.append('qusalesrep', data.qusalesrep);
        fd.append('quprojectname', data.quprojectname);
        fd.append('qustatus', data.qustatus);
        fd.append('qucontact', data.qucontact);
        fd.append('contact_infos', data.contact_infos);
        fd.append('qurecivedthru', data.qurecivedthru);
        fd.append('quboq', data.quboq);
        fd.append('quspecification', data.quspecification);        
        fd.append('quextra', data.quextra);
        fd.append('revision_no', data.revision_no);
        fd.append('rdate', data.rdate);
        fd.append('rduration', data.rduration);
        fd.append('ramount', data.ramount);
        fd.append('rsystemtype', data.rsystemtype);
        fd.append('rcosingeng', data.rcosingeng);
        fd.append('rremarks', data.rremarks);
        fd.append('rdrawingno', data.rdrawingno);

        let post_data = {
            url : `${api_url}quotations/nnew.php`,
            data  : fd,
            method : "POST",
            headers : {
                'content-type' : undefined
            }
        };

        const req = $http(post_data);

        req.then(
            (res) => {
                if(res.data.msg === "1"){
                    $scope._savmsg = `<strong style='color:green'>saved</strong>`;
                }else if(res.data.msg === "404"){
                    alert(res.data.data);
                    location.href = `${print_location}logout.php`
                }else {
                    $scope._savmsg = `<strong style='color:red'>Error : ${res.data.data}</strong>`;
                }
            }
        );
    }

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
    //grid options end
    $scope.search_old_cmpl = false;
    $scope.getreport_dialog_submit = () => {
        let fd = new FormData();
        let pjname = document.getElementsByName('seach_projectname')[0].value;
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('seach_projectname', document.getElementsByName('seach_projectname')[0].value);

        let post_data = {
            url: `${api_url}quotations/search.php`,
            data: fd,
            method: "POST",
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);
        req.then(
            (res) => {
                if (res.data.msg === '1') {
                    $scope.search_old_cmpl = true;
                    $scope.newquotations = {
                        quprojectname: pjname,
                        qusno: res.data.data.qusno,
                        qurefno: res.data.data.refno,
                    };
                    $scope.$digest();
                    let q = document.getElementsByName('qurefno')[0];
                    if (res.data.data.qurefno !== '') {
                        q.setAttribute('readonly', 'true')
                    } else {
                        q.removeAttribute('readonly')
                    }

                } else {
                    alert(res.data.data);

                }
            }
        )

    }

//     let names = ['iliakan', 'remy', 'jeresig'];

// let requests = names.map(name => fetch(`https://api.github.com/users/${name}`));

// Promise.all(requests)
//   .then(responses => {
//     // all responses are resolved successfully
//     for(let response of responses) {
//       alert(`${response.url}: ${response.status}`); // shows 200 for every url
//     }

//     return responses;
//   })
//   // map array of responses into an array of response.json() to read their content
//   .then(responses => Promise.all(responses.map(r => r.json())))
//   // all JSON answers are parsed: "users" is the array of them
//   .then(users => users.forEach(user => alert(user.name)));

    $scope.cancel_seach = () => {
        console.log("working");
        $scope.search_old_cmpl = false;
        $scope.seach_projectname = '';
        //document.getElementsByName('seach_projectname')[0].focus();
    }

    $scope.save_quotations_submit = () => {
        let frm = document.getElementById('save_quotations');
        let fd = new FormData(frm);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        let post_data = {
            url: `${api_url}sales/index.php`,
            data: fd,
            method: "POST",
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(
            (res) => {
                if (res.data.msg === "1") {
                    alert("saved");
                    location.reload();
                } else if (res.data.msg === "404") {
                    alert(res.data.data);
                } else {
                    alert(res.data.data);
                }
            }
        )
    }
    QuotationAll();



    $scope.list_ppsystem = [];
    $scope.list_costeng = [];
    $scope.list_remark = [];
    $scope.list_location = [];
    $scope.list_client = [];
    $scope.list_srep = [];

    function QuotationAll() {
        $scope.list_ppsystem = [];
        $scope.list_costeng = [];
        $scope.list_remark = [];
        $scope.list_location = [];
        $scope.list_client = [];
        $scope.list_srep = [];
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        let post_data = {
            url: `${api_url}sales/getall.php`,
            data: fd,
            method: "POST",
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);
        req.then(
            (res) => {
                if (res.data.msg === "1") {
                    gridOptions.api.setRowData(res.data.data);
                    res.data.data.forEach(i => {
                        let cli = $scope.list_client.includes(i.qucontact);
                        if (!cli) {
                            $scope.list_client.push(i.qucontact);
                        }

                        let loc = $scope.list_location.includes(i.qulocation);
                        if (!loc) {
                            $scope.list_location.push(i.qulocation);
                        }

                        let sal = $scope.list_srep.includes(i.qusalesrep);
                        if (!sal) {
                            $scope.list_srep.push(i.qusalesrep);
                        }

                        let sy = $scope.list_ppsystem.includes(i.rsystemtype)
                        if (!sy) {
                            $scope.list_ppsystem.push(i.rsystemtype)
                        }

                        let eng = $scope.list_costeng.includes(i.rcosingeng)
                        if (!eng) {
                            $scope.list_costeng.push(i.rcosingeng)
                        }

                        let rem = $scope.list_remark.includes(i.rremarks)
                        if (!eng) {
                            $scope.list_remark.push(i.rremarks)
                        }

                    });

                } else if (res.data.msg === "404") {
                    alert(res.data.data);
                } else {
                    alert(res.data.data);
                }
            }
        )
    }
    $scope.is_start_newrevision = false;
    $scope.save_revision_submit = () => {
        $scope.is_start_newrevision = true;
        let frm = document.getElementById('save_revision');
        let fd = new FormData(frm);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        let post_data = {
            url: `${api_url}sales/newrevision.php`,
            data: fd,
            method: "POST",
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(
            (res) => {
                if (res.data.msg === "1") {
                    alert("saved");
                    location.reload();
                } else if (res.data.msg === "404") {
                    alert(res.data.data);
                    //location.reload();
                } else {
                    alert(res.data.data);
                }

                $scope.is_start_newrevision = false;
            }
        )
    }

    $scope.print_rpt = () => {
        const _data = print_data();
        let _mdata = _data._data;

    }

    $scope.print_rpt_salesrep = () => {
        const _data = print_data();
        let _mdata = _data._data;
        let _sales = _data._salesp;

    }

    function print_data() {
        let _fdata = [];
        let _data = [];
        let _salesp = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(i => {
            _data.push(i.data);
            let is_d = _salesp.includes(i.data.qusalesrep);
            if (!is_d) {
                _salesp.push(i.data.qusalesrep)
            }
        })
        _fdata.push(
            {
                _data,
                _salesp
            }
        );

        return _fdata;
    }
}

function newRevision(id, _pjname) {
    let dia = document.getElementById('new_revision_add');
    $scope = angular.element(dia).scope();
    let _date = new Date();
    let _d = _date.getDate();
    let _m = _date.getMonth() + 1;
    let _y = _date.getFullYear();
    let di = `${_d}-${_m}-${_y}`;
    $scope.newrevision = {
        rqno: id,
        rdate: di
    };
    $scope.pjname = _pjname;
    dia.style.display = "flex"
    $scope.$apply();
}
function listRevision(_id, _pjname) {
    let fd = new FormData();
    fd.append('user_name', userinfo.user_name);
    fd.append('user_token', userinfo.user_token);
    fd.append('qid', _id);

    let post_data = {
        url: `${api_url}sales/rlist.php`,
        data: fd,
        method: "POST",
        headers: {
            'content-type': undefined
        }
    };
    const req = fetch(`${api_url}sales/rlist.php`, {
        method: "POST",
        body: fd,
    });
    let dia = document.getElementById("dia_revision_list");
    $scope = angular.element(dia).scope();
    req.then(resp => resp.json()).then(
        (res) => {
            if (res.msg === "1") {
                $scope.rev_list = res.data;
                $scope.pjname = _pjname;
                $scope.$apply();
                dia.style.display = "flex";
            } else if (res.msg === "404") {
                alert(res.datat);
            } else {
                alert(res.data);
            }
        }
    );


}