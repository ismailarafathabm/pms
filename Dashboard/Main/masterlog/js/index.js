import masterlogunits from './units.js';
import masterlogsystems from './systems.js';
import mtbl_controller from './mtbl/index.js';
import Trades_controller from './trades.js';
import mtbl_backlog_controller from './mtbl/backlog.js';


app.controller("masterlogunits", masterlogunits);
app.controller("masterlogsystems", masterlogsystems)
app.controller("mtbl_controller", mtbl_controller);
app.controller('masterlogtrades', Trades_controller)
app.controller('mtbl_backlog_controller',mtbl_backlog_controller)

//directive

app.directive('projectList', projectfilters)
app.directive('unitList', unitlistfilters);
app.directive('itemList', itemlistfilters);

function projectfilters() {
    return {
        restrict: 'E',
        templateUrl: 'masterlog/js/pjlist.html'
    }
}

function unitlistfilters() {
    return { 
        restrict: 'E',
        templateUrl : 'masterlog/js/units.html'
    }
}

function itemlistfilters() {
    return { 
        restrict: 'E',
        templateUrl : 'masterlog/js/itemlist.html'
    }
}