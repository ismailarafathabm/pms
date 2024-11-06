<?php
include_once('../../../../../../conf.php');
?>
<?php include_once('../../../sidemenu.php'); ?>



<div class="route-continer-project route-container-ok">
    <div class="route-container-header">
        <div class="router-container-back-btn">
            <a href="" id="back_btn">
                <i id="page-go-back" class="fa fa-arrow-left"></i>
            </a>
        </div>
        <div class="router-container-title title-x">
            <Strong> {{'glass order released to purchasing' | uppercase}}</Strong>
        </div>
        <div class="router-container-options">
            <button onclick="tableToExcel('GlassOrder', 'Glass Orders')" class="nafco-button nafco-btn-ok">
                <i class="fa fa-file-excel-o"></i>
                Export Excel
            </button>
            <a type="button" onclick="document.getElementById('new-glassorder').style.display='block';document.getElementById('glassorderno').focus();" class="nafco-button newbutton">
                <i class="fa fa-plus"></i>
                Add
            </a>
        </div>
    </div>
    <div class="route-container-content">
        <table class="project-list-table borderd">
            <thead>
                <tr>
                    <th style="width:220px">Glass Ord.No.</th>
                    <th style="width:50px"></th>
                    <th style="width:150px">DONE BY</th>
                    <th style="width:180px">RELEASED TO PURCH.</th>
                    <th style="width:180px">RECEIVED FROM PURCH.</th>
                    <th style="width:200px">Glass Order Status</th>
                    <th style="width:450px">SUPPLIER</th>
                    <th style="width:350px">GLASS TYPE</th>
                    <th style="width:780px">GLASS SPECIFICATION</th>
                    <th style="width:650px">MARKING LOCATION</th>
                    <th style="width:50px">QTY</th>
                    <th style="width:450px">REMARK</th>
                </tr>
                <tr>
                    <td>
                        <input type="text" ng-model="fil.glassorderno" class="nafco-inputs" placeholder="search...">
                    </td>
                    <td>

                    </td>
                    <td>
                        <input type="text" ng-model="fil.doneby" class="nafco-inputs" placeholder="search...">
                    </td>
                    <td>
                        <input type="text" ng-model="fil.releasedtopurchase" class="nafco-inputs" placeholder="search...">
                    </td>
                    <td>
                        <input type="text" ng-model="fil.recivedfrompurchas" class="nafco-inputs" placeholder="search...">
                    </td>
                    <td>
                        <select class="nafco-inputs" ng-model="fil.orderstatus" name="orderstatus" id="orderstatus" required>
                            <option value="">-Select-</option>
                            <option value="1">ORDERED</option>
                            <option value="2">PENDING</option>
                            <option value="3">HOLD</option>
                            <option value="4">CANCELLED</option>
                            <option value="5">SUPERSEDED</option>
                            <option value="6">Others</option>
                        </select>
                    </td>
                    <td>
                        <select ng-model="fil.supplier_id" class="nafco-inputs">
                            <option value="">-Select-</option>
                            <option ng-repeat="supplier in supplier_list" value="{{supplier.supplier_id}}">{{supplier.supplier_name}}</option>
                        </select>
                    </td>
                    <td>
                        <select ng-model="fil.glasstype" class="nafco-inputs">
                            <option value="">-Select-</option>
                            <option ng-repeat="gtype in glasstypes" value="{{gtype.glasstype_id}}">{{gtype.glasstype_name}}</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" ng-model="fil.glassdescription" class="nafco-inputs" placeholder="search...">
                    </td>
                    <td>
                        <input type="text" ng-model="fil.markinglocation" class="nafco-inputs" placeholder="search...">
                    </td>
                    <td>
                        <input type="text" ng-model="fil.QTY" class="nafco-inputs" placeholder="">
                    </td>
                    <td>
                        <input type="text" ng-model="fil.remarks" class="nafco-inputs" placeholder="search...">
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="x in glassorder | filter:fil">
                    <td style="text-align: center;font-size:12px;">
                        <button class="nafco-button nafco-btn-sm link link-btn" type="button" ng-click="edit_glassorder(x)" style="font-size:12px;">
                            <i class="fa fa-edit"></i>
                            {{x.glassorderno}}
                        </button>
                    </td>
                    <td>
                        <div ng-if="x.file=='1'" style="text-align:center;">
                            <a target="_blank" href="<?php echo $url_base ?>vfiles.php?page=glasssorder&folder={{x.glassorder_token}}" class="link">
                                <i class="fa fa-file-pdf-o"></i>
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
                        <div ng-if="x.orderstatus === '1'">ORDERED</div>
                        <div ng-if="x.orderstatus === '2'">PENDING</div>
                        <div ng-if="x.orderstatus === '3'">HOLD</div>
                        <div ng-if="x.orderstatus === '4'">CANCELLED</div>
                        <div ng-if="x.orderstatus === '5'">SUPERSEDED</div>
                        <div ng-if="x.orderstatus === '6'">Others</div>
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
                        <div style="display:inline-block" ng-repeat="e in x.items_list">
                            {{e.boqitems_itemid}},
                        </div>
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



<div style="display:none">
    <table class="project-list-table borderd" id="GlassOrder">
        <thead>
            <tr>
                <th style="width:220px">Glass Ord.No.</th>
                <th style="width:150px">DONE BY</th>
                <th style="width:220px">RELEASED TO PURCH.</th>
                <th style="width:220px">RECEIVED FROM PURCH.</th>
                <th style="width:220px">Glass Order Status</th>
                <th style="width:450px">SUPPLIER</th>
                <th style="width:450px">GLASS TYPE</th>
                <th style="width:780px">GLASS SPECIFICATION</th>
                <th style="width:450px">MARKING LOCATION</th>
                <th style="width:50px">QTY</th>
                <th style="width:450px">REMARK</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="x in glassorder | filter:fil">
                <td style="text-align: center;">
                    <button class="nafco-button nafco-btn-sm link link-btn" type="button" ng-click="edit_glassorder(x)">
                        <i class="fa fa-edit"></i>
                        {{x.glassorderno}}
                    </button>
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
                    <div ng-if="x.orderstatus === '1'">ORDERED</div>
                    <div ng-if="x.orderstatus === '2'">PENDING</div>
                    <div ng-if="x.orderstatus === '3'">HOLD</div>
                    <div ng-if="x.orderstatus === '4'">CANCELLED</div>
                    <div ng-if="x.orderstatus === '5'">SUPERSEDED</div>
                    <div ng-if="x.orderstatus === '6'">Others</div>

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
                    <div ng-repeat="e in x.items_list">
                        {{e.boqitems_itemid}}
                    </div>

                </td>
            </tr>
        </tbody>
    </table>
</div>
<style>
    .nafco-row {
        width: 80%;
        display: flex;
        flex-wrap: wrap;
    }

    .nafco-col-md-6 {
        padding-left: 25px;
        padding-bottom: 5px;
        width: 50%;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .nafco-col-md-12 {
        padding-left: 25px;
        padding-bottom: 5px;
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .nafco-label {

        width: 30%;
        font-size: 13px;
    }

    .nafco-semi {
        width: 4%;
    }

    .nafco-input {
        width: 66%;
    }

    .nafco-submitbutton {

        margin-top: 12px;
        width: 100%;
        text-align: right;
    }

    .nafco-submitbutton button {
        width: 120px;
        text-align: center;
    }

    .dialog-closebutton {
        background-color: #E93D08;
        color: #ffffff;
        border: none;
        margin-right: 5px;
        transition: all 0.5s;
    }

    .dialog-closebutton:hover {

        box-shadow: inset 1px 2px 14px #686564;
    }

    .nafco-modal-main {
        box-shadow: inset 0px 0px 10 5px #686564;
    }

    .link-btn {
        text-align: center;
        border: 1px solid #461090;
    }

    @media only screen and (max-width: 750px) {
        .nafco-col-md-6 {
            width: 100%;
            margin-bottom: 5px;
            flex-direction: column;

        }

        .nafco-label {
            width: 100%;
        }


        .nafco-semi {
            display: none;
        }

        .nafco-input {
            width: 100%;
        }

        .dialog-closebutton {
            background-color: #E93D08;
            color: #ffffff;
            border: none;
            margin-right: 5px;
        }


    }
</style>

<div class='nafco-modal' id="new-glassorder" style="display:none">
    <div class="nafco-modal-content-lg">
        <div class="nafco-modal-main">
            <div class="nafco-modal-head">
                <div class="model-head-close">

                    <i class="fa fa-times" onclick="document.getElementById('new-glassorder').style.display='none'"></i>
                </div>
                <div class="model-head-title">
                    Add New Glass Order
                </div>
            </div>
            <form enctype="multipart/form-data" name="save_new_glassorder" id="save_new_glassorder">
                <div class="nafco-modal-body">

                    <div class='nafco-row'>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Contract Number
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input type="text" class="nafco-inputs" ng-model="newglassorder.project_id" name="project_id" id="project_id" required readonly>
                            </div>
                        </div>

                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Glass Order NO.
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input type="text" class="nafco-inputs" ng-model="newglassorder.glassorderno" name="glassorderno" id="glassorderno" required ng-blur="getoldinfo()" ng-keyup="getinfoold($event)">
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Done By
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input type="text" class="nafco-inputs" ng-model="newglassorder.doneby" name="doneby" id="doneby" required>
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Release To Purch.
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input type="text" class="nafco-inputs" ng-model="newglassorder.releasedtopurchase" name="releasedtopurchase" id="releasedtopurchase" placeholder="dd-mm-yyyy" required>
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Recived From Purch.
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input type="text" class="nafco-inputs" ng-model="newglassorder.recivedfrompurchas" name="recivedfrompurchas" id="recivedfrompurchas" required placeholder="dd-mm-yyyy">
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Status
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <select class="nafco-inputs" ng-model="newglassorder.orderstatus" name="orderstatus" id="orderstatus" required>
                                    <option value="">-Select-</option>
                                    <option value="1">ORDERED</option>
                                    <option value="2">PENDING</option>
                                    <option value="3">HOLD</option>
                                    <option value="4">CANCELLED</option>
                                    <option value="5">SUPERSEDED</option>
                                    <option value="6">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Supplier
                                <button id="create_new_supplier" type="button" class="nafco-button nafco-btn-noborder nafco-btn-danger" onclick="document.getElementById('new-supplier').style.display='block';document.getElementById('new_supplier_name').focus();">
                                    <i class="fa fa-plus"></i>
                                    Add
                                </button>
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <select class="nafco-inputs" ng-model="newglassorder.supplier" name="supplier" id="supplier" required>
                                    <option value="">-select-</option>
                                    <option ng-repeat="supplier in supplier_list" value="{{supplier.supplier_id}}">{{supplier.supplier_name}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Glass Type
                                <button id="create_new_glasstype" type="button" class="nafco-button nafco-btn-noborder nafco-btn-danger" onclick="document.getElementById('new-glasstype').style.display='block';document.getElementById('glasstype_name').focus();">
                                    <i class="fa fa-plus"></i>
                                    Add
                                </button>
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <select class="nafco-inputs" ng-model="newglassorder.glasstype" name="glasstype" id="glasstype" required>
                                    <option value="">-select-</option>
                                    <option ng-repeat="gtype in glasstypes" value="{{gtype.glasstype_id}}">{{gtype.glasstype_name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Specification
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <textarea type="text" class="nafco-inputs" ng-model="newglassorder.glassdescription" name="glassdescription" id="glassdescription" required></textarea>
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Marking Location
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input type="text" class="nafco-inputs" ng-model="newglassorder.markinglocation" name="markinglocation" id="markinglocation" required>
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Qty
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input placeholder="numbers only" type="text" class="nafco-inputs" ng-model="newglassorder.QTY" name="QTY" id="QTY" required placeholder="dd-mm-yyyy">
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Remarks
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input type="text" class="nafco-inputs" ng-model="newglassorder.remarks" name="remarks" id="remarks" required="required">
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Upload (PDF File only)
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input type="file" class="nafco-inputs" name="pdffile[]" id="pdffile" multiple>
                            </div>
                        </div>
                        <div class="nafco-col-md-6">

                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                BOQ Item No.
                                <button id="insertboqitems" type="button" class="nafco-button nafco-btn-noborder nafco-btn-danger" ng-click="insert_boqitems()">
                                    <i class="fa fa-plus"></i>
                                    Add
                                </button>
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <select class="nafco-inputs" ng-model="newglassorder.boq_itemno" name="boq_itemno" id="boq_itemno">
                                    <option value="">-Select-</option>
                                    <option ng-repeat="boqs in measurements.boq" value="{{boqs.item_no}}">{{boqs.item_no}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="nafco-col-md-6">
                            <table class="project-list-table borderd">
                                <tbody>
                                    <tr ng-repeat="b in boqitemlist">
                                        <td>
                                            <input type="text" class="nafco-inputs" name="boq_itmes[]" id="remarks" required="required" readonly value="{{b}}">
                                        </td>
                                        <td>
                                            <button type="button" name="rmv_btn" ng-click="rmv($index)" class='nafco-button nafco-btn-danger'>
                                                <i class="fa fa-trash"></i>
                                                Remove
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="nafco-row">
                        <div class="nafco-submitbutton">
                            <button type="button" name="close-button" class="nafco-button dialog-closebutton" onclick="document.getElementById('new-glassorder').style.display='none'">Close</button>
                            <button type="button" name="close-buttons" class="nafco-button nafco-btn-danger" ng-click="removeNew_glassorder()">Clear All</button>
                            <button ng-disabled="save_new_glassorder.$invalid" type="submit" name="submit" class="nafco-button nafco-btn-ok">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




<div class='nafco-modal' id="edit-glassorder" style="display:none">
    <div class="nafco-modal-content-lg">
        <div class="nafco-modal-main">
            <div class="nafco-modal-head">
                <div class="model-head-close">

                    <i class="fa fa-times" onclick="document.getElementById('edit-glassorder').style.display='none'"></i>
                </div>
                <div class="model-head-title">
                    Edit Glass Order
                </div>
            </div>
            <form enctype="multipart/form-data" name="edit_new_glassorder" id="edit_new_glassorder">
                <div class="nafco-modal-body">

                    <div class='nafco-row'>
                        <div class="hiddenbox">
                            <div class="nafco-label ">
                                Order Token
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input type="text" class="nafco-inputs" ng-model="edit_glassorders.glassorder_token" name="glassorder_token" id="glassorder_token" required readonly>
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Contract Number
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input type="text" class="nafco-inputs" ng-model="edit_glassorders.project_id" name="project_id" id="project_id" required readonly>
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                BOQ Item No.
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <select class="nafco-inputs" ng-model="edit_glassorders.boq_itemno" name="boq_itemno" id="boq_itemno">
                                    <option value="">-Select-</option>
                                    <option ng-repeat="boqs in measurements.boq" value="{{boqs.item_no}}">{{boqs.item_no}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Glass Order NO.
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input type="text" class="nafco-inputs" ng-model="edit_glassorders.glassorderno" name="glassorderno" id="glassorderno" required>
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Done By
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input type="text" class="nafco-inputs" ng-model="edit_glassorders.doneby" name="doneby" id="doneby" required>
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Release To Purch.
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input type="text" class="nafco-inputs" ng-model="edit_glassorders.releasedtopurchase" name="releasedtopurchase" id="releasedtopurchase" placeholder="dd-mm-yyyy" required>
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Recived From Purch.
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input type="text" class="nafco-inputs" ng-model="edit_glassorders.recivedfrompurchas" name="recivedfrompurchas" id="recivedfrompurchas" required placeholder="dd-mm-yyyy">
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Status
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <select class="nafco-inputs" ng-model="edit_glassorders.orderstatus" name="orderstatus" id="orderstatus" required>
                                    <option value="">-Select-</option>
                                    <option value="1">ORDERED</option>
                                    <option value="2">PENDING</option>
                                    <option value="3">HOLD</option>
                                    <option value="4">CANCELLED</option>
                                    <option value="5">SUPERSEDED</option>
                                    <option value="6">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Supplier
                                <button id="create_new_supplier" type="button" class="nafco-button nafco-btn-noborder nafco-btn-danger" onclick="document.getElementById('new-supplier').style.display='block';document.getElementById('new_supplier_name').focus();">
                                    <i class="fa fa-plus"></i>
                                    Add
                                </button>
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <select class="nafco-inputs" ng-model="edit_glassorders.supplier" name="supplier" id="supplier" required>
                                    <option value="">-select-</option>
                                    <option ng-repeat="supplier in supplier_list" value="{{supplier.supplier_id}}">{{supplier.supplier_name}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Glass Type
                                <button id="create_new_glasstype" type="button" class="nafco-button nafco-btn-noborder nafco-btn-danger" onclick="document.getElementById('new-glasstype').style.display='block';document.getElementById('glasstype_name').focus();">
                                    <i class="fa fa-plus"></i>
                                    Add
                                </button>
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <select class="nafco-inputs" ng-model="edit_glassorders.glasstype" name="glasstype" id="glasstype" required>
                                    <option value="">-select-</option>
                                    <option ng-repeat="gtype in glasstypes" value="{{gtype.glasstype_id}}">{{gtype.glasstype_name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Specification
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <textarea type="text" class="nafco-inputs" ng-model="edit_glassorders.glassdescription" name="glassdescription" id="glassdescription" required></textarea>
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Marking Location
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input type="text" class="nafco-inputs" ng-model="edit_glassorders.markinglocation" name="markinglocation" id="markinglocation" required>
                            </div>
                        </div>
                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Qty
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input placeholder="numbers only" type="text" class="nafco-inputs" ng-model="edit_glassorders.QTY" name="QTY" id="QTY" required placeholder="dd-mm-yyyy">
                            </div>
                        </div>

                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Remarks
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input type="text" class="nafco-inputs" ng-model="edit_glassorders.remarks" name="remarks" id="remarks" required="required">
                            </div>
                        </div>

                        <div class="nafco-col-md-6">
                            <div class="nafco-label">
                                Upload (PDF File only)
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input type="file" class="nafco-inputs" name="pdffile[]" id="pdffile" multiple>
                            </div>
                        </div>

                        <div class="nafco-col-md-6">

                        </div>
                    </div>
                    <div class="nafco-row">
                        <div class="nafco-submitbutton">
                            <button type="button" name="close-button" class="nafco-button dialog-closebutton" onclick="document.getElementById('edit-glassorder').style.display='none'">Close</button>
                            <button ng-click="removeglassorder(edit_glassorders.glassorder_token,edit_glassorders.project_id)" type="button" name="remove-button" class="nafco-button nafco-btn-danger">
                                <i class="fa fa-trash"></i>
                                Remove
                            </button>
                            <button ng-disabled="edit_new_glassorder.$invalid" type="submit" name="submit" class="nafco-button nafco-btn-ok">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class='nafco-modal' id="new-supplier">
    <div class="nafco-modal-content-sm">
        <div class="nafco-modal-main">
            <div class="nafco-modal-head">
                <div class="model-head-close">
                    <i class="fa fa-times " onclick="document.getElementById('new-supplier').style.display='none'"></i>
                </div>
                <div class="model-head-title">
                    Add New Supplier
                </div>
            </div>
            <form name="save_new_supplier" ng-submit="supplier_new_save()">
                <div class="nafco-modal-body">
                    <div class='nafco-row'>
                        <div class="nafco-col-md-12">
                            <div class="nafco-label">
                                Supplier Name
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input type="text" class="nafco-inputs" ng-model="new_supplier_name" name="new_supplier_name" id="new_supplier_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="nafco-row">
                        <div class="nafco-submitbutton">
                            <button type="button" name="close-button" class="nafco-button dialog-closebutton" onclick="document.getElementById('new-supplier').style.display='none'">Close</button>
                            <button ng-disabled="save_new_supplier.$invalid" type="submit" name="submit" class="nafco-button nafco-btn-ok">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class='nafco-modal' id="new-glasstype">
    <div class="nafco-modal-content-sm">
        <div class="nafco-modal-main">
            <div class="nafco-modal-head">
                <div class="model-head-close">
                    <i class="fa fa-times " onclick="document.getElementById('new-glasstype').style.display='none'"></i>
                </div>
                <div class="model-head-title">
                    Add New Glass Type
                </div>
            </div>
            <form name="save_new_glasstype" ng-submit="gasstype_new_save()">
                <div class="nafco-modal-body">
                    <div class='nafco-row'>
                        <div class="nafco-col-md-12">
                            <div class="nafco-label">
                                Glass Type
                            </div>
                            <div class="nafco-semi">
                                :
                            </div>
                            <div class="nafco-input">
                                <input type="text" class="nafco-inputs" ng-model="glasstype_name" name="glasstype_name" id="glasstype_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="nafco-row">
                        <div class="nafco-submitbutton">
                            <button type="button" name="close-button" class="nafco-button dialog-closebutton" onclick="document.getElementById('new-glasstype').style.display='none'">Close</button>
                            <button ng-disabled="save_new_glasstype.$invalid" type="submit" name="submit" class="nafco-button nafco-btn-ok">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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