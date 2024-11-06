import cuttinglistservices from "../services/index.js";
export default function cuttinglistsupdates($scope) {
    const cts = new cuttinglistservices();
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


    $scope.listitems = [];
    getAlldatas()

    async function getAlldatas() {
        const items = localStorage.getItem("ctlist");
        console.log(JSON.parse(items));
        if (!items || items === undefined) {
            return;
        }
        $scope.listitems =  JSON.parse(items);
        //$scope.$apply();
    }   

    $scope.remove_item = (index) => {
        $scope.listitems.splice(index, 1);
    }

    $scope.updatetype = "account"
    $scope.newct = {
        account_flag: '0',
        account_release : '',
        account_return: '',
        
        matterial_flag: '0',
        material_release: '',
        material_return: '',
        materialstatus: '',
        materialrefno: '',

        operation_flag: '0',        
        operation_release: '',
        operation_return: '',
        
        production_flag: '0',
        production_release: '',
        production_accept : ''        
    }
    //update actions
    $scope.isupdateing = false;

    $scope.saveCt = async () => {
        if ($scope.isupdateing) return;
        const fd = new FormData();
        fd.append("ct", JSON.stringify($scope.listitems));
        fd.append('updatetype', $scope.updatetype);
        fd.append("ctupdate", JSON.stringify($scope.newct));
        $scope.isupdateing = true;
        const res = await cts.POST("cuttinglists/bulkupdate.php", fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isupdateing = false;
            $scope.$apply();
            return;
        }

        alert("Updated");
        $scope.isupdateing = false;
        $scope.$apply();

    }

}