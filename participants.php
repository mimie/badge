<html>
<head>
<title>Participants</title>
<link rel="stylesheet" type="text/css" href="design.css" />
<script type="text/javascript">
  var checked=false;
  var formname='';

function checkedAll(formname)
{
  var values= document.getElementById(formname);
 
  if (checked==false)
  {
    checked=true;
  }
 
  else
  {
    checked = false;
  }

 for (var i=0; i < values.elements.length; i++)
 {
   values.elements[i].checked=checked;
 }

}
</script>
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
