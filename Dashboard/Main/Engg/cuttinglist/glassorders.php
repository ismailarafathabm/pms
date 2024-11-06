<div class="ism-dialogbox" id="glass_orderlist">
    <div class="ism-dialog-body ism-dialog-bodytables">
        <div class="dialog-head">
            <div class="dialog-head-title">
                {{'Glass Order Released' | uppercase}}
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('glass_orderlist').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="dialog-body">
            <table class="dialog-table">
                <thead id="hidiv">
                    <tr>
                        <th class="fiexdheader">Glass Ord.No.</th>
                        <th class="fiexdheader">File</th>
                        <th class="fiexdheader">DONE BY</th>
                        <th class="fiexdheader">RELEASED TO PURCH.</th>
                        <th class="fiexdheader">RECEIVED FROM PURCH.</th>
                        <th class="fiexdheader">Glass Order Status</th>
                        <th class="fiexdheader">SUPPLIER</th>
                        <th class="fiexdheader">GLASS TYPE</th>
                        <th class="fiexdheader">GLASS SPECIFICATION</th>
                        <th class="fiexdheader">MARKING LOCATION</th>
                        <th class="fiexdheader">QTY</th>
                        <th class="fiexdheader">REMARK</th>

                    <tr>
                </thead>
                <tbody>
                    <tr ng-repeat="x in glassorderlist | filter:fil">
                        <td style="text-align: center;">
                            {{x.glassorderno}}
                        </td>
                        <td>
                            <div ng-if="x.file=='1'">
                                <a target="_blank" href="<?php echo $url_asset ?>/glassorder/{{x.glassorder_token}}.pdf" class="link">
                                    <i class="fa fa-download"></i>
                                </a>
                            </div>
                        </td>
                        <td>
                            {{x.doneby}}
                        </td>
                        <td>
                            {{x.releasedtopurchase}}
                        </td>
                        <td>
                            {{x.recivedfrompurchas}}
                        </td>
                        <td>
                            {{x.orderstatus}}
                        </td>
                        <td style="font-size:12px;">
                            {{x.supplier_name}}
                        </td>

                        <td style="font-size:12px;">
                            {{x.glasstype_name}}
                        </td>
                        <td style="font-size:9px;">
                            {{x.glassdescription}}
                        </td>
                        <td style="font-size:10px;">
                            {{x.markinglocation}}
                        </td>
                        <td>
                            {{x.QTY}}
                        </td>
                        <td style="font-size:11px;">
                            {{x.remarks}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>