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

  $badgeProperties = array();

  $badgeProperties["imgHeight"] = $properties->imgHeight;
  $badgeProperties["imgWidth"] = $properties->imgWidth;
  $badgeProperties["titleSize"] = $properties->titleSize;
  $badgeProperties["nameSize"] = $properties->nameSize;
  $badgeProperties["orgSize"] = $properties->orgSize;
  $badgeProperties["dateSize"] = $properties->dateSize;

?>
<html>
<head>
<title>Customize Badge</title>
<style>
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
<?php

  foreach($contactIds as $id){
    $participantDetails = getParticipantDetails($id);
    $perBadge = htmlCustomizeBadge($eventId,$participantDetails,$badgeProperties);

    echo $perBadge;

  }

?>
</body>
</html>
