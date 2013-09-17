<?php

  include '../dbcon.php';
  include '../badges_functions.php';
  include 'weberp_functions.php';

  $eventId = $_GET["eventId"];

  $displayEventHeader = displayEventHeader($eventId);
  echo $displayEventHeader;

  $filterParticipantForm = filterParticipantForm();
  echo $filterParticipantForm;


  if(isset($_POST["searchNameEmail"])){
    
    $searchNameEmail = $_POST["nameEmailTb"];
    $contactIds = getContactIdSearchName($eventId,$searchNameEmail);
    $searchParticipantByName = searchedParticipantListByName($contactIds,$eventId);
    echo $searchParticipantByName;

  }

  elseif(isset($_POST["searchOrg"])){

    $searchOrg = $_POST["orgTb"];
    $contactIds = getContactIdSearchOrg($eventId,$searchOrg);
    $searchParticipantByName = searchedParticipantListByName($contactIds,$eventId);
    echo $searchParticipantByName;
  }

  elseif(isset($_POST["searchStatus"])){
    $statusId = $_POST["statusTypeSelect"];
    $contactIds = getContactIdSearchStatusId($eventId,$statusId);
    $searchParticipantByName = searchedParticipantListByName($contactIds,$eventId);
    echo $searchParticipantByName;
  }

  else{
  
    $displayParticipants = getParticipantByEvent($eventId);
    echo $displayParticipants;
  }
  
?>
