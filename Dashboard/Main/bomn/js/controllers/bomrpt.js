import cuttinglistservices from "../../../cuttinglist/js/services/index.js";
import * as models from './models.js';
export default function nbomrpt($scope, $compile) {
    let _bomdata = [];
    const bom = new cuttinglistservices();
    let username = userinfo.user_name;
    const post_access = ['demo', 'john'];
    $scope.access = {
        post : post_access.includes(username)
    };
    const cols = models.cols($scope, $compile, $scope.access, 'A');
    const gridOptions = bom.gridoptions(cols);
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);
    let splitval = 500;
    let rowcount = 0;
    $scope.isrptloading = false;
    async function getrpt() {
        const res = await bom.GET(`bomn/index.php`);
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        rowcount = (+res.data);
        if (rowcount === 0) {
            _bomdata = [];
            gridOptions.api.setRowData([]);
            return;
        }

        let splitcount = rowcount / splitval;
        let rowstart = [];
        let n = 0;
        rowstart.push(n);
        for (var i = 0; i < splitcount; i++) {
            n = n + splitval;
            rowstart.push(n)
        }
        LoadReports(rowstart);
        $scope.$apply();
    }
    async function LoadReports(x) {
        $scope.isrptloading = true;
        let _griddatas = [];
        x.map(async (i) => {
            const res = await fetchDatas(i);
            res.data.map(k => {
                _griddatas.push(k);
            })
            gridOptions.api.setRowData(_griddatas);

            if (_griddatas.length === rowcount) {
                let sumof_qty = 0;
                let sumof_area = 0;
                gridOptions.api.forEachNodeAfterFilterAndSort(d => {
                    const i = d.data;
                    sumof_qty += (+i.ct_qty);
                    console.log(i.ct_area);
                    sumof_area += (+i.ct_area);
                })

                $scope.sumof = {
                    totitem: sumof_qty,
                    sumof_area: sumof_area,
                }
                _bomdata = _griddatas;
                $scope.isrptloading = false;
                $scope.$apply();
            }

        })
    }
    async function fetchDatas(sno,p) {
        const res = await bom.GET(`bomn/rpt.php?limit=${sno}`);
        return res;
    }
    getrpt();

    $scope.bominfo = {};
    $scope.bomlist = [];
    $scope.print_bom = (p, b) => {
        printbom(p,b);
    }
    
    async function printbom(p, b) {
        if ($scope.isrptloading) return;
        $scope.isrptloading = true;
        const res = await bom.GET(`bomn/get.php?bomno=${b}&project=${p}`);
        if (res?.msg !== 1) {
            $scope.isrptloading =false;
            alert(res.data);
            $scope.$apply();
            return;
        } 
        $scope.isrptloading =false;
        $scope.bomlist = res.data;
        $scope.$apply();  
        let xd = res.data.length === 0 ? {} : res.data[0];
        console.log(xd);
        $scope.bominfo = xd;
        printaction();        
    }

    function printaction() {
        console.log($scope.bominfo,$scope.bomlist);
        let nw = window.open(`${print_location}/sprint/bom.html`, '_blank', "width:1300px;height:700px")
        nw.bominfo = JSON.stringify($scope.bominfo);
        nw.bomlist = JSON.stringify($scope.bomlist);
    }

    $scope.bom_post = async (p, b) => {        
        if ($scope.isrptloading) return;
        const c = confirm('Are You Sure Post?');
        if (!c) return;
        $scope.isrptloading = true;
        const res = await bom.GET(`bomn/post.php?bomno=${b}&project=${p}`);
        if (res?.msg !== 1) {
            $scope.isrptloading =false;
            alert(res.data);
            $scope.$apply();
            return;
        } 
        $scope.isrptloading = false;
        alert("Data Has Posted");
        getrpt();
        $scope.$apply();
    }

    $scope.bom_unpost = async (p, b) => {        
        if ($scope.isrptloading) return;
        const c = confirm('Are You Sure Un-Post?');
        if (!c) return;
        $scope.isrptloading = true;
        const res = await bom.GET(`bomn/unpost.php?bomno=${b}&project=${p}`);
        if (res?.msg !== 1) {
            $scope.isrptloading =false;
            alert(res.data);
            $scope.$apply();
            return;
        } 
        $scope.isrptloading = false;
        alert("Data Has Posted");
        getrpt();
        $scope.$apply();
    }

    $scope.print_bomrpt = () => {
        let _data = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _data.push(_.data);
        })
        //localStorage.setItem("pms_boms", JSON.stringify(_data));
        let printwindow = window.open(`${print_location}/sprint/bomrpt.html`, '_blank', "width:1300px;height:700px");
        printwindow.pms_boms = JSON.stringify(_data);
        
    }
}