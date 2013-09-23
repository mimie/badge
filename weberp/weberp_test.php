<?php

  include '../dbcon.php';
  include '../badges_functions.php';
  include 'weberp_functions.php';

  $searchEvent = searchEventName("Auditing");
  var_dump($searchEvent);

  $searchEvent2 = searchEventName("Chain");
  var_dump($searchEvent2);

  $searchEvent3 = searchEventName("karen");
  var_dump($searchEvent3);

  /**$displayParticipants = getParticipantByEvent("139");
  echo $displayParticipants;**/

  /*$displayParticipant2 = getParticipantByEvent("177");
  echo $displayParticipant2;*/

  $statusId = getParticipantStatusId("7831","139");
  var_dump($statusId);

  $status = getParticipantStatusType();
  var_dump($status);

  $statusTypeSelectForm = statusTypeSelectForm("3");
  echo $statusTypeSelectForm;

  $eventHeader = displayEventHeader("139");
  echo $eventHeader;

  $feeAmount = getParticipantFeeAmount("7831","139");
  var_dump($feeAmount);

  $statusSelector = participantStatusSelector();
  echo $statusSelector;

  $searchParticipantForm = filterParticipantForm();
  echo $searchParticipantForm;

 $contactIds = getContactIdSearchName("139","guzman");
 var_dump($contactIds);

 $searchParticipantByName = searchedParticipantListByName($contactIds,"139");
 echo $searchParticipantByName;

 $searchOrg = getContactIdSearchOrg("139","Isla Lipana");
 var_dump($searchOrg);

 $searchStatus = getContactIdSearchStatusId("139","1");
 var_dump($searchStatus);

 $allEventTypes = getAllEventTypes();
 var_dump($allEventTypes);

 $eventTypesFilterForm = eventTypesFilterForm();
 echo $eventTypesFilterForm;

?>
