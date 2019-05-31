<div style="overflow: scroll;">
	<table id="dynamictable" class="table table-hover table-striped">
		<tr>
			<th class="text-center" colspan="6">
				<?php 
					$conn = mysqli_connect($servername,$username,$password,$database);
					$q = "select sum(B.price) from producthead as A inner join productdetails as B on A.id=B.head_id where A.user_id='".$_SESSION['user']."'";
					$r = mysqli_query($conn,$q);
					if($r)
					{
						$ro = mysqli_fetch_array($r);
						$totprice = $ro[0];
						if(!$totprice)
						{
							$totprice=0;
						}
					}
					else
					{
						echo "Error- ".mysqli_error($conn);
					}

				?>
				<h3>Total Price - Rs. <span id="totprice"><?php echo "$totprice"; ?></span></h3>
			</th>
		</tr>
		<tr>
			<th style="width: 10%;">ID</th>
			<th style="width: 20%;">&nbsp;</th>
			<th style="width: 25%;">Product Name</th>
			<th style="width: 15%;">Product Quanity</th>
			<th style="width: 10%;">Product Price</th>
			<th style="width: 20%;">Change</th>
		</tr>
		<?php

			require 'connect.php';
			if(!isset($_SESSION['user']))
			{
				echo '<script>alert("Sign up/Log in to access dashboard");location.href="index.php"</script>';
			}
			if($conn)
			{
				$user_id = $_SESSION['user'];
				$query = "select B.* from producthead as A inner join productdetails as B on A.id=B.head_id where A.user_id='".$user_id."' limit $page1,3	";
				$result = mysqli_query($conn,$query);
				if($result)
				{
					while($row = mysqli_fetch_array($result))
					{
						
						echo "<tr class='selectorclass'>
								<td style='width:10%;'>$row[0]</td>
								<td style='width:20%;'><img style='max-height:110px; width: auto;' src='$row[3]' alt='productImage' /></td>
								<td style='width:25%;'>$row[4]</td>
								<td style='width:15%;'><div class='btn-group'><button ";

								if($row[5]==1)
								{
									echo " disabled ";
								}

								echo " class='minusone btn btn-sm btn-primary'>-</button><button style='background-color:white;color:black;' class='qqq btn btn-primary btn-sm'>$row[5]</button><button class='plusone btn btn-sm btn-primary'>+</button></div></td>
								<td style='width:10%;'>$row[7]</td>
								<td style='width:20%;'><div class='btn-group'><button class='btn finalremove btn-danger btn-sm'>Remove</button></div></td>
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
		var id = $(this).closest('tr').find("td:eq(0)").text();
		var newname = $(this).closest('tr').find("td:eq(2)").text();
		var newquantity = $(this).closest('tr').find("td:eq(3)").find("button.qqq").text();
		var newprice = parseFloat($(this).closest('tr').find("td:eq(4)").text())*parseInt(newquantity);
		$.ajax(
	    {
			type: "POST",
			url: 'change.php',
			data: {
				
				id : id,
				newquantity : newquantity,
				newprice : newprice

			},
			success: function(data)
			{
				console.log(data);
				alert(data);
				$("#totprice")
			}
		});
	});

	$(".finalremove").click(function()
	{
		var conf = confirm("Are you sure want to delete this item from the cart? The action cannot be undone");
		if(conf)
		{
			var id = $(this).closest('tr').find("td:eq(0)").text();
			var newquantity = $(this).closest('tr').find("td:eq(3)").find("button.qqq").text();
		    $.ajax({
				type: "POST",
				url: 'removeitem.php',
				data: {
					
					quantity : newquantity,
					id : id

				},
				success: function(data)
				{
					document.location.reload();
				}
			});
		}
		
	});

	$(".plusone").unbind().click(function()
	{
		var i = parseInt($(this).closest('tr').find('button.qqq').text());
		i+=1;
		$(this).closest('tr').find('button.qqq').text(i);
		var id = $(this).closest('tr').find("td:eq(0)").text();
		var newname = $(this).closest('tr').find("td:eq(2)").text();
		var newquantity = $(this).closest('tr').find("td:eq(3)").find("button.qqq").text();
		var newprice = parseFloat($(this).closest('tr').find("td:eq(4)").text())*parseInt(newquantity);
		$.ajax(
	    {
			type: "POST",
			url: 'change.php',
			data: {
				
				id : id,
				newquantity : newquantity,
				newprice : newprice

			},
			success: function(data)
			{
				if(data!="Updated")
				{
					alert(data);
				}
				document.location.reload();
			}
		});
	});
	$(".minusone").unbind().click(function()
	{
		var i  = parseInt($(this).closest('tr').find('button.qqq').text());
		i-=1;
		if(i<=0)
		{
			i=1;
		}
		$(this).closest('tr').find('button.qqq').text(i);
		var id = $(this).closest('tr').find("td:eq(0)").text();
		var newname = $(this).closest('tr').find("td:eq(2)").text();
		var newquantity = $(this).closest('tr').find("td:eq(3)").find("button.qqq").text();
		var newprice = parseFloat($(this).closest('tr').find("td:eq(4)").text())*parseInt(newquantity);
		$.ajax(
	    {
			type: "POST",
			url: 'change.php',
			data: {
				
				minus : "sorted",
				id : id,
				newquantity : newquantity,
				newprice : newprice

			},
			success: function(data)
			{
				if(data!="Updated")
				{
					alert(data);
				}
				document.location.reload();
			}
		});
	});
	$(".remove-item").click(function()
	{
		$(this).closest('tr').fadeOut(300,function()
		{
			$(this).remove();
		});
	});
</script>