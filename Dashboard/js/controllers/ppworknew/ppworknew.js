app.controller('ppworknew', ppworknew);
function ppworknew($scope, $http, $routeParams) {
    const _mode = $routeParams.type;
    var site = print_location;
    console.log(_mode);
    if (_mode !== 'whtopp' || _mode !== "fctopp") {
        //location.href = site;
    }
    document.getElementById("rpt_materials").classList.add('menuactive');
    document.title = "POWDER COTTINGS REPORT - PMS";
    let excelfilename = "";
    let printtitle = "";
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth();
    var year = date.getFullYear();
    switch (_mode) {
        case 'whtopp':
            $scope.dialogtitle = "Warehouse To Paint Plant";
            $scope._pagemaintitle = "WAREHOUSE TO PAINT PLANT - REPORT";
            excelfilename = `Warehouse To Paint Plant  AS ON DATE ${day}-${month}-${year}`;
            printtitle = `WAREHOUSE TO PAINT PLANT REPORT AS ON DATE ${day}-${month}-${year}`;
            break;
        case 'fctopp':
            $scope.dialogtitle = "Factory To Paint Plant";
            $scope._pagemaintitle = "FACTORY TO PAINT PLANT  - REPORT";
            excelfilename = `Factory To Paint Plant  AS ON DATE ${day}-${month}-${year}`;
            printtitle = `FACTORY TO PAINT PLANT AS ON DATE ${day}-${month}-${year}`;
            break;
           
        default:
            $scope.dialogtitle = "Warehouse To Paint Plant";
            $scope._pagemaintitle = "WAREHOUSE TO PAINT PLANT - REPORT";
            excelfilename = `Factory To Paint Plant  AS ON DATE ${day}-${month}-${year}`;
            printtitle = `WAREHOUSE TO PAINT PLANT REPORT AS ON DATE ${day}-${month}-${year}`;
            break;
    }


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
        var bh = wsize - 165;
        var bhbh = bh - 35 - 10 - 7;
        var bhbhbh = bh - 35 - 27;
        document.querySelector(".sub-body-container").style.height = bh + "px";
        document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container").style.maiHeight = bh + "px";
        var docwith = window.innerWidth;
        var mbodyw = document.querySelector(".ism-bodys").offsetWidth;
    }


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

    if (userinfo.user_name === 'demo' || userinfo.user_name === 'materials') {
        columnDefs.push({
            headerName: 'EDIT',
            cellRenderer: function (p) {
                return `<button class="ism-btns btn-delete" style="padding: 2px 2px;" onclick="editppworknew('${p.data.ppid}')">
            <i class="fa fa-edit"></i>
            Edit</button>`
            },
            sortingOrder: ['asc', 'desc'],
            width: 90
        })

        columnDefs.push({
            headerName: 'Receipt',
            cellRenderer: function (p) {
                return `<button class="ism-btns btn-delete" style="padding: 2px 2px;" onclick="createReceipt('${p.data.ppid}')">
                <i class="fa fa-edit"></i>
                Receipt</button>`
            },
            sortingOrder: ['asc', 'desc'],
            width: 120
        })
    }

    columnDefs.push({
        headerName: 'PROJECT NAME',
        field: 'ppproject',
        cellRenderer: function (_) {
            return `${_.data.ppproject} [${_.data.pjno}]`;
        },
        sortingOrder: ['asc', 'desc'],
        width: 228,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'TYPE',
        field: 'pptype',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'DESCRIPTIOIN',
        field: 'ppdescription',
        sortingOrder: ['asc', 'desc'],
        width: 320,
        filter: 'agMultiColumnFilter',
    })
    columnDefs.push({
        headerName: 'COLOR',
        field: 'ppcolor',
        sortingOrder: ['asc', 'desc'],
        width: 318,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'QTY/PC',
        field: 'qty',
        sortingOrder: ['asc', 'desc'],
        width: 80,
        filter: 'agNumberColumnFilter',
    })

    columnDefs.push({
        headerName: 'RECEIVED',
        field: 'receiptqty',
        cellRenderer: function (_) {
            return `<button class="ism-btns btn-delete" style="padding: 2px 2px;" type="button" onclick="getReceiptInfo('${_.data.ppid}')">${_.data.receiptqty}</button>`;
        },
        sortingOrder: ['asc', 'desc'],
        width: 80,
        filter: 'agNumberColumnFilter',
    })

    columnDefs.push({
        headerName: 'BALANCE',
        field: 'balance',
        sortingOrder: ['asc', 'desc'],
        width: 80,
        filter: 'agNumberColumnFilter',
    })

    columnDefs.push({
        headerName: 'Wt/Kg',
        field: 'totkg',
        sortingOrder: ['asc', 'desc'],
        width: 80,
        filter: 'agNumberColumnFilter',
    })



    columnDefs.push({
        headerName: 'DEL.No',
        field: 'delno',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'Date',
        field: 'ppdate',
        cellRenderer: function (p) {
            return `<div>${p.data.ppdate_d}</div>`
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        sort: 'desc',
        width: 120,
    })

    columnDefs.push({
        headerName: 'ETA',
        field: 'eta',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        filter: 'agMultiColumnFilter',
    })


    columnDefs.push({
        headerName: 'LOCATION',
        field: 'location',
        sortingOrder: ['asc', 'desc'],
        width: 200,
        filter: 'agMultiColumnFilter',
    })
    columnDefs.push({
        headerName: 'REMARKS',
        field: 'remarks',
        sortingOrder: ['asc', 'desc'],
        width: 200,
        filter: 'agMultiColumnFilter',
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

            var param = {
                fileName: excelfilename,
                sheetName: "SHEET1",
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }
    // NewGetReport();
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    getAllProjects();
    function getAllProjects() {
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        const post_data = {
            url: `${api_url}ppwork/projects.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        }

        const req = $http(post_data);
        req.then(
            (res) => {
                //console.log(res.data.data);
                if (res?.data?.msg === "1") {
                    $scope.projectlist = res.data.data;
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                } else {
                    _apiError(res.data);
                }
            }
        )
    }

    let _process = false;
    loadAll();
    _autoCompleateWorks();
    function loadAll() {
        if (!_process) {
            _process = true;
            const fd = new FormData();
            fd.append('user_name', userinfo.user_name);
            fd.append('user_token', userinfo.user_token);
            fd.append('pptype', _mode);

            const post_data = {
                url: `${api_url}ppworknew/index.php`,
                data: fd,
                method: "POST",
                headers: {
                    'content-type': undefined
                }
            };

            const req = $http(post_data);
            req.then(res => {
                _process = false;
                console.log(res.data);
                if (res?.data?.msg === '1') {
                    gridOptions.api.setRowData(res.data.data);
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                } else if (res?.data?.msg === "404") {
                    alert("USER AUTHENTICATION ERROR");
                    ///location.href = `${site}/logout.php`;
                } else {
                    console.log("API ERROR... CHECK IN CONSOLE");
                }
            })
        } else {
            console.log("Another Process is Running.")
        }
    }

    let dia_saveData = document.getElementById('dia_saveData');
    $scope.addnewentry = () => {
        if (!_process) {
            dia_saveData.style.display = "flex";
            //dia_saveData.style.zoom = "110%";
        } else {
            alert("Another Process is Running....")
        }
    }



    let ppproject = document.getElementsByName("ppproject")[0];
    let pptype = document.getElementsByName("pptype")[0];
    let ppdescription = document.getElementsByName("ppdescription")[0];
    let ppcolor = document.getElementsByName("ppcolor")[0];
    let qty = document.getElementsByName("qty")[0];
    let totkg = document.getElementsByName("totkg")[0];
    let delno = document.getElementsByName("delno")[0];
    let ppdate = document.getElementsByName("ppdate")[0];
    let eta = document.getElementsByName("eta")[0];
    let location = document.getElementsByName("location")[0];
    let remarks = document.getElementsByName("remarks")[0];

    ppproject.addEventListener('keydown', (_) => {
        if (_.which === 13) {
            pptype.focus();
        }
    })

    pptype.addEventListener('keydown', (_) => {
        if (_.which === 13) {
            ppdescription.focus();
        }
    })

    ppdescription.addEventListener('keydown', (_) => {
        if (_.which === 13) {
            ppcolor.focus();
        }
    })


    ppcolor.addEventListener('keydown', (_) => {
        if (_.which === 13) {
            qty.focus();
        }
    })


    qty.addEventListener('keydown', (_) => {
        if (_.which === 13) {
            totkg.focus();
        }
    })

    totkg.addEventListener('keydown', (_) => {
        if (_.which === 13) {
            delno.focus();
        }
    })

    delno.addEventListener('keydown', (_) => {
        if (_.which === 13) {
            ppdate.focus();
        }
    })

    ppdate.addEventListener('keydown', (_) => {
        if (_.which === 13) {
            eta.focus();
        }
    })

    eta.addEventListener('keydown', (_) => {
        if (_.which === 13) {
            location.focus();
        }
    })

    location.addEventListener('keydown', (_) => {
        if (_.which === 13) {
            remarks.focus();
        }
    })

    remarks.addEventListener('keydown', (_) => {
        if (_.which === 13) {
            _validate();
        }
    })

    $scope.saveDataFrm_submit = () => _validate();

    function _validate() {
        if (ppproject.value === '') {
            $scope.errormsg = "Select Any Project";
            return;
        }
        if (pptype.value === '') {
            $scope.errormsg = "Enter Material Type";
            return;
        }
        if (ppdescription.value === '') {
            $scope.errormsg = "Enter Material Description";
            return;
        }
        if (ppcolor.value === '') {
            $scope.errormsg = "Enter Required Color";
            return;
        }
        if (qty.value === '') {
            $scope.errormsg = "Enter QTY/PCS";
            return;
        }
        if (totkg.value === '') {
            $scope.errormsg = "Enter Wt/Kg";
            return;
        }
        if (delno.value === '') {
            $scope.errormsg = "Enter DEL.No";
            return;
        }
        if (ppdate.value === '') {
            $scope.errormsg = "Enter Date";
            return;
        }
        if (eta.value === '') {
            $scope.errormsg = "Enter ETA";
            return;
        }
        if (location.value === '') {
            $scope.errormsg = "Enter Location";
            return;
        }
        if (remarks.value === '') {
            $scope.errormsg = "Enter Remarks";
            return;
        }


        _saveAction();
    }

    function _saveAction() {
        const frm = document.getElementById("saveDataFrm");
        let pjno = ppproject.options[ppproject.selectedIndex].text;

        const fd = new FormData(frm);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('type', _mode);
        fd.append('pjno', pjno)

        const post_data = {
            url: `${api_url}ppworknew/new.php`,
            data: fd,
            method: "POST",
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);
        req.then(res => {
            console.log(res.data);
            if (res?.data?.msg === "1") {
                $scope.errormsg = "Saved";
                $scope.newSaveppData = {};
                loadAll();
                _autoCompleateWorks()
                ppproject.focus();

            } else if (res?.data?.msg === "0") {
                $scope.errormsg = res.data.data;
            } else if (res?.data?.msg === "404") {
                alert("USER AUTHENTICATION ERROR.");
                location.href = `${site}logout.php`
            } else {
                alert("API ERROR,CHECK IN CONSOLE....");
                console.error(res.data);
            }
        })
    }

    //update event

    let edit_qty = document.getElementsByName("qty")[1];
    let edit_totkg = document.getElementsByName("totkg")[1]
    let edit_eta = document.getElementsByName("eta")[1];
    let edit_location = document.getElementsByName("location")[1];
    let edit_remarks = document.getElementsByName("remarks")[1];

    edit_qty.addEventListener('keydown', (_) => {
        if (_.which === 13) {
            edit_totkg.focus();
        }
    })

    edit_totkg.addEventListener('keydown', (_) => {
        if (_.which === 13) {
            edit_eta.focus();
        }
    })

    edit_eta.addEventListener('keydown', (_) => {
        if (_.which === 13) {
            edit_location.focus();
        }
    })

    edit_location.addEventListener('keydown', (_) => {
        if (_.which === 13) {
            edit_remarks.focus();
        }
    })

    edit_remarks.addEventListener('keydown', (_) => {
        if (_.which === 13) {
            _editValidate();
        }
    })

    $scope.editDataFrm_submit = () => _editValidate();
    function _editValidate() {
        if (edit_qty.value === "") {
            $scope.erromsg_edit = "Enter QTY/PCS"
            return;
        }

        if (edit_totkg.value === "") {
            $scope.erromsg_edit = "Enter Wt/Kg"
            return;
        }

        if (edit_eta.value === "") {
            $scope.erromsg_edit = "Enter ETA"
            return;
        }

        if (edit_location.value === "") {
            $scope.erromsg_edit = "Enter Location"
            return;
        }

        if (edit_remarks.value === "") {
            $scope.erromsg_edit = "Enter Remark"
            return;
        }

        if (isNaN(edit_qty.value)) {
            $scope.erromsg_edit = "QTY/PCS is not a valid Number"
            return;
        }

        _updateData();
    }

    function _updateData() {
        if (!_process) {
            _process = true;
            const frm = document.getElementById("editDataFrm");
            const fd = new FormData(frm);
            fd.append('user_name', userinfo.user_name);
            fd.append('user_token', userinfo.user_token);

            const post_data = {
                url: `${api_url}ppworknew/update.php`,
                data: fd,
                method: 'POST',
                headers: {
                    'content-type': undefined
                }
            };

            const req = $http(post_data);

            req.then(
                res => {
                    _process = false;
                    if (res?.data?.msg === "1") {
                        $scope.erromsg_edit = "UPDATED";
                        loadAll();
                        _autoCompleateWorks();
                    } else if (res?.data?.msg === "404") {
                        alert("USER AUTHENTICATION ERROR");
                        location.href = `${site}logout.php`;
                    } else if (res?.data?.msg === "0") {
                        $scope.erromsg_edit = res.data.data;
                    } else {
                        alert("API ERROR , CHECK IN CONSOLE.....");
                        console.log(res.data);
                    }
                }
            )
        } else {
            $scope.erromsg_edit = "Another Process is running...";
        }

    }


    $scope.removeitemnow = (id, type) => {
        console.log(id, type);
        const fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('ppid', id);
        fd.append('type', type);

        const post_data = {
            url: `${api_url}ppworknew/delete.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(res => {
            if (res?.data?.msg === "1") {
                alert("Removed");
                loadAll();
                document.getElementById("dia_EditData").style.display = "none";
            } else if (res?.data?.msg === "0") {
                alert(res.data.data);
            } else if (res?.data?.msg === "404") {
                alert("USER AUTHENTICATION ERROR.");
                location.href = `${site}logout.php`
            } else {
                alert("API ERROR,CHECK IN CONSOLE....");
                console.error(res.data);
            }
        })
    }

    $scope.printResult = () => {
        let _data = [];

        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _data.push(_.data);
        })

        let printwindow = window.open(`${print_location}/sprint/pprpt.html`, '_blank', "width:1300px;height:700px");
        printwindow.forprintdata = JSON.stringify(_data);

        printwindow.project_name = $scope.viewproject.project_name;
        printwindow.type = "N";



    }


    $scope.ppnewMaterialTypeList = [];
    $scope.ppnewDescriptionList = [];
    $scope.ppnewColorList = [];
    $scope.ppnewunitlist = [];
    $scope.ppnewLocationList = [];
    $scope.ppnewRemarkList = [];

    function _autoCompleateWorks() {
        $scope.ppnewMaterialTypeList = [];
        $scope.ppnewDescriptionList = [];
        $scope.ppnewColorList = [];
        $scope.ppnewunitlist = [];
        $scope.ppnewLocationList = [];
        $scope.ppnewRemarkList = [];

        const post_data = {
            url: `${api_url}ppworknew/autoc.php`,
            method: "GET",
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(res => {
            let matlist = res?.data?.materiallist ?? [];
            let matlistpp = res?.data?.materiallistpp ?? [];


            matlist.map((_) => {
                let a = $scope.ppnewMaterialTypeList.includes(_);
                if (!a) {
                    $scope.ppnewMaterialTypeList.push(_)
                }
            })

            matlistpp.map((_) => {
                let a = $scope.ppnewMaterialTypeList.includes(_);
                if (!a) {
                    $scope.ppnewMaterialTypeList.push(_)
                }
            })

            console.log($scope.ppnewMaterialTypeList);

            let ppnewDescriptionList = res?.data?.descriptionlist ?? [];
            let ppnewDescriptionListpp = res?.data?.descriptionlistpp ?? [];

            ppnewDescriptionList.map((_) => {
                let a = $scope.ppnewDescriptionList.includes(_);
                if (!a) {
                    $scope.ppnewDescriptionList.push(_);
                }
            })

            ppnewDescriptionListpp.map((_) => {
                let a = $scope.ppnewDescriptionList.includes(_);
                if (!a) {
                    $scope.ppnewDescriptionList.push(_);
                }
            })

            let colorlist = res?.data?.colorlist ?? [];
            let colorlistpp = res?.data?.colorlistPP ?? [];

            colorlist.map((_) => {
                let a = $scope.ppnewColorList.includes(_);
                if (!a) {
                    $scope.ppnewColorList.push(_);
                }
            })

            colorlistpp.map((_) => {
                let a = $scope.ppnewColorList.includes(_);
                if (!a) {
                    $scope.ppnewColorList.push(_);
                }
            })

            let unitlist = res?.data?.unitlist ?? [];

            unitlist.map((_) => {
                let a = $scope.ppnewunitlist.includes(_);
                if (!a) { $scope.ppnewunitlist.push(_); }
            });

            let locationlist = res?.data?.locationlist ?? [];
            locationlist.map((_) => {
                let a = $scope.ppnewLocationList.includes(_);
                if (!a) { $scope.ppnewLocationList.push(_); }
            })

            let remarklist = res?.data?.remarklist ?? [];
            remarklist.map((_) => {
                let a = $scope.ppnewRemarkList.includes(_);
                if (!a) { $scope.ppnewRemarkList.push(_); }
            })


        })
    }

    //receipt action 

    let returndate = document.getElementsByName("returndate")[0];
    let returnqty = document.getElementsByName("returnqty")[0];
    let rcpno = document.getElementsByName("rcpno")[0];
    let remark = document.getElementsByName("remark")[0];

    returndate.addEventListener("keydown", (_) => {
        if (_.which === 13) {
            returnqty.focus();
        }
    });

    returnqty.addEventListener("keydown", (_) => {
        if (_.which === 13) {
            rcpno.focus();
        }
    });

    rcpno.addEventListener("keydown", (_) => {
        if (_.which === 13) {
            remark.focus();
        }
    });

    remark.addEventListener("keydown", (_) => {
        if (_.which === 13) {
            remark.focus();
        }
    });

    $scope.receiptNew_submit = () => _Receiptvalidate();

    function _Receiptvalidate() {
        if (returndate.value === "") {
            alert("Eneter Date");
            return;
        }
        if (returnqty.value === "") {
            alert("Eneter QTY");
            return;
        }
        if (rcpno.value === "") {
            alert("Eneter Receipt NO");
            return;
        }
        if (remark.value === "") {
            alert("Eneter Remark");
            return;
        }

        ReceiptSave();
    }

    function ReceiptSave() {
        let frm = document.getElementById("receiptNew");
        const fd = new FormData(frm);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        const post_data = {
            url: `${api_url}ppworknew/newreceipt.php`,
            data: fd,
            method: "POST",
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(res => {
            console.log(res.data);
            if (res?.data?.msg === "1") {
                alert("SAVED");
                $scope.newReceipt = {};
                returndate.focus();
                loadAll();
                //$scope.$apply();
            } else if (res?.data?.msg === "0") {
                alert(res.data.data);
            } else if (res?.data?.msg === "404") {
                alert("USER AUTHENTICATION ERROR");
                location.href = `${site}logout.php`;
            } else {
                alert("API ERROR , CHECK CONSOLE");
            }
        })
    }

    $scope.removeitemrc = (id) => {
        console.log(id);
        const fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('returnid', id);

        const post_data = {
            url: `${api_url}ppworknew/deleterc.php`,
            data: fd,
            method: "POST",
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(res => {
            console.log(res.data);
            if (res?.data?.msg === "1") {
                alert("saved");
                location.reload();
            } else if (res?.data?.msg === "404") {
                alert("USER AUTHENTICATION ERROR");
                location.href = `${site}logout.php`;
            } else if (res?.data?.msg === "0") {
                alert(res.data.data);
            } else {
                alert("API ERROR , CHECK CONSOLE");
            }
        })
    }


}

function editppworknew(id) {
    const fd = new FormData();
    fd.append('user_name', userinfo.user_name);
    fd.append('user_token', userinfo.user_token);
    fd.append('ppid', id);

    fetch(`${api_url}ppworknew/get.php`, {
        method: 'POST',
        body: fd
    }).then(r => r.json())
        .then(res => {
            if (res?.msg === "1") {
                let dia = document.getElementById("dia_EditData");
                let scope = angular.element(dia).scope();
                dia.style.display = "flex";
                scope.newEditppData = res?.data ?? {};
                scope.$apply();
                document.getElementsByName("ppproject")[1].style.pointerEvents = "none"
            } else if (res?.msg === "0") {
                alert(res.data);
            } else if (res?.msg === "404") {
                alert("USER AUTHENTICATION ERROR");
                location.href = `${print_location}/logout.php`;
            } else {
                alert("API ERROR, CHECK IN CONSOLE....");
                console.log(res);
            }
        })
}

function createReceipt(id) {
    let dia = document.getElementById("dia_receiptdata");
    let x = document.getElementsByName("ppid")[0];
    var scope = angular.element(dia).scope();
    scope.ppid = id;
    scope.newReceipt = {};
    scope.$apply();
    dia.style.display = "flex";
}

function getReceiptInfo(id) {
    const fd = new FormData();
    fd.append('user_name', userinfo.user_name);
    fd.append('user_token', userinfo.user_token);
    fd.append('ppid', id);

    fetch(`${api_url}ppworknew/getreceipt.php`, {
        body: fd,
        method: 'POST',
    }).then(r => r.json())
        .then(res => {
            if (res?.msg === "1") {
                let x = res?.data ?? [];
                if (x.length === 0) {
                    alert("NO DATA FOUND");
                    return;
                }
                let dia = document.getElementById("dia_pprecived_info");
                let scope = angular.element(dia).scope();
                scope.recivedlist = x;
                scope.$apply();
                dia.style.display = "flex";
            } else if (res?.msg === "0") {
                alert(res.data);
            } else if (res?.msg === "404") {
                alert("USER AUTHENTICATION ERROR");
                location.href = `${print_location}/logout.php`;
            } else {
                alert("API ERROR, CHECK IN CONSOLE....");
                console.log(res);
            }
        })

}



app.controller("ppworknewallx", ppworknewallx);

function ppworknewallx($scope, $http) {
    let _rptdata = [];
    document.getElementById("rpt_materials").classList.add('menuactive');
    document.title = "POWDER COTTINGS BALANCE REPORT - PMS";
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth();
    var year = date.getFullYear();
    let excelfilename = `POWDER COTTINGS BALANCE AS ON DATE ${day}-${month}-${year}`;
    let printtitle = `POWDER COTTINGS BALANCE AS ON DATE ${day}-${month}-${year}`;
    //windows auto height adjust
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
        var bh = wsize - 170;
        var bhbh = bh - 35 - 10 - 7;
        var bhbhbh = bh - 35 - 27;
        document.querySelector(".sub-body-container").style.height = bh + "px";
        document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container").style.maiHeight = bh + "px";
        var docwith = window.innerWidth;
        var mbodyw = document.querySelector(".ism-bodys").offsetWidth;
    }


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

    //windows auto height adjust

    //grid
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
        headerName: 'PROJECT NAME',
        field: 'ppproject',
        cellRenderer: function (_) {
            return `${_.data.ppproject} [${_.data.pjno}]`;
        },
        sortingOrder: ['asc', 'desc'],
        width: 228,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'TYPE',
        field: 'pptype',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'DESCRIPTIOIN',
        field: 'ppdescription',
        sortingOrder: ['asc', 'desc'],
        width: 320,
        filter: 'agMultiColumnFilter',
    })
    columnDefs.push({
        headerName: 'COLOR',
        field: 'ppcolor',
        sortingOrder: ['asc', 'desc'],
        width: 318,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'QTY/PC',
        field: 'qty',
        sortingOrder: ['asc', 'desc'],
        width: 80,
        filter: 'agNumberColumnFilter',
    })

    columnDefs.push({
        headerName: 'RECEIVED',
        field: 'receiptqty',
        cellRenderer: function (_) {
            return `<button class="ism-btns btn-delete" style="padding: 2px 2px;" type="button" onclick="getReceiptInfo('${_.data.ppid}')">${_.data.receiptqty}</button>`;
        },
        sortingOrder: ['asc', 'desc'],
        width: 80,
        filter: 'agNumberColumnFilter',
    })

    columnDefs.push({
        headerName: 'BALANCE',
        field: 'balance',
        sortingOrder: ['asc', 'desc'],
        width: 80,
        filter: 'agNumberColumnFilter',
    })

    columnDefs.push({
        headerName: 'Wt/Kg',
        field: 'totkg',
        sortingOrder: ['asc', 'desc'],
        width: 80,
        filter: 'agNumberColumnFilter',
    })



    columnDefs.push({
        headerName: 'DEL.No',
        field: 'delno',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'Date',
        field: 'ppdate',
        cellRenderer: function (p) {
            return `<div>${p.data.ppdate_d}</div>`
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        sort: 'desc',
        width: 120,
    })

    columnDefs.push({
        headerName: 'ETA',
        field: 'eta',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        filter: 'agMultiColumnFilter',
    })


    columnDefs.push({
        headerName: 'LOCATION',
        field: 'location',
        sortingOrder: ['asc', 'desc'],
        width: 200,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'REMARKS',
        field: 'remarks',
        sortingOrder: ['asc', 'desc'],
        width: 200,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'TYPE',
        field: 'typef',

        sortingOrder: ['asc', 'desc'],
        width: 250,
        filter: 'agMultiColumnFilter',
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

            var param = {
                fileName: excelfilename,
                sheetName: "SHEET1",
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }
    // NewGetReport();
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    //grid

    //apis
    loadAll();
    function loadAll() {
        const fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        const post_data = {
            url: `${api_url}ppworknew/allpp.php`,
            data: fd,
            method: "POST",
            headers: {
                'content-type': undefined
            }
        };
        const req = $http(post_data);
        req.then(res => {
            _process = false;
            console.log(res.data);
            if (res?.data?.msg === '1') {
                const fdata = res.data.data.filter(x => (+x.balance) !== 0);
                _rptdata = fdata;
                gridOptions.api.setRowData(fdata);
            } else if (res?.data?.msg === "0") {
                alert(res.data.data);
            } else if (res?.data?.msg === "404") {
                alert("USER AUTHENTICATION ERROR");
                ///location.href = `${site}/logout.php`;
            } else {
                console.log("API ERROR... CHECK IN CONSOLE");
            }
        })
    }



    $scope.printResult = () => {
        let _data = [];

        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _data.push(_.data);
        })

        let printwindow = window.open(`${print_location}/sprint/pprpt.html`, '_blank', "width:1300px;height:700px");
        printwindow.forprintdata = JSON.stringify(_data);

       // printwindow.project_name = $scope.viewproject.project_name;
        printwindow.type = "N";

    }


    $scope.datefilter = {
        diashow: false,
        isloading: false,
        data: {
            fromdate: '',
            todate : ''
        }
    };
    _getThisWeek();
    async function _getThisWeek() {
        console.log("AAAAAA");
        const req = await fetch(`${print_location}/api/cuttinglists/weekget.php`);
        const res = await req.json();
        if (res?.msg !== "1") {
            return;
        }

        $scope.datefilter = {
            ...$scope.datefilter,
            data: {
                fromdate: res.data.fday,
                todate : res.data.fd,
            }
        };

        console.log(res.data);
        console.log($scope.datefilter);

        $scope.$apply();

    }

    $scope.filterbydate = () => {
        const _fromdate = $scope.datefilter?.data?.fromdate ?? '';
        const _todate = $scope.datefilter?.data?.todate ?? '';
        if (!_fromdate || _fromdate === '') {
            alert("Enter Form Date");
            return;
        }

        if (!_todate || _todate === '') {
            alert("Enter To Date");
            return;
        }
        const fdate = _convertDate(_fromdate);
        const todate = _convertDate(_todate);
        gridOptions.api.setRowData([]);
        const filterdata = _rptdata.filter(x => x.ppdate >= fdate && x.ppdate <= todate);
        let sortdata = filterdata.sort((a, b) => {
            if (a.issuedate < b.issuedate) {
                return -1;
            }
            if (a.issuedate > b.issuedate) {
                return 1;
            }
            return 1;
        })
        gridOptions.api.setRowData(sortdata);
        gridOptions.columnApi.applyColumnState({
            state: [{ colId: 'issuedate', sort: 'desc' }],
        });
        $scope.datefilter['diashow'] = false;

    }

    function _convertDate(d) {
        const x = d.split('-');

        const date = x[0];
        const month = x[1];
        const year = x[2];

        return `${year}-${month}-${date}`;
    }
    

}





app.controller("ppworknewall", ppworknewall);

function ppworknewall($scope, $http) {
    let _rptdata = [];
    document.getElementById("rpt_materials").classList.add('menuactive');
    document.title = "POWDER COTTINGS REPORT - PMS";
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth();
    var year = date.getFullYear();
    let excelfilename = `Paint Plant All Report AS ON DATE ${day}-${month}-${year}`;
    let printtitle = `PAINT PLANT ALL REPORT AS ON DATE ${day}-${month}-${year}`;
    //windows auto height adjust
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
        var bh = wsize - 170;
        var bhbh = bh - 35 - 10 - 7;
        var bhbhbh = bh - 35 - 27;
        document.querySelector(".sub-body-container").style.height = bh + "px";
        document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container").style.maiHeight = bh + "px";
        var docwith = window.innerWidth;
        var mbodyw = document.querySelector(".ism-bodys").offsetWidth;
    }


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

    //windows auto height adjust

    //grid
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
        headerName: 'PROJECT NAME',
        field: 'ppproject',
        cellRenderer: function (_) {
            return `${_.data.ppproject} [${_.data.pjno}]`;
        },
        sortingOrder: ['asc', 'desc'],
        width: 228,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'TYPE',
        field: 'pptype',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'DESCRIPTIOIN',
        field: 'ppdescription',
        sortingOrder: ['asc', 'desc'],
        width: 320,
        filter: 'agMultiColumnFilter',
    })
    columnDefs.push({
        headerName: 'COLOR',
        field: 'ppcolor',
        sortingOrder: ['asc', 'desc'],
        width: 318,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'QTY/PC',
        field: 'qty',
        sortingOrder: ['asc', 'desc'],
        width: 80,
        filter: 'agNumberColumnFilter',
    })

    columnDefs.push({
        headerName: 'RECEIVED',
        field: 'receiptqty',
        cellRenderer: function (_) {
            return `<button class="ism-btns btn-delete" style="padding: 2px 2px;" type="button" onclick="getReceiptInfo('${_.data.ppid}')">${_.data.receiptqty}</button>`;
        },
        sortingOrder: ['asc', 'desc'],
        width: 80,
        filter: 'agNumberColumnFilter',
    })

    columnDefs.push({
        headerName: 'BALANCE',
        field: 'balance',
        sortingOrder: ['asc', 'desc'],
        width: 80,
        filter: 'agNumberColumnFilter',
    })

    columnDefs.push({
        headerName: 'Wt/Kg',
        field: 'totkg',
        sortingOrder: ['asc', 'desc'],
        width: 80,
        filter: 'agNumberColumnFilter',
    })



    columnDefs.push({
        headerName: 'DEL.No',
        field: 'delno',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'Date',
        field: 'ppdate',
        cellRenderer: function (p) {
            return `<div>${p.data.ppdate_d}</div>`
        },
        sortingOrder: ['asc', 'desc'],
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        sort: 'desc',
        width: 120,
    })

    columnDefs.push({
        headerName: 'ETA',
        field: 'eta',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        filter: 'agMultiColumnFilter',
    })


    columnDefs.push({
        headerName: 'LOCATION',
        field: 'location',
        sortingOrder: ['asc', 'desc'],
        width: 200,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'REMARKS',
        field: 'remarks',
        sortingOrder: ['asc', 'desc'],
        width: 200,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'TYPE',
        field: 'typef',

        sortingOrder: ['asc', 'desc'],
        width: 250,
        filter: 'agMultiColumnFilter',
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

            var param = {
                fileName: excelfilename,
                sheetName: "SHEET1",
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }
    // NewGetReport();
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    //grid

    //apis
    loadAll();
    function loadAll() {
        const fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        const post_data = {
            url: `${api_url}ppworknew/allpp.php`,
            data: fd,
            method: "POST",
            headers: {
                'content-type': undefined
            }
        };
        const req = $http(post_data);
        req.then(res => {
            _process = false;
            console.log(res.data);
            if (res?.data?.msg === '1') {
                _rptdata = res.data.data;
                gridOptions.api.setRowData(res.data.data);
            } else if (res?.data?.msg === "0") {
                alert(res.data.data);
            } else if (res?.data?.msg === "404") {
                alert("USER AUTHENTICATION ERROR");
                ///location.href = `${site}/logout.php`;
            } else {
                console.log("API ERROR... CHECK IN CONSOLE");
            }
        })
    }



    $scope.printResult = () => {
        let _data = [];

        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _data.push(_.data);
        })

        let printwindow = window.open(`${print_location}/sprint/pprpt.html`, '_blank', "width:1300px;height:700px");
        printwindow.forprintdata = JSON.stringify(_data);

        printwindow.project_name = $scope.viewproject.project_name;
        printwindow.type = "N";

    }

    $scope.datefilter = {
        diashow: false,
        isloading: false,
        data: {
            fromdate: '',
            todate : ''
        }
    };
    _getThisWeek();
    async function _getThisWeek() {
        console.log("AAAAAA");
        const req = await fetch(`${print_location}/api/cuttinglists/weekget.php`);
        const res = await req.json();
        if (res?.msg !== "1") {
            return;
        }

        $scope.datefilter = {
            ...$scope.datefilter,
            data: {
                fromdate: res.data.fday,
                todate : res.data.fd,
            }
        };

        console.log(res.data);
        console.log($scope.datefilter);

        $scope.$apply();

    }

    $scope.filterbydate = () => {
        const _fromdate = $scope.datefilter?.data?.fromdate ?? '';
        const _todate = $scope.datefilter?.data?.todate ?? '';
        if (!_fromdate || _fromdate === '') {
            alert("Enter Form Date");
            return;
        }

        if (!_todate || _todate === '') {
            alert("Enter To Date");
            return;
        }
        const fdate = _convertDate(_fromdate);
        const todate = _convertDate(_todate);
        gridOptions.api.setRowData([]);
        const filterdata = _rptdata.filter(x => x.ppdate >= fdate && x.ppdate <= todate);
        let sortdata = filterdata.sort((a, b) => {
            if (a.issuedate < b.issuedate) {
                return -1;
            }
            if (a.issuedate > b.issuedate) {
                return 1;
            }
            return 1;
        })
        gridOptions.api.setRowData(sortdata);
        gridOptions.columnApi.applyColumnState({
            state: [{ colId: 'issuedate', sort: 'desc' }],
        });
        $scope.datefilter['diashow'] = false;

    }

    function _convertDate(d) {
        const x = d.split('-');

        const date = x[0];
        const month = x[1];
        const year = x[2];

        return `${year}-${month}-${date}`;
    }



}