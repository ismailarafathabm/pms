import _ from './controllers/trades.js';
import _uc from './controllers/unit.js'
export default function Trades_controller($scope, $rootScope, $compile) {
    function _msgoff() {        
        $scope.res.display = false;
        $scope.$apply();
    }
    const tc = new _();
    const _msg = (d,t,msg = "") => {
        let icon = t === "n" ? "fa fa-exclamation-circle" : "fa fa-info-circle";
        let theme = t === "n" ? "ism-dialog-input-error" : "ism-dialog-input-success";

        $scope.res = {
            display: d,
            theme: theme,
            icon: icon,
            msg : msg
        }
        setTimeout(_msgoff, 2000);
    }

    $scope.newtradegroup = {
        isloading: false,
        list: []
    };
    $scope.newunitgroups = {
        isloading: false,
        list: []
    };
    _DefalutLoads();
    async function _DefalutLoads() {
        tc.getAllTradeGroup();
    }
}