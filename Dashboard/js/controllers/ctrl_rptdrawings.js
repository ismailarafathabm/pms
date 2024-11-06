app.controller('ctrl_rptdrawings', rptdrawings);

function rptdrawings($scope, $http, $filter) {
    document.getElementById("rpt_project_drawing").classList.add('menuactive');

    maxbodyheight();
    window.addEventListener('resize', () => {
        maxbodyheight()
    })

    function maxbodyheight() {
        var mbody = document.querySelector(".ism-bodys");
        var wsize = window.innerHeight;
        //console.log(wsize);
        var head_size = document.querySelector(".ism-headers").offsetHeight;
        //console.log(head_size);        
        var nav_size = document.querySelector(".ism-navi-itmes");
        nav_size.marginTop = head_size + "px"
        var foot_size = document.querySelector(".ism-footers").offsetHeight;
        var rmh = 120;
        var bh = wsize - 120;
        var bhbh = bh - 35 - 10 - 7;
        var bhbhbh = bh - 35 - 27;
        // var bhbhbh = bh - 45;

        document.querySelector(".sub-body").style.marginTop = "75px";
        document.querySelector(".sub-body-container").style.height = bh + "px";
        document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container").style.maiHeight = bh + "px";
        //document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".mainbodys_data").style.height = bhbh + "px";
        document.querySelector(".mainbodys_data").style.maxHeight = bhbh + "px";
        document.querySelector(".mainbodys_data").style.maiHeight = bhbh + "px";

        document.querySelector(".loadingdiv").style.height = bhbh + "px";
        document.querySelector(".loadingdiv").style.maxHeight = bhbh + "px";
        document.querySelector(".loadingdiv").style.maiHeight = bhbh + "px";

        document.querySelector(".naf-tables").style.height = bhbhbh + "px";
        document.querySelector(".naf-tables").style.maxHeight = bhbhbh + "px";
        document.querySelector(".naf-tables").style.maiHeight = bhbhbh + "px";


        //set size main container

        var docwith = window.innerWidth;
        var mbodyw = document.querySelector(".ism-bodys").offsetWidth;

        document.querySelector(".inreportsbody").style.width = docwith - 300 - 30;
    }
    $scope.isloading = false;
    rpt();

    function rpt() {
        $scope.isloading = true;
        let fd = {
            naf_user: userinfo
        };
        var post_data = {
            method: 'post',
            url: api_url + "DrawingApprovals/rptnew.php",
            data: fd
        };

        $http(post_data).then(
            res => {
                console.log(res.data);
                if (res.data.msg === "1") {
                    $scope.data = res.data.data;
                    mdata = res.data.data;
                } else {
                    alert(res.data.data);
                }

                $scope.isloading = false;
            }
        )


    }


    $scope.filter = {};

    $scope.getItems = (obj, array) => {

        return (array || [])
            .map((w) => {
                return w[obj];
            })
            .filter((w, idx, arr) => {
                if (typeof w === "undefined") {
                    return false;
                }

                return arr.indexOf(w) === idx;
            });


    };
    $scope.filterByPropertiesMatchingAND = function(data) {

        var matchesAND = true;
        for (var obj in $scope.filter) {
            if ($scope.filter.hasOwnProperty(obj)) {
                if (noSubFilter($scope.filter[obj])) continue;
                if (!$scope.filter[obj][data[obj]]) {
                    matchesAND = false;
                    break;
                }
            }
        }

        return matchesAND;

    };
    // matching with OR operator
    $scope.filterByPropertiesMatchingOR = function(data) {

        var matchesOR = true;
        for (var obj in $scope.filter) {
            if ($scope.filter.hasOwnProperty(obj)) {
                if (noSubFilter($scope.filter[obj])) continue;
                if (!$scope.filter[obj][data[obj]]) {
                    matchesOR = false;
                } else {
                    matchesOR = true;
                    break;
                }
            }
        }

        return matchesOR;
    };

    function noSubFilter(obj) {

        for (var key in obj) {
            if (obj[key]) return false;
        }

        return true;
    }

    $scope.getreportsdatas = (x, pagetitles) => {
        document.getElementById("revision_list").style.display = "block";
        $scope.pagetitles = pagetitles;
        get_all_approvals(x);
    }

    function get_all_approvals(project_id) {
        var post_data = {
            naf_user: userinfo,
            project_no: project_id
        };
        console.log(post_data);
        $http.post(
            api_url + "DrawingApprovals/index.php",
            post_data,

        ).then(
            function(res) {
                console.log(res.data);
                if (res.data.msg == "1") {
                    $scope._approvals = res.data.data;
                    //$scope.newrevisions = res.data.data[0];
                } else {
                    alert(res.data.data);
                }
                $scope.isloading = false;
            }
        );
    }


    $scope.showhidesfilters = function(ids) {
        if ($("#" + ids).hasClass('lis_sh')) {
            $("#" + ids).removeClass('lis_sh');
        } else {
            $("#" + ids).addClass('lis_sh');
        }
    }

    $scope.print_btn = function() {
        var tab = document.getElementById("draw_approvals").innerHTML;
        localStorage.removeItem("rpt_techapprovals");
        localStorage.setItem("rpt_techapprovals", tab);
        window.open(print_location + "rpt/rpt_technicalapprovals.php", '_blank');
    }
    $("#back_btn").on('click', function() {
        window.history.back();
    })

}