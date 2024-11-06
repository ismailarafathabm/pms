import MetroServices from './../service/metro.js';
export default function metroworkdrawingapprovals($scope, $http, $compile) {
    document.title = "METRO PROJECT DRAWING APPROVALS - PMS";
    const ms = new MetroServices();

    //document.getElementById("rpt_metro").classList.add('menuactive');
    document.getElementById("revision_list").style.display = "none";
    document.getElementById("dia_newdrawingapprovalsfor").style.display = "none";
    document.getElementById("dia_newshopdrawingApprovals").style.display = "none";
    document.getElementById("newRevision").style.display = "none";
    document.getElementById("editRevision").style.display = "none";



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
    let site = print_location;
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

    

    var columnDefs = [
        {
            headerName: "",
            sortable: false,
            filter: false,
            cellClassRules: statuscheck,
            cellRenderer: function (d) {
                if (userinfo.user_name === "operation@alunafco.com" || userinfo.user_name === "demo") {
                    return $compile(`
                <button type="button" class="ism-btns btn-save" style="padding:2px 5px"
                ng-click="AddNewRevision_btn('${d.data.approvals_project_code}','${d.data.approvals_draw_no}','${d.data.approvals_token}','${d.data.approvals_draw_no}')"
                ><i class="fa fa-plus"></i></button>
                `)($scope)[0]
                } else {
                    return '-';
                }
            },
            width: 60,
        },
        {
            headerName: 'Sl.No',
            //cellRenderer: 'node.rowIndex + 1',
            valueGetter: "node.rowIndex + 1",
            filter: false,
            sortable: false,
            suppressMenu: false,
            cellClassRules: statuscheck,
            width: 65,

        },
        {
            headerName: 'File',
            field: 'f',
            sortable: false,
            cellRenderer: function (p) {
                let title = `${p.data.approvals_project_code} # DRAWING NO  ${p.data.approvals_draw_no}# RECEIVED DATE  ${p.data.approvals_infos_receivedon}`;

                return p.data.f === '1' ? `
                <a href="${site}assets/drawingapprovals/${p.data.approvals_last_revision_no}.pdf?v=${v}" download='${title}'>
                    <i class="fa fa-download"></i>
                </a>
                <a href="${site}assets/drawingapprovals/${p.data.approvals_last_revision_no}.pdf?v=${v}" target="_blank">
                    <i class="fa fa-eye"></i>
                </a>
                ` : ``;
            },
            filter: false,
            cellClassRules: statuscheck,
            width: 70,

        },
        {
            headerName: 'Project No',
            field: 'approvals_project_code',
            sortingOrder: ['asc', 'desc'],
            cellClassRules: statuscheck,
            width: 70,
        },
        {
            headerName: 'Project Name',
            field: 'project_name',
            sortingOrder: ['asc', 'desc'],
            cellClassRules: statuscheck,
            width: 152,
        },
        {
            headerName: 'Approval For',
            field: 'types_name',
            sortingOrder: ['asc', 'desc'],
            cellClassRules: statuscheck,
            width: 200,
        },
        {
            headerName: 'Drawing No',
            field: 'approvals_draw_no',
            filter: 'agTextColumnFilter',
            cellRenderer: function (p) {
                return $compile(`
                <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" ng-click="Revision_btnListnew('${p.data.approvals_project_code}','${p.data.approvals_token}','${p.data.approvals_draw_no}')">
                    ${p.data.approvals_draw_no}
                </button> `)($scope)[0];
            },
            sortingOrder: ['asc', 'desc'],
            cellClassRules: statuscheck,
            width: 220,
        },
        {
            headerName: 'Code',
            field: 'approvals_last_status',
            sortingOrder: ['asc', 'desc'],
            cellClassRules: statuscheck,
            width: 60,
        },
        {
            headerName: 'Description',
            field: 'approvals_descriptions',
            filter: 'agTextColumnFilter',
            sortingOrder: ['asc', 'desc'],
            cellClassRules: statuscheck,
            width: 553,
        },
        {
            headerName: 'Rev #',
            field: 'approvals_last_revision_code',
            sortingOrder: ['asc', 'desc'],
            cellClassRules: statuscheck,
            width: 53,
        },
        {
            headerName: 'SUB #',
            field: 'approvals_infos_sub',
            filter: 'agTextColumnFilter',
            sortingOrder: ['asc', 'desc'],
            cellClassRules: statuscheck,
            width: 214,
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
            width: 120,

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
            width: 120,
        },
        {
            headerName: 'Client Sign On',
            field: 'approvals_infos_clienton_d',
            sortingOrder: ['asc', 'desc'],
            cellClassRules: statuscheck,
            width: 120,
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
            width: 80,
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


    rpt();
    async function rpt() {
        const res = await ms.getAllDrawingApprovals();
        console.log(res);
        if (res.msg !== 1) {
            alert(res.data);
            return;
        }
        gridOptions.api.setRowData(res.data);
    }


    $scope.Revision_btnListnew = (pcode, ptoken, dno) => {
        let post_data = {
            naf_user: userinfo,
            project_no: pcode,
            drawing_no: ptoken
        };
        document.getElementById('revision_list').style.display = 'flex';

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


    //load metro projects
    $scope.projects = [];
    loadprojects();
    async function loadprojects() {
        $scope.projects = [];
        const p = await ms.getAllmetroprojects();
        if (p.msg !== 1) {
            alert(res.data);
            return;
        }
        $scope.projects = p.data;
        $scope.$apply();
    }
    //load approval for
    $scope.drawapprovals = [];
    loadDrawingapprovals();
    function loadDrawingapprovals() {
        $scope.drawapprovals = [];
        var post_data = {
            naf_user: userinfo
        };
        $http({
            method: 'post',
            url: api_url + "DrawingApprovalsTypes/index.php",
            data: post_data
        }).then(
            function (res) {
                console.log(res.data);
                if (res.data.msg == "1") {
                    $scope._dapprovals = res.data.data;
                    $scope.drawapprovals = res.data.data;

                } else {
                    alert(res.data.data);
                }
            }
        );

    }

    //save new drawing approval type
    $scope.drawingapprovalstype = {
        drawing_type_new: "",
    };

    $scope.save_new_approvaltype_click = () => {
        const drawing_type_new = document.getElementById("drawing_type_new");
        if (drawing_type_new.value.trim() === "") {
            alert("Enter Approval Category");
            drawing_type_new.focus();
            return;
        }
        var post_data = {
            naf_user: userinfo,
            drawing_types_new: drawing_type_new.value.trim()
        };
        $http.post(api_url + "DrawingApprovalsTypes/new.php", post_data)
            .then(
                (res) => {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert("saved");
                        $scope.drawingapprovalstype = {
                            drawing_type_new: "",
                        };
                        loadDrawingapprovals();
                        drawing_type_new.focus();
                    } else {
                        alert(res.data.data);
                    }
                }
            )
    }
    //save drawing approvals 
    $scope.savedrawingapprovals_submit = () => {
        let project_id = document.getElementById("project_id");
        var post_data = {
            naf_user: userinfo,
            newapproval: $scope.newapproval,
            project_no: project_id.value.trim()
        };

        $http.post(api_url + "DrawingApprovals/new.php", post_data)
            .then(
                function (res) {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert("Saved");
                        $scope.newapproval = {
                            approvals_for: '',
                            approvals_draw_no: '',
                            approvals_descriptions: ''
                        };
                        rpt();
                    } else {
                        alert(res.data.data);
                    }
                }
            )
    }

    $scope.exportExcel = function () {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {

            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();
            var mname = `METRO WORK SHOP DRAWING REPORT AS ON DATE ${day}-${month}-${year}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: mname,
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }

    $scope.clearFilters = function () {
        gridOptions.columnApi.applyColumnState({
            defaultState: {
                sort: null,
            },
        });
        gridOptions.api.setFilterModel(null);
    }
    //aprovals

    //-new revesion
    $scope.newrevisions = {
        project_code: "",
        approvals_token: "",
        approvals_draw_no: "",
        approvals_info_reveision_no: "",
        approvals_info_sub: "",
        approvals_info_submited_on: "",
        approvals_info_received_on: "",
        approvals_info_client_on: "",
        approvals_info_code: "",
        approvals_info_remarks: "",
    }
    let ndate = new Date();
    let dpd = `${ndate.getDate()}-${ndate.getMonth() + 1}-${ndate.getFullYear()}`;
    $scope.AddNewRevision_btn = (pjcode, drno, aptoken, drnos) => {
        console.log(pjcode, drno, aptoken, drnos);

        $scope.newrevisions = {
            project_code: pjcode,
            approvals_token: aptoken,
            approvals_draw_no: drno,
            approvals_info_reveision_no: "",
            approvals_info_sub: "",
            approvals_info_submited_on: dpd,
            approvals_info_received_on: "",
            approvals_info_client_on: "",
            approvals_info_code: "",
            approvals_info_remarks: "",
        };

        document.getElementById("newRevision").style.display = "flex";
    }

    $scope.isloadingsave = false;
    $("#save_drawing_approvals").submit(function (e) {
        if ($scope.isloadingsave) {
            console.log("Already process runnging");
            return;
        }
        $scope.isloadingsave = true;
        e.preventDefault();
        var fd = new FormData(this);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        $.ajax({
            url: api_url + "DrawingApprovals/newinfo.php",
            data: fd,
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                //console.log("reponse return");
                $scope.isloadingsave = false;

                if (res.msg === "1") {
                    $scope.newrevisions = {
                        ...$scope.newrevisions,
                        approvals_info_reveision_no: "",
                        approvals_info_sub: "",
                        approvals_info_submited_on: dpd,
                        approvals_info_received_on: "",
                        approvals_info_client_on: "",
                        approvals_info_code: "",
                        approvals_info_remarks: "",
                    };
                    alert("saved");
                    document.getElementById("newRevision").style.display = "none";
                    rpt();
                } else {
                    alert(res.data);
                }
            }

        })

    })

    //--revesion edit
    $scope.edit_revision = function ($rinfos) {
        console.log("working");
        document.getElementById('editRevision').style.display = 'flex';
        $scope.editrelease = $rinfos;
        // document.getElementById('_drawingno').innerText = ainfo.approvals_draw_no;
        // document.getElementById('_drawingnos').innerText = $rinfos.approvals_info_drawing_no;
    }


    $("#edit_drawing_approvals").submit(function (e) {
        //console.log("response");
        if ($scope.isloadingsave) {
            console.log("Already process runnging");
            return;
        }
        $scope.isloadingsave = true;
        e.preventDefault();

        var fd = new FormData(this);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        $.ajax({
            url: api_url + "DrawingApprovals/updateDrawinginfo.php",
            data: fd,
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                $scope.isloadingsave = false;
                //console.log("reponse return");
                console.log(res);
                if (res.msg === "1") {
                    alert("saved");
                    rpt();
                } else {
                    alert(res.data);
                }
            }

        })


    });

    $scope.printResult = () => {
        let pdata = [];
        let printdata = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(i => {
            printdata.push(i.data);
        });
        if (printdata.length === 0) {
            alert("No Data Found...");
            return;
        }
        var loc = print_location + "pprint/metro/drawings.html";
        localStorage.setItem("metrodrawingapprovals", JSON.stringify(printdata));
        window.open(loc, '_blank', "width = '1300px'height = '600px'");
    }


}