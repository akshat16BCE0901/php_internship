<?php 
	require 'connect.php';
	$conn = mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
		$uname = trim($_POST['uname']);
		if(empty($uname))
		{
			echo "<p></p>";
		}
		else
		{
			$query = "SELECT * from login2 where `user_id`='".$uname."'";
			$result = mysqli_query($conn,$query);
			if($result)
			{
				if(mysqli_num_rows($result)>0)
				{
					echo "<p class='text-danger'>Username not available</p>";
				}
				else
				{
					echo "<p class='text-success'>Username available</p>";
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
		echo mysqli_error($conn);
	}

?>