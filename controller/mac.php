<?php
//session_start();
class mac
{
    const pms_auth = "pms_auth";
    const pms_user_log = "pms_user_log";
    const pms_project_summary = "pms_project_summary";
    const project_payment_terms = "project_payment_terms";
    const project_conditions = "project_conditions";
    const pms_project_specification = "pms_project_specification";
    const pms_units = "pms_units";
    const pms_ptype = "pms_ptype";
    const pms_systemtype = "pms_systemtype";
    const pms_finish = "pms_finish";
    const pms_poq = "pms_poq";
    const pms_approval_types = "pms_approval_types";
    const pms_approvals = "pms_approvals";
    const pms_class_types = "pms_class_types";
    const pms_boq_notes = "pms_boq_notes";
    const pms_draw_approvals_types = "pms_draw_approvals_types";
    const pms_draw_approvals = "pms_draw_approvals";
    const pms_drawing_approvals_info = "pms_drawing_approvals_info";
    const pms_boq_measurement = "pms_boq_measurement";
    const psm_suppliers = "psm_suppliers";
    const pms_glasstypes = "pms_glasstypes";
    const pms_glassorders = "pms_glassorders";
    const pms_markingtype = "pms_markingtype";
    const pms_cutting_list = 'pms_cutting_list';
    const cuttinglist_qty_type = "cuttinglist_qty_type";
    const variation_subject = "variation_subject";
    const pms_salesmans = "pms_salesmans";
    const pms_region = "pms_region";
    const nafco_variation = "nafco_variation";
    const nafco_variation_revison = "nafco_variation_revison";

    public function token($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function enc($action, $string)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'nafco2020';
        $secret_iv = '2020nafco';
        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'enc') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'denc') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }



    protected function _date($val, $format)
    {
        if (!date_create($val)) {
            return date($format);
        }
        return date_format(date_create($val), $format);
    }

    protected function _datef($val)
    {
        if (!date_create($val)) {
            return array(
                "display" => date('d-M-Y'),
                "display" => date('d-m-Y'),
                "display" => date('d-m-y'),
            );
        }

        return array(
            "display" => date_format(date_create($val), 'd-M-Y'),
            "normal" => date_format(date_create($val), 'd-m-Y'),
            "print" => date_format(date_create($val), 'd-m-y'),
        );
    }

    protected function datemethod($date)
    {
        return array(
            "sorting" => date_format(date_create($date), 'Y-m-d'),
            "display" => date_format(date_create($date), 'd-M-Y'),
            "normal" => date_format(date_create($date), 'd-m-Y'),
            "print" => date_format(date_create($date), 'd-m-y'),
        );
    }

    protected function createlogfile($logs)
    {
        // $ip = json_encode($_REQUEST);

        $ip = '-';
        $user = $_SESSION['nafco_alu_user_name'];
        $currenttoken = $_SESSION['nafco_alu_user_token'];
        $log_date_time = date("d-M-Y H:i:s");
        $log_description = $log_date_time . "::" . $logs . "::" . $ip . "::" . $user . "::" . $currenttoken;
        $log_filename = "logfiles/ERROR_LOG_" . date("YMd");

        if (!file_exists($log_filename)) {
            // create directory/folder uploads.
            mkdir($log_filename, 0777, true);
        }
        $log_file_data = $log_filename . '/log_' . date('d-M-Y') . '.log';
        file_put_contents($log_file_data, $log_description . '\n', FILE_APPEND);
    }
}
