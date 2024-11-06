import GlassOrderServices from "../services/index.js";
export default function GoEnggnew($scope) {
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
    
    const gos = new GlassOrderServices();
    $scope.gosuppleirs = [];
    $scope.goglasstype = [];
    $scope.goglassspec = [];
    $scope.gomarking = [];
    $scope.remarks = [];
  
    GetGoAutoCompleate();
    async function GetGoAutoCompleate() {
        const res = await gos.GET('gos/goauto.php');
        $scope.gosuppleirs = [];
        $scope.goglasstype = [];
        $scope.goglassspec = [];
        $scope.gomarking = [];
        $scope.remarks = [];
        $scope.godoneby = [];
        if (res?.msg !== 1) {
            return;
        }
        $scope.gosuppleirs = res?.data?.gosuppleirs;
        $scope.goglasstype = res?.data?.goglasstype;
        
        $scope.goglassspec = res?.data?.goglassspec;
        $scope.gomarking = res?.data?.gomarking;
        $scope.remarks = res?.data?.remarks;
        $scope.godoneby =  res?.data?.godoneby;
        $scope.$apply();
        return;
    }

    $scope.newgo = {
        goid: "",
        goprojectid: '0',
        goproject: '',
        goprojectname: '',
        goprojectlocation: '',
        gonumber: '',
        gosupplier: '',
        goglasstype: '',
        goglassspec: '',
        gomarking: '',
        goqty: '',
        goarea: '',
        godoneby: '',
        godate: '',
        gopflag: '0',
        goprelease: '',
        gopreturn: '',
        remarks: '',
        gocostingflag: '0',
        gocostingrelease: '',
        gocosingreturn: '',
        othersdesc: '',
        gotype: '1',
        gootype : '1'
    }

    let currentproject = "";
    $scope.getolddatas = async () => {   
        
        const pjno = document.getElementById("goproject").value;
        if (pjno === '') return;
        currentproject = pjno;
        await GetLastData()
    }
    async function GetLastData() {
        const res = await gos.GET(`gos/golast.php?pjno=${currentproject}`);
        console.log(res);
        if (res?.msg !== 1) {            
            return;
        }
        console.log(res);
        $scope.newgo = res.data;
       
        console.log(res.data);
        $scope.newgo = {
            ...$scope.newgo,
            goprelease: res.data.goprelease_d.normal,
            gopreturn  : res.data.gopreturn_d.normal,
            godate: res.data.godate_d.normal,
            gocostingrelease: res.data.gocostingrelease_d.normal,
            gocosingreturn : res.data.gocostingrelease_d.normal,
        }
        $scope.$apply();
        return;
    }

    $scope.saveCt = async () => {       
        const fd = new FormData();
        fd.append("payload", JSON.stringify($scope.newgo));
        const res = await gos.POST('gos/newgo.php', fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        currentproject =  $scope.goproject;
        $scope.newgo = {
            goid: "",
            goprojectid: '0',
            goproject: '',
            goprojectname: '',
            goprojectlocation: '',
            gonumber: '',
            gosupplier: '',
            goglasstype: '',
            goglassspec: '',
            gomarking: '',
            goqty: '',
            goarea: '',
            godoneby: '',
            godate: '',
            gopflag: '0',
            goprelease: '',
            gopreturn: '',
            remarks: '',
            gocostingflag: '0',
            gocostingrelease: '',
            gocosingreturn: '',
            othersdesc: '',
            gotype: '1',
            gootype : '1'
        }
       
        $scope.$apply();     
        GetLastData()
        return;
    }

}