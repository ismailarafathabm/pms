<?php
session_start();
include_once('../../../../conf.php');
$userdep = $_SESSION['nafco_alu_user_department'];
$update_access = ['superadmin', 'engineering'];
$_update_access = false;
foreach ($update_access as $a) {
    if ($userdep === $a) {
        $_update_access = true;
        break;
    }
}
$price_access = ['superadmin', 'engineering', 'Management', 'engineeringuser'];
$_price_acces = false;
foreach ($price_access as $p) {
    if ($userdep === $p) {
        $_price_acces = true;
    }
}
include_once('../../menu.php');
?>



<div class="sub-body">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" id="back_btn">
                    <i class="fa fa-arrow-left"></i>
                </div>
                {{'Cutting List & MO Released To productions' | uppercase}}
            </div>
            <div class="sub-container-right">
                <?php
                if ($_price_acces === true) {
                ?>
                    <button onclick="tableToExcel('cuttinglist', 'Cutting List')" class="ism-btns btn-normal">
                        <i class="fa fa-file-excel-o"></i>
                        Export Excel
                    </button>
                <?php
                }
                ?>

                <?php
                if ($_update_access === true) {
                ?>
                    <button type="button" onclick="document.getElementById('new-cuttinglist').style.display='block'" class="ism-btns btn-normal">
                        <i class="fa fa-plus"></i>
                        Add
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

            <table class="naf-tables">
                <thead>
                    <tr>
                        <th class="fiexdheader">S.No</th>
                        <th class="fiexdheader">BOQ Item</th>
                        <th class="fiexdheader">Type</th>
                        <th class="fiexdheader"></th>
                        <th class="fiexdheader">CL.REF No</th>
                        <th class="fiexdheader">CL.Date Released</th>
                        <th class="fiexdheader">MO.Ref NO</th>
                        <th class="fiexdheader">MO.Released To Acct</th>
                        <th class="fiexdheader">MO.Released To Production</th>
                        <th class="fiexdheader">Released To</th>
                        <th class="fiexdheader">Done By</th>
                        <th class="fiexdheader">Marking Type</th>
                        <th class="fiexdheader">Desscription</th>
                        <th class="fiexdheader">Location</th>
                        <th class="fiexdheader">Qty</th>
                        <th class="fiexdheader">Height</th>
                        <th class="fiexdheader">Width</th>
                        <th class="fiexdheader">AREA.SQM</th>
                        <th class="fiexdheader">Tot.Area</th>
                        <th class="fiexdheader">Glass Ref. No.</th>
                        <th class="fiexdheader">SHEET TYPE</th>
                        <th class="fiexdheader">REMARK</th>
                        <th class="fiexdheader">SECTION</th>
                    </tr>
                    <tr class="nx">
                        <th class="bg-whites">

                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fi.cuttinglist_boqitem" class="nafco-inputs" placeholder="Search..">
                        </th>
                        <th class="bg-whites">
                            <select ng-model='fi.cuttinglistfor'>
                                <option value="">All</option>
                                <option value="1">BOQ ITEMS</option>
                                <option value="2">MISCELLANEOUS ITEMS</option>
                            </select>
                        </th>
                        <th class="bg-whites"></th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fi.cuttinglist_clrefno" class="nafco-inputs" placeholder="Search..">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fi.cuttinglist_cldaterelease" class="nafco-inputs" placeholder="Search..">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fi.cuttinglist_morefno" class="nafco-inputs" placeholder="Search..">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fi.cuttinglist_moreleasedtoacct" class="nafco-inputs" placeholder="Search..">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fi.cuttinglist_moreleasedtoproduction" class="nafco-inputs" placeholder="Search..">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fi.cuttinglist_releasedto" class="nafco-inputs" placeholder="Search..">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fi.cuttinglist_doneby" class="nafco-inputs" placeholder="Search..">
                        </th>
                        <th class="bg-whites">

                            <input type="text" ng-model="fi.cuttinglist_markingtype" class="nafco-inputs" placeholder="Search..">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fi.cuttinglist_descripton" class="nafco-inputs" placeholder="Search..">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fi.cuttinglist_location" class="nafco-inputs" placeholder="Search..">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fi.cuttinglist_qty" class="nafco-inputs" placeholder="Search..">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fi.cuttinglist_height" class="nafco-inputs" placeholder="Search..">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fi.cuttinglist_width" class="nafco-inputs" placeholder="Search..">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fi.cuttinglist_area" class="nafco-inputs" placeholder="Search..">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fi.cuttinglist_totarea" class="nafco-inputs" placeholder="Search..">
                        </th>

                        <th class="bg-whites">
                            <input type="text" ng-model="fi.cuttinglist_classrefno" class="nafco-inputs" placeholder="Search..">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fi.cuttinglist_sheettp" class="nafco-inputs" placeholder="Search..">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fi.cuttinglist_remarks" class="nafco-inputs" placeholder="Search..">
                        </th>

                        <th class="bg-whites">
                            <input type="text" ng-model="fi.cuttinglist_section" class="nafco-inputs" placeholder="Search..">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-class-odd="'oddtr'" ng-repeat="ct in cuttinglist | filter:fi | orderBy:'cuttinglist_cldaterelease'">
                        <td>
                            {{$index+1}}
                        </td>
                        <td>
                            {{ct.cuttinglist_boqitem}}
                        </td>
                        <td ng-if="ct.cuttinglistfor==='1'">
                            BOQ ITEMS
                        </td>
                        <td ng-if="ct.cuttinglistfor==='2'">
                            MISCELLANEOUS ITEMS
                        </td>
                        <td>
                            <div ng-if="ct.file === '1'">
                                <a target="_blank" href="<?php echo $url_base ?>viewuploads.php?foldertoken={{ct.cuttinglist_token}}">
                                    <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                                </a>
                            </div>
                        </td>
                        <td>
                            <?php
                            if ($_update_access === true) {
                            ?>
                                <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" ng-click="edit_cuttinglist(ct)">
                                    <i class="fa fa-edit"></i>
                                    {{ct.cuttinglist_clrefno}}
                                </button>
                            <?php

                            } else {
                            ?>
                                {{ct.cuttinglist_clrefno}}
                            <?php
                            }
                            ?>

                        </td>
                        <td>
                            {{ct.cuttinglist_cldaterelease}}
                        </td>

                        <td>
                            {{ct.cuttinglist_morefno}}
                        </td>

                        <td>
                            {{ct.cuttinglist_moreleasedtoacct}}
                        </td>

                        <td>
                            {{ct.cuttinglist_moreleasedtoproduction}}
                        </td>
                        <td>
                            {{ct.cuttinglist_releasedto}}
                        </td>
                        <td>
                            {{ct.cuttinglist_doneby}}
                        </td>
                        <td>
                            {{ct.cuttinglist_markingtype}}
                        </td>
                        <td style="font-size:9px;">
                            {{ct.cuttinglist_descripton}}
                        </td>
                        <td style="font-size:9px;">
                            {{ct.cuttinglist_location}}
                        </td>
                        <td>
                            {{ct.cuttinglist_qty}} {{ct.cuttinglist_qty_type | uppercase}}
                        </td>
                        <td>
                            {{ct.cuttinglist_height}}
                        </td>
                        <td>
                            {{ct.cuttinglist_width}}
                        </td>
                        <td>
                            {{ct.cuttinglist_area | number :'2'}}
                        </td>
                        <td>
                            {{ct.cuttinglist_totarea | number :'2'}}
                        </td>
                        <td>
                            <button ng-if="ct.cuttinglist_classrefno !== 'N/A'" type="button" class="ism-btns btn-normal" style="padding:2px 5px" ng-click="glassorderslists(ct.cuttinglist_classrefno)">
                                {{ct.cuttinglist_classrefno}}
                            </button>
                        </td>
                        <td>
                            {{ct.cuttinglist_sheettp}}
                        </td>
                        <td style="font-size:10px;">
                            {{ct.cuttinglist_remarks}}
                        </td>
                        <td>
                            {{ct.cuttinglist_section}}
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div style="display:none;">
    <table class="project-list-table borderd drawing-approvals" id="cuttinglist">
        <thead>
            <tr>
                <th style="width:500px">CL.REF No</th>
                <th style="width:400px">CL.Date Released</th>
                <th style="width:100px">MO.Ref NO</th>
                <th style="width:220px">MO.Released To Acct</th>
                <th style="width:220px">MO.Released To Production</th>
                <th style="width:100px">Released To</th>
                <th style="width:100px">Done By</th>
                <th style="width:70px">Marking Type</th>
                <th style="width:1250px">Desscription</th>
                <th style="width:450px">Location</th>
                <th style="width:35px">Qty</th>
                <th style="width:35px">Height</th>
                <th style="width:35px">Width</th>
                <th style="width:65px">AREA.SQM</th>
                <th style="width:180px">Glass Ref. No.</th>
                <th style="width:100px">SHEET TYPE</th>
                <th style="width:850px">REMARK</th>
                <th style="width:20px">SECTION</th>
                <th style="width:150px"></th>

            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="ct in cuttinglist | filter:fi">
                <td>
                    <button type="button" class="nafco-button nafco-btn-danger" ng-click="edit_cuttinglist(ct)">
                        <i class="fa fa-edit"></i>
                        {{ct.cuttinglist_clrefno}}
                    </button>
                </td>
                <td>
                    {{ct.cuttinglist_cldaterelease}}
                </td>

                <td>
                    {{ct.cuttinglist_morefno}}
                </td>

                <td>
                    {{ct.cuttinglist_moreleasedtoacct}}
                </td>

                <td>
                    {{ct.cuttinglist_moreleasedtoproduction}}
                </td>
                <td>
                    {{ct.cuttinglist_releasedto}}
                </td>
                <td>
                    {{ct.cuttinglist_doneby}}
                </td>
                <td>
                    {{ct.cuttinglist_markingtype}}
                </td>
                <td style="font-size:9px;">
                    {{ct.cuttinglist_descripton}}
                </td>
                <td style="font-size:9px;">
                    {{ct.cuttinglist_location}}
                </td>
                <td>
                    {{ct.cuttinglist_qty}}
                </td>
                <td>
                    {{ct.cuttinglist_height}}
                </td>
                <td>
                    {{ct.cuttinglist_width}}
                </td>
                <td>
                    {{ct.cuttinglist_area}}
                </td>
                <td>
                    <button ng-if="ct.cuttinglist_classrefno !== 'N/A' " type="button" class="nafco-button nafco-nafco-btn-noborder nafco-btn-ok" style="color:black" ng-click="glassorderslists(ct.cuttinglist_classrefno)">
                        {{ct.cuttinglist_classrefno}}
                    </button>
                </td>
                <td>
                    {{ct.cuttinglist_sheettp}}
                </td>
                <td style="font-size:10px;">
                    {{ct.cuttinglist_remarks}}
                </td>
                <td>
                    {{ct.cuttinglist_section}}
                </td>
                <td>
                    <div ng-if="ct.file=='1'">
                        <a target="_blank" href="<?php echo $url_asset ?>/cuttinglist/{{ct.cuttinglist_token}}.pdf" class="link">
                            <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                        </a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php
include_once('new.php');
include_once('glassorders.php');
include_once('edit.php');
?>
<script type="text/javascript">
    var tableToExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,',
            template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
            base64 = function(s) {
                return window.btoa(unescape(encodeURIComponent(s)))
            },
            format = function(s, c) {
                return s.replace(/{(\w+)}/g, function(m, p) {
                    return c[p];
                })
            }
        return function(table, name) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {
                worksheet: name || 'Worksheet',
                table: table.innerHTML
            }
            window.location.href = uri + base64(format(template, ctx))
        }
    })()
</script>

<div class="ism-dialogbox" id="new-qtytype">
    <div class="ism-dialog-body" style="max-width:620px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                Add New Qty Type
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('new-qtytype').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="save_new_qtytype" ng-submit="qtytype_new_save()">
            <div class="dialog-body">
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Qty Type
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="qtytypenew" name="qtytypenew" id="qtytypenew" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('new-qtytype').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="save_new_qtytype.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                        <i ng-if="save_new_qtytype.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!save_new_qtytype.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>