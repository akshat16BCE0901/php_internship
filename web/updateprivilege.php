<?php 

	$query = $_POST['query'];
	require '../connect.php';
	$conn= mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
		$result = mysqli_query($conn,$query);
		if($result)
		{
			echo "Updated Successfully";
		}
		else
		{
			echo mysqli_error($conn);
		}
	}
	else
	{
		echo mysqli_error($conn);
	}


?>