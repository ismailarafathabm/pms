import cuttinglistservices from "../../../cuttinglist/js/services/index.js";
export default function boqsummary($scope, $http) {
    $scope.currentuser = userinfo['user_name'];
    $scope.withdetails = "1";
    const eng = new cuttinglistservices();
    let finaldata = [];
    $scope.rpttype = "1";    
    $scope.ispageloading = false;
    get_projectinfo();
    function get_projectinfo() {
        let project_id = sessionStorage.getItem("nafco_project_current");
        let post_data = {
            naf_user: userinfo,
            project_no: project_id,
        };
        //var req = $http.post(api_url + "Project/view.php", post_data);
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
                GetBoqs();
            } else {
                alert(res.data.data);
                window.location.href = `${print_location}/Dashboard/Main/index.php`;
            }
        });
    }


    $scope.boqitemssummary = [];
    $scope.boqsummary = {
        totqty: 0,
        totarea: 0,
        eng_qty: 0,
        eng_area: 0,
        eng_bal_qty: 0,
        eng_bal_area: 0,
        pres: 0,
        presbal : 0,
    }
    async function GetBoqs() {
        const _pjno = sessionStorage.getItem("nafco_project_current");
        const res = await eng.GET('boqneng/boqsummary.php?projectno=' + _pjno);
        if (res?.msg !== 1) {
            alert("Error on Getting BOQ Items.");
            return;
        }
        let _boq_qty = 0;
        let _eng_rel = 0;
        let _eng_bal = 0;

        let totqty = 0;
        let totarea = 0;
        let eng_qty = 0;
        let eng_area = 0;
        let eng_bal_qty = 0;
        let eng_bal_area = 0;
        
        res.data.map(i => {
            let qtys = ['POWDER COATED (RAL 8019)', 'NO.', 'POWDER COATED - RAL 9005', 'TON'];
            _boq_qty += (+i.poq_qty);
            _eng_rel += (+i.eng_qty);
            if (qtys.includes(i.unit_name)) {
                totqty += (+i.poq_qty);
                eng_qty += (+i.eng_qty);                
            } else {
                totarea += (+i.poq_qty);    
                eng_area += (+i.eng_qty);                
            }
            if ((+i.poq_qty) > (+i.eng_qty)) {
                _eng_bal += (+i.poq_qty) - (+i.eng_qty) 
            }
        })

        console.log(_boq_qty, _eng_rel, _eng_bal);
        
        let _totqty = (+totqty) + (+totarea);  
        
        eng_bal_qty = (+totqty) - (+eng_qty);
        eng_bal_area = (+totarea) - (+eng_area);

        let _engqty = (+eng_qty) + (+eng_area);
        let _engqtyx = (+eng_bal_qty) + (+eng_bal_area);
        //let prs = (+_engqty) / (+_totqty) * 100;
        //let presbal = ((+_engqtyx) / (+_totqty) * 100 * -1);
        let prs = (+_eng_rel) / (+_boq_qty) * 100;
        let presbal = (+_eng_bal) / (+_boq_qty) * 100; 
        $scope.boqsummary = {
            totqty: totqty,
            totarea: totarea,
            eng_qty: eng_qty,
            eng_area: eng_area,
            eng_bal_qty: eng_bal_qty,
            eng_bal_area: eng_bal_area,
            pres: prs,
            presbal : presbal,
        }
        console.log($scope.boqsummary);
        finaldata = res.data;
        $scope.boqitemssummary = res.data;
        $scope.$apply();
        return;
    }
    function alldata() {
        $scope.boqitemssummary = finaldata;
    }
    function balancedata() {
        $scope.boqitemssummary = finaldata.filter(i => (+i.eng_qty) < (+i.poq_qty));
    }
    function releasedata() {
        $scope.boqitemssummary = finaldata.filter(i => (+i.eng_qty) !== 0);
    }
    function freleasedata() {
        $scope.boqitemssummary = finaldata.filter(i => (+i.eng_qty) === (+i.poq_qty));
    }
    $scope.filterData = () => {
        let _fitlerby = $scope.rpttype ?? "1";
        switch (_fitlerby) {
            case "1":
                alldata()
                return;
            case "2":
                balancedata()
                return;
            case "3":
                releasedata()
                return;
            case "4":
                freleasedata()
                return;
            default: return;
        }
        console.log("o");
    }
    $scope.show_eng_release_dia = {
        diashow: false,
        dialoading: false,    
        currentboq_release: []
    };
    
    $scope.getreleaseinfo = async (id) => {
        if ($scope.show_eng_release_dia.dialoading) return;
        
        $scope.show_eng_release_dia = {
            ...$scope.show_eng_release_dia,
            dialoading: true,
            currentboq_release: []
        };
        
        const res = await eng.GET('boqneng/releaseget.php?boqid=' + id);
        if (res?.msg !== 1) {
            $scope.show_eng_release_dia = {
                ...$scope.show_eng_release_dia,
                dialoading: false,                
            };
            $scope.$apply();
            alert(res.data);
            return;
        } 
        $scope.show_eng_release_dia = {
            diashow: true,
            dialoading: false,    
            currentboq_release:res.data         
        };        
        $scope.$apply();
        return;
    }

    $scope.printResult = () => {
        const titles = {
            '1': 'BOQ - ENGINEERING ALL SUMMARY',
            '2': 'BOQ - ENGINEERING BALANCE SUMMARY',
            '3': 'BOQ - ENGINEERING RELEASE SUMMARY',
            '4': 'BOQ - ENGINEERING WITHOUT BALANCE SUMMARY',
        };
        const title = titles[$scope.rpttype] ?? 'BOQ ENGGINEERING SUMMARY';
        localStorage.setItem("boq_eng_summary_title", title);
        localStorage.setItem("boq_eng_summary", JSON.stringify($scope.boqitemssummary))
        localStorage.setItem("boq_eng_summary_tot", JSON.stringify($scope.boqsummary))
        localStorage.setItem("boq_projectinfo", JSON.stringify($scope.viewproject))
        localStorage.setItem("boq_print_withdt", $scope.withdetails);
        let printwindow = window.open(`${print_location}/sprint/boqengsummary.html`, '_blank', "width:1300px;height:700px");
    }

    $scope.removeboqr = async (id) => {        
        if ($scope.ispageloading) return;
        const c = confirm("Are You Sure Remove?");
        if (!c) return;
        $scope.ispageloading = true;
        const res = await eng.GET('boqneng/engrremove.php?boqid=' + id);
        if (res['msg'] !== 1) {
            alert(res['data']);
            $scope.ispageloading = false;
            $scope.$apply();
            return;
        }
        alert(res['data']);
        $scope.ispageloading = false;
        location.reload();
        //$scope.$apply();       
        return;
    }
}
