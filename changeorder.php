<?php 
	session_start();
?>

	<div class="col-md-10 col-md-offset-1">
		<h3>Please select the product you want to modify -</h3> 
	</div>
	<div>
		<table id="dynamictable" class="table table-hover table-striped">
	<tr>
		<td>ID</td>
		<td>Product Name</td>
		<td>Product Quanity</td>
		<td>Product Price</td>
		<td>Change</td>
	</tr>
	<?php

		require 'connect.php';
		if(!isset($_SESSION['user']))
		{
			echo '<script>alert("Sign up/Log in to access dashboard");location.href="index.php"</script>';
		}
		$conn = mysqli_connect($servername,$username,$password,$database);
		if($conn)
		{
			$head_id = $_POST['headid'];
			$user_id = $_SESSION['user'];
			$query = "select * from productdetails where head_id='".$head_id."'";
			$result = mysqli_query($conn,$query);
			if($result)
			{
				while($row = mysqli_fetch_array($result))
				{
					// echo "<tr>
					// 		<td class='nr1'>".$row[0]."</td>
					// 		<td>".$row[2]."</td>
					// 		<td>".$row[3]."</td>
					// 		<td>".$row[4]."</td>
					// 		<td><button class='btn finalchange btn-primary' data-target='#myModal2' data-toggle='modal'>change</button</td>
					// 	</tr>";
					echo "<tr>
							<td><input disabled type='text' value='".$row[0]."'</td>
							<td><input type='text' value='".$row[2]."'</td>
							<td><input type='text' value='".$row[3]."'</td>
							<td><input type='text' value='".$row[4]."'</td>
							<td><button class='btn finalchange btn-primary'>change</button</td>
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
<script type="text/javascript">
	$(".finalchange").click(function()
	{
		var id = $(this).closest('tr').find("td:eq(0) input").val();
		var newname = $(this).closest('tr').find("td:eq(1) input").val();
		var newquantity = $(this).closest('tr').find("td:eq(2) input").val();
		var newprice = $(this).closest('tr').find("td:eq(3) input").val();
		$.ajax(
	    {
			type: "POST",
			url: 'change.php',
			data: {
				
				id : id,
				newname : newname,
				newquantity : newquantity,
				newprice : newprice

			},
			success: function(data)
			{
				console.log(data);
				alert(data);
				document.location.reload();
			}
		});
	});
</script>