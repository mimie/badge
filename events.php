<html>
<head>
<title>Events</title>
<link rel="stylesheet" type="text/css" href="design.css" />
</head>
<body>
<?php
     
  include 'dbcon.php';
  include 'badges_functions.php';

  echo searchEventForm();

  if(!$_POST["searchEvent"]){
     echo displayAllEvents();
  }

  else{
     $eventName = $_POST["eventName"];
     $eventMatches = searchEvent($eventName);
     $searchResult = displaySearchEvent($eventMatches);
    
     echo $searchResult;
  }

?>
</body>
</html>

