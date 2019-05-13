<?php 
	session_start();
	if(!isset($_SESSION['randnum2']))
	{
		$_SESSION['randnum2']=1;
	}
	// if(isset($_SESSION['user']))
	// {
	// 	unset($_SESSION['user']);
	// }
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
				background-color: #c5f2b0;
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
		<section>
			<div class="col-md-4 col-md-offset-1" id="generate">
				<h3>Generate your invoice</h3>
				<form method="post" action="submit.php">
					<table class="table table-striped table-hover">
						<tr>
							<td><h4>Invoice ID </h4></td>
							<td><input readonly="readonly" type="text" name="invid" value="<?php echo"INVID".$_SESSION['user'].date("dmy").$_SESSION['randnum2']; ?>"></td>
						</tr>
						<tr>
							<td><h4>Invoice date </h4></td>
							<td><input readonly="readonly" type="text" name="invdate" value="<?php echo(date("Y-m-d")) ?>"></td>
						</tr>
						<tr>
							<td><h4>Amount to be paid</h4></td>
							<td><input readonly="readonly" value="<?php echo $_GET['amt'] ?>" type="text" name="amount"></td>
						</tr>
						<tr>
							<td><h4>User ID : </h4></td>
							<td><input readonly="readonly" value="<?php echo $_GET['uid'] ?>" type="text" name="userid"></td>
						</tr>

						<tr>
							<td colspan=2 class="text-center"><input class="btn btn-primary" type="submit" value="Generate" /></td>
						</tr>
					</table>
				</form>
			</div>
			<div class="col-md-4 col-md-offset-2" id="pay">
				<h3>Make payement</h3>
				<form method="post" action="instamojo/order.php">
					<table class="table table-striped table-hover">
						<tr>
							<td><h4>Payment Date</h4></td>
							<td><input readonly="readonly" type="text" name="depositdate" value="<?php echo(date("Y-m-d")) ?>"></td>
						</tr>
						<tr>
							<td><h4>Enter Invoice ID </h4></td>
							<td><input type="text" name="invid"></td>
						</tr>
						<tr>
							<td><h4>Amount paying </h4></td>
							<td><input required="required" type="text" name="depositamount"></td>
						</tr>
						<tr>
							<td><h4>Mode of payement</h4></td>
							<td><select name="mode">
								<option value="">----SELECT----</option>
								<option value="Cash">Cash</option>
								<option value="Cheque">Cheque</option>
								<option value="Demand Draft">Demand Draft</option>
								<option value="Net Banking">Net Banking</option>
								<option value="Card">Debit/Credit Card</option>

							</select></td>
						</tr>

						<tr>
							<td class="text-center"><input class="btn btn-primary" type="submit" /></td>
							<td class="text-center"><input class="btn btn-primary" type="reset" /></td>
						</tr>
					</table>
				</form>
			</div>
		</section>
	</body>
</html>
