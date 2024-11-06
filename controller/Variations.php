<?php
date_default_timezone_set('Asia/Riyadh');
include_once('mac.php');
class Variations extends mac
{
    private $cn;
    private $cm;
    private $rows;
    private $sql;
    private $response;

    private $variation_subject;
    private $v_sub_name;

    private $nafco_variation;
    private $variation_tokens;
    private $variation_project;
    private $variation_project_name;
    private $variation_project_location;
    private $variation_refno_p1;
    private $variation_refno_p2;
    private $variation_refno_p3;
    private $variation_refno_p4;
    private $variation_refno;
    private $variation_date;
    private $variation_to;
    private $variation_subjects;
    private $variation_description;
    private $variation_amount;
    private $variation_remarks;
    private $variation_region;
    private $variation_salesman;
    private $variation_status;
    private $variation_createby;
    private $variation_editby;
    private $variation_cdate;
    private $variation_edate;
    private $revision_no;
    private $variation_atten;


    private $nafco_variation_revison;
    private $revison_token;
    private $revison_project;
    private $revison_project_name;
    private $revison_project_location;
    private $revison_refno_p1;
    private $revison_refno_p2;
    private $revison_refno_p3;
    private $revison_refno_p4;
    private $revison_refno;
    private $revison_no;
    private $revision_date;
    private $revision_to;
    private $revision_subject;
    private $revision_description;
    private $revision_amount;
    private $revision_region;
    private $revision_salesman;
    private $revision_status;
    private $revision_createdby;
    private $revision_editby;
    private $revision_cdate;
    private $revision_edate;
    private $variation_token;
    private $revison_atten;
    private $revision_remark;
    private $revision_status_n;

    function __construct($db)
    {
        $this->cn = $db;
        $this->variation_subject = mac::variation_subject;
        $this->nafco_variation = mac::nafco_variation;
        $this->nafco_variation_revison = mac::nafco_variation_revison;
        $this->response = array("msg" => "0", "data" => "Error");
    }

    public function NewVariatons($variations_info)
    {

        $this->variation_tokens = $variations_info['variation_token'];
        $this->variation_project = $this->enc('enc', $variations_info['variation_project']);
        $this->variation_project_name = $this->enc('enc', $variations_info['variation_project_name']);
        $this->variation_project_location = $this->enc('enc', $variations_info['variation_project_location']);
        $this->variation_refno_p1 = $this->enc('enc', $variations_info['variation_refno_p1']);
        $this->variation_refno_p2 = $this->enc('enc', $variations_info['variation_refno_p2']);
        $this->variation_refno_p3 = $this->enc('enc', $variations_info['variation_refno_p3']);
        $this->variation_refno_p4 = $this->enc('enc', $variations_info['variation_refno_p4']);
        $this->variation_refno = $this->enc('enc', $variations_info['variation_refno']);
        $this->variation_date = $variations_info['variation_date'];
        $this->variation_to = $this->enc('enc', $variations_info['variation_to']);
        $this->variation_subjects = $variations_info['variation_subject'];
        $this->variation_description = $this->enc('enc', $variations_info['variation_description']);
        $this->variation_amount = $this->enc('enc', $variations_info['variation_amount']);
        $this->variation_remarks = $this->enc('enc', $variations_info['variation_remarks']);
        $this->variation_region = $variations_info['variation_region'];
        $this->variation_salesman = $this->enc('enc', $variations_info['variation_salesman']);
        $this->variation_status = $this->enc('enc', $variations_info['variation_status']);
        $this->variation_createby = $this->enc('enc', $variations_info['variation_createby']);
        $this->variation_editby = $this->enc('enc', $variations_info['variation_editby']);
        $this->variation_cdate = $variations_info['variation_cdate'];
        $this->variation_edate = $variations_info['variation_edate'];
        $this->revision_no = $this->enc('enc', $variations_info['revision_no']);
        $this->variation_atten = $this->enc('enc', $variations_info['variation_atten']);

        $this->revison_token = $variations_info['revison_token'];
        $this->revison_project = $this->enc('enc', $variations_info['variation_project']);
        $this->revison_project_name = $this->enc('enc', $variations_info['variation_project_name']);
        $this->revison_project_location = $this->enc('enc', $variations_info['variation_project_location']);
        $this->revison_refno_p1 = $this->enc('enc', $variations_info['variation_refno_p1']);
        $this->revison_refno_p2 = $this->enc('enc', $variations_info['variation_refno_p2']);
        $this->revison_refno_p3 = $this->enc('enc', $variations_info['variation_refno_p3']);
        $this->revison_refno_p4 = $this->enc('enc', $variations_info['variation_refno_p4']);
        $this->revison_refno = $this->enc('enc', $variations_info['variation_refno']);
        $this->revison_no = $this->enc('enc', $variations_info['revision_no']);
        $this->revision_date = $variations_info['variation_date'];
        $this->revision_to = $this->enc('enc', $variations_info['variation_to']);
        $this->revision_subject = $variations_info['variation_subject'];
        $this->revision_description = $this->enc('enc', $variations_info['variation_description']);
        $this->revision_amount = $this->enc('enc', $variations_info['variation_amount']);
        $this->revision_region = $variations_info['variation_region'];
        $this->revision_salesman = $this->enc('enc', $variations_info['variation_salesman']);
        $this->revision_status = $this->enc('enc', $variations_info['variation_status']);
        $this->revision_createdby = $this->enc('enc', $variations_info['variation_createby']);
        $this->revision_editby = $this->enc('enc', $variations_info['variation_editby']);
        $this->revision_cdate = $variations_info['variation_cdate'];
        $this->revision_edate = $variations_info['variation_edate'];
        $this->variation_token = $variations_info['variation_token'];
        $this->revison_atten = $this->enc('enc', $variations_info['variation_atten']);
        $this->revision_remark = $this->enc('enc', $variations_info['variation_remarks']);
        $this->revision_status_n = "x";
        $whohange = $this->enc('enc', '-');
        $k = '-';
        $sv_variations = array(
            ':variation_token' => $this->variation_tokens,
            ':variation_project' => $this->variation_project,
            ':variation_project_name' => $this->variation_project_name,
            ':variation_project_location' => $this->variation_project_location,
            ':variation_refno_p1' => $this->variation_refno_p1,
            ':variation_refno_p2' => $this->variation_refno_p2,
            ':variation_refno_p3' => $this->variation_refno_p3,
            ':variation_refno_p4' => $this->variation_refno_p4,
            ':variation_refno' => $this->variation_refno,
            ':variation_date' => $this->variation_date,
            ':variation_to' => $this->variation_to,
            ':variation_subject' => $this->variation_subjects,
            ':variation_description' => $this->variation_description,
            ':variation_amount' => $this->variation_amount,
            ':variation_remarks' => $this->variation_remarks,
            ':variation_region' => $this->variation_region,
            ':variation_salesman' => $this->variation_salesman,
            ':variation_status' => $this->variation_status,
            ':variation_createby' => $this->variation_createby,
            ':variation_editby' => $this->variation_editby,
            ':variation_cdate' => $this->variation_cdate,
            ':variation_edate' => $this->variation_edate,
            ':revision_no' => $this->revision_no,
            ':variation_atten' => $this->variation_atten,
            ':whochange' => $whohange,
            ':datechange' => $k
        );

        $sv_revision = array(
            ':revison_token' => $this->revison_token,
            ':revison_project' => $this->revison_project,
            ':revison_project_name' => $this->revison_project_name,
            ':revison_project_location' => $this->revison_project_location,
            ':revison_refno_p1' => $this->revison_refno_p1,
            ':revison_refno_p2' => $this->revison_refno_p2,
            ':revison_refno_p3' => $this->revison_refno_p3,
            ':revison_refno_p4' => $this->revison_refno_p4,
            ':revison_refno' => $this->revison_refno,
            ':revison_no' => $this->revison_no,
            ':revision_date' => $this->revision_date,
            ':revision_to' => $this->revision_to,
            ':revision_subject' => $this->revision_subject,
            ':revision_description' => $this->revision_description,
            ':revision_amount' => $this->revision_amount,
            ':revision_region' => $this->revision_region,
            ':revision_salesman' => $this->revision_salesman,
            ':revision_status' => $this->revision_status,
            ':revision_createdby' => $this->revision_createdby,
            ':revision_editby' => $this->revision_editby,
            ':revision_cdate' => $this->revision_cdate,
            ':revision_edate' => $this->revision_edate,
            ':variation_token' => $this->variation_token,
            ':revison_atten' => $this->revison_atten,
            ':revision_remark' =>  $this->revision_remark,
            ':revision_status_n' => $this->revision_status_n,
            ':whochange' => $whohange,
            ':datechange' => $k
        );

        $this->sql = "INSERT into $this->nafco_variation values(
                null,
                :variation_token,
                :variation_project,
                :variation_project_name,
                :variation_project_location,
                :variation_refno_p1,
                :variation_refno_p2,
                :variation_refno_p3,
                :variation_refno_p4,
                :variation_refno,
                :variation_date,
                :variation_to,
                :variation_subject,
                :variation_description,
                :variation_amount,
                :variation_remarks,
                :variation_region,
                :variation_salesman,
                :variation_status,
                :variation_createby,
                :variation_editby,
                :variation_cdate,
                :variation_edate,
                :revision_no,
                :variation_atten,
                :whochange,
                :datechange
            )";
        $this->cm = $this->cn->prepare($this->sql);
        if ($this->cm->execute($sv_variations)) {
            $this->sql = "INSERT into $this->nafco_variation_revison values(
                    null,
                    :revison_token,
                    :revison_project,
                    :revison_project_name,
                    :revison_project_location,
                    :revison_refno_p1,
                    :revison_refno_p2,
                    :revison_refno_p3,
                    :revison_refno_p4,
                    :revison_refno,
                    :revison_no,
                    :revision_date,
                    :revision_to,
                    :revision_subject,
                    :revision_description,
                    :revision_amount,
                    :revision_region,
                    :revision_salesman,
                    :revision_status,
                    :revision_createdby,
                    :revision_editby,
                    :revision_cdate,
                    :revision_edate,
                    :variation_token,
                    :revison_atten,
                    :revision_remark,
                    :revision_status_n,
                    :whochange,
                    :datechange
                )";
            $this->cm = $this->cn->prepare($this->sql);
            if ($this->cm->execute($sv_revision)) {
                $this->response = array(
                    "msg" => "1",
                    "data" => "Saved"
                );
            } else {
                $this->response = array(
                    "msg" => "0",
                    "data" => "2"
                );
            }
        } else {
            $this->response = array(
                "msg" => "0",
                "data" => "1"
            );
        }
        return json_encode($this->response);
        exit();
    }

    public function NewRevision($variations_info)
    {
        $this->variation_tokens = $variations_info['variation_token'];
        $this->variation_project = $this->enc('enc', $variations_info['variation_project']);
        $this->variation_project_name = $this->enc('enc', $variations_info['variation_project_name']);
        $this->variation_project_location = $this->enc('enc', $variations_info['variation_project_location']);
        $this->variation_refno_p1 = $this->enc('enc', $variations_info['variation_refno_p1']);
        $this->variation_refno_p2 = $this->enc('enc', $variations_info['variation_refno_p2']);
        $this->variation_refno_p3 = $this->enc('enc', $variations_info['variation_refno_p3']);
        $this->variation_refno_p4 = $this->enc('enc', $variations_info['variation_refno_p4']);
        $this->variation_refno = $this->enc('enc', $variations_info['variation_refno']);
        $this->variation_date = $variations_info['variation_date'];
        $this->variation_to = $this->enc('enc', $variations_info['variation_to']);
        $this->variation_subjects = $variations_info['variation_subject'];
        $this->variation_description = $this->enc('enc', $variations_info['variation_description']);
        $this->variation_amount = $this->enc('enc', $variations_info['variation_amount']);
        $this->variation_remarks = $this->enc('enc', $variations_info['variation_remarks']);
        $this->variation_region = $variations_info['variation_region'];
        $this->variation_salesman = $this->enc('enc', $variations_info['variation_salesman']);
        $this->variation_status = $this->enc('enc', $variations_info['variation_status']);
        $this->variation_createby = $this->enc('enc', $variations_info['variation_createby']);
        $this->variation_editby = $this->enc('enc', $variations_info['variation_editby']);
        $this->variation_cdate = $variations_info['variation_cdate'];
        $this->variation_edate = $variations_info['variation_edate'];
        $this->revision_no = $this->enc('enc', $variations_info['revision_no']);
        $this->variation_atten = $this->enc('enc', $variations_info['variation_atten']);

        $this->revison_token = $variations_info['revison_token'];
        $this->revison_project = $this->enc('enc', $variations_info['variation_project']);
        $this->revison_project_name = $this->enc('enc', $variations_info['variation_project_name']);
        $this->revison_project_location = $this->enc('enc', $variations_info['variation_project_location']);
        $this->revison_refno_p1 = $this->enc('enc', $variations_info['variation_refno_p1']);
        $this->revison_refno_p2 = $this->enc('enc', $variations_info['variation_refno_p2']);
        $this->revison_refno_p3 = $this->enc('enc', $variations_info['variation_refno_p3']);
        $this->revison_refno_p4 = $this->enc('enc', $variations_info['variation_refno_p4']);
        $this->revison_refno = $this->enc('enc', $variations_info['variation_refno']);
        $this->revison_no = $this->enc('enc', $variations_info['revision_no']);
        $this->revision_date = $variations_info['variation_date'];
        $this->revision_to = $this->enc('enc', $variations_info['variation_to']);
        $this->revision_subject = $variations_info['variation_subject'];
        $this->revision_description = $this->enc('enc', $variations_info['variation_description']);
        $this->revision_amount = $this->enc('enc', $variations_info['variation_amount']);
        $this->revision_region = $variations_info['variation_region'];
        $this->revision_salesman = $this->enc('enc', $variations_info['variation_salesman']);
        $this->revision_status = $this->enc('enc', $variations_info['variation_status']);
        $this->revision_createdby = $this->enc('enc', $variations_info['variation_createby']);
        $this->revision_editby = $this->enc('enc', $variations_info['variation_editby']);
        $this->revision_cdate = $variations_info['variation_cdate'];
        $this->revision_edate = $variations_info['variation_edate'];
        $this->variation_token = $variations_info['variation_token'];
        $this->revison_atten = $this->enc('enc', $variations_info['variation_atten']);
        $this->revision_remark = $this->enc('enc', $variations_info['variation_remarks']);

        //reonly other revisions
        $this->sql  = "UPDATE nafco_variation_revison set revision_status_n='y' where variation_token='$this->variation_token'";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();

        $whochange = $this->enc('enc', '-');
        $sv_revision = array(
            ':revison_token' => $this->revison_token,
            ':revison_project' => $this->revison_project,
            ':revison_project_name' => $this->revison_project_name,
            ':revison_project_location' => $this->revison_project_location,
            ':revison_refno_p1' => $this->revison_refno_p1,
            ':revison_refno_p2' => $this->revison_refno_p2,
            ':revison_refno_p3' => $this->revison_refno_p3,
            ':revison_refno_p4' => $this->revison_refno_p4,
            ':revison_refno' => $this->revison_refno,
            ':revison_no' => $this->revison_no,
            ':revision_date' => $this->revision_date,
            ':revision_to' => $this->revision_to,
            ':revision_subject' => $this->revision_subject,
            ':revision_description' => $this->revision_description,
            ':revision_amount' => $this->revision_amount,
            ':revision_region' => $this->revision_region,
            ':revision_salesman' => $this->revision_salesman,
            ':revision_status' => $this->revision_status,
            ':revision_createdby' => $this->revision_createdby,
            ':revision_editby' => $this->revision_editby,
            ':revision_cdate' => $this->revision_cdate,
            ':revision_edate' => $this->revision_edate,
            ':variation_token' => $this->variation_token,
            ':revison_atten' => $this->revison_atten,
            ':revision_remark' => $this->revision_remark,
            ':whochange' => $whochange,
            ':datechange' => $whochange
        );
        $this->sql = "INSERT into $this->nafco_variation_revison values(
                        null,
                        :revison_token,
                        :revison_project,
                        :revison_project_name,
                        :revison_project_location,
                        :revison_refno_p1,
                        :revison_refno_p2,
                        :revison_refno_p3,
                        :revison_refno_p4,
                        :revison_refno,
                        :revison_no,
                        :revision_date,
                        :revision_to,
                        :revision_subject,
                        :revision_description,
                        :revision_amount,
                        :revision_region,
                        :revision_salesman,
                        :revision_status,
                        :revision_createdby,
                        :revision_editby,
                        :revision_cdate,
                        :revision_edate,
                        :variation_token,
                        :revison_atten,
                        :revision_remark,
                        'x',
                        :whochange,
                        :datechange
                    )";
        $this->cm = $this->cn->prepare($this->sql);
        if ($this->cm->execute($sv_revision)) {
            $sql = "UPDATE $this->nafco_variation set
                    variation_refno_p1 = :variation_refno_p1,
                    variation_refno_p2 = :variation_refno_p2,
                    variation_refno_p3 = :variation_refno_p3,
                    variation_refno_p4 = :variation_refno_p4,
                    variation_refno = :variation_refno,
                    variation_date = :variation_date,
                    variation_to = :variation_to,
                    variation_subject = :variation_subject,
                    variation_description = :variation_description,
                    variation_amount = :variation_amount,
                    variation_remarks = :variation_remarks,
                    variation_region = :variation_region,
                    variation_salesman = :variation_salesman,
                    variation_status = :variation_status,
                    variation_editby = :variation_editby,
                    variation_edate = :variation_edate,
                    revision_no = :revision_no,
                    variation_atten = :variation_atten
                    where
                    variation_token = :variation_token and
                    variation_project = :variation_project
                ";
            $cm = $this->cn->prepare($sql);
            $sv_variations = array(
                ':variation_refno_p1' => $this->variation_refno_p1,
                ':variation_refno_p2' => $this->variation_refno_p2,
                ':variation_refno_p3' => $this->variation_refno_p3,
                ':variation_refno_p4' => $this->variation_refno_p4,
                ':variation_refno' => $this->variation_refno,
                ':variation_date' => $this->variation_date,
                ':variation_to' => $this->variation_to,
                ':variation_subject' => $this->variation_subjects,
                ':variation_description' => $this->variation_description,
                ':variation_amount' => $this->variation_amount,
                ':variation_remarks' => $this->variation_remarks,
                ':variation_region' => $this->variation_region,
                ':variation_salesman' => $this->variation_salesman,
                ':variation_status' => $this->variation_status,
                ':variation_editby' => $this->variation_editby,
                ':variation_edate' => $this->variation_edate,
                ':revision_no' => $this->revision_no,
                ':variation_atten' => $this->variation_atten,
                ':variation_token' => $this->variation_tokens,
                ':variation_project' => $this->variation_project,
            );
            $cm->execute($sv_variations);
            $this->response = array(
                "msg" => "1",
                "data" => "updated"
            );
        } else {
            $this->response = array(
                "msg" => "0",
                "data" => "Data base error"
            );
        }
        return json_encode($this->response);
        exit();
    }

    public function AllVariations($project_no)
    {
        $this->variation_project = $this->enc('enc', $project_no);
        $this->sql = "SELECT *from (($this->nafco_variation
                inner join
                variation_subject
                on
                $this->nafco_variation.variation_subject = variation_subject.v_sub_id)
                inner join
                pms_salesmans
                on
                $this->nafco_variation.variation_salesman = pms_salesmans.salesman_code)
                inner join
                pms_region
                on
                $this->nafco_variation.variation_region = pms_region.region_id
                where
                $this->nafco_variation.variation_project = :variation_project
                order by $this->nafco_variation.variation_id desc
                ";
        //echo $this->sql;
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":variation_project", $this->variation_project);
        $this->cm->execute();
        $_revision = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $xdate  = date_create($variation_date);
            $ddate = date_format($xdate, 'd-M-Y');
            $sdate = date_format($xdate, 'Y-m-d');
            $sdate_n = date_format($xdate, 'd-m-Y');

            $_approvedate = date_create($approvedate);
            $approvedate = date_format($_approvedate, 'Y-m-d');
            $approvedate_n = date_format($_approvedate, 'd-m-Y');
            $approvedate_d = date_format($_approvedate, 'd-M-Y');

            $_reldate = date_create($reldate);
            $reldate = date_format($_reldate, 'Y-m-d');
            $reldate_n = date_format($_reldate, 'd-m-Y');
            $reldate_d = date_format($_reldate, 'd-M-Y');

            $_caceldate = date_create($caceldate);
            $caceldate = date_format($_caceldate, 'Y-m-d');
            $caceldate_n = date_format($_caceldate, 'd-m-Y');
            $caceldate_d = date_format($_caceldate, 'd-M-Y');

            $_recived_date = date_create($recived_date);
            $recived_date = date_format($_recived_date, 'Y-m-d');
            $recived_date_n = date_format($_recived_date, 'd-m-Y');
            $recived_date_d = date_format($_recived_date, 'd-M-Y');

            $_vo = $this->enc('denc', $vno);
            $vno = $_vo;
            if ($_vo === 0 || $_vo === '0' ||$_vo === 'false' || $_vo === false ) {
                $vno = '-';
            }

            $dispproject = $this->enc('denc', $variation_project_name) . "[" . $this->enc('denc', $variation_project) . "]";;
            $_revision[] = array(
                'variation_id' => $variation_id,
                'variation_token' => $variation_token,
                'variation_project' => $this->enc('denc', $variation_project),
                'variation_project_name' => $this->enc('denc', $variation_project_name),
                'variation_project_location' => $this->enc('denc', $variation_project_location),
                'variation_refno_p1' => $this->enc('denc', $variation_refno_p1),
                'variation_refno_p2' => $this->enc('denc', $variation_refno_p2),
                'variation_refno_p3' => $this->enc('denc', $variation_refno_p3),
                'variation_refno_p4' => $this->enc('denc', $variation_refno_p4),
                'variation_refno' => $this->enc('denc', $variation_refno),
                'variation_date' => $ddate,
                'variation_dateS' => $sdate,
                'variation_date_n' => $sdate_n,
                'variation_to' => $this->enc('denc', $variation_to),
                'variation_subject' => (string)$variation_subject,
                'variation_description' => $this->enc('denc', $variation_description),
                'variation_amount' => $this->enc('denc', $variation_amount),
                'variation_remarks' => $this->enc('denc', $variation_remarks),
                'variation_region' => (string)$variation_region,
                'variation_salesman' => $this->enc('denc', $variation_salesman),
                'variation_status' => $this->enc('denc', $variation_status),
                'variation_createby' => $this->enc('denc', $variation_createby),
                'variation_editby' => $this->enc('denc', $variation_editby),
                'variation_cdate' => $variation_cdate,
                'variation_edate' => $variation_edate,
                'revision_no' => $this->enc('denc', $revision_no),
                'variation_atten' => $this->enc('denc', $variation_atten),
                'v_sub_name' => strtoupper($this->enc('denc', $v_sub_name)),
                'region_name' => strtoupper($this->enc('denc', $region_name)),
                'salesman_code' => $this->enc('denc', $salesman_code),
                'salesman_name' => $this->enc('denc', $salesman_name),
                'sdate' => $sdate,
                'dispproject' => $dispproject,
                'whochange' => $this->enc('denc', $whochange),
                'datechange' =>  $datechange,
                'vno' => $vno,
                'reldate' => $reldate,
                'reldate_n' => $reldate_n,
                'reldate_d' => $reldate_d,
                'approvedate' => $approvedate,
                'approvedate_n' => $approvedate_n,
                'approvedate_d' => $approvedate_d,
                'caceldate' => $caceldate,
                'caceldate_n' => $caceldate_n,
                'caceldate_d' => $caceldate_d,
                'recived_date' => $recived_date,
                'recived_date_n' => $recived_date_n,
                'recived_date_d' => $recived_date_d,
            );
        }
        $this->response = array(
            "msg" => "1",
            "data" => $_revision
        );
        return json_encode($this->response);
        exit();
    }

    public function VariationsAllRevision($project_no, $token)
    {
        $this->revison_project = $this->enc('enc', $project_no);
        $this->variation_token = $token;
        $this->sql = "SELECT *from (($this->nafco_variation_revison
                inner join variation_subject
                on $this->nafco_variation_revison.revision_subject=variation_subject.v_sub_id)
                inner join
                pms_salesmans
                on $this->nafco_variation_revison.revision_salesman = pms_salesmans.salesman_code)
                inner join
                pms_region
                on
                $this->nafco_variation_revison.revision_region = pms_region.region_id
                where
                $this->nafco_variation_revison.revison_project=:revison_project
                and
                $this->nafco_variation_revison.variation_token=:variation_token
                order by $this->nafco_variation_revison.revison_id desc";
        $this->cm = $this->cn->prepare($this->sql);

        // $xsql = "SELECT *from (($this->nafco_variation_revison
        // inner join variation_subject
        // on $this->nafco_variation_revison.revision_subject=variation_subject.v_sub_id)
        // inner join
        // pms_salesmans
        // on $this->nafco_variation_revison.revision_salesman = pms_salesmans.salesman_code)
        // inner join
        // pms_region
        // on
        // $this->nafco_variation_revison.revision_region = pms_region.region_id
        // where
        // $this->nafco_variation_revison.revison_project='$this->revison_project'
        // and
        // $this->nafco_variation_revison.variation_token='$this->variation_token'
        // order by $this->nafco_variation_revison.revison_id desc";

        //echo $xsql;
        $_params = array(
            ":revison_project" => $this->revison_project,
            ":variation_token" => $this->variation_token
        );
        $this->cm->execute($_params);
        $_revisions = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $xdate  = date_create($revision_date);
            $ddate = date_format($xdate, 'd-M-Y');
            
            $_revisions[] = array(
                'revison_token' => $revison_token,
                'revison_project' => $this->enc('denc', $revison_project),
                'revison_project_name' => $this->enc('denc', $revison_project_name),
                'revison_project_location' => $this->enc('denc', $revison_project_location),
                'revison_refno_p1' => $this->enc('denc', $revison_refno_p1),
                'revison_refno_p2' => $this->enc('denc', $revison_refno_p2),
                'revison_refno_p3' => $this->enc('denc', $revison_refno_p3),
                'revison_refno_p4' => $this->enc('denc', $revison_refno_p4),
                'revison_refno' => $this->enc('denc', $revison_refno),
                'revison_no' => $this->enc('denc', $revison_no),
                'revision_date' => $ddate,
                'revision_to' => $this->enc('denc', $revision_to),
                'revision_subject' => (string)$revision_subject,
                'revision_description' => $this->enc('denc', $revision_description),
                'revision_amount' => $this->enc('denc', $revision_amount),
                'revision_region' => (string)$revision_region,
                'revision_salesman' => $this->enc('denc', $revision_salesman),
                'revision_status' => $this->enc('denc', $revision_status),
                'revision_createdby' => $this->enc('denc', $revision_createdby),
                'revision_editby' => $revision_editby,
                'revision_cdate' => $revision_cdate,
                'revision_edate' => $revision_edate,
                'variation_token' => $variation_token,
                'revison_atten' => $this->enc('denc', $revison_atten),
                'revision_remark' => $this->enc('denc', $revision_remark),
                'v_sub_name' => strtoupper($this->enc('denc', $v_sub_name)),
                'region_name' => strtoupper($this->enc('denc', $region_name)),
                'salesman_code' => $this->enc('denc', $salesman_code),
                'salesman_name' => $this->enc('denc', $salesman_name),
                'revision_status_n' => $revision_status_n,
                'whochange' => $this->enc('denc', $whochange),
                'datechange' =>  $datechange,
            );
        }

        $this->response = array(
            "msg" => "1",
            "data" => $_revisions
        );
        return json_encode($this->response);
        exit();
    }

    public function GetVariationsinfobyP3($project_no, $p3no)
    {
        $this->revison_project = $this->enc('enc', $project_no);
        $this->revison_refno_p3 = $this->enc('enc', $p3no);
        $this->sql = "SELECT *from ($this->nafco_variation_revison
            inner join variation_subject
            on $this->nafco_variation_revison.revision_subject=variation_subject.v_sub_id)
            inner join
            pms_salesmans
            on $this->nafco_variation_revison.revision_salesman = pms_salesmans.salesman_code
            where $this->nafco_variation_revison.revison_project=:revison_project and $this->nafco_variation_revison.revison_refno_p3=:revison_refno_p3 order by $this->nafco_variation_revison.revison_id desc";
        $_params = array(
            ":revison_project" => $this->revison_project,
            ":revison_refno_p3" => $this->revison_refno_p3
        );
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($_params);
        $_ok = $this->cm->rowCount() !== 0  ? true : false;
        if ($_ok === true) {
            $this->rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            extract($this->rows);
            $_revisions = array(
                'revison_id' => $revison_id,
                'revison_token' => $revison_token,
                'revison_project' => $this->enc('denc', $revison_project),
                'revison_project_name' => $this->enc('denc', $revison_project_name),
                'revison_project_location' => $this->enc('denc', $revison_project_location),
                'revison_refno_p1' => $this->enc('denc', $revison_refno_p1),
                'revison_refno_p2' => $this->enc('denc', $revison_refno_p2),
                'revison_refno_p3' => $this->enc('denc', $revison_refno_p3),
                'revison_refno_p4' => $this->enc('denc', $revison_refno_p4),
                'revison_refno' => $this->enc('denc', $revison_refno),
                'revison_no' => $this->enc('denc', $revison_no),
                'revision_date' => $revision_date,
                'revision_to' => $this->enc('denc', $revision_to),
                'revision_subject' => (string)$revision_subject,
                'revision_description' => $this->enc('denc', $revision_description),
                'revision_amount' => $this->enc('denc', $revision_amount),
                'revision_region' =>  (string)$revision_region,
                'revision_salesman' => $this->enc('denc', $revision_salesman),
                'revision_status' => $this->enc('denc', $revision_status),
                'revision_createdby' => $this->enc('denc', $revision_createdby),
                'revision_editby' => $revision_editby,
                'revision_cdate' => $revision_cdate,
                'revision_edate' => $revision_edate,
                'variation_token' => $variation_token,
                'revison_atten' => $this->enc('denc', $revison_atten),
                'revision_remark' => $this->enc('denc', $revision_remark),
                'whochange' => $this->enc('denc', $whochange),
                'datechange' =>  $datechange,
            );

            $this->response = array(
                "msg" => "1",
                "data" => $_revisions
            );
        } else {
            $this->response = array(
                'msg' => "0",
                "data" => "No data found"
            );
        }
        return json_encode($this->response);
        exit();
    }

    public function GetVariationsinfo($project_no, $token)
    {
        $this->revison_project = $this->enc('enc', $project_no);
        $this->revison_token = $this->enc('enc', $token);
        $this->sql = "SELECT *from ($this->nafco_variation_revison
                inner join variation_subject
                on $this->nafco_variation_revison.revision_subject=variation_subject.v_sub_id)
                inner join
                pms_salesmans
                on $this->nafco_variation_revison.revision_salesman = pms_salesmans.salesman_code
                where $this->nafco_variation_revison.revison_project=:revison_project and $this->nafco_variation_revison.revison_token=:revison_token";
        $_params = array(
            ":revison_project" => $this->revison_project,
            ":revison_token" => $this->revison_token
        );
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($_params);
        $_ok = $this->cm->rowCount() !== 0  ? true : false;
        if ($_ok === true) {
            $this->rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            extract($this->rows);
            $_revisions = array(
                'revison_token' => $revison_token,
                'revison_project' => $this->enc('denc', $revison_project),
                'revison_project_name' => $this->enc('denc', $revison_project_name),
                'revison_project_location' => $this->enc('denc', $revison_project_location),
                'revison_refno_p1' => $this->enc('denc', $revison_refno_p1),
                'revison_refno_p2' => $this->enc('denc', $revison_refno_p2),
                'revison_refno_p3' => $this->enc('denc', $revison_refno_p3),
                'revison_refno_p4' => $this->enc('denc', $revison_refno_p4),
                'revison_refno' => $this->enc('denc', $revison_refno),
                'revison_no' => $this->enc('denc', $revison_no),
                'revision_date' => $revision_date,
                'revision_to' => $this->enc('denc', $revision_to),
                'revision_subject' => (string)$revision_subject,
                'revision_description' => $this->enc('denc', $revision_description),
                'revision_amount' => $this->enc('denc', $revision_amount),
                'revision_region' =>  (string)$revision_region,
                'revision_salesman' => $this->enc('denc', $revision_salesman),
                'revision_status' => $this->enc('denc', $revision_status),
                'revision_createdby' => $this->enc('denc', $revision_createdby),
                'revision_editby' => $revision_editby,
                'revision_cdate' => $revision_cdate,
                'revision_edate' => $revision_edate,
                'variation_token' => $variation_token,
                'revison_atten' => $this->enc('denc', $revison_atten),
                'revision_remark' => $this->enc('denc', $revision_remark),
                'whochange' => $this->enc('denc', $whochange),
                'datechange' => $datechange,
            );

            $this->response = array(
                "msg" => "1",
                "data" => $_revisions
            );
        } else {
            $this->response = array(
                'msg' => "0",
                "data" => "No data found"
            );
        }
        return json_encode($this->response);
        exit();
    }



    public function RemoveVariations($project_no, $token)
    {
        $this->variation_project = $this->enc('enc', $project_no);
        $this->variation_token = $token;
        //remove variations
        $this->sql = "DELETE FROM $this->nafco_variation where variation_project=:variation_project and variation_token=:variation_token";
        $_params = array(
            "variation_project" => $this->variation_project,
            "variation_token" => $this->variation_token
        );
        $this->cm = $this->cn->prepare($this->sql);
        $_ok = $this->cm->execute($_params);
        $this->sql = "DELETE from $this->nafco_variation_revison where revison_project=:variation_project and revison_token=:variation_token";
        $this->cm = $this->cn->prepare($this->sql);
        $_k = $this->cm->execute($_params);
        if ($_ok === true && $_k === true) {
            $this->response = array(
                "msg" => '1',
                "data" => 'Removed'
            );
        } else {
            $this->response = array(
                "msg" => "0",
                "data" => "error In data base"
            );
        }
        //remove revision
        return json_encode($this->response);
        exit();
    }
    public function RemoveRevision($project, $token, $retoken)
    {
        $this->revison_project = $this->enc('enc', $project);
        $this->revison_token = $retoken;
        $this->variation_token = $token;
        $this->sql = "DELETE FROM $this->nafco_variation_revison where revison_project=:revison_project and revison_token=:revison_token and variation_token=:variation_token";
        $_params = array(
            ":revison_project" => $this->revison_project,
            ":revison_token" => $this->revison_token,
            ":variation_token" => $this->variation_token
        );
        $this->cm = $this->cn->prepare($this->sql);
        if ($this->cm->execute($_params)) {
            $this->response = array(
                "msg" => "1",
                "data" => "Removed"
            );
        } else {
            $this->response = array(
                "msg" => "0",
                "data" => "Error In database"
            );
        }
        return json_encode($this->response);
        exit();
    }

    public function update_revision_status($token_variation, $token_revison, $project_no, $status, $whochange, $datechange)
    {
        $this->revison_project = $this->enc('enc', $project_no);
        $this->revison_token = $token_revison;
        $this->variation_token = $token_variation;
        $this->revision_status = $this->enc('enc', $status);

        $this->sql = "UPDATE $this->nafco_variation set
        variation_status=:revision_status,
        whochange=:whochange,
        datechange=:datechange
        where variation_project=:variation_project and variation_token=:variation_token";
        $this->cm = $this->cn->prepare($this->sql);
        $_params = array(
            ':revision_status' => $this->revision_status,
            ':whochange' => $whochange,
            ':datechange' => $datechange,
            ':variation_project' => $this->revison_project,
            ':variation_token' => $this->variation_token,
        );
        //echo "itw woring";
        $_ok = false;
        if ($this->cm->execute($_params)) {
            $_ok = true;
            //        echo "ok ";
        }

        $_ok2 = true;
        $this->sql = "UPDATE $this->nafco_variation_revison set revision_status=:revision_status,
        whochange=:whochange,
        datechange=:datechange  where revison_token=:revison_token and revison_project=:revison_project and variation_token=:variation_token";
        $this->cm = $this->cn->prepare($this->sql);
        $_params = array(
            ':revision_status' => $this->revision_status,
            ':whochange' => $whochange,
            ':datechange' => $datechange,
            ':revison_token' => $this->revison_token,
            ':revison_project' => $this->revison_project,
            ':variation_token' => $this->variation_token
        );
        if ($this->cm->execute($_params)) {
            $_ok2 = true;
            //echo "ok -1";
        }

        if ($_ok === true && $_ok2 === true) {
            $this->response = array(
                'msg' => "1",
                'data' => "udpated"
            );
        } else {
            $this->response = array(
                'msg' => "0",
                'data' => "Error"
            );
        }
        return json_encode($this->response);
        exit();
    }


    public function update_revision_approve($token_variation, $token_revison, $project_no, $status, $amount)
    {
        $this->revison_project = $this->enc('enc', $project_no);
        $this->revison_token = $token_revison;
        $this->variation_token = $token_variation;
        $this->revision_status = $this->enc('enc', $status);
        $this->revision_amount = $this->enc('enc', $amount);

        $this->sql = "UPDATE $this->nafco_variation set variation_status=:revision_status,variation_amount=:variation_amount where variation_project=:variation_project and variation_token=:variation_token";
        $this->cm = $this->cn->prepare($this->sql);
        $_params = array(
            ':revision_status' => $this->revision_status,
            ':variation_amount' => $this->revision_amount,
            ':variation_project' => $this->revison_project,
            ':variation_token' => $this->variation_token
        );
        //echo "itw woring";
        $_ok = false;
        if ($this->cm->execute($_params)) {
            $_ok = true;
            //        echo "ok ";
        }

        $_ok2 = true;
        $this->sql = "UPDATE $this->nafco_variation_revison set revision_status=:revision_status,revision_amount=:revision_amount where revison_token=:revison_token and revison_project=:revison_project and variation_token=:variation_token";
        $this->cm = $this->cn->prepare($this->sql);
        $_params = array(
            ':revision_status' => $this->revision_status,
            ':revision_amount' => $this->revision_amount,
            ':revison_token' => $this->revison_token,
            ':revison_project' => $this->revison_project,
            ':variation_token' => $this->variation_token
        );
        if ($this->cm->execute($_params)) {
            $_ok2 = true;
            //echo "ok -1";
        }

        if ($_ok === true && $_ok2 === true) {
            $this->response = array(
                'msg' => "1",
                'data' => "udpated"
            );
        } else {
            $this->response = array(
                'msg' => "0",
                'data' => "Error"
            );
        }
        return json_encode($this->response);
        exit();
    }


    public function NewRpttot()
    {
        $this->sql = "SELECT *FROM pms_project_summary";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $rept = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $project = $this->rows['project_no'];

            $sql = "SELECT *from ((nafco_variation
                inner join
                variation_subject
                on
                nafco_variation.variation_subject = variation_subject.v_sub_id)
                inner join
                pms_salesmans
                on
                nafco_variation.variation_salesman = pms_salesmans.salesman_code)
                inner join
                pms_region
                on
                nafco_variation.variation_region = pms_region.region_id
                where  nafco_variation.variation_project='$project'
                order by nafco_variation.variation_id desc
                ";
            //echo $sql . "</br>";
            $cm = $this->cn->prepare($sql);
            $cm->execute();
            $totamount = 0;
            if ($cm->rowCount() > 0) {
                while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
                    extract($rows);
                    $xdate  = date_create($variation_date);
                    $ddate = date_format($xdate, 'd-M-Y');
                    $sdate = date_format($xdate, 'Y-m-d');
                    $_approvedate = date_create($approvedate);
                    $approvedate = date_format($_approvedate, 'Y-m-d');
                    $approvedate_n = date_format($_approvedate, 'd-m-Y');
                    $approvedate_d = date_format($_approvedate, 'd-M-Y');

                    $_reldate = date_create($reldate);
                    $reldate = date_format($_reldate, 'Y-m-d');
                    $reldate_n = date_format($_reldate, 'd-m-Y');
                    $reldate_d = date_format($_reldate, 'd-M-Y');

                    $_caceldate = date_create($caceldate);
                    $caceldate = date_format($_caceldate, 'Y-m-d');
                    $caceldate_n = date_format($_caceldate, 'd-m-Y');
                    $caceldate_d = date_format($_caceldate, 'd-M-Y');

                    $_recived_date = date_create($recived_date);
                    $recived_date = date_format($_recived_date, 'Y-m-d');
                    $recived_date_n = date_format($_recived_date, 'd-m-Y');
                    $recived_date_d = date_format($_recived_date, 'd-M-Y');

                    $_vo = $this->enc('denc', $vno);
                    $vno = $_vo;
                    if ($_vo === 0 || $_vo === '0') {
                        $vno = '-';
                    }


                    $dispproject = $this->enc('denc', $variation_project_name) . "[" . $this->enc('denc', $variation_project) . "]";
                    $totamount += (float)$this->enc('denc', $variation_amount);

                    $rept[] = array(
                        'variation_id' => $variation_id,
                        'variation_token' => $variation_token,
                        'variation_project' => $this->enc('denc', $variation_project),
                        'variation_project_name' => $this->enc('denc', $variation_project_name),
                        'variation_project_location' => $this->enc('denc', $variation_project_location),
                        'variation_refno_p1' => $this->enc('denc', $variation_refno_p1),
                        'variation_refno_p2' => $this->enc('denc', $variation_refno_p2),
                        'variation_refno_p3' => $this->enc('denc', $variation_refno_p3),
                        'variation_refno_p4' => $this->enc('denc', $variation_refno_p4),
                        'variation_refno' => $this->enc('denc', $variation_refno),
                        'variation_date' => $ddate,
                        'variation_to' => $this->enc('denc', $variation_to),
                        'variation_subject' => (string)$variation_subject,
                        'variation_description' => $this->enc('denc', $variation_description),
                        'variation_amount' => $this->enc('denc', $variation_amount),
                        'variation_remarks' => $this->enc('denc', $variation_remarks),
                        'variation_region' => (string)$variation_region,
                        'variation_salesman' => $this->enc('denc', $variation_salesman),
                        'variation_status' => $this->enc('denc', $variation_status),
                        'variation_createby' => $this->enc('denc', $variation_createby),
                        'variation_editby' => $this->enc('denc', $variation_editby),
                        'variation_cdate' => $variation_cdate,
                        'variation_edate' => $variation_edate,
                        'revision_no' => $this->enc('denc', $revision_no),
                        'variation_atten' => $this->enc('denc', $variation_atten),
                        'v_sub_name' => strtoupper($this->enc('denc', $v_sub_name)),
                        'region_name' => strtoupper($this->enc('denc', $region_name)),
                        'salesman_code' => $this->enc('denc', $salesman_code),
                        'salesman_name' => $this->enc('denc', $salesman_name),
                        'sdate' => $sdate,
                        'dispproject' => $dispproject,
                        'types' => "lists",
                        'whochange' => $this->enc('denc', $whochange),
                        'datechange' =>  $datechange,
                        'vno' => $vno,
                        'reldate' => $reldate,
                        'reldate_n' => $reldate_n,
                        'reldate_d' => $reldate_d,
                        'approvedate' => $approvedate,
                        'approvedate_n' => $approvedate_n,
                        'approvedate_d' => $approvedate_d,
                        'caceldate' => $caceldate,
                        'caceldate_n' => $caceldate_n,
                        'caceldate_d' => $caceldate_d,
                        'recived_date' => $recived_date,
                        'recived_date_n' => $recived_date_n,
                        'recived_date_d' => $recived_date_d,

                    );
                }
                $rept[] = array(
                    'variation_amount' =>  (string)$totamount,
                    'revision_no' => "Total",
                    'variation_status' => '',
                    'dispproject' => $dispproject,
                );
            }
        }
        $this->response = array(
            "msg" => "1",
            "data" => $rept
        );
        return json_encode($this->response);
        exit();
    }
    public function Rpt()
    {

        $this->sql = "SELECT *from (($this->nafco_variation
                    inner join
                    variation_subject
                    on
                    $this->nafco_variation.variation_subject = variation_subject.v_sub_id)
                    inner join
                    pms_salesmans
                    on
                    $this->nafco_variation.variation_salesman = pms_salesmans.salesman_code)
                    inner join
                    pms_region
                    on
                    $this->nafco_variation.variation_region = pms_region.region_id
                    order by $this->nafco_variation.variation_id desc
                    ";
        //echo $this->sql;
        $this->cm = $this->cn->prepare($this->sql);
        ///$this->cm->bindParam(":variation_project", $this->variation_project);
        $this->cm->execute();
        $_variations = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $xdate  = date_create($variation_date);
            $ddate = date_format($xdate, 'd-M-Y');
            $sdate = date_format($xdate, 'Y-m-d');
            $variation_statustext = '';
            switch ($this->enc('denc', $variation_status)) {
                case '1':
                    $variation_statustext  = 'ISSUED FOR APPROVAL';
                    break;
                case '2':
                    $variation_statustext = 'APPROVED';
                    break;
                case '3':
                    $variation_statustext = 'CANCELLED';
                    break;
                case '4':
                    $variation_statustext = 'DUMMY';
                    break;
                case '5':
                    $variation_statustext = 'PAID/INVOICE';
                    break;
            }
            $dispproject = $this->enc('denc', $variation_project_name) . "[" . $this->enc('denc', $variation_project) . "]";
            $_variations[] = array(
                'variation_statustext' => $variation_statustext,
                'variation_id' => $variation_id,
                'variation_token' => $variation_token,
                'variation_project' => $this->enc('denc', $variation_project),
                'variation_project_name' => $this->enc('denc', $variation_project_name),
                'variation_project_location' => $this->enc('denc', $variation_project_location),
                'variation_refno_p1' => $this->enc('denc', $variation_refno_p1),
                'variation_refno_p2' => $this->enc('denc', $variation_refno_p2),
                'variation_refno_p3' => $this->enc('denc', $variation_refno_p3),
                'variation_refno_p4' => $this->enc('denc', $variation_refno_p4),
                'variation_refno' => $this->enc('denc', $variation_refno),
                'variation_date' => $ddate,
                'variation_to' => $this->enc('denc', $variation_to),
                'variation_subject' => (string)$variation_subject,
                'variation_description' => $this->enc('denc', $variation_description),
                'variation_amount' => $this->enc('denc', $variation_amount),
                'variation_remarks' => $this->enc('denc', $variation_remarks),
                'variation_region' => (string)$variation_region,
                'variation_salesman' => $this->enc('denc', $variation_salesman),
                'variation_status' => $this->enc('denc', $variation_status),
                'variation_createby' => $this->enc('denc', $variation_createby),
                'variation_editby' => $this->enc('denc', $variation_editby),
                'variation_cdate' => $variation_cdate,
                'variation_edate' => $variation_edate,
                'revision_no' => $this->enc('denc', $revision_no),
                'variation_atten' => $this->enc('denc', $variation_atten),
                'v_sub_name' => strtoupper($this->enc('denc', $v_sub_name)),
                'region_name' => strtoupper($this->enc('denc', $region_name)),
                'salesman_code' => $this->enc('denc', $salesman_code),
                'salesman_name' => $this->enc('denc', $salesman_name),
                'sdate' => $sdate,
                'dispproject' => $dispproject,
                'whochange' => $this->enc('denc', $whochange),
                'datechange' => $datechange,//check encription and save part need
                'vno' => $this->enc('denc',$vno),
                'approvedate' => date_format(date_create($approvedate),'Y-m-d'),
                'approvedate_d' => date_format(date_create($approvedate),'d-M-Y'),
                'approvedate_n' => date_format(date_create($approvedate),'d-m-Y'),
                'approvedate_p' => date_format(date_create($approvedate),'d-m-y'),

                'reldate' => date_format(date_create($reldate),'Y-m-d'),
                'reldate_d' => date_format(date_create($reldate),'d-M-Y'),
                'reldate_n' => date_format(date_create($reldate),'d-m-Y'),
                'reldate_p' => date_format(date_create($reldate),'d-m-y'),

                'caceldate' => date_format(date_create($caceldate),'Y-m-d'),
                'caceldate_d' => date_format(date_create($caceldate),'d-M-Y'),
                'caceldate_n' => date_format(date_create($caceldate),'d-m-Y'),
                'caceldate_p' => date_format(date_create($caceldate),'d-m-y'),
                'cancelby' => $cancelby === '0' ? '-' : $this->enc('denc',$cancelby),
                'amountrecviced' => $this->enc('denc',$amountrecviced),

                'recived_date' => date_format(date_create($recived_date),'Y-m-d'),
                'recived_date_d' => date_format(date_create($recived_date),'d-M-Y'),
                'recived_date_n' => date_format(date_create($recived_date),'d-m-Y'),
                'recived_date_p' => date_format(date_create($recived_date),'d-m-y'),
                'reftext' => $this->enc('denc',$reftext),
                'vno' => $vno === '0' ? '-' :$this->enc('denc',$vno),
                // 'vno' => $this->enc('denc',$vno) === "" ? "-" : $this->enc('denc',$vno),


            );
        }
        $this->response = array(
            "msg" => "1",
            "data" => $_variations
        );
        return json_encode($this->response);
        exit();
    }

    public function NewVariationSubject($variationSubject)
    {
        $this->v_sub_name = $this->enc('enc', $variationSubject);

        $this->sql = "SELECT *FROM $this->variation_subject where v_sub_name=:v_sub_name";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":v_sub_name", $this->v_sub_name);
        $this->cm->execute();
        $dub = $this->cm->rowCount() === 0 ? true : false;

        if ($dub === true) {
            $this->sql = "INSERT INTO $this->variation_subject values(null,:v_sub_name)";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":v_sub_name", $this->v_sub_name);
            if ($this->cm->execute()) {
                $this->response = array("msg" => "1", "data" => "Saved");
            } else {
                $this->response = array("msg" => "0", "data" => "Database Error");
            }
        } else {
            $this->response = array("msg" => "0", "data" => "Dublicate Found");
        }

        return json_encode($this->response);
        exit();
    }

    public function ListVariationSubject()
    {
        $this->sql = "SELECT *FROM $this->variation_subject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $_subjectsname = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $_subjectsname[] = array(
                "v_sub_id" => $v_sub_id,
                "v_sub_name" => $this->enc('denc', $v_sub_name)
            );
        }
        $this->response = array("msg" => "1", "data" => $_subjectsname);
        return json_encode($this->response);
        exit();
    }

    public function EditVariations($sv)
    {
        //print_r($sv);
        $this->sql = "UPDATE nafco_variation set
                variation_refno_p1=:variation_refno_p1,
                variation_refno_p2=:variation_refno_p2,
                variation_refno_p3=:variation_refno_p3,
                variation_refno_p4=:variation_refno_p4,
                variation_refno=:variation_refno,
                variation_date=:variation_date,
                variation_to=:variation_to,
                variation_subject=:variation_subject,
                variation_description=:variation_description,
                variation_amount=:variation_amount,
                variation_remarks=:variation_remarks,
                variation_region=:variation_region,
                variation_salesman=:variation_salesman,
                variation_editby=:variation_editby,
                variation_edate=:variation_edate,
                revision_no=:revision_no,
                variation_atten=:variation_atten
                where
                variation_id=:variation_id";
        //echo $this->sql;
        $this->cm = $this->cn->prepare($this->sql);
        if ($this->cm->execute($sv)) {
            $this->response = array("msg" => "1", "data" => "updated");
        } else {
            $this->response = array("msg" => "0", "data" => "error in database");
        }
        return json_encode($this->response);
        exit();
    }

    public function EditRevision($revisions)
    {
        $this->sql = "UPDATE nafco_variation_revison set
            revison_refno_p1=:revison_refno_p1,
            revison_refno_p2=:revison_refno_p2,
            revison_refno_p3=:revison_refno_p3,
            revison_refno_p4=:revison_refno_p4,
            revison_refno=:revison_refno,
            revison_no=:revison_no,
            revision_date=:revision_date,
            revision_to=:revision_to,
            revision_subject=:revision_subject,
            revision_description=:revision_description,
            revision_amount=:revision_amount,
            revision_region=:revision_region,
            revision_salesman=:revision_salesman,
            revision_editby=:revision_editby,
            revision_edate=:revision_edate,
            revison_atten=:revison_atten,
            revision_remark=:revision_remark
            where
            revison_id=:revison_id";
        $this->cm = $this->cn->prepare($this->sql);
        if ($this->cm->execute($revisions)) {
            $this->response = array("msg" => "1", "data" => "Updated");
        } else {
            $this->response = array("msg" => "0", "data" => "Database Error");
        }

        return json_encode($this->response);
        exit();
    }
}
