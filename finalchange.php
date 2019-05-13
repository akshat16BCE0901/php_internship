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
		$id= $_POST['primaryid'];
		$newquantity = $_POST['newquantity'];
		$newprice = $_POST['newprice'];
		$query = "UPDATE `productdetails` SET `quantity`=$newquantity ,`price`= $newprice WHERE `id`= $id";
		$result = mysqli_query($conn,$query);
		if($result)
		{
			echo '<script>alert("Successfully Updated");location.href="cart.php"</script>';
		}	
		else
		{
			echo mysqli_error($conn);
		}
		echo $query;
	}
	else
	{
		echo "Error - ".mysqli_error($conn);
	}


 ?>