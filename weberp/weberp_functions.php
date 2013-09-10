<?php

function getEventByDate($startDate,$endDate){

  $sql = "SELECT id FROM civicrm_event\n"
       . "WHERE start_date BETWEEN '$startDate 00:00:00' AND '$endDate 23:59:59' ORDER BY start_date DESC";
  $result = mysql_query($sql) or die(mysql_error());

  $eventIds = array();

  while($row = mysql_fetch_assoc($result)){
    $eventIds[] = $row['id'];
  }

  return $eventIds;
}

function displayEvents($eventIds){

  $allEvents = getAllEvents();
  $html = "<table>"
        . "<tr>"
        . "<th>Event Title</th>"
        . "<th>Event Date</th>"
        . "<th>Participant List</th>"
        . "</tr>";

  foreach($eventIds as $id){

    $eventInfo = $allEvents["$id"];
    $title = $eventInfo["title"];
    $date = $eventInfo["start_date"];

    $html = $html."<tr>"
          ."<td>$title</td>"
          ."<td>".formatDate($date)."</td>"
          ."<td><a href='participantListing.php?eventId=".$id."'>Participants</a></td>"
          ."</tr>";

  }

  $html = $html."</table>";
  return $html;
}

function getStatusId($eventId,$contactId){

  $sql = "SELECT status_id FROM civicrm_participant WHERE event_id = '$eventId' AND contact_id='$contactId'";
  $result = mysql_query($sql) or die(mysql_error());

  $row = mysql_fetch_assoc($result);
  $statusId = $row["status_id"];

  return $statusId;
}


function searchEventName($eventName){

  $allEvents = getAllEvents();
  $eventIdMatches = array();

  $patternEvent = "/\b\w*".$eventName."\w*\b/";

  foreach($allEvents as $eventId => $details){
    $title = $details["title"];
    $result = preg_match($patternEvent,$title);

    if($result == 1){
      $eventIdMatches[] = $eventId;

    }
  }

  return $eventIdMatches;
}

function getParticipantByEvent($eventId){

 $allContacts = getAllContacts();
 $contactIds = getEventParticipantId($eventId);
 $allEmails = getAllEmails();

 $html = "<table>"
       . "<tr>"
       . "<th>Participant Name</th>"
       . "<th>Organization Name</th>"
       . "<th>Email Address</th>"
       . "<th>Participant Status</th>"
       . "<tr>";

 foreach($contactIds as $id){

  $details = $allContacts[$id];
  $name = $details["name"];
  $org = $details["org"];
  $email = $allEmails[$id];

  $html = $html."<tr>"
        . "<td>$name</td>"
        . "<td>$org</td>"
        . "<td>$email</td>"
        . "</tr>";
  }

  $html = $html."</table>";

  return $html;

 
}

function getParticipantStatusId($contactId,$eventId){

 $contactId = mysql_real_escape_string($contactId);
 $eventId = mysql_real_escape_string($eventId);
 $sql = "SELECT status_id FROM civicrm_participant\n" 
      . "WHERE contact_id = '{$contactId}'"
      . "AND event_id ='{$eventId}'";
 $result = mysql_query($sql) or die(mysql_error());

 $row = mysql_fetch_assoc($result);
 $statusId = $row["status_id"];

 return $statusId;

}

function getParticipantStatusType(){
 
  $status = array();
  
  $sql = "SELECT id,label FROM civicrm_participant_status_type";
  $result = mysql_query($sql) or die(mysql_error());
 
  while($row = mysql_fetch_assoc($result)){
     
     $statusId = $row["id"];
     $statusName = $row["label"];
  
     $status[$statusId] = $statusName;
  }
  
  return $status;
 }


?>
