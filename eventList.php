<?php
  include 'dbcon.php';
  include 'badges_functions.php';

  $eventId = $_GET["eventId"];
  $eventName = getEventName($eventId);
  $eventDate = getEventDate($eventId);
  $eventDate = DateTime::createFromFormat('Y-m-d H:i:s',$eventDate);
  $eventDate = $eventDate->format('j F Y');

  $speakerContactId = getSpeakerContactId($eventId);
  $speakerName = getParticipantName($speakerContactId);
?>
<html>
<head>
<title>Event List</title>
<style>
#eventHeader{
  text-align:center;
  padding:5px;
}

#eventDetails{
  padding:5px;
}

table#eventInfo{
  border-collapse:collapse;
  border: 1px solid black;
}

table#eventInfo td{
  border-collapse:collapse;
  border: 1px solid black;
  padding: 5px;
}

table#participantInfo{
  border-collapse:collapse;
  border:1px solid black;
}

table#participantInfo td,th{
  border-collapse:collapse;
  border:1px solid black;
  padding: 4px;
}
</style>
</head>
<body>
<!--<div style="height:5px;border:1px solid #0489B1;background:#0489B1;"></div>-->
<div id="eventHeader">
<h4>Institute of Internal Auditors - Philippines<br>
Centre for Professional Development<br>
Attendance and CPE Form</h4>
</div>
<!--<div style="height:5px;border:1px solid #0489B1;background:#0489B1;"></div>-->

<div id="eventDetails" align="center">
 <table id="eventInfo">
  <tr>
   <td><b>Topic</b></td>
   <td><?=$eventName?></td>
  </tr>
  <tr>
   <td><b>Date, Time</b></td>
   <td><?=$eventDate?></td>
  </tr>
  <tr>
   <td><b>Speaker</b></td> 
   <td><?=$speakerName?></td>
  </tr>
  <tr>
   <td><b>Venue</b></td>
   <td>ST. GILES HOTEL, MAKATI CITY</td>
  </tr>
 </table>
</div>

<div id="participantDetails" align="center">
 <table id="participantInfo">
 <tr>
  <th>No.</th>
  <th>Name</th>
  <th>Company</th>
  <th>Position</th>
  <th>Yrs in Co / Current Position</th>
  <th>If CIA, CIA No.</th>
  <th>If CPA, CPA No.</th>
  <th>Signature</th>
 </tr>
 </table>
</div>

</body>
</html>
