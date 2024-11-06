<style>
    .ism-pms-dialog-tbale-header-cell,
    .ism-table-dialog-table-body-cells {
        font-size: 0.90rem;
        font-family: 'apple';
    }

    .ism-pms-dialog-body-sub {
        display: flex;
        width: 100%;
        margin-bottom: 10px;
        justify-content: center;
    }
</style>

<div class="ism-pms-dialog" ng-if="procurementreceipt.diashow">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Glass Order Received List
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-show="!procurementreceipt.isloading" ng-click="procurementreceipt.diashow  = false;">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="procurementreceipt.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>

        <div class="ism-pms-dialog-body" style="max-height: 80vh;">
            <div class="ism-pms-dialog-body-sub">
                <table class="ism-pms-dialog-table" style="width: 75%;">
                    <tbody class="ism-pms-dialog-table-body">
                        <tr>
                            <td class="ism-pms-dialog-tbale-header-cell" style="width: 175px;">GO#</td>
                            <td class="ism-table-dialog-table-body-cells" style="font-weight:600;">{{currentgo.gonodisp}}</td>
                            <td class="ism-pms-dialog-tbale-header-cell" style="width: 175px;">Date</td>
                            <td class="ism-table-dialog-table-body-cells" style="font-weight:600;">{{currentgo.procurement_orderdate_d.display}}</td>
                        </tr>
                        <tr>
                            <td class="ism-pms-dialog-tbale-header-cell" style="width: 175px;">Coating</td>
                            <td class="ism-table-dialog-table-body-cells" style="font-weight:600;">{{currentgo.procurement_coating}}</td>
                            <td class="ism-pms-dialog-tbale-header-cell" style="width: 175px;">Thickness</td>
                            <td class="ism-table-dialog-table-body-cells" style="font-weight:600;">{{currentgo.procurement_thickness}}</td>
                        </tr>

                        <tr>
                            <td class="ism-pms-dialog-tbale-header-cell" style="width: 175px;">Outter</td>
                            <td class="ism-table-dialog-table-body-cells" style="font-weight:600;">{{currentgo.procurement_out}}</td>
                            <td class="ism-pms-dialog-tbale-header-cell" style="width: 175px;">Inner</td>
                            <td class="ism-table-dialog-table-body-cells" style="font-weight:600;">{{currentgo.procurement_inner}}</td>
                        </tr>
                        <tr>
                            <td class="ism-pms-dialog-tbale-header-cell" style="width: 175px;">Glass Type</td>
                            <td class="ism-table-dialog-table-body-cells" style="font-weight:600;">{{currentgo.goglasstype}}</td>
                            <td class="ism-pms-dialog-tbale-header-cell" style="width: 175px;">Glass Spec</td>
                            <td class="ism-table-dialog-table-body-cells" style="font-weight:600;"> {{currentgo.goglassspec}}</td>
                        </tr>


                        <tr>
                            <td class="ism-pms-dialog-tbale-header-cell" style="width: 175px;">Qty</td>
                            <td class="ism-table-dialog-table-body-cells" style="font-weight:600;">{{currentgo.procurement_qty}}</td>
                            <td class="ism-pms-dialog-tbale-header-cell" style="width: 175px;">Area</td>
                            <td class="ism-table-dialog-table-body-cells" style="font-weight:600;"> {{currentgo.procurement_area}}</td>
                        </tr>
                        <tr>
                            <td class="ism-pms-dialog-tbale-header-cell" style="width: 175px;">Received Qty</td>
                            <td class="ism-table-dialog-table-body-cells" style="font-weight:600;">{{currentgo.receipt_qty}}</td>
                            <td class="ism-pms-dialog-tbale-header-cell" style="width: 175px;">Received Area</td>
                            <td class="ism-table-dialog-table-body-cells" style="font-weight:600;"> {{currentgo.receipt_area}}</td>
                        </tr>

                        <tr>
                            <td class="ism-pms-dialog-tbale-header-cell" style="width: 175px;">Balance Qty</td>
                            <td class="ism-table-dialog-table-body-cells" style="font-weight:600;">{{currentgo.go_balance_qty}}</td>
                            <td class="ism-pms-dialog-tbale-header-cell" style="width: 175px;">Balance Area</td>
                            <td class="ism-table-dialog-table-body-cells" style="font-weight:600;"> {{
                                (currentgo.go_balance_area).toLocaleString(undefined,{maximumFractionDigits:3})
                            }}</td>

                        </tr>
                        <tr>
                            <td class="ism-table-dialog-table-body-cells" colspan="4">
                                <button class="ism-pms-dialog-btn ism-btn-dialog-save" type="button" ng-click="addnewReceipt()">
                                                <i class="fa fa-plus"></i>
                                                Add New Receipt
                                            </button>
                                <div style="
                                display: none;
                                justify-content: end;
                                padding: 5px;
                                ">
                                    <div ng-if="editoptions">
                                        <div ng-if="currentgo.dellocation === 'Factory'">
                                            <button class="ism-pms-dialog-btn ism-btn-dialog-save" type="button" ng-click="addnewReceipt()" ng-if="currentuser === 'tauqqir'">
                                                <i class="fa fa-plus"></i>
                                                Add New Receipt
                                            </button>
                                        </div>
                                        <div ng-if="currentgo.dellocation !== 'Factory'">
                                            
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="ism-pms-dialog-body-rows" style="width: 1200px;">
                <table class="ism-pms-dialog-table">
                    <thead class="ism-pms-dialog-table-headers">
                        <tr>
                            <td class="ism-pms-dialog-tbale-header-cell">PDF</td>
                            <?php
                            if ($canuploadreceipt) {
                            ?>
                                <td class="ism-pms-dialog-tbale-header-cell"></td>
                            <?php
                            }
                            ?>
                            <td class="ism-pms-dialog-tbale-header-cell">S.No</td>
                            <td class="ism-pms-dialog-tbale-header-cell">Type</td>
                            <td class="ism-pms-dialog-tbale-header-cell">Invocie#</td>
                            <td class="ism-pms-dialog-tbale-header-cell">Date</td>
                            <td class="ism-pms-dialog-tbale-header-cell">Supplier</td>
                            <td class="ism-pms-dialog-tbale-header-cell">Coating</td>
                            <td class="ism-pms-dialog-tbale-header-cell">Thickness</td>
                            <td class="ism-pms-dialog-tbale-header-cell">Outter</td>
                            <td class="ism-pms-dialog-tbale-header-cell">Inner</td>
                            <td class="ism-pms-dialog-tbale-header-cell">Qty</td>
                            <td class="ism-pms-dialog-tbale-header-cell">Area</td>
                            <td class="ism-pms-dialog-tbale-header-cell">Remove</td>
                            <td class="ism-pms-dialog-tbale-header-cell" style="display: none;">Unit Price</td>
                            <td class="ism-pms-dialog-tbale-header-cell" style="display: none;">Others</td>
                            <td class="ism-pms-dialog-tbale-header-cell" style="display: none;">Total Price</td>
                        </tr>
                    </thead>
                    <tbody class="ism-pms-dialog-table-body">
                        <tr ng-repeat="i in procurementreceipt.procurementreceiptsdata">
                            <td class="ism-table-dialog-table-body-cells">
                                <div ng-if="i.rcfile === '1'">
                                    <a href="<?php echo $url_base ?>/assets/cuttinglists/gor/{{i.goreceiptid}}.pdf" target="_blank" download="Go Receipt {{i.goreceiptinvoiceno}}.pdf">
                                        <img src="<?php echo $url_base ?>/assets/pdfdownload.png?v=2.4.1.4" style="width:15px;">
                                    </a>
                                    <a href="<?php echo $url_base ?>/assets/cuttinglists/gor/{{i.goreceiptid}}.pdf" target="_blank">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                            <?php
                            if ($canuploadreceipt) {
                            ?>
                                <td class="ism-table-dialog-table-body-cells">

                                    <button type="button" class="ism-btns btn-normal" style="padding:2px 2px" ng-click="uploadgoreceipt(i.goreceiptid)">
                                        <i class='fa fa-file-pdf-o'></i>
                                    </button>
                                </td>
                            <?php
                            }
                            ?>
                            <td class="ism-table-dialog-table-body-cells">{{$index+1}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{i.goreceipttype}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{i.goreceiptinvoiceno}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{i.goreceiptdate_d.display}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{i.goreceiptsupplier}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{i.procurement_coating}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{i.procurement_thickness}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{i.procurement_out}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{i.procurement_inner}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{i.goreceiptqty}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{i.goreceiptarea}}</td>
                            <?php
                            if ($canuploadreceipt) {
                            ?>
                                <td class="ism-table-dialog-table-body-cells">

                                    <button type="button" class="ism-btns btn-delete" style="padding:2px 2px" ng-click="removereceipt(i.goreceiptid)" ng-show="<?php echo $user?> === i.goreceipteby">
                                        <i class='fa fa-trash'></i>
                                        Remove
                                    </button>
                                </td>
                            <?php
                            }
                            ?>
                            <td class="ism-table-dialog-table-body-cells" style="display: none;">{{i.goreceiptunitprice}}</td>
                            <td class="ism-table-dialog-table-body-cells" style="display: none;">{{i.goreceiptotherprice}}</td>
                            <td class="ism-table-dialog-table-body-cells" style="display: none;">{{i.goreceipttotalprice}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="ism-pms-dialog-footer">
            <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="procurementreceipt.diashow = false;">
                Close
            </button>
        </div>

    </div>
</div>