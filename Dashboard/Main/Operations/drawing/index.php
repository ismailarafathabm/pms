<?php
session_start();
include_once('../../../../conf.php');
$userdep = $_SESSION['nafco_alu_user_department'];

$update_access = ['demo','superadmin', 'operation'];
$_update_access = false;
foreach ($update_access as $a) {
    if ($userdep === $a) {
        $_update_access = true;
        break;
    }
}
$price_access = ['superadmin', 'operation', 'Management', 'contract and operations'];
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
                SHOP DRAWING APPROVALS
            </div>
            <div class="sub-container-right">

                <?php
                if ($_price_acces === true) {
                ?>
                    <button ng-if="'<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='operation' || '<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='Management'" onclick="tableToExcel('shopdrawing', 'Shop Drawing Approvals')" class="ism-btns btn-normal">
                        <i class="fa fa-file-excel-o"></i>
                        Export Excel
                    </button>
                <?php
                }
                ?>
                <?php
                if ($_update_access === true) {
                ?>
                    <button type="button" onclick="document.getElementById('dia_newshopdrawingApprovals').style.display='block'" class="ism-btns btn-normal" >
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
                        <th class="fiexdheader">Approval For</th>
                        <th class="fiexdheader">Drawing No</th>
                        <th class="fiexdheader">Description</th>
                        <th class="fiexdheader">Rev #</th>
                        <th class="fiexdheader">SUB #</th>
                        <th class="fiexdheader">Submitted On</th>
                        <th class="fiexdheader">Received On</th>
                        <th class="fiexdheader">Client Return On</th>
                        <th class="fiexdheader">Code</th>
                        <th class="fiexdheader">Delay</th>

                    </tr>
                    <tr class="nx">
                        <th class="bg-whites"></th>
                        <th class="bg-whites"></th>
                        <th class="bg-whites"></th>
                        <th class="bg-whites">
                            <select ng-model="fillters.approvals_for" class="nafco-inputs">
                                <option value="">-All-</option>
                                <option ng-repeat="y in _dapprovals" value="{{y.types_id}}">{{y.types_name}}</option>
                            </select>
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fillters.approvals_draw_no" class="nafco-inputs" placeholder="Search...">
                        <th class="bg-whites">
                            <input type="text" ng-model="fillters.approvals_descriptions" class="nafco-inputs" placeholder="Search...">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fillters.approvals_last_revision_code" class="nafco-inputs" placeholder="Search...">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fillters.approvals_infos_sub" class="nafco-inputs" placeholder="Search...">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fillters.approvals_infos_submitedon" class="nafco-inputs" placeholder="Search...">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fillters.approvals_infos_receivedon" class="nafco-inputs" placeholder="Search...">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fillters.approvals_infos_clienton" class="nafco-inputs" placeholder="Search...">
                        </th>
                        <th class="bg-whites">
                            <select ng-model="fillters.approvals_last_status" class="nafco-inputs">
                                <option value="">-All-</option>
                                <option value="U">U - Under Review </option>
                                <option value="A">A - Approved</option>
                                <option value="B">B - Approved As noted</option>
                                <option value="C">C - Approved as noted Resubmit</option>
                                <option value="H">H - ON Hold</option>
                                <option value="X">X - Canceled</option>
                                <option value="F">F - FOR INFORMATION</option>
                            </select>
                        </th>

                        <th class="bg-whites"></th>

                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="x in _approvals | filter:fillters" class="{{x.approvals_last_status==='U'?'tryellow':'' || x.approvals_last_status==='A'?'trgreen':'' || x.approvals_last_status==='B'?'trgreen2':'' || x.approvals_last_status==='C'?'trred txt-red':'' || x.approvals_last_status==='D'?'trorange':'' || x.approvals_last_status==='H'?'tryellow2':'' || x.approvals_last_status==='X'?'trred2 txt-red':'' || x.approvals_last_status==='F'?'trblue':''}}">
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':'' || x.approvals_last_status==='H'?'td-yellow3':'' || x.approvals_last_status==='X'?'td-red3':'' || x.approvals_last_status==='F'?'td-blue3':''}}">
                            {{$index+1}}
                        </td>
                        <td>


                            <button type="button" ng-click="Revision_btnList(x)" class="ism-btns btn-close" style="padding:2px 5px">
                                <i class="fa fa-list"></i>
                            </button>

                            <?php
                            if ($_update_access === true) {
                            ?>
                                <button type="button" ng-click="AddNewRevision_btn(x)" class="ism-btns btn-save" style="padding:2px 5px">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <button type="button" ng-click="Removedrawings(x)" class="ism-btns btn-delete" style="padding:2px 5px">
                                    <i class="fa fa-trash"></i>
                                </button>
                            <?php
                            }
                            ?>
                        </td>
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':'' || x.approvals_last_status==='H'?'td-yellow3':'' || x.approvals_last_status==='X'?'td-red3':'' || x.approvals_last_status==='F'?'td-blue3':''}}">
                            <div style="display:flex;flex-direction:row;gap:3px;align-items: center; justify-content: flex-start;">
                                <a ng-if="x.f == '1'" target="_blank" class="nafco-button nafco-sm-btn nafco-btn-noborder nafco-btn-danger" style="color:#000" href="<?php echo $url_base ?>assets/drawingapprovals/{{x.approvals_last_revision_no}}.pdf">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a ng-if="x.f == '1'" class="nafco-button nafco-sm-btn nafco-btn-noborder nafco-btn-danger" style="color:#000" download="{{x.approvals_draw_no | uppercase}}_ {{x.types_name}}.pdf" href="<?php echo $url_base ?>assets/drawingapprovals/{{x.approvals_last_revision_no}}.pdf">
                                    <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                                </a>
                            </div>
                        </td>
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':'' || x.approvals_last_status==='H'?'td-yellow3':'' || x.approvals_last_status==='X'?'td-red3':'' || x.approvals_last_status==='F'?'td-blue3':''}}">
                            {{x.types_name}}
                        </td>
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':'' || x.approvals_last_status==='H'?'td-yellow3':'' || x.approvals_last_status==='X'?'td-red3':'' || x.approvals_last_status==='F'?'td-blue3':''}}">

                            {{x.approvals_draw_no | uppercase}}
                            <?php
                            if ($_update_access === true) {
                            ?>
                                <button ng-click="edit_drawingdt(x)" type="button" class="ism-btns btn-close" style="padding:2px 5px">
                                    <i class="fa fa-edit"></i>
                                </button>
                            <?php
                            }
                            ?>


                        </td>
                        <td>
                            {{x.approvals_descriptions}}
                        </td>

                        <td>
                            {{x.approvals_last_revision_code}}
                        </td>
                        <td>
                            {{x.approvals_infos_sub}}
                        </td>
                        <td>
                            {{x.approvals_infos_submitedon}}
                        </td>
                        <td>
                            {{x.approvals_infos_receivedon}}
                        </td>
                        <td>
                            {{x.approvals_infos_clienton}}
                        </td>

                        <td>
                            <span ng-if="x.approvals_last_status==='A'" class="fa fa-circle" style="color:#0d7377"></span>
                            <span ng-if="x.approvals_last_status==='B'" class=" fa fa-circle" style="color:#41aea9"></span>
                            <span ng-if="x.approvals_last_status==='C'" class="fa fa-circle" style="color:#bb2205"></span>
                            <span ng-if="x.approvals_last_status==='U'" class="fa fa-circle" style="color:#f6830f"></span>
                            <span ng-if="x.approvals_last_status==='H'" class="fa fa-circle" style="color:#0278ae"></span>
                            <span ng-if="x.approvals_last_status==='F'" class="fa fa-circle" style="color:#150485"></span>
                            <span ng-if="x.approvals_last_status==='X'" class="fa fa-circle" style="color:#e60412"></span>
                            {{x.approvals_last_status}}
                        </td>
                        <td style="text-align:center">
                            {{x.delayclient}}
                        </td>



                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div style="display:none;">
    <table class="project-list-table borderd drawing-approvals" id="shopdrawing">
        <thead>
            <tr>
                <th style="width:10px">#S.NO</th>
                <th style="width:50px"></th>
                <th style="width:120px">Approval For</th>
                <th style="width:650px">Drawing No</th>
                <th style="width:850px">Description</th>
                <th style="width:220px">Rev #</th>
                <th style="width:220">SUB #</th>
                <th style="width:220px">Submitted On</th>
                <th style="width:220px">Received On</th>
                <th style="width:250px">Client Return On</th>
                <th style="width:250px">Code</th>
                <th style="width:250px">Delay</th>
                <th style="width:300px"></th>

            <tr>
        </thead>
        <tbody>
            <tr ng-repeat="x in _approvals | filter:fillters">
                <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}">
                    {{$index+1}}
                </td>
                <td style="width:50px" class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}">
                    <a ng-if="x.f == '1'" class="nafco-button nafco-sm-btn nafco-btn-noborder nafco-btn-danger" style="color:#000" target="_blank" href="<?php echo $url_base ?>assets/drawingapprovals/{{x.approvals_last_revision_no}}.pdf">
                        <i class="fa fa-download"></i>
                    </a>
                </td>
                <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}">
                    {{x.types_name}}
                </td>
                <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}">
                    {{x.approvals_draw_no | uppercase}}
                    <button ng-click="edit_drawingdt(x)" style="padding:2px 5px" type="button" class="nafco-button nafco-btn-noborder nafco-btn-danger">
                        <i class="fa fa-edit"></i>
                    </button>

                </td>
                <td>
                    {{x.approvals_descriptions}}
                </td>

                <td>
                    {{x.approvals_last_revision_code}}
                </td>
                <td>
                    {{x.approvals_infos_sub}}
                </td>
                <td>
                    {{x.approvals_infos_submitedon}}
                </td>
                <td>
                    {{x.approvals_infos_receivedon}}
                </td>
                <td>
                    {{x.approvals_infos_clienton}}
                </td>

                <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}" style="text-align:center">
                    {{x.approvals_last_status}}
                </td>
                <td style="text-align:center">
                    {{x.delayclient}}
                </td>
                <td>
                    <button type="button" ng-click="AddNewRevision_btn(x)" class="nafco-button nafco-btn-noborder nafco-sm-btn nafco-btn-ok">
                        <i class="fa fa-plus"></i>
                    </button>

                    <button type="button" ng-click="Revision_btnList(x)" class="nafco-button nafco-btn-noborder nafco-sm-btn nafco-btn-danger">
                        <i class="fa fa-list"></i>
                    </button>
                </td>


            </tr>
        </tbody>
    </table>
</div>

<?php
include_once('new.php');
include_once('revision.php');
include_once('newrevision.php');
include_once('editdrwinginfo.php');
include_once('edit.php');
?>




<div class="ism-dialogbox" id="dia_newdrawingapprovalsfor">
    <div class="ism-dialog-body" style="max-width:620px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                Add New Shop Drawing Approvals Category
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('dia_newdrawingapprovalsfor').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="savenewapprovalscaregory" ng-submit="save_types()">
            <div class="dialog-body">
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Approval Category
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="drawing_types_new" name="drawing_type_new" class="nafco-inputs" required autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>

            <div class="dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('dia_newdrawingapprovalsfor').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="savenewapprovalscaregory.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                        <i ng-if="savenewapprovalscaregory.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!savenewapprovalscaregory.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
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