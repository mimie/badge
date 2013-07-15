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
  echo displayAllEvents();

?>
</body>
</html>

