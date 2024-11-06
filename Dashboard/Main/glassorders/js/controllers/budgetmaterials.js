import _ from './../services/budgetmaterials.js';
export default function budgetmaterials($scope, $http, $rootScope, $compile, $filter) {
    const bms = new _();
    $scope.materialslist = [];
    autocompleatematerials();
    async function autocompleatematerials() {
        const res = await bms.autocompleatematerials();
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        $scope.materialslist = res.data ?? [];
        $scope.$apply();
        return;
    }

    document.getElementById("dia_material_budget").style.display = "none";
    let _type = "1";
    function _newmatierls() {
        $scope.newmaterialbudget = {
            ...$scope.newmaterialbudget,
            isloading: false,
            mode: "N",
            title: "Add New Material Budget",
            btn: "Save",
            data: {
                ...$scope.newmaterialbudget.data,
                bmid: "0",
                bmtype: '',
                bmqty: '',
                bmeprice: '',
                bmeval: '',
                bmdiscountval: '',
                bmunit: '',
                bmmaterialtype: "",
                bmdiscountprice : ""
            }
        };
        document.getElementById("dia_material_budget").style.display = "flex";
        document.getElementById("bmtype").focus();
    }
    $scope.newmaterialbudget_click = () => {
        _type = "1";
        _newmatierls()  
    }
    $scope.newmaterialbudgets_click = () => {
        _type = "2";
        _newmatierls()  
    }

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
                console.log($scope.viewproject);
                $scope.newproject = res.data.data;

            } else {
                alert(res.data.data);
            }
        });
    }

    //gird options

    const gridDiv = document.querySelector('#myGrid');
    var filterParams = {
        comparator: function (filterLocalDateAtMidnight, cellValue) {
            var dateAsString = cellValue;
            var dateParts = dateAsString.split('-');
            var cellDate = new Date(
                Number(dateParts[0]),
                Number(dateParts[1]) - 1,
                Number(dateParts[2])
            );

            if (filterLocalDateAtMidnight.getTime() === cellDate.getTime()) {
                return 0;
            }

            if (cellDate < filterLocalDateAtMidnight) {
                return -1;
            }

            if (cellDate > filterLocalDateAtMidnight) {
                return 1;
            }
        },
    };
    const username = userinfo.user_name;
    const _priceaccessusers = ['demo','sam', 'nabil', 'hani', 'AbuZaid', 'nimnim', 'estimation', 'estimations'];
    const user_addnew = ['nimnim', 'estimation', 'estimations', 'demo'];   
    
    $scope.access = {
        priceview: _priceaccessusers.includes(username),
        newbutton : user_addnew.includes(username),
    };
    const columnDefs = bms.colsdef($scope, $compile, $scope.access);
    const gridOptions = bms.gridoptions(columnDefs);
    function dateComparator(date1, date2) {
        var date1Number = monthToComparableNumber(date1);
        var date2Number = monthToComparableNumber(date2);

        if (date1Number === null && date2Number === null) {
            return 0;
        }
        if (date1Number === null) {
            return -1;
        }
        if (date2Number === null) {
            return 1;
        }

        return date1Number - date2Number;
    }

    function monthToComparableNumber(date) {
        if (date === undefined || date === null || date.length !== 10) {
            return null;
        }

        var yearNumber = date.substring(6, 10);
        var monthNumber = date.substring(3, 5);
        var dayNumber = date.substring(0, 2);

        var result = yearNumber * 10000 + monthNumber * 100 + dayNumber;
        return result;
    }
    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);
    $scope.isrptloading = false;
    getprojectmaterials();
    $scope.sum = {
        cost: 0,
        area: 0
    };
    function sumoffcalc(datas) {
        let _cost = 0;        
        datas.map(i => {
            _cost += (+i.bmdiscountval);
        })
        $scope.sum = {
            cost: _cost,
            area: 0
        };
    }

    async function getprojectmaterials() {
        $scope.isrptloading = true;
        const fd = bms.FormData();
        $scope.sum = {
            cost: 0,
            area: 0
        };
        fd.append("bmproject", sessionStorage.getItem("nafco_project_current_sno"));
        const res = await bms.budgetmaterialsbyproject(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isrptloading = false;
            $scope.$apply();
            return;
        }
        $scope.isrptloading = false;
        gridOptions.api.setRowData(res.data ?? []);
        sumoffcalc(res.data);
        $scope.$apply();
        return;
    }

    //-main form actiosn
   
    $scope.newmaterialbudget = {
        isloading: false,
        mode: "N",
        title: "Add New Material Budget",
        btn: "Save",
        data: {
            bmid: "0",            
            bmrefno: '001',
            bmproject: sessionStorage.getItem("nafco_project_current_sno"),
            bmtype: '',
            bmqty: '',
            bmeprice: '',
            bmeval: '',
            bmdiscountval: '',
            bmunit: '',
            bmmaterialtype: '',
            bmdiscountprice : ""
        }
    };

    $scope.calcactions = () => {
        const bmqty = document.getElementById("bmqty").value.trim() === "" ? 0 : document.getElementById("bmqty").value.trim();
        const bmeprice = document.getElementById("bmeprice").value.trim() === "" ? 0 : document.getElementById("bmeprice").value.trim();
        const bmeval = (+bmqty) * (+bmeprice);
        const discountval = $scope.newmaterialbudget?.data?.bmdiscountprice ?? 0;
        const dicountval = (+bmeval) - (+discountval);
        $scope.newmaterialbudget = {
            ...$scope.newmaterialbudget,
            data: {
                ...$scope.newmaterialbudget.data,
                bmeval: Math.round(bmeval),
                bmdiscountval : Math.round(dicountval)
            }
        };
    }

    $scope.save_budgetmaterial_save_submit = async() => {
        if ($scope.newmaterialbudget.isloading) {
            console.log("Already Process is Running...");
            return;
        }
        if ($scope.newmaterialbudget.mode === "N") {
            await _savematerialbudget();
            return;
        }

        await _updatematerialbudget();
        return;
    }
    $scope.editinfo = async (x) => {
        if ($scope.newmaterialbudget.isloading) {
            console.log("Process Is Running....");
            return;
        }
        document.getElementById("dia_material_budget").style.display = "flex";
        const fd = bms.FormData();
        fd.append("bmid", x);
        $scope.newmaterialbudget = {
            ...$scope.newmaterialbudget,
            data: {
                ...$scope.newmaterialbudget.data,
            },
            isloading : true,
        }
        const res = await bms.budgetmaterialsbybmid(fd);
        if (res?.msg !== 1) {
            $scope.newmaterialbudget = {
                ...$scope.newmaterialbudget,
                data: {
                    ...$scope.newmaterialbudget.data,
                },
                isloading: false,                
            }
            _msg(true, 'n', res.data);
            $scope.$apply();
            return;
        }

        
        _type = res.data.budgettype;
        $scope.newmaterialbudget = {
            ...$scope.newmaterialbudget,
            data: {
                ...$scope.newmaterialbudget.data,                                             
                bmid: res.data.bmid,
                bmtype: res.data.bmtype,
                bmqty: res.data.bmqty,
                bmeprice: res.data.bmeprice,
                bmeval: res.data.bmeval,
                bmunit : res.data.bmunit,
                bmdiscountval: res.data.bmdiscountval,
                bmmaterialtype: res.data.bmmaterialtype,
                bmdiscountprice: res.data.bmdiscountprice,
                budgetNo : res.data.budgetNo
            },
            isloading: false,
            btn: 'Update',
            title: "Edit Material Budget",
            mode : "E",
        }
        $scope.$apply();
        return;
    }
    async function _savematerialbudget() {
        const fd = bms.FormData();        
        fd.append("bmrefno", $scope.newmaterialbudget.data.bmrefno);
        fd.append("bmproject", $scope.newmaterialbudget.data.bmproject);
        fd.append("bmtype", $scope.newmaterialbudget.data.bmtype);
        fd.append("bmqty", $scope.newmaterialbudget.data.bmqty);
        fd.append("bmeprice", $scope.newmaterialbudget.data.bmeprice);
        fd.append("bmeval", $scope.newmaterialbudget.data.bmeval);
        fd.append("bmdiscountval", $scope.newmaterialbudget.data.bmdiscountval);
        fd.append("bmunit", $scope.newmaterialbudget.data.bmunit);
        fd.append('bmmaterialtype', $scope.newmaterialbudget.data.bmmaterialtype);
        fd.append('bmdiscountprice', $scope.newmaterialbudget.data.bmdiscountprice);
        fd.append('budgettype',_type);
        fd.append('budgetNo', $scope.newmaterialbudget.data.budgetNo);

        $scope.newmaterialbudget = {
            ...$scope.newmaterialbudget,
            data: {
                ...$scope.newmaterialbudget.data,
            },
            isloading : true,
        }
        const res = await bms.newbudgetmaterials(fd);
        console.log(res);
        if (res?.msg !== 1) {
            $scope.newmaterialbudget = {
                ...$scope.newmaterialbudget,
                data: {
                    ...$scope.newmaterialbudget.data,
                },
                isloading: false,
            };
            _msg(true, 'n', res.data);
            $scope.$apply();
            return;
        }

        $scope.newmaterialbudget = {
            ...$scope.newmaterialbudget,
            data: {
                ...$scope.newmaterialbudget.data,
                bmid: "0",                              
                bmtype: '',
                bmqty: '',
                bmeprice: '',
                bmeval: '',
                bmunit : '',
                bmdiscountval: '',
                bmmaterialtype: '',
                bmdiscountprice : '',
            },
            isloading: false,
        };
        _msg(true, 't', 'Data Has Saved');              
        gridOptions.api.setRowData(res.data ?? []);
        sumoffcalc(res.data);
        $scope.$apply();
        document.getElementById("bmtype").focus();
        return;
    }

    async function _updatematerialbudget() {
        const fd = bms.FormData();                        
        fd.append("bmproject", $scope.newmaterialbudget.data.bmproject);
        fd.append("bmtype", $scope.newmaterialbudget.data.bmtype);
        fd.append("bmqty", $scope.newmaterialbudget.data.bmqty);
        fd.append("bmeprice", $scope.newmaterialbudget.data.bmeprice);
        fd.append("bmeval", $scope.newmaterialbudget.data.bmeval);
        fd.append("bmdiscountval", $scope.newmaterialbudget.data.bmdiscountval);
        fd.append("bmunit", $scope.newmaterialbudget.data.bmunit);
        fd.append("bmid", $scope.newmaterialbudget.data.bmid);
        fd.append('bmmaterialtype', $scope.newmaterialbudget.data.bmmaterialtype);
        fd.append('bmdiscountprice', $scope.newmaterialbudget.data.bmdiscountprice);
        fd.append('budgettype', _type);
        fd.append('budgetNo', $scope.newmaterialbudget.data.budgetNo);

        $scope.newmaterialbudget = {
            ...$scope.newmaterialbudget,
            data: {
                ...$scope.newmaterialbudget.data
            },
            isloading: true,
        };

        const res = await bms.updatebudgetmaterials(fd);
        if (res?.msg !== 1) {
            $scope.newmaterialbudget = {
                ...$scope.newmaterialbudget,
                data: {
                    ...$scope.newmaterialbudget.data
                },
                isloading: false,
            };    
            _msg(true, 'n', res.data);
            $scope.$apply();
            return;
        }
        $scope.newmaterialbudget = {
            ...$scope.newmaterialbudget,
            data: {
                ...$scope.newmaterialbudget.data
            },
            isloading: false,
        };    
        _msg(true, 't', "Data Has Updated");
        sumoffcalc(res.data);
        gridOptions.api.setRowData(res.data ?? []);
        $scope.$apply();
    }

    $scope.bgmtypes = [];
    allmaterialtypes();
    async function allmaterialtypes() {
        $scope.bgmtypes = [];
        const res = await bms.bgmtypes();
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }

        $scope.bgmtypes = res.data;
        $scope.$apply();
        return;

    }

    $scope.printfrm = () => {
        localStorage.removeItem("pms_budget_summary_print");
        localStorage.removeItem("pms_budget_summary_project");
        let printdata = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(i => {
            printdata.push(i.data);
        });
        let prj = $scope.viewproject;
        localStorage.setItem("pms_budget_summary_print", JSON.stringify(printdata));
        localStorage.setItem("pms_budget_summary_project", JSON.stringify(prj));
        window.open(`${print_location}/fprint/#!/budgetmaterials`, "_blank", "width:1200px;height:500px");
    }


    $scope.excelexport = () => {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();
            var mname = `BUDGET MATERIALS`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }


}