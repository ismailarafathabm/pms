<div class="autocompleate-dia" style="width: 595px;">
    <div class="autocompleate-container" style="display: flex;gap: 10px;">
        <input ng-hide="isloading" class="ism-metro-inputs" type="text" ng-model="src_boqitem_type" id="src_boqitem_type" placeholder="search..." style="width: 90%;"/>
        <button ng-hide="isloading" type="button" ng-click="addnewitemtype()" class="ism-btns btn-normal" style="padding:2px;border-radius:2px;width:10%">
            <i class="fa fa-plus"></i>
            Add
        </button>
    </div>
    <div class="autocompleate-loads">
        <table class="autocompleate-table">
            <thead>
                <tr>
                    <th>Options</th>
                    <th>S.NO</th>
                    <th>Item Type</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="x in itemtypes | filter : src_boqitem_type">
                    <td>
                        <div style="display: flex;gap:2px">
                            <button ng-hide="isloading" type="button" type="button" class="ism-btns btn-normal" style="padding:2px;border-radius:2px" ng-click="edit_boqitem_type(x)">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button ng-hide="isloading" type="button" type="button" class="ism-btns btn-delete" style="padding:2px;border-radius:2px" ng-click="remove_boqitem_type(x.ptype_id)">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                    <td>{{$index+1}}</td>
                    <td>{{x.ptype_name}}</td>
                    <td>
                        <div style="display: flex;gap:2px">
                            <button ng-hide="isloading" type="button" class="ism-btns btn-normal" ng-click="select_item_type(x)" style="padding:2px;border-radius:2px">
                                <i class="fa fa-check"></i> Select
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>