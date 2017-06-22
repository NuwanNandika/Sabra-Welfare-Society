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
$query = "SELECT * FROM register ORDER BY FirstName ASC";
$admin_set = mysqli_query($conn, $query);

$user = $_SESSION["username"];
$select = "SELECT * FROM register WHERE uname = '$user'";
$select_set = mysqli_query($conn, $select);
$member = mysqli_fetch_assoc($select_set);
?>
<html lang="en">
    <head>
        <title>People</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Teko" rel="stylesheet">
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
                                            echo '<li><a href="manage_admins.php">Manage Admin</a></li>';
                                            echo '<li class="active"><a href="people.php">People</a></li>';
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

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jumbotron">
                        <table class="table" style="width: 100%;">
                            <tr>
                                <th>Name</th>
                                <th>    </th>
                            </tr>
<?php while ($admin = mysqli_fetch_assoc($admin_set)) { ?>
                                <tr id="parent">
                                    <td><?php echo $admin["FirstName"] . " " . $admin["LastName"]; ?></td> 
                                    <td><a href="details.php?id=<?php echo urlencode($admin["id"]); ?>" class="btn btn-success">View more</a></td> 
                                </tr>
<?php } ?>
                        </table>
                        <a href="delete_user.php" class="btn btn-danger">Delete users</a>
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
        <script src="js/homepage.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
</html>
