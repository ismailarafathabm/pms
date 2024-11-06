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
include_once('../../../conf.php');
include_once('../menu1.php');
?>
<div class="sub-body">
    <div class="sub-body-container" style="margin-top:75px">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                <?php echo strtoupper('Warehouse To Paint Plant - REPORT')?>
            </div>
            <div class="sub-container-right">
                <button ng-click="clearFilters()" class="ism-btns btn-delete">
                    <i class="fa fa-filter" aria-hidden="true"></i>
                    <i class="fa fa-times" aria-hidden="true"></i>
                    Clear Filter
                </button>
                <button ng-click="getSummaryRpt()" class="ism-btns btn-normal">
                    <i class="fa fa-eye"></i>
                    Summary Report
                </button>
                <button ng-click="printResult()" class="ism-btns btn-normal">
                    <i class="fa fa-print"></i>
                    Print
                </button>
                <button ng-click="exportExcel()" class="ism-btns btn-normal">
                    <i class="fa fa-file-excel-o"></i>
                    Export Excel
                </button>
                <?php
                $access_add = false;
                $user = $_SESSION['nafco_alu_user_name'];
                if($user === 'materials' || $user === 'demo'){
                    $access_add = true;
                }
                if ($access_add) {
                ?>
                    <button ng-click="addnewentry()" class="ism-btns btn-normal" style="margin-left:10px">
                        <i class="fa fa-plus"></i>
                        Add
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

<?php 
    include_once 'new.php';
    include_once 'recivelist.php';
    include_once 'summary.php'
?>



