<?php
	require('connect.php');
	$name = $_POST['category'] ;
	$main = $_POST['main_category'] ;
	$conn = mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
		$query = "INSERT into subcategories(`name`,`maincategory`) VALUES('".$name."',$main)";
		$result = mysqli_query($conn,$query);
		if($result)
		{
			echo "INSERTED";
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