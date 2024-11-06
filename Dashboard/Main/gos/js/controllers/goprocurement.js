import GlassOrderServices from '../services/index.js';
import * as models from './models.js';
export default function goprocurement($scope, $compile) {
    console.log("its working");
    $scope.pagetitle = "Procurement Entry";
    $scope.printshow = false;
    $scope.customizeprintbtn = false;
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
        editaccess: userinfo.user_name === 'demo' || userinfo.user_name === 'ashraff',
        pdfupdate: userinfo.user_name === 'demo' || userinfo.user_name === 'ashraff',
        priceaccess: priceaccessusers.includes(userinfo.user_name),
        receiptaccess: false,
    };
    const gos = new GlassOrderServices();
    AutoCompleate();
    const columnDefs = models.procurementgrid($scope, access, $compile);
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
        const res = await gos.GET(`gos/indexpr.php`);
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
                _griddatas.push(k);
            })

            if (_griddatas.length === rowcount) {
                $scope.isrptloading = false;
                gridOptions.api.setRowData(_griddatas);
                $scope.$apply();
            }

        })
    }
    async function fetchDatas(sno) {
        const res = await gos.GET(`gos/gospro.php?limitr=${sno}`);
        return res;
    }
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
    console.log($scope.prupdate)
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
                proucrementeta: '',
                uinsert: '',
                procurementremark: '',
                dellocation: '',
                workorderno: '',
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
        $scope.$apply();
        LoadReport();
        return;

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
                ...$scope.prnewreceipt.data,
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

    $scope.prnewreceipt_submit = async () => {
        if ($scope.prnewreceipt.isloading) return;
        const fd = new FormData();
        $scope.prnewreceipt = {
            ...$scope.prnewreceipt,
            isloading: true,
            data: {
                ...$scope.prnewreceipt.data,
                goreceiptsupplier: $scope.currentgo.procurement_supplier,
                goreceiptgoprno: $scope.currentgo.goprojectid,
                goreceipt_project: $scope.currentgo.goproject,
                goreceipt_projectname: $scope.currentgo.goprojectname,
                goreceipt_projectlocation: $scope.currentgo.goprojectlocation,
                goreceiptcalby: rec_calby,
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
            data: {
                ...$scope.prnewreceipt.data,
            }
        };
        $scope.procurementreceipt = {
            diashow: true,
            isloading: true,
            procurementreceiptsdata: []
        };
        let datas = loadReceipt($scope.currentgo.goid);

        $scope.procurementreceipt = {
            diashow: true,
            isloading: false,
            procurementreceiptsdata: datas
        };

        $scope.$apply();
        alert("Data has saved");
        return;
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
    $scope.autoCompleate = {
        suppliers: [],
        coatings: [],
        thikness: [],
        outters: [],
        inners: [],
    }
    async function AutoCompleate() {
        $scope.autoCompleate = {
            suppliers: [],
            coatings: [],
            thikness: [],
            outters: [],
            inners: [],
            uinserts: [],
            locations : []
            
        }
        const res = await gos.GET('gos/goauto.php');

        if (res?.msg !== 1) {
            return;
        }
        $scope.autoCompleate = {
            suppliers: res?.data?.suppliers,
            coatings: res?.data?.coatings,
            thikness: res?.data?.thikness,
            outters: res?.data?.outters,
            inners: res?.data?.inners,
            uinserts: res?.data?.uinserts,
            locations : res?.data?.lcoations,
        }
        $scope.$apply();
        return;

    }
}