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
                {{'glass order released to purchasing' | uppercase}}
            </div>
            <div class="sub-container-right">
                <?php
                if ($_price_acces === true) {
                ?>
                    <button onclick="tableToExcel('GlassOrder', 'Glass Orders')" class="ism-btns btn-normal">
                        <i class="fa fa-file-excel-o"></i>
                        Export Excel
                    </button>
                <?php
                }
                ?>
                <?php
                if ($_update_access === true) {
                ?>
                    <a type="button" onclick="document.getElementById('new-glassorder').style.display='block';document.getElementById('glassorderno').focus();" class="ism-btns btn-normal">
                        <i class="fa fa-plus"></i>
                        Add
                    </a>
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
                        <th class="fiexdheader">Glass Ord.No.</th>
                        <th class="fiexdheader"></th>
                        <th class="fiexdheader">DONE BY</th>
                        <th class="fiexdheader">RELEASED TO PURCH.</th>
                        <th class="fiexdheader">RECEIVED FROM PURCH.</th>
                        <th class="fiexdheader">Glass Order Status</th>
                        <th class="fiexdheader">SUPPLIER</th>
                        <th class="fiexdheader">GLASS TYPE</th>
                        <th class="fiexdheader">GLASS SPECIFICATION</th>
                        <th class="fiexdheader">MARKING LOCATION</th>
                        <th class="fiexdheader">QTY</th>
                        <th class="fiexdheader">REMARK</th>
                    </tr>
                    <tr class="nx">
                        <th class="bg-whites">

                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fil.glassorderno" class="nafco-inputs" placeholder="search...">
                        </th>
                        <th class="bg-whites">

                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fil.doneby" class="nafco-inputs" placeholder="search...">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fil.releasedtopurchase" class="nafco-inputs" placeholder="search...">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fil.recivedfrompurchas" class="nafco-inputs" placeholder="search...">
                        </th>
                        <th class="bg-whites">
                            <select class="nafco-inputs" ng-model="fil.orderstatus" name="orderstatus" id="orderstatus" required>
                                <option value="">-Select-</option>
                                <option value="1">ORDERED</option>
                                <option value="2">PENDING</option>
                                <option value="3">HOLD</option>
                                <option value="4">CANCELLED</option>
                                <option value="5">SUPERSEDED</option>
                                <option value="6">Others</option>
                            </select>
                        </th>
                        <th class="bg-whites">
                            <select ng-model="fil.supplier_id" class="nafco-inputs">
                                <option value="">-Select-</option>
                                <option ng-repeat="supplier in supplier_list" value="{{supplier.supplier_id}}">{{supplier.supplier_name}}</option>
                            </select>
                        </th>
                        <th class="bg-whites">
                            <select ng-model="fil.glasstype" class="nafco-inputs">
                                <option value="">-Select-</option>
                                <option ng-repeat="gtype in glasstypes" value="{{gtype.glasstype_id}}">{{gtype.glasstype_name}}</option>
                            </select>
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fil.glassdescription" class="nafco-inputs" placeholder="search...">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fil.markinglocation" class="nafco-inputs" placeholder="search...">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fil.QTY" class="nafco-inputs" placeholder="">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fil.remarks" class="nafco-inputs" placeholder="search...">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-class-odd="'oddtr'" ng-repeat="x in glassorder | filter:fil">
                        <td>
                            {{$index+1}}
                        </td>
                        <td style="text-align: center;font-size:12px;">
                            <?php
                            if ($_update_access === true) {
                            ?>
                                <button class="ism-btns btn-normal" style="padding:2px 5px" type="button" ng-click="edit_glassorder(x)" style="font-size:12px;">
                                    <i class="fa fa-edit"></i>
                                    {{x.glassorderno}}
                                </button>
                            <?php

                            } else {
                            ?>
                                {{x.glassorderno}}
                            <?php
                            }
                            ?>

                        </td>
                        <td>
                            <div ng-if="x.file=='1'" style="text-align:center;">
                                <a target="_blank" href="<?php echo $url_base ?>vfiles.php?page=glasssorder&folder={{x.glassorder_token}}" class="link">
                                    <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                                </a>
                            </div>
                        </td>
                        <td>
                            {{x.doneby}}
                        </td>
                        <td>
                            {{x.releasedtopurchase}}
                        </td>
                        <td>
                            {{x.recivedfrompurchas}}
                        </td>
                        <td>
                            <div ng-if="x.orderstatus === '1'">ORDERED</div>
                            <div ng-if="x.orderstatus === '2'">PENDING</div>
                            <div ng-if="x.orderstatus === '3'">HOLD</div>
                            <div ng-if="x.orderstatus === '4'">CANCELLED</div>
                            <div ng-if="x.orderstatus === '5'">SUPERSEDED</div>
                            <div ng-if="x.orderstatus === '6'">Others</div>
                        </td>
                        <td style="font-size:12px;">
                            {{x.supplier_name}}
                        </td>

                        <td style="font-size:12px;">
                            {{x.glasstype_name}}
                        </td>
                        <td style="font-size:9px;">
                            {{x.glassdescription}}
                        </td>
                        <td style="font-size:10px;">
                            {{x.markinglocation}}
                            <div style="display:inline-block" ng-repeat="e in x.items_list">
                                {{e.boqitems_itemid}},
                            </div>
                        </td>
                        <td>
                            {{x.QTY}}
                        </td>
                        <td style="font-size:11px;">
                            {{x.remarks}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div style="display:none">
    <table class="project-list-table borderd" id="GlassOrder">
        <thead>
            <tr>
                <th style="width:220px">Glass Ord.No.</th>
                <th style="width:150px">DONE BY</th>
                <th style="width:220px">RELEASED TO PURCH.</th>
                <th style="width:220px">RECEIVED FROM PURCH.</th>
                <th style="width:220px">Glass Order Status</th>
                <th style="width:450px">SUPPLIER</th>
                <th style="width:450px">GLASS TYPE</th>
                <th style="width:780px">GLASS SPECIFICATION</th>
                <th style="width:450px">MARKING LOCATION</th>
                <th style="width:50px">QTY</th>
                <th style="width:450px">REMARK</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="x in glassorder | filter:fil">
                <td style="text-align: center;">
                    <button class="nafco-button nafco-btn-sm link link-btn" type="button" ng-click="edit_glassorder(x)">
                        <i class="fa fa-edit"></i>
                        {{x.glassorderno}}
                    </button>
                </td>
                <td>
                    {{x.doneby}}
                </td>
                <td>
                    {{x.releasedtopurchase}}
                </td>
                <td>
                    {{x.recivedfrompurchas}}
                </td>
                <td>
                    <div ng-if="x.orderstatus === '1'">ORDERED</div>
                    <div ng-if="x.orderstatus === '2'">PENDING</div>
                    <div ng-if="x.orderstatus === '3'">HOLD</div>
                    <div ng-if="x.orderstatus === '4'">CANCELLED</div>
                    <div ng-if="x.orderstatus === '5'">SUPERSEDED</div>
                    <div ng-if="x.orderstatus === '6'">Others</div>

                </td>
                <td style="font-size:12px;">
                    {{x.supplier_name}}
                </td>

                <td style="font-size:12px;">
                    {{x.glasstype_name}}
                </td>
                <td style="font-size:9px;">
                    {{x.glassdescription}}
                </td>
                <td style="font-size:10px;">
                    {{x.markinglocation}}
                    <div style="display:inline-block" ng-repeat="e in x.items_list">
                        {{e.boqitems_itemid}},
                    </div>
                </td>
                <td>
                    {{x.QTY}}
                </td>
                <td style="font-size:11px;">
                    {{x.remarks}}
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php
include_once('new.php');
include_once('edit.php');
?>

<div class="ism-dialogbox" id="new-glasstype">
    <div class="ism-dialog-body" style="max-width:620px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                Add New Glass Type
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('new-glasstype').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="save_new_glasstype" ng-submit="gasstype_new_save()">
            <div class="dialog-body">
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Glass Type
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="glasstype_name" name="glasstype_name" id="glasstype_name" required autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>

            <div class="dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('new-glasstype').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="save_new_glasstype.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                        <i ng-if="save_new_glasstype.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!save_new_glasstype.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="ism-dialogbox" id="new-supplier">
    <div class="ism-dialog-body" style="max-width:620px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                Add New Supplier
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('new-supplier').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="save_new_supplier" ng-submit="supplier_new_save()">
            <div class="dialog-body">
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Supplier Name
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="new_supplier_name" name="new_supplier_name" id="new_supplier_name" required autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>

            <div class="dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('new-supplier').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="save_new_supplier.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                        <i ng-if="save_new_supplier.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!save_new_supplier.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
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