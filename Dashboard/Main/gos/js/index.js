// add new glass order 
import GoEnggnew from "./controllers/new.js";
app.controller('goengnew', GoEnggnew)
// glass order full report
import goeng from "./controllers/index.js";
app.controller('goeng', goeng)

//go new inside project
import gonewengp from './controllers/newp.js';
app.controller('gonewengp', gonewengp);

//go view for Data entry persion
import goviewp from "./controllers/indexp.js";
app.controller('goviewp', goviewp);


import goeditp from './controllers/editp.js';
app.controller('goeditp', goeditp);

import goedit from './controllers/edit.js';
app.controller('goedit', goedit);


import goengusers from "./controllers/indexuser.js";
app.controller('goengusers', goengusers);

import goviewusersp from "./controllers/indexuserp.js";
app.controller('goviewusersp', goviewusersp);

import goprocurement from './controllers/goprocurement.js';
app.controller('goprocurement', goprocurement);

import goprocurementview from './controllers/goprocurementview.js';
app.controller('goprocurementview', goprocurementview);

import goreceiptview from "./controllers/goreceiptview.js";
app.controller('goreceiptview', goreceiptview);
