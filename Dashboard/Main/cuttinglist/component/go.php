<?php
session_start();
$userdep = $_SESSION['nafco_alu_user_department'];
include_once '../../../../conf.php';
include_once '../../menu1.php';
include_once '../../glassorders/purchase/nst.php';
include_once '../../masterlog/st.php';
include_once '../../glassorders/procurement/st.php';
include_once 'st.php';
include_once 'ctools.php';
$newcuttinglistusers = ['demo', 'eng_carlo'];
$sv = in_array($user, $newcuttinglistusers);
?>


<style>
 .ag-cell{
        font-size: 0.75rem;
        font-family: 'owh';
    }
.ag-header-cell-text{
    font-size: 12px;
    font-family: 'owh';
   
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

.x2{
    background-color: #e5e5e5;
}
</style>

<div class="sub-body" style="margin-top: 75px;height: calc(100vh - 100px);">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                Cutting List
            </div>
            <div class="sub-container-right">

            </div>
        </div>
        <div class="sub-body-container-contents" style="height:94%;background: #fff;">
            <?php 
                if(!$sv){
                    echo "You Could not Access This Page";
                    exit;
                }
            ?>
            <div id="myGrid" class="ag-theme-balham" style="height:100%;"></div>
        </div>
    </div>
</div>
<?php 
    include_once 'gostatusupdate.php';
    include_once 'godstatusupdate.php';
    include_once 'goupload.php';
?>