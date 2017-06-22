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
if (mysqli_connect_errno()) {
    die("Database connection failed: " .
            mysqli_connect_error() .
            " (" . mysqli_connect_errno() . ")"
    );
}
$unameErr = $posErr = "";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $fblink = $_POST['fblink'];
    
    $count = 0;
    $res = "SELECT * FROM register WHERE uname = '$_POST[username]'";
    $result_set = mysqli_query($conn, $res);
    $result = mysqli_fetch_assoc($result_set);
    $count = mysqli_num_rows($result_set);
    
    $name = $result['FirstName'] . " " . $result['LastName'];
    $email = $result['email'];
    $phone = $result['phone'];
    $photo = $result['picture'];


    $sql = "SELECT * FROM aboutus WHERE uname = '$_POST[username]'";
    $admin_set = mysqli_query($conn, $sql);
    $admin = mysqli_fetch_assoc($admin_set);
    $position = $admin['position'];


    if (empty($_POST["username"])) {
        $unameErr = "* Username can't be empty";
    } else if (empty($_POST["position"])) {
        $posErr = "* Position is required";
    } else if ($count == 0) {
        $unameErr = "* There is no such username";
    } else {
        $query = "UPDATE aboutus SET ";
        $query .= "name = '{$name}', ";
        $query .= "uname = '$_POST[username]', ";
        $query .= "picture = '{$photo}', ";
        $query .= "fblink = '$_POST[fblink]', ";
        $query .= "email = '{$email}', ";
        $query .= "phone = '{$phone}' ";
        $query .= "WHERE position = '$_POST[position]' ";
        $query .= "LIMIT 1";
        mysqli_query($conn, $query);
    }
}
?>
<html>
    <head>
        <title>Change Position</title>
        <link type="text/css" rel="stylesheet" href="css/coverphoto.css">
        <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
        <link href="css/phonesize.css" rel="stylesheet" type="text/css" media="only screen and (max-width:450px)" />
        <link href="css/tabletsize.css" rel="stylesheet" type="text/css" media="only screen and (min-width:451px) and (max-width:960px)" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Teko" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet"> 
    </head>
    <body id="cover">
        <div class="container-fluid">
            <?php
            include("header.php");
            ?>
            <div class="row">
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
                                            echo '<li><a href="manage_admins.php">Manage Admin</a></li>';
                                            echo '<li><a href="people.php">People</a></li>';
                                            echo '<li><a href="request_list.php">Request List</a></li>';
                                            echo '<li class="active"><a href="changePosition.php">Update Positions</a></li>';
                                        }
                                    } else {
                                        echo '<li><a href="home.php">Home <span class="sr-only">(current)</span></a></li>';
                                        echo '<li class="active"><a href="Registration.php">Register</a></li>';
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
            <div class="row">
                <div class="container">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="jumbotron">
                            <form action="changePosition.php" method="post">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Enter username"><br>
                                    <span class="error"> <?php echo $unameErr; ?></span><br>
                                    <label>Position</label>
                                    <select name="position" class="form-control">
                                        <option value="">Select Position</option>
                                        <option value="Counsellor">Counsellor</option>
                                        <option value="President">President</option>
                                        <option value="Vice President">Vice President</option>
                                        <option value="Secretary">Secretary</option>
                                        <option value="Under Secretary">Under Secretary</option>
                                        <option value="Treasurer">Treasurer</option>
                                    </select><br>
                                    <span class="error"> <?php echo $posErr; ?></span>
                                    <br>
                                    <label>Facebook profile URL</label>
                                    <input type="text" class="form-control" name="fblink" placeholder="If available"><br>
                                    <input type="reset" class="btn btn-default" value="Reset">
                                    <input type="submit" name="submit" class="btn btn-default" value="Update" id="submit_btn">

                                </div>
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