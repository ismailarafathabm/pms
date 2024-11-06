<?php 
    $baseurl = "http://172.0.100.17:8090/api/stocks";
    $req = curl_init($baseurl);
    $res = curl_exec($req);
    curl_close($req);
?>