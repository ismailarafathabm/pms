import GlassOrderServices from "../services/index.js";
export default function goedit($scope) {
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
    
    $scope.currentproject = {};

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
        gootype: '1',
        rgono:'',
    }

   
    GetGoInfo();
    async function GetGoInfo() {
        const goid = localStorage.getItem("pms_go_goid");
        if (!goid || goid === '') {
            alert("Error on getting data");
            return;
        }

        const res = await gos.GET(`gos/goget.php?goid=${goid}`);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        $scope.newgo = res.data;
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

    $scope.UpdateGO = async () => {
        const fd = new FormData();
        fd.append("payload", JSON.stringify($scope.newgo));
        const res = await gos.POST(`gos/updatex.php?goid=${$scope.newgo.goid}`, fd);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        alert("Data Has updated");
        return;
    }
}