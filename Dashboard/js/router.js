app.config(function ($routeProvider) {
    $routeProvider
        .when("/projects", {
            templateUrl: "project/components/index.php",
            controller: "projectctrl"
        })
        .when("/projects/:mode", {
            templateUrl: "project/components/index.php",
            controller: "projectctrl"
        })
        .when("/projectlistnew", {
            templateUrl: "Operations/index.php",
            controller: "dashboardcontroller"
        })
        .when("/projectlist", {
            templateUrl: "project/components/index.php",
            controller: "projectctrl"
        })
        .when("/projectlistv", {
            templateUrl: "Operations/indexv.php",
            controller: "dashboardcontrollernewv"
        })

        .when("/home", {
            templateUrl: "Operations/index.php",
            controller: "dashboardcontroller"
        })
        .when("/newtlist", {
            templateUrl: "Home/New.php",
            controller: "newprojectctrl"
        })
        .when("/viewproject", {
            templateUrl: "Operations/projectinfo/viewproject.php",
            controller: "viewproject"
        })
        .when("/spec", {
            templateUrl: "Operations/projectinfo/spec.php",
            controller: "spec"
        })
        .when("/tandc", {
            templateUrl: "Operations/projectinfo/tandc.php",
            controller: "tandc"
        })
        .when("/conditions", {
            templateUrl: "Operations/projectinfo/conditions.php",
            controller: "conditions"
        })
        .when("/boq", {
            templateUrl: "Operations/boq/boq.php",
            controller: "boq"
        })
        .when("/addboq", {
            templateUrl: "Operations/boq/aboq.php",
            controller: "addboq"
        })
        .when("/viewboq/:itemno", {
            templateUrl: "Operations/boq/boqEdit.php",
            controller: "viewboq"
        })
        .when("/approval", {
            templateUrl: "Operations/technical/approvals.php",
            controller: "approval"
        })
        .when("/approval/:token", {
            templateUrl: "Operations/technical/approvalsview.php",
            controller: "approvalview"
        })
        .when("/approvaledit/:token", {
            templateUrl: "Operations/technical/approvaledit.php",
            controller: "approvalsedit"
        })
        .when("/techapproval/:aptype", {
            templateUrl: "Operations/technical/Projects/info/approvaltech.php",
            controller: "techapprovalfi"
        })
        .when("/approvalsupersheet/:token", {
            templateUrl: "Operations/technical/approvals_suppersheet.php",
            controller: "approvalsupersheet"
        })
        .when("/asupersheets", {
            templateUrl: "Operations/technical/approvalsSupersheet.php",
            controller: "asupersheetindex"
        })
        .when("/newapprovals", {
            templateUrl: "Operations/technical/approvaladd.php",
            controller: "newapprovals"
        })
        .when("/commingsoon", {
            templateUrl: "Home/commingsoone.php",
        })
        .when("/newspec", {
            templateUrl: "Operation/projectinfo/specadd.php",
            controller: "newspec"
        })
        .when('/techdraw', {
            templateUrl: "Operations/drawing/index.php",
            controller: 'drawing_approvals_index'
        })
        .when('/techdrawnew', {
            templateUrl: "Operations/drawing/new.php",
            controller: 'drawing_approvals_addnew'
        })
        .when('/measurement', {
            templateUrl: "Projects/info/measurement/index.php",
            controller: 'measurement'

        })
        .when('/cuttinglist', {
            templateUrl: "Engg/cuttinglist/index.php",
            controller: 'cuttinglist'

        })

        .when('/variations', {
            templateUrl: "costing/variations/index.php",
            controller: 'ctrl_veriation'
        })
        .when('/varinew', {
            templateUrl: "costing/variations/variations/index.php",
            controller: 'ctrl_newvariations'
        })
        .when('/varinewaccept', {
            templateUrl: "costing/variations/variations/index_accept.php",
            controller: 'ctrl_newvariations_accept'
        })
        .when('/varinewcancel', {
            templateUrl: "costing/variations/variations/index_cancell.php",
            controller: 'ctrl_newvariations_cancell'
        })
        .when('/rpt_variations_pending', {
            templateUrl: "costing/variations/variations/rpt/index.php",
            controller: 'rpt_variations_pending'
        })
        .when('/rpt_variations_approve', {
            templateUrl: "costing/variations/variations/rpt/approve.php",
            controller: 'rpt_variations_approve'
        })
        .when('/rpt_variations_cancel', {
            templateUrl: "costing/variations/variations/rpt/cancel.php",
            controller: 'rpt_variations_cancel'
        })
        .when('/rpt_variations_all', {
            templateUrl: "costing/variations/variations/rpt/all.php",
            controller: 'rpt_variations_all'
        })
        // .when('/shopdrawingApprovalsrpt', {
        //     templateUrl: "management/shopdrawing2.php",
        //     controller: 'ctrl_drawingapprovals1'
        // })
        .when('/shopdrawingApprovalsrptx', {
            templateUrl: "management/shopdrawing2x.php",
            controller: 'ctrl_drawingapprovals1x'
        })
        .when('/shopdrawingApprovalsrpt2', {
            templateUrl: "management/shopdrawing2.php",
            controller: 'ctrl_drawingapprovals1'
        })
        .when('/variationrptNew', {
            templateUrl: "management/variationsrpt2.php",
            controller: 'ctrl_variationsrpt'
        })
        .when('/variationrpt', {
            templateUrl: "management/variationrpt2.php",
            controller: 'ctrl_variationsrptNew'
        })
        .when('/cuttinglistrpt', {
            templateUrl: "management/cuttinglistrpt2.php",
            controller: 'ctrl_cuttinglistrpt'
        })
        .when('/glassorders', {
            templateUrl: "management/glassorderrpt2.php",
            controller: 'ctrl_glassordersrpt'
        })
        .when('/rptdrawingapprovals', {
            templateUrl: "management/rptdrawings.php",
            controller: 'ctrl_rptdrawings'
        })
        .when('/rptcuttinglists', {
            templateUrl: "management/rptcuttinglistnew.php",
            controller: 'ctrl_rptcuttinglist'
        })
        .when('/shopdrawingApprovalsrpt', {
            templateUrl: "management/new/drawingapprovals.php",
            controller: 'ctrl_shopdrawingApprovalsrpt'
        })
        .when('/techapprovalsrpt', {
            templateUrl: "management/new/techapprovals.php",
            controller: 'ctrl_techApprovalsrpt'
        })
        .when('/engcuttinglist', {
            templateUrl: "management/new/cuttinglistrpt.php",
            controller: 'ctrl_engcuttinglist'
        })
        .when('/engglassorders', {
            templateUrl: "management/new/glassorderrpt.php",
            controller: 'ctrl_engglassorders'
        })
        .when('/estvariation', {
            templateUrl: "management/new/variationrpt.php",
            controller: 'ctrl_estvariation'
        })
        //manpowers
        //new manpower start
        .when('/ems-manpower', {
            templateUrl: "ems-manpower/pages/index.php",
            controller : "emsmanpower"
        })
        .when('/ems-costwisemanpower', {
            templateUrl: "ems-manpower/pages/costwise.php",
            controller : "costwisemanpower"
        })
        .when('/ems-dtview', {
            templateUrl: "ems-manpower/pages/dtview.php",
            controller : "manpowerdtview"
        })
        .when('/ems-attenpresent', {
            templateUrl: "ems-manpower/pages/attpresent.php",
            controller : "manpowerattenpresent"
        })
        .when('/ems-attenansent', {
            templateUrl: "ems-manpower/pages/attabsent.php",
            controller : "manpowerattenabsent"
        })
        .when('/ems-attenrental', {
            templateUrl: "ems-manpower/pages/attrental.php",
            controller : "manpowerattenrental"
        })
        .when('/ems-subcontracts', {
            templateUrl: "ems-manpower/pages/attsubcontract.php",
            controller : "manpowerattensubcontract"
        })
        //new manpower end
        .when('/manpowerrpt', {
            templateUrl: "manpower/index.php",
            controller: "manpowerrpt"

        })
        
        .when('/wmanpowerrpt', {
            templateUrl: "manpower/indexw.php",
            controller: "wmanpowerrpt"

        })
        .when('/manpowersummary', {
            templateUrl: "manpower/summary.php",
            controller: 'ctrl_summary'
        })
        .when('/manpowersummaryp', {
            templateUrl: 'manpower/summary_dt.php',
            controller: 'ctrl_summarysp'
        })
        .when('/manpowersummaryabs', {
            templateUrl: 'manpower/summary_aps.php',
            controller: 'ctrl_summaryabs'
        })
        .when('/manpowersummaryrend', {
            templateUrl: 'manpower/summary_rent.php',
            controller: 'ctrl_summaryrent'
        })
        .when('/manpowerfullinfo', {
            templateUrl: 'manpower/fullrpt.php',
            controller: 'ctrl_manfullrtp'
        })
        .when('/projectwithoutmanpower', {
            templateUrl: 'pstatusupdate/pwmanpower.php',
            controller: 'ctrl_pwomanpower'
        })
        .when('/sales', {
            templateUrl: 'sales/index.php',
            controller: 'ctrl_quotations'
        })
        //manpowers
        .when('/', {
            templateUrl: "project/components/index.php",
            controller: "projectctrl"
        })
        .when('/projectlisthv', {
            templateUrl: "Operations/indexn.php",
            controller: "dashboardcontrollernewvh"
        })
        .when('/projectlistvhv', {
            templateUrl: "Operations/indexn.php",
            controller: "dashboardcontrollernewvhv"
        })
        // .when('/',{
        //     templateUrl : 'pstatusupdate/index.php',
        //     controller : 'ctrl_projectdashboard'
        // })

        .when('/bom', {
            templateUrl: "bom/index.php",
            controller: "bom_controller"
        })

        .when('/bomnew', {
            templateUrl: "bom/components/addbom.php",
            controller: "bomaddctrl"
        })
        //powder cotting report

        .when('/paint_plant_whtpaint', {
            templateUrl: "pp/whtopp.php",
            controller: "ppwhtopp"
        })
        .when('/paint_plant_pptofactory', {
            templateUrl: "pp/pptofac.php",
            controller: "pppptofac"
        })
        .when('/paint_plant_receiptwh', {
            templateUrl: "pp/receip_wh.php",
            controller: "rcwh"
        })
        .when('/paint_plant_receiptfac', {
            templateUrl: "pp/receip_fac.php",
            controller: "rcfac"
        })
        .when('/ppworknew/:type', {
            templateUrl: "ppnew/index.php",
            controller: "ppworknew"
        })
        .when('/ppworknew', {
            templateUrl: "ppnew/ppall.php",
            controller: "ppworknewall"
        })
        .when('/ppworknewx', {
            templateUrl: "ppnew/ppall.php",
            controller: "ppworknewallx"
        })

        .when('/ppworknewrc', {
            templateUrl: "ppnew/receiptpp.php",
            controller: "ppworknewrcall"
        })
        .when('/ppworknewrc/:type', {
            templateUrl: "ppnew/receiptppf.php",
            controller: "ppworknewrcallf"
        })

        //ems part 
        .when('/empoyeelist', {
            templateUrl: 'ems/index.php',
            controller: 'ems_all_employees'
        })
        .when('/vacationlist', {
            templateUrl: 'ems/vacation.php',
            controller: 'emp_vacations'
        })
        .when('/finalexitlist', {
            templateUrl: 'ems/finalexit.php',
            controller: 'emp_finalexit'
        })
        .when('/maintenancework', {
            templateUrl: 'maintancework/index.php',
            controller: "maintanaceworkctrl"
        })
        .when('/maintenanceworknew', {
            templateUrl: 'maintancework/new.php',
            controller: "maintanaceworknewctrl"
        })
        .when('/metrotechnical', {
            templateUrl: 'metro/techapprovals.php',
            controller: 'metroworktechapprovals'
        })
        .when('/metroshopdrawing', {
            templateUrl: 'metro/shopdrawing.php',
            controller: 'metroworkshopdrawings'
        })
        .when('/metrodrawingapprovals', {
            templateUrl: 'metro/drawingapprovals.php',
            controller: 'metroworkdrawingapprovals'
        })
        // master log
        .when('/masterlogunits', {
            templateUrl: 'masterlog/units.php',
            controller: 'masterlogunits',
        })
        .when('/masterlogsystems', {
            templateUrl: 'masterlog/systems.php',
            controller: 'masterlogsystems'
        })
        .when('/masterlogtrades', {
            templateUrl: 'masterlog/trades.php',
            controller: "masterlogtrades"
        })

        //materila to be load
        .when('/mtbl', {
            templateUrl: 'mattobeload/index.php',
            controller: 'mtbl_controller'
        })
        .when('/mtblbacklog', {
            templateUrl: 'mattobeload/backlog.php',
            controller: 'mtbl_backlog_controller'
        })
        //glass orders 
        .when('/nglassorderglasstypes', {
            templateUrl: 'glassorders/procurement/index.php',
            controller: "goglassdescription"
        })
        .when('/nglassorderrpt', {
            templateUrl: 'glassorders/index.php',
            controller: 'gorptcontroller'
        })
        .when('/nglasssuppliers', {
            templateUrl: "glassorders/procurement/suppliers.php",
            controller: "goglasssuppliers"
        })
        .when('/nglassorderbudget', {
            templateUrl: "glassorders/procurement/budget.php",
            controller: "goglassbudget"
        })

        .when('/nglassordereng', {
            templateUrl: 'glassorders/engineering/index.php',
            controller: 'goengglassorder'
        })
        .when('/budgetglass', {
            templateUrl: "glassorders/budget/index.php",
            controller: 'budgetglass'
        })
        .when('/purchaseglass', {
            templateUrl: "glassorders/procurement/glassorderapprovals.php",
            controller: "purchaseglass"
        })
        .when('/budgetmaterials', {
            templateUrl: "glassorders/budget/material.php",
            controller: 'budgetmaterials'
        })
        .when('/purchasematerial', {
            templateUrl: 'glassorders/procurement/materialapprovals.php',
            controller: "purchasematerial"
        })
        .when('/po', {
            templateUrl: "glassorders/purchase/newpo.php",
            controller: "ponew",
        })
        .when('/vpo', {
            templateUrl: 'glassorders/purchase/index.php',
            controller: 'vpo'
        })
        .when('/pobudget', {
            templateUrl: "glassorders/purchase/newpob.php",
            controller: "pobnew",
        })
        .when('/pobudgetv', {
            templateUrl: "glassorders/purchase/pob.php",
            controller: "pob",
        })
        .when('/projectbudget', {
            templateUrl: 'glassorders/budget/summary.php',
            controller: 'projectbudget'
        })
        .when('/pon', {
            templateUrl: "glassorders/purchase/ponew.php",
            controller: 'pon_ctrl'
        })
        .when('/ponv', {
            templateUrl: "glassorders/purchase/pownewv.php",
            controller: 'ponv_ctrl'
        })
        .when('/ponewpaymentadvice', {
            templateUrl: "glassorders/advice/new.php",
            controller: 'po_nadvice'
        })
        .when('/popaymentadvice', {
            templateUrl: "glassorders/advice/index.php",
            controller: 'po_advice'
        })
        .when('/budgetsummary', {
            templateUrl: "glassorders/rpt/index.php",
            controller: 'summary_budget'
        })
        .when('/porpt', {
            templateUrl: "glassorders/rpt/ponew.php",
            controller: 'rpt_po'
        })
        .when('/projectsummary', {
            templateUrl: 'glassorders/budget/projectbudget.php',
            controller: 'project_budget'
        })

        .when('/GlassOrder', {
            templateUrl: 'glassorders/engineering/index.php',
            controller: 'gon_ctrl'
        })

        .when('/gonnew', {
            templateUrl: 'glassorders/engineering/new.php',
            controller: "gon_new"
        })
        .when('/gonp', {
            templateUrl: 'glassorders/engineering/gop.php',
            controller: "gonp"
        })
        .when('/gonpnew', {
            templateUrl: "glassorders/engineering/gopnew.php",
            controller: 'gonpnew'
        })
        .when('/posummary', {
            templateUrl: "glassorders/rpt/posummary.php",
            controller: 'poallsummary'
        })
        .when('/posummarysuppliers', {
            templateUrl: "glassorders/rpt/posummarysuppliers.php",
            controller: 'posummarysuppliers'
        })
        //submitalls
        .when('/technicalsubmital', {
            templateUrl: 'approvals/index.php',
            controller: 'technicalsubmital'
        })
        .when('/technicalsubmitalnew', {
            templateUrl: 'approvals/views/techsubmital/index.php',
            controller: 'technicalsubmitalnew'
        })
        .when('/technicalsubmitalnew/:mode', {
            templateUrl: 'approvals/views/techsubmital/index.php',
            controller: 'technicalsubmitalnew'
        })

        .when('/shopdrawingsubmital', {
            templateUrl: 'approvals/views/drawingsubmital/index.php',
            controller: 'shopdrawingsubmital'
        })

        .when('/shopdrawingsubmitalnew', {
            templateUrl: 'approvals/views/drawingsubmital/new.php',
            controller: 'shopdrawingsubmitalnew'
        })

        //comprehecive rpt
        .when('/comprehensive', {
            templateUrl: 'technical/views/index.php',
            controller: 'compreheciverpt'
        })
        //mr
        .when('/mrn', {
            templateUrl: 'mr/views/new.php',
            controller: 'mrnctrl'
        })
        .when('/mrn/:mode', {
            templateUrl: 'mr/views/new.php',
            controller: 'mrnctrl'
        })
        .when('/mr', {
            templateUrl: 'mr/views/index.php',
            controller: 'mrctrl'
        })
        .when('/mrrpt', {
            templateUrl: 'mr/views/mrrpt.php',
            controller: 'mrrpt'
        })

        .when('/mrp', {
            templateUrl: 'mr/pocurement/index.php',
            controller: 'mrp'
        })
        .when('/mrpn', {
            templateUrl: 'mr/pocurement/new.php',
            controller: 'mrpn'
        })

        //mr

        //autorization
        .when('/authorization', {
            templateUrl: "boqnew/components/index.php",
            controller: 'autorizationctrl'
        })
        .when('/morelease', {
            templateUrl: "boqnew/components/morelease.php",
            controller: "morelease"
        })

        //eng cutting list new model
        .when('/cuttinglists', {
            templateUrl: "cuttinglist/component/index.php",
            controller: 'cuttinglists'
        })
        //inside project
        .when('/cuttinglistsp', {
            templateUrl: "cuttinglist/component/indexp.php",
            controller: 'cuttinglistsp'
        })

        .when('/cuttinglistsupdates', {
            templateUrl: "cuttinglist/component/bulkupdate.php",
            controller: 'cuttinglistsupdates'
        })

        .when('/Cuttinglistsimport', {
            templateUrl: "cuttinglist/component/indeximport.php",
            controller: 'Cuttinglistsimport'
        })

        .when('/cuttinglistsusers', {
            templateUrl: "cuttinglist/component/indexuser.php",
            controller: 'cuttinglistsusers'
        })

        .when('/cuttinglistsusersdt', {
            templateUrl: "cuttinglist/component/indexuserdt.php",
            controller: 'cuttinglistsusersdt'
        })

        .when('/cuttinglistsusersp', {
            templateUrl: "cuttinglist/component/indexuserp.php",
            controller: 'cuttinglistsusersp'
        })

        .when('/cuttinglistsnew', {
            templateUrl: "cuttinglist/component/new.php",
            controller: "cuttinglistsnew"
        })
        .when('/cuttinglistsnewp', {
            templateUrl: "cuttinglist/component/newp.php",
            controller: "cuttinglistsnew"
        })
        .when('/cuttinglistsnew/:cid/:types', {
            templateUrl: "cuttinglist/component/new.php",
            controller: "cuttinglistsnew"
        })
        .when('/cuttinglistsnewp/:cid/:types', {
            templateUrl: "cuttinglist/component/newp.php",
            controller: "cuttinglistsnew"
        })

        // .when('/enggonew', {
        //     templateUrl: "cuttinglist/component/gonew.php",
        //     controller: "enggonew"
        // })

        // .when('/enggonew/:id/:mode', {
        //     templateUrl: "cuttinglist/component/gonew.php",
        //     controller: "enggonew"
        // })
        .when('/goeng', {
            templateUrl: 'gos/component/index.php',
            controller: "goeng"
        })
        .when('/goengnew', {
            templateUrl: 'gos/component/new.php',
            controller: "goengnew"
        })

        .when('/gonewengp', {
            templateUrl: 'gos/component/newp.php',
            controller: "gonewengp"
        })
        .when('/goviewp', {
            templateUrl: 'gos/component/indexp.php',
            controller: "goviewp"
        })
        .when('/goeditp', {
            templateUrl: 'gos/component/editp.php',
            controller: "goeditp"
        })
        .when('/goedit', {
            templateUrl: 'gos/component/edit.php',
            controller: "goedit"
        })
        .when('/goprocurement', {
            templateUrl: 'gos/component/goprocurement.php',
            controller: 'goprocurement'
        })
        .when('/goprocurementview', {
            templateUrl: 'gos/component/goprocurement.php',
            controller: 'goprocurementview'
        })
        .when('/goprocurementview/:type', {
            templateUrl: 'gos/component/goprocurement.php',
            controller: 'goprocurementview'
        })
        .when('/goreceiptview', {
            templateUrl: 'gos/component/goreceipts.php',
            controller: 'goreceiptview'
        })
        //for user s

        .when('/goengusers', {
            templateUrl: 'gos/component/indexuser.php',
            controller: "goengusers"
        })

        .when('/goviewusersp', {
            templateUrl: 'gos/component/indexuserp.php',
            controller: "goviewusersp"
        })

        //bom new 
        .when('/nbom', {
            templateUrl: "bomn/components/index.php",
            controller: "nbom"
        })
        .when('/nbomnew', {
            templateUrl: "bomn/components/new.php",
            controller: "nbomnew"
        })
        .when('/nbomrpt', {
            templateUrl: "bomn/components/rpt.php",
            controller: "nbomrpt"
        })
        ///bom new
        //engineering - start
        .when('/boqrelease', {
            templateUrl: "enggboq/components/release.php",
            controller: "boqrelease"
        })
        .when('/boqdispatch', {
            templateUrl: "enggboq/components/dispatch.php",
            controller: "boqdispatch"
        })
        .when('/boqsummary', {
            templateUrl: "enggboq/components/index.php",
            controller: "boqsummary"
        })
        .when('/engreleasesummary', {
            templateUrl: "enggboq/components/releasesummary.php",
            controller: "engreleasesummary"
        })
        //engineering - End
        //new boq for operations
        .when('/boqope', {
            templateUrl: "boq/components/index.php",
            controller: 'boqope'
        })
        .when('/boqope/:type', {
            templateUrl: "boq/components/index.php",
            controller: 'boqope'
        })
        .when('/boqopenew', {
            templateUrl: "boq/components/new.php",
            controller: 'boqopenew'
        })
        .when('/boqopenewa', {
            templateUrl: "boq/components/newa.php",
            controller: 'boqopenewa'
        })
        //end new boq for operations

        .when('/ctproductionentry', {
            templateUrl: 'ct-production/components/index.php',
            controller: 'ctproductionentry'
        })
        .when('/ctproductionentrynew', {
            templateUrl: 'ct-production/components/ct-recive.php',
            controller: 'ctproductionentrynew'
        })
        .when('/ctproduction', {
            templateUrl: 'ct-production/components/production.php',
            controller: 'ctproduction'
        })
        .when('/ctproduction/:type', {
            templateUrl: 'ct-production/components/production.php',
            controller: 'ctproduction'
        })
        .when('/ctrelease', {
            templateUrl: 'ct-production/components/ct-release.php',
            controller: 'ctrelease'
        })
        
        .when('/ctreleasehistory', {
            templateUrl: 'ct-production/components/ct-releasehis.php',
            controller: 'ctreleasehistory'
        })

        .when('/installation', {
            templateUrl: 'installation/components/index.php',
            controller: 'installation'
        })
        .when('/installation/:type', {
            templateUrl: 'installation/components/index.php',
            controller: 'installation'
        })
        .when('/procurement-materialsposummary', {
            templateUrl: 'procurement-materials/pages/pmaterialssummary.php',
            controller : 'pmaterialssummaryctrl'
        })
        .when('/procurement-materialsponew', {
            templateUrl: 'procurement-materials/pages/pmaterialsponew.php',
            controller : 'pmaterialsponewctrl'
        })
        .otherwise({
            redirectTo: "/",
        })
});