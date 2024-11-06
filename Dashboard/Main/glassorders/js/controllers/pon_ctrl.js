import GlassSupplierServices from './../services/suppliers.js'
import POService from './../services/po.js';
export default function pon_ctrl($scope, $http, $compile, $rootScope, $filter) {
    console.log("working ppppp");
    const s = new GlassSupplierServices();
    const po = new POService();
    $scope.po = {
        ...$scope.po,
        potype: "Glass",
        ordertype: "1",        
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
    const _msg = (d, t, msg = "") => {
        let icon = t === "n" ? "fa fa-exclamation-circle" : "fa fa-info-circle";
        let theme = t === "n" ? "ism-dialog-input-error" : "ism-dialog-input-success";

        $scope.res = {
            display: d,
            theme: theme,
            icon: icon,
            msg: msg
        }
        setTimeout(_msgoff, 2000);
    }
    _msg(false, "n")
    function _msgoff() {
        $scope.res.display = false;
        $scope.$apply();
    }


    get_projectinfo()
    function get_projectinfo() {
        let project_id = sessionStorage.getItem("nafco_project_current");
        let post_data = {
            naf_user: userinfo,
            project_no: project_id
        }
        var req = $http.post(api_url + "Project/view.php", post_data);
        req.then(res => {
            //console.log(res.data);
            if (res.data.msg === "1") {
                $scope.viewproject = res.data.data;
                localStorage.removeItem("currentproject");
                localStorage.setItem("pms_currentproject", JSON.stringify($scope.viewproject));

                console.log($scope.viewproject);
                $scope.newproject = res.data.data;

                $scope.po = {
                    ...$scope.po,                           
                    projectno: res.data.data.project_no,
                    projectname: res.data.data.project_name,
                    projectlocation : res.data.data.project_location
                };
                //$scope.$apply();

            } else {
                alert(res.data.data);
            }
        });
    }
    $scope.additem = {
        sno: 0,
        description: "",
        qty: "",
        weight: "",
        area: "",
        totalprice: "",
        unitprice: "",
    }
    $scope.paymenttermslist = [];
    $scope.deliverytermslist = [];
    let sno = 1;
    let psno = 1;
    let dsno = 1;
    $scope.polist = [];
    function _unitprice(a, b) {
        if ((+a) === 0 && (+b) === 0) {
            return 0;
        }
        if ((+b) === 0) {
            return (+a);
        }
        return (+a) / (+b);
    }

    function subttocalc() {
        let _i = 0;
        let _extra = 0;
        let _ttoextra = 0;
        let _qty = 0;
        let _ton = 0;
        let _area = 0;
        $scope.polist.map(i => {
            _extra += (+i.extraamount);
            _ttoextra += (+i.currentamount);
            _i += (+i.totalprice);
            _qty += (+i.qty);
            _ton += (+i.weight);
            _area += (+i.area);
        })
        $scope.itemtotqty = _qty;
        $scope.itemtotwgt = _ton;
        $scope.itemtotarea = _area;
        $scope.itemstotal = _i;
        $scope.itemstotalextra = _extra;
        $scope.itemstotalsubtotal = _ttoextra;
    }
    function vatcalc() {
        let _vat = $scope.povatval ?? 0;
        if (isNaN(_vat)) {
            _vat = 0;
        }
        let _amount = $scope.itemstotalsubtotal ?? 0;
        if (isNaN(_amount)) {
            _amount = 0;
        }
        let vatam = (+_amount) * (+_vat) / 100;
        $scope.vatval = vatam;

        $scope.itemssubttotal = (+vatam) + (+_amount);
        // $scope.$apply();
        return;

    }
    document.getElementById('totalprice').addEventListener('keydown', (e) => {
        // if (e.which === 13) {
        //     _addintolist();
        // }
    })
    document.getElementById('totalpriceb').addEventListener('keydown', (e) => {
        // if (e.which === 13) {
        //     _addintolist();
        // }
    })

    document.getElementById("extraamount").addEventListener("keydown", (e) => {
        if (e.which === 13) {
            _addintolist();
        }
    })

    document.getElementById("extraamountb").addEventListener("keydown", (e) => {
        if (e.which === 13) {
            _addintolist();
        }
    })

    function _addintolist() {

        sno += 1;
        $scope.additem = {
            ...$scope.additem,
            sno: sno
        }
        const _descripton = document.getElementById("description");
        const _qty = document.getElementById("qty");
        const _weight = document.getElementById("weight");
        const _area = document.getElementById("area");
        const _totalprice = $scope.additem?.totalprice ?? "0";
        console.log(_totalprice)
        const glasscoatings = $scope.additem?.glasscoatings ?? '-';
        const glassthickness = $scope.additem?.glassthickness ?? '-';
        const glassout = $scope.additem?.glassout ?? '-';
        const glassinner = $scope.additem?.glassinner ?? '-';
        const extraamount = $scope.additem?.extraamount ?? 0;
        const currentamount = $scope.additem?.currentamount ?? 0;

        let description = _descripton.value.trim() === "" ? "-" : _descripton.value.trim();
        let qty = _qty.value.trim() === "" ? 0 : _qty.value.trim();
        let weight = _weight.value.trim() === "" ? 0 : _weight.value.trim();
        let area = _area.value.trim() === "" ? 0 : _area.value.trim();
        let totalprice = _totalprice;
        if ((+qty) === NaN) {
            qty = 0;
        }
        if ((+weight) === NaN) {
            weight = 0;
        }
        if ((+area) === NaN) {
            area = 0;
        }
        if ((+totalprice) === NaN) {
            totalprice = 0;
        }
        const xqty = $scope.calcbyqty ?? false;
        const xwgt = $scope.calcbywt ?? false;
        const xarea = $scope.calcbyarea ?? false;
        let unitprice = 0;
        if (xqty) {
            unitprice = _unitprice(totalprice, qty);
        }
        if (xwgt) {
            unitprice = _unitprice(totalprice, weight);
        }
        if (xarea) {
            unitprice = _unitprice(totalprice, area);
        }

        let _currentamount = (+extraamount) + (+totalprice);

        let xordertype = $scope.po.ordertype;
        let suppliername = $scope.po.suppliername;
        let projectno = $scope.po.projectno;
        let projectname = $scope.po.projectname;
        let projectlocation = $scope.po.projectlocation;
        let supplieratt = $scope.po.atten;
        let supplierfax = $scope.po.fax;
        let supplierph = $scope.po.address;

        console.log(xordertype);
        
        console.log($scope.polist);
        let additem = {
            sno: sno,
            description: description,
            glasscoatings: glasscoatings,
            glassthickness: glassthickness,
            glassout: glassout,
            glassinner: glassinner,
            qty: qty,
            weight: weight,
            area: area,
            totalprice: totalprice,
            unitprice: unitprice,
            calcby: calcby,
            extraamount: extraamount,
            currentamount: _currentamount,
            ordertype: xordertype,
            suppliername : suppliername,
            projectno : projectno,
            projectname : projectname,
            projectlocation: projectlocation,
            supplieratt: supplieratt,
            supplierfax: supplierfax,
            supplierph : supplierph,
        }
        console.log(additem);
        $scope.polist.push(additem);

        $scope.additem = {
            sno: "",
            description: "",
            glasscoatings: "",
            glassthickness: "",
            glassout: "",
            glassinner: "",
            qty: "",
            weight: "",
            area: "",
            totalprice: "",
            unitprice: "",
            calcby: calcby,
            extraamount: "",
            currentamount: "",
          
        }
        subttocalc();
        vatcalc();
        $scope.$apply();
        return;

    }
    $scope.povatvalcalc = () => {
        console.log("called")
        vatcalc();
    }
    document.getElementById("paymentterms").addEventListener('keydown', (e) => {
        if (e.which === 13) {
            paymenttermsadd();
            $scope.$apply();
            return;
        }
    })
    $scope.addtopaymentterms = () => {
        paymenttermsadd();
    }

    function paymenttermsadd() {
        let _item = document.getElementById("paymentterms");
        if (_item.value.trim() === "") {
            alert("Enter Terms");
            _item.focus();
            return;
        }
        dsno += 1;
        $scope.paymenttermslist.push({
            sno: dsno,
            terms: _item.value
        });
        $scope.paymentterms = "";
        _item.focus();
        //$scope.$apply();
        return;
    }

    $scope.addtodeliveryterms = () => {
        deliveryterms();
        return;
    }

    document.getElementById("deliveryterms").addEventListener('keydown', (e) => {
        if (e.which === 13) {
            deliveryterms();
            $scope.$apply();
            return;
        }
    })
    function deliveryterms() {
        let _item = document.getElementById("deliveryterms");
        if (_item.value.trim() === "") {
            alert("Enter Terms");
            _item.focus();
            return;
        }
        psno += 1;
        $scope.deliverytermslist.push({
            sno: psno,
            terms: _item.value
        });
        $scope.deliveryterms = "";
        _item.focus();
        //$scope.$apply();
        return;
    }
    $scope.removeItem = (x) => {
        $scope.polist.splice(x, 1);
        subttocalc();
        vatcalc();
        //$scope.$apply();
        console.log($scope.polist);
    }
    $scope.calcbyqty = true;
    let calcby = "q";
    $scope.changecalcmethod = (_m) => {
        const m = _m;
        switch (m) {
            case 'q':
                calcby = "q";
                $scope.calcbyqty = true;
                $scope.calcbywt = false;
                $scope.calcbyarea = false;
                break;
            case 'w':
                calcby = "w";
                $scope.calcbyqty = false;
                $scope.calcbywt = true;
                $scope.calcbyarea = false;
                break;
            case 'a':
                calcby = "a";
                $scope.calcbyqty = false;
                $scope.calcbywt = false;
                $scope.calcbyarea = true;
                break;
            default: changecalcmethods(); break;
        }

    }


    function _d(a, b) {
        if (isNaN(a)) {
            return 0;
        }
        if (isNaN(b)) {
            return 0;
        }
        console.log((+a) * (+b));
        return (+a) * (+b);
    }
    function price_calc() {

        const qty = $scope.calcbyqty ?? false;
        const wgt = $scope.calcbywt ?? false;
        const area = $scope.calcbyarea ?? false;

        let uprice = $scope.additem?.unitprice ?? 0;
        console.log(uprice);
        let totalvalue = 0;
        if (qty) {
            let qtyval = $scope.additem?.qty ?? 0;
            totalvalue = _d(uprice, qtyval);
            $scope.additem = {
                ...$scope.additem,
                totalprice: totalvalue
            };
            //$scope.$apply();
            return;
        }

        if (wgt) {

            let qtyval = $scope.additem?.weight ?? 0;
            totalvalue = _d(uprice, qtyval);
            $scope.additem = {
                ...$scope.additem,
                totalprice: totalvalue
            };
            //$scope.$apply();
            return;
        }

        if (area) {
            let qtyval = $scope.additem?.area ?? 0;
            totalvalue = _d(uprice, qtyval);
            $scope.additem = {
                ...$scope.additem,
                totalprice: totalvalue
            };
            // $scope.$apply();
            return;
        }
    }
    function _changefocus(_l) {
        switch (_l) {
            case 'd':
                document.getElementById("qty").focus();
                break;
            case 'q':
                document.getElementById("weight").focus();
                break;
            case 'w':
                document.getElementById("area").focus();
                break;
            case 'a':
                document.getElementById("unitprice").focus();
                break;
            case 'u':
                document.getElementById("totalprice").focus();
                break;
            default:
                break;

        }
    }
    function _changefocusf(_l) {
        switch (_l) {
            case 'd':
                // document.getElementById("qty").focus();
                break;
            case 'q':
                document.getElementById("description").focus();
                break;
            case 'w':
                document.getElementById("qty").focus();
                break;
            case 'a':
                document.getElementById("weight").focus();
                break;
            case 'u':
                document.getElementById("area").focus();
                break;
            case 't':
                document.getElementById("unitprice").focus();
                break;
            default:
                break;

        }
    }
    $scope.foucschange = ($event, _l) => {

        let _k = $event.which;
        // console.log(_k);
        switch (_k) {
            default:

                break;
            case 13:
            case 39:
                _changefocus(_l);
                break;
            case 37:
                _changefocusf(_l)
                break;
        }

    }


    $scope.calc_unitprice = () => {
        let uprice = $scope.additem?.unitprice ?? 0;
        console.log(uprice);
        price_calc();
    }

    $scope.povatval = "15";

    function changecalcmethods() {
        const qty = $scope.calcbyqty ?? false;
        const wgt = $scope.calcbywt ?? false;
        const area = $scope.calcbyarea ?? false;


        if (!qty && !wgt && !area) {
            $scope.calcbyqty = true;
            $scope.calcbyqty = false;
            $scope.calcbywt = false;
            //  return;
        }
    }

    $scope.removedeleiveryItem = (id) => {
        $scope.deliverytermslist.splice(id, 1);
    }

    $scope.removepaymenttermsItem = (id) => {
        $scope.paymenttermslist.splice(id, 1);
    }

    ///suppliers 
    $scope.selectsuppliers = async($event) => {
        $scope.supplierlist = [];        
        let potype = document.getElementById("potype").value;
        if (potype === "Glass") {
            await allsuppliers();
        } else {
            await allsuppliersFromWh() 
        }
    }

    async function allsuppliersFromWh() {
        const req = await fetch("http://172.0.100.17:8090/api/supplier/");
        const res = await req.json();
        $scope.supplierlist = res;
        $scope.$apply();
    }
    $scope.getallitems = ($event) => AllItems($event.target.value);
    $scope.autocompleateitemswh = []
    async function AllItems(srcval) {
        $scope.autocompleateitemswh = []
        if (!srcval || srcval === "") {
            return;
        }
        
        const req = await fetch("http://172.0.100.17:8090/api/stocks/"+srcval);
        const res = await req.json();
        $scope.autocompleateitemswh = res;
        $scope.$apply();
        return;
    }
    document.getElementById("dia_suppliers").style.display = 'none';
    $scope.supplierlist = [];
    allsuppliers();
    async function allsuppliers() {
        $scope.supplierlist = [];
        const res = await s.getAllGlassSuppliers();
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.supplierlist = [];
            $scope.$apply();
            return;
        }

        $scope.supplierlist = res.data ?? [];
        $scope.$apply();
    }
    let selected_supplier = {};
    $scope.getsupplierinfo = () => {
       // console.log(x);
        let id = $scope.po?.posupplier ?? 0;
        console.log(id);
        if (id === 0) {
            $scope.po = {
                ...$scope.po,
                atten: "",
                address: "",
                fax: "",
            }
            return;

        }
        selected_supplier = $scope.supplierlist.find(x => x.glasssupplierid === id);
        console.log(selected_supplier);
        $scope.po = {
            ...$scope.po,
            suppliername: selected_supplier.glasssuppliername ?? "",
            atten: selected_supplier.suppliercontact ?? "",
            address: selected_supplier.supplieraddress ?? "",
            fax: selected_supplier.supplierfax ?? "",
        }

        console.log($scope.po);
    }
    $scope.suppliers = _emptysuppliers();
    function _emptysuppliers() {

        const _ = {
            isloading: false,
            title: "Add New Supplier",
            btn: "Save",
            mode: "N",
            data: {
                glasssupplierid: "0",
                glasssuppliername: "",
                glasssuppliercountry: "",
                suppliercontact: "",
                supplieraddress: "",
                supplieremail: "",
                supplierphone: "",
                supplierfax: ""
            }
        };

        return _;
    }
    $scope.addnewsupplier = () => {
        $scope.suppliers = _emptysuppliers();
        document.getElementById("dia_suppliers").style.display = 'flex';
    }

    $scope.save_suppliers_submit = async () => {
        if ($scope.suppliers.isloading) {
            console.log("Already Another Process Is Running...");
            return;
        }

        if ($scope.suppliers.mode === "N") {
            await _savesuppliers();
            return;
        }
    }

    function _validate() {

        const glasssuppliername = document.getElementById("glasssuppliername");
        const glasssuppliercountry = document.getElementById("glasssuppliercountry");
        if (glasssuppliername.value.trim() === "") {
            _msg(true, "n", "Enter Supplier Name");
            glasssuppliername.focus();
            return 0;
        }

        if (glasssuppliercountry.value.trim() === "") {
            _msg(true, "n", "Enter Supplier Location");
            glasssuppliercountry.focus();
            return 0;
        }

        const fd = s.FormData();
        fd.append("glasssuppliername", glasssuppliername.value);
        fd.append("glasssuppliercountry", glasssuppliercountry.value);
        fd.append("suppliercontact", $scope.suppliers.data.suppliercontact ?? "-");
        fd.append("supplieraddress", $scope.suppliers.data.supplieraddress ?? "-");
        fd.append("supplieremail", $scope.suppliers.data.supplieremail ?? "-");
        fd.append("supplierphone", $scope.suppliers.data.supplierphone ?? "-");
        fd.append("supplierfax", $scope.suppliers.data.supplierfax ?? "-");
        return fd;

    }

    async function _savesuppliers() {
        const fd = _validate();
        if (fd === 0) {
            return;
        }
        $scope.suppliers = {
            ...$scope.suppliers,
            data: { ...$scope.suppliers.data },
            isloading: true,
        };
        const res = await s.newsupplier(fd);
        if (res?.msg !== 1) {
            _msg(true, "n", res.data);
            $scope.suppliers = {
                ...$scope.suppliers,
                data: { ...$scope.suppliers.data },
                isloading: false,
            };
            $scope.$apply();
            return;
        }
        $scope.suppliers = {
            ...$scope.suppliers,
            data: {
                glasssupplierid: "0",
                glasssuppliername: "",
                glasssuppliercountry: "",
                suppliercontact: "",
                supplieraddress: "",
                supplieremail: "",
                supplierphone: "",
                supplierfax: ""
            },
            isloading: false,
        };
        _msg(true, "t", "Supplier Information Has Saved");
        $scope.supplierlist = res?.data ?? [];
        $scope.$apply();
    }
    ///mateiral

    $scope.materiallist = [];
    Materiallist()
    async function Materiallist() {
        $scope.materiallist = [];
        const fd = po.FormData();
        fd.append("bmproject",sessionStorage.getItem("nafco_project_current_sno"))
        const res = await po.pomaterialtypes(fd);
        if (res?.msg !== 1) {
            alert(res?.data);
            $scope.materiallist = [];
            $scope.$apply();
            return;
        }

        $scope.materiallist = res.data ?? [];
        $scope.$apply();
        return;
    }

    $scope.save_ponew = () => {
        if ($scope.isloading) {
            console.log("Already Process Is Running");
            return;
        }
        const _savepo = {
            po: $scope.po,
            dt: $scope.polist,
            totprice: $scope.itemstotal,
            vatval: $scope.povatval,
            subttoal: $scope.itemssubttotal,
            paymentterms: $scope.paymenttermslist,
            deliveryterms: $scope.deliverytermslist
        };

        console.log(_savepo);


        if ($scope.itemssubttotal === undefined) {
            alert("Fill All data");
            return;
        }
        if ($scope.po === undefined) {
            alert("Enter Purchase order informations");
            return;
        }

        if ($scope.po.porefno === undefined || $scope.po.porefno.trim() === "") {
            alert("Enter Ref No");
            return;
        }

        if ($scope.po.podate === undefined || $scope.po.podate.trim() === "") {
            alert("Enter Po Date");
            return;
        }

        if ($scope.po.posupplier === undefined || $scope.po.posupplier.trim() === "") {
            alert("Enter Supplier");
            return;
        }
        if ($scope.po.pofrm === undefined || $scope.po.pofrm.trim() === "") {
            alert("Enter Form");
            return;
        }
        if ($scope.po.potype === undefined || $scope.po.potype.trim() === "") {
            alert("Select Material Type");
            return;
        }

        if ($scope.po.podescription === undefined || $scope.po.podescription.trim() === "") {
            alert("Enter Subject");
            return;
        }

        if ($scope.povatval === undefined || $scope.povatval.trim() === "") {
            alert("Enter VAT %");
            return;
        }
        if ($scope.paymenttermslist.length === 0) {
            alert("Enter Payment Terms");
            return;
        }
        if ($scope.deliverytermslist.length === 0) {
            alert("Enter Delivery Terms");
            return;
        }
        posave(_savepo);

    }


    function alreset() {
        $scope.po = {
            porefno: "",
            podate: "",
            posupplier: "",
            atten: "",
            address: "",
            fax: "",
            pofrm: "",
            potype: "",
            podescription: "",
        };

        $scope.polist = [];
        //$scope.povatval = 
        $scope.itemtotqty = 0;
        $scope.itemtotwgt = 0;
        $scope.itemtotarea = 0;
        $scope.itemstotal = 0;
        $scope.vatval = 0;
        $scope.itemssubttotal = 0;
        $scope.paymenttermslist = [];
        $scope.deliverytermslist = [];

    }
    $scope.isloading = false;
    async function posave(_savepo) {
        const fd = po.FormData();
        fd.append('ponew', JSON.stringify(_savepo));
        fd.append('ponewproject', sessionStorage.getItem("nafco_project_current_sno"));
        $scope.isloading = true;
        const res = await po.ponewsave(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isloading = false;
            $scope.$apply();
            return;
        }
        alert("PO has Saved");
        printactions(res.data);
        $scope.isloading = false;
        alreset()
        $scope.$apply();
        return;
    }

    async function printactions(id) {
        const fd = po.FormData();
        fd.append('ponewid', id);
        const res = await po.ponewinfo(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }

        localStorage.removeItem("pms_ponew_print");
        localStorage.setItem("pms_ponew_print", JSON.stringify(res.data));
        window.open(`${print_location}fprint/#!/ponew`, "_blank", "height:500px,width:1200px");
        return;
    }



}