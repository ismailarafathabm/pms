import homepage from './controllers/index.js'
import MaterialToBeLoadSummary from './controllers/materialloadsummary.js';
import mtblbacklog from './controllers/mtblbacklog.js'
import goprint from './controllers/goprint.js' 
import mprint from './controllers/mprint.js';
import poprint from './controllers/poprint.js';
import pobprint from './controllers/pobprint.js';
import ponewprint from './controllers/ponew.js';
import budgetsummary from './controllers/budgetsummary.js';
import budgetmaterial from './controllers/budgetmaterial.js';
import budgetglass from './controllers/budgetglass.js';
import poadvices from './controllers/poadvice.js'

app.controller("homepage", homepage);
app.controller("MaterialToBeLoadSummary", MaterialToBeLoadSummary);
app.controller("mtblbacklog", mtblbacklog);
app.controller("goprint", goprint);
app.controller('mprint', mprint);
app.controller('poprint', poprint);
app.controller('pobprint', pobprint);
app.controller('ponewprint', ponewprint);
app.controller('budgetsummary', budgetsummary);
app.controller('budgetmaterial',budgetmaterial);
app.controller('budgetglass', budgetglass);
app.controller("poadvices", poadvices);

import projectbudget_n from './controllers/projectbudget_n.js';
app.controller('projectbudget_n', projectbudget_n);

import ams_lp from './controllers/ams_lp.js';
app.controller('ams_lp', ams_lp);

import projectbudgetsummary from './controllers/projectbudgetsummary.js';
app.controller('projectbudgetsummary', projectbudgetsummary);

import projectbudget from './controllers/projectbudget.js';
app.controller("projectbudget", projectbudget);

import projectporpt from './controllers/projectporpt.js';
app.controller('projectporpt', projectporpt);

import * as ams from './controllers/ams/index.js';
app.controller('ams_project_summary', ams.ams_project_summary)
app.controller('ams_project_downpayment', ams.ams_project_downpayment)
app.controller('ams_project_workdone', ams.ams_project_workdone);