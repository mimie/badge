<?php

  include '../dbcon.php';
  include '../badges_functions.php';
  include 'weberp_functions.php';

  $eventId = $_GET["eventId"];

  $displayEventHeader = displayEventHeader($eventId);
  echo $displayEventHeader;
  $displayParticipants = getParticipantByEvent($eventId);
  echo $displayParticipants;
  
?>
