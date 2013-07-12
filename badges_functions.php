<?php
include 'dbcon.php';

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

?>
