<tr ng-repeat="x in materiallist track by $index" ng-if="mode === 'N'">
    <td>{{$index+1}}</td>
    <td>
        <textarea rows='3' ng-model="x.mritem" id="materiallist_items_{{$index+1}}" class="old_page_inputs" />
        </textarea>
    </td>
    <td>
        <input type="text" ng-model="x.mrpartno" id="materiallist_partno_{{$index+1}}" class="old_page_inputs" />
    </td>
    <td>
        <input type="text" ng-model="x.mrpartnotai" id="materiallist_mrpartnotai_{{$index+1}}" class="old_page_inputs" />
    </td>
    <td>
        <input type="text" ng-model="x.mrdieweight" id="materiallist_mrdieweight_{{$index+1}}" class="old_page_inputs" ng-change="calcgridChnage($event,$index)" />
    </td>
    <td>
        <input type="text" ng-model="x.mrreqlength" id="materiallist_mrreqlength_{{$index+1}}" class="old_page_inputs" ng-change="calcgridChnage($event,$index)" />
    </td>
    <td>
        <input type="text" ng-model="x.mrreqqty" id="materiallist_mrreqqty_{{$index+1}}" class="old_page_inputs" ng-change="calcgridChnage($event,$index)" />
    </td>
    <td>
        <input type="text" ng-model="x.mrunit" id="materiallist_mrunit_{{$index+1}}" class="old_page_inputs" ng-change="calcgridChnage($event,$index)" />
    </td>
    <td>{{(+x.mrreqtotweight).toLocaleString(undefined,{maximumFractionDigits:2})}}</td>
    <td>
        <div style="display:flex;align-items:center;gap:5px">
            <div>{{x.poq_item_no === false ? '' : x.poq_item_no}} </div>
            <i class="fa fa-info" ng-hide="!x.mrboqno || x.mrboqno === '' || x.mrboqno.toString() === '0'" ng-click="getboqinfo(x.mrboqno)"></i>
        </div>
    </td>
    <td ng-show="mode === 'N'"> {{x.boqiteminfo === false ? '' : x.boqiteminfo}}</td>
    <td ng-show="mode === 'E'"> {{x.ptype_name === false ? '' : x.ptype_name}}</td>
    <td>
        <input type="text" ng-model="x.mravaiqty" id="materiallist_mravaiqty_{{$index+1}}" class="old_page_inputs" ng-change="calcgridChnage($event,$index)" />
    </td>
    <td>{{(+x.mraviweight).toLocaleString(undefined,{maximumFractionDigits:2})}}</td>
    <td>{{x.mrorderedqty}}</td>
    <td>{{(+x.mrorderedweight).toLocaleString(undefined,{maximumFractionDigits:2})}}</td>
    <td>
        <input type="text" ng-model="x.mrfinish" id="materiallist_mrfinish_{{$index+1}}" class="old_page_inputs" />
    </td>
    <td>
        <input type="text" ng-model="x.mrremarks" id="materiallist_mrremarks_{{$index+1}}" class="old_page_inputs" />
    </td>
    <td ng-if="mode === 'N'">
        <button class="ism-pms-dialog-btn  ism-btn-dialog-dagner" type="button" ng-click="removeitems($index)">
            <i class="fa fa-times"></i>
        </button>
    </td>
    <td ng-if="mode === 'E'" >
        <button ng-if="mrinpust.mrflags !== 'P'" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" type="button" ng-click="deleteitems(x.mrid,x.mrproject,x.mrcode,x.mrno)">
            <i class="fa fa-trash"></i>
        </button>
    </td>
</tr>