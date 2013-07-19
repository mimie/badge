<html>
<head>
<title>Participants</title>
<link rel="stylesheet" type="text/css" href="design.css" />
</head>
<body>
<?php

  include 'dbcon.php';
  include 'badges_functions.php';

  $eventId = $_GET['eventId'];
  $participantForm = searchParticipantForm();
  echo $participantForm;

  if($_POST["searchParticipant"]){
     $searchCriteria = $_POST["searchCriteria"];
     $participants = resultSearchParticipant($eventId,$searchCriteria);
     echo $participants;
  }

  else{
     $participants = displayParticipantPerEvent($eventId);
     echo $participants;
  }

?>
</body>
</html>
