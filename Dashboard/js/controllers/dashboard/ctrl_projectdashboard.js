app.filter('regiondisp',()=>{
    return(val)=>{
        return val === 'Western Region' ? val : 'Central Region';
    }
});
app.controller('ctrl_projectdashboard',ctrl_projectdashboard);

function ctrl_projectdashboard($scope,$http){
    document.title = "PROJECT LIST - PMS"
    var currentmode  = '';
    var currenttxt = '';
    maxbodyheight();
    window.addEventListener('resize',maxbodyheight)
    function maxbodyheight() {
        var mbody = document.querySelector(".ism-bodys");
        var wsize = window.innerHeight;        
        var head_size = document.querySelector(".ism-headers").offsetHeight;        
        var nav_size = document.querySelector(".ism-navi-itmes");
        nav_size.marginTop = head_size + "px";                
        document.querySelector(".sub-body-container").style.marginTop = "75px";

    }
    document.getElementById("rpt_projectdashboard").classList.add('menuactive');
    GetprojectInfos();
    function GetprojectInfos(){
        var fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        var post_data = {
            data : fd,
            method : 'post',
            url : `${api_url}pinfo/index.php`,
            headers : {
                'content-type' : undefined
            }
        };

        $http(post_data).then(
            (res) => {
                console.log(res.data);
                if(res.data.msg === '1'){$scope.couters = res.data.data;}else{alert(res.data.data);}
            }
        )
    }

    $scope.thispagetitle = 'All Projects';
    //$scope.thispagetitle = titlesss;
    // $scope.pages.pagetitle = '';
    getProjects('','All Projects');
    $scope.getgetProjects = (v,titlesss) => {
       
        getProjects(v);
        currentmode = v;
        currenttxt = titlesss;
        $scope.thispagetitle = titlesss;
    }
    $scope.projects = [];
    function getProjects(types){
        
        var fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);
        fd.append('st', types);

        var post_data = {
            data : fd,
            method : 'post',
            url : `${api_url}pinfo/getprojects.php`,
            headers : {
                'content-type' : undefined
            }
        };

        $http(post_data).then(
            (res) => {
                console.log(res.data);
                if(res.data.msg === '1'){
                    $scope.projects = res.data.data;
                    
                }else{alert(res.data.data);}
            }
        )
    }

    $scope.goproject = (pno) => {
        sessionStorage.clear('nafco_project_current');
        sessionStorage.setItem('nafco_project_current', pno);
        _viewproject();
    }

    


}