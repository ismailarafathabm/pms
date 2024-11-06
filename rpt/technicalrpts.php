<?php
include_once('../../../../conf.php');
?>
<?php include_once('../menu.php') ?>
<div class="route-continer-project route-container-ok">
    <div class="route-container-header">
        <div class="router-container-back-btn">
            <a href="" id="back_btn">
                <i id="page-go-back" class="fa fa-arrow-left"></i>
            </a>
        </div>
        <div class="router-container-title">
            <Strong> {{'approvals' | uppercase}}</Strong>
        </div>
        <div class="router-container-options">
            <button ng-click="printclick()" class="nafco-button nafco-btn-ok">
                Print
            </button>
            <button onclick="tableToExcel('techapprovals', 'Technical Approvals')" class="nafco-button nafco-btn-ok">
                <i class="fa fa-file-excel-o"></i>
                Export Excel
            </button>
        </div>
    </div>
    <div class="route-container-content">
        <table class="project-list-table borderd">
            <thead>
                <tr>
                    <th style="width:50px;">#S.NO</th>
                    <th style="width:100px;">Project No</th>
                    <th>Project Name</th>
                    <th></th>
                    <th>Approval Details</th>
                    <th>D.Approved</th>
                    <th>D.Released</th>
                    <th>Remarks</th>
                    <th style="width:180px;"> Status</th>
                <tr>
            </thead>
            <tbody>
                <tr>
                    <td>

                    </td>
                    <td>
                        <div style="display:flex">
                            <select class="nafco-inputs" ng-model="fi.project_no">
                                <option value="">-All-</option>
                                <option ng-repeat="pr in viewproject" value="{{pr.project_no | uppercase}}">{{pr.project_no | uppercase}}</option>
                            </select>
                            <!-- <input type="text" ng-model="fi.project_no" class="nafco-inputs"> -->
                            <!-- <button>sort</button> -->
                        </div>
                    </td>
                    <td>
                        <select ng-model="fi.project_name" class="nafco-inputs">
                            <option value="">-All-</option>
                            <option ng-repeat="pr in viewproject" value="{{pr.project_name | uppercase}}">{{pr.project_name | uppercase}}</option>
                        </select>
                        <!-- <input type="text" ng-model="fi.project_name" class="nafco-inputs"> -->
                    </td>

                    <td>

                    </td>
                    <td><input type="text" ng-model="fi.approval_type_name" class="nafco-inputs"></td>
                    <td><input type="text" ng-model="fi.approvals_adate" class="nafco-inputs"></td>
                    <td><input type="text" ng-model="fi.approvals_rdate" class="nafco-inputs"></td>
                    <td><input type="text" ng-model="fi.approvals_remarks" class="nafco-inputs"></td>
                    <td>
                        <select ng-model="fi.approvals_status" class="nafco-inputs">
                            <option value="">-Choose Status-</option>
                            <option value="a">Approved Not Released</option>
                            <option value="b">Approval Released</option>
                        </select>
                    </td>
                </tr>
                <tr ng-repeat="ap in _tempapprovals | filter:fi">
                    <td>{{$index+1}}</td>
                    <td>{{ap.project_no | uppercase}}</td>
                    <td>{{ap.project_name | uppercase}}</td>
                    <td>
                        <a download="{{ap.project_no .approval_type_name }}" target="_blank" href="<?php echo $url_base ?>assets/approvals/{{ap.approvals_token}}.pdf" ng-if="ap.approvals_status ==='b'" class="link mr-1">
                            <i class="fa fa-download">

                            </i>
                        </a>
                    </td>
                    <td>

                        {{ap.approval_type_name | uppercase}}

                    </td>
                    <td>

                        {{ap.approvals_adate | date :  "dd-MMM-yyyy"}}

                    </td>
                    <td>

                        {{ap.approvals_rdate | date :  "dd-MMM-yyyy"}}

                    </td>
                    <td>{{ap.approvals_remarks}}</td>
                    <td>
                        <p ng-if="ap.approvals_status==='a'" class="txt-danger"> {{'approval not released' | uppercase }} </p>
                        <p ng-if="ap.approvals_status==='b'" class="txt-ok"> {{'approval released' | uppercase }} </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="display:none;">
        <table class="project-list-table borderd" id="techapprovals">
            <thead>
                <tr>
                    <th style="width:50px;">#S.NO</th>
                    <th>Project No</th>
                    <th>Project Name</th>
                    <th>Approval Details</th>
                    <th>D.Approved</th>
                    <th>D.Released</th>
                    <th>Remarks</th>
                    <th style="width:180px;"> Status</th>
                <tr>
            </thead>
            <tbody>
                <tr ng-repeat="ap in _tempapprovals | filter:fi">
                    <td>{{$index+1}}</td>
                    <td>{{ap.project_no | uppercase}}</td>
                    <td>{{ap.project_name | uppercase}}</td>
                    <td>

                        {{ap.approval_type_name | uppercase}}

                    </td>
                    <td>

                        {{ap.approvals_adate | date :  "dd-MMM-yyyy"}}

                    </td>
                    <td>

                        {{ap.approvals_rdate | date :  "dd-MMM-yyyy"}}

                    </td>
                    <td>{{ap.approvals_remarks}}</td>
                    <td>
                        <p ng-if="ap.approvals_status==='a'"> {{'approval not released' | uppercase }} </p>
                        <p ng-if="ap.approvals_status==='b'"> {{'approval released' | uppercase }} </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<script type="text/javascript">
    var tableToExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,',
            template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
            base64 = function(s) {
                return window.btoa(unescape(encodeURIComponent(s)))
            },
            format = function(s, c) {
                return s.replace(/{(\w+)}/g, function(m, p) {
                    return c[p];
                })
            }
        return function(table, name) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {
                worksheet: name || 'Worksheet',
                table: table.innerHTML
            }
            window.location.href = uri + base64(format(template, ctx))
        }
    })()
</script>