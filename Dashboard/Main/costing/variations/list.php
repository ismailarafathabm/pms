<div class="ism-dialogbox" id="revision_list">
    <div class="ism-dialog-body ism-dialog-bodytables">
        <div class="dialog-head">
            <div class="dialog-head-title">
                Variation REF No : <u>{{refno_display}}</u> 's Revision List
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('revision_list').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="dialog-body">
            <table class="dialog-table">
                <thead>
                    <tr>

                        <th class="fiexdheader">S.No</th>
                        <?php
                        if ($_access === true) {
                        ?>
                            <th class="fiexdheader"></th>
                        <?php
                        }
                        ?>


                        <th class="fiexdheader">Ref No</th>
                        <th class="fiexdheader">Revision No</th>
                        <th class="fiexdheader">Atte</th>
                        <th class="fiexdheader">Contractor/Client</th>
                        <th class="fiexdheader">Date</th>
                        <th class="fiexdheader">Subject</th>
                        <th class="fiexdheader">Description</th>
                        <?php
                        if ($_access === true) {
                        ?>
                            <th class="fiexdheader">Total Amount</th>
                        <?php
                        }
                        ?>

                        <th class="fiexdheader">Region</th>
                        <th class="fiexdheader">Sales Man</th>
                        <th class="fiexdheader">Status</th>
                        <?php
                        if ($_access === true) {
                        ?>
                            <th class="fiexdheader"></th>
                        <?php
                        }
                        ?>

                        <?php
                        if ($_access === true) {
                        ?>
                            <th class="fiexdheader">Actions</th>
                        <?php
                        }
                        ?>

                    <tr>
                </thead>
                <tbody>
                    <tr ng-repeat="vr in revisionlist | filter:f2">
                        <td>
                            {{$index+1}}
                        </td>
                        <?php
                        if ($_access === true) {
                        ?>
                            <td>
                                <center>
                                    <a target="_blank" href="<?php echo $url_base ?>assets/v1/{{vr.revison_token}}.pdf">
                                        <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                                    </a>
                                </center>
                            </td>
                        <?php
                        }
                        ?>

                        <td class="{{vr.revision_status==='3'?'td-danger':'' || vr.revision_status==='1'?'td-yellow':'' || vr.revision_status==='2'?'td-green':'' || vr.revision_status==='4'?'td-orange':''}}">
                            {{vr.revison_refno}}
                        </td>
                        <td class="{{vr.revision_status==='3'?'td-danger':'' || vr.revision_status==='1'?'td-yellow':'' || vr.revision_status==='2'?'td-green':'' || vr.revision_status==='4'?'td-orange':''}}">
                            {{vr.revison_no}}
                        </td>
                        <td>
                            {{vr.revison_atten}}
                        </td>
                        <td>
                            {{vr.revision_to}}
                        </td>
                        <td>
                            {{vr.revision_date}}
                        </td>

                        <td>
                            {{vr.v_sub_name}}
                        </td>
                        <td>
                            {{vr.revision_description}}
                        </td>
                        <?php
                        if ($_access === true) {
                        ?>
                            <td style="text-align:right">
                                {{vr.revision_amount | number : fractionSize}}
                            </td>
                        <?php
                        }
                        ?>

                        <td>
                            {{vr.region_name}}
                        </td>
                        <td>
                            {{vr.salesman_code}} - {{vr.salesman_name}}
                        </td>
                        <td class="{{vr.revision_status==='3'?'td-danger':'' || vr.revision_status==='1'?'td-yellow':'' || vr.revision_status==='2'?'td-green':'' || vr.revision_status==='4'?'td-orange':''}}">
                            <p ng-if="vr.revision_status==='1'">
                                {{'ISSUED FOR APPROVAL' | uppercase}}
                            </p>
                            <p ng-if="vr.revision_status==='2'">
                                {{'APPROVED' | uppercase}}
                            </p>
                            <p ng-if="vr.revision_status==='3'">
                                {{'cancelled' | uppercase}}
                            </p>
                            <p ng-if="vr.revision_status==='4'">
                                {{'dummy' | uppercase}}
                            </p>
                            <p ng-if="vr.revision_status==='5'">
                                {{'Paid/Invoice' | uppercase}}
                            </p>
                        </td>
                        <?php
                        if ($_access === true) {
                        ?>
                            <td>
                                <center ng-if="v.revision_status !== '1' && v.revision_status !== '5'">
                                    <a target="_blank" href="<?php echo $url_base ?>assets/vs1/{{vr.revison_token}}.pdf">
                                        <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                                    </a>
                                </center>
                            </td>
                        <?php
                        }
                        ?>

                        <?php
                        if ($_access === true) {
                        ?>
                            <td>
                                <center>
                                    <button ng-if="vr.revision_status_n === 'x' && '<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='estimate' || '<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='Management'" type="button" ng-click="status_change(vr)" class="ism-btns btn-save" style="padding:2px 5px">
                                        <i class="fa fa-pencil"></i> Update Status
                                    </button>
                                    <button ng-if="vr.revision_status_n === 'x' && '<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='operation'" type="button" ng-click="status_change_others(vr)" class="ism-btns btn-save" style="padding:2px 5px">
                                        <i class="fa fa-pencil"></i> Update Status
                                    </button>
                                </center>
                            </td>
                        <?php
                        }
                        ?>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>