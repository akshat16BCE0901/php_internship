<?php 
	session_start();
	require 'connect.php';
	if(!isset($_SESSION['user']))
	{
		echo '<script>alert("Sign up/Log in to access dashboard");location.href="index.php"</script>';
	}
	$conn = mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
	}
	else
	{
		echo "Error - ".mysqli_error($conn);
	}
	if(isset($_SESSION['category']))
	{
		$link = "shopping.php?category=".$_SESSION['category'];
	}
	else
	{
		$link = 'index.php';
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Your cart</title>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<style type="text/css">
			.proceed
			{
				padding: 10px;
				border: 2px solid black;
				border-radius: 20px;
			}
			table
			{
				border: 2px solid black;
				border-radius: 10px;
				overflow-x: scroll;
			}
			.pgnum
			{
				text-align: center;
				font-size: 20px;
				border: 0.5px solid black;
				border-collapse: collapse;
				padding: 2px;
			}
			body
			{
				margin-top: 80px;
			}
		</style>
	</head>
	<body>
		<?php include 'navbar.php'; ?>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-offset-2 col-md-8">
						

						<?php
							$page = $_GET['page'];
							if($page=="" || $page==1)
							{
								$page1=0;
							}
							else
							{
								$page1= ($page*3) - 3;
							}	
							$rowcount = "select count(*) from producthead as A inner join productdetails as B on A.id=B.head_id where A.user_id='".$_SESSION['user']."'";
							$tt= mysqli_query($conn,$rowcount);
							if($tt)
							{
								$rr = mysqli_fetch_array($tt);
								$count = $rr[0];
							}
							include 'changeorder.php';
							$num_row = ceil($count/3);

						?>
				</div>
			</div>
			<div align="center" class="text-center row">
				<?php 
					for ($i=1; $i <=$num_row; $i++) { 
						echo "<a class='pgnum btn btn-sm btn-primary' href='cart.php?page=$i'>&nbsp;$i&nbsp;</a>";
					}
				?>
			</div>
			<div class="row">
				<div align="center" class="col-md-4 col-md-offset-1 proceed">
					<h2>
						Aren't over yet ?
					</h2>
					<button onclick="location.href='<?php echo($link); ?>'" class="btn btn-primary btn-lg">Back to Dashboard!</button>
				</div>
				<div align="center" class=" col-md-offset-1 col-md-5 proceed">
					<h2>That's all? Proceed to Checkout !!</h2>
					<button onclick="location.href='payment.php'" class="btn btn-primary checkout btn-lg">Checkout</button>
				</div>
			</div><br><br>
			<div class="modal fade	" id="myModal2" role="dialog">
			    <div class="modal-dialog modal-lg">
			      	<div class="modal-content">
			        	<div class="modal-header">
			          		<button type="button" class="close" data-dismiss="modal">&times;</button>
			          		<h4 class="modal-title">Modify your order</h4>
			        	</div>
			        	<div class="modal-body">
			          		
			        	</div>
			        	<div class="modal-footer">
			          		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			        	</div>
			      	</div>
			    </div>
			</div>
			<?php 

        include 'footer.php';

    ?>
		</div>
		
		
	</body>
</html>