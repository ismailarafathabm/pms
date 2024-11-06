app.controller('dashboardcontroller', ['$scope', '$http', function($scope, $http) {
    //console.log("its working");
    // const inputs = document.querySelectorAll("input");
    // inputs.forEach(i => {
    //     i.autocomplete = "off";
    // })
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
    $scope.isloading = true;
    document.getElementById("rpt_project").classList.add('menuactive');
    $("#back_btn").on('click', function() {
        window.history.back();
    })

    sessionStorage.clear('nafco_project_current');
    var post_data = {
        naf_user: userinfo
    }
    var url = api_url + "Project/index.php";
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
            function(res) {
                console.log(res.data);
                if (res.data.msg === "1") {
                    $scope.menu_Techapprovals = res.data.data;
                } else {
                    alert(res.data.data);
                }
                $scope.isloading = false;
            }
        )
    }
    $http.post(url, post_data).then(
        function(res) {
            console.log(res.data);
            if (res.data.msg === "1") {
                $scope._projects = res.data.data;
            } else {
                if (res.data.data === "Access Error") {
                    alert("This user ID already Login Another Pc \n Please Re-Login...");
                    _logout();
                }
            }

        }
    );

    $scope.goproject = function(pid) {
        sessionStorage.clear('nafco_project_current');
        sessionStorage.setItem('nafco_project_current', pid);
        _viewproject();
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
        var bh = wsize - 110;
        var bhbh = bh - 39 - 8;
        var bhbhbh = bh - 52 - 8;
        // var bhbhbh = bh - 45;

        document.querySelector(".sub-body-container").style.height = bh + "px";
        document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container").style.maiHeight = bh + "px";
        document.querySelector(".sub-body-container").style.marginTop = "75px";
        //document.querySelector(".sub-body-container").style.maxHeight = bh + "px";
        document.querySelector(".sub-body-container-contents").style.height = bhbh + "px";
        document.querySelector(".sub-body-container-contents").style.maxHeight = bhbh + "px";
        document.querySelector(".sub-body-container-contents").style.maiHeight = bhbh + "px";


        document.querySelector(".naf-tables").style.height = bhbhbh + "px";
        document.querySelector(".naf-tables").style.maxHeight = bhbhbh + "px";
        document.querySelector(".naf-tables").style.maiHeight = bhbhbh + "px";

    }


    $scope.manpower_summaryreport = () => {
        var sdate = $('#date_search').val();
        var edate = $('#date_search1').val();
        var url = `http://172.0.0.1:8082/EMS//print/psmsummary.php?s=${sdate}&e=${edate}`;
        window.open(url, '_blank', 'widht=1300px;height=600px');
    }


    $scope.xerror = false;
    $("input[name='advance_amount_remark']").css('color', "red");
    $("input[name='project_first_advance']").css('color', "red");
    $(".fa-check").css('color', "red");


    $scope.save_project = function() {
        clc();
        var _svdata = {
            naf_user: userinfo,
            _frmdata: $scope.newproject,
            _conditions: $scope._condition,
            _terms: $scope._terms
        };
        var req = $http.post(api_url + "Project/new.php", _svdata);
        req.then(function(res) {
            if (res.data.msg === "1") {
                alert("saved");
                reload();
            } else {
                alert(res.data.data);
            }
        })
    }

    $scope.calc_f1 = function() {
        var __presentage = parseFloat($scope.newproject.project_first_advance_amount);
        var __amount = parseFloat($scope.newproject.project_amount);
        if (__presentage > __amount) {
            $scope.xerror = false;

        } else {
            $scope.xerror = true;
        }
        clc()
    }

    $scope.calc_f2 = function() {
        clc()
    }
    $scope.clcvalues = function() {
        var __presentage = parseFloat($scope.newproject.project_basicpayment);
        if (__presentage <= 100) {
            $scope.xerror = true;
        } else {
            $scope.xerror = false;
        }
        clc();
    }

    function clc() {
        if (!$scope.newproject.project_amount || $scope.newproject.project_amount == "" || !$scope.newproject.project_first_advance_amount || $scope.newproject.project_first_advance_amount == "" || !$scope.newproject.project_basicpayment || $scope.newproject.project_basicpayment == "") {
            $scope.newproject.project_first_advance = 0;
            $scope.ckcolors = "text-danger";
            $scope.bgcolor = "bg-danger";
            $scope.newproject.advance_amount_remark = "Advance Payment Not Completed";
        } else {
            var __amount = parseFloat($scope.newproject.project_amount);
            var __presentage = parseFloat($scope.newproject.project_first_advance_amount);
            var presentage = parseFloat(calcss(__amount, __presentage));
            $scope.newproject.project_first_advance = presentage;
            var _mini = parseInt($scope.newproject.project_basicpayment);
            if (_mini <= presentage) {
                $scope.ckcolors = "color:green";
                $scope.bgcolor = "bg-success";
                $("input[name='advance_amount_remark']").css('color', "green");
                $("input[name='project_first_advance']").css('color', "green");
                $(".fa-check").css('color', "green");
                $scope.newproject.advance_amount_remark = "Advance Payment Completed";
            } else {
                $("input[name='advance_amount_remark']").css('color', "red");
                $("input[name='project_first_advance']").css('color', "red");
                $(".fa-check").css('color', "red");
                $scope.newproject.advance_amount_remark = "Advance Payment Not Completed";
            }
        }
    }

}])

function calcss(__amount, __presentage) {
    var presentage = __presentage / __amount * 100;
    var __pres = presentage.toFixed(2)
    return __pres;
}

$(document).ready(function() {
    $(window).keydown(function(event) {
        if (event.keyCode == 13) {
            //$(this).next(':input').focus();
            event.preventDefault();

            return false;
        }
    });

});




app.filter('sumrow', () => {
    return function(datas, column) {
        var sum = 0;

        if (!datas) {

        } else {
           
            for (var i = 0; i < datas.length; i++) {
                sum += (+datas[i][column]);
            }
        }
        return sum.toFixed(2);

    }
})