
<div class="filterdialog" id="dia_receiptdata" style="z-index: 10000005">
    <div class="filterdialog-conatiner" style="width:670px">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <i class="fa fa-plus"></i>
                </div>                
                <div class="filterheadertext" id="dialogTitleEdit">
                    PAINT PLANT RECEIPT
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('dia_receiptdata').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form id="receiptNew" name="newReceipt" ng-submit="receiptNew_submit()" autocomplete="off">
            <div class="filterdialogbody">
                <div class="filterdialogbodycontainer" style="flex-direction:row">                    
                    <div class="row">
                        <div class="new-lable">Date</div>
                        <div class="inputitmes">
                            <input ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" placeholder="dd-mm-yyyy"  type="text" name="returndate" ng-model="newSaveppData.returndate" class="new-inputs-black" required>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="new-lable">QTY</div>
                        <div class="inputitmes">                        
                            <input  type="text" name="ppid" ng-model="ppid" class="new-inputs-black" required style="display:none">
                            <input  type="text" name="returnqty" ng-model="newReceipt.returnqty" class="new-inputs-black" required>
                        </div>
                    </div>                                          
                    <div class="row">
                        <div class="new-lable">PP.RECEPT NO</div>
                        <div class="inputitmes">
                            <input  type="text" name="rcpno" ng-model="newReceipt.rcpno" class="new-inputs-black" required>
                        </div>
                    </div>                                        
                    <div class="row">
                        <div class="new-lable">Remarks</div>
                        <div class="inputitmes">
                            <input  type="text" name="remark" ng-model="newReceipt.remark" class="new-inputs-black" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filterdialogfooter">
                <div class="rightbutton">
                    <button type="button" class="closenewbutton" onclick="document.getElementById('dia_receiptdata').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="leftbuttons">
                    <button type="submit" class="savenewbutton" ng-disabled="newReceipt.$invalid || is_start_getrepott">
                        <i ng-show="!is_start_getrepott" class="fa fa-check"></i>
                        <i ng-show="is_start_getrepott" class="fa fa-spinner fa-pulse  fa-fw"></i>
                        Receive
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>