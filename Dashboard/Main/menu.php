<?php
//session_start();
if (!isset($_SESSION['nafco_alu_user_name'])) {
?>
    location.herf = "<?php echo $url_base ?>/logout.php"
<?php
}
$xusername = $_SESSION['nafco_alu_user_name'];
$user = $_SESSION['nafco_alu_user_name'];

//include_once '../../../connection/connection.php';
?>
<div class="topprojectinfos">
    <div>
        <?php 
        //  $path = $_SERVER['DOCUMENT_ROOT'].'/PMS/connection/connection.php'; 
        //  include_once($path);
        //  $con = new connection();
        //  $cn = $conn->connect();
         
         ?>
        <div style="margin-left:20px;color:#54123b;display:inline;">
            Contract No : <span style="font-weight:bold;font-size:14px;color:#633a82" id="project_number_div">{{viewproject.project_no | uppercase}}</span>
        </div>
        <div style="color:#54123b;display:inline;padding-left:35px">
            Project Name : <span style="font-weight:bold;font-size:14px;color:#633a82" id="project_name_div">{{viewproject.project_name | uppercase}}</span>
        </div>
        <div style="color:#54123b;display:inline;padding-left:35px">
            Contractor Name :<span style="font-weight:bold;font-size:14px;color:#633a82">
                {{viewproject.project_cname | uppercase}}</span>
        </div>
        <div style="color:#54123b;display:inline;padding-left:35px">
            Location : <span style="font-weight:bold;font-size:14px;color:#633a82">{{viewproject.project_location | uppercase}}</span>
        </div>
        <div style="color:#54123b;display:inline;padding-left:35px;">
            Expiry : <span style="font-weight:bold;font-size:14px;color:#c9485b">{{viewproject.project_expiry_date | uppercase}}</span>
        </div>
    </div>

</div>
<ul class="ism-navi-itmes projectmainmenu">
    <li id="exit_btn"><a href="#!/projectlist" class="hvr-shadow-radial">
            <i class="fa fa-times" style="margin-right:3px"></i>
            Exit
        </a>
    </li>
    <li class="dropdown">
        <a id="contract_menu">
            Project Informations
        </a>
        <ul class="submenu" id="boqmenus">
            <li>
                <a href="#!viewproject">
                    Project Summary
                </a>
            </li>
            <?php
            $projectpdf_access_users = ['demo', 'sam', 'nabil', 'hani', 'operation@alunafco.com', 'estimation', 'nimnim', 'admin', 'estimations', 'wagdy', 'AbuZaid','Husam'];
            $projectpdf_access = in_array($user, $projectpdf_access_users);
            if ($projectpdf_access) {
            ?>
                <li>
                    <a download="{{viewproject.project_name}} - {{viewproject.project_no}}.pdf" href="<?php echo $url_base ?>assets/contract/{{viewproject.project_no_enc}}.pdf" target="_blank">
                        <i class="fa fa-file-pdf-o"></i>
                        Project PDF
                    </a>
                </li>
            <?php
            }
            ?>
            <!-- <li>
                <a class="topnav" href="#!boq">
                    Project BOQ
                </a>
            </li> -->
            <li>
                <a class="topnav" href="#!/boqope">
                    All BOQ's
                </a>

            </li>
            <li>
                 <a class="topnav" href="#!/boqope/contract">
                    Contract BOQ's
                </a>
            </li>
            
            <?php
            $project_newboq_access_users = ['demo', 'operation@alunafco.com'];
            $project_newboq_access = in_array($user, $project_newboq_access_users);
            if ($project_newboq_access) {
            ?>
                <li>
                    <a class="topnav" href="#!boqopenew">
                        New BOQ
                    </a>
                    <a class="topnav" href="#!boqopenewa">
                        Revised & Additional BOQ
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
    </li>

    <li id="pro_costing" class="dropdown">
        <a class="hvr-shadow-radial">Estimation</a>
        <ul class="submenu">
            <li><a href="#!/varinew">Variation</a></li>
            <?php
            $projectpudject_access_users = ['demo', 'sam', 'nabil', 'hani',  'estimation', 'nimnim', 'admin', 'estimations', 'AbuZaid','Husam'];
            $projectpudject_access = in_array($user, $projectpdf_access_users);
            if ($projectpdf_access) {
            ?>
                <a><i class="fa fa-usd"></i>Budget</a>
                <li><a href="#!/projectbudget">Summary</a></li>
                <li><a href="#!/projectsummary">budget</a></li>
                <li><a href="#!/budgetmaterials">Materials</a></li>
                <li><a href="#!/budgetglass">Glass</a></li>

            <?php
            }
            ?>
        </ul>
    </li>
    <li id="approvals_menu" class="dropdown">
        <a> Technical </a>
        <ul class="submenu">
            <?php
            $projectsubmittal_access_users = ['demo', 'operation@alunafco.com'];
            $projectsubmittal_access = in_array($user, $projectsubmittal_access_users);
            if ($projectsubmittal_access) {
            ?>
                <a> Submittals </a>
                <li> <a href="#!technicalsubmital">Technical Submittal</a></li>
                <li> <a href="#!shopdrawingsubmital">Shop Drawing Submittal</a></li>
            <?php
            }
            ?>
            <a> Approvals </a>
            <li> <a href="#!approval">Technical Approvals</a></li>
            <li> <a href="#!techdraw">Shop Drawings Approvals</a></li>
            <?php
            $projectcomh_access_users = ['demo', 'sam', 'nabil', 'hani', 'operation@alunafco.com', 'vonn', 'john', 'khaja', 'admin', 'johnlacro','Husam'];
            $projectcomh_access = in_array($user, $projectcomh_access_users);
            if ($projectcomh_access) {
            ?>
                <a> comprehensive </a>
                <li id="cmprpt">
                    <a href="#!/comprehensive" class="hvr-shadow-radial">
                        comprehensive Report
                    </a>
                </li>
            <?php
            }
            ?>

        </ul>
    </li>

    <?php
    $projectmaterials_access_users = ['demo', 'vonn', 'sam', 'nabil', 'hani', 'AbuZaid', 'Abuzaid', 'john', 'johnlacro', 'khaja', 'barakth', 'materials', 'sharabathi', 'admin', 'fidel','hubert','Husam'];
    $projectmaterials_access = in_array($user, $projectmaterials_access_users);
    if ($projectmaterials_access) {
    ?>
        <li id="newbom" class="dropdown">
            <a>
                Materials
            </a>
            <ul class="submenu">
                <a>M.R</a>
                <li><a href="#!mr"> View MR</a></li>
                <a>BOM</a>
                <li><a href="#!nbom"> BOM</a></li>
                <?php
                $projectmaterialsbomold_access_users = ['demo', 'john', 'materials','hubert'];
                $projectmaterialsbomold_access = in_array($user, $projectmaterialsbomold_access_users);
                if ($projectmaterialsbomold_access) {
                ?>
                    <a>Entry -</a>
                    <li><a href="#!mrn">New MR</a></li>
                    <?php
                    $projectmaterialsbom_newboqm_access_users = ['demo', 'john','hubert'];
                    $projectmaterialsbom_newboqm_access = in_array($user, $projectmaterialsbom_newboqm_access_users);
                    if ($projectmaterialsbom_newboqm_access) {
                    ?>
                        <li><a href="#!nbomnew"> New BOM</a></li>
                        <li><a href="#!bomnew"> New BOM - old</a></li>
                <?php
                    }
                }
                ?>

            </ul>
        </li>
    <?php
    }
    ?>
    <?php
    $project_procurement_access_users = ['demo', 'sam', 'nabil', 'hani', 'rajjal', 'ashraff', 'procurement', 'AbuZaid', 'fidel', 'admin','Husam'];
    $project_procurement_access = in_array($user, $project_procurement_access_users);
    if ($project_procurement_access) {
    ?>
        <li id="newbom" class="dropdown">
            <a> Procurement</a>
            <ul class="submenu">
                <li><a href="#!gonp">PO Summary</a></li>
                <li><a href="#!ponv">PO's</a></li>
                <li><a href="#!pobudgetv">PO Budget</a></li>
                <li><a href="#!/popaymentadvice">Payment Advice View</a></li>
                <?php
                $project_procurement_entry_access_users = ['demo', 'procurement', 'fidel'];
                $project_procurement_entry_access = in_array($user, $project_procurement_entry_access_users);
                if ($project_procurement_entry_access) {
                ?>
                    <a>-Entry-</a>
                    <li><a href="#!/pon">New PO</a></li>
                    <li><a href="#!/pobudget">PO Budget</a></li>
                    <li><a href="#!/ponewpaymentadvice">Payment Advice</a></li>
                <?php
                }
                ?>
            </ul>
        </li>
    <?php
    }
    ?>
    <li id="newbom" class="dropdown">
        <a> Engineering</a>
        <ul class="submenu">
            <li><a href="#!cuttinglistsusersp">CL</a></li>
            <li><a href="#!goviewusersp">GO</a></li>
            <li><a href="#!boqsummary">BOQ - Summary</a></li>
            <li><a href="#!engreleasesummary"> BOQ - Releases</a></li>
            <?php
            $project_ct_entry_access_users = ['demo', 'engineering'];
            $project_ct_entry_access = in_array($user, $project_ct_entry_access_users);
            if ($project_ct_entry_access) {
            ?>
                <a>Entry</a>
                <li><a href="#!cuttinglistsp">CL _ EDIT </a></li>
                <li><a href="#!cuttinglistsnewp">CL _ NEW</a></li>
                <li><a href="#!goviewp">GO _ EDIT</a></li>
                <li><a href="#!gonewengp">GO _ NEW</a></li>
            <?php
            }
            ?>
            <?php
            $project_boqeng_entry_access_users = ['demo', 'suji', 'joseph', 'rayan', 'halith', 'fizal', 'andrew', 'regner'];
            $project_boqeng_entry_access = in_array($user, $project_boqeng_entry_access_users);
            if ($project_boqeng_entry_access) {
            ?>
                <a>Entry</a>
                <li><a href="#!boqrelease">BOQ Release</a></li>
            <?php
            }
            ?>
        </ul>
    </li>
</ul>