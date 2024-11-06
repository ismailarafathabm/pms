import GlassOrderServices from '../services/index.js';
import * as models from './models.js';
export default function goviewp($scope, $http, $compile) {
    let access = {};
    const gos = new GlassOrderServices();
    const columnDefs = models.aliprojectgoview($scope, access, $compile);
    const gridOptions = gos.gridoptions(columnDefs);
    const gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);
    
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
                //console.log($scope.viewproject);
                localStorage.removeItem("currentproject");
                localStorage.setItem("pms_currentproject", JSON.stringify($scope.viewproject));

                //console.log($scope.viewproject);
                $scope.newproject = res.data.data;
                GetRowCount($scope.newproject.project_no);
                //console.log($scope.ts);
                //LoadReports(res.data.data.project_no);
                //LoadData(res.data.data.project_no)
                // GetRowCount(res.data.data.project_no);
            } else {
                alert(res.data.data);
            }
        });
    }

    $scope.gosdata = [];
    $scope.isrptloading = false;
    let splitval = 500;
    let rowcount = 0;

    async function GetRowCount(project_no) {
        console.log(project_no);
        const res = await gos.GET(`gos/indexp.php?goproject=${project_no}`);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        rowcount = (+res.data);
        let splitcount = rowcount / splitval;
        let rowstart = [];
        let n = 0;
        rowstart.push(n);
        for (var i = 0; i < splitcount; i++) {
            n = n + splitval;
            rowstart.push(n)
        }

        LoadReports(rowstart, project_no)
        $scope.$apply();
    }

    async function LoadReports(x, project_no) {
        $scope.isrptloading = true;
        let _griddatas = [];
        x.map(async (i) => {
            const res = await fetchDatas(i, project_no);
            res.data.map(k => {
                _griddatas.push(k);
            })

            if (_griddatas.length === rowcount) {
                $scope.isrptloading = false;
                gridOptions.api.setRowData(_griddatas);
                $scope.$apply();
            }

        })
    }

    async function fetchDatas(sno, project_no) {
        const res = await gos.GET(`gos/gosp.php?limitr=${sno}&goproject=${project_no}`);
        return res;
    }


    $scope.removego = async (goid) => {
        const c = confirm("Are You Sure Remove This GO?");
        if (!c) return;
        const rc = confirm("Are your Re conform to Remove This GO?");
        if (!rc) return;
        const res = await gos.GET(`gos/remove.php?goid=${goid}`);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        alert("Data Has Removed");
        GetRowCount($scope.newproject.project_no);
        $scope.$apply();
        return;
    }


    $scope.goedit = (id) => {
        localStorage.setItem("pms_go_goid", id);
        window.location.href = `${print_location}/Dashboard/Main/index.php#!/goeditp`
    }
    $scope.goupload = {
        diashow: false,
        isloading: false,
        id: 0
    };
    $scope.uploadmox = (id) => {
        $scope.goupload = {
            diashow: true,
            isloading: false,
            id: id
        };
    }

    $scope.uploadgosubmit = async () => {
        if ($scope.goupload.isloading) return;
        const fd = new FormData(
            document.getElementById("uploadgo")
        );
        $scope.goupload = {
            ...$scope.goupload,
            isloading: true,
        };
        const res = await gos.POST(`cuttinglists/gopdf.php?goid=${$scope.goupload.id}`, fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.goupload = {
                ...$scope.goupload,
                isloading: false,
            };
            $scope.$apply();
            return;
        }
        alert("Data has Updated");
        GetRowCount($scope.newproject.project_no);
        $scope.goupload = {
            ...$scope.goupload,
            isloading: false
        };
        $scope.$apply();
        return;
    }

    $scope.exportExcel = function () {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            let excelfilename = "Glass Order List";
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();

            var param = {
                fileName: excelfilename,
                sheetName: "SHEET1",
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }

}