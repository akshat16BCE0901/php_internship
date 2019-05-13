<?php 
	session_start();
	require 'connect.php';

	$conn = mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
		echo "";
		if(!empty($_POST['country']))
		{
			$query = "SELECT * from states where `country`='".$_POST['country']."'";
			$result = mysqli_query($conn,$query);
			if($result)
			{
				if(mysqli_num_rows($result)>0)
				{
					echo "<option>Select the state</option>";
					while($row = mysqli_fetch_assoc($result))
					{
						echo "<option>".$row['state']."</option>";
					}
				}
				else
				{
					echo "No state available";
				}
			}
			else
			{
				echo mysqli_error($conn);
			}
		}
		elseif(!empty($_POST['state']))
		{
			$query = "SELECT * from cities where `state`='".$_POST['state']."'";
			$result = mysqli_query($conn,$query);
			if($result)
			{
				if(mysqli_num_rows($result)>0)
				{
					echo "<option>Select the city</option>";
					while($row = mysqli_fetch_assoc($result))
					{
						echo "<option>".$row['city']."</option>";
					}
				}
				else
				{
					echo "No city available";
				}
			}
			else
			{
				echo mysqli_error($conn);
			}
		}
	}
	else
	{
		echo "Error - ".mysqli_error($conn);
	}
	
?>