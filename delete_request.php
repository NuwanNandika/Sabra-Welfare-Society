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

$admin = find_admin_by_id($_GET["id"]);
if (!$admin) {
    redirect_to("request_list.php");
}
$id = $admin["id"];
$query = "DELETE FROM request WHERE id = {$id} LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result && mysqli_affected_rows($conn) == 1) {
    redirect_to("request_list.php");
} else {
    $_SESSION["message"] = "Something went wrong!";
    redirect_to("request_list.php");
}
?>