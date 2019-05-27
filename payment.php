<?php 
	session_start();

	require 'connect.php';	
	if(!isset($_SESSION['randnum2']))
	{
		$_SESSION['randnum2']=1;
	}
	
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Invoice</title>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<style type="text/css">
			#generate
			{
				padding: 10px;
				border: 2px solid black;
				border-radius: 10px;
			}
			#pay
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
				background: #D3CCE3;  /* fallback for old browsers */
				background: -webkit-linear-gradient(to right, #E9E4F0, #D3CCE3);  /* Chrome 10-25, Safari 5.1-6 */
				background: linear-gradient(to right, #E9E4F0, #D3CCE3); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

			}
		</style>
	</head>
	<body>
		<section>
			<h1 align="center">Welcome to the payment process!!</h1>
		</section>
		<?php

			if(!isset($_SESSION['user']))
			{
				echo '<script>alert("Sign up/Log in to access dashboard");location.href="index.php"</script>';
			}
			else
			{
				$conn = mysqli_connect($servername,$username,$password,$database);
				if($conn)
				{
					$price = 0;
					$invoice = "INVID".$_SESSION['user'].date("dmy").$_SESSION['randnum2'];
					$query = "select IF(sum(price) IS NOT NULL,sum(price),0) from producthead as A inner join productdetails as B on A.id=B.head_id where A.user_id='".$_SESSION['user']."'";
					$result = mysqli_query($conn,$query);
					if($result)
					{
						$row = mysqli_fetch_array($result);
						$price = $row[0]; 
					}
					if($price)
					{
						$invdate = date("Y-m-d");
						$u = $_SESSION['user'];
						$quer = "INSERT INTO `invoice` VALUES ('$invoice',$price,'$invdate','$u')";
				        if(mysqli_query($conn,$quer))
				        {
				            
				            $_SESSION['correct'] = true;
				            ?>
								<section>
									<div class="col-md-4 col-md-offset-2" id="pay">
										<form method="post" action="instamojo/order.php">
											<table class="table table-striped">
												<tr>
													<td>Invoice ID : </td>
													<td><input type="text" readonly="readonly" name="invid" value="<?php echo($invoice); ?>"></td>
												</tr>
												<tr>
													<td>Total Amount : </td>
													<td><input type="text" readonly="readonly" name="depositamount" value="<?php echo($price); ?>"></td>
												</tr>
												<tr>
													<td colspan="2"><input class="btn formpay btn-primary" type="submit" value="Confirm" /></td>
												</tr>
											</table>
											
											
											
										</form>
									</div>
								</section>


				            <?php
				        }
				        else{
				            echo mysqli_error($conn);
				        }

					}
					else
					{
						?>

							<section>
								<div class="col-md-4 col-md-offset-2" id="pay">
									<h3>Your cart is empty. Please add items into the cart first.</h3>
									
								</div>
							</section>

						<?php
					}
					
				}
				else
				{
					echo "Error - ".mysqli_error($conn);
				}

			}

		?>
	</body>
	<script type="text/javascript">
		$(".formpay").trigger('click');
	</script>
</html>
