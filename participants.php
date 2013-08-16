<html>
<head>
<title>Participants</title>
<link rel="stylesheet" type="text/css" href="design.css" />
<style>
#header ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
	
#header li {
  display: inline;
  border: 2px solid #0489B1;
  border-bottom-width: 0;
  margin: 0 0.5em 0 0;
}
	
#header li a {
  padding: 0 1em;
}
	
#header #selected {
  padding-bottom: 1px;
  background: #0489B1;
}

a:link {
  text-decoration:none;
  color:white;
}

a:visited{
  color:white;
}

button {
  background: linear-gradient(to bottom, rgb(97,196,25) 0%,rgb(149,226,90) 100%);
  margin: 0 auto;
  padding: 10px 20px 10px 20px;
	border-radius: 5px;
  border: 1px solid #c4c4c4;
  box-shadow: 0px 6px 0px 0px rgba(88, 163, 31, 1),
    0px 5px 12px 0px rgba(0, 0, 0, 0.6),
    inset 0px 0px 10px -5px rgba(0, 0, 0, 1);
  transition: all 100ms linear;
  touch-callout: none;
  user-select: none;
  cursor: pointer;
  display: block;
  position: relative;
  
  font-family: Arial Black, Gadget, sans-serif;
  font-size: 15px;
  color: #fff;
  text-align: center;
  text-transform: uppercase;
}

button > span {
  display: block;
	-webkit-transform: skew(5deg, 0deg);
}

button:active {
	top: 4px;
  box-shadow: 0px 2px 0px 0px rgba(88, 163, 31, 1),
    0px 5px 5px 0px rgba(0, 0, 0, 0.6),
    inset 0px 0px 10px -5px rgba(0, 0, 0, 1);
}

</style>
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
<div id="header">
<ul>
   <li id="selected" onmouseover="this.style.background='#31B404';" onmouseout="this.style.background='#0489B1';"><a href="events.php"><b>LIST OF EVENTS<b></a></li>
</ul>
</div>
<?php

  echo "<div align='center' style='border: 10px solid #0489B1; padding:15px;'>";

  include 'dbcon.php';
  include 'badges_functions.php';

  if(isset($_GET['eventId'])){
    $eventId = $_GET['eventId'];
    $participants = displayParticipantPerEvent($eventId);
  }
  $participantForm = searchParticipantForm();
  echo $participantForm;

  if(isset($_POST["searchParticipant"])){
     $searchCriteria = $_POST["searchCriteria"];
     $participants = resultSearchParticipant($eventId,$searchCriteria);
     echo $participants;
  }

  elseif(isset($_POST["badgeType"]) && $_POST["badgeType"] == 'default'){
    session_start();
    $contactIds = $_POST["contactIds"];
    $totalSelected = count($contactIds);
    $contactIds = json_encode($contactIds);
    $contactIds = urlencode($contactIds);
    
    echo "<a href='viewBadge.php?ids=".$contactIds."&eventId=".$eventId."' target='_blank'><button type='button'>View Badge of ".$totalSelected." Participant/s</button></a>";
    echo $participants;
  }

  elseif(isset($_POST["badgeType"]) && $_POST["badgeType"] == 'select'){

  echo "<script type='text/javascript'>";
  echo "alert('Please select badge properties');"; 
  echo "document.location.href = 'participants.php?eventId=${eventId}'";
  echo "</script>";
  }

  else{

     if(isset($_GET['eventId'])){
        echo $participants;
     }

  }

  echo "</div>";
 

?>
</body>
</html>
