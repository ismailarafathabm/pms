<?php
function readfile_chunked($filename,$retbytes=true) {
   $chunksize = 50*(1024*1024); // how many bytes per chunk the user wishes to read
   $buffer = '';
   $cnt =0;
   $handle = fopen($filename, 'rb');
   if ($handle === false) {
      return false;
   }
   while (!feof($handle)) {
      $buffer = fread($handle, $chunksize);
      echo $buffer;
      if ($retbytes) {
         $cnt += strlen($buffer);
      }
   }
   $status = fclose($handle);
   if ($retbytes && $status) {
      return $cnt; // return number of bytes delivered like readfile() does.
   }
   return $status;
}
$fn= $_GET['fname'];
$x = '../assets/approvals/'.$fn;
echo $x;
readfile_chunked($x);
?>