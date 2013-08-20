<?php

  include 'dbcon.php';
  include 'badges_functions.php';
  
  $contactIds = urldecode($_REQUEST['ids']);
  $contactIds = json_decode($contactIds);

  $eventId = urldecode($_REQUEST['eventId']);
  $eventId = json_decode($eventId);

  $properties = urldecode($_REQUEST['properties']);
  $properties = json_decode($properties);
?>
