import GlassSupplierServices from './../services/suppliers.js'
import POService from './../services/po.js';
export default function ponew($scope, $http, $compile, $rootScope, $filter) {
    console.log("it is po new")
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

            } else {
                alert(res.data.data);
            }
        });
    }
    const _msg = (d, t, msg = "") => {
        let icon = t === "n" ? "fa fa-exclamation-circle" : "fa fa-info-circle";
        let theme = t === "n" ? "ism-dialog-input-error" : "ism-dialog-input-success";

        $scope.res = {
            display: d,
            theme: theme,
            icon: icon,
            msg: msg
        }
        setTimeout(_msgoff, 5000);
    }
    _msg(false, "n")
    function _msgoff() {
        $scope.res.display = false;
        $scope.$apply();
    }

    $scope.isrptloading = false;
    //suppliers
    const gs = new GlassSupplierServices();
    const po = new POService();
    const dia_suppliers = document.getElementById("dia_suppliers");
    dia_suppliers.style.display = "none";
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
            }
        };

        return _;
    }
    $scope.suppliers = _emptysuppliers();
    $scope.addnewsupplier = () => {
        $scope.suppliers = {};
        $scope.suppliers = _emptysuppliers();
        dia_suppliers.style.display = "flex";
        document.getElementById("glasssuppliername").focus();
    }

    
    $scope.save_suppliers_submit = async () => {
        if ($scope.suppliers.isloading) {
            console.log("Already Another Process Is Running...");
            return;
        }

        if ($scope.suppliers.mode === "N") {
            await _savesuppliers();
        } else {
            await _updatesupplier();
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

        const fd = gs.FormData();
        fd.append("glasssuppliername", glasssuppliername.value);
        fd.append("glasssuppliercountry", glasssuppliercountry.value);
        return fd;

    }

    $scope.supplierlist = [];

    loadAllSuppliers();
    async function loadAllSuppliers() {
        const res = await gs.getAllGlassSuppliers();
        console.log(res);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }

        $scope.supplierlist = res.data ?? [];
        $scope.$apply();
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
        const res = await gs.newsupplier(fd);
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
            },
            isloading: false,
        };
        $scope.supplierlist = res.data;
        _msg(true, "t", "Supplier Information Has Saved");        
        $scope.$apply();
    }
    //suppliers
    //materials
    $scope.materiallist = [];
    getmateriallist();
    async function getmateriallist() {
        $scope.materiallist = [];
        const res = await po.materialtype();
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        $scope.materiallist = res.data ?? [];
        $scope.$apply();
    }

    $scope.po = {
        isloading: false,
        btn: "Save",
        mode: "N",
        data: {
            poid : '0',
            podate: _gettoday(),
            porefno: '',
            itemtype: '',
            posupplier: '',
            posupplieraddress: '',
            poattenby: '',
            podescription: '',
            poqty: '',
            povalue : '',
            pounitprice : '',
            ponotes : '',
            popaymentterms: '',
            podeliveryterms: '',
            poproject: sessionStorage.getItem('nafco_project_current_sno'),
            poarea: '',
            poweight : ''
            
            
        }
    }

    let supplireinfo = {};
    $scope.getsupplierinfo = () => {
        supplireinfo = {};
        let val = $scope.search.posupplier;
        supplireinfo = $scope.supplierlist.find(x => x.glasssupplierid === val); 
        console.log(supplireinfo);

        $scope.po = {
            ...$scope.po,
            data: {
                ...$scope.po.data,
                posupplier: supplireinfo.glasssuppliername,
                posupplieraddress: supplireinfo.glasssuppliercountry,
            }
        };
    }

    $scope.posave_submit = async () => {
        if ($scope.po.isloading) {
            console.log("Already Process is Running..");
            return;
        }
        if ($scope.po.mode === "N") {
            await _save();
            return;
        }

    }


    async function _save() {
        const fd = po.FormData();
        fd.append('podate', $scope.po.data.podate);
        fd.append('porefno', $scope.po.data.porefno);
        fd.append('itemtype', $scope.po.data.itemtype);
        fd.append('posupplier', $scope.po.data.posupplier);
        fd.append('posupplieraddress', $scope.po.data.posupplieraddress);
        fd.append('poattenby', $scope.po.data.poattenby);
        fd.append('podescription', $scope.po.data.podescription);
        fd.append('poqty', $scope.po.data.poqty);
        fd.append('povalue', $scope.po.data.povalue);
        fd.append('pounitprice', $scope.po.data.pounitprice);
        fd.append('ponotes', $scope.po.data.ponotes);
        fd.append('popaymentterms', $scope.po.data.popaymentterms);
        fd.append('podeliveryterms', $scope.po.data.podeliveryterms);
        fd.append('poproject', $scope.po.data.poproject);
        fd.append('poarea', $scope.po.data.poarea);
        fd.append('poweight',$scope.po.data.poweight)

        $scope.po = {
            ...$scope.po,
            data: {
                ...$scope.po.data
            },
            isloading: true,
        };
        const res = await po.savepo(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            _msg(true, "n", res.data);
            $scope.po = {
                ...$scope.po,
                data: {
                    ...$scope.po.data
                },
                isloading: false,
            };
            $scope.$apply();
            return;
        }

        $scope.po = {
            ...$scope.po,
            data: {
                ...$scope.po.data
            },
            isloading: false,
        };
        _msg(true, "t", "Data Has Saved");
        $scope.$apply();
        printfunction($scope.po.data);
        $scope.po = {
            isloading: false,
            btn: "Save",
            mode: "N",
            data: {
                poid : '0',
                podate: _gettoday(),
                porefno: '',
                itemtype: '',
                posupplier: '',
                posupplieraddress: '',
                poattenby: '',
                podescription: '',
                poqty: '',
                povalue : '',
                pounitprice : '',
                ponotes : '',
                popaymentterms: '',
                podeliveryterms: '',
                poproject: sessionStorage.getItem('nafco_project_current_sno'),
                poarea: '',
                poweight : '',
                
                
            }
        }
        //alert("Saved");        
        return;
    }

    function printfunction(data){
        localStorage.removeItem("pms_print_purchaes_po");
        localStorage.setItem("pms_print_purchaes_po", JSON.stringify(data));
        window.open(`${print_location}fprint/#!/poprint`, "_blank", "height:500px,width:1200px");
    }

    async function _update() {
        
    }

    $scope.calc = () => {
        let poarea = document.getElementById('poarea');
        let pounitprice = document.getElementById("pounitprice");
        let x = poarea.value.trim() === "" ? 0 : poarea.value.trim();
        let y = pounitprice.value.trim() === "" ? 0 : pounitprice.value.trim();
        let z = (+x) * (+y);
        $scope.po = {
            ...$scope.po,
            data: {
                ...$scope.po.data,
                povalue: Math.round(z)
            }
        }

    }

   
}

