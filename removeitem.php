<?php

	session_start();
	require 'connect.php';
	if(!isset($_SESSION['user']))
	{
		echo '<script>alert("Sign up/Log in to access dashboard");location.href="index.php"</script>';
	}
	$conn = mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
		$id= $_POST['id'];
		$query = "DELETE from `productdetails` WHERE `id`=".$id;
		if(mysqli_query($conn,$query))
		{
			echo "Item removed";
		}
		else
		{
			echo mysqli_error($conn);
		}

	}
	else
	{
		echo "Error - ".mysqli_error($conn);
	}


 ?>
 