<?php
require_once 'mac.php';

class Variations extends mac
{
    private $cn;
    private $cm;
    private $sql;
    private $response;
    function __construct($db)
    {
        $this->cn = $db;
        $this->response = array("msg" => "0", "data" => "Error");
    }

    private function newvariation_revision($revisionifno)
    {

        $vtoken = $revisionifno[':variation_token'];
        $this->sql  = "UPDATE nafco_variation_revison set revision_status_n='y' where variation_token='$vtoken'";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();

        $this->sql = "INSERT into nafco_variation_revison values(
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
            :datechange,
            :vno,
            :approvedate,
            :reldate,
            :caceldate,
            :cancelby,
            :amountrecviced,
            :recived_date,
            :reftext
        )";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($revisionifno);
        unset($cm, $sql);
    }

    public function NewVariations($vairaionifno, $revisioninfo)
    {
        $this->newvariation_revision($revisioninfo);
        $this->sql = "INSERT into nafco_variation values(
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
            :datechange,
            :vno,
            :approvedate,
            :reldate,
            :caceldate,
            :cancelby,
            :amountrecviced,
            :recived_date,
            :reftext
        )";

        $this->cm = $this->cn->prepare($this->sql);
        if ($this->cm->execute($vairaionifno)) {
            $this->response = array(
                "msg" => "1",
                "data" => "saved"
            );
        } else {
            $this->response = array(
                "msg" => "0",
                "data" => "Database Error"
            );
        }

        return json_encode($this->response);
        exit();
    }

    public function UpdateVariationsInfos($svdata)
    {
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
        if ($this->cm->execute($svdata)) {
            $this->response = array("msg" => "1", "data" => "updated");
        } else {
            $this->response = array("msg" => "0", "data" => "error in database");
        }
        return json_encode($this->response);
        exit();
    }

    public function AddnewRevision($variation, $revision)
    {
        $this->newvariation_revision($revision);
        

        unset($this->sql,$this->cm);

        $this->sql = "UPDATE nafco_variation set
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
        variation_editby = :variation_editby,
        variation_edate = :variation_edate,
        revision_no = :revision_no,
        variation_atten = :variation_atten
        where
        variation_token = :variation_token and
        variation_project = :variation_project";

        $this->cm = $this->cn->prepare($this->sql);
        if ($this->cm->execute($variation)) {
            $this->response = array('msg' => "1", 'data' => "Saved");
        } else {
            $this->response = array('msg' => "0", 'data' => "Database Error");
        }
        return json_encode($this->response);
        exit();
    }

    public function UpdateVariationApproved($variation,$revision){
        $this->sql = "UPDATE nafco_variation set variation_status=:variation_status, 
        vno=:vno,
        approvedate=:approvedate,
        reldate=:reldate 
        where
        variation_project=:variation_project 
        and 
        variation_token=:variation_token";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($variation);

        //update revesion 
        
        unset($this->sql,$this->cm);
        $this->sql = "UPDATE nafco_variation_revison set 
        revision_status = :revision_status,
        vno=:vno,
        approvedate=:approvedate,
        reldate=:reldate 
        where 
        revison_token = :revison_token and 
        revison_project = :revison_project and 
        variation_token = :variation_token";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($revision);

        $this->response = array('msg' => "1",'data' => "Saved");
        return json_encode($this->response);
        exit();
    }


    public function CancelVariations($variation,$revision){
        $this->sql = "UPDATE nafco_variation set 
        variation_status=:variation_status,
        caceldate=:caceldate,
        cancelby=:cancelby 
        where
        variation_project=:variation_project 
        and 
        variation_token=:variation_token";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($variation);
        unset($this->sql,$this->cm);

        $this->sql = "UPDATE nafco_variation_revison set 
        revision_status = :revision_status,
        caceldate=:caceldate,
        cancelby=:cancelby where 
        revison_token = :revison_token and 
        revison_project = :revison_project and 
        variation_token = :variation_token";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($revision);
        
        $this->response = array('msg' => "1",'data' => "Saved");
        return json_encode($this->response);
        exit();
    }

    
}
