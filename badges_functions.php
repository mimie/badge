<?php
include 'dbcon.php';

/*[93] => Array
        (
            [title] => IIA-P 2013 Bowling Tournament
            [start_date] => 2013-06-29 14:30:00
        )
**/
function getAllEvents(){

  $sql = "SELECT id,title,start_date FROM civicrm_event ORDER BY start_date DESC";
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

/*
 *eventId is the id of a specific event
 *@return all the contact id of a specific event
 */
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

/*
 *@return html table format of all events
 */
function displayAllEvents(){

  $allEvents = getAllEvents();

  $html = "<h3>List of Events</h3>";

  $html = $html."<table>"
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
          . "<td class='center'><a href='participants.php?eventId=$eventId'>Participants</a></td>"
          . "</tr>";
  }

  $html = $html."</table>";

  return $html;
  
}

/*
 *date is string format of date in the form of 2013-10-23 14:00:00
 *@return date in a format 23 Oct 2013
 */
function formatDate($date){

  $getDate = explode(" ",$date);
  $date = $getDate[0];
  $date = date("j M Y",strtotime($date));
  return $date;
}

/*
 *display all participants in a specific event
 */
function displayParticipantPerEvent($eventId){

  $allContacts = getAllContacts();
  $participants = getEventParticipantId($eventId);
  $emails = getAllEmails();

  $html = "<h3>List of Participants</h3>";
  $html = $html. "<table>"
        . "<th>Participant Name</th>"
        . "<th>Organization Name</th>"
        . "<th>Email Address</th>"
        . "<th>Print Badge</th>"
        . "<tr><td colspan='4' align='right'><input type='submit' name='print' value='PRINT BADGE'></td></tr>";

  foreach($participants as $contactId){

   $details = $allContacts[$contactId];
   $name = $details["name"];
   $org = $details["org"];
   $email = $emails[$contactId];

   if($name){

   $html = $html."<tr>"
         . "<td>$name</td>"
         . "<td>$org</td>"
         . "<td>$email</td>"
         . "<td class='center'><input type='checkbox' name='contactIds[]' value='$contactId'></td>"
         . "<tr>";
   }
 }

  $html = $html."</table>";

  return $html;

}

/*
 *eventName is the pattern of the string searched
 *@return an array of events that matches the pattern string
 */
function searchEvent($eventName){

  $allEvents = getAllEvents();
  $eventMatches = array();

  foreach($allEvents as $eventId => $details){
    $title = $details["title"];
    $result = preg_match("/$eventName/",$title);
    if($result == 1){
      //$eventMatches[] = $event;
        $eventMatches[$eventId] = $details;
    }
  }

  return $eventMatches;
}

/*
 *@return html form for search event
 */
function searchEventForm(){

  $htmlForm = "<form name='event' action='events.php' method='post'>"
            . "<label for='eventTitle'><b>Event Title: </b></label>"
            . "<input type='text' name='eventName'>"
            . "<input type='submit' name='searchEvent' value='SEARCH'>"
            . "</form>";

  return $htmlForm;
}

/*
 *@return an html table for the result of searched events
 */
function displaySearchEvent(array $events){
  
 if($events){
   $html = "<table>"
         . "<th>Event Title</th>"
         . "<th>Event Date</th>"
         . "<th>View Participant List</th>";

   foreach($events as $eventId=>$details){
        $title = $details["title"];
        $date = $details["start_date"];
        $date = formatDate($date);
       
   $html = $html."<tr>"
         . "<td>$title</td>"
         . "<td>$date</td>"
         . "<td class='center'><a href='participants.php?eventId=$eventId'>Participants</a></td>"
         . "</tr>";
  }

  $html = $html."</table>";

  return $html;
 }

 else{

   $message = errorMessageDisplay("The event name does not exist.");
   $html = $message."<br>".displayAllEvents();
   return $html;
 }
  
}

/*
 *@return the error message
 */
function errorMessageDisplay($message){

  $html = "<table class='error'><tr><td>$message</td></tr></table>";
  return $html;
}

function getAllEmails(){

  $emails = array();
  $ids = array();
  $sql = "SELECT email,contact_id FROM civicrm_email";
  $result = mysql_query($sql) or die(mysql_error());

  while($row = mysql_fetch_array($result)){
    $email = $row["email"];
    $contactId = $row["contact_id"];
   
    $emails[] = $email;
    $ids[] = $contactId;
  }
    
  $allEmails = array_combine($ids,$emails);
  return $allEmails;
}

function searchParticipantPerEvent($eventId,$searchCriteria){

  $searchCriteria = mysql_real_escape_string($searchCriteria);

  $participants = array();
  $details = array();

  $sql = "SELECT display_name,organization_name,email,cc.id FROM civicrm_participant cp, civicrm_email cem, civicrm_contact cc\n"
       . "WHERE cp.event_id='$eventId'\n"
       . "AND cp.contact_id = cc.id\n"
       . "AND cem.contact_id = cc.id\n"
       . "AND (cc.display_name LIKE '%{$searchCriteria}%' OR cem.email LIKE '%{$searchCriteria}%')";
  $result = mysql_query($sql) or die(mysql_error());

  while($row = mysql_fetch_assoc($result)){
     $details["name"] = $row["display_name"];
     $details["org"] = $row["organization_name"];
     $details["email"] = $row["email"];
     $details["id"] = $row["id"];
    
     $participants[] = $details;
     unset($details);
  }

  return $participants;
}

function displaySearchParticipant(array $participantDetails){

  $html = "<h3>List of Participants</h3>";
  $html = $html. "<table>"
        . "<th>Participant Name</th>"
        . "<th>Organization Name</th>"
        . "<th>Email Address</th>"
        . "<th>Print Badge</th>"
        . "<tr><td colspan='4' align='right'><input type='submit' name='print' value='PRINT BADGE'></td></tr>";

 foreach($participantDetails as $details){
   $name = $details["name"];
   $org = $details["org"];
   $email = $details["email"];
   $contactId = $details["contact_id"];

   $html = $html."<tr>"
         . "<td>$name</td>"
         . "<td>$org</td>"
         . "<td>$email</td>"
         . "<td class='center'><input type='checkbox' name='contactIds[]' value='$contactId'></td>"
         . "</tr>";
 }
  
  $html = $html."</table>";

  return $html;

}

function searchParticipantForm(){

  $htmlForm = "<form name='searchParticipantForm' action='' method='post'>"
            . "<label for='Email or Name'>Email or Name</label>"
            . "<input type='text' name='searchCriteria'>"
            . "<input type='submit' name='searchParticipant' value='SEARCH'>"
            . "</form>";

  return $htmlForm;
}
?>
