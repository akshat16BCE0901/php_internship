<?php
	session_start();
	require '../connect.php';	
	$conn = mysqli_connect($servername,$username,$password,$database);
?>
		<div class="main-page">
			<div class="tables">
				
				<div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table"> 
					<h4 style="display: inline-block;">Adjust Privileges</h4>
					<table class="table table-striped table-hover">
						<tr>
							<td>Select Admin Name - </td>
							<td><select id="adminname">
								<?php 

									$query = "select id,user_id from login2 where `role`='admin' or `role`='vendor'";
									$result = mysqli_query($conn,$query);
									if($result)
									{
										while($row = mysqli_fetch_array($result))
										{
											echo "<option value=".$row[0].">
												
													".$row[1]."

												  </option>";
										}
									}

								?>
							</select></td>
							<td><button class="showpriv btn btn-primary">Submit</button></td>
						</tr>
					</table>
				</div>

				<div class="fetched">
					
				</div>
								
			</div>
			
		</div>
		
</body>
<script type="text/javascript">
	$(".showpriv").click(function()
	{
		$.ajax({

			type : 'POST',
			url : 'showprivbody.php?page=1',
			data : {
				
				id : $("#adminname").val(),

			},
			success : function(data)
			{
				$(".fetched").html(data);
			}

		});
	});
</script>
</html>