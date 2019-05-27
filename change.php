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
		$newquantity = $_POST['newquantity'];
		$newprice = $_POST['newprice'];
		$query = "UPDATE `productdetails` SET `quantity`= $newquantity, `price`=$newprice WHERE `id`=".$id;
		if(mysqli_query($conn,$query))
		{
			echo "Updated";
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
 