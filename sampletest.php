<?php
	session_start();
	require '../connect.php';	
	$conn = mysqli_connect($servername,$username,$password,$database);
	$pageno = $_GET['page'];
	$pageno1 = $_GET['subpage']
?>
		<div class="main-page">
			<div class="tables">
				
				<div class="bs-example table-responsive widget-shadow addnewcat" data-example-id="bordered-table"> 
					<h4 style="display: inline-block;">Add a main category</h4> <button style="float: right;" class="btn btn-primary togglealladdmaincat">_</button>
					<form class="alladdmaincat">
						<div><h4 style="color: green;" id="subcatmsg"></h4></div>
						<table class="table table-striped table-hover">
							<tr>
								<td colspan="2"><h3 align="center">Enter details</h3></td>	
							</tr>
							<tr>
								<td>Enter category Name</td>
								<td><input type="text" id="maincategory"></td>
							</tr>
							<tr>
								<td><input value="Insert" class="btn insertmaincat btn-primary"></td>
								<td><input type="reset" value="Reset" class="btn btn-primary"></td>
							</tr>
						</table>
					</form>
				</div>

				<div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table"> 
					
					<h4 style="display: inline-block;">All Categories in Database</h4> <button style="float: right;" class="btn btn-primary toggleallcat">_</button>
					<table class="table table-bordered allcat">
						<tr>
							<th>ID</th>
							<th>Category Name</th>
						</tr>
						<?php
							$offset= ($pageno*3) - 3;
							$rowcount = "SELECT count(*) from categories";
							$tt= mysqli_query($conn,$rowcount);
							if($tt)
							{
								$rr = mysqli_fetch_array($tt);
								$count = $rr[0];
								$num_row = ceil($count/3);
							}
							$query = "select * from categories order by id limit $offset,3";
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
					<div align="center" class="text-center allcat">
						<?php 
							echo "<br>Pages  - ";
							$i=1;
							for (;$i <=$num_row; $i++) { 
								echo "<button class='pgnum btn btn-sm btn-primary' golink='adminadminpanel.php?page=$i&subpage=$pageno1'>&nbsp;$i&nbsp;</button>";
							}
						?>
					</div>
				</div>
				
				<div class="bs-example table-responsive widget-shadow addnewsubcat" data-example-id="bordered-table"> 
					
					<h4 style="display: inline-block;">Add a sub category</h4> <button style="float: right;" class="btn btn-primary togglealladdsubcat">_</button>
					<form class="alladdsubcat">
						<div><h4 style="color: green;" id="subcatmsg"></h4></div>
						<table class="table table-striped table-hover">
							<tr>
								<td colspan="2"><h3 align="center">Enter details</h3></td>	
							</tr>
							<tr>
								<td>Enter category Name</td>
								<td><input type="text" id="subcategory"></td>
							</tr>
							<tr>
								<td>Select Main Category</td>
								<td><select id="main_category">
									
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
								<td><input value="Insert" class="btn insertsubcat btn-primary"></td>
								<td><input type="reset" value="Reset" class="btn btn-primary"></td>
							</tr>
						</table>
					</form>
				</div>

				<div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table"> 

					<h4 style="display: inline-block;">All Sub-categories in Database</h4> <button style="float: right;" class="btn btn-primary toggleallsubcat">_</button>
					<table class="table table-striped table-hover allsubcat">
				
						<tr>
							<th>ID</th>
							<th>Category Name</th>
							<th>Main Category ID</th>
							<th>Main Cateogry Name</th>
						</tr>
						<?php
							$offset1= ($pageno1*4) - 4;
							$rowcount1 = "select count(*) from subcategories as A inner join categories as B on A.maincategory = B.id";
							$tt1= mysqli_query($conn,$rowcount1);
							if($tt1)
							{
								$rr1 = mysqli_fetch_array($tt1);
								$count1 = $rr1[0];
								$num_row1 = ceil($count1/4);
							}
							$query1 = "select A.*,B.name from subcategories as A inner join categories as B on A.maincategory = B.id limit $offset1,4";
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
					<div align="center" class="text-center allsubcat">
						<?php 
							echo "<br>Pages  - ";
							$i1=1;
							for (;$i1 <=$num_row1; $i1++) { 
								echo "<button class='pgnum1 btn btn-sm btn-primary' golink='adminadminpanel.php?page=$pageno&subpage=$i1'>&nbsp;$i1&nbsp;</button>";
							}
						?>
					</div>
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
		// $(".allcat").hide();
		// $(".alladdmaincat").hide();
		// $(".allsubcat").hide();
		// $(".alladdsubcat").hide();
		$(".toggleallcat").unbind().click(function()
		{
			$(".allcat").toggle();
			if($(".toggleallcat").html()=="_")
			{
				$(".toggleallcat").html("+");
			}
			else
			{
				$(".toggleallcat").html("_");
			}
		});
		$(".togglealladdmaincat").unbind().click(function()
		{
			$(".alladdmaincat").toggle();
			if($(this).html()=="_")
			{
				$(this).html("+");
			}
			else
			{
				$(this).html("_");
			}
		});
		$(".togglealladdsubcat").unbind().click(function()
		{
			$(".alladdsubcat").toggle();
			if($(this).html()=="_")
			{
				$(this).html("+");
			}
			else
			{
				$(this).html("_");
			}
		});
		$(".toggleallsubcat").unbind().click(function()
		{
			$(".allsubcat").toggle();
			if($(".toggleallsubcat").html()=="_")
			{
				$(".toggleallsubcat").html("+");
			}
			else
			{
				$(".toggleallsubcat").html("_");
			}
		});

		$(".insertmaincat").unbind().click(function()
		{
			var category = $("#maincategory").val();
			$.ajax({

				type : 'POST',
				url : '../category.php',
				data : {

					category : category

				},
				success : function(data)
				{
					$.ajax({

					type : 'POST',
					url : 'adminadminpanel.php?page=1&subpage=1',
					data : {

					},
					success : function(data)
					{
						alert("Inserted");
						$("#page-wrapper").html(data);
					}

				});
				}

			});
		});

		$(".insertsubcat").unbind().click(function()
		{
			var subcategory = $("#subcategory").val();
			var main_category = $("#main_category").val();
			$.ajax({

				type : 'POST',
				url : '../subcategory.php',
				data : {

					category : subcategory,
					main_category : main_category

				},
				success : function(data)
				{
					$.ajax({

						type : 'POST',
						url : 'adminadminpanel.php?page=1&subpage=1',
						data : {

						},
						success : function(data)
						{
							alert("Inserted");
							$("#page-wrapper").html(data);
						}

					});
				}

			});
		});

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
		              $(".allsubcat").hide();
		            }

	          	});

		});
		$(".pgnum1").click(function()
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
		              $(".allcat").hide();
		            }

	          	});

		});
	});
</script>

		
</body>
</html>