<?php 
	session_start();
	if(!isset($_SESSION['randnum']))
	{
		$_SESSION['randnum']=1;
	}
	if(isset($_SESSION['user']))
	{
		unset($_SESSION['user']);
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
			section
			{
				padding: 15px;
			}
			body
			{
				background: #D3CCE3;
				background: -webkit-linear-gradient(to right, #E9E4F0, #D3CCE3);
				background: linear-gradient(to right, #E9E4F0, #D3CCE3);
			}
			.item img
			{
				width: 1000px;
				height: 800px;
			}
			.sidelinks li a
			{
				font-size: 20px;
				color:white;

			}
			.sidelinks li
			{
				list-style: none;
			}
			.sidebar
			{
				border-radius: 20px;
				background-color: blue;
			}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-inverse" style="padding-bottom: 6px; padding-top: 6px;">
			<div class="container-fluid">
				<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<a class="navbar-brand" style="padding:0; margin-left:0;" href="#"><img src="logo.png" alt="Mawai Infotech Limited" /></a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
				
				<ul class="nav navbar-nav navbar-right">
					<li style="padding-top: 10px;"><button data-toggle="modal" data-target="#myModal" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span>&nbsp;Sign Up</button></li>
					<li style="padding-top: 10px; margin-left: 4px;"><button data-toggle="modal" data-target="#myModal1"  class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Login</button></li>
				</ul>
				</div>
			</div>
		</nav>
		<div class="row">
		<section>
			<h1 id="typewriter" align="center"></h1>
		</section>
		<section>
			<div class="col-md-4" class="sidebar" style="background-color: #332323;padding: 20px;"><ul class="sidelinks">
				<li><a href="#">Clothing</a></li>
				<li><a href="#">Stationary</a></li>
				<li><a href="#">Computer and Accessories</a></li>
				<li><a href="#">Mobile and Accessories</a></li>
				<li><a href="#">Home Decor</a></li>
				<li><a href="#">Shoes</a></li>
				<li><a href="#">Men's Accessories</a></li>
				<li><a href="#">Women's Accessories</a></li>
				<li><a href="#">Office Furniture</a></li>
				<li><a href="#">Wires and Routers</a></li>
				<li><a href="#">Televisions<li>
				<li><a href="#">Washing Machines</li>
			</ul></div>
			<div class="col-md-8" style="max-height: 500px;">
				<div id="myCarousel" data-interval="2000" class="carousel slide" data-ride="carousel">
  				<!-- Indicators -->
				  <ol class="carousel-indicators">
				    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				    <li data-target="#myCarousel" data-slide-to="1"></li>
				    <li data-target="#myCarousel" data-slide-to="2"></li>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner">
				    <div class="item active">
				      <img src="assets/images/clothing.jpg" alt="Clothing">
				    </div>

				    <div class="item">
				      <img src="assets/images/stationary.png" alt="Stationary">
				    </div>

				    <div class="item">
				      <img src="assets/images/computers.jpg" alt="Computers and Accessories">
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
		</section>
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
		<div class="container">
			<div>
				<?php 

        include 'footer.php';

    ?>
			</div>
		</div>
		<script type="text/javascript">
		    const instance = new Typewriter('#typewriter', {
		      strings: ["WELCOME TO MY INTERNSHIP PROJECT!!"],
		      autoStart: true,
		      loop:true,
		    });

		  </script>
	</body>
</html>
