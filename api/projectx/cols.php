<?php
  function datemethod($date)
  {
      return array(
          "sorting" => date_format(date_create($date), 'Y-m-d'),
          "display" => date_format(date_create($date), 'd-M-Y'),
          "normal" => date_format(date_create($date), 'd-m-Y'),
          "print" => date_format(date_create($date), 'd-m-y'),
      );
  }
?>
