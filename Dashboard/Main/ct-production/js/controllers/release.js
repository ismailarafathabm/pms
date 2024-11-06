import cuttinglistservices from "../../../cuttinglist/js/services/index.js";
export default function ctrelease($scope) {
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
    const pms = new cuttinglistservices();    
    $scope.isrptloading = false;
    document.title = "RELESE CUTTING LIST ITEM";
    $scope.clitems = []
    $scope.item = {
        outid: "",
        outno: "",
        outdate: "",
        outqty: "",
        outarea: "",
        outcno: "",
        ct_mono: "",
        ctno: "",
        ct_marking: "",
        ct_description: "",
        mofilename: "",
        ctfilename: "",
        ctfile: "",
        mofile: "",
        ctrequrieqty: "",
        dis_qty : "",
        bal_qty : "",
        
    }
    loaddatas();
    function loaddatas() {
        const _data = localStorage.getItem("clprolist");
        //console.log(_data);
        const data = JSON.parse(_data);
        console.log(data);
        data.map(i => {
            let item = {
                outid: "",
                outno: "",
                outdate: "",
                outqty: "",
                outarea: "",
                outcno: i.ct_id,
                ct_mono: i.ct_mono,
                ctno: i.ctno,
                ct_marking: i.ct_marking,
                ct_description: i.ct_description,
                mofilename: i.mofilename,
                ctfilename: i.ctfilename,
                ctfile: i.ctfile,
                mofile: i.mofile,
                ctrequrieqty: i.ctrequrieqty,
                dis_qty : i.dis_qty,
                bal_qty : i.bal_qty,
                
            }

            $scope.clitems.push(item);
        })
    }

    $scope.removeitem_handler = (index) => {
        const c = confirm("Are You Sure Remove?");
        if (!c) return;
        $scope.clitems.splice(index, 1);
    }

    $scope.update_handler = async () => {
        console.log($scope.clitems);
        if ($scope.isrptloading) return;
        const fd = new FormData(
            document.getElementById("save_deliver")
        );
        
        fd.append("payload", JSON.stringify($scope.clitems));
        fd.append("refno", document.getElementById("outno").value);
        fd.append("outdate", document.getElementById("outdate").value);
        $scope.isrptloading = true;
        const res = await pms.POST('ct-production/release.php',fd);
        if (res.msg !== 1) {
            $scope.isrptloading = false;
            alert(res.data);
            $scope.$apply();
            return;
        }

        alert("data has updated");
        $scope.isrptloading = false;
        $scope.$apply();
        window.location.href = `${print_location}/Dashboard/Main/index.php#!/ctproduction` 
        //redirect to previous page
        return;
    }
}