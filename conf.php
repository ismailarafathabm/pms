<?php
$url_ssl = "http://";

// $url_domain = "localhost:8082/beta.alunafco/";
$url_domain = "localhost:8082/pms/";
$url_base = $url_ssl . $url_domain;
$url_asset = $url_ssl . $url_domain . "assets/";
$url_logo = $url_ssl . $url_domain . "assets/logos/";
$url_theme = $url_ssl . $url_domain . "themes/";
$url_loginscreen = $url_ssl . $url_domain . "themes/loginscreen/";
$url_router = $url_ssl . $url_domain;

$url_dep_operation = $url_ssl . $url_domain . "Dashboard/";

$base_url = "http://localhost:8082/pms/";

//$emsurl = "http://ems.alunafco.net/";
$emsurl = "http://localhost:8082/EMS/";
$site_name = "National Aluminium Factory,Co(NAFCO)";
$app_name = "Nafco";
$app_version = "1.1.1";
$app_lan = "eng";
$app_developer = "ismailarafath";
$app_author = "nafco IT";
$app_init_date =  "21-01-2020";
$app_last_update = "15-05-2020";
//version informations
$v = "2.2024.4.28.2";


function logos($url, $w, $h)
{
     $img = "<img srce='" . $url . "' widths='" . $w . "' heights='" . $h . "'>";
     return $img;
}



$mode = "1";
if($mode !== "1"){
     ?>
     <h3>Site Under Maintenance</h3>
     <H6>we will be back ASAP</H6>
     <?php
     die();
 }