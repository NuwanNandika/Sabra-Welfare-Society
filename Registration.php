<?php require_once("functions.php"); ?>
<?php require_once("sessions.php"); ?>
<?php echo message() ?>
<?php
$upload_errors = array(
    UPLOAD_ERR_OK => "No errors.",
    UPLOAD_ERR_INI_SIZE => "Larger than upload_max_filesize.",
    UPLOAD_ERR_FORM_SIZE => "Larger than form MAX_FILE_SIZE.",
    UPLOAD_ERR_PARTIAL => "Partial upload.",
    UPLOAD_ERR_NO_FILE => "No file.",
    UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
    UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
    UPLOAD_ERR_EXTENSION => "File upload stopped by extension."
);
$fnameErr = $lnameErr = $emailErr = $unameErr = $passwordErr = $addErr = $phoneErr = $emailErr = $nicErr = $passwordErr = $conpassErr = "";
$fname = $lname = $email = $username = $password = $conpass = $role = "";
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


if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $nic = $_POST['nic'];
    $gender = "";
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_encrypt($password);
    $conpass = $_POST['conpassword'];
    //$hashed_conpassword = password_encrypt($conpass);
    $role = "member";
    if (strlen($nic) == 10) {
        $value = substr($nic, 2, 3);
        if ($value >= 500) {
            $gender = "Female";
        } else {
            $gender = "Male";
        }
    }else{
        $value = substr($nic, 4, 3);
        if ($value >= 500) {
            $gender = "Female";
        } else {
            $gender = "Male";
        }
    }


    $tmp_file = $_FILES['file_upload']['tmp_name'];
    $target_file = basename($_FILES['file_upload']['name']);
    $upload_dir = "uploads";

    if (move_uploaded_file($tmp_file, $upload_dir . "/" . $target_file)) {
        $message = "File uploaded successfully.";
    } else {
        $error = $_FILES['file_upload']['error'];
        $message = $upload_errors[$error];
    }
    $file = "uploads/" . $_FILES["file_upload"]["name"];



    //$select_set = mysqli_query($conn, $select);

    $count = 0;
    $res = "SELECT * FROM register WHERE uname = '$_POST[username]'";
    $result = mysqli_query($conn, $res);
    //$member = mysqli_fetch_assoc($select_set);
    $count = mysqli_num_rows($result);

    if (empty($_POST["fname"])) {
        $fnameErr = "* First Name is required";
    } else if (empty($_POST["lname"])) {
        $lnameErr = "* Last Name is required";
    } else if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
        $fnameErr = "* Please provide a valid name";
    } else if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
        $lnameErr = "* Please provide a valid name";
    } else if (empty($_POST["address"])) {
        $addErr = "* Address is required";
    } else if (empty($_POST["phone"])) {
        $phoneErr = "* Phone is required";
    } else if (empty($_POST["email"])) {
        $emailErr = "* Email is required";
    } else if (empty($_POST["nic"])) {
        $nicErr = "* NIC is required";
    } else if (empty($_POST["username"])) {
        $unameErr = "* Username is required";
    } else if (empty($_POST["password"])) {
        $passwordErr = "* Password is required";
    } else if (empty($_POST["conpassword"])) {
        $conpassErr = "* Password confirming is required";
    } else if ($password != $conpass) {
        $conpassErr = "* Password doesn't match";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        if (empty($_POST["email"])) {
            $emailErr = "* Email is required";
        }
    } else if (preg_match('/\s/',$username)) {
        $unameErr = "* There should not be white spaces in username";
    } else if (strlen($password) < 8) {
        $passwordErr = "* Password should have at least 8 characters";
    } else if ($count > 0) {
        $unameErr = "* That username already exists. Please try again with different username";
    } else {
        $sql = "INSERT INTO register(FirstName,LastName,address,phone,email,nic,picture,gender,uname,password,role) VALUES('$_POST[fname]','$_POST[lname]','$_POST[address]','$_POST[phone]','$_POST[email]','$_POST[nic]','$file','$gender','$_POST[username]','$hashed_password','$role')";
        mysqli_query($conn, $sql);
    }
}
?>


<html lang="en">
    <head>
        <title>Join us</title>
        <link type="text/css" rel="stylesheet" href="css/reg.css">
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
        echo '<li class="active"><a href="Registration.php">Register</a></li>';
        echo '<li><a href="profile.php">Profile</a></li>';
        echo '<li><a href="logout.php">Logout</a></li>';
        echo '<li><a href="About.php">About Us</a></li>';
        echo '<li><a href="comments.php">Comments</a></li>';
    } else {
        echo '<li><a href="home.php">Home <span class="sr-only">(current)</span></a></li>';
        echo '<li class="active"><a href="Registration.php">Register</a></li>';
        echo '<li><a href="profile.php">Profile</a></li>';
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
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jumbotron" id="jumbo">
                        <h1>Join us now</h1>

                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <p>First Name</p>
                                <input class="form-control" name="fname" type="text" size="100" placeholder="Enter your first name here" id="fname"><br><span class="error"> <?php echo $fnameErr; ?></span>
                                <p>Last Name</p>
                                <input class="form-control" name="lname" type="text" size="100" placeholder="Enter your last name here" id="lname"><br><span class="error"> <?php echo $lnameErr; ?></span>
                                <p>Address</p>
                                <textarea class="form-control" name="address" rows="10" cols="80" placeholder="Enter your permanant address" id="add"></textarea><br><span class="error"> <?php echo $addErr; ?></span>
                                <p>Phone</p>
                                <input class="form-control" name="phone" type="text" size="100" placeholder="Your phone number" id="phone"><br><span class="error"> <?php echo $phoneErr; ?></span>
                                <p>Email</p>
                                <input class="form-control" name="email" type="text" size="100" placeholder="Your Email address" id="email"><br><span class="error"> <?php echo $emailErr; ?></span>
                                <p>NIC</p>
                                <input class="form-control" name="nic" type="text" size="100" placeholder="Your national identity card number" id="nic"><br><span class="error"> <?php echo $nicErr; ?></span>       

                                <p>Upload a profile picture</p>
                                <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                                <input type="file" name="file_upload" id="fileToUpload">

                                <p>Username</p>
                                <input class="form-control" name="username" type="text" size="100" placeholder="Select a username" id="uname"><br><span class="error"> <?php echo $unameErr; ?></span>
                                <p>Password</p>
                                <input class="form-control" name="password" type="password" size="100" placeholder="Choose your password" id="pwd"><br><span class="error"> <?php echo $passwordErr; ?></span>
                                <p>Confirm password</p>
                                <input class="form-control" name="conpassword" type="password" size="100" placeholder="Confirm password" id="confirm"><br><span class="error"> <?php echo $conpassErr; ?></span><br><br>

                                <input type="reset" class="btn btn-default" value="Reset">
                                <input type="submit" name="submit" class="btn btn-default" value="Join now" id="submit_btn">

                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
<?php
include("footer.php");
?>
        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script src="js/reg.js" type="text/javascript"></script>
    </body>
</html>

