<?php
	require('connect.php');
	$conn = mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
		echo "";
	}
	else
	{
		echo mysqli_error($conn);;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>ADMIN PANEL</title>
	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/animate.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<style type="text/css">
		table
		{
			border: 2px solid black;
		}
	</style>
</head>
<body>
	<div class="row">
		<div class="col-md-4 col-md-offset-1" style="border: 2px solid black;border-radius: 20px; padding: 20px;">
			<h1>Categories in database</h1>
			<table class="table table-striped table-hover">
				<tr>
					<th>ID</th>
					<th>Category Name</th>
				</tr>
				<?php

					$query = "select * from categories";
					$result=  mysqli_query($conn,$query);
					if($result)
					{
						while($row = mysqli_fetch_array($result))
						{
							echo "<tr>
									<td>".$row[0]."</td>
									<td>".$row[1]."</td>
								</tr>";
						}
					}
				 ?>
			</table>
		</div>
		<div class="col-md-5 col-md-offset-1" style="border: 2px solid black;border-radius: 20px; padding: 20px;">
			<h1>Sub-categories in database</h1>
			<table class="table table-striped table-hover">
				
				<tr>
					<th>ID</th>
					<th>Category Name</th>
					<th>Main Category ID</th>
					<th>Main Cateogry Name</th>
				</tr>
				<?php

					$query1 = "select A.*,B.name from subcategories as A inner join categories as B on A.maincategory = B.id";
					$result1=  mysqli_query($conn,$query1);
					if($result1)
					{
						while($row1 = mysqli_fetch_array($result1))
						{
							echo "<tr>
									<td>".$row1[0]."</td>
									<td>".$row1[1]."</td>
									<td>".$row1[2]."</td>
									<td>".$row1[3]."</td>
								</tr>";
						}
					}
				 ?>
			</table>
		</div>
	</div>
	<div class="row" style="padding: 20px;">
		<div class="col-md-4 col-md-offset-1" style="border: 2px solid black;border-radius: 20px; padding: 20px;">
			<h1>Add a main category</h1>
			<form action="../category.php" method="post">
				<table class="table table-striped table-hover">
					<tr>
						<td colspan="2"><h3 align="center">Enter details</h3></td>	
					</tr>
					<tr>
						<td>Enter category Name</td>
						<td><input type="text" name="category"></td>
					</tr>
					<tr>
						<td><input type="submit" value="Insert" class="btn btn-primary"></td>
						<td><input type="reset" value="Reset" class="btn btn-primary"></td>
					</tr>
				</table>
			</form>
		</div>
		<div class="col-md-4 col-md-offset-2" style="border: 2px solid black;border-radius: 20px; padding: 20px;">
			<h1>Add a sub-category</h1>
			<form action="../subcategory.php" method="post">
				<table class="table table-striped table-hover">
					<tr>
						<td colspan="2"><h3 align="center">Enter details</h3></td>	
					</tr>
					<tr>
						<td>Enter category Name</td>
						<td><input type="text" name="category"></td>
					</tr>
					<tr>
						<td>Select Main Category</td>
						<td><select name="main_category">
							
							<?php

								$query = "select * from categories";
								$result=  mysqli_query($conn,$query);
								if($result)
								{
									while($row = mysqli_fetch_array($result))
									{
										echo "<option value='".$row[0]."'>".$row[1]."</option>";
									}
								}
							 ?>
							
						</select></td>
					</tr>
					<tr>
						<td><input type="submit" value="Insert" class="btn btn-primary"></td>
						<td><input type="reset" value="Reset" class="btn btn-primary"></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>