app.controller('bom_controller', bom_controller);

function bom_controller($scope, $http) {
    document.title = "BOM - PMS"

    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian'
    };

    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    document.getElementById("newbom").classList.add('menuactive');

    maxbodyheight();
    window.addEventListener('resize', () => {
        maxbodyheight()
    })

    function maxbodyheight() {
        var menuh = document.querySelector(".topprojectinfos").offsetHeight;
        //console.log(menuh);
        var mbody = document.querySelector(".ism-bodys");
        var wsize = window.innerHeight;
        //console.log(wsize);
        var head_size = document.querySelector(".ism-headers").offsetHeight;
        //console.log(head_size);        
        var nav_size = document.querySelector(".ism-navi-itmes");
        nav_size.marginTop = head_size + "px"
        var foot_size = document.querySelector(".ism-footers").offsetHeight;
        var rmh = 120;
        var bh = wsize - foot_size - menuh - 90;
        var bhbh = bh - 35 - 10 - 15;
        var bhbhbh = bh - 35 - 30;
        // var bhbhbh = bh - 45;
        var mrtop = menuh + 80;
        document.querySelector(".sub-body-container").style.height = bh + "px";
        document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container").style.maiHeight = bh + "px";

        document.querySelector(".sub-body-container").style.marginTop = mrtop + "px";


        // document.querySelector(".loadingdiv").style.height = bhbh + "px";
        // document.querySelector(".loadingdiv").style.maxHeight = bhbh + "px";
        // document.querySelector(".loadingdiv").style.maiHeight = bhbh + "px";

        document.querySelector(".naf-tables").style.height = bhbhbh + "px";
        document.querySelector(".naf-tables").style.maxHeight = bhbhbh + "px";
        document.querySelector(".naf-tables").style.maiHeight = bhbhbh + "px";


        //set size main container

        var docwith = window.innerWidth;
        var mbodyw = document.querySelector(".ism-bodys").offsetWidth;

    }


    let xprojectno = "";
    function get_projectinfo() {
        let post_data = {
            naf_user: userinfo,
            project_no: project_id
        }
        var req = $http.post(api_url + "Project/view.php", post_data);
        req.then(res => {
            //console.log(res.data);
            if (res.data.msg === "1") {
                $scope.viewproject = res.data.data;
                $scope.newproject = res.data.data;
                xprojectno = angular.lowercase(res.data.data.project_no);
                console.log(xprojectno);
                document.title = `BOM [${angular.uppercase(xprojectno)}] - PMS`;
                getAll()
                _xproject = angular.lowercase(res.data.data.project_no);
                project_id = angular.lowercase(res.data.data.project_no);
                // get_all_approvals();
            } else {
                alert(res.data.data);
            }
        });
    }

    if (!sessionStorage.getItem('nafco_project_current') || sessionStorage.getItem('nafco_project_current') === '') {
        projectlist();
    } else {
        project_id = sessionStorage.getItem('nafco_project_current');
        get_projectinfo();
        //get_approvalsTypes();
    }

    $scope.bomitems = [];
    function getAll() {
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('projectno', xprojectno);
        const post_data = {
            url: api_url + "bom/index.php",
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        }

        const req = $http(post_data);
        req.then(res => {
            if (res?.data?.msg === '1') {
                displayopton(res.data.data);
            } else if (res?.data.msg === "0") {
                alert(res.data.data);
            } else {
                _apiErrorMsg(res.data);
            }
        })
    }

    function displayopton(apidata) {
        let _data = [];
        let _system = [];
        $scope.bomitems = [];
        apidata.map((i) => {
            if (!_system.includes(i.bomsystem)) {
                _system.push(i.bomsystem);
            }
            _data.push(i);
        });
        let dispdata = [];
        _system.map((i) => {
            let _i = i;
            let ar = [];
            _data.map((j) => {
                if (i === j.bomsystem) {
                    ar.push(j);
                }
            })
            dispdata.push({ s: _i, a: ar });
        })
        $scope.bomitems = dispdata;
        // $scope.$apply();
        console.log(dispdata);
    }

    let addtion_projectno = document.getElementsByName("addtion_projectno")[0];
    let addtion_bomsno = document.getElementsByName("addtion_bomsno")[0];
    let addtion_bomid = document.getElementsByName("addtion_bomid")[0];
    let addtion_bomdate = document.getElementsByName("addtion_bomdate")[0];
    let addtion_addqty = document.getElementsByName("addtion_addqty")[0];
    let addtion_remark = document.getElementsByName("addtion_remark")[0];

    $scope.addtiondialog = (x) => {
        console.log(x);
        let ix = new Date();
        let d = ix.getDate();
        let m = ix.getMonth() + 1;
        let y = ix.getFullYear();

        let dia_bomaddtionals = document.getElementById("dia_bomaddtionals");
        dia_bomaddtionals.style.display = "flex";
        addtion_projectno.value = x.bomproject;
        addtion_bomsno.value = x.bomno;
        addtion_bomid.value = x.bomid;
        addtion_bomdate.value = `${d}-${m}-${y}`;
        addtion_addqty.value = "";
        addtion_remark.value = "";

        addtion_bomdate.focus();
    }

    addtion_bomdate.addEventListener("keyup", (e) => {
        if (e.keyCode === 13) {
            addtion_addqty.focus();
        }
    })

    addtion_addqty.addEventListener("keyup", e => {
        console.log(e.target.value);
        if (e.keyCode === 13) {
            addtion_remark.focus();
        }
    })

    addtion_remark.addEventListener("keyup", e => {

        if (e.keyCode === 13) {
            _updateBomQty();
        }
    })

    $scope.addtionupdate_submit = () => {
        _updateBomQty();
    }
    function _updateBomQty() {
        if (addtion_projectno.value === "") {
            alert("Enter Project Number");
            return;
        }
        if (addtion_bomsno.value === "") {
            alert("BOM S.No Missing");
            return;
        }

        if (addtion_bomid.value === "") {
            alert("BOM ID MISSING");
            return
        }

        if (addtion_bomdate.value === "") {
            alert("Enter Date")
            return
        }

        if (addtion_addqty.value === "") {
            alert("Enter Addtional Qty");
            return;
        }

        if (isNaN(addtion_addqty.value)) {
            alert("QTY Value Should be a number value");
            return
        }

        let rmark = addtion_remark.value === '' ? '-' : addtion_remark.value;

        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('bomid', addtion_bomid.value);
        fd.append('nqty', addtion_addqty.value);
        fd.append('sdate', addtion_bomdate.value);
        fd.append('projectno', addtion_projectno.value);
        fd.append('remark', rmark);

        const post_data = {
            url: `${api_url}bom/addtionals.php`,
            data: fd,
            method: "POST",
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(res => {
            if (res?.data?.msg === "1") {
                alert("Updated");
                getAll();
                addtion_addqty.value = "";
                addtion_remark.value = "";
                addtion_bomdate.focus();
            } else if (res?.data?.msg === "0") {
                alert(res.data.data);
            } else {
                _apiErrorMsg(res.data);
            }
        })
    }


    $scope.getAddtioninfos = (items) => {
        console.log(items);
        $scope._bomno = items.bomno;
        getAddtionInformations(items.rwid);
    }
    $scope.addtionlist = [];
    function getAddtionInformations(id) {
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('rid', id);
        const post_data = {
            url: `${api_url}bom/getaddtion.php`,
            method: "POST",
            data: fd,
            headers: {
                'content-type': undefined
            }
        }
        const req = $http(post_data);
        $scope.addtionlist = [];
        req.then(
            (res) => {
                if (res?.data?.msg === "1") {
                    let dia_addtionlist = document.getElementById("dia_addtionlist");
                    dia_addtionlist.style.display = "flex";
                    console.log(res.data.data);
                    $scope.addtionlist = res.data.data;
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        )
    }


    $scope.bomitemslist = [];
    AllBoqItems();
    function AllBoqItems() {
        console.log("function called");
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        const post_data = {
            url: `${api_url}bomitem/index.php`,
            data: fd,
            method: "POST",
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);
        $scope.bomitemslist = [];
        req.then(
            res => {
                console.log(res.data);
                if (res?.data?.msg === "1") {
                    $scope.bomitemslist = res.data.data;
                } else if (res?.data?.msg === "0") {
                    console.log(res.data.data);
                } else {
                    _apiErrorMsg(response)
                }
            }
        )
    }

    let revision_itemid = document.getElementsByName("revision_itemid")[0];
    let revision_bomprofileno = document.getElementsByName("revision_bomprofileno")[0];
    let revision_bompartno = document.getElementsByName("revision_bompartno")[0];
    let revision_alloy = document.getElementsByName("revision_alloy")[0];
    let revision_finish = document.getElementsByName("revision_finish")[0];
    let revision_bomdescription = document.getElementsByName("revision_bomdescription")[0];
    let revision_bomunit = document.getElementsByName("revision_bomunit")[0];
    let revision_bomdieweight = document.getElementsByName("revision_bomdieweight")[0];
    let revision_ssystem = document.getElementsByName("revision_ssystem")[0];
    let revision_mtype = document.getElementsByName("revision_mtype")[0];
    let revision_bomreqlength = document.getElementsByName("revision_bomreqlength")[0];
    let revision_bomreqbarqty = document.getElementsByName("revision_bomreqbarqty")[0];
    let revision_bomreqtotweight = document.getElementsByName("revision_bomreqtotweight")[0];
    let revision_ogdiscription = document.getElementsByName("revision_ogdiscription")[0];

    let revision_bomdate = document.getElementsByName("revision_bomdate")[0];
    let revision_bomid = document.getElementsByName("revision_bomid")[0];
    let revision_bomremark = document.getElementsByName("revision_bomremark")[0];


    $scope.addrevision = (_i) => {
        //$scope.revision = _i;

        revision_bomprofileno.value = _i.bomprofileno;
        revision_bompartno.value = _i.bompartno;
        revision_bomdescription.value = `${_i.bomdescription} - ${_i.alloy} - ${_i.finish} - ${_i.bomsystem} - ${_i.mtype}`;
        revision_bomunit.value = _i.bomunit;
        revision_bomdieweight.value = _i.bomdieweight;
        revision_bomreqlength.value = _i.bomreqlength;
        revision_bomreqbarqty.value = _i.bomreqbarqty;
        revision_bomreqtotweight.value = _i.bomreqtotweight;
        
        revision_itemid.value = _i.bomitemid;
        revision_alloy.value = _i.alloy;
        revision_finish.value = _i.finish;
        revision_ssystem.value = _i.bomsystem;
        revision_mtype.value = _i.mtype;
        revision_ogdiscription.value = _i.bomdescription;
        revision_bomid.value = _i.bomid;


        let _date = new Date();
        let _d = _date.getDate();
        let _m = _date.getMonth() + 1;
        let _y = _date.getFullYear();

        let __m = doubledigitfix(""+_m);
        let __d = doubledigitfix(""+_d);

        bomdate = `${__d}-${__m}-${_y}`;
        revision_bomdate.value = bomdate;
        let dia_bom_revisions = document.getElementById("dia_bom_revisions");
        dia_bom_revisions.style.display = "flex";
    }


    function doubledigitfix(_val){
        console.log(_val);
        console.log(_val.length)
        let rtval = _val;
        if(_val.length === 1){
            rtval = `0${_val}`;
        }
        return rtval;
    }

    revision_bomdate.addEventListener("keydown",(e)=>{
        if(e.keyCode === 13){
            revision_bomprofileno.focus();
        }
    })

    revision_bomprofileno.addEventListener("keyup", (e) => {
        if (e.keyCode === 13) {
            if (revision_bomprofileno.value === "") {
                alert("Enter Profile Number");
                return;
            }
            console.log(e.target.value);
            GetIteminfos(e.target.value);
        }
    });
    
    revision_bompartno.addEventListener("keyup", (e) => {
        if (e.keyCode === 13) {
            if (revision_bompartno.value === "") {
                alert("Enter Profile Number");
                return;
            }
            console.log(e.target.value);
            GetIteminfos(e.target.value);
        }
    });

  

    function clritems(){
        revision_itemid.value = "";
        revision_bomprofileno.value = "";
        revision_bompartno.value = "";
        revision_alloy.value = "";
        revision_finish.value = "";
        revision_bomdescription.value = "";
        revision_bomunit.value = "";
        revision_bomdieweight.value = "";
        revision_ssystem.value = "";
        revision_mtype.value = "";
        revision_bomreqlength.value = "";
        revision_bomreqbarqty.value = "";
        revision_bomreqtotweight.value = "";
        revision_ogdiscription.value = "";
    }
    function GetIteminfos(itemidx) {
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('itemid', itemidx)

        const post_data = {
            url: `${api_url}bomitem/get.php`,
            data: fd,
            method: "POST",
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);
        clritems();
        req.then(
            res => {
                if (res?.data?.msg === "1") {
                    let _i = res.data.data;
                    revision_ogdiscription = _i.itemdescription
                    revision_itemid.value = _i.itemid;
                    revision_bomprofileno.value = _i.itemprofileno;
                    revision_bompartno.value = _i.itempartno;
                    revision_alloy.value = _i.itemalloy;
                    revision_finish.value = _i.itemfinish;
                    revision_bomunit.value = _i.itemunit;
                    revision_bomdieweight.value = _i.itemdieweight;
                    revision_ssystem.value = _i.itemsystem;
                    revision_mtype.value = _i.itemtype;
                    revision_bomreqlength.value = _i.itemlength;
                    revision_bomreqbarqty.value = "";
                    revision_bomreqtotweight.value = "";
                    revision_bomdescription.value = `${_i.itemdescription} - ${_i.alloy} - ${_i.finish} - ${_i.ssystem} - ${_i.mtype}`;
                    revision_bomreqlength.focus();
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                } else {
                    _apiErrorMsg(response);
                }
            }
        )
    }

    revision_bomreqlength.addEventListener("keyup", (e) => {
        calculations();
        if (e.keyCode === 13) {
            revision_bomreqbarqty.focus();            
        }
    })

    revision_bomreqbarqty.addEventListener("keyup", (e) => {
        calculations();
        if (e.keyCode === 13) {
            revision_bomremark.focus();           
        }
    });

    revision_bomremark.addEventListener("keyup",(e)=>{
        calculations();
        if (e.keyCode === 13) {
            UpdateBom();
        }
    })

    function calculations(){
        revision_bomreqtotweight.value = (+(revision_bomreqbarqty.value) * +(revision_bomdieweight.value) * +(revision_bomreqlength.value)).toFixed(3);
    }

    $scope.new_revision_submit = () => {
        UpdateBom();
    }

    function UpdateBom() {
     
        if(revision_itemid.value === ""){
            alert("ITEM ID MISSING");
            return;
        }

        if(revision_bomprofileno.value === ""){
            alert("Item Profile Number Missing");
            return;
        }

        if(revision_bompartno.value === ""){
            alert("Item Part Number Missing");
            return;
        }

        if(revision_alloy.value === ""){
            alert("Item Alloy Information Missing");
            return;
        }

        if(revision_finish.value === ""){
            alert("Item Finish Color Missing");
            return;
        }

        if(revision_bomunit.value === ""){
            alert("Item Unit Missing");
            return
        }

        if(revision_bomdieweight.value === ""){
            alert("Item Die Weight Missing");
            return
        }

        if(revision_ssystem.value === ""){
            alert("System type Missing");
            return
        }

        if(revision_mtype.value === ""){
            alert("Material type Missing");
            return
        }

        
        if(revision_bomreqlength.value === ""){
            alert("Item Length Missing");
            return
        }


        if(revision_bomreqbarqty.value === ""){
            alert("Enter Bar Qty");
            return
        }

        if(revision_bomreqtotweight.value === ""){
            alert("Enter Total Weight Weight");
            return
        }

        if(revision_bomdescription.value === ""){
            alert("Item Description Missing");
            return
        }

        //check Number

        if(isNaN(revision_bomdieweight.value)){
            alert("Die Weight Should Be A Nummber value");
            return;
        }

        if(isNaN(revision_bomreqlength.value)){
            alert("Item Length Should Be A Nummber value");
            return;
        }


        if(isNaN(revision_bomreqbarqty.value)){
            alert("Bar Qty Should Be A Nummber value");
            return;
        }

        if(isNaN(revision_bomreqtotweight.value)){
            alert("Weight Should Be A Nummber value");
            return;
        }

        calculations();
        
        let frm = document.getElementById("new_revision");
        let fd = new FormData(frm);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('revision_projectno',_xproject)

        const post_data = {
            url: `${api_url}bom/revision.php`,
            method : "POST",
            data  : fd,
            headers : {
                'content-type' : undefined
            }
        };

        const req = $http(post_data);
    
        req.then(
            res => {
                console.log(res.data);
                if(res?.data?.msg === "1"){
                    alert("Updated");
                    document.getElementById("dia_bom_revisions").style.display = "none";
                    getAll();
                }else if(res?.data?.msg === "0"){
                    alert(res.data.data);   
                }else{
                    _apiErrorMsg(res.data);
                }
            }
        );
    }


    function _apiErrorMsg(response) {
        alert("Something Went Wrong API, Check in CONSOLE")
        let disp = response ?? "-";
        console.log(disp);
    }


}