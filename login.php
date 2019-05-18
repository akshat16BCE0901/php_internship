<?php 
	session_start();
	require 'connect.php';

	$conn = mysqli_connect($servername,$username,$password,$database);
	$username = $_POST['user_id'];
	$password = $_POST['password'];
	$query = "select * from login where `user_id`='".$username."' and `password`='".$password."'";
	if($conn)
	{
		$result = mysqli_query($conn,$query);
		if($result)
		{
			if(mysqli_num_rows($result)>0)
			{
				$_SESSION['user'] = $username;
				echo '<script>alert("Successfully Logged in");</script>';
				$row = mysqli_fetch_array($result);
				if($row[5]==1)
				{
					echo '<script>location.href="web/index.php"</script>';
				}
				else
				{
					echo '<script>location.href="shop.php"</script>';
				}
			}
			else
			{
				echo "User not found";
			}
		}

	}
	else
	{
		echo "Error - ".mysqli_error($conn);
	}
?>