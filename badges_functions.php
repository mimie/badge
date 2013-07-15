<?php
include 'dbcon.php';

/*[93] => Array
        (
            [title] => IIA-P 2013 Bowling Tournament
            [start_date] => 2013-06-29 14:30:00
        )
**/
function getAllEvents(){

  $sql = "SELECT id,title,start_date FROM civicrm_event";
  $result = mysql_query($sql) or die(mysql_error());

  $events = array();
  $details = array();

  while($row = mysql_fetch_assoc($result)){
     $eventId = $row['id'];
     $title = $row['title'];
     $startDate = $row['start_date'];

     if($title && $startDate){
     $details['title'] = $title;
     $details['start_date'] = $startDate;

     $events[$eventId] = $details;
     unset($details);
    }
  }

  return $events;

}

/*[6017] => Array
        (
            [name] => Lady Lyn De Leon
            [org] => Isla Lipana and Co./Pricewaterhouse Coopers
        )*/
function getAllContacts(){

  $sql = "SELECT id,display_name,organization_name FROM civicrm_contact";
  $result = mysql_query($sql) or die(mysql_error());

  $contacts = array();
  $details = array();

  while($row = mysql_fetch_assoc($result)){
     $contactId = $row['id'];
     $displayName = $row['display_name'];
     $orgName = $row['organization_name'];

     $details['name'] = $displayName;
     $details['org'] = $orgName;

     $contacts[$contactId] = $details;
     unset($details);
  }

  return $contacts;
}

function getEventParticipantId($eventId){

  $eventId = mysql_real_escape_string($eventId);
  $sql = "SELECT contact_id FROM civicrm_participant WHERE event_id = '{$eventId}'";
  $result = mysql_query($sql) or die(mysql_error());

  $contactIds = array();

  while($row = mysql_fetch_assoc($result)){
    $contactIds[] = $row['contact_id'];
 }
  return $contactIds;
}

function displayAllEvents(){

  $allEvents = getAllEvents();

  $html = "<table border='1'>"
        . "<th>Event Title</th>"
        . "<th>Event Date</th>"
        . "<th>View Participant List</th>";

  foreach($allEvents as $eventId=>$details){
        $title = $details["title"];
        $date = $details["start_date"];
        $date = formatDate($date);
       
    $html = $html."<tr>"
          . "<td>$title</td>"
          . "<td>$date</td>"
          . "<td><a href='participants.php?eventId=$eventId'>Participants</a></td>"
          . "</tr>";
  }

  $html = $html."</table>";

  return $html;
  
}

function formatDate($date){

  $getDate = explode(" ",$date);
  $date = $getDate[0];
  $date = date("j M Y",strtotime($date));
  return $date;
}

function displayParticipantPerEvent($eventId){

  $allContacts = getAllContacts();
  $participants = getEventParticipantId($eventId);

  $html = "<table border='1'>"
        . "<th>Participant Name</th>"
        . "<th>Organization Name</th>"
        . "<th>Print Badge</th>"
        . "<tr><td colspan='3' align='right'><input type='submit' name='print' value='PRINT BADGE'></td></tr>";

  foreach($participants as $contactId){

   $details = $allContacts[$contactId];
   $name = $details["name"];
   $org = $details["org"];

   if($name){

   $html = $html."<tr>"
         . "<td>$name</td>"
         . "<td>$org</td>"
         . "<td><input type='checkbox' name='contactIds[]' value='$contactId'></td>"
         . "<tr>";
   }
 }

  $html = $html."</table>";

  return $html;

}

?>
