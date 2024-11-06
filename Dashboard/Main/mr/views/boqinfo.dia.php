<style>
    .hed {
        background: #dbdbdb;
        font-weight: 600;
    }
</style>
<div class="ism-pms-dialog" ng-if="show_boq_dialog">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                BOQ
            </div>
            <div ng-show="!boqinfo_dia.isloading" class="ism-pms-idalog-header-closebtn" ng-click="setSystemNewStatus(false)">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>

        <div class="ism-pms-dialog-loader" ng-show="boqinfo_dia.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>

        <form autocomplete="off" ng-submit="save_system_submit()" id="save_system" name="system_save" ng-show="!boqinfo_dia.isloading">

            <div class="ism-pms-dialog-body" style="width: auto;">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>BOQ ITEM : {{boqinfo_dia.data.poq_item_no}} </span>
                </div>
                <div class="ism-pms-dialog-body-rows">
                    <div class="naf-tables">
                        <div class="old_pgm" style="width: 1340px;">
                            <div class="old_pgm_row" style="flex-direction:column;gap:20px">
                                <div class="old_pgm_fitbox">
                                    <table class="old_table itemlist" style="width: 1300px;">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Description</th>
                                                <th>QTY</th>
                                                <th>Unit</th>                                                
                                                <th>Area</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{boqinfo_dia.data.poq_item_no}}</td>
                                                <td style="padding : 0">
                                                    <div style="width: 100%;">
                                                        <table class="old_table itemlist" style="width: 100%;">
                                                            <tbody>
                                                                <tr>
                                                                    <td class='hed'>Type</td>
                                                                    <td colspan="4">{{boqinfo_dia.data.ptype_name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class='hed'></td>
                                                                    <td colspan="4">{{boqinfo_dia.data.poq_item_remark}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class='hed'>Location</td>
                                                                    <td colspan="4">{{boqinfo_dia.data.poq_remark}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class='hed'>Area</td>
                                                                    <td class='hed'>Width (MM)</td>
                                                                    <td class='hed'>Height (MM)</td>
                                                                    <td class='hed' colspan="2">Area (MM)</td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>{{
                                                                        (+boqinfo_dia.data.poq_item_width) === 0 ? 
                                                                        '-' : 
                                                                        (+boqinfo_dia.data.poq_item_width).toLocaleString(undefined,{maximumFractionDigits : 2})
                                                                    }}</td>
                                                                    <td>{{
                                                                        (+boqinfo_dia.data.poq_item_height) === 0 ?
                                                                        '-'
                                                                        :
                                                                        (+boqinfo_dia.data.poq_item_height).toLocaleString(undefined,{maximumFractionDigits : 2})
                                                                    }}</td>
                                                                    <td colspan="2">{{
                                                                        (+boqinfo_dia.data.area) === 0 ?
                                                                        '-' :
                                                                        (+boqinfo_dia.data.area).toLocaleString(undefined,{maximumFractionDigits : 2})
                                                                    }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class='hed'>Glass</td>
                                                                    <td colspan="4">{{boqinfo_dia.data.poq_item_glass_spec}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>Single</td>
                                                                    <td>{{boqinfo_dia.data.poq_item_glass_single}}</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>DOUBLE</td>
                                                                    <td>{{boqinfo_dia.data.poq_item_glass_double1}}</td>
                                                                    <td>{{boqinfo_dia.data.poq_item_glass_double2}}</td>
                                                                    <td>{{boqinfo_dia.data.poq_item_glass_double3}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>LAMINATED</td>
                                                                    <td>{{boqinfo_dia.data.poq_item_glass_laminate1}}</td>
                                                                    <td>{{boqinfo_dia.data.poq_item_glass_laminate2}}</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class='hed'>Drawing</td>
                                                                    <td colspan="4">{{boqinfo_dia.data.poq_drawing}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class='hed'>Finish</td>
                                                                    <td colspan="4">{{boqinfo_dia.data.finish_name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class='hed'>System</td>
                                                                    <td colspan="4">{{boqinfo_dia.data.system_type_name}}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                                <td style="text-align: center;">{{
                                                    (+boqinfo_dia.data.poq_qty) === 0 ? "-" : 
                                                    (+boqinfo_dia.data.poq_qty).toLocaleString(
                                                        undefined,
                                                        {
                                                            maximumFractionDigits : 2
                                                        }
                                                    )
                                                }}</td>
                                                <td style="text-align: center;">{{boqinfo_dia.data.unit_name}}</td>
                                                
                                                <td style="text-align: center;">{{
                                                    (+boqinfo_dia.data.area) === 0 ? 
                                                    '-' :  (+boqinfo_dia.data.area).toLocaleString(undefined,{maximumFractionDigits : 2})
                                                }}</td>
                                              
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="old_pgm_fitbox" ng-if="boqinfo_dia.notes.length !== 0"> 
                                    
                                    <table class="old_table itemlist" style="width: 1300px;">
                                        <thead>
                                            <tr>
                                                <th>S.No#</th>
                                                <th>Description</th>
                                            <tr>                                            
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="x in boqinfo_dia.notes">
                                                <td style="width: 75px;">{{$index+1}}</td>
                                                <td>{{x.boq_note_notes}}</td>
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
                <div class="{{res.theme}}" ng-show="res.display">
                    <i class="{{res.icon}}"></i>
                    <span>{{res.msg}}</span>
                </div>
            </div>
        </form>

    </div>
</div>