import Mrservices from "../services/mrs.js";
import * as models from "./../../../cuttinglist/js/controllers/models.js";
import * as mrmodels from './modeln.js'
import Mrservicesx from "../services/mr.js";
export default function mrp($scope, $http, $compile) {
    const mrs = new Mrservices();
    const mr = new Mrservicesx();
    let access = {
        edit: userinfo?.user_name === 'demo' || userinfo?.user_name === 'fidel' ? true : false
    };
    let splitval = 500;
    let rowcount = 0;
    const columnDefs = mrmodels.mrgridview($scope, access, $compile);
    const gridOptions = models.gridoptionsx(columnDefs);

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

    $scope.excelexport = () => {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {

            var mname = `Material Request For Project : ${$scope.viewproject.project_name}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }

    $scope.isrptloading = false;
    let gridApi;
    const gridDiv = document.querySelector('#myGrid');
    gridApi = new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);

    GetRowCount();
    async function GetRowCount() {
        const res = await mrs.GET("mr/gcount.php");
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }

        rowcount = (+res.data);
        if (rowcount === 0) {
            alert("No Data Found");
            $scope.isrptloading = false;
            return;
        }
        let splitcount = rowcount / splitval;
        let rowstart = [];
        let n = 0;
        rowstart.push(n);
        for (var i = 0; i <= splitcount; i++) {
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
            console.log(res.data);
            if (res.data.length !== 0) {
                res.data.map(k => {
                    _griddatas.push(k);
                })
                gridOptions.api.setRowData(_griddatas);
                if (_griddatas.length === rowcount) {
                    $scope.isrptloading = false;
                    $scope.$apply();
                }
            }
        })
    }

    async function fetchDatas(sno) {
        const res = await mrs.GET(`mr/mrs.php?limitr=${sno}`);
        return res;
    }
    let current_mrid = "";
    $scope.newmrp = {
        isloading: false,
        isshow: false,
        data: {
            mrp_orderno: "",
            mrp_supplier: "",
            mrp_okdate: "",
            mrp_eta: "",
            mrp_system: "",
            mrp_datereceive: "",
            mrp_totorder: "",
            mritem: "",
            mrdieweight: "",
            mrreqlength: "",
        }
    }

    $scope.mrpedit = async (id) => {
        $scope.newmrp = {
            isloading: false,
            isshow: true,
            data: {
                mritem: "",
                mrp_orderno: "",
                mrp_supplier: "",
                mrp_okdate: "",
                mrp_eta: "",
                mrp_system: "",
                mrp_datereceive: "",
                mrp_totorder: "",
                mrdieweight: "",
                mrreqlength: "",
            }
        }
        if ($scope.newmrp.isloading) return;
        await getInfo(id);
    }
    async function getInfo(mrid) {
        //  console.log(gridApi.getRowNode(mrid));

        current_mrid = mrid;
        $scope.newmrp = {
            ...$scope.newmrp,
            isloading: true,
            data: {
                ...$scope.newmrp,
            }
        }
        const res = await mrs.GET(`mr/mrpget.php?mrid=${mrid}`);
        if (res?.msg !== 1) {
            $scope.newmrp = {
                ...$scope.newmrp,
                isloading: false,
                data: {
                    ...$scope.newmrp,
                }
            }
            alert(res.data);
            return;
        }
        $scope.newmrp = {
            ...$scope.newmrp,
            isloading: false,
            data: {
                mrp_orderno: res.data.mrp_orderno,
                mrp_supplier: res.data.mrp_supplier,
                mrp_okdate: res.data.mrp_okdate_d.normal,
                mrp_eta: res.data.mrp_eta,
                mrp_system: res.data.mrp_system,
                mrp_datereceive: res.data.mrp_datereceived.normal,
                mrp_totorder: res.data.mrp_totorder,
                mrdieweight: res.data.mrdieweight,
                mrreqlength: res.data.mrreqlength,
                mritem: res.data.mritem,
                totalweight: res.data.totalweight,

            }
        }
        $scope.$apply();
        return;
    }

    function caltotwight() {
        const mrdieweight = $scope.newmrp?.data?.mrdieweight ?? 0;
        const mrreqlength = $scope.newmrp?.data?.mrreqlength ?? 0;
        const mrp_totorder = $scope.newmrp?.data?.mrp_totorder ?? 0;

        const totalweight = ((+mrdieweight) * (+mrreqlength) * (+mrp_totorder)) / 1000
        $scope.newmrp = {
            ...$scope.newmrp,
            data: {
                ...$scope.newmrp.data,
                totalweight: totalweight
            }
        }
    }

    $scope.caltoweight = () => caltotwight();

    $scope.updatemrp = async () => {
        if ($scope.newmrp.isloading) return;
        const fd = new FormData();
        fd.append('payload', JSON.stringify($scope.newmrp.data));
        const res = await mrs.POST(`mr/updatemrp.php?mrid=${current_mrid}`, fd);
        if (res?.msg !== 1) {
            alert(res?.data);
            return;
        }
        alert("data has updated");
        GetRowCount();
        return;
    }
    $scope.selected_mr = {};
    $scope.mr_receipts = [];

    async function getreceipthistory(mrid) {        
        const res = await mrs.GET(`mr/mrpreceipts.php?mrid=${mrid}`);
        console.log(res.data);
        return res?.msg === 1 ? res.data : 0;
    }
    async function getmrinfo(mrid) {        
        const res = await mrs.GET(`mr/mrpget.php?mrid=${mrid}`);
        console.log(res.data);
        return res.msg === 1 ? res.data : 0;
    }
    $scope.receiptloading = false;
    $scope.mrpreceipts = async (mrid) => {               

        $scope.selected_mr = {};
        $scope.mr_receipts = [];        

        const mrinfo = getmrinfo(mrid);
        const mrreceipt = getreceipthistory(mrid);

        if (mrreceipt === 0 || mrinfo === 0) {            
            alert("Error found on Getting data");
            return;
        }

        $scope.selected_mr = await mrinfo;
        $scope.mr_receipts = await mrreceipt;
        showMrReceipt();
        $scope.$apply();
        return;
    }


    $scope.mrpreceipt = {
        isshow: false,
        isloading: false,
        data: {
            mrid: "",
            mrpid: "",
            mrproject: "",
            mrprojectname: "",
            mritemdescription: '',
            mritemdieweight: "",
            mritemlength: "",
            mritemreceivedqty: "",
            mrreceiptid: "",
            mrreciptdate: "",
            mrsupplier: "",
            totalweight: "",
        }
    }


    function showMrReceipt() {
        $scope.mrpreceipt = {
            isshow: true,
            isloading: false,
            data: {
                mrid: $scope.selected_mr.mrid,
                mrpid: $scope.selected_mr.project_id,
                mrproject: $scope.selected_mr.project_no,
                mrprojectname: $scope.selected_mr.project_name,
                mritem : $scope.selected_mr.mrpartno,
                mritemdescription: $scope.selected_mr.mritem,
                mritemdieweight: $scope.selected_mr.mrdieweight,
                mritemlength: $scope.selected_mr.mrreqlength,
                mritemreceivedqty: "",
                mrreceiptid: "",
                mrreciptdate: "",
                mrsupplier: $scope.selected_mr.mrp_supplier,
                totalweight: "",
            }
        }
    }
    $scope.caltoweightreceipt = () => receiptTotalWight();
    function receiptTotalWight() {
        const mritemdieweight = $scope.mrpreceipt?.data?.mritemdieweight ?? 0
        const mritemlength = $scope.mrpreceipt?.data?.mritemlength ?? 0
        const mritemreceivedqty = $scope.mrpreceipt?.data?.mritemreceivedqty ?? 0
        const totalweight = (+mritemdieweight) * (+mritemlength) * (+mritemreceivedqty) / 1000;
        $scope.mrpreceipt = {
            ...$scope.mrpreceipt,
            data: {
                ...$scope.mrpreceipt.data,
                totalweight : totalweight
            }
        }
    }
    $scope.savemprreceipt = async () => {
        if ($scope.mrpreceipt.isloading) return;
        $scope.mrpreceipt = {
            ...$scope.mrpreceipt,
            data: {
                ...$scope.mrpreceipt.data,
            },
            isloading: true,            
        }
        const fd = new FormData(); 
        fd.append('payload', JSON.stringify($scope.mrpreceipt.data));
        const res = await mrs.POST('mr/newreceipt.php', fd);
        if (res?.msg !== 1) {
            $scope.mrpreceipt = {
                ...$scope.mrpreceipt,
                data: {
                    ...$scope.mrpreceipt.data,
                },
                isloading: false,            
            }
            alert(res.data);
            $scope.$apply();
            return;
        }

        $scope.mrpreceipt = {
            ...$scope.mrpreceipt,
            data: {
                ...$scope.mrpreceipt.data,
            },
            isloading: false,            
        }
        alert("data has Saved");
        GetRowCount();
        $scope.$apply();
        return;
    }



    //print

    async function getMrInfo(params){
        const fd = mr.FormData();
        fd.append('params', JSON.stringify(params));
        const res = await mr.apicall(fd, 'mrview');
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        localStorage.removeItem('pms_print_mr_info');        
        sessionStorage.setItem('nafco_project_current_sno', res.data.infos.mrproject)
        sessionStorage.setItem('nafco_project_current',res.data.infos.project_no_enc)
        localStorage.setItem('pms_print_mr_info', JSON.stringify(res.data));
    }

    $scope.print_mr_click = async (p, c, n) => {        
        let params = {
            mrproject: p,
            mrcode: c,
            mrno: n
        };   
        await getMrInfo(params);
        // localStorage.setItem('pms_print_mr_info_method', 'E');
       window.location.href = `${print_location}/Dashboard/Main/index.php#!/mrn/e`
    }



}