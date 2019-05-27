<?php
	session_start();
	require '../connect.php';	
	$conn = mysqli_connect($servername,$username,$password,$database);
	$pageno = $_GET['page'];
?>

		<div class="main-page">
			<div class="tables">
				
				<div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table"> 
					<div align="center">
						<button class="addnew btn btn-primary">ADD NEW USER</button>
					</div>
					<h4>All Users in Database:</h4>
					<table  class="table table-bordered">
					<tr>
						<th>ID</th>
						<th>USER_ID</th>
						<th>PASSWORD</th>
						<th>isActive</th>
						<th>cdate</th>
						<th>Role</th>
						<th>Change</th>
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
						$query= "SELECT * from login2 limit $offset,3";
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
							echo "<button class='pgnum btn btn-sm btn-primary' golink='tables.php?page=$i'>&nbsp;$i&nbsp;</button>";
						}
					?>
				</div>
				
			</div>
			<div class="row editmode" style="display: none;">
				<div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table">
					<table class="table table-bordered">
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
		</div>
		<div class="row updatemode" style="display: none;">
			<div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table">
				<table class="table table-responsive">
					<tr>
						<th>ID</th>
						<th>User ID</th>
						<th>Password</th>
						<th>isActive</th>
						<th>cdate (will be automatically updated)</th>
						<th>Role</th>
						<th>&nbsp;</th>
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
						<td><button class="btn btn-sm btn-primary finalchange">Change</button></td>
					</tr>
				</table>
			</div>
		</div>
		</div>
	
	<!-- side nav js -->
	<script type="text/javascript">
		$(document).ready(function()
		{

			$(".delete").unbind().click(function()
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
					            url : 'tables.php?page=<?php echo($pageno) ?>',
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
				$(".tables").css("display","none");
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
				console.log(newactive + " "+ newadmin+ " " + newdate);
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
				            url : 'tables.php?page=<?php echo($pageno) ?>',
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
				$(".tables").css("display","none");
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
				            url : 'tables.php?page=<?php echo($pageno) ?>',
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
	
		
</body>
</html>