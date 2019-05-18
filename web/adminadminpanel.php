<?php
	session_start();
	require '../connect.php';	
	$conn = mysqli_connect($servername,$username,$password,$database);
?>
		<div class="main-page">
			<div class="tables">
				
				<div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table"> 
					
					<h4>All Categories in Database</h4>
					<table class="table table-bordered">
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
				<div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table"> 

					<h4>Sub-categories in database</h4>
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
				<div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table"> 
					<h4>Add a main category</h4>
					<form method="post">
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
				<div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table"> 
					
					<h4>Add a sub-category</h4>
					<form method="post">
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

										$query = "select * from categories order by id";
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
			
		</div>
	
	<!-- side nav js -->
	<script src='js/SidebarNav.min.js' type='text/javascript'></script>
	<script>
      $('.sidebar-menu').SidebarNav()
    </script>
	<!-- //side nav js -->
	
	<!-- Classie --><!-- for toggle left push menu script -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			
			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!-- //Classie --><!-- //for toggle left push menu script -->
	
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.js"> </script>
	<script type="text/javascript">
	$(document).ready(function()
	{
		$(".disanchor").click(function()
		{
			var link  = $(this).attr("hef");
			$.ajax({

				type : 'POST',
				url : link,
				data : {



				},
				success : function(data)
				{
					$("#page-wrapper").html(data);
				}

			});
		});
		$(".masteranchor").click(function()
	      {
	        var link  = $(this).attr("hef");
	        
	          $.ajax({

	            type : 'POST',
	            url : link,
	            data : {



	            },
	            success : function(data)
	            {
	              $("#page-wrapper").html(data);
	            }

	          });
	      });
	});
</script>

		
</body>
</html>