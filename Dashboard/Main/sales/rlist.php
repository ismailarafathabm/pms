<div class="filterdialog" id="dia_revision_list">
    <div class="filterdialog-conatiner">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <i class="fa fa-list"></i>
                </div>
                <div class="filterheadertext">
                <strong>PROJECT : {{pjname}}</strong>'s  REVISION LIST 
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('dia_revision_list').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="filterdialogbody">
            <div class="naf-ams-tablediv" style='margin-top :10px;'>
                <div class="naf-asm-table-row">
                    <div class="naf-ams-table-cell table-inputs row-title tbl-view" style="width:50px">
                        S.No
                    </div>
                    <div class="naf-ams-table-cell table-inputs row-title tbl-view" style="width:150px">
                        Released Date
                    </div>
                    <div class="naf-ams-table-cell table-inputs row-title tbl-view" style="width:150px">
                        Duration
                    </div>
                    <div class="naf-ams-table-cell table-inputs row-title tbl-view" style="width:150px">
                        Amount (SR.)
                    </div>
                    <div class="naf-ams-table-cell table-inputs row-title tbl-view" style="width:150px">
                        Proposed System
                    </div>
                    <div class="naf-ams-table-cell table-inputs row-title tbl-view" style="width:150px">
                        Cost Engineer
                    </div>
                    <div class="naf-ams-table-cell table-inputs row-title tbl-view" style="width:150px">
                        Remark
                    </div>
                    <div class="naf-ams-table-cell table-inputs row-title tbl-view" style="width:150px">
                        Drawing No
                    </div>
                </div>
                <div class="naf-asm-table-row" ng-repeat="cashp in rev_list">
                    <div class="naf-ams-table-cell table-inputs tbl-view {{cashp.rcurrent === '1' ? '_green1' :  ''}}" style="width:50px">
                        {{$index+1}}
                    </div>
                    <div class="naf-ams-table-cell table-inputs tbl-view {{cashp.rcurrent === '1' ? '_green1' :  ''}}" style="width:150px">
                        {{cashp.rdate_d}}
                    </div>
                    <div class="naf-ams-table-cell table-inputs tbl-view {{cashp.rcurrent === '1' ? '_green1' :  ''}}" style="width:150px">
                        {{cashp.rduration}}
                    </div>
                    <div class="naf-ams-table-cell table-inputs tbl-view {{cashp.rcurrent === '1' ? '_green1' :  ''}}" style="width:150px;font-weight: 600;">
                        {{cashp.ramount | number}}
                    </div>
                    <div class="naf-ams-table-cell table-inputs tbl-view {{cashp.rcurrent === '1' ? '_green1' :  ''}}" style="width:150px">
                        {{cashp.rsystemtype}}
                    </div>
                    <div class="naf-ams-table-cell table-inputs tbl-view {{cashp.rcurrent === '1' ? '_green1' :  ''}}" style="width:150px">
                        {{cashp.rcosingeng}}
                    </div>
                    <div class="naf-ams-table-cell table-inputs tbl-view {{cashp.rcurrent === '1' ? '_green1' :  ''}}" style="width:150px">
                        {{cashp.rremarks}}
                    </div>
                    <div class="naf-ams-table-cell table-inputs tbl-view {{cashp.rcurrent === '1' ? '_green1' :  ''}}" style="width:150px">
                        {{cashp.rdrawingno}}
                    </div>
                </div>
            </div>
        </div>
        <div class="filterdialogfooter">
            <div class="rightbutton">
                <button type="button" class="closenewbutton" onclick="document.getElementById('new_revision_add').style.display = 'block'">
                    <i class="fa fa-times"></i>
                    Close
                </button>
            </div>
            <div class="leftbuttons">

            </div>
        </div>
    </div>
</div>