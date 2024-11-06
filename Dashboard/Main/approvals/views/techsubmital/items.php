<div class="ism-pms-dialog" id="dia_items">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Add Items
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_items').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>

        <div class="ism-pms-dialog-body">
            <div class="ism-pms-dialog-body-rows" style="width: 340px">
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 400px;">
                    <div class="ism-dialog-body-rows-input-container-lable">Item Name</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="mainitem" id="mainitem" ng-model="mainitem.mainitem" class="ism-dialog-rows-input-controller" required ng-keyup="additemmainlist($event)" />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 400px;">
                    <table class="old_table itemlist">
                        <thead>
                            <tr>
                                <th></th>
                                <th>S.No#</th>
                                <th style="width:300px">Item</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="x in mainitemlist  track by $index">
                                <td>
                                    <i style="color:red;" class="fa fa-trash" ng-click="removemainitem($index)"></i>
                                </td>
                                <td>{{$index+1}}</td>
                                <td style="width:300px">{{x.mainitem}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="ism-pms-dialog-footer">
            <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-disabled="mainitem.mainitem === undefined || mainitem.mainitem === ''" ng-click="additeminmainlist()">
                <i class="fa fa-times"></i>
                Add & Close
            </button>

            <button type="submit" ng-disabled="mainitem.mainitem === undefined || mainitem.mainitem === ''" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-click="addnewcategory()">
                <i class="fa fa-plus"></i>
                Add Category
            </button>
        </div>
    </div>
</div>

<div class="ism-pms-dialog" id="dia_category">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Add Category
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_category').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>

        <div class="ism-pms-dialog-body">

            <div class="ism-pms-dialog-body-group-title">
                <i class="fa fa-info-circle active"></i>
                <span>
                    Add Category for
                    <strong>
                        {{itemname}}
                    </strong>
                </span>
            </div>

            <div class="ism-pms-dialog-body-rows" style="width: 340px">
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 400px;">
                    <div class="ism-dialog-body-rows-input-container-lable">Category Name</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="categoryname" id="categoryname" ng-model="category.categoryname" class="ism-dialog-rows-input-controller" required ng-keydown="addtoitemlist_keydown($event)" />
                    </div>
                </div>

                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 400px;">
                    <table class="old_table itemlist">
                        <thead>
                            <tr>
                                <th></th>
                                <th>S.No#</th>
                                <th style="width:300px">Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="x in mainitem.categorylist  track by $index">
                                <td>
                                    <i style="color:red;" class="fa fa-trash" ng-click="removesubitems($index)"></i>
                                </td>
                                <td>{{$index+1}}</td>
                                <td style="width:300px">{{x.categoryname}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="ism-pms-dialog-footer">
            <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-disabled="category.categoryname === undefined || category.categoryname === ''" ng-click="addtoitemlist()">
                <i class="fa fa-times"></i>
                Add & Close
            </button>

            <button type="submit" ng-disabled="category.categoryname === undefined || category.categoryname === ''" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-click="additemsubcategory()">
                <i class="fa fa-plus"></i>
                Add Sub Category
            </button>
        </div>
    </div>
</div>


<div class="ism-pms-dialog" id="dia_subcategory">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Add Sub Category
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_subcategory').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>

        <div class="ism-pms-dialog-body">
            <div class="ism-pms-dialog-body-group-title">
                <i class="fa fa-info-circle active"></i>
                <span>
                    Add Category for
                    <strong>
                        {{categoryname}}
                    </strong>
                </span>
            </div>
            <div class="ism-pms-dialog-body-rows" style="width: 340px">
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 400px;">
                    <div class="ism-dialog-body-rows-input-container-lable">Sub Category Name</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="subcategoryname" id="subcategoryname" ng-model="subcategory.subcategoryname" class="ism-dialog-rows-input-controller" required ng-keydown="addtosubcategory($event)" />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 400px;">
                    <table class="old_table itemlist">
                        <thead>
                            <tr>
                                <th></th>
                                <th>S.No#</th>
                                <th style="width:300px">Sub Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="x in subitemsubsystemlist  track by $index">
                                <td>
                                    <i style="color:red;" class="fa fa-trash" ng-click="removesubitem($index)"></i>
                                </td>
                                <td>{{$index+1}}</td>
                                <td style="width:300px">{{x.name}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="ism-pms-dialog-footer">
            <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-disabled="subitemsubsystemlist.length === 0" ng-click="addtocategoylist()">
                <i class="fa fa-check"></i>
                Add & Close
            </button>
        </div>
    </div>
</div>