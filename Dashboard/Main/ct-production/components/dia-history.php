<div class="ism-pms-dialog" id="procurementreceipt_diashow">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Production Deliver Log
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-click="procurementreceipt_diahide()">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="isrptloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <div class="ism-pms-dialog-body" style="max-height: 80vh;" ng-hide="isrptloading">
            <div class="ism-pms-dialog-body-sub">
                <table class="ism-pms-dialog-table" style="width: auto;">
                    <thead class="ism-pms-dialog-table-headers">    
                        <tr>
                            <td class="ism-pms-dialog-tbale-header-cell">S.NO</td>
                            <td class="ism-pms-dialog-tbale-header-cell">PDF</td>
                            <td class="ism-pms-dialog-tbale-header-cell">Date</td>
                            <td class="ism-pms-dialog-tbale-header-cell">Ref#</td>
                            <td class="ism-pms-dialog-tbale-header-cell">Qty</td>
                            <td class="ism-pms-dialog-tbale-header-cell">Area</td>
                            <td class="ism-pms-dialog-tbale-header-cell"></td>
                        </tr>                    
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in deliverdlistitem">
                            <td>{{$index+1}}</td>      
                            <td>
                                <a ng-show="x.del_isdelfile_pdf.toString() === '1'" href="<?php echo $url_base?>assets/prodcution/deliver/{{x.deltoken}}.pdf" target="_blank">
                                    <i class="fa fa-file-pdf-o" style="color:red"></i>
                                </a>
                            </td>           
                            <td>{{x.outdate_d.display}}</td>   
                            <td>{{x.outno}}</td>               
                            <td>{{x.outqty}}</td>     
                            <td>{{x.outarea}}</td>           
                            <td>
                                <button type="button" ng-click="edit_deliver(x)">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>