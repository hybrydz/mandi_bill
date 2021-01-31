<?php
session_start();
require('connect.php');

//If the user is logged in 
if(isset($_SESSION['username'])) {
	$uid = $_SESSION['uid'];
	$uid_purchase = $uid."_purchase" ;
	$uid_rec = $uid."_rec";
//Fetchin data from tables Purachase_Orders and Received_Orders
	$query = "SELECT `sno` , `order_id` , `item` , `quantity`, `rate`, `amount_pay`, `rec_uid`, `date` FROM `$uid_purchase` ";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
	
	$query1 = "SELECT `sno`,`order_id`, `item`, `quantity`, `rate`, `amount_rec`, `cust_uid`, `date`  FROM `$uid_rec` ";
	$result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));
	
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
	
	 <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
		
		<!-- Theme JavaScript -->
    <script src="js/grayscale.min.js"></script>
		
	<!-- Theme CSS -->
    <link href="css/grayscale.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<!-- Data Table -->
	
	<link href="css/dataTables.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="js/dataTables.bootstrap.js"></script>
	<script src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>

	<script language="JavaScript">
	$(document).ready(function() {
		$('#example').dataTable();
	});
	</script>

	<script language="JavaScript">
	$(document).ready(function() {
		$('#example1').dataTable();
	});
	</script>
	<!-- /Data Table -->

	
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
    background: #a6dfd5;
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
                        <a class="page-scroll" href="./dashboard.php">Home</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="./Website/logout.php">Logout</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="./buyform.php">BUY</a>
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
	    <h1 class="brand-heading">MY ORDERS</h1>
	  </div>
	    <div class="col-sm-10 col-sm-offset-1 card">
		</div>		
	  </div>
	</header>
	
	<div style="padding:20px" >
	<!-- Purchase Orders-->
	<div class="panel panel-default" style="padding:10px">
  <!-- Default panel contents -->
  <div class="panel-heading">ORDERS PLACED</div>
  <div class="panel-body"  style="color:black">
    <div class="alert alert-danger" style="padding:10px" role="alert"> <?php echo "Total Amount to Pay : Rs.".$_SESSION['total_pay'] ; ?> </div>
  </div>
<div class="container"> <!-- Data Table Starts -->
  <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%" style="color:black">
    <thead>
      <tr>
        <?php
		if ($result->num_rows > 0) {
			echo"<th  style="."text-align:center".">S.No.</th>" ;
			echo "<th  style="."text-align:center".">Order Id</th>";
			echo "<th  style="."text-align:center".">Item</th>";
			echo "<th  style="."text-align:center".">Quantity</th>";
			echo "<th  style="."text-align:center".">Rate</th>";
			echo "<th  style="."text-align:center".">Amount</th>";
			echo "<th  style="."text-align:center".">Rec UID</th>";
			echo "<th  style="."text-align:center".">Date</th>";
			 ?>
      </tr>
    </thead>
    <tbody>
      <?php while($row=$result->fetch_assoc()) {
		echo "<tr>
				<td>".$row["sno"]."</td>
				<td>".$row["order_id"]."</td>
				<td>".$row["item"]."</td>
				<td>".$row["quantity"]."</td>
				<td>".$row["rate"]."</td>
				<td>".$row["amount_pay"]."</td>
				<td>".$row["rec_uid"]."</td>
				<td>".$row["date"]."</td>		
				</tr>";
			}
	}
	else{ echo "0 results"; }
	 ?>
    </tbody>
  </table>
  </div>
  </div>
  
 <!-- Received Orders -->
  <div class="panel panel-default" style="padding:10px">
 <!-- Default panel contents -->
  <div class="panel-heading">RECEIVED ORDERS</div>
  <div class="panel-body"  style="color:black">
   <div class="alert alert-success" style="padding:10px" role="alert"> <?php echo "Total Amount to Receive : Rs.".$_SESSION['total_rec'] ; ?> </div>
   </div>
  <div class="container">
  <table id="example1" class="table table-hover table-bordered" cellspacing="0" width="100%" style="color:black">
    <thead>
      <tr>
        	<?php
		if ($result1->num_rows > 0) {
			echo"<th  style="."text-align:center".">S.No.</th>" ;
			echo "<th  style="."text-align:center".">Order Id</th>";
			echo "<th  style="."text-align:center".">Item</th>";
			echo "<th  style="."text-align:center".">Quantity</th>";
			echo "<th  style="."text-align:center".">Rate</th>";
			echo "<th  style="."text-align:center".">Amount</th>";
			echo "<th  style="."text-align:center".">Customer UID</th>";
			echo "<th  style="."text-align:center".">Date</th>";
			 ?>
      </tr>
    </thead>
    <tbody>
      <?php while($row1=$result1->fetch_assoc()) {
		echo "<tr>
				<td>".$row1["sno"]."</td>
				<td>".$row1["order_id"]."</td>
				<td>".$row1["item"]."</td>
				<td>".$row1["quantity"]."</td>
				<td>".$row1["rate"]."</td>
				<td>".$row1["amount_rec"]."</td>
				<td>".$row1["cust_uid"]."</td>
				<td>".$row1["date"]."</td>		
				</tr>";
			}
	}
	else{ echo "0 results"; }
	 ?>		
    </tbody>
  </table>
</div>  <!--  Data Table Ends here -->
</div> 

</div>
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
    
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="js/dataTables.bootstrap.js"></script>
	<script src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
</body>
</html>
<?php
	}
	else{
		header('Location: ./login.php');
	}
?>