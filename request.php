<?php require_once("sessions.php"); ?>
<?php require_once("functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php echo message() ?>
<?php
$host = "localhost";
$uname = "root";
$pwd = "18372652232";
$dbName = "Welfare";
$conn = mysqli_connect($host, $uname, $pwd, $dbName);
$query = "SELECT * FROM register";
$admin_set = mysqli_query($conn, $query);
$admin = mysqli_fetch_assoc($admin_set);

$user = $_SESSION["username"];
$select = "SELECT * FROM register WHERE uname = '$user'";
$select_set = mysqli_query($conn, $select);
$member = mysqli_fetch_assoc($select_set);
if (isset($_POST['submit'])) {
    $username = $_SESSION["username"];
    $reason = $_POST['reason'];




    if (mysqli_connect_errno()) {
        die("Database connection failed: " .
                mysqli_connect_error() .
                " (" . mysqli_connect_errno() . ")"
        );
    }
    $need = "No";
    if (empty($_POST["money"]) && empty($_POST["other"])) {
        $sql = "INSERT INTO request(uname,reason,money,other) VALUES('$username','$_POST[reason]','$need','$need')";

        mysqli_query($conn, $sql);
    } else if (empty($_POST["money"])) {
        $other = $_POST['other'];
        $sql = "INSERT INTO request(uname,reason,money,other) VALUES('$username','$_POST[reason]','$need','$_POST[other]')";
        mysqli_query($conn, $sql);
    } else if (empty($_POST["other"])) {
        $money = $_POST['money'];
        $sql = "INSERT INTO request(uname,reason,money,other) VALUES('$username','$_POST[reason]','$_POST[money]','$need')";
        mysqli_query($conn, $sql);
    } else {
        $money = $_POST['money'];
        $other = $_POST['other'];
        $sql = "INSERT INTO request(uname,reason,money,other) VALUES('$username','$_POST[reason]','$_POST[money]','$_POST[other]')";
        mysqli_query($conn, $sql);
    }
    //$picture = $_SESSION["username"];
}
?>
<html>
    <head>
        <title>Request what you need</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/request.css">
        <link href="css/phonesize.css" rel="stylesheet" type="text/css" media="only screen and (max-width:450px)" />
        <link href="css/tabletsize.css" rel="stylesheet" type="text/css" media="only screen and (min-width:451px) and (max-width:960px)" />
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Teko" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet"> 
    </head>
    <body id="cover">
        <div class="container-fluid">
            <div class="row">
<?php
include("header.php");
?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="navBar">
                    <nav class="navbar navbar-default">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#"></a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
<?php
if (isset($_SESSION["id"])) {
    if ($member["role"] == "member") {
        echo '<li><a href="home.php">Home <span class="sr-only">(current)</span></a></li>';
        echo '<li><a href="Registration.php">Register</a></li>';
        echo '<li><a href="profile.php">Profile</a></li>';
        echo '<li><a href="logout.php">Logout</a></li>';
        echo '<li><a href="About.php">About Us</a></li>';
        echo '<li><a href="comments.php">Comments</a></li>';
    } else {
        echo '<li><a href="home.php">Home <span class="sr-only">(current)</span></a></li>';
        echo '<li><a href="Registration.php">Register</a></li>';
        echo '<li class="active"><a href="profile.php">Profile</a></li>';
        echo '<li><a href="logout.php">Logout</a></li>';
        echo '<li><a href="About.php">About Us</a></li>';
        echo '<li><a href="comments.php">Comments</a></li>';
        echo '<li><a href="manage_admins.php">Manage Admin</a></li>';
        echo '<li><a href="people.php">People</a></li>';
        echo '<li><a href="request_list.php">Request List</a></li>';
        echo '<li><a href="changePosition.php">Update Positions</a></li>';
    }
} else {
    echo '<li><a href="home.php">Home <span class="sr-only">(current)</span></a></li>';
    echo '<li><a href="Registration.php">Register</a></li>';
    echo '<li><a href="login.php">Login</a></li>';
    echo '<li><a href="About.php">About Us</a></li>';
    echo '<li><a href="comments.php">Comments</a></li>';
}
?>    
                            </ul>


                        </div><!-- /.navbar-collapse -->
                    </nav>
                </div>

            </div>
            <div class="row">
                <div class="col-md-4">
                    <a href="profile.php" class="btn btn-default" id="profile">Your Profile</a><br><br>
                    <a href="request.php" class="btn btn-default" id="request">Request Something</a><br><br>
                    <a href="edit_profile.php?id=<?php echo urlencode($admin["id"]); ?>" class="btn btn-default" id="edit">Edit Your Profile</a><br><br>
                    <a href="delete_profile.php?id=<?php echo urlencode($admin["id"]); ?>" class="btn btn-default" id="deleteProfile" onclick="return confirm('Are you sure you want to delete your profile?');">Delete Profile</a><br><br>
                </div>
                <div class="col-md-8">
                    <div class="jumbotron">
                        <div class="form-group">
                            <form action="request.php" method="post">
                                <label>Reason : </label>
                                <select name="reason" class="form-control">
                                    <option value="Funeral">Funeral</option>
                                    <option value="Wedding">Wedding</option>
                                    <option value="Alms Giving">Alms giving</option>
                                    <option value="Get Together">Get together</option>
                                    <option value="Other">Other</option>
                                </select><br><br>

                                <table class="table">
                                    <tr>
                                        <td><label>Money</label></td>
                                        <td><input type="checkbox" name="money" value="Yes"></td>
                                        
                                    </tr>
                                    <tr>
                                        <td><label>Other needs</label></td>
                                        <td><input type="checkbox" name="other" value="Yes"></td>
                                    </tr>
                                </table>
                                <input type="submit" class="form-control btn btn-default" value="Send" name="submit">


                            </form>
                        </div>
                    </div>
                </div>
            </div>
<?php
include("footer.php");
?>
        </div>
        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
</html>