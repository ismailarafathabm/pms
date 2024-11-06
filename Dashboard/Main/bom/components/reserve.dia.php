<style>
    .hed {
        background: #dbdbdb;
        font-weight: 600;
    }
</style>
<div class="ism-pms-dialog" ng-if="show_dia_reserveditems">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Item Reserved
            </div>
            <div ng-show="!boqinfo_dia.isloading" class="ism-pms-idalog-header-closebtn" ng-click="setSystemNewStatus(false)">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>

        <div class="ism-pms-dialog-loader" ng-show="boqinfo_dia.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>



        <div class="ism-pms-dialog-body" style="width: auto;">
            <div class="ism-pms-dialog-body-group-title">
                <i class="fa fa-info-circle active"></i> <span>Project Reserved Qty </span>
            </div>
            <div class="ism-pms-dialog-body-rows">
                <div class="naf-tables">
                    <div class="old_pgm" style="width: 1000px;">
                        <div ng-show="is_loading_data">Loading</div>
                        <div ng-show="!is_loading_data" class="old_pgm_row" style="flex-direction:column;gap:20px">
                            <div class="old_pgm_fitbox">
                                <table  class="old_table itemlist" style="width: 800px;">
                                    <tbody>
                                        <tr>
                                            <td>Part NO</td>
                                            <td>{{reserved_items_info.partno}}</td>
                                            <td>Description</td>
                                            <td>{{reserved_items_info.description}}</td>
                                        </tr>
                                        <tr>
                                            <td>Alloy</td>
                                            <td>{{reserved_items_info.partalloy}}</td>
                                            <td>Length</td>
                                            <td>{{reserved_items_info.partlength}}</td>
                                        </tr>
                                        <tr>
                                            <td>Color</td>
                                            <td>{{reserved_items_info.partcolor}}</td>
                                            <td>Dieweight</td>
                                            <td>{{reserved_items_info.dieweight}}</td>
                                        </tr>
                                        <tr>
                                            <td>Sulai Balance</td>
                                            <td>{{ (+(+reserved_items_info.sqty) - (+reserved_items_info.srqty)) === 0 ? '-' : (+reserved_items_info.sqty) - (+reserved_items_info.srqty)}}</td>
                                            <td>Azizia Balance</td>
                                            <td>{{ (+(+reserved_items_info.aqty) - (+reserved_items_info.arqty)) === 0 ? '-' : (+reserved_items_info.aqty) - (+reserved_items_info.arqty)}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="old_table itemlist" style="width: 800px;margin-top:5px">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Project</th>
                                            <th>Reserved Qty</th>
                                            <th>Issued Qty</th>
                                            <th>Balance For Reserved</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="x in wtreserveritems">
                                            <td>{{$index+1}}</td>
                                            <td style="font-size: 12px;font-weight: 600;color: #9e1717;">{{x.costcentername}}</td>
                                            <td style="font-size: 14px;font-weight: 600;color: #ab9f00;text-align: center;">{{
                                                (+x.qtyreserved) === 0 ? '-' : (+x.qtyreserved).toLocaleString(undefined,{maximumFractionDigits : 2})
                                            }}</td>
                                            <td style="font-size: 14px;font-weight: 600;color: #014104;text-align: center">{{
                                                (+x.qtyused) === 0 ? '-' : (+x.qtyused).toLocaleString(undefined,{maximumFractionDigits : 2})
                                            }}</td>
                                            <td style="font-size: 14px;font-weight: 600;color: #bb0000;text-align: center">{{
                                                (+x.qutybalance) === 0 ? '-' : (+x.qutybalance).toLocaleString(undefined,{maximumFractionDigits : 2})
                                            }}</td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ism-pms-dialog-footer">
            <button ng-show="!boqinfo_dia.isloading" type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="setSystemNewStatus(false)">
                <i class="fa fa-times"></i>
                Close
            </button>
            <button ng-show="!boqinfo_dia.isloading" type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="setProjectReserveStatus(true)">
                <i class="fa fa-times"></i>
                Get Reserved Project List
            </button>
            <button ng-show="!boqinfo_dia.isloading" type="button" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-click="print_resevered()">
                <i class="fa fa-print"></i>
                Print
            </button>
            <div class="{{res.theme}}" ng-show="res.display">
                <i class="{{res.icon}}"></i>
                <span>{{res.msg}}</span>
            </div>
        </div>


    </div>
</div>