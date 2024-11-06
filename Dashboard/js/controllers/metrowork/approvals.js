import MetroServices from './../service/metro.js';
export default function metroworktechapprovals($scope) {
    document.title = "METRO PROJECT APPROVALS - PMS";
    const ms = new MetroServices();
    // document.getElementById("rpt_metro").classList.add('menuactive');
     document.getElementById("ism_dia_metro_approvals_type").style.display = "none";
     document.getElementById("ism_dia_metro_newapprovals").style.display = "none";

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
        var bh = wsize - 160;
        var bhbh = bh - 35 - 10 - 7;
        var bhbhbh = bh - 35 - 27;
        document.querySelector(".sub-body-container").style.height = bh + "px";
        document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container").style.maiHeight = bh + "px";
        var docwith = window.innerWidth;
        var mbodyw = document.querySelector(".ism-bodys").offsetWidth;

    }
    $scope.approvaltype = {
        isloading: false,
        approval_type_name: "",
    };
    $scope.approvalstypes = [];
    const getallapprovals = async () => {
        const res = await ms.getallapprovalstype();
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }

        $scope.approvalstypes = res.data;
        $scope.$apply();
        return;
    }
    getallapprovals();
    async function saveNewApprovalType() {
        if ($scope.approvaltype.isloading) {
            console.log("Already Running...");
            return
        }
        const approval_type_name = document.getElementById("approval_type_name");
        if (approval_type_name.value.trim() === "") {
            alert("Enter Approval Name");
            approval_type_name.focus();
            return;
        }

        $scope.approvaltype = {
            ...$scope.approvaltype,
            isloading: true,
        };
        const fd = ms.fd();
        fd.append("approval_type_name", approval_type_name.value.trim());
        const res = await ms.newapprovaltype(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.approvaltype = {
                ...$scope.approvaltype,
                isloading: false,
            };
            $scope.$apply();
            approval_type_name.focus();
            return;
        }
        alert("Data Has Saved");
        $scope.approvaltype = {
            approval_type_name : "",
            isloading: false,
        };
        $scope.$apply();
        getallapprovals();
    }
    $scope.save_new_approvaltype_keydown = ($event) => {
        if ($event.which === 13) {
            saveNewApprovalType();
        }
    }
    $scope.save_new_approvaltype_click = () => {
        saveNewApprovalType();
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
        headerName: '',
        cellRenderer: function (d) {
            return d.data.approvals_status === "b" ? `
            <div>
                <a target="_blank" href="${print_location}/assets/approvals/${d.data.approvals_token}.pdf?v=${v}" class="btn-black mr-1 ng-scope" target="_blank">
                    <img src="${print_location}/assets/pdfdownload.png?v=${v}" style="width:18px;">
                </a>
                <a target="_blank" href="${print_location}/assets/approvals/${d.data.approvals_token}.pdf?v=${v}" class="btn-black mr-1 ng-scope" target="_blank" download="${d.data.project_name} - ${d.data.approval_type_name}.pdf">
                    <img loading='lazy' src="${print_location}/assets/adownload.png?v=${v}" style="width:18px;">
                </a>
            </div>` : `-`;
        },
        sortingOrder: ['asc', 'desc'],
        width: 110
    })
    columnDefs.push({
        headerName: 'Project No',
        field: 'project_no',
        sortingOrder: ['asc', 'desc'],
        width: 110
    })
    columnDefs.push({
        headerName: 'Project Name',
        field: 'project_name',
        sortingOrder: ['asc', 'desc'],
        width: 210
    })
    columnDefs.push({
        headerName: 'Approved Details',
        field: 'approval_type_name',
        sortingOrder: ['asc', 'desc'],
        width: 170
    })
    columnDefs.push({
        headerName: 'A.Date',
        field: 'approvals_adate',
        sortingOrder: ['asc', 'desc'],
        width: 110
    })

    columnDefs.push({
        headerName: 'R.Date',
        field: 'approvals_rdate',
        sortingOrder: ['asc', 'desc'],
        width: 110
    })
    columnDefs.push({
        headerName: 'Status',
        field: 'approvals_status',
        cellRenderer: function (d) {
            return d.data.approvals_status === "b" ? `B - Approval Released` : `A - Approval Not Released`;
        },
        sortingOrder: ['asc', 'desc'],
        width: 170
    })
    columnDefs.push({
        headerName: 'Remark',
        field: 'approvals_remarks',
        sortingOrder: ['asc', 'desc'],
        width: 210
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
            var mname = `METRO PROJECTS TECHNICAL APPROVALS AS ON DATE ${day}-${month}-${year}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: mname,
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }

    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);



    $scope.pageloading = false;
    $scope.projects = [];
    $scope.approvals = [];
    $scope.givenby = [];
    async function allmetroproject() {
        $scope.projects = [];
        $scope.approvals = [];
        $scope.givenby = [];
        if ($scope.pageloading) {
            console.log("Already running");
            return;
        }
        $scope.pageloading = true;
        const p = ms.getAllmetroprojects();
        const a = ms.getAllMetroApprovals();

        const metroproject = await p;
        const approvals = await a;

        if (metroproject.msg !== 1) {

            alert(metroproject.data);
            $scope.pageloading = false;
            $scope.$apply();
            return;
        }
        if (approvals.msg !== 1) {
            alert(approvals.data);
            $scope.pageloading = false;
            $scope.$apply();
            return;
        }

        $scope.projects = metroproject.data;
        $scope.approvals = approvals.data;
        approvals.data.map(i => {
            if (!$scope.givenby.includes(i.approvals_givenby)) {
                $scope.givenby.push(i.approvals_givenby);
            }
        })
        $scope.pageloading = false;
        gridOptions.api.setRowData(approvals.data);
        $scope.$apply();
    }
    allmetroproject();
    
    let ndate = new Date();
    let dpd = `${ndate.getDate()}-${ndate.getMonth() + 1}-${ndate.getFullYear()}`;
    function defalutNewApproval() {
        $scope.newtechapprovals = {
            isloading: false,
            mode: "N",
            buttontitle: "Save",
            buttonicon : "fa fa-check",
            title : " ADD NEW METRO TECHNICAL APPROVALS",
            data: {
                afor: "",
                Adate: "-",
                givenby: "",
                ftotech: "-",
                engmanager: "Mr. Sunny Mathew",
                rfromeng: "-",
                techengineer: "Mr. John Lacro",
                rftengi: "-",
                salesDep: "-",
                costingDep : "-",
                materialdep : "-",
                purchasedep : "-",
                engDep : "-",
                release : "-",
                remark: "",
                astatus: "a",
                approvals_projectid: ""
            }
        }
    }
    $scope.newtechapprovals = {
        isloading: false,
        mode: "N",
        buttontitle: "Save",
        buttonicon : "fa fa-check",
        title : " ADD NEW METRO TECHNICAL APPROVALS",
        data: {
            afor: "",
            Adate: "-",
            givenby: "",
            ftotech: "-",
            engmanager: "Mr. Sunny Mathew",
            rfromeng: "-",
            techengineer: "Mr. John Lacro",
            rftengi: "-",
            salesDep: "-",
            costingDep : "-",
            materialdep : "-",
            purchasedep : "-",
            engDep : "-",
            release : "-",
            remark: "",
            astatus: "a",
            approvals_projectid: ""
        }
    }


    $("#newapprovals").submit(function (e) {        
        if ($scope.newtechapprovals.isloading) {
            console.log("Already Running");
            return;
        }
        $scope.newtechapprovals = {
            ...$scope.newtechapprovals,
            data: {
                ...$scope.newtechapprovals.data
            },
            isloading: true
        };

        e.preventDefault();        
        var fd = new FormData(this);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        // fd.append("approvals_projectid", project_id)
        $.ajax({
            url: api_url + "Approvals/new.php",
            method: 'post',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                console.log(JSON.stringify(res));
                if (res["msg"] === "1") {
                    alert("saved");
                    defalutNewApproval();                   
                    $scope.$apply();
                    allmetroproject();
                } else {
                    alert(res["data"]);
                    $scope.newtechapprovals = {
                        ...$scope.newtechapprovals,
                        data: {
                            ...$scope.newtechapprovals.data
                        },
                        isloading: false
                    };
                    $scope.$apply();
                }                
            }
        })
    });

    $scope.printResult = () => {
        let printdata = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(i => {
            printdata.push(i.data);
        });
        if (printdata.length === 0) {
            alert("No Data Found...");
            return;
        }
        var loc = print_location + "print/newrpt/metro/index.html";
        localStorage.setItem("metrotechapprovals", JSON.stringify(printdata));
        window.open(loc, '_blank', "width = '1300px'height = '800px'");
    }
}