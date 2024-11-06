<div class="ism-pms-dialog" id="rpt_src_dialog2">
    <div class="ism-pms-dialog-container" style="width:340px">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Search Between Dates
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-show="!datefilter.isloading" onclick="document.getElementById('rpt_src_dialog2').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-body">
            <div class="ism-pms-dialog-body-rows" style="width: 225px;">
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Start Date</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="DD-MM-YYYY" class="ism-dialog-rows-input-controller" ng-model="payroll.startdate" name="startdate"  ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfig" selected-date="select_empdate" />
                    </div>
                </div>                
            </div>
            <div class="ism-pms-dialog-body-rows" style="width: 225px;">
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">End Date</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="DD-MM-YYYY" class="ism-dialog-rows-input-controller" ng-model="payroll.enddate" name="enddate"  ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfig" selected-date="selectdate_empdate" />
                    </div>
                </div>                
            </div>
        </div>
        <div class="ism-pms-dialog-footer">
            <button ng-disabled="isLoading || !payroll.startdate || payroll.startdate === '' || !payroll.enddate || payroll.enddate === '' " ng-click="filterdata_submit()" type="button" class="ism-pms-dialog-btn ism-btn-dialog-save">
                <i ng-show="isLoading" class="fa fa-spinner fa-spin"></i>
                <i ng-show="!isLoading" class="fa fa-search"></i>
                Search
            </button>
        </div>
    </div>
</div>


<style>
    .armodal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #181818c0;
    backdrop-filter: blur(3px) saturate(190%);
    
    z-index: 100000000;
    overflow: auto;
}

.armodal .armodel-container {
    position: relative;
    font-family: 'roboto', sans-serif;
    font-size: 14px;
    background-color: #fff;
    width: 1020px;
    margin: 10px auto;
    border-radius: 10px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    -ms-border-radius: 10px;
    -o-border-radius: 10px;
    overflow: hidden;
}

.armodal .armodel-container .armodelhead {
    position: relative;
    background-color: #d7e0e2;
    display: flex;
    justify-content: space-between;
    align-items: center;
    line-height: 1.1rem;
    padding: 12px 8px;
}

.armodal .armodel-container .armodelhead .armodel-title {
    position: relative;
    font-size: 16px;
    font-weight: bold;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.armodal .armodel-container .armodelhead .armodel-title .left-titles {
    margin-left: 10px;
}

.armodal .armodel-container .armodelhead .armodel-closebtn {
    border: 1px solid transparent;
    padding: 3px;
    border-radius: 6px;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    -ms-border-radius: 6px;
    -o-border-radius: 6px;
    cursor: pointer;
    font-size: 18px;
}

.armodal .armodel-container .armodelhead .armodel-closebtn:hover {
    background-color: #ff9c9c;
    box-shadow: 3px 3px 6px #ffa8a8;
    border: 1px solid #ff5b5b;
}

.armodal .armodel-container .armodelhead .armodel-closebtn:hover i {
    color: #481919;
}

.armodal .armodel-container .armodelhead .armodel-closebtn .fa {
    margin: 0px !important
}

.armodal .armodel-container .armodelbody {
    position: relative;
    overflow: auto;
    margin: 5px 0px 5px 0px;
    padding: 10px;
}

.armodal .armodel-container .armodelbody .armodelbodywarper {
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: start;
}

.armodal .armodel-container .armodelbody .armodelbodywarper .arbodyheader {
    /* background-color: #cde8f4; */
    padding: 3px 3px;
    font-weight: 600;
    color: #076994;
    border-bottom: 1px solid #0591cf;
    /* border-radius: 5px; */
    margin-bottom: 2px;
}

.armodal .armodel-container .armodelbody .armodelbodywarper .row{        
    display: flex;
    flex-wrap: wrap;
    box-sizing: border-box;
    padding : 5px;
    justify-content: center;
}

.armodal .armodel-container .armodelbody .armodelbodywarper .row .frm{
    display: flex;
    width: 180px;
    flex-direction: column;
    justify-content: start;
    align-items: flex-start;    
}



.armodal .armodel-container .armodelbody .armodelbodywarper .row .frm .frmlable{
    font-weight: bold;
}
.armodal .armodel-container .armodelbody .armodelbodywarper .row .frm .frmcontraollers-entry{
    display: flex;
    width: 160px;
    margin: 2px 0;
}
.armodal .armodel-container .armodelbody .armodelbodywarper .row .col2{
    width: 450px;
    margin-right: 2px;
}
.armodal .armodel-container .armodelbody .armodelbodywarper .row .col2 .row{
    display: flex;
    flex-wrap: wrap;
    box-sizing: border-box;
    padding : 5px;
}
.armodal .armodel-container .armodelbody .armodelbodywarper .row .col2 .frm{
    display: flex;
    width: 220px;
    flex-direction: column;
    justify-content: start;
    align-items: flex-start;    
}
.armodal .armodel-container .armodelbody .armodelbodywarper .row .col2 .row .frm .frmcontraollers-entry{
    display: flex;
    width: 200px;
    margin: 2px 0;
}

.arnewinput {
    border: 1px solid #020202;
    /* border-radius: 3px; */
    font-family: 'roboto', sans-serif;
    font-size: 14px;
    line-height: 1.4rem;
    align-items: center;
    width: 100%;
    outline: 1px solid transparent !important;
}

.arnewinput:disabled {
    background-color: #ffdcdc !important;
    cursor: no-drop !important;
    border: 1px solid transparent !important;
    outline: none !important;
}

.nomal:hover,
.nomal:focus,
.nomal:active {
    background: #fff;
    /* box-shadow: 1px 1px 12px #c3e9fb; */
    border: 1px solid #0085c1;
}

.danger:hover,
.danger:focus,
.danger:active {
    background: #fff;
    
    border: 1px solid #861d1d;
}
.danger:read-only{
    background-color: #fff3f3;
    /* box-shadow: 1px 1px 12px #fbc3c3; */
    border: 1px solid #ad7676;
}

.nomal:read-only
{
    background: #eaf4f8;
    /* box-shadow: 1px 1px 12px #c3e9fb; */
    border: 1px solid #2a5163;
}

 .dangerhead {
     
    color: #940707 !important;
    border-bottom: 1px solid #cf0505 !important;    
    
    
}
.armodal .armodel-container .arfoot{
    position: relative;
    margin : 5px 0px;
    padding : 5px 8px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.armodal .armodel-container .arfoot .button-list-right .cancelbutn{
    line-height: 1.3rem;    
    box-sizing: border-box;
    background: #ffcbcb;
    border: 1px solid #f14c4ca3;
    color: #c70000;
    

}

.armodal .armodel-container .arfoot .button-list-left{
    position: relative;
    display: flex;
    align-items: center;
}
.armodal .armodel-container .arfoot .button-list-left .printpayslip{
    line-height: 1.3rem;
    box-sizing: border-box;
    background: #1b87b1;
    border: 1px solid #1b87b1;
    color: #e1f0ff;    
    margin-right: 10px;
    text-decoration: none;
    padding : 3px;
    
}
.armodal .armodel-container .arfoot .button-list-left .submitbutton{
    line-height: 1.3rem;    
    box-sizing: border-box;
    background: #2c7575;
    border: 1px solid #2c7575;
    color: #9cf3dd;
    padding : 3px;
    
}
.armodal .armodel-container .arfoot .button-list-left .submitbutton:disabled{
    background-color: #aaaaaa;
    color : #000;
    cursor: no-drop;
}


.armodal .armodel-container .arfoot .button-list-right .cancelbutn:hover,
.armodal .armodel-container .arfoot .button-list-left .printpayslip:hover,
.armodal .armodel-container .arfoot .button-list-left .submitbutton:hover{
    color: #fff9f9;
    background: #2d2b2b;
    border: 1px solid #2d2b2b;
    transition: all 0.3s;
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -ms-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
}
.divrow {
            display: table-row;
        }

        .divcells {
            display: table-cell;
            white-space: nowrap;
        }

        .headersdivrow {
            padding: 8px 5px;
            justify-content: start;
            align-items: start;
            background: #d4d9ea;
            font-size: 14px;
            font-weight: 600;
            border-bottom: 1px solid #999daa;
            border-top: 1px solid #999daa;
            border-right: 1px solid #999daa;
        }

        .divcellbody {
            padding: 2px 5px;
            border-bottom: 1px solid #999daa;
            border-right: 1px solid #999daa;
            font-size: 14px;

        }

        .divcellfirst {
            border-left: 1px solid #999daa;
        }
</style>


<div class="armodal" id="rpt_emp_dialog">
        <div class="armodel-container" style="width:850px;">
            <div class="armodelhead">
                <div class="armodel-title">
                    <div class="left-logo">
                        <i class="fa fa-edit"></i>
                    </div>
                    <div>
                        <div class="left-titles">Employee Details {{_empinfomanpower}}</div>
                        <div class="left-titles">Project Name : <strong>{{_empinfomanpowerdet.pjname}}</strong></div>
                    </div>
                </div>
                <div class="armodel-closebtn" onclick="document.getElementById('rpt_emp_dialog').style.display='none'">
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <div class="armodelbody">
                <button type="button" ng-click="print_myinfos()">Print</button>
                <div class="armodelbodywarper">
                    <div class="row" style="justify-content: flex-start;">
                        <div class="divtable">
                            <div class="divrow headers">
                                <div class="divcells headersdivrow divcellfirst" style="width: 55px;">S.No</div>
                                <div class="divcells headersdivrow" style="width: 57px;">File NO</div>
                                <div class="divcells headersdivrow" style="width: 220px;">Name</div>
                                <div class="divcells headersdivrow" style="width: 120px;">Nationality</div>
                                <div class="divcells headersdivrow" style="width: 140px;">Designation</div>
                                <div class="divcells headersdivrow">Present</div>
                                <div class="divcells headersdivrow">Absent</div>
                                <div class="divcells headersdivrow">Total</div>
                                <div class="divcells headersdivrow">Amount</div>
                            </div>
                            <div class="divrow">
                                <div class="divcells divcellbody divcellfirst">

                                </div>
                                <div class="divcells divcellbody divcellfirst">
                                    <input ng-model="src.fileno" class="arnewinput nomal" placeholder="Search file no" ng-change="filter_fileno()">
                                </div>
                                <div class="divcells divcellbody divcellfirst">
                                    <input ng-model="src.ename" class="arnewinput nomal" placeholder="Search Name" ng-change="filter_name()">
                                </div>
                                <div class="divcells divcellbody divcellfirst">
                                    <select ng-model="src.enationality" class="arnewinput nomal" ng-change="filter_nationality()">
                                        <option value="">-Select-</option>
                                        <option ng-repeat="x in _empinfomanpowerdet.countrys" value="{{x}}">{{x}}</option>
                                    </select>
                                </div>
                                <div class="divcells divcellbody divcellfirst">
                                    <select ng-model="src.eposition" class="arnewinput nomal" ng-change="filter_category()">
                                        <option value="">-Select-</option>
                                        <option ng-repeat="x in _empinfomanpowerdet.positions" value="{{x}}">{{x}}</option>
                                    </select>
                                </div>
                                <div class="divcells divcellbody divcellfirst">

                                </div>
                                <div class="divcells divcellbody divcellfirst">

                                </div>
                                <div class="divcells divcellbody divcellfirst">

                                </div>
                                <div class="divcells divcellbody divcellfirst">

                                </div>
                            </div>
                            <div ng-repeat="emp in (flist=(_empinfomanpowerdet.employsees|filter :src))" class="divrow">
                                <div class="divcells divcellbody divcellfirst">
                                    {{$index+1}}
                                </div>
                                <div class="divcells divcellbody">
                                    {{emp.fileno}}
                                </div>
                                <div class="divcells divcellbody">
                                    {{emp.ename}}
                                </div>
                                <div class="divcells divcellbody">
                                    {{emp.enationality}}
                                </div>

                                <div class="divcells divcellbody">
                                    {{emp.eposition}}
                                </div>
                                <div class="divcells divcellbody">
                                    {{emp.pres}}
                                </div>
                                <div class="divcells divcellbody" style='color :red'>
                                    {{emp.abse}}
                                </div>
                                <div class="divcells divcellbody">
                                    {{emp.totalemp}}
                                </div>
                                <div class="divcells divcellbody" style="font-weight:bold">
                                    {{(+emp.amount).toLocaleString()}}
                                </div>
                            </div>

                            <div class="divrow headers">
                                <div class="divcells headersdivrow divcellfirst" style="width: 55px;"></div>
                                <div class="divcells headersdivrow" style="width: 57px;"></div>
                                <div class="divcells headersdivrow" style="width: 220px;"></div>
                                <div class="divcells headersdivrow" style="width: 120px;"></div>
                                <div class="divcells headersdivrow" style="width: 140px;"></div>

                                <!-- <div class="divcells headersdivrow">{{_empinfomanpowerdet._tot_present}}</div> -->
                                <div class="divcells headersdivrow">{{flist |  sumrow : 'pres'}}</div>
                                <div class="divcells headersdivrow">{{flist |  sumrow : 'abse'}}</div>
                                <div class="divcells headersdivrow">{{flist |  sumrow : 'totalemp'}}</div>
                                <div class="divcells headersdivrow">{{flist |  sumrow : 'amount'}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="arfoot">
                <div class="button-list-right">
                    <button class="cancelbutn" type="button" onclick="document.getElementById('rpt_emp_dialog').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close</button>
                </div>
            </div>
        </div>
    </div>