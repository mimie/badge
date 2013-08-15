<?php

  include 'dbcon.php';
  include 'badges_functions.php';

  
  $contactIds = urldecode($_REQUEST['ids']);
  $contactIds = json_decode($contactIds);

  $eventId = urldecode($_REQUEST['eventId']);
  $eventId = json_decode($eventId);

  $properties = array();
  $properties["bHeight"] = '205px';                                                                                                                                  
  $properties["bWidth"] = '329px';                                                                                                                                    
  $properties["imgHeight"] = '77';                                                                                                                                      
  $properties["imgWidth"] = '73';                                                                                                                                 
  $properties["titleSize"] = '4';                                                               
  $properties["nameSize"] = '5';                                                                                                                                                    
  $properties["orgSize"] = '4';                                                                                                                                              
  $properties["dateSize"] = '4';

  foreach($contactIds as $id){

    $participantDetails = getParticipantDetails($id);
    $htmlBadge = htmlBadge($eventId,$participantDetails,$properties);
    echo $htmlBadge;
  }
?>
