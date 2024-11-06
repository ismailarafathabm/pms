<div class="ism-pms-dialog" ng-if="show_eng_release_dia.diashow">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Released BOQ
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-click="show_eng_release_dia.diashow = false">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-body" style="width: 600px;">
            <div class="ism-pms-dialog-body-group-title">
                <i class="fa fa-info-circle active"></i> <span>Select Options </span>
            </div>
            <div class="ism-pms-dialog-body-rows">
                <table class="naf-tables">
                    <thead>
                        <tr>
                            <th style="font-weight: bold;text-align:center;background-color:#e7e8e9">S.NO</th>
                            <th style="font-weight: bold;text-align:center;background-color:#e7e8e9">Engg.Name</th>
                            <th style="font-weight: bold;text-align:center;background-color:#e7e8e9">Date</th>
                            <th style="font-weight: bold;text-align:center;background-color:#e7e8e9">QTY</th>
                            <th style="font-weight: bold;text-align:center;background-color:#e7e8e9">Area</th>
                            <th style="font-weight: bold;text-align:center;background-color:#e7e8e9"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in show_eng_release_dia.currentboq_release">
                            <td>{{index+1}}</td>
                            <td>{{x.boqeng_enggname}}</td>
                            <td>{{x.boqeng_rdate_d.display}}</td>
                            <td>{{x.boqeng_qty}}</td>
                            <td>{{x.boqeng_area}}</td>                           
                            <td>
                                <div ng-if="currentuser === x.boqeng_enggname">
                                    <button type="button" class="ism-btns btn-delete" ng-click="removeboqr(x.boqeng_id)" style="padding:2px">
                                        <i class='fa fa-trash'></i>                                    
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>