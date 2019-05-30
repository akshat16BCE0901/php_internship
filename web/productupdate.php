<?php
	session_start();
	require '../connect.php';	
	$conn = mysqli_connect($servername,$username,$password,$database);
	$pageno = $_GET['page'];
	$pageno1 = $_GET['subpage'];
?>

	<div class="main-page">
		<div class="tables">
			
			<div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table"> 
				
				<h4>All Products added by you:</h4>
				<table  class="table table-bordered">
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Brand</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Rating</th>
						<th>Image</th>
						<th>SubCategory</th>
						<th>&nbsp;</th>
					</tr>
					<?php
						$offset= ($pageno*3) - 3;
						$rowcount = "SELECT count(*) from products where `vendor_name`='".$_SESSION['user']."' and `imagelink` IS NOT NULL";
						$tt= mysqli_query($conn,$rowcount);
						if($tt)
						{
							$rr = mysqli_fetch_array($tt);
							$count = $rr[0];
							$num_row = ceil($count/3);
						}
						$query= "SELECT * from products where `vendor_name`='".$_SESSION['user']."' and `imagelink` IS NOT NULL limit $offset,3";
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
										<td>".$row[8]."</td>
										<td>".$row[4]."</td>
										<td><img src='../$row[5]' style='height :100px; width : auto;' /></td>
										<td>";
										$q = "select name from subcategories where id=$row[6]";
										$r = mysqli_query($conn,$q);
										if($r)
										{
											$row1 = mysqli_fetch_array($r);
											echo $row1[0];
										}	

										echo"</td>
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
						echo "<button class='pgnum btn btn-sm btn-primary' golink='productupdate.php?page=$i&subpage=$pageno1'>&nbsp;$i&nbsp;</button>";
					}
				?>
			</div>
			<div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table"> 
				
				<h4>Incomplete entries of images:</h4>
				<table  class="table table-bordered">
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Brand</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Rating</th>
						<th>Image</th>
						<th>SubCategory</th>
						<th>&nbsp;</th>
					</tr>
					<?php
						$offset1= ($pageno1*3) - 3;
						$rowcount1 = "SELECT count(*) from products where `vendor_name`='".$_SESSION['user']."' and `imagelink` IS NULL";
						$tt1= mysqli_query($conn,$rowcount1);
						if($tt)
						{
							$rr1 = mysqli_fetch_array($tt1);
							$count1 = $rr1[0];
							$num_row1 = ceil($count1/3);
						}
						$query1= "SELECT * from products where `vendor_name`='".$_SESSION['user']."' and `imagelink` IS NULL limit $offset1,3";
						$result1= mysqli_query($conn,$query1);
						if($result1)
						{
							while($row1 = mysqli_fetch_array($result1))
							{
								echo "<tr>
										<td>".$row1[0]."</td>
										<td>".$row1[1]."</td>
										<td>".$row1[2]."</td>
										<td>".$row1[3]."</td>
										<td>".$row1[8]."</td>
										<td>".$row1[4]."</td>
										<td><img src='../$row1[5]' style='height :100px; width : auto;' /></td>
										<td>";
										$q1 = "select name,maincategory from subcategories where id=$row1[6]";
										$r1 = mysqli_query($conn,$q1);
										if($r1)
										{
											$row2 = mysqli_fetch_array($r1);
											echo $row2[0];
										}	

										echo"</td>
										<td><button maincatid='$row2[1]' data-toggle='modal' data-target='#myModal' class='uploadimage btn-sm btn-primary'>Upload Image</button>
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
					$i1=1;
					for (;$i1 <=$num_row1; $i1++) { 
						echo "<button class='pgnum btn btn-sm btn-primary' golink='productupdate.php?page=$pageno&subpage=$i1'>&nbsp;$i1&nbsp;</button>";
					}
				?>
			</div>
			<div style="display: none;" class="editmode bs-example table-responsive widget-shadow" data-example-id="bordered-table"> 
				
				<h4>Update the product - </h4>
				<table  class="table table-bordered">
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Brand</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Rating</th>
						<th>&nbsp;</th>
					</tr>
					<tr class="newrow">
						<td id="pid"></td>
						<td><input type="text" name="newname" id="newname"></td>
						<td><input type="text" name="newbrand" id="newbrand"></td>
						<td><input type="text" name="newprice" id="newprice"></td>
						<td><input type="number" name="newquantity" id="newquantity" step="1" min="1"></td>
						<td><input type="number" name="newrating" id="newrating" step="0.1" min="0" max="5"></td>
						<td><button class="finalupdate btn btn-danger">Update</button></td>
					</tr>
				</table>
			</div>
			
		</div>
	</div>
	<div id="myModal" class="modal" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h2 class="modal-title">Upload Image</h2>
	      </div>
	      <div class="modal-body">
	      	<div id="registerdiv">
				
				<form action='uploadproductimage.php' method="post" enctype="multipart/form-data">
					<table class="table table-striped table-hover">
						<tr>
							<td>Product ID : </td>
							<td><input type="number" readonly="readonly" name="productid" id="productid"></td>
						</tr>
						<tr style="display: none;">
							<td>Subcategory : </td>
							<td><input type="text" readonly="readonly" name="subcat" id="subcat"></td>
						</tr>
						<tr style="display: none;">
							<td>MainCategory Id : </td>
							<td><input type="text" readonly="readonly" name="maincat" id="maincat"></td>
						</tr>
						<tr style="display: none;">
							<td>Brand :  </td>
							<td><input type="text" readonly="readonly" name="brand" id="brand"></td>
						</tr>
						<tr>
							<td>Upload image</td>
							<td><input required="required" type="file" name="productimage" id="productimage" /></td>
						</tr>
						<tr>
							<td colspan="2" class="text-center"><button class="btn btn-primary" type="submit">SUBMIT</button></td>
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

	
	<!-- side nav js -->
	<script type="text/javascript">
		$(document).ready(function()
		{	

			$(".uploadimage").unbind().click(function()
			{
				$("#productid").val($(this).closest('tr').find('td').eq(0).text());
				$("#brand").val($(this).closest('tr').find('td').eq(2).text());
				$("#subcat").val($(this).closest('tr').find('td').eq(7).text());
				$("#maincat").val($(this).attr('maincatid'));
			});
			$(".edit").unbind().click(function()
			{
				$(".editmode").css("display","block");
				var row = $(this).closest('tr');
				var pid = row.find('td').eq(0).text();
				$("#pid").text(pid);
				var name = row.find('td').eq(1).text();
				$("#newname").val(name);
				var brand = row.find('td').eq(2).text();
				$("#newbrand").val(brand);
				var price = row.find('td').eq(3).text();
				$("#newprice").val(price);
				var quantity = row.find('td').eq(4).text();
				$("#newquantity").val(quantity);
				var rating = row.find('td').eq(5).text();
				$("#newrating").val(rating);
			});

			$(".finalupdate").unbind().click(function()
			{
				var id = $("#pid").text();
				var name = $("#newname").val();
				var brand = $("#newbrand").val();
				var price = $("#newprice").val();
				var quantity = $("#newquantity").val();
				var rating = $("#newrating").val();
				var query = 'update products set `name`="'+name+'",`brand`="'+brand+'",`price`='+price+',`rating`='+rating+',`quantity`='+quantity+' where `id`='+id;
				$.ajax({

					type : 'POST',
					url : 'updateprivilege.php',
					data : {

						query : query

					},
					success : function(data)
					{
						$.ajax({

				            type : 'POST',
				            url : 'productupdate.php?page=1',
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
