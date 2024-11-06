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
                Technical Approvals - Report
            </div>
            <div class="sub-container-right">
                <button ng-click="clearFilters()" class="ism-btns btn-delete">
                    <i class="fa fa-filter" aria-hidden="true"></i>
                    <i class="fa fa-times" aria-hidden="true"></i>
                    Clear Filter
                </button>
                <?php
                if ($_price_acces === true) {
                ?>


                    <button ng-click="printResult()" class="ism-btns btn-normal">
                        <i class="fa fa-print"></i>
                        Print
                    </button>
                    <button  ng-click="exportExcel()" class="ism-btns btn-normal">
                        <i class="fa fa-file-excel-o"></i>
                        Export Excel
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
        <div ng-show="!isloading" class="sub-body-container-contents" style="height:100%;background: #fff;">
            <div id="myGrid" class="ag-theme-balham" style="height:100%;"></div>

        </div>
    </div>
</div>