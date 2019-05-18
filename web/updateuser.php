<?php 
		session_start();
		include '../connect.php';
		$conn= mysqli_connect($servername,$username,$password,$database);
		$newactive = $_POST['newactive'];
		$newadmin = $_POST['newadmin'];
		$date = $_POST['newdate'];
		$id = $_POST['id'];
		if($conn)
		{
			$query = "UPDATE login set `isactive`=$newactive, `isadmin`=$newadmin, `cdate`='$date' where id=$id";
			$result=  mysqli_query($conn,$query);
			if($result)
			{
				echo "User details updated";
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