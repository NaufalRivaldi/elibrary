<?php
  $date1=date('Y-m-d');
  $date2="2018-07-02";
  $datetime1 = new DateTime($date1);
  $datetime2 = new DateTime($date2);
  $difference = $datetime1->diff($datetime2);
  $text = $difference->days;
  $text += 1;
  echo $text;
?>