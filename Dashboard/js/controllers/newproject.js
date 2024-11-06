app.controller('newprojectctrl', function($scope, $http) {
    // const inputs = document.querySelectorAll("input");
    // inputs.forEach(i => {
    //     i.autocomplete = "off";
    // })
    document.getElementById("rpt_project").style.background = "#e84a5f";
    $("#back_btn").on('click', function() {
        window.history.back();
    })
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
})

function calcss(__amount, __presentage) {
    var presentage = __presentage / __amount * 100;
    var __pres = presentage.toFixed(2)
    return __pres;
}

function reload() {
    location.reload();
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