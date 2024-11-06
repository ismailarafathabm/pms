<?php
session_start();
$accessuser = ['demo'];
$username = $_SESSION['nafco_alu_user_name'];
include_once '../../menu1.php';
include_once '../../masterlog/st.php';
?>
<style>
    .gen_autocompleate {
        position: absolute;
        margin-left: -12px;
        margin-top: 0px;
        z-index: 5;
    }

    .autocompleate-dia {
        position: fixed;
        width: 600px;
        background-color: #fff;
        border-radius: 10px;
        padding: 10px;
        border: 1px solid #dbdbdb;
        height: 400px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
    }

    .autocompleate-container {
        display: block;
        background: #fff;
        margin-bottom: 5px;
        width: 100%;
    }

    .autocompleate-loads {
        position: relative;
        height: 100%;
        overflow: auto;
    }

    .autocompleate-table {
        position: relative;
        border-collapse: collapse;
        width: 100%;
    }

    .autocompleate-table th {
        border: 1px solid #d3d3d3;
        font-size: 13px;

    }

    .autocompleate-table td {
        font-size: 12px;
    }

    .xtable {
        position: relative;
        border-collapse: collapse;
    }

    .xtable th {
        border: 1px solid #d3d3d3;
        font-size: 1rem;
        padding: 5px;
        background: #d2e3e5;

    }

    .xtable td {
        font-size: 1rem;
        border: 1px solid #d3d3d3;
        padding: 5px;
    }

    @media (max-width: 1200px) {
        .autocompleate-dia {
            max-height: 220px;
            overflow: none;
        }
    }
</style>
<div class="sub-body">
    <div class="sub-body-container" style="margin-top: 75px;padding:0;overflow:hidden; font-family: 'roboto',sans-serif;font-size : 1rem;">
        <div class="ism-new-page-headers">
            <div class="ism-new-page-header-page-title">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                Autorization
            </div>
            <div class="ism-new-page-header-page-buttons">
                <input type="text" ng-model="searchallauth" class="ism-dialog-rows-input-controller" style="width:120px;margin-right:5px;padding:3px;" placeholder="Search..."/>
                <button type="button" class="ism-new-page-header-button normalbtn" ng-click="addnewauth()">
                    <i class="fa fa-plus" style="margin-right:1px"></i>
                    Add
                </button>
            </div>
        </div>
        <div>
            <div style="height: calc(100vh - 145px);overflow: auto;border: 1px solid #d9d9d9;padding:10px">
                <table class="xtable">
                    <thead>
                        <tr>
                            <th>
                                S.NO
                            </th>
                            <th>
                                Contract NO#
                            </th>
                            <th>
                                Project
                            </th>
                            <th>
                                User Name
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in allauths | filter:searchallauth">
                            <td>{{$index+1}}</td>
                            <td>{{x.project_no}}</td>
                            <td>{{x.project_name}}</td>
                            <td>{{x.user_id}}</td>
                            <td>
                                <button type="button" class="ism-new-page-header-button dangerbtn" ng-disabled="removebusy" ng-click="removeAuth(x)">
                                    <i class="fa fa-trash"></i>
                                    Remove
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'dia/assaign.dia.php';
?>