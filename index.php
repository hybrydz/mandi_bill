<?php  //Start the Session
session_start();

require('connect.php');

//SignUP PROCESS

  if (isset($_POST['first_name']) && isset($_POST['aadhar']) && isset($_POST['last_name']) && isset($_POST['email'])){
        $first_name = $_POST['first_name'];
	    $aadhar = $_POST['aadhar'];
		$last_name= $_POST['last_name'];
		$email = $_POST['email'] ;
		$x = mt_rand(1000,10000);
		$query = "INSERT INTO `profile` (first_name, aadhar, last_name,email) VALUES ('$first_name', '$aadhar', '$last_name', '$email');";
        $query .= "INSERT INTO `sign_in` (UID,email,pass) VALUES (LAST_INSERT_ID(), '$email', '$x');";
        $query .= "INSERT INTO `wallet` (UID,balance,amt_pay,amt_rec) VALUES (LAST_INSERT_ID(), 0, 0, 0)";
		
		
        $result = mysqli_multi_query($connection, $query);
        if($result){
			$msg ="User Registration Successful";
            $_SESSION['success'] =  $msg;
			$_SESSION['user']= $first_name;
			header('Location: ./Website/Success/success.php');
        }else{
            $fmsg ="User Registration Failed";
        }
    }
//1. LOGIN PROCESS
//1.1 If the form is submitted
if (isset($_POST['username']) and isset($_POST['password'])){
//1.1.1 Assigning posted values to variables.
$username = $_POST['username'];
$password = $_POST['password'];
//3.1.2 Checking the values are existing in the database or not
$query = "SELECT email,pass,UID FROM `sign_in` WHERE email='$username' and pass='$password'";
 
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$row = $result->fetch_assoc();
$count = mysqli_num_rows($result);
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
if ($count == 1){
$_SESSION['username'] = $username;
$_SESSION['uid']= $row["UID"];
	}
	else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
			$fmsg = "Invalid Login Credentials.";
		}
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['username'])){
	header('Location: dashboard.php');
	}	
	else{
//3.2 When the user visits the page first time, simple login form will be displayed.
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
	
	
	<!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
<style>
  
input[type="text"],
input[type="number"], 
textarea, 
textarea.form-control {
	height: 50px;
    margin: 0;
    padding: 0 20px;
    vertical-align: middle;
    background: #333;
    border: 1px solid #333;
    font-family: 'Roboto', sans-serif;
    font-size: 16px;
    font-weight: 300;
    line-height: 50px;
    color: #888;
    -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;
    -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
    -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
}

textarea, 
textarea.form-control {
	padding-top: 10px;
	padding-bottom: 10px;
	line-height: 30px;
}

input[type="text"]:focus, 
input[type="number"]:focus,
textarea:focus, 
textarea.form-control:focus {
	outline: 0;
	background: #444;
    border: 3px solid #555;
    -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
}

input[type="text"]:-moz-placeholder, textarea:-moz-placeholder, textarea.form-control:-moz-placeholder { color: #888; }
input[type="text"]:-ms-input-placeholder, textarea:-ms-input-placeholder, textarea.form-control:-ms-input-placeholder { color: #888; }
input[type="text"]::-webkit-input-placeholder, textarea::-webkit-input-placeholder, textarea.form-control::-webkit-input-placeholder { color: #888; }

input[type="number"]:-moz-placeholder, textarea:-moz-placeholder, textarea.form-control:-moz-placeholder { color: #888; }
input[type="number"]:-ms-input-placeholder, textarea:-ms-input-placeholder, textarea.form-control:-ms-input-placeholder { color: #888; }
input[type="number"]::-webkit-input-placeholder, textarea::-webkit-input-placeholder, textarea.form-control::-webkit-input-placeholder { color: #888; }


button.btn {
	width: 100%;
	height: 50px;
    margin: 0;
    padding: 0 20px;
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

button.btn:focus { outline: 0; opacity: 0.6; background: #fd625e; color: #fff; }

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
                <a class="navbar-brand page-scroll" href="#page-top">
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
                        <a class="page-scroll" href="about.html">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="./login.php">Login</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading"><b>Mandi</b>Bill</h1>
                        <p class="intro-text">A place for all your mandi transactions. The perfect alternate to a parchi.</p>
						<p>
						 <!-- LOGIN MODAL--> 
						  <div class="col-sm-6" style="float:right">
						  <a class="btn btn-default btn-lg launch-modal" onclick="$('#modal-register0').modal({'backdrop': 'static'});" href="#" target="transaction" data-modal-id="modal-register0" role="button">Login</a>
						  </div>
						  
						  <div class="modal fade" id="modal-register0" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal">
        					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        				</button>
        				<h3 class="modal-title" id="modal-register-label">Login</h3>
        				<p>Fill in the username and password:</p>
        			</div>
        			
        			<div class="modal-body">
        				
	                    <form method="POST" class="registration-form">
						<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
	                    	<div class="form-group">
	                    		<label class="sr-only" for="form-first-name">Username</label>
	                        	<input type="text" style="color:white" name="username" placeholder="Username..." class="form-first-name form-control" id="form-first-name" required autofocus>
	                        </div>
	                        <div class="form-group">
	                        	<label class="sr-only" for="form-last-name">Password:</label>
	                        	<input type="password" style="color:white" name="password" placeholder="Password...." class="form-last-name form-control" id="form-last-name" required>
	                        </div>
	                        <button type="submit" class="btn">Login!</button>
	                    </form>
	                    
        			</div>
        			
        		</div>
        	</div>
        </div>
						  <!--MODAL SIGNUP -->
						  
						  <div class="col-sm-6" style="float:left">
						  <a class="btn btn-default btn-lg launch-modal" onclick="$('#modal-register').modal({'backdrop': 'static'});" href="#" data-modal-id="modal-register" role="button">Signup</a>
						  </div>
						  <div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal">
        					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        				</button>
        				<h3 class="modal-title" id="modal-register-label">Sign up now</h3>
        				<p>Fill in the form below to get instant access:</p>
        			</div>
        			
        			<div class="modal-body">
        				
	                    <form  method="POST" class="registration-form">
	                    	<div class="form-group">
							    <?php if(isset($fmsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
								<label class="sr-only" for="form-first-name">Full name</label>
	                        	<input type="text" style="color:white" name="first_name" placeholder="First Name" class="form-first-name form-control" id="first_name" required autofocus>
	                        </div>
							<div class="form-group">
	                    		<label class="sr-only" for="form-last-name">Full name</label>
	                        	<input type="text" style="color:white" name="last_name" placeholder="Last Name" class="form-last-name form-control" id="last_name" required>
	                        </div>
	                        <div class="form-group">
	                        	<label class="sr-only" for="form-last-name">Aadhar card number</label>
	                        	<input type="text" style="color:white" name="aadhar" placeholder="Aadhar Id" class="form-last-name form-control" id="aadhar" required>
	                        </div>
	                        <div class="form-group">
	                        	<label class="sr-only" for="form-email">Email</label>
	                        	<input type="email" style="color:white" name="email" placeholder="Email" class="form-email form-control" id="email" required>
	                        </div>
	                        <div class="form-group">
	                        	<label class="sr-only" for="form-about-yourself">Address</label>
	                        	<textarea name="address" style="color:white" placeholder="Address" class="form-about-yourself form-control" id="address" required></textarea>
	                        </div>
	                        <button type="submit" class="btn">Sign me up!</button>
	                    </form>
	                    
        			</div>
        			
        		</div>
        	</div>
        </div>
    </p>
						     
                    </div>
                </div>
			</div>
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
<?php } ?>

