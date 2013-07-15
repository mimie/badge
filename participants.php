<?php

  include 'dbcon.php';
  include 'badges_functions.php';

  $eventId = $_GET['eventId'];
  $participants = displayParticipantPerEvent($eventId);
  echo $participants;

?>
