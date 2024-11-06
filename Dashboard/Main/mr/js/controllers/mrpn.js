import Mrservices from "../services/mrs.js";
export default function mrpn($scope) {
    const mrs = new Mrservices();
    //calculations
    $scope.calbyqty = true;
    $scope.calbyweght = false;
    //calc die weight
    $scope.calc_ord_wight = () => {
        let mrrdieweight = $scope.mrrnew?.data?.mrrdieweight ?? 0;
        let mrritemlength = $scope.mrrnew?.data?.mrritemlength ?? 0;
        let mrordqty = $scope.mrordqty ?? 0;
        let mrordwt = (+mrrdieweight * +mrritemlength * +mrordqty) / 1000
        $scope.mrordwt = mrordwt;
    }
    $scope.calby = (val) => {
        if (val === 'q') {
            $scope.calbyqty = true;
            $scope.calbyweght = false;
        } else {
            $scope.calbyqty = false;
            $scope.calbyweght = true;
        }
        _calcfunction();
    }
    function _calcfunction() {
        let mrrdieweight = $scope.mrrnew?.data?.mrrdieweight ?? 0;
        let mrritemlength = $scope.mrrnew?.data?.mrritemlength ?? 0;
        let mrrqty = $scope.mrrnew?.data?.mrrqty ?? 0;
        let mrrweight = (+mrrdieweight * +mrritemlength * +mrrqty) / 1000;

        //calc for price

        let mrrunitprice = $scope.mrrnew?.data?.mrrunitprice ?? 0;
        let totprice = $scope.calbyqty ? (+mrrunitprice * +mrrqty) : (+mrrunitprice * +mrrweight)
        console.log(totprice);
        //calc for others
        let mrrothers = $scope.mrrnew?.data?.mrrothers ?? 0;
        let mrrectipsubtotal = (+totprice + +mrrothers)

        $scope.mrrnew = {
            ...$scope.mrrnew,
            data: {
                ...$scope.mrrnew.data,
                mrrweight: mrrweight,
                mrrtprice: totprice,
                mrrectipsubtotal: mrrectipsubtotal
            }
        }
    }
    $scope.calc_receipt_weight = () => {
        _calcfunction();
    }

    //loading actions

    //load rm projects
    loadProjects();
    $scope.srcprojectlist = [];
    async function loadProjects() {
        const res = await mrs.GET('mr/mrproject.php');
        $scope.srcprojectlist = [];
        if (res?.msg !== 1) {
            return;
        }
        $scope.srcprojectlist = res.data;
        $scope.$apply();
        return;
    }

    ///dialog for project

    let project_autocompleate = document.getElementById("project_autocompleate");
    project_autocompleate.style.display = "none";
    let mritems_autocompleate = document.getElementById("mritems_autocompleate");
    mritems_autocompleate.style.display = "none";

    $scope.showprojectdialgo = () => {
        mritems_autocompleate.style.display = "none";
        project_autocompleate.style.display = "flex";
        document.getElementById("projectfilter").focus();
    }
    $scope.currentselectedproject = {};
    document.getElementById("projectfilter").addEventListener('keydown', (event) => {
        console.log(event.which);
        if (event.which === 27) {
            $scope.projectfilter = "";
            project_autocompleate.style.display = "none";
            document.getElementById("srcproject").focus();
        }
        
    })
    $scope.selectcurrent = (x) => {
        $scope.currentselectedproject = x;
        $scope.projectfilter = "";
        project_autocompleate.style.display = "none";
        document.getElementById("srcmrno").focus();
        console.log($scope.currentselectedproject);
        let projectdisplay = `${x.project_no} - ${x.project_name}`;
        $scope.srcproject = projectdisplay;
        projectMrs();
    }
    //mr 
    $scope.projectmrs = [];
    $scope.selectedmr = "";
    async function projectMrs() {
        $scope.projectmrs = [];
        $scope.srcmrno = "";
        const res = await mrs.GET(`mr/projectmrs.php?mrproject=${$scope.currentselectedproject.project_id}`);
        if (res?.msg !== 1) {
            alert(res?.data);
            return;
        }
        
        res.data.map(x => {
            if (!$scope.projectmrs.includes(x.mrno)) {
                $scope.projectmrs.push(x.mrno)
            }
        });

        $scope.$apply();
        return;
    }
   
    $scope.mritems = [];
    $scope.currentmritem = {};
    async function LoadMrITems() {
        $scope.mritems = [];
        $scope.currentmritem = {};
        const res = await mrs.GET(`mr/mritems.php?mrproject=${$scope.currentselectedproject.project_id}&mrno=${$scope.selectedmr}`);
        if (res?.msg !== 1) {
            return;
        }
        $scope.mritems = res.data;
        $scope.$apply();
    }
    $scope.getMritems = () => {
        if (!$scope.srcmrno) return;
        $scope.selectedmr = $scope.srcmrno;
        LoadMrITems();
    }

    //mr items show and hide code

    

    $scope.searchshow_mritems = ($event) => {
        project_autocompleate.style.display = "none";
        if (!$scope.srcmrno) return;
        mritems_autocompleate.style.display = "flex";
        document.getElementById("mritemfilters").focus();
    }

    document.getElementById("mritemfilters").addEventListener("keydown", (e) => {
        if (e.which === 27) {
            mritems_autocompleate.style.display = "none";
            document.getElementById("srcmritems").focus();
            return;
        }
        
    })

    $scope.mrrnew = {
        isloading: false,
        mode : 1,
        data: {
            mrid: '',
            mrreciptno : '',
            mrrdate : '',
            mrrsupplier : '',
            mrrpartno : '',
            mrrdescription : '',
            mrrdieweight : '',
            mrritemlength : '',
            mrrqty : '',
            mrrweight : '',
            mrrpricecal : '',
            mrrunitprice : '',
            mrrtprice : '',
            mrrothers : '',
            mrrectipsubtotal : '',
            mrreceiptflag : '',
            mrrprojectid : ''         
        }
    }

    $scope.selectmritem = (x) => {
        mritems_autocompleate.style.display = "none";
        $scope.currentmritem = x;
        console.log($scope.mrrnew);
        $scope.srcmritems = x.mrpartno;
        $scope.mrrnew = {
            ...$scope.mrrnew,
            data: {
                ...$scope.mrrnew.data,
                mrrdescription: x.mritem,
                mrrdieweight: x.mrdieweight,
                mrritemlength: x.mrreqlength,
                mrordqty: x.mrorderedqty,
                mrordwt: x.mrorderedweight,
            }
        }
        document.getElementById("mrrqty").focus();
    }

        //save action
    
        //validation

    
    
    function  _validate(ctrl){        
        if (ctrl.value === "") {
            ctrl.focus();
            return 0;
        }
        return 1;
    }

    function qtycheck() {
        const required_qty = 0;
        const old_receipt = 0;
        const new_receipt = 0;
        const tot_receipt = (+old_receipt) + (+new_receipt);
        return required_qty <= tot_receipt ? 1 : 0;
    }

    async function SaveAction() {
      
        
    }

    $scope.procurementreceipt_submit = () => {
        
    }


}