<?php
    require_once 'mac.php';
    class Sales extends mac{
        private $cn;
        private $cm;
        private $sql;
        private $rows;

        function __construct($db){
            $this->cn = $db;
            $this->response = array(
                'msg' => "0",
                'data' => "_error"
            );
        }
        private function denc($val){
            return $this->enc('denc',$val);
        }
        private function _new_refno(){
            $REFNO = "";
            $this->sql = "SELECT *FROM pms_sales order by sales_refno desc limit 1";
            $this->cm = $this->cn->prepare($this->sql);
            $cnt = $this->cm->rowCount() === 0 ? true : false;            
            if($cnt){
                $REFNO = "1";
            }else{
                $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
                $lno = (int)$this->enc('denc',$rows['srefnol']);
                $lno += 1;
                $REFNO = $lno;
            }
            unset($this->sql,$this->cm,$rows);
            return $REFNO;
        }
        private function _checkProject($projectname){
            $isproject = false;
            $this->sql  = "SELECT *FROM pms_sales where salse_project=:salse_project";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":salse_project",$projectname);
            $this->cm->execute();
            $isproject = $this->cm->rowCount() === 0 ? true : false;
            unset($this->cm,$this->sql);
            return $isproject;
        }
        private function _projectrefno($projectname){
            $this->sql  = "SELECT *FROM pms_sales where salse_project=:salse_project";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":salse_project",$projectname);
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $refno = $this->enc('denc',$rows['sales_refno']);
            unset($this->cm,$this->sql,$rows);
            return $refno;
        }
        public function getRefno($projectname){            
            $refno = "0";
            if($this->_checkProject($projectname)){
                $refno = $this->_projectrefno($projectname);
            }else{
                $refno = $this->_new_refno();
            }
            $this->response = array(
                'msg' => "1",
                'data' => $refno,
            );
            return json_encode($this->response);
            exit();
        }

        public function GetAllSales(){
            $this->sql = "SELECT *FROM pms_sales";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $sales = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($rows);
                $sales[] = array(
                    'sales_sno' => $sales_sno,
                    'ssno' => $this->denc($ssno),
                    'sales_refno' => $this->denc($sales_refno),
                    'sales_contractor' => ucwords(strtolower($this->denc($sales_contractor))),
                    'salse_project' => ucwords(strtolower($this->denc($salse_project))),
                    'sales_contact_persion' => ucwords(strtolower($this->denc($sales_contact_persion))),
                    'sales_contact_details' => $this->denc($sales_contact_details),
                    'salse_location' => ucwords(strtolower($this->denc($salse_location))),
                    'sales_status' => $this->denc($sales_status),
                    'sales_rep' => $this->denc($sales_rep),
                    'sales_documentsrc' => $this->denc($sales_documentsrc),
                    'sales_duration' => $this->denc($sales_duration),
                    'sales_amount' => $this->denc($sales_amount),
                    'sales_proposed_system' => $this->denc($sales_proposed_system),
                    'sales_cost_eng' => $this->denc($sales_cost_eng),
                    'sales_remarks' => $this->denc($sales_remarks),
                    'sales_drawingno' => $this->denc($sales_drawingno),
                    'sales_others' => $this->denc($sales_others),
                    'sales_cby' => $this->denc($sales_cby),
                    'sales_eby' => $this->denc($sales_eby),
                    'del' => $this->denc($del),
                    'srefnol' => $this->denc($srefnol),
                    'sales_document_rcdate' => date_format(date_create($sales_document_rcdate),'Y-m-d'),
                    'sales_document_rcdate_d' => date_format(date_create($sales_document_rcdate),'d-M-Y'),
                    'sales_document_rcdate_n' => date_format(date_create($sales_document_rcdate),'d-m-Y'),
                    'sales_document_rcdate_p' => date_format(date_create($sales_document_rcdate),'d-m-y'),
                    'sales_document_sumitdate' => date_format(date_create($sales_document_sumitdate),'Y-m-d'),
                    'sales_document_sumitdate_d' => date_format(date_create($sales_document_sumitdate),'d-M-Y'),
                    'sales_document_sumitdate_n' => date_format(date_create($sales_document_sumitdate),'d-m-Y'),
                    'sales_document_sumitdate_p' => date_format(date_create($sales_document_sumitdate),'d-m-y'),
                    'sales_releaseddate' => date_format(date_create($sales_releaseddate),'Y-m-d'),
                    'sales_releaseddate_d' => date_format(date_create($sales_releaseddate),'d-M-Y'),
                    'sales_releaseddate_n' => date_format(date_create($sales_releaseddate),'d-m-Y'),
                    'sales_releaseddate_p' => date_format(date_create($sales_releaseddate),'d-m-y'),
                );
            }
            unset($this->sql,$this->cm,$rows);
            return json_encode($this->response);
            exit();
        }
    }
?>