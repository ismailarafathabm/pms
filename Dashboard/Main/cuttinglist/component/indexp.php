<?php
session_start();
$userdep = $_SESSION['nafco_alu_user_department'];
include_once '../../../../conf.php';
include_once '../../menu.php';
include_once '../../glassorders/purchase/nst.php';
include_once '../../masterlog/st.php';
include_once '../../glassorders/procurement/st.php';
include_once 'st.php';
include_once 'ctools.php'
?>

<style>
   .ag-cell {
        font-size: 0.85rem;
        font-family: 'apple';
    }

    .ism-btns {
        font-size: 0.85rem;
        font-family: 'apple';
    }


    .cutting_cell-yellow {
        background-color: #e9e90b;
        font-weight: bold;
        border-top: 1px solid #3f3f0d !important;
        border-bottom: 1px solid #ff7e00 !important;
        color: #000 !important;
    }

    .ag-checkbox {
        color: #000;
    }

    .cutting_cell-red {
        background-color: #e18c8c;
        color: #000 !important;
        font-weight: bold;
        border-top: 1px solid #3f3f0d !important;
        border-bottom: 1px solid red !important;

    }

    .ag-header-cell-text {
        color: #fff !important;
    }

    .ag-theme-balham,
    .ag-pinned-left-header,
    .ag-header-container {
        background-color: #1775cb;
        color: #fff;
    }


    .direct_css {
        height: 20px;
        padding: 3px;
        border-radius: 17px;
        background-color: #ff8f8f;
        color: #341515;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 58px;
    }

    .fw_css {
        height: 20px;
        padding: 3px;
        border-radius: 17px;
        background-color: #4affd5;
        color: #004835;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 58px;
    }

    .rt_css {
        height: 20px;
        padding: 3px;
        border-radius: 17px;
        background-color: #004835;
        color: #ffffff;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 58px;
    }

    .cutting_cell_production {
        background: #e3e3e3;
    }

    .cutting_cell_fok {
        background: #e0ffee !important;
        color: #000 !important;
    }
    .danger_css {
        background: #ff8585;
        color: #5d0505;
        text-align: center;
        cursor: pointer;
    }
    @media only screen and (max-width:1400) {
        .sub-body-container-contents {
            zoom: 85%;
            font-size: 14px;
        }
    }
</style>

<div class="sub-body" style="margin-top: 100px;height: calc(100vh - 130px);">
    <div class="sub-body-container">
        <div class="sub-body-container-title" style="justify-content: space-between;">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                Eng.Cutting List
            </div>
            <div class="sub-container-right" style="display: flex;gap: 10px;align-items: center;justify-content: flex-start;">
                <div style="display: flex;gap: 10px;border: 3px solid #ff6262;">
                    <div style="background: #ff6262;color: #fff;padding: 5px;font-weight: 400;">Total Qty</div>
                    <div style="color:#ff6262;font-weight:600;padding:5px">{{(+sumof.totitem).toLocaleString(undefined,{maximumFractionDigits:2})}}</div>
                    <div  style="background: #ff6262;color: #fff;padding: 5px;font-weight: 400;">Total Area</div>
                    <div style="color:#ff6262;font-weight:600;padding:5px">{{(+sumof.sumof_area).toLocaleString(undefined,{maximumFractionDigits:2})}}</div>
                </div>
                <button ng-show="isselectedrows" ng-click="changestatusgroup()" class="ism-btns btn-normal">
                    <i class="fa fa-print"></i>
                    Update Status
                </button>

            </div>
        </div>
        <div class="sub-body-container-contents" style="height:94%;background: #fff;">
            <div ng-show="isrptloading">Fetching data please Wait......</div>
            <div ng-show="!isrptloading" id="myGrid" class="ag-theme-balham" style="height:100%;"></div>
        </div>
    </div>

</div>
<?php
include_once 'statusupdate.php';
include_once 'mopdf.php';
include_once 'ctpdf.php';

?>