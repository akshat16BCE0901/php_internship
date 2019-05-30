<?php
	session_start();
	require '../connect.php';	
	$conn = mysqli_connect($servername,$username,$password,$database);
?>

<div class="main-page">
	<div class="tables">
		
		<div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table"> 
			<div align="center">
				<h2>Enter product details</h2><br><br>
			</div>
			<div>
				<form method="post" action="newproduct.php" enctype="multipart/form-data">
					<table class="table table-bordered">
						<tr>
							<tr><td>Enter Name : </td><td><input required="required" name="pname" type="text"></td></tr>
							<tr><td>Enter Brand :</td><td><input required="required" name="pbrand" type="text"></td></tr>
							<tr><td>Enter price :</td><td><input required="required" name="pprice" type="text"></td></tr>
							<tr><td>Enter Rating (scale of 0-5) :</td><td><input required="required" name="prating" type="number" step="0.1" min="0" max="5.0"></td></tr>
							<tr><td>Enter quantity :</td><td><input required="required" name="pquantity" type="number" min="1"></td></tr>
							<tr><td>Upload Product Image :</td><td><input required="required" id="pimage" name="pimage" type="file"></td></tr>
							<tr><td>Select Main Category :</td><td><select required="required" id="maincategories" name="maincat">
								<option value="">Select Main category :</option>
								<?php 

									$query = "select * from categories order by id";
									$result = mysqli_query($conn,$query);
									if($result)
									{
										while($row = mysqli_fetch_array($result))
										{
											echo"<option value='$row[0]'>$row[1]</option>";
										}
										
									}

								?>
							</select></td></tr>
							<tr><td>Select Sub category :</td><td>
								<select required="required" name="subcat" id="subcategories">
									<option>
										Select Main category first
									</option>
								</select>
							</td></tr>
							<tr><td align="center" colspan="2"><button type="submit" class="btn btn-primary">Submit</button></td></tr>
						</tr>
						

					</table>
				</form>
			</div>
		</div>

		<div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table"> 
			<div align="center">
				<h2>Enter product details</h2><br><br>
			</div>
			<div>
				<form method="post" action="uploadcsv.php" enctype="multipart/form-data">
					<table class="table table-bordered">
						<tr>
							<td>Upload CSV file : </td>
							<td><input type="file" name="csvdata" id="csvdata"></td>
						</tr>
						<tr>
							<td><button type="reset" class="btn btn-primary" name="reset">RESET</button></td>
							<td><button type="submit" class="btn btn-primary" name="submit">SUBMIT</button></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		
		
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function()
	{
		$("#maincategories").on('change',function()
		{
			var a = $("#maincategories").val();
			$.ajax({

				type : 'POST',
				url : 'selectsubcat.php',
				data : {
					maincat : a
				},
				success : function(data)
				{
					$('#subcategories').html(data);
					console.log(data);
				}

			});
		});	
	});
</script>