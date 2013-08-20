<?php

  include 'dbcon.php';
  include 'badges_functions.php';
  
  $contactIds = urldecode($_REQUEST['ids']);
  $contactIds = json_decode($contactIds);

  $eventId = urldecode($_REQUEST['eventId']);
  $eventId = json_decode($eventId);

  $properties = urldecode($_REQUEST['properties']);
  $properties = json_decode($properties);
  
  $properties = (object)$properties;
  $badgeWidth = $properties->bWidth."px";
  $badgeHeight = $properties->bHeight."px";
?>
<html>
<head>
<style type="text/css">
<title>Customize Badge</title>
<?php

echo "#badge{"
     . "border:1px dashed #BDBDBD;"
     . "padding:2px;"
     . "width:".$badgeWidth.";"
     . "height:".$badgeHeight.";"
     . "}"
     . "table{"
     . "width:".$badgeWidth.";"
     . "height:".$badgeHeight.";"
     . "}";
?>
</style>
</head>
<body>
</body>
</html>
