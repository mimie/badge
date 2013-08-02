<?php
   
   include 'dbcon.php';
   include 'badges_functions.php';

   $event1 = searchEvent("e");
   $event2 = searchEvent("Meeting");
   $event3 = searchEvent("karen");

   /*var_dump($event1);
   var_dump($event2);
   var_dump($event3);*/

   echo displaySearchEvent($event1);
   echo displaySearchEvent($event2);
   echo displaySearchEvent($event3);

   //var_dump(getAllEmails());

   //$participants = searchParticipantPerEvent("43","mhy");
   //$participants = searchParticipantPerEvent("43","a");
   $participants = searchParticipantPerEvent("43","michael");
   echo "<pre>";
   echo var_dump($participants);
   echo "</pre>";

   $result = displaySearchParticipant($participants);
   echo $result;

   $searchParticipantForm = searchParticipantForm();
   echo $searchParticipantForm;

   $participant = getParticipantDetails('2983');
   var_dump($participant);

   $properties = array();
   
   $participant1 = getParticipantDetails('3306');
   $participant2 = getParticipantDetails('3276');
   $properties["bHeight"] = '350px';
   $properties["bWidth"] = '450px'; 
   $properties["imgHeight"] = '111';
   $properties["imgWidth"] = '100';
   $properties["titleSize"] = '4';
   $properties["nameSize"] = '7';
   $properties["orgSize"] = '5';
   $properties["dateSize"] = '5';

   $htmlBadge = htmlBadge('139',$participant,$properties);
   var_dump($htmlBadge);

   $htmlBadge2 = htmlBadge('139',$participant2,$properties);
   var_dump($htmlBadge2);
   
?>
