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
		<title>Shopping</title>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<style type="text/css">
			table
			{
				border: 2px solid black;
				border-radius: 10px;
			}
			@media screen and (max-width: 700px) {
				
				#scrolltable {
			        display: block;
			        overflow-x: auto;
			        white-space: nowrap;
    			}

			}
		</style>
	</head>
	<body>

		<nav class="navbar navbar-inverse">
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
				<ul class="nav navbar-nav">
					<li><a href="#"></a></li>
					<li><a href="#"></a></li>
					<li><a href="#"></a></li>
					<li><a href="#"></a></li>
					<li><a href="#"></a></li>
					<li><a href="#"></a></li>
					<li><p class="h3" style="color:white;" align="center">Welcome to your dashboard, <?php echo $_SESSION['user']; ?></p></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li style="padding-top: 10px;"><button class="btn btn-primary" onclick="location.href='details.php?k=<?php echo $_SESSION['user']; ?>'"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Invoice Details</button></li>
					<li style="padding-top: 10px;"><button class="btn btn-primary" onclick="location.href='cart.php?page=1'"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Go to cart</button></li>
					<li style="padding-top: 10px;"><button class="btn btn-primary" onclick="logout()"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</button></li>
				</ul>
				</div>
			</div>
		</nav>
		<section>
			<div id="autoentrydiv" class="col-md-6 col-md-offset-3">
					<table class="table table-striped table-hover">
						<tr>
							<td>Head ID</td>
							<td><input type="text" id="head_id" name="head_id" value="<?php echo 'PRDCTHD'.$_SESSION['user'].date("dmy").$_SESSION['randnum'] ?>" readonly="readonly"></td>
						</tr>
						<tr>
							<td>User ID</td>
							<td><input type="text" id="user_id" name="user_id" value="<?php echo $_SESSION['user'] ?>" readonly="readonly"></td>
						</tr>
						<tr>
							<td>Entry Date</td>
							<td><input type="text" id="datenow" name="datenow" value="<?php echo date("Y-m-d") ?>" readonly="readonly"></td>
						</tr>
					</table>
					<?php 

						$a = 'PRDCTHD'.$_SESSION['user'].date("dmy").$_SESSION['randnum'];
						$b = $_SESSION['user'];
						$c = date("Y-m-d");
						$q = "INSERT INTO `producthead`(`id`, `user_id`, `entry_date`) VALUES ('".$a."','".$b."','".$c."')";

						mysqli_query($conn,$q);
					
					?>
					<table id="scrolltable" class="table table-striped table-hover">
						<tr>
							<td>Product Name <span style='color:red;'>*</span><input type="text" id="pname" name="pname" required></td>
							<td>Product Quantity <span style='color:red;'>*</span> <input type="number" min="1" id="qty" name="qty" required></td>
							<td>Product Price <span style='color:red;'>*</span> <input type="text" id="pprice" name="pprice" required></td>
							<td><button class="add-row btn btn-primary">ADD</button></td>
						</tr>
						<tr>
							<td colspan="4"><h5 style='color:red;'>Fields marked with ( * ) are mandatory</h5></td>
						</tr>
					</table>
			</div>
		</section>
		<section>
			<div class="col-md-10 col-md-offset-1">
				<table id="table_temp" class="table table-striped table-hover"> 
					<tr>
						<th>Head ID</th>
						<th>Product Name</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>&nbsp;</th>
					</tr>
				</table>
			</div>
			<div class="col-md-6" align="center">
				<button type="button" class="submitall btn btn-primary">Confirm Order</button>		
			</div>
			<div class="col-md-6" align="center">
				<button type="button" class="delete-row btn btn-primary">Delete Selected Rows</button>
			</div>
			
		</section>
	</body>
	<?php
		
		$_SESSION['randnum']++;

	?>
	<script>

		function removerow(o)
		{
			var p = o.parentNode.parentNode;
			p.parentNode.removeChild(p);
		}
		function logout()
		{
			var answer = confirm("Are you sure want to logout? All the items remaining in the cart will be deleted.");
			if(answer)
			{
				alert("Successfully Logged Out!!!");
				location.href="index.php";
			}
		}
		$(document).ready(function()
		{
        	$(".add-row").click(function()
			{
				var head_id = $("#head_id").val();
				var pname = $("#pname").val();
				var qty = $("#qty").val();
				var pprice = $("#pprice").val();
				var markup = "<tr><td>"+head_id+"</td><td>"+pname+"</td><td>"+qty+"</td><td>"+pprice+"</td><td><input type='button' onclick='removerow(this)' class='btn btn-primary' value='Remove'></td></tr>";
				if(head_id!="" && pname!="" && qty!="" && pprice!="")
				{
					$("#table_temp").append(markup);
					$("#pname").val("");
					$("#qty").val("");
					$("#pprice").val("");
				}
				else{
					alert("Please fill all the fields!!");
				}
				

			});
		});
		$(".submitall").click(function()
			{
				$('#table_temp tbody').find('tr').each(function(i,el)
				{
					var column = $(this).find('td');
					var headid = column.eq(0).text();
					var productname = column.eq(1).text();
					var productquantity = column.eq(2).text();
					var productprice = column.eq(3).text();
					var stringname = headid + " "+productname+ " "+productquantity+ " "+productprice+ " ";
					$.ajax({
						type: "POST",
						url: 'submitall.php',
						data: {
							
							headid : headid,
							productname : productname,
							productquantity : productquantity,
							productprice : productprice

						},
						success: function(data)
						{
							
						}
					});
				});
				location.href="cart.php?page=1";
			});

	</script>
</html>