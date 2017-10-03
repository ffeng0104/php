<?php

require_once 'controller/Controller.php'; 
session_start();
$_SESSION["errorRegisterParticipant"] = ""; $_SESSION["errorRegisterEvent"] = "";
$_SESSION["errorParticipantName"] = "";
$_SESSION["erroreventname"] = ""; $_SESSION["erroreventstarttime"] = "";$_SESSION["erroreventendtime"] = "";$_SESSION["erroreventdate"] = "";
$c = new Controller();
try {
	$event_name = NULL;
	if (isset($_POST['event_name'])) {
		$event_name = $_POST['event_name'];
	}
	$eventdate= NULL;
	if (isset($_POST['event_date'])) {
		$eventdate = $_POST['event_date'];
        
	}
    $eventstart= NULL;
	if (isset($_POST['starttime'])) {
		$eventstart = $_POST['starttime'];
        
	}
    $eventend= NULL;
	if (isset($_POST['endtime'])) {
		$eventend = $_POST['endtime'];
        
	}
	$c->createEvent($event_name,$eventdate,$eventstart,$eventend); } catch (Exception $e) {
		$errors = explode("@", $e->getMessage()); foreach ($errors as $error) {
		
if (substr($error, 0, 1) == "1") {
       $_SESSION["erroreventname"] = substr($error, 1);
}
if (substr($error, 0, 1) == "2") {
       $_SESSION["erroreventdate"] = substr($error, 1);
}

if (substr($error, 0, 1) == "3") {
	$_SESSION["erroreventstarttime"] = substr($error, 1);
}

if (substr($error, 0, 1) == "4") {
	$_SESSION["erroreventendtime"] = substr($error, 1);
}
		}
	}
?>
<!DOCTYPE html>
<html>
       <head>
<meta http-equiv="refresh" content="0; url=/EventRegistrationWeb/" /> </head>
</html>