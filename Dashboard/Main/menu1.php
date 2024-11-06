<?php
if (!isset($_SESSION['nafco_alu_user_name'])) {
    die();
}
$user = $_SESSION['nafco_alu_user_name'];
?>
<ul class="ism-navi-itmes dashboardsmainmaneu">
    <li id="rpt_contracts" class="dropdown">
        <a>Contracts</a>
        <ul class="submenu">
            <li id="rpt_project">
                <a href="#!/projects/all"> On Going Projects</a>
            </li>
            <li id="rpt_projectv">
                <a href="#!/projects/villa">On Going Villas</a>
            </li>
            <li id="rpt_project">
                <a href="#!/projects/allhandover">Handed Over Projects</a>
            </li>
            <li id="rpt_projectv">
                <a href="#!/projects/villahandover"> Handed Over Villas</a>
            </li>
        </ul>
    </li>
    <li id="rpt_contracts" class="dropdown" style="display: none;">
        <a>oContracts</a>
        <ul class="submenu">
            <li id="rpt_project">
                <a href="#!/projectlist"> On Going Projects</a>
            </li>
            <li id="rpt_projectv">
                <a href="#!/projectlistv">On Going Villas</a>
            </li>
            <li id="rpt_project">
                <a href="#!/projectlisthv">Handed Over Projects</a>
            </li>
            <li id="rpt_projectv">
                <a href="#!/projectlistvhv"> Handed Over Villas</a>
            </li>
        </ul>
    </li>
    <?php
    $no_access_users = ['bilal', 'tauqqir'];
    $no_access = in_array($user, $no_access_users);
    if (!$no_access) {
    ?>
        <li id="rpt_variation" class="dropdown">
            <a>Estimation</a>
            <ul class="submenu">
                <li>
                    <a href="#!rpt_variations_pending">Pending Variations</a>
                </li>
                <li>
                    <a href="#!rpt_variations_approve">Approved / Paid Variations</a>
                </li>
                <li>
                    <a href="#!rpt_variations_cancel">Cancelled Variations</a>
                </li>
                <li>
                    <a href="#!rpt_variations_all">All Variations</a>
                </li>
                <?php
                $budgetAccesUsers = ['demo', 'superadmin', 'sam', 'nabil', 'hani', 'estimation', 'estimations', 'nimnim', 'AbuZaid', 'admin','Husam'];
                $budegetaccess = in_array($user, $budgetAccesUsers);
                if ($budegetaccess) {
                ?>
                    <li id="rpt_projectv">
                        <a href="#!/budgetsummary">Project Budget Summary</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </li>
    <?php
    }
    ?>
    <?php
    $technical_no_access_users = ['bilal', 'tauqqir'];
    $technical_no_access = in_array($user, $technical_no_access_users);
    if (!$technical_no_access) {
    ?>
        <li id="rpt_technical" class="dropdown">
            <a>Technical</a>
            <ul class="submenu">
                <li id="rpt_project_tech">
                    <a href="#!/techapprovalsrpt">Technical Approvals</a>
                </li>
                <li id="rpt_project_drawing">
                    <a href="#!/shopdrawingApprovalsrpt">Drawing Approlvals</a>
                </li>
                <hr>
                <li>
                    <a href="#!/metrotechnical">Technical Approvals For Metro</a>
                </li>
                <li>
                    <a href="#!/metrodrawingapprovals">Drawing Approvals For Metro</a>
                </li>
            </ul>
        </li>
    <?php
    }
    ?>
    <?php
    $material_access_users = ['demo', 'superadmin', 'sam', 'nabil', 'hani', 'john', 'barakth', 'materials', 'sharabathi', 'fidel', 'vonn', 'hubert', 'hameed', 'musallam', 'khaldoon', 'nashif', 'ahmed', 'amin', 'nabeel', 'najir', 'adnan', 'aljon', 'sakib', 'Ahmed','Husam'];
    $material_access = in_array($user, $material_access_users);
    if ($material_access) {
    ?>
        <li id="rpt_materials" class="dropdown">
            <a>Materials</a>
            <ul class="submenu">
                <li id="rpt_project_tech">
                    <a href="#!/mrrpt">M.R</a>
                </li>
                <li id="rpt_project_tech">
                    <a href="#!/nbomrpt">BOM</a>
                </li>
                <li>
                    <a href="#!ppworknewx">Paint Plant Balance</a>
                </li>
                <li>
                    <a href="#!ppworknewrc">All Receipt Paint Plant</a>
                </li>
                <li>
                    <a href="#!ppworknew">Paint Plant All</a>
                </li>
                <?php
                $ppedit_users = ['demo', 'materials'];
                $ppedit_access = in_array($user, $ppedit_users);
                if ($ppedit_access) {
                ?>

                    <li>
                        <a href="#!ppworknew/whtopp">Warehouse To Paint Plant</a>
                    </li>
                    <li>
                        <a href="#!ppworknew/fctopp">Factory To Paint Plant </a>
                    </li>
                    <li>
                        <a href="#!ppworknewrc/whtopp">Warehouse To Paint Plant Receipt</a>
                    </li>
                    <li>
                        <a href="#!ppworknewrc/fctopp">Factory To Paint Plant Receipt</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </li>
    <?php
    }
    ?>
    <?php
    //for procurement
    $proucrementAccessuser = ['demo', 'superadmin', 'rajjal', 'ashraff', 'sam', 'fidel', 'nabil', 'hani', 'admin', 'procurement', 'tauqqir', 'khaja', 'hameed', 'musallam', 'khaldoon', 'nashif', 'ahmed', 'amin', 'nabeel', 'najir', 'adnan', 'aljon', 'sakib', 'Ahmed','Husam'];
    $procurement_access = in_array($user, $proucrementAccessuser);
    if ($procurement_access) {
    ?>
        <li id="rpt_procurement" class="dropdown">
            <a>Procurement</a>
            <ul class="submenu">
                <li>
                    <a href="#!/goprocurementview">Glass Order Balance</a>
                </li>
                <li>
                    <a href="#!/goprocurementview/nobal">Glass Order Receipts</a>
                </li>
                <li>
                    <a href="#!/goprocurementview/all">Glass Order All</a>
                </li>
                <li>
                    <a href="#!goprocurement">Gass Order Entry</a>
                </li>
                <li>
                    <a href="#!/goreceiptview">Receipt History For Glass Orders</a>
                </li>

                <?php
                $po_access_users = ['demo', 'superadmin', 'sam', 'nabil', 'hani', 'procurement', 'ashraff', 'AbuZaid', 'rajjal', 'admin','Husam'];
                $po_access = in_array($user, $po_access_users);
                if ($po_access) {
                ?>

                    <li>
                        <a href="#!porpt">Glass Order PO Summary</a>
                    </li>
                    <li>
                        <a href="#!posummary">Projects Wise PO Summary</a>
                    </li>
                    <li>
                        <a href="#!posummarysuppliers">Supplier Wise PO Summary</a>
                    </li>

                <?php
                }
                ?>
            </ul>
        </li>
    <?php
    }
    ?>
    <?php
    //procuement mateirals
    $pmaterialsusers = ['demo', 'superadmin', 'sam', 'nabil', 'hani', 'fidel', 'ashraff', 'AbuZaid', 'rajjal', 'admin','Husam'];
    $pmaterialsaccess = in_array($user, $pmaterialsusers);
    if ($pmaterialsaccess) {
    ?>
        <li id="rpt_procurementmaterials" class="dropdown">
            <a>Procurement - Materials</a>
            <ul class="submenu">
                <li>
                    <a href="#!procurement-materialsposummary">Material PO Summary</a>
                </li>
                <?php
                $pmaterialsusernew = ['demo', 'fidel'];
                $pmaterialsnewaccess = in_array($user, $pmaterialsusernew);
                if ($pmaterialsnewaccess) {

                ?>
                    <li>
                        <a href="#!procurement-materialsponew">New</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </li>
    <?php
    }
    ?>
    <li id="rpt_engineering" class="dropdown">
        <a>Engineering</a>
        <ul class="submenu">
            <li>
                <a href="#!/cuttinglistsusers">Eng Cutting List</a>
            </li>
            <li>
                <a href="#!goengusers">Eng Glass Orders</a>
            </li>
            <?php
            $engedit_access_users = ['demo', 'engineering'];
            $engedit_access = in_array($user, $engedit_access_users);
            if ($engedit_access) {
            ?>

                <li>
                    <a href="#!cuttinglists">CL - EDIT VIEW </a>
                </li>
                <li>
                    <a href="#!cuttinglistsnew">CL - NEW </a>
                </li>

                <li>
                    <a href="#!goengnew">Go New</a>
                </li>
                <li>
                    <a href="#!goeng">Glass Orders</a>
                </li>
            <?php
            }
            ?>
        </ul>
    </li>
    <?php
    $production_access_users = ['demo', 'superadmin', 'sam', 'admin', 'nabil', 'hani', 'ikramullah', 'khaja', 'byju', 'hameed', 'musallam', 'khaldoon', 'nashif', 'ahmed', 'amin', 'nabeel', 'najir', 'adnan', 'aljon', 'sakib', 'Ahmed','Husam'];
    $production_access = in_array($user, $production_access_users);
    if ($production_access) {
    ?>
        <li id="rpt_production" class="dropdown">
            <a>Production</a>
            <ul class="submenu">
                <li>
                    <a href="#!/ctproduction/balance">Production Balance</a>
                </li>
                <li>
                    <a href="#!/ctproduction/compleate">Production Delivered</a>
                </li>

                <li>
                    <a href="#!/ctproduction">Production Log</a>
                </li>
                <li>
                    <a href="#!/ctreleasehistory">Proudction Delivered history</a>
                </li>
                <li>
                    <a href="#!/ctproductionentry">Production Entry</a>
                </li>
                <li>
                    <a href="#!mtbl">Production Delivery Schedule</a>
                </li>
                <li>
                    <a href="#!mtblbacklog">Production Delivery Backlog</a>
                </li>
            </ul>
        </li>
    <?php
    }
    ?>
    <?php
    $dispatch_access_users = ['demo', 'superadmin', 'sam', 'nabil', 'hani', 'ikramullah', 'john', 'rajjal', 'byju', 'admin', 'khaja', 'hameed', 'musallam', 'khaldoon', 'ahmed', 'nashif', 'amin', 'Ahmed','Husam'];
    $dispacth_access = in_array($user, $dispatch_access_users);
    if ($dispacth_access) {
    ?>
        <li id="project_materialtobeload" class="dropdown" style="display: none;">
            <a>Dispatch</a>
            <ul class="submenu">

            </ul>
        </li>
    <?php
    }
    ?>
    <?php
    $projects_access_users = ['demo', 'superadmin', 'sam', 'nabil', 'hani', 'demo', 'khaja', 'admin', 'hameed', 'musallam', 'khaldoon', 'nashif', 'ahmed', 'amin', 'nabeel', 'najir', 'adnan', 'aljon', 'sakib', 'Ahmed','Husam'];
    $project_access = in_array($user, $projects_access_users);
    if ($project_access) {
    ?>
        <li id="manpower_rpts" class="dropdown">
            <a>Projects</a>
            <ul class="submenu">
                <li>
                    <a href="#!/installation/balance">Project Balance</a>
                </li>
                <li>
                    <a href="#!/installation/compleate">Project Installed</a>
                </li>

                <li>
                    <a href="#!/installation">Project Log</a>
                </li>
                <!-- manpower start -->
                <?php
                $emsmanpoweruser = ['demo', 'sam', 'khaja', 'nabil', 'hani'];
                $emsmanpoweraccess = in_array($user, $emsmanpoweruser);
                if ($emsmanpoweraccess) {
                ?>
                    <li>
                        <a href="#!/ems-manpower">Daily Manpower Report </a>
                    </li>
                <?php
                }

                $emscostwisemanpowerusers = ['demo', 'sam', 'khaja', 'nabil', 'hani','Husam'];
                $emscostwisemanpoweraccess = in_array($user, $emscostwisemanpowerusers);
                if ($emscostwisemanpoweraccess) {
                ?>
                    <li>
                        <a href="#!/ems-costwisemanpower">Cost Wise Manpower Report</a>
                    </li>
                <?php
                }

                $emsmanpowerdtviewusers = ['demo', 'sam', 'khaja', 'nabil', 'hani','Husam'];
                $emsmanpowerdtviewaccess = in_array($user, $emsmanpowerdtviewusers);
                if ($emscostwisemanpoweraccess) {
                ?>
                    <li>
                        <a href="#!/ems-dtview">Detailed Manpower Report</a>
                    </li>
                <?php
                }

                $emsmanpowerattpresentusers = ['demo', 'sam', 'khaja', 'nabil', 'hani','Husam'];
                $emsmanpowerattpresentaccess = in_array($user, $emsmanpowerattpresentusers);
                if ($emsmanpowerattpresentaccess) {
                ?>
                    <li>
                        <a href="#!/ems-attenpresent">Project With Date wise Summary - Present</a>
                    </li>
                <?php
                }
                $emsmanpowerattabsentusers = ['demo', 'sam', 'khaja', 'nabil', 'hani','Husam'];
                $emsmanpowerattabsentaccess = in_array($user, $emsmanpowerattabsentusers);
                if($emsmanpowerattabsentaccess){
                    ?>
                     <li>
                        <a href="#!/ems-attenansent">Project with Date Wise Summary - Absent</a>
                    </li>
                    <?php
                }
                $emsmanpowerrentalusers = ['demo', 'sam', 'khaja', 'nabil', 'hani','Husam'];
                $emsmanpowerrentalaccess = in_array($user, $emsmanpowerrentalusers);
                
                if($emsmanpowerrentalaccess){
                    ?>
                    <li>
                        <a href="#!/ems-attenrental">Project with Date Wise Summary - Rental</a>
                    </li>
                    <?php
                }
                $emsmanpowersubcontractusers = ['demo', 'sam', 'khaja', 'nabil', 'hani','Husam'];
                $emsmanpowersubcontractacess = in_array($user, $emsmanpowersubcontractusers);
                if( $emsmanpowersubcontractacess){
                    ?>
                    <li>
                        <a href="#!/ems-subcontracts">Project with Date Wise Summary - Sub.Contract</a>
                    </li>
                    <?php
                }
                ?>
                <!-- manpower end -->
                <li>
                    <a href="#!empoyeelist">
                        <i class="fa fa-users"></i>
                        Project Workers List
                    </a>
                </li>
                <li>
                    <a href="#!vacationlist">
                        <i class="fa fa-times-circle"></i>
                        Project Workers On Vacation
                    </a>
                </li>
                <li>
                    <a href="#!finalexitlist">
                        <i class="fa fa-times"></i>
                        Project Workers Final Exit
                    </a>
                </li>
            </ul>
        </li>
    <?php
    }
    ?>
</ul>