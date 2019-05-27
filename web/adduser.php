<?php 

		include '../connect.php';
		$conn= mysqli_connect($servername,$username,$password,$database);
		if($conn)
		{
			echo " ";
		}
		else
		{
			echo mysqli_error($conn);
		}
		$pageno = $_GET['page'];
		//echo "<script>alert($pageno)</script>";

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
		.pgnum
		{
			text-align: center;
			font-size: 20px;
			border: 0.5px solid black;
			border-collapse: collapse;
			padding: 2px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="bs-example widget-shadow" data-example-id="bordered-table"> 
						<h4>Bordered Basic Table:</h4>
						<table class="table table-bordered"> <thead> <tr> <th>#</th> <th>First Name</th> <th>Last Name</th> <th>Username</th> </tr> </thead> <tbody> <tr> <th scope="row">1</th> <td>Mark</td> <td>Otto</td> <td>@mdo</td> </tr> <tr> <th scope="row">2</th> <td>Jacob</td> <td>Thornton</td> <td>@fat</td> </tr> <tr> <th scope="row">3</th> <td>Larry</td> <td>the Bird</td> <td>@twitter</td> </tr> </tbody> </table>
					</div>
			<div class="col-md-offset-2 col-md-8">
				<div align="center">
					<button class=" addnew btn btn-primary">ADD NEW USER</button>
				</div>
				<br>
				<div style="border:1px solid black;">

					<table  class="table table-hover table-striped">
						<tr>
							<td><h4>ID</h4></td>
							<td><h4>USER_ID</h4></td>
							<td><h4>PASSWORD</h4></td>
							<td><h4>isActive</h4></td>
							<td><h4>cdate</h4></td>
							<td><h4>Role</h4></td>
							<td><h4>Change</h4></td>
						</tr>
						<?php
							$offset= ($pageno*3) - 3;
							$rowcount = "SELECT count(*) from login2";
							$tt= mysqli_query($conn,$rowcount);
							if($tt)
							{
								$rr = mysqli_fetch_array($tt);
								$count = $rr[0];
								$num_row = ceil($count/3);
							}
							$query= "SELECT * from login2 LIMIT $offset,3";
							$result= mysqli_query($conn,$query);
							if($result)
							{
								while($row = mysqli_fetch_array($result))
								{
									echo "<tr>
											<td>".$row[0]."</td>
											<td>".$row[1]."</td>
											<td>".$row[2]."</td>
											<td>".$row[3]."</td>
											<td>".$row[4]."</td>
											<td>".$row[5]."</td>
											<td><button type='button' class='edit btn-sm btn-primary'>Edit</button>
												<button type='button' class='delete btn-sm btn-danger'>Delete</button>
											</td>
										</tr>";
								}
							}

						?>

					</table>
				</div>
				<div align="center" class="text-center">
					<?php 
						echo "<br>Pages  - ";
						$i=1;
						for (;$i <=$num_row; $i++) { 
							echo "<button class='pgnum btn btn-sm btn-primary' golink='adduser.php?page=$i'>&nbsp;$i&nbsp;</button>";
						}
					?>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row editmode" style="display: none;">
			<div style="border: 1px solid black; border-radius: 10px;" class="col-md-8 col-md-offset-2">
				<table class="table table-striped table-hover">
					<tr>
						<th>User ID</th>
						<th>Password</th>
						<th>cdate</th>
						<th>&nbsp;</th>
					</tr>
					<tr>
						<td><input id="newuid" type="text" name="userid"><span style="color :red;" class="errormsg"></span></td>
						<td><input id="newpass" type="password" name="password"><span style="color: red;" class="errormsg"></span></td>
						<td><input type="text" readonly="readonly" value="<?php echo date("Y-m-d") ?>"></td>
						<td><button class="btn btn-primary finaladd">Add</button></td>
					</tr>
				</table>
			</div>
			<div class="col-md-2">
				
			</div>
		</div>
		<div class="row updatemode" style="display: none;">
			<div class="col-md-8 col-md-offset-2">
				<table border="1" style=" padding: 2px; border: 2px solid black; border-radius: 10px;" class="table table-condensed table-striped">
					<tr>
						<th>ID</th>
						<th>User ID</th>
						<th>Password</th>
						<th>isActive</th>
						<th>cdate (will be automatically updated)</th>
						<th>Role</th>
					</tr>

					<tr>
						<td>
							<h5 id="oldid"></h5>
						</td>
						<td>
							<h5 id="olduser_id"></h5>
						</td>
						<td>
							<h5 id="old_password"></h5>
						</td>
						<td><input id="oldisactive" type="number" min="0" max="1" name="newisactive"></td>
						<td><input id="oldcdate" type="text" name="newcdate" readonly="readonly" value="<?php echo date("Y-m-d") ?>"></td>
						<td><input name="newisadmin" id="oldisadmin" type="text"></td>
						<td><button class="btn btn-primary finalchange">Change</button></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function()
	{

		$(".delete").click(function()
		{
			var a = confirm("Are you sure want to delete. The action cannot be undone !!!");
			if(a)
			{
				var row = $(this).closest('tr');
				var column = row.find('td');
				var oid = column.eq(0).text();
				console.log(oid);
				$.ajax({

		            type : 'POST',
		            url : 'deleteuser.php',
		            data : {

		            	id : oid

		            },
		            success : function(data)
		            {
		              $.ajax({

				            type : 'POST',
				            url : 'adduser.php?page=<?php echo($pageno) ?>',
				            data : {

				            },
				            success : function(data)
				            {
				              $("#page-wrapper").html(data);
				            }

			          	});
		            }

	          	});
			}
		});


		$(".edit").click(function()
		{
			$(".editmode").css("display","none");
			var row = $(this).closest('tr');
			var column = row.find('td');
			var oid = column.eq(0).text();
			var ouname = column.eq(1).text();
			var opass = column.eq(2).text();
			var oisadmin = column.eq(5).text();
			var oisactive = column.eq(3).text();
			$(".updatemode").css("display","block");
			$("#oldid").html(oid);
			$("#olduser_id").html(ouname);
			$("#old_password").html(opass);
			$("#oldisactive").val(oisactive);
			$("#oldisadmin").val(oisadmin);
		});
		
		$(".finalchange").click(function()
		{
			$(".editmode").css("display","none");
			$(".updatemode").css("display","block");
			var id =  $("#oldid").html();
			var newactive = $("#oldisactive").val();
			var newadmin = $("#oldisadmin").val();
			var newdate = $("#oldcdate").val();
			$.ajax({

	            type : 'POST',
	            url : 'updateuser.php',
	            data : {

	            	id : id,
	            	newactive : newactive,
	            	newadmin  : newadmin,
	            	newdate : newdate

	            },
	            success : function(data)
	            {
	              $.ajax({

			            type : 'POST',
			            url : 'adduser.php?page=<?php echo($pageno) ?>',
			            data : {

			            },
			            success : function(data)
			            {
			              $("#page-wrapper").html(data);
			            }

		          	});
	            }

          	});

		});

		$(".pgnum").click(function()
		{

			var bttn  = $(this).attr('golink');
			$.ajax({

		            type : 'POST',
		            url : bttn,
		            data : {

		            },
		            success : function(data)
		            {
		              $("#page-wrapper").html(data);
		            }

	          	});

		});

		$(".addnew").click(function()
		{
			$(".editmode").css("display","block");
			$(".updatemode").css("display","none");
		});


		$(".finaladd").click(function()
		{
			var user_id = $("#newuid").val();
			var password = $("#newpass").val();
			var confirmpass = $("#newpass").val();
			$.ajax({

				type : 'POST',
				url : '../register2.php',
				data : {

					user_id : user_id,
					password : password,
					confirmpass : confirmpass

				},
				success : function(data)
				{
					$.ajax({

			            type : 'POST',
			            url : 'adduser.php?page=1',
			            data : {

			            },
			            success : function(data)
			            {
			              $("#page-wrapper").html(data);
			            }

		          	});
				}

			});
		});
	});
</script>
</html>