<?php 

	require '../connect.php';	
	$conn = mysqli_connect($servername,$username,$password,$database);
	$id = $_POST['id'];

?>

<div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table"> 
	<h4 style="display: inline-block;">Adjust Privileges</h4> <button style="float: right;" class="btn btn-primary toggleaddprivileges">_</button>
	<table class="table table-striped table-hover addprivileges">

		<tr>
			<th>User name</th>
			<th>Menu Name</th>
			<th>Read</th>
			<th>Update</th>
			<th>Delete</th>
			<th>&nbsp;</th>
		</tr>
		<?php
			$query1 = "select A.user_id,B.id,B.read,B.update,B.delete,C.name,C.id from login2 as A inner join adminmenus as B on A.id = B.user inner join menulist as C on B.menu = C.id where A.id = '".$id."'";
			$result1=  mysqli_query($conn,$query1);
			if($result1)
			{
				while($row1 = mysqli_fetch_array($result1))
				{
					echo "<tr>
							<td>".$row1[0]."</td>
							<td>".$row1[5]."</td>
							<td><input type='checkbox' class='read' "; if($row1[2]){ echo "checked";} echo " /></td>
							<td><input type='checkbox' class='update' "; if($row1[3]){ echo "checked";} echo " /></td>
							<td><input type='checkbox' class='delete' "; if($row1[4]){ echo "checked";} echo " /></td>
							<td><button menuid='".$row1[6]."' class='updatepriv btn btn-danger'>Update</button></td>
						</tr>";
				}
			}
		 ?>
	</table>
</div>
<script type="text/javascript">
	
	$(".toggleaddprivileges").unbind().click(function()
	{
		$(".addprivileges").toggle();
		if($(".toggleaddprivileges").html()=='_')
		{
			$(".toggleaddprivileges").html()=='+';
		}
		else
		{
			$(".toggleaddprivileges").html()=='_';
		}
	});
	$(".updatepriv").unbind().click(function()
	{
		
		var row = $(this).closest('tr');
		var readpriv = row.find("input.read").is(':checked');
		var updatepriv = row.find("input.update").is(':checked');
		var deleteprivs = row.find("input.delete").is(':checked');
		var menu_id  = $(this).attr('menuid');
		var quer = "update adminmenus set `read`="+readpriv+",`update`="+updatepriv+",`delete`="+deleteprivs+" where user="+<?php echo "$id"; ?>+" and menu="+menu_id;
		console.log(quer);
		$.ajax({

			type : 'POST',
			url : 'updateprivilege.php',
			data : {
				query : quer
			},

			success : function(data)
			{
				alert(data);
				$(".showpriv").trigger('click');
			}

		});

	});

</script>