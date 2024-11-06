<button class="grupby" onclick="showhiddenlist()">Group By <i class="fa fa-angle-down"></i></button>
<div class="hidden-list" id="dropdownlist">    
    <div class="groupbylist" ng-click="groupbynone()"> Un Gruop </div>                 
    <div ng-repeat="x in groupingitems" class="groupbylist" ng-click="gropuby(x.field_name,x.disp_name)"> {{x.disp_name}} </div>                 
</div>