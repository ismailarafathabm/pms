import ctproductionentry from "./controllers/index.js";
app.controller('ctproductionentry', ctproductionentry);

import ctproductionentrynew from './controllers/receive.js'
app.controller('ctproductionentrynew', ctproductionentrynew);

import ctproduction from "./controllers/production.js";
app.controller('ctproduction', ctproduction)

import ctrelease from "./controllers/release.js";
app.controller('ctrelease', ctrelease)

import ctreleasehistory from "./controllers/ctreleasehistory.js";
app.controller('ctreleasehistory',ctreleasehistory)