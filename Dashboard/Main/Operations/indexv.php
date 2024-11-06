<?php
session_start();
include_once('../../../conf.php');
$userdep = $_SESSION['nafco_alu_user_department'];
$new_btnAccess = ['superadmin', 'it', 'operation'];
$_newBtnAccess = false;
foreach ($new_btnAccess as $x) {
    if ($userdep === $x) {
        $_newBtnAccess = true;
        break;
    }
}

$summaryPdf = ['superadmin', 'it', 'operation', 'estimate', 'accounts', 'Management', 'contract and operations'];
$_pdfaccess = false;
foreach ($summaryPdf as $x) {
    if ($userdep === $x) {
        $_pdfaccess = true;
        break;
    }
}
?>

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
</style>

<?php
include_once('../menu1.php');
?>


<div class="sub-body">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
               Villa  Projects Lists
            </div>
            <div class="sub-container-right">

                <button ng-click="clearFilters()" class="ism-btns btn-delete">
                    <i class="fa fa-times"></i>
                    Clear Filter
                </button>
                <button ng-click="printAll()" class="ism-btns btn-normal">
                    <i class="fa fa-print"></i>
                    Print
                </button>
                <button ng-click="excelexport()" class="ism-btns btn-normal">
                    <i class="fa fa-file-excel-o"></i>
                    Export Excel
                </button>
                <?php
                if ($_newBtnAccess === true) {
                ?>

                    <button type="button" type="button" class="ism-btns btn-save" onclick="document.getElementById('dia_addnewProjects').style.display='block'">
                        <i class="fa fa-plus"></i>
                        Add New Project
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

<?php
include_once('new.php');
?>

<style>
    .ism-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
        margin-bottom: 10px;
        margin-top: 10px;
    }

    .ism-table th {
        background-color: #2c445c;
        color: #fff;
        font-weight: 400;
        padding: 3px 5px;
        text-align: left;
        border: 1px solid #2c445c;
    }

    .ism-table td {
        padding: 3px 5px;
        border: 1px solid #2c445c;
        background: #ffffff9e;
    }

    .dashboard-modal {
        display: none;
        position: fixed;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        z-index: 3;
        background-color: #34333354;
        overflow: auto;
        padding-top: 20px;
        backdrop-filter: blur(10px) saturate(180%);
        z-index: 99999999;
        min-height: 100vh;
    }

    .dashboard-modal-container {
        background-color: #e9e9e952;
        width: 800px;
        margin: 0 auto;
        border-radius: 8px;
        color: #000;
        padding: 0px 10px;
        font-family: segoeui;
        /* backdrop-filter: grayscale(1); */
        box-shadow: -4px -2px 15px 2px #9f9f9f78;

    }

    .dashboard-modal-title {
        color: #0603c8;
        font-size: 16px;
        font-weight: bolder;
        padding: 13px 0px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .dashboard-modal-title i {
        color: #000;
        transition: all 0.2s;
    }

    .dashboard-modal-title i:hover {
        color: #f00;

    }

    .dasboard-modal-foot {
        padding: 20px 0px;
    }

    .list-of-employees-container {
        padding: 10px 20px;
        margin-top: 14px;
        height: 80%;
        overflow: auto;
    }

    .list-of-employees-container .ism-table {
        font-size: 14px;
    }

    .modal-employee-card {
        font-family: overpass;
        border: 1px dashed #1900d8;
        background-color: #f1f1f147;
        border-radius: 10px;
        box-shadow: inset -4px -7px 8px #baaeff38;
        padding: 17px 16px;
        display: flex;
        justify-content: center;
        margin-bottom: 15px;
    }

    .modal-employee-card-image {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .modal-employee-card-image-disp img {
        width: 100px;
        height: 100px;
        border-radius: 100%;
        margin-bottom: 12px;
    }

    .modal-employee-card-image-disp-fileno {
        font-size: 16px;
        color: #0603c8;
        font-weight: 700;
    }

    .modal-employee-card-details {
        margin-left: 30px;

    }

    .modal-employee-card-details-info {
        display: flex;
        align-items: center;
        width: 500px;
        margin-bottom: 5px;
        font-size: 16px;
    }

    .employee-card-details-info-lable {
        width: 150px;
    }

    .employee-card-details-info-cemi {
        width: 10px;
    }

    .employee-card-details-info-detatils {
        width: 335px;
        font-weight: bold;
        color: #0603c8
    }

    .dashboard-modal-frms center .i:hover {
        color: #005f48;
    }

    .danger-border {
        border: 1px dashed #ff0000;
        box-shadow: inset 4px 6px 20px #ff000026;
    }

    .danger-border .modal-employee-card-image .modal-employee-card-image-disp-fileno,
    .danger-border .modal-employee-card-details .modal-employee-card-details-info .employee-card-details-info-detatils {
        color: #550000;
    }

    .tanger-tr td {
        background: #ffe7e7;
        color: #550000;
    }

    .dashboard-modal-frms i {
        padding: 4px;
    }
</style>


<div class="dashboard-modal" id="manpower_summary_dialog">
    <div class="dashboard-modal-container">
        <div class="dashboard-modal-title">
            <div>
                Manpower Summary Report Creator
            </div>
            <div>
                <i class="fa fa-times" onclick="document.getElementById('manpower_summary_dialog').style.display='none'"></i>
            </div>
        </div>
        <div class="dashboard-modal-body">
            <div class="dashboard-modal-search">
                <div class="dashboard-modal-frms">
                    <center>
                        <form name="getmanpower" id="manpower_reports" ng-submit="manpower_summaryreport()">

                            Star Date : <input type="text" ng-model="srcmanpower_date" class="ism-inputs" id="date_search" name='date_search' ng-modal="srcmanpower.date_search" style="margin:0 auto;width:250px;" placeholder="Enter Date" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="manpower_csigdate">
                            </br>
                            End Date : <input type="text" ng-model="srcmanpower_date1" class="ism-inputs" id="date_search1" name='date_search1' ng-modal="srcmanpower.date_searchs" style="margin:0 auto;width:250px;" placeholder="Enter Date" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="manpower_csigdatex">
                            </br>
                            <button type="submit" ng-disabled="getmanpower.$invalid" class="ism-btns btn-save" style="padding:2px 2px;"><i class="fa fa-check"></i> Search</button>
                        </form>
                    </center>

                </div>
            </div>
        </div>
        <div class="dasboard-modal-foot">
            <button type="button" class="ism-btns btn-delete" onclick="document.getElementById('manpower_summary_dialog').style.display='none'">
                <i class="fa fa-times"></i>
                Close
            </button>
        </div>
    </div>
</div>