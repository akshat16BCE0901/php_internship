<?php 

	if(isset($_POST['tt']))
	{
		$t= $_POST['tt'];
	}
	if(isset($_GET['category']))
	{
		$cat= $_GET['category'];
		$_SESSION['category'] = $cat;
	}
	if(isset($_POST['brand']))
	{
		$qu = $_POST['brand'];
	}
	include 'connect.php';
	$conn = mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
		echo " ";
	}
	else
	{
		echo "Error - ".mysqli_error($conn);
	}

?>
<div class="container-fluid">
	<div class="row">
		<?php 
			
			if(isset($_POST['brand']))
			{
				$query = $_POST['brand'];
			}
			elseif(isset($_POST['tt']))
			{
				$query = "select * from products where subcatid = $t";
			}

			else
			{
				$query = "select A.* from products as A inner join subcategories as B on A.subcatid = B.id inner join categories as C on B.maincategory = C.id where C.id=$cat";
			}
			$res = mysqli_query($conn,$query);
			if($res)
			{
				while($row1 = mysqli_fetch_array($res))
				{
					?>
						
						<div class="col-md-3 tiless">
							<div class="thumbnail text-center" style="padding: 10px;">
								<?php 

									if($row1[5]!=NULL)
									{
										?><img src="<?php echo($row1[5]) ?>" alt="pantry"><?php
									}
									else
									{
										?><img style="color: red;" alt="Image not available"><?php 
									}

								?>
								<p class="lead">Price : Rs. <?php echo($row1[3]); ?></p>
								<caption><a class="anchor-color" ><?php echo($row1[1]); ?></a></caption><br>
								<caption><a style="color: black;">Quantity available - <?php echo($row1[8]); ?></a></caption><br>
								<caption><a style="color: black;"><?php echo($row1[2]); ?></a></caption><br>
								<caption><a style="color: black;">By - <?php echo(ucwords($row1[7])); ?></a></caption><br><br>
								<div style="display:inline;" class="col-6">Quantity : <input style="max-width: 50px; height: 30px;" value="1" min="1" max="<?php echo($row1[8]); ?>" type="number" name="quan"></div>&nbsp;&nbsp;&nbsp;&nbsp;
								<div align="center" style="display:inline;" class="col-6"><button pid='<?php echo($row1[0]); ?>' pname='<?php echo($row1[1]); ?>' vendor='<?php echo($row1[7]); ?>' imglink='<?php echo($row1[5]); ?>' price='<?php echo($row1[3]); ?>' class="addproduct btn btn-sm btn-primary">Add to cart</button></div>
								
							</div>
						</div>

					<?php
				}
			}

		?>
	</div>
	
</div>