<?php
session_start();
include_once('../../../../conf.php');
include_once('../../menu1.php');
$new_project_access_user = ['demo', 'operation@alunafco.com'];
$new_project_access = in_array($user, $new_project_access_user);
include_once './st.php';
?>
<div class="sub-body" style="margin-top:75px;height:calc(100vh - 155px)">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                {{page_title}}
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
                if ($new_project_access) {
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
        <div ng-show="!isloading" class="sub-body-container-contents" style="height:100%;background: #fff;">
            <div id="myGrid" class="ag-theme-balham" style="height:100%;"></div>
        </div>
    </div>
</div>

<?php 
    include_once 'new.php';
?>