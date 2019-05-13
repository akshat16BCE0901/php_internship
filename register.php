<?php 
	session_start();
	require 'connect.php';
	$user = $_POST['user_id'];
	$pass = $_POST['password'];
	$confirm  = $_POST['confirmpass'];	
	$conn = mysqli_connect($servername,$username,$password,$database);
	if($conn)
	{
		if($pass!=$confirm)
		{
			echo '<script>alert("Password do not match");location.href="index.php"</script>';
		}
		else
		{
			$query = "insert into login(user_id,password,cdate) values('".$user."','".$pass."','".date("Y-m-d")."')";
			$result = mysqli_query($conn,$query);
			if($result)
			{
				$_SESSION['user']=$user;
				echo '<script>alert("Successfully Logged in");location.href="shop.php"</script>';
			}
			else
			{
				echo mysqli_error($conn);
			}
		}
	}
	else
	{
		echo "Error - ".mysqli_error($conn);
	}
?>