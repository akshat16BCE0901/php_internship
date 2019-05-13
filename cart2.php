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
			#dynamictable
			{
				background-color: lightblue;
			}
		</style>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-offset-2 col-md-8">
					<table class="table table-striped table-hover">
						<tr>
							<th>Product Head ID</th>
							<th>Product Entry Date</th>
							<th>Total Quantity</th>
							<th>Total Price</th>
							<th>Edit your order</th>
						</tr>

						<?php
							$page = $_GET['page'];
							if($page=="" || $page==1)
							{
								$page1=0;
							}
							else
							{
								$page1= ($page*5) - 5;
							}
							echo "$page1";
							$rowcount = "select count(distinct A.id) from producthead as A join productdetails as B on A.id=B.head_id where A.user_id='".$_SESSION['user']."'";
							$tt= mysqli_query($conn,$rowcount);
							if($tt)
							{
								$rr = mysqli_fetch_array($tt);
								$count = $rr[0];
							}
							$query = "select id,entry_date from producthead where user_id='".$_SESSION['user']."' limit $page1,5";
							echo "$query";
							$result = mysqli_query($conn,$query);
							if($result)
							{
								
								while($row = mysqli_fetch_array($result))
								{
									$name =  $row[0];
									$date = $row[1];
									$query2 = "select head_id,sum(quantity),round(sum(price),2) from productdetails group by head_id having head_id='".$name."'";
									$result2 = mysqli_query($conn,$query2);
									if($result2)
									{
										while($row2 = mysqli_fetch_array($result2))
										{
											echo "<tr>
													<td class='nr'>".$row2[0]."</td>
													<td>".$date."</td>
													<td>".$row2[1]."</td>
													<td>".$row2[2]."</td>
													<td><button type='button' class='btn getdata btn-primary'>EDIT</button></td></tr>";
										}
									}
									else
									{
										echo mysqli_error($conn);
									}
								}
								$num_row = ceil($count/5);
							}
							else
							{
								echo mysqli_error($conn);
							}

						?>
					</table>
				</div>
			</div>
			<div class="row">
				<?php 

					for ($i=1; $i <=$num_row; $i++) { 
						echo "<a class='pgnum' href='cart2.php?page=$i'>$i </a>";
					}
				?>
			</div>
			
		
	</body>
</html>