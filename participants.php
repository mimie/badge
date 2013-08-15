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

function badgeProperties(action)
{
    if(action){
        customize = document.getElementById("customize").value;
        if(customize == action.value){
            document.getElementById("badgeForm").style.display = "block";
        }
        else{
            document.getElementById("badgeForm").style.display = "none";
        }
    }
    else{
        document.getElementById("badgeForm").style.display = "none";
    }
}
</script>
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

  elseif($_POST["badgeType"] == 'default'){
    session_start();
    $contactIds = $_POST["contactIds"];
    $contactIds = json_encode($contactIds);
    $contactIds = urlencode($contactIds);


    echo "<a href='viewBadge.php?ids=".$contactIds."&eventId=".$eventId."' target='_blank'>View Badge</a>";

    
  }

  else{

  $participants = displayParticipantPerEvent($eventId);
  echo $participants;

  }
 

?>
</body>
</html>
