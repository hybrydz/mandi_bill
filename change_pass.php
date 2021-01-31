<?php

session_start();
require('connect.php');



if(isset($_SESSION["username"])){

	$uid= $_SESSION["uid"];
	
	if(isset($_POST["old_pass"]) and isset($_POST["new_password"]) and isset($_POST["confirm_password"])){
		$old= $_POST["old_pass"];
		$new= $_POST["new_password"];
		$conf= $_POST["confirm_password"];
		
		if($new == $conf){
			$query= "SELECT pass from sign_in WHERE UID= '$uid' ";
			$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
			$row= $result->fetch_assoc();
	
			if($old == $row["pass"])
			{
			$query= "UPDATE sign_in set pass='$new' where pass='$old'";
			$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
	
				if($result){
					$smsg= "Password Changed Successfully";
				}
				else{
					$fmsg= "Password could not be changed. Please try again.";
				}
			}
			else{
				$omsg= "Old Password doesnt match";
			}
			
		}
		else{
				$nmsg= "New Password doesnt match";
			}
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
    <link rel="stylesheet" href="assets/css/form-elements.css">

	<link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style1.css">
	
	<!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
		
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
	
	<!-- jQuery -->
    <script src="vendor/jquery/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkIYQyEplWOm5ogHEbxSvlWn3CltEWlp0&callback=initMap"></script>
    
  
	<!-- Theme JavaScript -->
    <script src="js/grayscale.min.js"></script>
	
	 <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>

<style>

.back{
background-color:	#6a8d9d;
line-height: 200px;
margin-top: 10px;
}
.inc-intro {
  display: table;
  width: 100%;
  height: auto;
  padding-top: 30px;
  padding-bottom:0px;
  text-align: center;
  color: white;
  background: url(./img/inc-bg.jpg) no-repeat bottom center scroll;
  background-color: black;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;
}
.bag{
background-color:	#5a545a;
}
.bag1{
background-color:		#cccccc;
}
img{
  border-radius: 50%;
  width: 70px;
  margin: 10px;
}
.card{
  border-radius: 5%;
  background-color: white;
}
h1{
  font-weight: lighter;
  margin-left: 0px;
  margin-top: -70px;
}

.bg-card{
background-color:#fff;
border-radius:10%;
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
button.btn {
	
	height: 50px;
    vertical-align: middle;
    background: #fd625e;
    border: 0;
    font-family: 'Roboto', sans-serif;
    font-size: 16px;
    font-weight: 300;
    line-height: 50px;
    color: #fff;
    -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;
    text-shadow: none;
    -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
    -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
}

button.btn:hover { opacity: 0.6; color: #fff; }

button.btn:active { outline: 0; opacity: 0.6; color: #fff; -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none; }

button.btn:focus { outline: 0; opacity: 0.6; background: #35607c; color: #fff; }

button.btn:active:focus, button.btn.active:focus { outline: 0; opacity: 0.6; background: #fd625e; color: #fff; }
</style>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="./index.html">
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
                        <a class="page-scroll" href="./dashboard.php">Home</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="./edit_profile.php">Profile</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#./Wensite/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	<header class="inc-intro">
	<div class="container">
	  <div class="row" style="padding-top:200px">
	    <h1 class="brand-heading">Change Password</h1>
	  </div>
	    <div class="col-sm-10 col-sm-offset-1 card">
		  
		</div>
		
	  </div>
	</div>
	</header>
	    
		
	<!-- <Change Password Form> -->	
	<div class="container">
	<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
	<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
	<?php if(isset($omsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $omsg; ?> </div><?php } ?>
	<?php if(isset($nmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $nmsg; ?> </div><?php } ?>
    <form class="registration-form" method="POST">
        <h2 class="form-signin-heading"> </h2>
		
	        <div class="form-group">
			<label class="sr-only" for="form-first-name">Old Password</label>
			<input type="password" style="color:white" name="old_pass" placeholder="Old Password" class="form-first-name form-control" id="form-first-name" required autofocus>
	    </div>
	    <div class="form-group">
	       	<label class="sr-only" for="form-last-name">New Password:</label>
	       	<input type="password" style="color:white" name="new_password" placeholder="New Password" class="form-last-name form-control" id="form-last-name" required >
	    </div>
		<div class="form-group">
	    <label class="sr-only" for="form-last-name">Confirm Password:</label>
	    <input type="password" style="color:white" name="confirm_password" placeholder="Confirm New Password" class="form-last-name form-control" id="form-last-name" required >
	    </div>
	    <button type="submit" class="btn btn-lg btn-primary btn-block">Submit</button>
	</form>

    </div> <!-- </Change Password Form>-->
		
		
		
		
    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; MandiBill 2016</p>
        </div>
    </footer>

    
  
    
</body>

</html>
<?php
	}
	else{
		header('Location: ./login.php');
	}