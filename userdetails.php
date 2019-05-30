<?php
	session_start();
	require 'connect.php';
	$conn = mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
		echo " ";
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
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/animate.css">
		<script src="assets/js/wow.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://unpkg.com/typewriter-effect/dist/core.js"></script>
		<style>
			body {
			  margin:0;
			  font-family: "Lato", sans-serif;
			}

			.sidebar {
			  margin-left: 0;
			  padding-top: 50px;
			  padding-bottom: 38px;
			  width: 200px;
			  background-color: #f1f1f1;
			  position: fixed;
			  height: 100%;
			  overflow: scroll;
			}

			.sidebar a {
			  display: block;
			  color: black;
			  padding: 16px;
			  text-decoration: none;
			}
			 
			.sidebar a.active {
			  background-color: rgba(0,0,0,0.8);
			  color: white;
			}

			.sidebar a:hover:not(.active) {
			  background-color: #555;
			  color: white;
			}
				
			.anchor-color
			{
				color : blue;
			}
			div.content, div.tablee {
			  margin-left: 200px;
			  padding: 10px;
			  margin-top: 80px;
			}

			@media screen and (max-width: 400px) {
			  .sidebar {
			    width: 100%;
			    height: auto;
			    position: relative;
			  }
			  .sidebar a {float: left;}
			  div.content,div.tablee {margin-left: 0;}
			}

			@media screen and (max-width: 400px) {
			  .sidebar a {
			    text-align: center;
			    float: none;
			  }
			}
			.thumbnail >img
			{
				height: 200px;
				width: auto;
			}
			.anchor-color:hover
			{
				text-decoration: none;
			}
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
		<?php include 'navbar.php'; ?>
		  	<div class="container">
		  		<div class="row">
		  			<div class="col-md-10 col-md-offset-1">
		  				<div>
							<table class="table table-hover table-striped">
								<?php

									if($conn)
									{
										$user_id = $_SESSION['user'];
										$query = "select * from login2 where user_id = '".$_SESSION['user']."'";
										$result = mysqli_query($conn,$query);
										if($result)
										{
											$row = mysqli_fetch_array($result);
											echo "<tr>
													<td>User ID :  </td>
													<td>$row[1]</td>
													<td><a class='glyphicon glyphicon-edit' style='cursor : pointer;text-decoration:none;'></a></td>
												</tr>
												<tr>
													<td>Password : </td>
													<td id='passs'>"; 
															for($i=0;$i<strlen($row[2]);$i++)
															{
																echo "*";
															}

													echo"<span> <a onclick='reveal()' style='cursor : pointer; text-decoration: none;' class='glyphicon glyphicon-pencil'></a></span></td>
													<td><a class='glyphicon glyphicon-edit' style='cursor : pointer;text-decoration:none;'></a></td>
												</tr>
												<tr>
													<td>Address : </td>
													<td>$row[6]</td>
													<td><a class='glyphicon glyphicon-edit' style='cursor : pointer;text-decoration:none;'></a></td>
												</tr>
												<tr>
													<td>City : </td>
													<td>$row[7]</td>
													<td><a class='glyphicon glyphicon-edit' style='cursor : pointer;text-decoration:none;'></a></td>
												</tr>
												<tr>
													<td>State : </td>
													<td>$row[8]</td>
													<td><a class='glyphicon glyphicon-edit' style='cursor : pointer;text-decoration:none;'></a></td>
												</tr>";
										}
									}
									else
									{
										echo "Error - ".mysqli_error($conn);
									}

								?>
							</table>
						</div>
		  			</div>
		  		</div>
		  	</div>
		
	</body>
	<script type="text/javascript">
		
		function logout()
		{
			var answer = confirm("Are you sure want to logout?");
			if(answer)
			{
				alert("Successfully Logged Out!!!");
				location.href="index.php";
			}
		}
		function reveal()
		{
			var a = $("#passs").text('<?php echo(strval($row[2]));?>');
		}

	</script>
</html>