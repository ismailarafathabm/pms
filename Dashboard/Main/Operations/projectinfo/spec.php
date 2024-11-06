<?php
include_once('../../../../conf.php');
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
            <Strong> Project Specification</Strong>
        </div>
        <div class="router-container-options">
            <a href="#!newspec" class="nafco-button newbutton mr-5">
                <i class="fa fa-plus"></i>
                Add New
            </a>
            <a class="link" href="<?php echo $url_dep_operation ?>/admin/dashboard/projects/print/project_specification.php?project_code={{viewproject.project_no | lowercase}}" target="_blank">
                <i class="fa fa-print"></i>
                Print
            </a>
        </div>
    </div>
    <div class="route-container-content">
        <table class="project-list-table borderd">
            <tr>
                <td style="width:20%;text-align:center">
                    Aluminium
                </td>
                <td style="width:80%">
                    <div ng-repeat="a_s in _aluminiumspc" style="padding:5px;">
                        <div style="width:60%;display:inline-block">
                            {{a_s.spec_remark}}
                        </div>
                        <div style="width:10%;display:inline-block">
                            <button type="button" ng-click="edit_alu_spec(a_s.spec_id,a_s.spec_remark,'aluminium','1','Edit - Aluminium Specification')" class="nafco-button nafco-btn-ok nafco-sm-btn nafco-btn-noborder">
                                <i class="fa fa-pencil"></i>
                                Edit
                            </button>
                        </div>
                        <div style="width:14%;display:inline-block;">
                            <button ng-click="remove_alu_spec(a_s.spec_id)" type="button" class="nafco-button nafco-btn-danger nafco-sm-btn nafco-btn-noborder">
                                <i class="fa fa-trash"></i>
                                Remove
                            </button>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width:20%;text-align:center">
                    Finish
                </td>
                <td style="width:80%">

                    <div ng-repeat="a_s in _finishspc">
                        <div style="width:60%;display:inline-block">
                            {{a_s.spec_remark}}
                        </div>
                        <div style="width:10%;display:inline-block">
                            <button type="button" ng-click="edit_alu_spec(a_s.spec_id,a_s.spec_remark,'finish','1','Edit - Finish Specification')" class="nafco-button nafco-btn-ok nafco-sm-btn nafco-btn-noborder">
                                <i class="fa fa-pencil"></i>
                                Edit
                            </button>
                        </div>
                        <div style="width:14%;display:inline-block;">
                            <button ng-click="remove_alu_spec(a_s.spec_id)" type="button" class="nafco-button nafco-btn-danger nafco-sm-btn nafco-btn-noborder">
                                <i class="fa fa-trash"></i>
                                Remove
                            </button>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width:20%;text-align:center">
                    GLASS
                </td>
                <td style="width:80%">

                    <div ng-repeat="(key,val) in _glass | groupBy:'spec_type_sub'">
                        <h3 style="text-align:left;border-bottom:1px solid #001">{{key | uppercase}}</h3>
                        <div ng-repeat="a_s in val" style="border-bottom:1px solid #f1f1f1">
                            <div style="width:60%;display:inline-block">
                                {{a_s.spec_remark}}
                            </div>
                            <div style="width:10%;display:inline-block">
                                <button type="button" ng-click="edit_alu_spec(a_s.spec_id,a_s.spec_remark,'glass','{{key}}','Edit - Finish Specification')" class="nafco-button nafco-btn-ok nafco-sm-btn nafco-btn-noborder">
                                    <i class="fa fa-pencil"></i>
                                    Edit
                                </button>
                            </div>
                            <div style="width:14%;display:inline-block;">
                                <button ng-click="remove_alu_spec(a_s.spec_id)" type="button" class="nafco-button nafco-btn-danger nafco-sm-btn nafco-btn-noborder">
                                    <i class="fa fa-trash"></i>
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- <div ng-repeat="(key,val) in _glass | groupBy:'spec_type_sub'">
                            <h1>{{key}}</h1>
                            <div ng-repeat="xs in val">
                                {{xs.spec_remark}}
                            </div>
                        </div> -->
                    <!-- <ul ng-repeat="(key, value) in _glass | groupBy: '_glass.spec_type_sub'">
                            {{ key }}
                            <li ng-repeat="item in value">
                                {{ item.spec_remark }}
                            </li>
                        </ul> -->
                    <!-- <div ng-repeat=" a_s in _glass | orderBy : 'spec_type_sub'" style=" width:100%;position:relative;padding:10px;border-bottom:0px solid #6e5773">

                            <div style="width:50%;display:inline-block">
                                {{a_s.spec_remark}}
                            </div>
                            <div style="width:10%;display:inline-block">
                                <b>
                                    {{a_s.spec_type_sub | uppercase}}
                                </b>
                            </div>
                            <div style="width:10%;display:inline-block">
                                <button ng-if="newproject.project_hadnover !== '3'" type="button" ng-click="edit_alu_spec(a_s.spec_id,a_s.spec_remark,'glass','{{a_s.spec_type_sub | lowercase}}','Edit - Glass Specification')" class="nafco_buttons simple btn-green">
                                    <i class="fa fa-check"></i>
                                    update
                                </button>
                            </div>
                            <div style="width:14%;display:inline-block;">
                                <button ng-if="newproject.project_hadnover !== '3'" ng-click="remove_alu_spec(a_s.spec_id)" type="button" class="nafco_buttons simple btn-red" style="width:100%">
                                    <i class="fa fa-trash"></i>
                                    Remove
                                </button>
                            </div>
                        </div> -->
                </td>
            </tr>

            <tr>
                <td style="width:20%;text-align:center">
                    Hardwares
                </td>
                <td style="width:80%">
                    <div ng-repeat="a_s in _hardware">
                        <div style="width:60%;display:inline-block">
                            {{a_s.spec_remark}}
                        </div>
                        <div style="width:10%;display:inline-block">
                            <button ng-if="newproject.project_hadnover !== '3'" type="button" ng-click="edit_alu_spec(a_s.spec_id,a_s.spec_remark,'finish','1','Edit - Finish Specification')" class="nafco-button nafco-btn-ok nafco-sm-btn nafco-btn-noborder">
                                <i class="fa fa-pencil"></i>
                                Edit
                            </button>
                        </div>
                        <div style="width:14%;display:inline-block;">
                            <button ng-if="newproject.project_hadnover !== '3'" ng-click="remove_alu_spec(a_s.spec_id)" type="button" class="nafco-button nafco-btn-danger nafco-sm-btn nafco-btn-noborder">
                                <i class="fa fa-trash"></i>
                                Remove
                            </button>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div style="width:100%;min-height:150px;background-color:#ecf4f3;padding:10px;position:relative">
                <div style="width:100%">
                    <h3>{{dialog_title}}....</h3>
                </div>
                <form name="edit_aluminium_spec" ng-submit="aluminium_spec_edit()">
                    <div style="width:100%;min-height: 120px;padding:10px;background-color:#ffffea;border:1px solid #35b0ab">
                        <div style="width:100%;margin-top:15px; padding:4px;">
                            <textarea name="edit_spec_remark_aluminium" ng-model="edit_spec_remark_aluminium" id="edit_spec_remark_aluminium" class="nafco_inputs" style="width:90%;" required></textarea>
                        </div>
                        <div style="width:100%;margin-top:15px; padding:0px;text-align:right;">
                            <button ng-disabled="edit_aluminium_spec.$invalid" type="submit" class="nafco-button nafco-btn-ok">
                                <i class="fa fa-pencil"></i>
                                Edit
                            </button>
                            <button type="button" class="nafco-button nafco-btn-danger nafco-btn-noborder" id="close_modal" style="margin-left:20px;float:right">
                                <i class="fa fa-close"></i>
                                Close
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <div style="width:100%;margin-top:0px;margin-left:0px;">
    <div style="margin:0px;width:100%;height:25px;">
        <?php include_once('../../sidemenu.php'); ?>
    </div>

    <div style="width:95%;margin:15px auto;height:auto;background-color:#edf7fa;margin-top:60px;border:1px solid #D4CFCF">
        <div style="position:static;padding:10px;text-align:right;">
            <a href="#!newspec" class="nafco_buttons simple btn-red" style="width:100px;height:auto;padding:5px;border:1px solid #357376;text-align:center;text-decoration: none;color:#FFF;background-color: #357376;">
                <i class="fa fa-plus"></i>
                Add New
            </a>
            <a class="nafco_buttons simple btn-red" href="<?php echo $url_dep_operation ?>/admin/dashboard/projects/print/project_specification.php?project_code={{viewproject.project_no | lowercase}}" target="_blank">
                <i class="fa fa-print"></i>
                Print
            </a>
        </div>
        <div style="position:static;padding:15px;">
            <table class="gen_tables" style="width:95%;padding:5px;">
                <tr>
                    <td style="width:20%;text-align:center">
                        Aluminium
                    </td>
                    <td style="width:80%">
                        <div ng-repeat="a_s in _aluminiumspc" style="width:100%;position:relative;padding:10px;border-bottom:0px solid #6e5773">
                            <div style="width:60%;display:inline-block">
                                {{a_s.spec_remark}}
                            </div>
                            <div style="width:10%;display:inline-block">
                                <button type="button" ng-click="edit_alu_spec(a_s.spec_id,a_s.spec_remark,'aluminium','1','Edit - Aluminium Specification')" class="nafco_buttons simple btn-green">
                                    <i class="fa fa-check"></i>
                                    update
                                </button>
                            </div>
                            <div style="width:14%;display:inline-block;">
                                <button ng-click="remove_alu_spec(a_s.spec_id)" type="button" class="nafco_buttons simple btn-red" style="width:100%">
                                    <i class="fa fa-trash"></i>
                                    Remove
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%;text-align:center">
                        Finish
                    </td>
                    <td style="width:80%">

                        <div ng-repeat="a_s in _finishspc" style="width:100%;position:relative;padding:10px;border-bottom:0px solid #6e5773">
                            <div style="width:60%;display:inline-block">
                                {{a_s.spec_remark}}
                            </div>
                            <div style="width:10%;display:inline-block">
                                <button type="button" ng-click="edit_alu_spec(a_s.spec_id,a_s.spec_remark,'finish','1','Edit - Finish Specification')" class="nafco_buttons simple btn-green">
                                    <i class="fa fa-check"></i>
                                    update
                                </button>
                            </div>
                            <div style="width:14%;display:inline-block;">
                                <button ng-click="remove_alu_spec(a_s.spec_id)" type="button" class="nafco_buttons simple btn-red" style="width:100%">
                                    <i class="fa fa-trash"></i>
                                    Remove
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%;text-align:center">
                        GLASS
                    </td>
                    <td style="width:80%">

                        <div ng-repeat="(key,val) in _glass | groupBy:'spec_type_sub'" style="width:100%;position:relative;padding:10px;border-bottom:0px solid #6e5773">
                            <h3 style="text-align:left;border-bottom:1px solid #001">{{key | uppercase}}</h3>
                            <div ng-repeat="a_s in val" style="border-bottom:1px solid #f1f1f1">
                                <div style="width:60%;display:inline-block">
                                    {{a_s.spec_remark}}
                                </div>
                                <div style="width:10%;display:inline-block">
                                    <button type="button" ng-click="edit_alu_spec(a_s.spec_id,a_s.spec_remark,'glass','{{key}}','Edit - Finish Specification')" class="nafco_buttons simple btn-green">
                                        <i class="fa fa-check"></i>
                                        update
                                    </button>
                                </div>
                                <div style="width:14%;display:inline-block;">
                                    <button ng-click="remove_alu_spec(a_s.spec_id)" type="button" class="nafco_buttons simple btn-red" style="width:100%">
                                        <i class="fa fa-trash"></i>
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                         <div ng-repeat="(key,val) in _glass | groupBy:'spec_type_sub'">
                            <h1>{{key}}</h1>
                            <div ng-repeat="xs in val">
                                {{xs.spec_remark}}
                            </div>
                        </div> -->
<!-- <ul ng-repeat="(key, value) in _glass | groupBy: '_glass.spec_type_sub'">
                            {{ key }}
                            <li ng-repeat="item in value">
                                {{ item.spec_remark }}
                            </li>
                        </ul> -->
<!-- <div ng-repeat=" a_s in _glass | orderBy : 'spec_type_sub'" style=" width:100%;position:relative;padding:10px;border-bottom:0px solid #6e5773">

                            <div style="width:50%;display:inline-block">
                                {{a_s.spec_remark}}
                            </div>
                            <div style="width:10%;display:inline-block">
                                <b>
                                    {{a_s.spec_type_sub | uppercase}}
                                </b>
                            </div>
                            <div style="width:10%;display:inline-block">
                                <button ng-if="newproject.project_hadnover !== '3'" type="button" ng-click="edit_alu_spec(a_s.spec_id,a_s.spec_remark,'glass','{{a_s.spec_type_sub | lowercase}}','Edit - Glass Specification')" class="nafco_buttons simple btn-green">
                                    <i class="fa fa-check"></i>
                                    update
                                </button>
                            </div>
                            <div style="width:14%;display:inline-block;">
                                <button ng-if="newproject.project_hadnover !== '3'" ng-click="remove_alu_spec(a_s.spec_id)" type="button" class="nafco_buttons simple btn-red" style="width:100%">
                                    <i class="fa fa-trash"></i>
                                    Remove
                                </button>
                            </div>
                        </div> 
                    </td>
                </tr>

                <tr>
                    <td style="width:20%;text-align:center">
                        Hardwares
                    </td>
                    <td style="width:80%">
                        <div ng-repeat="a_s in _hardware" style="width:100%;position:relative;padding:10px;border-bottom:0px solid #6e5773">
                            <div style="width:60%;display:inline-block">
                                {{a_s.spec_remark}}
                            </div>
                            <div style="width:10%;display:inline-block">
                                <button ng-if="newproject.project_hadnover !== '3'" type="button" ng-click="edit_alu_spec(a_s.spec_id,a_s.spec_remark,'finish','1','Edit - Finish Specification')" class="nafco_buttons simple btn-green">
                                    <i class="fa fa-check"></i>
                                    update
                                </button>
                            </div>
                            <div style="width:14%;display:inline-block;">
                                <button ng-if="newproject.project_hadnover !== '3'" ng-click="remove_alu_spec(a_s.spec_id)" type="button" class="nafco_buttons simple btn-red" style="width:100%">
                                    <i class="fa fa-trash"></i>
                                    Remove
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div> -->