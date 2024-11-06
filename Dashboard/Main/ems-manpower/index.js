import emsManpower from "./controllers/manpower.js";
app.controller('emsmanpower', emsManpower);

import costWisemanpower from "./controllers/costwise.js";
app.controller('costwisemanpower', costWisemanpower);

import manpowerDtview from "./controllers/dtview.js";
app.controller('manpowerdtview', manpowerDtview);

import manpowerAttenPresent from "./controllers/attenpresent.js";
app.controller('manpowerattenpresent', manpowerAttenPresent);

import manpowerAttenAbsent from "./controllers/attenabsent.js";
app.controller('manpowerattenabsent', manpowerAttenAbsent);

import manpowerAttenRental from "./controllers/attenrental.js";
app.controller('manpowerattenrental', manpowerAttenRental);

import manpowerAttenSubcontract from './controllers/attensubcontract.js';
app.controller('manpowerattensubcontract',manpowerAttenSubcontract)