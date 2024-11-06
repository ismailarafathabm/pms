app.controller('ctrl_drawingapprovals1x', ctrl_drawingapprovals1x);

function ctrl_drawingapprovals1x($scope, $http) {
    window.addEventListener('resize', () => {
        maxbodyheight()
    })
    maxbodyheight();

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
    getReportAll();
    var rowcount = 0;
    $scope.data = [];

    function getReportAll() {
        var fd = new FormData();
        fd.append('user_name', userinfo.user_name);
        fd.append('user_token', userinfo.user_token);

        var post_data = {
            method: 'post',
            url: api_url + "DrawingApprovals/speedcode/index.php",
            data: fd,
            headers: {
                'content-type': undefined
            }
        };

        const req = $http(post_data);

        req.then(
            function(res) {
                if (res.data.msg === "1") {
                    rowcount = res.data.data;
                    ControllerFetch(rowcount);
                } else {
                    alert(res.data.data);
                }
            }
        );

    }

    function ControllerFetch(xrows) {
        if (xrows < 200) {

        } else {
            console.log('danger', xrows);
        }
    }


    async function FetchData(start) {

    }
}