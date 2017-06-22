<?php require_once("functions.php"); ?>
<?php require_once("sessions.php"); ?>
<?php
$nameErr = $emailErr = "";
$name = $email = "";
$conn = mysqli_connect("localhost", "root", "18372652232", "welfare");
if (mysqli_connect_errno()) {
    die("Database connection failed: " .
            mysqli_connect_error() .
            " (" . mysqli_connect_errno() . ")"
    );
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (empty($_POST["name"])) {
        $_SESSION["message"] = "* Name is required";
        
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $_SESSION["message"] = "* Please provide a valid name";
    } else if (empty($_POST["email"])) {
            $_SESSION["message1"] = "* Email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["message1"] = "* Invalid email format"; 
    } else {
        $sql = "INSERT INTO contactus(name,email,subject,message) VALUES('$_POST[name]','$_POST[email]','$_POST[subject]','$_POST[message]')";
        mysqli_query($conn, $sql);
        
    }
    redirect_to("home.php#form");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welfare Society</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/homepage.css">
        <link href="css/desktop.css" rel="stylesheet" type="text/css" media="only screen and (min-width:961px)" />
        <link href="css/phone.css" rel="stylesheet" type="text/css" media="only screen and (max-width:450px)" />
        <link href="css/tablet.css" rel="stylesheet" type="text/css" media="only screen and (min-width:451px) and (max-width:960px)" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Teko" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet"> 
    </head>
    <body>
        <div class="container-fluid" id="body">
<?php
include("header.php");
?>

        </div>
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
        echo '<li class="active"><a href="home.php">Home <span class="sr-only">(current)</span></a></li>';
        echo '<li><a href="Registration.php">Register</a></li>';
        echo '<li><a href="profile.php">Profile</a></li>';
        echo '<li><a href="logout.php">Logout</a></li>';
        echo '<li><a href="About.php">About Us</a></li>';
        echo '<li><a href="comments.php">Comments</a></li>';
    } else {
        echo '<li class="active"><a href="home.php">Home <span class="sr-only">(current)</span></a></li>';
        echo '<li><a href="Registration.php">Register</a></li>';
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
    echo '<li class="active"><a href="home.php">Home <span class="sr-only">(current)</span></a></li>';
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
        <div class="container-fluid" id="background">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="slideShow">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                            <li data-target="#myCarousel" data-slide-to="4"></li>

                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="pics/happiness1.jpg" alt="Happiness" class="slideShow">
                            </div>

                            <div class="item">
                                <img src="pics/happiness2.jpg" alt="Happiness" class="slideShow">
                            </div>

                            <div class="item">
                                <img src="pics/happiness3.jpg" alt="Happiness" class="slideShow">
                            </div>

                            <div class="item">
                                <img src="pics/happiness4.jpg" alt="Happiness" class="slideShow">
                            </div>

                            <div class="item">
                                <img src="pics/happiness5.jpg" alt="Happiness" class="slideShow">
                            </div>  
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                </div>
                <a href="#title1" id="middle" class="btn btn-default" style="border: 1px solid black;">What we do</a>    
            </div>
        </div>
        <div class="container-fluid" id="otherDetails">
            <div class="row" id="whatWeDo">
                <div class="container">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                        <h1 id="title1">WHAT WE DO</h1><br>
                        <p>We offer you what you need when you are in trouble</p>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
                        <img src="pics/events.png" class="icons img-responsive icon" style="margin: 0 auto;">
                        <h3>Events</h3>
                        <p class="paragraph">
                            <font color="gray">
                            When you have a special event in your house, don't worry. You will not have to do it alone. We will help you with that and to accomplish your goal. You will be donated in many ways. That's what we do.
                            </font>
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
                        <img src="pics/loan.png" class="icons img-responsive icon" style="margin: 0 auto;">
                        <h3>Loans</h3>
                        <p class="paragraph">
                            <font color="gray">
                            Are you having a money problem? Do you have a event in your house? or do you want money for any reason? We will offer you a loan. We will help you to solve your money problem. Your hard time is over.
                            </font>
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
                        <img src="pics/funeral.png" class="icons img-responsive icon" style="margin: 0 auto;">
                        <h3>Funerals</h3>
                        <p class="paragraph">
                            <font color="gray">
                            We help you in urgent situations. If you have a funeral in your house or anywhere you care about, you won't be alone anymore. We will be with you at any time. We hope to give you what you need at the moment.
                            </font>
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
                        <img src="pics/help.png" class="icons img-responsive icon" style="margin: 0 auto;">
                        <h3>Help</h3>
                        <p class="paragraph">
                            <font color="gray">
                            We define the meaning of help. We will help you at any moment. We care about your needs and we give you what you need. We want to be a shade to you and we want to make you happy. It's all about helping.
                            </font>
                        </p>
                    </div>

                </div><br><br>
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <center><a href="#title2" id="next" class="btn btn-default">WHO WE ARE</a></center>
                </div>
                <div class="col-md-4">

                </div>

            </div>

            <div class="row" id="whoWeAre">
                <div class="container">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                        <h1 id="title2">WHO WE ARE</h1><br>
                        <p id="para2">We do our best to help you</p>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center hover1 column">
                        <figure><img src="pics/vision.png" id="event" class="img-responsive"></figure>
                        <h4>Our Vision</h4>
                        <p class="paragraph"><font color="gray">
                                Our vision is everyone has problems. Everyone needs help. Everyone has a bad time in their lives. So we pretend it's necessary to help someone who needs help so bad. That's who we are.
                           </font> </p>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center hover2 column">
                        <figure><img src="pics/purpose.png" id="loan" class="img-responsive hover column"></figure>
                        <h4>Our Purpose</h4>
                        <p class="paragraph"><font color="gray">
                                Our purpose is to help the people who needs it. If you need help, tell us. We will be with you. We will help you with what we have. We are the ones who help you when you need it.
                            </font> </p>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center hover3 column">
                        <figure><img src="pics/way.png" id="funeral" class="img-responsive"></figure>
                        <h4>Our Way</h4>
                        <p class="paragraph"><font color="gray">
                                Our way is to see the happiness in you. We need to see people smiling than crying. We see a big future in our way. Our aim is to clear you that way and give you a clear way to success.
                            </font> </p>
                    </div>
                </div><br><br><br><br>
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <a href="#joinUs" id="explore" class="btn btn-default">Explore More</a>
                </div>
                <div class="col-md-4">

                </div>
            </div>
            <div class="row" id="joinUs">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <div class="container">
                        <h1 id="title3">Join us now</h1><br>
                        <p class="paragraph" id="para3">
                            All you have to do is joining us. We have what you want. So, don't be late. Join our community and create your own account here. We will be in touch with you. So, don't be nervous. Don't feel bad. If you are a lecturer, non-academic, academic member or anyone in Sabaragamuwa University of Sri Lanka, here is your chance. You just have to create an account in this website. Tell us when you need help. We will be there to help you.<br><br>
                            We will get only 50 rupees from your salary every month. You will be given 30,000 rupees and your other needs when you have an function, funeral or any event in your house or when you need it. You just have to request what you need.                        </p><br>
                    </div>
                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <center><a href="#contact" id="questions">Any Questions?</a></center>
                </div>
                <div class="col-md-4">

                </div>
            </div>   
            <div class="row" id="form">
                <div class="container">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <center><h1 id="contact">Contact Us</h1></center>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                        <div id="left">
                            <b id="abt">Give us a feedback</b><br>
                            <p class="para4"></b><br>
                                What do you think of our community? What do you think of our service? What do you think of this website? Please give us a feedback. Tell us what you feel. It will be helpful to reduce the defects of our service. <br><br>
                                If you want to know something about our community, contact us. Do you have any question about us, ask us. If you have any problem about registering or any other thing, feel free to tell us your problem. We will be here to give you a solution.
                            </p>
                        </div>

                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                        
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" class="form-group">
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="prospects_form">
                            <div class="form-group">
                                <p class="para4">Your Name</p>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Full Name"><span class="error"><?php echo message(); ?></span>
                            </div>
                            <div class="form-group">
                                <p class="para4">Your Email</p>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Enter your email"><span class="error"><?php echo message1(); ?></span>
                            </div>
                            <div class="form-group">
                                <p class="para4">Subject</p>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter a subject">
                            </div>
                            <div class="form-group">
                                <p class="para4">Your Message</p>
                                <textarea cols="70" rows="10" name="message" class="form-control" placeholder="Enter your message. ex: Feedback good or bad, questions and so on"></textarea>
                            </div>
                            <input type="submit" value="SEND" name="submit" class="btn btn-info" id="send">

                        </form>
                        <a href="#header" id="arrow"><i class="fa fa-arrow-circle-up" style="font-size:48px;" id="upArrow"></i></a>
                    </div>
                    
                </div><br>

            </div>
<?php
include("footer.php");
?> 
        </div>

        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script src="js/homepage.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
</html>