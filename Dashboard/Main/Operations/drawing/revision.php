<div class="ism-dialogbox" id="revision_list">
    <div class="ism-dialog-body ism-dialog-bodytables">
        <div class="dialog-head">
            <div class="dialog-head-title">
                Drawing No : <u>{{_drawingno}}</u> - Revision List
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('revision_list').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="dialog-body">
            <table class="dialog-table">
                <thead>
                    <tr>
                        <th class="fiexdheader">#S No</th>
                        <?php
                        if ($_update_access === true) {
                        ?>
                            <th class="fiexdheader">Edit</th>
                        <?php
                        }
                        ?>
                        <th class="fiexdheader">#Drawing No</th>
                        <th class="fiexdheader">Rev #</th>
                        <th class="fiexdheader">Sub.#</th>
                        <th class="fiexdheader">Submited On</th>
                        <th class="fiexdheader">Received On</th>
                        <th class="fiexdheader">Client Approved On</th>
                        <th class="fiexdheader">Code</th>
                        <th class="fiexdheader"> Delay</th>


                        <th class="fiexdheader">File</th>

                    <tr>
                </thead>
                <tbody>
                    <tr ng-repeat="x in revision_list | filter:appfilter">
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':'' || x.approvals_last_status==='H'?'td-yellow3':'' || x.approvals_last_status==='X'?'td-red3':'' || x.approvals_last_status==='F'?'td-blue3':''}}">
                            {{$index + 1}}
                        </td>
                        <?php
                        if ($_update_access === true) {
                        ?>
                            <td>
                                <button type="button" ng-click="edit_revision(x)" class='ism-btns btn-normal' style="padding:2px 5px">
                                    <i class="fa fa-pencil"></i>
                                    Edit
                                </button>

                            </td>
                        <?php
                        }
                        ?>
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':'' || x.approvals_last_status==='H'?'td-yellow3':'' || x.approvals_last_status==='X'?'td-red3':'' || x.approvals_last_status==='F'?'td-blue3':''}}">
                            {{x.approvals_info_drawing_no | uppercase}}
                        </td>
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':'' || x.approvals_last_status==='H'?'td-yellow3':'' || x.approvals_last_status==='X'?'td-red3':'' || x.approvals_last_status==='F'?'td-blue3':''}}">
                            {{x.approvals_info_reveision_no}}
                        </td>
                        <td>
                            {{x.approvals_info_sub}}
                        </td>
                        <td>
                            {{x.approvals_info_submited_on}}
                        </td>
                        <td>
                            {{x.approvals_info_received_on}}
                        </td>
                        <td>
                            {{x.approvals_info_client_on}}
                        </td>

                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':'' || x.approvals_last_status==='H'?'td-yellow3':'' || x.approvals_last_status==='X'?'td-red3':'' || x.approvals_last_status==='F'?'td-blue3':''}}">
                            {{x.approvals_info_code}}
                        </td>
                        <td style="text-align:center">
                            {{x.delay}}
                        </td>


                        <td>
                            <div style="display:flex;flex-direction:row;gap:5px;align-items: center; justify-content: flex-start;">
                                <a target="_blank" ng-show="x.files === '1'" class="nafco-button nafco-sm-btn nafco-btn-noborder nafco-btn-danger" style="color:#000" target="_blank" href="<?php echo $url_base ?>assets/drawingapprovals/{{x.approvals_info_token}}.pdf">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a download="{{x.approvals_info_drawing_no | uppercase}}_ {{x.approvals_info_sub}}.pdf" ng-show="x.files === '1'" class="nafco-button nafco-sm-btn nafco-btn-noborder nafco-btn-danger" style="color:#000" target="_blank" href="<?php echo $url_base ?>assets/drawingapprovals/{{x.approvals_info_token}}.pdf">
                                    <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                                </a>


                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>