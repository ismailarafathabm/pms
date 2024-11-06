<?php
session_start();
$userdep = $_SESSION['nafco_alu_user_department'];
include_once '../../../../conf.php';
include_once '../../menu1.php';
include_once '../../glassorders/purchase/nst.php';
include_once '../../glassorders/procurement/st.php';
include_once '../../cuttinglist/component/st.php';
?>
<style>
    #project_autocompleate {
        margin-left: -355px;
        margin-top: -3px;
    }

    .autocompleate-dia {
        box-shadow: 10px 10px 20px #ddd;
    }

    .ism-pms-dialog-table {
        border-collapse: separate;
        border-spacing: 0;
        border: 1px solid #d7d7d7;
    }
    .ism-pms-dialog-tbale-header-cell{
        border: 1px solid #d5cece;
        padding: 12px 15px;
        background: #e9e9e9;
        font-size: 0.85rem;
        line-height: 0.80rem;
    }
    .ism-table-dialog-table-body-cells{
        border: 1px solid #ebe6e6;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 0.80rem;
        padding: 3px;
        line-height: 0.80rem;
    }
    .ism-pms-dialog-table-headers{
        position: sticky;
        top: 0;
    }
</style>
<div class="sub-body" style="margin-top: 75px;height: calc(100vh - 100px);">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                MATERIAL RECEIPT
            </div>
            <div class="sub-container-right">

            </div>

        </div>
        <div class="sub-body-container-contents" style="height:94%;background: #fdfdfd;">
            <div class="forms">
                <div class="form-conatiner">
                    <div class="form-inputconatiners">
                        <div class="form-inputs">
                            <div class="form-input-headers">
                                Invoice Informations
                            </div>
                            <div class="form-inputs-elements" style="width:350px;margin-bottom:20px">
                                <div class="forminputs-inputs" style="flex:1 1 150px">
                                    <div class="forminput-label">Receipt No #</div>
                                    <div class="fominput-inputs">
                                        <input type="text" class="forminput-input" name="mrreciptno" id="mrreciptno" ng-model="mrrnew.data.mrreciptno" />
                                    </div>
                                </div>
                                <div class="forminputs-inputs" style="flex:1 1 150px">
                                    <div class="forminput-label">Date #</div>
                                    <div class="fominput-inputs">
                                        <input type="text" class="forminput-input" name="mrrdate" id="mrrdate" ng-model="mrrnew.data.mrrdate" />
                                    </div>
                                </div>
                                <div class="forminputs-inputs" style="flex:1 1 350px">
                                    <div class="forminput-label">Supplier</div>
                                    <div class="fominput-inputs">
                                        <input type="text" class="forminput-input" name="mrrsupplier" id="mrrsupplier" ng-model="mrrnew.data.mrrsupplier" />

                                    </div>
                                </div>
                                <div class="forminputs-inputs" style="flex:1 1 350px">
                                    <div class="forminput-label">Project</div>
                                    <div class="fominput-inputs">
                                        <input type="text" class="forminput-input" name="srcproject" id="srcproject" ng-model="srcproject" ng-keydown="showprojectdialgo()" />
                                        <div id="project_autocompleate" class="gen_autocompleate">
                                            <?php
                                            include_once "project.dia.php";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="forminputs-inputs" style="flex:1 1 150px">
                                    <div class="forminput-label">MR#</div>
                                    <div class="fominput-inputs">
                                        <select class="forminput-input" name="srcmrno" id="srcmrno" ng-model="srcmrno" ng-change="getMritems()">
                                            <option value="">-Select-</option>
                                            <option ng-repeat="x in projectmrs" value="{{x}}">{{x}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="forminputs-inputs" style="flex:1 1 150px">
                                    <div class="forminput-label">ITEM#</div>
                                    <div class="fominput-inputs">
                                        <input type="text" class="forminput-input" name="srcmritems" id="srcmritems" ng-model="srcmritems" ng-keydown="searchshow_mritems($event)" />
                                        <div id="mritems_autocompleate" class="gen_autocompleate" style="left: 192px;top: 235px;">
                                            <?php
                                            include_once "items.dia.php";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="forminputs-inputs" style="flex:1 1 300px">
                                    <div class="forminput-label">Description</div>
                                    <div class="fominput-inputs">
                                        <input type="text" class="forminput-input" name="mrrdescription" id="mrrdescription" ng-model="mrrnew.data.mrrdescription" />
                                    </div>
                                </div>
                                <div class="forminputs-inputs" style="flex:1 1 150px">
                                    <div class="forminput-label">Die Weight</div>
                                    <div class="fominput-inputs">
                                        <input type="text" class="forminput-input" name="mrrdieweight" id="mrrdieweight" ng-model="mrrnew.data.mrrdieweight" readonly/>
                                    </div>
                                </div>
                                <div class="forminputs-inputs" style="flex:1 1 150px">
                                    <div class="forminput-label">Length</div>
                                    <div class="fominput-inputs">
                                        <input type="text" class="forminput-input" name="mrritemlength" id="mrritemlength" ng-model="mrrnew.data.mrritemlength" readonly/>
                                    </div>
                                </div>
                                <div class="forminputs-inputs" style="flex:1 1 150px">
                                    <div class="forminput-label">O.Qty</div>
                                    <div class="fominput-inputs">
                                        <input type="text" class="forminput-input" name="mrordqty" id="mrordqty" ng-model="mrrnew.data.mrordqty" ng-change="calc_ord_wight()" readonly/>
                                    </div>
                                </div>
                                <div class="forminputs-inputs" style="flex:1 1 150px">
                                    <div class="forminput-label">O.Weight</div>
                                    <div class="fominput-inputs">
                                        <input type="text" class="forminput-input" name="mrordwt" id="mrrnew.data.mrordwt" ng-model="mrrnew.data.mrordwt" readonly/>
                                    </div>
                                </div>
                                <div class="forminputs-inputs" style="flex:1 1 150px">
                                    <div class="forminput-label">R.Qty <input type="checkbox" ng-model="calbyqty" ng-click="calby('q')" /></div>
                                    <div class="fominput-inputs">
                                        <input type="text" class="forminput-input" name="mrrqty" id="mrrqty" ng-model="mrrnew.data.mrrqty" ng-change="calc_receipt_weight()" />
                                    </div>
                                </div>
                                <div class="forminputs-inputs" style="flex:1 1 150px">
                                    <div class="forminput-label">R.Weight <input type="checkbox" ng-model="calbyweght" ng-click="calby('w')" /></div>
                                    <div class="fominput-inputs">
                                        <input type="text" class="forminput-input" name="mrrweight" id="mrrweight" ng-model="mrrnew.data.mrrweight" readonly/>
                                    </div>
                                </div>
                                <div class="forminputs-inputs" style="flex:1 1 150px">
                                    <div class="forminput-label">Unit Price</div>
                                    <div class="fominput-inputs">
                                        <input type="text" class="forminput-input" name="mrrunitprice" id="mrrunitprice" ng-model="mrrnew.data.mrrunitprice" ng-change="calc_receipt_weight()" />
                                    </div>
                                </div>
                                <div class="forminputs-inputs" style="flex:1 1 150px">
                                    <div class="forminput-label">Total Price</div>
                                    <div class="fominput-inputs">
                                        <input type="text" class="forminput-input" name="mrrtprice" id="mrrtprice" ng-model="mrrnew.data.mrrtprice" readonly/>
                                    </div>
                                </div>
                                <div class="forminputs-inputs" style="flex:1 1 150px">
                                    <div class="forminput-label">Others</div>
                                    <div class="fominput-inputs">
                                        <input type="text" class="forminput-input" name="mrrothers" id="mrrothers" ng-model="mrrnew.data.mrrothers" ng-change="calc_receipt_weight()" />
                                    </div>
                                </div>
                                <div class="forminputs-inputs" style="flex:1 1 150px">
                                    <div class="forminput-label">Sub Total</div>
                                    <div class="fominput-inputs">
                                        <input type="text" class="forminput-input" name="mrrectipsubtotal" id="mrrectipsubtotal" ng-model="mrrnew.data.mrrectipsubtotal" readonly/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-datas">
                            <div class="form-data-container">
                                <table class="ism-pms-dialog-table">
                                    <thead>
                                        <tr>
                                            <th class="ism-pms-dialog-tbale-header-cell"></th>
                                            <th class="ism-pms-dialog-tbale-header-cell">S.No</th>
                                            <th class="ism-pms-dialog-tbale-header-cell">Part#</th>
                                            <th class="ism-pms-dialog-tbale-header-cell">Description</th>
                                            <th class="ism-pms-dialog-tbale-header-cell">Die Weight</th>
                                            <th class="ism-pms-dialog-tbale-header-cell">Lenght</th>
                                            <th class="ism-pms-dialog-tbale-header-cell">Qty</th>
                                            <th class="ism-pms-dialog-tbale-header-cell">Weight</th>
                                            <th class="ism-pms-dialog-tbale-header-cell">Received Qty</th>
                                            <th class="ism-pms-dialog-tbale-header-cell">Received Wt</th>
                                            <th class="ism-pms-dialog-tbale-header-cell">Unit Price</th>
                                            <th class="ism-pms-dialog-tbale-header-cell">Total Price</th>
                                            <th class="ism-pms-dialog-tbale-header-cell">Sub Total</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="bttom">
                <div class="bttom-buttons">
                    <div class="bttom-button-containers">
                        <button class='btn-bttom btn-bttom-ok' ng-click="procurementreceipt_submit()">
                            <i class="fa fa-check"></i>
                            Save
                        </button>
                        <button class='btn-bttom btn-bttom-verfy'>
                            <i class="fa fa-search"></i>
                            Search
                        </button>
                        <button class='btn-bttom btn-bttom-verfy'>
                            <i class="fa fa-print"></i>
                            Print
                        </button>
                        <button class='btn-bttom btn-bttom-danger'>
                            <i class="fa fa-trash"></i>
                            Remove
                        </button>
                        <button class='btn-bttom btn-bttom-verfy' style="margin-left: 50px;">
                            <i class="fa fa-envelope"></i>
                            Post
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>