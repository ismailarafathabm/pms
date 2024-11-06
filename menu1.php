<?php
$user = $_SESSION['nafco_alu_user_name'];
?>
<ul class="ism-navi-itmes dashboardsmainmaneu">
    <li id="rpt_contracts" class="dropdown">
        <a>Contracts</a>
        <ul class="submenu">
            <li id="rpt_project">
                <a href="#!/projectlist">Projects</a>
            </li>
            <li id="rpt_projectv">
                <a href="#!/projectlistv">Villas</a>
            </li>
        </ul>
    </li>
    <?php
    $no_access_users = ['bilal'];
    $no_access = in_array($user, $no_access_users);
    if (!$no_access) {
    ?>
        <li id="rpt_variation" class="dropdown">
            <a>Estimation</a>
            <ul class="submenu">
                <a>Variations</a>
                <li>
                    <a href="#!rpt_variations_pending">Pending</a>
                </li>
                <li>
                    <a href="#!rpt_variations_approve">Approved/Paid</a>
                </li>
                <li>
                    <a href="#!rpt_variations_cancel">Cancelled</a>
                </li>
                <li>
                    <a href="#!rpt_variations_all">All</a>
                </li>
                <?php
                $budgetAccesUsers = ['demo', 'sam', 'nabil', 'hani', 'estimation', 'estimations', 'nimnim', 'AbuZaid', 'admin'];
                $budegetaccess = in_array($user, $budgetAccesUsers);
                if ($budegetaccess) {
                ?>
                    <li id="rpt_projectv">
                        <a href="#!/budgetsummary">Budget Summary</a>
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
    $technical_no_access_users = ['bilal'];
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
                <a>Metro Work</a>
                <li>
                    <a href="#!/metrotechnical">Technical Approvals</a>
                </li>
                <li>
                    <a href="#!/metrodrawingapprovals">Drawing Approvals</a>
                </li>
            </ul>
        </li>
    <?php
    }
    ?>
    <?php
    $material_access_users = ['demo', 'sam', 'nabil', 'hani', 'john', 'barakth', 'materials', 'sharabathi', 'fidel', 'vonn'];
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
                <a>Paint Plant Reports</a>
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
                    <a>- ENTRY -</a>
                    <li>
                        <a href="#!ppworknew/whtopp">Warehouse To Paint Plant</a>
                    </li>
                    <li>
                        <a href="#!ppworknew/fctopp">Factory To Paint Plant </a>
                    </li>
                    <a>Receipt</a>
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
    $proucrementAccessuser = ['demo', 'rajjal', 'ashraff', 'sam', 'fidel', 'nabil', 'hani', 'admin','procurement'];
    $procurement_access = in_array($user, $proucrementAccessuser);
    if ($procurement_access) {
    ?>
        <li id="rpt_procurement" class="dropdown">
            <a>Procurement</a>
            <ul class="submenu">
                <a>Glass Orders</a>
                <li>
                    <a href="#!goprocurement">Go - Entry</a>
                </li>

                <li>
                    <a href="#!/goprocurementview">GO - Balance</a>
                </li>
                <li>
                    <a href="#!/goreceiptview">GO - Receipts</a>
                </li>
                <?php
                $po_access_users = ['demo', 'sam', 'nabil', 'hani', 'procurement', 'ashraff', 'AbuZaid', 'rajjal', 'admin'];
                $po_access = in_array($user, $po_access_users);
                if ($po_access) {
                ?>
                    <a>PO</a>
                    <li>
                        <a href="#!porpt">PO Report</a>
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
    <li id="rpt_engineering" class="dropdown">
        <a>Engineering</a>
        <ul class="submenu">
            <li>
                <a href="#!/cuttinglistsusers">Cutting List</a>
            </li>
            <li>
                <a href="#!goengusers">GO</a>
            </li>
            <?php
            $engedit_access_users = ['demo', 'engineering'];
            $engedit_access = in_array($user, $engedit_access_users);
            if ($engedit_access) {
            ?>
                <a>Cutting List</a>
                <li>
                    <a href="#!cuttinglists">CL - EDIT VIEW </a>
                </li>
                <li>
                    <a href="#!cuttinglistsnew">CL - NEW </a>
                </li>
                <a>GO</a>
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
    $dispatch_access_users = ['demo', 'sam', 'nabil', 'hani', 'ikramullah', 'john', 'rajjal', 'byju', 'admin','khaja'];
    $dispacth_access = in_array($user, $dispatch_access_users);
    if ($dispacth_access) {
    ?>
        <li id="project_materialtobeload" class="dropdown">
            <a>Dispatch</a>
            <ul class="submenu">
                <a>Material to Be Load</a>
                <li>
                    <a href="#!mtbl">Report</a>
                </li>
                <li>
                    <a href="#!mtblbacklog">Backlog</a>
                </li>
            </ul>
        </li>
    <?php
    }
    ?>
    <?php
    $projects_noaccess_users = ['ayman', 'barakth', 'bilal', 'rajjal', 'estimations'];
    $project_noaccess = in_array($user, $projects_noaccess_users);
    if (!$project_noaccess) {
    ?>
        <li id="manpower_rpts" class="dropdown">
            <a>Project</a>
            <ul class="submenu">
                <li>
                    <a href="#!/manpowerrpt">Daily Manpower Report </a>
                </li>
                <li>
                    <a href="#!empoyeelist">
                        <i class="fa fa-users"></i>
                        Employee Report
                    </a>
                </li>
                <li>
                    <a href="#!vacationlist">
                        <i class="fa fa-times-circle"></i>
                        On Vacation
                    </a>
                </li>
                <li>
                    <a href="#!finalexitlist">
                        <i class="fa fa-times"></i>
                        Final Exit</a>
                </li>
            </ul>
        </li>
    <?php
    }
    ?>
</ul>