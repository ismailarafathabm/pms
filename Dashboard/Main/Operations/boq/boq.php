<?php
session_start();
include_once('../../../../conf.php');
$userdep = $_SESSION['nafco_alu_user_department'];
$username = $_SESSION['nafco_alu_user_name'];
$update_access = ['demo', 'operation@alunafco.com'];
$_update_access = false;

foreach ($update_access as $a) {
    if (strtolower($username) === strtolower($a)) {
        $_update_access = true;
        break;
    }
}
$price_access = ['superadmin', 'operation', 'Management', 'accounts', 'contract and operations', 'estimate', 'naser'];
$_price_acces = false;
foreach ($price_access as $p) {
    if ($userdep === $p) {
        $_price_acces = true;
    }
}

$_priceaccess_user = ['wagdy'];
foreach ($_priceaccess_user as $p) {
    if ($username === $p) {
        $_price_acces = true;
    }
}

$_print_access = false;
$_printaccessuser = ['naser'];
foreach ($_printaccessuser as $p) {
    if ($username === $p) {
        $_print_access = true;
    }
}

if ($userdep === "engineeringuser") {
    $_print_access = true;
}

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
                <div class="rpt-backbtn" id="back_btn">
                    <i class="fa fa-arrow-left"></i>
                </div>
                PROJECT BOQ <span style="font-size:9px;font-family:overpass;margin-left:5px">Project Bill of Quantity</span>
            </div>
            <div class="sub-container-right">
                <?php
                if ($xusername === "naser") {
                ?>
                    <a ng-if="viewproject.project_boq_refno!==''" class="ism-btns btn-normal" href="<?php echo $url_base ?>Print/project_boq.php?project_code={{viewproject.project_no | lowercase}}" target="_blank" style="margin-right: 4px;">
                        <i class="fa fa-print"></i>
                        Print
                    </a>
                <?php
                }
                ?>
                <?php
                if ($_price_acces === true) {
                ?>
                    <a ng-if="viewproject.project_boq_refno!==''" class="ism-btns btn-normal" href="<?php echo $url_base ?>Print/project_boq.php?project_code={{viewproject.project_no | lowercase}}" target="_blank" style="margin-right: 4px;">
                        <i class="fa fa-print"></i>
                        Print
                    </a>
                    <button id="exportexcel" class="ism-btns btn-normal" style="display: none;">
                        <i class="fa fa-file-excel-o"></i>
                        Export Excel
                    </button>
                    <?php
                }
                if ($_print_access === true) {
                    if ($username === "wagdy") {
                    } else {
                    ?>
                        <button id="exportexcel" class="ism-btns btn-normal" style="display: none;">
                            <i class="fa fa-file-excel-o"></i>
                            Export Excel
                        </button>
                <?php
                    }
                }
                ?>

                <button ng-click="show_miss_items()" ng-if="viewproject.project_boq_refno !=='' && isshowmiscellaneousitems " class="ism-btns btn-normal">
                    <i class="fa fa-info"></i>
                    M.R - Miscellaneouse Items
                </button>



                <?php
                if ($_update_access === true) {
                ?>
                    <button ng-if="viewproject.project_boq_refno!==''" class="ism-btns btn-save" onclick="document.getElementById('dianewboqadd').style.display='block'">
                        <i class="fa fa-plus"></i>
                        New BOQ Item
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
        <!-- add boq ref numbers -->
        <?php
        $accessusers = ['demo', 'operation@alunafco.com'];
        $accessBoqRefno = false;
        foreach ($accessusers as $useraac) {
            if ($useraac === $username) {
                $accessBoqRefno = true;
                break;
            }
        }

        if ($accessBoqRefno === true) {
        ?>
            <div ng-show="!isloading" class="sub-body-container-contents" ng-if="viewproject.project_boq_refno ===''">
                <form name="refno_upate_boq" ng-submit="upate_boq_refno()">
                    <div class="dialog-row-sm">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                #REF - NO
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" name="boq_refno" id="boq_refno" class="nafco-inputs" value="{{viewproject.project_boq_refno}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="dialog-row-sm">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                #Revision No - NO
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" name="boq_refno" id="boq_revision" class="nafco-inputs" value="{{viewproject.project_boq_revision}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="dialog-row-sm" style="margin-left: 379px;">
                        <button ng-disabled="refno_upate_boq.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                            <i ng-if="refno_upate_boq.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                            <i ng-if="!refno_upate_boq.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                            Save
                        </button>
                    </div>
                </form>
            </div>
        <?php
        }
        ?>

        <!-- add boq ref numbers -->

        <!-- boq informations -->
        <div ng-show="!isloading" class="sub-body-container-contents" ng-if="viewproject.project_boq_refno !==''">
            <h4 style='margin-left:20px'>REF NO :<span style="font-size:18px;color:#ca0000"> {{viewproject.project_boq_refno}}</span></h4>
            <h4 style='margin-left:20px'>Rev NO :<span style="font-size:18px;color:#ca0000"> {{viewproject.project_boq_revision}}</span></h4>
            <div class="dialog-row-sm" style="margin-right: 19px;
    padding: 5px;
    float: right;
    background: #c4d0d2;">

                <div class="dialog-frm-ctrls">
                    <div class="dialog-frm-lable">
                        Search
                    </div>
                    <div class="dialog-frm-cemi">:</div>
                    <div class="dialog-frm-controls">
                        <input type="text" class="nafco-inputs" ng-model="srcall" required>
                    </div>
                </div>
            </div>

            <table id="boqtable" class="table-boq">
                <thead>
                    <tr>
                        <th class="boq-head">Item No</th>
                        <th class="boq-head">Description</th>
                        <th class="boq-head">Qty</th>
                        <th class="boq-head">Unit</th>
                        <?php
                        if ($_price_acces === true) {
                        ?>
                            <th class="boq-head">
                                Unit Price
                            </th>
                        <?php
                        }
                        ?>
                        <th class="boq-head">Area</th>
                        <?php
                        if ($_price_acces === true) {
                        ?>
                            <th class="boq-head">
                                Total Price
                            </th>
                        <?php
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="_b in projectboq.boq | orderBy:'poq_id' | filter:srcall">
                        <td style="text-align:center;border-bottom: 2px solid #ca0000;">
                            {{_b.boq_info.poq_item_no}}
                            <button ng-if="(+_b.mrcount) !== 0" type="button" ng-click="getboqinfo(_b.boq_info.poq_id)" class="ism-btns btn-close">
                                <i class="fa fa-info"></i>
                            </button>
                            <?php

                            if ($_update_access === true) {
                            ?>
                                <button type="button" ng-click="getboqinfosfroedit(_b.boq_info.poq_id)" class="ism-btns btn-close">
                                    <i class="fa fa-edit"></i>
                                </button>
                            <?php
                            }
                            ?>
                        </td>
                        <td style="border-bottom: 2px solid #ca0000;">
                            <table class="table-boq-sub">
                                <tr>
                                    <td class="boq-sub-titles algright">Type</td>
                                    <td colspan="4">
                                        {{_b.boq_info.ptype_name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="boq-sub-titles algright"></td>
                                    <td colspan="4">
                                        {{_b.boq_info.poq_item_remark}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="boq-sub-titles algright">Location</td>
                                    <td colspan="4">
                                        {{_b.boq_info.poq_remark}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="boq-sub-titles algright">Area</td>
                                    <td class="boq-sub-titles">WIDTH (MM)</td>
                                    <td class="boq-sub-titles">HEIGHT (MM)</td>
                                    <td class="boq-sub-titles" colspan="2">
                                        AREA(MM)
                                    </td>
                                </tr>
                                <tr>
                                    <td class="boq-sub-titles"></td>
                                    <td>{{_b.boq_info.poq_item_width}}</td>
                                    <td>{{_b.boq_info.poq_item_height}}</td>
                                    <td colspan="2">
                                        {{_b.boq_info.area}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="boq-sub-titles algright">Glass</td>
                                    <td colspan="4">
                                        {{_b.boq_info.poq_item_glass_spec}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="boq-sub-titles"></td>
                                    <td>SINGLE</td>
                                    <td>{{_b.boq_info.poq_item_glass_single}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="boq-sub-titles" style="width:10%"></td>
                                    <td style="width:22.5%">DOUBLE</td>
                                    <td style="width:22.5%">{{_b.boq_info.poq_item_glass_double1}}</td>
                                    <td style="width:22.5%">{{_b.boq_info.poq_item_glass_double2}}</td>
                                    <td style="width:22.5%">{{_b.boq_info.poq_item_glass_double3}}</td>
                                </tr>
                                <tr>
                                    <td class="boq-sub-titles"></td>
                                    <td>LAMINATED</td>
                                    <td>{{_b.boq_info.poq_item_glass_laminate1}}</td>
                                    <td>{{_b.boq_info.poq_item_glass_laminate2}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="boq-sub-titles algright">Drawing</td>
                                    <td colspan="4">{{_b.boq_info.poq_drawing}}</td>
                                </tr>
                                <tr>
                                    <td class="boq-sub-titles algright">Finish</td>
                                    <td colspan="4">{{_b.boq_info.finish_name}}</td>
                                </tr>
                                <tr>
                                    <td class="boq-sub-titles algright">System</td>
                                    <td colspan="4">{{_b.boq_info.system_type_name}}</td>
                                </tr>
                                <tr>
                                    <td class="boq-sub-titles algright">Notes </td>
                                    <td colspan="4" style="padding:3px;">
                                        <table class='boq-sub-notes '>
                                            <tr ng-repeat="nts in _b.boq_info.notes" style="border: 1px solid #8b4288 !important;">
                                                <td style="width:90%;border: 1px solid #8b4288 !important;">
                                                    {{nts.boq_note_notes}}
                                                </td>
                                                <td style="width:20%;border: 1px solid #8b4288 !important;">
                                                    <?php

                                                    if ($_update_access === true) {
                                                    ?>
                                                        <button ng-click="rmv_notes(nts.boq_note_id)" id="rem_boq_notes" class="ism-btn btn-delete">
                                                            <i class="fa fa-trash"></i>
                                                            Remove
                                                        </button>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:90%;border: 1px solid #8b4288 !important;"></td>
                                                <td style="width:20%;border: 1px solid #8b4288 !important;">
                                                    <?php
                                                    if ($_update_access === true) {
                                                    ?>
                                                        <button class="ism-btn btn-save" type="button" id="save_boqifo" name="boq_notes" ng-click="save_boq_notes(_b.boq_info.poq_item_no)">
                                                            <i class="fa fa-plus"></i>
                                                            Add</button>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="border-bottom: 2px solid #ca0000;">
                            {{_b.boq_info.poq_qty | number:2}}
                        </td>
                        <td style="border-bottom: 2px solid #ca0000;">
                            {{_b.boq_info.unit_name}}
                        </td>
                        <?php
                        if ($_price_acces === true) {
                        ?>
                            <td style="font-weight:600;text-align:right;border-bottom: 2px solid #ca0000;">
                                {{_b.boq_info.poq_uprice | number:2}}
                            </td>
                        <?php
                        }
                        ?>
                        <td style="border-bottom: 2px solid #ca0000;">
                            {{_b.boq_info.item_aras}}
                        </td>
                        <?php
                        if ($_price_acces === true) {
                        ?>
                            <td style="font-weight:600;text-align:right;border-bottom: 2px solid #ca0000;">
                                {{_b.boq_info.tot | number:2}}
                            </td>
                        <?php
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
        <table class="table-boq" id="boqtablex" style="display: none;">
            <thead>
                <tr>
                    <th class="boq-head">Contract NO</th>
                    <th class="boq-head" colspan="11"> {{viewproject.project_no | uppercase}} </th>
                </tr>
                <tr>
                    <th class="boq-head">Project Name</th>
                    <th class="boq-head" colspan="11">Project Name : {{viewproject.project_name | uppercase}}</th>
                </tr>
                <tr>
                    <th class="boq-head">Item No</th>
                    <th class="boq-head" colspan="6">Description</th>
                    <th class="boq-head">Qty</th>
                    <th class="boq-head">Unit</th>
                    <th class="boq-head"> Unit Price</th>
                    <th class="boq-head"> Area</th>
                    <th class="boq-head">Total Price</th>
                </tr>
            </thead>
            <tbody id="dipboq">

            </tbody>
        </table>
        <!-- boq informations -->


        <div class="sub-body-container-title" ng-if="viewproject.project_boq_refno !==''">
            <div class="sub-container-left">
                BOQ Special notes
            </div>
            <div class="sub-container-right">

                <?php
                if ($_update_access === true) {
                ?>
                    <button class="ism-btns btn-save" ng-click="boqnotenew()">
                        <i class="fa fa-plus"></i>
                        New Special Notes
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

        <div ng-show="!isloading" class="sub-body-container-contents" style="margin-bottom:25px;" ng-if="viewproject.project_boq_refno !==''">
            <table class="naf-tables" style="white-space: normal!important;">
                <thead>
                    <tr>
                        <th class="fiexdheader" width="20px">S.No</th>
                        <th class="fiexdheader" width="500px">Notes</th>
                        <th class="fiexdheader" width="200px">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="it in ksboqitemsnotes">
                        <td>{{$index+1}}</td>
                        <td class="{{it.notesimportats==='1' ? 'bold-red':'';}} {{it.notesimportats==='3' ? 'bold-blue':'';}}">
                            {{it.notesdescription}}
                        </td>
                        <td style="display:flex;align-items: center;">
                            <?php
                            if ($_update_access === true) {
                            ?>
                                <button class="ism-btns btn-save" ng-click="spitemnotesedit(it)" style="padding:4px 5px;margin-right: 5px;">
                                    <i class="fa fa-pencil mr-1"></i>
                                    Edit</button>
                                <button class="ism-btns btn-delete" ng-click="removen(it.notesid)" style="padding:4px 5px">
                                    <i class="fa fa-trash-o mr-1"></i>
                                    Remove</button>

                            <?php
                            }
                            ?>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- boq special notes Add -->
<div class="ism-dialogbox" id="boqitemsnew">
    <div class="dia_main-bodyinfos">
        <div class="ism-dialog-body" style="max-width:620px">
            <div class="dialog-head">
                <div class="dialog-head-title">
                    <span class="fa fa-plus"></span>
                    Add New BOQ Special Note
                </div>
                <div class="dialog-closebutton" onclick="document.getElementById('boqitemsnew').style.display='none'">
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <form name="boqnotesnews" id="boqnotesnews" ng-submit="savenewboqnotes()">
                <div class="dialog-body">
                    <div class="dialog-row-sm">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Notes
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <textarea rows="3" ng-model="newboqnotes.notesdescription" name="notesdescription" class="nafco-inputs" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="dialog-row-sm">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Type
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <select ng-model="newboqnotes.notesimportats" name="notesimportats" class="nafco-inputs" required>
                                    <option value="">-select-</option>
                                    <option value="1">Important</option>
                                    <option value="3">semi-Important</option>
                                    <option value="2">Normal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dialog-foot">
                    <div class="dialog-foot-buttons">
                        <button type="button" class="ism-btns btn-close" onclick="document.getElementById('boqitemsnew').style.display='none'">
                            <i class="fa fa-times"></i>
                            Close
                        </button>
                        <button ng-disabled="boqnotesnews.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                            <i ng-if="boqnotesnews.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                            <i ng-if="!boqnotesnews.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- boq special notes -->
<!-- boq special note edit -->
<div class="ism-dialogbox" id="dia_boqitemsEdits">
    <div class="dia_main-bodyinfos">
        <div class="ism-dialog-body" style="max-width:620px">
            <div class="dialog-head">
                <div class="dialog-head-title">
                    <span class="fa fa-pencil"></span>
                    Edit BOQ Special Note
                </div>
                <div class="dialog-closebutton" onclick="document.getElementById('dia_boqitemsEdits').style.display='none'">
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <form name="boqnotesEdit" id="boqnotesEdit" ng-submit="Editboqnotes()">
                <div class="dialog-body">
                    <div class="dialog-row-sm">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Notes
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <textarea rows="3" ng-model="boqitemsEdit.notesdescription" name="notesdescription" class="nafco-inputs" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="dialog-row-sm">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Type
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <select ng-model="boqitemsEdit.notesimportats" name="notesimportats" class="nafco-inputs naf" required>
                                    <option value="">-select-</option>
                                    <option value="1">Important</option>
                                    <option value="3">semi-Important</option>
                                    <option value="2">Normal</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="dialog-row-sm nodis">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                id
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <textarea rows="3" ng-model="boqitemsEdit.notesid" name="notesdescription" class="nafco-inputs" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dialog-foot">
                    <div class="dialog-foot-buttons">
                        <button type="button" class="ism-btns btn-close" onclick="document.getElementById('dia_boqitemsEdits').style.display='none'">
                            <i class="fa fa-times"></i>
                            Close
                        </button>
                        <button ng-disabled="boqnotesEdit.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                            <i ng-if="boqnotesEdit.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                            <i ng-if="!boqnotesEdit.$invalid" class=" fa fa-pencil" style="color:#84cccf"></i>
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- boq special note edit -->
<?php
include_once('aboq.php');
include_once('boqEdit.php');
include_once('boqdia.php');
include_once 'mr.dia.php';
?>
<iframe id="txtArea1" style="display:none"></iframe>
<script type="text/javascript">
    //     var ExportToExcel = (function() {
    //         var encabezado = `<html><head><meta http-equiv="content-type 
    //   content="text/plain; charset=UTF-8"/><style> table, td {border:thin solid 
    //   black} table {border-collapse:collapse}</style></head><body><table>`;
    //         var table = document.getElementById("boqtablex");
    //         var dataTable = table.innerHTML
    //         var piePagina = "</table></body></html>";
    //         var tabla = encabezado + dataTable + piePagina;
    //         var myBlob = new Blob([tabla], {
    //             type: 'text/html'
    //         });
    //         var url = window.URL.createObjectURL(myBlob);
    //         var a = document.createElement("a");
    //         document.body.appendChild(a);
    //         a.href = url;
    //         a.download = "export.xls";
    //         a.click();

    //         setTimeout(function() {
    //             window.URL.revokeObjectURL(url);
    //         }, 0);
    //     });


    // var ExportToExcel = (function() {
    //     var uri = 'data:application/vnd.ms-excel;base64,',
    //         template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
    //         base64 = function(s) {
    //             return window.btoa(unescape(encodeURIComponent(s)))
    //         },
    //         format = function(s, c) {
    //             return s.replace(/{(\w+)}/g, function(m, p) {
    //                 return c[p];
    //             })
    //         }
    //     return function() {
    //         console.log("cllaed")
    //         let  table = document.getElementById("boqtablex")
    //         var ctx = {
    //             worksheet: name || 'Worksheet',
    //             table: table.innerHTML
    //         }

    //         window.location.href = uri + base64(format(template, ctx))
    //     }
    // })()
</script>

<script>
    // window.print();
    $("#exportexcel").click(function() {
        $("#boqtablex").table2excel({
            // exclude CSS class
            exclude: ".noExl",
            name: "Worksheet Name",
            filename: "SomeFile", //do not include extension
            fileext: ".xls" // file extension
        });
    });
</script>