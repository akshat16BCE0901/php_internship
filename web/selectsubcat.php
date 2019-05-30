<?php 
	require('../connect.php');
	$conn = mysqli_connect($servername,$username,$password,$database);
	$maincat = $_POST['maincat'];
	$query ="select * from subcategories where `maincategory`=$maincat";
	$result = mysqli_query($conn,$query);
	if($result)
	{
		while($row = mysqli_fetch_array($result))
		{
			echo "<option value='$row[0]'>$row[1]</option>";
		}
	}
	else
	{
		echo mysqli_error($conn);
	}

?>