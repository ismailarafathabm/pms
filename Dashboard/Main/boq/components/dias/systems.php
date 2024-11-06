<div class="autocompleate-dia" style="width: 595px;">
    <div class="autocompleate-container" style="display: flex;gap: 10px;">
        <input ng-hide="isloading" class="ism-metro-inputs" type="text" ng-model="src_boqsystem_type" id="src_boqsystem_type" placeholder="search..." style="width: 90%;"/>
        <button ng-hide="isloading" type="button" ng-click="show_systemtypeadd()" class="ism-btns btn-normal" style="padding:2px;border-radius:2px;width:10%">
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
                    <th>System</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="x in systemtypes | filter : src_boqsystem_type">
                    <td>
                        <div style="display: flex;gap:2px">
                            <button ng-hide="isloading" type="button" type="button" class="ism-btns btn-normal" style="padding:2px;border-radius:2px" ng-click="edit_system_type(x)">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button ng-hide="isloading" type="button" type="button" class="ism-btns btn-delete" style="padding:2px;border-radius:2px" ng-click="remove_system_type(x.system_type_id)">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                    <td>{{$index+1}}</td>
                    <td>{{x.system_type_name}}</td>
                    <td>
                        <div style="display: flex;gap:2px">
                            <button ng-hide="isloading" type="button" class="ism-btns btn-normal" ng-click="select_system_type(x)" style="padding:2px;border-radius:2px">
                                <i class="fa fa-check"></i> Select
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>