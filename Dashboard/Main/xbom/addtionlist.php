<style>
    .title_table {
        padding: 5px;
        margin: 5px 0px;
        background-color: #f1f1f1;
        border: 1px dashed #015147;
        color: #015147;
        font-weight: bold;
        font-size: 14px;
    }
</style>
<div class="filterdialog" id="dia_addtionlist">
    <div class="filterdialog-conatiner" style="width:auto; background-color: #f9f9f9">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <i class="fa fa-plus"></i>
                </div>
                <div class="filterheadertext">
                    BOM - {{_bomno}} - Addtional
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('dia_addtionlist').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>

        <div class="filterdialogbody">
            <div class="filterdialogbodycontainer">
                <div class="tablemodal">
                    <div class="title_table">
                        BOM
                    </div>
                    <table class="old_table">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th colspan="6">Item</th>
                                <th colspan="2" class="n_req">Required</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th style="width:20px">S.No</th>
                                <th style="width:85px">Date</th>
                                <th style="width:100px">BOM NO.</th>
                                <th style="width:70px">Item Type</th>
                                <th style="width:65px">Proflie</th>
                                <th style="width:65px">Part No.</th>
                                <th style="width:200px">Description</th>
                                <th style="width:40px">Unit</th>
                                <th style="width:60px">Die Weight</th>
                                <th class="n_req" style="width:60px">Length</th>
                                <th class="n_req" style="width:60px">Bar Qty</th>
                                <th style="width:90px">Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="items in addtionlist" ng-if="items.bomtype==='O'">
                                <td>{{$index+1}}</td>
                                <td>{{items.bomdate_d}}</td>
                                <td>
                                    {{items.bomno}}
                                </td>
                                <td>{{items.mtype}}</td>
                                <td>{{items.bomprofileno}}</td>
                                <td>{{items.bompartno}}</td>
                                <td>{{items.bomdescription}} - {{items.alloy}} - {{items.finish}}</td>
                                <td>{{items.bomunit}}</td>
                                <td>{{items.bomdieweight}}</td>
                                <td class="n_req">{{items.bomreqlength}}</td>
                                <td class="n_req">{{items.bomreqbarqty}}</td>
                                <td>{{items.bomremark}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tablemodal" style="margin-top:10px">
                    <div class="title_table">
                        Addtional Informations
                    </div>
                    <table class="old_table">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th colspan="6">Item</th>
                                <th colspan="2" class="n_req">Required</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th style="width:20px">S.No</th>
                                <th style="width:85px">Date</th>
                                <th style="width:100px">BOM NO.</th>
                                <th style="width:70px">Item Type</th>
                                <th style="width:65px">Proflie</th>
                                <th style="width:65px">Part No.</th>
                                <th style="width:200px">Description</th>
                                <th style="width:40px">Unit</th>
                                <th style="width:60px">Die Weight</th>
                                <th class="n_req" style="width:60px">Length</th>
                                <th class="n_req" style="width:60px">Bar Qty</th>
                                <th style="width:90px">Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="items in addtionlist" ng-if="items.bomtype==='A'">
                                <td>{{$index+1}}</td>
                                <td>{{items.bomdate_d}}</td>
                                <td>
                                    {{items.bomno}}
                                </td>
                                <td>{{items.mtype}}</td>
                                <td>{{items.bomprofileno}}</td>
                                <td>{{items.bompartno}}</td>
                                <td>{{items.bomdescription}} - {{items.alloy}} - {{items.finish}}</td>
                                <td>{{items.bomunit}}</td>
                                <td>{{items.bomdieweight}}</td>
                                <td class="n_req">{{items.bomreqlength}}</td>
                                <td class="n_req">{{items.bomreqbarqty}}</td>
                                <td>{{items.bomremark}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="tablemodal" style="margin-top:10px">
                    <div class="title_table">
                        REVISIONS
                    </div>
                    <table class="old_table">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th colspan="6">Item</th>
                                <th colspan="2" class="n_req">Required</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th style="width:20px">S.No</th>
                                <th style="width:85px">Date</th>
                                <th style="width:100px">BOM NO.</th>
                                <th style="width:70px">Item Type</th>
                                <th style="width:65px">Proflie</th>
                                <th style="width:65px">Part No.</th>
                                <th style="width:200px">Description</th>
                                <th style="width:40px">Unit</th>
                                <th style="width:60px">Die Weight</th>
                                <th class="n_req" style="width:60px">Length</th>
                                <th class="n_req" style="width:60px">Bar Qty</th>
                                <th style="width:90px">Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="items in addtionlist" ng-if="items.bomtype==='R'">
                                <td>{{$index+1}}</td>
                                <td>{{items.bomdate_d}}</td>
                                <td>
                                    {{items.bomno}}
                                </td>
                                <td>{{items.mtype}}</td>
                                <td>{{items.bomprofileno}}</td>
                                <td>{{items.bompartno}}</td>
                                <td>{{items.bomdescription}} - {{items.alloy}} - {{items.finish}}</td>
                                <td>{{items.bomunit}}</td>
                                <td>{{items.bomdieweight}}</td>
                                <td class="n_req">{{items.bomreqlength}}</td>
                                <td class="n_req">{{items.bomreqbarqty}}</td>
                                <td>{{items.bomremark}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>