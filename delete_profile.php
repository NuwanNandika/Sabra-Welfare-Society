<?php require_once("functions.php"); ?>
<?php require_once("sessions.php"); ?>
<?php confirm_logged_in(); ?>
<?php echo message() ?>
<?php

$host = "localhost";
$uname = "root";
$pwd = "18372652232";
$dbName = "Welfare";
$conn = mysqli_connect($host, $uname, $pwd, $dbName);

$id = $_GET["id"];
$query = "DELETE FROM register WHERE id = {$id} LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result && mysqli_affected_rows($conn) == 1) {
    $_SESSION["id"] = NULL;
    $_SESSION["username"] = NULL;
    redirect_to("login.php");
} else {
    $_SESSION["message"] = "Something went wrong!";
}
?>