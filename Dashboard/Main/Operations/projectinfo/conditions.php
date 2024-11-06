<?php
include_once('../../../../../conf.php');
?>
<?php include_once('../../sidemenu.php'); ?>
<div class="route-continer-project route-container-ok">
    <div class="route-container-header">
        <div class="router-container-back-btn">
            <a href="" id="back_btn">
                <i id="page-go-back" class="fa fa-arrow-left"></i>
            </a>
        </div>
        <div class="router-container-title">
            <Strong> Project Conditions</Strong>
        </div>
    </div>
    <div class="route-container-content">
        <table class="project-list-table borderd">
            <tr ng-repeat="cn in _conditions">
                <td style="width:20px">{{cn.project_conditions_number}}</td>
                <td style="width:750px">{{cn.project_conditions_remark}}</td>
                <td style="width:50px"><button id="remove_conditions" ng-click="condition_remove(cn.project_conditions_id)" class="nafco-button nafco-sm-btn nafco-btn-danger nafco-btn-noborder"><i class="fa fa-trash text-danger"></i> Remove</button></td>
            </tr>
            <tr ng-if="newproject.project_hadnover !== '3'">
                <td></td>
                <td></td>
                <td>
                    <button type="button" ng-click="new_conditions()" class="nafco-button nafco-sm-btn nafco-btn-ok nafco-btn-noborder">
                        <i class="fa fa-plus"></i>
                        Add New
                    </button>
                </td>
            </tr>
        </table>
    </div>
</div>



<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div style="width:100%;min-height:150px;background-color:#ecf4f3;padding:10px;position:relative">
            <div style="width:100%">
                <h3>Add New Conditions....</h3>
            </div>
            <form name="add_new_conditions" ng-submit="new_conditions_add()">
                <div style="width:100%;min-height: 120px;padding:10px;background-color:#ffffea;border:1px solid #35b0ab">
                    <div style="width:100%;margin-top:15px; padding:4px;">
                        <textarea ng-model="conditions_add_new" name="conditions_add_new" id="conditions_add_new" class="nafco_inputs" style="width:90%;" required></textarea>
                    </div>
                    <div style="width:100%;margin-top:15px; padding:0px;">
                        <button ng-disabled="add_new_conditions.$invalid" type="submit" class="nafco_buttons simple btn-green" style="width:20%;margin-left:70%;padding:3px;border:1px solid #29c7ad">
                            <i class="fa fa-check"></i>
                            Update
                        </button>
                        <button type="button" class="nafco_buttons simple btn-red" id="close_modal" style="margin-top:10px;width:20%;margin-left:70%;padding:3px;border:1px solid #d45090">
                            <i class="fa fa-close"></i>
                            Close
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>