<?php require_once("sessions.php"); ?>
<?php require_once("functions.php"); ?>
<?php

$_SESSION["id"] = NULL;
$_SESSION["username"] = NULL;
redirect_to("login.php");
?>