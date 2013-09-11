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
 $status = getParticipantStatusType();
 

 $html = "<table border='1'>"
       . "<tr>"
       . "<th>Participant Name</th>"
       . "<th>Organization Name</th>"
       . "<th>Email Address</th>"
       . "<th>Participant Status</th>"
       . "<th>Change Participant Status</th>"
       . "<th>Fee Amount</th>"
       . "<th>Post</th>"
       . "<tr>";

 foreach($contactIds as $id){

  $details = $allContacts[$id];
  $name = $details["name"];
  $org = $details["org"];
  $email = $allEmails[$id];

  $feeAmount = getParticipantFeeAmount($id,$eventId);
  
  $statusId = getParticipantStatusId($id,$eventId);
  $statusName = $status[$statusId];
  //$statusTypeSelectForm = statusTypeSelectForm($statusId);

  $html = $html."<tr>"
        . "<td>$name</td>"
        . "<td>$org</td>"
        . "<td>$email</td>"
        . "<td align='center'>$statusName</td>"
        . "<td align='center'><input type='checkbox' name='contactIds[]' value='$id'></td>"
        . "<td align='center'>$feeAmount</td>"
        . "<td align='center'><input type='checkbox' name='contactIds2[]' value='$id'></td>"
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

/*
 *On waitlist, Awaiting Approval, Pending from waitlist,
 *Pending from Approval, Rejected are disabled status type
 */
function getParticipantStatusType(){
 
  $status = array();
  
  $sql = "SELECT id,label FROM civicrm_participant_status_type\n"
       . "WHERE id NOT IN(7,8,9,10)";
  $result = mysql_query($sql) or die(mysql_error());
 
  while($row = mysql_fetch_assoc($result)){
     
     $statusId = $row["id"];
     $statusName = $row["label"];
  
     $status[$statusId] = $statusName;
  }
  
  return $status;
 }

function statusTypeSelectForm($statusId){

  $status = getParticipantStatusType();

  $html = "<SELECT name='statusType'>";

  foreach($status as $id => $statusName){

    $selected = $statusId == $id ? 'selected' : '';
    var_dump($selected);
    $html = $html."<option value='$id' $selected>$statusName</option>";
  }

  $html = $html."</SELECT>";

  return $html;
}

function displayEventHeader($eventId){

  $eventName = getEventName($eventId);
  $html = "<div>"
        . "List of Participants for $eventName"
        . "</div>";

  return $html;
}

function getParticipantFeeAmount($contactId,$eventId){

  $contactId = mysql_real_escape_string($contactId);
  $eventId = mysql_real_escape_string($eventId);

  $sql = "SELECT fee_amount FROM civicrm_participant\n"
       . "WHERE contact_id ='{$contactId}' AND event_id = '{$eventId}'";
  $result = mysql_query($sql) or die(mysql_error());

  $row = mysql_fetch_assoc($result);
  $feeAmount = $row["fee_amount"];

  return $feeAmount;
}
?>
