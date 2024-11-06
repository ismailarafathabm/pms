export default function mtblbacklog($scope, $rootScope) {
    
    const groupitems = [
        {
            disp_name: "Project",
            field_name: "loadproject",
        },
        {
            disp_name: "Sales Rep",
            field_name: "Sales_Representative",
        },
        {
            disp_name: "Description",
            field_name: "mattype",
        },
        {
            disp_name: "Driver",
            field_name: "driver",
        },
        
        {
            disp_name: "Location",
            field_name: "location",
        },
        {
            disp_name: "Region",
            field_name: "projectRegion"
        },      
        {
            disp_name: "Week No",
            field_name: "currentweek"
        }
    ];
    
    $scope.ungroupdisp = true;
    $rootScope.printfilters = true;
    function getCurrentDate() {
        let d = new Date();
        let day = d.getDay();
        let month = d.getMonth() + 1;
        let year = d.getFullYear();
        $scope.currentdate = `${day}-${month}-${year}`;
    }
    $scope.currentdate = "";
    getCurrentDate();
    $rootScope.printtitle = "Material To Be Load Backlog Pending Report As On "+ $scope.currentdate;
    function calspanchange(groupColumn) {
        
        switch (groupColumn) {
            default: return 13;
            case 'loadproject': return 13;
            case 'mattype': return 13;
            case 'driver': return 13;
            case 'location': return 13;
            case 'locastatustion': return 13;            
        }
    }

    $rootScope.groupingitems = groupitems;
    $scope.ungroup = [];  
    //grop
    const data = JSON.parse(localStorage.getItem("pms_ism_print_material_load_backlog"));
    $scope.ungroup = data;
    $rootScope.groupbynone = () => {
        $scope.ungroup = data;
        showhiddenlist()
        $scope.ungroupdisp = true;
    }

     //ungorup
     $scope.groupdata = [];   
     $scope.groupColumn = "";
     $scope.newpageadd = false;
     $scope.groupdataTitle = "";
     $rootScope.gropuby = (z, y) => {      
         $scope.colspancnt = calspanchange(z)
         console.log($scope.colspancnt);
         $scope.groupColumn = z;
         $scope.groupdata = [];
         $scope.groupdataTitle = y;
         let group_item = [];
         data.map(i => {
             const y = i[z].toLowerCase();
             if (!group_item.includes(y)) {
                 group_item.push(y);
             }
         });
         console.log(group_item);
         let abc = [];
         group_item.sort((a,b)=> a - b ).map(n => {
             console.log("working");
             let cols = n;
             let xdata = data.filter(ab => ab[z].toLowerCase() === n);            
             abc.push({cols,xdata})
         })
         console.log(abc);
         $scope.groupdata = abc;            
         $scope.ungroupdisp = false;        
         showhiddenlist();
     }
}