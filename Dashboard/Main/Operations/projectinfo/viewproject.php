<?php
session_start();
include_once('../../../../conf.php');



$userdep = $_SESSION['nafco_alu_user_department'];

$update_access = ['superadmin', 'operation'];
$_update_access = false;
foreach ($update_access as $a) {
    if ($userdep === $a) {
        $_update_access = true;
        break;
    }
}

$price_access = ['superadmin', 'operation', 'Management', 'accounts', 'contract and operations'];
$_price_acces = false;
foreach ($price_access as $p) {
    if ($userdep === $p) {
        $_price_acces = true;
    }
}
$username = $_SESSION['nafco_alu_user_name'];
$_printaccessuser = ['naser','wagdy'];
foreach($_printaccessuser as $p){
    if($username === $p){
        $_price_acces = true;
    }
}
?>

<?php
include_once('../../menu.php');
?>
<div class="back-to-top" id="back-to-tops">
    <i class="fa fa-arrow-up"></i>
</div>
<div class="sub-body summarypages">
    <div class="sub-body-container summarypages" style="height: calc(100vh - 100px);
    overflow: auto;
">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn">
                    <a href="#/!">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                PROJECT SUMMARY
            </div>
            <div class="sub-container-right">
                <button class="ism-btns btn-normal" ng-click="get_manpowerinfo(newproject.project_no)">
                    <i class="fa fa-users"></i>
                    Get Man Power
                </button>
                <?php
                if ($_price_acces === true) {
                ?>
                    <a ng-show="viewproject.f==='1'" class="ism-btns btn-normal" href="<?php echo $url_base ?>assets/contract/{{viewproject.project_no_enc}}.pdf" target="_blank" style="margin-right: 4px;">
                        <i class="fa fa-file-pdf-o"></i>
                        View PDF
                    </a>
                    <a class="ism-btns btn-normal" href="<?php echo $url_base ?>Print/project_summery.php?project_code={{newproject.project_no | lowercase}}" target="_blank" style="margin-right: 4px;">
                        <i class="fa fa-print"></i>
                        Print
                    </a>

                    



                <?php
                }
                ?>

                <?php
                if ($_update_access === true) {
                ?>
                    <button class="ism-btns btn-normal" ng-click="upload_pdf_dialog()">
                        <i class="fa fa-upload"></i>
                        <i class="fa fa-file-pdf-o"></i>
                        {{viewproject.f==='1' ? 'Change PDF' : 'Upload PDF'}}
                    </button>
                    <button class="ism-btns btn-delete" ng-click="editprojectsinfos(newproject)">
                        <i class="fa fa-pencil"></i>
                        Edit
                    </button>
                <?php
                }
                ?>
                <?php 
                    $handover_upload_users = ['demo','operation@alunafco.com'];
                    $hendover_upload_access = in_array($username,$handover_upload_users);
                    if($handover_upload_users){
                        ?>
                        <button type="button" class="ism-btns btn-normal" ng-click="handover_dia()" ng-hide="viewproject.project_hadnover === '3'">
                            <i class="fa fa-check"></i>
                            Hand Over
                        </button>
                        <?php
                    }
                ?>
            </div>
        </div>
        <div ng-show="isloading" class="sub-body-container-contents loadingdiv">
            <center>
                <img src="<?php echo $url_base ?>/themes/defload.gif" width="50px" height="50px">
                <br />
                <span style="margin-top:5px;">Please Wait Loading Data....</span>
            </center>
        </div>

        <div ng-show="!isloading" class="sub-body-container-contents">
            <div class="projectinfos-infos">
                <div class="dialog-row projectpagesrow">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            #Contract No
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <label class="displaydiv">{{newproject.project_no}}</label>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Project Name
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <label class="displaydiv">{{newproject.project_name}}</label>
                        </div>
                    </div>
                </div>

                <div class="dialog-row projectpagesrow">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Contractor Name
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <label class="displaydiv">{{newproject.project_cname}}</label>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Location
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <label class="displaydiv">{{newproject.project_location}}</label>
                        </div>
                    </div>
                </div>

                <div class="dialog-row projectpagesrow">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Contract Sign Date
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <label class="displaydiv">{{newproject.project_singdate}}</label>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Remark
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <label class="displaydiv">{{newproject.project_sing_description}}</label>
                        </div>
                    </div>
                </div>

                <div class="dialog-row projectpagesrow">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Duration (in Months)
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <label class="displaydiv">{{newproject.project_contract_duration}}</label>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Remark
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <label class="displaydiv">{{newproject.project_contract_description}}</label>
                        </div>
                    </div>
                </div>


                <div class="dialog-row projectpagesrow">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Contact Person
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <label class="displaydiv">{{newproject.project_contact_person}}</label>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Contact No
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <label class="displaydiv">{{newproject.project_contact_no}}</label>
                        </div>
                    </div>
                </div>

                <div class="dialog-row projectpagesrow">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Sales Representative
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <label class="displaydiv">{{newproject.Sales_Representative}}</label>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Penalty
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <label class="displaydiv">{{newproject.project_penalty}}</label>
                        </div>
                    </div>
                </div>

                <div class="dialog-row projectpagesrow">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Expiry Date
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <label class="displaydiv">{{newproject.project_expiry_date}}</label>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Remark
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <label class="displaydiv">{{newproject.project_remarks}}</label>
                        </div>
                    </div>
                </div>

                <?php
                if ($_price_acces === true) {
                ?>
                    <div class="dialog-row projectpagesrow">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Project Amount
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <label class="displaydiv">{{newproject.project_amount | number}}</label>
                            </div>
                        </div>
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                First Paid Amount
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <label class="displaydiv">{{newproject.project_first_advance_amount| number}}</label>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

                <?php
                if ($_price_acces === true) {
                ?>
                    <div class="dialog-row projectpagesrow">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Payment Date
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <label class="displaydiv">{{ newproject.project_first_advance_amount === 0 ? '-' : newproject.project_advacne_date}}</label>
                            </div>
                        </div>
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Remark
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <label class="displaydiv">{{newproject.advance_amount_remark}}</label>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

                <div class="dialog-row projectpagesrow">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Handover Status
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <lable ng-if="newproject.project_hadnover === '0'" class="displaydiv">-</lable>
                            <lable ng-if="newproject.project_hadnover === '1'" class="displaydiv">INITIAL HANDING OVER</lable>
                            <lable ng-if="newproject.project_hadnover === '2'" class="displaydiv">PARTIAL HANDING OVER</lable>
                            <lable ng-if="newproject.project_hadnover === '3'" class="displaydiv">FINAL HANDING OVER</lable>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Handover Date
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <lable ng-if="newproject.project_hadnover === '0'" class="displaydiv">-</lable>
                            <lable ng-if="newproject.project_hadnover === '1'" class="displaydiv">{{newproject.project_handover_date}}</lable>
                            <lable ng-if="newproject.project_hadnover === '2'" class="displaydiv">{{newproject.project_handover_date}}</lable>
                            <lable ng-if="newproject.project_hadnover === '3'" class="displaydiv">{{newproject.project_handover_date}}</lable>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="sub-body-container-title" style='margin-top: 10px;'>
            <div class="sub-container-left">
                {{'Project Conditions'|uppercase}}
            </div>
            <div class="sub-container-right">
                <?php
                if ($_update_access === true) {
                ?>
                    <button type="button" onclick="document.getElementById('diaconditionsnew').style.display='block'" class="ism-btns btn-save">
                        <i class="fa fa-plus"></i>
                        Add New
                    </button>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="sub-body-container-contents">
            <div class="projectinfos-infos">
                <table class="naf-tables">
                    <tbody>
                        <tr ng-repeat="cn in _conditions">
                            <td style="width:25px">{{cn.project_conditions_number}}</td>
                            <td style="width:750px">{{cn.project_conditions_remark}}</td>
                            <?php
                            if ($_update_access === true) {
                            ?>
                                <td style="width:250px">
                                    <button id="remove_conditions" ng-click="condition_remove(cn.project_conditions_id)" class="ism-btns btn-delete" style="padding:2px 3px"><i class="fa fa-trash text-danger"></i> Remove</button>
                                    <button type="button" ng-click="edit_conditions(cn)" class="ism-btns btn-save" style="padding:2px 3px">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                    </button>
                                </td>
                            <?php
                            }
                            ?>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>



        <div class="sub-body-container-title" style='margin-top: 10px;'>
            <div class="sub-container-left">
                {{'Project Terms'|uppercase}}
            </div>
            <div class="sub-container-right">
                <?php
                if ($_update_access === true) {
                ?>
                    <button type="button" onclick="document.getElementById('myModal_terms').style.display = 'block';" class="ism-btns btn-save">
                        <i class="fa fa-plus"></i>
                        Add New
                    </button>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="sub-body-container-contents">
            <div class="projectinfos-infos">
                <table class="naf-tables">
                    <tbody>
                        <tr ng-repeat="cn in _terms">
                            <td style="width:25px">{{cn.payment_terms_number}}</td>
                            <td style="width:750px">{{cn.payment_terms_descripton}}</td>
                            <?php
                            if ($_update_access === true) {
                            ?>
                                <td style="width:250px">
                                    <button id="remove_conditions" ng-click="remove_terms(cn.payment_terms_id)" type="button" class="ism-btns btn-delete" style="padding:2px 3px"><i class="fa fa-trash text-danger"></i> Remove</button>
                                    <button id="edit_terms" ng-click="edits_terms(cn)" type="button" class="ism-btns btn-save" style="padding:2px 3px">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                    </button>
                                </td>
                            <?php
                            }
                            ?>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="sub-body-container-title" style='margin-top: 10px;'>
            <div class="sub-container-left">
                {{'Project Specification'|uppercase}}
            </div>
            <div class="sub-container-right">
                <?php
                if ($_price_acces === true) {
                ?>
                    <a class="ism-btns btn-normal" href="<?php echo $url_base ?>Print/project_specification.php?project_code={{viewproject.project_no | lowercase}}" target="_blank" style='margin-right:4px'>
                        <i class="fa fa-print"></i>
                        Print
                    </a>
                <?php
                }
                ?>
                <?php
                if ($_update_access === true) {
                ?>
                    <button onclick="document.getElementById('diaNewspec').style.display='block'" class="ism-btns btn-save">
                        <i class="fa fa-plus"></i>
                        Add New
                    </button>
                <?php
                }
                ?>

            </div>
        </div>
        <div class="sub-body-container-contents">
            <div class="projectinfos-infos">
                <table class="naf-tables">
                    <tbody>
                        <tr>
                            <td style="width:100px">
                                Aluminium
                            </td>
                            <td>
                                <div ng-repeat="a_s in _aluminiumspc" style="padding:5px;">
                                    <div style="display:inline-block">
                                        {{a_s.spec_remark}}
                                    </div>
                                    <?php
                                    if ($_update_access === true) {
                                    ?>
                                        <div style="display:inline-block">
                                            <button ng-if="'<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='operation' || '<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='Management'" type="button" ng-click="edit_alu_spec(a_s.spec_id,a_s.spec_remark,'aluminium','1','Edit - Aluminium Specification')" class="ism-btns btn-save" style="padding:2px 3px">
                                                <i class="fa fa-pencil"></i>
                                                Edit
                                            </button>
                                        </div>
                                        <div style="display:inline-block;">
                                            <button ng-if="'<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='operation' || '<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='Management'" ng-click="remove_alu_spec(a_s.spec_id)" type="button" class="ism-btns btn-delete" style="padding:2px 3px">
                                                <i class="fa fa-trash"></i>
                                                Remove
                                            </button>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td style="width:100px">
                                Finish
                            </td>
                            <td>
                                <div ng-repeat="a_s in _finishspc">
                                    <div style="display:inline-block">
                                        {{a_s.spec_remark}}
                                    </div>
                                    <?php
                                    if ($_update_access === true) {
                                    ?>
                                        <div style="display:inline-block">
                                            <button ng-if="'<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='operation' || '<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='Management'" type="button" ng-click="edit_alu_spec(a_s.spec_id,a_s.spec_remark,'finish','1','Edit - Finish Specification')" class="ism-btns btn-save" style="padding:2px 3px">
                                                <i class="fa fa-pencil"></i>
                                                Edit
                                            </button>
                                        </div>
                                        <div style="display:inline-block;">
                                            <button ng-if="'<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='operation' || '<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='Management'" ng-click="remove_alu_spec(a_s.spec_id)" type="button" class="ism-btns btn-delete" style="padding:2px 3px">
                                                <i class="fa fa-trash"></i>
                                                Remove
                                            </button>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                GLASS
                            </td>
                            <td>
                                <div ng-repeat="(key,val) in _glass | groupBy:'spec_type_sub'">
                                    <h3 style="text-align:left;border-bottom:1px solid #001">{{key | uppercase}}</h3>
                                    <div ng-repeat="a_s in val" style="border-bottom:1px solid #f1f1f1">
                                        <div style="display:inline-block">
                                            {{a_s.spec_remark}}
                                        </div>
                                        <?php
                                        if ($_update_access === true) {
                                        ?>
                                            <div style="display:inline-block">
                                                <button ng-if="'<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='operation' || '<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='Management'" type="button" ng-click="edit_alu_spec(a_s.spec_id,a_s.spec_remark,'glass','{{key}}','Edit - Finish Specification')" class="ism-btns btn-save" style="padding:2px 3px">
                                                    <i class="fa fa-pencil"></i>
                                                    Edit
                                                </button>
                                            </div>
                                            <div style="display:inline-block;">
                                                <button ng-if="'<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='operation' || '<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='Management'" ng-click="remove_alu_spec(a_s.spec_id)" type="button" class="ism-btns btn-delete" style="padding:2px 3px">
                                                    <i class="fa fa-trash"></i>
                                                    Remove
                                                </button>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Hardwares
                            </td>
                            <td>
                                <div ng-repeat="a_s in _hardware">
                                    <div style="display:inline-block">
                                        {{a_s.spec_remark}}
                                    </div>
                                    <?php
                                    if ($_update_access === true) {
                                    ?>
                                        <div style="display:inline-block">
                                            <button ng-if="'<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='operation' || '<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='Management'" ng-if="newproject.project_hadnover !== '3'" type="button" ng-click="edit_alu_spec(a_s.spec_id,a_s.spec_remark,'finish','1','Edit - Finish Specification')" class="ism-btns btn-save" style="padding:2px 3px">
                                                <i class="fa fa-pencil"></i>
                                                Edit
                                            </button>
                                        </div>
                                        <div style="display:inline-block;">
                                            <button ng-if="'<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='operation' || '<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='Management'" ng-if="newproject.project_hadnover !== '3'" ng-click="remove_alu_spec(a_s.spec_id)" type="button" class="ism-btns btn-delete" style="padding:2px 3px">
                                                <i class="fa fa-trash"></i>
                                                Remove
                                            </button>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="height:25px"></div>
        </div>

    </div>
    <div style="height:25px"></div>
</div>

<?php
include_once('Dialogbox/index.php');
include_once('Dialogbox/conditions.php');
include_once('Dialogbox/terms.php');
include_once('Dialogbox/uploadpdf.php');
include_once('Dialogbox/spec.php');
?>


<style>
    .ism-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
        margin-bottom: 10px;
        margin-top: 10px;
    }

    .ism-table th {
        background-color: #2c445c;
        color: #fff;
        font-weight: 400;
        padding: 3px 5px;
        text-align: left;
        border: 1px solid #2c445c;
    }

    .ism-table td {
        padding: 3px 5px;
        border: 1px solid #2c445c;
        background: #ffffff9e;
    }

    .dashboard-modal {
        display: none;
        position: fixed;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        z-index: 3;
        background-color: #34333354;
        overflow: auto;
        padding-top: 20px;
        backdrop-filter: blur(20px) saturate(180%);
        z-index: 99999999;
    }

    .dashboard-modal-container {
        background-color: #e9e9e952;
        width: 800px;
        margin: 0 auto;
        border-radius: 8px;
        color: #000;
        padding: 0px 10px;
        font-family: segoeui;
        /* backdrop-filter: grayscale(1); */
        box-shadow: -4px -2px 15px 2px #9f9f9f78;
    }

    .dashboard-modal-title {
        color: #0603c8;
        font-size: 16px;
        font-weight: bolder;
        padding: 13px 0px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .dashboard-modal-title i {
        color: #000;
        transition: all 0.2s;
    }

    .dashboard-modal-title i:hover {
        color: #f00;

    }

    .dasboard-modal-foot {
        padding: 20px 0px;
    }

    .list-of-employees-container {
        padding: 10px 20px;
        margin-top: 14px;
        height: 80%;
        overflow: auto;
    }

    .list-of-employees-container .ism-table {
        font-size: 14px;
    }

    .modal-employee-card {
        font-family: overpass;
        border: 1px dashed #1900d8;
        background-color: #f1f1f147;
        border-radius: 10px;
        box-shadow: inset -4px -7px 8px #baaeff38;
        padding: 17px 16px;
        display: flex;
        justify-content: center;
        margin-bottom: 15px;
    }

    .modal-employee-card-image {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .modal-employee-card-image-disp img {
        width: 100px;
        height: 100px;
        border-radius: 100%;
        margin-bottom: 12px;
    }

    .modal-employee-card-image-disp-fileno {
        font-size: 16px;
        color: #0603c8;
        font-weight: 700;
    }

    .modal-employee-card-details {
        margin-left: 30px;
    }

    .modal-employee-card-details-info {
        display: flex;
        align-items: center;
        width: 500px;
        margin-bottom: 5px;
        font-size: 16px;
    }

    .employee-card-details-info-lable {
        width: 150px;
    }

    .employee-card-details-info-cemi {
        width: 10px;
    }

    .employee-card-details-info-detatils {
        width: 335px;
        font-weight: bold;
        color: #0603c8
    }

    .dashboard-modal-frms center .i:hover {
        color: #005f48;
    }

    .danger-border {
        border: 1px dashed #ff0000;
        box-shadow: inset 4px 6px 20px #ff000026;
    }

    .danger-border .modal-employee-card-image .modal-employee-card-image-disp-fileno,
    .danger-border .modal-employee-card-details .modal-employee-card-details-info .employee-card-details-info-detatils {
        color: #550000;
    }

    .tanger-tr td {
        background: #ffe7e7;
        color: #550000;
    }

    .dashboard-modal-frms i {
        padding: 4px;
    }
</style>
<div class="dashboard-modal" id="dia_dashboard_employee_list">
    <div class="dashboard-modal-container">
        <div class="dashboard-modal-title">
            <div>
                {{employeelist_title}} LIST
            </div>
            <div>
                <i class="fa fa-times" onclick="document.getElementById('dia_dashboard_employee_list').style.display='none'"></i>
            </div>
        </div>
        <div class="dashboard-modal-body">
            <div class="dashboard-modal-search">
                <div class="dashboard-modal-frms" ng-show="bfsearch">
                    <center>
                        <form name="getmanpower" id="manpower_reports" ng-submit="man_power_report_submit()">

                            Date : <input type="text" ng-model="srcmanpower_date" class="ism-inputs" id="date_search" name='date_search' ng-modal="srcmanpower.date_search" style="margin:0 auto;width:250px;" placeholder="Enter Date" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="manpower_csigdate">
                            <input type="text" id="manpower_project_no" name="manpower_project_no" ng-modal="srcmanpower.project_no" class="ism-inputs" style="margin:0 auto;width:350px;display:none" placeholder="Search..." readonly>
                            <button type="submit" ng-disabled="getmanpower.$invalid" class="ism-btns btn-save" style="padding:2px 2px;"><i class="fa fa-check"></i> Search</button>
                        </form>
                    </center>

                </div>
                <div class="dashboard-modal-frms" ng-show='afsearch'>
                    <center>
                        <input ng-show="!viewinfos" type="text" ng-model="srcemp" class="ism-inputs" style="margin:0 auto;width:350px;" placeholder="Search...">
                        <input ng-show="viewinfos" type="text" ng-model="srccate" class="ism-inputs" style="margin:0 auto;width:350px;" placeholder="Search...">
                        <i class="fa fa-info-circle info-i" ng-click="showinfos()"></i>
                        <i class="fa fa-table table-i" ng-click="showtable()"></i>
                        <i class="fa fa-list card-i" ng-click="showcard()"></i>
                        <i ng-click="againsearch()" class="fa fa-search" style="color:red"></i>
                    </center>
                </div>
            </div>
            <div ng-show="viewcard && afsearch" class="list-of-employees-container">
                <div class="modal-employee-card {{employee.estatus !== '1' ? 'danger-border': ''}}" ng-repeat="employee in employees | filter:srcemp | orderBy:'efile'">
                    <div class="modal-employee-card-image">
                        <div class="modal-employee-card-image-disp">
                            <img loading="lazy" ng-if="employee.f==='1'" src="<?php echo $base_url ?>/uploads/staffs/{{employee.efile}}.jpg">
                            <img loading="lazy" ng-if="employee.f==='0'" src="<?php echo $base_url ?>/uploads/staffs/000.png">
                        </div>
                        <div class="modal-employee-card-image-disp-fileno">
                            File NO : {{employee.efile}}
                        </div>
                    </div>
                    <div class="modal-employee-card-details">
                        <div class="modal-employee-card-details-info">
                            <div class="employee-card-details-info-lable">
                                Name
                            </div>
                            <div class="employee-card-details-info-cemi">
                                :
                            </div>
                            <div class="employee-card-details-info-detatils">
                                {{employee.ename | capitalize}}
                            </div>
                        </div>
                        <div class="modal-employee-card-details-info">
                            <div class="employee-card-details-info-lable">
                                Designation
                            </div>
                            <div class="employee-card-details-info-cemi">
                                :
                            </div>
                            <div class="employee-card-details-info-detatils">
                                {{employee.eposition |  capitalize}}
                            </div>
                        </div>

                        <div class="modal-employee-card-details-info">
                            <div class="employee-card-details-info-lable">
                                Location
                            </div>
                            <div class="employee-card-details-info-cemi">
                                :
                            </div>
                            <div class="employee-card-details-info-detatils">
                                {{employee.elocation | capitalize}}
                            </div>
                        </div>
                        <div class="modal-employee-card-details-info">
                            <div class="employee-card-details-info-lable">
                                Category
                            </div>
                            <div class="employee-card-details-info-cemi">
                                :
                            </div>
                            <div class="employee-card-details-info-detatils">
                                {{employee.ecategory | capitalize}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div ng-show="viewtable  && afsearch" class="list-of-employees-container">
                <table class="ism-table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>File No</th>
                            <th>Designation</th>
                            <th>Department</th>
                            <th>Location</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="employee in employees | filter:srcemp | orderBy:'efile'" class="{{employee.estatus !== '1' ? 'tanger-tr':''}}">
                            <td>{{$index+1}}</td>
                            <td>{{employee.efile}}</td>
                            <td>{{employee.ename | capitalize}}</td>
                            <td> {{employee.eposition |  capitalize}}</td>
                            <td> {{employee.elocation | capitalize}}</td>
                            <td> {{employee.ecategory | capitalize}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div ng-show="viewinfos && afsearch" class="list-of-employees-container">
                <table class="ism-table" style="margin-bottom:5px">
                    <tr>
                        <td>Project Name </td>
                        <td style="font-weight:bold">{{manpower_pinfos.projectname}}</td>
                    </tr>
                    <tr>
                        <td>Date </td>
                        <td style="font-weight:bold">{{manpower_pinfos.mdate}}</td>
                    </tr>
                    <tr>
                        <td>Region </td>
                        <td style="font-weight:bold">{{manpower_pinfos.projectregion}}</td>
                    </tr>
                    <tr>
                        <td>Project Manager </td>
                        <td style="font-weight:bold">{{manpower_pinfos.mangername | ifnan}} - ({{manpower_pinfos.managerfileno | ifnan}})</td>
                    </tr>

                    <tr>
                        <td>Project Engineer </td>
                        <td style="font-weight:bold">{{manpower_pinfos.engname | ifnan}} - ({{manpower_pinfos.engfileno | ifnan}})</td>
                    </tr>

                    <tr>
                        <td>Foreman Name </td>
                        <td style="font-weight:bold">{{manpower_pinfos.formanname | ifnan}} - ({{manpower_pinfos.foremanfileno | ifnan}})</td>
                    </tr>
                    <tr>
                        <td>Leadman/Chargehand Name </td>
                        <td style="font-weight:bold">{{manpower_pinfos.formatsubname | ifnan}} - ({{manpower_pinfos.formansubfileno | ifnan}})</td>
                    </tr>
                </table>
                <table class="ism-table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Designation</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="det in details | filter:srccate | orderBy:'eposition'">
                            <td>{{$index+1}}</td>
                            <td>{{det.eposition | capitalize}}</td>
                            <td>{{det.cnt}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Total</td>
                            <td>{{workerinfototal}}</td>
                        </tr>
                    </tbody>
                </table>


            </div>
        </div>
        <div class="dasboard-modal-foot">
            <button type="button" class="ism-btns btn-delete" onclick="document.getElementById('dia_dashboard_employee_list').style.display='none'">
                <i class="fa fa-times"></i>
                Close
            </button>
        </div>
    </div>
</div>

<?php 
    include_once './Dialogbox/handover.php';
?>