<?php 

	require '../connect.php';	
	$conn = mysqli_connect($servername,$username,$password,$database);
	$id = $_REQUEST['id'];
	$page= $_REQUEST['page'];
	$qqq = "SELECT id from menulist where parentmenuid IS NULL and id in(select menu from adminmenus where user=$id)";
	$menuarr = array();
	$resultrow = mysqli_query($conn,$qqq);
	if($resultrow)
	{
		while($fetechrow = mysqli_fetch_array($resultrow))
		{
			array_push($menuarr, $fetechrow[0]);
		}
	}
	else
	{
		echo mysqli_query($conn);
	}


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
<div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table"> 
	<h4 style="display: inline-block;">Add Privileges</h4> <button style="float: right;" class="btn btn-primary toggleaddprivileges2">_</button>
	<form action="" method="POST" id="privform" class="addprivileges2">
		<table class="table table-striped table-hover">

			<tr>
				<th style='display : none;'>Menu ID</th>
				<th>Menu Name</th>
				<th>Select Privilege</th>
			</tr>
			<?php
				$query1 = "select id,name from menulist where parentmenuid IS NULL and id!=7";
				$result1=  mysqli_query($conn,$query1);
				if($result1)
				{
					while($row1 = mysqli_fetch_array($result1))
					{
						echo "<tr><td style='display : none;'>$row1[0]</td><td>$row1[1]</td>";

						$qu = "SELECT id,name from menulist where parentmenuid=$row1[0]";
						$res = mysqli_query($conn,$qu);
						if($res)
						{
							if(mysqli_num_rows($res)>0)
							{
								$qur = "SELECT id,name from menulist where parentmenuid=$row1[0] and id not in (select menu from adminmenus where user=$id)";
								$res = mysqli_query($conn,$qur);
								echo "<td><button type='button' class='btn btn-success btn-sm expandsubmenu'>Toggle Sub-menus</button></td></tr>";
								echo "<tr style='display : none;'><td colspan='3'><table class='table table-bordered'>";
								if($res)
								{
									if(mysqli_num_rows($res)>0)
									{
										while($rr = mysqli_fetch_array($res))
										{
											echo "<tr><td style='display : none;'>$rr[0]</td><td>$rr[1]</td><td><input type='checkbox' class='submenu' mainmenuid='$row1[0]' name='privs[]' value='$rr[0]'></td></tr>";
										}
									}
									else
									{
										echo "<tr><td colspan='2'>All Privileges under this menu are already given</td></tr>";
									}
									
									echo "</table></td></tr>";
								}
							}
							else
							{
								echo "<td><input class='mainmenu' type='checkbox' ";

								if(in_array($row1[0], $menuarr))
								{
									echo "disabled";
								}

								echo" name='privs[]' value='$row1[0]' /></td></tr>";
							}
						}
					}
				}
			 ?>
		</table>
		<button type="button" class="dondone btn btn-primary btn-lg">ADD PRIVILEGES</button>
	</form>
	
</div>
<div class="bs-example table-responsive widget-shadow" data-example-id="bordered-table"> 
	<h4 style="display: inline-block;">Remove Privileges</h4> <button style="float: right;" class="btn btn-primary toggleaddprivileges3">_</button>
	<table class="table table-striped table-hover addprivileges3">

		<tr>
			<th>Privilege ID</th>
			<th>Menu ID</th>
			<th>Menu Name</th>
			<th>&nbsp;</th>
		</tr>
		<?php
			$query1 = "select A.id,A.menu,B.name from adminmenus as A inner join menulist as B on A.menu=B.id where A.user=$id and parentmenuid is null";
			$result1=  mysqli_query($conn,$query1);
			if($result1)
			{
				while($row1 = mysqli_fetch_array($result1))
				{
					?>
						
						<tr>
							<td><?php echo $row1[0]; ?></td>
							<td><?php echo $row1[1]; ?></td>
							<td><?php echo $row1[2]; ?></td>
							<?php 

								$q = "select A.id,A.menu,B.name from adminmenus as A inner join menulist as B on A.menu=B.id where A.user=$id and parentmenuid=$row1[1]";
								$r = mysqli_query($conn,$q);
								if($r)
								{
									if(mysqli_num_rows($r)>0)
									{
										?><td><button class="btn btn-sm btn-success expandsubmenu2">Toogle sub-menus</button></td></tr><tr style="display: none;"><td colspan="4"><table class="table table-bordered"><tr><th>Privilege ID</th>
										<th>Menu ID</th>
										<th>Menu Name</th>
										<th>&nbsp;</th></tr><?php
										while($re = mysqli_fetch_array($r)) 
										{
											?>
												
												
															<tr>
																<td><?php echo $re[0]; ?></td>
																<td><?php echo $re[1]; ?></td>
																<td><?php echo $re[2]; ?></td>
																<td><button class="btn btn-danger removeprivilege ">Remove</button></td>
															</tr>
														

											<?php
										}
										echo "</table>
													</td>
												</tr>";
									}
									else
									{
										?><td><button class="btn btn-danger removeprivilege ">Remove</button></td></tr><?php
									}
								}
								else
								{
									echo mysqli_error($conn);
								}

							?>

					<?php
				}
			}
		 ?>
	</table>
	
</div>
<script type="text/javascript">
		
	$(document).ready(function()
	{
		$(".addprivileges").hide();
		$(".addprivileges2").hide();
		$(".addprivileges3").hide();
	});
	$(".expandsubmenu").unbind().click(function()
	{
		$(this).closest('tr').next('tr').toggle();
	});
	$(".expandsubmenu2").unbind().click(function()
	{
		$(this).closest('tr').next('tr').toggle();
	});
	$(".removeprivilege").unbind().click(function()
	{
		var privid = $(this).closest('tr').find('td').eq(0).text();
		var query= "DELETE from adminmenus where id="+privid;
		$.ajax({

			type : 'POST',
			url : 'updateprivilege.php',
			data : {
				query : query
			},
			success : function(data)
			{
				alert(data);
				$.ajax({

					type : 'POST',
					url : 'showprivbody.php?page=1',
					data : {
						
						id : <?php echo "$id"; ?>,

					},
					success : function(data)
					{
						$(".fetched").html(data);
					}

				});
			}

		});
	});
	var menuids = [];
	var uniqueids = [];
	$(".dondone").unbind().click(function()
	{
		$(".mainmenu:checkbox:checked").each(function()
		{
			menuids.push($(this).val());
		});
		$(".submenu:checkbox:checked").each(function()
		{
			menuids.push($(this).val());
			menuids.push($(this).attr('mainmenuid'));
		});
		$.each(menuids, function(i, el){
		    if($.inArray(el, uniqueids) === -1) uniqueids.push(el);
		});
		$.ajax({

			type : 'POST',
			url : 'addprivilege.php',
			data : {

				arr : JSON.stringify({params : uniqueids}),
				id : <?php echo "$id"; ?>

			},
			success : function(data)
			{
				alert(data);
				$.ajax({

					type : 'POST',
					url : 'showprivbody.php?page=1',
					data : {
						
						id : <?php echo "$id"; ?>,

					},
					success : function(data)
					{
						$(".fetched").html(data);
					}

				});
			}

		});
		console.log(uniqueids);
	});

	$(".toggleaddprivileges").unbind().click(function()
	{
		$(".addprivileges").toggle();
		if($(".toggleaddprivileges").text()=='_')
		{
			$(".toggleaddprivileges").text()=='+';
		}
		else
		{
			$(".toggleaddprivileges").text()=='_';
		}
	});
	$(".toggleaddprivileges2").unbind().click(function()
	{
		$(".addprivileges2").toggle();
		if($(".toggleaddprivileges2").text()=='_')
		{
			$(".toggleaddprivileges2").text()=='+';
		}
		else
		{
			$(".toggleaddprivileges2").text()=='_';
		}
	});
	$(".toggleaddprivileges3").unbind().click(function()
	{
		$(".addprivileges3").toggle();
		if($(".toggleaddprivileges3").text()=='_')
		{
			$(".toggleaddprivileges3").text()=='+';
		}
		else
		{
			$(".toggleaddprivileges3").text()=='_';
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