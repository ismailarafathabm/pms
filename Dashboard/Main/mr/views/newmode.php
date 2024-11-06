<tr ng-repeat="x in materiallist track by $index" ng-if="mode === 'E'">
    <td>{{$index+1}}</td>
    <td>
        {{x.mritem}}
    </td>
    <td>
        {{x.mrpartno}}
    </td>
    <td>
        {{x.mrpartnotai}}
    </td>
    <td>
        {{x.mrdieweight}}
    </td>
    <td>
        {{x.mrreqlength}}
    </td>
    <td>
        {{x.mrreqqty}}
    </td>
    <td>
        {{x.mrunit}}
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
        {{x.mravaiqty}}
    </td>
    <td>{{(+x.mraviweight).toLocaleString(undefined,{maximumFractionDigits:2})}}</td>
    <td>{{x.mrorderedqty}}</td>
    <td>{{(+x.mrorderedweight).toLocaleString(undefined,{maximumFractionDigits:2})}}</td>
    <td>
        {{x.mrfinish}}
    </td>
    <td>
        {{x.mrremarks}}
    </td>
    <td ng-if="mode === 'N'">
        <button class="ism-pms-dialog-btn  ism-btn-dialog-dagner" type="button" ng-click="removeitems($index)">
            <i class="fa fa-times"></i>
        </button>
    </td>
    <td ng-if="mode === 'E'">
        <?php
        if ($canedit) {
        ?>
            <div style="display: flex;gap:2px;align-items: center;">

                <button ng-if="x.mrflags !== 'P'" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" type="button" ng-click="deleteitems(x.mrid,x.mrproject,x.mrcode,x.mrno)">
                    <i class="fa fa-trash"></i>
                </button>
                <button ng-if="x.mrflags !== 'P'" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" type="button" ng-click="edititem(x)">
                    <i class="fa fa-edit"></i>
                </button>
            </div>
        <?php } ?>
    </td>


</tr>