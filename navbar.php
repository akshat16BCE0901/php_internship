<nav style="padding: 10px;" class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>                        
		</button>
		<a class="navbar-brand" style="padding:0; margin-left:0;" href="#"><img src="logo.png" alt="Mawai Infotech Limited" /></a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		<ul class="nav navbar-nav">
			<li><a href="#"></a></li>
			<li><a href="#"></a></li>
			<li><a href="#"></a></li>
			<li class="dropdown">
				<a class="btn btn-primary btn-sm dropdown-toggle" style="color: white; padding: 8px; margin-top:6px;" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-gift"></span>&nbsp;Categories 
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<?php 

						$query = "select * from categories order by id";
						$res = mysqli_query($conn,$query);
						if($res)
						{
							while($row = mysqli_fetch_array($res))
							{
								echo "<li><a href='shopping.php?category=".$row[0]."'>".$row[1]."</a></li>";
							}
						} 

					?>
		        </ul>
			</li>
			<li><a href="#"></a></li>
			<li><a href="#"></a></li>
			<?php 

			if(isset($_SESSION['user']))
			{
				echo "<li><p class='h3' style='color:white;' align='center'>Welcome to your dashboard, ".$_SESSION['user']."</p></li>";
			} 

			?>
			
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<?php 

				if(isset($_SESSION['user']))
				{ ?>
					

					<li style='padding-top: 10px;'><button class='btn btn-primary' onclick="location.href='details.php?k=<?php echo($_SESSION['user']) ?>'"><span class='glyphicon glyphicon-shopping-cart'></span>&nbsp;Invoice Details</button></li>
					<li style="padding-top: 10px;"><button class="btn btn-primary" onclick="location.href='cart.php?page=1'"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Go to cart</button></li>
					<li style='padding-top: 10px;'><button class='btn btn-primary' onclick="location.href='orders.php?page=1'"><span class='glyphicon glyphicon-shopping-cart'></span>&nbsp;Previous orders</button></li>
					<li style="padding-top: 10px;"><button class="btn btn-primary" onclick="location.href='logout.php'"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</button></li>

					<?php
				}
				else
				{
					?>

						<li style="padding-top: 10px;"><button data-toggle="modal" data-target="#myModal" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span>&nbsp;Sign Up</button></li>
						<li style="padding-top: 10px; margin-left: 4px;"><button data-toggle="modal" data-target="#myModal1"  class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Login</button></li>
	
					<?php
				}

			 ?>
			
		</ul>
		</div>
	</div>
</nav>