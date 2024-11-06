import mrnctrl from "./controllers/mrn.js"
app.controller('mrnctrl', mrnctrl);

import mrctrl from './controllers/index.js';
app.controller('mrctrl', mrctrl);



import mrrpt from "./controllers/mrrpt.js";
app.controller("mrrpt", mrrpt)

import mrp from "./controllers/indexp.js";
app.controller('mrp', mrp)

import mrpn from "./controllers/mrpn.js"; 
app.controller('mrpn',mrpn)

app.directive('bomitemList', () => {
    return {
        restrict: "E",
        templateUrl : 'mr/js/controllers/html/index.html'
    }
})