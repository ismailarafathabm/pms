import TechnicalSubmitalSerices from "../services/index.js";
export default function shopdrawingsubmitalnew($scope, $http) {
    document.getElementById("approvals_menu").classList.add('menuactive');
    const tss = new TechnicalSubmitalSerices();
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

    let username = _username;
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    function _currentdate() {
        let _date = new Date();
        let _d = _date.getDate();
        let _m = _date.getMonth() + 1;
        let _y = _date.getFullYear();
        if (_m.toString().length === 1) {
            _m =`0${_m}`;
        }
        if (_d.toString().length === 1) {
            _d = `0${_d}`;
        }
        let _day = `${_d}-${_m}-${_y}`;
        return _day;
    }
    $scope.purpose = {
        approval: false,
        furtheractions : false,
        review : false,
        comments : false,
        informations : false,
        sample : false,        
    }
    $scope.remarks = {
        drawing : false,
        technicalsubmital : false,
        hardwaresubmital : false,
        calculation : false,
        prequalification : false,
        sample : false,        
    }
    $scope.tsspclist = {
        tsspclistdescription: "",
        tsspclistnotes: ""
    }
    $scope.tscommands = "";
    console.log("Error");

    $scope.tsdt = {
        dsdt_id: "",
        dsdt_project: "",
        dsdt_dsid: "",
        dsdt_dsqty: "",
        dsdt_drawingno: "",
        dsdt_remarks: "",
        dsdt_editby: "",
        dsdt_editdate: "",
        dsdt_description : "",
    };

    $scope.tsdt_list = [];
    console.log($scope.tsdt_list)

    $scope.ts = _defaultts();
    function _defaultts() {
       const _ = {
            isloading: false,
            mode : 1,
            data: {
                ds_id: "",
                ds_project: "",
                ds_submitalno: "",
                ds_rvno: "",
                ds_date: _currentdate(),
                ds_purpose: $scope.purpose,
                ds_remark: $scope.remarks,
                ds_submittedby: username,
                ds_submitteddate: _currentdate(),
                ds_status: "",                
                ds_remarks: "",
                ds_cby: "",
                ds_eby : "",
                ds_cdate: "",
                ds_edate: "",
                ds_extra: "",               
            },
            list: [],
            commands: [],
        }

        return _;

      
        
    }

    get_projectinfo()
    function get_projectinfo() {
        $scope.ts = _defaultts();
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
                console.log($scope.viewproject);
                localStorage.removeItem("currentproject");
                localStorage.setItem("pms_currentproject", JSON.stringify($scope.viewproject));

                console.log($scope.viewproject);
                $scope.newproject = res.data.data;
                console.log($scope.ts);
                $scope.ts = {
                    ...$scope.ts,
                    data: {
                        ...$scope.ts.data,
                        ds_project: $scope.viewproject?.project_id ?? 0,                        
                    },
                    commands: [...$scope.ts.commands],
                    list: [...$scope.ts.list]
                };
                console.log($scope.ts);
               
            } else {
                alert(res.data.data);
            }
        });
    }

    $scope.addnewitemslist_keydown_maintable = ($event) => {
        if ($event.which === 13) {
            console.log("start");
            _addnewitemslist_keydown_maintable();
           
        }
    }

    $scope.addtolist_click = () => {
        _addnewitemslist_keydown_maintable();
    }

    function _addnewitemslist_keydown_maintable() {
        const dsdt_dsqty = $scope.tsdt?.dsdt_dsqty ?? "1";
        const dsdt_drawingno = $scope.tsdt?.dsdt_drawingno ?? "";
        const dsdt_description = $scope.tsdt?.dsdt_description ?? "";
        const dsdt_remarks = $scope.tsdt?.dsdt_remarks ?? "";
        
        if (dsdt_drawingno.toString().trim() === ""
            && dsdt_description.toString().trim() === ""
            && dsdt_remarks.toString().trim() === "") {
            alert("Fill All Informations");
            return;
        }
        let dub = $scope.tsdt_list.filter(x => x.dsdt_drawingno.toLowerCase() === dsdt_drawingno.toLowerCase());
        console.log(dub, dub.length);
        if(dub.length == 1)
        {
            alert("Already This Drawign Number Found");           
            return;
        }
        let newdata = {
            dsdt_dsqty : dsdt_dsqty === "" ? "1" : dsdt_dsqty,
            dsdt_drawingno: dsdt_drawingno,
            dsdt_description : dsdt_description,
            dsdt_remarks : dsdt_remarks,
        }
        console.log(newdata);
        $scope.tsdt_list.push(newdata);
        document.getElementById("dsdt_drawingno").focus();
        $scope.$apply();
        return;
        
    }

    $scope.remove_items = (i) => {
        $scope.tsdt_list.splice(i, 1);
    }

    const techsub_qty = document.getElementById("techsub_qty");
    const dsdt_drawingno = document.getElementById("dsdt_drawingno");
    const dsdt_description = document.getElementById("dsdt_description");
    const dsdt_remarks = document.getElementById("dsdt_remarks");

    techsub_qty.addEventListener("keyup", (e) => {
        if (e.which === 13 || e.which === 39) {
            dsdt_drawingno.focus();
        }        
    })
    dsdt_drawingno.addEventListener("keyup", (e) => {
        if (e.which === 13 || e.which === 39) {
            dsdt_description.focus();
        }      
        if (e.which === 37) {
            techsub_qty.focus();
        }
    })
    dsdt_description.addEventListener("keyup", (e) => {
        if (e.which === 13 || e.which === 39) {
            dsdt_remarks.focus();
        }      
        if (e.which === 37) {
            dsdt_drawingno.focus();
        }
    })

    dsdt_remarks.addEventListener("keyup", (e) => {
        if (e.which === 13) {
            _addnewitemslist_keydown_maintable();
        }      
        if (e.which === 37) {
            dsdt_description.focus();
        }
    })

    
    const itemlistdsdt = document.getElementsByName('itemlistdsdt');
    console.log(itemlistdsdt)
    for (var i; i <= itemlistdsdt.length; i++){
        itemlistdsdt[i].addEventListener("keyup", (e) => {
            console.log("owkring");
        })
    }

    function _validate() {
        const ds_submitalno = document.getElementById("ds_submitalno");
        const ds_rvno = document.getElementById("ds_rvno");
        const ds_date = document.getElementById("ds_date");
        const ds_submittedby = document.getElementById("ds_submittedby");
        const ds_submitteddate = document.getElementById("ds_submitteddate");
        console.log(ds_submitalno,ds_submitalno.value);
        if (ds_submitalno.value.toString().trim() === "") {
            alert("Enter Submital Number");
            ds_submitalno.focus();
            return false;
        }

        if (ds_rvno.value.toString().trim() === '') {
            alert("Enter Revision");
            ds_rvno.focus();
            return false;
        }

        if (ds_date.value.toString().trim() === '') {
            alert("Enter Date");
            ds_date.focus();
            return false;
        }

        if (ds_submittedby.value.toString().trim() === '') {
            alert("Enter Submitted By");
            ds_submittedby.focus();
            return false;
        }
        
        if (ds_submitteddate.value.toString().trim() === '') {
            alert("Enter Submital By");
            ds_submitteddate.focus();
            return false;
        }
        if ($scope.tsdt_list.length === 0) {
            alert("Enter Drawing Submitall Numbers")
            return false;
        }

        //empty check
        let _ishaveempty = false;
        $scope.tsdt_list.map(i => {            
            const _drawingno = i.dsdt_drawingno;
            const _descriptoin = i.dsdt_description;
            const _remarks = i.dsdt_remarks;

            if (
                _drawingno.trim() === "" && 
                _descriptoin.trim() === "" && 
                _remarks.trim() === "" 
            ) {
                _ishaveempty = true;
            }
        })

        if (_ishaveempty) {
            alert("Please Fill All Informations");
            return false;
        }
        

        let _drawingno = [];
        let _dubdrawing = false;
        let _dublicateDrawingno = "";
        $scope.tsdt_list.map(i => {
            if (i.dsdt_drawingno.toLowerCase() === "") {                
            } else {
                let x = _drawingno.includes(i.dsdt_drawingno.toLowerCase());
                if (x) {
                    _dublicateDrawingno = i.dsdt_drawingno.toLowerCase();
                    _dubdrawing = true;
                }
                _drawingno.push(i.dsdt_drawingno.toLowerCase());
            }
        });

        if (_dubdrawing) {
            alert(`Dublicate Drawing No Found '${_dublicateDrawingno}'`);
            return false;
        }

        return true;
    }
    $scope.save_ts = async () => {
        //console.log(_validate());
        if (!_validate()) {
            return;
        }

        const fd = tss.FormData();
        $scope.ts = {
            ...$scope.ts,
            data: {
                ...$scope.ts.data,
                ds_extra: JSON.stringify($scope.tsdt_list),
                ds_purpose: JSON.stringify($scope.purpose),
                ds_remark: JSON.stringify($scope.remarks),                
            }
        };
        
        fd.append("payload", JSON.stringify($scope.ts.data));

        const res = await tss.saveds(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        localStorage.removeItem("naf_print_submital_drawings")
        localStorage.setItem("naf_print_submital_drawings", JSON.stringify(res.data));
        window.open(`${print_location}/sprint/dgsubmital.html`,"_blank","width=1200px;height=600px");
        return;
    }

}

