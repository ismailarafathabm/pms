<?php



// $ddate = "2023-01-02";
// $date = new DateTime($ddate);
// $week = $date->format("W");
// echo "Weeknummer: $week";
?>
<?php
$ddate = "2012-01-02";
$duedt = explode("-", $ddate);
$date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
$week  = (int)date('W', $date);
echo "Weeknummer: " . $week;
?>