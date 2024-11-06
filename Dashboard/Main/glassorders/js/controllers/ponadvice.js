import POService from './../services/po.js';
export default function ponadvice($scope, $http, $compile, $rootScope, $filter) {
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


    const po = new POService();
    console.log("?????????");
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
    $scope.refok = false;
    $scope.isloading = false;
    $scope.porefnolist = [];
    getrefnos();
    $scope.srcrefno = "";
    async function getrefnos() {
        if ($scope.isloading) {
            return;
        }
        $scope.isloading = true;
        $scope.porefnolist = [];
        const fd = po.FormData();
        fd.append("poproject",sessionStorage.getItem("nafco_project_current_sno"))
        const res = await po.refnos(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.porefnolist = [];
            $scope.isloading = false;
            $scope.$apply();
            return;
        }
        $scope.isloading = false;
        $scope.porefnolist = res.data ?? [];
        $scope.$apply();
    }


    $scope.loadponewinfo = () => {
        const refno = $scope.srcrefno ?? '';
        if (refno.trim() === "") {
            alert("Enter PO Referance Number");
            return;
        }
        _getinfo(refno);
        return;
    }

    $scope.isloading = false;
    async function _getinfo(refno) {
        if ($scope.isloading) {
            console.log("Already Process Is Running");
            return;
        }
        const fd = po.FormData();
        fd.append("poproject", sessionStorage.getItem("nafco_project_current_sno"));
        fd.append("porefno", refno);
        $scope.isloading = true;
        const res = await po.searchpo(fd);
        if (res?.msg !== 1) {
            $scope.isloading = false;
            $scope.$apply();
            return;
        }
        $scope.isloading = false;
        $scope.po = res.data;
        $scope.refok = true;
        console.log(res.data);
        $scope.$apply();
        return;
    }

    
    $scope.save_ponew = () => {
        if ($scope.isloading) {
            console.log("Already Another Process Is Running");
            return;
        }

        SaveAdvice();
        
    }

    async function SaveAdvice() {
        const padvancedate = document.getElementById('padvancedate');
        const padviceto = document.getElementById('padviceto');
        const paymenttype = document.getElementById('paymenttype');
        const paymentamount = document.getElementById('paymentamount');
        const padvicetypedescription = document.getElementById('padvicetypedescription');
        const paymentcountry = document.getElementById('paymentcountry');
        const paymentpersent = document.getElementById('paymentpersent');
        const paydescriptions = document.getElementById('paydescriptions');

        if (padvancedate.value.trim() === "") {
            alert("Enter Date");
            padvancedate.focus();            
            return;
        }

        if (padviceto.value.trim() === "") {
            alert("Enter To Who?");
            padviceto.focus();            
            return;
        }

        if (paymenttype.value.trim() === "") {
            alert("Enter Payment Type");
            paymenttype.focus();            
            return;
        }

        if (paymentamount.value.trim() === "") {
            alert("Enter Payment Amount");
            paymentamount.focus();            
            return;
        }
      
        if (paymenttype.value === 'Others') {
            console.log(paymenttype.value);
            console.log(padvicetypedescription.value);
            if (padvicetypedescription.value.trim() === "") {
                alert("Enter Payment Descriptions");
                paymentamount.focus();               
                return;
            }
        }

        if (paymentcountry.value.trim() === "") {
            alert("Enter Currency Type");
            paymentcountry.focus();            
            return;
        }

        if (paymentpersent.value.trim() === "") {
            alert("Enter Payment %");
            paymentpersent.focus();            
            return;
        }

        if (paydescriptions.value.trim() === "") {
            alert("Enter Payment Advice Notes");
            paydescriptions.focus();            
            return;
        }

        const ponewid = $scope.po?.ponewid ?? "0";
        const fd = po.FormData();
        fd.append('ponewid', ponewid);
        fd.append('padviceproject', sessionStorage.getItem('nafco_project_current_sno'));
        fd.append('advice', JSON.stringify($scope.padvice));
        const res = await po.newadvice(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;   
        }
        alert("Data has Saved");
        localStorage.removeItem('pms_print_paymentadvice');
        localStorage.removeItem('pms_print_po_info');
        localStorage.setItem("pms_print_paymentadvice", JSON.stringify(res.data));
        localStorage.setItem("pms_print_po_info", JSON.stringify($scope.po));
        window.open(`${print_location}fprint/#!/poadvice`, "_blank", "height:500px,width:1200px");
        return;
    }
    
}