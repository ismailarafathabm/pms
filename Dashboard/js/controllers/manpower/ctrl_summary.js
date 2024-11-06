app.controller('ctrl_summary', ctrl_summary);


function ctrl_summary($scope, $http) {
    document.getElementById('dia_filter_dates').style.display='flex';
    // const inputs = document.querySelectorAll("input");
    // inputs.forEach(i => {
    //     i.autocomplete = "off";
    // })
    document.getElementById("_ispageloading").style.display = "none";
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

    $scope.isloading = true;

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
        headerName: 'Project No',
        field: 'projectno',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 100,
    },
    {
        headerName: 'Name',
        field: 'projectname',
        cellRenderer: function (d) {
            return `
            <button type="button" class="ism-btns btn-normal" onclick="getinfos('${d.data.projectno}','${_startdate}','${_enddate}','${d.data.projectname}')" style="padding: 3px 2px;">
                ${d.data.projectname}
            </button>
            `
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 495,  
        sort: 'asc',
        sortIndex: 2     

    },
    {
        headerName: 'Region',
        field: 'projectregion',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        sort: 'asc',
        sortIndex: 0 
    },
    {
        headerName: 'Project Manager',
        field: 'mangername',
        cellRenderer: function(p){
            if(p.data.mangername === "NAN"){
                return `NONE`;
            }else{
                return p.data.mangername
            }
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        sort: 'asc',
        sortIndex: 1 
    },
    {
        headerName: 'Present',
        field: 'pres',
        filter: 'agNumberColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 70,
    },
    {
        headerName: 'Absent',
        field: 'abse',
        filter: 'agNumberColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 70,
    },
    {
        headerName: 'Total',
        field: 'totalemp',
        filter: 'agNumberColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 70,
    },
    {
        headerName: 'Amount',
        field: 'coustamount',
        filter: 'agNumberColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 70,
    },]
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
            url: `${api_gway}/manpower_summary.php`,
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




    $scope.print_rpt = () => {
        var regions = [];
        var print_data = [];
        var tot_emp = 0;
        var totamount = 0;
        var cdate = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(i => {
            cdate.push(i.data);
            tot_emp += (+i.data.totalemp);
            totamount += (+i.data.coustamount);
            var av = regions.includes(i.data.projectregion);
            if (!av) {
                regions.push(i.data.projectregion)
            }
        })

        regions.map(i => {
            var regnam = i;
            var list = [];
            var total = 0;
            var totempamount = 0;
            cdate.map(j => {
                if (i === j.projectregion) {
                    total += (+j.totalemp);
                    totempamount += (+j.coustamount);
                    list.push(j)
                }
            })
            print_data.push({
                regnam,
                list,
                total,
                totempamount
            });

        })


        var prdata = "";
        prdata += ` <div class="row monthinfos">
                     <div class="monthinfoss">Project Wise Summary With Cost : ${_todays}</div>
                     </div>                                
                        `;
        print_data.map(i => {
            if (i.list.length !== 0) {
                prdata += `<div class="row summarytable" style="background:#f6ea98">
                            <div>Region : ${angular.uppercase(i.regnam)} <span style="color:red"> Total Employees :${i.total}</span> </div>
                            <div class='title_tos'>Total Amount : ${i.totempamount} </div>
                        </div>
                `;
                prdata += `<div class="variationfino">
                            <table>
                                <thead>                                                                                       
                                    <tr>
                                        <th class="fiexdheader" style="width:25px">S.No</th> 
                                        <th class="fiexdheader" style="width:100px">Project No</th>           
                                        <th class="fiexdheader" style="width:300px">Project Name</th>                                                           
                                        <th class="fiexdheader" style="width:100px">Present</th>  
                                        <th class="fiexdheader" style="width:100px">Absent</th>  
                                        <th class="fiexdheader" style="width:100px">Total</th>                                                                                      
                                        <th class="fiexdheader" style="width:100px">Amount</th>    
                                    </tr>
                                </thead>
                                <tbody>`;
                var sno = 0;
                var totalprj = 0;
                var totabs = 0;
                var totpres = 0;
                var tttcnt = 0;
                var tttamount = 0;
                i.list.map(j => {
                    sno += 1;
                    totalprj = sno;
                    totabs += (+j.abse);
                    totpres += (+j.pres);
                    tttcnt += (+j.totalemp);
                    tttamount += (+j.coustamount)
                    prdata += `
                                    <tr>
                                        <td class="fullinfo" style="width:25px">${sno}</td>
                                        <td class="fullinfo" style="width:100px">${j.projectno}</td>
                                        <td class="fullinfo" style="width:300px">${j.projectname}</td>
                                        <td class="fullinfo" style="width:100px;text-align:center;">${j.pres}</td>
                                        <td class="fullinfo" style="width:100px;color:red;text-align:center;">${j.abse}</td>
                                        <td class="fullinfo" style="width:100px;font-weight:bold;text-align:center;">${j.totalemp}</td>                                                
                                        <td class="fullinfo" style="width:100px;font-weight:bold;text-align:center;">${j.coustamount}</td>                                                
                                    </tr>
                                    `;
                });

                prdata += `
                                    <tr>
                                        <td colspan="3" style="font-size: 14px;background-color: #b3ffb5;font-weight: 600;">Total Project ${totalprj}</td>                                                
                                        <td style="font-size: 14px;background-color: #b3ffb5;font-weight: 600;text-align:center;">${totpres}</td>
                                        <td style="font-size: 14px;background-color: #b3ffb5;font-weight: 600;text-align:center;">${totabs}</td>
                                        <td style="font-size: 14px;background-color: #b3ffb5;font-weight: 600;text-align:center;">${tttcnt}</td>                                                
                                        <td style="font-size: 14px;background-color: #b3ffb5;font-weight: 600;text-align:center;">${tttamount}</td>  
                                    </tr> </tbody></table>
                `;

            }
        })

        prdata += `<div class="row summarytable bottomtotal" style="background:#ffea5d">
                            <div>
                                Total Employees  ${tot_emp} 
                            </div>
                            <div class='title_tos'>
                               Total Amount : ${totamount}
                            </div>
                        </div>
            `;

        localStorage.removeItem("printdisplayhead");
        localStorage.removeItem('print_data');
        localStorage.setItem('print_data', prdata);

        window.open(`${api_pms}print/manpower/index.html`, '_blank', "width = '1300px', height = '700px'");

    }
    $scope._empinfomanpower = "";
    $scope._empinfomanpowerdet = {};
    $scope.print_myinfos = () => {
        var category = [];
        var workerslist = [];
        $scope.flist.map(i => {
            var av = category.includes(i.eposition);
            if (!av) { category.push(i.eposition) }
            workerslist.push(i)
        });
        var gtotemp = 0;
        var gtotal = 0;
        var prdata = [];
        category.map(i => {
            var cate = i;
            var emplis = [];
            var totab = 0;
            var totpr = 0;
            var totda = 0
            var totsal = 0;
            workerslist.map(j => {
                if (j.eposition === i) {
                    totab += (+j.abse);
                    totpr += (+j.pres);
                    totda += (+j.totalemp)
                    totsal += (+j.amount);
                    gtotal += (+j.amount);
                    emplis.push(j);
                }
            })

            prdata.push({
                cate,
                emplis,
                totab,
                totpr,
                totda,
                totsal,
            })
        });
        
        var prdatap ="";
        var ppname = $scope.projectnamenow;
        prdatap += ` <div class="row monthinfos">
                     <div class="monthinfoss">
                        <h5 style="margin: 0px;margin-block-start: 0px;margin-block-end: 0px;">Man Power Summary Cost Report</h5>
                        <h5 style="margin: 0px;margin-block-start: 0px;margin-block-end: 0px;"> Project Name :  ${ppname} </h5> 
                        <h5 style="margin: 0px;margin-block-start: 0px;margin-block-end: 0px;"> ${_todays}</h5>
                     </div>
                     </div>                                
                        `;
        prdata.map(i => {
            prdatap += `<div class="row summarytable" style="background:#f6ea98">
                            <div>Designation : ${angular.uppercase(i.cate)}</div>
                            <div class='title_tos'>Total Salary : ${i.totsal} </div>
                        </div>
                `;
            prdatap += `<div class="variationfino">
                        <table>
                            <thead>                                                                                       
                                <tr>
                                    <th class="fiexdheader" style="width:25px">S.No</th> 
                                    <th class="fiexdheader" style="width:100px">File No</th>           
                                    <th class="fiexdheader" style="width:300px">Name</th>                                                           
                                    <th class="fiexdheader" style="width:100px">Nationality</th>  
                                    <th class="fiexdheader" style="width:100px">Present</th>  
                                    <th class="fiexdheader" style="width:100px">Absent</th>                                                                                      
                                    <th class="fiexdheader" style="width:100px">Total Days</th>                                                                                      
                                    <th class="fiexdheader" style="width:100px">Salary</th>                                                                                      
                                </tr>
                            </thead>
                            <tbody>`;
            var sno = 0;
            var totemp = i.emplis.length;
            gtotemp += i.emplis.length;
            i.emplis.map(j => {
                sno += 1;
                prdatap += `
                                    <tr>
                                        <td class="fullinfo" style="width:25px">${sno}</td>
                                        <td class="fullinfo" style="width:100px">${j.fileno}</td>
                                        <td class="fullinfo" style="width:300px">${j.ename}</td>
                                        <td class="fullinfo" style="width:100px">${j.enationality}</td>
                                        <td class="fullinfo" style="width:100px;text-align:center;">${j.pres}</td>
                                        <td class="fullinfo" style="width:100px;text-align:center;">${j.abse}</td>
                                        <td class="fullinfo" style="width:100px;text-align:center;">${j.totalemp}</td>
                                        <td class="fullinfo" style="width:100px;text-align:center;font-weight:bold">${j.amount}</td>                                                
                                    </tr>
                                    `;
            })
            prdatap += `
                                    <tr>
                                        <td colspan="4" style="font-size: 14px;background-color: #b3ffb5;font-weight: 600;">Total Employees ${totemp}</td>                                                
                                        <td style="font-size: 14px;background-color: #b3ffb5;font-weight: 600;text-align:center;">${i.totpr}</td>
                                        <td style="font-size: 14px;background-color: #b3ffb5;font-weight: 600;text-align:center;">${i.totab}</td>
                                        <td style="font-size: 14px;background-color: #b3ffb5;font-weight: 600;text-align:center;">${i.totda}</td>                                                
                                        <td style="font-size: 14px;background-color: #b3ffb5;font-weight: 600;text-align:center;">${i.totsal}</td>                                                
                                    </tr> </tbody></table>
                `;
        });
        prdatap += `<div class="row summarytable bottomtotal" style="background:#ffea5d">
                            <div>
                                Total Employees ${gtotemp}
                            </div>
                            <div class='title_tos'>
                                Total Amount : ${gtotal.toFixed(2)} 
                            </div>
                        </div>
            `;
        localStorage.removeItem("printdisplayhead");
        localStorage.removeItem('print_data');
        localStorage.setItem('print_data', prdatap);

        window.open(`${api_pms}print/manpower/index.html`, '_blank', "width = '1300px', height = '700px'");
    }
}

app.filter('sumrow', () => {
    return function(datas, column) {
        var sum = 0;

        if (!datas) {

        } else {
           
            for (var i = 0; i < datas.length; i++) {
                sum += (+datas[i][column]);
            }
        }
        return sum;

    }
})

function getinfos(project, stdate, endate,prjname) {
    var dia = document.getElementById("rpt_emp_dialog");
    var scope = angular.element(dia).scope();
    document.getElementById("_ispageloading").style.display = "block";
    scope.$apply();
    var fd = new FormData();    
    fd.append("startdate", stdate);
    fd.append("enddate", endate);
    fd.append("projectname", project);

    fetch(`${api_gway}manpower_empinfos.php`, {
        method: "post",
        body: fd,
    }).then(resp => resp.json()).then(res => {
        if (res.msg === '1') {

            var stardate = stdate;
            var enddate = enddate;
            var projectname = project;
            var employsees = res.data;

            var src_designation = [];
            var src_nationality = [];
            res.data.map(i => {
                var av = src_nationality.includes(i.enationality);
                if (!av) {
                    src_nationality.push(i.enationality);
                }
                av = src_designation.includes(i.eposition);
                if (!av) { src_designation.push(i.eposition) }
            })
            scope._empinfomanpowerdet = {
                'stardate': stardate,
                'endate': endate,
                'project': projectname,                
                'employsees': employsees,
                'positions': src_designation,
                'countrys': src_nationality

            };
            scope._empinfomanpower = `Project Name ${prjname} : Date Form : ${stardate} to ${endate}`;
            scope.projectnamenow = prjname;
            scope.$apply();
            scope._ispageloading = false;
            dia.style.display = "block";
        } else {
            alert(res.data);
        }
        document.getElementById("_ispageloading").style.display = "none";
    });
}