<?php
include_once('../../../../conf.php');
?>
<div style="width:100%;margin-top:0px;margin-left:0px;">
    <div style="margin:0px;width:100%;height:25px;">
        <?php include_once('../../sidemenu.php'); ?>
    </div>

    <div style="width:95%;margin:15px auto;height:auto;background-color:#edf7fa;margin-top:60px;border:1px solid #D4CFCF">
        <div style="position:static;padding:15px;">
            <table class="gen_tables" style="width:90%;padding:5px; margin:auto auto">
                <tr>
                    <td style="width:20%;text-align:center">
                        Aluminium
                    </td>
                    <td style="width:80%">
                        <div style="width:100%;padding:5px;background-color:#e8f9e9;border:1px solid #9de3d0;">
                            <form name="save_aluminium_spec" ng-submit="aluminium_spec_save()">
                                <h3 style="text-align:center">Add New Aluminium Specification...</h3>
                                <textarea class="nafco_inputs" name="spec_remark_aluminium" ng-model="spec_remark_aluminium" id="spec_remark_aluminium" style="width:60%;" required></textarea>
                                <button type="submit" ng-disabled="save_aluminium_spec.$invalid" id="save_btn_aluminium_spec">
                                    <i class="fa fa-check" style="padding:2px;"></i>
                                    Save
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%;text-align:center">
                        Finish
                    </td>
                    <td style="width:80%">
                        <div style="width:100%;padding:5px;background-color:#e8f9e9;border:1px solid #9de3d0;">
                            <form name="save_finish_spec" ng-submit="finish_spec_save()">
                                <h3 style="text-align:center">Add New Finish Specification...</h3>
                                <textarea class="nafco_inputs" name="spec_remark_finish" ng-model="spec_remark_finish" id="spec_remark_finish" style="width:60%;" required></textarea>
                                <button type="submit" ng-disabled="save_finish_spec.$invalid" id="save_btn_aluminium_spec">
                                    <i class="fa fa-check" style="padding:2px;"></i>
                                    Save
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%;text-align:center">
                        Glass
                    </td>
                    <td style="width:80%">
                        <div class="glass-main">
                            <div class="glass-container">
                                <div class="glass-inner">
                                    <form name="save_glass_spec" ng-submit="glass_spec_save()">
                                        <div class="glass-inputs">
                                            <div class="glass-input-group">
                                                <select id="glass_types" name="glass_type" ng-model="project.glass_type" class="nafco_inputs">
                                                    <option value="">-Select-</option>
                                                    <option ng-repeat="g in glass_types" value="{{g.class_type_name | lowercase}}">{{g.class_type_name | uppercase}}</option>
                                                </select>
                                                <button ng-click="open_glassType()" id="open_new_glassType" class="nafco_buttons btn-border-red" type="button"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="glass-inputs">
                                            <textarea id="glass_spec" name="glass_spec" ng-model="project.glass_spce" class='nafco_inputs'></textarea>
                                        </div>
                                        <div class="glass-inputs btns">
                                            <button ng-disabled="save_glass_spec.$invalid" class="nafco_buttons btn-border-green" type="submit" name="save_glass_spce_btn">
                                                <i class='fa fa-check'></i>
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%;text-align:center">
                        Hardwares
                    </td>
                    <td style="width:80%">
                        <div style="width:100%;padding:5px;background-color:#e8f9e9;border:1px solid #9de3d0;">
                            <form name="save_hardware_spec" ng-submit="hardware_spec_save()">
                                <h3 style="text-align:center">Add New Hardware Specification...</h3>
                                <textarea type="text" class="nafco_inputs" name="spec_remark_hardware" ng-model="spec_remark_hardware" id="spec_remark_hardware" class='form-control border-danger' style="width:60%;" required></textarea>
                                <button type="submit" ng-disabled="save_hardware_spec.$invalid" id="save_btn_aluminium_spec">
                                    <i class="fa fa-check" style="padding:2px;"></i>
                                    Save
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

            </table>
        </div>
    </div>
</div>


<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div style="width:100%;min-height:150px;background-color:#ecf4f3;padding:10px;position:relative">
            <div style="width:100%">
                <h3>ADD NEW GLASS TYPE....</h3>
            </div>
            <form name="add_glassType" ng-submit="glassType_add()">
                <div style="width:100%;min-height: 120px;padding:10px;background-color:#ffffea;border:1px solid #35b0ab">
                    <div style="width:100%;margin-top:15px; padding:4px;">
                        <input type="text" name="glassType" ng-model="glassType" id="glassType" class="nafco_inputs" style="width:90%;" required>
                    </div>
                    <div style="width:100%;margin-top:15px; padding:0px;">
                        <button ng-disabled="add_glassType.$invalid" type="submit" class="nafco_buttons simple btn-green" style="width:20%;margin-left:70%;padding:3px;border:1px solid #29c7ad">
                            <i class="fa fa-check"></i>
                            Save
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

<style>
    .glass-main {
        width: 100%;
        margin: 0px;
    }

    .glass-container {
        width: 95%;
        margin: auto auto;
        height: auto;
        min-height: 100px;
        background-color: #e8f9e9;
        border: 1px solid #9de3d0;
    }

    .glass-inner {
        display: block;
        padding: 10px;
    }

    .glass-inputs {
        padding: 5px;
    }

    .glass-inputs textarea {
        width: 60%
    }

    .glass-input-group {
        display: inline-block;
        width: 100%
    }

    .glass-input-group select {
        width: 30%;
        margin-right: 10px;
    }

    .glass-input-group button {
        width: 5%;
        height: 100%;
    }

    .btns {
        width: 20%;
        align-content: right;
        text-align: left;
    }
</style>