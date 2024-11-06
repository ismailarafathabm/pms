<div class="ism-pms-dialog" id="dia_load_budgetglassorder">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Glass Order History
            </div>

            <div class="ism-pms-idalog-header-closebtn" ng-show="!mtblrpt.isloading" onclick="document.getElementById('dia_load_budgetglassorder').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="projectmat.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-show="!projectmat.isloading">
            <div class="ism-pms-dialog-body" style="width: auto;max-width:1260px" ng-show="!materialssummary">
                <table class="ism-pms-dialog-table">
                    <thead class="ism-pms-dialog-table-headers">
                        <tr>
                            <th class="ism-pms-dialog-tbale-header-cell">S.No</th>
                            <th class="ism-pms-dialog-tbale-header-cell" style="width: 90px;">Date</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Ref.No</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Glass Type</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Descriptioin</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Area</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Qty</th>
                            <th class="ism-pms-dialog-tbale-header-cell">P/sqm</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Total Amount</th>
                            <th>
                               
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in glassorderhistroy.data">
                            <td class="ism-table-dialog-table-body-cells">{{$index+1}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.gopdate_d}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.gopno}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.gopglasstype}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.gopglassdesc}}</td>
                            
                            <td class="ism-table-dialog-table-body-cells">{{x.gopglasstotalarea}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.gopglassqty}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.gopglasspricepersqm}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.gopglasstotalamount}}</td>
                           <td class="ism-table-dialog-table-body-cells">
                           <button type="button" class="mis-new-page-header-button" onclick="window.location.href =`http://172.0.100.17:8082/PMS/Dashboard/Main/glassorders/print/index.html`">
                           <i class="fa fa-print"></i>
                                    Print
                                </button>
                           </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>