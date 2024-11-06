<style>
    .sub-body-container {
        margin: 0px 15px 50px;
        border-radius: 15px;
        padding: 15px;
        font-family: 'segoeui', Tahoma, Geneva, Verdana, sans-serif;
        display: block;
        position: relative;
        border: 1px solid #dcdada;
        box-shadow: 9px 15px 20px #acababdb;
    }

    .sub-body-sub {
        display: flex;

        justify-content: flex-start;
        flex-direction: column;
    }

    .pagetitle {
        font-size: 21px;
        font-weight: 800;
        letter-spacing: 1.1px;
        line-height: 16px;
        margin: 15px 43px 20px 16px;
    }

    .sub-body-project-counters {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        align-items: center;
    }

    .project-cards {
        padding: 15px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        margin: 5px 5px;
        cursor: pointer;
    }

    .ripple {
        background-position: center;
        transition: background 0.8s;
    }

    .ripple:hover {
        background: #47a7f5 radial-gradient(circle, transparent 1%, #47a7f5 1%) center/15000%;
    }

    .ripple:active {
        background-color: #6eb9f7;
        background-size: 100%;
        transition: background 0s;
    }


    .card-blue {
        background-color: #006ef6d6;
        color: #fff;
        box-shadow: 8px 12px 20px #2989ff73;
        transition: background 0.8s ease;
    }


    .card-green {
        background-color: #058585d6;
        color: #fff;
        box-shadow: 8px 12px 20px #2d9999d1;
    }

    .card-orange {
        background-color: #f61700d6;
        color: #fff;
        box-shadow: 8px 12px 20px #f73c2961;
    }

    .card-icons {
        display: block;
        padding: 20px;
        border-radius: 50%;
        background-color: #0000002e;
        margin-right: 5px;
    }

    .card-icons .fa {
        margin-right: 0px;
        font-size: 30p
    }

    .card-dt {
        padding: 5px;
        margin-right: 10px;
    }

    .card-count {
        text-align: right;
        font-size: 45px;
        font-weight: 600;
        display: block;

    }

    .card-title {
        font-weight: 600;
        font-size: 19px;
        line-height: 19px;
        letter-spacing: 1.2px;
        color: #ffffffc2;
        margin: 5px 0px;
    }

    .card-maroon {
        background-color: #2c3bed;
        color: #fff;
        box-shadow: 8px 12px 20px #2837e08c;
    }

    .card-cyan {
        background-color: #773915;
        color: #fff;
        box-shadow: 8px 12px 20px #7739156e;
    }

    .card-danger {
        background-color: #a81919;
        color: #fff;
        box-shadow: 8px 12px 20px #f02323ab;
    }

    .sub-boty-projectlists {
        margin-top: 30px;
        background: #efeaea;
        padding: 11px;
        border-radius: 15px;
        box-shadow: 5px 9px 9px #bebebe;
    }

    .plistrow {
        cursor: pointer;
        margin: 5px 0px;
        padding: 5px;
        background: #efefef;
        border: 1px solid #dfdede;
        border-left: 2px solid #2c3bed;
        transition: background-color 0.3s ease-in, border-left 0.3s ease;
    }

    .plistrow-header {
        padding: 5px;
        border-bottom: 1px solid #7b7b7b;
        background: #dde0ff;
    }

    /* .plistrow:hover {
        border-left: 2px solid #2d9999;
        background: #068dd3;
        color: #fff;
        cursor: pointer;
    } */

    .plistcol {
        display: table-cell;
        padding: 5px;
        font-weight: bold;

    }
</style>
<?php
include_once('../menu1.php');
?>


<div class="sub-body">
    <div class="sub-body-container">
        <div class="sub-body-sub">
            <div class="pagetitle">
                PROJECTS
            </div>
            <div class="sub-body-body">
                <div class="sub-body-project-counters">
                    <div class="project-cards ripple card-cyan" ng-click="getgetProjects('','All Projects')">
                        <div class="card-dt">
                            <div class="card-count">
                                {{couters.totalprojects}}
                            </div>
                            <div class="card-title">
                                Total Projects
                            </div>
                        </div>
                        <div class="card-icons">
                            <i class="fa fa-building"></i>
                        </div>
                    </div>
                    <div class="project-cards ripple card-green" ng-click="getgetProjects('1','Ongoing Projects With Manpower')">
                        <div class="card-dt">
                            <div class="card-count">
                                {{couters.ongoingwithmanpower}}
                            </div>
                            <div class="card-title">
                                OnGoing with Manpower
                            </div>
                        </div>
                        <div class="card-icons">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                    <div class="project-cards ripple card-orange" ng-click="getgetProjects('2','Ongoing Projects Without Manpower')">
                        <div class="card-dt">
                            <div class="card-count">
                                {{couters.ongoingwithoutmanpower}}
                            </div>
                            <div class="card-title">
                                OnGoing W/O Manpower
                            </div>
                        </div>
                        <div class="card-icons">
                            <i class="fa fa-briefcase"></i>
                        </div>
                    </div>
                    <div class="project-cards ripple card-blue" ng-click="getgetProjects('3','New Projects')">
                        <div class="card-dt">
                            <div class="card-count">
                                {{couters.notstartedwithoutmanpower}}
                            </div>
                            <div class="card-title">
                                New Projects
                            </div>
                        </div>
                        <div class="card-icons">
                            <i class="fa fa-plus"></i>
                        </div>
                    </div>
                    <div class="project-cards ripple card-maroon" ng-click="getgetProjects('4','Handovered Projects')">
                        <div class="card-dt">
                            <div class="card-count">
                                {{couters.handoverprojects}}
                            </div>
                            <div class="card-title">
                                Handovered Projects
                            </div>
                        </div>
                        <div class="card-icons">
                            <i class="fa fa-handshake-o"></i>
                        </div>
                    </div>
                    <div ng-hide="couters.untitiled === 0" class="project-cards ripple card-danger" ng-click="getgetProjects('-','Unknown Status')">
                        <div class="card-dt">
                            <div class="card-count">
                                {{couters.untitiled}}
                            </div>
                            <div class="card-title">
                                Unknown Projects
                            </div>
                        </div>
                        <div class="card-icons">
                            <i class="fa fa-question-circle"></i>
                        </div>
                    </div>


                </div>
                <div class="sub-boty-projectlists">
                    <div class="pagetitle">{{thispagetitle}}</div>

                    <div class="plist">
                        <div class="plistrow-header">
                            <div class="plistcol" style="width:100px">Project NO</div>
                            <div class="plistcol" style="width:400px">
                                Name
                            </div>
                            <div class="plistcol" style="width:170px">Region</div>
                            <div class="plistcol" style="width:100px">Location</div>
                            <div class="plistcol" style="width:130px">Sign Date</div>
                            <div class="plistcol" style="width:100px">Duration</div>
                            <div class="plistcol" style="width:130px">Expiry Date</div>
                            <div class="plistcol" style="width:140px">Status By</div>
                            <div class="plistcol" style="width:130px">L.U Date</div>
                        </div>
                        <input type="search" placeholder="search" ng-model="src" style="
                        width: 350px;
                        padding: 8px 8px;
                        font-size: 16px;
                        background: #dcd5d5;
                        border: 1px solid transparent;
                        border-radius: 3px;
                        box-shadow: inset -1px -1px 5px #bbb8b8;
                        color: #000;
                        font-weight: 600;
                        font-family: 'roboto';
                        border-left: 2px solid #e81500;
                    ">
                        <div class="plistrow ripple" ng-repeat="pli in (flist=projects | filter:src)" ng-click="goproject(pli.pno)">

                            <div class="plistcol" style="width:100px">{{pli.ppcno}}</div>
                            <div class="plistcol" style="width:400px">
                                {{pli.ppname}}
                            </div>
                            <div class="plistcol" style="width:170px">{{pli.ppregion | regiondisp}}</div>
                            <div class="plistcol" style="width:100px">{{pli.pplocation}}</div>
                            <div class="plistcol" style="width:130px">{{pli.ppsign_d}}</div>
                            <div class="plistcol" style="width:100px">{{pli.ppduration}} Months</div>
                            <div class="plistcol" style="width:130px">{{pli.ppexpiry_d}}</div>
                            <div class="plistcol" style="width:140px">{{pli.ppstatusupby}}</div>
                            <div class="plistcol" style="width:130px">{{pli.ppstatuschdate_d}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>