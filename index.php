<?php 
	session_start();
	if(!isset($_SESSION['randnum']))
	{
		$_SESSION['randnum']=1;
	}
	require 'connect.php';

	$conn = mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
		echo "";
	}
	else
	{
		echo "Error - ".mysqli_error($conn);
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Shopping</title>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="assets/css/animate.css">
		<script src="assets/js/wow.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://unpkg.com/typewriter-effect/dist/core.js"></script>

		<script type="text/javascript">
			new WOW().init();
		</script>
		<style type="text/css">
			body
			{
				scroll-behavior: smooth;
			}
			#registerdiv
			{
				padding: 10px;
				border: 2px solid black;
				border-radius: 10px;
				background-color: #c5f2b0;
			}
			#logindiv
			{
				padding: 10px;
				border: 2px solid black;
				border-radius: 10px;
				background: #c2d3ef;
			}
			.row
			{
				padding: 20px;
			}
			.carousel-caption
			{
				background-color: rgba(0,0,0,0.8);
			}
			.card
			{
				background-color: #e3e3e3;
				padding: 10px;
			}

		</style>
	</head>
	<body>
		<?php include 'navbar.php'; ?>
		<div style=" padding-top: 70px;" class="container-fluid">
			<div class="row">
				<div id="myCarousel" data-interval='2000' class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				    <li data-target="#myCarousel" data-slide-to="1"></li>
				    <li data-target="#myCarousel" data-slide-to="2"></li>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner">
				    <div class="item active">
				      <img style="max-height: 500px; width: 100%;" src="assets/images/shopping1.jpg" alt="Shopping Image 1">
				      <div class="carousel-caption">
				        <h3>SALE - 50-60 % on familywear</h3>
				        <p>Come fall in love with shopping</p>
				      </div>
				    </div>

				    <div class="item">
				      <img style="max-height: 500px; width: 100%;" src="assets/images/shopping2.jpg" alt="Shopping Image 2">
				      <div class="carousel-caption">
				        <h3>LATEST CLUB ACCESSORIES</h3>
				        <p>Hurry Up!! Stocks Limited.</p>
				      </div>
				    </div>

				    <div class="item">
				      <img style="max-height: 500px; width: 100%;" src="assets/images/shopping3.png" alt="Shopping image 3">
				      <div class="carousel-caption">
				        <h3>UNILEY NOW AVAILABLE !!!</h3>
				        <p>Get 10% additional discount on first order!!</p>
				      </div>
				    </div>
				  </div>

				  <!-- Left and right controls -->
				  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#myCarousel" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>
			</div>
			
			<div style="background-color: skyblue;" class="row">
				<div align="center" class="col-md-3 card text-center">
					<h3>Laptops and Accessories</h3>
					<div align="center">
						<img style="min-height: 300px; width:100%;" class="img img-responsive" src="assets/images/card-img-1.jpg" alt="Image 1">
					</div>
				</div>
				<div class="col-md-1"></div>
				<div style="background-color: white;" class="col-md-3 card text-center">
				
					<h3>All brands available</h3>
					<div  align="center" class="row">
						<div class="col-md-6"><img class="img img-responsive" src="assets/images/icon-1.jpg" alt="Image 2"></div>
						<div class="col-md-6"><img class="img img-responsive" src="assets/images/icon-2.jpg" alt="Image 2"></div>
					</div>
					<div align="center"  class="row">
						<div class="col-md-6"><img class="img img-responsive" src="assets/images/icon-3.jpg" alt="Image 2"></div>
						<div class="col-md-6"><img class="img img-responsive" src="assets/images/icon-4.jpg" alt="Image 2"></div>
					</div>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-3 card">
					<h3>Latest Designs</h3>
					<div id="myCarousel2" data-interval='2000' class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				    <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
				    <li data-target="#myCarousel2" data-slide-to="1"></li>
				    <li data-target="#myCarousel2" data-slide-to="2"></li>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner">
				    <div class="item active">
				      <img style="max-height: 310px; width: 100%;" src="assets/images/men.jpg" alt="Shopping Image 1">  
				    </div>

				    <div class="item">
				      <img style="max-height: 310px; width: 100%;" src="assets/images/women.jpg" alt="Shopping Image 2">
				    </div>

				    <div class="item">
				      <img style="max-height: 310px; width: 100%;" src="assets/images/children.jpg" alt="Shopping image 3">
				    </div>
				  </div>

				  <!-- Left and right controls -->
				  <a class="left carousel-control" href="#myCarousel2" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#myCarousel2" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>
				</div>
				<div class="col-md-1"></div>
			</div>
			<div class="row" style="background-color: white;">
				<ul class="nav nav-pills nav-justified">
				  <li class="active"><a data-toggle="tab" href="#home">Latest Kurti Designs</a></li>
				  <li><a data-toggle="tab" href="#menu1">Pendrives Under 999/-</a></li>
				  <li><a data-toggle="tab" href="#menu2">Fresh Arrivals for Men</a></li>
				  <li><a data-toggle="tab" href="#menu3">Recommended for you</a></li>
				  <li><a data-toggle="tab" href="#menu4">Menu 4</a></li>
				  <li><a data-toggle="tab" href="#menu5">Menu 5</a></li>
				  <li><a data-toggle="tab" href="#menu6">Menu 6</a></li>
				</ul>

				<div align="center" class="tab-content">
				  <div id="home" class="tab-pane fade in active">
				    <div class="row">
				    	<div class="col-md-2"><img src="assets/images/kurti1.jpg" alt="Kurti" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/kurti2.jpg" alt="Kurti" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/kurti3.jpg" alt="Kurti" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/kurti4.jpg" alt="Kurti" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/kurti5.jpg" alt="Kurti" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/kurti6.jpg" alt="Kurti" class="img-responsive"></div>
				    </div>
				  </div>
				  <div id="menu1" class="tab-pane fade">
				    <div class="row">
				    	<div class="col-md-2"><img src="assets/images/pd1.jpg" alt="Pendrive" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/pd2.jpg" alt="Pendrive" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/pd3.jpg" alt="Pendrive" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/pd4.jpg" alt="Pendrive" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/pd5.jpg" alt="Pendrive" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/pd6.jpg" alt="Pendrive" class="img-responsive"></div>
				    </div>
				  </div>
				  <div id="menu2" class="tab-pane fade">
				    <div class="row">
				    	<div class="col-md-2"><img src="assets/images/men1.jpg" alt="Menswear" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/men2.jpg" alt="Menswear" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/men3.jpg" alt="Menswear" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/men4.jpg" alt="Menswear" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/men5.jpg" alt="Menswear" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/men6.jpg" alt="Menswear" class="img-responsive"></div>
				    </div>
				  </div>
				  <div id="menu3" class="tab-pane fade">
				    <div class="row">
				    	<div class="col-md-2"><img src="assets/images/comp1.jpg" alt="Recommendations" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/comp2.jpg" alt="Recommendations" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/comp3.jpg" alt="Recommendations" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/comp4.jpg" alt="Recommendations" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/comp5.jpg" alt="Recommendations" class="img-responsive"></div>
				    	<div class="col-md-2"><img src="assets/images/comp6.jpg" alt="Recommendations" class="img-responsive"></div>
				    </div>
				  </div>
				  <div id="menu4" class="tab-pane fade">
				    <h3>Menu 4</h3>
				    <p>Some content in menu 4.</p>
				  </div>
				  <div id="menu5" class="tab-pane fade">
				    <h3>Menu 5</h3>
				    <p>Some content in menu 5.</p>
				  </div>
				  <div id="menu6" class="tab-pane fade">
				    <h3>Menu 6</h3>
				    <p>Some content in menu 6.</p>
				  </div>
				</div>
			</div>
			<div style="background-color: lightgreen;" id="contact" class="row">
				<h1 style="font-size: 50px;" align="center">Contact Us</h1>
				<div align="center" class="col-md-6">

					<h2>MAWAI INFOTECH LTD,</h2>
					<h3>A-164, Sector 63 Rd.</h3>
					<h3>Sector 63, Noida</h3>
					<h3><span><i class="glyphicon glyphicon-phone"></i></span>(+91)9629000816</h3>
					<h4>Email Us at - <a style="color: black; font-size: 17px;" href="mailto:akshat.singhal2016@vitstudent.ac.in">akshat.singhal2016@vitstudent.ac.in</a></h4>
				</div>
				<div class="col-md-6">
					<iframe style="width: 100%; height: 40vh;" class="img img-responsive" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.228557163921!2d77.37618441508238!3d28.62291128242161!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ceff61f435049%3A0xa3e7780d94730f8c!2sMawai+Infotech+Ltd.!5e0!3m2!1sen!2sin!4v1558345096238!5m2!1sen!2sin"  frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
			</div>
			<div class="footer row" align="center" style="background-color: rgba(0,0,0,0.8); color: white;">
				<h3>COPYRIGHT &copy; AKSHAT SINGHAL</h3>
			</div>
		</div>





	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h2 class="modal-title">Haven't Joined Yet.?? Register now!</h2>
	      </div>
	      <div class="modal-body">
	      	<div id="registerdiv">
				
				<form action='register.php' method="post" enctype="multipart/form-data">
					<table class="table table-striped table-hover">
						<tr>
							<td><h4>Enter user ID </h4></td>
							<td><input required="required" type="text" name="user_id"></td>
						</tr>
						<tr>
							<td><h4>Enter password </h4></td>
							<td><input required="required" type="password" name="password"></td>
						</tr>
						<tr>
							<td><h4>Confirm password </h4></td>
							<td><input required="required" type="password" name="confirmpass"></td>
						</tr>
						<tr>
							<td><h4>Upload Profile Picture</h4></td>
							<td><input type="file" name="image"></td>
						</tr>
						<tr>
							<td class="text-center"><button class="btn btn-primary" type="submit">SUBMIT</button></td>
							<td class="text-center"><button class="btn btn-primary" type="reset">RESET</button></td>
						</tr>
					</table>
				</form>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>



	<div id="myModal1" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h2 class="modal-title">Login</h2>
	      </div>
	      <div class="modal-body">
	      	<div id="registerdiv">
				
				<form action='login.php' method="post">
					<table class="table table-striped table-hover">
						<tr>
							<td><h4>Enter user ID </h4></td>
							<td><input required="required" type="text" name="user_id"></td>
						</tr>
						<tr>
							<td><h4>Enter password </h4></td>
							<td><input required="required" type="password" name="password"></td>
						</tr>
						<tr>
							<td class="text-center"><button class="btn btn-primary" type="submit">SUBMIT</button></td>
							<td class="text-center"><button class="btn btn-primary" type="reset">RESET</button></td>
						</tr>
					</table>
				</form>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>
	</body>
</html>
