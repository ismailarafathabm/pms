export default function MaterialToBeLoadSummary($scope, $rootScope) {
    console.log("working");
    const _mode = localStorage.getItem("pms_ism_summary_mode")
    $rootScope.printfilters = _mode === "l" ? true : false; 
    $scope.summarya = _mode === "l" ? true : false;
    console.log(_mode);
    console.log($scope.summarya ? "yes" : "NO");
    
    const groupitems = [
        { disp_name: "Descriptoin", field_name: "description" },
        { disp_name: "Driver", field_name: "driver" },
        { disp_name: "Loading Date", field_name: "loadingdate_p" },
        { disp_name: "At Site", field_name: "ascurrentdate_p" },
        { disp_name: "Status", field_name: "status" },
    ];
    const pagetitle = localStorage.getItem("pms_ism_summary_title");
    $rootScope.printtitle = `${pagetitle} : Material To Be Load Summary Report` ;
    $rootScope.groupingitems = groupitems;
    $scope.ungroup = [];  
    const data = JSON.parse(localStorage.getItem("pms_ism_summary_data"));
    $scope.ungroup = data;
    console.log(data);    
    $rootScope.groupbynone = () => {
        
        $scope.summarya = true;
        $scope.ungroup = data;
        showhiddenlist()
        $scope.ungroupdisp = false;
    }

    $scope.groupdata = [];   
    $scope.groupColumn = "";
    $scope.newpageadd = false;
    $scope.groupdataTitle = "";

    $rootScope.gropuby = (z, y) => {
        console.log("its called");
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
        $scope.ungroupdisp = true;     
        $scope.summarya = true;
        showhiddenlist();
    }
    
}