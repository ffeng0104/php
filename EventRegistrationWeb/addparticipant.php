<?php

require_once 'controller/Controller.php';
session_start();
$c = new Controller();
$_SESSION["errorRegisterParticipant"] = ""; $_SESSION["errorRegisterEvent"] = "";
$_SESSION["errorParticipantName"] = "";
$_SESSION["erroreventname"] = ""; $_SESSION["erroreventstarttime"] = "";$_SESSION["erroreventendtime"] = "";$_SESSION["erroreventdate"] = "";
try {
$c->createParticipant($_POST['participant_name']);

} catch (Exception $e) {
       $_SESSION["errorParticipantName"] = $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
       <head>
<meta http-equiv="refresh" content="0; url=/EventRegistrationWeb/" /> </head>
</html>