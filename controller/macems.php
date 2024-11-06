<?php
class emac
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
}
