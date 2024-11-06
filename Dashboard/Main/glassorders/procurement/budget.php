<?php
session_start();
$userdep = $_SESSION['nafco_alu_user_department'];
include_once '../../menu1.php';
include_once '../../masterlog/st.php';
include_once './st.php';
?>
<article class="sub-body">
    <div class="sub-body-container" style="margin-top: 75px;padding:0;overflow:hidden; font-family: 'roboto',sans-serif;font-size : 1rem;">
        <div class="ism-loaderdiv-new" ng-if="isrptloading">
            <div class="ism-loader-container" ng-if="isrptloading">
                <i class="fa fa-cog fa-spin" style="font-size:80px;color:darkblue"></i>
            </div>
        </div>
        <div class="ism-new-page-headers">
            <div class="ism-new-page-header-page-title">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                Glass Budget </i>
            </div>
            <div class="ism-new-page-header-page-buttons">
                <button type="button" class="ism-new-page-header-button normalbtn" ng-click="show_project_list_selector()">
                    <i class="fa fa-plus" style="margin-right:1px"></i>
                    Load
                </button>
                <button type="button" class="ism-new-page-header-button normalbtn" ng-click="add_new_budget()">
                    <i class="fa fa-plus" style="margin-right:1px"></i>
                    Add
                </button>
            </div>
        </div>
        <div style="height: calc(100vh - 145px);overflow: auto;border: 1px solid #d9d9d9;">
            <i ng-show="isrptloading" class="fa fa-cog fa-spin pageloader"></i>
            <div ng-show="!isrptloading" id="myGrid" class="ag-theme-balham" style="height:100%;"></div>
        </div>
    </div>
</article>
<?php 
    include_once './models/budget.php';
    include_once './models/projectsel.php';
    
    
    include_once './models/supplier.php';


   

    include_once './models/glassorder.php';
    include_once './models/glassorderhistory.php';

    include_once './models/index.php';
    include_once './models/gtype.php';
?>

<!-- <div class="ism-pms-autofill-new">
    <div class="ism-pms-autofill-new-conatiner">
        <div class="ism-pms-autofill-rows">
            <div class="ism-psm-autofill-search-controllers">
                <input type="text">
            </div>
        </div>
        <div class="ism-pms-autofill-rows">
            <div class="ism-pms-autofill-listitems">
                <table class="ism-pms-autofill-table">
                    <thead>
                        <tr>                            
                            <th>S.No</th>
                            <th>Contract No</th>
                            <th>Project Name</th>
                            <th>Contractor Name</th>
                            <th>Location</th>
                            <th>Region</th>
                            <th>Sales Rep</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in autoprojects">
                            <td>{{x.project_no}}</td>
                            <td>{{x.project_name}}</td>
                            <td>{{x.project_cname}}</td>
                            <td>{{x.project_location}}</td>
                            <td>{{x.projectRegion}}</td>
                            <td>{{x.Sales_Representative}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> -->