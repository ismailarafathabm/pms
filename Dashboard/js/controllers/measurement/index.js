app.controller('measurement', function ($scope, $http) {
    $("#back_btn").on('click', function () {
        window.history.back();
    })
    let project_id;
    let project_boq_refno;
    let project_boq_revision;

    if (!sessionStorage.getItem('nafco_project_current') || sessionStorage.getItem('nafco_project_current') === '') {
        projectlist();
    } else {
        project_id = sessionStorage.getItem('nafco_project_current');
        get_projectinfo();        
    }

    function get_projectinfo() {
        let post_data = {
            naf_user: userinfo,
            project_no: project_id
        }
        var req = $http.post(api_url + "Project/view.php", post_data);
        req.then(res => {            
            if (res.data.msg === "1") {
                $scope.viewproject = res.data.data;
                $scope.newproject = res.data.data;
                
                project_id = angular.lowercase(res.data.data.project_no);
                $scope.meas = {
                    meas_project : project_id
                }
                
                get_all_boq_measurements();
                if (res.data.data.project_boq_refno === "") {
                    alert("BOQ Ref No Missing");
                } else if (res.data.data.project_boq_revision === "") {
                    alert("BOQ Ref No Missing");
                } else {
                    project_boq_refno = res.data.data.project_boq_refno;
                    project_boq_revision = res.data.data.project_boq_revision;
                    get_all_boq();
                }
            } else {
                alert(res.data.data);
            }
        });
    }

    all_techApprovalsType();
    function all_techApprovalsType() {
        let post_data = {
            naf_user: userinfo
        };
        $http({
            method: 'post',
            data: post_data,
            url: api_url + "Approval_Type/index.php"
        }).then(
            function (res) {                
                if (res.data.msg === "1") {
                    $scope.menu_Techapprovals = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    All_approvalsType();
    function All_approvalsType() {
        var post_data = {
            naf_user: userinfo
        };
        $http({
            method: 'post',
            url: api_url + "DrawingApprovalsTypes/index.php",
            data: post_data
        }).then(
            function (res) {                
                if (res.data.msg == "1") {
                    $scope._dapprovals = res.data.data;
                    $scope.drawapprovals = res.data.data;

                } else {
                    alert(res.data.data);
                }
            }
        );
    }
    
    function get_all_boq_measurements(){
        let post_data = {
            naf_user :userinfo,
            porject_id: project_id 
        };        
        $http.post(api_url + "measurement/index.php",post_data)
        .then(
            function(res){                
                if(res.data.msg === "1"){
                    $scope.measurements = res.data.data;
                }else{  
                    alert(res.data.data);
                }
            }
        )

    }
    $scope.hi = false;
    $scope.wk = function(){        
        if ($scope.meas.meas_boq && $scope.meas.meas_boq !== ''){
            $scope.hi = true;
            get_boqinfo($scope.meas.meas_boq);
            // $scope.meas = {
            //     meas_project: project_id
            // }
        }else{
            $scope.hi = false;
        }
    }
    function get_boqinfo(itemno) {
        let post_data = {
            naf_user: userinfo,
            project_no: project_id,
            item_no: itemno
        };


        $http.post(api_url + "Boq/get.php", post_data)
            .then(
                (res) => {                    
                    if (res.data.msg === "1") {
                        $("#boq_item_finish").val(res.data.data.finish_name);
                        $("#boq_item_location").val(res.data.data.item_description);                        
                        $("#boq_item_system").val(res.data.data.system_type_name);
                        $("#meas_width").focus();                        
                    } 
                }
            )



    }
    function get_all_boq(){
        var post_data = {
            naf_user: userinfo,
            project_no: project_id,
            project_refno: project_boq_refno,
            project_reviewno: project_boq_revision
        };
        $http.post(api_url + "Boq/index.php", post_data)
            .then(
                function (res) {                    
                    if (res.data.msg === "1") {
                        $scope.itemsnos = res.data.data;                                                
                    } else {
                        alert(res.data.data);
                    }
                }
            )
    }
    $("#meas_width").keyup(function(){
        calc();
    })
    $("#meas_height").keyup(function () {
        calc();
    })

    function calc(){
        $("#meas_area").val(_area_calc($("#meas_width").val(), $("#meas_height").val()));
    }

    $scope.save_measurements = function(){
        var post_data = {
            naf_user : userinfo,
            meas : $scope.meas
        };        
        $http({
            method :'post',
            url: api_url + "measurement/new.php",
            data : post_data
        }).then((res)=>{          
            if(res.data.msg == "1"){
                alert("saved");
                document.getElementById("new-measurement").style.display = 'none';                
                $scope.hi = false;
            }else{
                alert(res.data.data);
            }
        })
    }
})

function _area_calc(no1, no2, digits) {    
    var _no1 = parseFloat(no1);
    var _no2 = parseFloat(no2);
    var x = _no1 * _no2;    
    return x;
}