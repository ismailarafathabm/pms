<?php 
  include_once '../cuttinglists/gen.php';
  if ($method !== 'POST') {
      header('HTTP/1.0 404 page not found');
      echo response("0", "Request Method Not Acceptable");
      exit;
  }
  $auth = true;    
  include_once '../cuttinglists/auth.php';
  if (!$auth) {
      header("HTTP/1.0 403 Authorization Error");
      echo response("0", "You Cannot Access This Page right Now Please Re-Login your Account");
      exit;
  }
  $bom_id = !isset($_GET['bom_id']) || trim($_GET['bom_id']) === '' ? '' : trim($_GET['bom_id']);

  if($bom_id === ''){
    header("HTTP/1.0 409 input missing");
    echo response("0","Enter Project Name");
    exit;
  }
  $bom_no = !isset($_POST['bom_no']) || trim($_POST['bom_no']) === '' ? '' : trim($_POST['bom_no']);
  if($bom_no ===''){
    header("HTTP/1.0 409 input missing");
    echo response("0","Enter BOM NO");
    exit;
  }
  $bom_projectno = !isset($_POST['bom_projectno']) || trim($_POST['bom_projectno']) === '' ? '' : trim($_POST['bom_projectno']);
  if($bom_projectno ===''){
    header("HTTP/1.0 409 input missing");
    echo response("0","Enter Project");
    exit;
  }
  include_once '../../controller/bomn.php';
  $bom = new Bomn($cn);
  echo $bom->DeleteBomItem($bom_id,$uuser,$bom_no,$bom_projectno);
  exit;
?>