app.filter('daterangetech', function() {
    return function(conversations, start_date, end_date) {
        var result = [];
        // date filters
        var start_date = (start_date && !isNaN(Date.parse(start_date))) ? Date.parse(start_date) : 0;
        var end_date = (end_date && !isNaN(Date.parse(end_date))) ? Date.parse(end_date) : new Date().getTime();

        if (start_date > end_date) {
            alert("Check Input Date");
            //location.reload();
        } else {
            // if the conversations are loaded
            if (conversations && conversations.length > 0) {
                $.each(conversations, function(index, conversation) {
                    var conversationDate = new Date(conversation.approvals_adate_s);

                    if (conversationDate >= start_date && conversationDate <= end_date) {
                        result.push(conversation);
                    } else {
                        result = [];
                    }
                });
                return result;
            }
        }
    };
});

app.filter('apstatusfilter', function() {
    return function(approvals_status) {
        switch (approvals_status) {
            case 'A':
                return 'A - approval not released';
                break;
            case 'B':
                return 'B - approval released';
                break;
        }
    }
})
app.controller("ctrl_techapprovalsrpt", function($scope, $http, $filter) {
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
    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian'
    };

    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function(value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function(value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    $scope.showhidesfilters = function(ids) {
        if ($("#" + ids).hasClass('lis_sh')) {
            $("#" + ids).removeClass('lis_sh');
        } else {
            $("#" + ids).addClass('lis_sh');
        }
    }
    mdata = [];


    $scope.isloading = false;
    document.getElementById("rpt_project_tech").classList.add('menuactive');
    localStorage.removeItem("rpt_techapprovals");
    $("#back_btn").on('click', function() {
        window.history.back();
    })
    get_all();


    // var bc_home = document.getElementById("back-to-tops");
    // bc_home.addEventListener('click', function() {
    //     window.scrollTo(0, 0);
    // })

    var fi = document.getElementById("fiexdheader-hide");
    // bc_home.style.display = "none";
    // window.addEventListener('scroll', function() {
    //     if (pageYOffset > 400) {
    //         //console.log("owk")
    //         bc_home.style.display = "block";
    //         //fi.style.display = "block";
    //     } else {
    //         //console.log("error");
    //         bc_home.style.display = "none";
    //         // fi.style.display = "none";
    //     }
    // })

    function get_all() {
        $scope.isloading = true;
        let post_data = {
            naf_user: userinfo
        };
        $http({
            method: "POST",
            data: post_data,
            url: api_url + "Approvals/index.php"
        }).then(
            function(res) {
                console.log(res.data);
                if (res.data.msg === "1") {
                    $scope.data = res.data.data;
                    mdata = res.data.data;
                    $scope.isloading = false;
                }
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

    $scope.srtbydate = () => {
        var sdate = $("#sdate").val();
        var spdate = sdate.split("-");

        var s_d = spdate[0];
        var s_m = spdate[1];
        var s_y = spdate[2];

        var ssdate = s_y + "-" + s_m + "-" + s_d;

        var edate = $("#edate").val();
        var epdate = edate.split("-");

        var e_d = epdate[0];
        var e_m = epdate[1];
        var e_y = epdate[2];

        var esdate = e_y + "-" + e_m + "-" + e_d;


        console.log(ssdate, esdate);
        $scope.data = $filter('daterangetech')(mdata, ssdate, esdate);
    }
    $scope.printclick = function() {
        var tbl = document.getElementById("techapprovals").innerHTML;
        localStorage.removeItem("rpt_techapprovals");
        localStorage.setItem("rpt_techapprovals", tbl);
        window.open(print_location + "rpt/rpt_technicalapprovals.php", '_blank')
    }
});

app.filter('myDatefilter', function() {
    return function(myDatefilter) {
        switch (myDatefilter) {
            case '-':
                return ''
            default:
                return 'd-MM-YYYY';

        }
    }
})
app.controller("ctrl_drawingapprovals", ['$scope', '$http', function($scope, $http) {
    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian'
    };

    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function(value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    var hei = document.querySelector('#hidiv').offsetHeight;
    console.log(screen.width);
    if (screen.width < 1300) {
        var nwtop = 83 + parseInt(hei) - 1;
    } else {
        var nwtop = 70 + parseInt(hei) - 1;
    }

    console.log(hei, nwtop);
    console.log(hei.offsetTop + hei.offsetLeft);
    const xshorts = document.querySelectorAll(".fiexdheader-sort");
    xshorts.forEach(
        x => {
            x.style.top = nwtop + "px";
        }
    )

    //rpt_project_drawing

    var bc_home = document.getElementById("back-to-tops");
    bc_home.addEventListener('click', function() {
        window.scrollTo(0, 0);
    })
    bc_home.style.display = "none";
    window.addEventListener('scroll', function() {
        if (pageYOffset > 400) {
            //console.log("owk")
            bc_home.style.display = "block";
        } else {
            //console.log("error");
            bc_home.style.display = "none";
        }
    })

    $scope.$on("loaded", function() { console.log('all ok') });

    document.getElementById("rpt_project_drawing").style.background = '#e84a5f';
    $("#back_btn").on('click', function() {
        window.history.back();
    })

    // console.log("its workign");
    rptview();

    function rptview() {
        let post_data = {
            naf_user: userinfo
        };
        $http({
            method: "POST",
            data: post_data,
            url: api_url + "DrawingApprovals/rpt.php"
        }).then(
            function(res) {
                if (res.data.msg === "1") {
                    console.log(res.data.data);
                    $scope._approvals = res.data.data;
                } else {
                    alert(res.data.data);
                }
            }
        )
    }

    get_projectinfo();

    function get_projectinfo() {
        let post_data = {
            naf_user: userinfo
        }
        var req = $http.post(api_url + "Project/index.php", post_data);
        req.then(res => {
            //console.log(res.data);
            if (res.data.msg === "1") {
                $scope.viewproject = res.data.data;
            } else {
                alert(res.data.data);
            }
        });
    }
    $scope._fview = "0";
    var i = 0;
    $scope.hidedetials = function() {
        if (i === 1) {
            i = 0;
            document.getElementById("hidebutton").innerText = "Show Details";
            $scope._fview = "0";
        } else {
            i = 1;
            $scope._fview = "1";
            document.getElementById("hidebutton").innerText = "Hide Details";
        }

    }

    $scope.print_btn = function() {
        var tab = document.getElementById("draw_approvals").innerHTML;
        localStorage.removeItem("rpt_techapprovals");
        localStorage.setItem("rpt_techapprovals", tab);
        window.open(print_location + "rpt/rpt_technicalapprovals.php", '_blank');
    }


}]);

app.filter('daterangevariations', function() {
    return function(conversations, start_date, end_date) {
        var result = [];

        // date filters
        var start_date = (start_date && !isNaN(Date.parse(start_date))) ? Date.parse(start_date) : 0;
        var end_date = (end_date && !isNaN(Date.parse(end_date))) ? Date.parse(end_date) : new Date().getTime();

        if (start_date > end_date) {
            alert("Check Input Date");
            location.reload();
        } else {
            // if the conversations are loaded
            if (conversations && conversations.length > 0) {
                $.each(conversations, function(index, conversation) {
                    var conversationDate = new Date(conversation.sdate);

                    if (conversationDate >= start_date && conversationDate <= end_date) {
                        result.push(conversation);
                    }
                });

                return result;
            }
        }
    };

});

app.controller('ctrl_variationsrpt', ['$scope', '$http', '$filter', function($scope, $http, $filter) {
    $scope.showhidesfilters = function(ids) {
        if ($("#" + ids).hasClass('lis_sh')) {
            $("#" + ids).removeClass('lis_sh');
        } else {
            $("#" + ids).addClass('lis_sh');
        }
    }

    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian'
    };

    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function(value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    //rpt_variation


    document.getElementById("rpt_variation").classList.add('menuactive');

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
    $("#back_btn").on('click', function() {
        window.history.back();
    })




    localStorage.removeItem('rpt_variation_tbl');
    getRpt();
    mdata = [];

    function getRpt() {
        let post_data = {
            naf_user: userinfo
        };
        $scope.isloading = true;
        $http({
            method: 'post',
            url: api_url + "Variations/rpt.php",
            data: post_data
        }).then(
            function(res) {
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

    $scope.srtbydate = () => {
        var sdate = $("#sdate").val();
        var spdate = sdate.split("-");

        var s_d = spdate[0];
        var s_m = spdate[1];
        var s_y = spdate[2];

        var ssdate = s_y + "-" + s_m + "-" + s_d;

        var edate = $("#edate").val();
        var epdate = edate.split("-");

        var e_d = epdate[0];
        var e_m = epdate[1];
        var e_y = epdate[2];

        var esdate = e_y + "-" + e_m + "-" + e_d;


        console.log(ssdate, esdate);
        $scope.data = $filter('daterangevariations')(mdata, ssdate, esdate);
    }


    $scope.print_btn = function() {
        var tab = document.getElementById("print_tbl").innerHTML;
        localStorage.removeItem("rpt_techapprovals");
        localStorage.setItem("rpt_techapprovals", tab);
        window.open(print_location + "rpt/rpt_technicalapprovals.php", '_blank');
    }

}])




app.controller('ctrl_variationsrptNew', ['$scope', '$http', '$filter', function($scope, $http, $filter) {
    $scope.showhidesfilters = function(ids) {
        if ($("#" + ids).hasClass('lis_sh')) {
            $("#" + ids).removeClass('lis_sh');
            maxbodyheight();
        } else {
            $("#" + ids).addClass('lis_sh');
            maxbodyheight();
        }
    }

    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian'
    };

    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function(value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    //rpt_variation


    document.getElementById("rpt_variation").classList.add('menuactive');

    maxbodyheight();
    window.addEventListener('resize', () => {
        maxbodyheight()
    })
    document.querySelector(".sub-body").addEventListener('resize', () => {
        console.log(this.height);
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
    $("#back_btn").on('click', function() {
        window.history.back();
    })




    localStorage.removeItem('rpt_variation_tbl');
    getRpt();
    mdata = [];

    function getRpt() {
        let post_data = {
            naf_user: userinfo
        };
        $scope.isloading = true;
        $http({
            method: 'post',
            url: api_url + "Variations/rptnew.php",
            data: post_data
        }).then(
            function(res) {
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

    $scope.srtbydate = () => {
        var sdate = $("#sdate").val();
        var spdate = sdate.split("-");

        var s_d = spdate[0];
        var s_m = spdate[1];
        var s_y = spdate[2];

        var ssdate = s_y + "-" + s_m + "-" + s_d;

        var edate = $("#edate").val();
        var epdate = edate.split("-");

        var e_d = epdate[0];
        var e_m = epdate[1];
        var e_y = epdate[2];

        var esdate = e_y + "-" + e_m + "-" + e_d;


        console.log(ssdate, esdate);
        $scope.data = $filter('daterangevariations')(mdata, ssdate, esdate);
    }


    $scope.print_btn = function() {
        var tab = document.getElementById("print_tbl").innerHTML;
        localStorage.removeItem("rpt_techapprovals");
        localStorage.setItem("rpt_techapprovals", tab);
        window.open(print_location + "rpt/rpt_technicalapprovals.php", '_blank');
    }

}])

app.filter('varstatusfilter', function() {
    return function(variation_status) {
        switch (variation_status) {
            case '1':
                return 'ISSUED FOR APPROVAL';
                break;
            case '2':
                return 'APPROVED';
                break;
            case '3':
                return 'cancelled';
                break;
            case '4':
                return 'dummy';
                break;
            default:
                return "-";
                break;
        }
    }
})
app.filter('daterangecuttinglist', function() {
    return function(conversations, start_date, end_date) {
        var result = [];

        // date filters
        var start_date = (start_date && !isNaN(Date.parse(start_date))) ? Date.parse(start_date) : 0;
        var end_date = (end_date && !isNaN(Date.parse(end_date))) ? Date.parse(end_date) : new Date().getTime();

        if (start_date > end_date) {
            alert("Check Input Date");
            location.reload();
        } else {
            // if the conversations are loaded
            if (conversations && conversations.length > 0) {
                $.each(conversations, function(index, conversation) {
                    var conversationDate = new Date(conversation.cuttinglist_cldaterelease_s);

                    if (conversationDate >= start_date && conversationDate <= end_date) {
                        result.push(conversation);
                    }
                });

                return result;
            }
        }
    };
});
app.controller("ctrl_cuttinglistrpt", function($scope, $http, $filter) {
    mdata = [];
    document.getElementById("rpt_project_cuttinglist").classList.add('menuactive');
    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian'
    };
    console.log(access_cuttinglist_excel_report);
    $scope.access_cuttinglist_excel_report = access_cuttinglist_excel_report;
    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function(value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    $scope.showhidesfilters = function(ids) {
        if ($("#" + ids).hasClass('lis_sh')) {
            $("#" + ids).removeClass('lis_sh');
        } else {
            $("#" + ids).addClass('lis_sh');
        }
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



    $("#back_btn").on('click', function() {
        window.history.back();
    })

    load_Rtp();

    function load_Rtp() {
        $scope.isloading = true;
        let post_data = {
            naf_user: userinfo
        };

        $http.post(api_url + "cuttinglist/rpt.php", post_data).then(
            (res) => {
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

    $scope.printclick = function() {
        console.log("its working");
        var tbl = document.getElementById("cuttinglist").innerHTML;
        localStorage.removeItem('rpt_variation_tbl');
        localStorage.setItem("rpt_variation_tbl", tbl);
        window.open(print_location + "rpt/rpt_variations.php", '_blank');
        //location.href = print_location;
    }

    $scope.srtbydate = () => {
        var sdate = $("#sdate").val();
        var spdate = sdate.split("-");

        var s_d = spdate[0];
        var s_m = spdate[1];
        var s_y = spdate[2];

        var ssdate = s_y + "-" + s_m + "-" + s_d;

        var edate = $("#edate").val();
        var epdate = edate.split("-");

        var e_d = epdate[0];
        var e_m = epdate[1];
        var e_y = epdate[2];

        var esdate = e_y + "-" + e_m + "-" + e_d;


        console.log(ssdate, esdate);
        $scope.data = $filter('daterangecuttinglist')(mdata, ssdate, esdate);
    }


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
})
app.filter('daterangeglassorders', function() {
    return function(conversations, start_date, end_date) {
        var result = [];

        // date filters
        var start_date = (start_date && !isNaN(Date.parse(start_date))) ? Date.parse(start_date) : 0;
        var end_date = (end_date && !isNaN(Date.parse(end_date))) ? Date.parse(end_date) : new Date().getTime();

        if (start_date > end_date) {
            alert("Check Input Date");
            location.reload();
        } else {
            // if the conversations are loaded
            if (conversations && conversations.length > 0) {
                $.each(conversations, function(index, conversation) {
                    var conversationDate = new Date(conversation.releasedtopurchase_s);

                    if (conversationDate >= start_date && conversationDate <= end_date) {
                        result.push(conversation);
                    }
                });

                return result;
            }
        }
    };
});
app.controller('ctrl_glassordersrpt', function($scope, $http, $filter) {
    document.getElementById("rpt_project_glassorders").classList.add('menuactive');
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
    mdata = [];
    $scope.showhidesfilters = function(ids) {
        if ($("#" + ids).hasClass('lis_sh')) {
            $("#" + ids).removeClass('lis_sh');
        } else {
            $("#" + ids).addClass('lis_sh');
        }
    }


    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian'
    };

    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function(value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };

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


    $("#back_btn").on('click', function() {
        window.history.back();
    })
    rpt();

    function rpt() {
        $scope.isloading = true;
        let post_data = {
            naf_user: userinfo
        };

        $http.post(api_url + "glassorder/rpt.php", post_data)
            .then(
                (res) => {
                    console.log(res.data);
                    if (res.data.msg === '1') {
                        $scope.data = res.data.data;
                        mdata = res.data.data;

                    } else {
                        alert(res.data.data);
                    }
                    $scope.isloading = false;
                }
            );
    }

    $scope.printclick = function() {
        console.log("its working");
        var tbl = document.getElementById("cuttinglist").innerHTML;
        localStorage.removeItem('rpt_variation_tbl');
        localStorage.setItem("rpt_variation_tbl", tbl);
        window.open(print_location + "rpt/rpt_variations.php", '_blank');
        //location.href = print_location;
    }

    $scope.srtbydate = () => {
        var sdate = $("#sdate").val();
        var spdate = sdate.split("-");

        var s_d = spdate[0];
        var s_m = spdate[1];
        var s_y = spdate[2];

        var ssdate = s_y + "-" + s_m + "-" + s_d;

        var edate = $("#edate").val();
        var epdate = edate.split("-");

        var e_d = epdate[0];
        var e_m = epdate[1];
        var e_y = epdate[2];

        var esdate = e_y + "-" + e_m + "-" + e_d;


        console.log(ssdate, esdate);
        $scope.data = $filter('daterangeglassorders')(mdata, ssdate, esdate);
    }
})


app.filter('glassstatusfilter', function() {
    return function(orderstatus) {

        var st = "ORDERED";
        switch (orderstatus) {
            case '1':
                st = "ORDERED";
                break;
            case '2':
                st = "PENDING";
                break;
            case '3':
                st = "HOLD";
                break;
            case '4':
                st = "CANCELLED";
                break;
            case '5':
                st = "SUPERSEDED";
                break;
            case '6':
                st = "Others";
                break;
        }

        return st;
    }
})



app.controller("ctrl_drawingapprovals1", ['$scope', '$http', '$filter', function($scope, $http, $filter) {
    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian'
    };

    moment.locale('en');
    //moment.locale('ar-sa');
    $scope.locale = moment.locale();
    $scope.switchLocale = function(value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    $mdata = [];
    $("#back_btn").on('click', function() {
        window.history.back();
    })

    //rpt_project_drawing








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
    // $("#back_btn").on('click', function() {
    //         window.history.back();
    //     })
    // console.log("its workign");


    rptview();

    function rptview() {
        $scope.isloading = true;
        let post_data = {
            naf_user: userinfo
        };
        $http({
            method: "POST",
            data: post_data,
            url: api_url + "DrawingApprovals/rpt1.php"
        }).then(
            function(res) {
                console.log(res.data);
                if (res.data.msg === "1") {
                    console.log(res.data.data);
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

    // matching with AND operator
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

    $scope.print_btn = function() {
        var tab = document.getElementById("draw_approvals").innerHTML;
        localStorage.removeItem("rpt_techapprovals");
        localStorage.setItem("rpt_techapprovals", tab);
        window.open(print_location + "rpt/rpt_technicalapprovals.php", '_blank');
    }

    $scope.showhidesfilters = function(ids) {
        if ($("#" + ids).hasClass('lis_sh')) {
            $("#" + ids).removeClass('lis_sh');
        } else {
            $("#" + ids).addClass('lis_sh');
        }
    }

    $scope.Revision_btnList = function($x) {
        console.log($x);
        $scope._drawingno = $x.approvals_draw_no;
        document.getElementById('revision_list').style.display = 'block';
        let post_data = {
            naf_user: userinfo,
            project_no: $x.approvals_project_code,
            drawing_no: $x.approvals_token
        };

        $http.post(api_url + "DrawingApprovals/getAllrevisions.php", post_data)
            .then(
                function(res) {
                    console.log(res.data);
                    if (res.data.msg === "1") {
                        $scope.revision_list = res.data.data;
                    } else {
                        alert(res.data.data);
                    }
                }
            )

    }

    $scope.srtbydate = () => {
        var sdate = $("#sdate").val();
        var spdate = sdate.split("-");

        var s_d = spdate[0];
        var s_m = spdate[1];
        var s_y = spdate[2];

        var ssdate = s_y + "-" + s_m + "-" + s_d;

        var edate = $("#edate").val();
        var epdate = edate.split("-");

        var e_d = epdate[0];
        var e_m = epdate[1];
        var e_y = epdate[2];

        var esdate = e_y + "-" + e_m + "-" + e_d;

        console.log(ssdate, esdate);
        $scope.data = $filter('daterange')(mdata, ssdate, esdate);
    }




}]);
app.filter('daterange', function() {
    return function(conversations, start_date, end_date) {
        var result = [];

        // date filters
        var start_date = (start_date && !isNaN(Date.parse(start_date))) ? Date.parse(start_date) : 0;
        var end_date = (end_date && !isNaN(Date.parse(end_date))) ? Date.parse(end_date) : new Date().getTime();

        if (start_date > end_date) {
            alert("Check Input Date");
            location.reload();
        } else {
            // if the conversations are loaded
            if (conversations && conversations.length > 0) {
                $.each(conversations, function(index, conversation) {
                    var conversationDate = new Date(conversation.approvals_infos_submitedon);

                    if (conversationDate >= start_date && conversationDate <= end_date) {
                        result.push(conversation);
                    }
                });

                return result;
            }
        }
    };
});

app.filter("myfilter", function($filter) {
    return function(items, from, to) {
        return $filter('filter')(items, "approvals_infos_submitedon", function(v) {
            var date = moment(v);
            return date >= moment(from) && date <= moment(to);
        });
    };
});


app.filter('myfi2', function() {
    return function(approvals_last_status) {
        switch (approvals_last_status) {
            case 'A':
                return "A - Approved";
                break;
            case 'B':
                return "B - Approved As noted";
                break;
            case 'C':
                return "C - Approved as noted Resubmit";
                break;
            case 'H':
                return "H - ON Hold";
                break;
            case 'U':
                return "U - Under Review";
                break;
            case 'X':
                return "X - Canceled";
                break;
            case 'F':
                return "F - FOR INFORMATION";
                break;
            default:
                return "- Pending";
                break;
        }
    }
})