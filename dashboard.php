<?php

session_start();
require('connect.php');

// If the user is Logged in, display the page.
if (isset($_SESSION['username'])) {
	
	$uid= $_SESSION["uid"];
	//User purchase Table
	$uid_purchase= $uid."_purchase";
	//Receiver Uid Table
	$uid_rec= $uid."_rec";
	
	//cust_uid
	//rec_uid
	
	$query = "SELECT SUM(amount_pay) AS pay FROM `$uid_purchase`";
	$query1 = "SELECT SUM(amount_rec) AS rec FROM `$uid_rec`";
	
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
	$result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));
	$row = $result->fetch_assoc();
	$row1 = $result1->fetch_assoc();	
	$total_pay= $row["pay"];
	$total_rec= $row1["rec"];
	$_SESSION['total_pay']= $total_pay;
	$_SESSION['total_rec']= $total_rec;
	
	if(isset($_POST["filter"])){
		$filter= $_POST["filter"];
			$query1 = "SELECT SUM(amount_pay) AS filter_pay FROM `$uid_purchase` where rec_uid='$filter'";
			$query2 = "SELECT SUM(amount_rec) AS filter_rec FROM `$uid_rec` where cust_uid='$filter'";
			$result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));
			$result2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
			$row1 = $result1->fetch_assoc();
			$row2 = $result2->fetch_assoc();
			$filter_purchase= $row1["filter_pay"];
			$filter_rec = $row2["filter_rec"];
		}
	
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MandiBill - a place for every transaction</title>
	
	<link href='http://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
    <link rel='stylesheet prefetch' href='http://ilt-insightdlp-static.s3.amazonaws.com/css/default.css'>
     
    <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/style1.css">
	
	<!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    
	
	<!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
	
	
	<!-- Theme CSS -->
    <link href="css/grayscale.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<style>
.back{
background-color:	#6a8d9d;
line-height: 200px;
margin-top: 10px;
}
.card{
width: 350px;
border: 1px solid gray;
box-shadow: 1px 1px 3px #888;
border-top: 20px solid green;
min-height: 250px;
padding-: 10px;
margin: 10px;
border-radius:5%;
}

.das-intro {
  display: table;
  width: 100%;
  height: auto;
  padding-top: 30px;
  padding-bottom:0px;
  text-align: center;
  color: white;
  background: url(./img/about-bag.jpg) no-repeat bottom center scroll;
  background-color: black;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;
}

.bag{
background-color:#d0312e;
}
.bag1{
background-color:#589c4c;
}
img{
  border-radius: 50%;
  width: 70px;
  margin: 10px;
}

h1{
  font-weight: lighter;
  margin-left: 0px;
  margin-top: -70px;
}

p{
  margin: 10px;
  font-family: segoe ui;
  line-height: 1.4em;
  font-size: 1.2em;
}

#mainbox{
  font-family: calibri;
  box-sizing: border-box;
  justify-content: center;
  display: flex;
flex-wrap: wrap;
}
.ab{
  float:right;
}
.child{
  line-height:200px;
}

</style>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="./index.php">
                    <i class="fa fa-play-circle"></i> <span class="light">Start</span> Selling
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
             <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="./index.php">Home</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="./Website/logout.php">Logout</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="./edit_profile.php">Profile</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	<header class="das-intro">
	<div class="container">
	  <div class="row" style="padding-top:200px">
	    <div class="col-sm-12" style="text-align: center">
		  <h1 class="brand-heading"><?php echo "Welcome " . $_SESSION["username"]; ?></h1>
		</div>
	  </div>
	  <div class="row">
		<div class="col-sm-4" style="text-align:center;"><div id="mainbox">
<div class="card bag" style="padding-top:25px">
  <h3>Amount to pay:</h3>
  <p style="padding-top:90px"><h1>Rs <?php echo $total_pay; ?></h1></p>
</div>
</div>
	</div>
	<div class="col-sm-4">
	  <h2 class="brand-heading">UID: <?php echo $_SESSION['uid'] ; ?></h2>
	  
	  <form class="form-inline" method="POST">
    <div class="form-group" style="padding-bottom:10px">
      <input type="text" name="filter" class="form-control" id="uid" style="background-color:white" placeholder="Filter Amount By UID" autofocus>
    </div>
    <button type="submit" class="btn btn-default" style="font-weight:bold">Submit</button>
	<p>
			<?php if(isset($filter_purchase)){ ?><div class="alert alert-danger" style="padding:10px" role="alert"> <?php echo "You have to pay <B>Rs.".$filter_purchase."</B> to ".$filter; ?> </div><?php } ?>
			<?php if(isset($filter_rec)){ ?><div class="alert alert-success" style="padding:10px" role="alert"> <?php echo "You have to receive <B>Rs.".$filter_rec."</B> from ".$filter; ?> </div><?php } ?>
  </form>
  
	</div>
		
		
	
	<div class="col-sm-4 ab" style="text-align:center;"><div id="mainbox">
<div class="card bag1" style="padding-top:25px">
  <h3>Amount to receive:</h3>
  <p style="padding-top:90px"><h1>Rs <?php echo $total_rec; ?></h1></p>
</div>
</div>

	</div>
	</div>
	
	<div class="row" style="padding-bottom:120px">
	<div class="col-sm-2" style="padding-top:100px"><button class="ctrl-standard is-reversed typ-subhed fx-bubbleDown" onclick="window.location.href='./buyform.php'">Buy</button></div>
	<div class="col-sm-2" style="padding-top:100px"><button class="ctrl-standard is-reversed typ-subhed fx-bubbleDown" onclick="window.location.href='./data.php'">My Orders</button></div>
	<div class="col-sm-3" style="padding-top:100px"><button class="ctrl-standard is-reversed typ-subhed fx-bubbleDown">Incomplete Transactions</button></div>
	<div class="col-sm-3" style="padding-top:100px"><button class="ctrl-standard is-reversed typ-subhed fx-bubbleDown">Complete Transactions</button></div>
	<div class="col-sm-2" style="padding-top:100px"><button class="ctrl-standard is-reversed typ-subhed fx-bubbleDown">Notifications</button></div>
	
	</div>
	</header>
    <!-- Footer -->
    <footer>
	
        <div class="container text-center">
            <p>Copyright &copy; MandiBill 2016</p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkIYQyEplWOm5ogHEbxSvlWn3CltEWlp0&callback=initMap"></script>
    
  </head>
  <body>

    <!-- Theme JavaScript -->
    <script src="js/grayscale.min.js"></script>
	
	 <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>

</body>

</html>
<?php
}
//if the user is not logged in, redirect to home page.
else {
	header('Location: ./login.php');
}
?>