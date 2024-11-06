<style>
    .ag-header-container {

        background: #c4d0d2;
        font-family: 'roboto';
        font-size: 14px;
        font-weight: 600;
        color: #000 !important;
    }

    .ag-header-cell-text {
        color: #000 !important;

    }

    .ag-cell {
        font-family: 'roboto';
        font-size: 14px;
        white-space: nowrap;
        border: 1px solid #00000012 !important;
    }

    .td-ok {
        color: #015147;
    }

    .td-green {
        background-color: #e7fffc;
        color: #000;
    }

    .td-green {
        background-color: #e7fffc;
        color: #000;
    }

    .td-yellow {
        background: #fff6dc;
        color: #000;
    }

    .ag-pinned-left-header {
        background: #c4d0d2;
        font-family: 'roboto';
        font-size: 14px;
        font-weight: 600;
        color: #000 !important;
    }

    .ag-theme-balham {
        --ag-odd-row-background-color: #f6feff;
    }

    .ag-theme-balham .ag-row-odd {
        background-color: var(--ag-odd-row-background-color);
    }

    .prgcontainer {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 2px;
        width: 100%;
    }

    .pargmain {
        width: 100%;
        border: 1px solid #d9d9d9;
        height: 12px;
        margin-top: 3px;
        flex: 2;
    }

    .prgbar {
        width: var(--pgval);
        height: 100%;
        background: #319b68;
        box-shadow: 1px 7px 10px -3px #53af57;
    }

    .prgval {
        flex: 1;
        font-size: 12px;
    }

    .ng-hg-datepicker {
        font-family: 'segoeui';
    }
</style>
<?php
session_start();
include_once 'st.php';
include_once '../../../conf.php';
$userdep = $_SESSION['nafco_alu_user_department'];

$update_access = ['superadmin', 'operation'];
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

include_once '../menu1.php';


?>


<div class="sub-body">
    <div class="sub-body-container" style="margin-top:75px">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                Metro Project Drawing Approvals
            </div>
            <div class="sub-container-right">
                <?php
                if ($_update_access === true) {
                ?>
                    <button onclick="document.getElementById('dia_newshopdrawingApprovals').style.display='flex'" type="button" class="ism-btns btn-normal">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Add New
                    </button>
                    </button>
                <?php
                }
                ?>
                <button ng-click="clearFilters()" class="ism-btns btn-delete">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    Clear Filter
                </button>
                <button ng-click="printResult()" class="ism-btns btn-normal">
                    <i class="fa fa-print"></i>
                    Print
                </button>
                <button ng-click="exportExcel()" class="ism-btns btn-normal">
                    <i class="fa fa-file-excel-o"></i>
                    Export Excel
                </button>
            </div>
        </div>

        <div class="sub-body-container-contents" style="height:100%;background: #fff;">
            <div id="myGrid" class="ag-theme-balham" style="height:100%;"></div>
        </div>
    </div>
</div>
<?php
// include_once 'dia/index.php';
// include_once 'dia/approvalsadd.php';
?>

<div class="ism-metro-project-dialog" id="revision_list">
    <div class="ism-metro-project-dialog-container" style="width:1200px">
        <div class="ism-metro-project-dialog-container-titles">
            <div class="ism-metro-project-dialog-titles-title">
                <div class="ism-metro-project-dialog-title-main-headers">
                    METRO APPROVALS
                </div>
            </div>
            <div class="ism-metro-project-dialog-title-closebtn" onclick="document.getElementById('revision_list').style.display='none'">
                <i class='fa fa-times'></i>
            </div>
        </div>
        <div class="ism-metro-project-dialog-container-subtitle">
            <i class="fa fa-info-circle"></i>
            Drawing No : <u>{{_drawingno}}</u> - Revision List
        </div>
        <div class="ism-metro-project-dialog-main-body">
            <div class="ism-metro-project-mainbody-row">
                <table class="dialog-table">
                    <thead id="hidiv">
                        <tr>
                            <th class="fiexdheader">#S No</th>
                            <?php
                            if ($_update_access === true) {
                            ?>
                                <th class="fiexdheader"></th>
                            <?php
                            }
                            ?>
                            <th class="fiexdheader">File</th>
                            <th class="fiexdheader">#Drawing No</th>
                            <th class="fiexdheader">Rev #</th>
                            <th class="fiexdheader">Sub.#</th>
                            <th class="fiexdheader">Submited On</th>
                            <th class="fiexdheader">Received On</th>
                            <th class="fiexdheader">Client Approved On</th>
                            <th class="fiexdheader">Code</th>
                            <th class="fiexdheader">Delay</th>


                        <tr>
                    </thead>
                    <tbody>
                        <tr ng-class-odd="'oddtr'" ng-repeat="x in revision_list | filter:appfilter">
                            <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':'' || x.approvals_last_status==='H'?'td-yellow3':'' || x.approvals_last_status==='X'?'td-red3':'' || x.approvals_last_status==='F'?'td-blue3':''}}">
                                {{$index + 1}}
                            </td>
                            <?php
                            if ($_update_access === true) {
                            ?>
                                <td>
                                    <button type="button" ng-click="edit_revision(x)" class='ism-btns btn-normal' style="padding:2px 5px">
                                        <i class="fa fa-pencil"></i>
                                        Edit
                                    </button>

                                </td>
                            <?php
                            }
                            ?>
                            <td style="text-align:center">

                                <a ng-show="x.files === '1'" class="nafco-button nafco-sm-btn nafco-btn-noborder nafco-btn-danger" href="<?php echo $url_base ?>assets/drawingapprovals/{{x.approvals_info_token}}.pdf" style="color:#000" download="{{x.approvals_info_project_id}} # {{x.approvals_info_drawing_no}} # {{x.approvals_info_reveision_no}}">
                                    <i class="fa fa-download"></i>
                                </a>

                                <a ng-show="x.files === '1'" class="nafco-button nafco-sm-btn nafco-btn-noborder nafco-btn-danger" href="<?php echo $url_base ?>assets/drawingapprovals/{{x.approvals_info_token}}.pdf" style="color:#000" target="_blank">
                                    <i class="fa fa-eye"></i>
                                </a>

                            </td>
                            <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':'' || x.approvals_last_status==='H'?'td-yellow3':'' || x.approvals_last_status==='X'?'td-red3':'' || x.approvals_last_status==='F'?'td-blue3':''}}">
                                {{x.approvals_info_drawing_no | uppercase}}
                            </td>
                            <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':'' || x.approvals_last_status==='H'?'td-yellow3':'' || x.approvals_last_status==='X'?'td-red3':'' || x.approvals_last_status==='F'?'td-blue3':''}}">
                                {{x.approvals_info_reveision_no}}
                            </td>
                            <td>
                                {{x.approvals_info_sub}}
                            </td>
                            <td>
                                {{x.approvals_info_submited_on}}
                            </td>
                            <td>
                                {{x.approvals_info_received_on}}
                            </td>
                            <td>
                                {{x.approvals_info_client_on}}
                            </td>

                            <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':'' || x.approvals_last_status==='H'?'td-yellow3':'' || x.approvals_last_status==='X'?'td-red3':'' || x.approvals_last_status==='F'?'td-blue3':''}}">
                                {{x.approvals_info_code}}
                            </td>
                            <td style="text-align:center">
                                {{x.delay}}
                            </td>


                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'dia/adddrawingapprovals.php';
include_once 'dia/drawingnewfor.php';
include_once 'dia/drawingapprovalsrevesion.php';
include_once 'dia/drawingapprovalsrevesionedit.php';
?>