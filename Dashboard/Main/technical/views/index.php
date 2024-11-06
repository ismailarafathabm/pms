<?php
session_start();
include_once('../../../../conf.php');
include_once('../../menu.php');
include_once('../../masterlog/st.php');
?>
<style>
    .naf-tables tr:hover td {
        background-color: #f1f1f100 !important;
    }

    .ntit {
        background-color: #f5f5f5;
    }

    .table-header {
        background: #f3f3f3;
        font-weight: 600;
    }

    .tbl-btn {
        padding: 2px;
        border-radius: 2px;
        line-height: 16px;
    }

    .code_A {
        background: #c9ffd5;
        color: #007b49;
        font-weight: 600;
    }

    .code_B {
        background: #c2e7cb;
    }

    .code_BC {
        background: #effff3;
    }

    .code_C {
        background-color: #ffe2be;
    }

    .code_D {
        background-color: #ffc3c3;
        color: #bd0000;
        font-weight: 600;
    }

    .code_U {
        background-color: #feebff;
    }

    .code_E {
        background-color: #ebe8ff;
    }

    .code_F {
        background-color: #e3e3e3;
        color: #bd0000;
        font-weight: bold;
    }
</style>
<div class="sub-body summarypages">
    <div class="sub-body-container summarypages" style="height: calc(100vh - 130px);
    overflow: auto;
    ">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn">
                    <a href="#/!">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                PROJECT COMPREHENSIVE DATAS
            </div>

            <div class="sub-container-right">
                <button ng-click="setStatusFilter(true)" class="ism-btns btn-normal">
                    <i class="fa fa-filter"></i>
                    Filter
                </button>
                <button ng-click="printdatas()" class="ism-btns btn-normal">
                    <i class="fa fa-print"></i>
                    Print
                </button>
            </div>
        </div>

        <div class="sub-body-container-title ntit">
            <div class="sub-container-left">
                Systems
            </div>

            <div class="sub-container-right">
                <button ng-click="setSystemNewStatus(true)" class="ism-btns btn-normal" ng-if="caniaccessbtns">
                    <i class="fa fa-plus"></i>
                    Add New System
                </button>
            </div>
        </div>
        <div class="sub-body-container-contents">
            <?php include_once 'components/system.php' ?>
        </div>

        <?php
        include_once 'components/colors.php';
        include_once 'components/hardware.php';
        include_once 'components/technical.php';
        include_once 'components/calculation.php';
        ?>
    </div>

</div>

<?php
include_once 'models/systemmodel.php';
include_once 'models/colormodels.php';
include_once 'models/hardwaremodel.php';
include_once 'models/approvals.php';
include_once 'models/calculation.php';
include_once 'models/filter.dia.php';
?>