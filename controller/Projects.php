<?php
date_default_timezone_set('Asia/Riyadh');
include_once('mac.php');
class Projects extends mac
{
    private $cn;
    private $cm;
    private $rows;
    private $sql;
    private $response;

    private $pms_project_summary;

    private $project_id;
    private $project_no;
    private $project_name;
    private $project_cname;
    private $project_location;
    private $project_singdate;
    private $project_sing_description;
    private $project_contract_duration;
    private $project_contract_description;
    private $project_contact_person;
    private $project_contact_no;
    private $Sales_Representative;
    private $project_penalty;
    private $project_expiry_date;
    private $project_remarks;
    private $project_amount;
    private $project_basicpayment;
    private $project_first_advance_amount;
    private $project_first_advance;
    private $project_advacne_date;
    private $advance_amount_remark;
    private $project_enter_date;
    private $project_edit_date;
    private $project_status;
    private $project_create_by;
    private $project_ledit_by;
    private $project_boq_refno;
    private $project_boq_revision;
    private $project_hadnover;
    private $project_handover_date;


    private $project_payment_terms;
    private $payment_terms_id;
    private $payment_terms_descripton;
    private $payment_terms_project;
    private $payment_terms_number;

    private $project_conditions;
    private $project_conditions_id;
    private $project_conditions_remark;
    private $project_conditions_project;
    private $project_conditions_number;

    private $pms_project_specification;
    private $spec_id;
    private $spec_project;
    private $spec_remark;
    private $spec_type;
    private $spec_type_sub;

    //table - poq pms_poq
    private $pms_poq;
    //table poq column
    private $poq_id;
    private $poq_item_no;
    private $poq_item_type;
    private $poq_item_remark;
    private $poq_item_width;
    private $poq_item_height;
    private $poq_item_glass_spec;
    private $poq_item_glass_single;
    private $poq_item_glass_double1;
    private $poq_item_glass_double2;
    private $poq_item_glass_double3;
    private $poq_item_glass_laminate1;
    private $poq_item_glass_laminate2;
    private $poq_drawing;
    private $poq_finish;
    private $poq_system_type;
    private $poq_qty;
    private $poq_unit;
    private $poq_uprice;
    private $poq_remark;
    private $poq_cby;
    private $poq_eby;
    private $poq_Cdate;
    private $poq_Edate;
    private $poq_project_code;
    private $poq_status;
    private $boq_refno;
    private $boq_reviewno;
    private $boq_area;

    private $pms_class_types;
    private $class_type_id;
    private $class_type_name;

    private $pms_boq_notes;
    private $boq_note_id;
    private $boq_note_project;
    private $boq_note_itemno;
    private $boq_note_notes;

    private $pms_boq_measurement;
    private $meas_id;
    private $meas_boq;
    private $meas_width;
    private $meas_height;
    private $meas_remark;
    private $meas_project;


    function __construct($db)
    {
        $this->cn = $db;
        $this->pms_project_summary = mac::pms_project_summary;
        $this->project_payment_terms = mac::project_payment_terms;
        $this->project_conditions = mac::project_conditions;
        $this->pms_project_specification = mac::pms_project_specification;
        $this->pms_poq = mac::pms_poq;
        $this->pms_class_types = mac::pms_class_types;
        $this->pms_boq_notes = mac::pms_boq_notes;
        $this->pms_boq_measurement = mac::pms_boq_measurement;
        $this->reponse = array("msg" => "0", "data" => "#_ERROR");
    }
    public function get_all_boq_meas($project)
    {
        $this->meas_project = $this->enc('enc', $project);
        $this->sql = "SELECT *FROM ((((pms_poq 
            inner join 
            pms_ptype on pms_poq.poq_item_type=pms_ptype.ptype_id) 
            inner join 
            pms_systemtype on pms_poq.poq_system_type=pms_systemtype.system_type_id) 
            inner join 
            pms_finish on pms_poq.poq_finish=pms_finish.finish_id) 
            inner join 
            pms_units on pms_poq.poq_unit=pms_units.uint_id) inner join pms_boq_measurement on pms_poq.poq_item_no=pms_boq_measurement.meas_boq where pms_boq_measurement.meas_project=:meas_project";
        // $this->sql = "select *from $this->pms_boq_measurement inner join $this->pms_poq on $this->pms_boq_measurement.meas_boq=$this->pms_poq.poq_item_no where $this->pms_boq_measurement.meas_project=:meas_project";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":meas_project", $this->meas_project);
        $this->cm->execute();
        $_meas = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $area  = (float) $this->enc('denc', $meas_width) * (float) $this->enc('denc', $meas_height);
            $_meas[] = array(
                'poq_id' => $poq_id,
                'poq_item_no' => $this->enc('denc', $poq_item_no),
                'poq_item_type' => $poq_item_type,
                'poq_item_remark' => $this->enc('denc', $poq_item_remark),
                'poq_item_width' => $this->enc('denc', $poq_item_width),
                'poq_item_height' => $this->enc('denc', $poq_item_height),
                'poq_item_glass_spec' => $this->enc('denc', $poq_item_glass_spec),
                'poq_item_glass_single' => $this->enc('denc', $poq_item_glass_single),
                'poq_item_glass_double1' => $this->enc('denc', $poq_item_glass_double1),
                'poq_item_glass_double2' => $this->enc('denc', $poq_item_glass_double2),
                'poq_item_glass_double3' => $this->enc('denc', $poq_item_glass_double3),
                'poq_item_glass_laminate1' => $this->enc('denc', $poq_item_glass_laminate1),
                'poq_item_glass_laminate2' => $this->enc('denc', $poq_item_glass_laminate2),
                'poq_drawing' => $this->enc('denc', $poq_drawing),
                'poq_finish' => $poq_finish,
                'poq_system_type' => $poq_system_type,
                'poq_qty' => $this->enc('denc', $poq_qty),
                'poq_unit' => $poq_unit,
                'poq_uprice' => $this->enc('denc', $poq_uprice),
                'poq_remark' => $this->enc('denc', $poq_remark),
                'poq_cby' => $this->enc('denc', $poq_cby),
                'poq_eby' => $this->enc('denc', $poq_eby),
                'poq_Cdate' => $this->enc('denc', $poq_Cdate),
                'poq_Edate' => $this->enc('denc', $poq_Edate),
                'poq_project_code' => $this->enc('denc', $poq_project_code),
                'poq_status' => $this->enc('denc', $poq_status),
                'unit_name' => $this->enc('denc', $unit_name),
                'ptype_name' => $this->enc('denc', $ptype_name),
                'system_type_name' => $this->enc('denc', $system_type_name),
                'finish_name' => $this->enc('denc', $finish_name),
                'meas_id' => $meas_id,
                'meas_boq' => $this->enc('denc', $meas_boq),
                'meas_width' => $this->enc('denc', $meas_width),
                'meas_height' => $this->enc('denc', $meas_height),
                'meas_remark' => $this->enc('denc', $meas_remark),
                'meas_project' => $this->enc('denc', $meas_project),
                'area' => $area
            );
        }
        $this->response = array("msg" => "1", "data" => $_meas);
        return json_encode($this->response);
        exit();
    }

    public function new_meas($meas_info)
    {
        $this->meas_boq = $this->enc('enc', $meas_info['meas_boq']);
        $this->meas_width = $this->enc('enc', $meas_info['meas_width']);
        $this->meas_height = $this->enc('enc', $meas_info['meas_height']);
        $this->meas_remark = $this->enc('enc', $meas_info['meas_remark']);
        $this->meas_project = $this->enc('enc', $meas_info['meas_project']);
        $this->sql = "select *from $this->pms_boq_measurement where meas_project=:meas_project and meas_boq=:meas_boq";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":meas_project", $this->meas_project);
        $this->cm->bindParam(":meas_boq", $this->meas_boq);
        $this->cm->execute();
        $_d = true;
        if ($this->cm->rowCount() > 0) {
            $_d = false;
        }

        if ($_d == true) {
            $this->sql = "INSERT INTO $this->pms_boq_measurement values(
                null,
                :meas_boq,
                :meas_width,
                :meas_height,
                :meas_remark,
                :meas_project
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(':meas_boq', $this->meas_boq);
            $this->cm->bindParam(':meas_width', $this->meas_width);
            $this->cm->bindParam(':meas_height', $this->meas_height);
            $this->cm->bindParam(':meas_remark', $this->meas_remark);
            $this->cm->bindParam(':meas_project', $this->meas_project);
            if ($this->cm->execute()) {
                $this->response = array("msg" => "1", "data" => "Saved");
            } else {
                $this->response = array("msg" => "0", "data" => "DB ERROR");
            }
        } else {
            $this->response = array("msg" => "0", "data" => "Already Exists");
        }
        return json_encode($this->response);
        exit();
    }

    public function new_project($projectinfo)
    {
        //$this->project_id = $projectinfo["project_id"];
        $pjid = strtoupper($projectinfo["project_no"]);
        $prono = strtolower($projectinfo["project_no"]);
        //echo $prono;
        $this->project_no = $this->enc('enc', $prono);
        $this->project_name = $this->enc('enc', $projectinfo["project_name"]);
        $this->project_cname = $this->enc('enc', $projectinfo["project_cname"]);
        $this->project_location = $this->enc('enc', $projectinfo["project_location"]);

        $_project_singdate = date_create($projectinfo["project_singdate"]);
        $this->project_singdate = date_format($_project_singdate, 'Y-m-d');

        $this->project_sing_description = $this->enc('enc', $projectinfo["project_sing_description"]);
        $this->project_contract_duration = $this->enc('enc', $projectinfo["project_contract_duration"]);
        $this->project_contract_description = $this->enc('enc', $projectinfo["project_contract_description"]);
        $this->project_contact_person = $this->enc('enc', $projectinfo["project_contact_person"]);
        $this->project_contact_no = $this->enc('enc', $projectinfo["project_contact_no"]);
        $this->Sales_Representative = $this->enc('enc', $projectinfo["Sales_Representative"]);
        $this->project_penalty = $this->enc('enc', $projectinfo["project_penalty"]);

        $_project_expiry_date = date_create($projectinfo["project_expiry_date"]);
        $this->project_expiry_date = date_format($_project_expiry_date, 'Y-m-d');

        $this->project_remarks = $this->enc('enc', $projectinfo["project_remarks"]);
        $this->project_amount = $this->enc('enc', $projectinfo["project_amount"]);
        $this->project_basicpayment = $this->enc('enc', $projectinfo["project_basicpayment"]);
        $this->project_first_advance_amount = $this->enc('enc', $projectinfo["project_first_advance_amount"]);
        $this->project_first_advance = $this->enc('enc', $projectinfo["project_first_advance"]);

        $_project_advacne_date = date_create($projectinfo["project_advacne_date"]);
        $this->project_advacne_date = date_format($_project_advacne_date, 'Y-m-d');
        $this->advance_amount_remark = $this->enc('enc', $projectinfo["advance_amount_remark"]);
        $this->project_create_by = $this->enc('enc', $projectinfo["project_create_by"]);
        $this->project_ledit_by = $this->enc('enc', $projectinfo["project_create_by"]);
        $projectRegion = $this->enc('enc', $projectinfo["projectRegion"]);
        $project_type = $this->enc('enc', $projectinfo["project_type"]);
        if ($projectinfo["advance_amount_remark"] === "Advance Payment Completed") {
            $status = $this->enc('enc', '1');
        } else {
            $status = $this->enc('enc', '0');
        }

        $this->project_boq_refno = $this->enc('enc', '');
        $this->project_boq_revision = $this->enc('enc', '');
        //check this project id already exists)
        $this->sql = "select project_no from $this->pms_project_summary where project_no=:project_no";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":project_no", $this->project_no);
        $this->cm->execute();
        $dub = false;
        if ($this->cm->rowCount() === 0) {
            $dub = true;
        }
        if ($dub === true) {
            $this->sql = "";
            $this->cm = "";

            $this->sql = "insert into $this->pms_project_summary values(
                null,
                :project_no,
                :project_name,
                :project_cname,
                :project_location,
                :project_singdate,
                :project_sing_description,
                :project_contract_duration,
                :project_contract_description,
                :project_contact_person,
                :project_contact_no,
                :Sales_Representative,
                :project_penalty,
                :project_expiry_date,
                :project_remarks,
                :project_amount,
                :project_basicpayment,
                :project_first_advance_amount,
                :project_first_advance,
                :project_advacne_date,
                :advance_amount_remark,                
                current_timestamp(),
                current_timestamp(),
                :status,
                :project_create_by,
                :project_ledit_by,
                :project_boq_refno,
                :project_boq_revision,
                :project_hadnover,
                '2020-01-01',
                :projectRegion,
                :project_type,
                '" . $pjid . "'
            )";
            $_hnd = $this->enc('enc', '0');
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(':project_no', $this->project_no);
            $this->cm->bindParam(':project_name', $this->project_name);
            $this->cm->bindParam(':project_cname', $this->project_cname);
            $this->cm->bindParam(':project_location', $this->project_location);
            $this->cm->bindParam(':project_singdate', $this->project_singdate);
            $this->cm->bindParam(':project_sing_description', $this->project_sing_description);
            $this->cm->bindParam(':project_contract_duration', $this->project_contract_duration);
            $this->cm->bindParam(':project_contract_description', $this->project_contract_description);
            $this->cm->bindParam(':project_contact_person', $this->project_contact_person);
            $this->cm->bindParam(':project_contact_no', $this->project_contact_no);
            $this->cm->bindParam(':Sales_Representative', $this->Sales_Representative);
            $this->cm->bindParam(':project_penalty', $this->project_penalty);
            $this->cm->bindParam(':project_expiry_date', $this->project_expiry_date);
            $this->cm->bindParam(':project_remarks', $this->project_remarks);
            $this->cm->bindParam(':project_amount', $this->project_amount);
            $this->cm->bindParam(':project_basicpayment', $this->project_basicpayment);
            $this->cm->bindParam(':project_first_advance_amount', $this->project_first_advance_amount);
            $this->cm->bindParam(':project_first_advance', $this->project_first_advance);
            $this->cm->bindParam(':project_advacne_date', $this->project_advacne_date);
            $this->cm->bindParam(':advance_amount_remark', $this->advance_amount_remark);
            $this->cm->bindParam(":status", $status);
            $this->cm->bindParam(':project_create_by', $this->project_create_by);
            $this->cm->bindParam(':project_ledit_by', $this->project_ledit_by);
            $this->cm->bindParam(':project_boq_refno', $this->project_boq_refno);
            $this->cm->bindParam(':project_boq_revision', $this->project_boq_revision);
            $this->cm->bindParam(':project_hadnover', $_hnd);
            $this->cm->bindParam(':projectRegion', $projectRegion);
            $this->cm->bindParam(':project_type', $project_type);


            //print_r($this->cm);
            if ($this->cm->execute()) {

                $this->response = array(
                    "msg" => "1",
                    "data" => "saved"
                );
            } else {
                $this->response = array(
                    "msg" => "0",
                    "data" => "Database Error..\n contact Developer"
                );
            }
        } else {
            $prjno = $projectinfo["project_no"];
            $this->response = array(
                "msg" => "0",
                "data" => "This Project Number '$prjno' Already Exists"
            );
        }

        return json_encode($this->response);
        exit();
    }

    public function update_project($projectinfo)
    {
        $this->sql = "UPDATE pms_project_summary set 
                    project_name=:project_name,
                    project_cname=:project_cname,
                    project_location=:project_location,
                    project_singdate=:project_singdate,
                    project_sing_description=:project_sing_description,
                    project_contract_duration=:project_contract_duration,
                    project_contract_description=:project_contract_description,
                    project_contact_person=:project_contact_person,
                    project_contact_no=:project_contact_no,
                    Sales_Representative=:Sales_Representative,
                    project_penalty=:project_penalty,
                    project_expiry_date=:project_expiry_date,
                    project_remarks=:project_remarks,
                    project_create_by=:project_create_by,
                    projectRegion = :projectRegion,
                    project_amount=:project_amount,                    
                    project_first_advance_amount=:project_first_advance_amount,
                    advance_amount_remark=:advance_amount_remark,
                    project_advacne_date=:project_advacne_date,
                    project_type = :project_type
                    where
                    project_no=:project_no";
        $this->cm = $this->cn->prepare($this->sql);
        if ($this->cm->execute($projectinfo)) {
            $this->response = array("msg" => "1", "data" => "Updated");
        } else {
            $this->response = array("msg" => "0", "data" => "Data base Error");
        }
        return json_encode($this->response);
        exit();
    }


    public function get_all_handoverprojects(){
        $project_hadnoverx = $this->enc('enc','3');
        //$this->sql = "SELECT *from pms_project_summary";
        $this->sql = "SELECT *,ct.ctqty as cutting_qty,ct.ctarea as cutting_area 
        from pms_project_summary as pj left join 
        (SELECT ctprojectno,sum(ct_qty) as ctqty,sum(ct_area) as ctarea from pms_cuttinglist where production_flag=2 group by ctprojectno) as ct 
        on pj.project_link=ct.ctprojectno where project_hadnover = '". $project_hadnoverx ."'";
        //echo $this->sql;
        $this->cm = $this->cn->prepare($this->sql);
        //$this->cm->bindParam(":project_hadnover",$project_hadnoverx);
        $this->cm->execute();
        //echo $this->cm->rowCount();
        $_projects = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            //contract date 
            $__date = $project_singdate;
            $_date = date_create($__date);
            $project_singdate = date_format($_date, 'd-m-Y');
            $project_singdate_s = date_format($_date, 'Y-m-d');
            $project_singdate_d = date_format($_date, 'd-M-Y');
            $project_singdate_p = date_format($_date, 'd-m-Y');

            //project_expiry_date
            $__date = $project_expiry_date;
            $_date = date_create($__date);
            $project_expiry_date = date_format($_date, 'd-m-Y');

            $nw_date = date('d-m-Y');
            //$status = "Initial Stage";

            $status =  $this->enc('denc', $project_status);

            //project_advacne_date
            $__date = $project_advacne_date;
            $_date = date_create($__date);
            $project_advacne_date = date_format($_date, 'd-m-Y');

            $__date = $project_handover_date;
            $_date = date_create($__date);
            $project_handover_date = date_format($_date, 'd-m-Y');
            $project_handover_date_s = date_format($_date, 'Y-m-d');
            $project_handover_date_d = date_format($_date, 'd-M-Y');
            $project_handover_date_p = date_format($_date, 'd-m-Y');

            $project_x = $this->enc('denc', $project_no);
            $ex_project = explode('/', $project_x);
            if (count($ex_project) === 1) {
            } else {
                $projectF = $ex_project[1];
                //$pt = $projectF[0];
                $ptx = $ex_project[0];
                $pt = $ptx[0];
                // echo $pt;

                // echo $pt;
                if ($pt === 'p') {
                    $projectB = explode('p', $ex_project[0]);
                } else {
                    $projectB = explode('v', $ex_project[0]);
                }
                //echo count($projectB);
                $projectBA =  $projectB[1];

                //check files is exits 

                $filelocation = "../../assets/contract/" . $project_no . ".pdf";
                $f = '0';
                if (file_exists($filelocation)) {
                    $f = '1';
                }

                $hvfilelocation = "../../assets/project/" .$project_id . ".pdf";
                $hvf = "0";
                if(file_exists($hvfilelocation)){
                    $hvf = "1";
                }

                $projectsnodisp = $projectF . "-" . $projectBA . "P";
                if ($pt === 'p') {

                    $_projects[] = array(
                        "hvf" => $hvf,
                        "cutting_qty" => is_null($cutting_qty) ? "0" : $cutting_qty,
                        "ctarea" => is_null($ctarea) ? "0" : $ctarea,
                        "project_id" => $project_id,
                        "project_no_enc" => $project_no,
                        "projectsnodisp" =>  $projectsnodisp,
                        "project_no" => $this->enc('denc', $project_no),
                        "project_name" => $this->enc('denc', $project_name),
                        "project_cname" => $this->enc('denc', $project_cname),
                        "project_location" => strtoupper($this->enc('denc', $project_location)),
                        "project_singdate" => $project_singdate,
                        "project_singdate_s" => $project_singdate_s,
                        "project_singdate_d" => $project_singdate_d,
                        "project_singdate_p" => $project_singdate_p,
                        "project_sing_description" => $this->enc('denc', $project_sing_description),
                        "project_contract_duration" => $this->enc('denc', $project_contract_duration),
                        "project_contract_description" => $this->enc('denc', $project_contract_description),
                        "project_contact_person" => $this->enc('denc', $project_contact_person),
                        "project_contact_no" => $this->enc('denc', $project_contact_no),
                        "Sales_Representative" => $this->enc('denc', $Sales_Representative),
                        "project_penalty" => $this->enc('denc', $project_penalty),
                        "project_expiry_date" => $project_expiry_date,
                        "project_remarks" => $this->enc('denc', $project_remarks),
                        "project_amount" => (float) $this->enc('denc', $project_amount),
                        "project_basicpayment" => (float) $this->enc('denc', $project_basicpayment),
                        "project_first_advance_amount" => (float) $this->enc('denc', $project_first_advance_amount),
                        "project_first_advance" => (float) $this->enc('denc', $project_first_advance),
                        "project_advacne_date" => $project_advacne_date,
                        "advance_amount_remark" => $this->enc('denc', $advance_amount_remark),
                        "project_enter_date" => $project_enter_date,
                        "project_edit_date" => $project_edit_date,
                        "project_status" => $status,
                        "project_create_by" => $this->enc('denc', $project_create_by),
                        "project_ledit_by" => $this->enc('denc', $project_ledit_by),
                        "project_boq_refno" => $this->enc('denc', $project_boq_refno),
                        "project_boq_revision" => $this->enc('denc', $project_boq_revision),
                        "project_handover_date" => $project_handover_date,
                        "project_handover_date_s" => $project_handover_date_s,
                        "project_handover_date_d" => $project_handover_date_d,
                        "project_handover_date_p" => $project_handover_date_p,
                        "project_hadnover" => $this->enc('denc', $project_hadnover),
                        "projectRegion" => $this->enc('denc', $projectRegion),
                        "project_type" => $this->enc('denc', $project_type),
                        "f" => $f,
                        'lo' => $filelocation,

                    );
                }
            }
        }
        $this->response = array("msg" => "1", "data" => $_projects);
        return json_encode($this->response);
        exit();
    }
    public function get_all_handoverprojectsv(){
        $project_hadnoverx = $this->enc('enc','3');
        //$this->sql = "SELECT *from pms_project_summary";
        $this->sql = "SELECT *,ct.ctqty as cutting_qty,ct.ctarea as cutting_area 
        from pms_project_summary as pj left join 
        (SELECT ctprojectno,sum(ct_qty) as ctqty,sum(ct_area) as ctarea from pms_cuttinglist where production_flag=2 group by ctprojectno) as ct 
        on pj.project_link=ct.ctprojectno where project_hadnover = '". $project_hadnoverx ."'";
        //echo $this->sql;
        $this->cm = $this->cn->prepare($this->sql);
        //$this->cm->bindParam(":project_hadnover",$project_hadnoverx);
        $this->cm->execute();
        //echo $this->cm->rowCount();
        $_projects = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            //contract date 
            $__date = $project_singdate;
            $_date = date_create($__date);
            $project_singdate = date_format($_date, 'd-m-Y');
            $project_singdate_s = date_format($_date, 'Y-m-d');
            $project_singdate_d = date_format($_date, 'd-M-Y');
            $project_singdate_p = date_format($_date, 'd-m-Y');

            //project_expiry_date
            $__date = $project_expiry_date;
            $_date = date_create($__date);
            $project_expiry_date = date_format($_date, 'd-m-Y');

            $nw_date = date('d-m-Y');
            //$status = "Initial Stage";

            $status =  $this->enc('denc', $project_status);

            //project_advacne_date
            $__date = $project_advacne_date;
            $_date = date_create($__date);
            $project_advacne_date = date_format($_date, 'd-m-Y');

            $__date = $project_handover_date;
            $_date = date_create($__date);
            $project_handover_date = date_format($_date, 'd-m-Y');
            $project_handover_date_s = date_format($_date, 'Y-m-d');
            $project_handover_date_d = date_format($_date, 'd-M-Y');
            $project_handover_date_p = date_format($_date, 'd-m-Y');

            $project_x = $this->enc('denc', $project_no);
            $ex_project = explode('/', $project_x);
            if (count($ex_project) === 1) {
            } else {
                $projectF = $ex_project[1];
                //$pt = $projectF[0];
                $ptx = $ex_project[0];
                $pt = $ptx[0];
                // echo $pt;

                // echo $pt;
                if ($pt === 'p') {
                    $projectB = explode('p', $ex_project[0]);
                } else {
                    $projectB = explode('v', $ex_project[0]);
                }
                //echo count($projectB);
                $projectBA =  $projectB[1];

                //check files is exits 
                $hvfilelocation = "../../assets/project/" .$project_id . ".pdf";
                $hvf = "0";
                if(file_exists($hvfilelocation)){
                    $hvf = "1";
                }
                $filelocation = "../../assets/contract/" . $project_no . ".pdf";
                $f = '0';
                if (file_exists($filelocation)) {
                    $f = '1';
                }

                $projectsnodisp = $projectF . "-" . $projectBA . "P";
                if ($pt === 'v') {

                    $_projects[] = array(
                        "hvf" => $hvf,
                        "cutting_qty" => is_null($cutting_qty) ? "0" : $cutting_qty,
                        "ctarea" => is_null($ctarea) ? "0" : $ctarea,
                        "project_id" => $project_id,
                        "project_no_enc" => $project_no,
                        "projectsnodisp" =>  $projectsnodisp,
                        "project_no" => $this->enc('denc', $project_no),
                        "project_name" => $this->enc('denc', $project_name),
                        "project_cname" => $this->enc('denc', $project_cname),
                        "project_location" => strtoupper($this->enc('denc', $project_location)),
                        "project_singdate" => $project_singdate,
                        "project_singdate_s" => $project_singdate_s,
                        "project_singdate_d" => $project_singdate_d,
                        "project_singdate_p" => $project_singdate_p,
                        "project_sing_description" => $this->enc('denc', $project_sing_description),
                        "project_contract_duration" => $this->enc('denc', $project_contract_duration),
                        "project_contract_description" => $this->enc('denc', $project_contract_description),
                        "project_contact_person" => $this->enc('denc', $project_contact_person),
                        "project_contact_no" => $this->enc('denc', $project_contact_no),
                        "Sales_Representative" => $this->enc('denc', $Sales_Representative),
                        "project_penalty" => $this->enc('denc', $project_penalty),
                        "project_expiry_date" => $project_expiry_date,
                        "project_remarks" => $this->enc('denc', $project_remarks),
                        "project_amount" => (float) $this->enc('denc', $project_amount),
                        "project_basicpayment" => (float) $this->enc('denc', $project_basicpayment),
                        "project_first_advance_amount" => (float) $this->enc('denc', $project_first_advance_amount),
                        "project_first_advance" => (float) $this->enc('denc', $project_first_advance),
                        "project_advacne_date" => $project_advacne_date,
                        "advance_amount_remark" => $this->enc('denc', $advance_amount_remark),
                        "project_enter_date" => $project_enter_date,
                        "project_edit_date" => $project_edit_date,
                        "project_status" => $status,
                        "project_create_by" => $this->enc('denc', $project_create_by),
                        "project_ledit_by" => $this->enc('denc', $project_ledit_by),
                        "project_boq_refno" => $this->enc('denc', $project_boq_refno),
                        "project_boq_revision" => $this->enc('denc', $project_boq_revision),
                        "project_handover_date" => $project_handover_date,
                        "project_handover_date_s" => $project_handover_date_s,
                        "project_handover_date_d" => $project_handover_date_d,
                        "project_handover_date_p" => $project_handover_date_p,
                        "project_hadnover" => $this->enc('denc', $project_hadnover),
                        "projectRegion" => $this->enc('denc', $projectRegion),
                        "project_type" => $this->enc('denc', $project_type),
                        "f" => $f,
                        'lo' => $filelocation,

                    );
                }
            }
        }
        $this->response = array("msg" => "1", "data" => $_projects);
        return json_encode($this->response);
        exit();
    }

    public function get_all_projects()
    {
        $project_hadnoverx = $this->enc('enc','3');
        //$this->sql = "SELECT *from pms_project_summary";
        $this->sql = "SELECT *,ct.ctqty as cutting_qty,ct.ctarea as cutting_area 
        from pms_project_summary as pj left join 
        (SELECT ctprojectno,sum(ct_qty) as ctqty,sum(ct_area) as ctarea from pms_cuttinglist where production_flag=2 group by ctprojectno) as ct 
        on pj.project_link=ct.ctprojectno where project_hadnover <> '". $project_hadnoverx ."'";
        //echo $this->sql;
        $this->cm = $this->cn->prepare($this->sql);
        //$this->cm->bindParam(":project_hadnover",$project_hadnoverx);
        $this->cm->execute();
        //echo $this->cm->rowCount();
        $_projects = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            //contract date 
            $__date = $project_singdate;
            $_date = date_create($__date);
            $project_singdate = date_format($_date, 'd-m-Y');
            $project_singdate_s = date_format($_date, 'Y-m-d');
            $project_singdate_d = date_format($_date, 'd-M-Y');
            $project_singdate_p = date_format($_date, 'd-m-Y');

            //project_expiry_date
            $__date = $project_expiry_date;
            $_date = date_create($__date);
            $project_expiry_date = date_format($_date, 'd-m-Y');

            $nw_date = date('d-m-Y');
            //$status = "Initial Stage";

            $status =  $this->enc('denc', $project_status);

            //project_advacne_date
            $__date = $project_advacne_date;
            $_date = date_create($__date);
            $project_advacne_date = date_format($_date, 'd-m-Y');

            $__date = $project_handover_date;
            $_date = date_create($__date);
            $project_handover_date = date_format($_date, 'd-m-Y');
            $project_handover_date_s = date_format($_date, 'Y-m-d');
            $project_handover_date_d = date_format($_date, 'd-M-Y');
            $project_handover_date_p = date_format($_date, 'd-m-Y');

            $project_x = $this->enc('denc', $project_no);
            $ex_project = explode('/', $project_x);
            if (count($ex_project) === 1) {
            } else {
                $projectF = $ex_project[1];
                //$pt = $projectF[0];
                $ptx = $ex_project[0];
                $pt = $ptx[0];
                // echo $pt;

                // echo $pt;
                if ($pt === 'p') {
                    $projectB = explode('p', $ex_project[0]);
                } else {
                    $projectB = explode('v', $ex_project[0]);
                }
                //echo count($projectB);
                $projectBA =  $projectB[1];

                //check files is exits 

                $filelocation = "../../assets/contract/" . $project_no . ".pdf";
                $f = '0';
                if (file_exists($filelocation)) {
                    $f = '1';
                }

                $projectsnodisp = $projectF . "-" . $projectBA . "P";
                if ($pt === 'p') {

                    $_projects[] = array(
                        "cutting_qty" => is_null($cutting_qty) ? "0" : $cutting_qty,
                        "ctarea" => is_null($ctarea) ? "0" : $ctarea,
                        "project_id" => $project_id,
                        "project_no_enc" => $project_no,
                        "projectsnodisp" =>  $projectsnodisp,
                        "project_no" => $this->enc('denc', $project_no),
                        "project_name" => $this->enc('denc', $project_name),
                        "project_cname" => $this->enc('denc', $project_cname),
                        "project_location" => strtoupper($this->enc('denc', $project_location)),
                        "project_singdate" => $project_singdate,
                        "project_singdate_s" => $project_singdate_s,
                        "project_singdate_d" => $project_singdate_d,
                        "project_singdate_p" => $project_singdate_p,
                        "project_sing_description" => $this->enc('denc', $project_sing_description),
                        "project_contract_duration" => $this->enc('denc', $project_contract_duration),
                        "project_contract_description" => $this->enc('denc', $project_contract_description),
                        "project_contact_person" => $this->enc('denc', $project_contact_person),
                        "project_contact_no" => $this->enc('denc', $project_contact_no),
                        "Sales_Representative" => $this->enc('denc', $Sales_Representative),
                        "project_penalty" => $this->enc('denc', $project_penalty),
                        "project_expiry_date" => $project_expiry_date,
                        "project_remarks" => $this->enc('denc', $project_remarks),
                        "project_amount" => (float) $this->enc('denc', $project_amount),
                        "project_basicpayment" => (float) $this->enc('denc', $project_basicpayment),
                        "project_first_advance_amount" => (float) $this->enc('denc', $project_first_advance_amount),
                        "project_first_advance" => (float) $this->enc('denc', $project_first_advance),
                        "project_advacne_date" => $project_advacne_date,
                        "advance_amount_remark" => $this->enc('denc', $advance_amount_remark),
                        "project_enter_date" => $project_enter_date,
                        "project_edit_date" => $project_edit_date,
                        "project_status" => $status,
                        "project_create_by" => $this->enc('denc', $project_create_by),
                        "project_ledit_by" => $this->enc('denc', $project_ledit_by),
                        "project_boq_refno" => $this->enc('denc', $project_boq_refno),
                        "project_boq_revision" => $this->enc('denc', $project_boq_revision),
                        "project_handover_date" => $project_handover_date,
                        "project_handover_date_s" => $project_handover_date_s,
                        "project_handover_date_d" => $project_handover_date_d,
                        "project_handover_date_p" => $project_handover_date_p,
                        "project_hadnover" => $this->enc('denc', $project_hadnover),
                        "projectRegion" => $this->enc('denc', $projectRegion),
                        "project_type" => $this->enc('denc', $project_type),
                        "f" => $f,
                        'lo' => $filelocation,

                    );
                }
            }
        }
        $this->response = array("msg" => "1", "data" => $_projects);
        return json_encode($this->response);
        exit();
    }

    public function getAllProjectlist()
    {
        $this->sql = "select *from $this->pms_project_summary";
        //echo $this->sql;
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        //echo $this->cm->rowCount();
        $_projects = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            //contract date 
            $__date = $project_singdate;
            $_date = date_create($__date);
            $project_singdate = date_format($_date, 'd-m-Y');
            $project_singdate_s = date_format($_date, 'Y-m-d');
            $project_singdate_d = date_format($_date, 'd-M-Y');
            $project_singdate_p = date_format($_date, 'd-m-Y');

            //project_expiry_date
            $__date = $project_expiry_date;
            $_date = date_create($__date);
            $project_expiry_date = date_format($_date, 'd-m-Y');

            $nw_date = date('d-m-Y');
            //$status = "Initial Stage";

            $status =  $this->enc('denc', $project_status);

            //project_advacne_date
            $__date = $project_advacne_date;
            $_date = date_create($__date);
            $project_advacne_date = date_format($_date, 'd-m-Y');

            $__date = $project_handover_date;
            $_date = date_create($__date);
            $project_handover_date = date_format($_date, 'd-m-Y');
            $project_handover_date_s = date_format($_date, 'Y-m-d');
            $project_handover_date_d = date_format($_date, 'd-M-Y');
            $project_handover_date_p = date_format($_date, 'd-m-Y');

            $project_x = $this->enc('denc', $project_no);
            $ex_project = explode('/', $project_x);
            if (count($ex_project) === 1) {
            } else {
                $projectF = $ex_project[1];
                //$pt = $projectF[0];
                $ptx = $ex_project[0];
                $pt = $ptx[0];
                // echo $pt;

                // echo $pt;
                if ($pt === 'p') {
                    $projectB = explode('p', $ex_project[0]);
                } else {
                    $projectB = explode('v', $ex_project[0]);
                }
                //echo count($projectB);
                $projectBA =  $projectB[1];

                //check files is exits 

                $filelocation = "../../assets/contract/" . $project_no . ".pdf";
                $f = '0';
                if (file_exists($filelocation)) {
                    $f = '1';
                }

                $projectsnodisp = $projectF . "-" . $projectBA . "P";
                $_projects[] = array(
                    "project_id" => $project_id,
                    "project_no_enc" => $project_no,
                    "projectsnodisp" =>  $projectsnodisp,
                    "project_no" => $this->enc('denc', $project_no),
                    "project_name" => $this->enc('denc', $project_name),
                    "project_cname" => $this->enc('denc', $project_cname),
                    "project_location" => strtoupper($this->enc('denc', $project_location)),
                    "project_singdate" => $project_singdate,
                    "project_singdate_s" => $project_singdate_s,
                    "project_singdate_d" => $project_singdate_d,
                    "project_singdate_p" => $project_singdate_p,
                    "project_sing_description" => $this->enc('denc', $project_sing_description),
                    "project_contract_duration" => $this->enc('denc', $project_contract_duration),
                    "project_contract_description" => $this->enc('denc', $project_contract_description),
                    "project_contact_person" => $this->enc('denc', $project_contact_person),
                    "project_contact_no" => $this->enc('denc', $project_contact_no),
                    "Sales_Representative" => $this->enc('denc', $Sales_Representative),
                    "project_penalty" => $this->enc('denc', $project_penalty),
                    "project_expiry_date" => $project_expiry_date,
                    "project_remarks" => $this->enc('denc', $project_remarks),
                    "project_amount" => (float) $this->enc('denc', $project_amount),
                    "project_basicpayment" => (float) $this->enc('denc', $project_basicpayment),
                    "project_first_advance_amount" => (float) $this->enc('denc', $project_first_advance_amount),
                    "project_first_advance" => (float) $this->enc('denc', $project_first_advance),
                    "project_advacne_date" => $project_advacne_date,
                    "advance_amount_remark" => $this->enc('denc', $advance_amount_remark),
                    "project_enter_date" => $project_enter_date,
                    "project_edit_date" => $project_edit_date,
                    "project_status" => $status,
                    "project_create_by" => $this->enc('denc', $project_create_by),
                    "project_ledit_by" => $this->enc('denc', $project_ledit_by),
                    "project_boq_refno" => $this->enc('denc', $project_boq_refno),
                    "project_boq_revision" => $this->enc('denc', $project_boq_revision),
                    "project_handover_date" => $project_handover_date,
                    "project_handover_date_s" => $project_handover_date_s,
                    "project_handover_date_d" => $project_handover_date_d,
                    "project_handover_date_p" => $project_handover_date_p,
                    "project_hadnover" => $this->enc('denc', $project_hadnover),
                    "projectRegion" => $this->enc('denc', $projectRegion),
                    "project_type" => $this->enc('denc', $project_type),
                    "f" => $f,
                    'lo' => $filelocation,
                );
            }
        }
        $this->response = array("msg" => "1", "data" => $_projects);
        return json_encode($this->response);
        exit();
    }

    public function get_allv_projects()
    {
        $project_hadnoverx = $this->enc('enc','3');
        $this->sql = "SELECT *,ct.ctqty as cutting_qty,ct.ctarea as cutting_area 
        from pms_project_summary as pj left join 
        (SELECT ctprojectno,sum(ct_qty) as ctqty,sum(ct_area) as ctarea from pms_cuttinglist where production_flag=2 group by ctprojectno) as ct 
        on pj.project_link=ct.ctprojectno where project_hadnover <> '". $project_hadnoverx ."'";
        //echo $this->sql;
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        //echo $this->cm->rowCount();
        $_projects = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            //contract date 
            $__date = $project_singdate;
            $_date = date_create($__date);
            $project_singdate = date_format($_date, 'd-m-Y');
            $project_singdate_s = date_format($_date, 'Y-m-d');
            $project_singdate_d = date_format($_date, 'd-M-Y');
            $project_singdate_p = date_format($_date, 'd-m-Y');

            //project_expiry_date
            $__date = $project_expiry_date;
            $_date = date_create($__date);
            $project_expiry_date = date_format($_date, 'd-m-Y');

            $nw_date = date('d-m-Y');
            //$status = "Initial Stage";

            $status =  $this->enc('denc', $project_status);

            //project_advacne_date
            $__date = $project_advacne_date;
            $_date = date_create($__date);
            $project_advacne_date = date_format($_date, 'd-m-Y');

            $__date = $project_handover_date;
            $_date = date_create($__date);
            $project_handover_date = date_format($_date, 'd-m-Y');
            $project_handover_date_s = date_format($_date, 'Y-m-d');
            $project_handover_date_d = date_format($_date, 'd-M-Y');
            $project_handover_date_p = date_format($_date, 'd-m-Y');

            $project_x = $this->enc('denc', $project_no);
            $ex_project = explode('/', $project_x);
            if (count($ex_project) === 1) {
            } else {
                $projectF = $ex_project[1];
                //$pt = $projectF[0];
                $ptx = $ex_project[0];
                $pt = $ptx[0];
                // echo $pt;

                // echo $pt;
                if ($pt === 'p') {
                    $projectB = explode('p', $ex_project[0]);
                } else {
                    $projectB = explode('v', $ex_project[0]);
                }
                //echo count($projectB);
                $projectBA =  $projectB[1];

                //check files is exits 

                $filelocation = "../../assets/contract/" . $project_no . ".pdf";
                $f = '0';
                if (file_exists($filelocation)) {
                    $f = '1';
                }

                $projectsnodisp = $projectF . "-" . $projectBA . "P";
                if ($pt === 'v') {

                    $_projects[] = array(
                        "cutting_qty" => is_null($cutting_qty) ? "0" : $cutting_qty,
                        "ctarea" => is_null($ctarea) ? "0" : $ctarea,
                        "project_id" => $project_id,
                        "project_no_enc" => $project_no,
                        "projectsnodisp" =>  $projectsnodisp,
                        "project_no" => $this->enc('denc', $project_no),
                        "project_name" => $this->enc('denc', $project_name),
                        "project_cname" => $this->enc('denc', $project_cname),
                        "project_location" => strtoupper($this->enc('denc', $project_location)),
                        "project_singdate" => $project_singdate,
                        "project_singdate_s" => $project_singdate_s,
                        "project_singdate_d" => $project_singdate_d,
                        "project_singdate_p" => $project_singdate_p,
                        "project_sing_description" => $this->enc('denc', $project_sing_description),
                        "project_contract_duration" => $this->enc('denc', $project_contract_duration),
                        "project_contract_description" => $this->enc('denc', $project_contract_description),
                        "project_contact_person" => $this->enc('denc', $project_contact_person),
                        "project_contact_no" => $this->enc('denc', $project_contact_no),
                        "Sales_Representative" => $this->enc('denc', $Sales_Representative),
                        "project_penalty" => $this->enc('denc', $project_penalty),
                        "project_expiry_date" => $project_expiry_date,
                        "project_remarks" => $this->enc('denc', $project_remarks),
                        "project_amount" => (float) $this->enc('denc', $project_amount),
                        "project_basicpayment" => (float) $this->enc('denc', $project_basicpayment),
                        "project_first_advance_amount" => (float) $this->enc('denc', $project_first_advance_amount),
                        "project_first_advance" => (float) $this->enc('denc', $project_first_advance),
                        "project_advacne_date" => $project_advacne_date,
                        "advance_amount_remark" => $this->enc('denc', $advance_amount_remark),
                        "project_enter_date" => $project_enter_date,
                        "project_edit_date" => $project_edit_date,
                        "project_status" => $status,
                        "project_create_by" => $this->enc('denc', $project_create_by),
                        "project_ledit_by" => $this->enc('denc', $project_ledit_by),
                        "project_boq_refno" => $this->enc('denc', $project_boq_refno),
                        "project_boq_revision" => $this->enc('denc', $project_boq_revision),
                        "project_handover_date" => $project_handover_date,
                        "project_handover_date_s" => $project_handover_date_s,
                        "project_handover_date_d" => $project_handover_date_d,
                        "project_handover_date_p" => $project_handover_date_p,
                        "project_hadnover" => $this->enc('denc', $project_hadnover),
                        "projectRegion" => $this->enc('denc', $projectRegion),
                        "project_type" => $this->enc('denc', $project_type),
                        "f" => $f,
                        'lo' => $filelocation,

                    );
                }
            }
        }
        $this->response = array("msg" => "1", "data" => $_projects);
        return json_encode($this->response);
        exit();
    }

    public function getProjectinfo($project_no)
    {
        $this->project_no = $this->enc('enc', $project_no);
        $this->sql = "select *from $this->pms_project_summary where project_no=:project_no";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":project_no", $this->project_no);
        $this->cm->execute();
        if ($this->cm->rowCount() === 1) {
            $this->rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            extract($this->rows);
            //contract date 
            $__date = $project_singdate;
            $_date = date_create($__date);
            $project_singdate = date_format($_date, 'd-m-Y');

            //project_expiry_date
            $__date = $project_expiry_date;
            $_date = date_create($__date);
            $project_expiry_date = date_format($_date, 'd-m-Y');

            $nw_date = date('d-m-Y');
            $status = "Initial Stage";

            $status =  $this->enc('denc', $project_status);

            //project_advacne_date
            $__date = $project_advacne_date;
            $_date = date_create($__date);
            $project_advacne_date = date_format($_date, 'd-m-Y');

            $__date = $project_handover_date;
            $_date = date_create($__date);
            $project_handover_date = date_format($_date, 'd-m-Y');
            $filelocation = "../../assets/contract/" . $project_no . ".pdf";
            $f = '0';
            if (file_exists($filelocation)) {
                $f = '1';
            }
            $_projects = array(
                "project_id" => $project_id,
                "project_no_enc" => $project_no,
                "project_no" => strtoupper($this->enc('denc', $project_no)),
                "project_name" => $this->enc('denc', $project_name),
                "project_cname" => $this->enc('denc', $project_cname),
                "project_location" => $this->enc('denc', $project_location),
                "project_singdate" => $project_singdate,
                "project_sing_description" => $this->enc('denc', $project_sing_description),
                "project_contract_duration" => (int) $this->enc('denc', $project_contract_duration),
                "project_contract_description" => $this->enc('denc', $project_contract_description),
                "project_contact_person" => $this->enc('denc', $project_contact_person),
                "project_contact_no" => $this->enc('denc', $project_contact_no),
                "Sales_Representative" => $this->enc('denc', $Sales_Representative),
                "project_penalty" => $this->enc('denc', $project_penalty),
                "project_expiry_date" => $project_expiry_date,
                "project_remarks" => $this->enc('denc', $project_remarks),
                "project_amount" => (float) $this->enc('denc', $project_amount),
                "project_basicpayment" => (float) $this->enc('denc', $project_basicpayment),
                "project_first_advance_amount" => (float) $this->enc('denc', $project_first_advance_amount),
                "project_first_advance" => (float) $this->enc('denc', $project_first_advance),
                "project_advacne_date" => $project_advacne_date,
                "advance_amount_remark" => $this->enc('denc', $advance_amount_remark),
                "project_enter_date" => $project_enter_date,
                "project_edit_date" => $project_edit_date,
                "project_status" => $status,
                "project_boq_refno" => $this->enc('denc', $project_boq_refno),
                "project_boq_revision" => $this->enc('denc', $project_boq_revision),
                "project_create_by" => $this->enc('denc', $project_create_by),
                "project_ledit_by" => $this->enc('denc', $project_ledit_by),
                "project_handover_date" => $project_handover_date,
                "project_hadnover" => $this->enc('denc', $project_hadnover),
                "projectRegion" => $this->enc('denc', $projectRegion),
                "project_type" => $this->enc('denc', $project_type),
                "f" => $f,
                'lo' => $filelocation,
            );
            $this->response = array("msg" => "1", "data" => $_projects);
        } else {
            $this->response = array("msg" => "0", "data" => "This Project Number Not Found");
        }
        return json_encode($this->response);
        exit();
    }

    public function get_terms($project_id)
    {
        $this->payment_terms_project = $this->enc('enc', $project_id);
        $this->sql = "select *from $this->project_payment_terms where payment_terms_project = :payment_terms_project";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":payment_terms_project", $this->payment_terms_project);
        $this->cm->execute();
        $_terms = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $number = "-";
            if ($payment_terms_number === '') {
                $number = '-';
            } else {
                $number = $this->enc('denc', $payment_terms_number);
            }
            $_terms[] = array(
                "payment_terms_id" => $payment_terms_id,
                "payment_terms_descripton" => $this->enc('denc', $payment_terms_descripton),
                "payment_terms_project" => $this->enc('denc', $payment_terms_project),
                "payment_terms_number" => $number,
            );
        }
        $this->response = array("msg" => "1", "data" => $_terms);
        return json_encode($this->response);
        exit();
    }
    public function terms_save($termsname, $projectname, $number)
    {
        $this->payment_terms_project = $this->enc('enc', $projectname);
        $this->payment_terms_descripton = $this->enc('enc', $termsname);
        $this->payment_terms_number = $this->enc('enc', $number);
        $_sql = "insert into $this->project_payment_terms values(
                null,
                :payment_terms_descripton,
                :payment_terms_project,
                :payment_terms_number
            )";
        $cm = $this->cn->prepare($_sql);
        $cm->bindParam(":payment_terms_descripton", $this->payment_terms_descripton);
        $cm->bindParam(":payment_terms_project", $this->payment_terms_project);
        $cm->bindParam(":payment_terms_number", $this->payment_terms_number);
        if ($cm->execute()) {
            $this->response = array("msg" => "1", "data" => "Saved");
        } else {
            $this->response = array("msg" => "0", "data" => "#_DB ERROR");
        }
        return json_encode($this->response);
        exit();
    }
    public function terms_edit($terms, $number, $id)
    {
        $this->payment_terms_descripton = $this->enc('enc', $terms);
        $this->payment_terms_number = $this->enc('enc', $number);
        $this->payment_terms_id = $id;
        $this->sql = "UPDATE project_payment_terms set 
                        payment_terms_descripton=:payment_terms_descripton,
                        payment_terms_number=:payment_terms_number where
                        payment_terms_id=:payment_terms_id";
        $this->cm = $this->cn->prepare($this->sql);
        $_param = array(
            ":payment_terms_descripton" => $this->payment_terms_descripton,
            ":payment_terms_number" => $this->payment_terms_number,
            ":payment_terms_id" => $this->payment_terms_id,
        );
        if ($this->cm->execute($_param)) {
            $this->response = array("msg" => "1", "data" => "Updated");
        } else {
            $this->response = array("msg" => "0", "data" => "#_DB ERROR");
        }
        return json_encode($this->response);
        exit();
    }
    public function terms_delete($termsid, $projectname)
    {
        $this->payment_terms_id = $termsid;
        $this->payment_terms_project = $this->enc('enc', $projectname);
        $this->sql = "delete from $this->project_payment_terms where payment_terms_id=:payment_terms_id and payment_terms_project=:payment_terms_project";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":payment_terms_id", $this->payment_terms_id);
        $this->cm->bindParam(":payment_terms_project", $this->payment_terms_project);
        if ($this->cm->execute()) {
            $this->response = array("msg" => "1", "data" => "Removed");
        } else {
            $this->response = array("msg" => "0", "data" => "#_DB ERROR");
        }
        return json_encode($this->response);
        exit();
    }

    public function get_conditions($project_id)
    {
        $this->project_conditions_project = $this->enc('enc', $project_id);
        $this->sql = "select *from $this->project_conditions where project_conditions_project = :project_conditions_project";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":project_conditions_project", $this->project_conditions_project);
        $this->cm->execute();
        $_conditions = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $numbers = '-';

            if ($project_conditions_number === '') {
                $numbers = '-';
            } else {
                $numbers = $this->enc('denc', $project_conditions_number);
            }
            $_conditions[] = array(
                "project_conditions_id" => $project_conditions_id,
                "project_conditions_remark" => $this->enc('denc', $project_conditions_remark),
                "project_conditions_project" => $this->enc('denc', $project_conditions_project),
                "project_conditions_number" => $numbers
            );
        }
        $this->response = array("msg" => "1", "data" => $_conditions);
        return json_encode($this->response);
        exit();
    }
    public function condition_add($condition, $projectname, $numbers)
    {
        $this->project_conditions_remark = $this->enc('enc', $condition);
        $this->project_conditions_project = $this->enc('enc', $projectname);
        $this->project_conditions_number = $this->enc('enc', $numbers);
        $this->sql = "insert into $this->project_conditions values(
                null,
                :project_conditions_remark,
                :project_conditions_project,
                :project_conditions_number
            )";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":project_conditions_remark", $this->project_conditions_remark);
        $this->cm->bindParam(":project_conditions_project", $this->project_conditions_project);
        $this->cm->bindParam(":project_conditions_number", $this->project_conditions_number);
        if ($this->cm->execute()) {
            $this->response = array("msg" => "1", "data" => "Saved....");
        } else {
            $this->response = array("msg" => "0", "data" => "DB ERROR");
        }
        return json_encode($this->response);
        exit();
    }
    public function condition_Edit($id, $condition, $numbers)
    {
        $project_conditions_id = $id;
        $this->project_conditions_remark = $this->enc('enc', $condition);
        $this->project_conditions_number = $this->enc('enc', $numbers);
        $this->sql = "UPDATE $this->project_conditions set project_conditions_remark=:project_conditions_remark,
                        project_conditions_number=:project_conditions_number 
                        where 
                        project_conditions_id=:project_conditions_id";
        $this->cm = $this->cn->prepare($this->sql);
        $_parms = array(
            ":project_conditions_remark" => $this->project_conditions_remark,
            ":project_conditions_number" => $this->project_conditions_number,
            ":project_conditions_id" => $project_conditions_id
        );
        if ($this->cm->execute($_parms)) {
            $this->response = array("msg" => "1", "data" => "Saved....");
        } else {
            $this->response = array("msg" => "0", "data" => "DB ERROR");
        }
        return json_encode($this->response);
        exit();
    }
    public function conditions_remove($conditionid, $projectname)
    {
        $this->project_conditions_id = $conditionid;
        $this->project_conditions_project = $this->enc('enc', $projectname);
        $this->sql = "DELETE FROM $this->project_conditions 
            where 
            project_conditions_id=:project_conditions_id 
            and 
            project_conditions_project=:project_conditions_project";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":project_conditions_id", $this->project_conditions_id);
        $this->cm->bindParam(":project_conditions_project", $this->project_conditions_project);
        if ($this->cm->execute()) {
            $this->response = array("msg" => "1", "data" => "Removed....");
        } else {
            $this->response = array("msg" => "0", "data" => "DB Error");
        }
        return json_encode($this->response);
        exit();
    }

    public function get_all_spc($project_id)
    {
        $this->spec_project = $this->enc('enc', $project_id);
        $this->sql = "select *from $this->pms_project_specification where spec_project = :spec_project";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":spec_project", $this->spec_project);
        $this->cm->execute();
        $_aluminium = [];
        $_finish = [];
        //$_glass_double = [];
        //$_glass_spaidrel = [];
        $_hardware = [];

        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $_type = $this->enc('denc', $spec_type);
            switch ($_type) {
                case 'aluminium':
                    $_aluminium[] = array(
                        "spec_id" => $spec_id,
                        "spec_remark" => $this->enc('denc', $spec_remark)
                    );
                    break;
                case 'finish':
                    $_finish[] = array(
                        "spec_id" => $spec_id,
                        "spec_remark" => $this->enc('denc', $spec_remark)
                    );
                    break;
                case 'hardware':
                    $_hardware[] = array("spec_id" => $spec_id, "spec_remark" => $this->enc('denc', $spec_remark));
                    break;
            }
        }

        $_glass = [];
        $this->spec_project = $this->enc('enc', $project_id);
        $this->sql = "SELECT * FROM $this->pms_project_specification where spec_project = :spec_project and spec_type=:spec_type order by spec_type_sub asc";
        $_type = 'a2RTdnBIdzFNQU1WaVEvaUZJWkRKdz09';
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":spec_project", $this->spec_project);
        $this->cm->bindParam(":spec_type", $_type);
        $this->cm->execute();
        $_glass = array();
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $_glass[] = array(
                "spec_id" => $spec_id,
                "spec_type_sub" => $this->enc('denc', $spec_type_sub),
                "spec_remark" => $this->enc('denc', $spec_remark)
            );
        }

        $_spec = array(
            "_aluminium" => $_aluminium,
            "_finish" => $_finish,
            "_hardware" => $_hardware,
            "_glass" => $_glass
        );

        $this->response = array("msg" => "1", "data" => $_spec);
        return json_encode($this->response);
        exit();
        // spec_id
        // spec_project
        // spec_remark
        // spec_type
        // spec_type_sub
    }

    public function get_glass_spces($project_id)
    {

        //echo json_encode($_res);        
    }

    public function new_specification($specifiction_info)
    {
        $this->spec_project = $this->enc('enc', $specifiction_info["spec_project"]);
        $this->spec_remark = $this->enc('enc', $specifiction_info["spec_remark"]);
        $this->spec_type = $this->enc('enc', $specifiction_info["spec_type"]);
        $this->spec_type_sub = $this->enc('enc', $specifiction_info["spec_type_sub"]);

        $this->sql = "insert into $this->pms_project_specification values(
                null,                
                :spec_project,
                :spec_remark,
                :spec_type,
                :spec_type_sub
            )";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":spec_project", $this->spec_project);
        $this->cm->bindParam(":spec_remark", $this->spec_remark);
        $this->cm->bindParam(":spec_type", $this->spec_type);
        $this->cm->bindParam(":spec_type_sub", $this->spec_type_sub);

        if ($this->cm->execute()) {
            $this->response = array("msg" => "1", "Saved");
        } else {
            $this->response = array("msg" => "1", "DB Error");
        }
        return json_encode($this->response);
        exit();
    }

    public function remove_specification($project_id, $specificationid)
    {
        $this->spec_project = $this->enc('enc', $project_id);
        $this->spec_id = $specificationid;
        $this->sql = "delete from $this->pms_project_specification where spec_project=:spec_project and spec_id=:spec_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":spec_project", $this->spec_project);
        $this->cm->bindParam(":spec_id", $this->spec_id);
        if ($this->cm->execute()) {
            $this->response = array("msg" => "1", "Removed");
        } else {
            $this->response = array("msg" => "0", "DB Error");
        }
        return json_encode($this->response);
        exit();
    }

    public function update_specification($project_id, $project_name, $remark)
    {
        $this->spec_id = $project_id;
        $this->spec_project = $this->enc('enc', $project_name);
        $this->spec_remark = $this->enc('enc', $remark);

        $this->sql = "update $this->pms_project_specification set spec_remark=:spec_remark 
            where 
            spec_project = :spec_project 
            and 
            spec_id = :spec_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":spec_remark", $this->spec_remark);
        $this->cm->bindParam(":spec_project", $this->spec_project);
        $this->cm->bindParam(":spec_id", $this->spec_id);

        if ($this->cm->execute()) {
            $this->response = array("msg" => "1", "Updated");
        } else {
            $this->response = array("msg" => "0", "#_Error");
        }
        return json_encode($this->response);
        exit();
    }

    public function new_boq($boq_info)
    {
        $this->poq_item_no = $this->enc('enc', $boq_info['poq_item_no']);
        $this->boq_refno = $this->enc('enc', $boq_info['boq_refno']);
        $this->boq_reviewno = $this->enc('enc', $boq_info['boq_reviewno']);
        $this->poq_project_code = $this->enc('enc', $boq_info['poq_project_code']);
        $sv = true;
        $dub = false;
        $this->sql = "SELECT *from $this->pms_poq 
            where 
            poq_item_no=:poq_item_no 
            and 
            boq_refno = :boq_refno 
            and 
            boq_reviewno = :boq_reviewno 
            and 
            poq_project_code = :poq_project_code
            ";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":poq_item_no", $this->poq_item_no);
        $this->cm->bindParam(":boq_refno", $this->boq_refno);
        $this->cm->bindParam(":boq_reviewno", $this->boq_reviewno);
        $this->cm->bindParam(":poq_project_code", $this->poq_project_code);
        $this->cm->execute();
        if ($this->cm->rowCount() === 0) {
            $dub = true;
        }
        $this->cm->execute();
        if ($sv === true) {
            if ($dub === true) {

                $this->poq_item_type = $boq_info['poq_item_type'];
                $this->poq_item_remark = $this->enc('enc', $boq_info['poq_item_remark']);
                $this->poq_item_width = $this->enc('enc', $boq_info['poq_item_width']);
                $this->poq_item_height = $this->enc('enc', $boq_info['poq_item_height']);
                $this->poq_item_glass_spec = $this->enc('enc', $boq_info['poq_item_glass_spec']);
                $this->poq_item_glass_single = $this->enc('enc', $boq_info['poq_item_glass_single']);
                $this->poq_item_glass_double1 = $this->enc('enc', $boq_info['poq_item_glass_double1']);
                $this->poq_item_glass_double2 = $this->enc('enc', $boq_info['poq_item_glass_double2']);
                $this->poq_item_glass_double3 = $this->enc('enc', $boq_info['poq_item_glass_double3']);
                $this->poq_item_glass_laminate1 = $this->enc('enc', $boq_info['poq_item_glass_laminate1']);
                $this->poq_item_glass_laminate2 = $this->enc('enc', $boq_info['poq_item_glass_laminate2']);
                $this->poq_drawing = $this->enc('enc', $boq_info['poq_drawing']);
                $this->poq_finish = $boq_info['poq_finish'];
                $this->poq_system_type = $boq_info['poq_system_type'];
                $this->poq_qty = $this->enc('enc', $boq_info['poq_qty']);
                $this->poq_unit = $boq_info['poq_unit'];
                $this->poq_uprice = $this->enc('enc', $boq_info['poq_uprice']);
                $this->poq_remark = $this->enc('enc', $boq_info['poq_remark']);
                $this->poq_cby = $this->enc('enc', $boq_info['poq_cby']);
                $this->poq_eby = $this->enc('enc', $boq_info['poq_eby']);
                $this->poq_Cdate = $this->enc('enc', $boq_info['poq_Cdate']);
                $this->poq_Edate = $this->enc('enc', $boq_info['poq_Edate']);

                $this->poq_status = $this->enc('enc', $boq_info['poq_status']);
                $this->boq_area = $this->enc('enc', $boq_info['boq_area']);


                $this->sql = "INSERT INTO $this->pms_poq values(
                        null,
                        :poq_item_no,
                        :poq_item_type,
                        :poq_item_remark,
                        :poq_item_width,
                        :poq_item_height,
                        :poq_item_glass_spec,
                        :poq_item_glass_single,
                        :poq_item_glass_double1,
                        :poq_item_glass_double2,
                        :poq_item_glass_double3,
                        :poq_item_glass_laminate1,
                        :poq_item_glass_laminate2,
                        :poq_drawing,
                        :poq_finish,
                        :poq_system_type,
                        :poq_qty,
                        :poq_unit,
                        :poq_uprice,
                        :poq_remark,
                        :poq_cby,
                        :poq_eby,
                        :poq_Cdate,
                        :poq_Edate,
                        :poq_project_code,
                        :poq_status,
                        :boq_refno,
                        :boq_reviewno,
                        :boq_area
                    )";

                $this->cm = $this->cn->prepare($this->sql);
                $this->cm->bindParam(":poq_item_no", $this->poq_item_no);
                $this->cm->bindParam(":poq_item_type", $this->poq_item_type);
                $this->cm->bindParam(":poq_item_remark", $this->poq_item_remark);
                $this->cm->bindParam(":poq_item_width", $this->poq_item_width);
                $this->cm->bindParam(":poq_item_height", $this->poq_item_height);
                $this->cm->bindParam(":poq_item_glass_spec", $this->poq_item_glass_spec);
                $this->cm->bindParam(":poq_item_glass_single", $this->poq_item_glass_single);
                $this->cm->bindParam(":poq_item_glass_double1", $this->poq_item_glass_double1);
                $this->cm->bindParam(":poq_item_glass_double2", $this->poq_item_glass_double2);
                $this->cm->bindParam(":poq_item_glass_double3", $this->poq_item_glass_double3);
                $this->cm->bindParam(":poq_item_glass_laminate1", $this->poq_item_glass_laminate1);
                $this->cm->bindParam(":poq_item_glass_laminate2", $this->poq_item_glass_laminate2);
                $this->cm->bindParam(":poq_drawing", $this->poq_drawing);
                $this->cm->bindParam(":poq_finish", $this->poq_finish);
                $this->cm->bindParam(":poq_system_type", $this->poq_system_type);
                $this->cm->bindParam(":poq_qty", $this->poq_qty);
                $this->cm->bindParam(":poq_unit", $this->poq_unit);
                $this->cm->bindParam(":poq_uprice", $this->poq_uprice);
                $this->cm->bindParam(":poq_remark", $this->poq_remark);
                $this->cm->bindParam(":poq_cby", $this->poq_cby);
                $this->cm->bindParam(":poq_eby", $this->poq_eby);
                $this->cm->bindParam(":poq_Cdate", $this->poq_Cdate);
                $this->cm->bindParam(":poq_Edate", $this->poq_Edate);
                $this->cm->bindParam(":poq_project_code", $this->poq_project_code);
                $this->cm->bindParam(":poq_status", $this->poq_status);
                $this->cm->bindParam(":boq_refno", $this->boq_refno);
                $this->cm->bindParam(":boq_reviewno", $this->boq_reviewno);
                $this->cm->bindParam(":boq_area", $this->boq_area);
                if ($this->cm->execute()) {
                    $this->response = array("msg" => "1", "data" => "saved");
                } else {
                    $this->response = array("msg" => "0", "data" => "DB_Error");
                }
            } else {
                $this->response = array("msg" => "0", "data" => "This Item Number Already Exists...");
            }
        } else {
            $this->response = array("msg" => "0", "data" => "Project Status was Completed, so You Can not change Anythings");
        }


        return json_encode($this->response);
        exit();
    }

    public function all_boq($project_name, $boq_refon, $boq_reviewno)
    {
        $this->poq_project_code = $this->enc('enc', $project_name);
        $this->boq_refno = $this->enc('enc', $boq_refon);
        $this->boq_reviewno = $this->enc('enc', $boq_reviewno);
        //SELECT *FROM (((pms_poq inner join pms_ptype on pms_poq.poq_item_type=pms_ptype.ptype_id) inner join pms_systemtype on pms_poq.poq_system_type=pms_systemtype.system_type_id) inner join pms_finish on pms_poq.poq_finish=pms_finish.finish_id) inner join pms_units on pms_poq.poq_unit=pms_units.uint_id
        $this->sql = "SELECT *FROM (((pms_poq 
            inner join 
            pms_ptype on pms_poq.poq_item_type=pms_ptype.ptype_id) 
            inner join 
            pms_systemtype on pms_poq.poq_system_type=pms_systemtype.system_type_id) 
            inner join 
            pms_finish on pms_poq.poq_finish=pms_finish.finish_id) 
            inner join 
            pms_units on pms_poq.poq_unit=pms_units.uint_id 
            where 
            pms_poq.poq_project_code = :poq_project_code 
            and 
            boq_refno=:boq_refno 
            and 
            boq_reviewno=:boq_reviewno order by poq_id asc";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":poq_project_code", $this->poq_project_code);
        $this->cm->bindParam(":boq_refno", $this->boq_refno);
        $this->cm->bindParam(":boq_reviewno", $this->boq_reviewno);
        $this->cm->execute();
        $_BOQ = [];
        $_total = 0;
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $tot = (float) $this->enc('denc', $poq_qty) * (float) $this->enc('denc', $poq_uprice);
            $_total += (float) $tot;
            $area  = (float) $this->enc('denc', $poq_item_width) * (float) $this->enc('denc', $poq_item_height);
            $_BOQ[] = array(
                'poq_id' => $poq_id,
                'poq_item_no' => $this->enc('denc', $poq_item_no),
                'poq_item_type' => $poq_item_type,
                'poq_item_remark' => $this->enc('denc', $poq_item_remark),
                'poq_item_width' => $this->enc('denc', $poq_item_width),
                'poq_item_height' => $this->enc('denc', $poq_item_height),
                'poq_item_glass_spec' => $this->enc('denc', $poq_item_glass_spec),
                'poq_item_glass_single' => $this->enc('denc', $poq_item_glass_single),
                'poq_item_glass_double1' => $this->enc('denc', $poq_item_glass_double1),
                'poq_item_glass_double2' => $this->enc('denc', $poq_item_glass_double2),
                'poq_item_glass_double3' => $this->enc('denc', $poq_item_glass_double3),
                'poq_item_glass_laminate1' => $this->enc('denc', $poq_item_glass_laminate1),
                'poq_item_glass_laminate2' => $this->enc('denc', $poq_item_glass_laminate2),
                'poq_drawing' => $this->enc('denc', $poq_drawing),
                'poq_finish' => $poq_finish,
                'poq_system_type' => $poq_system_type,
                'poq_qty' => $this->enc('denc', $poq_qty),
                'poq_unit' => $poq_unit,
                'poq_uprice' => $this->enc('denc', $poq_uprice),
                'poq_remark' => $this->enc('denc', $poq_remark),
                'poq_cby' => $this->enc('denc', $poq_cby),
                'poq_eby' => $this->enc('denc', $poq_eby),
                'poq_Cdate' => $this->enc('denc', $poq_Cdate),
                'poq_Edate' => $this->enc('denc', $poq_Edate),
                'poq_project_code' => $this->enc('denc', $poq_project_code),
                'poq_status' => $this->enc('denc', $poq_status),
                'unit_name' => $this->enc('denc', $unit_name),
                'ptype_name' => $this->enc('denc', $ptype_name),
                'system_type_name' => $this->enc('denc', $system_type_name),
                'finish_name' => $this->enc('denc', $finish_name),
                'tot' => $tot,
                'area' => $area,
                "item_aras" => $this->enc('denc', $boq_area),
            );
        }

        $_data = array(
            "boq" => $_BOQ,
            "total" => $_total
        );
        $this->response = array("msg" => "1", "data" =>  $_data);
        return json_encode($this->response);
        exit();
    }

    public function all_boqs($project_name, $boq_refon, $boq_reviewno)
    {
        $this->poq_project_code = $this->enc('enc', $project_name);
        $this->boq_refno = $this->enc('enc', $boq_refon);
        $this->boq_reviewno = $this->enc('enc', $boq_reviewno);
        //SELECT *FROM (((pms_poq inner join pms_ptype on pms_poq.poq_item_type=pms_ptype.ptype_id) inner join pms_systemtype on pms_poq.poq_system_type=pms_systemtype.system_type_id) inner join pms_finish on pms_poq.poq_finish=pms_finish.finish_id) inner join pms_units on pms_poq.poq_unit=pms_units.uint_id
        $this->sql = "SELECT *,mr.cntmr as mrcount FROM (((pms_poq 
            inner join 
            pms_ptype on pms_poq.poq_item_type=pms_ptype.ptype_id) 
            inner join 
            pms_systemtype on pms_poq.poq_system_type=pms_systemtype.system_type_id) 
            inner join 
            pms_finish on pms_poq.poq_finish=pms_finish.finish_id) 
            inner join 
            pms_units on pms_poq.poq_unit=pms_units.uint_id 
            left join (
                select count(mrboqno) as cntmr,mrboqno from pms_materials_materialrequest group by mrboqno
            ) as mr on pms_poq.poq_id = mr.mrboqno
            where 
            pms_poq.poq_project_code = :poq_project_code 
            and 
            boq_refno=:boq_refno 
            and 
            boq_reviewno=:boq_reviewno order by poq_id asc";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":poq_project_code", $this->poq_project_code);
        $this->cm->bindParam(":boq_refno", $this->boq_refno);
        $this->cm->bindParam(":boq_reviewno", $this->boq_reviewno);
        $this->cm->execute();
        $_BOQ = [];
        $_total = 0;
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $itemNo = $this->enc('denc', $poq_item_no);
            $tot = (float) $this->enc('denc', $poq_qty) * (float) $this->enc('denc', $poq_uprice);
            $_total += (float) $tot;
            $area  = (float) $this->enc('denc', $poq_item_width) * (float) $this->enc('denc', $poq_item_height);

            $sql = "SELECT *from $this->pms_boq_notes 
            where 
            boq_note_project=:boq_note_project 
            and 
            boq_note_itemno=:boq_note_itemno";
            $cm = $this->cn->prepare($sql);
            $cm->bindParam(":boq_note_project", $this->poq_project_code);
            $cm->bindParam(":boq_note_itemno", $poq_item_no);
            $cm->execute();
            $_notes = [];
            while ($row = $cm->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $_notes[] = array(
                    'boq_note_id' => $boq_note_id,
                    'boq_note_project' => $this->enc('denc', $boq_note_project),
                    'boq_note_itemno' => $this->enc('denc', $boq_note_itemno),
                    'boq_note_notes' => $this->enc('denc', $boq_note_notes)
                );
            }
            $_BOQ_info = array(
                'poq_id' => $poq_id,
                'poq_item_no' => $this->enc('denc', $poq_item_no),
                'poq_item_type' => $poq_item_type,
                'poq_item_remark' => $this->enc('denc', $poq_item_remark),
                'poq_item_width' => $this->enc('denc', $poq_item_width),
                'poq_item_height' => $this->enc('denc', $poq_item_height),
                'poq_item_glass_spec' => $this->enc('denc', $poq_item_glass_spec),
                'poq_item_glass_single' => $this->enc('denc', $poq_item_glass_single),
                'poq_item_glass_double1' => $this->enc('denc', $poq_item_glass_double1),
                'poq_item_glass_double2' => $this->enc('denc', $poq_item_glass_double2),
                'poq_item_glass_double3' => $this->enc('denc', $poq_item_glass_double3),
                'poq_item_glass_laminate1' => $this->enc('denc', $poq_item_glass_laminate1),
                'poq_item_glass_laminate2' => $this->enc('denc', $poq_item_glass_laminate2),
                'poq_drawing' => $this->enc('denc', $poq_drawing),
                'poq_finish' => $poq_finish,
                'poq_system_type' => $poq_system_type,
                'poq_qty' => $this->enc('denc', $poq_qty),
                'poq_unit' => $poq_unit,
                'poq_uprice' => $this->enc('denc', $poq_uprice),
                'poq_remark' => $this->enc('denc', $poq_remark),
                'poq_cby' => $this->enc('denc', $poq_cby),
                'poq_eby' => $this->enc('denc', $poq_eby),
                'poq_Cdate' => $this->enc('denc', $poq_Cdate),
                'poq_Edate' => $this->enc('denc', $poq_Edate),
                'poq_project_code' => $this->enc('denc', $poq_project_code),
                'poq_status' => $this->enc('denc', $poq_status),
                'unit_name' => $this->enc('denc', $unit_name),
                'ptype_name' => $this->enc('denc', $ptype_name),
                'system_type_name' => $this->enc('denc', $system_type_name),
                'finish_name' => $this->enc('denc', $finish_name),
                "item_aras" => $this->enc('denc', $boq_area),
                'tot' => $tot,
                'area' => $area,
                'notes' => $_notes,
            );

            $_BOQ[] = array(
                "item_no" => $itemNo,
                "boq_info" => $_BOQ_info,
                "mrcount" => is_null($mrcount) ? '0' : $mrcount,
            );
        }
        $_data = array(
            "boq" => $_BOQ,
            "total" => $_total
        );
        $this->response = array("msg" => "1", "data" =>  $_data);
        return json_encode($this->response);
        exit();
    }

    public function get_boq($project_name, $boq_no)
    {
        $this->poq_project_code = $this->enc('enc', $project_name);
        $this->poq_item_no =  $boq_no;

        $this->sql = "SELECT *FROM (((pms_poq 
            inner join 
            pms_ptype on pms_poq.poq_item_type=pms_ptype.ptype_id) 
            inner join 
            pms_systemtype on pms_poq.poq_system_type=pms_systemtype.system_type_id) 
            inner join 
            pms_finish on pms_poq.poq_finish=pms_finish.finish_id) 
            inner join 
            pms_units on pms_poq.poq_unit=pms_units.uint_id 
            where 
            pms_poq.poq_project_code = :poq_project_code 
            and 
            pms_poq.poq_id = :poq_item_no";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam("poq_project_code", $this->poq_project_code);
        $this->cm->bindParam("poq_item_no", $this->poq_item_no);
        $this->cm->execute();
        if ($this->cm->rowCount() === 1) {
            $this->rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            extract($this->rows);
            $tot = (float) $this->enc('denc', $poq_qty) * (float) $this->enc('denc', $poq_uprice);
            $area  = (float) $this->enc('denc', $poq_item_width) * (float) $this->enc('denc', $poq_item_height);
            $_BOQ = array(
                'poq_id' => $poq_id,
                'item_no' => $this->enc('denc', $poq_item_no),
                'item_type' => $poq_item_type,
                'item_remark' => $this->enc('denc', $poq_item_remark),
                'item_width' => (float)$this->enc('denc', $poq_item_width),
                'item_height' => (float)$this->enc('denc', $poq_item_height),
                'glass_name' => $this->enc('denc', $poq_item_glass_spec),
                'glass_single' => $this->enc('denc', $poq_item_glass_single),
                'glass_double1' => $this->enc('denc', $poq_item_glass_double1),
                'glass_double2' => $this->enc('denc', $poq_item_glass_double2),
                'glass_double3' => $this->enc('denc', $poq_item_glass_double3),
                'glass_laminated1' => $this->enc('denc', $poq_item_glass_laminate1),
                'glass_laminated2' => $this->enc('denc', $poq_item_glass_laminate2),
                'drawing_refno' => $this->enc('denc', $poq_drawing),
                'finish_type' => $poq_finish,
                'system_type' => $poq_system_type,
                'item_qty' => (float)$this->enc('denc', $poq_qty),
                'item_unit' => (float) $poq_unit,
                'item_Uprice' => (float)$this->enc('denc', $poq_uprice),
                'item_description' => $this->enc('denc', $poq_remark),
                'poq_cby' => $this->enc('denc', $poq_cby),
                'poq_eby' => $this->enc('denc', $poq_eby),
                'poq_Cdate' => $this->enc('denc', $poq_Cdate),
                'poq_Edate' => $this->enc('denc', $poq_Edate),
                'poq_project_code' => $this->enc('denc', $poq_project_code),
                'poq_status' => $this->enc('denc', $poq_status),
                'unit_name' => $this->enc('denc', $unit_name),
                'ptype_name' => $this->enc('denc', $ptype_name),
                'system_type_name' => $this->enc('denc', $system_type_name),
                'finish_name' => $this->enc('denc', $finish_name),
                'item_Tprice' => (float)$tot,
                'item_area' => (float)$area,
                'item_aras' => $this->enc('denc', $boq_area),
            );

            $this->response = array("msg" => "1", "data" => $_BOQ);
        } else {
            $this->response = array("msg" => "0", "data" => "No data Found....");
        }
        return json_encode($this->response);
        exit();
    }

    public function boq_ref_update($project_name, $boq_refno, $revisionno)
    {
        $this->project_no = $this->enc('enc', $project_name);
        $this->project_boq_refno = $this->enc('enc', $boq_refno);
        $this->project_boq_revision = $this->enc('enc', $revisionno);

        $this->sql = "UPDATE $this->pms_project_summary 
                        set 
                        project_boq_refno=:project_boq_refno,
                        project_boq_revision=:project_boq_revision 
                        where
                        project_no = :project_no";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":project_boq_refno", $this->project_boq_refno);
        $this->cm->bindParam(":project_boq_revision", $this->project_boq_revision);
        $this->cm->bindParam(":project_no", $this->project_no);
        if ($this->cm->execute()) {
            $this->response = array("msg" => "1", "data" => "Data Saved");
        } else {
            $this->response = array("msg" => "0", "data" => "Error In DB");
        }
        return json_encode($this->response);
        exit();
    }

    public function update_boq($boq_info)
    {
        $_id = $boq_info['poq_id'];
        $this->poq_item_no = $this->enc('enc', $boq_info['poq_item_no']);
        $this->poq_item_type = $boq_info['poq_item_type'];
        $this->poq_item_remark = $this->enc('enc', $boq_info['poq_item_remark']);
        $this->poq_item_width = $this->enc('enc', $boq_info['poq_item_width']);
        $this->poq_item_height = $this->enc('enc', $boq_info['poq_item_height']);
        $this->poq_item_glass_spec = $this->enc('enc', $boq_info['poq_item_glass_spec']);
        $this->poq_item_glass_single = $this->enc('enc', $boq_info['poq_item_glass_single']);
        $this->poq_item_glass_double1 = $this->enc('enc', $boq_info['poq_item_glass_double1']);
        $this->poq_item_glass_double2 = $this->enc('enc', $boq_info['poq_item_glass_double2']);
        $this->poq_item_glass_double3 = $this->enc('enc', $boq_info['poq_item_glass_double3']);
        $this->poq_item_glass_laminate1 = $this->enc('enc', $boq_info['poq_item_glass_laminate1']);
        $this->poq_item_glass_laminate2 = $this->enc('enc', $boq_info['poq_item_glass_laminate2']);
        $this->poq_drawing = $this->enc('enc', $boq_info['poq_drawing']);
        $this->poq_finish = $boq_info['poq_finish'];
        $this->poq_system_type = $boq_info['poq_system_type'];
        $this->poq_qty = $this->enc('enc', $boq_info['poq_qty']);
        $this->poq_unit = $boq_info['poq_unit'];
        $this->poq_uprice = $this->enc('enc', $boq_info['poq_uprice']);
        $this->poq_remark = $this->enc('enc', $boq_info['poq_remark']);
        $this->poq_cby = $this->enc('enc', $boq_info['poq_cby']);
        $this->poq_eby = $this->enc('enc', $boq_info['poq_eby']);
        $this->poq_Cdate = $this->enc('enc', $boq_info['poq_Cdate']);
        $this->poq_Edate = $this->enc('enc', $boq_info['poq_Edate']);
        $this->poq_project_code = $this->enc('enc', $boq_info['poq_project_code']);
        $this->poq_status = $this->enc('enc', $boq_info['poq_status']);
        $this->boq_area = $this->enc('enc', $boq_info['boq_area']);

        //dublicate check 
        $this->sql = "select *from $this->pms_poq where poq_item_no=:poq_item_no and poq_id<>:poq_id and poq_project_code=:poq_project_code";
        $this->cm = $this->cn->prepare($this->sql);
        $_params = array(
            ':poq_item_no' => $this->poq_item_no,
            ":poq_id" => $_id,
            ':poq_project_code' => $this->poq_project_code
        );
        $this->cm->execute($_params);
        $dub = $this->cm->rowCount() === 0 ? true : false;
        if ($dub === true) {

            $this->sql = "UPDATE $this->pms_poq set   
                        poq_item_no=:poq_item_no,                      
                        poq_item_type=:poq_item_type,
                        poq_item_remark=:poq_item_remark,
                        poq_item_width=:poq_item_width,
                        poq_item_height=:poq_item_height,
                        poq_item_glass_spec=:poq_item_glass_spec,
                        poq_item_glass_single=:poq_item_glass_single,
                        poq_item_glass_double1=:poq_item_glass_double1,
                        poq_item_glass_double2=:poq_item_glass_double2,
                        poq_item_glass_double3=:poq_item_glass_double3,
                        poq_item_glass_laminate1=:poq_item_glass_laminate1,
                        poq_item_glass_laminate2=:poq_item_glass_laminate2,
                        poq_drawing=:poq_drawing,
                        poq_finish=:poq_finish,
                        poq_system_type=:poq_system_type,
                        poq_qty=:poq_qty,
                        poq_unit=:poq_unit,
                        poq_uprice=:poq_uprice,
                        poq_remark=:poq_remark,                        
                        poq_eby=:poq_eby,                        
                        poq_Edate=:poq_Edate,
                        boq_area=:boq_area                                                
                        where 
                        poq_id=:poq_id 
                        and 
                        poq_project_code=:poq_project_code
                    ";

            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":poq_item_no", $this->poq_item_no);
            $this->cm->bindParam(":poq_item_type", $this->poq_item_type);
            $this->cm->bindParam(":poq_item_remark", $this->poq_item_remark);
            $this->cm->bindParam(":poq_item_width", $this->poq_item_width);
            $this->cm->bindParam(":poq_item_height", $this->poq_item_height);
            $this->cm->bindParam(":poq_item_glass_spec", $this->poq_item_glass_spec);
            $this->cm->bindParam(":poq_item_glass_single", $this->poq_item_glass_single);
            $this->cm->bindParam(":poq_item_glass_double1", $this->poq_item_glass_double1);
            $this->cm->bindParam(":poq_item_glass_double2", $this->poq_item_glass_double2);
            $this->cm->bindParam(":poq_item_glass_double3", $this->poq_item_glass_double3);
            $this->cm->bindParam(":poq_item_glass_laminate1", $this->poq_item_glass_laminate1);
            $this->cm->bindParam(":poq_item_glass_laminate2", $this->poq_item_glass_laminate2);
            $this->cm->bindParam(":poq_drawing", $this->poq_drawing);
            $this->cm->bindParam(":poq_finish", $this->poq_finish);
            $this->cm->bindParam(":poq_system_type", $this->poq_system_type);
            $this->cm->bindParam(":poq_qty", $this->poq_qty);
            $this->cm->bindParam(":poq_unit", $this->poq_unit);
            $this->cm->bindParam(":poq_uprice", $this->poq_uprice);
            $this->cm->bindParam(":poq_remark", $this->poq_remark);
            $this->cm->bindParam(":poq_eby", $this->poq_eby);
            $this->cm->bindParam(":poq_Edate", $this->poq_Edate);
            $this->cm->bindParam(":boq_area", $this->boq_area);
            $this->cm->bindParam(":poq_id", $_id);
            $this->cm->bindParam(":poq_project_code", $this->poq_project_code);
            if ($this->cm->execute()) {
                $this->response = array("msg" => "1", "data" => "Updated");
            } else {
                $this->response = array("msg" => "0", "data" => "DB Error");
            }
        } else {
            $this->response = array("msg" => "0", "data" => "This BOQ id already Taken....");
        }
        return json_encode($this->response);
        exit();
    }

    // private $pms_class_types;
    // private $class_type_id;
    // private $class_type_name;
    public function new_glassTypes($glasstype)
    {
        $this->class_type_name = $this->enc('enc', strtolower($glasstype));
        $this->sql = "INSERT INTO $this->pms_class_types values(null,:class_type_name)";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":class_type_name", $this->class_type_name);
        if ($this->cm->execute()) {
            $this->response = array("msg" => "1", "data" => "Saved");
        } else {
            $this->response = array("msg" => "0", "data" => "already exists");
        }
        return json_encode($this->response);
        exit();
    }

    public function all_glassTypes()
    {
        $this->sql = "SELECT *FROM $this->pms_class_types order by class_type_name asc";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $_glassTypes = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $_glassTypes[] = array(
                "class_type_id" => $class_type_id,
                "class_type_name" => $this->enc('denc', $class_type_name)
            );
        }
        $this->response = array("msg" => "1", "data" => $_glassTypes);
        return json_encode($this->response);
        exit();
    }



    public function new_boq_notes($boqnotes)
    {
        $this->boq_note_project = $this->enc('enc', $boqnotes["boq_note_project"]);
        $this->boq_note_itemno = $this->enc('enc', $boqnotes["boq_note_itemno"]);
        $this->boq_note_notes = $this->enc('enc', $boqnotes["boq_note_notes"]);

        $this->sql = "INSERT INTO $this->pms_boq_notes values(
            null,
            :boq_note_project,
            :boq_note_itemno,
            :boq_note_notes
        )";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":boq_note_project", $this->boq_note_project);
        $this->cm->bindParam(":boq_note_itemno", $this->boq_note_itemno);
        $this->cm->bindParam(":boq_note_notes", $this->boq_note_notes);
        if ($this->cm->execute()) {
            $this->response = array("msg" => "1", "data" => "saved");
        } else {
            $this->response = array('msg' => "0", 'data' => "DB_Error");
        }
        return json_encode($this->response);
        exit();
    }

    public function remove_boq_notes($id)
    {
        $this->boq_note_id = $id;
        $this->sql = "DELETE FROM $this->pms_boq_notes WHERE boq_note_id=:boq_note_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(':boq_note_id', $this->boq_note_id);
        if ($this->cm->execute()) {
            $this->response = array('msg' => "1", 'data' => "Removed");
        } else {
            $this->response = array("msg" => "0", "data" => "DB Error");
        }
        return json_encode($this->response);
        exit();
    }

    public function Gway_Projects()
    {
        $this->sql = "SELECT project_no,project_name,projectRegion,project_location FROM pms_project_summary";
        //echo $this->sql;
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $g_projects = [];

        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $reg = "-";
            if (strtoupper($this->enc('denc', $projectRegion)) === 'CENTER REGION') {
                $reg = "CENTRAL REGION";
            } else {
                $reg = strtoupper($this->enc('denc', $projectRegion));
            }
            $g_projects[] = array(
                "project_no" => strtoupper($this->enc('denc', $project_no)),
                "project_name" => strtoupper($this->enc('denc', $project_name)),
                "projectRegion" => $reg,
                "project_location" => strtoupper($this->enc('denc', $project_location)),
                "projectenc" => $project_no,
            );
        };
        $final = [];
        foreach ($g_projects as $pj) {
            if ($pj['project_no'] === "P14/19") {
                $x = explode(" ", $pj['project_name']);
                //print_r($x);
                $pj['project_name'] = "RIYADH METRO STATION " . $x[3];
                $final[] = $pj;
                $pj['project_name'] = "RIYADH METRO STATION " . $x[4];
                $final[] = $pj;
                $pj['project_name'] = "RIYADH METRO STATION " . $x[5];
                $final[] = $pj;
                $pj['project_name'] = "RIYADH METRO STATION " . $x[6];
                $final[] = $pj;
            } else if ($pj['project_no'] === "P02/19") {
                $x = explode(" ", $pj['project_name']);
                $pj['project_name'] = "RIYADH METRO DEEP UNDERGROUND STATION " . $x[5];
                $final[] = $pj;
                $pj['project_name'] = "RIYADH METRO DEEP UNDERGROUND STATION " . $x[7];
                $final[] = $pj;
            } else if ($pj['project_no'] === "P21/22") {
                $x = explode(" ", $pj['project_name']);
                //print_r($x);
                $pj['project_name'] = "Riyadh Metro Project Station P21/22 - " . $x[4];
                $final[] = $pj;
                $pj['project_name'] = "Riyadh Metro Project Station P21/22 - " . $x[5] . $x[6];
                $final[] = $pj;
                $pj['project_name'] = "Riyadh Metro Project Station P21/22 - " . $x[7];
                $final[] = $pj;
                $pj['project_name'] = "Riyadh Metro Project Station P21/22 - " . $x[9];
                $final[] = $pj;
            }
            //Riyadh Metro Project Station
            //print_r($x);
            // }else if($pj['project_no'] === "P25/22"){
            //     $x = explode(" ",$pj['project_name']);
            //     $pjgroup = explode("/",$x[4]);
            //     $pj['project_name'] = "RIYADH METRO PROJECT STATION P25/22 - ". $pjgroup[0];
            //     $final[] = $pj;
            //     $pj['project_name'] = "RIYADH METRO PROJECT STATION  P25/22 - ". $pjgroup[1];
            //     $final[] = $pj;

            // }
            else if ($pj['project_no'] === "P07/22") {
                $x = explode(" ", $pj['project_name']);
                //print_r($x);
                $pj['project_name'] = "Riyadh Metro Station P07/22 - " . $x[3];
                $final[] = $pj;

                $pj['project_name'] = "Riyadh Metro Station P07/22 - " . $x[4] . " " . $x[5];
                $final[] = $pj;

                $pj['project_name'] = "Riyadh Metro Station P07/22 - " . $x[7];
                $final[] = $pj;

                $pj['project_name'] = "Riyadh Metro Station P07/22 - " . $x[8];
                $final[] = $pj;

                $pj['project_name'] = "Riyadh Metro Station P07/22 - " . $x[9];
                $final[] = $pj;
            }

            // else if($pj['project_no'] === "P14/22"){
            //     echo $pj['project_no'];
            //     echo $pj['project_name'];
            //     break;
            //     $x = explode(" ",$pj['project_name']);
            //    // print_r($x);
            //     $pj['project_name'] = "RIYADH METRO PROJECT - STATION ". $x[5];
            //     $final[] = $pj;
            //     $pj['project_name'] = "RIYADH METRO PROJECT - STATION ". $x[6];
            //     $final[] = $pj;
            //     $pj['project_name'] = "RIYADH METRO PROJECT - STATION ". $x[7];
            //     $final[] = $pj;
            //     // $pj['project_name'] = "RIYADH METRO PROJECT - STATION ". $x[8];
            //     // $final[] = $pj;
            //     $pj['project_name'] = "RIYADH METRO PROJECT - PARK & RIDE ". $x[12];
            //     $final[] = $pj;
            //     $pj['project_name'] = "RIYADH METRO PROJECT - PARK & RIDE ". $x[13];
            //     $final[] = $pj;
            //     $pj['project_name'] = "RIYADH METRO PROJECT - PARK & RIDE ". $x[15];
            //     $final[] = $pj;
            // }
            else {
                $final[] = $pj;
            }
        }

        $this->response = array("msg" => "1", "data" => $final);
        return json_encode($this->response);
        exit();
    }

    public function Gway_Project_infos($project_nok, $pnamex)
    {
        $project_no = $this->enc('enc', strtolower($project_nok));
        $this->sql = "SELECT project_no,project_name,projectRegion,project_location FROM pms_project_summary where project_no=:project_no";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":project_no", $project_no);
        $this->cm->execute();
        $avi = $this->cm->rowCount() === 1 ? true : false;
        //unset($this->cm,$this->sql);
        if ($avi) {
            $this->rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            extract($this->rows);
            $reg = "-";
            if (strtoupper($this->enc('denc', $projectRegion)) === 'CENTER REGION') {
                $reg = "CENTRAL REGION";
            } else {
                $reg = strtoupper($this->enc('denc', $projectRegion));
            }
            $pjno = strtoupper($this->enc('denc', $project_no));
            $pname = strtoupper($this->enc('denc', $project_name));
            if ($pjno === "P14/19" || $pjno === "P02/19" || $pjno === "P14/22" || $pjno === "P21/22" || $pjno === "P07/22") {
                $pname = $pnamex;
            }
            $projinfo = array(
                "project_no" => strtoupper($this->enc('denc', $project_no)),
                "project_name" =>  $pname,
                "projectRegion" => $reg,
                "project_location" => strtoupper($this->enc('denc', $project_location)),
            );
            $this->response = array("msg" => "1", "data" => $projinfo);
        } else {
            $this->response = array("msg" => "0", "data" => "No data found");
        }
        return json_encode($this->response);
        exit();
    }
}
