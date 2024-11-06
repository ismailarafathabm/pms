import POService from './../services/po.js';
export default function pobnew($scope, $http, $compile, $rootScope, $filter) {
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

            } else {
                alert(res.data.data);
            }
        });
    }
    const po = new POService();
    $scope.porefnolist = [];
    getrefnos();
    async function getrefnos() {
        $scope.porefnolist = [];
        const fd = po.FormData();
        fd.append("poproject",sessionStorage.getItem("nafco_project_current_sno"))
        const res = await po.refnos(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.porefnolist = [];
            $scope.$apply();
            return;
        }

        $scope.porefnolist = res.data ?? [];
        $scope.$apply();

    }
    $scope.refok = false;
    $scope.pob = {
        isloading: false,
        mode: "N",
        btn: "Save",
        data: {
            pobno: '',
            pobdate: '',
            pobprefno : '',
            pobporefno : '',
            pobtype : '',
            pobtotbudget: '',
            pobbmprice : '',
            pobprvalue : '',
            pobcvalue : '',
            pobqty : '',
            pobtypet: '',
            supplier: '',
            supplierarray : '',
        }
    }
    $scope.search_refno_submit = async () => {
        $scope.refok = false;
        const porefno = $scope.posrc.data.porefno ?? 0
        const fd = po.FormData();
        fd.append("poproject", sessionStorage.getItem("nafco_project_current_sno"));
        fd.append("porefno", porefno);
        const res = await po.searchpo(fd);
        console.log(res);
        if (res?.msg !== 1) {
            _msg(true, 'n', res.data);
            $scope.refok = false;
            $scope.$apply();
            return;
        }
        let balval = (+res.data.sumofbudget) - ((+res.data.sumofprevious) + (+res.data.povalue));
        $scope.pob = {
            ...$scope.pob,
            isloading: false,
            data: {
                ...$scope.pob.data,
                pobqty : res.data.sumofqty,
                pobdate: res.data.ponewdate_n,
                pobtypet: res.data.ponewtype,
                pobporefno: res.data.ponewrefno,
                pobtotbudget: res.data.projectbudget,
                pobprvalue: res.data.prvtotal,
                pobcvalue: res.data.ponewtotval,
                pobbmprice: res.data.getbalanceofbudget,
                supplier: res.data.glasssuppliername.toUpperCase(),
                supplierarray : res.data.glasssuppliercountry,
            }
        };
        $scope.refok = true;
        console.log($scope.pob);
        $scope.$apply();
    }

    $scope.pob_submit = async () => {
        if($scope.pob.isloading) {
            console.log(res.data);
            return;
        }

        if ($scope.pob.mode === "N") {
            await _save();
            return;
        }

        await _update();
        return;
    }

    async function _save(){
        const fd = po.FormData();
        fd.append("pobdate", $scope.pob.data.pobdate);
        fd.append("pobprefno", $scope.pob.data.pobprefno);
        fd.append("pobporefno", $scope.pob.data.pobporefno);
        fd.append("pobtotbudget",$scope.pob.data.pobtotbudget)
        fd.append("pobtype", $scope.pob.data.pobtype);        
        fd.append("pobbmprice", $scope.pob.data.pobbmprice);
        fd.append("pobprvalue", $scope.pob.data.pobprvalue);
        fd.append("pobcvalue", $scope.pob.data.pobcvalue);        
        fd.append("pobavailablebudget", $scope.pob.data.pobbmprice);
        fd.append("pobqty", $scope.pob.data.pobqty);
        fd.append("poproject", sessionStorage.getItem("nafco_project_current_sno"));

        const res = await po.savepob(fd);

        if (res?.msg !== 1) {
            _msg(true, "n", res.data);            
            return;
        }
        _msg(true, "n", "data has saved");   
        printactions(
            sessionStorage.getItem("nafco_project_current_sno"),
            $scope.pob.data.pobporefno,
            $scope.pob.data.pobprefno
        );
        $scope.pob = {
            isloading: false,
            mode: "N",
            btn: "Save",
            data: {
                pobno: '',
                pobdate: '',
                pobprefno : '',
                pobporefno : '',
                pobtype : '',
                pobtotbudget: '',
                pobbmprice : '',
                pobprvalue : '',
                pobcvalue : '',
                pobqty : '',
                pobtypet: '',
                supplier: '',
                supplierarray: '',                
            },
          
        }

        $scope.refok = false;

        return;
        //location.reload();
        
    }

    async function printactions(p, r, pr) {
        const fd = po.FormData();
        fd.append('pobproject', p)
        fd.append('pobporefno',r)
        fd.append('pobprefno',pr)
        const res = await po.pobprintinfo(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }

        localStorage.removeItem("pms_print_purchaes_pob");
        localStorage.setItem("pms_print_purchaes_pob", JSON.stringify(res.data));
        
        window.open(`${print_location}fprint/#!/pobprint`, "_blank", "height:500px,width:1200px");
    }

    
}