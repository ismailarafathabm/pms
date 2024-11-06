<?php 
// $today = new \DateTime();
// $currentWeekDay = $today->format('w'); // Weekday as a number (0 = Sunday, 6 = Saturday)

// $firstdayofweek = clone $today;
// $lastdayofweek  = clone $today;

// if ($currentWeekDay !== '0') {
//     $firstdayofweek->modify('last saturday');
// }

// if ($currentWeekDay !== '6') {
//     $lastdayofweek->modify('next friday');
// }

// echo $firstdayofweek->format('Y-m-d').PHP_EOL;
// echo $lastdayofweek->format('Y-m-d').PHP_EOL;
// echo getWeekOfYear();
// function getWeekOfYear() {
//     $date = new DateTime("2023-04-14");
//     $dayOfweek = intval( $date->format('w') );

//     if( $dayOfweek == 0 ) {
//         $date->add(new DateInterval('P3D'));
//     } 

//     $weekOfYear = intval( $date->format('W') );

//     return $weekOfYear;
// }
$names = array(
    "materials" => "JOHN",
    "costing" => "Ornan",
    "eng_carlo" => "Ali"
);

echo !isset($names['costing']) ? 'Ismail' : $names['costing'];
?>