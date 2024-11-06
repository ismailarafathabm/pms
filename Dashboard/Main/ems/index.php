<?php
session_start();
include_once('../../../conf.php');
$userdep = $_SESSION['nafco_alu_user_department'];
include_once('../menu1.php');
?>
<style>
    .ism-new-loaderdiv{   display: flex;
    align-items: center;
    justify-content: center;
    height: 120px;
    font-size: 75px;
    color: #063eea
    }
</style>

<div class="sub-body">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                Project Workers List
            </div>
            <div class="sub-container-right">

                <button ng-click="clearFilters()" class="ism-btns btn-delete">
                    <i class="fa fa-times"></i>
                    Clear Filter
                </button>
            </div>
        </div>
        <div class="sub-body-container-contents" style="height:100%;background: #fff;">
            <div ng-show="isLoadingInfo" class="ism-new-loaderdiv">
                <i  class="fa fa-cog fa-spin"></i>
            </div>
            <div ng-show="!isLoadingInfo" id="myGrid" class="ag-theme-balham" style="height:100%;"></div>
        </div>
    </div>
</div>