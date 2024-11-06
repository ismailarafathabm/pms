<table class="naf-pms-table">
    <thead class="naf-pms-header">
        <tr>
            <th>S.No</th>
            <?php
            if ($_btn_access) {
            ?>
                <th>Actions</th>
            <?php
            }
            ?>
            <?php
            if ($_access) {
            ?>
                <th>Approved File</th>
                <th>File</th>
            <?php
            }
            ?>
            <th>Ref. NO</th>
            <th>Status</th>
            <th>Approve Code</th>
            <th>Revision No</th>
            <th>Atte</th>
            <th>Contractor/Client</th>
            <th>Date</th>
            <th>Subject</th>
            <th>Description</th>
            <?php
            if ($_access) {
            ?>
                <th>Total Amount</th>
            <?php
            }
            ?>
            <th>Region</th>
            <th>Sales Man</th>
            <th></th>
        </tr>
        <tr>
            <td></td>
            <?php
            if ($_btn_access) {
            ?>
                <td></td>
            <?php
            }

            if ($_access) {
            ?>
                <td></td>
                <td></td>
            <?php
            }
            ?>
            <td>
                <input type="text" ng-model="src.variation_refno" class="new-inputs-black" style="padding:3px">
            </td>
            <td></td>
            <td></td>
            <td>
                <input type="text" ng-model="src.revision_no" class="new-inputs-black" style="padding:3px">
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <?php
            if ($_access) {
            ?>
                <td></td>
            <?php
            }
            ?>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr class="naf-pms-row {{v.variation_status === '1' ? 'bg-yellow' : ''}} {{v.variation_status === '4' ? 'bg-borwn' : ''}} {{v.variation_status === '2' ? 'bg-green' : ''}} {{v.variation_status === '5' ? 'bg-greens' : ''}}  {{v.variation_status === '3' ? 'bg-red' : ''}}" ng-repeat="v in (xfilter = variationslist | filter : src | orderBy : ['-variation_status','-variation_dateS'])">
            <td class="naf-pms-cell"> {{$index+1}}</td>
            <?php
            if ($_btn_access) {
            ?>
                <td class="naf-pms-cell">
                    <div style="display:flex;">
                        <button ng-show="v.variation_status === '1'" id="create_new_supplier" type="button" class="ism-btns btn-save" style="padding:2px 5px;margin:2px" ng-click="AddNewRevision_btn(v)">
                            <i class="fa fa-plus" style="margin:0px;"></i>
                            New Revision
                        </button>
                        <button id="create_new_supplier" type="button" class="ism-btns btn-save" style="padding:2px 5px;margin:2px" ng-click="Revision_btnList(v)">
                            <i class="fa fa-list" style="margin:0px;"></i>
                            Revison List
                        </button>
                        <button id="create_new_supplier" type="button" class="ism-btns btn-save" style="padding:2px 5px;margin:2px" ng-click="editvariationsdialogs(v)">
                            <i class="fa fa-pencil" style="margin:0px;"></i>
                            Edit
                        </button>
                    </div>
                </td>
            <?php
            }
            if ($_access) {
            ?>
                <td class="naf-pms-cell">
                    <a ng-show="v.variation_status !== '1'" target="_blank" href="<?php echo $url_base ?>assets/variation_status/{{v.variation_token}}.pdf" target="_blank" download="{{v.variation_refno}} - {{v.variation_status | statusfilter}}.pdf">
                        <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                    </a>
                </td>
                <td class="naf-pms-cell">
                    <a ng-if="v.variation_status !== '2'" target="_blank" href="<?php echo $url_base ?>assets/variations/{{v.variation_token}}.pdf" target="_blank" download="{{v.variation_refno}} {{v.variation_status | statusfilter}}.pdf">
                        <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                    </a>
                </td>
            <?php
            }
            ?>
            <td class="naf-pms-cell"> {{v.variation_refno}}</td>
            <td class="naf-pms-cell" style="font-weight:bold">
                <span class="fa fa-circle {{v.variation_status === '1' ? 'bg-yellow-fa' : ''}}  {{v.variation_status === '2' ? 'bg-green-fa' : ''}} {{v.variation_status === '5' ? 'bg-greens-fa' : ''}}  {{v.variation_status === '3' ? 'bg-red-fa' : ''}}"></span>
                {{v.variation_status | statusfilter}}
            </td>
            <td class="naf-pms-cell"> {{v.variation_status === '2' ? v.vno : ''}}</td>
            <td class="naf-pms-cell"> {{v.revision_no}}</td>
            <td class="naf-pms-cell"> {{v.variation_atten}}</td>
            <td class="naf-pms-cell"> {{v.variation_to}}</td>
            <td class="naf-pms-cell"> {{v.variation_date}}</td>
            <td class="naf-pms-cell"> {{v.v_sub_name}}</td>
            <td class="naf-pms-cell"> {{v.variation_description}}</td>
            <?php
            if ($_access) {
            ?>
                <td class="naf-pms-cell naf-pms-cell-number" style="font-weight:bold">{{v.variation_amount | number : fractionSize}}</td>
            <?php
            }
            ?>
            <td class="naf-pms-cell"> {{v.region_name}}</td>
            <td class="naf-pms-cell"> {{v.salesman_code }} - {{v.salesman_name | uppercase}}</td>
        </tr>
    </tbody>
</table>




<table class="naf-pms-table" id="dvData" style="display:none">
    <thead class="naf-pms-header">
        <tr>
            <th>S.No</th>           
            <th>Ref. NO</th>
            <th>Status</th>
            <th>Approve Code</th>
            <th>Revision No</th>
            <th>Atte</th>
            <th>Contractor/Client</th>
            <th>Date</th>
            <th>Subject</th>
            <th>Description</th>
            <?php
            if ($_access) {
            ?>
                <th>Total Amount</th>
            <?php
            }
            ?>
            <th>Region</th>
            <th>Sales Man</th>
            <th></th>
        </tr>        
    </thead>
    <tbody>
        <tr class="naf-pms-row {{v.variation_status === '1' ? 'bg-yellow' : ''}} {{v.variation_status === '4' ? 'bg-borwn' : ''}} {{v.variation_status === '2' ? 'bg-green' : ''}} {{v.variation_status === '5' ? 'bg-greens' : ''}}  {{v.variation_status === '3' ? 'bg-red' : ''}}" ng-repeat="v in (xfilter = variationslist | filter : src | orderBy : ['-variation_status','-variation_dateS'])">
            <td class="naf-pms-cell"> {{$index+1}}</td>           
            <td class="naf-pms-cell"> {{v.variation_refno}}</td>
            <td class="naf-pms-cell" style="font-weight:bold">
                <span class="fa fa-circle {{v.variation_status === '1' ? 'bg-yellow-fa' : ''}}  {{v.variation_status === '2' ? 'bg-green-fa' : ''}} {{v.variation_status === '5' ? 'bg-greens-fa' : ''}}  {{v.variation_status === '3' ? 'bg-red-fa' : ''}}"></span>
                {{v.variation_status | statusfilter}}
            </td>
            <td class="naf-pms-cell"> {{v.variation_status === '2' ? v.vno : ''}}</td>
            <td class="naf-pms-cell"> {{v.revision_no}}</td>
            <td class="naf-pms-cell"> {{v.variation_atten}}</td>
            <td class="naf-pms-cell"> {{v.variation_to}}</td>
            <td class="naf-pms-cell"> {{v.variation_date}}</td>
            <td class="naf-pms-cell"> {{v.v_sub_name}}</td>
            <td class="naf-pms-cell"> {{v.variation_description}}</td>
            <?php
            if ($_access) {
            ?>
                <td class="naf-pms-cell naf-pms-cell-number" style="font-weight:bold">{{v.variation_amount | number : fractionSize}}</td>
            <?php
            }
            ?>
            <td class="naf-pms-cell"> {{v.region_name}}</td>
            <td class="naf-pms-cell"> {{v.salesman_code }} - {{v.salesman_name | uppercase}}</td>
        </tr>
    </tbody>
</table>