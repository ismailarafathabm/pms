app.controller('ctrl_estvariation', estvariation);

function estvariation($scope, $http) {
    $scope._btn_print = access_variation_print;
    $scope._btn_excel = access_varation_export;
    document.getElementById("rpt_variation").classList.add('menuactive');
    var site = print_location;
    window.addEventListener('resize', () => {
        maxbodyheight()
    })
    maxbodyheight();

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
    var statuscheck = {
        'td-yellow': function(p) {
            return p.data.variation_status === '1'
        },
        'trgreen': function(p) {
            return p.data.variation_status === '2'
        },
        'trred txt-red': function(p) {
            return p.data.variation_status === '3'
        },
        'tryellow2': function(p) {
            return p.data.variation_status === '4'
        },
        'trgreen2': function(p) {
            return p.data.variation_status === '5'
        },
    }


    var columnDefs = [];
    console.log(access_variation_amount);
    if (access_variation_amount === true) {
        columnDefs = [{
                headerName: 'Sl.No',
                //cellRenderer: 'node.rowIndex + 1',
                valueGetter: "node.rowIndex + 1",
                filter: false,
                sortable: false,
                suppressMenu: false,
                cellClassRules: statuscheck
            },
            {
                headerName: 'Project NO',
                field: 'variation_project',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },
            {
                headerName: 'Name',
                field: 'variation_project_name',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },
            {
                headerName: 'File',
                sortable: false,
                cellRenderer: function(p) {
                    return `
                <a  href="${site}assets/variations/${p.data.variation_token}.pdf"  target="_blank">
                    <img loading='lazy' src="${site}assets/pdfdownload.png?v=${v}" style="width:18px;">
                </a>
                `
                },
                filter: false,
                cellClassRules: statuscheck,

            },
            {
                headerName: 'Date',
                field: 'sdate',
                cellRenderer: function(p) {
                    return `<div>${p.data.variation_date}</div>`
                },
                sortingOrder: ['asc', 'desc'],
                cellClass: 'dateType_green',
                filter: 'agDateColumnFilter',
                filterParams: filterParams,
                cellClassRules: statuscheck,
                sort: 'desc',

            },

            {
                headerName: 'Subject',
                field: 'v_sub_name',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },
            {
                headerName: 'Ref No',
                field: 'variation_refno',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },
            {
                headerName: 'Revision No',
                field: 'revision_no',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },
            {
                headerName: 'Total Amount',
                field: 'variation_amount',
                filter: 'agNumberColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,
                cellClass: 'money-filed',
                valueFormatter: currencyFormatter,

            },
            {
                headerName: 'Status',
                field: 'variation_statustext',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },
            {
                headerName: 'File',
                sortable: false,
                cellRenderer: function(p) {
                    return p.data.variation_status !== '1' ?
                        `
                <a  href="${site}assets/variation_status/${p.data.variation_token}.pdf"  target="_blank">
                    <img loading='lazy' src="${site}assets/pdfdownload.png?v=${v}" style="width:18px;">
                </a>
                ` : ``
                },
                filter: false,
                cellClassRules: statuscheck,

            },
            {
                headerName: 'Atte',
                field: 'variation_atten',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },
            {
                headerName: 'Contractor/Client',
                field: 'variation_to',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },
            {
                headerName: 'Description',
                field: 'variation_description',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },
            {
                headerName: 'Region',
                field: 'region_name',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },

            {
                headerName: 'Sales Man',
                field: 'salesman_code',
                cellRenderer: function(p) {
                    return `<div>${p.data.salesman_code} - ${p.data.salesman_name} </div>`
                },
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },
        ];
    } else {
        columnDefs = [{
                headerName: 'Sl.No',
                //cellRenderer: 'node.rowIndex + 1',
                valueGetter: "node.rowIndex + 1",
                filter: false,
                sortable: false,
                suppressMenu: false,
                cellClassRules: statuscheck
            },
            {
                headerName: 'Project NO',
                field: 'variation_project',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },
            {
                headerName: 'Name',
                field: 'variation_project_name',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },

            {
                headerName: 'Date',
                field: 'sdate',
                cellRenderer: function(p) {
                    return `<div>${p.data.variation_date}</div>`
                },
                sortingOrder: ['asc', 'desc'],
                cellClass: 'dateType_green',
                filter: 'agDateColumnFilter',
                filterParams: filterParams,
                cellClassRules: statuscheck,
                sort: 'desc',

            },

            {
                headerName: 'Subject',
                field: 'v_sub_name',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },
            {
                headerName: 'Ref No',
                field: 'variation_refno',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },
            {
                headerName: 'Revision No',
                field: 'revision_no',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },

            {
                headerName: 'Status',
                field: 'variation_statustext',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },

            {
                headerName: 'Atte',
                field: 'variation_atten',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },
            {
                headerName: 'Contractor/Client',
                field: 'variation_to',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },
            {
                headerName: 'Description',
                field: 'variation_description',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },
            {
                headerName: 'Region',
                field: 'region_name',
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },

            {
                headerName: 'Sales Man',
                field: 'salesman_code',
                cellRenderer: function(p) {
                    return `<div>${p.data.salesman_code} - ${p.data.salesman_name} </div>`
                },
                filter: 'agMultiColumnFilter',
                sortingOrder: ['asc', 'desc'],
                cellClassRules: statuscheck,

            },
        ];
    }

    function currencyFormatter(params) {
        return formatNumber(params.value);
    }

    function formatNumber(number) {
        // this puts commas into the number eg 1000 goes to 1,000,
        // i pulled this from stack overflow, i have no idea how it works
        return Math.floor(number)
            .toString()
            .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
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

    getRpt();

    function getRpt() {
        let post_data = {
            naf_user: userinfo
        };
        $scope.isloading = true;
        $http({
            method: 'post',
            url: api_url + "Variations/rpt.php",
            data: post_data
        }).then(
            function(res) {
                console.log(res.data);
                if (res.data.msg === "1") {
                    $scope.data = res.data.data;

                    var gridDiv = document.querySelector('#myGrid');
                    new agGrid.Grid(gridDiv, gridOptions);
                    datas = res.data.data;
                    gridOptions.api.setRowData(datas);
                    var allColumnIds = [];
                    gridOptions.columnApi.getAllColumns().forEach(function(column) {
                        allColumnIds.push(column.colId);
                    });

                    gridOptions.columnApi.autoSizeColumns(allColumnIds, false);

                } else {
                    alert(res.data.data);
                }
                $scope.isloading = false;
            }
        )
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


    $scope.printResult = () => {
        var print_data = '';
        var sno = 0;
        var _v = [];
        var _p = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(ms => {
            var havep = _p.includes(ms.data.variation_project);
            if (!havep) {
                _p.push(ms.data.variation_project)
            }

            _v.push({
                variation_project: ms.data.variation_project,
                variation_project_name: ms.data.variation_project_name,
                variation_date: ms.data.variation_date,
                v_sub_name: ms.data.v_sub_name,
                variation_refno: ms.data.variation_refno,
                revision_no: ms.data.revision_no,
                variation_amount: ms.data.variation_amount,
                variation_statustext: ms.data.variation_statustext,
                variation_atten: ms.data.variation_atten,
                variation_to: ms.data.variation_to,
                variation_description: ms.data.variation_description,
                region_name: ms.data.region_name,
                salesman_code: ms.data.salesman_code,
                salesman_name: ms.data.salesman_name,
                variation_status: ms.data.variation_status

            })
        });


        var _prt = [];

        _p.forEach(_i => {
            console.log(_i)
            var _farray = [];
            var tot = 0;
            var _projectname = '';
            _v.forEach(_j => {
                if (_i === _j.variation_project) {
                    console.log(_j.variation_project_name);
                    tot += (+_j.variation_amount);
                    _projectname = _j.variation_project_name;
                    _farray.push({
                        variation_project: _j.variation_project,
                        variation_project_name: _j.variation_project_name,
                        variation_date: _j.variation_date,
                        v_sub_name: _j.v_sub_name,
                        variation_refno: _j.variation_refno,
                        revision_no: _j.revision_no,
                        variation_amount: _j.variation_amount,
                        variation_statustext: _j.variation_statustext,
                        variation_atten: _j.variation_atten,
                        variation_to: _j.variation_to,
                        variation_description: _j.variation_description,
                        region_name: _j.region_name,
                        salesman_code: _j.salesman_code,
                        salesman_name: _j.salesman_name,
                        variation_status: _j.variation_status
                    });
                }


            });
            _prt.push({
                prj: _i,
                prjn: _projectname,
                prjarr: _farray,
                prjtot: tot
            })
        })

        console.log(_prt);

        _prt.forEach(m => {
            print_data += `
            <div class="main_div">            
            <div class="projectinfo">
            ${angular.uppercase(m.prj)} -  ${angular.uppercase(m.prjn)}
            <span class='title_tos'>Total Amount : ${m.prjtot}</span>
            </div>
            <div class="variationfino">
            <table>
            <thead>
            <tr>
            <th class="fiexdheader">S.No</th>            
            <th class="fiexdheader">Date</th>
            <th class="fiexdheader">Subject</th>
            <th class="fiexdheader">Ref No</th>
            <th class="fiexdheader">Revision No</th>
            <th class="fiexdheader">Description</th>
            <th class="fiexdheader">Total Amount</th>
            <th class="fiexdheader">Status</th>            
            </tr>
            </thead>
            <tbody>`;
            var sno = 0;
            m.prjarr.forEach(l => {
                var colorinfos = '';
                switch (l.variation_status) {
                    case '2':
                        colorinfos = 'color :#274C43;background-color:#a3f5e0';
                        break;
                    case '5':
                        colorinfos = 'color :#007357;background-color:#dcfdf5';
                        break;
                    case '3':
                        colorinfos = 'color :#580101;background-color:#fdc9c9';
                        break;
                    case '4':
                        colorinfos = 'color :#5C1E00;background-color:#ffebe1';
                        break;
                    case '1':
                        colorinfos = 'color :#494E00;background-color:#FCFFD4';
                        break;

                }
                sno += 1;
                print_data += `
                <tr>
                <td style="${colorinfos};width:55px">${sno}</td>
                <td style="${colorinfos};width:85px">${l.variation_date}</td>
                <td style="${colorinfos};width:100px">${l.v_sub_name}</td>
                <td style="${colorinfos};width:130px">${l.variation_refno}</td>
                <td style="${colorinfos};width:75px">${l.revision_no}</td>
                <td style="${colorinfos};width:275px">${l.variation_description}</td>
                <td style="${colorinfos};width:75px">${l.variation_amount}</td>
                <td style="${colorinfos};width:120px">${l.variation_statustext}</td>
                </tr>
                `;
            })
            print_data += `</tbody>
            </table>
            </div>
            
            </div>
            `;
        });

        console.log(print_data);
        localStorage.removeItem('print_variationsreport');
        localStorage.setItem('print_variationsreport', print_data);

        var locationprint = print_location + "Print/print_variations.php";
        window.open(locationprint, '_blank', "width = '1000px', height = '800px'");

    }

}