<?php

  include '../dbcon.php';
  include '../badges_functions.php';
  include 'weberp_functions.php';

  $searchEvent = searchEventName("Auditing");
  var_dump($searchEvent);

  $searchEvent2 = searchEventName("Chain");
  var_dump($searchEvent2);

  $searchEvent3 = searchEventName("karen");
  var_dump($searchEvent3);

  $displayParticipants = getParticipantByEvent("139");
  echo $displayParticipants;

  $statusId = getParticipantStatusId("7831","139");
  var_dump($statusId);

?>
