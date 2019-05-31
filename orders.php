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

							$rowcount = "select count(*) from producthead as A inner join orders as B on A.id=B.head_id where A.user_id='".$_SESSION['user']."'";
							$tt= mysqli_query($conn,$rowcount);
							if($tt)
							{
								$rr = mysqli_fetch_array($tt);
								$count = $rr[0];
							}
							?> 

							<div>
								<table id="dynamictable" class="table table-hover table-striped">
									<tr>
										<th style="width: 20%;">&nbsp;</th>
										<th style="width: 25%;">Product Name</th>
										<th style="width: 10%;">Product Price</th>
										<th style="width: 10%;">Product Quantity</th>
										<th style="width: 15%;">Subtotal</th>
										<th style="width: 20%;">Date of Shopping</th>

									</tr>
									<?php

										if($conn)
										{
											$user_id = $_SESSION['user'];
											$query = "select B.*,A.entry_date from producthead as A inner join orders as B on A.id=B.head_id where A.user_id='".$user_id."' limit $page1,3	";
											$result = mysqli_query($conn,$query);
											if($result)
											{
												while($row = mysqli_fetch_array($result))
												{
													
													echo "<tr class='selectorclass'>
															<td style='width:20%;'><img style='max-height:110px; width: auto;' src='$row[3]' alt='productImage' /></td>
															<td style='width:25%;'>$row[4]</td>
															<td style='width:10%;'>$row[7]</td>
															<td style='width:10%;'>$row[5]</td>
															<td style='width:15%;'>$row[6]</td>
															<td style='width:20%;'>$row[9]</td>
														</tr>";
												}
											}
											else
											{
												echo "No orders found";
											}
										}
										else
										{
											echo "Error - ".mysqli_error($conn);
										}

									?>
								</table>
							</div>

							<?php 

							$num_row = ceil($count/3);

						?>
				</div>
			</div>
			<div align="center" class="text-center row">
				<?php 
					for ($i=1; $i <=$num_row; $i++) { 
						echo "<a class='pgnum btn btn-sm btn-primary' href='orders.php?page=$i'>&nbsp;$i&nbsp;</a>";
					}
				?>
			</div>
			
			<?php 

        include 'footer.php';

    ?>
		</div>
		
		
	</body>
</html>