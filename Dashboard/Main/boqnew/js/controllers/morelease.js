import MRservices from "../../../mr/js/services/mr.js";

export default function morelease($scope) {
    
    //get boq item list
    $scope.boqlist = [];
    getAllBoqItems();
    async function getAllBoqItems() {
        $scope.boqlist = [];
        const mrs = await import("../../../mr/js/services/mr.js").then((x) => new x.default());
        const fd = mrs.FormData();
        fd.append("project_enc", sessionStorage.getItem("nafco_project_current"));
        const res = await mrs.apicall(fd, "getboq");
        
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.boqlist = [];
            $scope.$apply();
            return;
        }
        $scope.boqlist = res.data;
        $scope.$apply();
        return;
    }

    $scope.selectcurrentboqitem = (x) => {
        console.log(x);
    }

    async function getBoqInfo(boqid) {
        const mrs = await import("../../../mr/js/services/mr.js").then((x) => new x.default());
        const fd = mrs.FormData();
    }
   
}