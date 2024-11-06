<?php
session_start();
include_once('../../../../conf.php');

$userdep = $_SESSION['nafco_alu_user_department'];

$update_access = ['operation'];
$_update_access = false;
foreach ($update_access as $a) {
    if ($userdep === $a) {
        $_update_access = true;
        break;
    }
}

$price_access = ['demo', 'operation', 'Management', 'contract and operations'];
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
                TECHNICAL APPROVALS
            </div>
            <div class="sub-container-right">
                <?php
                if ($_price_acces === true) {
                ?>
                    <button onclick="tableToExcel('techapprovals', 'Technical Approvals')" class="ism-btns btn-normal">
                        <i class="fa fa-file-excel-o"></i>
                        Export Excel
                    </button>
                <?php
                }
                ?>

                <?php
                if ($_update_access === true) {
                ?>
                    <button type="button" class="ism-btns btn-normal" onclick="document.getElementById('dia_newTechApprovals').style.display='block'">
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
                        <th class="fiexdheader">#S.NO</th>
                        <th class="fiexdheader"></th>
                        <th class="fiexdheader"></th>
                        <th class="fiexdheader">Approval Details</th>
                        <th class="fiexdheader">D.Approved</th>
                        <th class="fiexdheader">D.Released</th>
                        <th class="fiexdheader">Status</th>
                        <th class="fiexdheader">Remarks</th>


                    </tr>
                    <tr class="nx">
                        <th class="bg-whites">

                        </th>
                        <th class="bg-whites"></th>
                        <th class="bg-whites">

                        </th>
                        <th class="bg-whites"><input type="text" ng-model="fi.approval_type_name" class="nafco-inputs" placeholder="Search Approval Type"></th>
                        <th class="bg-whites"><input type="text" ng-model="fi.approvals_adate" class="nafco-inputs" placeholder="Search Approval Approval Date"></th>
                        <th class="bg-whites"><input type="text" ng-model="fi.approvals_rdate" class="nafco-inputs" placeholder="Search Approval Approval Released Date"></th>
                        <th class="bg-whites">
                            <select ng-model="fi.approvals_status" class="nafco-inputs">
                                <option value="">-Choose Status-</option>
                                <option value="a">Approved Not Released</option>
                                <option value="c">Approval Under Process</option>
                                <option value="b">Approval Released</option>

                            </select>
                        </th>
                        <th class="bg-whites"><input type="text" ng-model="fi.approvals_remarks" class="nafco-inputs" placeholder="Search Remarks"></th>


                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="ap in _tempapprovals | filter:fi">
                        <td>{{$index+1}}</td>
                        <td>
                            <button type="button" ng-click="viewinfosapprovals(ap)" class="ism-btns btn-normal" style="padding:2px 5px">
                                <i class="fa fa-eye"></i>
                                View
                            </button>
                            <?php
                            if ($_update_access === true) {
                            ?>
                                <button type="button" ng-click="supersedethis(ap)" ng-if="ap.approvals_status==='b'" class="ism-btns btn-normal" style="padding:2px 5px">
                                    <i class="fa fa-upload"></i>
                                </button>
                                <button ng-click="getinfosapprovals(ap)" type="button" class="ism-btns btn-normal" style="padding:2px 5px">
                                    <i class="fa fa-pencil-square-o"></i> Edit
                                </button>

                                <button ng-click="rmvitems(ap)" type="button" class="ism-btns btn-delete" style="padding:2px 5px">
                                    <i class="fa fa-trash"></i> Remove
                                </button>


                            <?php
                            }
                            ?>

                        </td>
                        <td>
                            <div style="display:flex;gap:5px">
                            <!-- <a target="_blank" href="<?php echo $url_base ?>assets/approvals/{{ap.approvals_token}}.pdf" ng-if="ap.approvals_status ==='b'" class="btn-black mr-1" style="border:1px solid #d7d7d7">
                                <i class="fa fa-eye"></i>
                            </a> -->
                            <a target="_blank" href="<?php echo $url_base?>filedownload/index.php?fname={{ap.approvals_token}}.pdf&dwname={{ap.approval_type_name | uppercase}} - {{ap.project_name | uppercase}}.pdf"  ng-if="ap.approvals_status ==='b'" class="btn-black mr-1" style="border:1px solid #d7d7d7">
                                <i class="fa fa-download"></i>
                                <!-- <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">  -->
                            </a>
                            </div>
                        </td>
                        <td>
                            {{ap.approval_type_name | uppercase}}
                        </td>
                        <td>
                            {{ap.approvals_adate | date :  "dd-MMM-yyyy"}}
                        </td>
                        <td>
                            {{ap.approvals_rdate | date :  "dd-MMM-yyyy"}}
                        </td>
                        <td>
                            <p ng-if="ap.approvals_status==='a'" class="txt-danger">
                                <span ng-if="ap.approvals_status === 'a'" class="fa fa-circle" style="color:#ea5455"></span>
                                {{'approval not released' | uppercase }}
                            </p>
                            <p ng-if="ap.approvals_status==='b'" class="txt-ok">
                                <span ng-if="ap.approvals_status === 'b'" class="fa fa-circle" style="color:#206a5d"></span>
                                {{'approval released' | uppercase }}
                            </p>
                            <p ng-if="ap.approvals_status==='c'">
                                <span ng-if="ap.approvals_status === 'c'" class="fa fa-circle" style="color:#ffb647"></span>
                                {{'approval under process' | uppercase }}
                            </p>
                        </td>
                        <td>{{ap.approvals_remarks}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div style="display:none">
    <table class="project-list-table borderd" id="techapprovals">
        <thead>
            <tr>
                <th style="width:50px;">#S.NO</th>
                <th>Approval Details</th>
                <th>D.Approved</th>
                <th>D.Released</th>
                <th>Remarks</th>
                <th>Status</th>
            <tr>
        </thead>
        <tbody>
            <tr ng-repeat="ap in _tempapprovals | filter:fi">
                <td>{{$index+1}}</td>
                <td>
                    {{ap.approval_type_name | uppercase}}
                </td>
                <td>
                    {{ap.approvals_adate | date :  "dd-MMM-yyyy"}}
                </td>
                <td>
                    {{ap.approvals_rdate | date :  "dd-MMM-yyyy"}}
                </td>
                <td>{{ap.approvals_remarks}}</td>
                <td>
                    <p ng-if="ap.approvals_status==='a'" class="txt-danger"> {{'approval not released' | uppercase }} </p>
                    <p ng-if="ap.approvals_status==='b'" class="txt-ok"> {{'approval released' | uppercase }} </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php
include_once('new.php');
include_once('edit.php');
include_once('view.php');
include_once('supersede.php');
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


<div class="ism-dialogbox" id="dia_newApprovalsType">
    <div class="ism-dialog-body" style="max-width:620px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                Approvals For
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('dia_newApprovalsType').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="new_approvaltype" ng-submit="aprrovalType_new()">
            <div class="dialog-body">
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Approval For
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" name="approvaltype_name" ng-model="approvaltype_name" id="approvaltype_name" class="nafco-inputs" required autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('dia_newApprovalsType').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="new_approvaltype.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                        <i ng-if="new_approvaltype.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!new_approvaltype.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>