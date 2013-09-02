<?php
  include 'dbcon.php';
  include 'badges_functions.php';

  $eventId = $_GET["eventId"];
  $eventName = getEventName($eventId);
  $eventDate = getEventDate($eventId);
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
</style>
</head>
<body>
<div style="height:5px;border:1px solid #0489B1;background:#0489B1;"></div>
<div id="eventHeader">
<h4>Institute of Internal Auditors - Philippines<br>
Centre for Professional Development<br>
Attendance and CPE Form</h4>
</div>
<div style="height:5px;border:1px solid #0489B1;background:#0489B1;"></div>

<div id="eventDetails" align="center">
 <table id="">
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
   <td>Mags V. Mendez III, CPA, CIA, CCSA, CRMA</td>
  </tr>
  <tr>
   <td><b>Venue</b></td>
   <td>ST. GILES HOTEL, MAKATI CITY</td>
  </tr>
 </table>
</div>

</body>
</html>
