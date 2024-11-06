import WhServices from "../services/wh.js";
export default function bomadd($scope) {
    const ws = new WhServices();
    $scope.whitems = [];
    GetAllData();
    async function GetAllData(src = "") {
        $scope.whitems = [];
        const res = await ws.getRequest('stocks');
        $scope.whitems = res;
        $scope.$apply();
        return;
    }

    $scope.itemtypes = [];
    GetItemTypes() 
    async function GetItemTypes() {
        $scope.itemtypes = [];
        const res = await ws.getRequest("ItemTypes");
        $scope.itemtypes = res;
        $scope.$apply();
        return;
    }

    const show_auto_complete_items = document.getElementById("show_auto_complete_items");
    show_auto_complete_items.style.display = "none";
    $scope.search_box = () => {
        show_auto_complete_items.style.display = "flex";
    }
    $scope.closecurrent = () => {
        show_auto_complete_items.style.display = "none";
    }

    document.getElementById("show_itemid").addEventListener('keydown', (e) => {
        show_auto_complete_items.style.display = "flex";
        document.getElementsByName("src_bom_item_model")[0].focus();
    })

    $scope.getitemsboq = async ($event) => {
        $scope.whitems = [];
        const sr = document.getElementsByName("src_bom_item_model")[0].value;
        const page = `stocks/${sr}`;
        ///console.log(page);
        const res = await ws.getRequest(page);
        $scope.whitems = res;
        $scope.$apply();
        return;
    }
    $scope.wtreserveritems = [];
    $scope.is_loading_data = false;
    $scope.reserved_items_info = {};
    $scope.getreservveinfo = async (x) => {
        console.log(x);
        $scope.reserved_items_info = x;
        const fm = {
            "partno": x.partno,
            "partalloy": x.partalloy,
            "partcolor": x.partcolor,
            "partlength": x.partlength
        };

        $scope.wtreserveritems = [];
        $scope.show_dia_reserveditems = true;
        $scope.is_loading_data = true;
        const res = await ws.postRequest("stocks",fm);
        if (!res) {
            $scope.is_loading_data = false;
            $scope.$apply();
            return;
        }
        
        $scope.wtreserveritems = res;
        $scope.is_loading_data = false;
        $scope.$apply();
    }

    $scope.show_dia_reserveditems = false;
    $scope.setSystemNewStatus = (_status) => $scope.show_dia_reserveditems = _status;


    $scope.getItembyTypes = async() => {
        if (!$scope.dia_mcategory) {
            alert("Enter Material Category");
            return;
        }
        //document.style.cursor = "wait";
        const page = `ItemTypes/${$scope.dia_mcategory}`;
        const res = await ws.getRequest(page);                
        $scope.whitems = res;
        //document.style.cursor = "default";
        $scope.$apply();
    }
    $scope.sho_which_project_has_reservations = false;
    $scope.setProjectReserveStatus = (_status) => {
        console.log("hitted");
        $scope.sho_which_project_has_reservations = _status
        
    };
    $scope.projectlist = [];
    getReservedProjectList();
    async function getReservedProjectList() {
        $scope.projectlist = [];
        const res = await ws.getRequest('Costcenter');
        $scope.projectlist = res;
        $scope.$apply();
    }

    $scope.reservedmateriallist = [];
    $scope.setreseveditemsforproject = _status => $scope.show_items_for_selected_project = _status;
    $scope.get_reserve_project = async (x) => await getReservedMaterialsForSelectedProject(x);
    $scope.selectedprojectedlist = "";
    async function getReservedMaterialsForSelectedProject(projectname) {
        $scope.selectedprojectedlist = "";
        $scope.reservedmateriallist = [];
        $scope.show_items_for_selected_project = true;
        if (!projectname || projectname === "") {
            alert("Enter Project Name");
            return;
        }
        $scope.is_loading_data = true;
        const fd = {
            costcenter: projectname
        };
        $scope.selectedprojectedlist = projectname;
        const res = await ws.postRequest('Costcenter', fd);
        $scope.reservedmateriallist = res;
        $scope.is_loading_data = false;
        $scope.$apply();
        return;
    }
    
    $scope.getitemreservationbyproject = () => {
        if (!$scope.reservedmateriallist || $scope.reservedmateriallist.length === 0) {            
            return;
        }
        localStorage.removeItem("naf_project_items_project");
        localStorage.removeItem("naf_project_items_project_items");        
        localStorage.setItem("naf_project_items_project", $scope.selectedprojectedlist);
        localStorage.setItem("naf_project_items_project_items", JSON.stringify($scope.reservedmateriallist));
        window.open(`${print_location}/sprint/reserveditemproject.html`, "_blank", "width:1300px;height:650px");
    }
    
    $scope.print_material_category = async () => {
        if (!$scope.dia_mcategory) {
            alert("Enter Material Category");
            return;
        }
        
        const page = `ItemTypes/${$scope.dia_mcategory}`;
        ///console.log(page);
        const res = await ws.getRequest(page);
        localStorage.removeItem("naf_mat_stock_mcat");
        localStorage.removeItem("naf_mat_stock_mcat_name");
        localStorage.setItem("naf_mat_stock_mcat_name",$scope.dia_mcategory);
        localStorage.setItem("naf_mat_stock_mcat", JSON.stringify(res));
        window.open(`${print_location}/sprint/stocklist.html`, "_blank", "width:1300px;height:650px");
        return;
    }
    $scope.print_resevered = () => {
        localStorage.removeItem("wtreserveritems");
        localStorage.removeItem("reserved_items_info");
        localStorage.setItem("wtreserveritems", JSON.stringify($scope.wtreserveritems));
        localStorage.setItem("reserved_items_info", JSON.stringify($scope.reserved_items_info));
        window.open(`${print_location}/sprint/reserved.html`, "_blank", "width:1300px;height:650px");
    }
    // db.nafwh.aggregate([{ $group: { "_id": "$materialcatagory", "sulaiqty": { $sum: "$sqty" }, "aziziaqty": { $sum: "$aqty" } , totrows : {$sum:1} } }])
    // db.nafwh.aggregate([{ $group: { "_id": "$partno", totsulai: { $sum: "$sqty" }, count: { $sum: 1 } } }])
    // db.nafwh.aggregate([{ $group: { _id: { partno : "$partno",partalloy : "$partalloy" , partlength:"$partlength" , partcolor:"$partcolor"}, totsulai: { $sum : "$sqty"} , count : {$sum : 1} } }])
}