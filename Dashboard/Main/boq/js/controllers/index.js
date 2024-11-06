import cuttinglistservices from "../../../cuttinglist/js/services/index.js";
export default function boqope($scope, $http,$routeParams) {
    const boq = new cuttinglistservices();
    $scope.showboq_referance = false;
    get_projectinfo();
    function get_projectinfo() {
        let project_id = sessionStorage.getItem("nafco_project_current");
        let post_data = {
            naf_user: userinfo,
            project_no: project_id,
        };
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
                _getProjectBoq(
                    $scope.viewproject.project_no_enc,
                    $scope.viewproject.project_boq_refno,
                    $scope.viewproject.project_boq_revision,
                );
                document.title = "BOQ For" + $scope.viewproject.project_name;
            } else {
                alert(res.data.data);
                window.location.href = `${print_location}/Dashboard/Main/index.php`;
            }
        });
    }
    $scope.withdetails = "1";
    $scope.isloading = false;
    $scope.boqs = [];
    $scope.showboqtype = false;
    async function _getProjectBoq(pj, rno, rvno) {
        if ($scope.isloading) return;
        $scope.isloading = true;
        let res;
        if (!$routeParams.type) {
            $scope.showboqtype = true;
            res = await boq.GET(`boqop/allboq.php?projectno=${pj}`);
        } else {
            $scope.showboqtype = false;
            $scope.showboq_referance = true;
            res = await boq.GET(`boqop/contractboq.php?projectno=${pj}`);
        }
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.isloading = false;
            $scope.$digest();
            return;
        }
        $scope.boqs = res.data;
        $scope.isloading = false;
        $scope.$digest();
        return;
    }
}