app.controller('boq', function($scope, $http,$timeout) {
    // const inputs = document.querySelectorAll("input");
    // inputs.forEach(i => {
    //     i.autocomplete = "off";
    // })
    $scope.isloading = false;
    document.getElementById("contract_menu").classList.add('menuactive');
    $("#back_btn").on('click', function() {
        window.history.back();
    })

    

    var bc_home = document.getElementById("back-to-tops");
    bc_home.addEventListener('click', function() {
        window.scrollTo(0, 0);
    })
    bc_home.style.display = "none";
    window.addEventListener('scroll', function() {
        if (pageYOffset > 400) {
            bc_home.style.display = "block";
        } else {
            bc_home.style.display = "none";
        }
    })
    let project_id;
    if (!sessionStorage.getItem('nafco_project_current') || sessionStorage.getItem('nafco_project_current') === '') {
        projectlist();
    } else {
        project_id = sessionStorage.getItem('nafco_project_current');
        get_projectinfo();
        //$scope.projctname = project_id;
    }
    all_techApprovalsType();

    function all_techApprovalsType() {
        let post_data = {
            naf_user: userinfo
        };
        $http({
            method: 'post',
            data: post_data,
            url: api_url + "Approval_Type/index.php"
        }).then(
            function(res) {
                if (res.data.msg === "1") {
                    $scope.menu_Techapprovals = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    var project_boq_refno = "";
    var project_boq_revision = "";

    function get_projectinfo() {
        let post_data = {
            naf_user: userinfo,
            project_no: project_id
        }
        var req = $http.post(api_url + "Project/view.php", post_data);
        req.then(res => {
            if (res.data.msg === "1") {
                $scope.viewproject = res.data.data;
                $scope.newproject = res.data.data;
                document.title = `BOQ of ${res.data.data.project_name} [${res.data.data.project_no}] - PMS`;
                project_id = angular.lowercase(res.data.data.project_no)
                if (res.data.data.project_boq_refno === "") {

                } else if (res.data.data.project_boq_revision === "") {

                } else {
                    project_boq_refno = res.data.data.project_boq_refno;
                    project_boq_revision = res.data.data.project_boq_revision;
                    project_boq(project_id, project_boq_refno, project_boq_revision);
                    getboqitemallsfun();
                }
            } else {
                alert(res.data.data);
            }
        });
    }

    function project_boq(project_no, refno, reviewno) {
        $scope.isloading = true;
        var post_data = {
            naf_user: userinfo,
            project_no: project_no,
            project_refno: refno,
            project_reviewno: reviewno
        };
        $http.post(api_url + "Boq/index.php", post_data)
            .then(
                function(res) {
                    console.log(res.data);

                    if (res.data.msg === "1") {
                        $scope.projectboq = res.data.data;
                        _maketable(res.data.data)
                        $scope.totamount = res.data.data.total;
                    } else {
                        alert(res.data.data);
                    }
                    console.log("its working");
                    $scope.isloading = false;
                }
            )
    }

    function _maketable(x) {
        console.log("yellow,", x)   
        const boq = x.boq;

        let _print = "";
        boq.map((i, index) => {
            _print += "<tr>";
            _print += `<td rowspan="12">${i.boq_info.poq_item_no}</td>`
            _print += `<td style="font-weight:bold">Type</td>`
            _print += `<td colspan="5">${i.boq_info.ptype_name}</td>`
            _print += `<td rowspan="12">${i.boq_info.poq_qty}</td>`
            _print += `<td rowspan="12">${i.boq_info.unit_name}</td>`
            _print += `<td rowspan="12">${i.boq_info.poq_uprice}</td>`
            _print += `<td rowspan="12">${i.boq_info.item_aras}</td>`
            _print += `<td rowspan="12">${i.boq_info.tot}</td>`
            _print += "</tr>";
            _print += "<tr>"
            _print += `<td></td>`
            _print += `<td colspan="5">${i.boq_info.poq_item_remark}</td>`
            _print += "</tr>"
            _print += "<tr>"
            _print += `<td style="font-weight:bold">Locations</td>`
            _print += `<td colspan="5">${i.boq_info.poq_remark}</td>`
            _print += "</tr>"
            _print += "<tr>"
            _print += `<td style="font-weight:bold">Area</td>`
            _print += `<td style="font-weight:bold">WIDTH (MM)</td>`
            _print += `<td style="font-weight:bold">HEIGHT (MM)</td>`
            _print += `<td colspan="3"> AREA(MM)</td>`
            _print += "</tr>"

            _print += "<tr>"
            _print += `<td></td>`
            _print += `<td>${i.boq_info.poq_item_width}</td>`
            _print += `<td>${i.boq_info.poq_item_height}</td>`
            _print += `<td colspan="3"> ${i.boq_info.area}</td>`
            _print += "</tr>"

            _print += "<tr>"
            _print += `<td style="font-weight:bold">Glass</td>`
            _print += `<td colspan="5">${i.boq_info.poq_item_glass_spec}</td>`            
            _print += "</tr>"

            _print += "<tr>"
            _print += `<td style="font-weight:bold">SINGLE</td>`
            _print += `<td>${i.boq_info.poq_item_glass_single}</td>`
            _print += `<td></td>`
            _print += `<td colspan="3"></td>`
            _print += "</tr>"

            _print += "<tr>"
            _print += `<td style="font-weight:bold">DOUBLE</td>`
            _print += `<td>${i.boq_info.poq_item_glass_double1}</td>`
            _print += `<td>${i.boq_info.poq_item_glass_double2}</td>`
            _print += `<td>${i.boq_info.poq_item_glass_double3}</td>`
           
            _print += "</tr>"

            
            _print += "<tr>"
            _print += `<td style="font-weight:bold">LAMINATED</td>`
            _print += `<td>${i.boq_info.poq_item_glass_laminate1}</td>`
            _print += `<td>${i.boq_info.poq_item_glass_laminate2}</td>`
            _print += `<td></td>`
          
            _print += "</tr>"

            _print += "<tr>"
            _print += `<td style="font-weight:bold">Drawing</td>`
            _print += `<td colspan="5">${i.boq_info.poq_drawing}</td>`
            _print += "</tr>"

            _print += "<tr>"
            _print += `<td style="font-weight:bold">Finish</td>`
            _print += `<td colspan="5">${i.boq_info.finish_name}</td>`
            _print += "</tr>"
            _print += "<tr>"
            _print += `<td colspan="6">
            Notes
            <br/>
            <ul>
            `
            i.boq_info.notes.map((j,index) => {
                _print +=`<li> ${index+1}) ${j.boq_note_notes}</li>`
               
            })
           
            _print += "</ul></td></tr>"          
            
        })        

        document.getElementById("dipboq").innerHTML = _print;
    }

    $scope.upate_boq_refno = function() {
        let req = {
            naf_user: userinfo,
            project_no: project_id,
            boq_refno: $("#boq_refno").val(),
            boq_revision: $("#boq_revision").val(),
        };
        $http.post(api_url + "Project/update_boq_ref.php", req)
            .then(
                function(response) {

                    if (response.data.msg == "1") {
                        alert("updated");
                        _reload();
                    } else {
                        alert(response.data.data);
                    }
                }
            )
    }

    // var modal = document.getElementById("myModal");
    // var modal_close = document.getElementById("close_modal");
    // $scope.save_boq_notes = function(boqno) {
    //     modal.style.display = "block";
    //     $scope.boq_item_no_notes = boqno;
    // }
    // modal_close.onclick = function() {
    //     modal.style.display = "none";
    // }
    // window.onclick = function(event) {
    //     if (event.target == modal) {
    //         modal.style.display = "none";
    //     }
    // }

    $scope.boq_notes_new = function() {
        var post_data = {
            naf_user: userinfo,
            project_no: project_id,
            boq_item_no: $scope.boq_item_no_notes,
            boq_notes: $scope.boq_notes,
        }

        $http({
            method: 'post',
            data: post_data,
            url: api_url + 'Boq/notes_add.php',
        }).then(
            (res) => {
                if (res.data.msg === "1") {
                    alert("saved");
                    project_boq(project_id, project_boq_refno, project_boq_revision);
                    $scope.boq_notes = "";
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    $scope.rmv_notes = function(ids) {

        var post_data = {
            naf_user: userinfo,
            notes_id: ids
        };

        $http({
            method: 'post',
            data: post_data,
            url: api_url + "Boq/notes_remove.php"
        }).then(
            (res) => {
                if (res.data.msg === "1") {
                    alert("Removed");
                    project_boq(project_id, project_boq_refno, project_boq_revision);
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    //search items

    all_ptype()

    function all_ptype() {
        var post_data = {
            naf_user: userinfo
        };
        var req = $http.post(api_url + "Ptype/index.php", post_data);
        req.then(
            function(res) {
                if (res.status == 200) {
                    if (res.data.msg === "1") {
                        $scope._ptype = res.data.data;
                    } else {
                        alert(res.data.data);
                    }
                } else {
                    alert("Server Connection error....");
                }

            }
        )
    }

    all_systemType();

    function all_systemType() {
        var post_data = {
            naf_user: userinfo
        };

        var req = $http.post(api_url + "SysType/index.php", post_data);
        req.then(
            res => {
                if (res.data.msg === "1") {
                    $scope._systype = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }
    all_systemFinish();

    function all_systemFinish() {
        var post_data = {
            naf_user: userinfo,
        }
        $http.post(api_url + "SysFinish/index.php", post_data)
            .then(
                function(res) {
                    if (res.data.msg === "1") {
                        $scope._sysFinish = res.data.data;
                    } else {
                        alert(res.data.data);
                    }
                }
            )
    }
    $scope.isbusynow = false;
    var dia_boqitemsnew = document.getElementById("boqitemsnew");
    $scope.boqnotenew = function() {
        dia_boqitemsnew.style.display = "block"
    }

    async function BoqItemsAll() {
        var datas = {
            naf_user: userinfo,
            notesprojectcode: project_id

        };

        console.log(datas);

        var post_data = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(datas)
        }
        const response = await fetch(api_url + "Boq/boqnotes/index.php", post_data);
        return response.json();
    }


    function getboqitemallsfun() {
        var datas = {
            naf_user: userinfo,
            notesprojectcode: project_id

        };
        $http({
            url: api_url + "Boq/boqnotes/index.php",
            data: datas,
            method: "post"

        }).then(
            (res) => {
                console.log(res.data);
                if (res.data.msg === "1") {
                    $scope.ksboqitemsnotes = res.data.data;
                }
            }
        )
    }


    $scope.savenewboqnotes = function() {
        console.log("itw working");
        $scope.isbusynow = true;
        var fd = {
            naf_user: userinfo,
            newboqitems: $scope.newboqnotes,
            notesprojectcode: project_id
        };

        saveUserinfos(fd)
            .then(
                res => {
                    console.log(res)
                    if (res.msg === "1") {
                        alert("saved");
                        document.getElementById("boqnotesnews").reset();
                        getboqitemallsfun();
                    } else {
                        alert(res.data);
                    }
                    $scope.isbusynow = false;
                }
            ).catch((error) => {
                console.log(error);
            })

    }

    async function saveUserinfos(fd = {}) {
        var post_data = {
            method: "post",
            mode: 'cors',
            cache: 'no-cache',
            body: JSON.stringify(fd),
            headers: {
                'Content-Type': 'application/json'
            }
        };

        const req = await fetch(api_url + "Boq/boqnotes/new.php", post_data);
        //console.log(req.text());
        return req.json();
    }

    async function RemoveBoqitems(fd = {}) {
        var post_data = {
            method: "post",
            mode: "cors",
            cache: 'no-cache',
            body: JSON.stringify(fd),
            headers: {
                'content-type': 'application/json'
            }
        };

        const req = await fetch(api_url + "Boq/boqnotes/remove.php", post_data);
        return req.json();
    }

    $scope.removen = (id) => {
        var c = confirm("Are Your Sure Delete This?");
        if (c) {
            var fd = {
                naf_user: userinfo,
                ids: id
            };
            RemoveBoqitems(fd).then(
                res => {
                    console.log(res);
                    if (res.msg === "1") {
                        alert("Removed");
                        getboqitemallsfun();
                    } else {
                        alert(res.data);
                    }
                }
            )
        }

    }

    $scope.spitemnotesedit = (items) => {
        $("#dia_boqitemsEdits").css('display', 'block');
        $scope.boqitemsEdit = items;
    }

    $scope.Editboqnotes = () => {
        var post_data = {
            naf_user: userinfo,
            notesid: $scope.boqitemsEdit.notesid,
            notesdescription: $scope.boqitemsEdit.notesdescription,
            notesimportats: $scope.boqitemsEdit.notesimportats
        };

        EditInfos(post_data).then(
            (res) => {
                console.log(res.data);
                if (res.data.msg === "1") {
                    alert("save");
                    getboqitemallsfun();
                } else {
                    alert(res.data.data);
                }
            }
        )
    }
    async function EditInfos(data = {}) {
        var req = await $http.post(api_url + "Boq/boqnotes/edit.php", data);
        return req;
    }

    get_all_units();

    function get_all_units() {
        let post_data = {
            naf_user: userinfo
        };

        var req = $http.post(api_url + "Units/index.php", post_data);
        req.then(
            res => {

                if (res.data.msg === "1") {

                    $scope._units = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    $scope.area_cal = function($event) {

        if ($event.which !== 13) {
            $scope._item_area = _area_calc($scope.new_boq.item_width, $scope.new_boq.item_height, 2)

        }
    }

    $scope.price_calc = function($event) {
        if ($event.which !== 13) {
            $scope._itemTprice = _area_calc($scope.new_boq.item_Uprice, $scope.new_boq.item_qty, 2)
        }
    }

    let isProcessBoq = false;

    $scope.boq_new_save = function () {
        if (!isProcessBoq) {
            isProcessBoq = true;
            var post_data = {
                naf_user: userinfo,
                new_boq: $scope.new_boq,
                poq_project_code: project_id,
                ref_no: $scope.viewproject.project_boq_refno,
                rev_no: $scope.viewproject.project_boq_revision,
                notesitems: $scope._notess
            };
            $http.post(api_url + "Boq/new.php", post_data)
                .then(
                    function (res) {
                        isProcessBoq = false;
                        console.log(res.data);
                        if (res.data.msg === "1") {
                            alert("saved..");
                            reload();
                        } else {
                            alert(res.data.data);
                        }
                    }
                );
        } else {
            alert("Anohter Process Is Running....");
        }
    }

    $scope._notess = [];

    $scope.addnewnotes = () => {
        _addNotesBoq();
    }

    function _addNotesBoq(){
        var nwval = $("#notesnew").val();
        if (nwval !== '') {
            var dub = $scope._notess.includes(nwval);
            if (dub) {
                alert("dublicate found")
            } else {
                $scope._notess.push(nwval);
                $("#notesnew").val('');
            }
        }
    }

    $scope.remove = (item) => {
        $scope._notess.splice(item, 1)
    }

    $scope.type_new = function() {
        var post_data = {
            naf_user: userinfo,
            ptype_name: $scope.ptype_name
        };
        var req = $http.post(api_url + "Ptype/new.php", post_data);
        req.then(
            res => {

                if (res.data.msg === "1") {
                    alert("saved");
                    $scope.ptype_name = "";
                    all_ptype();

                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    $scope.finish_new = function() {
        var post_data = {
            naf_user: userinfo,
            system_finish: $scope.finish_name
        };
        $http.post(api_url + "SysFinish/new.php", post_data)
            .then(
                function(res) {
                    if (res.data.msg == "1") {
                        alert("saved");
                        $scope.finish_name = "";
                        all_systemFinish();
                    } else {
                        alert(res.data.data);
                    }
                }
            )
    }

    $scope.system_new = function() {
        var post_data = {
            naf_user: userinfo,
            system_name: $scope.system_name
        };

        var req = $http.post(api_url + "SysType/new.php", post_data)
            .then(
                function(res) {
                    if (res.data.msg === "1") {
                        alert("Saved..");
                        $scope.system_name = "";
                        all_systemType();
                    } else {
                        alert(res.data.data);
                    }
                }
            )
    }

    $scope.unit_new = function() {
        var post_data = {
            naf_user: userinfo,
            unit_name: $scope.unit_name
        };
        var req = $http.post(api_url + "Units/new.php", post_data);
        req.then(
            res => {
                if (res.data.msg === "1") {
                    alert("saved");
                    get_all_units();
                    $scope.unit_name = "";

                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    $scope.getboqinfosfroedit = (id) => {

        let post_data = {
            naf_user: userinfo,
            project_no: project_id,
            item_no: id
        };


        $http.post(api_url + "Boq/get.php", post_data)
            .then(
                (res) => {
                    //console.log(res.data);
                    if (res.data.msg === "1") {
                        console.log(res.data.data);
                        $scope.edit_boq = res.data.data;
                        $scope._item_area_edit = _area_calc1($scope.edit_boq.item_width, $scope.edit_boq.item_height, 2)
                        $scope._itemTprice_edit = _area_calc1($scope.edit_boq.item_Uprice, $scope.edit_boq.item_qty, 2)
                    } else {
                        //console.log("not working");
                    }
                }
            );
        document.getElementById('dianewboqEdit').style.display = 'block';
    }



    $scope.area_cal1 = function($event) {

        if ($event.which !== 13) {
            $scope._item_area_edit = _area_calc($scope.edit_boq.item_width, $scope.edit_boq.item_height, 2)

        }
    }

    $scope.price_calc1 = function($event) {
        if ($event.which !== 13) {
            $scope._itemTprice_edit = _area_calc($scope.edit_boq.item_Uprice, $scope.edit_boq.item_qty, 2)
        }
    }



    $scope.boq_edit_save = function() {
        var post_data = {
            naf_user: userinfo,
            new_boq: $scope.edit_boq,
            poq_project_code: project_id,
            ref_no: $scope.viewproject.project_boq_refno,
            rev_no: $scope.viewproject.project_boq_revision,
        };
        console.log(post_data);
        $http.post(api_url + "Boq/update.php", post_data)
            .then(
                function(res) {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        alert("saved..");
                        reload();
                    } else {
                        alert(res.data.data);
                    }
                }
            );
    }

    $scope.save_boq_notes = (boqno) => {
        document.getElementById('boq_notes_new').style.display = 'block';
        $scope.boq_item_no_notes = boqno;
    }

    $scope.boq_notes_new = () => {
        var post_data = {
            naf_user: userinfo,
            project_no: project_id,
            boq_item_no: $scope.boq_item_no_notes,
            boq_notes: $scope.boq_notes,
        }

        $http({
            method: 'post',
            data: post_data,
            url: api_url + 'Boq/notes_add.php',
        }).then(
            (res) => {
                if (res.data.msg === "1") {
                    alert("saved");
                    project_boq(project_id, project_boq_refno, project_boq_revision);
                    $scope.boq_notes = "";
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    $scope.boqItemNoAutoCompleate = [];
    $scope.boqItemRemarkAutoCompleate = [];
    $scope.boqItemDescription = [];
    $scope.boqItemGlassSpecification = [];
    $scope.boqItemGlassSingle = [];
    $scope.boqItemGlassDouble1 = [];
    $scope.boqItemGlassDouble2 = [];
    $scope.boqItemGlassDouble3 = [];
    $scope.boqItemGlassLaminate1 = [];
    $scope.boqItemGlassLaminate2 = [];
    $scope.boqItemDrawing = [];
    $scope.boqItemNotes = [];
    boq_autocompleate();
    function boq_autocompleate() {
        $scope.boqItemNoAutoCompleate = [];
        $scope.boqItemRemarkAutoCompleate = [];
        $scope.boqItemDescription = [];
        $scope.boqItemGlassSpecification = [];
        $scope.boqItemGlassSingle = [];
        $scope.boqItemGlassDouble1 = [];
        $scope.boqItemGlassDouble2 = [];
        $scope.boqItemGlassDouble3 = [];
        $scope.boqItemGlassLaminate1 = [];
        $scope.boqItemGlassLaminate2 = [];
        $scope.boqItemDrawing = [];
        $scope.boqItemNotes = [];
        const post_data = {
            url : `${api_url}autoc/boq.php`,
            method : "GET",
            headers : {
                'content-type' : undefined
            }
        };

        const req = $http(post_data);

        req.then(
            res =>{
                console.log(res.data);
                if(res?.data?.msg === '1'){
                    $scope.boqItemNoAutoCompleate = res?.data?.data?.itemno ?? [];
                    $scope.boqItemRemarkAutoCompleate = res?.data?.data?.itemremark ?? [];
                    $scope.boqItemDescription = res?.data?.data?.description ?? [];
                    $scope.boqItemGlassSpecification = res?.data?.data?.glassspecification ?? [];
                    $scope.boqItemGlassSingle = res?.data?.data?.glasssingle ?? [];
                    $scope.boqItemGlassDouble1 = res?.data?.data?.double1 ?? [];
                    $scope.boqItemGlassDouble2 = res?.data?.data?.double2 ?? [];
                    $scope.boqItemGlassDouble3 = res?.data?.data?.double3 ?? [];
                    $scope.boqItemGlassLaminate1 = res?.data?.data?.laminate1 ?? [];
                    $scope.boqItemGlassLaminate2 = res?.data?.data?.laminate2 ?? [];
                    $scope.boqItemDrawing = res?.data?.data?.drawing ?? [];
                    $scope.boqItemNotes = res?.data?.data?.notes ?? [];

                }else {
                    alert("something wrong in api.... check Console");
                    console.error(`Api Error - ${res.data}`);
                }
            }
        )
    }
    $scope.mr_title = "M.R";
    const mr_dia = document.getElementById("mr_dia");
    mr_dia.style.display = 'none';
    $scope.mrlist = [];
    $scope.getboqinfo = async (id) => {
        $scope.mr_title = "M.R";
        console.log(id);
        const mr = await import('../../Main/mr/js/services/mr.js').then(r => new r.default);
        const fd = mr.FormData();
        fd.append('mrboqno', id);
        const res = await mr.apicall(fd, 'mrboq');
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        mr_dia.style.display = 'flex';
        $scope.mrlist = res.data;
        $scope.$apply();
        console.log(res);
       
        
    }
    $scope.isshowmiscellaneousitems = false;
    _getmisc_count();
    async function _getmisc_count() {
        $scope.isshowmiscellaneousitems = false;
        const mr = await import('../../Main/mr/js/services/mr.js').then(r => new r.default);
        const fd = mr.FormData();
        fd.append("mrproject", sessionStorage.getItem("nafco_project_current_sno"));
        const res = await mr.apicall(fd, 'getmiscellaneousecnt');
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        if ((+res.data) !== 0) {
            $scope.isshowmiscellaneousitems = true;
        }
    }
    
    $scope.show_miss_items = async () => {
        $scope.mr_title = "M.R Miscellaneouse Items";
        const mr = await import('../../Main/mr/js/services/mr.js').then(r => new r.default);
        const fd = mr.FormData();
        fd.append("mrproject", sessionStorage.getItem("nafco_project_current_sno"));
        const res = await mr.apicall(fd, 'getmiscellaneouse');
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }

        mr_dia.style.display = 'flex';
        $scope.mrlist = res.data;
        $scope.$apply();
        console.log(res);
    }

    document.getElementsByName("notesnew")[0].addEventListener('keydown',(e)=>{
        if(e.which === 13){
            _addNotesBoq();
            $scope.$apply();
        }
    })

    $scope.excelexport=function(tableId){ // ex: '#my-table'
        $scope.exportHref=Excel.tableToExcel(tableId,'sheet name');
        $timeout(function(){location.href=$scope.fileData.exportHref;},100); // trigger download
    }
 
})

function _area_calc1(no1, no2, digits) {
    //console.log("wk", no1, no2);
    var _no1 = parseFloat(no1);
    var _no2 = parseFloat(no2);
    var x = _no1 * _no2;
    //console.log(x);
    return x
}