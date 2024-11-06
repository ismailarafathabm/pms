<?php 
    $header = apache_request_headers();
    foreach ($header as $header => $value) {
        echo "$header: $value <br />\n";
    }

?>