app.controller('bomadd_controller', bomadd_controller);

function bomadd_controller($scope, $http) {
    
    document.title = "ADD NEW BOM - PMS"
    $scope.gregorianDatepickerConfig = {
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
                document.getElementsByName("bomcontract").value = $scope.viewproject.project_no;
                $scope.newproject = res.data.data;
                project_id = angular.lowercase(res.data.data.project_no);
                getBomNewNo(angular.lowercase(res.data.data.project_no));
                // get_all_approvals();
            } else {
                alert(res.data.data);
            }
        });
    }

    // all_systemType();

    // function all_systemType() {
    //     var post_data = {
    //         naf_user: userinfo
    //     };

    //     var req = $http.post(api_url + "SysType/index.php", post_data);
    //     req.then(
    // https://www.amazon.in/BenQ-23-8-inch-Monitor-Built/dp/B08D11X17Q/ref=psdc_1375425031_t3_B08J82K4GX?th=1

    //         res => {
    //             if (res.data.msg === "1") {
    //                 $scope._systype = res.data.data;
    //             } else {
    //                 alert(res.data.data);
    //             }
    //         }
    //     )
    // }

    if (!sessionStorage.getItem('nafco_project_current') || sessionStorage.getItem('nafco_project_current') === '') {
        projectlist();
    } else {
        project_id = sessionStorage.getItem('nafco_project_current');
        get_projectinfo();
        //get_approvalsTypes();
    }



    $scope.loadsearch = () => {
        diabomitemadd()
    }

    function diabomitemadd() {
        document.getElementById("dia_add_bom_items").style.display = "flex"
    }

    // $scope.bomitemslist = [];

    // allItemlist();
    // function allItemlist() {
    //     let fd = new FormData();
    //     fd.append('user_name', userinfo.user_name);
    //     fd.append('user_token', userinfo.user_token);
    //     const post_data = {
    //         url: api_url + "bomitem/index.php",
    //         data: fd,
    //         method: 'POST',
    //         headers: {
    //             'content-type': undefined
    //         }
    //     };

    //     const req = $http(post_data);
    //     req.then(res => {
    //         if (res.data.msg === "1") {
    //             $scope.bomitemslist = res.data.data;
    //             // $scope.$apply();
    //         } else {
    //             //alert(res.data.data);
    //         }
    //     })
    // }
    // // let item_id = "";
    // function getIteminfo(id) {
    //     let fd = new FormData();
    //     fd.append('user_name', userinfo.user_name);
    //     fd.append('user_token', userinfo.user_token);
    //     fd.append('itemid', id);
    //     const post_data = {
    //         url: api_url + "bomitem/get.php",
    //         data: fd,
    //         method: 'POST',
    //         headers: {
    //             'content-type': undefined
    //         }
    //     }
    //     const req = $http(post_data);
    //     req.then(res => {
    //         if (res.data.msg === "1") {
    //             item_id.value = res.data.data.item_id;
    //             proflieno.value = res.data.data.item_profile;
    //             partno.value = res.data.data.item_partno;
    //             description.value = res.data.data.item_description;
    //             dieweight.value = res.data.data.item_dieweight;
    //             itemunit.value = res.data.data.item_unit;
    //             reqlenght.focus();
    //             Calcu();
    //         } else {
    //             alert(res.data.data);
    //         }
    //     })
    // }

    // reqlenght.addEventListener("keyup", (e) => {
    //     Calcu();
    // })
    // reqbarqty.addEventListener("keydown", (e) => {
    //     // if(e.which === 9 ){
    //     //     totweightreq.focus();
    //     // }
    // });
    // avaibarqty.addEventListener("keydown", (e) => {

    //     // if(e.which === 9 ){
    //     //     remarks.focus();
    //     // }
    // });
    // reqbarqty.addEventListener("keyup", (e) => {
    //     Calcu();

    // })

    // availenght.addEventListener("keyup", (e) => {
    //     Calcu();
    // })
    // avaibarqty.addEventListener("keyup", (e) => {
    //     Calcu();
    // })

    // function Calcu() {
    //     totweightreq.value = (+reqlenght.value * +reqbarqty.value * +dieweight.value).toFixed(2);
    //     avaitotweight.value = (+availenght.value * +avaibarqty.value * +dieweight.value).toFixed(2);
    //     if ((+reqbarqty.value) >= (+avaibarqty.value)) {
    //         needlenght.value = 0;
    //         needbarqty.value = 0;
    //         needweight.value = 0;
    //     } else {
    //         console.log("calculate");
    //         needlenght.value = (+reqlenght.value - +availenght.value).toFixed(2);
    //         needbarqty.value = (+avaibarqty.value - +reqbarqty.value)
    //         needweight.value = (+needlenght.value * +needbarqty.value * +dieweight.value).toFixed(2);
    //     }

    // }

    // remarks.addEventListener("keydown", (e) => {
    //     if (e.which === 13) {
    //         addToTable();
    //         _modechange();
    //     }
    //     focusevent(e, avaibarqty, avaibarqty);
    // })

    // remarks.addEventListener("dblclick", (e) => {
    //     _mode = "e"
    // })

    // function addToTable() {
    //     if (partno.value === '') {
    //         alert("Enter Partno");
    //     } else if (description.value === "") {
    //         alert("select Any item");
    //     } else if (dieweight.value === "") {
    //         alert("Enter Die Weight");
    //     } else if (reqlenght.value === "") {
    //         alert(" Enter Require Lengt");
    //     } else if (reqbarqty.value === "") {
    //         alert(" Enter Require BAR Qty");
    //     } else if (itemunit.value === "") {
    //         alert("Enter UNIT");
    //     } else if (availenght.value === "") {
    //         alert("Enter Availabel Length");
    //     } else if (avaibarqty.value === "") {
    //         alert("Enter Bar QTY");
    //     } else if (avaitotweight.value === "'") {
    //         alert("Enter Available Total weight");
    //     } else if (needlenght.value === "'") {
    //         alert("Enter To Be Order Lenght");
    //     } else if (needbarqty.value === "") {
    //         alert("Enter To Be Order Bar");
    //     } else if (needweight.value === "") {
    //         alert("Enter To Be Order Weight");
    //     } else if (bomsystem.value === "") {
    //         alert("Enter Refer System");
    //     }
    //     else {
    //         if (isNaN(dieweight.value)) {
    //             alert("DIE Weight Should be a Number value")
    //         } else if (isNaN(reqlenght.value)) {
    //             alert("Required Length Should Be a Number Value")
    //         } else if (isNaN(reqbarqty.value)) {
    //             alert("Required BAR Qty Should Be a Number Value")
    //         }
    //         else if (isNaN(totweightreq.value)) {
    //             alert("Required Total Weight Should Be a Number Value")
    //         }
    //         else if (isNaN(availenght.value)) {
    //             alert("Required Availabble Length Should Be a Number Value")
    //         }
    //         else if (isNaN(avaibarqty.value)) {
    //             alert("Required Availabble BAR QTY Should Be a Number Value")
    //         }
    //         else if (isNaN(avaitotweight.value)) {
    //             alert("Required Availabble Weight Should Be a Number Value")
    //         }
    //         else if (isNaN(needlenght.value)) {
    //             alert("Required To Be Ordered Length Should Be a Number Value")
    //         } else {
    //             let nitem = {
    //                 item_id: item_id,
    //                 proflieno: proflieno.value,
    //                 partno: partno.value,
    //                 description: description.value,
    //                 dieweight: dieweight.value,
    //                 reqlenght: reqlenght.value,
    //                 reqbarqty: reqbarqty.value,
    //                 itemunit: itemunit.value,
    //                 totweightreq: totweightreq.value,
    //                 availenght: availenght.value,
    //                 avaibarqty: avaibarqty.value,
    //                 avaitotweight: avaitotweight.value,
    //                 needlenght: needlenght.value,
    //                 needbarqty: needbarqty.value,
    //                 needweight: needweight.value,
    //                 remarks: remarks.value === '' ? '-' : remarks.value,
    //                 bomsystem: bomsystem.value,
    //             };
    //             console.log(nitem);

    //             $scope.itemslist.push(nitem);
    //             $scope.$apply();

    //             proflieno.value = "";
    //             partno.value = "";
    //             description.value = "";
    //             dieweight.value = "";
    //             reqlenght.value = "";
    //             reqbarqty.value = "";
    //             itemunit.value = "";
    //             totweightreq.value = "";
    //             availenght.value = "";
    //             avaibarqty.value = "";
    //             avaitotweight.value = "";
    //             needlenght.value = "";
    //             needbarqty.value = "";
    //             needweight.value = "";
    //             remarks.value = "";
    //             proflieno.focus();
    //         }

    //     }
    // }

    // $scope.removeItem = (index) => {
    //     $scope.itemslist.splice(index, 1);
    // }

    // $scope.newitem_bom_submit = () => {
    //     let frm = document.getElementById('newitem_bom');
    //     let fd = new FormData(frm);
    //     fd.append('user_name', userinfo.user_name);
    //     fd.append('user_token', userinfo.user_token);
    //     const post_data = {
    //         url: api_url + "bomitem/new.php",
    //         data: fd,
    //         method: 'POST',
    //         headers: {
    //             'content-type': undefined
    //         }
    //     }
    //     const req = $http(post_data);

    //     req.then(
    //         (res) => {
    //             if (res.data.msg === "1") {
    //                 alert("Saved");
    //                 $scope.bomitemslist = [];
    //                 allItemlist();
    //                 $scope.newitem = [];
    //                 document.getElementsByName('item_profile')[0].focus();
    //             } else {
    //                 alert(res.data.data);
    //             }
    //         }
    //     )
    // }

    

    let itemtype = document.getElementsByName("itemtype")[0];
    let itemprofileno = document.getElementsByName("itemprofileno")[0];
    let itemsystem = document.getElementsByName("itemsystem")[0];
    let itempartno = document.getElementsByName("itempartno")[0];
    let itemdescription = document.getElementsByName("itemdescription")[0];
    let itemalloy = document.getElementsByName("itemalloy")[0];
    let itemfinish = document.getElementsByName("itemfinish")[0];
    let itemlength = document.getElementsByName("itemlength")[0];
    let itemunit = document.getElementsByName("itemunit")[0];
    let itemdieweight = document.getElementsByName("itemdieweight")[0];

    itemtype.addEventListener("keydown", (e) => {
        if (e.which === 13 || e.which === 9)
            moveNext(itemprofileno);
        return
    })

    itempartno.addEventListener("keydown", (e) => {
        if (e.which === 13 || e.which === 9)
            moveNext(itemdescription);
        return
    })
    itemdescription.addEventListener("keydown", (e) => {
        if (e.which === 13 || e.which === 9)
            moveNext(itemdieweight);
        return
    })
    itemalloy.addEventListener("keydown", (e) => {
        if (e.which === 13 || e.which === 9)
            moveNext(itemfinish);
        return
    })
    itemfinish.addEventListener("keydown", (e) => {
        if (e.which === 13 || e.which === 9)
            moveNext(itemunit);
        return
    })

    itemlength.addEventListener("keydown", (e) => {
        if (e.which === 13 || e.which === 9)
            moveNext(itemalloy);
        return
    })
    itemunit.addEventListener("keydown", (e) => {
        if (e.which === 13 || e.which === 9)
            itemSaveFunction();
        return
    })

    itemdieweight.addEventListener("keydown", (e) => {
        if (e.which === 13)
            moveNext(itemlength)
        return
    })


    function moveNext(_controllers) {
        _controllers.focus();
    }

    $scope.mtypelist = [];
    getAllmtypes();
    function getAllmtypes() {
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        const post_data = {
            url: `${api_url}bomprop/mtypeall.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        }

        const req = $http(post_data);
        $scope.mtypelist = [];
        req.then(
            res => {
                if (res?.data?.msg === "1") {
                    $scope.mtypelist = res.data.data;
                } else if (res?.data?.msg === "0") {
                    console.log(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        )
    }

    let typename = document.getElementsByName('typename')[0];
    typename.addEventListener('keydown',(e)=>{
        if(e.which === 13){
            if(typename.value === ""){
                alert("Enter Material Type")
                return;
            }
            _saveType();
        }
    });
    $scope.newprops_type_submit = () => {
        _saveType();
    }

    function _saveType(){
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append("typename", typename.value);

        const post_data = {
            url: `${api_url}bomprop/mtypenew.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        }

        const req = $http(post_data);
        req.then(
            res => {
                if (res?.data?.msg === '1') {
                    alert("saved");
                    typename.value = "";
                    typename.focus();
                    getAllmtypes();
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        )
    }

    //system profile no
    $scope.systemprofilelist = [];
    AllsystemProlfileno();
    function AllsystemProlfileno() {
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        const post_data = {
            url: `${api_url}bomprop/systemall.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        }

        const req = $http(post_data);
        $scope.systemprofilelist = [];
        req.then(
            res => {
                if (res?.data?.msg === "1") {
                    $scope.systemprofilelist = res.data.data;
                } else if (res?.data?.msg === "0") {
                    console.log(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        )
    }

    itemprofileno.addEventListener("keydown", e => {
        if (e.which === 13) {
            itemsystem.focus();
        }
    });

    itemsystem.addEventListener("keydown",(e)=>{
        if(e.which === 13){
            moveNext(itempartno);
        }
    })
    function getsystemprofileinfo(proflieno) {
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('itemprofileno', proflieno);
        const post_data = {
            url: `${api_url}bomprop/systemget.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        }

        const req = $http(post_data);
        req.then(
            res => {
                if (res?.data?.msg === "1") {
                    itemsystem.value = res.data.data.systemname;
                    console.log($scope.profilesystem)
                    itempartno.focus();
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                    console.log(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        );
    }

    
    let systemname = document.getElementsByName("systemname")[0];

    

    systemname.addEventListener('keydown',(e)=>{
        if(e.which === 13){
            if(systemname.value === ''){
                alert("Enter system Name");
                return
            }            
            _systemSave();
        }
    })

    $scope.newprops_profiletype_submit = () => {
        _systemSave()
    }

    function _systemSave(){
        let frm = document.getElementById('newprops_profiletype');
        let fd = new FormData(frm);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        const post_data = {
            url: `${api_url}bomprop/systemnew.php`,
            method: 'POST',
            data: fd,
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);
        // $scope.systemprofilelist = [];
        req.then(
            res => {
                if (res?.data?.msg === "1") {
                    alert("saved");
                    AllsystemProlfileno();
                    $scope.profilesystem = [];
                    document.getElementsByName('systemname')[0].focus();
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                    console.log(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        );
    }


    $scope.alloylist = [];
    allAlloy();
    function allAlloy() {
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        const post_data = {
            url: `${api_url}bomprop/alloyall.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);
        req.then(res => {
            console.log(res.data);
            $scope.alloylist = [];
            if (res?.data?.msg === "1") {
                $scope.alloylist = res.data.data;
            } else if (res?.data?.msg === "0") {
                console.log(res.data.data);
            } else {
                _apiErrorMsg(res.data);
            }
        })
    }

    let alloyname = document.getElementsByName("alloyname")[0];

    alloyname.addEventListener("keydown",(e)=>{
        if(e.which === 13){
            if(alloyname.value === ""){
                alert("Enter Alloy Name");
                return;
            }
            _alloySave()
        }
    })

    $scope.newprops_alloy_submit = () => {
        _alloySave()      
    }

    function _alloySave(){
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('alloyname', alloyname.value);

        const post_data = {
            url: `${api_url}bomprop/alloynew.php`,
            method: "POST",
            data: fd,
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);
        req.then(
            res => {
                if (res?.data?.msg === "1") {
                    alert("Saved");
                    allAlloy();
                    alloyname.value = "";
                    alloyname.focus();
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                    console.log(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        )
    }

    let finishcolor = document.getElementsByName("finishcolor")[0];
    $scope.finishcolorlist = [];
    allFinish();
    function allFinish() {
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        const post_data = {
            url: `${api_url}bomprop/colorall.php`,
            method: "POST",
            data: fd,
            headers: {
                'content-type': undefined
            }
        };
        const req = $http(post_data);
        $scope.finishcolorlist = [];
        req.then(res => {
            if (res?.data?.msg === "1") {
                $scope.finishcolorlist = res.data.data;
            } else if (res?.data?.msg === "0") {
                console.log(res.data.data);
            } else {
                _apiErrorMsg(res.data);
            }
        })
    }

    finishcolor.addEventListener("keydown", e => {
        if (e.which === 13) {
            addNewFinish();
        }
    })


    $scope.newprops_finsih_submit = () => {
        addNewFinish();
    }

    function addNewFinish() {
        if (finishcolor.value === "") {
            alert("Enter Finish Color");
            return;
        }
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('finishSave', finishcolor.value);

        const post_data = {
            url: `${api_url}bomprop/colornew.php`,
            method: "POST",
            data: fd,
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);
        req.then(
            res => {
                if (res?.data?.msg === "1") {
                    alert("saved");
                    allFinish();
                    finishcolor.value = "";
                    finishcolor.focus();
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        );
    }


    $scope.unitlist = [];
    Allunits();
    function Allunits() {
        $scope.unitlist = [];
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        const post_data = {
            url: `${api_url}bomprop/unitall.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(
            res => {

                if (res?.data?.msg === "1") {
                    $scope.unitlist = res.data.data;
                } else if (res?.data?.msg === "0") {
                    console.log(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        )

    }
    let unitname = document.getElementsByName("unitname")[0];
    unitname.addEventListener("keyup", e => {
        if (e.which === 13) {
            saveUnit();
        }
    });

    $scope.newprops_units_submit = () => {
        saveUnit();
    }

    function saveUnit() {
        if (unitname.value === "") {
            alert("enter unit");
            return;
        }

        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('unitname', unitname.value);

        const post_data = {
            url: `${api_url}bomprop/unitnew.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);
        req.then(res => {
            if (res?.data?.msg === "1") {
                alert("saved");
                Allunits();
                unitname.value = "";
                unitname.focus();
            } else if (res?.data?.msg === "0") {
                alert(res.data.data);
            } else {
                _apiErrorMsg(res.data);
            }
        })
    }

    $scope.partfunctionlist = [];

    _loadParfunctionAll();
    
    function _loadParfunctionAll(){
        $scope.partfunctionlist = [];
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        const post_data = {
            url: `${api_url}bomprop/partfunctionall.php`,
            data: fd,
            method: 'POST',
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(
            res => {

                if (res?.data?.msg === "1") {
                    $scope.partfunctionlist = res.data.data;
                } else if (res?.data?.msg === "0") {
                    console.log(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        )
    }

    $scope.newitem_bom_submit = () => {
        itemSaveFunction();
    }

    function itemSaveFunction() {
        if (!_emptyvalidate(itemtype)) {
            alert("Select Item Type")
            return
        }

        if (!_emptyvalidate(itemprofileno)) {
            alert("Select Profile")
            return
        }

        if (!_emptyvalidate(itemprofileno)) {
            alert("Select System Type")
            return
        }

        if (!_emptyvalidate(itempartno)) {
            alert("Enter Part Number")
            return
        }

        if (!_emptyvalidate(itemdescription)) {
            alert("Enter Item Description")
            return
        }

        if (!_emptyvalidate(itemalloy)) {
            alert("Select Alloy")
            return
        }

        if (!_emptyvalidate(itemfinish)) {
            alert("Select Finish (COLOR)")
            return
        }

        if (!_emptyvalidate(itemlength)) {
            alert("Enter Length")
            return
        }
        if (!_numbervalidate(itemlength)) {
            alert("length Should Be a Number value")
            return
        }

        if (!_emptyvalidate(itemunit)) {
            alert("Select Item Unit")
            return
        }

        if (!_emptyvalidate(itemdieweight)) {
            alert("Enter ITEM DIE WEIGHT")
            return
        }


        if (!_numbervalidate(itemdieweight)) {
            alert("DIE Weight Should Be a Number value")
            return
        }
        console.log("its working")
        let frm = document.getElementById("newitem_bom");
        let fd = new FormData(frm);
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        const post_data = {
            url: `${api_url}bomitem/new.php`,
            data: fd,
            method: "POST",
            headers: {
                'content-type': undefined
            }
        }

        const req = $http(post_data);
        req.then(
            res => {
                if (res?.data?.msg === '1') {
                    alert("saved");
                    $scope.newitem = [];
                    itemsystem.value = "";
                    itemtype.focus();
                    AllBoqItems();
                } else if (res?.data?.msg === '0') {
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


    let itemid = "";
    let profileno = document.getElementsByName("profileno")[0];
    let partno = document.getElementsByName("partno")[0];
    let alloy = "";
    let finish = "";
    let dieweight = document.getElementsByName("dieweight")[0];
    let ssystem = "";
    let mtype = "";
    let description = document.getElementsByName("description")[0];
    let reqlenght = document.getElementsByName("reqlenght")[0];
    let reqbarqty = document.getElementsByName("reqbarqty")[0];
    let itemunits = document.getElementsByName("itemunits")[0];
    let totweightreq = document.getElementsByName("totweightreq")[0];
    let availenght = document.getElementsByName("availenght")[0];
    let avaibarqty = document.getElementsByName("avaibarqty")[0];
    let avaitotweight = document.getElementsByName("avaitotweight")[0];
    let needlenght = document.getElementsByName("needlenght")[0];
    let needbarqty = document.getElementsByName("needbarqty")[0];
    let needweight = document.getElementsByName("needweight")[0];
    let remarks = document.getElementsByName("remarks")[0];
    let ogdiscription = "";


    function focusevent(e, moveprv, movenxt) {
        if (e.keyCode === 39) {
            if (_mode === "n") {
                movenxt.focus();
            }
        }

        if (e.keyCode === 37) {
            if (_mode === "n") {
                moveprv.focus();
            }
        }
    }
    let _mode = "n";
    function _modechange() {
        _mode = "n";
    }




    profileno.addEventListener("keydown", (e) => {
        if (e.which === 13) {
            let bomsrcitemlist = document.getElementById("bomsrcitemlist");
            console.log(bomsrcitemlist);
            console.log(bomsrcitemlist.selectedIndex);
            itemid = profileno.value
            LoadItemInfo(itemid);
        }
        focusevent(e, partno, partno)
    });

    partno.addEventListener("keydown", (e) => {
        if (e.which === 13) {
            itemid = partno.value
            LoadItemInfo(itemid);
        }
        focusevent(e, profileno, reqlenght)
    });




    $scope.itemslist = [];

    function clearItems() {
        itemid = "";
        profileno.value = "";
        partno.value = "";
        alloy = "";
        finish = "";
        dieweight.value = "";
        ssystem = "";
        mtype = "";
        description.value = "";
        reqlenght.value = "";
        reqbarqty.value = "";
        itemunits.value = "";
        totweightreq.value = "";
        availenght.value = "";
        avaibarqty.value = "";
        avaitotweight.value = "";
        needlenght.value = "";
        needbarqty.value = "";
        needweight.value = "";
        remarks.value = "";
        ogdiscription = "";
    }

    function LoadItemInfo(_itemid) {
        if (_itemid === '') {
            clearItems();
            alert("Select Any Item.")
            return;
        }

        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('itemid', itemid)

        const post_data = {
            url: `${api_url}bomitem/get.php`,
            data: fd,
            method: "POST",
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(
            res => {
                clearItems();
                if (res?.data?.msg === "1") {
                    console.log(res.data.data);
                    itemid = res.data.data.itemid;
                    document.getElementsByName("itemid")[0].value = itemid;
                    profileno.value = res.data.data.itemprofileno;
                    partno.value = res.data.data.itempartno;
                    alloy = res.data.data.itemalloy;
                    finish = res.data.data.itemfinish;
                    dieweight.value = res.data.data.itemdieweight;
                    ssystem = res.data.data.itemsystem;
                    mtype = res.data.data.itemtype;
                    ogdiscription = res.data.data.itemdescription;
                    availenght.value = res.data.data.itemlength;
                    needlenght.value = res.data.data.itemlength;
                    itemunits.value = res.data.data.itemunit;
                    reqlenght.value = res.data.data.itemlength;
                    description.value = `${ogdiscription} - ${alloy} - ${finish} - ${ssystem} - ${mtype}`;
                    reqbarqty.focus();
                    console.log(itemid);
                } else if (res?.data?.msg === "0") {
                    alert(res.data.data);
                } else {
                    _apiErrorMsg(res.data);
                }
            }
        )
    }

    
    reqlenght.addEventListener("keydown", (e) => {
        if (e.keyCode === 13) {
            reqbarqty.focus();
            _modechange();
        }
        focusevent(e, partno, reqbarqty);

    })

    reqlenght.addEventListener("keyup", (e) => {
        calculations();
    });

    reqbarqty.addEventListener("keydown", (e) => {
        if (e.keyCode === 13) {
            avaibarqty.focus();
            _modechange();
        }
        focusevent(e, reqlenght, avaibarqty);
    })
    reqbarqty.addEventListener("keyup", (e) => {
        calculations();
    });

    avaibarqty.addEventListener("keydown", (e) => {
        if (e.keyCode === 13) {
            remarks.focus();
            _modechange();
        }
        focusevent(e, reqbarqty, remarks);

    })

    avaibarqty.addEventListener("keyup", (e) => {
        calculations();
    });

    remarks.addEventListener("keydown", (e) => {
        calculations();
        if (e.keyCode === 13) {
            AddToList();
            _modechange();
        }
        focusevent(e, avaibarqty, profileno);
    })


    profileno.addEventListener("dblclick", (e) => {
        _mode = "e"
    })
    partno.addEventListener("dblclick", (e) => {
        _mode = "e"
    })
    reqlenght.addEventListener("dblclick", (e) => {
        _mode = "e"
    })
    reqbarqty.addEventListener("dblclick", (e) => {
        _mode = "e"
    })
    avaibarqty.addEventListener("dblclick", (e) => {
        _mode = "e"
    })
    remarks.addEventListener("dblclick", (e) => {
        _mode = "e"
    })


    function calculations() {
        //get require weight
        totweightreq.value = Math.round(((+dieweight.value) * (+reqlenght.value) * (+reqbarqty.value))).toFixed(3);

        //get avialable weight
        avaitotweight.value = ((+dieweight.value) * (+availenght.value) * (+avaibarqty.value)).toFixed(3);

        //get be order weight

        if ((+avaibarqty.value) >= (+reqbarqty.value)) {
            needbarqty.value = "0";
            //needlenght.value = "0";
            needweight.value = "0";
        } else {
            needbarqty.value = (+reqbarqty.value) - (+avaibarqty.value);
            needweight.value = ((+dieweight.value) * (+needlenght.value) * (+needbarqty.value)).toFixed(3);
        }
    }

    function AddToList() {
        console.log(itemid);
        if (itemid === "") {
            alert("Select Any Item")
            return;
        }

        if (!_emptyvalidate(profileno)) {
            alert("Select Any Item _ profile no missing")
            return;
        }
        if (!_emptyvalidate(partno)) {
            alert("Select Any Item _ part number missing")
            return;
        }
        if (!_emptyvalidates(alloy)) {
            alert("Select Any Item _ Alloy Missing")
            return;
        }
        if (!_emptyvalidates(finish)) {
            alert("Select Any Item _ finish Color Missing")
            return;
        }
        if (!_emptyvalidates(ssystem)) {
            alert("Select Any Item _ System Type Missing")
            return;
        }
        if (!_emptyvalidates(ssystem)) {
            alert("Select Any Item _ System Type Missing")
            return;
        }
        if (!_emptyvalidates(mtype)) {
            alert("Select Any Item _ Material Type Missing")
            return;
        }

        if (!_emptyvalidate(description)) {
            alert("Select Any Item _ Description Type Missing")
            return;
        }

        if (!_emptyvalidate(dieweight)) {
            alert("Select Any Item _ Die Wight missing")
            return;
        }
        if (!_emptyvalidate(itemunits)) {
            alert("Select Any Item _ Units missing")
            return;
        }
        if (!_emptyvalidate(reqlenght)) {
            alert("Enter Require Length")
            return;
        }
        console.log(reqlenght.value);

        if (!_numbervalidate(reqlenght)) {
            alert("Require Length Should Be a Number")
            return;
        }
        if (!_emptyvalidate(reqbarqty)) {
            alert("Enter Required Bar Qty")
            return;
        }

        if (!_numbervalidate(reqbarqty)) {
            alert("Required Bar Qty Should Be a Number")
            return;
        }

        if (!_emptyvalidate(totweightreq)) {
            alert("Check Require Total Weight")
            return;
        }

        if (!_numbervalidate(totweightreq)) {
            alert("Require Total Weight Should Be a Number")
            return;
        }

        if (!_emptyvalidate(availenght)) {
            alert("Check Avialable Length")
            return;
        }

        if (!_numbervalidate(availenght)) {
            alert("Avialable Length Should Be a Number")
            return;
        }

        if (!_emptyvalidate(avaibarqty)) {
            avaibarqty.value == "0";
            calculations();
        }

        if (!_numbervalidate(avaibarqty)) {
            alert("Avialable Bar Qty Should Be a Number")
            return;
        }

        if (!_emptyvalidate(avaitotweight)) {
            alert("Check Available Weight")
            return;
        }

        if (!_numbervalidate(avaitotweight)) {
            alert("Check Available Weight Should Be a Number")
            return;
        }

        if (!_emptyvalidate(needlenght)) {
            alert("Check Qty to Be order length")
            return;
        }

        if (!_numbervalidate(needlenght)) {
            alert("Qty to Be order length Should Be a Number")
            return;
        }

        if (!_emptyvalidate(needbarqty)) {
            alert("Check Qty to Be order Bar Qty")
            return;
        }

        if (!_numbervalidate(needbarqty)) {
            alert("Qty to Be order Bar Qty Should Be a Number")
            return;
        }

        if (!_emptyvalidate(needweight)) {
            alert("Check Qty to Be order Weight")
            return;
        }

        if (!_numbervalidate(needweight)) {
            alert("Qty to Be order Weight Should Be a Number")
            return;
        }


        let nitem = {
            itemid: itemid,
            profileno: profileno.value,
            partno: partno.value,
            alloy: alloy,
            finish: finish,
            dieweight: dieweight.value,
            ssystem: ssystem,
            mtype: mtype,
            description: description.value,
            reqlenght: reqlenght.value,
            reqbarqty: reqbarqty.value,
            itemunits: itemunits.value,
            totweightreq: totweightreq.value,
            availenght: availenght.value,
            avaibarqty: avaibarqty.value === '' ? "0" : avaibarqty.value,
            avaitotweight: avaitotweight.value,
            needlenght: needlenght.value,
            needbarqty: needbarqty.value,
            needweight: needweight.value,
            remarks: remarks.value === "" ? '-' : remarks.value,
            ogdiscription: ogdiscription,
        };

        console.log(nitem);
        clearItems();
        $scope.itemslist.push(nitem);
        $scope.$apply();

        // //group by option need
        // //groups 
        // let _system = [];
        // let _mtype = [];
        // let alldata = [];
        // $scope.itemslist.map((i) => {
        //     let _s = i.ssystem;
        //     if (!_system.includes(_s)) {
        //         _system.push(_s);
        //     }
        //     let _m = i.mtype;
        //     if (!_mtype.includes(_mtype)) {
        //         _mtype.push(_m);
        //     }

        //     alldata.push(i);
        // });

        // let _xn = [];
        // _system.map((x) => {
        //     let xsystem = x;
        //     let arr = [];
        //     alldata.map((i) => {
        //         if (i.ssystem === x) {
        //             arr.push(i);
        //         }
        //     })
        //     _xn.push({ xsystem, arr });
        // })

        // console.log(_xn);

        // $scope.itemslist = _xn;
        // $scope.$apply();
        profileno.focus();

    }

    $scope.removeItem = (index) => {
        console.log("working");
        $scope.itemslist.splice(index, 1);
    }

    bomsno = "";
    $scope.saveBom = () => {
        let bomdate = document.getElementsByName('bomdate')[0].value;
        let bomproject = $scope.viewproject.project_no;
        let bomcontract = document.getElementsByName('bomcontract')[0].value;
        let bomcolor = document.getElementsByName('bomcolor')[0].value;
        if (bomdate === '') {
            alert("Enter Date");
        }else if(bomproject === ''){
            alert("Select Any Project");
        }else if(bomcontract === ''){ alert("Enter Contract Informations") }
        else if(bomcolor === ''){ alert("Enter Color Informations") }
        else if ($scope.itemslist.length === 0) {
            alert("Enter BOM Items...")
        } else {
            let itemslist = $scope.itemslist;
            console.log();
            let s = JSON.stringify(itemslist);
            let frm = document.getElementById('newitem_bom');
            let fd = new FormData();
            fd.append('user_name', userinfo.user_name);
            fd.append('user_token', userinfo.user_token);
            fd.append("bomfno",document.getElementsByName("bomsno")[0].value);
            fd.append('bomdate', bomdate);
            fd.append('bomproject', bomproject);
            fd.append('bomcontract', bomcontract);
            fd.append('bomcolor', bomcolor);
            fd.append('itemslist', JSON.stringify(itemslist));
            fd.append("bomsno",bomsno)

            const post_data = {
                url: api_url + "bom/new.php",
                data: fd,
                method: 'POST',
                headers: {
                    'content-type': undefined
                }
            }
            const req = $http(post_data);

            req.then(
                (res) => {
                    if (res?.data?.msg === '1') {
                        alert("saved");
                        location.reload();
                    } else if(res?.data?.msg === "0"){
                        alert(res.data.data);
                    }else {
                        _apiErrorMsg(res.data);
                    }
                }
            );
        }
    }

    function _emptyvalidate(_controller) {
        return _controller.value !== "" ? true : false;
    }
    function _emptyvalidates(_controller) {
        return _controller !== "" ? true : false;
    }
    function _numbervalidate(_controller) {
        return !isNaN(_controller.value) ? true : false;
    }
    function _numbervalidates(_controller) {
        return !isNaN(_controller) ? true : false;
    }
    

    function getBomNewNo(projectno){
        console.log("pom called");
        let fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('projectno',projectno);
        fd.append('bomsno',bomsno);
        fd.append('ltype',"O");

        const post_data = {
            url : `${api_url}bom/gno.php`,
            data : fd,
            method : "POST",
            headers : {
                'content-type' : undefined
            }
        };

        const req = $http(post_data);

        req.then(
            res => {
                console.log(res);
                if(res?.data?.msg === "1"){
                    console.log(res.data.data);
                    document.getElementsByName("bomsno")[0].value = res.data.data.bomno;
                    let x = new Date();
                    let d = x.getDate();
                    let m = x.getMonth()+1;
                    let y = x.getFullYear();
                    document.getElementsByName('bomdate')[0].value = `${d}-${m}-${y}`;
                    bomsno = res.data.data.bomsno;
                }else if(res?.data?.msg === "0"){
                    alert(res.data.data);
                }else{
                    _apiErrorMsg(res.data);
                }
            }
        )
    }

    function _apiErrorMsg(response) {
        alert("Something Went Wrong API, Check in CONSOLE")
        let disp = response ?? "-";
        console.log(disp);
    }
}