<?php
//need to security for download
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<h1>Error !</h1>";
    exit;
}

$payload = json_decode($_POST['payload']);
$userid = $_POST['userid'];

$gofiles_location = "./../../../assets/cuttinglists/go/";
$file_extendstion = ".pdf";
$donwloadfilename ='GosDownload.zip';
if(file_exists($donwloadfilename)){
    unlink($donwloadfilename);
}
// if(file_exists($userid)){
//     rmdir($userid);
// }
// mkdir($userid,0777);

$zip = new ZipArchive;
$zip->open($donwloadfilename, ZipArchive::CREATE);
foreach ($payload as $x) {
    $file_id = $x->goid;
    $file_newname = explode('/',$x->gofno);   
    $newfilename = $file_newname[0] ."_".$file_newname[1] ;
    $gofile = $gofiles_location . $file_id . $file_extendstion;
    //echo $gofile;
    $gonewfile = $newfilename . $file_extendstion;
    if (file_exists($gofile)) {        
        if (file_exists($gonewfile)) {
            unlink($gonewfile);
        }
        $x = copy($gofile, $gonewfile);
        if($x){
            $zip->addFile($gonewfile);
        }
    }
}

$zip->close();
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename=' . $donwloadfilename);
header('Content-Length: ' . filesize($donwloadfilename));
readfile($donwloadfilename);
