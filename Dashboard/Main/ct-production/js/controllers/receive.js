import cuttinglistservices from "../../../cuttinglist/js/services/index.js";
export default function ctproductionentrynew($scope) {
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
    $scope.autoitems = [];
     
    async function autoc() {
        $scope.autoitems = [];
        $scope.isrptloading = true;
        const res = await pms.GET('ct-production/autocm.php');
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isrptloading = false;
            $scope.$apply();
            return;
        }
        $scope.autoitems = res.data;
        $scope.isrptloading = false;
        $scope.$apply();
        return;
    }
    $scope.clitems = [];
    $scope.item = {
        ctprid : '0',
        ctid: "",
        mofile: "",
        mofilename: "",
        ctfile: "",
        ctfilename: "",
        ctrdate: "",
        ctno: "",
        ct_mono: "",
        ct_marking: "",
        ct_description : "",
        ctmaterialstatus: "",
        cttrade: "",
        ctrequrieqty: "",
        ctreqarea: "",
        ctremarks: "",
        deliverysh: "",
        currentsection : '',
    }
    _loaddatas();
    function _loaddatas() {
        $scope.clitems = [];
        const _datas = localStorage.getItem("clprolist");
       // console.log(_datas);
        const data = JSON.parse(_datas);
        data.map(i => {
            let item = {
                ctprid: i.ctprid,
                ctid: i.ct_id,
                mofile: i.mofile,
                mofilename: i.mofilename,
                ctfile: i.ctfile,
                ctfilename: i.ctfilename,
                ctrdate: i.ctrdate_d.normal,
                ctno: i.ctno,
                ct_mono: i.ct_mono,
                ct_marking: i.ct_marking,
                ct_description: i.ct_description,
                ctmaterialstatus: i.ctmaterialstatus,
                cttrade: i.cttrade,
                ctrequrieqty: i.ct_qty,
                ctreqarea: i.ct_area,
                ctremarks: i.ctremarks,
                deliverysh: "",
                currentsection : i.currentsection,
            }
            if ((+i.ctprid) !== 0) {
                item = {
                    ...item,
                    deliverysh: i.deliverysh_d.normal,
                }
            }
            $scope.clitems.push(item);
        })
        console.log($scope.clitems)
        autoc();
        //$scope.$apply();
    }
    $scope.select_item_handler = (x) => {
        console.log(x);
        $scope.item = x;       
    }
    $scope.form_cancel_handler = () => {
        $scope.item = {
            ctprid : 0,
            ctid: "",
            mofile: "",
            mofilename: "",
            ctfile: "",
            ctfilename: "",
            ctrdate: "",
            ctno: "",
            ct_mono: "",
            ct_marking: "",
            ct_description : "",
            ctmaterialstatus: "",
            cttrade: "",
            ctrequrieqty: "",
            ctreqarea: "",
            ctremarks: "",
            deliverysh : "",
            currentsection : '',
        }
    }

    $scope.form_save_handler = async () => {        
        await save_data($scope.item);
    }
    $scope.update_handler = async (x) => await save_data(x);
    async function save_data(x) {
        if ($scope.isrptloading) return;
        const id = x.ctid ?? "0"
        if (!id || id.toString().trim() === "" || id === "0") {
            alert("You do not have Selected any Data");
            return;
        }
        const fd = new FormData();
        fd.append("paload", JSON.stringify(x));
        $scope.isrptloading = true;
        const res = await pms.POST('ct-production/ct-update.php', fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isrptloading = false;           
            $scope.$apply();
            return;
        }

        $scope.isrptloading = false;
        $scope.$apply();
        return;
    }

    $scope.gonext = ($event,index,current,left,righte) => {
        //console.log($event.which);
        let code = $event.which;
        // console.log("current",current);
        // console.log("left",left);
        // console.log("right", righte);
        // console.log("index", index);

        if (code === 39 || code === 13) {
            if (left === null) return
                let nxt = index + "_" + left;
                document.getElementById(nxt).focus();                            
        } else if (code === 37) {
            if (righte === null) return;
            let right = index + "_" + righte;
            document.getElementById(right).focus();   
        } else if (code === 40) {
            let nxtindex = index + 1;
            let eleid = nxtindex + "_" + current;
            let ele = document.getElementById(eleid);
            if (!ele || ele === null || ele === undefined) return;
            ele.focus();
        } else if (code === 38) {
            let nxtindex = index - 1;
            let eleid = nxtindex + "_" + current;
            let ele = document.getElementById(eleid);
            if (!ele || ele === null || ele === undefined) return;
            ele.focus();
        } else {
            return;
        }
        
    }

    $scope.update_handler = async () => {
        if ($scope.isrptloading) return;
        const fd = new FormData();
        console.log($scope.clitems);
        fd.append("payload", JSON.stringify($scope.clitems));
        $scope.isrptloading = true;
        const res = await pms.POST('ct-production/ct-update.php', fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isrptloading = false;           
            $scope.$apply();
            return;
        }
        alert("datas has updated");
        $scope.isrptloading = false;
        window.location.href = `${print_location}/Dashboard/Main/index.php#!/ctproduction` 
        $scope.$apply();
        return;
    }
    $scope.removeitem_handler = (index) => {
        $scope.clitems.splice(index, 1);
    }
}