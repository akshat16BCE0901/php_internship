<?php
	session_start();
	require 'connect.php';
	$conn = mysqli_connect($servername,$username,$password,$database);
	$cat= $_GET['category'];
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
			#registerdiv
			{
				padding: 10px;
				border: 2px solid black;
				border-radius: 10px;
				background-color: #c5f2b0;
			}
			#logindiv
			{
				padding: 10px;
				border: 2px solid black;
				border-radius: 10px;
				background: #c2d3ef;
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
		<div class="side"><?php include 'sidebar.php'; ?></div>

		<div class="content">
		    <?php include 'shopping_content.php'; ?>
		</div>
		<!-- <div class="tablee">
			<?php //include 'table.php'; ?>
		</div> -->


		<div id="myModal" class="modal fade" role="dialog">
	  		<div class="modal-dialog">

	    		<!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h2 class="modal-title">Haven't Joined Yet.?? Register now!</h2>
			      </div>
			      <div class="modal-body">
			      	<div id="registerdiv">
						
						<form action='register.php' method="post" enctype="multipart/form-data">
							<table class="table table-striped table-hover">
								<tr>
									<td><h4>Enter user ID </h4></td>
									<td><input required="required" type="text" name="user_id"></td>
								</tr>
								<tr>
									<td><h4>Enter password </h4></td>
									<td><input required="required" type="password" name="password"></td>
								</tr>
								<tr>
									<td><h4>Confirm password </h4></td>
									<td><input required="required" type="password" name="confirmpass"></td>
								</tr>
		                        <tr>
		                            <td><h4>Enter your address</h4></td>
		                            <td><input required="required" type="text" name="address"></td>
		                        </tr>
		                        <tr>
		                            <td><h4>City</h4></td>
		                            <td><input required="required" type="text" name="city"></td>
		                        </tr>
		                        <tr>
		                            <td><h4>State</h4></td>
		                            <td><input required="required" type="text" name="state"></td>
		                        </tr>
		                        <tr>
		                            <td><input type="radio" name="role" value="customer"><p style="font-size:14 px;">Customer</p></td>
		                            <td><input type="radio" name="role" value="vendor"><p style="font-size:14 px;">Vendor</p></td>
		                        </tr>
		                        <tr>                            
									<td><h4>Upload Profile Picture</h4></td>
									<td><input type="file" name="image"></td>
								</tr>
								<tr>
									<td class="text-center"><button class="btn btn-primary" type="submit">SUBMIT</button></td>
									<td class="text-center"><button class="btn btn-primary" type="reset">RESET</button></td>
								</tr>
							</table>
						</form>
					</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>

	  		</div>
		</div>



		<div id="myModal1" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h2 class="modal-title">Login</h2>
		      </div>
		      <div class="modal-body">
		      	<div id="registerdiv">
					
					<form action='login.php' method="post">
						<table class="table table-striped table-hover">
							<tr>
								<td><h4>Enter user ID </h4></td>
								<td><input required="required" type="text" name="user_id"></td>
							</tr>
							<tr>
								<td><h4>Enter password </h4></td>
								<td><input required="required" type="password" name="password"></td>
							</tr>
							<tr>
								<td class="text-center"><button class="btn btn-primary" type="submit">SUBMIT</button></td>
								<td class="text-center"><button class="btn btn-primary" type="reset">RESET</button></td>
							</tr>
						</table>
					</form>
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

		$(document).on("click",".addproduct",function()
		{
			var id = $(this).attr("pid");
			var imglink = $(this).attr("imglink");
			var pname = $(this).attr("pname");
			var quantity = $(this).closest("div.tiless").find("input[name='quan']").val();
			var pp = $(this).attr("price");
			var vendorname = $(this).attr("vendor");
			var totalproductprice = parseFloat(pp)*parseInt(quantity);
			$.ajax({
				type: "POST",
				url: 'submitall.php',
				data: {

					image : imglink,
					productid : id,
					headid : "<?php echo($_SESSION['prdcthd']); ?>",
					productname : pname,
					productquantity : parseInt(quantity),
					perprice : parseFloat(pp),
					productprice : totalproductprice,
					vendorname : vendorname

				},
				success: function(data)
				{
					alert(data);
				}
			});
		});

		$('.show_products').on('click', function()
		{
			var link = $(this).attr("golink");
			$.ajax({

				type : 'POST',
				url : 'shopping_content.php',
				data : {

					tt : link
				},

				success : function(data)
				{
					$(".content").hide().html(data).fadeIn(500);

				}

			});
			$.ajax({

				type : 'POST',
				url : 'showbrands.php',
				data : {

					subcat : link,
					category : <?php echo $_GET['category']; ?>

				},
				success : function(data)
				{
					$(".brands").html(data);
				}

			});
		});
		
	</script>
</html>