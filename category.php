<?php
	require('connect.php');
	$name = $_POST['category'];
	$conn = mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
		$query = "INSERT into categories(`name`) VALUES('".$name."')";
		$result = mysqli_query($conn,$query);
		if($result)
		{
			echo "INSERTED";
			header("location:adminpanel.php");
		}
		else
		{
			echo "Error  - ".mysqli_error($conn);
		}
	}
	else
	{
		echo mysqli_error($conn);
	}

?>