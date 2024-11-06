<?php
session_start();
$userdep = $_SESSION['nafco_alu_user_department'];
include_once '../../../../conf.php';
include_once '../../menu1.php';
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

    .cutting_cell-yellow{
        background-color: #e9e90b;
        font-weight: bold;
        border-top: 1px solid #3f3f0d !important;
        border-bottom: 1px solid #ff7e00 !important;
        color :#000 !important;
    }
    .cutting_cell-red{
        background-color: #e18c8c;
        color :#000 !important;
        font-weight: bold;
        border-top: 1px solid #3f3f0d !important;
        border-bottom: 1px solid red !important;

    }
    .ag-header-cell-text{
        color :#fff !important;
    }
    .ag-header-container{
        background-color:#1775cb;
        color :#fff;
    }


    .direct_css{
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
.fw_css{
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
.rt_css{
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
    
    @media only screen and (max-width:1400) {
        .sub-body-container-contents{
            zoom : 85%;
            font-size : 14px;
        }
    }
    
</style>

<div class="sub-body" style="margin-top: 75px;height: calc(100vh - 100px);">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                Cutting List With Imported Datas
            </div>
            <div class="sub-container-right">

            </div>
        </div>
        <div class="sub-body-container-contents" style="height:94%;background: #fff;">
            <div ng-show="isrptloading">Fetching data please Wait......</div>
            <div ng-show="!isrptloading" id="myGrid" class="ag-theme-balham" style="height:100%;"></div>
        </div>
    </div>

</div>
<?php 
    // include_once 'statusupdate.php';
    // include_once 'mopdf.php';
    // include_once 'ctpdf.php';
?>