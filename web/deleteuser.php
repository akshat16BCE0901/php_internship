<?php 
		session_start();
		include '../connect.php';
		$conn= mysqli_connect($servername,$username,$password,$database);
		$id = $_POST['id'];
		if($conn)
		{
			$query = "DELETE from login where id=$id";
			$result=  mysqli_query($conn,$query);
			if($result)
			{
				echo "DELETED";
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