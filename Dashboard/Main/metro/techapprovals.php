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
                Metro Project Technical Approvals
            </div>
            <div class="sub-container-right">
            <?php
                if ($_update_access === true) {
                ?>
                <button onclick="document.getElementById('ism_dia_metro_newapprovals').style.display='flex'" type="button" class="ism-btns btn-normal">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Add New
                </button>
                <?php 
                }
                ?>
                <button ng-click="clearFilters()" class="ism-btns btn-delete">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    Clear Filter
                </button>
                <button ng-click="printResult()" class="ism-btns btn-normal" style="display:none">
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
    include_once 'dia/index.php';
    include_once 'dia/approvalsadd.php';
?>