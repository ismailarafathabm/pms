<div class="filterdialog" id="dia_revision_list">
    <div class="filterdialog-conatiner" style="width:93%">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <i class="fa fa-edit"></i>
                </div>
                <div class="filterheadertext">
                    Variation REF No : <u>{{refno_display}}</u> 's Revision List
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('dia_revision_list').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="filterdialogbody">
            <div class="filterdialogbodycontainer" style="
                display: block;    
                overflow: auto;
                ">
                <div class="naf-table-div">
                    <div class="naf-pms-table">
                        <div class="naf-pms-row naf-pms-header">
                            <div class="naf-pms-cell  naf-pms-header-cell">S.No</div>
                            <div class="naf-pms-cell naf-pms-header-cell"></div>
                            <div class="naf-pms-cell naf-pms-header-cell"></div>
                            <div class="naf-pms-cell  naf-pms-header-cell">Ref No</div>
                            <div class="naf-pms-cell  naf-pms-header-cell">Revision No</div>
                            <div class="naf-pms-cell  naf-pms-header-cell">Atte</div>
                            <div class="naf-pms-cell  naf-pms-header-cell">Contractor/Client</div>
                            <div class="naf-pms-cell  naf-pms-header-cell">Date</div>
                            <div class="naf-pms-cell  naf-pms-header-cell">Subject</div>
                            <div class="naf-pms-cell  naf-pms-header-cell">Description</div>
                            <div class="naf-pms-cell  naf-pms-header-cell">Total Amount</div>
                            <div class="naf-pms-cell  naf-pms-header-cell">Region</div>
                            <div class="naf-pms-cell  naf-pms-header-cell">Sales Man</div>
                            <div class="naf-pms-cell naf-pms-header-cell"></div>
                            <div class="naf-pms-cell  naf-pms-header-cell">Status</div>
                        </div>
                        <div class="naf-pms-row" ng-repeat="vr in (xrevisionfilter = revisionlist )">
                            <div class="naf-pms-cell"> {{$index+1}}</div>
                            <div class="naf-pms-cell">
                                <div style="
                                display: block;
                                overflow: auto;
                            ">
                                    <div style="display:flex;">
                                        <!-- <select ng-model="statuschangeselect" class="new-inputs-black" ng-if="vr.revision_status_n === 'x'">
                                            <option value="">-Select-</option>
                                            <option value="2">Approved</option>
                                            <option value="5">Paid/Invoice</option>
                                            <option value="3">Cancelled</option>
                                            <option value="4">Dummy</option>
                                        </select>                
                                                                 -->
                                        <button type="button" ng-if="vr.revision_status_n === 'x'" ng-show="vr.revision_status==='4'" type="button" class="ism-btns btn-save" style="padding:2px 5px;margin:2px" ng-click="change_cancel_infos(vr)">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </button>
                                        <button type="button" ng-if="vr.revision_status_n === 'x'" ng-show="vr.revision_status==='2' || vr.revision_status==='5'" type="button" class="ism-btns btn-save" style="padding:2px 5px;margin:2px" ng-click="changeRevsion_accept_info(vr)">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </button>
                                        <button type="button" ng-if="vr.revision_status_n === 'x'" ng-show="vr.revision_status==='1' || vr.revision_status==='4'" type="button" class="ism-btns btn-save" style="padding:2px 5px;margin:2px" ng-click="changeRevisionStatus(vr)">
                                            <i class="fa fa-edit"></i>
                                            Update
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <div class="naf-pms-cell">
                                <a target="_blank" href="<?php echo $url_base ?>assets/v1/{{vr.revison_token}}.pdf">
                                    <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                                </a>
                            </div>
                            <div class="naf-pms-cell"> {{vr.revison_refno}}</div>
                            <div class="naf-pms-cell"> {{vr.revison_no}}</div>
                            <div class="naf-pms-cell"> {{vr.revison_atten}}</div>
                            <div class="naf-pms-cell"> {{vr.revision_to}} </div>
                            <div class="naf-pms-cell"> {{vr.revision_date}}</div>
                            <div class="naf-pms-cell"> {{vr.v_sub_name}} </div>
                            <div class="naf-pms-cell"> {{vr.revision_description}} </div>
                            <div class="naf-pms-cell naf-pms-cell-number" style="font-weight:bold"> {{vr.revision_amount | number}} </div>
                            <div class="naf-pms-cell"> {{vr.region_name}} </div>
                            <div class="naf-pms-cell"> {{vr.salesman_code}} - {{vr.salesman_name}}</div>
                            <div class="naf-pms-cell">
                                <a ng-show="vr.revision_status !== '1'" target="_blank" href="<?php echo $url_base ?>assets/vs1/{{vr.revison_token}}.pdf">
                                    <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                                </a>
                            </div>
                            <div class="naf-pms-cell"> {{vr.revision_status | statusfilter}} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>