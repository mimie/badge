<?php

  include 'dbcon.php';
  include 'badges_functions.php';
  include 'weberp_functions.php';

  $searchEvent = searchEventName("Auditing");
  var_dump($searchEvent);

  $searchEvent2 = searchEventName("Chain");
  var_dump($searchEvent2);

  $searchEvent3 = searchEventName("karen");
  var_dump($searchEvent3);

?>
