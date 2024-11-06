app.controller('pppptofac', pppptofac);

function pppptofac($scope, $http) {
    document.title = "POWDER COTTINGS REPORT [PAINT PLANT TO FACTORY] - PMS";
    document.getElementById('dialogTitleNeww').innerText = "Factory To Paint Plant";
    document.getElementById("powdercottingR").classList.add('menuactive');
    var site = print_location;
    window.addEventListener('resize', () => {
        maxbodyheight()
    })
    maxbodyheight();
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

    var columnDefs = [];
    if (userinfo.user_name === 'demo' || userinfo.user_name === 'barakth') {
        columnDefs.push({
            headerName: 'Edit',
            cellRenderer: function (p) {
                return `<button onclick="editinfo('${p.data.pprid}')">
            <i class="fa fa-edit"></i>
            Edit</button>`
            },
            sortingOrder: ['asc', 'desc'],
            width: 90,


        })
    }
    columnDefs.push({
        headerName: 'DEL.NO',
        field: 'pp_delno',
        sortingOrder: ['asc', 'desc'],
        width: 100,
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
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'Project No',
        field: 'pp_project',
        sortingOrder: ['asc', 'desc'],
        width: 110,
        filter: 'agMultiColumnFilter',

    })
    columnDefs.push({
        headerName: 'Project Name',
        field: 'pp_projectname',
        sortingOrder: ['asc', 'desc'],
        width: 228,
        filter: 'agMultiColumnFilter',
    })



    columnDefs.push({
        headerName: 'Type',
        field: 'pp_mtype',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'Part No',
        field: 'pppartno',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        filter: 'agMultiColumnFilter',
    })
    columnDefs.push({
        headerName: 'Mat.Type',
        field: 'ppitemtype',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'Description',
        field: 'pp_mdescription',
        sortingOrder: ['asc', 'desc'],
        width: 300,
        filter: 'agMultiColumnFilter',
    })
    columnDefs.push({
        headerName: 'Alloy',
        field: 'ppalloy',
        sortingOrder: ['asc', 'desc'],
        width: 90,
        filter: 'agMultiColumnFilter',
    })
    columnDefs.push({
        headerName: 'Length',
        field: 'pplenght',
        sortingOrder: ['asc', 'desc'],
        width: 90,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'Color',
        field: 'pp_color',
        sortingOrder: ['asc', 'desc'],
        width: 218,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'Die Wght',
        field: 'pp_dieweight',
        sortingOrder: ['asc', 'desc'],
        width: 97,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'QTY',
        field: 'pp_qty',
        sortingOrder: ['asc', 'desc'],
        width: 68,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'Tot Die Weight',
        field: 'ppbalancedie',
        sortingOrder: ['asc', 'desc'],
        width: 68,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'Received',
        field: 'tot_recive',
        cellRenderer: function (p) {
            return `
            <button class="ism-btns btn-normal" style="padding:2px 5px" onclick="recivedList('${p.data.pprid}')">
            ${p.data.tot_recive}
            </button>
            `;
        },
        sortingOrder: ['asc', 'desc'],
        width: 90,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'Received Die Wght',
        field: 'totrecivedweight',
        sortingOrder: ['asc', 'desc'],
        width: 97,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'Balance',
        field: 'tot_balance',
        sortingOrder: ['asc', 'desc'],
        width: 97,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'Balance Die Wght',
        field: 'balancewieght',
        sortingOrder: ['asc', 'desc'],
        width: 97,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'Unit',
        field: 'pp_units',
        sortingOrder: ['asc', 'desc'],
        width: 97,
        filter: 'agMultiColumnFilter',
    })



    columnDefs.push({
        headerName: 'ETA',
        field: 'pp_dta',
        sortingOrder: ['asc', 'desc'],
        width: 120,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'Location',
        field: 'pp_location',
        sortingOrder: ['asc', 'desc'],
        width: 186,
        filter: 'agMultiColumnFilter',
    })

    columnDefs.push({
        headerName: 'Remarks',
        field: 'pp_remarks',
        sortingOrder: ['asc', 'desc'],
        width: 240,
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
            var mname = `Factory To Paint Plant  AS ON DATE ${day}-${month}-${year}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: mname,
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }
    // NewGetReport();
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);

    const _ftype = "pptofa";
    $scope.projectlist = [];
    function _apiError($response) {
        alert("Something Error In FETCH API , please Read Console Data");
        console.error($response);
    }
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
                console.log(res.data.data);
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
    getAllData();
    function getAllData() {
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('pptype', _ftype);

        const post_data = {
            url: `${api_url}ppwork/index.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(
            res => {
                if (res?.data?.msg === "1") {
                    console.log(res.data.data);
                    gridOptions.api.setRowData(res.data.data);
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                } else {
                    _apiError(res.data);
                }
            }
        )
    }

    $scope.addnewentry = () => {
        document.getElementById("dia_saveData").style.display = "flex";
    }

    $scope.newSaveppData = [];

    $scope.saveDataFrm_submit = () => {
        _saveValidate();
    }


    $scope.printResult = () => {
        let _data = [];
        let _project = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((i) => {
            _data.push(i.data);
            let av = _project.includes(i.data.pp_project);
            if (!av) {
                _project.push(i.data.pp_project);
            }
        });
        let _fdata = [];
        _project.map((i) => {
            let _pno = i;
            let _pname = "";
            let _list = [];
            _data.map((j) => {
                if (j.pp_project === i) {
                    _pname = j.pp_projectname;
                    _list.push(j);
                }
            })
            _fdata.push(
                {
                    _pno, _pname, _list
                }
            )
        })
        if (_fdata.length === 0) {
            alert("NO DATA FOUND.....");
            return;
        }
        localStorage.clear("printppreports");
        localStorage.clear("printppreportstitle");
        localStorage.setItem("printppreportstitle", "PAINT PLANT TO FACTORY REPORT");
        localStorage.setItem("printppreports", JSON.stringify(_fdata));
        var loc = print_location + "print/printpprpt.html";
        window.open(loc, '_blank', "width = '1300px'height = '800px'");
    }

    $scope.newReceiptLoad = (a) => {
        console.log("working");
        console.log(a);
        $scope.newReceipt = {
            ppid: a.pprid,
        };

        document.getElementById('dia_receiptdata').style.display = "flex";
        document.getElementById("dialogTitleEdit").innerText = "NEW RECEIPT";
    }


    $scope.receiptNew_submit = () => {
        let frm = document.getElementById("receiptNew");
        let fd = new FormData(frm);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        let post_data = {
            url: `${api_url}ppwork/recivenew.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(
            res => {
                if (res?.data?.msg === "1") {
                    alert('SAVED');
                    $scope.newReceipt = [];
                    location.reload();
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                } else {
                    _apiError(res.data);
                }
            }
        );
    }

    $scope.Edit_DataFrm_submit = () => {
        let frm = document.getElementById("EditDataFrm");
        let fd = new FormData(frm);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        let _pname = document.getElementsByName('pp_project')[1];
        let pname = _pname.options[_pname.selectedIndex].text;
        fd.append('pp_projectname', pname);
        const post_data = {
            url: `${api_url}ppwork/update.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);
        req.then(
            res => {
                if (res?.data?.msg === "1") {
                    alert("updated");
                    location.reload();
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                } else {
                    _apiError(res.data);
                }
            }
        )
    }

    $scope.autocompleates = [];


    AutoCompleate();
    function AutoCompleate() {
        let post_data = {
            url: `${api_url}ppwork/autofill.php`,
        }
        const req = $http(post_data);

        req.then(
            res => {
                if (res?.data?.msg === "1") {
                    $scope.autocompleates = res.data.data;
                } else {
                    _apiError(res.data);
                }
            }
        )
    }


    $scope.whtoppsummary = [];
    $scope.count_infos = {
        sum_totqty: 0,
        sum_totrec: 0,
        sum_totbal: 0
    };
    $scope.getSummaryRpt = () => {
        let sum_totqty = 0;
        let sum_totrec = 0;
        let sum_totbal = 0;
        $scope.whtoppsummary = [];
        $scope.count_infos = {
            sum_totqty: 0,
            sum_totrec: 0,
            sum_totbal: 0
        };
        let dia = document.getElementById('dia_summary_factopp');
        dia.style.display = "block";
        let _data = [];
        let _project = [];
        let _type = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((i) => {
            let k = i.data.pp_project;
            if (!_project.includes(k)) {
                _project.push(k);
            }
            let t = i.data.pp_mtype;
            if (!_type.includes(t)) {
                _type.push(t);
            }
            _data.push(i.data);
        });

        //console.log(_type);

        let a = [];

        _project.map(p => {
            let pro = p;
            let ty = "";
            let arr = [];
            _type.map(t => {
                ty = t;
                _data.map(d => {
                    if (d.pp_project === p) {
                        if (d.pp_mtype === ty) {
                            arr.push(d);
                        }
                    }
                })
            })
            a.push({ pro, ty, arr });
        })








        let r = [];

        let post_data = {
            url: `${api_url}ppwork/pptofactorysummary.php`,
            method: 'GET',
            headers: {
                'content-type': undefined
            }
        };
        const req = $http(post_data);
        req.then(res => {
            console.log(res.data);
            if (res?.data?.msg === '1') {
                r = res?.data?.data || [];
                //console.log(r);
                let n = [];
                r.map(p => {
                    let pr = p.pp_project;
                    let prname = "";
                    let pppartno = "";
                    let pplenght = "";
                    let ppalloy = "";
                    let ppitemtype = "";
                    let pp_dieweight = "";
                    let ty = p.pp_mtype;
                    let qt = 0;
                    let rc = 0;
                    let bl = 0;
                    _data.map(d => {
                        if (p.pp_project === d.pp_project
                            && p.pp_mtype === d.pp_mtype
                            && p.pppartno === d.pppartno
                            && p.pplenght === d.pplenght
                            && p.ppalloy === d.ppalloy
                            && p.ppitemtype === d.ppitemtype
                            && p.pp_dieweight === d.pp_dieweight) {
                            prname = d.pp_projectname;
                            pppartno = d.pppartno;
                            pplenght = d.pplenght;
                            ppalloy = d.ppalloy;
                            ppitemtype = d.ppitemtype;
                            pp_dieweight = d.pp_dieweight;
                            prname = d.pp_projectname;
                            qt += (+d.pp_qty);
                            sum_totqty += (+d.pp_qty);
                            rc += (+d.tot_recive);
                            sum_totrec += (+d.tot_recive);
                            bl += (+d.tot_balance);
                            sum_totbal += (+d.tot_balance);
                        }
                    })

                    n.push({
                        pr, prname, pppartno, pplenght, ppalloy, ppitemtype, pp_dieweight, ty, qt, rc, bl
                    });
                    $scope.whtoppsummary = n;
                })
                $scope.count_infos = {
                    sum_totqty: sum_totqty,
                    sum_totrec: sum_totrec,
                    sum_totbal: sum_totbal
                };
                console.log(n);
            }
        })
        //console.log($scope.whtoppsummary);
    }

    
    let _itempartno = "";

    $scope.itemPartnoAutocomplete = [];
    _parnoautcompleate();
    function _parnoautcompleate() {
        $scope.itemPartnoAutocomplete = [];
        const post_data = {
            url: `${api_url}autoc/bomitem.php`,
            method: 'GET',
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);
        req.then(
            res => {
                //console.log(res.data);
                if (res?.data?.msg === "1") {
                    $scope.itemPartnoAutocomplete = res?.data?.data ?? [];
                }
            }
        )
    }

    function _loadPartnoinfo() {
        let partno = _itempartno;
        const post_data = {
            url: `${api_url}autoc/iteminfo.php?partno=${partno}`,
            method: "GET",
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);
        req.then(
            res => {
                if (res?.data?.msg === "1") {
                    //_itemotherload();
                    $scope.newSaveppData.ppitemtype = res.data.data.itemtype ?? "";
                    $scope.newSaveppData.pp_mdescription = res.data.data.itemdescription ?? "";
                    $scope.newSaveppData.ppalloy = res.data.data.itemalloy ?? "";
                    $scope.newSaveppData.pplenght = res.data.data.itemlength ?? "";
                    $scope.newSaveppData.pp_dieweight = res.data.data.itemdieweight ?? "";
                    $scope.newSaveppData.pp_units = res.data.data.itemunit ?? "";
                    //document.getElementsByName('pp_qty')[0].focus();

                    let pp_project_data = document.getElementsByName("pp_project")[0].value;
                    let ppdate_data = document.getElementsByName("ppdate")[0].value;
                    let pp_mtype_data = document.getElementsByName("pp_mtype")[0].value;
                    let pp_delno_data = document.getElementsByName("pp_delno")[0].value;
                    let pp_dta_data = document.getElementsByName("pp_dta")[0].value;
                    let pp_location_data = document.getElementsByName("pp_location")[0].value;
                    let pp_remarks_data = document.getElementsByName("pp_remarks")[0].value;
                    let pp_color_data = document.getElementsByName("pp_color")[0].value;
                    $scope.newSaveppData = {
                        pp_project: pp_project_data,
                        ppdate: ppdate_data,
                        pp_mtype: pp_mtype_data,
                        pp_delno: pp_delno_data,
                        pp_dta: pp_dta_data,
                        pp_location: pp_location_data,
                        pp_remarks: pp_remarks_data,
                        pp_color: pp_color_data,
                        pppartno: _itempartno,
                        ppitemtype: res.data.data.itemtype ?? "",
                        pp_mdescription: res.data.data.itemdescription,
                        ppalloy: res.data.data.itemalloy,
                        pplenght: res.data.data.itemlength,
                        pp_dieweight: res.data.data.itemdieweight,
                        pp_qty: '',
                        pp_units: res.data.data.itemunit,
                        ppbalancedie: '0',
                        itempartfunction : res.data.data.itempartfunction
                    };
                    ppitemtype.focus();
                    ppitemtype.select();

                } else if (res?.data?.msg !== "1") {
                    //alert(res.data.data);
                    let pp_project_data = document.getElementsByName("pp_project")[0].value;
                        let ppdate_data = document.getElementsByName("ppdate")[0].value;
                        let pp_mtype_data = document.getElementsByName("pp_mtype")[0].value;
                        let pp_delno_data = document.getElementsByName("pp_delno")[0].value;
                        let pp_dta_data = document.getElementsByName("pp_dta")[0].value;
                        let pp_location_data = document.getElementsByName("pp_location")[0].value;
                        let pp_remarks_data = document.getElementsByName("pp_remarks")[0].value;
                        let pp_color_data = document.getElementsByName("pp_color")[0].value;
                        let pp_pppartno = document.getElementsByName("pppartno")[0].value;
                        $scope.newSaveppData = {
                            pp_project: pp_project_data,
                            ppdate: ppdate_data,
                            pp_mtype: pp_mtype_data,
                            pp_delno: pp_delno_data,
                            pp_dta: pp_dta_data,
                            pp_location: pp_location_data,
                            pp_remarks: pp_remarks_data,
                            pp_color: pp_color_data,
                            pppartno: pp_pppartno,
                            ppitemtype: '',
                            pp_mdescription: '',
                            ppalloy: '',
                            pplenght: '',
                            pp_dieweight: '',
                            pp_qty: '',
                            pp_units: '',
                            ppbalancedie: '',
                            itempartfunction : '',
                        };
                    ppitemtype.focus();
                    ppitemtype.select();
                } else {
                    alert("API ERROR CHECK CONSOLE....");
                    console.log(res.data);
                    ppitemtype.focus();
                    ppitemtype.select();
                }
            }
        )
    }
    let pp_project = document.getElementsByName('pp_project')[0];
    let ppdate = document.getElementsByName('ppdate')[0];
    let pp_mtype = document.getElementsByName('pp_mtype')[0];
    let pppartno = document.getElementsByName('pppartno')[0];
    let ppitemtype = document.getElementsByName("ppitemtype")[0];
    let pp_mdescription = document.getElementsByName("pp_mdescription")[0];
    let ppalloy = document.getElementsByName("ppalloy")[0];
    let pp_qty = document.getElementsByName("pp_qty")[0];
    let pp_dieweight = document.getElementsByName("pp_dieweight")[0];
    let pplenght = document.getElementsByName("pplenght")[0];
    let pp_color = document.getElementsByName("pp_color")[0];
    let pp_units = document.getElementsByName("pp_units")[0];
    let pp_delno = document.getElementsByName("pp_delno")[0];
    let pp_dta = document.getElementsByName("pp_dta")[0];
    let pp_location = document.getElementsByName("pp_location")[0];
    let pp_remarks = document.getElementsByName("pp_remarks")[0];
    let itempartfunction = document.getElementsByName("itempartfunction")[0];
    pppartno.addEventListener("keydown", (e) => {
        if (e.which === 13) {
            if (pppartno.value === "") {
                alert("Enter Part no")
            } else {
                _itempartno = pppartno.value ?? "";
                _loadPartnoinfo();
                _DieWeightCalculations();
                $scope.$apply();
                ppitemtype.select();
                ppitemtype.focus();
                
            }
        }
    })

    pp_mtype.addEventListener('keydown', (e) => {
        if (e.which === 13) {            
            pp_delno.focus();
            
        }
    })

    ppitemtype.addEventListener('keydown', (e) => {
        if (e.which === 13) {
            pp_mdescription.focus();
            pp_mdescription.select();
        }
    })

    pp_mdescription.addEventListener('keydown', (e) => {
        if (e.which === 13) {
            ppalloy.focus();
            ppalloy.select();
        }
    })

    ppalloy.addEventListener('keydown', (_) => {
        if (_.which === 13) {
            pplenght.focus();
            pplenght.select();
        }
    })

    pplenght.addEventListener("keydown", (_) => {
        if (_.which === 13) {
            pp_dieweight.focus();
            pp_dieweight.select();
        }
    })

    pp_dieweight.addEventListener("keydown", (_) => {
        if (_.which === 13) {
            pp_qty.focus();
            pp_qty.select();
        }
    })

    pp_qty.addEventListener("keydown", (_) => {
        if (_.which === 13) {
            _DieWeightCalculations();
            pp_units.focus();
            pp_units.select();

        }
    })


    pp_units.addEventListener("keydown", (_) => {
        if (_.which === 13) {
            _DieWeightCalculations();
            itempartfunction.focus();
            itempartfunction.select();           
        }
    })

    pp_color.addEventListener("keydown", (_) => {
        if (_.which === 13) {
            pppartno.focus();
            pppartno.select();
        }
    })

    pp_delno.addEventListener("keydown", (_) => {
        console.log(this);
        if (_.which === 13) {
            pp_dta.focus();
            pp_dta.select();
        }
    })

    pp_dta.addEventListener("keydown", (_) => {
        if (_.which === 13) {
            pp_location.focus();
            pp_location.select();
        }
    })

    pp_location.addEventListener("keydown", (_) => {
        if (_.which === 13) {
            pp_remarks.focus();
        }
    })


    pp_remarks.addEventListener("keydown", (_) => {
        if (_.which === 13) {
            pp_color.focus();
        }
    })

    pp_qty.addEventListener("blur", (_) => {
        console.log("owkring");
        _DieWeightCalculations();
    })

    itempartfunction.addEventListener("keydown",(_)=>{
        if(_.which === 13){
            _saveValidate();
        }
    })

    document.getElementsByName("pp_project")[0].addEventListener("keydown", (_) => {
        if (_.which === 13) {
            document.getElementsByName("ppdate")[0].focus();
        }
    })
    document.getElementsByName("ppdate")[0].addEventListener("keydown", (_) => {
        if (_.which === 13) {
            pp_mtype.focus();
        }
    })


    $scope.bomItemAlloyList = [];
    $scope.bomItemUnitList = [];
    $scope.bomItemDescriptionList = [];
    $scope.bomItemLengthList = [];
    $scope.bomItemDieWeightList = [];
    $scope.bomItemPartFunctionList = [];
    $scope.bomItemItemTypeList = [];
    _itemotherload();
    function _itemotherload() {
        $scope.bomItemAlloyList = [];
        $scope.bomItemUnitList = [];
        $scope.bomItemDescriptionList = [];
        $scope.bomItemLengthList = [];
        $scope.bomItemDieWeightList = [];
        $scope.bomItemPartFunctionList = [];
        $scope.bomItemItemTypeList = [];
        const post_data = {
            url: `${api_url}autoc/bomitemwithpartno.php`,
            method: 'GET',
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(
            res => {
                console.log(res.data);
                if (res?.data?.msg === '1') {
                    $scope.bomItemAlloyList = res?.data?.data?.alloy ?? [];
                    $scope.bomItemUnitList = res?.data?.data?.units ?? [];
                    $scope.bomItemDescriptionList = res?.data?.data?.description ?? [];
                    $scope.bomItemLengthList = res?.data?.data?.lenghts ?? [];
                    $scope.bomItemDieWeightList = res?.data?.data?.deiweight ?? [];
                    $scope.bomItemPartFunctionList = res?.data?.data?.parfunctionlist ?? [];;
                    $scope.bomItemItemTypeList = res?.data?.data?.itemtypelist ?? [];;
                }
                else if (res?.data?.msg !== "1") {
                    alert(res.data.data);
                }
                else { alert("API ERROR  NEED MORE INFROMATION PLEASE CHECK CONSOLE"); console.log(res.data); }
            }
        )
    }

    $scope.bomItemColorList = [];
    $scope.bomItemSystemList = [];
    $scope.remarksList = [];
    $scope.locationsList = [];
    _colorAutoCompleate();
    function _colorAutoCompleate() {
        $scope.bomItemColorList = [];
        $scope.bomItemSystemList = [];
        $scope.remarksList = [];
        $scope.locationsList = [];
        const post_data = {
            url: `${api_url}autoc/bomcolor.php`,
            headers: {
                'content-type': undefined
            },
            method: "GET"
        };

        const req = $http(post_data);

        req.then(
            res => {
                if (res?.data?.msg === "1") {
                    $scope.bomItemColorList = res?.data?.data.colors ?? [];
                    $scope.bomItemSystemList = res?.data?.data.system ?? [];
                    $scope.remarksList = res?.data?.data.remarks ?? [];
                    $scope.locationsList = res?.data?.data.location ?? [];

                    let ncolor = res?.data?.data?.colnew ?? [];

                    ncolor.map((x) => {
                        let _isavai = $scope.bomItemColorList.includes(x);
                        if (!_isavai) {
                            console.log(x);
                            $scope.bomItemColorList.push(x);
                        }
                    })
                } else {
                    alert("API ERROR CHECK CONSOLE.....");
                    console.error("Getting Error On COLOR auto complete : ", res.data);
                }
            }
        )
    }


    pp_qty.addEventListener('keydown', (e) => {
        _DieWeightCalculations();
    });

    function _DieWeightCalculations() {
        if (pp_qty.value === "") {
            console.log("Enter QTY", pp_qty.value);
            return;
        }
        if (pp_dieweight.value === "") {
            console.log("Enter die weight");
            return;
        }
        if (pplenght.value === "") {
            console.log("Enter Length");
            return;
        }

        if (isNaN(pp_qty.value)) {
            console.log("QTY NOT VALID NUMBER", pp_qty.value);
            return;
        }
        if (isNaN(pp_dieweight.value)) {
            console.log("DIE WEIGHT NOT A VALID NUMBER", pp_dieweight.value);
            return;
        }
        if (isNaN(pplenght.value)) {
            console.log("LENGHT NOT A VALID NUMBER", pplenght.value);
            return;
        }

        let todeiweight = (+pp_qty.value) * (+pp_dieweight.value) * (+pplenght.value);
        console.log(todeiweight);
        $scope.newSaveppData.ppbalancedie = todeiweight.toFixed(3);
        $scope.$apply();

    }

    function _saveValidate() {
        saveData();
    }

    $scope.api_error = false;
    function saveData() {
        if (!_process) {
            _process = true;
            let frm = document.getElementById("saveDataFrm");
            let fd = new FormData(frm);
            let _pname = document.getElementsByName('pp_project')[0];
            let pname = _pname.options[_pname.selectedIndex].text;
            fd.append('user_name', userinfo.user_name);
            fd.append('user_token', userinfo.user_token);
            fd.append('pp_type', _ftype);
            fd.append('pp_projectname', pname);

            const post_data = {
                url: `${api_url}ppwork/new.php`,
                data: fd,
                method: 'POST',
                headers: {
                    'content-type': undefined
                }
            };

            const req = $http(post_data);
            req.then(
                (res) => {

                    if (res?.data?.msg === "1") {
                        $scope.api_error = true;
                        $scope._apimsg = "SAVED..."                        
                        let pp_project_data = document.getElementsByName("pp_project")[0].value;
                        let ppdate_data = document.getElementsByName("ppdate")[0].value;
                        let pp_mtype_data = document.getElementsByName("pp_mtype")[0].value;
                        let pp_delno_data = document.getElementsByName("pp_delno")[0].value;
                        let pp_dta_data = document.getElementsByName("pp_dta")[0].value;
                        let pp_location_data = document.getElementsByName("pp_location")[0].value;
                        let pp_remarks_data = document.getElementsByName("pp_remarks")[0].value;
                        let pp_color_data = document.getElementsByName("pp_color")[0].value;
                        $scope.newSaveppData = {
                            pp_project: pp_project_data,
                            ppdate: ppdate_data,
                            pp_mtype: pp_mtype_data,
                            pp_delno: pp_delno_data,
                            pp_dta: pp_dta_data,
                            pp_location: pp_location_data,
                            pp_remarks: pp_remarks_data,
                            pp_color: pp_color_data,
                            pppartno: '',
                            ppitemtype: '',
                            pp_mdescription: '',
                            ppalloy: '',
                            pplenght: '',
                            pp_dieweight: '',
                            pp_qty: '',
                            pp_units: '',
                            ppbalancedie: '',
                            itempartfunction : '',
                        };
                        pppartno.focus();
                        pppartno.select();
                        _itemotherload();
                    } else if (res?.data?.msg === "0") {
                        alert(res.data.data);
                    } else {
                        _apiError(res.data);
                    }
                    _process = false;
                }
            )
        } else {
            $scope._apimsg = "Please Wait Another Process Is Running....";
        }
    }
    $scope.newDataLoad = () => {
        location.reload();
    }

    $scope.deleteAction = (_id) => {
        let c = confirm("ARE YOU SURE DELETE THIS ?");
        if(c){
            let fd = new FormData();
            fd.append('user_name', userinfo.user_name);
            fd.append('user_token', userinfo.user_token);
            fd.append('ppid', _id);
            const post_data = {
                data : fd,
                method : "POST",
                url : `${api_url}ppwork/del.php`,
                headers : {
                    'content-type' : undefined
                }
            };

            const req = $http(post_data);
            req.then(res=>{
                if(res?.data?.msg === "1"){
                    alert("REMOVED");
                    location.reload();
                }else if(res?.data?.msg === "0" ){
                    alert(res.data.data);
                }else{
                    alert("API ERROR,check in console....");
                    console.log(res.data);
                }
            })

        }
    }


    

    let itemtype = document.getElementsByName("itemtype")[0];
    let itemprofileno = document.getElementsByName("itemprofileno")[0];
    let itemsystem = document.getElementsByName("itemsystem")[0];
    let itempartno = document.getElementsByName("itempartno")[0];
    let itemdescription = document.getElementsByName("itemdescription")[0];
    let itemalloy = document.getElementsByName("itemalloy")[0];
    let itemfinish = document.getElementsByName("itemfinish")[0];
    let itemlength = document.getElementsByName("itemlength")[0];
    let itemunit = document.getElementsByName("itemunit")[0];
    let itemdieweight = document.getElementsByName("itemdieweight")[0];

    itemtype.addEventListener("keydown", (e) => {
        if (e.which === 13 || e.which === 9)
            moveNext(itemprofileno);
        return
    })

    itempartno.addEventListener("keydown", (e) => {
        if (e.which === 13 || e.which === 9)
            moveNext(itemdescription);
        return
    })
    itemdescription.addEventListener("keydown", (e) => {
        if (e.which === 13 || e.which === 9)
            moveNext(itemdieweight);
        return
    })
    itemalloy.addEventListener("keydown", (e) => {
        if (e.which === 13 || e.which === 9)
            moveNext(itemfinish);
        return
    })
    itemfinish.addEventListener("keydown", (e) => {
        if (e.which === 13 || e.which === 9)
            moveNext(itemunit);
        return
    })

    itemlength.addEventListener("keydown", (e) => {
        if (e.which === 13 || e.which === 9)
            moveNext(itemalloy);
        return
    })
    itemunit.addEventListener("keydown", (e) => {
        if (e.which === 13 || e.which === 9)
            itemSaveFunction();
        return
    })

    itemdieweight.addEventListener("keydown", (e) => {
        if (e.which === 13)
            moveNext(itemlength)
        return
    })


    function moveNext(_controllers) {
        _controllers.focus();
    }

    $scope.mtypelist = [];
    getAllmtypes();
    function getAllmtypes() {
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        const post_data = {
            url: `${api_url}bomprop/mtypeall.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        }

        const req = $http(post_data);
        $scope.mtypelist = [];
        req.then(
            res => {
                if (res?.data?.msg === "1") {
                    $scope.mtypelist = res.data.data;
                } else if (res?.data?.msg === "0") {
                    console.log(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        )
    }

    let typename = document.getElementsByName('typename')[0];
    typename.addEventListener('keydown',(e)=>{
        if(e.which === 13){
            if(typename.value === ""){
                alert("Enter Material Type")
                return;
            }
            _saveType();
        }
    });
    $scope.newprops_type_submit = () => {
        _saveType();
    }

    function _saveType(){
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append("typename", typename.value);

        const post_data = {
            url: `${api_url}bomprop/mtypenew.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        }

        const req = $http(post_data);
        req.then(
            res => {
                if (res?.data?.msg === '1') {
                    alert("saved");
                    typename.value = "";
                    typename.focus();
                    getAllmtypes();
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        )
    }

    //system profile no
    $scope.systemprofilelist = [];
    AllsystemProlfileno();
    function AllsystemProlfileno() {
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        const post_data = {
            url: `${api_url}bomprop/systemall.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        }

        const req = $http(post_data);
        $scope.systemprofilelist = [];
        req.then(
            res => {
                if (res?.data?.msg === "1") {
                    $scope.systemprofilelist = res.data.data;
                } else if (res?.data?.msg === "0") {
                    console.log(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        )
    }

    itemprofileno.addEventListener("keydown", e => {
        if (e.which === 13) {
            itemsystem.focus();
        }
    });

    itemsystem.addEventListener("keydown",(e)=>{
        if(e.which === 13){
            moveNext(itempartno);
        }
    })
    function getsystemprofileinfo(proflieno) {
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('itemprofileno', proflieno);
        const post_data = {
            url: `${api_url}bomprop/systemget.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        }

        const req = $http(post_data);
        req.then(
            res => {
                if (res?.data?.msg === "1") {
                    itemsystem.value = res.data.data.systemname;
                    console.log($scope.profilesystem)
                    itempartno.focus();
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                    console.log(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        );
    }

    
    let systemname = document.getElementsByName("systemname")[0];

    

    systemname.addEventListener('keydown',(e)=>{
        if(e.which === 13){
            if(systemname.value === ''){
                alert("Enter system Name");
                return
            }            
            _systemSave();
        }
    })

    $scope.newprops_profiletype_submit = () => {
        _systemSave()
    }

    function _systemSave(){
        let frm = document.getElementById('newprops_profiletype');
        let fd = new FormData(frm);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        const post_data = {
            url: `${api_url}bomprop/systemnew.php`,
            method: 'POST',
            data: fd,
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);
        // $scope.systemprofilelist = [];
        req.then(
            res => {
                if (res?.data?.msg === "1") {
                    alert("saved");
                    AllsystemProlfileno();
                    $scope.profilesystem = [];
                    document.getElementsByName('systemname')[0].focus();
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                    console.log(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        );
    }


    $scope.alloylist = [];
    allAlloy();
    function allAlloy() {
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        const post_data = {
            url: `${api_url}bomprop/alloyall.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);
        req.then(res => {
            console.log(res.data);
            $scope.alloylist = [];
            if (res?.data?.msg === "1") {
                $scope.alloylist = res.data.data;
            } else if (res?.data?.msg === "0") {
                console.log(res.data.data);
            } else {
                _apiErrorMsg(res.data);
            }
        })
    }

    let alloyname = document.getElementsByName("alloyname")[0];

    alloyname.addEventListener("keydown",(e)=>{
        if(e.which === 13){
            if(alloyname.value === ""){
                alert("Enter Alloy Name");
                return;
            }
            _alloySave()
        }
    })

    $scope.newprops_alloy_submit = () => {
        _alloySave()      
    }

    function _alloySave(){
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('alloyname', alloyname.value);

        const post_data = {
            url: `${api_url}bomprop/alloynew.php`,
            method: "POST",
            data: fd,
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);
        req.then(
            res => {
                if (res?.data?.msg === "1") {
                    alert("Saved");
                    allAlloy();
                    alloyname.value = "";
                    alloyname.focus();
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                    console.log(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        )
    }

    let finishcolor = document.getElementsByName("finishcolor")[0];
    $scope.finishcolorlist = [];
    allFinish();
    function allFinish() {
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        const post_data = {
            url: `${api_url}bomprop/colorall.php`,
            method: "POST",
            data: fd,
            headers: {
                'content-type': undefined
            }
        };
        const req = $http(post_data);
        $scope.finishcolorlist = [];
        req.then(res => {
            if (res?.data?.msg === "1") {
                $scope.finishcolorlist = res.data.data;
            } else if (res?.data?.msg === "0") {
                console.log(res.data.data);
            } else {
                _apiErrorMsg(res.data);
            }
        })
    }

    finishcolor.addEventListener("keydown", e => {
        if (e.which === 13) {
            addNewFinish();
        }
    })


    $scope.newprops_finsih_submit = () => {
        addNewFinish();
    }

    function addNewFinish() {
        if (finishcolor.value === "") {
            alert("Enter Finish Color");
            return;
        }
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('finishSave', finishcolor.value);

        const post_data = {
            url: `${api_url}bomprop/colornew.php`,
            method: "POST",
            data: fd,
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);
        req.then(
            res => {
                if (res?.data?.msg === "1") {
                    alert("saved");
                    allFinish();
                    finishcolor.value = "";
                    finishcolor.focus();
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        );
    }


    $scope.unitlist = [];
    Allunits();
    function Allunits() {
        $scope.unitlist = [];
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        const post_data = {
            url: `${api_url}bomprop/unitall.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(
            res => {

                if (res?.data?.msg === "1") {
                    $scope.unitlist = res.data.data;
                } else if (res?.data?.msg === "0") {
                    console.log(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        )

    }
    let unitname = document.getElementsByName("unitname")[0];
    unitname.addEventListener("keyup", e => {
        if (e.which === 13) {
            saveUnit();
        }
    });

    $scope.newprops_units_submit = () => {
        saveUnit();
    }

    function saveUnit() {
        if (unitname.value === "") {
            alert("enter unit");
            return;
        }

        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('unitname', unitname.value);

        const post_data = {
            url: `${api_url}bomprop/unitnew.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);
        req.then(res => {
            if (res?.data?.msg === "1") {
                alert("saved");
                Allunits();
                unitname.value = "";
                unitname.focus();
            } else if (res?.data?.msg === "0") {
                alert(res.data.data);
            } else {
                _apiErrorMsg(res.data);
            }
        })
    }
    $scope.partfunctionlist = [];
    _loadParfunctionAll();
    function _loadParfunctionAll(){
        $scope.partfunctionlist = [];
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        const post_data = {
            url: `${api_url}bomprop/partfunctionall.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(
            res => {

                if (res?.data?.msg === "1") {
                    $scope.partfunctionlist = res.data.data;
                } else if (res?.data?.msg === "0") {
                    console.log(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        )
    }

    $scope.newitem_bom_submit = () => {
        itemSaveFunction();
    }

    function itemSaveFunction() {
        if (!_emptyvalidate(itemtype)) {
            alert("Select Item Type")
            return
        }

        if (!_emptyvalidate(itemprofileno)) {
            alert("Select Profile")
            return
        }

        if (!_emptyvalidate(itemprofileno)) {
            alert("Select System Type")
            return
        }

        if (!_emptyvalidate(itempartno)) {
            alert("Enter Part Number")
            return
        }

        if (!_emptyvalidate(itemdescription)) {
            alert("Enter Item Description")
            return
        }

        if (!_emptyvalidate(itemalloy)) {
            alert("Select Alloy")
            return
        }

        if (!_emptyvalidate(itemfinish)) {
            alert("Select Finish (COLOR)")
            return
        }

        if (!_emptyvalidate(itemlength)) {
            alert("Enter Length")
            return
        }
        if (!_numbervalidate(itemlength)) {
            alert("length Should Be a Number value")
            return
        }

        if (!_emptyvalidate(itemunit)) {
            alert("Select Item Unit")
            return
        }

        if (!_emptyvalidate(itemdieweight)) {
            alert("Enter ITEM DIE WEIGHT")
            return
        }


        if (!_numbervalidate(itemdieweight)) {
            alert("DIE Weight Should Be a Number value")
            return
        }
        console.log("its working")
        let frm = document.getElementById("newitem_bom");
        let fd = new FormData(frm);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        const post_data = {
            url: `${api_url}bomitem/new.php`,
            data: fd,
            method: "POST",
            headers: {
                'content-type': undefined
            }
        }

        const req = $http(post_data);
        req.then(
            res => {
                if (res?.data?.msg === '1') {
                    alert("saved");
                    $scope.newitem = [];
                    itemsystem.value = "";
                    itemtype.focus();
                    AllBoqItems();
                } else if (res?.data?.msg === '0') {
                    alert(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        )

    }

    function _emptyvalidate(_controller) {
        return _controller.value !== "" ? true : false;
    }
    function _emptyvalidates(_controller) {
        return _controller !== "" ? true : false;
    }
    function _numbervalidate(_controller) {
        return !isNaN(_controller.value) ? true : false;
    }
    function _numbervalidates(_controller) {
        return !isNaN(_controller) ? true : false;
    }

}

function editinfo(id) {
    let dia = document.getElementById("dia_saveEdit");
    let scope = angular.element(dia).scope();
    document.getElementById("dialogTitleedit").innerText = "EDIT"

    let fd = new FormData();
    fd.append('user_name', userinfo.user_name);
    fd.append('user_token', userinfo.user_token);
    fd.append('ppid', id);
    fetch(`${api_url}ppwork/get.php`, {
        method: 'POST',
        body: fd,
    }).then(r => r.json())
        .then(res => {
            if (res?.msg === "1") {
                let m = res?.data ?? [];
                scope.editSaveppData = m;
                scope.$apply();
                dia.style.display = "flex";
            } else if (res?.msg === "0") {
                alert(res.data.data);
            } else {
                alert("Something Error In FETCH API , please Read Console Data");
                console.error(res);
            }
        });


    $scope.deleteAction = (_id) => {
        let c = confirm("ARE YOU SURE DELETE THIS ?");
        if (c) {
            let fd = new FormData();
            fd.append('user_name', userinfo.user_name);
            fd.append('user_token', userinfo.user_token);
            fd.append('ppid', _id);
            const post_data = {
                data: fd,
                method: "POST",
                url: `${api_url}ppwork/del.php`,
                headers: {
                    'content-type': undefined
                }
            };

            const req = $http(post_data);
            req.then(res => {
                if (res?.data?.msg === "1") {
                    alert("REMOVED");
                    location.reload();
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                } else {
                    alert("API ERROR,check in console....");
                    console.log(res.data);
                }
            })

        }
    }

    function _emptyvalidate(_controller) {
        return _controller.value !== "" ? true : false;
    }
    function _emptyvalidates(_controller) {
        return _controller !== "" ? true : false;
    }
    function _numbervalidate(_controller) {
        return !isNaN(_controller.value) ? true : false;
    }
    function _numbervalidates(_controller) {
        return !isNaN(_controller) ? true : false;
    }

}

function recivedList(id) {
    console.log(id);
    let fd = new FormData();
    fd.append('user_name', userinfo.user_name);
    fd.append('user_token', userinfo.user_token);
    fd.append('ppid', id);



    fetch(`${api_url}ppwork/recive.php`, { body: fd, method: 'post' }).then(res => res.json()).then(
        res => {
            if (res?.msg === "1") {
                let dia = document.getElementById("dia_pprecived_info");
                let scope = angular.element(dia).scope();
                dia.style.display = "block";
                let m = res?.data?.recived ?? [];
                let dt = res?.data?.ppwork ?? [];
                scope.vData = dt;
                scope.recivedlist = m;

                scope.$apply();
            } else if (res?.msg === "0") {
                alert(res.data.data);
            } else {
                alert("Something Error In FETCH API , please Read Console Data");
                console.error(res);
            }
        }
    )
}