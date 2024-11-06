import TechnicalSubmitalSerices from "../services/index.js";
export default function technicalsubmitalnew($scope, $http, $routeParams) {
    console.log($routeParams);
    const mode = $routeParams?.mode || 'n';
    console.log(mode);
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
    $scope.ts = _defaultts();
    function _defaultts() {
       const _ = {
            isloading: false,
            mode : mode,
            data: {
                techsub_id: "",
                techsub_project: "",
                techsub_number: "",
                techsub_rvno: "",
                techsub_date: _currentdate(),
                techsub_purpose: $scope.purpose,
                techsub_remarks: $scope.remarks,
                techsub_submittedby: "",
                techsub_subdate: _currentdate(),
                techsub_status: "",
                techsub_statusdate: "",
                techsub_remarksdt: "",
                techsub_description: "",
                techsub_spctype: "",
                techsub_qty: "",
                techsub_cby: "",
                techsub_eby: "",
                techsub_cdate: "",
                techsub_edate: "",
                techsub_extra: "",
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
                        techsub_project: $scope.viewproject?.project_id ?? 0,
                        ///techsub_submittedby: $scope.viewproject?.Sales_Representative ?? "no",
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


    $scope.mainitem = {
        mainitem: "",
        categorylist : [],        
    };
    $scope.mainitemlist = [];

    $scope.category = {
        categoryname: "",
        subcategorylist: []
    };
    $scope.categorylist = [];

    $scope.subcategory = {
        subcategoryname:"",
    };
    $scope.subitemsubsystemlist = [];
    $scope.btntitle = "Save & Print";
    if (mode === 'e') {
        $scope.btntitle = "Update & Print";
        const _params = JSON.parse(localStorage.getItem("pms_print_techsubmital_frm"));
        const comments = _params.commands;
        let lcommend = [];
        comments.map(i => lcommend.push(i.tscc_notes));
        console.log(lcommend);
        $scope.ts = {
            ...$scope.ts,
            data: _params.submital,
            commands: lcommend,
            list: [...$scope.ts.list],
            mode : mode,
        }

        $scope.ts = {
            ...$scope.ts,
            data: {
                ...$scope.ts.data,
                techsub_date: _params.submital.techsub_date_n,
                techsub_subdate : _params.submital.techsub_subdate_n,
            }
        }
        console.log(_params);
        $scope.purpose = JSON.parse(_params.submital.techsub_purpose);
        $scope.remarks = JSON.parse(_params.submital.techsub_remarks);
        $scope.mainitemlist = JSON.parse(_params.submital.techsub_extra);
        
       // $scope.$apply();
        console.log($scope.mainitemlist);
    }

    function _addtospeclist() {
        const tsspclistdescription = document.getElementById("tsspclistdescription");
        const tsspclistnotes = document.getElementById("tsspclistnotes");
        if (tsspclistdescription.value.trim() === "") {
            tsspclistdescription.focus();
            return;
        }

        // if (tsspclistnotes.value.trim() === "") {
        //     tsspclistnotes.focus();
        //     return;
        // }
        let tsspclistx = {};
        tsspclistx = {
            tsspclistdescription: tsspclistdescription.value,
            tsspclistnotes: tsspclistnotes.value === "" ? "-" : tsspclistnotes.value,
        }

        $scope.ts = {
            ...$scope.ts,
            data: { ...$scope.ts.data },
            commands: [...$scope.ts.commands],
            list: [...$scope.ts.list, tsspclistx]
        }

        $scope.tsspclist = {
            tsspclistdescription: "",
            tsspclistnotes: ""
        }
        tsspclistdescription.focus();
        return;

    }
    $scope.speclist_keydown = ($event) => {
        console.log($event.which);
        if ($event.which === 13) {
            _addtospeclist();
            return;
        }
    }

    function _addcommands() {
        const tscommands = document.getElementById("tscommands");
        if (tscommands.value.trim() === "") {
            tscommands.focus();
            return;
        }
        $scope.ts = {
            ...$scope.ts,
            data: { ...$scope.ts.data },
            commands: [...$scope.ts.commands, tscommands.value],
            list: [...$scope.ts.list]
        }

        $scope.tscommands = "";
        return;

    }

    $scope.tscommands_keydown = ($event) => {
        if ($event.which === 13) {
            _addcommands();
            return;
        }
    }

    $scope.save_ts = async () => {
        if ($scope.ts.isloading) return;
        if ($scope.ts.mode === "n") {
            await _savets();
            return;
        }
        await _updatets();
        return;
    }

    async function _updatets() {
        const _validate = frmvalidate();
        if (!_validate) return;
        $scope.ts = {
            ...$scope.ts,
            list: [...$scope.ts.list],
            commands: [...$scope.ts.commands],
            data: {
                ...$scope.ts.data,
                techsub_purpose: $scope.purpose,
                techsub_remarks: $scope.remarks,
                techsub_extra : JSON.stringify($scope.mainitemlist)
            }
        };
        const fd = tss.FormData();
        fd.append("payload", JSON.stringify($scope.ts));
        $scope.ts = {
            list: [...$scope.ts.list],
            commands: [...$scope.ts.commands],
            data : {...$scope.ts.data},
            ...$scope.ts,
            isloading : false,
        }
        const res = await tss.updatets(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.ts = {
                list: [...$scope.ts.list],
                commands: [...$scope.ts.commands],
                data : {...$scope.ts.data},
                ...$scope.ts,
                isloading : false,
            }
            $scope.$apply();
            return;
        }
        ///$scope.ts = _defaultts();
        localStorage.removeItem("pms_print_techsubmital_frm");
        localStorage.setItem("pms_print_techsubmital_frm", JSON.stringify(res.data));
        window.open(`${print_location}/sprint/index.html`, "_blank", "width=1200px;height=600px");       
        
        $scope.$apply();
       // alert("Data Has Updated");
        return;
        
    }
    const frmvalidate = () => {
        const techsub_number = document.getElementById("techsub_number");
        const techsub_rvno = document.getElementById("techsub_rvno");
        const techsub_date = document.getElementById("techsub_date");
        const techsub_submittedby = document.getElementById("techsub_submittedby");
        const techsub_subdate = document.getElementById("techsub_subdate");
        const techsub_remarksdt = document.getElementById("techsub_remarksdt");
        const techsub_description = document.getElementById("techsub_description");
        const techsub_spctype = document.getElementById("techsub_spctype");
        const techsub_qty = document.getElementById("techsub_qty");

        if (techsub_number.value.trim() === "") {
            alert("Enter Submital No");
            techsub_number.focus();
            return false;
        }

        if (techsub_rvno.value.trim() === "") {
            alert("Enter Revision No");
            techsub_rvno.focus();
            return false;
        }

        if (techsub_date.value.trim() === "") {
            alert("Enter Submital Date");
            techsub_date.focus();
            return false;
        }

        if (techsub_qty.value.trim() === "") {
            alert("Enter Qty");
            techsub_qty.focus();
            return false;
        }

        if (isNaN(techsub_qty.value)) {
            alert("Qty value is not a number");
            techsub_qty.focus();
            return false;
        }

        if (techsub_description.value.trim() === "") {
            alert("Enter Item Description");
            techsub_description.focus();
            return false;
        }

        if (techsub_remarksdt.value.trim() === "") {
            alert("Enter Item Remarks");
            techsub_remarksdt.focus();
            return false;
        }

        if (techsub_spctype.value.trim() === "") {
            alert("Enter Dwg./ Spec. Referance");
            techsub_spctype.focus();
            return false;
        }

        if (techsub_submittedby.value.trim() === "") {
            alert("Enter Submital By");
            techsub_submittedby.focus();
            return false;
        }

        if (techsub_subdate.value.trim() === "") {
            alert("Enter Date of Submital");
            techsub_subdate.focus();
            return false;
        }

        let _empyt = true;
        $scope.mainitemlist.map(i => {
            if (i.mainitem.toString().trim() === "") {
                _empyt = false;
            }

            i.categorylist.map(j => {
                if (j.categoryname.toString().trim() === "") {
                    _empyt = false;
                }
                j.subcategorylist.map(k => {
                    if (k.name.toString().trim() === "") {
                        _empyt = false
                    }
                })
            })

        })
        if (!_empyt) {
            alert("Check Some Items not Entered Data");
            return false;
        }
        return true;
    }
    async function _savets() {
        const _validate = frmvalidate();
        if (!_validate) return;
        $scope.ts = {
            ...$scope.ts,
            list: [...$scope.ts.list],
            commands: [...$scope.ts.commands],
            data: {
                ...$scope.ts.data,
                techsub_purpose: $scope.purpose,
                techsub_remarks: $scope.remarks,
                techsub_extra : JSON.stringify($scope.mainitemlist)
            }
        };
        const fd = tss.FormData();
        fd.append("payload", JSON.stringify($scope.ts));
        $scope.ts = {
            list: [...$scope.ts.list],
            commands: [...$scope.ts.commands],
            data : {...$scope.ts.data},
            ...$scope.ts,
            isloading : false,
        }
        const res = await tss.savets(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.ts = {
                list: [...$scope.ts.list],
                commands: [...$scope.ts.commands],
                data : {...$scope.ts.data},
                ...$scope.ts,
                isloading : false,
            }
            $scope.$apply();
            return;
        }
        // $scope.ts =  {
        //     list: [...$scope.ts.list],
        //     commands: [...$scope.ts.commands],
        //     data : {...$scope.ts.data},
        //     ...$scope.ts,
        //     isloading : false,
        // }
        $scope.ts = _defaultts();
        localStorage.removeItem("pms_print_techsubmital_frm");
        localStorage.setItem("pms_print_techsubmital_frm", JSON.stringify(res.data));
        window.open(`${print_location}/sprint/index.html`,"_blank","width=1200px;height=600px");
        alert("Data Has Saved");
        $scope.$apply();
        return;
    }

    $scope.removecommand = (x) => {
        $scope.ts.commands.splice(x, 1);        
    }
    $scope.removelist = (x) => {
        $scope.ts.list.splice(x, 1);        
    }

    const dia_items = document.getElementById("dia_items");
    const dia_subcategory = document.getElementById("dia_subcategory");
    const dia_category = document.getElementById("dia_category");

    
    dia_items.style.display = "none";
    dia_subcategory.style.display = "none";
    dia_category.style.display = "none";


    $scope.addsubitems = () => {
        dia_items.style.display = "flex";        
        $scope.mainitem = {
            mainitem: "",
            categorylist: []
        };
    }
    $scope.addnewcategory = () => {
        dia_category.style.display = "flex"; 
        console.log($scope.mainitem);
        $scope.itemname = $scope.mainitem.mainitem;
        $scope.category = {
            categoryname: "",
            subcategorylist: []
        };
    }
    $scope.additemsubcategory = () => {
        $scope.categoryname = $scope.category.categoryname;
        dia_subcategory.style.display = "flex";    
        $scope.subcategory = {
            subcategoryname: "",
            subitemsubsystemlist: []
        };
    }

   

    $scope.addtosubcategory = ($event) => {
        if ($event.which === 13) {
            console.log("working")

            const subcategoryname = document.getElementById("subcategoryname");
            if (subcategoryname.value === "") {
                alert("Enter Sub Cvalueateogry");
                return;
            }
            const subitem = {
                name : subcategoryname.value,
            }
            $scope.subitemsubsystemlist.push(subitem);
            $scope.subcategory.subcategoryname = "";
            
        }
        
    }
    $scope.removesubitem = (index) => {
        $scope.subitemsubsystemlist.splice(index,1)
    }

    $scope.removemainitem = (index) => {
        $scope.mainitemlist.splice(index,1)
    }

    $scope.removesubitems = (index) => {
        $scope.mainitem.categorylist.splice(index,1)
    }

    $scope.removesubitemlist = (i,index) => {
        console.log(i,index);
        console.log($scope.mainitemlist)
        $scope.mainitemlist.find(x=> i.mainitem.toLowerCase() === x.mainitem.toLowerCase()).categorylist.splice(index,1)
    }
    $scope.removesubcategroyitemlist = (i,j,index) => {        
        $scope.mainitemlist.find(
            x => i.mainitem.toLowerCase() === x.mainitem.toLowerCase()
        ).categorylist.find(
            x => j.categoryname.toLowerCase() === x.categoryname.toLowerCase()
        ).subcategorylist.splice(index, 1);
    }

    

    $scope.addtocategoylist = () => {
        _addtocategoylist();
        dia_subcategory.style.display = "none";
    }   

    

    function _addtocategoylist() {
        $scope.category = {
            ...$scope.category,
            subcategorylist: $scope.subitemsubsystemlist
        };
        $scope.subitemsubsystemlist = [];      
        console.log("category",$scope.category);
    }
    
    $scope.addtoitemlist = () => {
        _addtoitemlist()
        dia_category.style.display = "none";
    }

    $scope.addtoitemlist_keydown = ($event) => {
        if ($event.which === 13) {           
            _addtoitemlist();
            $scope.category = {
                categoryname: "",
                subcategorylist: []
            };
        }
    }

    function _addtoitemlist() {
        $scope.mainitem = {
            ...$scope.mainitem,
            categorylist : [...$scope.mainitem.categorylist,$scope.category],        
        };
        console.log("main item",$scope.mainitem);
    }

    $scope.additeminmainlist = () => {
        $scope.mainitemlist.push($scope.mainitem);
        console.log("main item List", $scope.mainitemlist);
        dia_items.style.display = "none";
    }

    $scope.additemmainlist = ($event) => {
        if ($event.which === 13) {
            $scope.mainitemlist.push($scope.mainitem);
            console.log("main item List", $scope.mainitemlist);
            $scope.mainitem = {
                mainitem: "",
                categorylist: []
            };
        }
    }

    function _xaddtomainlist() {
        let newitem = {
            mainitem: "",
            categorylist: []
        };

        $scope.mainitemlist.push(newitem);
    }
    $scope.addnewitemslist_keydown_maintable = ($event) => {
        if ($event.which === 13) {
            _xaddtomainlist();
            return; 
        }
    }
    $scope.addcategoryforthisitem = ($event, i) => {
        if ($event.which === 45) {
            _xaddtomainlist();
            return;
        }
        if ($event.ctrlKey && $event.which === 78) {
            e.preventDefault();
            let newitem = {
                mainitem: "",
                categorylist: []
            };

            $scope.mainitemlist.push(newitem);
            return;
            
        }
        console.log($event.which)
        if ($event.which === 13) {
            let category = {
                categoryname: "",
                subcategorylist: []
            };            
            $scope.mainitemlist.find(x => i.mainitem.toLowerCase() === x.mainitem.toLowerCase()).categorylist.push(category);
            return;
        }
       
    }
    
    $scope.addsubcategoryforthiscategory = ($event, i, j) => {
        if ($event.which === 13) {
            let subitems = {
                name: "",
            };
            $scope.mainitemlist.find(
                x => i.mainitem.toLowerCase() === x.mainitem.toLowerCase()
            ).categorylist.find(
                x => j.categoryname.toLowerCase() === x.categoryname.toLowerCase()
            ).subcategorylist.push(subitems);
        }
    }
    
    $scope.addnewsubitemthiscategory = ($event, i, j) => {
    
        if ($event.which === 13) {
            let subitems = {
                name: "",
            };
            $scope.mainitemlist.find(
                x => i.mainitem.toLowerCase() === x.mainitem.toLowerCase()
            ).categorylist.find(
                x => j.categoryname.toLowerCase() === x.categoryname.toLowerCase()
            ).subcategorylist.push(subitems);
        }
    }
}