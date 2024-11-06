import gorptcontroller from './controllers/index.js';
import goglassdescription from './controllers/glist.js';
import goglasssuppliers from './controllers/suppliers.js';
import goglassbudget from './controllers/goglassbudget.js';
import engglassorder from './controllers/enggo.js';
import budgetglass from './controllers/budgetglass.js';
import purchaseglass from './controllers/purchaseglass.js';
import budgetmaterials from './controllers/budgetmaterials.js'
import purchasematerial from './controllers/purchasematerial.js';
import ponew from './controllers/ponew.js';
import vpo from './controllers/po.js';
import pobnew from './controllers/pobnew.js';
import pob from './controllers/pob.js';
import projectbudget from './controllers/projectbudget.js';

import pon_ctrl from './controllers/pon_ctrl.js';
import ponv_ctrl from './controllers/ponv_ctrl.js';
app.controller("gorptcontroller", gorptcontroller);
app.controller("goglassdescription", goglassdescription);
app.controller("goglasssuppliers", goglasssuppliers);
app.controller("goglassbudget", goglassbudget);  
app.controller('goengglassorder', engglassorder);
app.controller('budgetglass', budgetglass);
app.controller('purchaseglass', purchaseglass);
app.controller('budgetmaterials', budgetmaterials);
app.controller('purchasematerial', purchasematerial);
app.controller('ponew', ponew);
app.controller('vpo', vpo);
app.controller('pobnew', pobnew);
app.controller('pob', pob);
app.controller('projectbudget', projectbudget);


app.controller('pon_ctrl', pon_ctrl);
app.controller('ponv_ctrl', ponv_ctrl);

app.directive('projectListnew', projectlistnew);
app.directive('suppliersListnew', supplierslistnew);
app.directive('glassListnew', glasslistnew);


import ponadvice from './controllers/ponadvice.js';
app.controller('po_nadvice', ponadvice)
import poadvicelist from './controllers/ponadivcelist.js';
app.controller('po_advice', poadvicelist)


import summary_budget from './controllers/summary_budget.js';
app.controller('summary_budget', summary_budget);

import rpt_po from './controllers/rpt_po.js';
app.controller('rpt_po', rpt_po);

import poallsummary from './controllers/poallsummary.js';
app.controller('poallsummary', poallsummary);

import posummarysuppliers from './controllers/rpt_supplier_posummary.js';
app.controller('posummarysuppliers', posummarysuppliers);

import  project_budget  from './controllers/project_budget.js';
app.controller('project_budget', project_budget);

//gon
import gon_ctrl from './controllers/gon.js';
app.controller('gon_ctrl', gon_ctrl);
import gon_new from './controllers/gonnew.js'
app.controller('gon_new',gon_new)

//gon

//gonp
import gonp from './controllers/gonp.js';
app.controller('gonp', gonp);
import gonpnew from './controllers/gonpnew.js';
app.controller('gonpnew', gonpnew);
//gonp


function projectlistnew() {
    return {
        restrict: 'E',
        templateUrl : 'glassorders/js/autofills/project.html',
    }
}

function supplierslistnew() {
    return {
        restrict: 'E',
        templateUrl : 'glassorders/js/autofills/supplierlist.html'
    }
}

function glasslistnew() {
    return {
        restrict: 'E',
        templateUrl : 'glassorders/js/autofills/glasslist.html'
    }
}