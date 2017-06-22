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
if (mysqli_connect_errno()) {
    die("Database connection failed: " .
            mysqli_connect_error() .
            " (" . mysqli_connect_errno() . ")"
    );
}
$error = "";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];

    $count = 0;
    $res = "SELECT * FROM register WHERE uname = '$_POST[username]' AND role = 'admin'";
    $result = mysqli_query($conn, $res);
    //$member = mysqli_fetch_assoc($select_set);
    $count = mysqli_num_rows($result);

    $count2 = 0;
    $res2 = "SELECT * FROM register WHERE uname = '$_POST[username]'";
    $result2 = mysqli_query($conn, $res2);
    //$member = mysqli_fetch_assoc($select_set);
    $count2 = mysqli_num_rows($result2);

    if (empty($username)) {
        $error = "* Username is required";
    } else if ($count > 0) {
        $error = "* User is already an admin";
    } else if ($count2 == 0) {
        $error = "* Username doesn't exist";
    } else {
        $query = "UPDATE register SET role = 'admin' WHERE uname = '$_POST[username]'";
        mysqli_query($conn, $query);
        redirect_to("manage_admins.php");
    }
}
?> 

<html lang="en">
    <head>
        <title>New Admin</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/coverphoto.css">
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
                        <div class="container-fluid">
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
    $user = $_SESSION["username"];
    $select = "SELECT * FROM register WHERE uname = '$user'";
    $select_set = mysqli_query($conn, $select);
    $member = mysqli_fetch_assoc($select_set);
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
        echo '<li><a href="profile.php">Profile</a></li>';
        echo '<li><a href="logout.php">Logout</a></li>';
        echo '<li><a href="About.php">About Us</a></li>';
        echo '<li><a href="comments.php">Comments</a></li>';
        echo '<li class="active"><a href="manage_admins.php">Manage Admin</a></li>';
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
                        </div><!-- /.container-fluid -->
                    </nav>
                </div>

            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="jumbotron">
                        <h1>New Admin</h1>
                        <form action="new_admin.php" method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control"><span class="error"> <?php echo $error; ?></span><br>

                                <input type="submit" name="submit" class="btn btn-success" value="+ Add">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
<?php
include("footer.php");
?>
            </div>
        </div>
        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
</html>
