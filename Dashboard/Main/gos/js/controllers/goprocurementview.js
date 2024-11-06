import GlassOrderServices from '../services/index.js';
import * as models from './models.js';
export default function goprocurementview($scope, $compile, $routeParams) {
    let pagetype = !$routeParams.type || $routeParams.type === "" ? '' : $routeParams.type;
    $scope.editoptions = !$routeParams.type || $routeParams.type === "" ? true : false;
    console.log($scope.editoptions);
    console.log("pagetype", pagetype);
    let _rptdata = [];
    $scope.printshow = true;
    const customizeprint_users = ['demo', 'ashraff', 'sam'];
    $scope.currentuser = userinfo.user_name;
    $scope.customizeprintbtn = customizeprint_users.includes(userinfo.user_name);



    $scope.viewprint = {
        odate: true,
        otype: true,
        supplier: true,
        coatting: true,
        contract: true,
        projectname: true,
        gono: true,
        pino: true,
        thikenss: true,
        outter: true,
        inner: true,

        qty: true,
        qtyreceived: true,
        qtybalance: true,
        uinsert: false,
        remarks: false,
        dlocation: true,
        eta: false,
        wkrno: false,
        area: false,
        unitprice: true,
        otherprice: true,
        totalprice: true,

        recivedarea: false,
        balancearea: false,
        glasstype: false,
        glassspec: false,

        //need to dispatch
    };
    $scope.gregorianDatepickerConfigdotravels = {
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
    moment.locale('en');

    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    let priceaccessusers = ['demo', 'nabil', 'hani', 'abuzaid', 'ashraff', 'sam'];
    let access = {
        editaccess: userinfo.user_name === 'demo' || userinfo.user_name === 'ashraff' || userinfo.user_name === 'procurement',
        receiptaccess: true,
        pdfupdate: userinfo.user_name === 'demo' || userinfo.user_name === 'ashraff',
        priceaccess: priceaccessusers.includes(userinfo.user_name),        
    };
    const gos = new GlassOrderServices();
    // AutoCompleate();
    const columnDefs = models.procurementgridashraf($scope, access, $compile, $scope.viewprint);
    const gridOptions = gos.gridoptions(columnDefs);
    const gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);
    $scope.isrptloading = false;
    let splitval = 500;
    let rowcount = 0;
    //get report
    LoadReport();
    async function LoadReport() {
        _rptdata = [];
        const res = await gos.GET(`gos/indexprx.php`);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        rowcount = (+res.data);
        let splitcount = rowcount / splitval;
        let rowstart = [];
        let n = 0;
        rowstart.push(n);
        for (var i = 0; i < splitcount; i++) {
            n = n + splitval;
            rowstart.push(n)
        }

        LoadReports(rowstart)
        $scope.$apply();
    }
    async function LoadReports(x) {
        $scope.isrptloading = true;
        let _griddatas = [];
        x.map(async (i) => {
            const res = await fetchDatas(i);
            res.data.map(k => {
                if (pagetype === "all") {
                    $scope.pagetitle = "Glass Order All"
                    _griddatas.push(k);
                }
                else if (pagetype === "nobal") {
                    if ((+k.go_balance_qty) <= 0) {
                        //console.log(k);
                        $scope.pagetitle = "Glass Order Recipts"
                        _griddatas.push(k);
                    }
                } else {
                    if ((+k.go_balance_qty) > 0) {
                         $scope.pagetitle = "Glass Order balance"
                        _griddatas.push(k);
                    }
                }
            })

            $scope.isrptloading = false;
            _rptdata = _griddatas;
            gridOptions.api.setRowData(_griddatas);
            $scope.$apply();



        })
    }
    async function fetchDatas(sno) {
        const res = await gos.GET(`gos/gosprox.php?limitr=${sno}`);
        return res;
    }

    $scope.currentgo = {};
    async function getgoinfo(id) {
        $scope.currentgo = {};
        const res = await gos.GET(`gos/goget.php?goid=${id}`);
        if (res?.msg !== 1) {
            return;
        }
        $scope.currentgo = res.data;
        $scope.$apply();
        return;
    }

    $scope.exportExcel = function () {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            let excelfilename = "Glass Order List - Procurement";
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


    //get history of go id    
    $scope.procurementreceipt = {
        diashow: false,
        isloading: false,
        procurementreceiptsdata: []
    };
    async function loadReceipt(id) {
        const res = await gos.GET(`gos/procurementreceipt.php?goid=${id}`);
        if (res?.msg !== 1) {
            alert(res.data);
            return [];
        }
        return res.data;
    }
    $scope.receiptlist = async (id) => {
        getgoinfo(id);
        $scope.procurementreceipt = {
            diashow: true,
            isloading: false,
            procurementreceiptsdata: []
        };
        let datas = await loadReceipt(id);
        $scope.procurementreceipt = {
            diashow: true,
            isloading: false,
            procurementreceiptsdata: datas
        };
        //$scope.procurementreceipts = res.data;
        //LoadReport();
        $scope.$apply();
        return;
    }

    $scope.prnewreceipt = {
        diashow: false,
        isloading: false,
        title: "",
        data: {
            goreceiptid: "",
            goreceiptgono: "",
            goreceiptgoprno: "",
            goreceiptdate: "",
            goreceiptinvoiceno: "",
            goreceiptsupplier: "",
            goreceiptarea: "",
            goreceipt_project: "",
            goreceipt_projectname: "",
            goreceipt_projectlocation: "",
            goreceiptunitprice: "0",
            goreceiptcalby: "q",
            goreceiptotherprice: "0",
            goreceipttotalprice: "0",
            goreceipttype: 'GO',
            broken_by: 'Supplier',
            broken_naf_by: 'site',
            broken_engg: '',
            broken_go_oldno: '',
            broken_description: '',
        }
    }

    $scope.addnewReceipt = () => {

        $scope.prnewreceipt = {
            ...$scope.prnewreceipt,
            data: {
                goreceiptid: "",
                goreceiptgono: "",
                goreceiptgoprno: "",
                goreceiptdate: "",
                goreceiptinvoiceno: "",
                goreceiptsupplier: "",
                goreceiptarea: "",
                goreceipt_project: "",
                goreceipt_projectname: "",
                goreceipt_projectlocation: "",
                goreceiptunitprice: "0",
                goreceiptcalby: "q",
                goreceiptotherprice: "0",
                goreceipttotalprice: "0",
                goreceipttype: 'GO',
                broken_by: 'Supplier',
                broken_naf_by: 'site',
                broken_engg: '',
                broken_go_oldno: '',
                broken_description: '',
            },
            diashow: true
        }
    }
    let rec_calby = "a";
    $scope.calbyqtyx = false;
    $scope.calbyareax = true;
    $scope.changecalbyx = (a) => {
        rec_calby = a;
        if (a === "a") {
            $scope.calbyqtyx = false;
            $scope.calbyareax = true;
        } else {
            $scope.calbyqtyx = true;
            $scope.calbyareax = false;
        }
        calpriceReceipt()
    }

    function calpriceReceipt() {
        let goreceiptqty = document.getElementById("goreceiptqty").value;
        let goreceiptarea = document.getElementById("goreceiptarea").value;
        let goreceiptunitprice = document.getElementById("goreceiptunitprice").value;
        let calprice = rec_calby === "a" ? (+goreceiptarea) : (+goreceiptqty);
        let totprice = calprice * (+goreceiptunitprice);
        let goreceiptotherprice = document.getElementById("goreceiptotherprice").value;
        let total_price = totprice + (+goreceiptotherprice);

        $scope.prnewreceipt = {
            ...$scope.prnewreceipt,
            data: {
                ...$scope.prnewreceipt.data,
                goreceipttotalprice: total_price
            }
        }

        console.log($scope.prnewreceipt);
    }
    $scope.calcpricesx = () => {
        calpriceReceipt();
    }
    function checkQty() {
        let received_qty = document.getElementById("goreceiptqty").value;
        let oldreceived_qty = $scope.currentgo.receipt_qty;
        let pqtuy = $scope.currentgo.procurement_qty;

        let x = (+received_qty) + (+oldreceived_qty);
        console.log(x, pqtuy)
        // alert(x);

        if (x <= (+pqtuy)) {
            return true;
        } else {
            return false;
        }
    }
    $scope.prnewreceipt_submit = async () => {
        let qtyok = checkQty();
        if ($scope.prnewreceipt.data.goreceipttype === 'GO') {
            if (!qtyok) {
                alert("Over Qty")
                return
            }
        }
        if ($scope.prnewreceipt.isloading) return;
        const fd = new FormData();
        $scope.prnewreceipt = {
            ...$scope.prnewreceipt,
            isloading: true,
            data: {
                ...$scope.prnewreceipt.data,
                goreceiptgono: $scope.currentgo.goid,
                goreceiptsupplier: $scope.currentgo.procurement_supplier,
                goreceiptgoprno: $scope.currentgo.goprojectid,
                goreceipt_project: $scope.currentgo.goproject,
                goreceipt_projectname: $scope.currentgo.goprojectname,
                goreceipt_projectlocation: $scope.currentgo.goprojectlocation,
                goreceiptcalby: 0,
            }
        }

        fd.append("payload", JSON.stringify($scope.prnewreceipt.data));

        const res = await gos.POST(`gos/procurementnewreceipt.php?goid=${$scope.currentgo.goid}`, fd);

        if (res?.msg !== 1) {
            alert(res.data);
            $scope.prnewreceipt = {
                ...$scope.prnewreceipt,
                isloading: false,
                data: {
                    ...$scope.prnewreceipt.data,
                }
            };

            return;
        }

        $scope.prnewreceipt = {
            ...$scope.prnewreceipt,
            isloading: false,
            diashow : false,
            data: {
                ...$scope.prnewreceipt.data,
            }
        };
        $scope.procurementreceipt = {
            diashow: true,
            isloading: true,
            procurementreceiptsdata: []
        };
        alert("Data has saved");
        let datas = await loadReceipt($scope.currentgo.goid);
        console.log("reloads",datas);

        $scope.procurementreceipt = {
            diashow: true,
            isloading: false,
            procurementreceiptsdata: datas
        };
        await LoadReport();
        $scope.$apply();
        
        return;
    }
    //clear filters

    $scope.clearFilters = function () {
        gridOptions.columnApi.applyColumnState({
            defaultState: {
                sort: null,
            },
        });

        gridOptions.api.setFilterModel(null);
        gridOptions.api.setRowData([]);
        gridOptions.api.setRowData(_rptdata);
        gridOptions.columnApi.applyColumnState({
            state: [{ colId: 'procurement_orderdate', sort: 'desc' }],
        });


    }

    $scope.goupload = {
        diashow: false,
        isloading: false,
        id: 0
    };
    $scope.uploadmox = (id) => {
        $scope.goupload = {
            diashow: true,
            isloading: false,
            id: id
        };
    }

    $scope.uploadgosubmit = async () => {
        if ($scope.goupload.isloading) return;
        const fd = new FormData(
            document.getElementById("uploadgo")
        );
        $scope.goupload = {
            ...$scope.goupload,
            isloading: true,
        };
        const res = await gos.POST(`cuttinglists/gospdf.php?goid=${$scope.goupload.id}`, fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.goupload = {
                ...$scope.goupload,
                isloading: false,
            };
            $scope.$apply();
            return;
        }
        alert("Data has Updated");
        LoadReport();
        $scope.goupload = {
            ...$scope.goupload,
            isloading: false
        };
        $scope.$apply();
        return;
    }


    $scope.show_print_filter = false;
    $scope.hidefilter = (s) => $scope.show_print_filter = s;
    $scope.startfilter = () => {
        let _rpt = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _rpt.push(_.data);
        })
        localStorage.setItem("print_gosp_data", JSON.stringify(_rpt));
        localStorage.setItem("print_gosp_cols", JSON.stringify($scope.viewprint));
        window.open(`${print_location}/sprint/gosp.html`, '_blank', "width:1300px;height:700px");
        //let printwindow = window.open(`${print_location}/sprint/gosp.html`, '_blank', "width:1300px;height:700px");
        // printwindow.forprintdata = JSON.stringify(_rpt);
        // printwindow.cols = JSON.stringify($scope.viewprint);
    }

    //get this week

    _getThisWeek();
    async function _getThisWeek() {
        //console.log("AAAAAA");
        const res = await gos.GET(`cuttinglists/weekget.php`);
        if (res?.msg !== 1) {
            return;
        }

        $scope.datefilter = {
            ...$scope.datefilter,
            data: {
                fromdate: res.data.fday,
                todate: res.data.fd,
            }
        };

        console.log(res.data);
        console.log($scope.datefilter);

        $scope.$apply();

    }


    function _convertDate(d) {
        const x = d.split('-');

        const date = x[0];
        const month = x[1];
        const year = x[2];

        return `${year}-${month}-${date}`;
    }
    //date filter code 
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
        const filterdata = _rptdata.filter(x => x.procurement_orderdate >= fdate && x.procurement_orderdate <= todate);
        let sortdata = filterdata.sort((a, b) => {
            if (a.procurement_orderdate < b.procurement_orderdate) {
                return -1;
            }
            if (a.procurement_orderdate > b.procurement_orderdate) {
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

    //defalut print setup

    $scope.printdefalut = () => {
        let xviewprint = {
            odate: true,
            otype: false,
            supplier: false,
            coatting: false,
            contract: true,
            projectname: true,
            gono: true,
            pino: true,
            thikenss: true,
            outter: true,
            inner: true,

            qty: false,
            qtyreceived: false,
            qtybalance: true,
            uinsert: false,
            remarks: false,
            dlocation: false,
            eta: false,
            wkrno: false,
            area: false,
            unitprice: false,
            otherprice: false,
            totalprice: false,

            recivedarea: false,
            balancearea: false,
            glasstype: false,
            glassspec: false,

            //need to dispatch
        };

        let _rpt = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _rpt.push(_.data);
        })
        localStorage.setItem("print_gosp_data", JSON.stringify(_rpt));
        localStorage.setItem("print_gosp_cols", JSON.stringify(xviewprint));
        window.open(`${print_location}/sprint/gosp.html`, '_blank', "width:1300px;height:700px");
    }

    $scope.goreceipt = {
        diashow: false,
        isloading: false,
    };
    let receiptcurrentid = 0;
    $scope.uploadgoreceipt = (id) => {
        receiptcurrentid = id;
        $scope.goreceipt = {
            diashow: true,
            isloading: false,
        };
    }

    $scope.goreceiptupdate_submit = async () => {
        if ($scope.goupload.isloading) return;
        const fd = new FormData(
            document.getElementById("goreceiptupdate")
        );
        $scope.goupload = {
            ...$scope.goupload,
            isloading: true,
        };
        const res = await gos.POST(`cuttinglists/gorpdf.php?goid=${receiptcurrentid}`, fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.goupload = {
                ...$scope.goupload,
                isloading: false,
            };
            $scope.$apply();
            return;
        }
        alert("Data has Updated");
        LoadReport();
        $scope.goupload = {
            ...$scope.goupload,
            isloading: false
        };
        $scope.$apply();
        return;
    }

    //edit option
    $scope.prupdate = {
        diashow: false,
        isloading: false,
        title: 'Edit Glass Order',
        data: {
            goid: '',
            gonodisp: '',
            goglassspec: '',
            goqty: '',
            goarea: '',
            procurement_orderdate: '',
            procurment_orderunitprice: '',
            procurement_calby: '',
            procurement_otherprice: '',
            procurement_totalprice: '',
            procurement_supplier: '',
            procurement_coating: '',
            procurement_thickness: '',
            procurement_out: '',
            procurement_inner: '',
            procurement_qty: '',
            procurement_area: '',
            goreceipttype: 'GO',
            broken_by: 'Supplier',
            broken_naf_by: 'site',
            broken_engg: '',
            broken_go_oldno: '',
            broken_description: '',
            invoiceno: '',
            proucrementeta: '',
            uinsert: '',
            procurementremark: '',
            dellocation: '',
            workorderno: '',
        }
    }

    let currentid = "";

    $scope.updateProcurement = async (id) => {

        $scope.prupdate = {
            diashow: false,
            isloading: false,
            title: 'Edit Glass Order',
            data: {
                goid: '',
                gonodisp: '',
                goglassspec: '',
                goqty: '',
                goarea: '',
                procurement_orderdate: '',
                procurment_orderunitprice: '',
                procurement_calby: '',
                procurement_otherprice: '',
                procurement_totalprice: '',
                procurement_supplier: '',
                procurement_coating: '',
                procurement_thickness: '',
                procurement_out: '',
                procurement_inner: '',
                procurement_qty: '',
                procurement_area: '',
                goreceipttype: 'GO',
                broken_by: 'Supplier',
                broken_naf_by: 'site',
                broken_engg: '',
                broken_go_oldno: '',
                broken_description: '',
                invoiceno: '',
                proucrementeta: '',
                uinsert: '',
                procurementremark: '',
                dellocation: '',
                workorderno: '',
            }
        }
        console.log($scope.prupdate);
        const res = await gos.GET(`gos/goget.php?goid=${id}`);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        currentid = id;
        $scope.prupdate = {
            diashow: true,
            isloading: false,
            title: res.data.gonodisp + ' -   Edit Glass Order',
            data: res.data
        }

        $scope.prupdate = {
            ...$scope.prupdate,
            data: {
                ...$scope.prupdate.data,
                procurement_orderdate: res.data.procurement_orderdate_d.normal,
                goreceipttype: res?.data?.goreceipttype === '' ? 'GO' : res.data.goreceipttype,
                broken_by: res?.data?.broken_by === '' ? 'Supplier' : res.data.goreceipttype,
                broken_naf_by: res?.data?.broken_naf_by === '' ? 'site' : res.data.goreceipttype,
                broken_engg: res?.data?.broken_engg === '' ? res.data.godoneby : res.data.broken_engg,
                broken_go_oldno: res?.data?.broken_go_oldno === '' ? '' : res.data.goreceipttype,
                broken_description: res?.data?.broken_description === '' ? '' : res.data.goreceipttype,
                invoiceno: res?.data?.invoiceno === '' ? '' : res.data.invoiceno,
                proucrementeta: res?.data?.proucrementeta,
                uinsert: res?.data?.uinsert,
                procurementremark: res?.data?.procurementremark,
                dellocation: res?.data?.dellocation,
                workorderno: res?.data?.workorderno
            }
        }

        console.log($scope.prupdate);

        $scope.$apply();
        return;
    }
    let calcby = "a";
    $scope.calbyqty = false;
    $scope.calbyarea = true;
    $scope.changecalby = (s) => {
        calcby = s;
        console.log(s);
        console.log(calcby);
        $scope.calbyqty = calcby === 'q' ? true : false;
        $scope.calbyarea = calcby !== 'q' ? true : false;
        calc()
    }
    $scope.calcprices = () => {
        calc();
    }
    function calc() {
        const goqty = document.getElementById("goqty").value;
        const goarea = document.getElementById("goarea").value;
        const uniprice = document.getElementById("procurment_orderunitprice").value;
        const oterprice = document.getElementById('procurement_otherprice').value;
        let tot = (+goarea);
        let xtot = (+tot) * (+uniprice);
        let finalprice = (+xtot) + (+oterprice);

        $scope.prupdate = {
            ...$scope.prupdate,
            data: {
                ...$scope.prupdate.data,
                procurement_calby: calcby,
                procurement_totalprice: Math.round(finalprice),
            }
        }

    }
    $scope.currentgo = {};
    async function getgoinfo(id) {
        $scope.currentgo = {};
        const res = await gos.GET(`gos/goget.php?goid=${id}`);
        if (res?.msg !== 1) {
            return;
        }
        $scope.currentgo = res.data;
        $scope.$apply();
        return;
    }
    $scope.procuremnetudpate_submit = async () => {

        if ($scope.prupdate.isloading) return;

        const fd = new FormData();
        fd.append("payload", JSON.stringify($scope.prupdate.data));
        $scope.prupdate = {
            ...$scope.prupdate,
            data: {
                ...$scope.prupdate.data,
            },
            isloading: true,
        }
        const res = await gos.POST(`gos/procurementupdate.php?goid=${currentid}`, fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.prupdate = {
                ...$scope.prupdate,
                data: {
                    ...$scope.prupdate.data,
                },
                isloading: false,
            }
            AutoCompleate();
            $scope.$apply();
            return;
        }

        $scope.prupdate = {
            ...$scope.prupdate,
            data: {
                ...$scope.prupdate.data,
            },
            isloading: false,
        }
       
        LoadReport();
        $scope.$apply();
        
        return;

    }

    $scope.removereceipt = async(id) => {
        if ($scope.isloading) return;
        const c = confirm("Are You Sure To Remove data?");
        if (!c) return;
        $scope.isloading = true;
        const res = await gos.GET(`gos/receipt-remove.php?goreceiptid=${id}`);
        if (res?.msg !== 1) {
            $scope.isloading = false;
            alert(res.data);
            return;
        }
        alert("Removed");
        let datas = await loadReceipt($scope.currentgo.goid);
        console.log("reloads",datas);

        $scope.procurementreceipt = {
            diashow: true,
            isloading: false,
            procurementreceiptsdata: datas
        };
        await LoadReport();
        $scope.isloading = false;
        return;
    }
    //edit option

    //remove

    $scope.print_defalutstyle = () => {
        let _data = [];    
        let _config = []
        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _data.push(_.data);
            _config.push(_);
        })        
        //console.log(_data);
        if (_data.length === 0) {
            alert("No Data.")
            return;
        }
        //console.log(_data);
        //console.log(_data.length);
        let _bodywidth = _config[0].columnController.columnApi.columnController.columnApi.columnController.bodyWidth;
        let _columns = _config[0].columnController.columnApi.columnController.columnApi.columnController.autoRowHeightColumns;
        //let _columns = _config[0].columnController.columnApi.columnController.columnApi.columnController.autoRowHeightColumns;
        //console.log(_columns);
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
        console.log(fconfig);
        localStorage.setItem("pms_go_sam_rpt", JSON.stringify(_data));
        localStorage.setItem("pms_go_sam_rpt_config", JSON.stringify(fconfig));
        localStorage.setItem("pms_go_sam_rpt_totwidth",_bodywidth.toString())
        //console.log(_config[0].columnController.columnApi.columnController.columnApi.columnController);
        ///window.open(`${url}print/customers.php`, "_blank", "width:1200px;height:700px");
        //window.open(`${print_location}/sprint/gospsam.html`, '_blank', "width:1300px;height:700px");
    }

}