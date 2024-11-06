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
</style>
<?php
session_start();
include_once('../../../../conf.php');
$userdep = $_SESSION['nafco_alu_user_department'];
$username = $_SESSION['nafco_alu_user_name'];

$update_access = ['superadmin', 'operation'];
$_update_access = false;
foreach ($update_access as $a) {
    if ($userdep === $a) {
        $_update_access = true;
        break;
    }
}
$price_access = ['superadmin', 'operation', 'Management', 'contract and operations','estimate'];
$_price_acces = false;
foreach ($price_access as $p) {
    if ($userdep === $p) {
        $_price_acces = true;
    }
}
$_printaccessuser = ['naser'];
foreach($_printaccessuser as $p){
    if($username === $p){
        $_price_acces = true;
    }
}
include_once('../../menu1.php');

?>
<div class="sub-body">
    <div class="sub-body-container" style="margin-top:75px">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                Shop Drawing Approvals - Report
            </div>
            <div class="sub-container-right">
                <button ng-click="clearFilters()" class="ism-btns btn-delete">
                    <i class="fa fa-filter" aria-hidden="true"></i>
                    <i class="fa fa-times" aria-hidden="true"></i>
                    Clear Filter
                </button>
               
                <?php
                if ($_price_acces === true ) {
                ?>

<button  ng-click="printResulttest()" class="ism-btns btn-normal">
                        <i class="fa fa-print"></i>
                        Print
                    </button>
                    <!-- <button  ng-click="printResult()" class="ism-btns btn-normal">
                        <i class="fa fa-print"></i>
                        Print
                    </button> -->
                    <button  ng-click="exportExcel()" class="ism-btns btn-normal">
                        <i class="fa fa-file-excel-o"></i>
                        Export Excel
                    </button>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="sub-body-container-contents" style="height:100%;background: #fff;">
            <div id="myGrid" class="ag-theme-balham" style="height:100%;"></div>

        </div>
    </div>
</div>



<div class="ism-dialogbox" id="revision_list">
    <div class="ism-dialog-body ism-dialog-bodytables">
        <div class="dialog-head">
            <div class="dialog-head-title">
                Drawing No : <u>{{_drawingno}}</u> - Revision List
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('revision_list').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="dialog-body">
            <table class="dialog-table">
                <thead id="hidiv">
                    <tr>
                        <th class="fiexdheader">#S No</th>
                        <th class="fiexdheader">#Drawing No</th>
                        <th class="fiexdheader">Rev #</th>
                        <th class="fiexdheader">Sub.#</th>
                        <th class="fiexdheader">Submited On</th>
                        <th class="fiexdheader">Received On</th>
                        <th class="fiexdheader">Client Approved On</th>
                        <th class="fiexdheader">Code</th>
                        <th class="fiexdheader">Delay</th>
                        <th class="fiexdheader">File</th>

                    <tr>
                </thead>
                <tbody>
                    <tr ng-class-odd="'oddtr'" ng-repeat="x in revision_list | filter:appfilter">
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':'' || x.approvals_last_status==='H'?'td-yellow3':'' || x.approvals_last_status==='X'?'td-red3':'' || x.approvals_last_status==='F'?'td-blue3':''}}">
                            {{$index + 1}}
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

                        <td style="text-align:center">

                            <a ng-show="x.files === '1'"  class="nafco-button nafco-sm-btn nafco-btn-noborder nafco-btn-danger" href="<?php echo $url_base ?>assets/drawingapprovals/{{x.approvals_info_token}}.pdf" style="color:#000" download="{{x.approvals_info_project_id}} # {{x.approvals_info_drawing_no}} # {{x.approvals_info_reveision_no}}" >
                                <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:15px;">
                            </a>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>