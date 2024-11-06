import cuttinglistservices from "../../../cuttinglist/js/services/index.js";
import * as models from './models.js';
export default function nbomnew($scope, $http) {
    $scope.currentuser = userinfo.user_name;
    const bom = new cuttinglistservices();
    $scope.mode = "1";
    $scope.itemmdoe = "1";
    $scope.issubmitted = false;
    $scope.ispageloading = false;
    $scope.alsowithlenght = true;
    //date time picker code
    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: "DD-MM-YYYY",
        defaultDisplay: "gregorian",
    };

    moment.locale("en");
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    moment.locale("en");
    //moment.locale('ar-sa');

    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    //date time picker code
    
    //get current date
   
    //get project Informations
    $scope.viewproject = {};
    $scope.newproject = {}
    $scope.getOldInfo = ($event) => {
        if ($event.which === 13) {
            _checkbomnumberinfo()
        }
    };
    $scope.searchBomInfo = () => {
        _checkbomnumberinfo();
    }

    function _checkbomnumberinfo() {
        const bom_no = document.getElementById("bom_no");
        if (bom_no.value === "") {
            alert("Enter BOM Number");
            bom_no.focus();
            return;
        }
        getSavedInfo(bom_no.value);
        return;
    }
    $scope.currentbom = {};
    $scope.postflag = "0";
    $scope.newbomcurrentuser = $scope.currentuser;
    async function getSavedInfo(bomno) {
        $scope.postflag = "0";
        $scope.newbomcurrentuser = $scope.currentuser;
        $scope.currentbom = {};
        $scope.bomlist = [];
        sumofrow();
        $scope.mode = "1";
        if ($scope.ispageloading) return;
        $scope.ispageloading = true;
        const res = await bom.GET(`bomn/get.php?bomno=${bomno}&project=${$scope.viewproject.project_no}`);
        if (res?.msg !== 1) {
            $scope.mode = "1";
            $scope.ispageloading = false;
            $scope.issubmitted = true;
            $scope.$apply();
            return;
        }
        if (res.data.length > 0) {
            $scope.mode = "2";           
            $scope.ispageloading = false;
            $scope.issubmitted = true;
            $scope.bomlist = res.data;
            let xd = res.data.length === 0 ? {} : res.data[0];
            $scope.currentbom = xd;
            console.log(xd);
            $scope.newbom = {
                ...$scope.newbom,
                bom_registerno: xd.bom_registerno,
                bom_makeby: xd.bom_makeby,
                bom_checkedby: xd.bom_checkedby,
                bom_date: xd.bom_date_s.normal,
                bom_postflag: xd.bom_postflag,
                bom_cby: xd.bom_cby,
            }
            $scope.newbomcurrentuser = xd.bom_cby;
            $scope.postflag = xd.bom_postflag;
            $scope.canedit_dtinfo = true;
            sumofrow();
            $scope.$apply();
            return;
          
        } 
        $scope.ispageloading = false;
        $scope.issubmitted = true;
        $scope.canedit_dtinfo = true;
       
        $scope.$apply();
        return;
    }
    //Form model
    $scope.newbom = models.newbom;
    get_projectinfo();
    function get_projectinfo() {
        let project_id = sessionStorage.getItem("nafco_project_current");
        let post_data = {
            naf_user: userinfo,
            project_no: project_id,
        };
        var req = $http.post(api_url + "Project/view.php", post_data);
        req.then((res) => {
            if (res.data.msg === "1") {
                $scope.viewproject = res.data.data;
                //console.log($scope.viewproject);
                localStorage.removeItem("currentproject");
                localStorage.setItem(
                  "pms_currentproject",
                  JSON.stringify($scope.viewproject)
                );
                $scope.newbom = {
                    ...$scope.newbom,
                    bom_projectid: res.data.data.project_id,
                    bom_projectno: res.data.data.project_no,
                    bom_projectname: res.data.data.project_name,
                    bom_projectencno: res.data.data.project_no_enc,
                    bom_prefixno: `BOM/${res.data.data.project_no}`,
                    clientname : res.data.data.project_cname 
                }
                GetBoqs();
                GetWhItems();
            } else {
                alert(res.data.data);
                window.location.href = `${print_location}/Dashboard/Main/index.php`;
            }
        });
    }
    $scope.boqitems = [];
    async function GetBoqs() {
        const _pjno = sessionStorage.getItem("nafco_project_current");
        const res = await bom.GET('bomn/boqs.php?projectno=' + _pjno);
        if (res?.msg !== 1) {
            alert("Error on Getting BOQ Items.");
            return;
        }
        $scope.boqitems = res.data;
        $scope.$apply();
        return;
    }

    $scope.whitems = [];
    $scope.whselectedprofiles = [];
    $scope.whitems_partno = [];
    $scope.whselected_descriptions = [];
    $scope.whselected_dieweights = []
    $scope.whseelcted_lengths = [];
    $scope.selected_colors = [];
    async function GetWhItems() {
        const res = await bom.GET('bomn/items.php');
        if (res?.msg !== 1) {
            alert("Error on Getting Profiles");
            console.log(res.data);
            return;
        }
        $scope.whitems = res.data;
        $scope.whitems.map(i => {
            let ii = i['partno'].trim();
            if (!$scope.whitems_partno.includes(ii)) {
                $scope.whitems_partno.push(ii);
            }
        })
        //$scope.whitems_partno = _gg('partno');
        console.log($scope.whitems_partno);
        $scope.$apply();
    }

    $scope.selectwhitems = () => {
        loadwhgrouping()
    }

    $scope.selectwhitems = () => {
        loadwhgrouping()
    }
    function _gg(filed) {
        let xlist = [];
        $scope.whselectedprofiles.map(i => {
            let ii = i[filed].trim();
            if (!xlist.includes(ii)) {
                xlist.push(ii);
            }
        })
        return xlist;
    }
    function loadwhgrouping() {
        const partno = document.getElementById("bom_profileno").value;
        if (partno === '') {         
            return;  
        }
        $scope.whselectedprofiles = $scope.whitems.filter(x => x.partno === partno);
        $scope.whselected_dieweights = _gg('dieweight');
        $scope.whseelcted_lengths = _gg('partlength');
        $scope.selected_colors = _gg('partcolor');
        $scope.whselected_descriptions = _gg('description');
        return;
    
    }


    //calculation function for weight and need to order.
    function calfunction(){
        let itemdieweight = document.getElementById("bom_dieweight").value;
        let itemlenght = document.getElementById("bom_qrlenght").value;
        let itemnobar = document.getElementById("bom_qrbar").value;
        let itemtotweight = document.getElementById("bom_qrtotweight").value;
        let iteminstocklength = document.getElementById("bom_avilength").value;
        let iteminstocknobars = document.getElementById("bom_avaibar").value;
        let itemorderlenght = document.getElementById("bom_orderlength").value;
        let itemorderbar = document.getElementById("bom_orderbar").value;
        let itemorderweight = document.getElementById("bom_orderweight").value;
        
        console.log(itemtotweight);
        let itemaviweight = 0;
        if ($scope.newbom.alsowithlenght) {
            itemtotweight = (+itemdieweight) * (+itemlenght) * (+itemnobar);
            itemaviweight = (+itemdieweight) * (+iteminstocklength) * (+iteminstocknobars);
        } else {
            itemtotweight = (+itemdieweight) * (+itemnobar);
            itemaviweight = (+itemdieweight) *  (+iteminstocknobars);
        }        
        itemorderlenght = iteminstocklength;
        itemorderbar = (+itemnobar) - (+iteminstocknobars)
        itemorderweight = (+itemtotweight) - (+itemaviweight);
        $scope.newbom = {
            ...$scope.newbom,
            bom_qrtotweight: Math.round(itemtotweight).toFixed(3),
            bom_orderlength: Math.round(itemorderlenght).toFixed(3),
            bom_orderbar: Math.round(itemorderbar).toFixed(3),
            bom_orderweight: Math.round(itemorderweight).toFixed(3),
        }
    }
    $scope.calc = () => {
        calfunction()
      //  console.log($scope.newbom)
    }

    //Input Navication with arrow and enter keys
    $scope.inputnavigator = ($event, next, prev) => {
        console.log($event.target.id)
        if ($event.which === 39 || $event.which === 13) {
            if (next !== '') {
                document.getElementById(next).focus();
            }
        }
        if ($event.which === 37) {
            if (prev !== '') {
                document.getElementById(prev).focus();
            }
        }
        if ($event.target.id === 'itemnotes') {
            //add to list
            if ($event.which === 13) {
                AddTOBomList();
            }
        }
    }

    //Save to Database 
    $scope.addtolist = () => AddTOBomList()

    $scope.bomlist = [];
    $scope.canedit_dtinfo = true;
    function _validate(ctrl) {
        const _ctrl = document.getElementById(ctrl);
        if (_ctrl.value.trim() === '') {            
            _ctrl.focus();
            return 0;
        }
        return 1;
    }
    function AddTOBomList() {
        if ($scope.ispageloading) return;
        if (_validate("bom_no") === 0) {
            alert("Enter BOM Number")
            return;
        }
        if (_validate("bom_date") === 0) {
            alert("Enter Bom date")
            return;
        }
        if (_validate("bom_description") === 0) {
            alert("Enter Description")
            return;
        }
        if (_validate("bom_dieweight") === 0) {
            alert("Enter Die Weight")
            return;
        }
        if (_validate("bom_qrlenght") === 0) {
            alert("Enter Length")
            return;
        }
        if (_validate("bom_qrbar") === 0) {
            alert("Enter No Of bars")
            return;
        }
        if (_validate("bom_avaibar") === 0) {
            alert("Enter No Available Bar")
            return;
        }
        if (_validate("bom_orderbar") === 0) {
            alert("Enter No Need to order Bars")
            return;
        }
        if ($scope.itemmdoe === '1') {
            _saveAction();            
        } else {
            _updateAction();
        }
    }

    async function _saveAction() {
        $scope.ispageloading = true;
        const fd = new FormData();
        fd.append('payload', JSON.stringify($scope.newbom));
        const res = await bom.POST('bomn/new.php',fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.ispageloading = false;
            $scope.$apply();
            return;
        }
        _clearText();
        $scope.bomlist = res.data;
        $scope.ispageloading = false;
        sumofrow();
        $scope.$apply();
        return;
    }

    async function _updateAction() {
        $scope.ispageloading = true;
        const fd = new FormData();
        fd.append('payload', JSON.stringify($scope.newbom));
        const res = await bom.POST('bomn/update.php?bom_id=' + $scope.newbom.bom_id, fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.ispageloading = false;
            $scope.$apply();
            return;
        }
        _clearText();
        $scope.bomlist = res.data;
        $scope.ispageloading = false;
        $scope.itemmdoe = "1";
        sumofrow();
        $scope.$apply();
        return;
    }
    $scope.cancelEdit = () => {
        _clearText();        
        $scope.itemmdoe = "1";
    }
    function _clearText() {
        $scope.newbom = {
            ...$scope.newbom,
            bom_profileno: '',
            bom_boqid : '',
            bom_description : '',
            bom_dieweight : '',
            bom_qrlenght : '',
            bom_qrbar : '',
            bom_qrtotweight : '',
            bom_avilength : '',
            bom_avaibar : '',
            bom_orderlength : '',
            bom_orderbar : '',
            bom_orderweight : '',
            bom_itemfinish : '',
            bom_remarks : '',           
        }
    }
    $scope.getOldDatas = () => {
        const bom_no = document.getElementById("bom_no").value;
        console.log(bom_no);
    }
    $scope.handlerchange_checkboxlenght = ($event) => {
        calfunction();
    }
    //remove item

    $scope.removeBomitem = async (x) => {
        if ($scope.ispageloading) return;
        const cf = confirm('Are You Sure Remove This Data');
        if (!cf) return;
        $scope.ispageloading = true;
        const fd = new FormData();
        fd.append('bom_no', $scope.currentbom.bom_no);
        fd.append('bom_projectno',$scope.currentbom.bom_projectno);
        const res = await bom.POST('bomn/remove.php?bom_id=' + x.bom_id,fd);
        if (res?.msg !== 1) {
            $scope.ispageloading = false;
            alert(res.data);
            $scope.$apply();
            return;
        }
        $scope.ispageloading = false;
        $scope.bomlist = res.data;
        sumofrow();
        $scope.$apply();
        return;
    }

    $scope.editBomItem = (x) => {
        $scope.itemmdoe = "2";
        $scope.newbom = {
            ...$scope.newbom,
            bom_profileno: x.bom_profileno,
            bom_boqid : x.bom_boqid,
            bom_description : x.bom_description,
            bom_dieweight : x.bom_dieweight,
            bom_qrlenght : x.bom_qrlenght,
            bom_qrbar : x.bom_qrbar,
            bom_qrtotweight : x.bom_qrtotweight,
            bom_avilength : x.bom_avilength,
            bom_avaibar : x.bom_avaibar,
            bom_orderlength : x.bom_orderlength,
            bom_orderbar : x.bom_orderbar,
            bom_orderweight : x.bom_orderweight,
            bom_itemfinish : x.bom_itemfinish,
            bom_remarks : x.bom_remarks,
            bom_projectno : x.bom_projectno,
            bom_no : x.bom_no,
            bom_id : x.bom_id,
        }
    }

    function _arraycal(filed) {
        const _tot = $scope.bomlist.reduce((p, i) => p += (+i[filed]), 0);
        return _tot;
    }
    $scope.sumofrowx= {
        _req_bar: 0,
        _req_wt : 0,
        _avi_bar : 0,
        _ord_bar : 0,
        _ord_wt : 0,
    }
    function sumofrow() {
        console.log("called");
        let _req_bar = _arraycal('bom_qrbar');
        let _req_wt = _arraycal('bom_qrtotweight');
        let _avi_bar = _arraycal('bom_avaibar');
        let _ord_bar = _arraycal('bom_orderbar');
        let _ord_wt = _arraycal('bom_orderweight');
        $scope.sumofrowx = {
            _req_bar,
            _req_wt,
            _avi_bar,
            _ord_bar,
            _ord_wt,
        };
        console.log("sumofo",$scope.sumofrowx)

    }

    $scope.print_bom = () => {
        ///localStorage.setItem('bominfo', JSON.stringify($scope.newbom));
        //localStorage.setItem('bomlist', JSON.stringify($scope.bomlist));
        let nw = window.open(`${print_location}/sprint/bom.html`, '_blank', "width:1300px;height:700px")
        nw.bominfo = JSON.stringify($scope.newbom);
        nw.bomlist = JSON.stringify($scope.bomlist);
    }
}